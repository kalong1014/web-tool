<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:91:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/member/vip_daili.html";i:1665556317;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/header.html";i:1660125746;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/footer.html";i:1660125746;}*/ ?>
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
            <h3 class="fs22 font-weight-500 c333">代理列表</h3>
            <p class="fs14 c666">1、展示系统内所有代理</p>
             <p class="fs14 c666">2、添加完代理请手动充值发布视频数量和账号数量</p>
        </div>
    </div>
    
<div class="wrapper wrapper-content animated fadeInRight">
    <!-- jieshu -->
    <div class="ibox float-e-margins">
        <!--<div class="ibox-title">-->
        <!--    <h5>代理列表</h5>-->
        <!--</div>-->
        <div class="ibox-content">
            <!--搜索框开始-->           
            <div class="row" style="margin:20px 0">
                <div class="col-sm-12">   
                <div  class="col-sm-2" style="width: 100px">
                    <div class="input-group" >  
                        <a href="<?php echo url('add_vipdali'); ?>"><button class="btn btn-outline btn-primary" type="button">添加代理</button></a> 
                    </div>
                </div>                                            
                    <form name="admin_list_sea" class="form-search" method="post" action="<?php echo url(''); ?>">
                        <div class="col-sm-3">
                            <div class="input-group">

                                <!-- <span class="input-group-btn"> 
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> 导出</button> 
                                </span> -->
                            </div>
                        </div>
                    </form>                         
                </div>
            </div>
            <!--搜索框结束-->
            <!--<div class="hr-line-dashed"></div>-->

            <div class="example-wrap">
                <div class="example">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="long-tr">
                                <th>账号</th>
                                <th>姓名</th>
                                <th>上级</th>
                                <th>贴牌<br>名称</th>
                                <th>当前<br>级别</th>
                                <th>代理<br>数量</th>
                                <th>剩余<br>积分</th>
                                <th>会员<br>数量</th>
                                <th>发布<br>视频数</th>
                                <th>剩余绑定<br>账号数</th>
                                <th>发布视频<br>计费</th>
                                <th>排名<br>计费</th>
                                <th>混剪<br>计费</th>
                                <th>运维<br>计费</th>


                                <th style="width:7%">添加<br>时间</th>
                                <th style="width:5%">到期<br>时间</th>
                                <th>是否<br>开启API</th>
                                <th>是否<br>登录</th>
                                <th>操作</th>
                            </tr>
                        </thead>

                       <?php if(is_array($list) || $list instanceof \think\Collection): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$vo): ?>
                         <tr class="long-tr" style="text-align:center">
                             <td style="width:5%"><?php echo $vo['username']; ?></td>
                              <td><?php echo !empty($vo['real_name'])?$vo['real_name']:'未填写'; ?></td>
                             <td><?php echo !empty($vo['susername'])?$vo['susername']:'无'; ?></td>
                             <td><?php echo !empty($vo['painame'])?$vo['painame']:'无'; ?></td>
                             <?php if($vo['jibie']==1): ?>
                             <td>贴牌<br>代理</td>
                             <?php else: ?>
                            <td>普通<br>代理</td>
                             <?php endif; ?>
                             <td><?php echo !empty($vo['dai'])?$vo['dai']:'0'; ?></td>
                             <td><?php echo !empty($vo['jifen'])?$vo['jifen']:'0'; ?></td>
                               <td><?php echo !empty($vo['shang'])?$vo['shang']:'0'; ?></td>
                             <td><?php echo !empty($vo['spnumber'])?$vo['spnumber']:'0'; ?></td>
                             <td><?php echo !empty($vo['zhnumber'])?$vo['zhnumber']:'0'; ?></td>
                             <td><?php echo !empty($vo['fpspkc'])?$vo['fpspkc']:'0'; ?></td>
                             <td><?php echo !empty($vo['paiming'])?$vo['paiming']:'0'; ?></td>
                             <td><?php echo !empty($vo['hunjian'])?$vo['hunjian']:'0'; ?></td>
                             <td><?php echo !empty($vo['yunwei'])?$vo['yunwei']:'0'; ?></td>
                             <td><?php echo date('Y-m-d H:i:s',$vo['addtime']); ?></td>
                             <td><?php echo $vo['user_time']; ?></td>
                            <?php if($vo['jibie']==1): if($vo['apistatus']==0): ?>
                                      <td> <a class="red" href="javascript:;" onclick="kaiqi(<?php echo $vo['id']; ?>,1);">
                                        <div id="jin"><span class="label label-danger">未开启</span></div>
                                        </a></td>
                                    <?php else: ?>
                                       <td>  <a class="red" href="javascript:;" onclick="kaiqi(<?php echo $vo['id']; ?>,0);">
                                                <div id="kaiqi"><span class="label label-info">已开启</span></div>
                                            </a>
                                            </td>
                                    <?php endif; else: ?>
                            <td> 无</td>
                            <?php endif; ?>
                             <td>
                                <?php if($vo['status'] ==1): ?>
                                    <a class="red" href="javascript:;" onclick="user_staus(<?php echo $vo['id']; ?>,0);">
                                        <div id="kaiqi"><span class="label label-info">开启</span></div>
                                    </a>
                                <?php else: ?>
                                 <a class="red" href="javascript:;" onclick="user_staus(<?php echo $vo['id']; ?>,1);">
                                <div id="jin"><span class="label label-danger">禁用</span></div>
                                </a>
                                <?php endif; ?>
                             </td>                                    
                             <td>  
                              <a href="javascript:spfabu(<?php echo $vo['id']; ?>)" class="btn btn-primary btn-xs">
                                            
                                            发布</a>&nbsp;&nbsp;
                                  <a href="javascript:zhanghao(<?php echo $vo['id']; ?>)" class="btn btn-primary btn-xs">
                                            
                                            账号</a>&nbsp;&nbsp;
                              <a href="javascript:jfchongzhi(<?php echo $vo['id']; ?>)" class="btn btn-primary btn-xs">
                                            
                                            积分充值</a>&nbsp;&nbsp;
                                 <!--<a href="javascript:chongzhi(<?php echo $vo['id']; ?>)" class="btn btn-primary btn-xs">-->
                                 <!--           金币充值</a>&nbsp;&nbsp;-->
                                <a href="<?php echo url('edit_vipdali'); ?>?id=<?php echo $vo['id']; ?>" class="btn btn-primary btn-xs">
                                            编辑</a>&nbsp;&nbsp;
                                             
                                <!-- <a href="<?php echo url('edit_vipdali'); ?>?id="  class="btn btn-danger btn-xs">
                                            删除</a> -->
                            </td>
                            </tr>
                           <?php endforeach; endif; else: echo "" ;endif; ?>
                          
                        <script id="arlist" type="text/html">
                            
                        </script>
                        <tbody id="article_list"></tbody>
                    </table>
                    <div id="AjaxPage" style=" text-align: center;"><?php echo $page; ?></div>
                    <div id="allpage" style=" text-align: right;"></div>
                </div>
            </div>
           <!-- kaishi -->
        </div>
    </div>
