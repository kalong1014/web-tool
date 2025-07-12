<?php

namespace ChatGPT;

class wenxin
{
    protected static $model = 'ERNIE-3.5-8K';
    protected static $apikey = '';
    protected static $secretkey = '';
    protected static $temperature = 0.95;
    protected static $apis = [
        'ERNIE-3.5-8K' => 'https://aip.baidubce.com/rpc/2.0/ai_custom/v1/wenxinworkshop/chat/completions',
        'ERNIE-3.5-8K-0329' => 'https://aip.baidubce.com/rpc/2.0/ai_custom/v1/wenxinworkshop/chat/ernie-3.5-8k-0329',
        'ERNIE-3.5-8K-Preview' => 'https://aip.baidubce.com/rpc/2.0/ai_custom/v1/wenxinworkshop/chat/ernie-3.5-8k-preview',
        'ERNIE-3.5-128K' => 'https://aip.baidubce.com/rpc/2.0/ai_custom/v1/wenxinworkshop/chat/ernie-3.5-128k',
        'ERNIE-3.5-8K-0613' => 'https://aip.baidubce.com/rpc/2.0/ai_custom/v1/wenxinworkshop/chat/ernie-3.5-8k-0613',
        'ERNIE-3.5-8K-0701' => 'https://aip.baidubce.com/rpc/2.0/ai_custom/v1/wenxinworkshop/chat/ernie-3.5-8k-0701',
        'ERNIE-4.0-8K' => 'https://aip.baidubce.com/rpc/2.0/ai_custom/v1/wenxinworkshop/chat/completions_pro',
        'ERNIE-4.0-8K-0329' => 'https://aip.baidubce.com/rpc/2.0/ai_custom/v1/wenxinworkshop/chat/ernie-4.0-8k-0329',
        'ERNIE-4.0-8K-Preview' => 'https://aip.baidubce.com/rpc/2.0/ai_custom/v1/wenxinworkshop/chat/ernie-4.0-8k-preview',
        'ERNIE-4.0-8K-Preview-0518' => 'https://aip.baidubce.com/rpc/2.0/ai_custom/v1/wenxinworkshop/chat/completions_adv_pro',
        'ERNIE-4.0-8K-0613' => 'https://aip.baidubce.com/rpc/2.0/ai_custom/v1/wenxinworkshop/chat/ernie-4.0-8k-0613',
        'ERNIE-4.0-8K-Latest' => 'https://aip.baidubce.com/rpc/2.0/ai_custom/v1/wenxinworkshop/chat/ernie-4.0-8k-latest',
        'ERNIE-4.0-Turbo-8K' => 'https://aip.baidubce.com/rpc/2.0/ai_custom/v1/wenxinworkshop/chat/ernie-4.0-turbo-8k',
        'ERNIE-4.0-Turbo-8k-Preview' => 'https://aip.baidubce.com/rpc/2.0/ai_custom/v1/wenxinworkshop/chat/ernie-4.0-turbo-8k-preview',
        'ERNIE-4.0-Turbo-8K-0628' => 'https://aip.baidubce.com/rpc/2.0/ai_custom/v1/wenxinworkshop/chat/ernie-4.0-turbo-8k-0628',
        'Llama-2-13b-chat' => 'https://aip.baidubce.com/rpc/2.0/ai_custom/v1/wenxinworkshop/chat/llama_2_13b',
        'Llama-2-70b-chat' => 'https://aip.baidubce.com/rpc/2.0/ai_custom/v1/wenxinworkshop/chat/llama_2_70b',
        'ChatGLM2-6B-32K' => 'https://aip.baidubce.com/rpc/2.0/ai_custom/v1/wenxinworkshop/chat/chatglm2_6b_32k',
        'ERNIE-Speed-8K' => 'https://aip.baidubce.com/rpc/2.0/ai_custom/v1/wenxinworkshop/chat/ernie_speed',
        'ERNIE-Speed-128K' => 'https://aip.baidubce.com/rpc/2.0/ai_custom/v1/wenxinworkshop/chat/ernie-speed-128k',
        'ERNIE-Lite-8K' => 'https://aip.baidubce.com/rpc/2.0/ai_custom/v1/wenxinworkshop/chat/eb-instant',
        'ERNIE-Lite-8K-0922' => 'https://aip.baidubce.com/rpc/2.0/ai_custom/v1/wenxinworkshop/chat/eb-instant',
        'ERNIE-Tiny-8K' => 'https://aip.baidubce.com/rpc/2.0/ai_custom/v1/wenxinworkshop/chat/ernie-tiny-8k',
        'ERNIE-Novel-8K' => 'https://aip.baidubce.com/rpc/2.0/ai_custom/v1/wenxinworkshop/chat/ernie-novel-8k',
        'ERNIE-Character-8K' => 'https://aip.baidubce.com/rpc/2.0/ai_custom/v1/wenxinworkshop/chat/ernie-char-8k',
        'ERNIE-Fiction-8K' => 'https://aip.baidubce.com/rpc/2.0/ai_custom/v1/wenxinworkshop/chat/ernie-func-8k',
        'ERNIE-Character-Fiction-8K' => 'https://aip.baidubce.com/rpc/2.0/ai_custom/v1/wenxinworkshop/chat/ernie-char-fiction-8k',
    ];

