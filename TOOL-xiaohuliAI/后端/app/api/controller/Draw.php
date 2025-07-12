<?php

namespace app\api\controller;

use think\facade\Db;
use think\facade\Log;

class Draw extends Base
{
    /**
     * 获取消息历史记录
     */
    public function getHistoryMsg()
    {
        $list = Db::name('msg_draw')
            ->where([
                ['site_id', '=', self::$site_id],
                ['user_id', '=', self::$user['id']],
                ['is_delete', '=', 0]
            ])
            ->field('id,channel,message,images,state,errmsg')
            ->order('id desc')
            ->limit(10)
            ->select()->toArray();
        $msgList = [];
        $list = array_reverse($list);
        foreach ($list as $v) {
            $msgList[] = [
                'draw_id' => $v['id'],
                'channel' => $v['channel'],
                'state' => $v['state'],
                'errmsg' => $v['errmsg'],
                'message' => $v['message'],
                'response' => explode('|', $v['images'])
            ];
        }

        return successJson($msgList);
    }

    /**
     * 提交绘画接口
     */
    public function draw()
    {
        $message = input('message', '', 'trim');
        $draw_id = input('draw_id', '0', 'intval');
        $options = input('options', '', 'trim');
        if (empty($message) && !$draw_id) {
            return errorJson('请输入画面描述');
        }

        $user = Db::name('user')
            ->where('id', self::$user['id'])
            ->find();
        if (!$user) {
            $_SESSION['user'] = null;
            return errorJson('请登录');
        }

        // 禁言用户
        if ($user['is_freeze']) {
            return errorJson('系统繁忙，请稍后再试');
        }

        if (intval($user['balance_draw']) <= 0) {
            return errorJson('绘图次数用完了，请充值！');
        }

        $now = time();
        $taskNum = Db::name('msg_draw')
            ->where([
                ['site_id', '=', self::$site_id],
                ['user_id', '=', self::$user['id']],
                ['state', '=', 0],
                ['is_delete', '=', 0],
                ['create_time', '>', $now - 180]
            ])
            ->count();
        if ($taskNum >= 5) {
            return errorJson('最多同时进行5个任务，请稍后再试');
        }

        // 插入一条绘画记录
        if ($draw_id) {
            $draw = Db::name('msg_draw')
                ->where([
                    ['site_id', '=', self::$site_id],
                    ['id', '=', $draw_id],
                    ['is_delete', '=', 0]
                ])
                ->field('id,message_input,options')
                ->find();
            if (!$draw) {
                return errorJson('没有找到此绘画记录');
            }
            Db::name('msg_draw')
                ->where([
                    ['site_id', '=', self::$site_id],
                    ['id', '=', $draw['id']]
                ])
                ->update([
                    'state' => 0,
                    'images' => '',
                    'errmsg' => '',
                    'finish_time' => 0,
                    'create_time' => time()
                ]);
            $message = $draw['message_input'];
            $options = $draw['options'];
        } else {
            if (empty($message)) {
                $this->setDrawFail($draw_id, '请输入画面描述');
            }
            $clearMessage = wordFilter($message);
            $draw_id = Db::name('msg_draw')
                ->insertGetId([
                    'site_id' => self::$site_id,
                    'user_id' => self::$user['id'],
                    'message' => $clearMessage,
                    'message_input' => $message,
                    'state' => 0, // 0生成中 1已生成 2生成失败
                    'options' => $options,
                    'create_time' => time()
                ]);
        }

        // 扣费
        changeUserDrawBalance($user['id'], -1, '绘画消费');

        // 异步执行绘画任务
        $drawSetting = getSystemSetting(self::$site_id, 'draw');
        $platform = $drawSetting['platform'] ?? 'openai';
        $channel = $drawSetting['channel'] ?? 'openai';
        if (empty($options)) {
            $options = json_encode([
                'channel' => $drawSetting['channel']
            ]);
        }
        $drawTaskUrl = 'https://' . $_SERVER['HTTP_HOST'] . '/web.php/draw/submitDrawTask';
        $this->httpRequest($drawTaskUrl, [
            'platform' => $platform,
            'channel' => $channel,
            'draw_id' => $draw_id,
            'message' => $message,
            'options' => $options
        ]);

        return successJson([
            'draw_id' => $draw_id
        ]);
    }

