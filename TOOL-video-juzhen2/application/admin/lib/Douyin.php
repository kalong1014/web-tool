<?php

namespace app\admin\lib;
 
class Douyin
{
    private $clientKey;
    private $clientSecret;
    private $apiUrl = 'https://open.douyin.com/';
    private $panel = '';
    private $header = array();
    private $body = array();
    private $page = 0;
    private $statistics =  [
            'comment_count'=>0,
            'digg_count'=>0,
            'download_count'=>0,
            'forward_count'=>0,
            'play_count'=>0,
            'share_count'=>0,
        ];
    private $video_arr = array();
    private $reply_arr = array();
    private $user_arr = array();
    /**
     * 构造
     */
    public function __construct($config = array())
    {
        $this->clientKey = isset($config['client_key']) ? $config['client_key'] : '';
        $this->clientSecret = isset($config['client_secret']) ? $config['client_secret'] : '';
    }
    /*
     * 创建视频
     */
    public function createVideo($data = array())
    {
        if (!(isset($data['access_token']) && $data['access_token'])) {
            return array(
                'errcode' => 3001,
                'errmsg' => 'access_token不能为空',
            );
        }
        if (!(isset($data['openid']) && $data['openid'])) {
            return array(
                'errcode' => 3002,
                'errmsg' => 'openid不能为空',
            );
        }
        if (!(isset($data['video_id']) && $data['video_id'])) {
            return array(
                'errcode' => 3003,
                'errmsg' => 'video_id不能为空',
            );
        }
        $access_token = $data['access_token'];
        $openid = $data['openid'];
        $video_id = $data['video_id'];
        $this->panel = 'video/create/';
        $this->header = array(
            'Content-Type: application/json',
            'access-token: ' . $access_token,
        );
        $this->body = array(
            'video_id' => $video_id,
        );
        if (isset($data['text']) && $data['text']) {
            $this->body['text'] = $data['text'];
        }
        if (isset($data['micro_app_url']) && $data['micro_app_url']) {
            $this->body['micro_app_url'] = $data['micro_app_url'];
        }
        if (isset($data['micro_app_id']) && $data['micro_app_id']) {
            $this->body['micro_app_id'] = $data['micro_app_id'];
        }
        if (isset($data['micro_app_title']) && $data['micro_app_title']) {
            $this->body['micro_app_title'] = $data['micro_app_title'];
        }
        if (isset($data['poi_name']) && $data['poi_name']) {
            $this->body['poi_name'] = $data['poi_name'];
        }
        if (isset($data['custom_cover_image_url']) && $data['custom_cover_image_url']) {
            $this->body['custom_cover_image_url'] = $data['custom_cover_image_url'];
        }
        if (isset($data['poi_id']) && $data['poi_id']) {
            $this->body['poi_id'] = $data['poi_id'];
        }
        if (isset($data['cover_tsp']) && $data['cover_tsp']) {
            $this->body['cover_tsp'] = (float) $data['cover_tsp'];
        }
        $url = $this->apiUrl . $this->panel . '?open_id=' . $openid;
        $result = json_decode($this->post($url, json_encode($this->body)), true);
        if (!isset($result['data'])) {
            return array(
                'errcode' => 3004,
                'errmsg' => '远程服务器响应异常',
            );
        }
        if ($result['data']['error_code']) {
            return array(
                'errcode' => 3005,
                'errmsg' => $result['data']['description'],
            );
        }
        return array(
            'errcode' => 0,
            'errmsg' => 'success',
            'data' => array(
                'item_id' => $result['data']['item_id'],
            ),
        );
    }
    /*
     * 上传视频
     */
    public function uploadVideo($data = array())
    {
        if (!(isset($data['access_token']) && $data['access_token'])) {
            return array(
                'errcode' => 3001,
                'errmsg' => 'access_token不能为空',
            );
        }
        if (!(isset($data['openid']) && $data['openid'])) {
            return array(
                'errcode' => 3002,
                'errmsg' => 'openid不能为空',
            );
        }
        if (!(isset($data['video']) && $data['video'])) {
            return array(
                'errcode' => 3003,
                'errmsg' => '视频文件不能为空',
            );
        }
        $access_token = $data['access_token'];
        $openid = $data['openid'];
        $video = realpath($data['video']);
        $this->panel = 'video/upload/';
        $this->body = array(
            'video' => new \CURLFile($video),
        );
        $this->header = array(
            'Content-Type: multipart/form-data',
            'access-token: ' . $access_token,
        );
        $url = $this->apiUrl . $this->panel . '?open_id=' . $openid;
        $result = json_decode($this->post($url, $this->body), true);
        if (!isset($result['data'])) {
            return array(
                'errcode' => 3004,
                'errmsg' => '远程服务器响应异常',
            );
        }
        if ($result['data']['error_code']) {
            return array(
                'errcode' => 3005,
                'errmsg' => $result['data']['description'],
            );
        }
        return array(
            'errcode' => 0,
            'errmsg' => 'success',
            'data' => array(
                'video_id' => $result['data']['video']['video_id'],
                'width' => $result['data']['video']['width'],
                'height' => $result['data']['video']['height'],
            ),
        );
    }
    /*
     * 上传图片
     */
    public function uploadImage($data = array())
    {
        if (!(isset($data['access_token']) && $data['access_token'])) {
            return array(
                'errcode' => 3001,
                'errmsg' => 'access_token不能为空',
            );
        }
        if (!(isset($data['openid']) && $data['openid'])) {
            return array(
                'errcode' => 3002,
                'errmsg' => 'openid不能为空',
            );
        }
        if (!(isset($data['image']) && $data['image'])) {
            return array(
                'errcode' => 3003,
                'errmsg' => '图片文件不能为空',
            );
        }
        $access_token = $data['access_token'];
        $openid = $data['openid'];
        $image = realpath($data['image']);
        $this->panel = 'image/upload/';
        $this->body = array(
            'image' => new \CURLFile($image),
        );
        $this->header = array(
            'Content-Type: multipart/form-data',
            'access-token: ' . $access_token,
        );
        $url = $this->apiUrl . $this->panel . '?open_id=' . $openid;
        $result = json_decode($this->post($url, $this->body), true);
        if (!isset($result['data'])) {
            return array(
                'errcode' => 3004,
                'errmsg' => '远程服务器响应异常',
            );
        }
        if ($result['data']['error_code']) {
            return array(
                'errcode' => 3005,
                'errmsg' => $result['data']['description'],
            );
        }
        return array(
            'errcode' => 0,
            'errmsg' => 'success',
            'data' => array(
                'image_id' => $result['data']['image']['image_id'],
                'width' => $result['data']['image']['width'],
                'height' => $result['data']['image']['height'],
            ),
        );
    }
    /*
     * 获取用户信息
     */
    public function getUserInfo($data = array())
    {
        if (!(isset($data['access_token']) && $data['access_token'])) {
            return array(
                'errcode' => 3001,
                'errmsg' => 'access_token不能为空',
            );
        }
        if (!(isset($data['openid']) && $data['openid'])) {
            return array(
                'errcode' => 3002,
                'errmsg' => 'openid不能为空',
            );
        }
        $access_token = $data['access_token'];
        $openid = $data['openid'];
        $this->panel = 'oauth/userinfo/';
        $this->body = array(
            'open_id' => $openid,
            'access_token' => $access_token,
        );
        $this->header = array();
        $url = $this->apiUrl . $this->panel;
        $result = json_decode($this->post($url, $this->body), true);
        if (!isset($result['data'])) {
            return array(
                'errcode' => 3003,
                'errmsg' => '远程服务器响应异常',
            );
        }
        if ($result['data']['error_code']) {
            return array(
                'errcode' => 3004,
                'errmsg' => $result['data']['description'],
            );
        }
        return array(
            'errcode' => 0,
            'errmsg' => 'success',
            'data' => array(
                'union_id' => $result['data']['union_id'],
                'open_id' => $result['data']['open_id'],
                'nickname' => $result['data']['nickname'],
                'avatar' => $result['data']['avatar'],
                'gender' => $result['data']['gender'],
                'country' => $result['data']['country'],
                'province' => $result['data']['province'],
                'city' => $result['data']['city'],
                'e_account_role' => $result['data']['e_account_role'],
            ),
        );
    }

