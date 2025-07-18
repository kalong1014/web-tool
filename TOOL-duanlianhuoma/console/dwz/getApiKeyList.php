<?php

    /**
     * 状态码说明
     * 200 成功
     * 201 未登录
     * 202 失败
     * 203 空值
     * 204 无结果
     */

	// 页面编码
	header("Content-type:application/json");
	
	// 判断登录状态
    session_start();
    if(isset($_SESSION["yinliubao"])){
        
        // 接收参数
    	@$page = $_GET['p']?$_GET['p']:1;
    	
        // 当前登录的用户
        $LoginUser = $_SESSION["yinliubao"];
        
        // 数据库配置
    	include '../Db.php';
    
    	// 实例化类
    	$db = new DB_API($config);
    
    	// 获取总数
    	$apiKeyNum = $db->set_table('huoma_dwz_apikey')->getCount(['apikey_creat_user'=>$LoginUser]);
    
    	// 每页数量
    	$lenght = 10;
    
    	// 每页第一行
    	$offset = ($page-1)*$lenght;
    
    	// 总页码
    	$allpage = ceil($apiKeyNum/$lenght);
    
    	// 上一页     
    	$prepage = $page-1;
    	if($page == 1){
    		$prepage=1;
    	}
    
    	// 下一页
    	$nextpage = $page+1;
    	if($page == $allpage){
    		$nextpage=$allpage;
    	}
    	
        // 获取当前登录用户的管理权限
        $user_admin = json_decode(json_encode($db->set_table('huoma_user')->find(['user_name'=>$LoginUser])))->user_admin;
        
        if($user_admin == 1){
            
            // 获取当前登录用户创建的apiKey，每页10个DESC排序
        	$getapiKeyList = $db->set_table('huoma_dwz_apikey')->findAll(
        	    $conditions = ['apikey_creat_user' => $LoginUser],
        	    $order = 'ID DESC',
        	    $fields = null,
        	    $limit = ''.$offset.','.$lenght.''
        	);
        	
            // 判断获取结果
        	if($getapiKeyList && $getapiKeyList > 0){
        	    
        	    // 获取成功
        		$result = array(
        		    'apiKeyList' => $getapiKeyList,
        		    'prepage' => $prepage,
        		    'nextpage' => $nextpage,
        		    'allpage' => $allpage,
        		    'page' => $page,
        		    'user_admin' => $user_admin,
        		    'code' => 200,
        		    'msg' => '获取成功'
        		);
        	}else{
        	    
        	    // 获取失败
                $result = array(
                    'code' => 204,
                    'msg' => '暂无数据'
                );
        	}
        }else{
            
            // 获取失败
            $result = array(
                'code' => 204,
                'msg' => '没有管理权限'
            );
        }
    }else{
        
        // 未登录
        $result = array(
			'code' => 201,
            'msg' => '未登录或登录过期'
		);
    }

	// 输出JSON
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
	
?>