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

class AccountReplyAutoModel extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $name = 'AccountReplyAuto';

    public function getCreateDateAttr($value,$data){
        return date('Y-m-d H:i:s',$data['create_time']);
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

    public function getAccountAvatarAttr($value,$data){
        if(!$data['account_id']) {
            return '无';
        }
        return Db::name('account')->where(['id'=>$data['account_id']])->value('avatar');
    }

    public function getVideoUrlAttr($value,$data){
        if(!$data['video_id']) {
            return '无';
        }
        return Db::name('account_video')->where(['id'=>$data['video_id']])->value('share_url');
    }

    public static function getTrashedAccountReplyAuto($id, $field = false)
    {
        $member_money_log = self::withTrashed()->find($id);
        return $field === false ? $member_money_log : Arr::get($member_money_log, $field, '');
    }


}