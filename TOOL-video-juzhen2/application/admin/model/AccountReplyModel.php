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

class AccountReplyModel extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $name = 'AccountReply';

    public function getCreateDateAttr($value,$data){
        return date('Y-m-d H:i:s',$data['create_time']);
    }

    public function getUpdateDateAttr($value,$data){
        return date('Y-m-d H:i:s',$data['update_time']);
    }

    public function getVideoUrlAttr($value,$data){
        if(!$data['video_id']) {
            return '无';
        }
        return Db::name('account_video')->where(['id'=>$data['video_id']])->value('share_url');
    }

    public function getMemberTitleAttr($value,$data){
        if(!$data['member_id']) {
            return '无';
        }
        return Db::name('member')->where(['id'=>$data['member_id']])->value('company_name');
    }


}