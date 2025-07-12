<?php

namespace app\storeadmin\controller;

use app\admin\model\Admin;
use app\admin\model\User;
use app\common\controller\Backend;
use app\common\model\Attachment;
use fast\Date;
use think\Db;
use think\Config;

/**
 * 后台首页
 * @internal
 */
class Api extends Backend
{
    protected $noNeedLogin = ['*'];
    protected $noNeedRight = ['index', 'logout'];
    protected $layout = '';

    public function _initialize()
    {
        parent::_initialize();
        //移除HTML标签
        $this->request->filter('trim,strip_tags,htmlspecialchars');
    }

    /**
     * 接口数据统计
     */
    public function index()
    {

        $store_id = session('store_id');
        $starttime = Date::unixtime('day', -10);
        $endtime = Date::unixtime('day', 0, 'end');
        $dates = [];
        for ($i=0; $i<=10; $i++){
            $dates[$i] = date('Y-m-d' ,strtotime( '+' . $i-10 .' days', time()));
        }
        foreach ($dates as $k => $v) {
            $index_task_date[] =  '"'.date('m-d',strtotime($v)).'"';
            $index_task_num = 1);
            $map_task_num = 2;
            $xhs_task_num = 3;
            $ks_task_num = 4;
            $index_task_count[] =  $index_task_num + $map_task_num + $xhs_task_num + $ks_task_num;
        }
        $index_task_date = implode(',', $index_task_date);
        $index_task_count = implode(',', $index_task_count);
        // 客户提取列表
        $user_list = [];
        // 充值统计
        $store_info = Db::name('store')->where(['id'=>$store_id])->find();
        $all_price = Db::name("store_pay")->where(['store_id'=>$store_id,'status'=>1])->sum('price');
        $use_price = 33;

        $today = date('Y-m-d');
        $dbTableList = Db::query("SHOW TABLE STATUS");
        $return=array(
            'index_task'      => 1,
            'video_task'      => 3,
            'key_task'      => 10,
            'run_task'      => 20,
            'all_task'      => 99,
            'all_video'      => 100,
            'all_comment'      => 399,
            'user_list'     =>  $user_list,
            'store_info'    =>  $store_info,
            'use_price'     =>  $use_price,
            'all_price'     =>  $all_price, 
            'index_task_date'     =>  $index_task_date, 
            'index_task_count'     =>  $index_task_count,
    );

        ///中心
        $year = date('Y',time());
        $month = date('m',time());
        $day = date('d',time());
        $days = date('Y-m-d',time());
        $miny = $year.'-01-01 00:00:00';
        $maxy = $year.'-12-31 23:59:59';
        $minm = $year.'-'.$month.'-01 00:00:00';
        $maxm = $year.'-'.$month.'-31 23:59:59';
        $mind = $year.'-'.$month.'-'.$day.' 00:00:00';
        $maxd = $year.'-'.$month.'-'.$day.' 23:59:59';
        $zong=Db::name('store_pay')->where(['store_id'=>$store_id])->sum('price');
        $zongy=Db::name('store_pay')->where(['store_id'=>$store_id])->whereTime('addtime', 'between', [$miny, $maxy])->sum('price');
        $zongm=Db::name('store_pay')->where(['store_id'=>$store_id])->whereTime('addtime', 'between', [$minm, $maxm])->sum('price');
        $zongd=Db::name('store_pay')->where(['store_id'=>$store_id])->whereTime('addtime', 'between', [$mind, $maxd])->sum('price');
        $return['zong']=$zong;
        $return['zongy']=$zongy;
        $return['zongm']=$zongm;
        $return['zongd']=$zongd;
        $return['days']=$days;

        $zan=1;
        $jin=2;
        $wan=3;
        if($wan!=0){
            $wancheng=round($wan/($zan+$jin+$wan),1).'%';
        }else{
            $wancheng=0;
        }

        $return['zan']=$zan;
        $return['jin']=$jin;
        $return['wan']=$wan;
        $return['lv']=$wancheng;


