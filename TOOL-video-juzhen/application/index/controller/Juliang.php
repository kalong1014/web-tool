<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use think\Db;
use think\Cache;

class Juliang extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = '';

    protected $client_key = QIYE_CLIENT_KEY;
    protected $client_secret = QIYE_CLIENT_SECRET;

    public function get_token(){
        $auth_code = input('auth_code','');
        $url = 'https://ad.oceanengine.com/open_api/oauth2/access_token/';
        $params = ['app_id'=>'1732968543655940','secret'=>'1e437ca6c3e53964433920965038b4141784f779','grant_type'=>'auth_code'];
        if($auth_code){
            $params['auth_code'] = $auth_code;
        }
        $headers = ['Content-Type'=>'application/json'];
        $res = dcurl($url,'POST',$params,$headers);
        file_put_contents('/www/wwwroot/weike/public/1.txt', $res, FILE_APPEND);

    }

   // 回调
    public function douyin_redirect(){
        // var_dump($_REQUEST);exit;
        $store_id = input('store_id',0);
        $code = input('code',0);

        $params['client_key'] = $this->client_key;
        $params['client_secret'] = $this->client_secret;

        $params['grant_type'] = 'authorization_code';
        
        $params['code'] = $code;

        $open_host = 'https://open.douyin.com/';

        $res = dcurl($open_host.'oauth/access_token/','POST',$params);
        // var_dump($res);exit;
        $res_json = json_decode($res,1);
        if($res_json){
            if(@$res_json['data']['error_code']!=0){
                echo '<p style="margin-top:40px;text-align:center;font-size:30px;color:#000;">'.$res_json['data']['description'].'</p>';exit;
            }else{

                $user_params['open_id'] = $res_json['data']['open_id'];
                $user_params['access_token'] = $res_json['data']['access_token'];
                $user_params['refresh_token'] = $res_json['data']['refresh_token'];
                $expires_in = $res_json['data']['expires_in'] + time();
                $refresh_expires_in = $res_json['data']['refresh_expires_in'] + time();
                // 检查用户
                $has_user = Db::name('qiye_user')->where(['store_id'=>$store_id,'openid'=>$user_params['open_id']])->value('id');
                if($has_user){   
                    Db::name('qiye_user')->where(['id'=>$has_user])->update(['access_token'=>$user_params['access_token'],'refresh_out_time'=>date('Y-m-d H:i:s',$refresh_expires_in),'refresh_token'=>$user_params['refresh_token'],'token_out_time'=>date('Y-m-d H:i:s',$expires_in),'status'=>1]);
                    echo '<p style="margin-top:40px;text-align:center;font-size:30px;color:#000;">绑定更新成功</p>';exit;
                }
                
                $user_res = dcurl($open_host.'oauth/userinfo/','GET',$user_params);
                $user_arr = json_decode($user_res,1);
                if($user_arr){
                    if(@$user_arr['data']['error_code']!=0){
                        echo '<p style="margin-top:40px;text-align:center;font-size:30px;color:#000;">'.$user_arr['data']['description'].'</p>';exit;
                    }
                    // 获取用户信息
                    if(!in_array($user_arr['data']['e_account_role'],['EAccountM','EAccountS','EAccountK'])){
                        echo '<p style="margin-top:40px;text-align:center;font-size:30px;color:#000;">请使用企业号扫码绑定</p>';exit;
                    }
                    $data = ['nickname'=>$user_arr['data']['nickname'],'head'=>$user_arr['data']['avatar'],'openid'=>$user_arr['data']['open_id'],'access_token'=>$user_params['access_token'],'refresh_out_time'=>date('Y-m-d H:i:s',$refresh_expires_in),'refresh_token'=>$user_params['refresh_token'],'token_out_time'=>date('Y-m-d H:i:s',$expires_in),'store_id'=>$store_id,'addtime'=>date('Y-m-d H:i:s')];
                    $res = Db::name('qiye_user')->insert($data);
                    if($res){   
                        echo '<p style="margin-top:40px;text-align:center;font-size:30px;color:#000;">绑定成功</p>';exit;
                    }else{
                        echo '<p style="margin-top:40px;text-align:center;font-size:30px;color:#000;">绑定用户失败</p>';exit;
                    }
                }else{
                    echo '<p style="margin-top:40px;text-align:center;font-size:30px;color:#000;">用户信息获取失败</p>';exit;
                }
            }
        }else{
            echo '<p style="margin-top:40px;text-align:center;font-size:30px;color:#000;">抖音授权失败</p>';exit;
        }
    }

}
