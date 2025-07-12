<?php

namespace app\agentadmin\controller;

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

        $store_id = session('p_store_id');
        $agent_id = session('p_agent_id');
        $starttime = Date::unixtime('day', -10);
        $endtime = Date::unixtime('day', 0, 'end');
        $dates = [];
        for ($i=0; $i<=10; $i++){
            $dates[$i] = date('Y-m-d' ,strtotime( '+' . $i-10 .' days', time()));
        }
        foreach ($dates as $k => $v) {
            $index_task_date[] =  '"'.date('m-d',strtotime($v)).'"';
            $index_task_num = Db::name("video_comment")->alias('vc')
                ->join('store_task st','st.id = vc.task_id')
                ->where('DATE_FORMAT(vc.addtime, "%Y-%m-%d")='.$v)->where('st.store_id',"in",$store_id)->count();
            $map_task_num = Db::name('map_customer')->alias('c')
                ->join('map_task st','st.id = c.map_task_id')
                ->where('DATE_FORMAT(c.addtime, "%Y-%m-%d")='.$v)->where('st.store_id',"in",$store_id)->count();
            $xhs_task_num = Db::name("xhs_comment")->alias('vc')
                ->join('xhs_task st','st.id = vc.task_id')
                ->where('DATE_FORMAT(vc.addtime, "%Y-%m-%d")='.$v)->where('st.store_id',"in",$store_id)->count();
            $ks_task_num = Db::name("ks_comment")->alias('vc')
                ->join('ks_task st','st.id = vc.task_id')
                ->where('DATE_FORMAT(vc.addtime, "%Y-%m-%d")='.$v)->where('st.store_id',"in",$store_id)->count();
            $index_task_count[] =  $index_task_num + $map_task_num + $xhs_task_num + $ks_task_num;
        }
        $index_task_date = implode(',', $index_task_date);
        $index_task_count = implode(',', $index_task_count);
        // 客户提取列表
        $user_list = Db::name('video_comment')->alias('vc')->field('vc.id,st.url,vc.comment,vc.addtime,vc.userid,st.title')
            ->join('store_task st','st.id = vc.task_id')
            ->where('store_id',"in",$store_id)
            ->order('vc.id desc')->limit(100)
            ->select();
        if($user_list){
            foreach ($user_list as $key => $value) {
                $user_list[$key]['userid'] =  mb_substr($value['userid'], 0, 3, 'utf-8').'****'.mb_substr($value['userid'], -1, 3, 'utf-8');
            }
        }

        // 充值统计
        $store_info = Db::name('store')->where('id',"in",$store_id)->find();
        $all_price = Db::name("store_pay")->where('store_id',"in",$store_id)->where(['status'=>1])->sum('price');
        $use_price = Db::name('video_comment')->alias('vc')
                ->join('store_task st','st.id = vc.task_id')
                ->where('st.store_id',"in",$store_id)
                ->count()
            + Db::name('map_customer')->alias('c')
                ->join('map_task st','st.id = c.map_task_id')
                ->where('st.store_id',"in",$store_id)->count()
            + Db::name('xhs_comment')->alias('vc')
                ->join('xhs_task st','st.id = vc.task_id')
                ->where('st.store_id',"in",$store_id)
                ->count()
            + Db::name('ks_comment')->alias('vc')
                ->join('ks_task st','st.id = vc.task_id')
                ->where('st.store_id',"in",$store_id)
                ->count();

        $today = date('Y-m-d');
        $dbTableList = Db::query("SHOW TABLE STATUS");
        $return=array(
            'index_task'      => Db::name('store_task')->where(['mode'=>1,'show_status'=>1])->where('store_id',"in",$store_id)->count(),
            'video_task'      => Db::name('store_task')->where(['mode'=>2,'show_status'=>1])->where('store_id',"in",$store_id)->count(),
            'key_task'      => Db::name('store_task')->where(['mode'=>3,'show_status'=>1])->where('store_id',"in",$store_id)->count() + Db::name('xhs_task')->where('store_id',"in",$store_id)->count() + Db::name('ks_task')->where('store_id',"in",$store_id)->count(),
            'run_task'      => Db::name('store_task')->where(['status'=>1,'show_status'=>1])->where('store_id',"in",$store_id)->count() + Db::name('map_task')->where(['status'=>1])->where('store_id',"in",$store_id)->count() + Db::name('xhs_task')->where(['status'=>1])->where('store_id',"in",$store_id)->count() + Db::name('ks_task')->where(['status'=>1])->where('store_id',"in",$store_id)->count(),
            'all_task'      => Db::name('store_task')->where('store_id',"in",$store_id)->where(['show_status'=>1])->count() + Db::name('map_task')->where('store_id',"in",$store_id)->count() + Db::name('xhs_task')->where('store_id',"in",$store_id)->count() + Db::name('ks_task')->where('store_id',"in",$store_id)->count(),
            'all_video'      => Db::name('task_video')->alias('tc')
                    ->join('store_task st','st.id = tc.task_id')
                    ->where(['tc.is_show'=>1,'st.show_status'=>1])->where('st.store_id',"in",$store_id)->count()
                + Db::name('xhs_note')->alias('tc')
                    ->join('xhs_task st','st.id = tc.task_id')
                    ->where('st.store_id',"in",$store_id)->count()
                + Db::name('ks_video')->alias('tc')
                    ->join('ks_task st','st.id = tc.task_id')
                    ->where('st.store_id',"in",$store_id)->count(),
            'all_comment'      => Db::name('video_comment')->alias('vc')
                    ->join('store_task st','st.id = vc.task_id')
                    ->where('st.store_id',"in",$store_id)->count()
                + Db::name('map_customer')->alias('c')
                    ->join('map_task st','st.id = c.map_task_id')
                    ->where('st.store_id',"in",$store_id)->count()
                + Db::name('xhs_comment')->alias('vc')
                    ->join('xhs_task st','st.id = vc.task_id')
                    ->where('st.store_id',"in",$store_id)->count()
                + Db::name('ks_comment')->alias('vc')
                    ->join('ks_task st','st.id = vc.task_id')
                    ->where('st.store_id',"in",$store_id)->count(),
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
        $zong=Db::name('store_pay')->where('store_id',"in",$store_id)->sum('price');
        $zongy=Db::name('store_pay')->where('store_id',"in",$store_id)->whereTime('addtime', 'between', [$miny, $maxy])->sum('price');
        $zongm=Db::name('store_pay')->where('store_id',"in",$store_id)->whereTime('addtime', 'between', [$minm, $maxm])->sum('price');
        $zongd=Db::name('store_pay')->where('store_id',"in",$store_id)->whereTime('addtime', 'between', [$mind, $maxd])->sum('price');
        $return['zong']=$zong;
        $return['zongy']=$zongy;
        $return['zongm']=$zongm;
        $return['zongd']=$zongd;
        $return['days']=$days;
        $dy1=Db::name('store_task')->where('store_id',"in",$store_id)->where(['status'=>'0'])->count();
        $dy2=Db::name('store_task')->where('store_id',"in",$store_id)->where(['status'=>'1'])->count();
        $dy3=Db::name('store_task')->where('store_id',"in",$store_id)->where(['status'=>'2'])->count();
        $xhs1=Db::name('xhs_task')->where('store_id',"in",$store_id)->where(['status'=>'0'])->count();
        $xhs2=Db::name('xhs_task')->where('store_id',"in",$store_id)->where(['status'=>'1'])->count();
        $xhs3=Db::name('xhs_task')->where('store_id',"in",$store_id)->where(['status'=>'2'])->count();
        $bz1=Db::name('bz_task')->where('store_id',"in",$store_id)->where(['status'=>'0'])->count();
        $bz2=Db::name('bz_task')->where('store_id',"in",$store_id)->where(['status'=>'1'])->count();
        $bz3=Db::name('bz_task')->where('store_id',"in",$store_id)->where(['status'=>'2'])->count();
        $ks1=Db::name('ks_task')->where('store_id',"in",$store_id)->where(['status'=>'0'])->count();
        $ks2=Db::name('ks_task')->where('store_id',"in",$store_id)->where(['status'=>'1'])->count();
        $ks3=Db::name('ks_task')->where('store_id',"in",$store_id)->where(['status'=>'2'])->count();
        $map1=Db::name('map_task')->where('store_id',"in",$store_id)->where(['status'=>'3'])->count();
        $map2=Db::name('map_task')->where('store_id',"in",$store_id)->where(['status'=>'1'])->count();
        $map3=Db::name('map_task')->where('store_id',"in",$store_id)->where(['status'=>'2'])->count();
        $zan=$dy1+$xhs1+$bz1+$ks1+$map1;
        $jin=$dy2+$xhs2+$bz2+$ks2+$map2;
        $wan=$dy3+$xhs3+$bz3+$ks3+$map3;
        if($wan>0){
            $wancheng=round($wan/($zan+$jin+$wan),1).'%';
        }else{
            $wancheng='0.0%';
        }
        $return['zan']=$zan;
        $return['jin']=$jin;
        $return['wan']=$wan;
        $return['lv']=$wancheng;
        //商戶
        $store_count = Db::name('store')->where(['agent_id'=>$agent_id,'status'=>1])->count();
        //代理
        $agent_count = Db::name('agent')->where(['agent_pid'=>$agent_id,'status'=>1])->count();
        //下级代理商户
        $agent_store_count = Db::name('store')->alias('s')
            ->join('agent a','a.id = s.agent_id')
            ->where(['a.agent_pid'=>$agent_id,'s.status'=>1])
            ->count();
        //佣金
        $all_commission = Db::name('agent_commission')->where(['agent_id'=>$agent_id,'status'=>1])->sum('commission');
        // 商家总充值
        $all_price = Db::name('store_pay')->alias('sp')
            ->join('store s','s.id = sp.store_id')
            ->where(['s.agent_id'=>$agent_id,'sp.status'=>1])
            ->sum('sp.price');
        //今日種植
        $today_price = Db::name('store_pay')->alias('sp')
            ->join('store s','s.id = sp.store_id')
            ->where(['s.agent_id'=>$agent_id,'sp.status'=>1])
            ->where('DATE_FORMAT(sp.addtime,"%Y-%m-%d")="'.date('Y-m-d').'"')
            ->sum('sp.price');
        //下級充值
        $agent_all_price = Db::name('store_pay')->alias('sp')
            ->join('store s','s.id = sp.store_id')
            ->join('agent a','a.id = s.agent_id')
            ->where(['a.agent_pid'=>$agent_id,'sp.status'=>1])
            ->sum('sp.price');
        //剩餘點數
        $agent = Db::name('agent')->where(['id'=>$agent_id,'status'=>1])->find();
        if(empty($agent)){
            header('Location:index/login');exit;
        }
        $return['store_count']=$store_count;
        $return['agent_count']=$agent_count;
        $return['all_commission']=$all_commission;
        $return['all_price']=$all_price;
        $return['today_price']=$today_price;
        $return['agent_all_price']=$agent_all_price;
        $return['agent_store_count']=$agent_store_count;
        $return['dianshu']=$agent['dianshu'];
        return json_encode($return,true);

    }
    //年获客
    public function echarts_4(){
         $store_id = session('p_store_id');
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
            $ks=Db::name('ks_comment')->where('store_id',"in",$store_id)->whereTime('addtime', 'between', [$min, $max])->count();
            $xhs=Db::name('xhs_comment')->where('store_id',"in",$store_id)->whereTime('addtime', 'between', [$min, $max])->count();
            $bz=Db::name('bz_comment')->where('store_id',"in",$store_id)->whereTime('addtime', 'between', [$min, $max])->count();
            //$dy=Db::name('video_comment')->where(['store_id'=>$store_id])->count();
            $mapid=Db::name('map_task')->where('store_id',"in",$store_id)->select();
            $mapids=[];
            $dyids=[];
            foreach ($mapid as $item){
                $mapids[]=$item['id'];
            }
            $mapidz=implode(',',$mapids);
            $map=Db::name('map_customer')->where('map_task_id',"in",$mapidz)->whereTime('addtime', 'between', [$min, $max])->count();
            $dyid=Db::name('store_task')->where('store_id',"in",$store_id)->select();
            $dyids=[];
            foreach ($dyid as $dyitem){
                $dyids[]=$dyitem['id'];
            }
            $dyidz=implode(',',$dyids);
            $dy=Db::name('video_comment')->where('task_id',"in",$dyidz)->whereTime('addtime', 'between', [$min, $max])->count();
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
         $store_id = session('p_store_id');
        $month =  date('m',time());
        $year = date('Y',time());
        $min = $year.'-'.$month.'-01 00:00:00';
        $max = $year.'-'.$month.'-31 23:59:59';
        $ks=Db::name('ks_comment')->where('store_id',"in",$store_id)->whereTime('addtime', 'between', [$min, $max])->count();
        $xhs=Db::name('xhs_comment')->where('store_id',"in",$store_id)->whereTime('addtime', 'between', [$min, $max])->count();
        $bz=Db::name('bz_comment')->where('store_id',"in",$store_id)->whereTime('addtime', 'between', [$min, $max])->count();
        //$dy=Db::name('video_comment')->where(['store_id'=>$store_id])->count();
        $mapid=Db::name('map_task')->where('store_id',"in",$store_id)->select();
        $mapids=[];
        $dyids=[];
        foreach ($mapid as $item){
            $mapids[]=$item['id'];
        }
        $mapidz=implode(',',$mapids);
        $map=Db::name('map_customer')->where('map_task_id',"in",$mapidz)->whereTime('addtime', 'between', [$min, $max])->count();
        $dyid=Db::name('store_task')->where('store_id',"in",$store_id)->select();
        $dyids=[];
        foreach ($dyid as $dyitem){
            $dyids[]=$dyitem['id'];
        }
        $dyidz=implode(',',$dyids);
        $dy=Db::name('video_comment')->where('task_id',"in",$dyidz)->whereTime('addtime', 'between', [$min, $max])->count();
        $redata=array(['value'=>$dy,'name'=>'抖音'],['value'=>$ks,'name'=>'快手'],['value'=>$xhs,'name'=>'小红薯'],['value'=>$map,'name'=>'地图'],['value'=>$bz,'name'=>'B站']);
        return json_encode($redata);
    }
    //抖音每日数据
    public function echart_3(){
       $store_id = session('p_store_id');
        $month =  date('m',time());
        $year = date('Y',time());
        $max_day = date("t",strtotime("$year'-'$month"));
//当月最后一天
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
            $dyid=Db::name('store_task')->where('store_id',"in",$store_id)->select();
            $dyids=[];
            foreach ($dyid as $dyitem){
                $dyids[]=$dyitem['id'];
            }
            $dyidz=implode(',',$dyids);
            $dy=Db::name('video_comment')->where('task_id',"in",$dyidz)->whereTime('addtime', 'between', [$min, $max])->count();
            $return[] = $dy;
            $day[] = $val;
        }
        $redata=array('data'=>$return,'dataDay'=>$day);
        return json_encode($redata);

    }
    //抖音线索用户
    public function dyuser(){
        $store_id = session('p_store_id');
        $dy=Db::name('video_comment')->alias('c')->field('c.userid,c.addtime,t.title')
            ->join('store_task t','c.task_id = t.id','left')->where('store_id',"in",$store_id)->select();
        return json_encode($dy);
    }