    public function video_list_pages($video_list=array()) {
        foreach($video_list as $k=>$v) {
            if($v['video_status'] > 1) {
                continue;
            }
            $this_statistics = $v['statistics'];
            $arr = [];
            foreach($v as $key=>$val) {
                $arr[$k][$key] = $val;
            }
            $this->video_arr[] = $arr;
            foreach($this->statistics as $k2=>$v2) {
                $this->statistics[$k2] += $this_statistics[$k2];
            }
        }
    }

    public function reply_list_pages($reply_list=array()) {
        if($reply_list) {
            $this->reply_arr[] = $reply_list;
        }
    }

    public function user_list_pages($user_list=array()) {
        if($user_list) {
            $this->user_arr[] = $user_list;
        }
    }

    /*
     * 获取视频信息
     */
    public function getVideoList($data = array())
    {
        $this->page += 1;
        if (!(isset($data['access_token']) && $data['access_token'])) {
            return array(
                'errcode' => 3001,
                'errmsg' => 'access_token不能为空',
            );
        }
        if (!(isset($data['openid']) && $data['openid'])) {
            return array(
                'errcode' => 3002,
                'errmsg' => 'openid不能为空',
            );
        }
        if (!(isset($data['cursor']))) {
            return array(
                'errcode' => 3003,
                'errmsg' => 'cursor不能为空',
            );
        }
        $access_token = $data['access_token'];
        $openid = $data['openid'];
        $cursor = $data['cursor'];
        $this->panel = 'video/list/';
        $this->header = array(
            'Content-Type: application/json',
            'access-token: '.$access_token,
        );
        $url = $this->apiUrl . $this->panel.'?open_id='.$openid.'&cursor='.$cursor.'&count=20';
        $result = json_decode($this->get($url), true);
        if (!isset($result['data'])) {
            return array(
                'errcode' => 3003,
                'errmsg' => '远程服务器响应异常',
            );
        }
        if ($result['data']['error_code']) {
            return array(
                'errcode' => 3004,
                'errmsg' => $result['data']['description'],
            );
        }
        if(isset($result['data']['cursor']) && $result['data']['cursor']) {
            $cursor = $result['data']['cursor'];
        }
        $video_list = $result['data']['list'];
        $this->video_list_pages($video_list);
        if($result['data']['has_more'] && $this->page <= 5000) {
            return $this->getVideoList(array(
                'openid' => $openid,
                'access_token' => $access_token,
                'cursor' => $cursor,
            ));
        } else {
            $return = [];
            $return['statistics'] = $this->statistics;
            $return['video_arr'] = $this->video_arr;
            $this->video_arr = [];
            $this->statistics =  [
                'comment_count'=>0,
                'digg_count'=>0,
                'download_count'=>0,
                'forward_count'=>0,
                'play_count'=>0,
                'share_count'=>0,
            ];
            return array(
                'errcode' => 0,
                'errmsg' => 'success',
                'data' => $return,
            );
            die;
        }
    }

