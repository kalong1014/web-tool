<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/video/wanshan.html";i:1667462037;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/header.html";i:1660125746;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/footer.html";i:1660125746;}*/ ?>
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


<script type="text/javascript" src="js/jquery-timepicker.js"/>"></script>
<link rel="stylesheet" href="/static/admin/easyUpload/uploadJs/upload.css">

<style>
    /*.form-group{*/
    /*    height: 45px;*/
    /*}*/
    .form-group label.control-label{
        line-height: 35px!important;
    }
    .yulan{
            max-height: 450px;
    overflow: auto;
    }
    .btn-tishi img{
        position:relative;
        animation:mymove 5s infinite;
        -webkit-animation:mymove 5s infinite;
    }
    @keyframes mymove
    {
        0% {left:0px;}
        50%{left:100px;}
        100% {left:0px;}
    }
    @-webkit-keyframes mymove /*Safari and Chrome*/
    {
        0% {left:0px;}
        50%{left:100px;}
        100% {left:0px;}
    }
    #spku-yulan >li {
        margin-bottom: 20px;
        margin-left: 2.6%;
        width: 21.7%;
    }
    #spku-yulan {
        -webkit-text-size-adjust: 100%;
        color: #333;
        font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        -webkit-tap-highlight-color: rgba(0,0,0,0);
        display: flex;
        flex-wrap: wrap;
    }
    .neiro {
        width: 100%!important;
        height: 215px!important;
    }
    .neiro img{width: 100%;height: 100%;}
    .neiro video{height: 100%!important;}
    .yulan #newli >li{
        width: 15.7%;
    }
    .ds_div{
        display: none;
    }
    
</style>

<!--上传封面-->
<style>
    #ossfile{
        font-size: 12px;padding: 5px 0;text-align: center;
    }
    span.yue_div1.yue_div_ban1{
        background: #000;
        padding: 5px;
    }
    span.yue_div1.yue_div_ban1, div.yue_div {
        display: flex;
        width: 60%;padding: 10px 0;
    }
    span.yue_name1, .yue_name {
        width: 40%;
    }
    span.yue_bit1, .yue_bit {
        width: 20%;
    }
    .progress1, .yue_div dt {
        width: 39%;
    }
    .yue_div dt{
        display: flex;
    }
    .progress{
        width: 80%;margin: 0;
    }
    #form_img img{
        height: 80px;margin-right: 10px;margin-bottom: 10px;
    }
</style>