</div>
<!-- kaishi -->
</div>
<!-- 充值开始 -->
 <div class="modal  fade" id="fenzu_xuan" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" style="width:50%;">
            <div class="modal-content" style="width:100%;padding-bottom:20px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">用户金币充值</h4>                  
                </div>
               <form class="form-horizontal" name="userAdd"  method="post" action=""  method="post">

                <div class="form-group" style="margin-top: 20px;">
                            <label class="col-sm-3 control-label">金币：</label>
                            <div class="input-group col-sm-4">
                                <input id="money" type="number" class="form-control" name="money" >
                                    <span style="margin-top:20px;width:100px;height:30px;color:green " id="jinbi">当前账户剩余金币</span>
                            </div>
                </div>
                    <input type="hidden" name="id" value="">
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-3">
                        <button class="btn btn-primary" type="button" onclick="cz()" > 确&nbsp;&nbsp;认</button>&nbsp;&nbsp;&nbsp;
                       
                    </div>
                </div>
                 </form>
            </div>
        </div>
    </div>
<!-- 充值结束 -->
<!-- 积分充值开始 -->
 <div class="modal  fade" id="jifenxuan" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" style="width:50%">
            <div class="modal-content" style="width:100%;padding-bottom: 20px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">用户积分充值</h4>                  
                </div>
               <form class="form-horizontal" name="userAdd"   action=""  method="post">
                        
                <div class="form-group" style="margin-top: 20px;">
                            <label class="col-sm-3 control-label">积分：</label>
                            <div class="input-group col-sm-4">
                                <input id="jifen" type="number" class="form-control" name="jifen"  >
                                <span style="margin-top:20px;width:100px;height:30px;color:green " id="jifenjinbi">当前账户剩余积分</span>
                            </div>
                </div>
                    <input type="hidden" name="jifenid" value="">
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-3">
                        <button class="btn btn-primary" type="button" onclick="jfcz()" > 确&nbsp;&nbsp;认</button>&nbsp;&nbsp;&nbsp;
                       
                    </div>
                </div>
                 </form>
            </div>
        </div>
    </div>
