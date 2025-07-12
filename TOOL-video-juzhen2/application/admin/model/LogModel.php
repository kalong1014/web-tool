<?php
/**
*   @中网智达(河北)网络科技有限公司
*   @短视频矩阵智能营销系统
*   @电话:18518753561
*   @QQ  :192129979
*   
*/
namespace app\admin\model;
use think\Model;

class LogModel extends Model
{
    protected $name = 'log';

    /**
     * 删除日志
     */
    public function delLog($log_id)
    {
        try{
            $this->where('log_id', $log_id)->delete();
            return ['code' => 1, 'data' => '', 'msg' => '删除日志成功'];
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

}