<?php
/**
 * Created by PhpStorm.
 * Member: dy
 * Date: 2019/12/19
 * Time: 16:58
 */
namespace app\admin\validate;
use think\Validate;

class AccountVideoValidate extends Validate
{
    // 验证规则
    protected $rule =   [
        'video_id'=>'unique:account_video,video_id',
    ];

    protected $message  =   [
        'video_id.unique'    => '视频已经存在',
    ];

    protected $scene = [
        'add'=>['video_id']
    ];
}