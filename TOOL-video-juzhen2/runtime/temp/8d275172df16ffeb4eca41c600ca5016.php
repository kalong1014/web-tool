<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:86:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/video/renwu.html";i:1667457815;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/header.html";i:1660125746;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/footer.html";i:1660125746;}*/ ?>
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
                <a href="javascript:tianjia();" class="btn btn-outline btn-primary">添加群发任务</a>
                <button type="button" class="btn btn-primary btn-outline" onclick="code_url()" >D音H5分享入口</button>
            </div>
                                                  
            <div class="col-12">
                <div class="block">
                    <form name="admin_list_sea" class="form-search" method="get" action="<?php echo url('renwu'); ?>">

                        <div class="col-sm-12 m-b-md" style="padding:0;text-align:center;">
                          <div style="display:inline-flex">
                            <select name="status" id="" class="form-control" style="width:100%;">
                                <option value="">任务状态</option>
                                <option value="1">发布中</option>
                                <option value="2">发布完成</option>
                                <option value="3">发布失败</option>
                               
                            </select>
                           
                            <button type="submit" class="btn btn-primary" style="border-top-left-radius:0;border-bottom-left-radius:0;height:35px"><i class="fa fa-search"></i> 搜索</button> 
                            
                          </div>

                        </div>
                    </form> 
                    
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="long-tr">
                                <th>类型</th>
                               
                                <th>任务名称</th>
                                <th>状态</th>
                                <th>视频源</th>
                                <th>是否重复</th>
                                <th>间隔<br>时间</th>
                                <th>发布<br>总数量</th>
                                <th>单个<br>数量</th>
                                <th>成功<br>数量</th>
                                <th>开始<br>时间</th>
                                <th>结束<br>时间</th>
                                <th>指定<br>日期</th>
                                <th>添加<br>时间</th>
                                <th>任务进度<br>(总发/已发)</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                       	
                        <tbody id="article_list">
                        	   <?php if(is_array($list) || $list instanceof \think\Collection): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$vo): ?>
                        	 <tr  style="text-align: center;">
                        	 	<td>
                               <?php if($vo['types']==1): ?>
                                单发任务
                                <?php elseif($vo['types']==2): ?>
                                群发任务
                                <?php elseif($vo['types']==3): ?>
                                循环任务
                               
                                <?php else: ?>
                                未知
                                <?php endif; ?>
                            </td>
                        	 
                        	 	<td style="width: 14%;"><?php echo $vo['rwname']; ?></td>
                        	 	<td><?php if($vo['status']==1): ?>发布中  <?php elseif($vo['status']==3): ?>需完善<?php elseif($vo['status']==4): ?>发布失败<?php else: ?>发布完成<?php endif; ?></td>
                        	 <td><?php if($vo['sucai']==1): ?>本地上传<?php elseif($vo['sucai']==3): ?>本地素材库<?php else: ?>混剪库<?php endif; ?></td>
                        	 	<td><?php if($vo['chongfu']==1): ?>禁止<?php else: ?>允许<?php endif; ?></td>
                        	 		<td><?php echo $vo['jiange']; ?></td>
                        	 	<td><?php echo $vo['number']; ?></td>
                        	 	<td><?php echo $vo['daycount']; ?></td>
                        	 		<td><?php echo $vo['count']; ?></td>
                        	 	<td><?php echo !empty($vo['kaishitime'])?$vo['kaishitime']:'无'; ?></td>
                        	 	<td><?php echo !empty($vo['jieshutime'])?$vo['jieshutime']:'无'; ?></td>
                        	 	<td><?php echo !empty($vo['zhidingtime'])?$vo['zhidingtime']:'无'; ?></td>
                        	 
                        	 	<td><?php echo date('Y-m-d H:i:s',$vo['addtime']); ?></td>
                        	 	<td style="width:7%"><?php echo $vo['jindu']; ?></td>
                        	 	<td style="width: 15%">
                        	 		<?php if($vo['status']==1): ?>
                        	 		 <a href="<?php echo url('admin/video/rw_user'); ?>?rid=<?php echo $vo['id']; ?>" class="btn btn-primary btn-xs" >
                                           查看数据</a>&nbsp;&nbsp;
                                    <a href="javascript:;" data-toggle="modal" data-target="#jilu"  class="btn btn-primary btn-xs" onclick="jilu(<?php echo $vo['id']; ?>)">
                                           记录</a>&nbsp;&nbsp;<br><br>
                                    <a href="javascript:;"   class="btn btn-primary btn-xs" onclick="stop(<?php echo $vo['id']; ?>)">
                                           <?php if($vo['stop']==1): ?>
                                            开启任务
                                            <?php else: ?>
                                             停止任务
                                            <?php endif; ?></a>&nbsp;&nbsp;
                                            <a href="javascript:del(<?php echo $vo['id']; ?>)"  class="btn btn-danger btn-xs">
                                            删除</a>

                                    <?php elseif($vo['status']==2): ?>
                                     <a href="<?php echo url('admin/video/rw_user'); ?>?rid=<?php echo $vo['id']; ?>" class="btn btn-primary btn-xs" >
                                           查看数据</a>&nbsp;&nbsp;
                                         <a href="javascript:;" data-toggle="modal" data-target="#jilu"  class="btn btn-primary btn-xs" onclick="jilu(<?php echo $vo['id']; ?>)">
                                           记录</a>&nbsp;&nbsp;<br><br>
                                        <a href="javascript:;"  class="btn btn-primary btn-xs" onclick="stop(<?php echo $vo['id']; ?>)">
                                            <?php if($vo['stop']==1): ?>
                                            开启任务
                                            <?php else: ?>
                                             停止任务
                                            <?php endif; ?>
                                          
                                           
                                           </a>&nbsp;&nbsp;
                                            <a href="javascript:del(<?php echo $vo['id']; ?>)"  class="btn btn-danger btn-xs">
                                            删除</a>
                                            
                                        <?php else: ?>
                                      <a href="<?php echo url('admin/video/rw_user'); ?>?rid=<?php echo $vo['id']; ?>" class="btn btn-primary btn-xs" >
                                           查看数据</a>&nbsp;&nbsp;
                                           <a href="javascript:;" data-toggle="modal" data-target="#jilu"  class="btn btn-primary btn-xs" onclick="jilu(<?php echo $vo['id']; ?>)">
                                           记录</a>&nbsp;&nbsp;<br><br>
                                            <a href="javascript:;"  class="btn btn-primary btn-xs" onclick="stop(<?php echo $vo['id']; ?>)">
                                           <?php if($vo['stop']==1): ?>
                                            开启任务
                                            <?php else: ?>
                                             停止任务
                                            <?php endif; ?></a>&nbsp;&nbsp;
                                            <a href="javascript:del(<?php echo $vo['id']; ?>)"  class="btn btn-danger btn-xs">
                                            删除</a>
                                    <?php endif; ?>

                        	 	</td>
                        	 </tr>
                             <?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                    <div id="AjaxPage" style=" text-align: right;"></div>
                    <div id="allpage" style=" text-align: right;"></div>
                </div>
            </div>
          
        </div>
    </div>
