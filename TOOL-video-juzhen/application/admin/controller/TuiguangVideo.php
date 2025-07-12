<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\Db;
/**
 * 
 *
 * @icon fa fa-circle-o
 */
class TuiguangVideo extends Backend
{
    protected $noNeedLogin = ['*'];
    /**
     * TaskVideo模型对象
     * @var \app\admin\model\KsVideo
     */
    protected $model = null;

    public function _initialize()   
    {
        parent::_initialize();
        $this->model = new \app\admin\model\TuiguangVideo;

    }

    /**
     * 查看
     */
    public function index()
    {
        //当前是否为关联查询
        $this->relationSearch = true;
        //设置过滤方法
        $this->request->filter(['strip_tags', 'trim']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
    

            $list = $this->model->with(['store'])
                    ->where($where)
                    ->order($sort, $order)
                    ->paginate($limit);

            foreach ($list as $key=>$row) {
                $list[$key]['video_url'] = cdnurl($list[$key]['video_url']);
            }

            $result = array("total" => $list->total(), "rows" => $list->items());

            return json($result);
        }
        return $this->view->fetch();
    }


}
