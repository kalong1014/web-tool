<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/account/index.html";i:1665218682;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/header.html";i:1660125746;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/footer.html";i:1660125746;}*/ ?>
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
            
            <!--第一行数据-->
            <div class="col-2">
                <!-- 卡片盒子 -->
                <div class="block card-group">
                    <!-- 卡片信息 -->
                    <div class="card-info">
                        <span class="tips">
                            视频总条数
                        </span>
                        <div class="num-or-price">
                            <span><?php echo (isset($all_count) && ($all_count !== '')?$all_count:0); ?></span>
                        </div>
                    </div>
                    <canvas id="line2" width="15" height="90" style="width: 40%; height: 80px; display: block; box-sizing: border-box;"></canvas>
                </div>
            </div>
            <div class="col-2">
                <!-- 卡片盒子 -->
                <div class="block card-group">
                    <!-- 卡片信息 -->
                    <div class="card-info">
                        <span class="tips">
                            视频总点赞量
                        </span>
                        <div class="num-or-price">
                            <span><?php echo (isset($like_count) && ($like_count !== '')?$like_count:0); ?></span>
                        </div>
                    </div>
                    <canvas id="line2" width="15" height="90" style="width: 40%; height: 80px; display: block; box-sizing: border-box;"></canvas>
                </div>
            </div>
            <div class="col-2">
                <!-- 卡片盒子 -->
                <div class="block card-group">
                    <!-- 卡片信息 -->
                    <div class="card-info">
                        <span class="tips">
                            视频总曝光量
                        </span>
                        <div class="num-or-price">
                            <span><?php echo (isset($view_count) && ($view_count !== '')?$view_count:0); ?></span>
                        </div>
                    </div>
                    <canvas id="line2" width="15" height="90" style="width: 40%; height: 80px; display: block; box-sizing: border-box;"></canvas>
                </div>
            </div>
            <div class="col-2">
                <!-- 卡片盒子 -->
                <div class="block card-group">
                    <!-- 卡片信息 -->
                    <div class="card-info">
                        <span class="tips">
                            视频总分享量
                        </span>
                        <div class="num-or-price">
                            <span><?php echo (isset($new_share) && ($new_share !== '')?$new_share:0); ?></span>
                        </div>
                    </div>
                    <canvas id="line2" width="15" height="90" style="width: 40%; height: 80px; display: block; box-sizing: border-box;"></canvas>
                </div>
            </div>
            <div class="col-2">
                <!-- 卡片盒子 -->
                <div class="block card-group">
                    <!-- 卡片信息 -->
                    <div class="card-info">
                        <span class="tips">
                            视频总转发量
                        </span>
                        <div class="num-or-price">
                            <span><?php echo (isset($forward_count) && ($forward_count !== '')?$forward_count:0); ?></span>
                        </div>
                    </div>
                    <canvas id="line2" width="15" height="90" style="width: 40%; height: 80px; display: block; box-sizing: border-box;"></canvas>
                </div>
            </div>
            <div class="col-2">
                <!-- 卡片盒子 -->
                <div class="block card-group">
                    <!-- 卡片信息 -->
                    <div class="card-info">
                        <span class="tips">
                            视频总评论数
                        </span>
                        <div class="num-or-price">
                            <span><?php echo (isset($comment_count) && ($comment_count !== '')?$comment_count:0); ?></span>
                        </div>
                    </div>
                    <canvas id="line2" width="15" height="90" style="width: 40%; height: 80px; display: block; box-sizing: border-box;"></canvas>
                </div>
            </div>
            <!--添加按钮-->
            <div class="col-12">
                <a href="/admin/account/get_tiktok_url" target="_blank" ><button class="btn btn-outline btn-primary" type="button">添加企业号</button></a>
            </div>
            <!--企业号列表-->
            <div class="col-12">
                <div class="block">
                    <table class="layui-hide" id="table-page" lay-filter="table-page"></table>
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
<script src="/static/admin/layui/layui.js"></script>
<script type="text/html" id="action">
    <div class="layui-btn-group">
        <a  class="btn btn-primary btn-xs" lay-event="del">
            解绑账号</a>
    </div>
</script>
<script type="text/html" id="toolbar">
    <div class="layui-btn-group">
        <button class="layui-btn layui-btn-sm" lay-event="refresh_data">刷新数据</button>
        <button class="layui-btn layui-btn-sm" lay-event="refresh_reply">刷新评论</button>
        <button class="layui-btn layui-btn-sm" lay-event="refresh_customer">刷新客户</button>
        <button class="layui-btn layui-btn-sm" lay-event="delete">批量解绑</button>
    </div>