</div>

</div>
<div class="modal  fade" id="codefenzu_url2" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" style="width:50%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title" style="text-align:center">D音H5分享链接/扫码入口</h3>
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

function tianjia(){
   // $("#add").modal('show');
     window.location.href="/admin/video/wanshan/"
}
    function del(id){
    $.post('<?php echo url("delete_renwu"); ?>',
     {id:id},
    function(data){
        
        if(data.code==1){
           
            layer.msg(data.msg,{icon:1,time:1500,shade: 0.1,});
             //location.reload();
             setInterval(function(){
                location.reload();
             },1000)
            return false;
        }else{
           
            layer.msg(data.msg,{icon:2,time:1500,shade: 0.1,});
            setInterval(function(){
                location.reload();
             },1000)
             //location.reload();
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

function stop(id){
       $.post('<?php echo url("stop"); ?>',
            {id:id},
    function(data){
        console.log(data)
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

  function code_url(){
      id = '';
    layer.load(1)
    $.get('<?php echo url("admin/userinfo/fenzu_h5_code_url"); ?>',{id:id},function(data){
        $("#qrcode_h5_url2").html(data.url);
        $(".qrcode_h5_qrcode").attr('src',data.qrcode)
        $("#codefenzu_url2").modal('show');
        layer.closeAll('loading');
        console.log(data)
    });
    
   
 }
</script>
</body>
</html>