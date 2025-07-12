<?php

namespace FoxAI;

use think\facade\Db;

class hub
{
    protected static $site_id = 0;
    protected static $ai = '';
    protected static $keyType = '';
    protected static $apiKey = '';
    // 系统前置指令
    protected static $systemPrompt = '';
    // 关联的上文内容
    protected static $relationMsgs = [];
    // 准备提交的文本内容
    protected static $message = '';
    // 输出文字的回调方法
    protected static $replyCallback = null;
    // 输出错误的回调方法
    protected static $errorCallback = null;
    // 上文最大长度 - 默认3000
    protected static $maxRelationLength = 3000;


    /**
     * @param $site_id
     * @param $ai
     */
    public function __construct($site_id, $ai = '')
    {
        self::$site_id = $site_id;
        self::$ai = $ai;
    }

    public function setSystemPrompt($systemPrompt)
    {
        self::$systemPrompt = $systemPrompt;
    }

    public function setRelationMsgs($relationMsgs)
    {
        self::$relationMsgs = $relationMsgs;
    }

    public function setMessage($message)
    {
        self::$message = $message;
    }

    public function setCallback($replyCallback = null, $errorCallback = null)
    {
        self::$replyCallback = $replyCallback;
        self::$errorCallback = $errorCallback;
    }

    private function initAiSDK()
    {
        // 获取AI通道配置
        $aiSetting = getAiSetting(self::$site_id, self::$ai);
        if (empty($aiSetting)) {
            $this->throwError('请先启用AI通道');
        }
        if (in_array(self::$ai, ['chatglm', 'openllm', 'localai'])) {
            $this->throwError('暂不支持此接口');
        }
        // 计算上下文最大字数长度
        if (!empty($aiSetting['model'])) {
            $engine = Db::name('engine')
                ->where([
                    ['type', '=', self::$ai],
                    ['name', '=', $aiSetting['model']]
                ])
                ->field('maxlen,maxinput')
                ->find();
            if ($engine) {
                if ($engine['maxinput']) {
                    self::$maxRelationLength = intval(intval($engine['maxinput']) * 0.7);
                } else {
                    if (!empty($aiSetting['max_tokens'])) {
                        self::$maxRelationLength = intval((intval($engine['maxlen']) - intval($aiSetting['max_tokens'])) * 0.7);
                    } else {
                        self::$maxRelationLength = intval($engine['maxlen']) - 1000;
                    }
                }
            }
        }
        // 获取KEY
        $keyType = self::$ai;
        switch (self::$ai) {
            case 'azure_openai3':
            case 'azure_openai4':
                $keyType = 'azure';
                break;
            case 'wenxin':
            case 'wenxin4':
                $keyType = 'wenxin';
                break;
            case 'hunyuan':
            case 'hunyuan4':
                $keyType = 'hunyuan';
                break;
            case 'zhipu':
            case 'zhipu4':
                $keyType = 'zhipu';
                break;
            case 'deepseek':
            case 'deepseek4':
                $keyType = 'deepseek';
                break;
            case 'claude2':
                $keyType = 'claude';
        }
        if ($keyType == 'deepseek') {
            if (empty($aiSetting['channel']) || $aiSetting['channel'] == 'deepseek') {
                $this->getApiKey($keyType);
            }
        } else {
            $this->getApiKey($keyType);
        }
        // 初始化各AI通道SDK对象
        switch (self::$ai) {
            case 'openai3':
            case 'diy32':
            case 'diy33':
            case 'openai4':
            case 'diy42':
            case 'diy43':
                $SDK = new \ChatGPT\openai(self::$apiKey, $aiSetting['model'], $aiSetting['temperature'], $aiSetting['max_tokens']);
                $SDK->setApiHost($aiSetting['diyhost']);
                break;
            case 'azure_openai3':
            case 'azure_openai4':
                $temp = explode('|', self::$apiKey);
                $key = $temp[0] ?? '';
                $diyhost = $temp[1] ?? '';
                $SDK = new \ChatGPT\azure($key, $aiSetting['model'], $aiSetting['temperature'], $aiSetting['max_tokens']);
                $SDK->setApiHost($diyhost);
                break;
            case 'wenxin':
            case 'wenxin4':
                $temp = explode('|', self::$apiKey);
                $apikey = $temp[0];
                $secretkey = $temp[1] ?? '';
                $SDK = new \ChatGPT\wenxin($apikey, $secretkey, $aiSetting['model'], $aiSetting['temperature']);
                break;
            case 'xunfei':
                $temp = explode('|', self::$apiKey);
                $appid = $temp[0] ?? '';
                $apisecret = $temp[1] ?? '';
                $apikey = $temp[2] ?? '';
                $SDK = new \ChatGPT\xunfei($appid, $apikey, $apisecret, $aiSetting['model'], $aiSetting['temperature'], $aiSetting['max_tokens']);
                break;
            case 'hunyuan':
            case 'hunyuan4':
                $temp = explode('|', self::$apiKey);
                $secretId = $temp[1] ?? '';
                $secretKey = $temp[2] ?? '';
                $SDK = new \ChatGPT\hunyuan($secretId, $secretKey, $aiSetting['model'], $aiSetting['temperature']);
                break;
            case 'tongyi':
                $maxTokens = isset($aiSetting['max_tokens']) ? intval($aiSetting['max_tokens']) : 1500;
                $SDK = new \ChatGPT\tongyi(self::$apiKey, $aiSetting['model'], $aiSetting['temperature'], $maxTokens);
                break;
            case 'zhipu':
            case 'zhipu4':
                $maxTokens = isset($aiSetting['max_tokens']) ? intval($aiSetting['max_tokens']) : 3000;
                $SDK = new \ChatGPT\zhipu(self::$apiKey, $aiSetting['model'], $aiSetting['temperature'], $maxTokens);
                break;
            case 'minimax':
                $temp = explode('|', self::$apiKey);
                $groupId = $temp[0] ?? '';
                $apiKey = $temp[1] ?? '';
                $model = isset($aiSetting['model']) ? $aiSetting['model'] : '';
                $SDK = new \ChatGPT\minimax($groupId, $apiKey, $model, $aiSetting['temperature'], $aiSetting['max_tokens']);
                break;
            case 'skychat':
                $temp = explode('|', self::$apiKey);
                $appkey = $temp[0];
                $appsecret = $temp[1] ?? '';
                $SDK = new \ChatGPT\skychat($appkey, $appsecret, $aiSetting['model'], $aiSetting['temperature'], $aiSetting['max_tokens']);
                break;
            case 'kimi':
                $SDK = new \ChatGPT\kimi(self::$apiKey, $aiSetting['model'], $aiSetting['temperature'], $aiSetting['max_tokens']);
                break;
            case 'baichuan':
                $SDK = new \ChatGPT\baichuan(self::$apiKey, $aiSetting['model'], $aiSetting['temperature'], $aiSetting['max_tokens']);
                break;
            case 'deepseek':
            case 'deepseek4':
                if (empty($aiSetting['channel']) || $aiSetting['channel']  == 'deepseek') {
                    $SDK = new \ChatGPT\deepseek(self::$apiKey, $aiSetting['model'], $aiSetting['temperature'], $aiSetting['max_tokens']);
                } elseif ($aiSetting['channel'] == 'qianfan') {
                    $SDK = new \ChatGPT\qianfan($aiSetting['qianfan_appid'], $aiSetting['qianfan_apikey'], $aiSetting['qianfan_model'], $aiSetting['temperature'], $aiSetting['max_tokens']);
                } elseif ($aiSetting['channel'] == 'ollama') {
                    $apikey = $aiSetting['ollama_apikey'] ?? '';
                    $SDK = new \ChatGPT\ollama($aiSetting['ollama_apiurl'], $apikey, $aiSetting['ollama_model'], $aiSetting['temperature'], $aiSetting['max_tokens']);
                }
                break;
            case 'shangtang':
                $temp = explode('|', self::$apiKey);
                $accesskeyId = $temp[0];
                $accesskeySecret = $temp[1] ?? '';
                $SDK = new \ChatGPT\shangtang($accesskeyId, $accesskeySecret, $aiSetting['model'], $aiSetting['temperature'], $aiSetting['max_tokens']);
                break;
            case 'doubao':
                $SDK = new \ChatGPT\doubao(self::$apiKey, $aiSetting['model'], $aiSetting['temperature'], $aiSetting['max_tokens']);
                break;
            case 'lxai':
                $SDK = new \ChatGPT\lxai(self::$apiKey, $aiSetting['model'], $aiSetting['temperature'], $aiSetting['max_tokens']);
                break;
            case 'claude2':
                $SDK = new \ChatGPT\claude2(self::$apiKey, $aiSetting['model'], $aiSetting['temperature'], $aiSetting['max_tokens']);
                if (!empty($aiSetting['diyhost'])) {
                    $SDK->setApiHost($aiSetting['diyhost']);
                }
                break;
            case 'gemini':
                $SDK = new \ChatGPT\gemini(self::$apiKey, $aiSetting['temperature'], $aiSetting['max_tokens'], $aiSetting['model']);
                if (!empty($aiSetting['diyhost'])) {
                    $SDK->setApiHost($aiSetting['diyhost']);
                }
                break;
            case 'chatglm':
                // todo
                break;
            case 'openllm':
                // todo
                break;
            case 'localai':
                // todo
                break;
        }

        return $SDK;
    }