        return json_encode($return,true);

    }
    //年获客
    public function echarts_4(){
         $store_id = session('store_id');
//获取月
        $days_arr = array();
        for($i=1;$i<=12;$i++){
            array_push($days_arr, $i);
        }
        $return = [];
        $dys = [];
        $kss = [];
        $xhss = [];
        $maps = [];
        $bzs = [];
        $zong = [];
//查询
        foreach ($days_arr as $val){
            $month = $val;
            $year = date('Y',time());
            $min = $year.'-'.$month.'-01 00:00:00';
            $max = $year.'-'.$month.'-31 23:59:59';
            $ks=1;
            $xhs=2;
            $bz=3;
            //$dy=Db::name('video_comment')->where(['store_id'=>$store_id])->count();
     
            $map=1;

            $dy=2;
            $dys[]=$dy;
            $xhss[]=$xhs;
            $kss[]=$ks;
            $maps[]=$map;
            $bzs[]=$bz;
            $zong[]=$dy+$ks+$xhs+$map+$bz;
        }

        $redata=array('dy'=>$dys,'ks'=>$kss,'xhs'=>$xhss,'map'=>$maps,'bz'=>$bzs,'zongNum'=>$zong);
        return json_encode($redata);
    }
    //月获客
    public function echarts_2(){
         $store_id = session('store_id');
        $month =  date('m',time());
        $year = date('Y',time());
        $min = $year.'-'.$month.'-01 00:00:00';
        $max = $year.'-'.$month.'-31 23:59:59';
        $ks=1;
        $xhs=2;
        $bz=3;
        //$dy=Db::name('video_comment')->where(['store_id'=>$store_id])->count();
        $map=4;

        $dy=5;
        $redata=array(['value'=>$dy,'name'=>'抖音'],['value'=>$ks,'name'=>'快手'],['value'=>$xhs,'name'=>'小红薯'],['value'=>$map,'name'=>'地图'],['value'=>$bz,'name'=>'B站']);
        return json_encode($redata);
    }
    //抖音每日数据
    public function echart_3(){
        $store_id = session('store_id');
        $month =  date('m',time());
        $year = date('Y',time());
        $max_day = date("t",strtotime("$year"-"$month"));
        //$max_day = cal_days_in_month(CAL_GREGORIAN, $month, $year);   //当月最后一天
//构造每天的数组
        $days_arr = array();
        for($i=1;$i<=$max_day;$i++){
            array_push($days_arr, $i);
        }
        $return = [];
        $day = [];
//查询
        foreach ($days_arr as $val){
            $min = $year.'-'.$month.'-'.$val.' 00:00:00';
            $max = $year.'-'.$month.'-'.$val.' 23:59:59';

            $dy=123;
            $return[] = $dy;
            $day[] = $val;
        }
        $redata=array('data'=>$return,'dataDay'=>$day);
        return json_encode($redata);

    }
    //抖音线索用户
    public function dyuser(){
        $store_id = session('store_id');
        $dy=Db::name('video_comment')->alias('c')->field('c.userid,c.addtime,t.title')
            ->join('store_task t','c.task_id = t.id','left')->where(['store_id'=>$store_id])->select();
        return json_encode($dy);
    }