public function char4(){
        $store_id = session('p_store_id');
        $ks=Db::name('ks_comment')->where('store_id',"in",$store_id)->count();
        $xhs=Db::name('xhs_comment')->where('store_id',"in",$store_id)->count();
        $bz=Db::name('bz_comment')->where('store_id',"in",$store_id)->count();
        //$dy=Db::name('video_comment')->where(['store_id'=>$store_id])->count();
        $mapid=Db::name('map_task')->where('store_id',"in",$store_id)->select();
        $mapids=[];
        $dyids=[];
        foreach ($mapid as $item){
            $mapids[]=$item['id'];
        }
        $mapidz=implode(',',$mapids);
        $map=Db::name('map_customer')->where('map_task_id',"in",$mapidz)->count();
        $dyid=Db::name('store_task')->where('store_id',"in",$store_id)->select();
        $dyids=[];
        foreach ($dyid as $dyitem){
           $dyids[]=$dyitem['id'];
         }
        $dyidz=implode(',',$dyids);
        $dy=Db::name('video_comment')->where('task_id',"in",$dyidz)->count();
        $data=array('快手','小红薯','B站','地图','抖音');
        $re=array($ks,$xhs,$bz,$map,$dy);

        $count=$ks+$xhs+++$bz+$map+$dy;
        $rezb=array(['value'=>round($ks/100,2),'name'=>'快手'],['value'=>round($xhs/100,2),'name'=>'小红薯'],['value'=>round($bz/100,2),'name'=>'B站'],['value'=>round($map/100,2),'name'=>'地图'],['value'=>round($dy/100,2),'name'=>'抖音']);
        $rezs=array(['value'=>$ks,'name'=>'快手'],['value'=>$xhs,'name'=>'小红薯'],['value'=>$bz,'name'=>'B站'],['value'=>$map,'name'=>'地图'],['value'=>$dy,'name'=>'抖音']);
        $redata=array('num'=>$data,'data'=>$re,'data1'=>$rezb,'data2'=>$rezs);
        return json_encode($redata);
}
    public function echart_2(){
        $store_id = session('p_store_id');

        $ks=Db::name('ks_video')->where('store_id',"in",$store_id)->group('status')->count();
        $xhs=Db::name('xhs_note')->where('store_id',"in",$store_id)->count();

        $bz=Db::name('bz_video')->where('store_id',"in",$store_id)->count();
        //$dy=Db::name('video_comment')->where(['store_id'=>$store_id])->count();
        $mpid=Db::name('map_task')->where('store_id',"in",$store_id)->select();
        $mpids=[];
        foreach ($mpid as $mpitem){
            $mpids[]=$mpitem['id'];
        }
        $mpidz=implode(',',$mpids);
        $map=Db::name('map_customer')->where('map_task_id',"in",$mpidz)->count();

        $dyid=Db::name('store_task')->where('store_id',"in",$store_id)->select();
        $dyids=[];
        foreach ($dyid as $dyitem){
            $dyids[]=$dyitem['id'];
        }
        $dyidz=implode(',',$dyids);
        $dy=Db::name('task_video')->where('task_id',"in",$dyidz)->count();


        $data=array('快手','小红薯','B站','地图','抖音');
        $datas=array('视频资料数');


        $redata=array('data'=>$data,'datas'=>$datas,'datas1'=>[$ks,$xhs,$bz,$map,$dy],);
        return json_encode($redata);
    }

}
