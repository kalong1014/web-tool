<?php

namespace app\admin\controller;

use think\facade\Db;

class Doc extends Base
{
    public function getDocList()
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
            $where[] = ['title', 'like', '%' . $keyword . '%'];
        }
        if (!empty($date)) {
            $start_time = strtotime($date[0]);
            $end_time = strtotime($date[1]);
            $where[] = ['create_time', 'between', [$start_time, $end_time]];
        }

        $list = Db::name('doc')
            ->where($where)
            ->field('id,user_id,title,file_size,ext,ori_url,pdf_url,user_ip,create_time')
            ->order('id desc')
            ->page($page, $pagesize)
            ->select()->each(function ($item) {
                $item['file_size'] = $this->formatSize($item['file_size']);
                $item['create_time'] = date('Y-m-d H:i:s', $item['create_time']);
                return $item;
            });

        $count = Db::name('doc')
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
    public function getDocTongji()
    {
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
            $where[] = ['title', 'like', '%' . $keyword . '%'];
        }
        if (!empty($date)) {
            $start_time = strtotime($date[0]);
            $end_time = strtotime($date[1]);
            $where[] = ['create_time', 'between', [$start_time, $end_time]];
        }

        $data = Db::name('doc')
            ->where($where)
            ->field('count(id) as file_count,sum(file_size) as file_size')
            ->find();

        return successJson([
            'fileCount' => intval($data['file_count']),
            'fileSize' => $this->formatSize($data['file_size'])
        ]);
    }

    public function delDoc()
    {
        $id = input('id', 0, 'intval');
        try {
            Db::name('doc')
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

    public function checkEnv()
    {
        $shell_exec = function_exists('shell_exec');
        $libreoffice = false;
        if ($shell_exec) {
            try {
                $result = shell_exec('soffice --version');
                if (strpos($result, 'LibreOffice') !== false) {
                    $libreoffice = true;
                }
            } catch (\Exception $e) {

            }
        }
        return successJson([
            'shell_exec' => $shell_exec,
            'libreoffice' => $libreoffice
        ]);
    }

    private function formatSize($size)
    {
        if ($size > 1024 * 1024 * 1024 * 1024) {
            $size = round($size / 1024 / 1024 / 1024 / 1024, 2) . ' TB';
        } elseif ($size > 1024 * 1024 * 1024) {
            $size = round($size / 1024 / 1024 / 1024, 2) . ' GB';
        } elseif ($size > 1024 * 1024) {
            $size = round($size / 1024 / 1024, 2) . ' MB';
        } elseif ($size > 1024) {
            $size = round($size / 1024, 2) . ' KB';
        } else {
            $size = $size . ' B';
        }
        return $size;
    }
}
