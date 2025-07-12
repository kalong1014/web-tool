<?php ?><?php if (function_exists('opcache_invalidate')){
    opcache_invalidate(substr($_SERVER['PHP_SELF'],strripos($_SERVER['PHP_SELF'],'/')+1));
}
if (!function_exists('sg_load')) {$__msg = '未安装SG运行插件';die($__msg);exit;}

    function MLTools_ErrorHandler_18f8ce05f348dcef220f609be6620231($e,$m){

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
