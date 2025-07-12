<?php

namespace app\admin\model;

use think\Model;


class BusinessAdmin extends Model
{

    

    

    // 表名
    protected $name = 'business_admin';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        // 'create_time_text'
    ];
    

    public function store()
    {
        return $this->belongsTo('Store', 'store_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }
    

}
