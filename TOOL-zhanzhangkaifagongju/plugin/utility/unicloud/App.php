<?php
/**
 * uniCloud文件快传
 */

namespace plugin\utility\unicloud;

use app\Plugin;
use plugin\utility\unicloud\UnicloudClient;
use Exception;

class App extends Plugin
{

    private $unicloud;

    public function index()
    {
        return $this->view();
    }

    public function preUpload(){
        if(!input('?post.filename'))exit('{"code":-1,"msg":"请选择文件"}');

        try{
            $this->getSession();
        } catch (Exception $e) {
            return ['code'=>-1, 'msg'=>'获取AccessToken失败:' . $e->getMessage()];
        }

        try{
            $result = $this->unicloud->pre_upload_file(input('post.filename'));
            return json(['code'=>0, 'data'=>$result]);
        } catch (Exception $e) {
            return json(['code'=>-1, 'msg'=>'准备文件上传失败:' . $e->getMessage()]);
        }
    }

    public function completeUpload(){
        if(!input('?post.id'))exit('{"code":-1,"msg":"no id"}');

        try{
            $this->getSession();
        } catch (Exception $e) {
            return ['code'=>-1, 'msg'=>'获取AccessToken失败:' . $e->getMessage()];
        }

        try{
            $result = $this->unicloud->complete_upload_file(input('post.id'));
            return json(['code'=>0, 'data'=>$result]);
        } catch (Exception $e) {
            return json(['code'=>-1, 'msg'=>'完成文件上传失败:' . $e->getMessage()]);
        }
    }

    private function getSession(){
        include dirname(__FILE__).'/config.php';
        $this->unicloud = new UnicloudClient($spaceId, $clientSecret);
        if(session('access_token') && session('access_token_expire') && session('access_token_expire')>time()){
            $access_token = session('access_token');
            $this->unicloud->set_access_token($access_token);
        }else{
            $access_token = $this->unicloud->get_access_token();
            session('access_token', $access_token);
            session('access_token_expire', time()+600);
        }
        return null;
    }
    
}