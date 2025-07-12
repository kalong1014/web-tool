<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:95:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/userinfo/user_list_f.html";i:1667376104;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/header.html";i:1660125746;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/footer.html";i:1660125746;}*/ ?>
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
<style type="text/css">
      .div {
    width:98%;
    height:500px;
    margin:-150px auto;
   /* background:#ccc;*/
    position: fixed;
    /*position: inherit;*/
    display: none;

    }
    #animation {
    -webkit-animation:fadeInRight 2s .2s ease both;
    -moz-animation:fadeInRight 2s .2s ease both;
    }
      @-webkit-keyframes fadeInRight {
      0% {
      opacity:0;
      -webkit-transform:translateX(20px)
      }
      100% {
      opacity:1;
      -webkit-transform:translateX(0)
      }
      }
      @-moz-keyframes fadeInRight {
      0% {
      opacity:0;
      -moz-transform:translateX(20px)
      }
      100% {
      opacity:1;
      -moz-transform:translateX(0)
      }
  }

    </style>

<body class="gray-bg">

<div class="wrapper wrapper-content animated fadeInRight">

	  <div class="row zhangh" style="margin-top:20px">
        
       
       
      
               
    </div> 
    <div class="ibox float-e-margins">
       
        <div style="width:100%;margin-top:20px;">
        	
       	 
       	 <!-- 列表 -->
<div class="liebiao">
    <div  class="neirong">
        <div class="neironghead">
            <div class="neirong1">
       	 		        <div class="img_data">
       	 		            平台
       	 		        </div>
       	 		        <div class="img_data">
       	 		            头像
       	 		        </div>
       	 		        <div class="peo_data">
       	 		            达人昵称
       	 		        </div>
       	 		        <div class="neirong2">
       	 		            <div class="neirong3">
       	 		                视频(总/私)
       	 		            </div>
       	 		            <div class="neirong3">
       	 		                播放
       	 		            </div>
       	 		            <div class="neirong3">
       	 		                点赞
       	 		            </div>
       	 		            <div class="neirong3">
       	 		                评论
       	 		            </div>
       	 		            <div class="neirong3">
       	 		                分享
       	 		            </div>
       	 		            <!--<div class="neirong3">-->
       	 		            <!--    粉丝-->
       	 		            <!--</div>-->
       	 		             <div class="neirong3">
       	 		                绑定时间
       	 		            </div>
       	 		        </div>
       	 		        <div class="neirongdi" style="padding:0">
       	 		            操作
       	 		        </div>
       	 		    </div>
       	    </div>
    </div>
       	 		    
    <?php if(is_array($list) || $list instanceof \think\Collection): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$vo): ?>
       	 	<div  class="neirong">
       	 	
       	 		<div class="neirong1">
       	 		    
       	 			<div class="img_data">
                        <div class="topp">
                          <?php if($vo['type']=='1'): ?>
                        
                          <img class="type" src="__IMG__/dou.jpg">
                          <?php elseif($vo['type']=='2'): ?>
                         
                          <img class="type" src="__IMG__/xig.png">
                          <?php elseif($vo['type']=='3'): ?>
                         
                          <img class="type" src="__IMG__/tout.png">
                          <?php else: ?>

                          <img class="type" src="__IMG__/kuais.png">
                          <?php endif; ?>
                   	 	</div>
       	 			</div>
       	 			<div class="img_data">
       	 			    <img src="<?php echo $vo['avatar']; ?>">
       	 			</div>
       	 			<div class="peo_data">
                   	 	  <div class="name"><?php echo $vo['nickname']; ?></div>
       	 			</div>
       	 			<div class="neirong2">
       	 				<div class="neirong3">
                          <?php if($vo['all_count'] =='' && $vo['private_count'] == ''): ?>
                            <p class="p1">0/0</p>
                          <?php else: ?>
                            <p class="p1"><?php echo $vo['all_count']; ?>/<?php echo $vo['private_count']; ?></p>
                          <?php endif; ?>
       	 				
       	 				
       	 				</div>
       	 				<div class="neirong3">
                           <?php if($vo['view_count'] ==''): ?>
               	 					<p class="p1">0</p>
                           <?php else: ?>
                           <p class="p1"><?php echo $vo['view_count']; ?></p>
                           <?php endif; ?>
       	 					<!--<p>播放</p>-->
       	 				</div>
       	 				<div class="neirong3">
                          <?php if($vo['like_count'] ==''): ?>
                          <p class="p1">0</p>
                           <?php else: ?>
                           <p class="p1"><?php echo $vo['like_count']; ?></p>
                           <?php endif; ?>
       	 				</div>
       	 				<div class="neirong3">
                          <?php if($vo['comment_count'] ==''): ?>
                          <p class="p1">0</p>
                           <?php else: ?>
                           <p class="p1"><?php echo $vo['comment_count']; ?></p>
                           <?php endif; ?>
       	 				</div>
       	 				<div class="neirong3">
                  
       	 				 <?php if($vo['new_share'] ==''): ?>
                          <p class="p1">0</p>
                          <?php else: ?>
                          <p class="p1"><?php echo $vo['new_share']; ?></p>
                          <?php endif; ?>
       	 				
       	 				</div>
                        <div class="neirong3">
                          <p class="p1"><?php echo $vo['addtime']; ?></p>
                        </div>
       	 				
       	 			</div>
       	 			<div class="neirongdi">
       	 					<a class="" href="<?php echo url('video/single'); ?>" title="发布视频">
                                <span class="label label-primary" style="font-size:15px">发布视频</span>
                            </a>
                            <a class="" href="<?php echo url('splb'); ?>?id=<?php echo $vo['id']; ?>" title="我的作品">
                                <span class="label label-primary" style="font-size:15px;background:#b572c1">作品</span>
                            </a>
                            <a class="" href="javascript:jilu(<?php echo $vo['id']; ?>)" title="任务日志">
                                <span class="label label-warning" style="font-size:15px">任务日志</span>
                            </a>
                            <a class="" href="javascript:del_del(<?php echo $vo['id']; ?>)" title="解绑">
                                <span class="label label-danger" style="font-size:15px">解绑</span>
                            </a>
                            <a class="" href="javascript:fz_gh(<?php echo $vo['id']; ?>)" title="移组">
                                <span class="label label-info" style="font-size:15px">移组</span>
                            </a>
       	 			</div>
       	 		</div>

       	 	</div>
       	 	
    <?php endforeach; endif; else: echo "" ;endif; ?>
   
    <?php echo $page; ?>
 
    <script type="text/javascript">
        function fabu(id){
         // document.getElementById('chuangkou').click();
        }
    </script>
       	 	
       	 


       	 </div>
       	 <!-- 结束 -->
       
        </div>
        <!-- 模态框开始 -->
         <div class="modal  fade" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true" style="margin-top:160px">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <a  href="<?php echo url('shouquan'); ?>?id=1" target="view_window" class="btn btn-primary" style="margin-left: 2px;width: 24%;float: left;" id="dou1yin"> 抖音</a>  
  <a href="<?php echo url('shouquan'); ?>?id=2" target="view_window" class="btn btn-primary" style="margin-left: 2px;width: 24%;float: left;" id="xigua"> 西瓜</a>  
  <a href="<?php echo url('shouquan'); ?>?id=3" target="view_window" class="btn btn-primary" style="margin-left: 2px;width: 24%;float: left;" id="toutiao"> 头条</a>  
  <a href="<?php echo url('shouquan'); ?>?id=4" target="view_window" class="btn btn-primary" style="margin-left: 2px;width: 24%;float: left;" id="kuaishou"> 快手</a>      
                </div>
                
            </div>
        </div>
    </div>
        <!-- 模态框结束 -->

    </div>
