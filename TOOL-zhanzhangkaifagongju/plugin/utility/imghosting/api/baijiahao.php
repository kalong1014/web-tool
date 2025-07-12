<?php

namespace plugin\utility\imghosting\api;

use Exception;
use plugin\utility\imghosting\api;

class baijiahao implements api
{
    public function upload($filepath, $filename){
        $url = 'https://baijiahao.baidu.com/builderinner/api/content/file/upload';
        $referer = 'https://baijiahao.baidu.com/';
        $file = new \CURLFile($filepath);
        $file->setPostFilename($filename);
        $param = [
            'no_compress' => '1',
            'id' => 'WU_FILE_0',
            'is_avatar' => '0',
            'media' => $file,
        ];
        $data = get_curl($url,$param,$referer);
        $arr = json_decode($data,true);
        if(isset($arr['errno']) && $arr['errno']==0){
            return ['url'=>$arr['ret']['https_url']];
        }elseif(isset($arr['errmsg'])){
            throw new Exception('上传失败请重试（'.$arr['errmsg'].'）');
        }else{
            throw new Exception('上传失败！接口错误');
        }
    }
}