    /**
     * @param string $message
     * @return array
     * 流式输出
     */
    public function sendText()
    {
        $SDK = $this->initAiSDK();
        $replyCallback = self::$replyCallback;
        $errorCallback = self::$errorCallback;
        $respTemp = '';
        $respFunc = function ($ch, $data) use (&$respTemp, $replyCallback, $errorCallback) {
            $dataLength = strlen($data);
            // file_put_contents('./data.txt', $data . "|", 8);

            if (self::$ai == 'minimax' && strpos($data, '"finish_reason":"stop"') !== false) {
                $replyCallback($ch, 'data: [DONE]');
                return $dataLength;
            }

            // 判断是否报错并处理
            $error = $this->parseError($data);
            if ($error && $errorCallback) {
                $errorCallback($error);
            }

            if (in_array(self::$ai, ['openai3', 'diy32', 'diy33', 'openai4', 'diy42', 'diy43', 'azure_openai3', 'azure_openai4', 'wenxin', 'wenxin4', 'zhipu', 'zhipu4', 'lxai', 'tongyi', 'skychat', 'claude2', 'kimi', 'baichuan', 'deepseek', 'deepseek4', 'shangtang', 'doubao'])) {
                if (strpos($data, 'rate_limit_usage') !== false) {
                    $wordArr = [' Rate limit..', 'data: [DONE]'];
                } else {
                    // 一条data可能会被截断分多次返回
                    $respTemp .= $data;
                    if (substr($respTemp, -1) !== "\n") {
                        return $dataLength;
                    }
                    $data = $respTemp;
                    $respTemp = '';
                }
            }
            if (empty($wordArr)) {
                $wordArr = $this->parseData($data);
            }
            if ($replyCallback && !empty($wordArr)) {
                foreach ($wordArr as $word) {
                    $replyCallback($ch, $word);
                }
            }
            return $dataLength;
        };

        $questions = $this->makeQuestions();
        if (in_array(self::$ai, ['wenxin', 'wenxin4', 'minimax'])) {
            $result = $SDK->sendText($questions, self::$systemPrompt, $respFunc);
        } elseif (self::$ai == 'xunfei') {
            $result = $SDK->sendText($questions, $replyCallback, $errorCallback);
        } else {
            $result = $SDK->sendText($questions, $respFunc);
        }

        if (!empty($result) && !empty($result['errno']) && $errorCallback) {
            $errorCallback($result);
        }
    }