    /*
     * 获取评论信息
     */
    public function getReplyList($data = array())
    {
        $this->page += 1;
        if (!(isset($data['access_token']) && $data['access_token'])) {
            return array(
                'errcode' => 3001,
                'errmsg' => 'access_token不能为空',
            );
        }
        if (!(isset($data['openid']) && $data['openid'])) {
            return array(
                'errcode' => 3002,
                'errmsg' => 'openid不能为空',
            );
        }
        if (!(isset($data['cursor']))) {
            return array(
                'errcode' => 3003,
                'errmsg' => 'cursor不能为空',
            );
        }
        if (!(isset($data['item_id']))) {
            return array(
                'errcode' => 3004,
                'errmsg' => '视频id不能为空',
            );
        }
        $access_token = $data['access_token'];
        $openid = $data['openid'];
        $cursor = $data['cursor'];
        $item_id = $data['item_id'];
        $this->panel = 'video/comment/list/';
        $this->header = array(
            'Content-Type: application/json',
            'access-token: '.$access_token,
        );
        $url = $this->apiUrl . $this->panel.'?open_id='.$openid.'&item_id='.urlencode($item_id).'&cursor='.$cursor.'&count=20';
        $result = json_decode($this->get($url), true);
        if (!isset($result['data'])) {
            return array(
                'errcode' => 3003,
                'errmsg' => '远程服务器响应异常',
            );
        }
        if ($result['data']['error_code']) {
            return array(
                'errcode' => 3004,
                'errmsg' => $result['data']['description'],
            );
        }
        if(isset($result['data']['cursor']) && $result['data']['cursor']) {
            $cursor = $result['data']['cursor'];
        }
        $reply_list = $result['data']['list'];
        $this->reply_list_pages($reply_list);
        if($result['data']['has_more'] && $this->page <= 5000) {
            return $this->getReplyList(array(
                'openid' => $openid,
                'item_id' => $item_id,
                'access_token' => $access_token,
                'cursor' => $cursor,
            ));
        } else {
            $return = $this->reply_arr;
            $this->reply_arr = [];
            return array(
                'errcode' => 0,
                'errmsg' => 'success',
                'data' => $return,
            );
            die;
        }
    }

