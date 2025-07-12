<?php

namespace app\admin\model;

use think\Model;


class ActivityUser extends Model
{

    

    

    // 表名
    protected $name = 'activity_user';
    
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
    

    public function activity()
    {
        return $this->belongsTo('Activity', 'activity_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }


}
