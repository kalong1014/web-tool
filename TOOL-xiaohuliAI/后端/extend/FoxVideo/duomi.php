<?php

namespace FoxVideo;

use think\facade\Log;

class duomi
{
    protected static $apiKey = '';
    protected static $apiHost = 'http://duomiapi.com';
    protected static $callback = '';

    /**
     * @param string $apiKey
     * @param array $options
     */
    public function __construct($apiKey)
    {
        self::$apiKey = $apiKey;
        self::$callback = 'https://' . $_SERVER['HTTP_HOST'] . '/api.php/notify/duomi_video';
    }

    /**
     * pika生成
     */
    public function pikaGenerate($options)
    {
        $apiUrl = self::$apiHost . '/api/video/pika/pro/generate';
        $post = [
            'key' => self::$apiKey,
            'callback_url' => self::$callback,
            'prompt' => $options['prompt'],
            'ratio' => $options['aspectRatio'],
            'sfx' => true,
            'options' => [
                'parameters' => [
                    'motion' => $options['motion'],
                    'guidanceScale' => $options['guidanceScale'],
                    'negativePrompt' => $options['negativePrompt']
                ],
                'frameRate' => $options['frameRate'],
            ],
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
        $result = $this->httpRequest($apiUrl, json_encode($post));
        return $this->formatResult($result);
    }
    public function pikaExtend($options)
    {
        return [
            'errno' => 1,
            'message' => '暂不支持此操作'
        ];
    }

    /**
     *luma生成
     */
    public function lumaGenerate($options)
    {
        $apiUrl = self::$apiHost . '/api/video/luma/pro/generate';
        $post = [
            'key' => self::$apiKey,
            'user_prompt' => $options['prompt'],
            'aspect_ratio' => $options['aspectRatio'],
            'callback_url' => self::$callback,
            'expand_prompt' => true,
            'loop' => false,
        ];
        if (!empty($options['image'])) {
            $post['image_url'] = $options['image'];
            if (!empty($options['image_end_url'])) {
                $post['image_end_url'] = $options['image_end_url'];
            }
        }
        $result = $this->httpRequest($apiUrl, json_encode($post));
        return $this->formatResult($result);
    }

    /**
     *luma扩展
     */
    public function lumaExtend($options)
    {
        $apiUrl = self::$apiHost . '/api/video/luma/pro/extend';
        $post = [
            'key' => self::$apiKey,
            'user_prompt' => $options['prompt'],
            'task_id' => $options['task_id'],
            'callback_url' => self::$callback,
            'expand_prompt' => true,
            'loop' => false,
        ];
        $result = $this->httpRequest($apiUrl, json_encode($post));
        return $this->formatResult($result);
    }

    /**
     * runway生成
     */
    public function runwayGenerate($options)
    {
        $apiUrl = self::$apiHost . '/api/video/runway/pro/generate';
        $post = [
            'key' => self::$apiKey,
            'prompt' => $options['prompt'],
            'callback_url' => self::$callback,
            'model' => $options['model'],
            'ratio' => $options['aspectRatio']
        ];

        if ($options['model'] == 'gen2') {
            if (!empty($options['style'])) {
                $post['style'] = $options['style'];
            }
            // 镜头控制
            $post['options']['motion_vector'] = [
                'x' => !empty($options['x']) ? floatval($options['x']) : 0,
                'y' => !empty($options['y']) ? floatval($options['y']) : 0,
                'z' => !empty($options['z']) ? floatval($options['z']) : 0,
                'r' => !empty($options['r']) ? floatval($options['r']) : 0,
                'bg_x_pan' => !empty($options['bg_x_pan']) ? floatval($options['bg_x_pan']) : 0,
                'bg_y_pan' => !empty($options['bg_y_pan']) ? floatval($options['bg_y_pan']) : 0
            ];
        } elseif ($options['model'] == 'gen3') {
            $post['options']['seconds'] = $options['seconds'];
        }

        if (!empty($options['image'])) {
            $post['image'] = $options['image'];
            $post['options']['flip'] = $options['aspectRatio'] === '9:16';
            unset($post['ratio']);
        }

        $result = $this->httpRequest($apiUrl, json_encode($post));
        return $this->formatResult($result);
    }

    /**
     * pixverse生成
     */
    public function pixGenerate($options)
    {
        $apiUrl = self::$apiHost . '/api/video/pix/pro/generate';
        $post = [
            'key' => self::$apiKey,
            'prompt' => $options['prompt'],
            'ratio' => $options['aspectRatio'],
            'callback_url' => self::$callback,
            'negative_prompt' => $options['negativePrompt'],
        ];
        if (!empty($options['seed'])) {
            $post['seed'] = intval($options['seed']);
        }
        if (!empty($options['style'])) {
            $post['style'] = intval($options['style']);
        }
        if (!empty($options['image'])) {
            $post['image_base'] = $options['image'];
        }
        $result = $this->httpRequest($apiUrl, json_encode($post));
        return $this->formatResult($result);
    }

    public function getJob($task_id, $model)
    {
        $apiUrl = self::$apiHost . '/api/video/' . $model . '/feed';
        $post = [
            'key' => self::$apiKey,
            'task_id' => $task_id
        ];
        $result = $this->httpRequest($apiUrl, json_encode($post));
        return $this->formatResult($result);
    }

    /**
     * @param $result
     * @return array|mixed
     * 格式化接口报错
     */
    protected function formatResult($result)
    {
        if (!empty($result['code'])) {
            if ($result['code'] == 200) {
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
            'Content-Type: application/json'
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