    /**
     * AI搜索
     */
    public function search($model, $type, $content)
    {
        $SDK = $this->initAiSDK();
        $replyCallback = self::$replyCallback;
        $errorCallback = self::$errorCallback;
        $respTemp = '';
        $respFunc = function ($ch, $data) use (&$respTemp, $replyCallback, $errorCallback) {
            // file_put_contents('./search_data.txt', $data . '|', 8);
            $dataLength = strlen($data);

            // 判断是否报错并处理
            $error = $this->parseError($data);
            if ($error && $errorCallback) {
                $errorCallback($error);
            }

            // 一条data可能会被截断分多次返回
            $respTemp .= $data;
            if (substr($respTemp, -1) !== "\n") {
                return $dataLength;
            }
            $data = $respTemp;
            $respTemp = '';

            $result = $this->parseSearchData($data);
            if (is_array($result) && count($result) > 0 && $replyCallback) {
                foreach ($result as $v) {
                    $replyCallback($ch, $v);
                    if (count($result) > 1) {
                        usleep(30000);
                    }
                }
            }

            return $dataLength;
        };

        $result = $SDK->search($model, $type, $content, $respFunc);

        if (!empty($result) && !empty($result['errno']) && $errorCallback) {
            $errorCallback($result);
        }
    }

    /**
     * 文档解析
     */
    public function doc($action, $options = [])
    {
        if (self::$ai == 'tongyi') {
            $model = 'qwen-long';
            $this->getApiKey(self::$ai);
            $SDK = new \ChatGPT\tongyi(self::$apiKey, $model);
        } else {
            return errorJson([
                'error' => 1,
                'message' => '请先配置参数'
            ]);
        }
        switch ($action) {
            case 'upload':
                return $SDK->uploadFile($options['filePath']);
            case 'extract':
                return $SDK->chatWithFile($options['messages']);
            case 'chat':
                $replyCallback = self::$replyCallback;
                $errorCallback = self::$errorCallback;
                $respTemp = '';
                $respFunc = function ($ch, $data) use (&$respTemp, $replyCallback, $errorCallback) {
                    $dataLength = strlen($data);
                    // file_put_contents('./chatWithFile.txt', $data . "|", 8);
                    // 判断是否报错并处理
                    $error = $this->parseError($data);
                    if ($error && $errorCallback) {
                        $errorCallback($error);
                    }

                    if (strpos($data, 'rate_limit_usage') !== false) {
                        $wordArr = [' Rate limit..', 'data: [DONE]'];
                    } else {
                        // 一条data可能会被截断分多次返回
                        $respTemp .= $data;
                        if (substr($respTemp, -1) !== "\n") {
                            return $dataLength;
                        }
                        $data = $respTemp;
                        $respTemp = '';
                    }
                    if (empty($wordArr)) {
                        $wordArr = $this->parseData($data);
                    }
                    if ($replyCallback && !empty($wordArr)) {
                        foreach ($wordArr as $word) {
                            $replyCallback($ch, $word);
                        }
                    }
                    return $dataLength;
                };
                $result = $SDK->chatWithFile($options['messages'], $respFunc);

                if (!empty($result) && !empty($result['errno']) && $errorCallback) {
                    $errorCallback($result);
                }
        }
    }

    /**
     * @param $msgs
     * @return array
     * 处理关联上文，防止过长
     */
    private function makeRelations($msgs)
    {
        if (strpos(self::$message, '请仅在以下内容里搜索答案') !== false) {
            return [];
        }
        $str = self::$systemPrompt . self::$message;
        foreach ($msgs as $msg) {
            $str .= $msg['message'] . $msg['response'];
        }
        if (calcTokens($str) > self::$maxRelationLength) {
            array_pop($msgs);
            if (count($msgs) > 0) {
                return $this->makeRelations($msgs);
            }
            return [];
        }
        return array_reverse($msgs);
    }

    /**
     * @return array
     * 组装问题数组
     */
    private function makeQuestions()
    {
        $questions = [];
        // 历史消息
        $relationMsgs = $this->makeRelations(self::$relationMsgs);
        if (self::$ai == 'gemini') {
            if (self::$systemPrompt) {
                $questions[] = [
                    'role' => 'user',
                    'parts' => [[
                        'text' => self::$systemPrompt
                    ]]
                ];
                $questions[] = [
                    'role' => 'model',
                    'parts' => [[
                        'text' => 'Got it!',
                    ]]
                ];
            }
            foreach ($relationMsgs as $msg) {
                $questions[] = [
                    'role' => 'user',
                    'parts' => [[
                        'text' => $msg['message']
                    ]]
                ];
                $questions[] = [
                    'role' => 'model',
                    'parts' => [[
                        'text' => $msg['response']
                    ]]
                ];
            }
            // 当前提问
            $questions[] = [
                'role' => 'user',
                'parts' => [[
                    'text' => self::$message
                ]]
            ];

        } else {
            // 前置指令
            if (self::$systemPrompt) {
                if (in_array(self::$ai, ['openai3', 'diy32', 'diy33', 'openai4', 'diy42', 'diy43', 'azure_openai3', 'azure_openai4', 'zhipu', 'zhipu4', 'lxai', 'tongyi', 'skychat', 'kimi', 'deepseek', 'deepseek4', 'shangtang', 'doubao'])) {
                    $questions[] = [
                        'role' => 'system',
                        'content' => self::$systemPrompt
                    ];
                } elseif (!in_array(self::$ai, ['wenxin', 'wenxin4', 'minimax', 'baichuan'])) {
                    $questions[] = [
                        'role' => 'user',
                        'content' => self::$systemPrompt
                    ];
                    $questions[] = [
                        'role' => 'assistant',
                        'content' => '好的'
                    ];
                }
            }
            foreach ($relationMsgs as $msg) {
                $questions[] = [
                    'role' => 'user',
                    'content' => $msg['message']
                ];
                $questions[] = [
                    'role' => 'assistant',
                    'content' => $msg['response']
                ];
            }
            // 当前提问
            $questions[] = [
                'role' => 'user',
                'content' => self::$message
            ];
        }

        return $questions;
    }

