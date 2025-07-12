<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:94:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/member/edit_vipdali.html";i:1665556318;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/header.html";i:1660125746;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/footer.html";i:1660125746;}*/ ?>
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
    <div class="header-box">
        <div class="pl25">
            <h3 class="fs22 font-weight-500 c333">编辑代理用户</h3>
            <p class="fs14 c666">根据提示信息编辑代理资料</p>
        </div>
    </div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
               
                <div class="ibox-content m-t-md">
                    <form class="form-horizontal" name="userAdd"  action="<?php echo url('edit_vipdali'); ?>" enctype="multipart/form-data" method="post">
                        <input type="hidden" name="id" value="<?php echo $list['id']; ?>">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">代理名称昵称<i style="color:#ff7752;font-weight:blod;margin:0 5px">*</i></label>
                            <div class="input-group col-sm-4">
                                <input id="username" type="text" class="form-control" name="username" required="required" placeholder="登录账号通用" value="<?php echo $list['username']; ?>">
                            </div>
                        </div>
                          <div class="form-group">
                            <label class="col-sm-3 control-label">代理等级：</label>
                            <div class="input-group col-sm-4">
                                <select class="form-control" name="jibie" id="groupid" onclick="xuanze()">
                                    <?php if($list['jibie'] ==1): ?>
                                    <option value="1">贴牌代理</option>
                                  
                                     <?php else: ?>
                                     
                                    <option value="2">普通代理</option>
                                   
                                      <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="tpm">
                            <label class="col-sm-3 control-label">代理贴牌名<i style="color:#ff7752;font-weight:blod;margin:0 5px">*</i></label>
                            <div class="input-group col-sm-4">
                             <input id="painame" type="text" class="form-control" name="painame"  value="<?php echo $list['painame']; ?>">
                            </div>
                        </div>
                      
                       <div class="form-group" id="tpym">
                            <label class="col-sm-3 control-label">代理贴牌域名<i style="color:#ff7752;font-weight:blod;margin:0 5px">*</i></label>
                            <div class="input-group col-sm-4">
                                <input id="domain" type="text" class="form-control" name="domain" value="<?php echo $list['domain']; ?>" >
                            </div>
                        </div>
                         <div class="form-group" id="tpdl">
                            <label class="col-sm-3 control-label">可开代理数<i style="color:#ff7752;font-weight:blod;margin:0 5px">*</i></label>
                            <div class="input-group col-sm-4">
                                <input id="dai" type="number" class="form-control" name="dai" value="<?php echo $list['dai']; ?>" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">发布扣除<i style="color:#ff7752;font-weight:blod;margin:0 5px">*</i></label>
                            <div class="input-group col-sm-4">
                                <input id="shang" type="number" class="form-control" name="fpspkc" value="<?php echo $list['fpspkc']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">排名扣除<i style="color:#ff7752;font-weight:blod;margin:0 5px">*</i></label>
                            <div class="input-group col-sm-4">
                                <input id="shang" type="number" class="form-control" name="paiming" value="<?php echo $list['paiming']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">可开会员数<i style="color:#ff7752;font-weight:blod;margin:0 5px">*</i></label>
                            <div class="input-group col-sm-4">
                                <input id="shang" type="number" class="form-control" name="shang" value="<?php echo $list['shang']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">混剪扣除<i style="color:#ff7752;font-weight:blod;margin:0 5px">*</i></label>
                            <div class="input-group col-sm-4">
                                <input id="shang" type="number" class="form-control" name="hunjian" value="<?php echo $list['hunjian']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">运维扣除<i style="color:#ff7752;font-weight:blod;margin:0 5px">*</i></label>
                            <div class="input-group col-sm-4">
                                <input id="shang" type="number" class="form-control" name="yunwei" value="<?php echo $list['yunwei']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">登录密码<i style="color:#ff7752;font-weight:blod;margin:0 5px">*</i></label>
                            <div class="input-group col-sm-4">
                                <input id="password" type="text" class="form-control" name="password" placeholder="不修改可为空" >
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <label class="col-sm-3 control-label">公司名称：</label>
                            <div class="input-group col-sm-4">
                                <input id="real_name" type="text" class="form-control" required="required" name="real_name" value="<?php echo $list['real_name']; ?>">

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">联系方式：</label>
                            <div class="input-group col-sm-4">
                                <input id="real_name" type="text" class="form-control" name="phone" value="<?php echo $list['phone']; ?>">

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">到期时间<i style="color:#ff7752;font-weight:blod;margin:0 5px">*</i></label>
                            <div class="input-group col-sm-4">
                                <input id="" type="date"  class="form-control" name="user_time"  value="<?php echo $list['user_time']; ?>">

                            </div>
                        </div>
                       
                        <div class="form-group">
                            <label class="col-sm-3 control-label">状&nbsp;态：</label>
                            <div class="col-sm-6">
                                <div class="radio ">                                        
                                    <input type="checkbox" name='status' value="1" class="js-switch" checked />&nbsp;&nbsp;默认开启                                     
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                                <button class="btn btn-primary" type="submit" > <i class="fa fa-save"></i> 保存</button>&nbsp;&nbsp;&nbsp;
                                <a class="btn btn-danger" href="javascript:history.go(-1);"><i class="fa fa-close"></i> 返回</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<input type="hidden" name="jiebie" value="<?php echo $list['jibie']; ?>">

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
        var  uid = $('input[name="jiebie"]').val();

         if(uid==2){
             //当前为一级代理可以开代理和会员
            $("#tpm").css('display','none');
            $("#tplg").css('display','none');
            $("#tpym").css('display','none');
            $("#tpdl").css('display','none');
         }else {
           

         }
    })

function xuanze(){
   dai = $('#groupid  option:selected').val();
    if(dai ==1){
       //$('input[name="password"]').css('display','none'); 
        $("#tpm").css('display','block');
        $("#tplg").css('display','block');
        $("#tpym").css('display','block');
        $("#tpdl").css('display','block');
    }else{
        $("#tpm").css('display','none');
        $("#tplg").css('display','none');
        $("#tpym").css('display','none');
        $("#tpdl").css('display','none');
    }
}
document.querySelector('#file').onchange = function (){
    //var fileArray = document.getElementById('file').files[0];
   // $("#pic").attr('src',fileArray);
 var f = document.getElementById('file').files[0];
    var src = window.URL.createObjectURL(f);
 document.getElementById('pic').src = src;
 $("#hi").css('display','block');
}

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