<?php

namespace app\web\controller;

use think\facade\Db;

class Music extends Base
{
    /**
     * 获取消息历史记录
     */
    public function getHistoryMsg()
    {
        $platform = input('platform', 'suno', 'trim');

        $where = [
            ['site_id', '=', self::$site_id],
            ['user_id', '=', self::$user['id']],
            ['is_delete', '=', 0],
            ['platform', '=', $platform]
        ];
        $list = Db::name('msg_music')
            ->where($where)
            ->field('id,platform,channel,action,options,result1,result2,state,errmsg,create_time')
            ->order('id desc')
            ->limit(10)
            ->select()->toArray();
        $msgList = [];
        $list = array_reverse($list);
        foreach ($list as $v) {
            $msgList[] = [
                'music_id' => $v['id'],
                'platform' => $v['platform'],
                'action' => $v['action'],
                'state' => $v['state'],
                'errmsg' => $v['errmsg'],
                'options' => json_decode($v['options'], true),
                'result1' => !empty($v['result1']) ? json_decode($v['result1'], true) : '',
                'result2' => !empty($v['result2']) ? json_decode($v['result2'], true) : '',
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
        $platform = input('platform', 'suno', 'trim');
        if (!in_array($platform, ['suno'])) {
            return errorJson('参数错误：未知的通道');
        }

        $where = [
            ['site_id', '=', self::$site_id],
            ['is_show', '=', 1],
            ['platform', '=', $platform]
        ];
        $list = Db::name('msg_music_public')
            ->where($where)
            ->field('id,platform,channel,action,description,song_url,image_url,video_url,image_large_url,create_time')
            ->order('weight desc, id desc')
            ->page($page, $pagesize)
            ->select()->toArray();
        $count = Db::name('msg_music_public')
            ->where($where)
            ->count();
        $musicList = [];
        foreach ($list as $v) {
            $musicList[] = [
                'music_id' => $v['id'],
                'platform' => $v['platform'],
                'action' => $v['action'],
                'description' => $v['description'],
                'song_url' => $v['song_url'],
                'image_url' => $v['image_url'],
                'video_url' => $v['video_url'],
                'image_large_url' => $v['image_large_url']
            ];
        }

        return successJson([
            'list' => $musicList,
            'count' => $count
        ]);
    }

    /**
     * 提交生成音乐任务
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
            $price = getFuncPrice(self::$site_id, $user, 'music');
            if ($price && $user['balance_point'] < $price) {
                return errorJson('余额不足，请充值！');
            }
            // 判断并行任务
            $now = time();
            $taskNum = Db::name('msg_music')
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

            $musicSetting = getSystemSetting(self::$site_id, 'music');

            #2、
            $music_id = input('music_id', 0, 'intval');
            $action = 'generate';
            if ($music_id) {
                $info = Db::name('msg_music')
                    ->where([
                        ['site_id', '=', self::$site_id],
                        ['id', '=', $music_id],
                        ['is_delete', '=', 0]
                    ])
                    ->find();
                if (!$info) {
                    return errorJson('没有找到记录，请刷新页面后重试');
                }

                $platform = $info['platform'];
                $channel = $info['channel'];
                $options = @json_decode($info['options'], true);
                $task_code = $info['task_code'];
                // 状态重置
                Db::name('msg_music')
                    ->where('id', $info['id'])
                    ->update([
                        'state' => 0,
                        'errmsg' => '',
                        'result1' => '',
                        'result2' => '',
                        'is_refund' => 0,
                        'finish_time' => 0,
                        'create_time' => $now
                    ]);
            } else {
                $platform = input('platform', 'suno', 'trim');
                if (!in_array($platform, ['suno'])) {
                    return errorJson('参数错误：未知的通道');
                }
                if ($platform == 'suno') {
                    $options = input('options', '', 'trim');
                    $options = @json_decode($options, true);
                    $channel = $musicSetting['suno']['channel'] ?? 'duomi';
                }

                $prompt = $options['prompt'];
                $clearPrompt = wordFilter($prompt);
                $task_code = uniqid() . self::$user['id'];

                $music_id = Db::name('msg_music')
                    ->insertGetId([
                        'site_id' => self::$site_id,
                        'user_id' => self::$user['id'],
                        'task_code' => $task_code,
                        'platform' => $platform,
                        'channel' => $channel,
                        'action' => $action ?? 'generate',
                        'prompt' => $prompt,
                        'prompt_clear' => $clearPrompt,
                        'state' => 0, // 0未开始 1已生成 2生成失败 3生成中
                        'options' => json_encode($options),
                        'user_ip' => get_client_ip(),
                        'create_time' => $now
                    ]);
            }
            $apikey = $this->getApiKey($channel);
            if (empty($apikey)) {
                $this->setMusicFail($music_id, 'key已用尽，请等待平台处理');
            } else {
                if ($platform == 'suno') {
                    if ($channel == 'duomi') {
                        $options['callback_url'] = 'https://' . $_SERVER['HTTP_HOST'] . '/api.php/notify/duomi_suno/task/' . $task_code;
                        $duomiSDK = new \FoxMusic\duomi($apikey);
                        $result = $duomiSDK->generate($options);
                        if ($result['errno']) {
                            $this->setMusicFail($music_id, $result['message']);
                        } else {
                            $task_id = $result['data'][0]['task_id'] ?? '';
                        }
                    }
                }
                // 扣费
                if ($price) {
                    changeUserBalance(self::$user['id'], -$price, '音乐消费');
                }

                if (!empty($task_id)) {
                    Db::name('msg_music')
                        ->where('id', $music_id)
                        ->update([
                            'task_id' => $task_id ?? ''
                        ]);
                }
            }

            return successJson([
                'music_id' => $music_id,
                'action' => $action,
                'options' => $options,
                'create_time' => date('Y-m-d H:i:s', $now)
            ]);
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }
    }

    /**
     * 供前端轮询音乐结果
     */
    public function getMusicResult()
    {
        $music_id = input('music_id', 0, 'intval');
        $music = Db::name('msg_music')
            ->where([
                ['site_id', '=', self::$site_id],
                ['user_id', '=', self::$user['id']],
                ['id', '=', $music_id],
                ['is_delete', '=', 0]
            ])
            ->find();
        if (!$music) {
            // 未找到任务
            return successJson([
                'state' => -1
            ]);
        }

        if ($music['state'] == 0) {
            $now = time();
            if ($now - $music['create_time'] > 600) {
                $errMsg = text('音乐生成失败');
                // 生成超时退费
                $price = getFuncPrice(self::$site_id, self::$user['id'], 'music');
                if ($price) {
                    changeUserBalance(self::$user['id'], $price, '音乐失败退费');
                }
                $this->setMusicFail($music_id, $errMsg);
                return successJson([
                    'state' => 2,
                    'message' => $errMsg
                ]);
            }

            $result1 = '';
            $result2 = '';
            if (!empty($music['result1'])) {
                $result1 = json_decode($music['result1'], true);
            }
            if (!empty($music['result2'])) {
                $result2 = json_decode($music['result2'], true);
            }
            return successJson([
                'state' => 0,
                'result1' => $result1,
                'result2' => $result2
            ]);
        } elseif ($music['state'] == 1) {
            $result1 = '';
            $result2 = '';
            if (!empty($music['result1'])) {
                $result1 = json_decode($music['result1'], true);
            }
            if (!empty($music['result2'])) {
                $result2 = json_decode($music['result2'], true);
            }
            return successJson([
                'state' => 1,
                'result1' => $result1,
                'result2' => $result2
            ]);
        } elseif ($music['state'] == 2) {
            return successJson([
                'state' => 2,
                'message' => $music['errmsg']
            ]);
        } else {
            // 未知状态
            return successJson([
                'state' => -1
            ]);
        }
    }

    private function setMusicFail($music, $errMsg)
    {
        Db::name('msg_music')
            ->where('id', $music)
            ->update([
                'state' => 2,
                'errmsg' => $errMsg,
                'is_refund' => 1
            ]);
        return null;
    }

    /**
     * 生成歌词
     */
    public function getLyric()
    {
        $prompt = input('prompt', '', 'trim');
        if (empty($prompt)) {
            return errorJson('提示词不能为空');
        }
        $setting = getSystemSetting(self::$site_id, 'music');
        $channel = $setting['suno']['channel'];
        if (!in_array($channel, ['duomi'])) {
            return errorJson('不支持的操作');
        }
        $apikey = $this->getApiKey($channel);
        if (empty($apikey)) {
            return errorJson('key已用尽，请等待平台处理');
        }
        $duomiSDK = new \FoxMusic\duomi($apikey);
        $lyric = $duomiSDK->generateLyrics($prompt);
        if ($lyric['errno']) {
            return errorJson($lyric['message']);
        }
        return successJson($lyric);
    }

    /**
     * 歌曲主动查询（前端请勿使用此接口）
     */
    public function feedMusic()
    {
        $task_id = input('task_id', '', 'trim');
        if (empty($task_id)) {
            return errorJson('任务不能为空');
        }
        $setting = getSystemSetting(self::$site_id, 'music');
        $channel = $setting['suno']['channel'];
        if (!in_array($channel, ['duomi'])) {
            return errorJson('不支持的操作');
        }
        $apikey = $this->getApiKey($channel);
        if (empty($apikey)) {
            return errorJson('key已用尽，请等待平台处理');
        }
        $duomiSDK = new \FoxMusic\duomi($apikey);
        $lyric = $duomiSDK->feed($task_id);
        if ($lyric['errno']) {
            return errorJson($lyric['message']);
        }
        return successJson($lyric);
    }


    /**
     * 获取某个音乐设置的参数
     */
    public function getMusicDetail()
    {
        $type = input('type', 'my', 'trim');
        $music_id = input('music_id', 0, 'intval');
        if ($type == 'my') {
            $info = Db::name('msg_music')
                ->where([
                    ['site_id', '=', self::$site_id],
                    ['user_id', '=', self::$user['id']],
                    ['id', '=', $music_id],
                    ['is_delete', '=', 0]
                ])
                ->field('id,platform,channel,action,options,result1,result2,state,errmsg,create_time')
                ->find();
        } elseif ($type == 'public') {
            $info = Db::name('msg_music_public')
                ->where([
                    ['site_id', '=', self::$site_id],
                    ['id', '=', $music_id],
                    ['is_show', '=', 1]
                ])
                ->find();
        }

        if (empty($info)) {
            return errorJson('没有找到记录，请刷新页面后重试');
        }

        $info['result1'] = !empty($info['result1']) ? json_decode($info['result1'], true) : '';
        $info['result2'] = !empty($info['result2']) ? json_decode($info['result2'], true) : '';
        $info['options'] = json_decode($info['options'], true);
        $info['create_time'] = date('Y-m-d H:i:s', $info['create_time']);

        return successJson($info);
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
     * 获取音乐模块的参数配置
     */
    public function getMusicSetting()
    {
        $musicSetting = getSystemSetting(self::$site_id, 'music');
        $sunoSetting = $musicSetting['suno'] ?? [];

        $setting = [
            'suno' => [
                'is_open' => $sunoSetting['is_open'] ?? 0,
                'channel' => $sunoSetting['channel'] ?? 'duomi',
                'shop_open' => 0
            ]
        ];
        if (!$setting['suno']['is_open']) {
            return errorJson('音乐功能已停用');
        }

        return successJson($setting);
    }

}