    /**
     * @param $content
     * @return array
     * 解析返回的数据，返回文字数组的形式：['你’, '好！']
     */
    private function parseData($content)
    {
        $wordArr = [];
        switch (self::$ai) {
            case 'openai3':
            case 'diy32':
            case 'diy33':
            case 'openai4':
            case 'diy42':
            case 'diy43':
            case 'azure_openai3':
            case 'azure_openai4':
            case 'lxai':
            case 'zhipu':
            case 'zhipu4':
                $wordArr = $this->openaiParseData($content);
                break;
            case 'wenxin':
            case 'wenxin4':
                $wordArr = $this->wenxinParseData($content);
                break;
            case 'claude2':
                $wordArr = $this->claude2ParseData($content);
                break;
            case 'tongyi':
                $wordArr = $this->tongyiParseData($content);
                break;
            case 'hunyuan':
            case 'hunyuan4':
                $wordArr = $this->hunyuanParseData($content);
                break;
            case 'minimax':
                $wordArr = $this->minimaxParseData($content);
                break;
            case 'skychat':
                $wordArr = $this->skychatParseData($content);
                break;
            case 'kimi':
                $wordArr = $this->kimiParseData($content);
                break;
            case 'baichuan':
                $wordArr = $this->baichuanParseData($content);
                break;
            case 'deepseek':
            case 'deepseek4':
                $wordArr = $this->deepseekParseData($content);
                break;
            case 'shangtang':
                $wordArr = $this->shangtangParseData($content);
                break;
            case 'doubao':
                $wordArr = $this->doubaoParseData($content);
                break;
            case 'gemini':
                $wordArr = $this->geminiParseData($content);
                break;
        }
        return $wordArr;
    }

    private function openaiParseData($content)
    {
        $content = trim($content);
        $rows = explode("\n", $content);
        $result = [];
        $char = '';
        foreach ($rows as $data) {
            $is_end = false;
            if (strpos($data, 'data: [DONE]') !== false) {
                $is_end = true;
            } else {
                $data = str_replace('data: {', '{', $data);
                $data = rtrim($data, "\n\n");

                // 有可能一次返回多条data: {}
                if (strpos($data, "}\n\n{") !== false) {
                    $arr = explode("}\n\n{", $data);
                    $data = '{' . $arr[1];
                }

                $data = @json_decode($data, true);
                if (!is_array($data)) {
                    continue;
                }
                if (isset($data['choices'])) {
                    $finish_reason = null;
                    if (isset($data['choices']['0']['finish_reason'])) {
                        $finish_reason = $data['choices']['0']['finish_reason'];
                    } elseif (isset($data['finish_reason'])) {
                        $finish_reason = $data['finish_reason'];
                    }
                    if ($finish_reason == 'stop') {
                        $is_end = true;
                    } elseif ($finish_reason == 'length') {
                        $char = 'data: [CONTINUE]';
                    } elseif (isset($data['choices']['0']['delta']['content'])) {
                        $char = $data['choices']['0']['delta']['content'];
                    }
                }
            }
            if ($char !== '') {
                $result[] = $char;
                $char = '';
            }
            if ($is_end) {
                $result[] = 'data: [DONE]';
            }
        }

        return $result;
    }

    private function wenxinParseData($content)
    {
        $content = trim($content);
        $rows = explode("\n", $content);
        $result = [];
        foreach ($rows as $data) {
            $is_end = false;

            $data = str_replace('data: {', '{', $data);
            $data = rtrim($data, "\n\n");

            // 有可能一次返回多条data: {}
            if (strpos($data, "}\n\n{") !== false) {
                $arr = explode("}\n\n{", $data);
                $data = '{' . $arr[1];
            }

            $data = @json_decode($data, true);
            if (!is_array($data)) {
                continue;
            }
            if (isset($data['result'])) {
                $char = $data['result'];
                if ($data['is_end']) {
                    $is_end = true;
                }
                if ($data['need_clear_history']) {
                    $is_end = true;
                    $char = '敏感内容，无法输出。';
                }
            }
            if (isset($char)) {
                $result[] = $char;
            }
            if ($is_end) {
                $result[] = 'data: [DONE]';
            }
        }

        return $result;
    }

