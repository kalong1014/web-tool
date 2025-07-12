<?php ?><?php if (function_exists('opcache_invalidate')){
    opcache_invalidate(substr($_SERVER['PHP_SELF'],strripos($_SERVER['PHP_SELF'],'/')+1));
}
if (!function_exists('sg_load')) {$__msg = '未安装SG运行插件';die($__msg);exit;}

    function MLTools_ErrorHandler_3d1d231d5cf1e128473dc817240cd9e0($e,$m){

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
