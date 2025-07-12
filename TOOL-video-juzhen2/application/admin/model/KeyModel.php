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

class KeyModel extends Model
{
    protected $name = 'adminkey';
    
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = true;


    
    public function getAllMenu()
    {
        return $this->order('id asc')->select();       
    }


   
    public function insertModel($param='')
    {   
        dump($name);die;
        
        // try{
        //     $result = $this->save($param);
        //     if(false === $result){            
        //         writelog(session('uid'),session('username'),'用户【'.session('username').'】添加菜单失败',2);
        //         return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
        //     }else{
        //         writelog(session('uid'),session('username'),'用户【'.session('username').'】添加菜单成功',1);
        //         return ['code' => 1, 'data' => '', 'msg' => '添加菜单成功'];
        //     }
        // }catch( PDOException $e){
        //     return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        // }
    }



    
    public function editMenu($param)
    {
        try{
            $result =  $this->save($param, ['id' => $param['id']]);
            if(false === $result){
                writelog(session('uid'),session('username'),'用户【'.session('username').'】编辑菜单失败',2);
                return ['code' => 0, 'data' => '', 'msg' => $this->getError()];
            }else{
                writelog(session('uid'),session('username'),'用户【'.session('username').'】编辑菜单成功',1);
                return ['code' => 1, 'data' => '', 'msg' => '编辑菜单成功'];
            }
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }



    
    public function getOneMenu($id)
    {
        return $this->where('id', $id)->find();
    }




    public function delMenu($id)
    {
        try{
            $this->where('id', $id)->delete();
            writelog(session('uid'),session('username'),'用户【'.session('username').'】删除菜单成功',1);
            return ['code' => 1, 'data' => '', 'msg' => '删除菜单成功'];
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }
    
    

}