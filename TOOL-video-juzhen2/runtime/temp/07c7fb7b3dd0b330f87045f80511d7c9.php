<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:93:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/usersite/deduction.html";i:1667788122;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/header.html";i:1660125746;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/footer.html";i:1660125746;}*/ ?>
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
    .btn-primary{
        margin-left:0;
        width: 300px;
    }
        .control-label{
            width: 150px;
            height: 35px;
            line-height: 35px;
            font-weight: normal;
            text-align: right;
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
                        <div class="form-group">
                            <label class="col-sm-2 control-label">主词+头词扣费:</label>
                            <div class="input-group col-sm-4">
                                <input  type="number" class="form-control" name="subject" value="<?php echo !empty($list['subject'])?$list['subject']:'0'; ?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">头词+尾词扣费 :</label>
                            <div class="input-group col-sm-4">
                                <input  type="number" class="form-control" name="headword" value="<?php echo !empty($list['headword'])?$list['headword']:'0'; ?>" >
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="col-sm-2 control-label">主词+头词+尾词扣费 :</label>
                            <div class="input-group col-sm-4">
                                <input  type="number" class="form-control" name="coda" value="<?php echo !empty($list['coda'])?$list['coda']:'0'; ?>" >
                            </div>
                        </div> 
                         <div class="form-group">
                            <label class="col-sm-2 control-label">头词扣费 :</label>
                            <div class="input-group col-sm-4">
                                <input  type="number" class="form-control" name="initial" value="<?php echo !empty($list['initial'])?$list['initial']:'0'; ?>" >
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="col-sm-2 control-label">混剪扣费 :</label>
                            <div class="input-group col-sm-4">
                                <input  type="number" class="form-control" name="shear" value="<?php echo !empty($list['shear'])?$list['shear']:'0'; ?>" >
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="col-sm-2 control-label">优惠券扣费 :</label>
                            <div class="input-group col-sm-4">
                                <input id="title" type="number" class="form-control" name="discount" value="<?php echo !empty($list['discount'])?$list['discount']:'0'; ?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">去水印扣费 :</label>
                            <div class="input-group col-sm-4">
                                <input  type="number" class="form-control" name="watermark" value="<?php echo !empty($list['watermark'])?$list['watermark']:'0'; ?>" >
                            </div>
                        </div> 
                        <button  class="btn btn-primary m-t-md submit">保存</button> 
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
<script type="text/javascript" charset="utf-8">
    $(".submit").click(function(){
        //layer.load(3)
        var subject     =   $("input[name='subject']").val();
        var headword    =   $("input[name='headword']").val();
        var coda        =   $("input[name='coda']").val();
        var shear       =   $("input[name='shear']").val();
        var discount    =   $("input[name='discount']").val();
        var watermark   =   $("input[name='watermark']").val();
        var initial   =   $("input[name='initial']").val();
        $.ajax({
        type: "POST",
        url: "deduction_add",
        data: {
            subject:subject,headword:headword,coda:coda,shear:shear,discount:discount,watermark:watermark,initial:initial
        },
        success: function(data){
            console.log(data)
            layer.closeAll('loading');
            if(data.code == 1){
                layer.msg(data.msg,{icon:1,time:1500,shade: 0.1,});
                // setInterval(function(){
                //         //window.location.href="/admin/huoke/stock_keyword";
                //     },1000)
                return false;
            }else{
                  layer.msg(data.msg,{icon:2,time:1500,shade: 0.1,});
            }
        },
        error:function() {
            layer.closeAll('loading');
            layer.alert('添加错误')
    
        }
    });
    })
</script>

</html>