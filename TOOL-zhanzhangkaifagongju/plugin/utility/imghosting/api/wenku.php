<?php

namespace plugin\utility\imghosting\api;

use Exception;
use plugin\utility\imghosting\api;

class wenku implements api
{
    public function upload($filepath, $filename){
        $url = 'https://wenku.baidu.com/user/api/editorimg';
        $referer = 'https://wenku.baidu.com/';
        $file = new \CURLFile($filepath);
        $file->setPostFilename($filename);
        $param = [
            'file' => $file,
        ];
        $data = get_curl($url,$param,$referer);
        $arr = json_decode($data,true);
        if(isset($arr['link'])){
            return ['url'=>$arr['link']];
        }elseif(isset($arr['status']) && isset($arr['status']['msg'])){
            throw new Exception('上传失败请重试（'.$arr['status']['msg'].'）');
        }else{
            throw new Exception('上传失败！接口错误');
        }
    }
}