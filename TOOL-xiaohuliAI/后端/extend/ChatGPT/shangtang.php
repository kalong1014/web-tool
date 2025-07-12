<?php

namespace ChatGPT;
use Firebase\JWT\JWT;

class shangtang
{
    protected static $model = 'SenseChat';
    protected static $accesskeyId = '';
    protected static $accesskeySecret = '';
    protected static $temperature = 0.8;
    protected static $max_tokens = 2000;
    protected static $apiUrl = 'https://api.sensenova.cn/v1/llm/chat-completions';

    /**
     * @param string $apiKey
     * @param string $model
     * @param string $temperature
     */
    public function __construct($accesskeyId, $accesskeySecret, $model = '', $temperature = '', $max_tokens = '')
    {
        if ($model) {
            self::$model = $model;
        }
        if ($temperature) {
            self::$temperature = $temperature;
        }
        if ($max_tokens) {
            self::$max_tokens = $max_tokens;
        }
        self::$accesskeyId = $accesskeyId;
        self::$accesskeySecret = $accesskeySecret;
    }

    /**
     * @param $message
     * @param $callback
     * @return array|mixed
     */
    public function sendText($message = [], $callback = null)
    {
        $post = [
            'model' => self::$model,
            'messages' => $message,
            'temperature' => floatval(self::$temperature),
            'max_new_tokens' => intval(self::$max_tokens),
            'stream' => true
        ];
        $result = $this->httpRequest(self::$apiUrl, $post, $callback);

        return $this->handleError($result);
    }

    /**
     * @param $text
     * @return false|string
     */
    public function getEmbedding($text)
    {
        if (mb_strlen($text) > 512) {
            return '';
        }
        $url = 'https://api.sensenova.cn/v1/llm/embeddings';
        $post = [
            'model' => 'nova-embedding-stable',
            'prompt' => $text
        ];

        $result = $this->httpRequest($url, $post);
        $result = json_decode($result);
        if (isset($result['code']) && $result['code'] == 200 && !empty($result['embeddings'])) {
            return json_encode($result['embeddings'][0]['embedding']);
        } else {
            return '';
        }
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
        if ($result['code']) {
            return [
                'errno' => 1,
                'message' => $result['msg']
            ];
        }

        return $result;
    }

    protected function makeToken()
    {
        $ak = self::$accesskeyId;
        $sk = self::$accesskeySecret;
        $now = time();
        $payload = [
            'iss' => $ak,
            'exp' => $now + 72 * 3600 * 1000,
            'nbf' => $now - 5
        ];
        $header = [
            'typ' => 'JWT',
            'alg' => 'HS256'
        ];
        return JWT::encode($payload, $sk, 'HS256', $ak, $header);
    }

    /**
     * http请求
     */
    protected function httpRequest($url, $post = null, $callback = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $token = $this->makeToken();
        $header = [
            'Content-Type: application/json',
            'Authorization:' . $token
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
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