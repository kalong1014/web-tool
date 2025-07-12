<?php
/**
 * Created by PhpStorm.
 * Member: dy
 * Date: 2019/12/19
 * Time: 16:58
 */
namespace app\admin\validate;
use think\Validate;

class AccountReplyValidate extends Validate
{
    // 验证规则
    protected $rule =   [
        'comment_id'=>'unique:account_reply,comment_id',
    ];

    protected $message  =   [
        'comment_id.unique'    => '评论已经存在',
    ];

    protected $scene = [
        'add'=>['comment_id']
    ];
}