</div>
<div class="modal  fade" id="ydfz" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" style="width:50%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title">请选择分组</h3>                  
                </div>
                    <div class="ibox-content m-t-md">
                        <div class="form-group">
                            <label class="col-sm-3 control-label text-r" style="line-height:35px;">选择分组&nbsp;&nbsp;</label>
                            <div class="col-sm-8">                                                      
                                <select name="fenzu" id="select2" class="form-control m-b">
                                    <?php if(is_array($fenzu) || $fenzu instanceof \think\Collection): if( count($fenzu)==0 ) : echo "" ;else: foreach($fenzu as $key=>$v): ?>
                                  <option value="<?php echo $v['id']; ?>"><?php echo $v['fzname']; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>                                    
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!--data-dismiss="modal" data-toggle="modal" data-target="#myModal" -->
                <button type="button" class="btn btn-primary" onclick="yd_date()" >确认选择</button> 
                    </div>
            </div>
        </div>
    </div>
 <div class="modal  fade" id="jilu" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" style="width:50%">
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
                                <th>状态</th>
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
        <!-- 选择分组模态框结束 -->
<!--移动账号分组开始-->

<!--移动账号分组结束-->
 
<!-- 记录模态框结束 -->

<input type="hidden" name="ydfzid" id="" value="" />
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
  //任务日志 //data-toggle="modal" data-target="#jilu"

