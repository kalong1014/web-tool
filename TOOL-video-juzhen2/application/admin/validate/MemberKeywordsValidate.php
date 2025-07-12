<?php
/**
 * Created by PhpStorm.
 * Member: dy
 * Date: 2019/12/19
 * Time: 16:58
 */
namespace app\admin\validate;
use think\Validate;

class MemberKeywordsValidate extends Validate
{
    // 验证规则
    protected $rule =   [
        'keyword'=>'require|unique:member_keywords,keyword^video_link',
    ];

    protected $message  =   [
        'keyword.unique'    => '关键词重复',
        'keyword.require'    => '关键词不能为空',
    ];

    protected $scene = [
        'add'=>['keyword']
    ];
}