public function char4(){
        $store_id = session('store_id');
        $ks=1;
        $xhs=2;
        $bz=3;
        //$dy=Db::name('video_comment')->where(['store_id'=>$store_id])->count();

        $map=4;

        $dy=5;
        $data=array('快手','小红薯','B站','地图','抖音');
        $re=array($ks,$xhs,$bz,$map,$dy);

        $count=$ks+$xhs+++$bz+$map+$dy;
        $rezb=array(['value'=>round($ks/100,2),'name'=>'快手'],['value'=>round($xhs/100,2),'name'=>'小红薯'],['value'=>round($bz/100,2),'name'=>'B站'],['value'=>round($map/100,2),'name'=>'地图'],['value'=>round($dy/100,2),'name'=>'抖音']);
        $rezs=array(['value'=>$ks,'name'=>'快手'],['value'=>$xhs,'name'=>'小红薯'],['value'=>$bz,'name'=>'B站'],['value'=>$map,'name'=>'地图'],['value'=>$dy,'name'=>'抖音']);
        $redata=array('num'=>$data,'data'=>$re,'data1'=>$rezb,'data2'=>$rezs);
        return json_encode($redata);
}
    public function echart_2(){
        $store_id = session('store_id');

        $ks=Db::name('ks_video')->where(['store_id'=>$store_id,])->group('status')->count();
        $xhs=Db::name('xhs_note')->where(['store_id'=>$store_id,])->count();

        $bz=Db::name('bz_video')->where(['store_id'=>$store_id,])->count();
        //$dy=Db::name('video_comment')->where(['store_id'=>$store_id])->count();
        $mpid=Db::name('map_task')->where(['store_id'=>$store_id])->select();
        $mpids=[];
        foreach ($mpid as $mpitem){
            $mpids[]=$mpitem['id'];
        }
        $mpidz=implode($mpids,',');
        $map=Db::name('map_customer')->where('map_task_id',"in",$mpidz)->count();

        $dyid=Db::name('store_task')->where(['store_id'=>$store_id])->select();
        $dyids=[];
        foreach ($dyid as $dyitem){
            $dyids[]=$dyitem['id'];
        }
        $dyidz=implode($dyids,',');
        $dy=Db::name('task_video')->where('task_id',"in",$dyidz)->count();


        $data=array('快手','小红薯','B站','地图','抖音');
        $datas=array('视频资料数');


        $redata=array('data'=>$data,'datas'=>$datas,'datas1'=>[$ks,$xhs,$bz,$map,$dy],);
        return json_encode($redata);
    }
    /**
     * 管理员登录
     */
    public function login()
    {
        if(isMobile()){
            header("HTTP/1.1 301 Moved Permanently");
            Header("Location:/store/");exit;
        }
        $url = $this->request->get('url', 'index/index');

        if ($this->request->isPost()) {
            $username = $this->request->post('username');
            $password = $this->request->post('password');
            $token = $this->request->post('__token__');
            $rule = [
                'username'  => 'require|length:3,30',
                'password'  => 'require|length:3,30',
                // '__token__' => 'require|token',
            ];
            $data = [
                'username'  => $username,
                'password'  => $password,
                // '__token__' => $token,
            ];
            if (Config::get('fastadmin.login_captcha')) {
                $rule['captcha'] = 'require|captcha';
                $data['captcha'] = $this->request->post('captcha');
            }
            $validate = new Validate($rule, [], ['username' => __('Username'), 'password' => __('Password'), 'captcha' => __('Captcha')]);

            $password = md5($password);
            $store = Db::name('store')->where('status=1 and password="'.$password.'" and username="'.$username.'" and out_date>="'.date('Y-m-d').'"')->find();
            if(!$store){
                $this->error('账号密码错误或账号已过期', $url, ['token' => $this->request->token()]);
            }
            session('store_id',$store['id']);
            session('agent_id',$store['agent_id']);
            session('store_name',$store['store_name']);
            session('out_date',$store['out_date']);
            $sessionid = session_id();
            // Db::name('store')->where(['id'=>$store['id']])->update(['pc_session_id'=>$sessionid]);
            ///
            /// 中心








            $this->success(__('Login successful'), $url, ['url' => $url, 'id' => $store['id'], 'username' => $username, 'avatar' => '']);
        }

        // 根据客户端的cookie,判断是否可以自动登录
        // if (session('store_id')) {
        //     $this->redirect($url);
        // }
        $background = Config::get('site.login_image');
        $background = $background ? (stripos($background, 'http') === 0 ? $background : config('site.cdnurl') . $background) : '/assets/img/login_bg2.jpg';
        $this->view->assign('background', $background);

        $config = Config::get('site');
        $this->assign('beian',$config['beian']);

        // 域名贴牌
        $agent = Db::name('agent')->where(['agent_host'=>$_SERVER['HTTP_HOST']])->find();
        if($agent && $agent['tiepai_name']){
            $this->assign('beian',"");
        }

        $this->view->assign('title', '系统登录');
        Hook::listen("admin_login_init", $this->request);
        return $this->view->fetch();
    }

    /**
     * 退出登录
     */
    public function logout()
    {
        session('store_id',0);
        session('agent_id',0);
        session('store_name','');
        session('out_date','');
        $this->success(__('Logout successful'), 'index/login');
    }

}
