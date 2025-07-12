<?php 
namespace fast;
use think\Db;
use think\Config;
use think\Cache;

class Wechat
{
    protected $mchid;
    protected $appid;
    protected $appKey;
    protected $apiKey;
    public $data = null;
 
    public function __construct($pay_appid="",$pay_appkey="")
    {
        $config = Config::get('site');
        // $this->mchid = $config['pay_mchid']; //https://pay.weixin.qq.com 产品中心-开发配置-商户号
        $this->appid = $pay_appid ? $pay_appid : $config['pay_appid']; //微信支付申请对应的公众号的APPID
        $this->appKey = $pay_appkey ? $pay_appkey : $config['pay_appkey']; //微信支付申请对应的公众号的APP Key
        // $this->apiKey = $config['pay_apikey']; //https://pay.weixin.qq.com 帐户设置-安全设置-API安全-API密钥-设置API密钥
    }


 
    /**
    * 通过跳转获取用户的openid，跳转流程如下：
    * 1、设置自己需要调回的url及其其他参数，跳转到微信服务器https://open.weixin.qq.com/connect/oauth2/authorize
    * 2、微信服务处理完成之后会跳转回用户redirect_uri地址，此时会带上一些参数，如：code
    * @return 用户的openid
    */
    public function GetOpenid()
    {
        //通过code获得openid
        if (!isset($_GET['code'])){
            //触发微信返回code码
            $scheme = $_SERVER['SERVER_PORT']=='443' ? 'https://' : 'http://';
            $baseUrl = urlencode($scheme.$_SERVER['HTTP_HOST'].'/store/index/index');
            $url = $this->__CreateOauthUrlForCode($baseUrl);
            Header("Location: $url");
            exit();
        } else {
            //获取code码，以获取openid
            $code = $_GET['code'];
            $openid = $this->getOpenidFromMp($code);
            return $openid;
        }
    }
 
    /**
    * 通过code从工作平台获取openid机器access_token
    * @param string $code 微信跳转回来带上的code
    * @return openid
    */
    public function GetOpenidFromMp($code)
    {
        $url = $this->__CreateOauthUrlForOpenid($code);
        $res = self::curlGet($url);
        //取出openid
        $data = json_decode($res,true);
        $this->data = $data;
        $openid = $data['openid'];
        // https://api.weixin.qq.com/sns/userinfo?access_token=ACCESS_TOKEN&openid=OPENID&lang=zh_CN
        return $openid;
    }

    /**
    * 通过code从工作平台获取openid机器access_token
    * @param string $code 微信跳转回来带上的code
    * @return openid
    */
    public function GetOpenidFromCode($code)
    {
        $url = $this->__CreateOauthUrlForOpenid($code);
        $res = self::curlGet($url);
        $data = json_decode($res,true);
        return $data;
    }

    public function GetUserInfo($accessToken,$open_id)
    {
        $url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$accessToken.'&openid='.$open_id.'&lang=zh_CN';
        $res = self::curlGet($url);
        $data = json_decode($res,true);
        return $data;
    }
 
    /**
    * 构造获取open和access_toke的url地址
    * @param string $code，微信跳转带回的code
    * @return 请求的url
    */
    private function __CreateOauthUrlForOpenid($code)
    {
        $urlObj["appid"] = $this->appid;
        $urlObj["secret"] = $this->appKey;
        $urlObj["code"] = $code;
        $urlObj["grant_type"] = "authorization_code";
        $bizString = $this->ToUrlParams($urlObj);
        return "https://api.weixin.qq.com/sns/oauth2/access_token?".$bizString;
    }
 
    /**
    * 构造获取code的url连接
    * @param string $redirectUrl 微信服务器回跳的url，需要url编码
    * @return 返回构造好的url
    */
    private function __CreateOauthUrlForCode($redirectUrl)
    {
        $urlObj["appid"] = $this->appid;
        $urlObj["redirect_uri"] = "$redirectUrl";
        $urlObj["response_type"] = "code";
        $urlObj["scope"] = "snsapi_base";
        $urlObj["state"] = "STATE"."#wechat_redirect";
        $bizString = $this->ToUrlParams($urlObj);
        return "https://open.weixin.qq.com/connect/oauth2/authorize?".$bizString;
    }
 
    /**
    * 拼接签名字符串
    * @param array $urlObj
    * @return 返回已经拼接好的字符串
    */
    private function ToUrlParams($urlObj)
    {
        $buff = "";
        foreach ($urlObj as $k => $v)
        {
            if($k != "sign") $buff .= $k . "=" . $v . "&";
        }
        $buff = trim($buff, "&");
        return $buff;
    }
 
