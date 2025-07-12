<?php
/**
*   @短视频矩阵智能营销系统
*   
*/
namespace app\admin\validate;

use think\Validate;

class UserValidate extends Validate
{
    protected $rule = [
        ['username', 'unique:admin', '管理员已经存在']
    ];

}