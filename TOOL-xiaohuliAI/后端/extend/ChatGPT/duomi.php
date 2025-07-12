<?php

namespace ChatGPT;

class duomi
{
    protected static $model = 'fast';
    protected static $apikey = '';
    protected static $apisecret = '';

    /**
     * @param $apikey
     * @param $apisecret
     */
    public function __construct($apikey = '')
    {
        self::$apikey = $apikey;
    }

    /**
     * @param $model 'fast or relax'
     * @param $option
     * @return array|mixed
     * 开启一个绘画任务
     */
    public function drawMJ($model, $option = [])
    {
        $url = 'https://api.wike.cc/api/midjourney/imagine/' . $model;
        $post = [
            'action' => 'generate',
            'prompt' => $option['prompt'] ?? '',
            'key' => self::$apikey,
            'callback_url' => $option['callback_url']
        ];

        $result = $this->httpRequest($url, $post);
        if (!empty($result['code']) && $result['code'] == 200) {
            return [
                'errno' => 0,
                'data'=> $result['data']['task_id']
            ];
        } else {
            return [
                'errno' => 1,
                'message' => $result['msg'] ?? '任务提交失败'
            ];
        }
    }

    /**
     * @param $option
     * @return array
     * MJ图片放大、变换
     */
    public function mjCtrl($model, $option = [])
    {
        $url = 'https://api.wike.cc/api/midjourney/imagine/' . $model;
        $post = [
            'action' => $option['action'],
            'callback_url' => $option['callback_url'],
            'key' => self::$apikey,
            'image_id' => $option['image_id']
        ];

        $result = $this->httpRequest($url, $post);

        if (!empty($result['code']) && $result['code'] == 200) {
            return [
                'errno' => 0,
                'data' => $result['data']['task_id']
            ];
        } else {
            return [
                'errno' => 1,
                'message' => $result['msg'] ?? '任务提交失败'
            ];
        }
    }

    /**
     * @param $imageUrl
     * @return array
     * 分割mj的4张图片
     */
    public function splitMjImage($imageUrl)
    {
        $images = [];

        $date = date('Ymd');
        $dir = './upload/draw/' . $date . '/';
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        $filename = uniqid();
        $filepath = $dir . $filename . '.jpg';
        $filepath1 = $dir . $filename . '_1.jpg';
        $filepath2 = $dir . $filename . '_2.jpg';
        $filepath3 = $dir . $filename . '_3.jpg';
        $filepath4 = $dir . $filename . '_4.jpg';
        $imageContent = file_get_contents($imageUrl, false, stream_context_create(['ssl' => ['verify_peer' => false, 'verify_peer_name' => false]]));
        if (strpos($imageUrl, '.webp') !== false) {
            $imageUrl = $dir . $filename . '_ori.webp';
            file_put_contents($imageUrl, $imageContent);
            $srcResource = imagecreatefromwebp($imageUrl);
            @unlink($imageUrl);
        } elseif (strpos($imageUrl, '.png') !== false) {
            $imageUrl = $dir . $filename . '_ori.png';
            file_put_contents($imageUrl, $imageContent);
            $srcResource = imagecreatefrompng($imageUrl);
            @unlink($imageUrl);
        } elseif (strpos($imageUrl, '.jpg') !== false) {
            $imageUrl = $dir . $filename . '_ori.jpg';
            file_put_contents($imageUrl, $imageContent);
            $srcResource = imagecreatefromjpeg($imageUrl);
            @unlink($imageUrl);
        }

        $width = imagesx($srcResource);
        $height = imagesy($srcResource);
        if ($width < 2048 && $height < 2048) {
            imagejpeg($srcResource, $filepath, 100);
            $images[] = saveToOss($filepath);
        } else {
            $newWidth = intval($width / 2);
            $newHeight = intval($height / 2);
            $newImage = imagecreatetruecolor($newWidth, $newHeight);
            // 第1张图片
            imagecopyresampled($newImage, $srcResource, 0, 0, 0, 0, $newWidth, $newHeight, $newWidth, $newHeight);
            imagejpeg($newImage, $filepath1, 100);
            $images[] = saveToOss($filepath1);
            // 第2张图片
            imagecopyresampled($newImage, $srcResource, 0, 0, $newWidth, 0, $newWidth, $newHeight, $newWidth, $newHeight);
            imagejpeg($newImage, $filepath2, 100);
            $images[] = saveToOss($filepath2);
            // 第3张图片
            imagecopyresampled($newImage, $srcResource, 0, 0, 0, $newHeight, $newWidth, $newHeight, $newWidth, $newHeight);
            imagejpeg($newImage, $filepath3, 100);
            $images[] = saveToOss($filepath3);
            // 第4张图片
            imagecopyresampled($newImage, $srcResource, 0, 0, $newWidth, $newHeight, $newWidth, $newHeight, $newWidth, $newHeight);
            imagejpeg($newImage, $filepath4, 100);
            $images[] = saveToOss($filepath4);
            imagedestroy($newImage);
            imagedestroy($srcResource);
        }

        return $images;
    }

    /**
     * http请求
     */
    protected function httpRequest($url, $post = '')
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: multipart/form-data'
        ]);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        if (!empty($_SERVER['HTTP_HOST'])) {
            curl_setopt($ch, CURLOPT_REFERER, 'https://' .  $_SERVER['HTTP_HOST']);
        }
        if ($post) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            return [
                'code' => 1,
                'message' => 'curl错误：' . curl_error($ch)
            ];
        }
        curl_close($ch);
        return json_decode($result, true);
    }
}
