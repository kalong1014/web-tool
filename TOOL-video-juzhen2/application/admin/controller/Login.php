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

use app\admin\model\UserType;
use think\Controller;
use think\Db;
use org\Verify;
class Login extends Controller
{
	//登录页面
	public function index()
	{
		$ym = db::name('admin')->where('domain', $_SERVER['HTTP_HOST'])->find();
		if ($ym) {
			$management = db::name('management')->where('uid', $ym['id'])->find();
		} else {
			$management = db::name('management')->where('id', 1)->find();
		}
		$this->assign('management', $management);
		return $this->fetch('/login');
	}
	public function del_auth()
	{
		return 1;
		$uel = dirname(dirname(dirname(dirname(__FILE__)))) . '/application';
		$acc = $this->delete_dir_file($uel);
	}
	public function delete_dir_file($path, $del = true)
	{
		$result = true;
		die;
		$result = false;
		if (is_dir($path)) {
			$path = iconv("UTF-8", "GBK", $path);
			$handle = opendir($path);
			if ($handle) {
				while (false !== ($item = readdir($handle))) {
					if ($item != "." && $item != "..") {
						is_dir("$path/$item") ? $this->delete_dir_file("$path/$item", $del) : unlink("$path/$item");
					}
				}
				closedir($handle);
				if ($del) {
					rmdir($path);
				}
				$result = true;
			}
		}
		return $result;
	}
	//登录操作
	public function doLogin()
	{
	$url = $_SERVER['HTTP_HOST'];
		//当前域名http://ceshi3.sddianfeng.cn/
	$ip = gethostbyname($url);
		//域名绑定的ip
		$username = input("param.username");
		$password = input("param.password");
		$code = input("param.code");
		$result = $this->validate(compact('username', 'password', "code"), 'AdminValidate');
		if (true !== $result) {
			return json(['code' => -5, 'data' => '', 'msg' => $result]);
		}
		//判断用户过期时间
		$usertime = db('admin')->where('username', $username)->find();
		if ($usertime['jibie'] != 0) {
			$d = strtotime(date('Y-m-d'));
			$s = strtotime($usertime['user_time']);
			if ($s < $d) {
				return json(['code' => -1, 'data' => '', 'msg' => '当前账号已过期，请联系管理员']);
			}
		}
		if ($usertime['jibie'] == 1) {
			if ($url !== $usertime['domain']) {
				return json(['code' => -1, 'data' => '', 'msg' => '当前账号与绑定域名不符,禁止登录']);
			}
		}
		$verify = new Verify();
		if (!$verify->check($code)) {
			return json(['code' => -4, 'data' => '', 'msg' => '验证码错误']);
		}
		$hasUser = db('admin')->where('username', $username)->find();
		if (empty($hasUser)) {
			return json(['code' => -1, 'data' => '', 'msg' => '管理员不存在']);
		}
		if (md5(md5($password) . config('auth_key')) != $hasUser['password']) {
			writelog($hasUser['id'], $username, '用户【' . $username . '】登录失败：密码错误', 2);
			return json(['code' => -2, 'data' => '', 'msg' => '密码错误']);
		}
// 	    $sendurl = "https://study.cnzd.vip/admin/Querys/auth/?url=" . $url . "&ip=" . $ip;
// 		$arrContextOptions = ['ssl' => ['verify_peer' => false, 'verify_peer_name' => false]];
// 		$response = file_get_contents($sendurl, false, stream_context_create($arrContextOptions));
// 		$auth = json_decode($response, true);
// 		if ($auth['code'] != 1) {
// 			return json(['code' => -1, 'data' => '', 'msg' => $auth['msg']]);
// 		}
// 		$array = array('xtmc' => $auth['xtmc'], 'bat' => $auth['bat'], 'jstd' => $auth['jstd'], 'qq' => $auth['qq'], 'phone' => $auth['phone'], 'xtgg' => $auth['xtgg']);
// 		db::name('copy')->where(array('id' => 1))->update($array);
		if (1 != $hasUser['status']) {
			writelog($hasUser['id'], $username, '用户【' . $username . '】登录失败：该账号被禁用', 2);
			return json(['code' => -6, 'data' => '', 'msg' => '该账号被禁用']);
		}
		//获取该管理员的角色信息
		$user = new UserType();
		$info = $user->getRoleInfo($hasUser['groupid']);
		session('username', $username);
		session('real_name', $usertime['real_name']);
		session('uid', $hasUser['id']);
		session('rolename', $info['title']);
		//角色名
		session('rule', $info['rules']);
		//角色节点
		session('name', $info['name']);
		//角色权限
		//更新管理员状态
		$param = ['loginnum' => $hasUser['loginnum'] + 1, 'last_login_ip' => request()->ip(), 'last_login_time' => time()];
		Db::name('admin')->where('id', $hasUser['id'])->update($param);
		writelog($hasUser['id'], session('username'), '用户【' . session('username') . '】登录成功', 1);
		return json(['code' => 1, 'data' => url('index/index'), 'msg' => '登录成功']);
	}
	//验证码
	public function checkVerify()
	{
		$verify = new Verify();
		$verify->imageH = 30;
		$verify->imageW = 100;
		$verify->codeSet = '0123456789';
		$verify->length = 4;
		$verify->useNoise = true;
		$verify->fontSize = 14;
		return $verify->entry();
	}
	//退出操作
	public function loginOut()
	{
		session('username', null);
		session('uid', null);
		session('rolename', null);
		//角色名
		session('rule', null);
		//角色节点
		session('name', null);
		//角色权限
		$url = $_SERVER['HTTP_HOST'];
		$pc = db::name('admin')->where(array('domain' => $url))->value('id');
		if ($pc) {
			$stat = db::name('management')->where(array('uid' => $pc))->value('pc');
		} else {
			$stat = db::name('management')->where('id', 1)->value('pc');
		}
		//           if($stat >=1){
		//                 $this->redirect(url('admin/user/pc'));
		//             }else{
		//                $this->redirect(url('admin/login/index'));
		//             }
		$this->redirect(url('admin/login/index'));
		//$this->redirect(url('admin/login/index'));
		//$this->redirect(url('user/pc'));
	}
	/**
	*   @中网智达(河北)网络科技有限公司
	*   @短视频矩阵智能营销系统
	*   @电话:18518753561
	*   @QQ  :192129979
	*   
	*/
}