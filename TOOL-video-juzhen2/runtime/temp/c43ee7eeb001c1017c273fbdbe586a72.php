<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:89:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/userinfo/fenzu.html";i:1667376046;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/header.html";i:1660125746;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/footer.html";i:1660125746;}*/ ?>
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
            <!--添加按钮-->
            <div class="col-12">
                <button type="button" class="btn btn-primary btn-outline" onclick="tianjia()" >新增分组</button>
                <button type="button" class="btn btn-primary btn-outline m-l-md" onclick="code_url()" >D音H5分享入口</button>
            </div>
            
            <div class="col-12">
                <div class="block">
                   
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="long-tr">
                                    <th width="50px">排序</th>
                                    <th >分组名称</th>
                                   
                                    <th >抖音</th>
                                    <th >快手</th>
                                    <th >西瓜</th>
                                    <th >头条</th>
                                    <th >账号数量</th>
                                    <th >添加时间</th>
                                    <th >操作</th>

                                </tr>
                            </thead>
                            <tbody>                       
                              <?php if(is_array($list) || $list instanceof \think\Collection): if( count($list)==0 ) : echo "" ;else: foreach($list as $k=>$v): ?>
                                <tr style="text-align: center;">
                                    <td colspan="" align="right" id="paixu">
                                    	  <input type="text" id="key" class="form-control" name="fzpai" value="<?php echo $v['fzpai']; ?>" placeholder="" style="float:left;display: block;width: 50px;margin-left: 10px;" />
                                   </td>
                                   <td><?php echo $v['fzname']; ?></td>
                                  
                                   <td><?php echo $v['douyin']; ?></td>
                                    <td><?php echo $v['kuaishou']; ?></td>
                                   <td><?php echo $v['xigua']; ?></td>
                                   <td><?php echo $v['toutiao']; ?></td>
                                  
                                   <td><?php echo $v['count']; ?></td>
                                   <td><?php echo date('Y-m-d H:i:s',$v['addtime']); ?></td>
                                   <td>
                                       <!--<a href="javascript:;" class="btn btn-primary btn-xs" data-toggle="modal" onclick="code_url2(<?php echo $v['id']; ?>)" >-->
                                       <!--    任务链接</a>-->
                                        <!--<a href="javascript:;" class="btn btn-primary btn-xs" data-toggle="modal" onclick="code_url(<?php echo $v['id']; ?>)" >-->
                                        <!--      登录链接</a>-->
                                   	 <a href="javascript:;" class="btn btn-primary btn-xs" data-toggle="modal" onclick="code_fenzu(<?php echo $v['id']; ?>)" >
                                               地推二维码</a>
                                     <a href="<?php echo url('user_list_f'); ?>?fenzuid=<?php echo $v['id']; ?>" class="btn btn-primary btn-xs"  >
                                               账号列表</a>
                                   	 <a href="javascript:;" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editfenzu" onclick="edit_fenzu(<?php echo $v['id']; ?>)" >
                                               编辑</a>
                                               <a href="javascript:;" class="btn btn-primary btn-xs"  onclick="del_fenzu(<?php echo $v['id']; ?>)" >
                                               删除</a>

                                   </td>
                                </tr>
                                 <?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                            
                        </table>
                   
                
                    <div id="AjaxPage" style=" text-align: center;"><?php echo $page; ?></div>
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
    <div class="modal  fade" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">添加分组</h4>                  
                </div>
                <form class="form-horizontal" name="add_rule" id="add_rule" method="post" action="<?php echo url('fenzu'); ?>">
                    <div class="ibox-content">
                          
                            <div class="form-group m-t-md">
                                <label class="col-sm-3 control-label font13">分组名称：</label>
                                <div class="col-sm-8">
                                    <input type="text" name="fzname" id="title" placeholder="请输入分组名称" class="form-control"/>
                                </div>
                            </div>                      
                           
                            <div class="form-group">
                                <label class="col-sm-3 control-label font13">分组排序：</label>
                                <div class="col-sm-8">

                                    <input type="number" name="fzpai" id="name" placeholder="排序默认为50，数量越大，排名越靠前" class="form-control"/>
                                    <!--<span class="help-block m-b-none">默认为50 </span>-->
                                </div>
                            </div>  
                        <!--     <div class="form-group">-->
                        <!--        <label class="col-sm-3 control-label">显示状态</label>-->
                        <!--        <select name="sattus" id="" class="form-control" style="width:200px;float:left">-->
                        <!--        <option value="2">显示</option>-->
                        <!--         <option value="1">隐藏</option>-->
                            
                           
                        <!--</select>-->
                        <!--    </div>  -->
                           
                           
                                             
                        </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> 保存</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> 关闭</button>                    
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- 编辑分组模态框 -->
     <div class="modal  fade" id="editfenzu" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" style="width:50%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">编辑分组</h4>                  
                </div>
                <form class="form-horizontal" name="add_rule" id="add_rule" method="post" action="<?php echo url('fenzu'); ?>">
                    <input type="hidden" name="id" id="fenzu_id" value="">
                    <input type="hidden" name="type" id="" value="1">
                    <div class="ibox-content m-t-md">
                          
                            <div class="form-group">
                                <label class="col-sm-3 control-label font13">分组名称：</label>
                                <div class="col-sm-8">
                                    <input type="text" name="fzname" id="fenzu_title" placeholder="请输入分组名称" class="form-control"/>
                                </div>
                            </div>                      
                           
                            <div class="form-group">
                                <label class="col-sm-3 control-label font13">分组排序：</label>
                                <div class="col-sm-8">

                                    <input type="number" name="fzpai" id="fenzu_pai" placeholder="排序默认为50，数量越大，排名越靠前" class="form-control"/>
                                    <!--<span class="help-block m-b-none">默认为50 </span>-->
                                </div>
                            </div>  
                        <!--     <div class="form-group">-->
                        <!--        <label class="col-sm-3 control-label">显示状态&nbsp;&nbsp;</label>-->
                        <!--        <select name="sattus" id="fenzu_status" class="form-control" style="width:200px;float:left">-->
                        <!--        <option value="2">显示</option>-->
                        <!--         <option value="1">隐藏</option>-->
                            
                           
                        <!--</select>-->
                        <!--    </div>  -->
                           
                           
                                             
                        </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> 保存</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> 关闭</button>                    
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- 结束 -->
    
    <!-- 地推二维码 -->
     <div class="modal  fade" id="codefenzu" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" style="width:50%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">地推二维码</h4>                  
                </div>
                <form class="form-horizontal" name="add_rule" id="add_rule" method="post" action="<?php echo url('fenzu'); ?>">
                    <div class="ibox-content m-t-md">
                          
                            <div class="form-group" style="text-align: center;">
                                <img class="qrcode_h5" src="" alt="" />
                            </div>         
                                             
                        </div>
                    <div class="modal-footer">                 
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- 结束 -->
    <!-- 登录链接 -->
     <div class="modal  fade" id="codefenzu_url" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" style="width:50%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">登录链接</h4>                  
                </div>
                <form class="form-horizontal" name="add_rule" id="add_rule" method="post" action="<?php echo url('fenzu'); ?>">
                    <div class="ibox-content m-t-md">
                          
                            <div class="form-group" style="text-align: center;">
                                <p id="qrcode_h5_url"></p>
                            </div> 
                            
                                       
                        </div>
                    <div class="modal-footer">                 
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- 结束 -->
    <div class="modal  fade" id="codefenzu_url2" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" style="width:50%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" style="text-align:center">D音H5分享链接/扫码入口</h4>
                </div>
                    <div class="ibox-content m-t-md">
                            
                        <div class="form-group" style="text-align: center;">
                            <p id="qrcode_h5_url2"></p>
                        </div>
                        <div class="form-group" style="text-align: center;">
                                <img class="qrcode_h5_qrcode" src="" alt="" />
                            </div> 
                    </div>
                    <div class="modal-footer">
                    </div>
            </div>
        </div>
    </div>
    
