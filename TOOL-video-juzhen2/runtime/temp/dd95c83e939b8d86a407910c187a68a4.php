<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:85:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/tool/index.html";i:1665472480;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/header.html";i:1660125746;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/footer.html";i:1660125746;}*/ ?>
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
                <a href="javascript:add()" class="btn btn-primary">添加</a>
            </div>
            
            <div class="col-12">
                <div class="block">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr class="long-tr">
                            <th>服务名称</th>
                            <th>注意事项</th>
                            <th>邀请码</th>
                            <th>添加时间</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>

                        <tbody id="article_list">

                        <?php if(is_array($list) || $list instanceof \think\Collection): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$vo): ?>
                        <tr>
                            <td><?php echo $vo['title']; ?></td>
                            <td><?php echo $vo['desc']; ?></td>
                            <td><?php echo $vo['code']; ?></td>
                            <td><?php echo date("Y-m-d H:i:s",$vo['create_time']); ?></td>
                            <td><?php if($vo['status']==1): ?>正常<?php else: ?>关闭<?php endif; ?></td>
                            <td>
                                <a href="javascript:;" onclick="give(<?php echo $vo['id']; ?>)" class="btn btn-info btn-xs">
                                    <i class="fa fa-paste"></i> 分配</a>&nbsp;&nbsp;
                                <a href="javascript:;" onclick="edit(<?php echo $vo['id']; ?>)" class="btn btn-primary btn-xs" >
                                    编辑</a>
                                <a href="/admin/tool/param?id=<?php echo $vo['id']; ?>" class="btn btn-primary btn-xs" >
                                    字段管理</a>
                                <a href="/admin/tool/examine?id=<?php echo $vo['id']; ?>" class="btn btn-primary btn-xs" >
                                    审核管理</a>
                                <a href="javascript:;"  class="btn btn-primary btn-xs" onclick="del(<?php echo $vo['id']; ?>)">
                                    删除</a>
                            </td>
                        </tr>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<!--添加返佣-->
<div class="modal  fade" id="add" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" style="width:50%">
        <div class="modal-content" style="width:100%;padding-bottom:20px">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">添加服务</h4>
            </div>
            <form class="form-horizontal" name="userAdd" id="tool_cate_data"  action=""  method="post">
                <div class="form-group" style="margin-top: 20px;">
                    <label class="col-sm-3 control-label font13">服务名称：</label>
                    <div class="input-group col-sm-8">
                        <input type="text" class="form-control" name="title"  >
                    </div>
                </div>
                <div class="form-group" style="margin-top: 20px;">
                    <label class="col-sm-3 control-label font13">注意事项：</label>
                    <div class="input-group col-sm-8">
                        <textarea name="desc" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <div class="form-group" style="margin-top: 20px;">
                    <label class="col-sm-3 control-label font13">邀请码：</label>
                    <div class="input-group col-sm-8">
                        <input type="text" class="form-control" name="code"  >
                    </div>
                </div>

                <div class="form-group" style="margin-top: 20px;">
                    <label class="col-sm-3 control-label font13">状态：</label>
                    <div class="input-group col-sm-5" style="line-height:35px">
                        <label class="font13"><input name="status" type="radio" value="1" checked/>正常 </label>
                        <label class="font13"><input name="status" type="radio" value="2" />关闭 </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-7 col-sm-offset-3">
                        <button class="btn btn-primary" type="button" onclick="confirm()" > 确认</button>&nbsp;&nbsp;&nbsp;

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--添加-->

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
    // 添加
    function add(){
        $('#add').modal('show');
    }

    function edit(id) {
        layer.open({
            type: 2,
            area: ['800px', '600px'],
            content: '/admin/tool/edit?id='+id
        });
    }

    function give(id) {
        layer.open({
            type: 2,
            area: ['800px', '600px'],
            content: '/admin/tool/give?id='+id
        });
    }


    function del(id) {
        layer.confirm("确认删除此服务吗？",function (index) {
            layer.close(index);
            var load_index = layer.load(2);
            $.post("/admin/tool/del",{id:id})
                .success(function (response) {
                    layer.msg(response.msg,{icon:1,time:1500,shade: 0.1,});
                    layer.close(load_index);
                    setTimeout(() => {
                        window.location.reload();
                    }, 500);
                })
                .complete(function () {
                    layer.close(load_index);
                });
        });
    }

    function check_valid(key) {
        switch (key) {
            case ("title"):
                return '服务名称不能为空';
                break;
            case ("desc"):
                return '服务介绍不能为空';
                break;
            case ("code"):
                return '邀请码不能为空';
                break;
            default:
                return '服务名称不能为空';
                break;
        }
    }

    //提交
    function confirm() {
        var load_index = layer.load(2);
        var formData = $('#tool_cate_data').serializeArray();
        var error = 0;
        $.each(formData, function(i, field){
            if(!field.value || field.value<=0) {
                console.log(field.name+'---'+field.value)
                var msg = check_valid(field.name)
                layer.alert(msg)
                error += 1;
                return false;
            }
        });
        if(error) {
            layer.closeAll('loading');
           return false;
        }
        $.ajax({
            type: "POST",
            url: "/admin/tool/edit",
            data: formData,
            success: function(data){
                layer.closeAll('loading');
                window.location.reload();
            },
            error:function() {
                layer.closeAll('loading');
                layer.alert('添加失败')
            }
        });
    }
</script>
</body>
</html>