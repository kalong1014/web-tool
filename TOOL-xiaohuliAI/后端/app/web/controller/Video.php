<?php

namespace app\web\controller;

use think\facade\Db;
use think\facade\Filesystem;

class Video extends Base
{
    /**
     * 获取消息历史记录
     */
    public function getHistoryMsg()
    {
        $platform = input('platform', 'pika', 'trim');
        if (!in_array($platform, ['pika', 'runway', 'stable', 'sora', 'luma'])) {
            return errorJson('参数错误：未知的通道');
        }

        $where = [
            ['site_id', '=', self::$site_id],
            ['user_id', '=', self::$user['id']],
            ['is_delete', '=', 0],
            ['platform', '=', $platform]
        ];
        $list = Db::name('msg_video')
            ->where($where)
            ->field('id,platform,channel,action,prompt,video_url,video_poster,video_duration,seed,state,errmsg,create_time')
            ->order('id desc')
            ->limit(10)
            ->select()->toArray();
        $msgList = [];
        $list = array_reverse($list);
        foreach ($list as $v) {
            $msgList[] = [
                'video_id' => $v['id'],
                'platform' => $v['platform'],
                'action' => $v['action'],
                'state' => $v['state'],
                'errmsg' => $v['errmsg'],
                'prompt' => $v['prompt'],
                'video' => $v['video_url'],
                'poster' => $v['video_poster'],
                'duration' => $v['video_duration'],
                'seed' => $v['seed'],
                'create_time' => date('Y-m-d H:i:s', $v['create_time'])
            ];
        }

        return successJson($msgList);
    }

    /**
     * 获取公开作品列表
     */
    public function getPublicList()
    {
        $page = input('page', 1, 'intval');
        $pagesize = input('pagesize', 30, 'intval');
        $platform = input('platform', 'pika', 'trim');
        if (!in_array($platform, ['pika', 'runway', 'stable', 'sora', 'luma'])) {
            return errorJson('参数错误：未知的通道');
        }

        $where = [
            ['site_id', '=', self::$site_id],
            ['is_show', '=', 1],
            ['platform', '=', $platform]
        ];
        $list = Db::name('msg_video_public')
            ->where($where)
            ->field('id,platform,prompt,video_url,video_poster,video_duration,seed,create_time')
            ->order('weight desc, id desc')
            ->page($page, $pagesize)
            ->select()->toArray();
        $count = Db::name('msg_video_public')
            ->where($where)
            ->count();
        $videoList = [];
        foreach ($list as $v) {
            $videoList[] = [
                'video_id' => $v['id'],
                'platform' => $v['platform'],
                'prompt' => $v['prompt'],
                'video' => $v['video_url'],
                'poster' => $v['video_poster'],
                'duration' => $v['video_duration'],
                'seed' => $v['seed']
            ];
        }

        return successJson([
            'list' => $videoList,
            'count' => $count
        ]);
    }

