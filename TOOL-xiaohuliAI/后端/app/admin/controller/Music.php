<?php

namespace app\admin\controller;

use think\facade\Db;

class Music extends Base
{
    public function getMsgList()
    {
        $page = input('page', 1, 'intval');
        $pagesize = input('pagesize', 10, 'intval');
        $date = input('date', []);
        $user_id = input('user_id', 0, 'intval');
        $keyword = input('keyword', '', 'trim');
        $platform = input('platform', 'suno', 'trim');
        $where = [
            ['site_id', '=', self::$site_id],
            ['platform', '=', $platform],
            ['is_delete', '=', 0]
        ];
        if ($user_id) {
            $where[] = ['user_id', '=', $user_id];
        }
        if ($keyword) {
            $where[] = ['prompt', 'like', '%' . $keyword . '%'];
        }
        if (!empty($date)) {
            $start_time = strtotime($date[0]);
            $end_time = strtotime($date[1]);
            $where[] = ['create_time', 'between', [$start_time, $end_time]];
        }

        $list = Db::name('msg_music')
            ->where($where)
            ->order('id desc')
            ->page($page, $pagesize)
            ->select()->each(function ($item) {
                $item['create_time'] = date('Y-m-d H:i:s', $item['create_time']);
                if (!empty($item['options'])) {
                    $item['options'] = @json_decode($item['options'], true);
                }
                if (!empty($item['result1'])) {
                    $item['result1'] = @json_decode($item['result1'], true);
                }
                if (!empty($item['result2'])) {
                    $item['result2'] = @json_decode($item['result2'], true);
                }

                return $item;
            });
        $count = Db::name('msg_music')
            ->where($where)
            ->count();

        return successJson([
            'list' => $list,
            'count' => $count
        ]);
    }

    public function delMsg()
    {
        $id = input('id', 0, 'intval');
        try {
            Db::name('msg_music')
                ->where([
                    ['site_id', '=', self::$site_id],
                    ['id', '=', $id]
                ])
                ->update([
                    'is_delete' => 1
                ]);
            return successJson('', '删除成功');
        } catch (\Exception $e) {
            return errorJson(text('删除失败') . ': ' . $e->getMessage());
        }
    }

    public function switchMusicPublic()
    {

        $id = input('id', 0, 'intval');
        $music = Db::name('msg_music')
            ->where([
                ['site_id', '=', self::$site_id],
                ['id', '=', $id],
                ['is_delete', '=', 0]
            ])
            ->find();
        if (!$music) {
            return errorJson('没有找到数据，请刷新页面重试');
        }

        $newPublic = $music['is_public'] ? 0 : 1;

        Db::startTrans();
        try {
            Db::name('msg_music')
                ->where('id', $music['id'])
                ->update([
                    'is_public' => $newPublic
                ]);
            $publicMusic = Db::name('msg_music_public')
                ->where([
                    ['site_id', '=', self::$site_id],
                    ['music_id', '=', $music['id']]
                ])
                ->find();
            if ($newPublic == 1) {

                if (!$publicMusic) {
                    Db::name('msg_music_public')
                        ->insert([
                            'site_id' => $music['site_id'],
                            'music_id' => $music['id'],
                            'user_id' => $music['user_id'],
                            'platform' => $music['platform'],
                            'channel' => $music['channel'],
                            'prompt' => $music['prompt'],
                            'options' => $music['options'],
                            'result1' => $music['result1'],
                            'result2' => $music['result2'],
                            'weight' => 100,
                            'is_show' => 1,
                            'user_ip' => $music['user_id'],
                            'finish_time' => $music['finish_time'],
                            'create_time' => time()
                        ]);
                }
            } else {
                if ($publicMusic) {
                    Db::name('msg_music_public')
                        ->where('id', $publicMusic['id'])
                        ->delete();
                }
            }

            Db::commit();
            return successJson('', '操作成功');
        } catch (\Exception $e) {
            Db::rollback();
            return errorJson('操作失败');
        }
    }

    public function getPublicList()
    {
        $page = input('page', 1, 'intval');
        $pagesize = input('pagesize', 20, 'intval');
        $keyword = input('keyword', '', 'trim');
        $platform = input('platform', 'pika', 'trim');

        $where = [
            ['site_id', '=', self::$site_id],
            ['platform', '=', $platform]
        ];
        if ($keyword) {
            $where[] = ['prompt', 'like', '%' . $keyword . '%'];
        }
        $list = Db::name('msg_music_public')
            ->where($where)
            ->order('weight desc, id desc')
            ->page($page, $pagesize)
            ->select()->toArray();
        $musicList = [];
        foreach ($list as $v) {
            $musicList[] = [
                'id' => $v['id'],
                'platform' => $v['platform'],
                'prompt' => $v['prompt'],
                'weight' => $v['weight'],
                'is_show' => $v['is_show'],
                'create_time' => date('Y-m-d H:i:s', $v['create_time'])
            ];
        }
        $count = Db::name('msg_music_public')
            ->where($where)
            ->count();

        return successJson([
            'list' => $musicList,
            'count' => $count
        ]);
    }

    /**
     * 设置广场视频的排序
     */
    public function setPublicMusicWeight()
    {
        $id = input('id', 0, 'intval');
        $weight = input('weight', 100, 'intval');
        $rs = Db::name('msg_music_public')
            ->where([
                ['site_id', '=', self::$site_id],
                ['id', '=', $id]
            ])
            ->update([
                'weight' => $weight
            ]);
        if ($rs !== false) {
            return successJson('', '修改成功');
        } else {
            return errorJson('保存失败');
        }
    }

    /**
     * 设置广场的视频是否显示
     */
    public function setPublicMusicState()
    {
        $id = input('id', 0, 'intval');
        $state = input('state', 0, 'intval');

        $rs = Db::name('msg_music_public')
            ->where([
                ['site_id', '=', self::$site_id],
                ['id', '=', $id]
            ])
            ->update([
                'is_show' => $state
            ]);
        if ($rs !== false) {
            return successJson('', '设置成功');
        } else {
            return errorJson('设置失败');
        }
    }

    /**
     * 移出视频广场
     */
    public function delPublicMusic()
    {
        $id = input('id', 0, 'intval');
        $publicMusic = Db::name('msg_music_public')
            ->where([
                ['site_id', '=', self::$site_id],
                ['id', '=', $id]
            ])
            ->find();
        if (!$publicMusic) {
            return errorJson('没找到数据，请刷新重试');
        }

        Db::startTrans();
        try {
            Db::name('msg_music_public')
                ->where('id', $publicMusic['id'])
                ->delete();
            if ($publicMusic['music_id']) {
                Db::name('msg_music')
                    ->where([
                        ['site_id', '=', self::$site_id],
                        ['id', '=', $publicMusic['music_id']]
                    ])
                    ->update([
                        'is_public' => 0
                    ]);
            }
            Db::commit();
            return successJson('', '操作成功');
        } catch (\Exception $e) {
            Db::rollback();
            return errorJson('操作失败：' . $e->getMessage());
        }
    }

}
