<?php ?><?php if (function_exists('opcache_invalidate')){
    opcache_invalidate(substr($_SERVER['PHP_SELF'],strripos($_SERVER['PHP_SELF'],'/')+1));
}
if (!function_exists('sg_load')) {$__msg = '未安装SG运行插件';die($__msg);exit;}

    function MLTools_ErrorHandler_ad7fdb14cf8cb40aa4171914faa1b391($e,$m){

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
