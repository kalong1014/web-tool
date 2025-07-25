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
        
        // 已登录
    	$qun_id = trim($_GET['qun_id']);
    	
        // 过滤参数
        if(empty($qun_id) || !isset($qun_id)){
            
            $result = array(
			    'code' => 203,
                'msg' => '非法请求'
		    );
        }else{
            
            // 当前登录的用户
            $LoginUser = $_SESSION["yinliubao"];
            
            // 数据库配置
        	include '../Db.php';
        
        	// 实例化类
        	$db = new DB_API($config);
        	
            // 验证用户
            $checkUser = $db->set_table('huoma_qun')->find(['qun_id' => $qun_id]);
            $qun_creat_user = json_decode(json_encode($checkUser))->qun_creat_user;
            
            if($qun_creat_user == $LoginUser){
                
                // 提交更新
                $resetQunPv = $db->set_table('huoma_qun')->update(['qun_id' => $qun_id,'qun_creat_user' => $LoginUser],['qun_pv' => 0,'qun_today_pv' => '{"pv":"0","date":"'.date('Y-m-d').'"}']);
                
                if($resetQunPv) {
                    
                    // 已重置
                    $result = array(
			            'code' => 201,
                        'msg' => '已重置'
		            );
                }else {
                    
                    // 重置失败
                    $result = array(
			            'code' => 201,
                        'msg' => '重置失败'
		            );
                }
            }else{
                
                // 不允许操作
                $result = array(
		            'code' => 201,
                    'msg' => '不允许操作'
	            );
            }
        }
    	
    }else{
        
        // 未登录
        $result = array(
			'code' => 201,
            'msg' => '未登录'
		);
    }

	// 输出JSON
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
	
?>