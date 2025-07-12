<?php
declare (strict_types = 1);
namespace app\command;
use app\admin\lib\Douyin;
use app\admin\model\AccountChatModel;
use app\admin\model\AccountCustModel;
use app\admin\model\ReplyConfigModel;
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
class SendNotice extends Command
{

    //命令描述
    protected function configure()
    {
        $this->setName('SendNotice')->setDescription('the SendNotice command');
    }

    //所要执行的命令
    protected function execute(Input $input, Output $output)
    {
        $this->chat();
    }

    private function chat(){
        $chat_list = AccountChatModel::where(array('chat_auto'=>0,'to_type'=>2,'delete_time'=>0))->select();
        AccountChatModel::where(array('chat_auto'=>0,'to_type'=>2))->update(['chat_auto'=>1]);
        Db::startTrans();
        $time = time();
        try{
            foreach($chat_list as $k=>$v) {
                $account = Db::name('account')->field('id,nickname,open_id,access_token,member_id,customer_refresh_count,customer_refresh_time')->where(array('id'=>$v['account_id']))->find();
                if(!$account) {
                    continue;
                }
                $to_cust = AccountCustModel::where(array('open_id'=>$v['from_user_id']))->find();
                if(!$to_cust) {
                    continue;
                }
                $reply_arr = [];
                $reply_arr['content'] = $v['text'];
                $reply_arr['message_type'] = 'text';
                $chat_arr = $this->chat_hit($reply_arr,$account['open_id'],$v['from_user_id'],$account['access_token'],$account['member_id']);
                if(!$chat_arr) {
                    continue;
                }
                $save = [];
                $save['account_id'] = $account['id'];
                $save['to_user_id'] = $to_cust['open_id'];
                $save['to_cust_id'] = $to_cust['id'];
                $save['from_user_id'] = $account['open_id'];
                $save['from_cust_id'] = 0;
                $save['message_id'] = 0;
                $save['message_type'] = 'text';
                $save['text'] = $chat_arr['reply_content'];
                $save['to_type'] = 1;
                $save['create_time'] = time();
                $save['member_id'] = $account['member_id'];
                $id = AccountChatModel::insertGetId($save);
                if(!$id) {
                    continue;
                }
                $info = AccountChatModel::where(array('id'=>$id))->find();
                AccountCustModel::where(array('id'=>$to_cust['id']))->update(['last_chat_time'=>time()]);
                //记录到自动回复
                $reply_auto_add = [];
                $reply_auto_add['content'] = $v['text'];
                $reply_auto_add['keyword'] = $chat_arr['keyword'];
                $reply_auto_add['member_id'] = $account['member_id'];
                $reply_auto_add['account_id'] = $account['id'];
                $reply_auto_add['account_title'] = $account['nickname'];
                $reply_auto_add['reply_content'] = $chat_arr['reply_content'];
                $reply_auto_add['status'] = 1;
                $reply_auto_add['type'] = 2;
                $reply_auto_add['create_time'] = time();
                Db::name('account_reply_auto')->insert($reply_auto_add);

                //记录最后更新时间和次数
                Db::name('account')->where(array('id'=>$v['account_id']))->update(['customer_refresh_time'=>time(),'customer_refresh_count'=>$account['customer_refresh_count']+1]);
            }
            Db::commit();
            echo '已回复';
        }catch (\Exception $e){
            Db::rollback();
//            dump($e->getMessage());die;
            echo '回复失败';
        }
    }

    public function chat_hit($reply_arr=array(),$open_id=0,$to_user_id=0,$access_token='',$member_id=0) {
        if(!$open_id || !$to_user_id || !$access_token || !$member_id) {
            return false;
        }
        $content = $reply_arr['content'];
        $reply_config_list = ReplyConfigModel::where(array('type'=>2,'member_id'=>$member_id))->select();
        if(!$reply_config_list) {
            return false;
        }
        $list = [];
        foreach ($reply_config_list as $k=>$v) {
            $list[] = $v['keyword'];
        }
        $count = 0; //命中的个数
        $pattern = "/".implode("|",$list)."/i"; //定义正则表达式
        if(preg_match_all($pattern, $content, $matches)){ //匹配到了结果
            $patternList = $matches[0];  //匹配到的数组
            $count = count($patternList);
        }
        $reply_content = '';
        $keyword = '';
        if($count >= 1 && isset($patternList)) {
            $pattern_content = $patternList[0];
            foreach($reply_config_list as $k=>$v) {
                if($v['keyword'] == $pattern_content) {
                    $reply_content = $v['content'];
                    $keyword = $v['keyword'];
                }
            }
            $api = Db::name('api')->where(array('uid'=>1))->find();
            $this->dy = new Douyin(array(
                'client_key' =>  $api['qykey'],
                'client_secret' =>  $api['qysecret'],
            ));
            $cust_result = $this->dy->toCustomerChat(array(
                'openid' => $open_id,
                'access_token' => $access_token,
                'to_user_id' => $to_user_id,
                'content'=>$reply_content,
                'message_type' => $reply_arr['message_type'],
            ));
            if(!isset($cust_result['errcode']) || $cust_result['errcode'] > 0) {
                return false;
            }
        } else {
            return false;
        }
        $return =[];
        $return['keyword'] = $keyword;
        $return['reply_content'] = $reply_content;
        return $return;
    }

}