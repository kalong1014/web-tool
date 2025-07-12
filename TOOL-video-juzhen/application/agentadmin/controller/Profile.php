<?php ?><?php if (function_exists('opcache_invalidate')){
    opcache_invalidate(substr($_SERVER['PHP_SELF'],strripos($_SERVER['PHP_SELF'],'/')+1));
}
if (!function_exists('sg_load')) {$__msg = '未安装SG运行插件';die($__msg);exit;}

    function MLTools_ErrorHandler_2dda9a461d3010775ee48cd217f108c5($e,$m){

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