/**
 * 判断是从哪里过来的链接
*/
$(function(){
  jiedian =  $("input[name='jiedian']").val();
  if(jiedian==2){
      document.getElementById('jiediantianjia').click();
  }
})
  function jilu(id){
    
    $("#jilu").modal('show');
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
                            +"<td>"+'发布失败'+"</td>"
                        +"</tr>" ;
                        $(".jilu").append(html);
                    }else{
                        html ="<tr  style='text-align: center;'>"
                            +"<td>"+value.id+"</td>"
                            +"<td>"+value.username+"</td>"
                            +"<td>"+value.count+"</td>"
                            +"<td>"+value.addtime+"</td>"
                            +"<td>"+'发布成功'+"</td>"
                            +"</tr>";
                        $(".jilu").append(html);
                    }  
                 }); 
    });
}

//抖音
function browse()
{
 
  fenzu = $("#select1  option:selected").val();
  if(fenzu ==null || fenzu=='' || fenzu== 'nudefinde'){
     layer.msg('请先添加账号分组',{icon:2,time:1500,shade: 0.1,});
  }else{

    $('#douyinzi').attr("href","<?php echo url('shouquan'); ?>?id=1&fenzu="+fenzu);
    document.getElementById('douyinzi').click();
  }
 
}
//西瓜
function browse1()
{ fenzu = $("#select1  option:selected").val();
  if(fenzu ==null || fenzu=='' || fenzu== 'nudefinde'){
       layer.msg('请先添加账号分组',{icon:2,time:1500,shade: 0.1,});
    }else{
      
     $('#xiguaa').attr("href","<?php echo url('shouquan'); ?>?id=2&fenzu="+fenzu);
    document.getElementById('xiguaa').click();
    }
 
}
//头条
function browse2()
{ fenzu = $("#select1  option:selected").val();
  if(fenzu ==null || fenzu=='' || fenzu== 'nudefinde'){
       layer.msg('请先添加账号分组',{icon:2,time:1500,shade: 0.1,});
    }else{
     $('#toutiaoa').attr("href","<?php echo url('shouquan'); ?>?id=3&fenzu="+fenzu);
      document.getElementById('toutiaoa').click();
    }
  
}
//快手
function browse3()
{ fenzu = $("#select1  option:selected").val();
 if(fenzu ==null || fenzu=='' || fenzu== 'nudefinde'){
       layer.msg('请先添加账号分组',{icon:2,time:1500,shade: 0.1,});
    }else{
      $('#kuaishoua').attr("href","<?php echo url('shouquan'); ?>?id=4&fenzu="+fenzu);
  document.getElementById('kuaishoua').click();
    }
 
}
function tianjia(){
   $.post('<?php echo url("quanxian"); ?>',
       {},
      function(data){
          if(data.code==1){

              fenzu = $("#select1  option:selected").val();
              if(fenzu ==null || fenzu=='' || fenzu == 'nudefinde'){
                layer.msg('请先添加账号分组',{icon:2,time:1500,shade: 0.1,});
                 timer = setInterval(function(){
                 
                  window.location.href="<?php echo url('fenzu'); ?>";
                   clearInterval(timer)
                },1000)
              }else{
                 $('#fenzu_xuan').modal('show');
              }
          }else{
               layer.msg(data.msg,{icon:2,time:1500,shade: 0.1,});
          }
     });
}

function fz_gh(id){
   
    $('#ydfz').modal('show');
    $("input[name='ydfzid']").val(id);
}

function yd_date(){
    fenzu = $("#select2  option:selected").val();
    user_id = $("input[name='ydfzid']").val();
    $.post('<?php echo url("yd_date"); ?>',{fenzu:fenzu,user_id:user_id},function(data){
       if(data.code==1){
          layer.msg(data.msg,{icon:1,time:1500,shade: 0.1,});
            setInterval(function(){
              location.reload();
            },1000)
       }else{
        layer.msg(data.msg,{icon:2,time:1500,shade: 0.1,});
         
       }
    })
}

function del_del(id){
  $.post('<?php echo url("quanxian_del"); ?>',
       {id:id},
      function(data){
          if(data.code==1){
           layer.confirm('您确定要删除此账号吗？，删除账号可能会导致任务发送失败', {icon: 3, title:'提示'}, function(index){
                $.post('<?php echo url("del_user"); ?>',{id:id},function(data){
                   if(data.code==1){
                      layer.msg(data.msg,{icon:1,time:1500,shade: 0.1,});
                        setInterval(function(){
                          location.reload();
                        },1000)
                   }else{
                    layer.msg(data.msg,{icon:2,time:1500,shade: 0.1,});
                     
                   }
                })
            })
          }else{
               layer.msg(data.msg,{icon:2,time:1500,shade: 0.1,});
                      setInterval(function(){
                          location.reload();
                        },1000)
          }
     });
}



</script>
</body>
</html>