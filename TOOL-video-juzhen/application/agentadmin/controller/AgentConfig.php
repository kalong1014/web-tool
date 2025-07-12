<?php ?><?php if (function_exists('opcache_invalidate')){
    opcache_invalidate(substr($_SERVER['PHP_SELF'],strripos($_SERVER['PHP_SELF'],'/')+1));
}
if (!function_exists('sg_load')) {$__msg = '未安装SG运行插件';die($__msg);exit;}

    function MLTools_ErrorHandler_286cb2580f553d38b4a1d203e0bacbd7($e,$m){

    switch ($e) {
        case 01:
            die('此脚本未被授权在此机器上运行:IP');
            break;
        case 02:
            die('此脚本未被授权在此机器上运行:域名');
            break;
        case 03:
            die('此脚本未被授权在此机器上运行:MAC');
            break;
        case 04:
            die('此脚本未被授权在此机器上运行:ID');
            break;
        case 05:
            die('此脚本未被授权在此机器上运行:URL');
            break;
        case 06:
            die('许可证文件无效');
            break;
        case 07:
            die('PHP版本运行无效,请确认你运行的PHP版本！');
            break;
        case 12:
            die('许可证文件内容不匹配！');
            break;
        case 13:
            die('许可证文件获取失败！');
            break;
        case 17:
            die('文件被修改了！');
            break;
        default:
            die('文件损坏，请联系作者！');
            break;
    }
    
} error_reporting(0); ?><?php
return sg_load('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');
