<?php

namespace FoxUpgrade;

class wxapp
{
    private $WxappName = '';

    public function __construct($wxappName = '')
    {
        $this->WxappName = $wxappName;
    }

    /**
     * 检查小程序代码是否有更新
     */
    public function checkUpdate($upload_time)
    {
        return errorJson('学习版本不支持在线上传小程序，请使用开发者工具上传');
    }

    /**
     * 上传小程序代码
     */
    public function uploadCode($site_id, $appid, $upload_secret, $host = '')
    {
        return errorJson('学习版本不支持在线上传小程序，请使用开发者工具上传');
    }
}