    /*
     * 回复评论
     */
    public function getReplyAuto($data = array())
    {
        if (!(isset($data['access_token']) && $data['access_token'])) {
            return array(
                'errcode' => 3001,
                'errmsg' => 'access_token不能为空',
            );
        }
        if (!(isset($data['openid']) && $data['openid'])) {
            return array(
                'errcode' => 3002,
                'errmsg' => 'openid不能为空',
            );
        }
        if (!(isset($data['item_id']) && $data['item_id'])) {
            return array(
                'errcode' => 3003,
                'errmsg' => 'item_id不能为空',
            );
        }
        if (!(isset($data['comment_id']) && $data['comment_id'])) {
            return array(
                'errcode' => 3004,
                'errmsg' => 'comment_id不能为空',
            );
        }
        if (!(isset($data['content']) && $data['content'])) {
            return array(
                'errcode' => 3005,
                'errmsg' => 'content不能为空',
            );
        }
        $access_token = $data['access_token'];
        $openid = $data['openid'];
        $item_id = $data['item_id'];
        $comment_id = $data['comment_id'];
        $content = $data['content'];
        $this->panel = 'video/comment/reply/?open_id='.$openid;
        $this->body = array(
            'comment_id' => $comment_id,
            'item_id' => $item_id,
            'content' => $content,
        );
        $this->header = array(
            'Content-Type: application/json',
            'access-token: ' . $access_token
        );
        $url = $this->apiUrl . $this->panel;
        $result = json_decode($this->post($url, json_encode($this->body)), true);
        if (!isset($result['data'])) {
            return array(
                'errcode' => 3003,
                'errmsg' => '远程服务器响应异常',
            );
        }
        if ($result['data']['error_code']) {
            return array(
                'errcode' => 3004,
                'errmsg' => $result['data']['description'],
            );
        }
        return array(
            'errcode' => 0,
            'errmsg' => 'success',
            'data' => $result['data']
        );
    }

