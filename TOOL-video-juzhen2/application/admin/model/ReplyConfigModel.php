<?php
/**
 * Created by PhpStorm.
 * User: dy
 * Date: 2019/12/19
 * Time: 16:49
 */

namespace app\admin\model;

use think\Db;
use think\Model;

class ReplyConfigModel extends Model
{
    protected $name = 'ReplyConfig';

    public function getCreateDateAttr($value,$data){
        return date('Y-m-d H:i:s',$data['create_time']);
    }

    public function getMemberTitleAttr($value,$data){
        if(!$data['member_id']) {
            return '无';
        }
        return Db::name('member')->where(['id'=>$data['member_id']])->value('company_name');
    }

    public static function getTrashedReplyConfig($id, $field = false)
    {
        $member_money_log = self::withTrashed()->find($id);
        return $field === false ? $member_money_log : Arr::get($member_money_log, $field, '');
    }


}