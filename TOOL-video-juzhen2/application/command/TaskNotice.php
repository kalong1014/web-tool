<?php
//declare (strict_types = 1);

namespace app\command;
use think\console\Command;
use think\console\Input;
use think\console\Output;
use app\admin\model\SucaiUser as SucaiUserModel;
use think\Db;

class TaskNotice extends Command
{
    protected function configure()
    {
        // 指令配置
        $this->setName('TaskNotice')->setDescription('the TaskNotice command');
    }

    protected function execute(Input $input, Output $output)
    {
        $api = Db::name('api')->where(array('id'=>1))->find();
        if(!$api['wx_appid'] || !$api['wx_appsecret']) {
            echo '未配置微信公众号';
        }
        $this->appid = $api['wx_appid'];
        $this->secret = $api['wx_appsecret'];
        $this->task_notice();
    }

    public function task_notice() {

        $where = [];
        $where['sended']= 0;
        $list = SucaiUserModel::alias('a')
            ->join('think_renwu b','a.pid = b.id')
            ->field('a.*,b.rwname,b.fabutime,b.user_id as admin_id')
            ->where($where)
            ->order('id DESC')
            ->select();
        $task_arr = [];
        foreach($list as $k=>$v) {
            SucaiUserModel::where(array('id'=>$v['id']))->update(['sended'=>1]);
            $user_ids = explode(",",$v['user_id']);
            foreach($user_ids as $k2=>$v2) {
                $quan = Db::name('quan')->field('id,nickname,openid')->where(array('id'=>$v2))->find();
                if($quan['openid']) {
                    $task = [];
                    $task['touser'] = $quan['openid'];
                    $task['touser_name'] = $quan['nickname'];
                    $task['rwname'] = $v['rwname'];
                    $task['fabutime'] = $v['fabutime'];
                    $task_arr[] = $task;
                }
            }
        }
        foreach($task_arr as $k=>$v) {
            $data = array(
                'first' => array('value' => '叮~ 您的账号'.$v['touser_name'].'有一条新的任务待发布'),
                'keyword1' => array('value' => $v['rwname']),
                'keyword2' => array('value' => '抖音视频'),
                'keyword3' => array('value' => '发布抖音视频任务'),
                'keyword4' => array('value' => date('Y-m-d H:i',$v['fabutime'])),
            );
            $url = 'https://ceoem.sddianfeng.cn/h5';
            $openid = $v['touser'];
            $template_id = 'vlL_H1aMgErbJqPVNoVy_QRoTkkhUD8QbJFuXtt7AMg';
            $this->sendTempMsg(1,$openid,$template_id,$url,'',$data);
        }

    }

    //获取access_token
    public function getAccessToken()
    {
        $access_token = cache('wxAccessToken');
        if (empty($access_token))
        {
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->appid."&secret=".$this->secret;
            $json_token = $this->http_request($url);
            $data = json_decode($json_token, true);
            //存入缓存 expires_in 时效
            cache('wxAccessToken', $data['access_token'], $data['expires_in']);
            $access_token = $data['access_token'];
        }
        return $access_token;
    }

    /**
     * 发送模板消息
     * 参考文档 https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Template_Message_Interface.html
     * @param   int         $type        消息模板类型 1:模板消息 2:订阅消息
     * @param   string         $openid
     * @param   integer        $template_id 模板ID
     * @param   string         $url         消息模板跳转url，可不填
     * @param   string         $color       主题字体颜色
     * @param   array          $data        模板数据
     * @return  string
     */
    public function sendTempMsg($type = 1, $openid, $template_id='', $url='', $color='', array $data)
    {
        $access_token = $this->getAccessToken();
        //模板消息
        $template_data = $this->_sendTempMsg($openid, $template_id, $url, $color, $data);
        //模板消息类型
        $type = ($type == 1) ? 'send' : 'subscribe';
        $url = "https://api.weixin.qq.com/cgi-bin/message/template/{$type}?access_token={$access_token}";
        $res = $this->http_request($url, $template_data);
        $res = json_decode($res, true);
        if ($res['errcode']==0) {
            echo $openid.'发送成功';
        }
        else {
            //失败返回错误信息
            echo $openid.'发送失败';
        }
    }

    private function _sendTempMsg($openid, $template_id, $url, $color, $data)
    {
        //模板消息
        $template_data = [
            'touser'=> $openid, //用户openid
            'template_id'=>$template_id, //在公众号下配置的模板id
            'url'=>$url, //点击模板消息会跳转的链接
            'color'=>$color,//消息字体颜色，不填默认为黑色
            'appid'=>$this->appid,
            'data'=>$data,
        ];
        $template_data = json_encode($template_data);
        return $template_data;
    }

    //请求
    private function http_request($url, $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }

}
