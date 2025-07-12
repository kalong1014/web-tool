<?php

namespace app\admin\controller;

use think\facade\Db;

class Video extends Base
{
    public function getList()
    {
        $page = input('page', 1, 'intval');
        $pagesize = input('pagesize', 10, 'intval');
        $where = [
            'site_id' => self::$site_id,
        ];
        try {
            $list = Db::name('video')
                ->where($where)
                ->field('id,title,price,market_price,num,weight,sales,is_default,status,create_time')
                ->order('weight desc, id asc')
                ->page($page, $pagesize)
                ->select()->each(function($item) {
                    $item['price'] = $item['price'] / 100;
                    $item['market_price'] = $item['market_price'] / 100;
                    $item['create_time'] = date('Y-m-d H:i:s', $item['create_time']);
                    return $item;
                });
            $count = Db::name('video')
                ->where($where)
                ->count();
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson([
            'list' => $list,
            'count' => $count
        ]);
    }

    /**
     * @return string
     * 取单个套餐
     */
    public function getInfo()
    {
        $id = input('id', 0, 'intval');

        try {
            $info = Db::name('video')
                ->where([
                    ['site_id', '=', self::$site_id],
                    ['id', '=', $id]
                ])
                ->find();
            if (!$info) {
                return errorJson('没有找到数据，请刷新页面重试');
            }
            $info['price'] = $info['price'] / 100;
            $info['market_price'] = $info['market_price'] / 100;
            return successJson($info);
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }
    }

    /**
     * @return string
     * 更新或新增
     */
    public function saveInfo()
    {
        $id = input('id', 0, 'intval');
        $title = input('title', '', 'trim');
        $weight = input('weight', 100, 'intval');
        $price = input('price', 0, 'floatval');
        $market_price = input('market_price', 0, 'floatval');
        $num = input('num', 0, 'intval');
        $hint = input('hint', '', 'trim');
        $desc = input('desc', '', 'trim');

        try {
            $data = [
                'title' => $title,
                'price' => $price * 100,
                'market_price' => $market_price * 100,
                'weight' => $weight,
                'num' => $num,
                'hint' => $hint,
                'desc' => $desc
            ];
            if ($id) {
                Db::name('video')
                    ->where([
                        ['site_id', '=', self::$site_id],
                        ['id', '=', $id]
                    ])
                    ->update($data);
            } else {
				$data['site_id'] = self::$site_id;
                $data['create_time'] = time();
                Db::name('video')
                    ->insert($data);
            }
            return successJson('', '保存成功');
        } catch (\Exception $e) {
            return errorJson(text('保存失败') . ': ' . $e->getMessage());
        }
    }

    /**
     * @return string
     * 删除
     */
    public function del()
    {
        $id = input('id', 0, 'intval');
        try {
            Db::name('video')
                ->where([
                    ['site_id', '=', self::$site_id],
                    ['id', '=', $id]
                ])
                ->delete();
            return successJson('', '删除成功');
        } catch (\Exception $e) {
            return errorJson(text('删除失败') . ': ' . $e->getMessage());
        }
    }

    /**
     * @return string
     * 设置上架状态
     */
    public function setStatus()
    {
        $id = input('id', 0, 'intval');
        $status = input('status', 0, 'intval');
        try {
            Db::name('video')
                ->where([
                    ['site_id', '=', self::$site_id],
                    ['id', '=', $id]
                ])
                ->update([
                    'status' => $status
                ]);
            return successJson('', '设置成功');
        } catch (\Exception $e) {
            return errorJson(text('设置失败') . ': ' . $e->getMessage());
        }
    }

    /**
     * @return string
     * 设置默认
     */
    public function setDefault()
    {
        $id = input('id', 0, 'intval');
        $is_default = input('is_default', 0, 'intval');
        try {
            if ($is_default) {
                Db::name('video')
                    ->where([
                        ['site_id', '=', self::$site_id],
                        ['is_default', '=', 1]
                    ])
                    ->update([
                        'is_default' => 0
                    ]);
            }
            Db::name('video')
                ->where([
                    ['site_id', '=', self::$site_id],
                    ['id', '=', $id]
                ])
                ->update([
                    'is_default' => $is_default ? 1 : 0
                ]);
            return successJson('', '设置成功');
        } catch (\Exception $e) {
            return errorJson(text('设置失败') . ': ' . $e->getMessage());
        }
    }

    public function getMsgList()
    {
        $page = input('page', 1, 'intval');
        $pagesize = input('pagesize', 10, 'intval');
        $date = input('date', []);
        $user_id = input('user_id', 0, 'intval');
        $keyword = input('keyword', '', 'trim');
        $platform = input('platform', 'pika', 'trim');
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

        $list = Db::name('msg_video')
            ->where($where)
            ->order('id desc')
            ->page($page, $pagesize)
            ->select()->each(function ($item) {
                $item['create_time'] = date('Y-m-d H:i:s', $item['create_time']);
                if (!$item['prompt_input'] || $item['prompt'] == $item['prompt_input']) {
                    unset($item['prompt_input']);
                }
                if (!empty($item['options'])) {
                    $item['options'] = @json_decode($item['options'], true);
                }

                return $item;
            });
        $count = Db::name('msg_video')
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
            Db::name('msg_video')
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

    public function switchVideoPublic()
    {

        $id = input('id', 0, 'intval');
        $video = Db::name('msg_video')
            ->where([
                ['site_id', '=', self::$site_id],
                ['id', '=', $id],
                ['is_delete', '=', 0]
            ])
            ->find();
        if (!$video) {
            return errorJson('没有找到数据，请刷新页面重试');
        }
        if ($video['action'] != 'generate' && $video['action'] != 'edit') {
            return errorJson('此类型视频不支持公开');
        }

        $newPublic = $video['is_public'] ? 0 : 1;

        Db::startTrans();
        try {
            Db::name('msg_video')
                ->where('id', $video['id'])
                ->update([
                    'is_public' => $newPublic
                ]);
            $publicVideo = Db::name('msg_video_public')
                ->where([
                    ['site_id', '=', self::$site_id],
                    ['video_id', '=', $video['id']]
                ])
                ->find();
            if ($newPublic == 1) {

                if (!$publicVideo) {
                    Db::name('msg_video_public')
                        ->insert([
                            'site_id' => $video['site_id'],
                            'video_id' => $video['id'],
                            'user_id' => $video['user_id'],
                            'platform' => $video['platform'],
                            'channel' => $video['channel'],
                            'prompt' => $video['prompt'],
                            'prompt_en' => $video['prompt_en'],
                            'options' => $video['options'],
                            'job_id' => $video['job_id'],
                            'video_url' => $video['video_url'],
                            'video_url_ori' => $video['video_url_ori'],
                            'video_duration' => $video['video_duration'],
                            'video_poster' => $video['video_poster'],
                            'seed' => $video['seed'],
                            'weight' => 100,
                            'is_show' => 1,
                            'user_ip' => $video['user_id'],
                            'finish_time' => $video['finish_time'],
                            'create_time' => time()
                        ]);
                }
            } else {
                if ($publicVideo) {
                    Db::name('msg_video_public')
                        ->where('id', $publicVideo['id'])
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
        $list = Db::name('msg_video_public')
            ->where($where)
            ->order('weight desc, id desc')
            ->page($page, $pagesize)
            ->select()->toArray();
        $videoList = [];
        foreach ($list as $v) {
            $videoList[] = [
                'id' => $v['id'],
                'platform' => $v['platform'],
                'prompt' => $v['prompt'],
                'video' => $v['video_url'],
                'poster' => $v['video_poster'],
                'duration' => $v['video_duration'],
                'seed' => $v['seed'],
                'weight' => $v['weight'],
                'is_show' => $v['is_show'],
                'create_time' => date('Y-m-d H:i:s', $v['create_time'])
            ];
        }
        $count = Db::name('msg_video_public')
            ->where($where)
            ->count();

        return successJson([
            'list' => $videoList,
            'count' => $count
        ]);
    }

    /**
     * 设置广场视频的排序
     */
    public function setPublicVideoWeight()
    {
        $id = input('id', 0, 'intval');
        $weight = input('weight', 100, 'intval');
        $rs = Db::name('msg_video_public')
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
    public function setPublicVideoState()
    {
        $id = input('id', 0, 'intval');
        $state = input('state', 0, 'intval');

        $rs = Db::name('msg_video_public')
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
    public function delPublicVideo()
    {
        $id = input('id', 0, 'intval');
        $publicVideo = Db::name('msg_video_public')
            ->where([
                ['site_id', '=', self::$site_id],
                ['id', '=', $id]
            ])
            ->find();
        if (!$publicVideo) {
            return errorJson('没找到数据，请刷新重试');
        }

        Db::startTrans();
        try {
            Db::name('msg_video_public')
                ->where('id', $publicVideo['id'])
                ->delete();
            if ($publicVideo['video_id']) {
                Db::name('msg_video')
                    ->where([
                        ['site_id', '=', self::$site_id],
                        ['id', '=', $publicVideo['video_id']]
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
