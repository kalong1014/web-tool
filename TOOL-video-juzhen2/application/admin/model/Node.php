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
use think\Db;

class Node extends Model
{

    protected $name = "auth_rule";


    /**
     * [getNodeInfo 获取节点数据]
     */
    public function getNodeInfo($id)
    {
        $result = $this->field('id,title,pid')->select();
        $str = "";
        $role = new UserType();
        $rule = $role->getRuleById($id);

        if(!empty($rule)){
            $rule = explode(',', $rule);
        }
        foreach($result as $key=>$vo){
            $str .= '{ "id": "' . $vo['id'] . '", "pId":"' . $vo['pid'] . '", "name":"' . $vo['title'].'"';

            if(!empty($rule) && in_array($vo['id'], $rule)){
                $str .= ' ,"checked":1';
            }

            $str .= '},';
        }

        return "[" . substr($str, 0, -1) . "]";
    }


    /**
     * [getMenu 根据节点数据获取对应的菜单]
     */
    public function getMenu($nodeStr = '')
    {
        //超级管理员没有节点数组
        //$where = empty($nodeStr) || $nodeStr == "SUPERAUTH" ? 'status = 1' : 'status = 1 and id in('.$nodeStr.')';
        $where = empty($nodeStr) ? 'status = 1' : 'status = 1 and id in('.$nodeStr.')';

        $result = Db::name('auth_rule')->where($where)->order('sort','desc')->select();
        $menu = prepareMenu($result);
       
        return $menu;
    }
/**
*   @中网智达(河北)网络科技有限公司
*   @短视频矩阵智能营销系统
*   @电话:18518753561
*   @QQ  :192129979
*   
*/
}