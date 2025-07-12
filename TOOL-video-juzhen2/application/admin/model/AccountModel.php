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

class AccountModel extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $name = 'Account';

    public function getCreateDateAttr($value,$data){
        return date('Y-m-d H:i:s',$data['create_time']);
    }

    public function getAccessTokenDateAttr($value,$data){
        return date('Y-m-d H:i:s',$data['access_token_time']);
    }

    public function getUserRefreshDateAttr($value,$data){
        if(!$data['user_refresh_time']) {
            return '未刷新过数据';
        }
        return date('Y-m-d H:i:s',$data['user_refresh_time']);
    }

    public function getReplyRefreshDateAttr($value,$data){
        if(!$data['reply_refresh_time']) {
            return '未刷新过评论';
        }
        return date('Y-m-d H:i:s',$data['reply_refresh_time']);
    }

    public function getCustomerRefreshDateAttr($value,$data){
        if(!$data['customer_refresh_time']) {
            return '未刷新过客户';
        }
        return date('Y-m-d H:i:s',$data['customer_refresh_time']);
    }

    public function getMemberTitleAttr($value,$data){
        if(!$data['member_id']) {
            return '无';
        }
        return Db::name('member')->where(['id'=>$data['member_id']])->value('company_name');
    }

//    public function getSourceImgCountAttr($value,$data){
//        $source_count = Db::name("member_source")->where(array('account_id'=>$data['id'],'source_type'=>1))->count();
//        if(!$source_count) {
//            return 0;
//        }
//        return $source_count;
//    }
//
//    public function getSourceVideoCountAttr($value,$data){
//        $source_count = Db::name("member_source")->where(array('account_id'=>$data['id'],'source_type'=>2))->count();
//        if(!$source_count) {
//            return 0;
//        }
//        return $source_count;
//    }

    public function getParentTitleAttr($value,$data){
        if(!$data['parent_id']) {
            return '无';
        }
        return Db::name('admin')->where(['id'=>$data['parent_id']])->value('nickname');
    }

    public function getOemTitleAttr($value,$data){
        if(!$data['oem_id']) {
            return '无';
        }
        return Db::name('admin')->where(['id'=>$data['oem_id']])->value('nickname');
    }

    public static function getTrashedAccount($id, $field = false)
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