</script>
<script>
    layui.define(['table','form','upload'],function (exports) {
        var table = layui.table;
        var form = layui.form
        var upload = layui.upload
        //基本实例
        var tableInit = table.render({
            elem: '#table-page'//绑定容器
            ,url: '/admin/account/list'
            ,page: true
            ,limit:10
            ,toolbar: "#toolbar"
            ,title:'企业号列表'
            ,defaultToolbar: []
            ,autoSort:false
            ,parseData: function(res){ //res 即为原始返回的数据
                console.log(res)
                return {
                    "code": res.code, //解析接口状态
                    "msg": res.msg, //解析提示文本
                    "count": res.data.count, //解析数据长度
                    "data": res.data.list //解析数据列表
                };
            }
            ,response: {
                statusCode: 1 //规定成功的状态码，默认：0
            }
            ,cellMinWidth:100
            ,cols: [[ //在表头设置对应的字段
                { minWidth:10, type: 'checkbox'}
                ,{field:'avatar', title: '头像', templet: `<div><img src="{{d.avatar}}" style="height: 30px;" alt=""></div>`}
                ,{field: 'nickname', title: '账号名称'}
                ,{field: 'video_count', title: '视频数量'}
                ,{field: 'play_count', title: '曝光量'}
                ,{field: 'digg_count', title: '点赞量', }
                ,{field: 'comment_count', title: '评论'}
                ,{field: 'share_count', title: '分享',}
                ,{field: 'create_date', title: '授权时间', sort: true}
                ,{field: 'access_token_date', title: '到期时间', sort: true}
                ,{title:'操作', align:'center', toolbar: '#action'}
            ]]
        });
        function refresh_data(data) {
            layer.confirm("您真的要刷新数据吗？",function (index) {
                layer.close(index);
                var ids = [];
                if(data instanceof Array){
                    layui.each(data,function (k,item) {
                        ids.push(item.id);
                    });
                }else{
                    ids = [data];
                }
                var load_index = layer.load(2);
                $.post("refresh_data",{ids:ids})
                    .success(function (response) {
                        console.log(response.data)
                        layer.close(load_index);
                        if(response.code){
                            layer.alert(response.msg)
                            setTimeout(function () {
                                tableInit.reload();
                            },1000);
                        }else{
                            layer.alert(response.msg)
                        }
                    })
                    .complete(function () {
                        layer.close(load_index);
                    });
            });
        }

        function refresh_reply(data) {
            layer.confirm("您真的要刷新评论吗？",function (index) {
                layer.close(index);
                var ids = [];
                if(data instanceof Array){
                    layui.each(data,function (k,item) {
                        ids.push(item.id);
                    });
                }else{
                    ids = [data];
                }
                var load_index = layer.load(2);
                $.post("refresh_reply",{ids:ids})
                    .success(function (response) {
                        console.log(response.data)
                        layer.close(load_index);
                        if(response.code){
                            layer.alert(response.msg)
                            setTimeout(function () {
                                tableInit.reload();
                            },1000);
                        }else{
                            layer.alert(response.msg)
                        }
                    })
                    .complete(function () {
                        layer.close(load_index);
                    });
            });
        }

        function refresh_customer(data) {
            layer.confirm("您真的要刷新客户吗？",function (index) {
                layer.close(index);
                var ids = [];
                if(data instanceof Array){
                    layui.each(data,function (k,item) {
                        ids.push(item.id);
                    });
                }else{
                    ids = [data];
                }
                var load_index = layer.load(2);
                $.post("refresh_customer",{ids:ids})
                    .success(function (response) {
                        console.log(response.data)
                        layer.close(load_index);
                        if(response.code){
                            layer.alert(response.msg)
                            setTimeout(function () {
                                tableInit.reload();
                            },1000);
                        }else{
                            layer.alert(response.msg)
                        }
                    })
                    .complete(function () {
                        layer.close(load_index);
                    });
            });
        }

        function delete_api(data) {
            layer.confirm("您真的要解绑账号吗？",function (index) {
                layer.close(index);
                var ids = [];
                if(data instanceof Array){
                    layui.each(data,function (k,item) {
                        ids.push(item.id);
                    });
                }else{
                    ids = [data];
                }
                var load_index = layer.load(2);
                $.post("delete",{ids:ids})
                    .success(function (response) {
                        if(response.code){
                            layer.alert(response.msg)
                            setTimeout(function () {
                                tableInit.reload();
                            },1000);
                        }else{
                            layer.alert(response.msg)
                        }
                    })
                    .complete(function () {
                        layer.close(load_index);
                    });
            });
        }

        //监听工具条
        table.on('tool(table-page)', function(obj){ //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
            var data = obj.data; //获得当前行数据
            var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
            var tr = obj.tr; //获得当前行 tr 的 DOM 对象（如果有的话）

            if(layEvent === 'del'){ //删除
                delete_api(data.id);
            } else if(layEvent === 'LAYTABLE_TIPS'){
                layer.alert('Hi，头部工具栏扩展的右侧图标。');
            }
        });
        //监听事件
        table.on('toolbar(table-page)', function(obj){
            var checkStatus = table.checkStatus(obj.config.id);
            switch(obj.event){
                case 'refresh_data':
                    refresh_data(checkStatus.data);
                    break;
                case 'refresh_reply':
                    refresh_reply(checkStatus.data);
                    break;
                case 'refresh_customer':
                    refresh_customer(checkStatus.data);
                    break;
                case 'delete':
                    delete_api(checkStatus.data);
                    break;
            }
        });

        table.on('sort(table-page)', function(obj){
            console.log(obj)
            table.reload('table-page', {
                initSort: obj //记录初始排序
                , where: {
                    field: obj.field //排序字段
                    , order: obj.type //排序方式
                }
            });
        });
        form.on('submit(search-btn)',function (data) {
            table.reload('table-page', {
                where: data.field
            });
            return false;
        });
    });
</script>
</body>
</html>