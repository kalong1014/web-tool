<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/usersite/menu.html";i:1665312374;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/header.html";i:1660125746;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/footer.html";i:1660125746;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico">
    <link href="/static/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
     <link href="/static/admin/chengshi/RegionalChoice.css" rel="stylesheet">
    <link href="/static/admin/css/font/iconfont.css" rel="stylesheet">
    <link href="/static/admin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/static/admin/css/plugins/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
    <link href="/static/admin/css/animate.min.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/switchery/switchery.css" rel="stylesheet">
    <link href="/static/admin/css/style.min.css?v=4.1.0" rel="stylesheet">
    <link href="/static/admin/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="__CSS__/select2.css" rel="stylesheet">
    <link href="__CSS__/toastr.min.css" rel="stylesheet">
    <link href="__CSS__/bootstrap-switch/bootstrap3/bootstrap-switch.min.css" rel="stylesheet">

    <style type="text/css">
    .long-tr th{
        text-align: center
    }
    .long-td td{
        text-align: center
    }
    </style>
</head>
<body class="gray-bg">
<link rel="stylesheet" href="/static/admin/layui/css/layui.css" media="all">
<div class="wrapper layui-card-body wrapper-content">
    <div class="admin-con">
        <div class="block-box">
            <div class="col-12">
                <a href="<?php echo url('usersite_add'); ?>"><button class="btn btn-outline btn-primary" type="button">添加菜单</button></a> 
            </div>                                            
                                        
            <div class="col-12">
                <div class="block">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="long-tr">
                               
                                <th>名称</th>
                                <th>URL</th>
                                <th>添加时间</th>
                                
                               
                                <th>操作</th>
                            </tr>
                        </thead>
                      
                        
                            <?php if(is_array($list) || $list instanceof \think\Collection): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$vo): ?>
                            <tr class = "long-td" >
                               
                                <td><?php echo $vo['menu']; ?></td>
                                <td><?php echo $vo['url']; ?></td>
                                <td><?php echo $vo['addtime']; ?></td>
                               
                              
                                <td>
                                    
                                     <a href="<?php echo url('usersite_edit'); ?>?id=<?php echo $vo['id']; ?>" class="btn btn-primary btn-xs">
                                                <i class="fa fa-paste"></i> 编辑</a>&nbsp;&nbsp;
                                            <a href="<?php echo url('delete'); ?>?id=<?php echo $vo['id']; ?>"  class="btn btn-danger btn-xs">
                                                <i class="fa fa-trash-o"></i> 删除</a> 
                                </td>
                            
                               
                            </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                          
                        
                        <tbody id="article_list"></tbody>
                    </table>
                    <div id="AjaxPage" style=" text-align: right;"></div>
                    <div id="allpage" style=" text-align: right;"></div>
                </div>
            </div>
           <!-- kaishi -->
        </div>
    </div>
</div>

<script src="/static/admin/js/jquery.min.js?v=2.1.4"></script>

<script src="/static/admin/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/static/admin/js/content.min.js?v=1.0.0"></script>
<script src="/static/admin/js/plugins/chosen/chosen.jquery.js"></script>
<script src="/static/admin/js/plugins/iCheck/icheck.min.js"></script>
<script src="/static/admin/js/plugins/layer/laydate/laydate.js"></script>
<script src="/static/admin/js/plugins/sweetalert/sweetalert.min.js"></script>
<script src="/static/admin/js/plugins/switchery/switchery.js"></script><!--IOS开关样式-->
<script src="/static/admin/js/jquery.form.js"></script>
<script src="/static/admin/js/layer/layer.js"></script>
<script src="/static/admin/js/laypage/laypage.js"></script>
<script src="/static/admin/js/laytpl/laytpl.js"></script>
<script src="/static/admin/js/select2.full.js"></script>
<script src="/static/admin/js/select2.js"></script>
<script src="/static/admin/js/i18n/es.js"></script>
<script src="/static/admin/js/i18n/zh-CN.js"></script>
<script src="__JS__/bootstrap-switch.js"></script>
<script src="__JS__/toastr.min.js"></script>
<script src="/static/admin/dreammsg/lib/dream-msg.min.js"></script>

<!-- 引入图片上传插件 -->

<!-- 引入图片插件结束 -->
<script>
    document.body.onmousedown=function(e){
    e = e||window.event
    var url = window.location.href
   navlabel =$('nav-label').html();
   
   
}
 $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
</script>

<script type="text/javascript">
   
   


</script>
</body>
</html>