    /**
    * 统一下单
    * @param string $openid 调用【网页授权获取用户信息】接口获取到用户在该公众号下的Openid
    * @param float $totalFee 收款总费用 单位元
    * @param string $outTradeNo 唯一的订单号
    * @param string $orderName 订单名称
    * @param string $notifyUrl 支付结果通知url 不要有问号
    * @param string $timestamp 支付时间
    * @return string
    */
    public function createJsBizPackage($openid, $totalFee, $outTradeNo, $orderName, $notifyUrl, $timestamp)
    {
        $config = array(
            'mch_id' => $this->mchid,
            'appid' => $this->appid,
            'key' => $this->apiKey,
        );
        // $orderName = iconv('GBK','UTF-8',$orderName);
        $unified = array(
            'appid' => $config['appid'],
            'attach' => 'pay',    //商家数据包，原样返回，如果填写中文，请注意转换为utf-8
            'body' => $orderName,
            'mch_id' => $config['mch_id'],
            'nonce_str' => self::createNonceStr(),
            'notify_url' => $notifyUrl,
            'openid' => $openid,   //rade_type=JSAPI，此参数必传
            'out_trade_no' => $outTradeNo,
            'spbill_create_ip' => $this->getip(),
            'total_fee' => intval($totalFee * 100),  //单位 转为分
            'trade_type' => 'JSAPI',
        );
        $unified['sign'] = self::getSign($unified, $config['key']);
        // var_dump($unified);exit;
        $responseXml = self::curlPost('https://api.mch.weixin.qq.com/pay/unifiedorder', self::arrayToXml($unified));
        $unifiedOrder = simplexml_load_string($responseXml, 'SimpleXMLElement', LIBXML_NOCDATA);
        if ($unifiedOrder === false) {
            die('parse xml error');
        }
        if ($unifiedOrder->return_code != 'SUCCESS') {
            die($unifiedOrder->return_msg);
        }
        if ($unifiedOrder->result_code != 'SUCCESS') {
            die($unifiedOrder->err_code);
        }
        $arr = array(
            "appId" => $config['appid'],
            "timeStamp" => "$timestamp",  //这里是字符串的时间戳，不是int，所以需加引号
            "nonceStr" => self::createNonceStr(),
            "package" => "prepay_id=" . $unifiedOrder->prepay_id,
            "signType" => 'MD5',
        );
        $arr['paySign'] = self::getSign($arr, $config['key']);
        return $arr;
    }

    public static function curlGet($url = '', $options = array())
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        if (!empty($options)) {
        curl_setopt_array($ch, $options);
        }
        //https请求 不验证证书和host
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
 
    public static function curlPost($url = '', $postData = '', $options = array())
    {
        if (is_array($postData)) {
            $postData = http_build_query($postData);
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); //设置cURL允许执行的最长秒数
        if (!empty($options)) {
            curl_setopt_array($ch, $options);
        }
        //https请求 不验证证书和host
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    public static function createNonceStr($length = 16)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $str = '';
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    public static function arrayToXml($arr)
    {
        $xml = "<xml>";
        foreach ($arr as $key => $val) {
        if (is_numeric($val)) {
            $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
        } else
            $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
        }
        $xml .= "</xml>";
        file_put_contents('1.txt',$xml);
        return $xml;
    }

    public static function getSign($params, $key)
    {
        ksort($params, SORT_STRING);
        $unSignParaString = self::formatQueryParaMap($params, false);
        $signStr = strtoupper(md5($unSignParaString . "&key=" . $key));
        return $signStr;
    }
        
    protected static function formatQueryParaMap($paraMap, $urlEncode = false)
    {
        $buff = "";
        ksort($paraMap);
        foreach ($paraMap as $k => $v) {
            if (null != $v && "null" != $v) {
                if ($urlEncode) {
                    $v = urlencode($v);
                }
                $buff .= $k . "=" . $v . "&";
            }
        }
        $reqPar = '';
        if (strlen($buff) > 0) {
            $reqPar = substr($buff, 0, strlen($buff) - 1);
        }
        return $reqPar;
    }

    public function getip(){
        if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
           $ip = getenv('HTTP_CLIENT_IP');
        } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
            $ip = getenv('REMOTE_ADDR');
        } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    public function seo_push($openid,$template_id,$url,$first,$keyword1='',$keyword2='',$keyword3='',$remark){
        //提交成功，触发信息推送
        $data=[
            'touser'=>$openid,
            'template_id'=>$template_id,
            'url'=> $url,
            'topcolor'=>"#FF0000",
            'data'=>array(
                // 'first'=>array('value'=>$first,'color'=>"#fc0101"),
                'thing4'=>array('value'=>$keyword1,'color'=>"#173177"), 
                'thing10'=>array('value'=>$keyword2,'color'=>"#173177"), 
                'time22'=>array('value'=>$keyword3,'color'=>"#173177"), 
                'thing23'=>array('value'=>$remark,'color'=>"#173177"),
            )
        ];
        $get_all_access_token = $this->get_all_access_token();
        $json_data=json_encode($data);//转化成json数组让微信可以接收
        $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$get_all_access_token;//模板消息请求URL
        $res=$this->curlPost($url,urldecode($json_data));
        $res=json_decode($res,true);
        //die;
        if($res['errcode']==0 && $res['errmsg']=="ok"){ 
        //发送成功    
            return 1;
        }else{
            return 0;
        }
    }

    public function get_all_access_token(){
        $cc_key = 'wechat_access_token_new2'.$this->appid;
        if(empty(Cache::get($cc_key))){
            $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->appid.'&secret='.$this->appKey;
            $res = $this->curlGet($url);
            $res = json_decode($res,true);
            if(@$res['access_token']){
                Cache::set('wechat_access_token',$res['access_token']);
                return $res['access_token'];
            }else{
                return '';
            }
        }else{
            return Cache::get($cc_key);
        }
    }

}