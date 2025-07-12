<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:92:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/huoke/set_keyword.html";i:1665540594;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/header.html";i:1660125746;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/footer.html";i:1660125746;}*/ ?>
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
<style>
    .layui-form-label{width: 130px;}
    .layui-form-item .layui-input-inline{width: 50%;}
</style>
<div class="wrapper layui-card-body wrapper-content">
    <div class="admin-con">
        <div class="block-box">
            <div class="col-12">
                <div class="block font13">
                    <div class="layui-form-item m-t-md">
                        <label class="layui-form-label ">主页链接：<span style="color:red;margin:0 5px;">*</span></label>
                        <div class="layui-input-inline">
                            <input type="text" name="url" id="url" placeholder="请输入主页链接" autocomplete="off" class="layui-input url" value="">
                        </div>
                    </div>
                    <div class="layui-form-item m-t-md">
                        <label class="layui-form-label">主词：<span style="color:red;margin:0 5px;">*</span></label>
                        <div class="layui-input-inline">
                            <textarea id="c-main_keyword" class="form-control n-valid subject" rows="7" name="subject" cols="20" placeholder="每行一个词，建议3-10个词" width="50%" ></textarea>
                            <div class="layui-form-mid layui-word-aux">每行一个词，建议3-10个词，每个词10个字之内</div>
                        </div>
                    </div>
                    <div class="layui-form-item m-t-md">
                        <label class="layui-form-label">头词：<span style="color:red;margin:0 5px;">*</span></label>
                        <div class="layui-input-inline">
                            <textarea id="c-main_keyword" class="form-control n-valid headword" rows="7" name="headword" cols="20" placeholder="每行一个词，最多5个前缀"></textarea>
                            <div class="layui-form-mid layui-word-aux">每行一个词，建议3-5个词，每个词10个字之内</div>
                        </div>
                    </div>
                    <div class="layui-form-item m-t-md">
                        <label class="layui-form-label">尾词：<span style="color:red;margin:0 5px;">*</span></label>
                        <div class="layui-input-inline">
                            <textarea id="c-main_keyword" class="form-control n-valid coda" rows="7" name="coda" cols="20" placeholder="每行一个词，最多5个后缀"></textarea>
                            <div class="layui-form-mid layui-word-aux">每行一个词，建议3-10个词，每个词10个字之内</div>
                        </div>
                    </div>  
                    <div class="layui-form-item m-t-md">
                        <label class="layui-form-label"></label>
                        <div class="layui-input-inline">
                            <button id="" class="btn btn-success submit">确定保存</button>
                        </div>
                    </div> 
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

<script type="text/javascript">
        $(".submit").click(function(){
             layer.load(3)
             var url = $(".url").val();//获取链接地址
             var subject = $(".subject").val();//获取主词
             var headword = $(".headword").val();//获取头词
             var coda = $(".coda").val();//获取尾词
            $.ajax({
            type: "POST",
            url: "/admin/huoke/set_ket_add",
            data: {
                url:url,subject:subject,headword:headword,coda:coda
            },
            success: function(data){
                console.log(data.code)
                layer.closeAll('loading');
                if(data.code == 1){
                    layer.msg(data.msg,{icon:1,time:1500,shade: 0.1,});
                    setInterval(function(){
                            window.location.href="/admin/huoke/stock_keyword";
                        },1000)
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
</body>
</html>