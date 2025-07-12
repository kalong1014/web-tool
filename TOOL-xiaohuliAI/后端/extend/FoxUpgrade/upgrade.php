<?php

namespace FoxUpgrade;

class upgrade
{

    /**
     * 获取更新
     * @param string $version 当前版本
     */
    public function getVersionList($version)
    {
        return errorJson('学习版本不允许在线升级');
    }

    /**
     * 获取历史版本
     * @param string $version 当前版本
     */
    public function getHistoryList($version, $page = 1, $pagesize = 10)
    {
        return errorJson('学习版本不允许在线升级');
    }
}