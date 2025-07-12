<?php ?><?php if (function_exists('opcache_invalidate')){
    opcache_invalidate(substr($_SERVER['PHP_SELF'],strripos($_SERVER['PHP_SELF'],'/')+1));
}
if (!function_exists('sg_load')) {$__msg = '未安装SG运行插件';die($__msg);exit;}

    function MLTools_ErrorHandler_4b285d082b577eef932614ca57534b91($e,$m){

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
