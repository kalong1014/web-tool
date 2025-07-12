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

use think\Db;
use Think\Model;
use think\Controller;
header("Content-Type: text/html;charset=utf-8");
/**
 * Seo控制器
 */
class Uplade extends Controller
{
	private $getUrl = 'http://shengji.sddianfeng.cn/';
	public function index()
	{
		$patch_str = @file_get_contents($this->getUrl);
		$system_version = config('system_version');
		$pathlist = $allpathlist = array();
		// 获取所有升级包
		preg_match_all("/\"(zhida_[\d]{8}+\.zip)\"/", $patch_str, $allpathlist);
		$allpathlist = $allpathlist['0'];
		if (empty($allpathlist)) {
			return json(['code' => 2, 'msg' => '当前是最新版本']);
		}
		foreach ($allpathlist as $k => $v) {
			preg_match("/zhida_([\d]{8})+\.zip/", $v, $p);
			if (empty($p) || $p[1] <= $system_version) {
				continue;
			}
			$pathlist[] = $p[0];
		}
		$data['url'] = $pathlist[0];
		$data['addtime'] = time();
		$type = input('post.type');
		if ($type == 1) {
			//获取数据库版本信息
			$bat = db::name('bat_b')->where('url', $pathlist[0])->find();
			if (empty($bat)) {
				return json(['code' => 1]);
			} else {
				return json(['code' => 2, 'msg' => '当前是最新版本']);
			}
		}
		if (count($pathlist) == 0) {
			return json(['code' => 2, 'msg' => '当前是最新版本']);
			//$this->jump([RESULT_ERROR, "没有可升级的安装包"]);
		}
		$cacheName = "./caches_upgrade";
		if (!file_exists('./caches_upgrade')) {
			@mkdir('./caches_upgrade');
		}
		//-----------------------------------下载地址
		foreach ($pathlist as $ks => $vs) {
			preg_match("/zhida_([\d]{8})+\.zip/", $vs, $name);
			//远程压缩包地址
			$zip_url = $this->getUrl . $vs;
			//解压补丁文件地址
			$source_path = $cacheName . DIRECTORY_SEPARATOR . basename($vs, ".zip");
			//本地压缩包地址
			$local_path = $cacheName . "/" . $vs;
			@file_put_contents($local_path, @file_get_contents($zip_url));
			//=============================解压文件
			$pclzip = new \pclzip\PclZip();
			$Dir = new \pclzip\Dir(ROOT_PATH);
			$pclzip->PclZip($local_path);
			if ($pclzip->extract(PCLZIP_OPT_PATH, $source_path) == 0) {
				die("Error : " . $pclzip->errorInfo(true));
			}
			$copy_from = $source_path;
			$copy_to = ROOT_PATH;
			$Dir->copyDir($copy_from, $copy_to);
			$model2 = controller("admin/Sql");
			$model2->index();
			//    -----------------------------删除目录
			@unlink($local_path);
			$Dir->delDir($source_path);
		}
		db::name('bat_b')->insert($data);
		sleep(5);
		return json(['code' => 1, 'msg' => '升级成功,请重新登录系统']);
	}
}