    private function claude2ParseData($content)
    {
        $content = trim($content);
        $rows = explode("\n\n", $content);
        $result = [];
        foreach ($rows as $val) {
            $is_end = false;
            $arr = explode("\n", $val);
            $data = str_replace('data: {', '{', $arr[1]);

            $data = @json_decode($data, true);
            if (!is_array($data)) {
                continue;
            }
            if (isset($data['type'])) {
                if ($data['type'] == 'message_start' || $data['type'] == 'content_block_start' || $data['type'] == 'ping') {
                    continue;
                }
                if ($data['type'] == 'content_block_delta') {
                    if (isset($data['delta']['stop_reason']) && $data['delta']['stop_reason'] == 'max_tokens') {
                        $is_end = true;
                        $char = '超出max_tokens或模型的最大值，无法输出。';
                    } else {
                        $char = $data['delta']['text'];
                    }
                }
                if ($data['type'] == 'content_block_stop') {
                    $is_end = true;
                }
            }
            if (isset($char)) {
                $result[] = $char;
            }
            if ($is_end) {
                $result[] = 'data: [DONE]';
            }
        }
        return $result;
    }

    private function tongyiParseData($content)
    {
        $content = trim($content);
        $rows = explode("\n", $content);
        $result = [];
        foreach ($rows as $data) {
            $data = trim($data);
            if (empty($data) || (strpos($data, 'data:{') === false && strpos($data, 'data: {') === false)) {
                continue;
            }

            $data = str_replace('data:{', '{', $data);
            $data = str_replace('data: {', '{', $data);
            $data = @json_decode($data, true);
            if (!is_array($data) || (empty($data['output']) && empty($data['choices']))) {
                continue;
            }
            if (isset($data['choices'])) {
                // qwen-long的
                if (!empty($data['choices'][0]['delta']['content'])) {
                    $result[] = $data['choices'][0]['delta']['content'];
                }
                if ($data['choices'][0]['finish_reason'] == 'stop') {
                    $result[] = 'data: [DONE]';
                }
            } elseif (isset($data['output'])) {
                // 普通模型的
                if (isset($data['output']['choices'])) {
                    if (!empty($data['output']['choices'][0]['message']['content'])) {
                        $result[] = $data['output']['choices'][0]['message']['content'];
                    }
                    if ($data['output']['choices'][0]['finish_reason'] == 'stop') {
                        $result[] = 'data: [DONE]';
                    }
                } else {
                    if (!empty($data['output']['text'])) {
                        $result[] = $data['output']['text'];
                    }
                    if ($data['output']['finish_reason'] == 'stop') {
                        $result[] = 'data: [DONE]';
                    }
                }
            }
        }

        return $result;
    }

    private function hunyuanParseData($content)
    {
        $content = trim($content);
        $rows = explode("\n", $content);
        $result = [];
        $char = '';
        foreach ($rows as $data) {
            $is_end = false;
            $data = trim($data);
            if (empty($data)) {
                continue;
            }
            $data = str_replace('data: {', '{', $data);
            $data = trim($data);

            $data = @json_decode($data);
            if (!$data) {
                continue;
            }

            if (isset($data->Response->Error)) {
                $char = $data->Response->Error->Message;
                $is_end = true;
            } elseif (isset($data->Choices)) {
                $finish_reason = null;
                $choices = $data->Choices[0];

                if (isset($choices->FinishReason)) {
                    $finish_reason = $choices->FinishReason;
                } elseif (isset($data->FinishReason)) {
                    $finish_reason = $data->FinishReason;
                }
                if ($finish_reason == 'stop') {
                    $is_end = true;
                } elseif ($finish_reason == 'length') {
                    $char = 'data: [CONTINUE]';
                } elseif (isset($choices->Delta->Content)) {
                    $char = $choices->Delta->Content;
                }
            }
            if ($char !== '') {
                $result[] = $char;
                $char = '';
            }
            if ($is_end) {
                $result[] = 'data: [DONE]';
            }
        }

        return $result;
    }

    private function minimaxParseData($content)
    {
        $content = trim($content);
        $rows = explode("\n", $content);
        $result = [];
        foreach ($rows as $data) {
            $is_end = false;

            $data = str_replace('data: {', '{', $data);
            $data = rtrim($data, "\n\n");
            $data = @json_decode($data, true);
            if (!is_array($data)) {
                continue;
            }
            if (isset($data['choices'])) {
                $finish_reason = null;
                if (isset($data['choices']['0']['finish_reason'])) {
                    $finish_reason = $data['choices']['0']['finish_reason'];
                }
                if ($finish_reason == 'stop') {
                    $is_end = true;
                } elseif ($finish_reason == 'length') {
                    $char = 'data: [CONTINUE]';
                } elseif (isset($data['choices']['0']['messages'][0]['text'])) {
                    $char = $data['choices']['0']['messages'][0]['text'];
                }
            }

            if (isset($char)) {
                $result[] = $char;
            }
            if ($is_end) {
                $result[] = 'data: [DONE]';
            }
        }

        return $result;
    }

    private function skychatParseData($content)
    {
        $content = trim($content);
        $rows = explode("\n", $content);
        $result = [];
        foreach ($rows as $data) {
            $data = trim($data);
            if (empty($data)) {
                continue;
            }
            $data = @json_decode($data, true);
            if (!is_array($data)) {
                continue;
            }
            if (isset($data['resp_data'])) {
                $result[] = $data['resp_data']['reply'];
                if ($data['resp_data']['finish_reason'] == 1) {
                    $result[] = 'data: [DONE]';
                }
            }
        }
        return $result;
    }


