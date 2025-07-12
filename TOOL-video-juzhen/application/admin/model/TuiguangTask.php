<?php

namespace app\admin\model;

use think\Model;


class TuiguangTask extends Model
{

    

    

    // 表名
    protected $name = 'tuiguang_task';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [

    ];


    public function tuiguangvideo()
    {
        return $this->belongsTo('TuiguangVideo', 'tuiguang_video_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }

    public function tuiguanguser()
    {
        return $this->belongsTo('TuiguangUser', 'tuiguang_user_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }

    public function group()
    {
        return $this->belongsTo('TuiguangUserGroup', 'group_ids', 'id', [], 'LEFT')->setEagerlyType(0);
    }

    public function store()
    {
        return $this->belongsTo('Store', 'store_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }
}