<script type="text/javascript">
 function edit_fenzu(id){
        $.post('<?php echo url("edit_id"); ?>',
        {id:id},
    function(data){
         $("#fenzu_title").val(data.fzname);
         $("#fenzu_pai").val(data.fzpai);
         $("#fenzu_status").val(data.sattus);
         $("#fenzu_id").val(data.id);
                
        
    });
 }
 function code_fenzu(id){
     layer.load(1)
    $.get('<?php echo url("fenzu_h5_code"); ?>',{id:id},function(data){
        $(".qrcode_h5").attr('src',data)
        $("#codefenzu").modal('show');
        layer.closeAll('loading');
        console.log(data)
    });
 }
  function code_url(id){
     layer.load(1)
    $.get('<?php echo url("fenzu_h5_code_url"); ?>',{id:id},function(data){
        $("#qrcode_h5_url2").html(data.url);
        $(".qrcode_h5_qrcode").attr('src',data.qrcode)
        $("#codefenzu_url2").modal('show');
        layer.closeAll('loading');
        console.log(data)
    });
 }
 function code_url2(id){
     layer.load(1)
     $.get('<?php echo url("fenzu_h5_code_url2"); ?>',{id:id},function(data){
         $("#qrcode_h5_url").html(data);
          
         $("#codefenzu_url").modal('show');
         layer.closeAll('loading');
         console.log(data)
     });
 }
 function tianjia(){
   $.post('<?php echo url("quanxian"); ?>',
       {},
      function(data){
          if(data.code==1){
            $('#myModal').modal('show');
              // layer.msg(data.msg,{icon:1,time:1500,shade: 0.1,});
               //location.reload();
          }else{
               layer.msg(data.msg,{icon:2,time:1500,shade: 0.1,});
          }
     });
}
/*删除分组*/
function del_fenzu(id){
     layer.confirm('您确定要删除当前分组?', {icon: 3, title:'提示'}, function(index){
        //do something
        $.getJSON('./del_fenzu', {'id' : id}, function(res){
            if(res.code == 1){
                layer.msg(res.msg,{icon:1,time:1500});
               setInterval(function(){
                          location.reload();
                        },1000)
            }else{
                layer.msg(res.msg,{icon:0,time:1500});
                setInterval(function(){
                          location.reload();
                        },1000)
            }
        });

        layer.close(index);
    })
}



</script>
</body>
</html>