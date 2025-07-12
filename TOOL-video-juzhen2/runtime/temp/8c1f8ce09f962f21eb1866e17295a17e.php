<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:87:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/tool/vconfig.html";i:1667369938;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/header.html";i:1660125746;}*/ ?>
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
<body>
<link rel="stylesheet" href="/static/admin/inputtag/inputTag.css">
<style>
    .confirm{
        background: #1e9efe;
        width: 80px;
        height: 35px;
        color: #fff;
        border: 0px;
    }
</style>
<body class="gray-bg">
<link rel="stylesheet" href="/static/admin/layui/css/layui.css" media="all">
<div class="wrapper layui-card-body wrapper-content">
    <div class="admin-con">
        <div class="block-box">
            <div class="col-12">
                <div class="block">
                    <div class="layui-fluid">
                        <div class="layui-row layui-col-space15">
                            <div class="layui-col-md12">
                                <div class="layui-card">
                                    <div class="layui-card-body">
                                        <button class="layui-btn confirm" style="float:right;" ></i>提交</button>
                    
                    
                                        <div class="fairy-tag-container">
                                            <input type="text" class="fairy-tag-input tag2" autocomplete="off" value="">
                                        </div>
                    
                                        <div id="tag2"></div>
                                        <!--                    <table class="layui-hide" id="table-page" lay-filter="table-page"></table>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://lf6-cdn-tos.bytecdntp.com/cdn/expire-1-M/layui/2.6.8/layui.min.js" type="application/javascript"></script>
<script charset="utf-8" src="/static/admin/inputtag/inputTag.js"></script>
<script>
    $(function() {
        var keywords = JSON.parse('<?php echo json_encode($keywords); ?>');
       
        var tagObj1;
        layui.config({
            base: './'
        }).use(['inputTag', 'jquery'], function () {
            var $ = layui.jquery, inputTag = layui.inputTag;

            // //清空数据方法
            // tagObj1.clearData();
            // //获取数据方法
            // tagObj1.getData();

            tagObj1 = inputTag.render({
                elem: '.tag2',
                data: keywords,
                permanentData: [],
                onChange: function (data, value, type) {
                    console.log(arguments);
                    // $('#tag2').text(JSON.stringify(data));
                }
            });
        })

        $(".confirm").click(function() {
            var tags = tagObj1.getData();
            
            $.ajax({
                type: "POST",
                url: "/admin/Tool/vconfig",
                data: {keywords:tags},
                success: function(data){
                    layer.msg(data.msg,{icon:1,time:1500,shade: 0.1,});
                    if(data.code == 1) {
                        setTimeout(function () {
                            window.location.reload()
                        },1000);
                    }
                }
            });
            console.log(tags);
        })
    })
</script>
</body>
</html>