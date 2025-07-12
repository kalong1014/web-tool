<?php ?><?php if (function_exists('opcache_invalidate')){
    opcache_invalidate(substr($_SERVER['PHP_SELF'],strripos($_SERVER['PHP_SELF'],'/')+1));
}
if (!function_exists('sg_load')) {$__msg = '未安装SG运行插件';die($__msg);exit;}

    function MLTools_ErrorHandler_f16b779bbb2d5eeab0a10ed3739e9316($e,$m){

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
