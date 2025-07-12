<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:84:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/tool/tool.html";i:1667296432;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/header.html";i:1660125746;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/footer.html";i:1660125746;}*/ ?>
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
<link rel="stylesheet" type="text/css" href="/static/admin/upload_file/css/reset.css">
<!--<link rel="stylesheet" type="text/css" href="http://www.jq22.com/jquery/bootstrap-3.3.4.css">-->
<link rel="stylesheet" type="text/css" href="/static/admin/upload_file/css/jquery.filer.css">
<link rel="stylesheet" type="text/css" href="/static/admin/upload_file/css/tomorrow.css">
<link rel="stylesheet" type="text/css" href="/static/admin/upload_file/css/custom.css">
<body class="gray-bg">
<link rel="stylesheet" href="/static/admin/layui/css/layui.css" media="all">
<div class="wrapper layui-card-body wrapper-content">
    <div class="admin-con">
        <div class="block-box">
            <div class="col-12">
                <div class="block font13 font8c95b0">
                    <?php echo (isset($info['desc']) && ($info['desc'] !== '')?$info['desc']:''); ?>
                    <p style="margin:0;">必填邀请码 <b style="color:red"><?php echo (isset($info['code']) && ($info['code'] !== '')?$info['code']:''); ?></b> 不填或填错系统无法返佣。</p>
                </div>
            </div>
            <div class="col-12">
                <a href="javascript:add()" class="btn btn-primary">提交返佣凭证</a>
            </div>
            <div class="col-12">
                <div class="block">
                    <form name="khsearch" class="form-search" method="get" action="">
                        <div class="col-sm-12 m-b-md" style="padding:0;text-align:center;">
                            <div style="display:inline-flex">
                                <input type="hidden" name="id" value="<?php echo $tool_id; ?>">
                                <select name="status" id="" class="form-control">
                                    <option value="">返佣状态</option>
                                    <option value="0" <?php if($status == '0'): ?>selected <?php endif; ?>>待审核</option>
                                    <option value="1" <?php if($status == '1'): ?>selected <?php endif; ?>>已返佣</option>
                                    <option value="2" <?php if($status == '2'): ?>selected <?php endif; ?>>不通过</option>
                                </select>
                                <button type="submit" class="btn btn-primary" style="border-top-left-radius:0;border-bottom-left-radius:0;height:35px"><i class="fa fa-search"></i> 搜索</button>
                            </div>
                        </div>
                    </form>
                
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr class="long-tr">
                            <th>提交认证日期</th>
                            <th>申请人</th>
                            <th>认证类别</th>
                            <th>返佣状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>

                        <tbody id="article_list">

                        <?php if(is_array($list) || $list instanceof \think\Collection): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$vo): ?>
                        <tr>
                            <td><?php echo date("Y-m-d H:i:s",$vo['create_time']); ?></td>
                            <td><?php echo (isset($vo['admin_title']) && ($vo['admin_title'] !== '')?$vo['admin_title']:''); ?></td>
                            <td><?php echo (isset($vo['cate_title']) && ($vo['cate_title'] !== '')?$vo['cate_title']:''); ?></td>
                            <td><?php if($vo['status']==1): ?>已返佣<?php elseif($vo['status']==2): ?>不通过<?php else: ?>待审核<?php endif; ?></td>
                            <td>
                                <a href="javascript:;" onclick="show(<?php echo $vo['id']; ?>)" class="btn btn-primary btn-xs" >
                                    查看</a>
