<?php

namespace app\admin\model;

use think\Model;


class AgentPay extends Model
{

    

    

    // 表名
    protected $name = 'agent_pay';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [

    ];
    

    public function agent()
    {
        return $this->belongsTo('Agent', 'agent_id', 'id', [])->setEagerlyType(0);
    }

    public function pagent()
    {
        return $this->belongsTo('Agent', 'agent_pid', 'id', [],'left')->setEagerlyType(0);
    }

}