    /**
     * 异步提交绘画任务
     * 仅供系统内部调用
     * 前端请勿使用此接口
     */
    public function submitDrawTask($draw_id = 0)
    {
        ignore_user_abort();
        set_time_limit(300);

        $platform = input('platform', 'openai', 'trim');
        $channel = input('channel', 'openai', 'trim');
        $message = input('message', '', 'trim');
        $options = input('options', '');
        if (!$draw_id) {
            $draw_id = input('draw_id', '0', 'intval');
        }
        if (!$draw_id) {
            exit;
        }

        $user = Db::name('user')
            ->where('id', self::$user['id'])
            ->find();
        if (!$user) {
            $this->setDrawFail($draw_id, '请重新登录');
        }

        // 禁言用户
        if ($user['is_freeze']) {
            $this->setDrawFail($draw_id, '系统繁忙，请稍后再试');
        }

        $clearMessage = wordFilter($message);
        $options = $options ? json_decode($options, true) : [];
        $apikey = $this->getApiKey($channel);
        if (empty($apikey)) {
            $this->setDrawFail($draw_id, 'key已用尽，请等待平台处理');
        }

        if (in_array($channel, ['openai', 'api2d', 'replicate'])) {
            // 同步绘画方式
            $urls = [];
            if ($channel == 'openai' || $channel == 'api2d') {
                $ChatGPT = new \ChatGPT\openai($apikey);
                if ($channel == 'openai') {
                    $apiSetting = getSystemSetting(0, 'api');
                    if ($apiSetting['channel'] == 'agent' && $apiSetting['agent_host']) {
                        $ChatGPT->setApiHost(rtrim($apiSetting['agent_host'], '/'));
                    }
                } elseif ($channel == 'api2d') {
                    $ChatGPT->setApiHost('https://openai.api2d.net');
                }

                $result = $ChatGPT->draw([
                    'prompt' => $clearMessage,
                    'size' => $options['size'] ?? '512x512',
                    'n' => $options['num'] ?? 1,
                    'response_format' => 'b64_json'
                ]);
            } elseif ($channel == 'replicate') {
                $replicateSDK = new \ChatGPT\replicate($apikey);
                $result = $replicateSDK->draw([
                    'prompt' => $clearMessage
                ]);
            }
            if (empty($result)) {
                $this->setDrawFail($draw_id, '未知错误');
            }

            if ($result['errno']) {
                $errLevel = 'warning';
                $errMsg = $result['message'];
                if ($channel == 'openai') {
                    if (strpos($errMsg, 'Billing hard limit has been reached') !== false) {
                        $errLevel = 'error';
                        $errMsg = '接口余额不足';
                    }
                } elseif ($channel == 'api2d') {
                    if (strpos($errMsg, 'Not enough point') !== false) {
                        $errLevel = 'error';
                        $errMsg = '接口余额不足';
                    }
                }
                if ($errLevel == 'error') {
                    $this->setKeyStop($channel, $apikey, $errMsg);
                    $this->submitDrawTask($draw_id);
                } else {
                    $this->setDrawFail($draw_id, $errMsg);
                }
                exit;
            }

            foreach ($result['data'] as $img) {
                if ($channel == 'openai') {
                    $url = $this->saveToFile($img['b64_json']);
                } elseif ($channel == 'api2d') {
                    $url = $this->saveToFile($img['url']);
                } elseif ($channel == 'replicate') {
                    $url = $this->saveToFile($img);
                }
                if (!empty($url)) {
                    $urls[] = $url;
                }
            }
            if (empty($urls)) {
                $this->setDrawFail($draw_id, '生成图片失败');
                exit;
            }

            // 生成成功，更新状态
            Db::name('msg_draw')
                ->where('id', $draw_id)
                ->update([
                    'platform' => $platform,
                    'channel' => $channel,
                    'images' => implode('|', $urls),
                    'state' => 1,
                    'finish_time' => time()
                ]);

        } elseif (in_array($channel, ['lxai', 'yijian'])) {
            // 异步绘画方式
            if ($channel == 'lxai') {
                $notifyUrl = 'https://' . $_SERVER['HTTP_HOST'] . '/api.php/notify/lxai';
                $lxaiSDK = new \ChatGPT\lxai($apikey);
                if ($platform == 'mj') {
                    $result = $lxaiSDK->drawMJ([
                        'prompt' => $clearMessage,
                        'imageurl' => $options['image'] ?? '',
                        'notifyHook' => $notifyUrl
                    ]);
                    if ($result['errno']) {
                        $this->setDrawFail($draw_id, $result['message']);
                    }

                    $task_id = $result['data'] ?? '';
                }
            } elseif ($channel == 'yijian') {
                $notifyUrl = 'https://' . $_SERVER['HTTP_HOST'] . '/api.php/notify/yijian';

                $temp = explode('|', $apikey);
                $apikey = $temp[0];
                $apisecret = $temp[1] ?? '';
                $yijianSDK = new \ChatGPT\yijian($apikey, $apisecret);
                if (!empty($options['sub_style'])) {
                    $style = $options['sub_style'];
                } elseif (!empty($options['style'])) {
                    $style = $options['style'];
                } else {
                    $style = '';
                }
                $result = $yijianSDK->submitDrawTask([
                    'prompt' => $clearMessage,
                    'ratio' => $options['size'] ?? 0,
                    'style' => $style,
                    'guidence_scale' => 7.5,
                    'engine' => $options['engine'] ?? 'default_dreamer_diffusion',
                    'callback_url' => $notifyUrl,
                    'init_image' => $options['image'] ?? ''
                ]);
                if ($result['errno']) {
                    $this->setDrawFail($draw_id, $result['message']);
                }

                $task_id = $result['data']['Uuid'] ?? '';
            }

            Db::name('msg_draw')
                ->where('id', $draw_id)
                ->update([
                    'platform' => $platform,
                    'channel' => $channel,
                    'task_id' => $task_id
                ]);
        }
    }

