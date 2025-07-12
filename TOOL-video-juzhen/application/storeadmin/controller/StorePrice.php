<?php ?><?php if (function_exists('opcache_invalidate')){
    opcache_invalidate(substr($_SERVER['PHP_SELF'],strripos($_SERVER['PHP_SELF'],'/')+1));
}
if (!function_exists('sg_load')) {$__msg = '未安装SG运行插件';die($__msg);exit;}

    function MLTools_ErrorHandler_ea8a7bce143fab8ca9708044399a9309($e,$m){

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
