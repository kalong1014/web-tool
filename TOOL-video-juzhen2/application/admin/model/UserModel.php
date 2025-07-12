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

class UserModel extends Model
{
    protected $name = 'admin';

    /**
     * 根据搜索条件获取用户列表信息
     */
    public function getUsersByWhere($map, $Nowpage, $limits)
    {
        return $this->field('think_admin.*,title')->join('think_auth_group', 'think_admin.groupid = think_auth_group.id')
            ->where($map)->page($Nowpage, $limits)->order('id desc')->select();
    }

    /**
     * 根据搜索条件获取所有的用户数量
     * @param $where
     */
    public function getAllUsers($where)
    {
        return $this->where($where)->count();
    }

    /**
     * 插入管理员信息
     * @param $param
     */
    public function insertUser($param)
    {
        try{
            $result = $this->validate('UserValidate')->save($param);
            if(false === $result){            
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '添加用户成功'];
            }
        }catch( PDOException $e){
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    /**
     * 编辑管理员信息
     * @param $param
     */
    public function editUser($param)
    {
        try{
            $result =  $this->validate('UserValidate')->save($param, ['id' => $param['id']]);
            if(false === $result){            
                return ['code' => 0, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '编辑用户成功'];
            }
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }


    /**
     * 根据管理员id获取角色信息
     * @param $id
     */
    public function getOneUser($id)
    {
        return $this->where('id', $id)->find();
    }


    /**
     * 删除管理员
     * @param $id
     */
    public function delUser($id)
    {
        try{

            $this->where('id', $id)->delete();
            writelog(session('uid'),session('username'),'用户【'.session('username').'】删除管理员成功(ID='.$id.')',1);
            return ['code' => 1, 'data' => '', 'msg' => '删除管理员成功'];

        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }
/**
*   @中网智达(河北)网络科技有限公司
*   @短视频矩阵智能营销系统
*   @电话:18518753561
*   @QQ  :192129979
*   
*/
}