    private function kimiParseData($content)
    {
        $content = trim($content);
        $rows = explode("\n", $content);
        $result = [];
        foreach ($rows as $data) {
            if (strpos($data, 'data: {') === false) {
                continue;
            }

            $data = str_replace('data: {', '{', $data);
            $data = rtrim($data, "\n\n");
            $data = @json_decode($data, true);
            if (!is_array($data)) {
                continue;
            }
            if (!empty($data['choices'][0]['delta']['content'])) {
                $result[] = $data['choices'][0]['delta']['content'];
            }
            if ($data['choices'][0]['finish_reason'] == 'stop') {
                $result[] = 'data: [DONE]';
            } elseif ($data['choices'][0]['finish_reason'] == 'length') {
                $is_end = true;
                $result[] = 'data: [CONTINUE]';
            }
        }

        return $result;
    }


    private function baichuanParseData($content)
    {
        $content = trim($content);
        $rows = explode("\n", $content);
        $result = [];
        foreach ($rows as $data) {
            if (strpos($data, 'data: {') === false) {
                continue;
            }

            $data = str_replace('data: {', '{', $data);
            $data = rtrim($data, "\n\n");
            $data = @json_decode($data, true);
            if (!is_array($data)) {
                continue;
            }
            if (!empty($data['choices'][0]['delta']['content'])) {
                $result[] = $data['choices'][0]['delta']['content'];
            }
            if (!empty($data['choices'][0]['finish_reason'])) {
                if ($data['choices'][0]['finish_reason'] == 'stop' || $data['choices'][0]['finish_reason'] == 'content_filter') {
                    $result[] = 'data: [DONE]';
                }
            }
        }

        return $result;
    }

    private function deepseekParseData($content)
    {
        $content = trim($content);
        $rows = explode("\n", $content);
        $result = [];
        $char = '';
        foreach ($rows as $data) {
            $is_end = false;
            if (strpos($data, 'data: [DONE]') !== false) {
                $is_end = true;
            } else {
                $data = str_replace('data: {', '{', $data);
                $data = rtrim($data, "\n\n");

                // 有可能一次返回多条data: {}
                if (strpos($data, "}\n\n{") !== false) {
                    $arr = explode("}\n\n{", $data);
                    $data = '{' . $arr[1];
                }

                $data = @json_decode($data, true);
                if (!is_array($data)) {
                    continue;
                }
                if (isset($data['choices'])) {
                    $finish_reason = null;
                    if (isset($data['choices']['0']['finish_reason'])) {
                        $finish_reason = $data['choices']['0']['finish_reason'];
                    } elseif (isset($data['finish_reason'])) {
                        $finish_reason = $data['finish_reason'];
                    }
                    if ($finish_reason == 'stop') {
                        $is_end = true;
                    } elseif ($finish_reason == 'length') {
                        $char = 'data: [CONTINUE]';
                    } elseif (isset($data['choices']['0']['delta']['content'])) {
                        $char = $data['choices']['0']['delta']['content'];
                    }
                }
            }

            if ($char !== '') {
                $result[] = $char;
                $char = '';
            }
            if ($is_end) {
                $result[] = 'data: [DONE]';
            }
        }

        return $result;
    }

    private function shangtangParseData($content)
    {
        $content = trim($content);
        $rows = explode("\n", $content);
        $result = [];
        $char = '';
        foreach ($rows as $data) {
            $is_end = false;
            if (strpos($data, 'data: [DONE]') !== false) {
                $is_end = true;
            } else {
                $data = str_replace('data:{', '{', $data);
                $data = rtrim($data, "\n\n");

                // 有可能一次返回多条data: {}
                if (strpos($data, "}\n\n{") !== false) {
                    $arr = explode("}\n\n{", $data);
                    $data = '{' . $arr[1];
                }

                $data = @json_decode($data, true);
                if (!is_array($data)) {
                    continue;
                }
                if (isset($data['data']['choices'])) {
                    $finish_reason = null;
                    if (isset($data['data']['choices'][0]['finish_reason'])) {
                        $finish_reason = $data['data']['choices'][0]['finish_reason'];
                    }
                    if ($finish_reason == 'stop') {
                        $is_end = true;
                    } elseif ($finish_reason == 'length') {
                        $char = 'data: [CONTINUE]';
                    } elseif (isset($data['data']['choices'][0]['delta'])) {
                        $char = $data['data']['choices'][0]['delta'];
                    }
                }
            }
            if ($char !== '') {
                $result[] = $char;
                $char = '';
            }
            if ($is_end) {
                $result[] = 'data: [DONE]';
            }
        }

        return $result;
    }

    private function doubaoParseData($content)
    {
        $content = trim($content);
        $rows = explode("\n", $content);
        $result = [];
        foreach ($rows as $data) {
            if (strpos($data, 'data: {') === false) {
                continue;
            }

            $data = str_replace('data: {', '{', $data);
            $data = rtrim($data, "\n\n");
            $data = @json_decode($data, true);
            if (!is_array($data)) {
                continue;
            }
            if (isset($data['choices'][0]['delta']['content'])) {
                $result[] = $data['choices'][0]['delta']['content'];
            }
            if (isset($data['choices'][0]['finish_reason'])) {
                if ($data['choices'][0]['finish_reason'] == 'stop') {
                    $result[] = 'data: [DONE]';
                } elseif ($data['choices'][0]['finish_reason'] == 'length') {
                    $is_end = true;
                    $result[] = 'data: [CONTINUE]';
                }
            }
        }

        return $result;
    }

    private function geminiParseData($content)
    {
        $result = [];
        $content = trim($content);
        if ($content == ']') {
            $result[] = 'data: [DONE]';
            return $result;
        }

        $json = '';
        $rows = explode("\n", $content);
        foreach ($rows as $row) {
            $json .= trim($row);
        }
        $json = str_replace(['[{"candidates"', ',{"candidates"'], '{"candidates"', $json);
        $json = @json_decode($json);
        if (!empty($json) && !empty($json->candidates[0]->content->parts[0]->text)) {
            $result[] = $json->candidates[0]->content->parts[0]->text;
        }
        return $result;
    }

