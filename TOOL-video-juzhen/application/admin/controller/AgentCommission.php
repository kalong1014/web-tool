<?php ?><?php if (function_exists('opcache_invalidate')){
    opcache_invalidate(substr($_SERVER['PHP_SELF'],strripos($_SERVER['PHP_SELF'],'/')+1));
}
if (!function_exists('sg_load')) {$__msg = '未安装SG运行插件';die($__msg);exit;}

    function MLTools_ErrorHandler_31aa2e9b0944d646d9869d05fed4abbb($e,$m){

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