<!-- 积分充值结束 -->
<!--账号充值-->

 <div class="modal  fade" id="zhanghao" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" style="width:50%">
            <div class="modal-content" style="width:100%;padding-bottom:20px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">账号绑定数量</h4>                  
                </div>
               <form class="form-horizontal" name="userAdd"   action=""  method="post">
                    
                <div class="form-group" style="margin-top: 20px;">
                            <label class="col-sm-3 control-label">账号绑定数量：</label>
                            <div class="input-group col-sm-4">
                                <input id="jifen" type="number" class="form-control" name="zhnumber"  >
                               
                            </div>
                </div>
                   
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-3">
                        <button class="btn btn-primary" type="button" onclick="zhanghaocz()" > 确认</button>&nbsp;&nbsp;&nbsp;
                       
                    </div>
                </div>
                 </form>
            </div>
        </div>
    </div>
    <!--视频发布-->
     <div class="modal  fade" id="spfabu" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" style="width:50%">
            <div class="modal-content" style="width:100%;padding-bottom:20px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">视频发布数量</h4>                  
                </div>
               <form class="form-horizontal" name="userAdd"   action=""  method="post">
                    
                <div class="form-group" style="margin-top: 20px;">
                            <label class="col-sm-3 control-label">视频发布数量：</label>
                            <div class="input-group col-sm-4">
                                <input id="jifen" type="number" class="form-control" name="spfabu"  >
                               
                            </div>
                </div>
                   
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-3">
                        <button class="btn btn-primary" type="button" onclick="spfabucz()" > 确认</button>&nbsp;&nbsp;&nbsp;
                       
                    </div>
                </div>
                 </form>
            </div>
        </div>
    </div>
    <!--视频发布结束-->
<input type="hidden" name="zhanghaoid" id="" value="" />
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

//视频发布
function spfabu(id){
     $('input[name="zhanghaoid"]').val(id);
      $('#spfabu').modal('show');
}
/*视频发布数量充值*/
function spfabucz(){
    zhanghaoid  =  $('input[name="zhanghaoid"]').val();
    spnumber  =  $('input[name="spfabu"]').val();
    $.post('<?php echo url("spfabu"); ?>',
            {zhanghaoid:zhanghaoid,spnumber:spnumber},
            function(data){  
                if(data.code==1){
                      layer.msg(data.msg,{icon:1,time:1500,shade: 0.1,});
                    setInterval(function(){
                         window.location.reload();
                    },1000)
                  
                    
                }else{
                    layer.msg(data.msg,{icon:2,time:1500,shade: 0.1,});
                    setInterval(function(){
                         window.location.reload();
                    },1000)
                }
             
        });
       
}
   //绑定账号充值
   function zhanghao(id){
       $('input[name="zhanghaoid"]').val(id);
      $('#zhanghao').modal('show');
   }
   //增加账号绑定数量
   function zhanghaocz(){
       zhanghaoid  =  $('input[name="zhanghaoid"]').val();
       zhnumber  =  $('input[name="zhnumber"]').val();
        $.post('<?php echo url("zhnumber"); ?>',
            {zhanghaoid:zhanghaoid,zhnumber:zhnumber},
            function(data){  
                if(data.code==1){
                      layer.msg(data.msg,{icon:1,time:1500,shade: 0.1,});
                    setInterval(function(){
                         window.location.reload();
                    },1000)
                  
                    
                }else{
                    layer.msg(data.msg,{icon:2,time:1500,shade: 0.1,});
                    setInterval(function(){
                         window.location.reload();
                    },1000)
                }
             
        });
   }
 function user_staus(id,type){
 if(type==1){
         con = '您确定要开启账号？';
    }else{
      
        con = '您确定要禁用账号？';
    }
    layer.confirm(con, {icon: 3, title:'提示'}, function(index){
         $.post('<?php echo url("user_staus"); ?>',
            {id:id,type:type},
            function(data){  
                if(data.code==1){
                     layer.msg(data.msg,{icon:1,time:1500});
                      setInterval(function(){
                        location.reload();
                        },1000)
                }else{
                     layer.msg(data.msg,{icon:1,time:1500,shade: 0.1,});
                      setInterval(function(){
                        location.reload();
                        },1000)
                }
             
            });
     })
 }
   
   /**
    * 是否开始代理账号api
   *
   *
   */
 function kaiqi(id,type){
        if(type==1){
               con = '您确定要开启api？';
        }else{
          
            con = '您确定要关闭api？';
        }
      layer.confirm(con, {icon: 3, title:'提示'}, function(index){
         $.post('<?php echo url("kaiqi"); ?>',
            {id:id,type:type},
            function(data){  
                if(data.code==1){
                     layer.msg(data.msg,{icon:1,time:1500});
                      setInterval(function(){
                        location.reload();
                        },1000)
                }else{
                     layer.msg(data.msg,{icon:1,time:1500,shade: 0.1,});
                      setInterval(function(){
                        location.reload();
                        },1000)
                }
             
            });
      })
  }
   
