<?php
//declare (strict_types = 1);

namespace app\command;
use app\admin\model\UploadTask as UploadTaskModel;
use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;

class UploadTask extends Command
{
    protected function configure()
    {
        // 指令配置
        $this->setName('UploadTask')->setDescription('the uploadtask command');
    }

    protected function execute(Input $input, Output $output)
    {
        $this->upload_task();
    }

    public function upload_task() {
        $where = [];
        $where['delete_time'] = 0;
        $tasks = UploadTaskModel::where($where)->find();
        $info = $this -> ALupload($tasks['name'],$tasks['tmp_url'],$tasks['types'],$tasks['uid']);
        dump($info);die;


    }

    public function ALupload($object,$filePath,$types='',$uid){

        $AL = db::name('api')->where('uid',$uid)->find();
        if(empty($AL['alykeyId']) || empty($AL['alykeysecret']) || empty($AL['alybuket']) || empty($AL['alybuketname'])){
            echo '未配置阿里云oss信息';
            return;
        }
        $accessKeyId =  $AL['alykeyId'];
        $accessKeySecret = $AL['alykeysecret'];
        // yourEndpoint填写cBuket所在地域对应的Endpoint。以华东1（杭州）为例，Endpoint填写为https://oss-cn-hangzhou.aliyuncs.com。
        $endpoint = $AL['alybuket'];
        // 填写Bucket名称，例如examplebucket。
        //https://bucketexample.oss-cn-hangzhou.aliyuncs.com/example/example.jpg
        $bucket= $AL['alybuketname'];
        // 填写Object完整路径，例如exampledir/exampleobject.txt。Object完整路径中不能包含Bucket名称。
        $object = $object;
        // <yourLocalFile>由本地文件路径加文件名包括后缀组成，例如/users/local/myfile.txt。
        // 填写本地文件的完整路径，例如D:\\localpath\\examplefile.txt。如果未指定本地路径，则默认从示例程序所属项目对应本地路径中上传文件。https:\\study.cnzd.vip\\1.jpg
        //$video_file = $_SERVER['DOCUMENT_ROOT'].'/uploads/images/20220311/181a82985bcca4036082c126b2531830.png';
        $filePath =$filePath;
//     dump(1);die;
        try{
            $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);

            $url  = $ossClient->uploadFile($bucket, $object, $filePath);

            return $url['oss-request-url'];
        } catch(OssException $e) {
//          dump(1);die;
            printf(__FUNCTION__ . ": FAILED\n");
            printf($e->getMessage() . "\n");
            return;
        }
        print(__FUNCTION__ . "OK" . "\n");
    }


}
