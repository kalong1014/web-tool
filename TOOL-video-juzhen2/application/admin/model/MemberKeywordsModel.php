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

class MemberKeywordsModel extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $name = 'MemberKeywords';

    public function getCreateDateAttr($value,$data){
        return date('Y-m-d',$data['create_time']);
    }

    public function getUpdateDateAttr($value,$data){
        if(!$data['update_time'] || $data['update_time'] == 0) {
            return '暂未更新';
        }
        return date('Y-m-d',$data['update_time']);
    }

    public function getUpLastDateAttr($value,$data){
        if(!$data['up_last_time'] || $data['up_last_time'] == 0) {
            return '暂未达标';
        }
        return date('Y-m-d H:i:s',$data['up_last_time']);
    }

    public function getMemberTitleAttr($value,$data){
        if(!$data['member_id']) {
            return '无';
        }
        return Db::name('member')->where(['id'=>$data['member_id']])->value('company_name');
    }

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

    public function getTypeTitleAttr($value,$data){
        switch ($data['type'])
        {
            case 1:
                return '单主词';
                break;
            case 2:
                return '头词+主词';
                break;
            case 3:
                return '主词+尾词';
                break;
            case 4:
                return '头词+主词+尾词';
                break;
            default:
                return '未查询到类型';
        }
    }

    public function getStatusTitleAttr($value,$data){
        switch ($data['status'])
        {
            case 1:
                return '优化中';
                break;
            case 2:
                return '已停词';
                break;
            default:
                return '已停词';
        }
    }

    public static function getTrashedMemberKeywords($id, $field = false)
    {
        $member_money_log = self::withTrashed()->find($id);
        return $field === false ? $member_money_log : Arr::get($member_money_log, $field, '');
    }

}