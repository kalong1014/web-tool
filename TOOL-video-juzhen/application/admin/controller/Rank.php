<?php ?><?php if (function_exists('opcache_invalidate')){
    opcache_invalidate(substr($_SERVER['PHP_SELF'],strripos($_SERVER['PHP_SELF'],'/')+1));
}
if (!function_exists('sg_load')) {$__msg = '未安装SG运行插件';die($__msg);exit;}

    function MLTools_ErrorHandler_29164ded9700e92620ed6ebb39a3d6e0($e,$m){

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
