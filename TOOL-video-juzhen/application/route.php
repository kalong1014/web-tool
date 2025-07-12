<?php

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;

Route::get('agentadmin','agentadmin/index/index');
Route::get('storeadmin','storeadmin/index/index');

Route::get('product','index/index/product');
Route::get('zixun_<id>','index/index/zixun_info');
Route::get('zixun<type_id>','index/index/zixun');
Route::get('zixun','index/index/zixun');
Route::get('contact','index/index/contact');
Route::get('onepage','index/index/onepage');
Route::get('C<url>','index/card/index');
Route::get('A<short_url>','index/activity/index');

return [
    //别名配置,别名只能是映射到控制器且访问时必须加上请求的方法
    '__alias__'   => [
    ],
    //变量规则
    '__pattern__' => [
    ],

    
//        域名绑定到模块
//        '__domain__'  => [
//            'admin' => 'admin',
//            'api'   => 'api',
//        ],
];
