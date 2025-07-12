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

class AuthGroupAccessModel extends Model
{
    protected $name = 'auth_group_access';

  /**
*   @中网智达(河北)网络科技有限公司
*   @短视频矩阵智能营销系统
*   @电话:18518753561
*   @QQ  :192129979
*   @添加用户关联
*   
*/
    public function addUser($param)
    {
        try{
            $result = $this->save($param);
            if(false === $result){
                writelog(session('uid'),session('username'),'用户【'.session('username').'】添加用户关联失败',2);
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
                writelog(session('uid'),session('username'),'用户【'.session('username').'】添加用户关联成功',1);
                return ['code' => 1, 'data' => '', 'msg' => '添加用户成功'];
            }
        }catch( PDOException $e){
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }
}