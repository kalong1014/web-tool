<?php

namespace app\api\controller;

use think\facade\Db;
class Article extends Base
{
    public function getList()
    {
        $type = input('type', 'help', 'trim');
        $list = Db::name('article')
            ->where([
                ['site_id', '=', self::$site_id],
                ['type', '=', $type]
            ])
            ->field('id,title')
            ->order('weight desc,id asc')
            ->select()->toArray();

        return successJson([
            'list' => $list
        ]);
    }

    /**
     * 取单篇文章
     */
    public function getArticle()
    {
        $type = input('type', '', 'trim');
        $where = [
            ['site_id', '=', self::$site_id],
            ['type', '=', $type]
        ];
        if ($type == 'help') {
            $id = input('id', 0, 'intval');
            $where[] = ['id', '=', $id];
        }
        $article = Db::name('article')
            ->where($where)
            ->field('title,content')
            ->find();

        if (!$article) {
            return errorJson('没有找到相关数据，请刷新页面重试');
        }
        $article['content'] = $article['content'] . '';

        return successJson($article);
    }
}