    /**
     * sdk constructor.
     * @param string $apikey
     * @param string $secretkey
     */
    public function __construct($apikey, $secretkey, $model = '', $temperature = '')
    {
        self::$apikey = $apikey;
        self::$secretkey = $secretkey;
        if ($temperature) {
            self::$temperature = $temperature;
        }
        if ($model && isset(self::$apis[$model])) {
            self::$model = $model;
        }
    }

    public function getAccessToken()
    {
        // 读取存储的 access_token
        $now = time();
        $accessTokenFile = __DIR__ . '/wenxin_access_token_' . self::$apikey . '.php';
        if (file_exists($accessTokenFile)) {
            $content = trim(substr(file_get_contents($accessTokenFile), 15));
            $data = json_decode($content);
        }

        $access_token = '';
        if (empty($data) || $data->expire_time < $now) {
            // 获取新token
            $url = 'https://aip.baidubce.com/oauth/2.0/token?grant_type=client_credentials&client_id=' . self::$apikey . '&client_secret=' . self::$secretkey;
            $res = $this->httpRequest($url);

            if (!empty($res['access_token'])) {
                $access_token = $res['access_token'];
                $data = [
                    'access_token' => $access_token,
                    'expire_time' => $now + $res['expires_in']
                ];
                file_put_contents($accessTokenFile, '<?php exit();?>' . json_encode($data));
            }
        } else {
            $access_token = $data->access_token;
        }

        return $access_token;
    }

    /**
     * @param $message
     * @param $callback
     * @return array|mixed
     * ERNIE-Bot
     */
    public function sendText($message = [], $system = '', $callback = null)
    {
        if (isset(self::$apis[self::$model])) {
            $url = self::$apis[self::$model];
        } else {
            $url = 'https://aip.baidubce.com/rpc/2.0/ai_custom/v1/wenxinworkshop/chat/' . strtolower(self::$model);
        }
        $url .= '?access_token=' . $this->getAccessToken();
        $post = [
            'messages' => $message,
            'stream' => true,
            'max_output_tokens' => 2048
        ];
        // system参数仅支持ERNIE-*模型
        if (strpos(self::$model, 'ERNIE-') !== false) {
            $post['temperature'] = floatval(self::$temperature);
            if ($system) {
                $post['system'] = $system;
            }
        }
        $result = $this->httpRequest($url, $post, $callback);

        return $this->handleError($result);
    }

    /**
     * @param $text
     * @return false|string
     */
    public function getEmbedding($text)
    {
        if (mb_strlen($text) > 384) {
            return '';
        }
        $url = 'https://aip.baidubce.com/rpc/2.0/ai_custom/v1/wenxinworkshop/embeddings/embedding-v1?access_token=' . $this->getAccessToken();

        $post = [
            'input' => [$text]
        ];

        $result = $this->httpRequest($url, $post);
        $result = $this->handleError($result);
        if (isset($result['errno'])) {
            return '';
        }
        return isset($result['data'][0]['embedding']) ? json_encode($result['data'][0]['embedding']) : '';
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
        if (isset($result['error_code'])) {
            return [
                'errno' => 1,
                'message' => $result['error_msg']
            ];
        }
        if (isset($result['error'])) {
            return [
                'errno' => 1,
                'message' => $result['error']['message']
            ];
        }
        if (isset($result['object']) && $result['object'] == 'error') {
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
