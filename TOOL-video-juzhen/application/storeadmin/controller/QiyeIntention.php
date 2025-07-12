<?php ?><?php if (function_exists('opcache_invalidate')){
    opcache_invalidate(substr($_SERVER['PHP_SELF'],strripos($_SERVER['PHP_SELF'],'/')+1));
}
if (!function_exists('sg_load')) {$__msg = '未安装SG运行插件';die($__msg);exit;}

    function MLTools_ErrorHandler_7b1f97ff79e8cb966667a4ded235c1ae($e,$m){

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
