<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:87:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/video/xitong.html";i:1667532724;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/header.html";i:1660125746;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/footer.html";i:1660125746;}*/ ?>
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
        
                    <h5 style="font-size:14px;margin-bottom:0">抖音接口：  <button class="btn btn-success" onclick="qiehuan()" style="font-size:13px">点击切换接口</button></h5>
            
                    <form class="form-inline font13" method="post" action="<?php echo url('xitong'); ?>">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?php if($list['api']==2): ?>抖音接口Key(借权) :<?php else: ?>抖音接口Key :<?php endif; ?></label>
                            <div class="input-group col-sm-4">
                                <input id="title" type="text" class="form-control" name="clientkey" value="<?php echo $list['clientkey']; ?>"  >
                            </div>
                        </div>
                
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?php if($list['api']==2): ?>抖音接口Secret(借权) :<?php else: ?>抖音接口Secret :<?php endif; ?></label>
                            <div class="input-group col-sm-4">
                                <input id="title" type="text" class="form-control" name="clientsecret" value="<?php echo $list['clientsecret']; ?>" >
                            </div>
                        </div>  
                  
                        <div class="hr-line-dashed" style="color:#000">
                            <!--.........................................................-->
                        </div>
                  
                        <h5 style="font-size:14px;margin-bottom:0">阿里云接口：</h5> 
                        <div class="form-group">
                            <label class="col-sm-2 control-label">阿里云KeyId :</label>
                            <div class="input-group col-sm-4">
                                <input id="title" type="text" class="form-control" name="alykeyId" value="<?php echo $list['alykeyId']; ?>" >
                            </div>
                        </div>
                
                        <div class="form-group">
                            <label class="col-sm-2 control-label">阿里云KeySecret :</label>
                            <div class="input-group col-sm-4">
                                <input id="title" type="text" class="form-control" name="alykeysecret" value="<?php echo $list['alykeysecret']; ?>" >
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="col-sm-2 control-label">阿里云Buket地址 :</label>
                            <div class="input-group col-sm-4">
                                <input id="title" type="text" class="form-control" name="alybuket" value="<?php echo $list['alybuket']; ?>" >
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="col-sm-2 control-label">阿里云Buket名称 :</label>
                            <div class="input-group col-sm-4">
                                <input id="title" type="text" class="form-control" name="alybuketname" value="<?php echo $list['alybuketname']; ?>"  >
                            </div>
                        </div> 

                        <div class="form-group">
                            <label class="col-sm-2 control-label">混剪接入区域标识 :</label>
                            <div class="input-group col-sm-4">
                                <input id="title" type="text" class="form-control" name="biaoshi" value="<?php echo $list['biaoshi']; ?>" >
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="col-sm-2 control-label">混剪Endpoint :</label>
                            <div class="input-group col-sm-4">
                                <input id="title" type="text" class="form-control" name="endpoint" value="<?php echo $list['endpoint']; ?>" >
                            </div>
                        </div> 
                        <div class="hr-line-dashed"></div>
                    
                    
                        <h5 style="font-size:14px;margin-bottom:0">快手接口：</h5> 
                        <div class="form-group">
                            <label class="col-sm-2 control-label">快手appId :</label>
                            <div class="input-group col-sm-4">
                                <input id="title" type="text" class="form-control" name="appid" value="<?php echo $list['appid']; ?>" >
                            </div>
                        </div>
                
                        <div class="form-group">
                            <label class="col-sm-2 control-label">快手appSecret :</label>
                            <div class="input-group col-sm-4">
                                <input id="title" type="text" class="form-control" name="appsecret" value="<?php echo $list['appsecret']; ?>" >
                            </div>
                        </div> 
                        <div class="hr-line-dashed"></div>
                        <h5 style="font-size:14px;margin-bottom:0">去水印接口：</h5> 
                        <div class="form-group">
                            <label class="col-sm-2 control-label">接口key :</label>
                            <div class="input-group col-sm-4">
                                <input id="title" type="text" class="form-control" name="key_api" value="<?php echo $list['key_api']; ?>" >
                            </div>
                        </div>
                
                        <div class="hr-line-dashed"></div>
                        <h5 style="font-size:14px;margin-bottom:0">SEO排名接口：</h5> 
                        <div class="form-group">
                            <label class="col-sm-2 control-label">排名appId :</label>
                            <div class="input-group col-sm-4">
                                <input id="title" type="text" class="form-control" name="gjcappid" value="<?php echo $list['gjcappid']; ?>" >
                            </div>
                        </div>
                
                        <div class="form-group">
                            <label class="col-sm-2 control-label">排名appkey :</label>
                            <div class="input-group col-sm-4">
                                <input id="title" type="text" class="form-control" name="gjckey" value="<?php echo $list['gjckey']; ?>" >
                            </div>
                        </div> 
                        <div class="hr-line-dashed"></div>
           
                  
                        <button type="submit" class="btn btn-primary m-t-md">保存</button> 
                
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- kaishi -->
<!--切换接口开始-->
<div class="modal fade" id="add" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" style="width:50%">
            <div class="modal-content" style="width:100%;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">切换接口</h4>                  
                </div>
                <div class="add-renwu m-l-md m-r-md">
                    <input type="hidden" name="api" id="" value="<?php echo $list['api']; ?>" />
                    <input type="hidden" name="apiid" id="" value="<?php echo $list['id']; ?>" />
                    <div class="m-t-md" style="font-size:14px;line-height:2">
                        <b>注意事项：</b><br>
                            1、切换接口可能导致之前授权的账号权限异常，必须将之前授权的账号重新授权。<br>
                            2、正在执行的视频发布任务会导致发送失败，请删除当前任务，新建发布任务。<br>
                            3、建议选好接口方式之后非必要不更换。
                               
                    </div>
                    <div class="form-group m-t-md" style="text-align: center;">
                        <botton class="btn btn-primary"  id='zhida_baocun' onclick="sub()" >
                            确认切换接口
                        </botton>
                    </div>
                </div> 
            </div>
        </div>
    </div>
<!--结束-->


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
    function qiehuan(){
        //layer.msg("操作成功",{icon:1,time:1500,shade: 0.1,});
       $("#add").modal('show');
    }
    
    function sub(){
       
         apiid =     $("input[name='apiid']").val();
         api =     $("input[name='api']").val();
        
    $.post('<?php echo url("apiqh"); ?>',
     {apiid:apiid,api:api},
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
</script>

</html>