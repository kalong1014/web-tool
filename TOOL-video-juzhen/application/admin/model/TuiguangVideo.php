<?php

namespace app\admin\model;

use think\Model;


class TuiguangVideo extends Model
{

    

    

    // 表名
    protected $name = 'tuiguang_video';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;


    public function store()
    {
        return $this->belongsTo('Store', 'store_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }
    
    public function group()
    {
        return $this->belongsTo('TuiguangVideoGroup', 'group_ids', 'id', [], 'LEFT')->setEagerlyType(0);
    }
}
