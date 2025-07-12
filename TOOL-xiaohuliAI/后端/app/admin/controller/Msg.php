<?php

namespace app\admin\controller;

use think\facade\Config;
use think\facade\Db;

class Msg extends Base
{
    public function getMsgList()
    {
        $show_gpt = Config::get('app.show_gpt');
        $type = input('type', 'chat', 'trim');
        $page = input('page', 1, 'intval');
        $pagesize = input('pagesize', 10, 'intval');
        $date = input('date', []);
        $user_id = input('user_id', 0, 'intval');
        $keyword = input('keyword', '', 'trim');
        $is_history = input('is_history', 0, 'intval');

        $where = [
            ['site_id', '=', self::$site_id],
            ['is_delete', '=', 0]
        ];
        if (!$show_gpt) {
            if ($type == 'pk') {
                $where[] = ['channel_a', 'not in', ['openai3', 'openai4', 'gemini', 'claude2']];
                $where[] = ['channel_b', 'not in', ['openai3', 'openai4', 'gemini', 'claude2']];
            } else {
                $where[] = ['channel', 'not in', ['openai3', 'openai4', 'gemini', 'claude2']];
            }
        }
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
        if ($type == 'chat') {
            $dbName = 'msg_web';
        } elseif ($type == 'write') {
            $dbName = 'msg_write';
        } elseif ($type == 'cosplay') {
            $dbName = 'msg_cosplay';
        } elseif ($type == 'pk') {
            $dbName = 'msg_pk';
        } else {
            return errorJson('参数错误');
        }
        if ($is_history) {
            $dbName .= '_history';
        }

        $aiNameList = getAINameList(self::$site_id);
        $list = Db::name($dbName)
            ->where($where)
            ->order('id desc')
            ->page($page, $pagesize)
            ->select()->each(function ($item) use ($type, $aiNameList){
                $item['create_time'] = date('Y-m-d H:i:s', $item['create_time']);
                $item['message'] = formatMsg($item['message']);
                $item['message_input'] = formatMsg($item['message_input']);
                if ($item['message'] == $item['message_input']) {
                    unset($item['message_input']);
                }
                if ($type == 'pk') {
                    if (isset($aiNameList[$item['channel_a']])) {
                        $item['channel_a'] = $aiNameList[$item['channel_a']];
                    }
                    $item['response_a'] = formatMsg($item['response_a']);
                    if (isset($aiNameList[$item['channel_b']])) {
                        $item['channel_b'] = $aiNameList[$item['channel_b']];
                    }
                    $item['response_b'] = formatMsg($item['response_b']);
                } else {
                    $item['response'] = formatMsg($item['response']);

                    if ($type == 'write') {
                        $item['topic_title'] = Db::name('write_topic')
                            ->where('id', $item['topic_id'])
                            ->value('title');
                        $item['prompt_title'] = Db::name('write_prompts')
                            ->where('id', $item['prompt_id'])
                            ->value('title');
                    } elseif ($type == 'cosplay') {
                        $item['topic_title'] = Db::name('cosplay_type')
                            ->where('id', $item['type_id'])
                            ->value('title');
                        $item['prompt_title'] = Db::name('cosplay_role')
                            ->where('id', $item['role_id'])
                            ->value('title');
                    }

                    switch ($item['channel']) {
                        case 'openai':
                            $item['channel'] = 'openai3';
                            break;
                        case 'baidu':
                            $item['channel'] = 'wenxin';
                            break;
                    }
                    if ($item['channel']) {
                        if (isset($aiNameList[$item['channel']])) {
                            $item['channel'] = $aiNameList[$item['channel']];
                        }
                    } else {
                        $item['channel'] = '查看回复';
                    }
                }


                return $item;
            });
        $count = Db::name($dbName)
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
    public function getMsgTongji()
    {
        $show_gpt = Config::get('app.show_gpt');
        $date = input('date', []);
        $user_id = input('user_id', 0, 'intval');
        $keyword = input('keyword', '', 'trim');
        $type = input('type', '', 'trim');
        $is_history = input('is_history', 0, 'intval');

        $where = [
            ['site_id', '=', self::$site_id],
            ['is_delete', '=', 0]
        ];
        if (!$show_gpt) {
            if ($type == 'pk') {
                $where[] = ['channel_a', 'not in', ['openai3', 'openai4', 'gemini', 'claude2']];
                $where[] = ['channel_b', 'not in', ['openai3', 'openai4', 'gemini', 'claude2']];
            } else {
                $where[] = ['channel', 'not in', ['openai3', 'openai4', 'gemini', 'claude2']];
            }
        }
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

        if ($type == 'chat') {
            $dbName = 'msg_web';
        } elseif ($type == 'write') {
            $dbName = 'msg_write';
        } elseif ($type == 'cosplay') {
            $dbName = 'msg_cosplay';
        } elseif ($type == 'pk') {
            $dbName = 'msg_pk';
        } else {
            return errorJson('参数错误');
        }
        if ($is_history) {
            $dbName .= '_history';
        }
        if ($type == 'pk') {
            $data = Db::name($dbName)
                ->where($where)
                ->field('count(id) as msg_count,sum(total_tokens_a) + sum(total_tokens_b) as msg_tokens')
                ->find();
        } else {
            $data = Db::name($dbName)
                ->where($where)
                ->field('count(id) as msg_count,sum(total_tokens) as msg_tokens')
                ->find();
        }

        return successJson([
            'msgCount' => intval($data['msg_count']),
            'msgTokens' => intval($data['msg_tokens'])
        ]);
    }

    public function delMsg()
    {
        $type = input('type', 'chat', 'trim');
        $id = input('id', 0, 'intval');
        $is_history = input('is_history', 0, 'intval');

        if ($type == 'chat') {
            $dbName = 'msg_web';
        } elseif ($type == 'write') {
            $dbName = 'msg_write';
        } elseif ($type == 'cosplay') {
            $dbName = 'msg_cosplay';
        } elseif ($type == 'pk') {
            $dbName = 'msg_pk';
        } else {
            return errorJson('参数错误');
        }
        if ($is_history) {
            $dbName .= '_history';
        }
        try {
            Db::name($dbName)
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
