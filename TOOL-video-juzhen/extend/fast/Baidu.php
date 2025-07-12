<?php 
namespace fast;
use think\Db;
use think\Config;

class Baidu
{
    protected $API_KEY;
    protected $SECRET_KEY;
    public $data = null;
 
    public function __construct($api='',$secret='')
    {
        $config = Config::get('site');
        $this->API_KEY = $api; 
        $this->SECRET_KEY = $secret; 
    }
 
    public function ai_chat($content = '') {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://aip.baidubce.com/rpc/2.0/ai_custom/v1/wenxinworkshop/chat/eb-instant?access_token={$this->getAccessToken()}",
            CURLOPT_TIMEOUT => 30,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER  => false,
            CURLOPT_SSL_VERIFYHOST  => false,
            CURLOPT_CUSTOMREQUEST => 'POST',
            
            CURLOPT_POSTFIELDS =>'{"messages":[{"role":"user","content":"'.$content.'"}]}',
    
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),

        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    
    /**
     * 使用 AK，SK 生成鉴权签名（Access Token）
     * @return string 鉴权签名信息（Access Token）
     */
    private function getAccessToken(){
        $curl = curl_init();
        $postData = array(
            'grant_type' => 'client_credentials',
            'client_id' => $this->API_KEY,
            'client_secret' => $this->SECRET_KEY
        );
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://aip.baidubce.com/oauth/2.0/token',
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_SSL_VERIFYPEER  => false,
            CURLOPT_SSL_VERIFYHOST  => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => http_build_query($postData)
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $rtn = json_decode($response);
        return @$rtn->access_token;
    }
}