    /*
     * 获取客户信息
     */
    public function getCustomerList($data = array())
    {
        $this->page += 1;
        if (!(isset($data['access_token']) && $data['access_token'])) {
            return array(
                'errcode' => 3001,
                'errmsg' => 'access_token不能为空',
            );
        }
        if (!(isset($data['openid']) && $data['openid'])) {
            return array(
                'errcode' => 3002,
                'errmsg' => 'openid不能为空',
            );
        }
        if (!(isset($data['cursor']))) {
            return array(
                'errcode' => 3003,
                'errmsg' => 'cursor不能为空',
            );
        }
        $start_time = $data['customer_refresh_time'];
        $access_token = $data['access_token'];
        $openid = $data['openid'];
        $cursor = $data['cursor'];
        $this->panel = 'enterprise/leads/user/list/';
        $this->header = array(
            'Content-Type: application/json',
            'access-token: '.$access_token,
        );
        if($start_time <= 0 ) {
            $start_time = time()-86400*30*12;
        }
        $start_time = $start_time - 86400;
        $url = $this->apiUrl . $this->panel.'?open_id='.$openid.'&cursor='.$cursor.'&count=10&start_time='.$start_time.'&end_time='.time().'&action_type=0';
        $result = json_decode($this->get($url), true);
        if (!isset($result['data'])) {
            return array(
                'errcode' => 3003,
                'errmsg' => '远程服务器响应异常',
            );
        }
        if ($result['data']['error_code']) {
            return array(
                'errcode' => 3004,
                'errmsg' => $result['data']['description'],
            );
        }
        if(isset($result['data']['cursor']) && $result['data']['cursor']) {
            $cursor = $result['data']['cursor'];
        }
        if(!isset($result['data']['users']) || !$result['data']['users']) {
            return array(
                'errcode' => 3003,
                'errmsg' => '没有新客户',
            );
        }
        $user_list = $result['data']['users'];
        $this->user_list_pages($user_list);
        if($result['data']['has_more'] && $this->page <= 5000) {
            return $this->getCustomerList(array(
                'openid' => $openid,
                'access_token' => $access_token,
                'cursor' => $cursor,
                'customer_refresh_time'=>$start_time
            ));
        } else {
            $return = $this->user_arr;
            $this->user_arr = [];
            return array(
                'errcode' => 0,
                'errmsg' => 'success',
                'data' => $return,
            );
            die;
        }
    }

    /*
     * 给客户发私信
     */
    public function toCustomerChat($data = array())
    {
        if (!(isset($data['access_token']) && $data['access_token'])) {
            return array(
                'errcode' => 3001,
                'errmsg' => 'access_token不能为空',
            );
        }
        if (!(isset($data['openid']) && $data['openid'])) {
            return array(
                'errcode' => 3002,
                'errmsg' => 'openid不能为空',
            );
        }
        if (!(isset($data['to_user_id']) && $data['to_user_id'])) {
            return array(
                'errcode' => 3003,
                'errmsg' => 'to_user_id不能为空',
            );
        }
        if (!(isset($data['message_type']) && $data['message_type'])) {
            return array(
                'errcode' => 3004,
                'errmsg' => 'message_type不能为空',
            );
        }
        if (!(isset($data['content']) && $data['content'])) {
            return array(
                'errcode' => 3005,
                'errmsg' => 'content不能为空',
            );
        }
        $access_token = $data['access_token'];
        $openid = $data['openid'];

        $to_user_id = $data['to_user_id'];
        $message_type = $data['message_type'];
        $content[$message_type] = $data['content'];
        $this->panel = 'enterprise/im/message/send?open_id='.$openid;
        $this->body = array(
            'to_user_id' => $to_user_id,
            'message_type' => $message_type,
            'content' => json_encode($content),
        );
        $this->header = array(
            'Content-Type: application/json',
            'access-token: ' . $access_token
        );
        $url = $this->apiUrl . $this->panel;
        $result = json_decode($this->post($url, json_encode($this->body)), true);
        if (!isset($result['data'])) {
            return array(
                'errcode' => 3003,
                'errmsg' => '远程服务器响应异常',
            );
        }
        if ($result['data']['error_code']) {
            return array(
                'errcode' => 3004,
                'errmsg' => $result['data']['description'],
            );
        }
        return array(
            'errcode' => 0,
            'errmsg' => 'success',
            'data' => $result['data']
        );
    }