    /**
     * 提交生成视频任务
     */
    public function submitTask()
    {
        try {
            #1、
            $user = Db::name('user')
                ->where('id', self::$user['id'])
                ->find();
            if (!$user) {
                $_SESSION['user'] = null;
                return errorJson('请登录');
            }
            // 判断禁言
            if ($user['is_freeze']) {
                return errorJson('系统繁忙，请稍后再试');
            }
            // 判断余额
            $price = getFuncPrice(self::$site_id, $user, 'video');
            if ($price && $user['balance_point'] < $price) {
                return errorJson('余额不足，请充值！');
            }
            // 判断并行任务
            $now = time();
            $taskNum = Db::name('msg_video')
                ->where([
                    ['site_id', '=', self::$site_id],
                    ['user_id', '=', self::$user['id']],
                    ['state', '=', 0],
                    ['is_delete', '=', 0],
                    ['create_time', '>', $now - 600]
                ])
                ->count();
            if ($taskNum >= 5) {
                return errorJson('最多同时进行5个任务，请稍后再试');
            }

            $videoSetting = getSystemSetting(self::$site_id, 'video');

            #2、
            $video_id = input('video_id', 0, 'intval');
            if ($video_id) {
                $info = Db::name('msg_video')
                    ->where([
                        ['site_id', '=', self::$site_id],
                        ['id', '=', $video_id],
                        ['is_delete', '=', 0]
                    ])
                    ->find();
                if (!$info) {
                    return errorJson('没有找到记录，请刷新页面后重试');
                }

                $action = $info['action'];
                $platform = $info['platform'];
                $channel = $info['channel'];
                $promptEn = $info['prompt_en'] ? $info['prompt_en'] : $info['prompt'];
                $clearPrompt = $info['prompt'];
                $seed = $info['seed'];
                $options = @json_decode($info['options'], true);
                // 状态重置
                Db::name('msg_video')
                    ->where('id', $info['id'])
                    ->update([
                        'state' => 0,
                        'video_url' => '',
                        'video_poster' => '',
                        'video_duration' => 0,
                        'errmsg' => '',
                        'is_refund' => 0,
                        'finish_time' => 0,
                        'create_time' => $now
                    ]);
            } else {
                $platform = input('platform', 'pika', 'trim');
                if (!in_array($platform, ['pika', 'runway', 'stable', 'sora', 'luma'])) {
                    return errorJson('参数错误：未知的通道');
                }
                $options = input('options', '', 'trim');
                $options = @json_decode($options, true);
                if ($platform == 'pika') {
                    if (empty($options)) {
                        $options = [
                            'action' => 'generate',
                            'prompt' => '',
                            'aspectRatio' => '16:9',
                            'pan' => '',
                            'tilt' => '',
                            'rotate' => '',
                            'zoom' => '',
                            'water' => 0,
                            'frameRate' => 24,
                            'guidanceScale' => 12,
                            'motion' => 0,
                            'seed' => '',
                            'negativePrompt' => '',
                            'image' => '',
                            'video' => ''
                        ];
                    }
                    $channel = $videoSetting['pika']['channel'] ?? '';
                } elseif ($platform == 'luma') {
                    if (empty($options)) {
                        $options = [
                            'action' => 'generate',
                            'prompt' => '',
                            'aspectRatio' => '16:9',
                            'image' => ''
                        ];
                    }
                    $channel = $videoSetting['luma']['channel'] ?? 'duomi';
                } elseif ($platform == 'runway') {
                    if (empty($options)) {
                        $options = [
                            'action' => 'generate',
                            'prompt' => '',
                            'aspectRatio' => '16:9',
                            'style' => 'cinematic',
                            'model' => 'gen3',
                            'x' => '',
                            'y' => '',
                            'z' => '',
                            'r' => '',
                            'bg_x_pan' => '',
                            'bg_y_pan' => '',
                            'seconds' => '10'
                        ];
                    }
                    $channel = $videoSetting['luma']['channel'] ?? 'duomi';
                } elseif ($platform == 'pixverse') {
                    $options = input('options', '', 'trim');
                    $options = @json_decode($options, true);
                    if (empty($options)) {
                        $options = [
                            'action' => 'generate',
                            'prompt' => '',
                            'aspectRatio' => '16:9',
                            'style' => '',
                            'negativePrompt' => '',
                            'image' => ''
                        ];
                    }
                    $channel = $videoSetting['luma']['channel'] ?? 'duomi';
                } else {
                    $options = [];
                    $channel = '';
                }

                $action = $options['action'] ?? '';
                if (!in_array($action, ['generate', 'edit', 'extend'])) {
                    return errorJson('不支持的操作');
                }

                if (empty($options['prompt'])) {
                    return errorJson('请输入文字描述');
                }

                if ($action == 'edit' || $action == 'extend') {
                    if (empty($options['video'])) {
                        return errorJson('请上传视频文件');
                    }
                    unset($options['image']);
                }

                $prompt = $options['prompt'];
                $seed = $options['seed'] ?? '';
                $clearPrompt = wordFilter($prompt);
                $promptEn = translate(self::$site_id, $prompt);

                $video_id = Db::name('msg_video')
                    ->insertGetId([
                        'site_id' => self::$site_id,
                        'user_id' => self::$user['id'],
                        'platform' => $platform,
                        'channel' => $channel,
                        'action' => $action ?? 'generate',
                        'prompt' => $clearPrompt,
                        'prompt_input' => $prompt === $clearPrompt ? '' : $prompt,
                        'prompt_en' => $promptEn,
                        'state' => 0, // 0未开始 1已生成 2生成失败 3生成中
                        'options' => json_encode($options),
                        'user_ip' => get_client_ip(),
                        'create_time' => $now
                    ]);
            }
            $options['prompt'] = $promptEn;

            $apikey = $this->getApiKey($channel);
            if (empty($apikey)) {
                $this->setVideoFail($video_id, 'key已用尽，请等待平台处理');
                return successJson([
                    'video_id' => $video_id,
                    'action' => $action,
                    'prompt' => $clearPrompt,
                    'create_time' => date('Y-m-d H:i:s', $now)
                ]);
            }

            switch ($channel) {
                case 'pikapikapika':
                    $VideoSDK = $this->newPikaSDK($videoSetting['pika'], $apikey);
                    break;
                case 'duomi':
                    $VideoSDK = new \FoxVideo\duomi($apikey);
            }

            if ($platform == 'pika') {
                switch ($action) {
                    case 'generate':
                    case 'edit':
                        $result = $VideoSDK->pikaGenerate($options);
                        break;
                    case 'extend':
                        $result = $VideoSDK->pikaExtend($options);
                }
            } elseif ($platform == 'luma') {
                switch ($action) {
                    case 'generate':
                    case 'edit':
                        $result = $VideoSDK->lumaGenerate($options);
                        break;
                    case 'extend':
                        $result = $VideoSDK->lumaExtend($options);
                }
            } elseif ($platform == 'runway') {
                $result = $VideoSDK->runwayGenerate($options);
            } elseif ($platform == 'pixverse') {
                $result = $VideoSDK->pixGenerate($options);
            }
            if ($result['errno']) {
                $this->setVideoFail($video_id, $result['message']);
                return successJson([
                    'video_id' => $video_id,
                    'action' => $action,
                    'prompt' => $clearPrompt,
                    'create_time' => date('Y-m-d H:i:s', $now)
                ]);
            }
            $job_id = $result['data']['task_id'] ?? '';

            // 扣费
            if ($price) {
                changeUserBalance(self::$user['id'], -$price, '生成视频消费');
            }
            Db::name('msg_video')
                ->where('id', $video_id)
                ->update([
                    'job_id' => $job_id ?? ''
                ]);

            return successJson([
                'video_id' => $video_id,
                'action' => $action,
                'prompt' => $clearPrompt,
                'seed' => $seed,
                'create_time' => date('Y-m-d H:i:s', $now)
            ]);

        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }
    }