    /**
     * @param $data
     * @return array|void|null
     * 解析报错信息
     */
    private function parseError($data)
    {
        $data = trim($data);
        if (strpos($data, '{') === false) {
            if (self::$ai == 'deepseek' || self::$ai == 'deepseek4') {
                if (strpos($data, 'data: [DONE]') !== false) {
                    return null;
                }
                $data = json_encode([
                    'error' => [
                        'message' => $data
                    ]
                ]);
            } else {
                return null;
            }
        }
        $errorMsg = $data;
        $data = @json_decode($data);
        if (empty($data)) {
            return null;
        }
        if (in_array(self::$ai, ['openai3', 'diy32', 'diy33', 'openai4', 'diy42', 'diy43', 'azure_openai3', 'azure_openai4', 'zhipu', 'zhipu4', 'lxai', 'tongyi', 'deepseek', 'deepseek4', 'shangtang'])) {
            if (isset($data->error)) {
                if (isset($data->error->code) && $data->error->code == 'invalid_api_key') {
                    $errorMsg = 'invalid_api_key';
                } else {
                    $errorMsg = $data->error->message;
                }
            } elseif (isset($data->object) && $data->object == 'error') {
                // api2d
                $errorMsg = $data->message;
            } elseif (!empty($data->choices)) {
                return null;
            }
        } elseif (self::$ai == 'wenxin' || self::$ai == 'wenxin4') {
            if (isset($data->error_code)) {
                $errorMsg = $data->error_msg;
            }
            if (!empty($data->need_clear_history) && !empty($data->result)) {
                $errorMsg = $data->result;
            }
        } elseif (self::$ai == 'hunyuan' || self::$ai == 'hunyuan4') {
            if (!empty($data->Response->Error)) {
                $errorMsg = $data->Response->Error->Message;
            }
        } elseif (self::$ai == 'minimax') {
            if (empty($data->choices) && !empty($data->base_resp)) {
                $errorMsg = $data->base_resp->status_msg;
            }
        } elseif (in_array(self::$ai, ['claude2', 'kimi', 'baichuan', 'doubao'])) {
            if (isset($data->error)) {
                $errorMsg = $data->error->message;
            }
        } elseif (self::$ai == 'gemini') {
            if (isset($data[0]->error)) {
                $errorMsg = $data[0]->error->message;
            }
        } elseif (self::$ai == 'skychat') {
            if (isset($data->code)) {
                if ($data->code == 200) {
                    return null;
                } else {
                    $errorMsg = $data->code_msg;
                }
            }
        }
        $error = $this->formatError($errorMsg);

        if ($error) {
            // 如果是key池的key出现错误，则继续试用下一个key
            if ($error['level'] == 'error') {
                $this->setKeyStop($error['message']);
                $this->sendText();
                exit;
            } elseif (strpos($error['message'], 'maximum context length') !== false) {
                /*$this->sendText(true);
                exit;*/
            }
        }

        return $error;
    }

    private function formatError($errorMsg)
    {
        if (empty($errorMsg)) {
            return null;
        }
        $level = 'warning';
        if (strpos($errorMsg, 'invalid_api_key') !== false) {
            $level = 'error';
            $errorMsg = 'key不正确';
        } elseif (strpos($errorMsg, 'Incorrect API key provided') !== false) {
            $level = 'error';
            $errorMsg = 'key不正确。' . $errorMsg;
        } elseif (strpos($errorMsg, 'deactivated account') !== false) {
            $level = 'error';
            $errorMsg = 'key账号被封。' . $errorMsg;
        } elseif (strpos($errorMsg, 'has been deactivated') !== false) {
            $level = 'error';
            $errorMsg = 'key已停用。' . $errorMsg;
        } elseif (strpos($errorMsg, 'exceeded your current quota') !== false) {
            $level = 'error';
            $errorMsg = 'key余额不足。' . $errorMsg;
        } elseif (strpos($errorMsg, 'is not active') !== false) {
            $level = 'error';
            $errorMsg = '账号已停用。' . $errorMsg;
        } elseif (strpos($errorMsg, 'thus not supported') !== false) {
            $level = 'error';
            $errorMsg = 'key不支持此模型。' . $errorMsg;
        } elseif (strpos($errorMsg, 'Rate limit reached') !== false) {
            $errorMsg = '达到接口频率上限，请稍后重试';
        } elseif (strpos($errorMsg, 'maximum context length') !== false) {
            $errorMsg = '内容超长，请缩减后提交';
        } elseif (strpos($errorMsg, 'Not enough point') !== false) {
            $level = 'error';
            $errorMsg = 'key余额不足。' . $errorMsg;
        } elseif (strpos($errorMsg, 'bad forward key') !== false) {
            $level = 'error';
            $errorMsg = 'key不正确。' . $errorMsg;
        } elseif (strpos($errorMsg, 'API key not valid') !== false) {
            $level = 'error';
            $errorMsg = 'key不正确。' . $errorMsg;
        } elseif (strpos($errorMsg, '身份验证失败') !== false) {
            $level = 'error';
            $errorMsg = 'key不正确。' . $errorMsg;
        } elseif (strpos($errorMsg, 'The SecretId is not found') !== false) {
            $level = 'error';
            $errorMsg = 'key不正确。' . $errorMsg;
        } elseif (strpos($errorMsg, 'check your signature is correct') !== false) {
            $level = 'error';
            $errorMsg = 'key不正确。' . $errorMsg;
        } elseif (strpos($errorMsg, 'invalid x-api-key') !== false) {
            $level = 'error';
            $errorMsg = 'key不正确。' . $errorMsg;
        } elseif (strpos($errorMsg, 'Your credit balance is too low to access the Claude API.') !== false) {
            $level = 'error';
            $errorMsg = 'key余额不足。' . $errorMsg;
        } elseif (strpos($errorMsg, '欠费') !== false) {
            $level = 'error';
            $errorMsg = 'key余额不足。' . $errorMsg;
        } elseif (strpos($errorMsg, 'Authentication Fails') !== false) {
            $level = 'error';
            $errorMsg = 'key不正确。' . $errorMsg;
        } elseif (strpos($errorMsg, 'The API key in the request is missing or invalid.') !== false) {
            $level = 'error';
            $errorMsg = 'key不正确。' . $errorMsg;
        } elseif (strpos($errorMsg, 'The request failed because your account has an overdue balance.') !== false) {
            $level = 'error';
            $errorMsg = 'key余额不足。' . $errorMsg;
        }

        return [
            'level' => $level,
            'message' => $errorMsg
        ];
    }

