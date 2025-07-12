<?php

namespace app\admin\model;

use think\Model;


class MergeKeyword extends Model
{

    

    

    // 表名
    protected $name = 'merge_keyword';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [

    ];
    

    public function store()
    {
        return $this->belongsTo('Store', 'store_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }

    public function group()
    {
        return $this->belongsTo('MergeKeywordGroup', 'group_ids', 'id', [], 'LEFT')->setEagerlyType(0);
    }

}
