<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:94:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/cityfission/actlist.html";i:1667633394;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/header.html";i:1660125746;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/footer.html";i:1660125746;}*/ ?>
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
    <style>
        .choose-cityfission{width: 100%;height: 60px;display:flex;text-align:center;}
        .choose-cityfission dt{width: 100px;line-height:60px;border:1px solid #5a5858;cursor: pointer;}
        .choose-cityfission-btn.act{background: #ff7752;}
        /*.cityfission-con{border:1px solid #5a5858;}*/
    </style>
<link rel="stylesheet" href="/static/admin/layui/css/layui.css" media="all">
    
<div class="wrapper layui-card-body wrapper-content">
    <div class="admin-con">
        <div class="block-box">
            <!--添加按钮-->
            <div class="col-12">
                <a href="/admin/video/task_add" class="btn btn-primary">添加</a>
            </div>
            <div class="col-12">
                <div class="block"> 
                    <form name="khsearch" class="form-search" method="get" action="">
                        <div class="col-sm-12 m-b-md" style="padding:0;text-align:center;">
                            <div style="display:inline-flex">
                                
                                <input type="text" id="key" class="form-control" name="rwname" autocomplete="off" placeholder="请输入任务名称" value="<?php echo (isset($rwname) && ($rwname !== '')?$rwname:''); ?>" style="display: block;width: 80%" />
                                <button type="submit" class="btn btn-primary" style="border-top-left-radius:0;border-bottom-left-radius:0;height:35px"><i class="fa fa-search"></i> 搜索</button> 
                            </div>
                        </div>
                    </form>  

                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="long-tr">
                                <th>活动ID</th>
                                <th>活动名称</th>
                                <th>类型</th>
                                <th>总发放</th>
                                <th>剩余</th>
                                <th>状态</th>
                                <th>创建时间</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        
                        <tbody id="article_list">
                            <?php if(is_array($list) || $list instanceof \think\Collection): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$vo): ?>
                                <tr>
                                    <td><?php echo $vo['id']; ?></td>
                                    <td><?php echo $vo['rwname']; ?></td>
                                    <td style="color:#1ab394"><?php if($vo['task_type']==1): ?>探店<?php else: ?>外卖<?php endif; ?></td>
                                    <td><?php echo $vo['count']; ?></td>
                                    <td><?php echo $vo['coupon_num'] - $vo['count']; ?></td>
                                    <td>
                                        <?php if($vo['stop']==1): ?>
                                        停止
                                        <?php else: ?>
                                        开启
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo date("Y-m-d H:i:s",$vo['addtime']); ?></td>
                                    <td>
                                        <!--<a href="javascript:;"   class="btn btn-primary btn-xs" onclick="stop(<?php echo $vo['id']; ?>)">-->
                                        <!--    <?php if($vo['stop']==1): ?>-->
                                        <!--    开启任务-->
                                        <!--    <?php else: ?>-->
                                        <!--    停止任务-->
                                        <!--    <?php endif; ?>-->
                                        <!--</a>&nbsp;&nbsp;-->
                                        <!--<a href="javascript:;" class="btn btn-primary btn-xs" onclick="copy(<?php echo $vo['id']; ?>)">-->
                                        <!--    复制推广链接</a>&nbsp;&nbsp;-->
                                        <a href="javascript:;" class="btn btn-primary btn-xs" onclick="code_url(<?php echo $vo['id']; ?>)">
                                           查看二维码</a>&nbsp;&nbsp;
                                        <!--<a href="javascript:;" data-toggle="modal" data-target="#jilu"  class="btn btn-primary btn-xs" onclick="jilu(<?php echo $vo['id']; ?>)">-->
                                        <!--    发送记录</a>&nbsp;&nbsp;-->
                                        <a href="javascript:del(<?php echo $vo['id']; ?>)"  class="btn btn-danger btn-xs font-color">
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


<!-- 记录模态框 -->
<div class="modal  fade" id="jilu" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" style="width:60%">
        <div class="modal-content" style="width:100%;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">发布记录</h4>
            </div>
            <div class="example">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr class="long-tr">
                        <th>ID</th>
                        <th>账号</th>
                        <th>日志信息</th>

                        <th>时间</th>

                    </tr>
                    </thead>

                    <tbody id="article_list" class="jilu">

                    </tbody>
                </table>
                <div id="AjaxPage" style=" text-align: right;"></div>
                <div id="allpage" style=" text-align: right;"></div>
            </div>
        </div>
    </div>
</div>
<!-- 记录模态框结束 -->
<div class="modal  fade" id="codefenzu_url2" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" style="width:50%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h3 class="modal-title" style="text-align:center">活动任务链接</h3>
            </div>
            <div class="ibox-content m-t-md">
                <div class="form-group" style="text-align: center;">
                    <p id="qrcode_h5_url2"></p>
                </div>
                <div class="form-group" style="text-align: center;">
                      <img class="qrcode_h5_qrcode" src="" alt="">
                </div> 
            </div>
            <div class="modal-footer">
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
    // function copy(id) {
    //     if(!id) {
    //         layer.msg('请刷新页面并重新复制');
    //         return false;
    //     }
    //     var domain = window.location.host;
    //     console.log(domain)
    //     const input = document.createElement('input');
    //     input.setAttribute('readonly', 'readonly');
    //     input.setAttribute('value', 'http://'+domain+'/index/active/get_coupon?id='+id);
    //     document.body.appendChild(input);
    //     input.setSelectionRange(0, 9999);
    //     input.select();
    //     document.execCommand('copy');
    //     document.body.removeChild(input);
    //     layer.msg('已复制链接到剪切板')
    // }
//二维码
    function code_url(id){
        $.get('<?php echo url("admin/Cityfission/code_url"); ?>',{id:id},function(data){
             $("#qrcode_h5_url2").html(data.url);
            $(".qrcode_h5_qrcode").attr('src',data.qrcode)
            $("#codefenzu_url2").modal('show');
            layer.closeAll('loading');
            console.log(data)
        });
    }
    // 添加
    function add(){
          $('#add').modal('show');
    }

    function del(id){
        $.post('<?php echo url("/admin/video/delete_renwu"); ?>',
            {id:id},
            function(data){
                if(data.code==1){
                    layer.msg(data.msg,{icon:1,time:1500,shade: 0.1,});
                    setInterval(function(){
                        location.reload();
                    },1000)
                    return false;
                }else{
                    layer.msg(data.msg,{icon:2,time:1500,shade: 0.1,});
                    setInterval(function(){
                        location.reload();
                    },1000)
                    return false;
                }
            });
    }

    function jilu(id){
        $.post('<?php echo url("jilu"); ?>',
            {id:id},
            function(data){
                $(".jilu").html('');

                var html="";
                console.log(data)
                $.each(data, function (key, value) {
                    if(value.status==1){
                        html = "<tr  style='text-align: center;'>"
                            +"<td>"+value.id+"</td>"
                            +"<td>"+value.username+"</td>"
                            +"<td>"+value.count+"</td>"
                            +"<td>"+value.addtime+"</td>"
                            +"</tr>" ;
                        $(".jilu").append(html);
                    }else{
                        con = "正在升级中";
                        html ="<tr  style='text-align: center;'>"
                            +"<td>"+value.id+"</td>"
                            +"<td>"+value.username+"</td>"
                            +"<td>"+value.count+"</td>"
                            +"<td>"+value.addtime+"</td>"
                            // +"<td>"+"<a href='"+value.url+"' class='btn btn-primary btn-xs' target='view_window'>"+'查看视频'+"</a>"+"</td>"


                            +"</tr>";

                        $(".jilu").append(html);
                    }

                });
            });
    }

    $(document).ready(function(){
        $(".cityfission-2").click(function(){
            $(".cityfission-11").hide();
            $(".cityfission-22").show();
        });
        $(".cityfission-1").click(function(){
            $(".cityfission-11").show();
            $(".cityfission-22").hide();
        });
    });

</script>

</body>
</html>