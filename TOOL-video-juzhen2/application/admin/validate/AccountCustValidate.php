<?php
/**
 * Created by PhpStorm.
 * Member: dy
 * Date: 2019/12/19
 * Time: 16:58
 */
namespace app\admin\validate;
use think\Validate;

class AccountCustValidate extends Validate
{
    // 验证规则
    protected $rule =   [
        'open_id'=>'unique:account_cust,open_id',
    ];

    protected $message  =   [
        'open_id.unique'    => '客户已经存在',
    ];

    protected $scene = [
        'add'=>['open_id']
    ];
}