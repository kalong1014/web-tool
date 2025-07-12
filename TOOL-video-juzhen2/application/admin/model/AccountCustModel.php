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
use traits\model\SoftDelete;

class AccountCustModel extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $name = 'AccountCust';

    public function getCreateDateAttr($value,$data){
        return date('Y-m-d H:i:s',$data['create_time']);
    }

    public function getUpdateDateAttr($value,$data){
        return date('Y-m-d H:i:s',$data['update_time']);
    }

    public function getLastChatDateAttr($value,$data){
        if(!$data['last_chat_time']) {
            return ' ';
        }
        return date('Y-m-d',$data['last_chat_time']);
    }

    public function getLastChatTextAttr($value,$data){
        $chat = Db::name('account_chat')->where(array('to_cust_id'=>$data['id']))->whereOr(array('from_cust_id'=>$data['id']))->order('id desc')->value('text');
        if(!$chat) {
            return ' ';
        }
        return $chat;
    }

    public function getMemberTitleAttr($value,$data){
        if(!$data['member_id']) {
            return '无';
        }
        return Db::name('member')->where(['id'=>$data['member_id']])->value('company_name');
    }

    public function getAccountTitleAttr($value,$data){
        if(!$data['account_id']) {
            return '无';
        }
        return Db::name('account')->where(['id'=>$data['account_id']])->value('nickname');
    }

    public function getAccountTokenAttr($value,$data){
        if(!$data['account_id']) {
            return '无';
        }
        return Db::name('account')->where(['id'=>$data['account_id']])->value('nickname');
    }

    public function getVideoUrlAttr($value,$data){
        if(!$data['video_id']) {
            return '无';
        }
        return Db::name('account_video')->where(['id'=>$data['video_id']])->value('share_url');
    }

    public static function getTrashedAccountCust($id, $field = false)
    {
        $member_money_log = self::withTrashed()->find($id);
        return $field === false ? $member_money_log : Arr::get($member_money_log, $field, '');
    }


}