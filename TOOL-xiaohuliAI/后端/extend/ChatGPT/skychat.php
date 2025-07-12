<?php

namespace ChatGPT;

class skychat
{
    protected static $model = 'SkyChat-MegaVerse';
    protected static $app_key = '';
    protected static $app_secret = '';
    protected static $apiHost = 'https://sky-api.singularity-ai.com';
    protected static $temperature = 0.66;
    protected static $max_tokens = 1000;
    protected static $timestamp = 0;

    /**
     * sdk constructor.
     * @param string $appkey
     * @param string $appsecret
     */
    public function __construct($appkey, $appsecret, $model, $temperature = '', $max_tokens = '')
    {
        self::$app_key = $appkey;
        self::$app_secret = $appsecret;
        self::$timestamp = time();
        if ($model) {
            self::$model = $model;
        }
        if ($temperature) {
            self::$temperature = $temperature;
        }
        if ($max_tokens) {
            self::$max_tokens = $max_tokens;
        }
    }

    /**
     * @param $message
     * @param $callback
     * @return array|mixed
     */
    public function sendText($questions = [], $callback = null)
    {
        $url = self::$apiHost . '/saas/api/v4/generate';
        foreach ($questions as $k => $v) {
            if ($v['role'] == 'assistant') {
                $questions[$k]['role'] = 'bot';
            }
        }

        $post = [
            'messages' => $questions,
            'model' => self::$model,
            'param' => [
                'generate_length' => intval(self::$max_tokens),
                'temperature' => intval(self::$temperature)
            ]
        ];
        $header = [
            'Content-Type: application/json',
            'app_key: ' . self::$app_key,
            'timestamp: ' . self::$timestamp,
            'sign: ' . $this->makeSign(),
            'stream: true'
        ];
        $result = $this->httpRequest($url, $post, $header, $callback);
        return $this->handleError($result);
    }

    public function search($model, $type, $content = '', $callback = null)
    {
        if ($model == 'search') {
            $apiUrl = 'https://api.singularity-ai.com/sky-saas-search/api/v1/search';
        } elseif ($model == 'copilot') {
            $apiUrl = 'https://api.singularity-ai.com/sky-saas-search/api/v1/copilot';
        } elseif ($model == 'research') {
            $apiUrl = 'https://api.singularity-ai.com/sky-saas-search/api/v1/search/research';
        }
        $post = [
            'content' => $content,
            'stream_resp_type' => 'delta'
        ];
        if ($model == 'research') {
            if ($type == 'scholar') {
                $post['is_scholar'] = true;
            }
        }
        $header = [
            'Content-Type: application/json',
            'app_key: ' . self::$app_key,
            'timestamp: ' . self::$timestamp,
            'sign: ' . $this->makeSign()
        ];
        $result = $this->httpRequest($apiUrl, $post, $header, $callback);
        return $this->handleError($result);
    }

    /**
     * @param $params
     * @return string
     * 计算签名
     */
    private function makeSign()
    {
        $app_key = self::$app_key;
        $app_secret = self::$app_secret;
        return md5($app_key . $app_secret . self::$timestamp);
    }

    /**
     * @param $result
     * @return array|mixed
     * 格式化接口报错
     */
    protected function handleError($result)
    {
        if (isset($result['errno'])) {
            return [
                'errno' => 1,
                'message' => $result['message']
            ];
        }
        if (isset($result['code']) && $result['code'] != 200) {
            return [
                'errno' => 1,
                'message' => $result['code_msg']
            ];
        }

        return $result;
    }

    /**
     * http请求
     */
    protected function httpRequest($url, $post = null, $header = null, $callback = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        if ($header) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        if ($post) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
        }
        if ($callback) {
            curl_setopt($ch, CURLOPT_WRITEFUNCTION, $callback);
        }
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            return [
                'errno' => 1,
                'message' => 'curl 错误信息: ' . curl_error($ch)
            ];
        }
        curl_close($ch);
        return json_decode($result, true);
    }
}
