<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/index.html";i:1667886847;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="renderer" content="webkit">
<meta http-equiv="Cache-Control" content="no-siteapp"/>
<title><?php echo $list['biaoti']; ?></title>
<meta name="keywords" content="<?php echo $list['ci']; ?>">
<meta name="description" content="<?php echo $list['miaoshu']; ?>">

<!--[if lt IE 9]>
<meta http-equiv="refresh" content="0;ie.html"/>
<![endif]-->

<link rel="shortcut icon" href="favicon.ico">
<link href="__CSS__/bootstrap.min.css?v=3.3.6" rel="stylesheet">
<link href="/static/admin/css/font/iconfont.css" rel="stylesheet">
<link href="__CSS__/font-awesome.min.css?v=4.4.0" rel="stylesheet">
<link href="__CSS__/animate.min.css" rel="stylesheet">
<link href="__CSS__/style.min.css?v=4.1.0" rel="stylesheet">
<link href="__CSS__/select2.css" rel="stylesheet">
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<div id="wrapper">
    <!--左侧导航开始-->
    <nav class="navbar-default navbar-static-side" role="navigation" >
        <div class="nr-menu-logo">
            <img src="/static/admin/images/<?php echo $list['nylogo']; ?>" style="width:90%;vertical-align: middle;">
            <!--<b><?php echo $list['htname']; ?></b>-->
        </div>
        <div class="nav-close">
            <i class="fa fa-times-circle"></i>
        </div>
        <div class="sidebar-collapse" style="">
            <ul class="nav" id="side-menu" >

                <?php if(!empty($menu)): if(is_array($menu) || $menu instanceof \think\Collection): if( count($menu)==0 ) : echo "" ;else: foreach($menu as $key=>$vo): ?>
                    <li class="menu">
                        <?php if($vo['name'] == "#"): if($vo['title'] =='首页'): ?>
                            <a class="J_menuItem" href="javascript:;" id="export">
                                <span class="iconfont icon-gongnenglanicon_mobanguanli" style="float:left"></span>
                                后台首页
                            </a>
                            <?php elseif($vo['title']=='数据大屏'): ?>
                            <a class="J_menuItem" href="<?php echo url('Index/indexPage'); ?>"  onclick="sjdp()">
                               <span class="iconfont icon-chuangzuozhezhongxin" style="float:left"></span>
                               数据大屏
                            </a>
                            <?php else: ?>
                            <a class="J_menuItem">
                                <span class="iconfont <?php echo $vo['css']; ?>" style="float:left"></span>
                                <?php echo $vo['title']; ?>
                                <span class="fa arrow"></span>
                            </a>
                            <?php endif; else: ?>
                             <a class="J_menuItem" href="<?php echo $vo['name']; ?>">
                                <i class="<?php echo $vo['css']; ?>"></i>
                                <?php echo $vo['title']; ?>
                            </a>
                           
                        <?php endif; ?>
                       
                        <ul class="nav nav-second-level">

                            <?php if(!empty($vo['child'])): if(is_array($vo['child']) || $vo['child'] instanceof \think\Collection): if( count($vo['child'])==0 ) : echo "" ;else: foreach($vo['child'] as $key=>$v): ?>
                                <li>
                                    <?php if($v['title']=='添加账号2'): elseif($v['title']=='企业号分组'): ?>
                                       <a class="J_menuItem" href="javascript:;" onclick="kaifang(2)">企业号分组</a>
                                    <?php elseif($v['title']=='客户等级'): ?>
                                            <a class="J_menuItem" href="javascript:;" onclick="kaifang(2)">客户等级</a>
                                    <?php elseif($v['title']=='私信列表'): ?>
                                    <a class="J_menuItem" href="javascript:;" onclick="kaifang(2)">私信列表</a>
                                    <?php elseif($v['title']=='私信回复'): ?>
                                    <a class="J_menuItem" href="javascript:;" onclick="kaifang(2)">私信回复</a>
                                    <?php elseif($v['title']=='AI智能助手'): ?>
                                    <a class="J_menuItem" href="javascript:;" onclick="kaifang(2)">AI智能助手</a>
                                    <?php elseif($v['title']=='客户列表'): ?>
                                    <a class="J_menuItem" href="javascript:;" onclick="kaifang(2)">客户列表</a>
                                    <?php elseif($v['title'] =="新增标题"): ?>
                                     <a class="J_menuItem" href="<?php echo $v['href']; ?>"><?php echo $v['title']; ?></a>
                                       
                                    <?php else: if($v['title']=='创作热词'): ?>
                                         <a class="J_menuItem "  href="https://trendinsight.oceanengine.com/vertical-analysis?source=nav_portal">创作热词</a>
                                        <?php elseif($v['title'] =="热门视频"): ?>
                                         <a class="J_menuItem "  href="https://trendinsight.oceanengine.com/vertical-analysis?source=nav_portal">热门视频</a>
                                        <?php elseif($v['title'] =="热点话题"): ?>
                                          <a class="J_menuItem "  href="https://trendinsight.oceanengine.com/vertical-analysis?source=nav_portal">热点话题</a>
                                        <?php else: ?>
                                            <a class="J_menuItem "  href="<?php echo $v['href']; ?>"><?php echo $v['title']; ?></a>
                                        <?php endif; endif; ?>
                                    
                                </li>
                                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                        </ul>
                    </li>
                    <?php endforeach; endif; else: echo "" ;endif; endif; ?>
            </ul>
        </div>
    </nav>
    <!--左侧导航结束-->
    <!--右侧部分开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1" >

        <div class="row border-bottom" >
            <nav class="navbar navbar-static-top" role="navigation">
                <div class="navbar-header">
                     <a class="navbar-minimalize btn btn-primary " href="#"><i
                        class="fa fa-bars"></i> </a>
                        <?php if(is_array($menus) || $menus instanceof \think\Collection): if( count($menus)==0 ) : echo "" ;else: foreach($menus as $key=>$vo): ?>
                         <a class=" btn btn-primary "  href="http://<?php echo $vo['url']; ?>"  target="view_window" style="background:none;border:0"><?php echo $vo['menu']; ?></a>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>

                <div class="nav-top-usertime">
                    到期时间：<?php echo $user['user_time']; ?>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li class="" >
                       
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#" style="">
                            <div class="clear" style="font-size: 15px;">
                                <!--当前账号-->
                             
                                <div class="text-muted text-xs block">
                                    <span><?php echo $username; ?></span>
                                    <span class="caret"></span>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs" style="">
                            <li>

                                <a href="javascript:;" data-toggle="modal" data-target="#bianji">
                                    修改密码</a>
                            </li>
                            <li><a href="javascript:;" id="cache">清除缓存 </a></li>
                            <li><a href="<?php echo url('admin/login/loginOut'); ?>">安全退出</a></li>
                        </ul>
                    
                    </li>

                </ul>
            </nav>
        </div>
        <style>
            
            .page-tabs-content >a {
               border-radius:60%;
            }
        </style>
        
        <div class="row J_mainContent" id="content-main">
            <iframe class="J_iframe" name="iframe0" width="100%" height="100%"
                    src="<?php echo url('Index/indexPage'); ?>" frameborder="0"
                    data-id="index_v1.html" seamless></iframe>
        </div>
        <!-- <div class="footer">
            <div class="pull-right">&copy; 2016-2017版权所有
            </div>
        </div> -->
    </div>
    <!--右侧部分结束-->

    <!--编辑分类开始-->
    <div class="modal  fade" id="bianji" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title">修改密码</h3>
                </div>
                <form class="form-horizontal" name="add_rule" id="add_rule" method="post" action="">
                    <div class="ibox-content">
                        <div class="form-group m-t-md">
                            <label class="col-sm-3 control-label">原密码：&nbsp;&nbsp;&nbsp;</label>
                            <div class="col-sm-8">
                                <input id="oldpass" type="text" name="contents"  placeholder="填写原密码" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group m-t-md">
                            <label class="col-sm-3 control-label">新密码：&nbsp;&nbsp;&nbsp;</label>
                            <div class="col-sm-8">
                                <input id="password" type="text" name="contents"  placeholder="填写新密码" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group m-t-md">
                            <label class="col-sm-3 control-label">再次填写新密码：&nbsp;&nbsp;&nbsp;</label>
                            <div class="col-sm-8">
                                <input id="password_two" type="text" name="contents"  placeholder="再次填写新密码" class="form-control"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="editpass()"><i class="fa fa-save"></i>立即修改</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> 关闭</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="__JS__/jquery.min.js?v=2.1.4"></script>
