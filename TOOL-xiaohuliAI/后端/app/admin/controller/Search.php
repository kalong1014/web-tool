<?php

namespace app\admin\controller;

use think\facade\Db;

class Search extends Base
{
    public function getMsgList()
    {
        $page = input('page', 1, 'intval');
        $pagesize = input('pagesize', 10, 'intval');
        $date = input('date', []);
        $user_id = input('user_id', 0, 'intval');
        $keyword = input('keyword', '', 'trim');

        $where = [
            ['site_id', '=', self::$site_id],
            ['is_delete', '=', 0]
        ];
        if ($user_id) {
            $where[] = ['user_id', '=', $user_id];
        }
        if ($keyword) {
            $where[] = ['ask', 'like', '%' . $keyword . '%'];
        }
        if (!empty($date)) {
            $start_time = strtotime($date[0]);
            $end_time = strtotime($date[1]);
            $where[] = ['create_time', 'between', [$start_time, $end_time]];
        }

        $list = Db::name('msg_search')
            ->where($where)
            ->field('id,user_id,model,type,ask,result_id,user_ip,create_time')
            ->order('id desc')
            ->page($page, $pagesize)
            ->select()->each(function ($item) {
                $item['result_url'] = $this->getResultUrl($item['result_id']);
                $item['create_time'] = date('Y-m-d H:i:s', $item['create_time']);
                return $item;
            });

        $count = Db::name('msg_search')
            ->where($where)
            ->count();

        return successJson([
            'list' => $list,
            'count' => $count
        ]);
    }

    private function getResultUrl($resultId)
    {
        $site_id = self::$admin['id'];
        $sitecode = self::$admin['sitecode'];

        $url = 'https://' . $_SERVER['HTTP_HOST'] . '/web/#/';
        if ($site_id != 1) {
            $url .= '?' . $sitecode . '#/';
        }
        $url = $url . 'search?result=' . $resultId;

        return $url;
    }

    public function delMsg()
    {
        $id = input('id', 0, 'intval');
        try {
            Db::name('msg_search')
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
