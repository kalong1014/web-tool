<?php


// [ 应用入口文件 ]

// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');
// 定义上传目录
define('UPLOAD_PATH', __DIR__ . '/../public');
// 定义应用缓存目录
define('RUNTIME_PATH', __DIR__ . '/../runtime/');
// 开启调试模式
//var_dump($_SERVER['HTTP_HOST']);
$domin_other='lunhui_tp5-master/public';
if($_SERVER['HTTP_HOST']=="localhost"){
    define('ROOT','http://'.$_SERVER['HTTP_HOST'].'/'.$domin_other);
}else{
    define('ROOT','');
}
//var_dump($_ENV);
//魔术常量

define('APP_DEBUG', false);
// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';
