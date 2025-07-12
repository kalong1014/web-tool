<?php
/**
 * 净网云剑拦截查询
 */

namespace plugin\web\cqqgsafe;

use app\Plugin;
use Exception;

class App extends Plugin
{

    public function index()
    {
        return $this->view();
    }

    public function query(){
        $domain = input('post.domain', null, 'trim');
        $type = input('post.type');
        if(!$domain) return msg('error','no domain');

        $captcha_result = verify_captcha4();
        if($captcha_result !== true){
            return msg('error', '验证失败，请重新验证');
        }

        $url = 'https://wap.110.cqqgsafe.com/7J6zvmx8Y/search/index?kw='.urlencode($domain);
        $data = get_curl($url);
        $arr = json_decode($data, true);
        if(!$arr) throw new Exception('查询接口返回数据解析失败');
        if(isset($arr['code']) && $arr['code']==200) {
            $arr = $arr['data'];
            //print_r($arr);
            $msg['查询域名'] = $domain;
            $msg['查询结果'] = '<font color="red">'.$arr['cate_name'].'已拦截封禁</font>';
            $msg['平台名称'] = $arr['gov_name'];
            $msg['记录来源'] = $arr['source'];
            $msg['记录日期'] = $arr['date'];
            $msg['违规链接'] = $arr['url'];

        }else{
            $msg['查询域名'] = $domain;
            $msg['查询结果'] = '<font color="green">'.$arr['msg'].'</font>';
        }

        return msg('ok','success',$msg);
    }

}