<?php

namespace plugin\utility\imghosting\api;

use Exception;
use plugin\utility\imghosting\api;

class qqyzf implements api
{
    public function upload($filepath, $filename){
        $url = 'https://yzf.qq.com/fsnb/kf-file/upload_wx_media';
        $referer = 'https://yzf.qq.com/xv/web/static/chat/index.html';
        $userid = 'kfh5'.substr(md5(microtime().rand(111,999)),0,14).'_h5'.md5(time().rand(111,999));
        $file = new \CURLFile($filepath);
        $file->setPostFilename($filename);
        $param = [
            'file' => $file,
            'mid' => 'fsnb',
            'media_type' => 'image',
            'userid' => $userid,
            'agentid' => ''
        ];

        $data = get_curl($url,$param,$referer);
        $arr = json_decode($data,true);
        if(isset($arr['result']) && $arr['result']==0){
            $picurl = urldecode($arr['KfPicUrl']);
	        $picurl = rtrim($picurl,'?');
            return ['url'=>$picurl];
        }elseif(isset($arr['errorMsg'])){
            throw new Exception('上传失败请重试（'.$arr['errorMsg'].'）');
        }elseif(isset($arr['errmsg'])){
            throw new Exception('上传失败请重试（'.$arr['errmsg'].'）');
        }else{
            throw new Exception('上传失败！接口错误');
        }
    }
}