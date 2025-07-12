<?php

namespace app\admin\controller;

use think\facade\Db;

class Mind extends Base
{
    public function getMindList()
    {
        $tool = input('tool', 'mind', 'intval');
        $page = input('page', 1, 'intval');
        $pagesize = input('pagesize', 10, 'intval');
        $date = input('date', []);
        $user_id = input('user_id', 0, 'intval');
        $keyword = input('keyword', '', 'trim');

        $where = [
            ['site_id', '=', self::$site_id],
            ['tool', '=', $tool],
            ['is_delete', '=', 0]
        ];
        if ($user_id) {
            $where[] = ['user_id', '=', $user_id];
        }
        if ($keyword) {
            $where[] = ['message', 'like', '%' . $keyword . '%'];
        }
        if (!empty($date)) {
            $start_time = strtotime($date[0]);
            $end_time = strtotime($date[1]);
            $where[] = ['create_time', 'between', [$start_time, $end_time]];
        }

        $aiNameList = getAINameList(self::$site_id);
        $list = Db::name('msg_tool')
            ->where($where)
            ->order('id desc')
            ->page($page, $pagesize)
            ->select()->each(function ($item) use ($aiNameList) {
                $item['create_time'] = date('Y-m-d H:i:s', $item['create_time']);
                if (isset($aiNameList[$item['channel']])) {
                    $item['channel'] = $aiNameList[$item['channel']];
                }
                return $item;
            });

        $count = Db::name('msg_tool')
            ->where($where)
            ->count();

        return successJson([
            'list' => $list,
            'count' => $count
        ]);
    }

    /**
     * 统计
     */
    public function getMindTongji()
    {
        $tool = input('tool', 'mind', 'intval');
        $date = input('date', []);
        $user_id = input('user_id', 0, 'intval');
        $keyword = input('keyword', '', 'trim');

        $where = [
            ['site_id', '=', self::$site_id],
            ['tool', '=', $tool],
            ['is_delete', '=', 0]
        ];
        if ($user_id) {
            $where[] = ['user_id', '=', $user_id];
        }
        if ($keyword) {
            $where[] = ['message', 'like', '%' . $keyword . '%'];
        }
        if (!empty($date)) {
            $start_time = strtotime($date[0]);
            $end_time = strtotime($date[1]);
            $where[] = ['create_time', 'between', [$start_time, $end_time]];
        }

            $data = Db::name('msg_tool')
                ->where($where)
                ->field('count(id) as msg_count,sum(total_tokens) as msg_tokens')
                ->find();


        return successJson([
            'msgCount' => intval($data['msg_count']),
            'msgTokens' => intval($data['msg_tokens'])
        ]);
    }

    public function delMind()
    {
        $id = input('id', 0, 'intval');

        try {
            Db::name('msg_tool')
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
}
