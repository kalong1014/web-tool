<?php
declare (strict_types = 1);
namespace app\command;
use app\admin\lib\Douyin;
use app\admin\model\MemberKeywordsLogModel;
use app\admin\model\MemberKeywordsModel;
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
class SearchKeyword extends Command
{

    //命令描述
    protected function configure()
    {
        $this->setName('SearchKeyword')->setDescription('the SearchKeyword command');
    }

    //所要执行的命令
    protected function execute(Input $input, Output $output)
    {
        $this->search();
    }

    private function search(){
       
        $where = [];
        $where['status'] = ['=',1];
        $where['delete_time'] = ['=',0];
        $keywords_list = Db::name('member_keywords')->field('keyword,keyword_id,member_id,type,video_link,price,up_day,up_last_time')->where($where)->select();
        $error = 0;
        foreach($keywords_list as $k=>$v) {
            $send = [];
            $send['appid'] = '20220620134517982';
            $send['id'] = $v['keyword_id'];
            $send['token'] = $this->token(14);
            $send['timestamp'] = time();
            $send['sign'] = $this->makeSignature($send,'V4SK80TJR15S9H40');
            $url = "http://query.17s.cn/api/get.html";
            $result = $this->curlPost($url,$send);
            $result = json_decode($result,true);
            if($result['code'] <> 1) {
                continue;
            }
            $rank = 999;
            if(isset($result['newRank']) && $result['newRank'] > 0) {
                $rank = $result['newRank'];
            }
            $keywords_arr_log_one = $keywords_list[$k];
            $keywords_arr_log_one['rank'] = $rank;
            $keywords_arr_log_one['create_time'] = time();
            $keywords_arr_log_one['up_day'] = $v['up_day'];
            $keywords_arr_log_one['up_last_time'] = $v['up_last_time'];
            $status = MemberKeywordsLogModel::insert($keywords_arr_log_one);
            if(!$status) {
                $error += 1;
            }
        }
        MemberKeywordsModel::where($where)->inc('search_count', 1)->update();
        MemberKeywordsModel::where($where)->update(['update_time'=>time()]);
        if($error > 0) {
            echo '===========查询中出现错误个数:'.$error.'===========';
            echo '<br>';
        }
        echo '查询完毕====='.date('Y-m-d H:i:s',time());
    }

    public function makeSignature($args, $key = '')
    {
        if(isset($args['sign'])) {
            $oldSign = $args['sign'];
            unset($args['sign']);     //剔除post数据sign
        } else {
            $oldSign = '';
        }
        ksort($args);                 //参数按照key进行升序排序
        $requestString = '';
        foreach($args as $k => $v) {
            if(is_numeric($v)) {
                $requestString .= $k . '=' . $v;     //参数链接成字符串
            } else {
                $requestString .= $k . '=' . urlencode($v);     //参数链接成字符串
            }
        }
        $newSign = hash_hmac("md5",strtolower($requestString) , $key);  // hash_hmac 加密转换为小写的参数字符串

        return $newSign;
    }

    public function token($length = 32) {
        // Create random token
        $string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

        $max = strlen($string) - 1;

        $token = '';

        for ($i = 0; $i < $length; $i++) {
            $token .= $string[mt_rand(0, $max)];
        }

        return $token;
    }

    public function curlPost($url,$data=""){
        $ch = curl_init();
        $opt = array(
            CURLOPT_URL     => $url,
            CURLOPT_HEADER  => 0,
            CURLOPT_POST    => 1,
            CURLOPT_POSTFIELDS      => $data,
            CURLOPT_RETURNTRANSFER  => 1,
            CURLOPT_TIMEOUT         => 20
        );
        $ssl = substr($url,0,8) == "https://" ? TRUE : FALSE;
        if ($ssl){
            $opt[CURLOPT_SSL_VERIFYHOST] = 2;
            $opt[CURLOPT_SSL_VERIFYPEER] = FALSE;
        }
        curl_setopt_array($ch,$opt);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

}