    /**
     * 供后端查询视频接口
     */
    public function feedduomi() {
        $model = input('model','luma','trim');
        $tesk_id = input('tesk_id', 0, 'trim');
        $apikey = $this->getApiKey('duomi');
        $duomiSDK = new \FoxVideo\duomi($apikey);
        $result = $duomiSDK->getJob($tesk_id, $model);
        return json_encode($result);
    }

    /**
     * 放大视频
     */
    public function upscale()
    {
        $now = time();
        $type = input('type', 'my', 'trim');
        $video_id = input('video_id', 0, 'intval');

        #1、
        $user = Db::name('user')
            ->where('id', self::$user['id'])
            ->find();
        if (!$user) {
            $_SESSION['user'] = null;
            return errorJson('请登录');
        }
        // 判断禁言
        if ($user['is_freeze']) {
            return errorJson('系统繁忙，请稍后再试');
        }
        // 判断余额
        $price = getFuncPrice(self::$site_id, $user, 'video');
        if ($price && $user['balance_point'] < $price) {
            return errorJson('余额不足，请充值！');
        }

        if ($type == 'my') {
            $video = Db::name('msg_video')
                ->where([
                    ['site_id', '=', self::$site_id],
                    ['user_id', '=', self::$user['id']],
                    ['id', '=', $video_id],
                    ['is_delete', '=', 0]
                ])
                ->find();
        } elseif ($type == 'public') {
            $video = Db::name('msg_video_public')
                ->where([
                    ['site_id', '=', self::$site_id],
                    ['id', '=', $video_id],
                    ['is_show', '=', 1]
                ])
                ->find();
        }
        if (empty($video)) {
            return errorJson('没有找到记录，请刷新页面后重试');
        }
        if ($video['state'] != 1) {
            return errorJson('请等待生成成功后再操作');
        }
        if (empty($video['video_url_ori'])) {
            return errorJson('此视频不支持放大');
        }
        $platform = $video['platform'];
        $channel = $video['channel'];

        if ($platform == 'pika') {
            if ($channel == 'pikapikapika') {
                $SDK = $this->newPikaSDK();
            }
        }
        if (empty($SDK)) {
            return errorJson('key已用尽，请等待平台处理');
        }

        $video_id = Db::name('msg_video')
            ->insertGetId([
                'site_id' => self::$site_id,
                'user_id' => self::$user['id'],
                'platform' => $platform,
                'channel' => $channel,
                'action' => 'upscale',
                'prompt' => $video['prompt'],
                'prompt_input' => $video['prompt_input'],
                'prompt_en' => $video['prompt_en'],
                'state' => 0, // 0未开始 1已生成 2生成失败 3生成中
                'options' => json_encode($video['options']),
                'user_ip' => get_client_ip(),
                'create_time' => $now
            ]);

        $result = $SDK->upscale($video['video_url_ori']);
        if (!empty($result['errno'])) {
            $this->setVideoFail($video_id, $result['message']);
        } else {
            if (!empty($result) && !empty($result['video'])) {
                Db::name('msg_video')
                    ->where([
                        ['site_id', '=', self::$site_id],
                        ['user_id', '=', self::$user['id']],
                        ['id', '=', $video_id]
                    ])
                    ->update([
                        'job_id' => $result['video']
                    ]);
            }
            // 扣费
            if ($price) {
                changeUserBalance(self::$user['id'], -$price, '放大视频消费');
            }
        }

        return successJson([
            'video_id' => $video_id,
            'action' => 'upscale',
            'prompt' => $video['prompt'],
            'seed' => $video['seed'],
            'create_time' => date('Y-m-d H:i:s', $now)
        ]);
    }

