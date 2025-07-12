<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:85:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/video/qiye.html";i:1665380803;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/header.html";i:1660125746;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/footer.html";i:1660125746;}*/ ?>
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
<style type="text/css" media="all">
    .form-group{
        width: 100%;
        height: 30px;
        margin-top:20px;

    }
    .control-label{
        width: 150px;
        height: 35px;
        line-height: 35px;
        font-weight: normal;
        margin-right: 10px;
    }
</style>
<body class="gray-bg">
<link rel="stylesheet" href="/static/admin/layui/css/layui.css" media="all">
<div class="wrapper layui-card-body wrapper-content">
    <div class="admin-con">
        <div class="block-box">
            <div class="col-12">
                <div class="block">
                    <form class="form-inline" method="post" action="<?php echo url('qiye'); ?>">
                        <h5 style="font-size:14px;margin-bottom:0">抖音企业号接口：</h5>
                        <div class="form-group">
                            <label class="col-sm-2 control-label text-r font13">接口地址 :</label>
                            <div class="input-group col-sm-4">
                                <input type="text" class="form-control" name="qyurl" value="<?php echo $list['qyurl']; ?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label text-r font13">Client Key :</label>
                            <div class="input-group col-sm-4">
                                <input type="text" class="form-control" name="qykey" value="<?php echo $list['qykey']; ?>" >
                            </div>
                        </div>
        
                        <div class="form-group">
                            <label class="col-sm-2 control-label text-r font13 ">Client Secret :</label>
                            <div class="input-group col-sm-4">
                                <input type="text" class="form-control" name="qysecret" value="<?php echo $list['qysecret']; ?>" >
                            </div>
                        </div>
                        <!--<div class="hr-line-dashed"></div>-->
                        <div class="form-group m-b-md">
                            <label class="col-sm-2 control-label text-r font13 "></label>
                            <div class="input-group col-sm-4">
                                <button type="submit" class="btn btn-primary">保&nbsp;&nbsp;&nbsp;存</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
</body>
</html>