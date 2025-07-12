<?php

namespace plugin\utility\imghosting\api;

use Exception;
use plugin\utility\imghosting\api;

class baidu implements api
{
    public function upload($filepath, $filename){
        $url = 'https://help.baidu.com/api/mpic';
        $referer = 'https://help.baidu.com/';
        $file = new \CURLFile($filepath);
        $file->setPostFilename($filename);
        $param = [
            'pic' => $file,
        ];
        $data = get_curl($url,$param,$referer);
        $arr = json_decode($data,true);
        if(isset($arr['resps'])){
            return ['url'=>$arr['resps'][0]];
        }else{
            throw new Exception('上传失败！接口错误');
        }
    }
}