    /**
     * 供前端轮询视频结果
     */
    public function getVideoResult()
    {
        $video_id = input('video_id', 0, 'intval');
        $video = Db::name('msg_video')
            ->where([
                ['site_id', '=', self::$site_id],
                ['user_id', '=', self::$user['id']],
                ['id', '=', $video_id],
                ['is_delete', '=', 0]
            ])
            ->find();
        if (!$video) {
            // 未找到任务
            return successJson([
                'state' => -1
            ]);
        }
        if ($video['channel'] == 'pikapikapika' && $video['state'] != 2 && !empty($video['job_id'])) {
            $this->updateVideoResult($video);
            $video = Db::name('msg_video')
                ->where('id', $video_id)
                ->find();
        }

        if ($video['state'] == 0) {
            $now = time();
            if ($now - $video['create_time'] > 600) {
                $errMsg = text('视频生成失败');
                // 生成超时退费
                $price = getFuncPrice(self::$site_id, self::$user['id'], 'video');
                if ($price) {
                    changeUserBalance(self::$user['id'], $price, '视频失败退费');
                }
                $this->setVideoFail($video_id, $errMsg);
                return successJson([
                    'state' => 2,
                    'message' => $errMsg
                ]);
            }
            return successJson([
                'state' => 0
            ]);

        } elseif ($video['state'] == 1) {
            return successJson([
                'state' => 1,
                'video' => $video['video_url'],
                'poster' => $video['video_poster'],
                'seed' => $video['seed'],
            ]);
        } elseif ($video['state'] == 2) {
            return successJson([
                'state' => 2,
                'message' => $video['errmsg']
            ]);
        } else {
            // 未知状态
            return successJson([
                'state' => -1
            ]);
        }
    }

