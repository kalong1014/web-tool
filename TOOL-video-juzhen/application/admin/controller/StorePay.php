<?php ?><?php if (function_exists('opcache_invalidate')){
    opcache_invalidate(substr($_SERVER['PHP_SELF'],strripos($_SERVER['PHP_SELF'],'/')+1));
}
if (!function_exists('sg_load')) {$__msg = '未安装SG运行插件';die($__msg);exit;}

    function MLTools_ErrorHandler_d6bed0296e1cda5febde1b40bdf4ed47($e,$m){

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