function article_list(list){

    var tpl = document.getElementById('arlist').innerHTML;
    laytpl(tpl).render(list, function(html){
        document.getElementById('article_list').innerHTML = html;
    });
}
function chongzhi(id){

    $('input[name="id"]').val(id);
         $.post('<?php echo url("cha"); ?>',
            {id:id},
            function(data){  
                if(data.code==1){
                    // $('input[name="money"]').val(data.msg);
                     $("#jinbi").html('当前账户剩余金币'+data.msg)
                }else{
                    layer.msg(data.msg,{icon:1,time:1500,shade: 0.1,});
                     window.location.reload();
                }
             
            });
      $('#fenzu_xuan').modal('show');
}

function cz(){
    
   id =  $('input[name="id"]').val();
   money = $('input[name="money"]').val();
        $.post('<?php echo url("moneyadd"); ?>',
            {id:id,money:money},
            function(data){  
                if(data.code==1){
                //     layer.msg("2秒就消失哦", { time: 2000 }, function () {
                //     window.location.href = document.location;
                // });
             
                     layer.msg(data.msg,{icon:1,time:1500,shade: 0.1,},function(){
                          window.location.href = document.location;
                     });
                    
                }else{
                    layer.msg(data.msg,{icon:2,time:1500,shade: 0.1,},function(){
                          window.location.href = document.location;
                     });
                    // window.location.reload();
                }
             
            });
}

/**
 * 
 */ 
function userEdit(id){

    location.href = './userEdit/id/'+id+'.html';
}



/**
 * 
 */
function user_state_del(id){

    $.post('<?php echo url("user_state_del"); ?>',
    {id:id},
    function(data){
         
        if(data.code==1){
           
            //var a='<span class="label label-danger">禁用</span>'
            //$('#kaiqi').html(a);
            //layer.msg(data.msg,{icon:2,time:1500,shade: 0.1,});
             window.location.reload();
            return false;
        }else{
           
            //var b='<span class="label label-info">开启</span>'
            //$('#jin').html(b);
            //layer.msg(data.msg,{icon:1,time:1500,shade: 0.1,});
             window.location.reload();
            return false;
        }         
        
    });
    return false;
}

/*积分充值*/
function jfchongzhi(id){
   

    $('input[name="jifenid"]').val(id);
         $.post('<?php echo url("jfcha"); ?>',
            {id:id},
            function(data){  
                if(data.code==1){
                    $("#jifenjinbi").html('当前账户剩余积分'+data.msg)
                    // $('input[name="money"]').val(data.msg);
                }else{
                    layer.msg(data.msg,{icon:1,time:1500,shade: 0.1,});
                     window.location.reload();
                }
             
            });
      $('#jifenxuan').modal('show');
}

/**
 * 积分
*/
function jfcz(){
   id =  $('input[name="jifenid"]').val();
   money = $('input[name="jifen"]').val();
        $.post('<?php echo url("jifenmoneyadd"); ?>',
            {id:id,money:money},
            function(data){  
                if(data.code==1){
                    layer.msg(data.msg,{icon:1,time:1500,shade: 0.1,},function(){
                          window.location.href = document.location;
                     });
                     
                }else{
                  
                  layer.msg(data.msg,{icon:2,time:1500,shade: 0.1,},function(){
                          window.location.href = document.location;
                     });
                }
             
            });
}

</script>
</body>
</html>