<script src="__JS__/bootstrap.min.js?v=3.3.6"></script>
<script src="__JS__/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="__JS__/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="__JS__/layer/layer.js"></script>
<script src="__JS__/hplus.min.js?v=4.1.0"></script>
<script src="__JS__/contabs.js"></script>
<script src="__JS__/plugins/pace/pace.min.js"></script>
<script type="text/javascript">

//退出登录
    $(document).ready(function(){
        $("#logout").click(function(){
            layer.confirm('你确定要退出吗？', {icon: 3}, function(index){
                layer.close(index);
                window.location.href="<?php echo url('admin/login/loginOut'); ?>";
            });
        });
    });

//清除缓存
    $(function(){
        
        $("#cache").click(function(){
            layer.confirm('你确定要清除缓存吗？', {icon: 3}, function(index){
                layer.close(index);
                $.ajax({
                type:"post",
                    url:"<?php echo url('admin/user/clear_del'); ?>",
                 data:index,//这里data传递过去的是序列化以后的字符串
                 success:function(data){
             if(data.code==1){
                        layer.msg(data.masg, {icon: 1,time:1500,shade: 0.1});
                    }else{  
                        layer.msg(data.masg, {icon: 1,time:1500,shade: 0.1});
                    }
             }
             });
            });
        });
    });
    function sjdp(){
        var tempwindow=window.open('_blank');
        tempwindow.location='/admin/index/console' ;
    }
    $("#export").click(function(){

        window.location.href="<?php echo url('admin/index/index'); ?>";
    })
    
    function kaifang(){
        layer.msg("待开放", {icon: 1,time:1500,shade: 0.1});
    }
    
    function quanxian(){
         layer.msg("请选择终端用户进行操作", {icon: 1,time:1500,shade: 0.1});
          setInterval(function(){
               location.reload();

             },1000)
        
        //  window.location.href="<?php echo url('admin/video/cizu_list'); ?>";
         
    }

    function editpass() {
        var oldpass = $("#oldpass").val();
        if(!oldpass) {
            alert('请输入原密码')
            return false;
        }
        var password = $("#password").val();
        if(!password) {
            alert('请输入新密码')
            return false;
        }
        var password_two = $("#password_two").val();
        if(!password_two) {
            alert('请再次输入新密码')
            return false;
        }

        $.ajax({
            type: "POST",
            url: "/admin/member/editpass",
            data: {'oldpass':oldpass,'password':password,'password_two':password_two},
            success: function(data){
                alert(data.msg)
                if(data.code != 0) {
                    return false;
                }
                window.location.href="/admin/login/loginOut";
            },
            error:function() {
                alert('修改失败')
            }
        });
    }
  
</script>
</body>

</html>
