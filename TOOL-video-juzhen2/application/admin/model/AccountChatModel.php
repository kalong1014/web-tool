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

class AccountChatModel extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $name = 'AccountChat';

    public function getCreateDateAttr($value,$data){
        return date('Y-m-d H:i:s',$data['create_time']);
    }

    public function getMemberTitleAttr($value,$data){
        if(!$data['member_id']) {
            return '无';
        }
        return Db::name('member')->where(['id'=>$data['member_id']])->value('company_name');
    }

    public function getFromCustNicknameAttr($value,$data){
        if($data['to_type'] == 1) {
            return Db::name('account')->where(['id'=>$data['account_id']])->value('nickname');
        }
        return Db::name('account_cust')->where(['id'=>$data['from_cust_id']])->value('nickname');
    }

    public function getFromCustAvatarAttr($value,$data){
        if($data['to_type'] == 1) {
            return Db::name('account')->where(['id'=>$data['account_id']])->value('avatar');
        }
        return Db::name('account_cust')->where(['id'=>$data['from_cust_id']])->value('avatar');
    }

    public function getToCustNicknameAttr($value,$data){
        if($data['to_type'] == 1) {
            return Db::name('account')->where(['id'=>$data['account_id']])->value('nickname');
        }
        return Db::name('account_cust')->where(['id'=>$data['to_cust_id']])->value('nickname');
    }

    public function getToCustAvatarAttr($value,$data){
        if($data['to_type'] == 1) {
            return Db::name('account')->where(['id'=>$data['account_id']])->value('avatar');
        }
        return Db::name('account_cust')->where(['id'=>$data['to_cust_id']])->value('avatar');
    }

    public static function getTrashedAccountChat($id, $field = false)
    {
        $member_money_log = self::withTrashed()->find($id);
        return $field === false ? $member_money_log : Arr::get($member_money_log, $field, '');
    }

    public static function getPlayCount($member_id)
    {
        return Db::name('account')->where(['delete_time'=>0,'member_id'=>$member_id])->SUM('play_count');
    }

    public static function getChatCount($member_id)
    {
        return Db::name('account')->where(['delete_time'=>0,'member_id'=>$member_id])->SUM('chat_count');
    }

    public static function getCommentCount($member_id)
    {
        return Db::name('account')->where(['delete_time'=>0,'member_id'=>$member_id])->SUM('comment_count');
    }

    public static function getDiggCount($member_id)
    {
        return Db::name('account')->where(['delete_time'=>0,'member_id'=>$member_id])->SUM('digg_count');
    }

}