    /**
     * 更新生成视频结果
     */
    private function updateVideoResult($video)
    {
        if (is_numeric($video)) {
            $video = Db::name('msg_video')
                ->where([
                    ['site_id', '=', self::$site_id],
                    ['id', '=', $video],
                    ['is_delete', '=', 0]
                ])
                ->find();
        }
        if (!$video) {
            return false;
        }
        $videoSetting = getSystemSetting(self::$site_id, 'video');
        if ($video['platform'] == 'pika') {
            $pikaSetting = $videoSetting['pika'];
            $apikey = $this->getApiKey($pikaSetting['channel']);
            if (empty($apikey)) {
                return false;
            }
            if ($pikaSetting['channel'] == 'pikapikapika') {
                $SDK = $this->newPikaSDK($pikaSetting);
            }
            if ($video['action'] == 'upscale') {
                $result = $SDK->getUpscaleJob($video['job_id']);
            } else {
                $result = $SDK->getJob($video['job_id']);
            }
            if (!empty($result['errno'])) {
                $this->setVideoFail($video['id'], $result['message']);
                return false;
            }
            if (empty($result) || empty($result['videos'])) {
                return false;
            }
            $result = $result['videos'][0];
            if ($result['status'] == 'finished') {
                // 重复判断一下，防止接口时间过长重复下载视频文件
                $videoState = Db::name('msg_video')
                    ->where([
                        ['site_id', '=', self::$site_id],
                        ['id', '=', $video['id']]
                    ])
                    ->value('state');
                if ($videoState == 1) {
                    return false;
                }
                // end
                $videoUrl = $result['resultUrl'];
                $videoPoster = $result['videoPoster'];
                if ($pikaSetting['api_type'] == 1 && !empty($pikaSetting['file_host'])) {
                    $pikaFileHost = rtrim($pikaSetting['file_host'], '/');
                    $videoUrl = str_replace('https://cdn.pika.art', $pikaFileHost, $videoUrl);
                    $videoPoster = str_replace('https://cdn.pika.art', $pikaFileHost, $videoPoster);
                }
                $videoUrl = $this->saveToFile($videoUrl);
                $videoPoster = $this->saveToFile($videoPoster);
                Db::name('msg_video')
                    ->where([
                        ['site_id', '=', self::$site_id],
                        ['id', '=', $video['id']]
                    ])
                    ->update([
                        'video_url' => $videoUrl,
                        'video_poster' => $videoPoster,
                        'video_url_ori' => $result['resultUrl'],
                        'video_duration' => $result['duration'],
                        'seed' => $result['seed'],
                        'state' => 1,
                        'errmsg' => '',
                        'finish_time' => time()
                    ]);

            }
        }
        return true;
    }

    /**
     * new 一个pika对象，并设置接口地址
     */
    private function newPikaSDK($pikaSetting = null, $apikey = '')
    {
        if (!$pikaSetting) {
            $videoSetting = getSystemSetting(self::$site_id, 'video');
            $pikaSetting = $videoSetting['pika'] ?? [];
        }
        if (!$apikey) {
            $apikey = $this->getApiKey($pikaSetting['channel']);
        }
        $pikaSDK = new \FoxVideo\pikapikapika($apikey);
        if ($pikaSetting['api_type'] == 1 && !empty($pikaSetting['api_host'])) {
            $pikaSDK->setApiHost($pikaSetting['api_host']);
        }

        return $pikaSDK;
    }

    /**
     * 获取某个视频设置的参数
     */
    public function getVideoOptions()
    {
        $type = input('type', 'my', 'trim');
        $video_id = input('video_id', 0, 'intval');
        if ($type == 'my') {
            $info = Db::name('msg_video')
                ->where([
                    ['site_id', '=', self::$site_id],
                    ['user_id', '=', self::$user['id']],
                    ['id', '=', $video_id],
                    ['is_delete', '=', 0]
                ])
                ->find();
        } elseif ($type == 'public') {
            $info = Db::name('msg_video_public')
                ->where([
                    ['site_id', '=', self::$site_id],
                    ['id', '=', $video_id],
                    ['is_show', '=', 1]
                ])
                ->find();
        }

        if (empty($info)) {
            return errorJson('没有找到记录，请刷新页面后重试');
        }
        $options = [];
        if (!empty($info['options'])) {
            $options = json_decode($info['options'], true);
            $options['seed'] = $info['seed'];
        }
        if ($info['platform'] == 'luma') {
            $options['task_id'] = $info['job_id'];
        }
        return successJson([
            'video_url' => $info['video_url'],
            'video_url_ori' => $info['video_url_ori'],
            'options' => $options
        ]);
    }

