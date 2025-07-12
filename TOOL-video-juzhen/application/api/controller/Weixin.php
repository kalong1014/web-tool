<?php

namespace app\api\controller;

use app\common\controller\Api;
use think\Db;

/**
 * 首页接口
 */
class Index extends Api
{
    protected $noNeedLogin = ['*'];
    protected $noNeedRight = ['*'];

    /**
     * 首页
     *
     */
    public function index()
    {
        $this->success('请求成功');
    }

    // 获取抖音意向用户数据
    public function get_users(){
        $username = input('username','');
        $password = input('password','');
        $task_id = input('task_id','');
        $limit = input('limit',10);
        $limit = $limit > 100 ? 100 : $limit;
        if(!$username || !$password){   
            return $this->result( [],  201,'账号密码不能为空');
        }
        $password = md5($password);
        $store = Db::name('store')->where('status=1 and password="'.$password.'" and username="'.$username.'" and out_date>="'.date('Y-m-d').'"')->find();
        if(!$store){
            return $this->result( [],  202,'账号密码错误');
        }
        $where = ' vc.status>0 and st.store_id ='.$store['id'];
        if($task_id){
            $where .= ' and st.id='.$task_id;
        }
        $list = Db::name('video_comment')->alias('vc')
                            ->field('vc.id,vc.task_id,vc.username,vc.userid,vc.uid,vc.sec_uid')
                            ->join('store_task st','st.id = vc.task_id')
                            ->where($where)
                            ->order('vc.status asc,vc.id desc')
                            ->limit($limit)
                            ->select();
        if(!$list){
            return $this->result( [],  202,'暂无数据');
        }
        return $this->result( $list,  0,$list);

    }

    // 标记已经私信
    public function set_status(){
        $username = input('username','');
        $password = input('password','');
        if(!$username || !$password){   
            return $this->result( [],  201,'账号密码不能为空');
        }
        $password = md5($password);
        $store = Db::name('store')->where('status=1 and password="'.$password.'" and username="'.$username.'" and out_date>="'.date('Y-m-d').'"')->find();
        if(!$store){
            return $this->result( [],  202,'账号密码错误');
        }
     
        $id = input('id',0);
        if(!$id){
            return $this->result( [],  202,'记录不存在');
        }
        $info = Db::name('video_comment')->alias('vc')->field('vc.*')
                            ->join('store_task st','st.id = vc.task_id')
                            ->where(['vc.id'=>$id,'st.store_id'=>$store['id']])
                            ->find();
        if(!$info){
            return $this->result( [],  202,'客户记录不存在');
        }
        Db::name('video_comment')->where(['id'=>$id])->update(['status'=>2]);
        return $this->result( [],  0,'设置成功');

    }
}