    /**
     * 解析AI搜索结果
     */
    private function parseSearchData($content)
    {
        $content = trim($content);
        if (empty($content)) {
            return null;
        }
        $rows = explode("\n", $content);
        $result = [];
        foreach ($rows as $data) {
            $data = trim($data);
            if (empty($data)) {
                continue;
            }

            if ($data == 'data: [DONE]') {
                $result[] = [
                    'type' => 'done',
                    'data' => ''
                ];
                continue;
            }

            $data = str_replace('data: {', '{', $data);
            $data = @json_decode($data, true);
            if (!is_array($data) || empty($data['card_type'])) {
                continue;
            }

            $cardType = $data['card_type'];
            switch($cardType) {
                case 'search_query':
                    $result[] = [
                        'type' => $cardType,
                        'data' => $data['arguments'][0]['messages'][0]['searchKeys']
                    ];
                    break;
                case 'search_result':
                    $sources = [];
                    if (isset($data['arguments'][0]['messages'][0]['sourceAttributions'])) {
                        $sourceAttributions = $data['arguments'][0]['messages'][0]['sourceAttributions'];
                        foreach ($sourceAttributions as $v) {
                            $sources[] = [
                                'doc_type' => $v['doc_type'],
                                'seeMoreUrl' => $v['seeMoreUrl'],
                                'showName' => $v['showName'],
                                'image' => $v['image'],
                                'snippet' => $v['snippet'],
                                'title' => $v['title'],
                                'publishDate' => $v['publishDate'],
                                'pictures' => $v['pictures']
                            ];
                        }
                    }
                    $result[] = [
                        'type' => $cardType,
                        'data' => $sources
                    ];
                    break;
                case 'markdown':
                case 'expand_query':
                    $result[] = [
                        'type' => $cardType,
                        'data' => $data['arguments'][0]['messages'][0]['text']
                    ];
                    break;
                case 'outline_json':
                case 'outline':
                case 'related_events':
                case 'related_people':
                    $sources = [];
                    if (isset($data['arguments'][0]['messages'][0]['sourceAttributions'])) {
                        $sourceAttributions = $data['arguments'][0]['messages'][0]['sourceAttributions'];
                        foreach ($sourceAttributions as $v) {
                            $sources[] = [
                                'doc_type' => $v['doc_type'],
                                'seeMoreUrl' => $v['seeMoreUrl'],
                                'showName' => $v['showName'],
                                'image' => $v['image'],
                                'snippet' => $v['snippet'],
                                'title' => $v['title'],
                                'publishDate' => $v['publishDate'],
                                'pictures' => $v['pictures']
                            ];
                        }
                    }
                    $result[] = [
                        'type' => $cardType,
                        'data' => [
                            'messages' => $data['arguments'][0]['messages'][0]['text'],
                            'sources' => $sources
                        ]
                    ];
                    break;
                case 'suggestedResponses':
                    $result[] = [
                        'type' => $cardType,
                        'data' => $data['arguments'][0]['messages'][0]['suggestedResponses']
                    ];
                    break;
            }
        }

        return $result;
    }

    /**
     * @param $text
     * @return array|mixed
     * 获取文本向量
     */
    public function getEmbedding($text)
    {
        $result = '';
        try {
            $SDK = $this->initAiSDK();
            $result = $SDK->getEmbedding($text);
        } catch (\Exception $e) {

        }
        return $result;
    }

    /**
     * 从key池里取回一个key
     */
    private function getApiKey($type)
    {
        $rs = Db::name('keys')
            ->where([
                ['site_id', '=', self::$site_id],
                ['type', '=', $type],
                ['state', '=', 1]
            ])
            ->order('last_time asc, id asc')
            ->find();
        if (!$rs) {
            $this->throwError('key已用尽，请等待平台处理');
        }
        Db::name('keys')
            ->where('id', $rs['id'])
            ->update([
                'last_time' => time()
            ]);

        self::$keyType = $type;
        self::$apiKey = $rs['key'];
    }

    /**
     * key出错时，停止key
     */
    private function setKeyStop($errorMsg)
    {
        if (empty(self::$keyType) || empty(self::$apiKey)) {
            return;
        }
        if ($errorMsg) {
            Db::name('keys')
                ->where([
                    ['site_id', '=', self::$site_id],
                    ['type', '=', self::$keyType],
                    ['key', '=', self::$apiKey]
                ])
                ->update([
                    'state' => 0,
                    'stop_reason' => $errorMsg
                ]);
        }
    }

    private function throwError($errmsg)
    {
        throw new \Exception($errmsg);
    }
}
