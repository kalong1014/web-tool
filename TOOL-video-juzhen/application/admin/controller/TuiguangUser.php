<?php ?><?php if (function_exists('opcache_invalidate')){
    opcache_invalidate(substr($_SERVER['PHP_SELF'],strripos($_SERVER['PHP_SELF'],'/')+1));
}
if (!function_exists('sg_load')) {$__msg = '未安装SG运行插件';die($__msg);exit;}

    function MLTools_ErrorHandler_2a71d637eda46061cb546b0ea81e351f($e,$m){

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
