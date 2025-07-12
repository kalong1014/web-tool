<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:89:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/usersite/index.html";i:1665381072;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/header.html";i:1660125746;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/footer.html";i:1660125746;}*/ ?>
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
        margin-top:30px;
      
    }
    .btn-primary{
        margin-top:40px;
        margin-left:10%;
        width: 300px;
    }
    .col-sm-2{
      width: 10%;
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
      
                    <form class="form-inline font13" method="post" action="<?php echo url('usersit_add'); ?>"  enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">后台名称 :</label>
                            <div class="input-group col-sm-4">
                                <input id="title" type="text" class="form-control" name="htname" value="<?php echo $list['htname']; ?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">网站标题 :</label>
                            <div class="input-group col-sm-4">
                                <input id="title" type="text" class="form-control" name="biaoti" value="<?php echo $list['biaoti']; ?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">副标题：</label>
                            <div class="input-group col-sm-4">
                                <input id="title" type="text" class="form-control" name="fubiaoti" value="<?php echo $list['fubiaoti']; ?>" >
                            </div>
                        </div>
                 
                        <div class="form-group">
                            <label class="col-sm-2 control-label">网站关键词 :</label>
                            <div class="input-group col-sm-4">
                                <input id="title" type="text" class="form-control" name="ci" value="<?php echo $list['ci']; ?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">网站描述 :</label>
                            <div class="input-group col-sm-4">
                                <input id="title" type="text" class="form-control" name="miaoshu" value="<?php echo $list['miaoshu']; ?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">ICP备案信息 :</label>
                            <div class="input-group col-sm-4">
                                <input id="title" type="text" class="form-control" name="beian" value="<?php echo $list['beian']; ?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">电话 :</label>
                            <div class="input-group col-sm-4">
                                <input id="title" type="number" class="form-control" name="phone" value="<?php echo $list['phone']; ?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">底部信息 :</label>
                            <div class="input-group col-sm-4">
                                <input id="title" type="text" class="form-control" name="dibu" value="<?php echo $list['dibu']; ?>" >
                            </div>
                  </div>
                   
                    <div class="form-group">
                            <label class="col-sm-2 control-label">微信二维码 :</label>
                             <input id="title" type="file" class="form-control" name="ewm" value="" >
                            <div class="input-group col-sm-4">
                                
                                <?php if(!empty($list['ewm'])): ?>
                                <img src="/static/admin/images/<?php echo $list['ewm']; ?>" alt="" style="width:100px;height:50px;" />
                                <?php else: endif; ?>
                                
                               
                               
                            </div>
                  </div>
                   <div class="form-group">
                            <label class="col-sm-2 control-label">内页LOGO :</label>
                             <input id="title" type="file" class="form-control" name="nylogo" value="" >
                            <div class="input-group col-sm-4">
                                
                                <?php if(!empty($list['nylogo'])): ?>
                                <img src="/static/admin/images/<?php echo $list['nylogo']; ?>" alt="" style="width:100px;height:50px;" />
                                <?php else: endif; ?>
                                
                                <span>图片尺寸80*38</span>
                               
                            </div>
                  </div>
                
                  <!--<div class="form-group">-->
                  <!--          <label class="col-sm-2 control-label">视频剪辑扣除:</label>-->
                  <!--          <div class="input-group col-sm-4">-->
                  <!--              <input id="title" type="text" class="form-control" name="spjj" value="<?php echo $list['spjj']; ?>" >-->
                  <!--          </div>-->
                  <!--</div>-->
                  <!--<div class="form-group">-->
                  <!--          <label class="col-sm-2 control-label">图片素材最少:</label>-->
                  <!--          <div class="input-group col-sm-4">-->
                  <!--              <input id="title" type="text" class="form-control" name="imgnum" value="<?php echo $list['imgnum']; ?>" >-->
                  <!--          </div>-->
                  <!--</div>-->
                  <!--<div class="form-group">-->
                  <!--          <label class="col-sm-2 control-label">关键词扣除:</label>-->
                  <!--          <div class="input-group col-sm-4">-->
                  <!--              <input id="title" type="text" class="form-control" name="jifen" value="<?php echo $list['jifen']; ?>" >-->
                  <!--          </div> -->
                  <!--</div>-->
                  <?php if($jibie==0): ?>
                  <div class="form-group">
                        <label class="col-sm-2 control-label">是否开启招商页:</label>
                        <div class="input-group col-sm-4">
                            <select  class="form-control" name="pc" id="">
                                <?php if($list['pc']==0): ?>
                                <option value="0">否</option>
                                <option value="1">是</option>
                                <?php else: ?>
                                 <option value="1">是</option>
                                 <option value="0">否</option>
                               
                                <?php endif; ?>
                                
                            </select>
                        </div> 
                  </div>
                  <?php else: endif; ?>
                   <div class="form-group">
                            <label class="col-sm-2 control-label">扫码授权提示语 :</label>
                            <div class="input-group col-sm-4">
                        <textarea name="h5_msg" id= rows="8" cols="40"><?php echo !empty($list['h5_msg'])?$list['h5_msg']:''; ?></textarea>
                            </div>
                  </div>
           
                <button type="submit" class="btn btn-primary">保&nbsp;&nbsp;&nbsp;存</button> 
                </form>
    
            <!--搜索框开始-->           
            <!--<div class="row">-->
            <!--    <div class="col-sm-12">   -->
                                                        
            <!--        <form name="admin_list_sea" class="form-search" method="post" action="<?php echo url('chaxun'); ?>">-->
            <!--            <span style="width:100px;float:left">站长工具</span> -->
                      <!--  <input type="text"  class="form-control" name="name" value="" placeholder="" style="width:200px;float:left"  disabled="tuue"/> -->
            <!--        <input type="text"  class="form-control" name="key" value="" placeholder="请输入您的key值" style="width:300px;float:left" />   -->
            <!--                <div class="form-group">-->
                          
            <!--                <div class="col-sm-6">-->
            <!--                    <div class="radio ">                                        -->
            <!--                        <input type="checkbox" name='status' value="1" class="js-switch" checked />&nbsp;&nbsp;默认开启                                     -->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
                        
            <!--            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> 保存</button> -->

            <!--        </form>                         -->
            <!--    </div>-->
            <!--</div>-->
           
            <!--搜索框结束-->

  
         
        </div>
    </div>
</div>
<!-- kaishi -->



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
     var elem = document.querySelector('.js-switch');
        var switchery = new Switchery(elem, {
            color: '#1AB394'
        });
         var elem = document.querySelector('.js-switch1');
        var switchery = new Switchery(elem, {
            color: '#1AB394'
        });
        var elem = document.querySelector('.js-switch2');
        var switchery = new Switchery(elem, {
            color: '#1AB394'
        });
        var elem = document.querySelector('.js-switch3');
        var switchery = new Switchery(elem, {
            color: '#1AB394'
        });
        var elem = document.querySelector('.js-switch4');
        var switchery = new Switchery(elem, {
            color: '#1AB394'
        });
        var elem = document.querySelector('.js-switch5');
        var switchery = new Switchery(elem, {
            color: '#1AB394'
        });
        var elem = document.querySelector('.js-switch6');
        var switchery = new Switchery(elem, {
            color: '#1AB394'
        });
        var elem = document.querySelector('.js-switch7');
        var switchery = new Switchery(elem, {
            color: '#1AB394'
        });
        var elem = document.querySelector('.js-switch8');
        var switchery = new Switchery(elem, {
            color: '#1AB394'
        });
        var elem = document.querySelector('.js-switch9');
        var switchery = new Switchery(elem, {
            color: '#1AB394'
        });
         var elem = document.querySelector('.js-switch10');
        var switchery = new Switchery(elem, {
            color: '#1AB394'
        });
    
    var config = {
        '.chosen-select': {},                    
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }

</script>

</html>