<?php

namespace FoxVideo;
use think\facade\Log;

class pikapikapika
{
    protected static $apiKey = '';
    protected static $apiHost = 'https://api.pikapikapika.io';

    /**
     * @param string $apiKey
     * @param array $options
     */
    public function __construct($apiKey)
    {
        self::$apiKey = $apiKey;
    }

    public function setApiHost($host)
    {
        self::$apiHost = rtrim($host, '/');
    }

    public function pikaGenerate($options)
    {
        $apiUrl = self::$apiHost . '/web/generate';
        $callbackUrl = 'https://' . $_SERVER['HTTP_HOST'] . '/api.php/notify/pikapikapika';
        $post = [
            'promptText' => $options['prompt'],
            'options' => [
                'parameters' => [
                    'motion' => $options['motion'],
                    'guidanceScale' => $options['guidanceScale'],
                    'negativePrompt' => $options['negativePrompt']
                ],
                'frameRate' => $options['frameRate'],
                'aspectRatio' => $options['aspectRatio']
            ],
            'model' => '1.0',
            'sfx' => true,
            'webhookOverride' => $callbackUrl
        ];
        if (isset($options['style'])) {
            $post['style'] = $options['style'];
        }
        if (!empty($options['video'])) {
            $post['video'] = $options['video'];
        } elseif (!empty($options['image'])) {
            $post['image'] = $options['image'];
        }
        if (!empty($options['seed'])) {
            $post['options']['parameters']['seed'] = intval($options['seed']);
        }
        $camera = [];
        if (!empty($options['pan'])) {
            $camera['pan'] = $options['pan'];
        }
        if (!empty($options['tilt'])) {
            $camera['tilt'] = $options['tilt'];
        }
        if (!empty($options['rotate'])) {
            $camera['rotate'] = $options['rotate'];
        }
        if (!empty($options['zoom'])) {
            $camera['zoom'] = $options['zoom'];
        }
        if (!empty($camera)) {
            $post['options']['camera'] = $camera;
        }
        return $this->httpRequest($apiUrl, json_encode($post));
    }

    public function pikaExtend($options)
    {
        $apiUrl = self::$apiHost . '/web/extend';
        $callbackUrl = 'https://' . $_SERVER['HTTP_HOST'] . '/api.php/notify/pikapikapika';
        $post = [
            'promptText' => $options['prompt'],
            'options' => [
                'parameters' => [
                    'motion' => $options['motion'],
                    'guidanceScale' => $options['guidanceScale'],
                    'negativePrompt' => $options['negativePrompt']
                ],
                'frameRate' => $options['frameRate'],
                'aspectRatio' => $options['aspectRatio']
            ],
            'video' => $options['video'],
            'webhookOverride' => $callbackUrl
        ];
        if (!empty($options['seed'])) {
            $post['options']['parameters']['seed'] = intval($options['seed']);
        }
        $camera = [];
        if (!empty($options['pan'])) {
            $camera['pan'] = $options['pan'];
        }
        if (!empty($options['tilt'])) {
            $camera['tilt'] = $options['tilt'];
        }
        if (!empty($options['rotate'])) {
            $camera['rotate'] = $options['rotate'];
        }
        if (!empty($options['zoom'])) {
            $camera['zoom'] = $options['zoom'];
        }
        if (!empty($camera)) {
            $post['options']['camera'] = $camera;
        }
        return $this->httpRequest($apiUrl, json_encode($post));
    }

    public function pikaUpscale($video)
    {
        $apiUrl = self::$apiHost . '/web/upscale';
        $post = [
            'video' => $video
        ];
        return $this->httpRequest($apiUrl, json_encode($post));
    }

    public function getJob($jobId)
    {
        $apiUrl = self::$apiHost . '/web/jobs/' . $jobId;
        return $this->httpRequest($apiUrl);
    }

    public function getUpscaleJob($jobId)
    {
        $apiUrl = self::$apiHost . '/web/jobs/upscaled';
        $post = [
            'video' => $jobId
        ];
        return $this->httpRequest($apiUrl, json_encode($post));
    }

    public function lipSync($options)
    {
        $apiUrl = self::$apiHost . '/web/lipSync';
        $post = [
            'video' => $options['video'],
            'speechStart' => $options['speechStart'],
            'speechEnd' => $options['speechEnd'],
            'speech' => $options['speech']
        ];
        return $this->httpRequest($apiUrl, json_encode($post));
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
        elseif (isset($result['error'])) {
            return [
                'errno' => 1,
                'message' => wordFilter($result['error']['message'])
            ];
        }
        return $result;
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
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Bearer ' . self::$apiKey
        ]);
        if ($post) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        $result = curl_exec($ch);
        if ($post) {
            Log::write('=== Pika Request ===');
            Log::write('URL: ' . $url);
            Log::write('KEY: ' . self::$apiKey);
            Log::write('POST: ' . $post);
            Log::write('RESULT: ' . $result);
        }
        if (curl_errno($ch)) {
            return [
                'errno' => 1,
                'message' => '网络错误: ' . curl_error($ch)
            ];
        }
        curl_close($ch);

        if (strpos($result, '{"') === false) {
            return [
                'errno' => 1,
                'message' => $result
            ];
        }
        return json_decode($result, true);
    }
}
