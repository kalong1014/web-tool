<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:99:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/member/member_agent_edit.html";i:1665311850;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/header.html";i:1660125746;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/footer.html";i:1660125746;}*/ ?>
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
                <div class="block">
                   <form class="form-horizontal" name="userAdd"  method="post" action="">
                    <input type="hidden" name="id" value="<?php echo $list['id']; ?>">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">会员名称：</label>
                            <div class="input-group col-sm-4">
                                <input id="username" type="text" class="form-control" name="username" required="required" value="<?php echo $list['username']; ?>">
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-sm-2 control-label">会员组：</label>
                            <div class="input-group col-sm-4">
                                <select class="form-control" name="hyz" id="groupid" onclick="xuanze()">
                                    <?php if(is_array($hyfz) || $hyfz instanceof \think\Collection): if( count($hyfz)==0 ) : echo "" ;else: foreach($hyfz as $key=>$vo): if($list['hyz'] == $vo['id']): ?>
                                     <option value="<?php echo $vo['id']; ?>"><?php echo $vo['username']; ?></option>
                                     <?php else: ?>
                                      <option value="<?php echo $vo['id']; ?>"><?php echo $vo['username']; ?></option>
                                     <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                    
                                   
                                     
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">登录密码：</label>
                            <div class="input-group col-sm-4">
                                <input id="password" type="text" class="form-control" name="password"   placeholder="不修改可留空">
                            </div>
                        </div>
                     
                        <div class="form-group">
                            <label class="col-sm-2 control-label">公司名称：</label>
                            <div class="input-group col-sm-4">
                                <input id="real_name" type="text" class="form-control" required="required" name="real_name" value="<?php echo $list['real_name']; ?>">

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">联系方式：</label>
                            <div class="input-group col-sm-4">
                                <input id="real_name" type="text" class="form-control" name="phone" value="<?php echo $list['phone']; ?>">

                            </div>
                        </div>
                     <div class="form-group">
                            <label class="col-sm-2 control-label">到期时间：</label>
                            <div class="input-group col-sm-4">
                                <input id="" type="date"  class="form-control" name="user_time" value="<?php echo $list['user_time']; ?>" >

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">状&nbsp;态：</label>
                            <div class="col-sm-6">
                                <div class="radio ">                                        
                                    <input type="checkbox" name='status' value="1" class="js-switch" checked />&nbsp;&nbsp;默认开启                                     
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> 保存</button>&nbsp;&nbsp;&nbsp;
                                <a class="btn btn-danger" href="javascript:history.go(-1);"><i class="fa fa-close"></i> 返回</a>
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
<script type="text/javascript">


    $(function(){
        $('#userAdd').ajaxForm({
            beforeSubmit: checkForm, 
            success: complete, 
            dataType: 'json'
        });
        
        function checkForm(){
            if( '' == $.trim($('#username').val())){
                layer.msg('请输入用户名',{icon:2,time:1500,shade: 0.1}, function(index){
                layer.close(index);
                });
                return false;
            }
            
            if( '' == $.trim($('#groupid').val())){
                layer.msg('请选择用户角色',{icon:2,time:1500,shade: 0.1}, function(index){
                layer.close(index);
                });
                return false;
            }

            if( '' == $.trim($('#password').val())){
                layer.msg('请输入登录密码',{icon:2,time:1500,shade: 0.1}, function(index){
                layer.close(index);
                });
                return false;
            }

            if( '' == $.trim($('#real_name').val())){
                layer.msg('请输入真实姓名',{icon:2,time:1500,shade: 0.1}, function(index){
                layer.close(index);
                });
                return false;
            }
        }


        function complete(data){
           
            if(data.code==1){
                layer.msg(data.msg, {icon: 6,time:1500,shade: 0.1}, function(index){
                    window.location.href="<?php echo url('user/index'); ?>";
                });
            }else{
                layer.msg(data.msg, {icon: 5,time:1500,shade: 0.1});
                return false;   
            }
        }
     
    });



    //IOS开关样式配置
   var elem = document.querySelector('.js-switch');
        var switchery = new Switchery(elem, {
            color: '#ff7752'
        });
    var config = {
        '.chosen-select': {},                    
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }

</script>
</body>
</html>