    private function setVideoFail($video_id, $errMsg)
    {
        Db::name('msg_video')
            ->where('id', $video_id)
            ->update([
                'state' => 2,
                'errmsg' => $errMsg,
                'is_refund' => 1
            ]);
        return null;
    }

    /**
     * 保存文件保存到本地或者云存储
     */
    private function saveToFile($fileUrl)
    {
        $context = stream_context_create([
            'http' => ['method' => 'GET', 'timeout' => 30],
            'ssl' => ['verify_peer' => false, 'verify_peer_name' => false]
        ]);
        $content = file_get_contents($fileUrl, false, $context);

        if (empty($content)) {
            return '';
        }
        // 保存到本地
        $date = date('Ymd');
        $dir = './upload/video/' . $date . '/';
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        $pathInfo = pathinfo($fileUrl);
        $fileExt = $pathInfo['extension'];
        $filepath = $dir . self::$user['id'] . uniqid() . '.' . $fileExt;
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
    private function getApiKey($type)
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

    private function setKeyStop($type, $key, $errorMsg)
    {
        if ($errorMsg) {
            Db::name('keys')
                ->where([
                    ['site_id', '=', self::$site_id],
                    ['type', '=', $type],
                    ['key', '=', $key]
                ])
                ->update([
                    'state' => 0,
                    'stop_reason' => $errorMsg
                ]);
        }
    }

    /**
     * 获取视频模块的参数配置
     */
    public function getVideoSetting()
    {
        $videoSetting = getSystemSetting(self::$site_id, 'video');
        $pikaSetting = $videoSetting['pika'] ?? [];
        $lumaSetting = $videoSetting['luma'] ?? [];
        $runwaySetting = $videoSetting['runway'] ?? [];
        $stableSetting = $videoSetting['stable'] ?? [];
        $soraSetting = $videoSetting['sora'] ?? [];

        $setting = [
            'pika' => [
                'is_open' => $pikaSetting['is_open'] ?? 0,
                'channel' => $pikaSetting['channel'] ?? 'pikapikapika',
                'shop_open' => $pikaSetting['shop_open'] ?? 0
            ],
            'luma' => [
                'is_open' => $lumaSetting['is_open'] ?? 0,
                'channel' => $lumaSetting['channel'] ?? 'duomi',
                'shop_open' => $lumaSetting['shop_open'] ?? 0
            ],
            'runway' => [
                'is_open' => $runwaySetting['is_open'] ?? 0,
                'channel' => $runwaySetting['channel'] ?? 'duomi',
                'shop_open' => $runwaySetting['shop_open'] ?? 0
            ],
            'stable' => [
                'is_open' => $stableSetting['is_open'] ?? 0,
                'shop_open' => $stableSetting['shop_open'] ?? 0
            ],
            'sora' => [
                'is_open' => $soraSetting['is_open'] ?? 0,
                'shop_open' => $soraSetting['shop_open'] ?? 0
            ]
        ];
        if (!$setting['pika']['is_open'] && !$setting['luma']['is_open'] && !$setting['runway']['is_open'] && !$setting['stable']['is_open'] && !$setting['sora']['is_open']) {
            return errorJson('视频功能已停用');
        }

        return successJson($setting);
    }

    /**
     *上传图片/视频
     */
    public function uploadMedia()
    {
        try {
            $file = request()->file('file');
            $mine = $file->getMime();
            if (!in_array($mine, ['image/png', 'image/jpeg', 'video/mp4'])) {
                return errorJson('仅支持上传jpg/png/mp4格式文件');
            }
            $fileType = $mine == 'video/mp4' ? 'video' : 'image';
            $path = Filesystem::disk('public')->putFile($fileType, $file, 'uniqid');
            $ext = strrchr($path, '.');
            if (!in_array($ext, ['.jpg', '.jpeg', '.png', '.mp4'])) {
                @unlink('./upload/' . $path);
                return errorJson('仅支持上传jpg/png/mp4格式文件');
            }
            $url = saveToOss('./upload/' . $path);
            return successJson([
                'type' => $fileType,
                'path' => $url
            ]);
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }
    }
}
