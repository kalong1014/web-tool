<?php

namespace ChatGPT;

class gemini
{
    protected static $apiKey = '';
    protected static $temperature = 0.9;
    protected static $max_tokens = 1500;
    protected static $apiHost = 'https://generativelanguage.googleapis.com';
    protected static $model = 'gemini-pro';

    /**
     * @param $apiKey
     * @param $temperature
     * @param $max_tokens
     * @param $model
     */
    public function __construct($apiKey = '', $temperature = '', $max_tokens = '', $model = '')
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
        self::$apiKey = $apiKey;
    }

    public function setApiHost($host)
    {
        self::$apiHost = $host;
    }

    /**
     * @param string $message
     * @return array
     * 流式输出
     */
    public function sendText($message = [], $callback = null)
    {
        $url = self::$apiHost . '/v1beta/models/' . self::$model . ':streamGenerateContent?key=' . self::$apiKey;
        $post = [
            'contents' => $message,
            'generationConfig' => [
                'temperature' => floatval(self::$temperature),
                'maxOutputTokens' => intval(self::$max_tokens)
            ]
        ];
        $result = $this->httpRequest($url, $post, $callback);
        if (isset($result['errno'])) {
            return [
                'errno' => 1,
                'message' => $result['message']
            ];
        }
        return $result;

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
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
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
