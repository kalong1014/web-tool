<?php
declare (strict_types = 1);
namespace app\command;
use app\admin\lib\Douyin;
use app\admin\model\AccountModel;
use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;
/**
 *
 * 1分钟执行一次
 * Class Autominute
 * @package app\common\command
 */
class Refresh extends Command
{

    //命令描述
    protected function configure()
    {
        $this->setName('Refresh')->setDescription('the Refresh command');
    }

    //所要执行的命令
    protected function execute(Input $input, Output $output)
    {
        $this->refresh_token();
        $this->access_token();
    }

    private function refresh_token(){
        //找到在明天过期的抖音号
        $start_time = time();
        $end_time = time()+86400;
        $where = [];
        $where['refresh_token_time'] = ['between',[$start_time,$end_time]];
        $list = AccountModel::where($where)->select();
        $error_msg = '';
        foreach($list as $k=>$v) {
            $api = Db::name('api')->where(array('uid'=>1))->find();
            $this->dy = new Douyin(array(
                'client_key' =>  $api['qykey'],
                'client_secret' =>  $api['qysecret'],
            ));
            $re_result = $this->dy->refreshAccessToken($v['refresh_token']);
            if(!isset($re_result['errcode']) || $re_result['errcode'] > 0) {
                $error_msg .= $v['nickname'].'|';
                continue;
            }
            $save = [];
            $save['refresh_token'] = $re_result['data']['refresh_token'];
            $save['refresh_token_time'] = time()+$re_result['data']['expires_in'];
            $status = AccountModel::where(array('id'=>$v['id']))->update($save);
            if(!$status) {
                $error_msg .= $v['nickname'].'|';
            }
        }
        if($error_msg) {
            echo 'refresh_token失败账号:'.$error_msg;
        }
    }

    private function access_token(){
        //找到在明天过期的抖音号
        $start_time = time();
        $end_time = time()+86400;
        $where = [];
        $where['access_token_time'] = ['between',[$start_time,$end_time]];
        $list = AccountModel::where($where)->select();
        $error_msg = '';
        foreach($list as $k=>$v) {
            $api = Db::name('api')->where(array('uid'=>1))->find();
            $this->dy = new Douyin(array(
                'client_key' =>  $api['qykey'],
                'client_secret' =>  $api['qysecret'],
            ));
            $re_result = $this->dy->reAccessToken($v['refresh_token']);
            if(!isset($re_result['errcode']) || $re_result['errcode'] > 0) {
                $error_msg .= $v['nickname'].'|';
                continue;
            }
            $save = [];
            $save['access_token'] = $re_result['data']['access_token'];
            $save['access_token_time'] = time()+$re_result['data']['expires_in'];
            $save['refresh_token'] = $re_result['data']['refresh_token'];
            $save['refresh_token_time'] = time()+$re_result['data']['refresh_expires_in'];
            $status = AccountModel::where(array('id'=>$v['id']))->update($save);
            if(!$status) {
                $error_msg .= $v['nickname'].'|';
            }
        }
        if($error_msg) {
            echo 'access_token失败账号:'.$error_msg;
        }
    }

}