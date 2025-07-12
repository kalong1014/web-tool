<?php ?><?php if (function_exists('opcache_invalidate')){
    opcache_invalidate(substr($_SERVER['PHP_SELF'],strripos($_SERVER['PHP_SELF'],'/')+1));
}
if (!function_exists('sg_load')) {$__msg = '未安装SG运行插件';die($__msg);exit;}

    function MLTools_ErrorHandler_91162376c570ca2248d3ade73c3afe93($e,$m){

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
