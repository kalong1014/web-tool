<?php

namespace plugin\utility\imghosting\api;

use Exception;
use plugin\utility\imghosting\api;

class aichat implements api
{
    public function upload($filepath, $filename){
        $url = 'https://upload.aichat.net/upload/single';
        $file = new \CURLFile($filepath);
        $file->setPostFilename($filename);
        $param = [
            'single' => $file,
        ];
        $data = get_curl($url,$param,$url);
        $arr = json_decode($data,true);
        if(isset($arr['code']) && $arr['code']==200){
            return ['url'=>$arr['url']];
        }elseif(isset($arr['error'])){
            throw new Exception('上传失败请重试（'.$arr['error'].'）');
        }else{
            throw new Exception('上传失败！接口错误');
        }
    }
}