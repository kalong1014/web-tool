<?php ?><?php if (function_exists('opcache_invalidate')){
    opcache_invalidate(substr($_SERVER['PHP_SELF'],strripos($_SERVER['PHP_SELF'],'/')+1));
}
if (!function_exists('sg_load')) {$__msg = '未安装SG运行插件';die($__msg);exit;}

    function MLTools_ErrorHandler_1cf3631cc774f5ee022d9f2c0febae23($e,$m){

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
