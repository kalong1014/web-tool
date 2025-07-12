<?php

namespace app\storeadmin\controller;

use app\common\controller\Backend;
use think\Db;
use think\Config;
/**
 * 
 *
 * @icon fa fa-circle-o
 */
class Feedback extends Backend
{
    protected $noNeedLogin = ['*'];
    /**
     * StoreTask模型对象
     * @var \app\admin\model\StoreTask
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();

    }


    /**
     * 查看
     */
    public function index()
    {
        //当前是否为关联查询
        $this->relationSearch = true;
        $store_id = session('store_id');

        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                $params = $this->preExcludeFields($params);

                if ($this->dataLimit && $this->dataLimitFieldAutoFill) {
                    $params[$this->dataLimitField] = $this->auth->id;
                }

                $result = false;
                try {
                    // echo '<pre>';
                    // var_dump($_SERVER);exit;
                    $params['user_ip'] = $_SERVER['REMOTE_ADDR'];
                    $res_json = dcurl('https://www.zhansiwl.com/index/script/feedback','POST',$params);
                    $res = json_decode($res_json,1);
                    if(@$res['code'] == 1){
                        $this->error($res['msg']);
                    }else{
                        $this->success('成功：'.@$res['msg']);
                    }
                } catch (Exception $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                }

            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        return $this->view->fetch();
    }

   
   
}
