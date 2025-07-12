<?php

namespace ChatGPT;

class hunyuan
{
    protected static $version = '2023-09-01';
    protected static $region = 'ap-guangzhou';
    protected static $secretId = '';
    protected static $secretKey = '';
    protected static $model = 'hunyuan-lite';
    protected static $temperature = 1.0;
    protected static $apiUrl = 'https://hunyuan.tencentcloudapi.com';
    protected static $apiHost = 'hunyuan.tencentcloudapi.com';
    protected static $service = 'hunyuan';
    protected static $action = '';

    /**
     * @param $secretId
     * @param $secretKey
     * @param $model
     * @param $temperature
     */
    public function __construct($secretId = '', $secretKey = '',$model = '', $temperature = 1.0)
    {
        self::$secretId = $secretId;
        self::$secretKey = $secretKey;
        self::$temperature = $temperature;
        if ($model) {
            self::$model = $model;
        }
    }

    /**
     * @param $message
     * @param $callback
     * @return array|mixed
     */
    public function sendText($message = [], $callback = null)
    {
        self::$action = 'ChatCompletions';
        // key首字母转大写
        $Messages = [];
        foreach ($message as $v) {
            $Messages[] = [
                'Role' => $v['role'],
                'Content' => $v['content']
            ];
        }
        $post = [
            'Messages' => $Messages,
            'Temperature' => floatval(self::$temperature),
            'Model' => self::$model,
            'Stream' => true
        ];

        $result = $this->httpRequest(self::$apiUrl, $post, $callback);
        return $this->handleError($result);
    }

    public function calcTokens($text)
    {
        self::$action = 'GetTokenCount';
        $post = [
            'Prompt' => $text
        ];

        return $this->httpRequest(self::$apiUrl, $post);
    }

    public function getEmbedding($text)
    {
        self::$action = 'GetEmbedding';
        $post = [
            'Input' => $text
        ];

        return $this->httpRequest(self::$apiUrl, $post);
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
        if (isset($result['error'])) {
            return [
                'errno' => 1,
                'message' => $result['error']['message']
            ];
        }

        return $result;
    }

    protected function makeSignV3($payload, $timestamp)
    {
        if (is_array($payload)) {
            $payload = json_encode($payload, JSON_UNESCAPED_UNICODE);
        }
        $algorithm = 'TC3-HMAC-SHA256';
        $secret_id = self::$secretId;
        $secretKey = self::$secretKey;
        $service = self::$service;
        $host = self::$apiHost;
        $date = gmdate('Y-m-d', $timestamp);

        // ************* 步骤 1：拼接规范请求串 *************
        $http_request_method = 'POST';
        $canonical_uri = '/';
        $canonical_querystring = '';

        $canonical_headers = "content-type:application/json; charset=utf-8\nhost:$host\nx-tc-action:" . strtolower(self::$action) . "\n";
        $signed_headers = 'content-type;host;x-tc-action';
        $hashed_request_payload = hash('sha256', $payload);
        $canonical_request = "$http_request_method\n$canonical_uri\n$canonical_querystring\n$canonical_headers\n$signed_headers\n$hashed_request_payload";

        // ************* 步骤 2：拼接待签名字符串 *************
        $credential_scope = "$date/$service/tc3_request";
        $hashed_canonical_request = hash('sha256', $canonical_request);
        $string_to_sign = "$algorithm\n$timestamp\n$credential_scope\n$hashed_canonical_request";

        // ************* 步骤 3：计算签名 *************
        $secret_date = hash_hmac('sha256', $date, 'TC3' . $secretKey, true);
        $secret_service = hash_hmac('sha256', $service, $secret_date, true);
        $secret_signing = hash_hmac('sha256', 'tc3_request', $secret_service, true);
        $signature = hash_hmac('sha256', $string_to_sign, $secret_signing);

        // ************* 步骤 4：拼接 Authorization *************
        $authorization = "$algorithm Credential=$secret_id/$credential_scope, SignedHeaders=$signed_headers, Signature=$signature";
        return $authorization;
    }

    protected function makeHeader($post)
    {
        $timestamp = time();
        return [
            'Authorization:' . $this->makeSignV3($post, $timestamp),
            'Content-Type:application/json; charset=utf-8',
            'Host:' . self::$apiHost,
            'X-TC-Action:' . self::$action,
            'X-TC-Timestamp:' . $timestamp,
            'X-TC-Version:' . self::$version,
            'X-TC-Region:' . self::$region
        ];
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
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->makeHeader($post));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post, JSON_UNESCAPED_UNICODE));
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