    /*
     * 刷新access_token
     */
    public function refreshAccessToken($refresh_token)
    {
        $this->panel = 'oauth/renew_refresh_token/';
        $this->body = array(
            'client_key' => $this->clientKey,
            'refresh_token' => $refresh_token,
        );
        $this->header = array(
            'Content-Type: multipart/form-data',
        );
        $url = $this->apiUrl . $this->panel;
        $result = json_decode($this->post($url, $this->body), true);
        if (!isset($result['data'])) {
            return array(
                'errcode' => 3001,
                'errmsg' => '远程服务器响应异常',
            );
        }
        if ($result['data']['error_code']) {
            return array(
                'errcode' => 3002,
                'errmsg' => $result['data']['description'],
            );
        }
        return array(
            'errcode' => 0,
            'errmsg' => 'success',
            'data' => array(
                'refresh_token' => $result['data']['refresh_token'],
                'expires_in' => (int) $result['data']['expires_in'] - 300,
            ),
        );
    }

    /*
     * 刷新access_token
     */
    public function reAccessToken($refresh_token)
    {
        $this->panel = 'oauth/refresh_token/';
        $this->body = array(
            'client_key' => $this->clientKey,
            'grant_type' => 'refresh_token',
            'refresh_token' => $refresh_token,
        );
        $this->header = array(
            'Content-Type: multipart/form-data',
        );
        $url = $this->apiUrl . $this->panel;
        $result = json_decode($this->post($url, $this->body), true);
        if (!isset($result['data'])) {
            return array(
                'errcode' => 3001,
                'errmsg' => '远程服务器响应异常',
            );
        }
        if ($result['data']['error_code']) {
            return array(
                'errcode' => 3002,
                'errmsg' => $result['data']['description'],
            );
        }
        return array(
            'errcode' => 0,
            'errmsg' => 'success',
            'data' => $result['data']
        );
    }

    /*
     * 获取access_token
     */
    public function getAccessToken($code)
    {
        $this->panel = 'oauth/access_token/';
        $this->body = array(
            'client_key' => $this->clientKey,
            'client_secret' => $this->clientSecret,
            'grant_type' => 'authorization_code',
            'code' => $code,
        );
        $this->header = array(
            'Content-Type: multipart/form-data',
        );
        $url = $this->apiUrl . $this->panel;
        $result = json_decode($this->post($url, $this->body), true);
        if (!isset($result['data'])) {
            return array(
                'errcode' => 3001,
                'errmsg' => '远程服务器响应异常',
            );
        }
        if ($result['data']['error_code']) {
            return array(
                'errcode' => 3002,
                'errmsg' => $result['data']['description'],
            );
        }
        return array(
            'errcode' => 0,
            'errmsg' => 'success',
            'data' => array(
                'access_token' => $result['data']['access_token'],
                'expires_in' => (int) $result['data']['expires_in'] - 300,
                'open_id' => $result['data']['open_id'],
                'refresh_expires_in' => (int) $result['data']['refresh_expires_in'],
                'refresh_token' => $result['data']['refresh_token'],
                'scope' => $result['data']['scope'],
            ),
        );
    }
    /*
     * http协议发送get请求
     */
    private function get($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 2);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        if ($this->header) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->header);
        }
        $out = curl_exec($ch);
        curl_close($ch);
        return $out;
    }
    /*
     * http协议发送post请求
     */
    private function post($url, $data = '')
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        if ($this->header) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->header);
        }
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}