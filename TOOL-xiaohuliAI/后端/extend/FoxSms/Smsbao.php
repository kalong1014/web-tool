<?php

namespace FoxSms;

class Smsbao
{

    protected static $user;
    protected static $pass;

    /**
     * @param $user 短信宝登录账号
     * @param $pass md5以后的密码
     */
    public function __construct($user, $pass)
    {
        self::$user = $user;
        self::$pass = $pass;
    }

    /**
     * @param $options
     * 发送验证码
     */
    public function send($phone, $content)
    {
        $url = 'http://api.smsbao.com/sms?u=' . self::$user . '&p=' . self::$pass . '&m=' . $phone . '&c=' . urlencode($content);
        return $this->httpRequest($url);
    }

    private function httpRequest($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            return [
                'errno' => 1,
                'message' => 'curl 错误信息: ' . curl_error($ch)
            ];
        }
        curl_close($ch);

        $statusStr = array(
            "0" => "短信发送成功",
            "-1" => "参数不全",
            "-2" => "服务器空间不支持,请确认支持curl或者fsocket，联系您的空间商解决或者更换空间！",
            "30" => "密码错误",
            "40" => "账号不存在",
            "41" => "余额不足",
            "42" => "帐户已过期",
            "43" => "IP地址限制",
            "50" => "内容含有敏感词"
        );
        if ($result == "0") {
            return [
                'errno' => 0,
                'message' => '发送成功'
            ];
        } else {
            return [
                'errno' => 1,
                'message' => '发送失败：' . isset($statusStr[$result]) ? $statusStr[$result] : '未知错误'
            ];
        }
    }
}