    public function mjCtrl()
    {
        $draw_id = input('draw_id', 0, 'intval');
        $type = input('type', 'upscale', 'trim');
        $index = input('index', 1, 'intval');
        $draw = Db::name('msg_draw')
            ->where([
                ['site_id', '=', self::$site_id],
                ['id', '=', $draw_id]
            ])
            ->find();
        if (!$draw) {
            return errorJson('参数错误');
        }
        if ($draw['state'] != 1) {
            return errorJson('请在绘图成功操作');
        }
        if ($draw['platform'] != 'mj' || $draw['channel'] != 'lxai') {
            return errorJson('不支持的操作');
        }

        $draw_id = Db::name('msg_draw')
            ->insertGetId([
                'site_id' => self::$site_id,
                'user_id' => self::$user['id'],
                'platform' => $draw['platform'],
                'channel' => $draw['channel'],
                'message' => $draw['message'] . ' ' . $type . ' ' . $index,
                'message_input' => $draw['message_input'] . ' ' . $type . ' ' . $index,
                'state' => 0, // 0生成中 1已生成 2生成失败
                'options' => $draw['options'],
                'create_time' => time()
            ]);

        // 扣费
        changeUserDrawBalance(self::$user['id'], -1, '绘画消费');

        $apikey = $this->getApiKey($draw['channel']);
        $notifyUrl = 'https://' . $_SERVER['HTTP_HOST'] . '/api.php/notify/lxai';
        $lxaiSDK = new \ChatGPT\lxai($apikey);
        $result = $lxaiSDK->mjCtrl([
            'id' => $draw['task_id'],
            'type' => $type,
            'index' => $index,
            'notifyHook' => $notifyUrl
        ]);
        if ($result['errno']) {
            $this->setDrawFail($draw_id, $result['message']);
        }

        $task_id = $result['data'] ?? '';
        Db::name('msg_draw')
            ->where('id', $draw_id)
            ->update([
                'task_id' => $task_id
            ]);

        return successJson([
            'draw_id' => $draw_id
        ]);
    }

