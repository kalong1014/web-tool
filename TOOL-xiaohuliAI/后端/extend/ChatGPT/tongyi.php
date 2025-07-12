<?php

namespace ChatGPT;

class tongyi
{
    protected static $apiUrl = 'https://dashscope.aliyuncs.com/api/v1/services/aigc/text-generation/generation';
    protected static $model = '';
    protected static $apiKey = '';
    protected static $temperature = 0.5;
    protected static $max_tokens = 1500;

    /**
     * sdk constructor.
     * @param string $apiKey
     * @param string $model
     * @param string $temperature
     * @param string $max_tokens
     */
    public function __construct($apiKey = '', $model = '', $temperature = '', $max_tokens = 1500)
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

    /**
     * @param string $message
     * @return array
     * GPT3.5以上模型
     * 流式输出
     */
    public function sendText($message = [], $callback = null)
    {
        $post = [
            'model' => self::$model,
            'input' => [
                'messages' => $message,
            ],
            'parameters' => [
                'result_format' => 'text',
                'temperature' => floatval(self::$temperature),
                'max_tokens' => intval(self::$max_tokens),
                'incremental_output' => true
            ]
        ];
        $result = $this->httpRequest(self::$apiUrl, $post, $callback);

        if (isset($result['error'])) {
            return [
                'errno' => 1,
                'message' => $result['error']['message']
            ];
        }
        return $result;
    }

    /**
     * 上传文件到百炼
     */
    public function uploadFile($filePath)
    {
        $apiUrl = 'https://dashscope.aliyuncs.com/compatible-mode/v1/files';

        if (function_exists('curl_file_create')) {
            $cFile = curl_file_create(realpath($filePath));
        } else {
            $cFile = '@' . realpath($filePath);
        }
        $post = [
            'file' => $cFile,
            'purpose' => 'file-extract'
        ];

        $result = $this->httpUpload($apiUrl, $post);
        if (isset($result['error'])) {
            return [
                'errno' => 1,
                'message' => $result['error']['message']
            ];
        }
        return [
            'errno' => 0,
            'file_id' => $result['id']
        ];
    }

    public function chatWithFile($messages, $callback = null)
    {
        try {
            $apiUrl = 'https://dashscope.aliyuncs.com/compatible-mode/v1/chat/completions';
            $post = [
                'model' => self::$model,
                'messages' => $messages,
                'stream' => $callback ? true : false
            ];
            $result = $this->httpRequest($apiUrl, $post, $callback);

            if (isset($result['error'])) {
                return [
                    'errno' => 1,
                    'message' => $result['error']['message']
                ];
            }
            return $result;
        }catch (\Exception $e) {
            echo $e->getMessage();
        }

    }

    /**
     * http请求
     */
    protected function httpRequest($url, $post = null, $callback = null)
    {
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . self::$apiKey
        ];
        if ($callback) {
            $headers[] = 'Accept: text/event-stream';
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
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
                'error' => [
                    'message' => 'curl 错误信息: ' . curl_error($ch)
                ]
            ];
        }
        curl_close($ch);
        return json_decode($result, true);
    }

    /**
     * 网络请求 - 上传文件
     */
    protected function httpUpload($url, $post = null, $callback = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: multipart/form-data',
            'Authorization: Bearer ' . self::$apiKey
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            return [
                'error' => [
                    'message' => 'curl 错误信息: ' . curl_error($ch)
                ]
            ];
        }
        curl_close($ch);
        return json_decode($result, true);
    }
}
