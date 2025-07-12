<?php

namespace FoxMusic;

class duomi
{
    protected static $apiKey = '';
    protected static $apiHost = 'https://api.wike.cc';

    public function __construct($apiKey = '')
    {
        self::$apiKey = $apiKey;
    }

    public function generate($options = []) {
        $url = self::$apiHost . '/api/suno/generate';
        $post = [
            'key' => self::$apiKey,
            'custom_mode' => intval($options['custom_mode']),
            'make_instrumental' => intval($options['make_instrumental']),
            'prompt' => str_replace('\n', "\n", trim($options['prompt'])),
            'mv' => 'chirp-v3-5',
            'callback_url' => $options['callback_url']
        ];

        if (!empty($options['continue_clip_id'])) {
            $post['continue_clip_id'] = $options['continue_clip_id'];
            if (!empty($options['continue_at'])) {
                $post['continue_at'] = $options['continue_at'];
            }
        }
        if (!empty($options['title'])) {
            $post['title'] = $options['title'];
        }
        if (!empty($options['tags'])) {
            $post['tags'] = $options['tags'];
        }
        if (!empty($options['negative_tags'])) {
            $post['negative_tags'] = $options['negative_tags'];
        }
        $result =  $this->httpRequest($url, $post);
        return $this->formatResult($result);
    }

    /**
     * 歌词生成
     */
    public function generateLyrics($prompt){
        $url = self::$apiHost . '/api/suno/lyrics';
        $post = [
            'key' => self::$apiKey,
            'prompt' => $prompt
        ];
        $result =  $this->httpRequest($url, $post);
        return $this->formatResult($result);
    }


    /**
     * 歌曲查询
     */
    public function feed($task_id){
        $url = self::$apiHost . '/api/suno/feed';
        $post = [
            'key' => self::$apiKey,
            'task_id' => $task_id
        ];
        $result =  $this->httpRequest($url, $post);
        return $this->formatResult($result);
    }

    /**
     * 格式化返回结果
     */
    protected function formatResult($result)
    {
        if (!empty($result['code'])) {
            if( $result['code'] == 200) {
                return [
                    'errno' => 0,
                    'data' => $result['data']
                ];
            } else {
                return [
                    'errno' => 1,
                    'message' => $result['msg'] ?? '任务提交失败'
                ];
            }
        } else {
            return [
                'errno' => 1,
                'message' => '任务提交失败'
            ];
        }
    }

    /**
     * http请求
     */
    protected function httpRequest($url, $post = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: multipart/form-data',
            'Accept: application/json'
        ]);
        if ($post) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            return [
                'errno' => 1,
                'message' => '网络错误: ' . curl_error($ch)
            ];
        }
        curl_close($ch);

        return json_decode($result, true);
    }
}