<body class="gray-bg">
    
    <link href="__CSS__/wanshan.css" rel="stylesheet">
    <!-- start: Header -->
    <div class="header-box">
        <div class="pl25">
            <h3 class="fs22 font-weight-500 c333">发布群发任务</h3>
            <p class="fs14 c666">根据提示完善任务相关信息</p>
            <p class="fs14 c666" style="color:red">注意：账号分组里面包含快手要上传视频封面，否则会发送失败</p>
        </div>
    </div>
    <!-- start: Header -->
    
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="btn-tishi" style="width:200px;position: absolute;right: 10%;top: 20px;height: 100px;" title="点我看看呀">
                        <div class="shan"></div>
                        <img src="__IMG__/tishi.png" style="width:100%;opacity: .7;">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="input-group col-sm-6">
                            <label class="radio-inline">
                            <input type="radio" name="typ" id="" value="2" checked style="margin-top:3px"> H5任务
                            </label>
                            <label class="radio-inline">
                            <input type="radio" name="typ" id="" value="1" style="margin-top:3px"> 普通任务
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">任务名称：</label>
                            <div class="input-group col-sm-6">
                                <input  type="text" class="form-control" name="rwname" placeholder="想个名字吧！">
                            </div>
                    </div>
                    <div class="form-group" style="height:45px">
                            <label class="col-sm-2 control-label">选择智能标题：</label>
                            <div class="input-group col-sm-4">
                                <select name="biaotid" class="form-control m-b" id="biaotid" style="width:200px">
                                    <?php if(is_array($biaoti) || $biaoti instanceof \think\Collection): if( count($biaoti)==0 ) : echo "" ;else: foreach($biaoti as $key=>$bt): ?>
                                    <option value="<?php echo $bt['id']; ?>"><?php echo $bt['ci_name']; ?></option>
                                     <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>  
                            </div>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">选择账号：</label>
                        <div class="input-group col-sm-4">
                            <input type="radio" name="inlineRadioOptions" id="zhida_san_bu_a" value="option1" checked style="margin-top:3px"> 选择账号
                            <input type="radio" name="inlineRadioOptions" id="zhida_san_bu_b" value="option4" style="margin-top:3px"> 按组发布
                        </div>
                    </div>
                    <div class="form-group" id="zhida_hunjian_a" style="display:none">
                        <label class="col-sm-2 control-label">选择账号分组：</label>
                        <div class="input-group col-sm-6">
                            <select name="zu" class="form-control m-b" id="zu" style="width:200px;float:left">
                                <?php if(is_array($zu) || $zu instanceof \think\Collection): if( count($zu)==0 ) : echo "" ;else: foreach($zu as $key=>$vo): ?>
                                <option value="<?php echo $vo['id']; ?>"><?php echo $vo['fzname']; ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>   
                           
                        </div>
                    </div>
                      <div class="form-group" style="height:inherit;" id="zhida_san_hao">
                        <div style="display:flex">
                            <label class="col-sm-2 control-label">&nbsp;</label>
                            <div class="input-group col-sm-6">
                                <ul class="zhida_h" id="zhida_zhanghao" style="padding-left:0;width: 100%;">
                                    <div class="zhida_l" style="max-height:155px;overflow:auto;">
                                    <?php if(is_array($list) || $list instanceof \think\Collection): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$value): ?>
                                    <div class=" checkbox-user" style="width:31.333%;float:left;margin-bottom: 4%;">
                                        <label class="checkbox-inline" style="height:35px;line-height:35px;display: inline-flex;align-items: center;">
                                            <input type="checkbox"  value="<?php echo $value['id']; ?>" name="name_id" class="zhida_chec" style="margin-top:0px">
                                            <img src="<?php echo $value['avatar']; ?>" style="width: 35px;height: 35px;border-radius: 5px;margin:0 5px">
                                            <div style="line-height:1.8;overflow: hidden;">
                                                    <div style="font-size:13px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;"><?php echo $value['nickname']; ?></div>
                                                    <span class="biao"><?php echo $value['type_name']; ?></span>
                                                </div>
                                        </label>
                                    </div>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                    <button type="button" style="display:none;" class="btn btn-primary reset_user">重新选择</button>
                                </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">视频来源：</label>
                        <div class="input-group col-sm-6">
                            <select name="sucai" class="form-control m-b" id="sucai1" style="width:200px">
                                    <option id="" value="0">选择视频来源</option>
                                    <option id="zhida_shipin" value="3"  >本地素材库</option>
                                    <option id="inlineRadio3" value="2" >混剪库</option>
                            </select>  
                              
                            <p style="font-size:12px;color:#9d9d9d;line-height: 35px;" id="wenzi"></p>

                        </div>
                    </div>    
                    
                     <div class="form-group"   id="xuan" style="height:inherit;min-height:45px">
                      
                        <div  class="col-sm-12" >
                            <label class="col-sm-2 control-label">选择快手封面：</label>
                             
                            <div class="case">
                            	 <div class="upload" action='/admin/video/cover_upload' id='case' data-type="png,jpg,jpeg"></div>
                            </div>
                        </div>
                    </div>
                    <div class="" id="form_img" style="margin-left:16.77777777%;width:60%">
                        </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">视频是否重复：</label>
                        <div class="input-group col-sm-6">
                            <label class="radio-inline">
                            <input type="radio" name="chongfu" id="inlineRadio1" value="2" checked style="margin-top:3px"> 允许
                            </label>
                            <label class="radio-inline">
                            <input type="radio" name="chongfu" id="inlineRadio2" value="1" style="margin-top:3px"> 禁止
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">每个账号发布视频数量：</label>
                        <div class="input-group col-sm-6">
                            <input id="" type="text" class="form-control" name="number" autocomplete="off" style="width:calc(70% - 90px);margin-right: 10px;">
                            <label class="col-sm-2 control-label" style="width:80px">视频间隔：</label>
                            <input id="username" type="text" class="form-control" name="jiange" autocomplete="off" style="width:calc(30% - 10px);margin-left:10px;float: inherit;">
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="col-sm-2 control-label">抖音POI地址：</label>
                        <div class="input-group col-sm-6">
                            <input id="username" type="text" class="form-control" name="poiadd" autocomplete="off" value="" style="width:calc(70% - 90px);margin-right: 10px;">
                            <a class="btn btn-primary" id="poi" style="font-size:12px;float: inherit;width: 80px;">获取POI</a>
                            <input id="username" type="text" class="form-control" name="poigz" autocomplete="off" value="" readonly style="width:calc(30% - 10px);margin-left:10px;float: inherit;">
                            <p style="font-size:12px;width:100%;color:#9d9d9d">  请到抖音官方搜索要挂在的地址业链接复制到这里即可例如:https://v.douyin.com/FGYjG1r/</p>
                        </div>
                    </div>
                    <div class="form-group">
                            <label class="col-sm-2 control-label">发布方式：</label>
                            <div class="input-group col-sm-6" style="line-height:45px">
                                <label class="radio-inline" style="align-items: center;display: inline-flex;">
                                <input type="radio" name="fb_type" style="margin-top:0px;" id="immediately" value="0" checked> 立即发布
                                </label>
                                
                                <label class="radio-inline" style="align-items: center;display: inline-flex;">
                                <input type="radio" name="fb_type" style="margin-top:0px;" id="timing" value="1" > 定时发布
                                </label>
                            </div>
                    </div>
                        
                      
                        
                        
                        
                        
                        <div class="form-group ds_div">
                            <label class="col-sm-2 control-label">开始时间：</label>
                            <div class="input-group col-sm-4">
                                <!--<span style="font-size:16px;color:#4A4AFF">开始时间</span>-->
                                <input id="beginTime" type="text" class="form-control" name="kaishitime"  autocomplete="off" >
                                <font color="red" id="validateBeginTime"></font>
                                
                            </div>
                        </div>
                        <div class="form-group ds_div">
                            <label class="col-sm-2 control-label">结束时间：</label>
                            <div class="input-group col-sm-4">
                                <!--<span style="font-size:16px;color:#4A4AFF">结束时间：</span>-->
                                <input id="endTime" type="text" class="form-control" name="jieshutime"  autocomplete="off">
                               <font color="red" id="validateEndTime"></font>
                                <p style="font-size:12px;width:100%;color:#9d9d9d"> 
                                    <b style="color:#ff7752">注意:</b>
                                    仅在此时间段内发布视频，不在此时间段不发布！为空则不限制
                                </p>
                            </div>
                        </div>
                        <div class="form-group ds_div">
                            <label class="col-sm-2 control-label">指定发布日期：</label>
                            <div class="input-group col-sm-4">
                                <!--<span style="font-size:16px;color:#4A4AFF">结束时间：</span>-->
                                <input id="Time" type="date" class="form-control" name="zhidingtime"  autocomplete="off">
                               <font color="red" id="validateEndTime"></font>
                                <p style="font-size:12px;width:100%;color:#9d9d9d">
                                    <b style="color:#ff7752">注意:</b>
                                    选择发布日期必选开始时间与结束时间。</p>
                            </div>
                        </div>
                        
                    <div class="form-group">
                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-6">
                            <button class="btn btn-primary" type="submit" onclick="tijiaofabu()"> 发布任务</button>&nbsp;&nbsp;&nbsp;
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>

      .layui-input, .layui-textarea{
        /*width:auto!important;*/
    }
    .layui-form-label{
        width:140px!important;
    }
    /*
    .jichudata .layui-form-item{
        width:30%!important;
        float: left;
        clear: none!important;
        margin-right:2%;
    }*/
    .layui-input-block{
        margin-left: 140px;
    }
  .skai_body{
        -webkit-text-size-adjust: 100%;
    color: #333;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    position: fixed;
    top: 50px;
    left: 140px;
    bottom: 0;
    right: 0;
    background: #FFF;
  }
  .skai_body_main{
        -webkit-text-size-adjust: 100%;
    color: #333;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    box-sizing: border-box;
    margin: 0;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    overflow: hidden;
    overflow-y: auto;
    padding: 15px;
  }
  .panel {
        -webkit-text-size-adjust: 100%;
    color: #333;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    margin-bottom: 20px;
    background-color: #fff;
    border: 1px solid transparent;
    border-radius: 4px;
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
    border-color: #bce8f1;
  }
    .panel-body {
            -webkit-text-size-adjust: 100%;
    color: #333;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    box-sizing: border-box;
    margin: 0;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    padding: 15px;
    }
    .layui-fluid{
            -webkit-text-size-adjust: 100%;
    color: #333;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    box-sizing: border-box;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    position: relative;
    margin: 0 auto;
    padding: 15px;
    }
    .layui-row{
            -webkit-text-size-adjust: 100%;
    color: #333;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    }
    .layui-col-xs12{
            -webkit-text-size-adjust: 100%;
    color: #333;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    margin: 0;
    padding: 0;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    position: relative;
    display: block;
    box-sizing: border-box;
    float: left;
    width: 100%;
    }
    .layui-card{
            -webkit-text-size-adjust: 100%;
    color: #333;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    border-radius: 2px;
    background-color: #fff;
    box-shadow: 0 1px 2px 0 rgba(0,0,0,.05);
    margin-bottom: 0;
    }
    .layui-card-body{
            -webkit-text-size-adjust: 100%;
    color: #333;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    box-sizing: border-box;
    margin: 0;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    position: relative;
    padding: 10px 15px;
    line-height: 24px;
    }
    .layui-elem-quote {
    -webkit-text-size-adjust: 100%;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    box-sizing: border-box;
    margin: 0;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    margin-bottom: 10px;
    padding: 15px;
    border-left: 5px solid #009688;
    border-radius: 0 2px 2px 0;
    background-color: #f2f2f2;
    line-height: 22px;
    font-size: 14px;
    color: #666;
    }
    .layui-form{
            -webkit-text-size-adjust: 100%;
    color: #333;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    line-height: 24px;
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    }
    .layui-form-item{
            -webkit-text-size-adjust: 100%;
    color: #333;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    line-height: 24px;
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    margin-bottom: 15px;
    clear: both;
    }
    .layui-form-label{
            -webkit-text-size-adjust: 100%;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    box-sizing: border-box;
    max-width: 100%;
    color: #252424;
    vertical-align: middle;
    margin-bottom: 0;
    position: relative;
    float: left;
    display: block;
    padding: 9px 15px;
    font-weight: 400;
    line-height: 20px;
    text-align: right;
    width: 140px!important;
    }
    
    .layui-input{
            -webkit-text-size-adjust: 100%;
    font: inherit;
    color: inherit;
    margin: 0;
    padding: 0;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    font-family: inherit;
    font-size: inherit;
    font-style: inherit;
    font-weight: inherit;
    outline: 0;
    -webkit-appearance: none;
    -webkit-transition: all .3s;
    box-sizing: border-box;
    border-color: #e6e6e6;
    height: 38px;
    line-height: 1.3;
    border-width: 1px;
    border-style: solid;
    background-color: #fff;
    border-radius: 2px;
    display: block;
    width: 100%;
    padding-left: 10px;
    }
    .layui-form-mid{
            -webkit-text-size-adjust: 100%;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    box-sizing: border-box;
    margin: 0;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    position: relative;
    color: #999!important;
    float: left;
    display: block;
    padding: 9px 0!important;
    line-height: 20px;
    margin-right: 10px;
    }
    .layui-form-label{
            -webkit-text-size-adjust: 100%;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    box-sizing: border-box;
    max-width: 100%;
    color: #252424;
    vertical-align: middle;
    margin-bottom: 0;
    position: relative;
    float: left;
    display: block;
    padding: 9px 15px;
    font-weight: 400;
    line-height: 20px;
    text-align: right;
    width: 140px!important;
    }
    .layui-input-block{
            -webkit-text-size-adjust: 100%;
    color: #333;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    line-height: 24px;
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    position: relative;
    min-height: 36px;
    margin-left: 140px;
    }
    .layui-unselect {
            -webkit-text-size-adjust: 100%;
    color: #333;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    box-sizing: border-box;
    padding: 0;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    -webkit-user-select: none;
    display: inline-block;
    vertical-align: middle;
    line-height: 28px;
    margin: 6px 10px 0 0;
    padding-right: 10px;
    cursor: pointer;
    font-size: 0;
    }
    .layui-anim {
            -webkit-text-size-adjust: 100%;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    line-height: 28px;
    cursor: pointer;
    box-sizing: border-box;
    -webkit-user-select: none;
    font-family: layui-icon!important;
    font-style: normal;
    -webkit-font-smoothing: antialiased;
    vertical-align: middle;
    animation-duration: .3s;
    animation-fill-mode: both;
    margin-right: 8px;
    font-size: 22px;
    color: #5FB878;
    display: inline-block;
    }
    .layui-unselect {
            -webkit-text-size-adjust: 100%;
    color: #333;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    box-sizing: border-box;
    padding: 0;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    -webkit-user-select: none;
    display: inline-block;
    vertical-align: middle;
    line-height: 28px;
    margin: 6px 10px 0 0;
    padding-right: 10px;
    cursor: pointer;
    font-size: 0;
    }
</style>

<style>
      .layui-input, .layui-textarea{
        /*width:auto!important;*/
    }
    .layui-form-label{
        width:140px!important;
    }
    /*
    .jichudata .layui-form-item{
        width:30%!important;
        float: left;
        clear: none!important;
        margin-right:2%;
    }*/
    .layui-input-block{
        margin-left: 140px;
    }
  .layui-form-item .layui-input-inline{width:260px;}
  .skai_body{
        -webkit-text-size-adjust: 100%;
    color: #333;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    position: fixed;
    top: 50px;
    left: 140px;
    bottom: 0;
    right: 0;
    background: #FFF;
  }
  .skai_body_main{
        -webkit-text-size-adjust: 100%;
    color: #333;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    box-sizing: border-box;
    margin: 0;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    overflow: hidden;
    overflow-y: auto;
    padding: 15px;
  }
  .panel {
        -webkit-text-size-adjust: 100%;
    color: #333;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    margin-bottom: 20px;
    background-color: #fff;
    border: 1px solid transparent;
    border-radius: 4px;
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
    border-color: #bce8f1;
  }
    .panel-body {
            -webkit-text-size-adjust: 100%;
    color: #333;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    box-sizing: border-box;
    margin: 0;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    padding: 15px;
    }
    .layui-fluid{
            -webkit-text-size-adjust: 100%;
    color: #333;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    box-sizing: border-box;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    position: relative;
    margin: 0 auto;
    padding: 15px;
    }
    .layui-row{
            -webkit-text-size-adjust: 100%;
    color: #333;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    }
    .layui-col-xs12{
            -webkit-text-size-adjust: 100%;
    color: #333;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    margin: 0;
    padding: 0;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    position: relative;
    display: block;
    box-sizing: border-box;
    float: left;
    width: 100%;
    }
    .layui-card{
            -webkit-text-size-adjust: 100%;
    color: #333;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    border-radius: 2px;
    background-color: #fff;
    box-shadow: 0 1px 2px 0 rgba(0,0,0,.05);
    margin-bottom: 0;
    }
    .layui-card-body{
            -webkit-text-size-adjust: 100%;
    color: #333;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    box-sizing: border-box;
    margin: 0;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    position: relative;
    padding: 10px 15px;
    line-height: 24px;
    }
    .layui-elem-quote {
    -webkit-text-size-adjust: 100%;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    box-sizing: border-box;
    margin: 0;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    margin-bottom: 10px;
    padding: 15px;
    border-left: 5px solid #009688;
    border-radius: 0 2px 2px 0;
    background-color: #f2f2f2;
    line-height: 22px;
    font-size: 14px;
    color: #666;
    }
    .layui-form{
            -webkit-text-size-adjust: 100%;
    color: #333;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    line-height: 24px;
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    }
    .layui-form-item{
            -webkit-text-size-adjust: 100%;
    color: #333;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    line-height: 24px;
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    margin-bottom: 15px;
    clear: both;
    }
    .layui-form-label{
            -webkit-text-size-adjust: 100%;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    box-sizing: border-box;
    max-width: 100%;
    color: #252424;
    vertical-align: middle;
    margin-bottom: 0;
    position: relative;
    float: left;
    display: block;
    padding: 9px 15px;
    font-weight: 400;
    line-height: 20px;
    text-align: right;
    width: 140px!important;
    }
    
    .layui-input{
            -webkit-text-size-adjust: 100%;
    font: inherit;
    color: inherit;
    margin: 0;
    padding: 0;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    font-family: inherit;
    font-size: inherit;
    font-style: inherit;
    font-weight: inherit;
    outline: 0;
    -webkit-appearance: none;
    -webkit-transition: all .3s;
    box-sizing: border-box;
    border-color: #e6e6e6;
    height: 38px;
    line-height: 1.3;
    border-width: 1px;
    border-style: solid;
    background-color: #fff;
    border-radius: 2px;
    display: block;
    width: 100%;
    padding-left: 10px;
    }
    .layui-form-mid{
            -webkit-text-size-adjust: 100%;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    box-sizing: border-box;
    margin: 0;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    position: relative;
    color: #999!important;
    float: left;
    display: block;
    padding: 9px 0!important;
    line-height: 20px;
    margin-right: 10px;
    }
    .layui-form-label{
            -webkit-text-size-adjust: 100%;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    box-sizing: border-box;
    max-width: 100%;
    color: #252424;
    vertical-align: middle;
    margin-bottom: 0;
    position: relative;
    float: left;
    display: block;
    padding: 9px 15px;
    font-weight: 400;
    line-height: 20px;
    text-align: right;
    width: 140px!important;
    }
    .layui-input-block{
            -webkit-text-size-adjust: 100%;
    color: #333;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    line-height: 24px;
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    position: relative;
    min-height: 36px;
    margin-left: 140px;
    }
    .layui-unselect {
            -webkit-text-size-adjust: 100%;
    color: #333;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    box-sizing: border-box;
    padding: 0;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    -webkit-user-select: none;
    display: inline-block;
    vertical-align: middle;
    line-height: 28px;
    margin: 6px 10px 0 0;
    padding-right: 10px;
    cursor: pointer;
    font-size: 0;
    }
    .layui-anim {
            -webkit-text-size-adjust: 100%;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    line-height: 28px;
    cursor: pointer;
    box-sizing: border-box;
    -webkit-user-select: none;
    font-family: layui-icon!important;
    font-style: normal;
    -webkit-font-smoothing: antialiased;
    vertical-align: middle;
    animation-duration: .3s;
    animation-fill-mode: both;
    margin-right: 8px;
    font-size: 22px;
    color: #5FB878;
    display: inline-block;
    }
    .layui-unselect {
            -webkit-text-size-adjust: 100%;
    color: #333;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
    box-sizing: border-box;
    padding: 0;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    -webkit-user-select: none;
    display: inline-block;
    vertical-align: middle;
    line-height: 28px;
    margin: 6px 10px 0 0;
    padding-right: 10px;
    cursor: pointer;
    font-size: 0;
    }
</style>

<div class="modal fade" id="btn-tishi" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">温馨提示</h4>                  
                </div>
                <div class="zhida_san_hao" style="padding:20px 0 " id="zhida_san_hao">
                    <p class="zhida_er_a">
                        1、视频内容必须和主词相关，否则审核不通过或账号会存在限流风险。
                    </p>
                    <p class="zhida_er_a">
                        2、发布账号有 快手 必须上传封面图片哦！
                    </p>
                    <p class="zhida_er_a">
                        3、创建任务必须有视频,否则发布不成功哦！
                    </p>
                    <p class="zhida_er_a">
                        4、指定时间发布任务时，请仔细核算发布视频条数与间隔时间！
                    </p>
                </div>
            </div>
    </div>    
</div>
<!--视频库-->
<div class="modal fade" id="spku" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">视频库-素材分类列表选择</h4>                  
                </div>
                
                <div class="zhida_san_hao" style="" id="zhida_san_hao">
                    <div class="choose-spkzu m-l-md m-t-md" style="text-align:center">
                        <span style="font-size:14px">选择本地素材分类列表：</span>
                        <select name="spkzu" class="form-control" id="spkzu" style="width:200px;display: initial;">
                             <?php if(is_array($fenlei) || $fenlei instanceof \think\Collection): if( count($fenlei)==0 ) : echo "" ;else: foreach($fenlei as $key=>$v): ?>
                            <option value="<?php echo $v['id']; ?>"><?php echo $v['uname']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select> 
                        <button class="btn btn-info ml-10" data-dismiss="modal" onclick="queren(1)">确定选择</button>
                        <!--<button class="btn btn-info">全&nbsp;&nbsp;选</button>-->
                    </div>
			         <div class="yulan" style="margin-top:20px">
			             <ul id="spku-yulan" class="sucai-page" >

                           
			             </ul>
			         </div>
                </div>
            </div>
        </div>
    </div>


<div class="modal fade" id="add" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">混剪库选择</h4>                  
                </div>
                
                <div class="zhida_san_hao" style="" id="zhida_san_hao">
			            <div class="m-t-md m-b-md" id="zhida_zhanghao" style="padding:0 20px;">
                			<!--<p class="zhida_k" style="background:#fff;color:#000">账号列表</p>-->
                			<div class="" style="width：100%;300px;overflow:auto;">
                                <?php if(is_array($yun) || $yun instanceof \think\Collection): if( count($yun)==0 ) : echo "" ;else: foreach($yun as $key=>$v): ?>
                    			<div style="width:20%;float:left;margin-bottom: 1%;">
    	                			<label class="checkbox-inline">
    	  								<input type="checkbox"  value="<?php echo $v['id']; ?>" name="yun_yunid" class="zhida_chec" style="margin-top:5px">
    	  							
    	  								<span style="font-size:15px"><?php echo $v['yun_name']; ?></span>
    								</label>
    							</div>
    							
    							 <?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                        </div>
    					
    					<div class="form-group" style="text-align:center;margin-bottom:20px">
                                    <div class="col-col-sm-offset-3">
                                        <button type="button" id="add_btn" class="close btn btn-outline btn-primary" data-dismiss="modal" style="opacity:1;float:initial;font-size: initial;font-weight: normal;padding:6px 12px;line-height: inherit;" onclick="queren(2)">确认选择</button>
                                    </div>
                        </div>
    			</div>
            </div>
        </div>
</div>
<input type="hidden" name="video" id="" value="">
<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
<input type="hidden" id="accessKeyId" value="<?php echo $accessKeyId; ?>">
<input type="hidden" id="accessKeySecret" value="<?php echo $accessKeySecret; ?>">
<input type="hidden" id="oss_host" value="<?php echo $oss_host; ?>">
<input type="hidden" id="is_ks" value="0">
<!-- 模态框 添加组结束 -->
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
<script src="/static/admin/chengshi/jquery.min.js"></script>
<script src="/static/admin/chengshi/bootstrap.min.js"></script>
<script src="/static/admin/chengshi/RegionalChoice.js"></script>
<script type="text/javascript" src="/static/admin/easyUpload/oss/lib/crypto1/crypto/crypto.js"></script>
<script type="text/javascript" src="/static/admin/easyUpload/oss/lib/crypto1/hmac/hmac.js"></script>
<script type="text/javascript" src="/static/admin/easyUpload/oss/lib/crypto1/sha1/sha1.js"></script>
<script type="text/javascript" src="/static/admin/easyUpload/oss/lib/base64.js"></script>
<script type="text/javascript" src="/static/admin/easyUpload/oss/lib/plupload-2.1.2/js/plupload.full.min.js"></script>
<script type="text/javascript" src="/static/admin/easyUpload/oss/upload2.js"></script>
<script src="/static/admin/easyUpload/uploadJs/jQuery.upload.js"></script>
<script type="text/javascript" charset="utf-8">
    $("#upload_btn").click(function() {
        var files = $("input[name=upload]").val()
        console.log('=========下面是已上传文件========')
        console.log(files)
    })
</script>
<script type="text/javascript" charset="utf-8">
     
    function lookPicture(resourcesUrl,resourcesType) {
        if (resourcesUrl == "") {
            layer.msg("没有发现图片！");
            return;
        }
        var img = new Image();
        img.onload = function () {
            //避免图片还未加载完成无法获取到图片的大小。
            //避免图片太大，导致弹出展示超出了网页显示访问，所以图片大于浏览器时下窗口可视区域时，进行等比例缩小。
            var max_height = $(window).height() - 100;
            var max_width = $(window).width();

            //rate1，rate2，rate3 三个比例中取最小的。
            var rate1 = max_height / img.height;
            var rate2 = max_width / img.width;
            var rate3 = 1;
            var rate = Math.min(rate1, rate2, rate3);
            //等比例缩放
            var imgHeight = img.height * rate; //获取图片高度
            var imgWidth = img.width * rate; //获取图片宽度

            var imgHtml = "<img src='" + resourcesUrl + "' width='" + imgWidth + "px' height='" + imgHeight + "px'/>";
            //弹出层
           if (resourcesType ==1 ) {
               layer.open({
                   type:1,//可传入的值有：0（信息框，默认）1（页面层）2（iframe层）3（加载层）4（tips层）
                   shade: 0.6,
                   maxmin: true,
                   anim: 1,
                   title: '图片预览',
                   area: ['auto', 'auto'],
                   // skin: 'layui-layer-nobg', //没有背景色
                   shadeClose: true,
                   content: imgHtml
               });
           }
        }
        img.src = resourcesUrl;
    }
    $(function(){
        
		$("#case").upload(
			//该函数为点击放大镜的回调函数，如没有该函数，则不显示放大镜
			function(_this,data){
				console.log(data) 
				lookPicture(data,1)
			}
		);
    })
</script>
<script type="text/javascript">

    // 时间开始
function delimg(url){
     id = $("#id").val();
   
      $.post('<?php echo url("shujudel"); ?>',
     {id:id,url:url},
    function(data){
         $("#form_img").html('');
   
        var html="";
         $.each(data, function (key, value) {
                        
            html =  " <img src='"+value+"' style='width:150px;cursor:pointer;' title='点击图片删除' onclick=delimg('"+value+"')>"
                                        $("#form_img").append(html);
                                  });

    });
}
(function ($) {
    $.hunterTimePicker = function (box, options) {
        var dates = {
          hour: ['00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23'],
          minute: ['00', '05', '10', '15', '20', '25', '30', '35', '40', '45', '50', '55'],
        };

        var box = $(box);

        var template = $('<div class="Hunter-time-picker" id="Hunter_time_picker"><div class="Hunter-wrap"><ul class="Hunter-wrap" id="Hunter_time_wrap"></ul></div></div>');

        var time_wrap = $('#Hunter_time_wrap', template);

        $(document).click(function() {
            template.remove();
        });

        box.click(function(event){
            event.preventDefault();
            event.stopPropagation();
            $('.Hunter-time-picker').remove();
            var _this = $(this);
            var offset = _this.offset();
            var top = offset.top + _this.outerHeight() + 15;
            template.css({
                'left': offset.left,
                'top': top
            });
            buildTimePicker();
            $('body').append(template);

            $('.Hunter-time-picker').click(function(event){
                event.preventDefault();
                event.stopPropagation();
            });
        });

        function buildTimePicker(){
            buildHourTpl();
            hourEvent();
            minuteEvent();
            cleanBtnEvent();
        };

        function buildHourTpl(){
            var hour_html = '<p>小时</p>';
            for(var i = 0; i < dates.hour.length; i++){
                var temp = box.val().split(":")[0];
                if(dates.hour[i]==temp){
                    hour_html += '<li class="Hunter-hour active" data-hour="' + dates.hour[i] +'"><ul class="Hunter-minute-wrap"></ul><div class="Hunter-hour-name">' + dates.hour[i] + '</div></li>';
                }else{
                    hour_html += '<li class="Hunter-hour" data-hour="' + dates.hour[i] +'"><ul class="Hunter-minute-wrap"></ul><div class="Hunter-hour-name">' + dates.hour[i] + '</div></li>';
                }
            }

            hour_html += '<li class="Hunter-clean"><input type="button" class="Hunter-clean-btn" id="Hunter_clean_btn" value="清 空"></li>'
            
            time_wrap.html(hour_html);
        };

        function buildMinuteTpl(cur_time){
            var poi = cur_time.position();
            var minute_html = '<p>分钟</p>';
            var temp = box.val().split(":")[1];
            for(var j = 0; j < dates.minute.length;j++){
                if(dates.minute[j]==temp){
                    minute_html += '<li class="Hunter-minute active" data-minute="' + dates.minute[j] + '">' + dates.minute[j] + '</li>';
                }else{
                    minute_html += '<li class="Hunter-minute" data-minute="' + dates.minute[j] + '">' + dates.minute[j] + '</li>';
                }
            }
            cur_time.find('.Hunter-minute-wrap').html(minute_html).css('left', '-' + (poi.left - 37) + 'px').show();
        };

        function hourEvent(){
            time_wrap.on('click', '.Hunter-hour', function(event){
                event.preventDefault();
                event.stopPropagation();
                var _this = $(this);

                time_wrap.find('.Hunter-hour').removeClass('active');
                time_wrap.find('.Hunter-hour-name').removeClass('active');
                time_wrap.find('.Hunter-minute-wrap').hide().children().remove();

                _this.addClass('active');
                _this.find('.Hunter-hour').addClass('active');

                var hourValue = _this.data('hour');
                var temp = box.val().split(":");
                if(temp.length > 1){
                    box.val(hourValue+":"+temp[1]);
                }else{
                    box.val(hourValue+":00");
                }
                buildMinuteTpl(_this);
                
                if(options.callback) options.callback(box);

                return false;
            });
        };

        function minuteEvent(){
            time_wrap.on('click', '.Hunter-minute', function(event) {
                event.preventDefault();
                event.stopPropagation();
                var _this = $(this);

                var minuteValue = _this.data('minute');
                var temp = box.val().split(":")[0]+":"+minuteValue;
                box.val(temp);
                template.remove();

                if(options.callback) options.callback(box);

                return false;
            });
        };

        function cleanBtnEvent(){
            time_wrap.on('click', '#Hunter_clean_btn', function(event){
                event.preventDefault();
                event.stopPropagation();

                box.val('');
                template.remove();
                if(options.callback) options.callback(box);
                return false;
            });
        };
    };

    $.fn.extend({
        hunterTimePicker: function (options) {
            options = $.extend({}, options);
            this.each(function () {
                new $.hunterTimePicker(this, options);
            });
            return this;
        }
    });
})(jQuery);
$("#poi").click(function(){
     poi = $("input[name='poiadd']").val();
           
             $.post('<?php echo url("Userinfo/poihuoqu"); ?>',
                {poi:poi},
             function(data){   
                if(data.code==1){
                   $("input[name='poigz']").val(data.msg);
                    return false;
                }else{
                    //发布失败
                    layer.msg(data.msg,{icon:2,time:1500,shade: 0.1,});
                    return false;
                    }         
        
            });
})

$("#sucai1").change(function() {
    var sucai = $(this).val();
  
    if(sucai == 3) {
        $("#spku").modal('show');
    }
    if(sucai == 2) {
        $("#add").modal('show'); 
    }
})


$(".reset_user").click(function() {
    $(".checkbox-user").show()
    $(this).hide();
    
})


$("#add_btn").click(function() {
    
    var obj=document.getElementsByName('yun_yunid'); //选择所有name="'test'"的对象，返回数组 
    //取到对象数组后，我们来循环检测它是不是被选中 
    var str=''; 
    for(var i=0; i<obj.length; i++){ 
        if(obj[i].checked) {
          str+=obj[i].value+',';  
        } 
    } 
    console.log(str)
})

// 温馨提示
$(".btn-tishi").click(function(){
$("#zhic").css('display',"none");
$("#btn-tishi").modal('show');
})


//第三部 按钮

$("#zhida_san_bu_a").click(function(){
    $("#zhida_hunjian_a").css('display',"none");
    $("#zhida_san_hao").css('display',"block");
})
$("#zhida_san_bu_b").click(function(){
    $("#zhida_hunjian_a").css('display',"block");
    $("#zhida_san_hao").css('display',"none");
})

//时间选择
$("#beginTime").hunterTimePicker();
$("#endTime").hunterTimePicker();




//点击第二步 获取所有素材
$("#sucai").click(function(){
    id = $('input[name="id"]').val();
   
     $("#newli").html('');
   
        var html="";
    $.post('<?php echo url("shuju"); ?>',
     {id:id},
    function(data){
         $.each(data, function (key, value) {
                          //1 视频 2 图片
            if(value.type==1){
                    html = " <li>"
                        
                        +"<div class='neiro'>"
                        +"<video style='height: 300px;width: 100%;' controls=''>"
                        +"<source src='/uploads/images/"+value.url+"'>"
                        +"</video>" 
                        +"<div class='type'>"
                        +"<div class='typename'>"
                        +'视频' 
                        +"</div>"
                        +"</div>"
                        +"<div class='caozuo '>"
                        +"<div class='layui-unselect layui-form-checkbox' lay-skin='primary'>"
                                   
                        +"</div>"
                        +"<span onclick='deltss("+key+")'>"+'删除'+"</span>"
                        +"</div>"
                           
                        +"</div>"
                       
                        +"</li>"
                         $("#newli").append(html);
            }else{
                html = " <li class='lise'>" 
                    +" <div class='neiro'>"
                    +" <img src='/uploads/images/"+value.url+"'>"
                    +" <div class='type'>"
                    +" <div class='typename'>"
                    +"图片"
                    +"</div>"
                    +"</div>"
                    +"<div class='caozuo'>"
                    +"<div class='layui-unselect layui-form-checkbox' lay-skin='primary'>"
                    +"</div>"
                    +"<span onclick='deltss("+key+")'>"
                    +'删除'
                    +"</span>"
                    + "</div>"
                    +" </div>"
                    +" </div>"
                    +"</li>"   
                     $("#newli").append(html);
                }     
            
        });

    });
})
//触发第三部
$("#deb").click(function(){
//      id = '';
//      var chongfu =  $("input[name=chongfu]:checked").val();//是否重复
//     var sucai =  $("input[name=sucai]:checked").val();//视频地址 1本地视频 2混剪视频
//     var yunid =  $("#sucai_yunid").val();//云素材id
//      var	id =     $("#spkzu").val();//本地视频素材库
//     var pid = $('input[name="id"]').val();//当前任务id
//     if(sucai==1){
//         type =1;
        
//     }else if(sucai==2){
//         type =2;
//          var name_id=new Array(); 
//         yunid = '';
//         $('input[name="yun_yunid"]:checked').each(function(){          
//                 yunid += $(this).val()+',';   
               
//         });
//     }else{
//         type =3;
//          if(id==""){
//             return  layer.msg("请选择本地素材库",{icon:2,time:1500,shade: 0.1,}); 
//         }
//     }
//      if(yunid==""){
//         return  layer.msg("请选择混剪列队",{icon:2,time:1500,shade: 0.1,});
//     }
//     $.post('<?php echo url("su_xun"); ?>',
//      {pid:pid,yunid:yunid,type:type,sucai:sucai,chongfu:chongfu,id:id},
//         function(data){
//         if(data.code==1){
//             // 	$("#diyibu").css('display','none');
// 	           // $("#dierbu").css('display','none');
// 	           // $("#disanbu").css('display','block');
// 	           // $("#disibu").css('display',"none");
           
//         }else{
//              layer.msg(data.msg,{icon:2,time:1500,shade: 0.1,});
//         }
//   });
})

 $("#shangchuan").click(function(){
        $("#shangchuan").val('正在上传中....');
    })


function deltss(id){
   
  var  pid = $('input[name="id"]').val();
    $.post('<?php echo url("delshuju"); ?>',
     {pid:pid,id:id},
    function(data){
        if(data.code==1){
             layer.msg(data.msg,{icon:1,time:1500,shade: 0.1,});
             //location.reload();
             timer = setInterval(function(){
                 
                 document.getElementById('sucai').click();
                 clearInterval(timer)
             },1000)
             window.clearInterval(interval);
        }else{
             layer.msg(data.msg,{icon:2,time:1500,shade: 0.1,});
            
             setInterval(function(){
               clearInterval(timer)

             },1000)
            
        }
   });
}
//第三部保存
$("#san").click(function(){

//   var pid = $('input[name="id"]').val();//当前任务id
//     //判断 选择是按组还是选择账号发送 组option4 账号 option1
//   // document.getElementById('dsib').click();
//     inlineRadioOptions  =$("input[name=inlineRadioOptions]:checked").val();
   
//     if(inlineRadioOptions=="option1"){
//             var name_id=new Array(); 
//             id = '';
//             $('input[name="name_id"]:checked').each(function(){          
//                     id += $(this).val()+',';  
//             });
//             if(id ==''){
//               layer.msg('请选择账号',{icon:2,time:1500,shade: 0.1,}); return false; 
//             }
//             type =1;
//     }else{
//           id = $('#zu  option:selected').val();
//           type =2;
//     }
    
//     $.post('<?php echo url("xunbaocun"); ?>',
//         {pid:pid,user_id:id,type:type},
//             function(data){
//                 if(data.code==1){
//                         $("#diyibu").css('display','none');
//                         $("#dierbu").css('display','none');
//                         $("#disanbu").css('display','none');
//                         $("#disibu").css('display','block');
//                 }else{
//                      layer.msg(data.msg,{icon:2,time:1500,shade: 0.1,}); return false;
//                 }
//             })
    
  
})



function queren(t){
    $("#is_ks").val(0);
    var pid = $('input[name="id"]').val();//当前任务id
    
    types=1;
    suid = $("#spkzu").val();
    if(t == 2) {
        suid = '';
        $('input[name="yun_yunid"]:checked').each(function(){          
                suid += $(this).val()+',';   
               
        });
        types=2;
    }
    //获取选择账号
    inlineRadioOptions  =$("input[name=inlineRadioOptions]:checked").val(); //选择账号
    //分组选择
    id = $('#zu  option:selected').val();
    type =2;
    if(inlineRadioOptions=='option1'){
        //账号选择
        var name_id=new Array(); 
            id = '';
            $('input[name="name_id"]:checked').each(function(){          
                    id += $(this).val()+',';       
            });
            if(id ==''){
               layer.msg('请选择账号',{icon:2,time:1500,shade: 0.1,}); return false; 
            }
            type =1;
    }
    $.post('<?php echo url("xunbaocun"); ?>',{user_id:id,type:type},function(data){
        code = data;
        console.log(code)
        $.post('<?php echo url("bdscxz"); ?>',{id:suid,type:types,pid:pid},function(data){
            $("input[name='video']").val(data.video);
            $("#wenzi").html('您选择的来源是：<b>'+data.name+'，包括'+data.video+'个视频，'+data.msg+'个图片</b>');
            console.log(code +'======'+ data.msg)
            if(data.msg==0 && code >= 1){
                //$("#is_ks").val(1);
                //$("#xuan").css('display','block');
            }else{
                //$("#xuan").css('display','none');
            }
            
        })
    })
    

}





//第四步
function tijiaofabu(){
    var video = $('input[name="video"]').val();//获取视频数量
    if(video==''){
       layer.msg('请选择视频',{icon:2,time:1500,shade: 0.1,}); return false; 
    }
    if(video <0){
        layer.msg('请选择视频',{icon:2,time:1500,shade: 0.1,}); return false; 
    }
    
  
    var pid = $('input[name="id"]').val();//当前任务id
    var rwname = $('input[name="rwname"]').val();//任务名称
    
    if(rwname == ''){
      layer.msg('请输入任务名称',{icon:2,time:1500,shade: 0.1,}); return false; 
    }
    var  biaotid = $('#biaotid  option:selected').val();//获取标题id
    // fz_id ='';
    // $("input[name='fenzu_id']:checked").each(function(){
    //   fz_id += $(this).val()+',';  
    // })
    // if(fz_id ==''){
    //     layer.msg('请选择账号分组',{icon:2,time:1500,shade: 0.1,}); return false;
    // }
           inlineRadioOptions  =$("input[name=inlineRadioOptions]:checked").val(); //选择账号
   
    if(inlineRadioOptions == "option1"){
           var name_id=new Array(); 
             user_id = '';
            
            $('input[name="name_id"]:checked').each(function(){          
                    user_id += $(this).val()+',';       
            });
            
            if(user_id ==''){
              layer.msg('请选择账号',{icon:2,time:1500,shade: 0.1,}); return false; 
            }
           zu =1;
        }else{
              user_id = $('#zu  option:selected').val();
            zu =2;
        }
       
    var chongfu         =       $("input[name=chongfu]:checked").val();//是否重复
    var sucai           =       $("#sucai1").val();
    var number          =       $('input[name="number"]').val();//发布数量
    var jieshutime      =       $("input[name=jieshutime]").val();//结束时间
    var kaishitime      =       $("input[name=kaishitime]").val();//开始时间D
    var zhidingtime     =       $("input[name=zhidingtime]").val();//开始时间D
    var jiange          =       $("input[name=jiange]").val();//间隔时间
    var poiadd          =       $("input[name=poiadd]").val();//抖音poi地址
    var poigz           =       $("input[name=poigz]").val();//挂载poi
    var upload_files    =       $("input[name=upload]").val();//封面图
    if(biaotid==undefined || biaotid ==''){
         layer.msg('请选择优化标题',{icon:2,time:1500,shade: 0.1,});
                         return false;
    }
  if(zhidingtime !=''){
      if(kaishitime =='' && jieshutime ==''){
          layer.msg('请填写开始和结束时间',{icon:2,time:1500,shade: 0.1,});
                         return false;
      }
  }
    if(jieshutime !=="" && kaishitime==''){
        layer.msg('请填写开始时间',{icon:2,time:1500,shade: 0.1,});
         return false;
    }
    if(kaishitime !=="" && jieshutime==''){
        layer.msg('请填写结束时间',{icon:2,time:1500,shade: 0.1,});
         return false;
    }
    if(jiange ==''){
         layer.msg('请填填写间隔时间',{icon:2,time:1500,shade: 0.1,});
         return false;
    }
    if(number==''){
         layer.msg('请填写发布视频数量',{icon:2,time:1500,shade: 0.1,});
         return false;
    }
        if(sucai ==3){
            suid =     $("#spkzu").val();
        }else{
             suid = '';
            $('input[name="yun_yunid"]:checked').each(function(){          
                    suid += $(this).val()+',';   
                   
            });
        }
         var typ         =       $("input[name=typ]:checked").val();//任务类型
        if(typ==2){
            url = '<?php echo url("Videolist/add_rw"); ?>';
        }else{
            url = '<?php echo url("faburenwuqunfa"); ?>';
        }
     $.post(url,
{pid:pid,number:number,jieshutime:jieshutime,kaishitime:kaishitime,jiange:jiange,poigz:poigz,biaotid:biaotid,zhidingtime:zhidingtime,rwname:rwname,zu:zu,chongfu:chongfu,sucai:sucai,suid:suid,upload_files:upload_files,user_id:user_id},
                function(data){
        if(data.code==1){

            layer.msg(data.msg,{icon:1,time:1500,shade: 0.1,});
            setInterval(function(){
            window.location.href="<?php echo url('admin/video/renwu'); ?>";
                            },1500);
        }else{
            layer.msg(data.msg,{icon:2,time:1500,shade: 0.1,});
        }
        
    })
        
} 
//获取select 选中的值
$(document).ready(function(){
   
	$('#spkzu').mouseout(function(){
		id =     $("#spkzu").val();
		
	    $("#spku-yulan").html('');
		 var html="";
    	    $.post('<?php echo url("xun_bdsp"); ?>',
         {id:id},
        function(data){
            if(data.code==1){
              
                $.each(data.msg, function (key, value) {
                          //1 视频 2 图片
            if(value.data== "视频"){
                    html = " <li style=' list-style: none;' class='lise'>"
                        
                        +" <div class='neiro' >"
                        +"<video controls=''>"
                        +" <source src='"+value.mediaIds+"' type='video/mp4'>"
                        +" </video>"
                        +"<div class='type'>"
                        +"<div class='typename'>"
                        value.data                                 
                        +"</div>"
                        +"</div>"
                        +"<div class='caozuo '>"
                        +"<input lay-skin='primary' type='checkbox' checked='checked' name='1sucai' value='' >"
                                    
                        +"</div>"
                        +"</div>"
                      
                        +"</li>"
                         $("#spku-yulan").append(html);
            }else{
                 html = " <li style=' list-style: none;' class='lise'>"
                        
                        +" <div class='neiro' >"
                       
                        +"  <img src='"+value.mediaIds+"'>"
                        
                        +"<div class='type'>"
                        +"<div class='typename'>"
                        value.data                                 
                        +"</div>"
                        +"</div>"
                        +"<div class='caozuo '>"
                        +"<input lay-skin='primary' type='checkbox' checked='checked' name='1sucai' value='' >"
                                    
                        +"</div>"
                        +"</div>"
                      
                        +"</li>"
                         $("#spku-yulan").append(html);
                
               
                }     
           
        });
                        
            }
            // else{
            //     layer.msg(data.msg,{icon:2,time:1500,shade: 0.1,});
            // }
            
        })
	})
});


//发布类型判断
$("#immediately").click(function() {
    $(".ds_div").hide();
})
$("#timing").click(function() {
    $(".ds_div").show();
})

</script>
</body>
</html>
