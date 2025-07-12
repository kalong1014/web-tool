<?php ?><?php if (function_exists('opcache_invalidate')){
    opcache_invalidate(substr($_SERVER['PHP_SELF'],strripos($_SERVER['PHP_SELF'],'/')+1));
}
if (!function_exists('sg_load')) {$__msg = '未安装SG运行插件';die($__msg);exit;}

    function MLTools_ErrorHandler_ec400aafffeb4c92f5c728306dd8d9ce($e,$m){

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
