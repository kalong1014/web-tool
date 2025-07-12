<?php

namespace app\admin\model;

use think\Model;


class VideoRank extends Model
{

    

    

    // 表名
    protected $name = 'video_rank';
    
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
        return $this->belongsTo('Store', 'store_id', 'id', [])->setEagerlyType(0);
    }

    public function tuiguangtask()
    {
        return $this->belongsTo('TuiguangTask', 'tuiguang_task_id', 'id', [])->setEagerlyType(0);
    }
    

}
