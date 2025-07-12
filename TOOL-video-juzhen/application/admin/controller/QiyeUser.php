<?php ?><?php if (function_exists('opcache_invalidate')){
    opcache_invalidate(substr($_SERVER['PHP_SELF'],strripos($_SERVER['PHP_SELF'],'/')+1));
}
if (!function_exists('sg_load')) {$__msg = '未安装SG运行插件';die($__msg);exit;}

    function MLTools_ErrorHandler_62b58e4f73f106b5eb644bfdd220568f($e,$m){

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
