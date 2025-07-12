<?php

//decode by http://www.yunlu99.com/
/**
*   @中网智达(河北)网络科技有限公司
*   @短视频矩阵智能营销系统
*   @电话:18518753561
*   @QQ  :192129979
*   
*/
namespace app\admin\controller;

use app\admin\model\UserModel;
use app\admin\model\UserType;
use app\admin\model\AuthGroupAccessModel;
use app\admin\model\PclZip;
use think\Db;
class Shouquan extends Base
{
	/**
	*   @中网智达(河北)网络科技有限公司
	*   @短视频矩阵智能营销系统
	*   @电话:18518753561
	*   @QQ  :192129979
	*   @用户列表
	*   
	*/
	public function index()
	{
		$list = db::name('shouquan')->select();
		$this->assign('list', $list);
		return $this->fetch();
	}
	/**
	 *
	 * 添加授权
	 */
	public function shouquan_add()
	{
		return $this->fetch();
	}
	/**
	    确定添加
	*/
	public function shouquan_add_d()
	{
		$data = input('post.');
		$merge = array_rand(array_flip(array_merge(range('A', 'Z'))), 1);
		$num = rand(0, 9) . $merge . rand(0, 9) . array_rand(array_flip(array_merge(range('A', 'Z'))), 1) . rand(0, 9) . rand(0, 9) . array_rand(array_flip(array_merge(range('A', 'Z'))), 1) . array_rand(array_flip(array_merge(range('A', 'Z'))), 1) . rand(0, 9) . rand(0, 9);
		$data['number'] = $num;
		$data['addtime'] = date('Y-m-d');
		$info = db::name('shouquan')->where('url', $data['url'])->find();
		if ($info) {
			$this->error('已添加过此域名');
		}
		$ip = db::name('shouquan')->where('ip', $data['ip'])->find();
		if ($ip) {
			$this->error('已有此ip地址');
		}
		$nu = db::name('shouquan')->where('number', $num)->find();
		if ($nu) {
			$data['number'] = rand(0, 9) . $merge . rand(0, 9) . array_rand(array_flip(array_merge(range('A', 'Z'))), 1) . rand(0, 9) . rand(0, 9) . array_rand(array_flip(array_merge(range('A', 'Z'))), 1) . array_rand(array_flip(array_merge(range('A', 'Z'))), 1) . rand(0, 9) . rand(0, 9);
		}
		$list = db::name('shouquan')->insert($data);
		if ($list) {
			$this->success('添加成功', url('index'));
		} else {
			$this->error('添加失败');
		}
	}
	/*
	编辑
	*/
	public function shouquan_edit()
	{
		$id = $_GET;
		$list = db::name('shouquan')->where('id', $id['id'])->find();
		$this->assign('list', $list);
		return $this->fetch();
	}
	/*
	    确认编辑
	*/
	public function shouquan_edit_t()
	{
		$id = input('post.id');
		$data = input('post.');
		$data['addtime'] = date('Y-m-d');
		unset($data['id']);
		$info = db::name('shouquan')->where('id', $id)->update($data);
		if ($info) {
			$this->success('编辑成功', url('index'));
		} else {
			$this->error('编辑失败,请稍后或联系管理员');
		}
	}
	/*
	删除
	*/
	public function delete()
	{
		$id = $_GET;
		$del = db::name('shouquan')->where('id', $id['id'])->delete();
		if ($del) {
			$this->success('删除成功', url('index'));
		} else {
			$this->error('删除失败,请稍后或联系管理员');
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