    private function setKeyStop($channel, $key, $errorMsg)
    {
        if ($errorMsg) {
            Db::name('keys')
                ->where([
                    ['site_id', '=', self::$site_id],
                    ['type', '=', $channel],
                    ['key', '=', $key]
                ])
                ->update([
                    'state' => 0,
                    'stop_reason' => $errorMsg
                ]);
        }
    }

    /**
     * 供前端轮询绘画结果
     */
    public function getDrawResult()
    {
        $draw_id = input('draw_id', 0, 'intval');
        $draw = Db::name('msg_draw')
            ->where([
                ['site_id', '=', self::$site_id],
                ['id', '=', $draw_id],
                ['is_delete', '=', 0]
            ])
            ->find();
        if (!$draw) {
            // 未找到任务
            return successJson([
                'state' => -1
            ]);
        }
        if ($draw['state'] == 0) {
            $now = time();
            if ($now - $draw['create_time'] > 300) {
                $errMsg = '图片生成失败';
                $this->setDrawFail($draw_id, $errMsg);
                return successJson([
                    'state' => 2,
                    'message' => $errMsg
                ]);
            }
            return successJson([
                'state' => 0
            ]);
        } elseif ($draw['state'] == 1) {
            return successJson([
                'state' => 1,
                'images' => explode('|', $draw['images'])
            ]);
        } elseif ($draw['state'] == 2) {
            return successJson([
                'state' => 2,
                'message' => $draw['errmsg']
            ]);
        } else {
            // 未知状态
            return successJson([
                'state' => -1
            ]);
        }
    }

    private function setDrawFail($draw_id, $errMsg)
    {
        Db::name('msg_draw')
            ->where('id', $draw_id)
            ->update([
                'state' => 2,
                'errmsg' => $errMsg
            ]);
        // 退费
        changeUserDrawBalance(self::$user['id'], 1, '绘画失败退费');
    }

    /**
     * 保存图片文件内容到本地或者云存储
     */
    private function saveToFile($content)
    {
        if (strpos($content, 'https://') !== false || strpos($content, 'http://') !== false) {
            $context = stream_context_create([
                'http' => ['method' => 'GET', 'timeout' => 30],
                'ssl' => ['verify_peer' => false, 'verify_peer_name' => false]
            ]);
            $content = file_get_contents($content, false, $context);
        } else {
            $content = base64_decode($content);
        }
        if (empty($content)) {
            return '';
        }
        // 保存到本地
        $date = date('Ymd');
        $dir = './upload/draw/' . $date . '/';
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        $filepath = $dir . self::$user['id'] . uniqid() . '.png';
        file_put_contents($filepath, $content);
        if (!file_exists($filepath)) {
            return '';
        }
        $url = saveToOss($filepath);

        return $url;
    }

    /**
     * 从key池里取回一个key
     */
    private function getApiKey($type = 'openai')
    {
        $rs = Db::name('keys')
            ->where([
                ['site_id', '=', self::$site_id],
                ['type', '=', $type],
                ['state', '=', 1]
            ])
            ->order('last_time asc, id asc')
            ->find();
        if (!$rs) {
            return '';
        }
        Db::name('keys')
            ->where('id', $rs['id'])
            ->update([
                'last_time' => time()
            ]);
        return $rs['key'];
    }

    private function httpRequest($url, $post = '')
    {
        $token = session_id();
        $header = [
            'x-token: ' . $token ?? ''
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, 1000);
        if ($post) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        curl_exec($ch);
        curl_close($ch);
    }
}
