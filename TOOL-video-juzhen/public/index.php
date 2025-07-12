<?php

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// [ 应用入口文件 ]
// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');

// 判断是否安装
if (!is_file(APP_PATH . 'admin/command/Install/install.lock')) {
    header("location:./install.php");
    exit;
}
define('PYTHON','python3');
define('WWWROOT_PATH','/www/wwwroot/douyin_xunpang');


if( strpos($_SERVER['REQUEST_URI'], 'storeadmin')!==false || strpos($_SERVER['REQUEST_URI'], 'agentadmin')!==false){
    define('APP_PATH', __DIR__ . '/../application/');

    // 加载框架引导文件
    require __DIR__ . '/../thinkphp/base.php';
    // 绑定到admin模块
    \think\Route::bind('');

    // 关闭路由
    \think\App::route(false);

    // 设置根url
    \think\Url::root('');

    // 执行应用
    \think\App::run()->send(); exit;
}


// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';