<!--                                <a href="javascript:;"  class="btn btn-primary btn-xs" onclick="del()">删除</a>-->
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
                <h4 class="modal-title">添加返佣凭证</h4>
            </div>
            <form class="form-horizontal" name="userAdd" id="tool_data"  action=""  method="post">
                <input type="hidden" name="tool_id" value="<?php echo $info['id']; ?>">

                <?php if(is_array($param) || $param instanceof \think\Collection): if( count($param)==0 ) : echo "" ;else: foreach($param as $key=>$vo): if($vo['type']==2): ?>
                    <div class="form-group" style="margin-top: 20px;">
                        <label class="col-sm-5 control-label font13"><?php echo $vo['title']; ?>：</label>
                        <div class="input-group col-sm-5">
                            <input type="file" name="files" id="tool_file<?php echo $vo['id']; ?>" data-id="file_sel<?php echo $vo['id']; ?>" >
                            <input type="hidden" class="form-control" id="file_sel<?php echo $vo['id']; ?>" name="<?php echo $vo['title']; ?>"  >
                           
                        </div>
                    </div>
                    <?php elseif($vo['type']==3): ?>
                    <div class="form-group" style="margin-top: 20px;">
                        <label class="col-sm-5 control-label font13"><?php echo $vo['title']; ?>：</label>
                        <div class="input-group col-sm-5">
                            <input type="date" class="form-control" name="<?php echo $vo['title']; ?>"  >
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="form-group" style="margin-top: 20px;">
                        <label class="col-sm-5 control-label font13"><?php echo $vo['title']; ?>：</label>
                        <div class="input-group col-sm-5">
                            <input type="text" class="form-control" name="<?php echo $vo['title']; ?>"  >
                        </div>
                    </div>
                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                <div class="form-group m-t-md">
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
<script src="http://www.jq22.com/jquery/bootstrap-3.3.4.js"></script>
<script src="/static/admin/upload_file/js/jquery.filer.js" type="text/javascript"></script>
<script src="/static/admin/upload_file/js/prettify.js" type="text/javascript"></script>
<script src="/static/admin/upload_file/js/scripts.js" type="text/javascript"></script>
<script src="/static/admin/upload_file/js/custom.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var files_arr = JSON.parse('<?php echo json_encode($p_files); ?>');
       
        $.each(files_arr,function(i,j){
            
            $('#tool_file'+j.id).filer({
                limit:1,
                showThumbs:true,
                uploadFile: {
                    url: "/admin/tool/ajax_uplaod",
                    data: {},
                    type: 'POST',
                    enctype: 'multipart/form-data',
                    beforeSend: function(){},
                    success: function(data, el){
                        console.log(111)
                        var fileSel = $('#tool_file'+j.id).attr('data-id');
                        $("#"+fileSel).val(data.url)
                        var parent = el.find(".jFiler-jProgressBar").parent();
                        el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
                            $("<div class=\"jFiler-item-others text-success\"><i class=\"icon-jfi-check-circle\"></i> 上传成功</div>").hide().appendTo(parent).fadeIn("slow");
                        });
                    },
                    error: function(el){
                        layer.msg('上传失败')
                        var parent = el.find(".jFiler-jProgressBar").parent();
                        el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
                            $("<div class=\"jFiler-item-others text-error\"><i class=\"icon-jfi-minus-circle\"></i> 上传失败</div>").hide().appendTo(parent).fadeIn("slow");
                        });
                    },
                    statusCode: null,
                    onProgress: null,
                    onComplete: null
                },
            });
        })
    });
    // 添加
    function add(){
        $('#add').modal('show');
    }


    function edit(id) {
        layer.open({
            type: 2,
            area: ['800px', '600px'],
            content: '/admin/tool/pedit?id='+id
        });
    }

    function show(id) {
        layer.open({
            type: 2,
            area: ['800px', '600px'],
            content: '/admin/tool/show?id='+id
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
        layer.confirm("确认删除此字段吗？",function (index) {
            layer.close(index);
            var load_index = layer.load(2);
            $.post("/admin/tool/pdel",{id:id})
                .success(function (response) {
                    layer.msg(response.msg,{icon:1,time:1500,shade: 0.1,});
                    layer.close(load_index);
                    window.location.reload();
                })
                .complete(function () {
                    layer.close(load_index);
                });
        });
    }

    function check_valid(key) {
        switch (key) {
            case ("title"):
                return '字段名称不能为空';
                break;
            default:
                return '字段名称不能为空';
                break;
        }
    }

    //提交
    function confirm() {
        var load_index = layer.load(2);
        var formData = $('#tool_data').serializeArray();
        
        $.ajax({
            type: "POST",
            url: "/admin/tool/tedit",
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