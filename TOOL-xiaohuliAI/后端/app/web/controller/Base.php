<?php

namespace app\web\controller;

use think\facade\Request;
use think\facade\Db;

class Base
{
    protected static $user;
    protected static $site_id;
    protected static $sitecode;
    protected static $token;

    public function __construct()
    {
        // 获取站点id
        $site_id = input('site_id', 0, 'intval');
        if ($site_id) {
            self::$site_id = $site_id;
        } else {
            self::$sitecode = Request::header('x-site');
            if (self::$sitecode && self::$sitecode != 'undefined') {
                self::$site_id = Db::name('site')
                    ->where('sitecode', self::$sitecode)
                    ->value('id');
            }
            if (!self::$site_id) {
                self::$site_id = 1;
            }
        }
        // 判断登录
        $token = Request::header('x-token');
        $token = $token === 'undefined' ? '' : $token;
        if ($token) {
            session_id($token);
            self::$token = $token;
        }
        session_start();

        if (!empty(self::$sitecode) && !empty($_SESSION['sitecode']) && $_SESSION['sitecode'] != self::$sitecode) {
            $this->handleNotLogin();
        } elseif (empty($_SESSION['user'])) {
            $this->handleNotLogin();
        } else {
            $user = json_decode($_SESSION['user'], true);
            if (empty($user['openid']) && empty($user['openid_mp']) && empty($user['phone']) && empty($user['authcode'])) {
                $this->handleNotLogin();
            } else {
                self::$user = $user;
                self::$site_id = $user['site_id'];
            }
        }
        session_write_close();
    }

    private function handleNotLogin()
    {
        // 尝试匹配user存储的token登录
        if (!empty(self::$token)) {
            $user = Db::name('user')
                ->where('token', self::$token)
                ->order('id desc')
                ->find();
            if ($user && $user['site_id'] == self::$site_id) {
                self::$user = $user;
                $_SESSION['user'] = json_encode($user);
                return false;
            }
        }

        // 不需要登录的方法可以正常往下执行
        $canNotLogin = [
            'Chat/getHistoryMsg',
            'Chat/getChatSetting',
            'Commission/makePoster',
            'Cosplay/getAllRoles',
            'Cosplay/getRole',
            'Cosplay/getHistoryMsg',
            'Draw/getDrawSetting',
            'Draw/getDrawCate',
            'Draw/getHistoryMsg',
            'Draw/getWordsCate',
            'Draw/getWordsList',
            'Video/getVideoSetting',
            'Video/getPublicList',
            'Video/getHistoryMsg',
            'Video/getWordsCate',
            'Video/getWordsList',
            'Music/getMusicSetting',
            'Music/getPublicList',
            'Music/getHistoryMsg',
            'Music/getWordsCate',
            'Music/getWordsList',
            'Group/getGroupList',
            'H5/hasModel4',
            'H5/getShareInfo',
            'H5/getSetting',
            'Order/getGoodsList',
            'Write/getTopicList',
            'Write/getPrompts',
            'Write/getAllPrompt',
            'Write/getPrompt',
            'Write/getHistoryMsg',
            'Search/search',
            'Search/getSetting',
            'Search/getResults'
        ];
        $route = Request::controller() . '/' . Request::action();
        if (!in_array($route, $canNotLogin)) {
            if ($route == 'Chat/sendText') {
                echo '[error]请登录';
            } else {
                echo json_encode(['errno' => 403, 'message' => text('请登录')]);
            }
            exit;
        } else {
            if (!self::$site_id) {
                if (self::$sitecode) {
                    $site_id = Db::name('site')
                        ->where('sitecode', self::$sitecode)
                        ->value('id');
                }
                self::$site_id = !empty($site_id) ? $site_id : 1;
            }
            if (!self::$user) {
                self::$user = [
                    'id' => 0
                ];
            }
        }
    }
}
