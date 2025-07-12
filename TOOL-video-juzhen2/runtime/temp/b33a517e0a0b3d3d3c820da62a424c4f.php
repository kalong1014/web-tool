<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:85:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/video/scfl.html";i:1665217512;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/header.html";i:1660125746;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/footer.html";i:1660125746;}*/ ?>
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
                <button type="button" class="btn btn-primary btn-outline" onclick="tianjia()" >新增预剪素材分类</button>
            </div>
           
            <div class="col-12">
                <div class="block">
                   
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="long-tr">
                                    <th >ID</th>
                                    <th >预剪素材分类名称</th>
                                    <th>音频</th>
                                    <th >视频</th>
                                    <th >图片</th>
                                    <th >时间</th>
                                    <th >操作</th>
                                </tr>
                            </thead>
                            <tbody> 
                            <?php if(is_array($list) || $list instanceof \think\Collection): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$v): ?>
                            <tr>
                                <td><?php echo $v['id']; ?></td>
                                <td><?php echo $v['uname']; ?></td>
                                <td><?php echo $v['audio']; ?></td>
                                <td><?php echo $v['video']; ?></td>
                                <td><?php echo $v['img']; ?></td>
                                <td><?php echo date('Y-m-d H:i:s',$v['addtime']); ?></td>
                                <td>
                                <a href="<?php echo url('admin/video/yuprw'); ?>?fid=<?php echo $v['id']; ?>" class="btn btn-primary btn-xs"  >
                                               上传素材</a>
                                <a href="<?php echo url('admin/video/index'); ?>?fid=<?php echo $v['id']; ?>" class="btn btn-primary btn-xs"  >
                                               查看素材</a>
                                <a href="javascript:qiyong(<?php echo $v['id']; ?>);" class="btn btn-primary btn-xs"  >
                                               删除</a>
                                <a href="javascript:edit_fenzu(<?php echo $v['id']; ?>);" class="btn btn-primary btn-xs"  >
                                               编辑</a>
                                </td>
                            </tr>
                             <?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                            
                        </table>
                   
                </div>
                 <div id="AjaxPage" style=" text-align: left;"></div>
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
    <!--添加预剪素材分类-->
    <div class="modal  fade" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" style="width:50%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">添加预剪素材分类</h4>                  
                </div>
                <form class="form-horizontal" name="add_rule" id="add_rule" method="post" action="<?php echo url('add_scfz'); ?>">
                    <div class="ibox-content m-t-md">
                          
                            <div class="form-group">
                                <label class="col-sm-3 control-label font13">预剪素材分类名称：</label>
                                <div class="col-sm-8">
                                    <input type="text" name="uname"  placeholder="分类名称" class="form-control"/>
                                    
                                </div>
                               
                            </div>    

                                             
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="fladd()"><i class="fa fa-save"></i> 保存</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> 关闭</button>                    
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- 编辑预剪素材分类 -->
     <div class="modal  fade" id="editfenzu" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">编辑预剪素材分类名称</h4>                  
                </div>
                <form class="form-horizontal" name="add_rule" id="add_rule" method="post" action="<?php echo url('edit_updata'); ?>">
                    <input type="hidden" name="id" id="fenzu_id" value="">
                   
                    <div class="ibox-content m-t-md">
                          
                            <div class="form-group">
                                <label class="col-sm-3 control-label font13">预剪素材分类名称：&nbsp;&nbsp;&nbsp;</label>
                                <div class="col-sm-8">
                                    <input type="text" name="" id="fenzu_title"  class="form-control" value=""/>
                                </div>
                            </div>                      
              
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="scfzbc()"><i class="fa fa-save"></i> 保存</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> 关闭</button>                    
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- 结束 -->

<script type="text/javascript">
/*添加分类*/

function fladd(){
   
    uname = $("input[name='uname']").val();
    if(uname ==""){
         layer.msg("请填写分组名称",{icon:2,time:1500,shade: 0.1,}); return false;
    }
    
    $.post('<?php echo url("add_scfz"); ?>',
        {uname:uname},
    function(data){
        if(data.code==1){
             layer.msg(data.msg,{icon:1,time:1500,shade: 0.1,});
             setInterval(function(){
              location.reload();
            },1000)
        }else{
            layer.msg(data.msg,{icon:2,time:1500,shade: 0.1,});
        }
    });
    
}
/*编辑*/
 function edit_fenzu(id){

        $.post('<?php echo url("edit_fz"); ?>',
        {id:id},
    function(data){
        if(data.code==1){
            $('#editfenzu').modal('show');
             $("#fenzu_title").val(data.msg.uname);
             $("#fenzu_id").val(data.msg.id);
            
        }else{
            layer.msg(data.msg,{icon:2,time:1500,shade: 0.1,});
        }
    });
 }
 /*编辑保存*/
 function scfzbc(){
    id =  $("#fenzu_id").val();
    name = $("#fenzu_title").val();
   if(name ==''){
        layer.msg("分组名称不能为空",{icon:2,time:1500,shade: 0.1,});
   }
   
   $.post('<?php echo url("scfzbc"); ?>',
        {id:id,name:name},
    function(data){
        if(data.code==1){
           layer.msg(data.msg,{icon:1,time:1500,shade: 0.1,});
            setInterval(function(){
                              location.reload();
                            },1000)
        }else{
            layer.msg(data.msg,{icon:2,time:1500,shade: 0.1,});
        }
    });
 }
 function tianjia(){
      $('#myModal').modal('show');
//   $.post('<?php echo url("quanxian"); ?>',
//       {},
//       function(data){
//           if(data.code==1){
//             $('#myModal').modal('show');
//               // layer.msg(data.msg,{icon:1,time:1500,shade: 0.1,});
//               //location.reload();
//           }else{
//               layer.msg(data.msg,{icon:2,time:1500,shade: 0.1,});
//           }
//      });
}

/*弃用分组*/
function qiyong(id){
    
    layer.confirm('您确定要删除分组吗?', {icon: 3, title:'提示'}, function(index){
        $.post('<?php echo url("qiyong"); ?>',
        {id:id},
        function(data){
            if(data.code==1){
                  layer.msg(data.msg,{icon:1,time:1500,shade: 0.1,});
                   setInterval(function(){
                              location.reload();
                            },1000)
            }else{
                layer.msg(data.msg,{icon:2,time:1500,shade: 0.1,});
            }
        });
    })

}
/**/

/**
 * 删除分组
*/
//  function del(id){
//     layer.confirm('您确定要删除此分组吗?', {icon: 3, title:'提示'}, function(index){
//         $.post('<?php echo url("qydel"); ?>',
//         {id:id},
//         function(data){
//             if(data.code==1){
//                   layer.msg(data.msg,{icon:1,time:1500,shade: 0.1,});
//                   setInterval(function(){
//                               location.reload();
//                             },1000)
//             }else{
//                 layer.msg(data.msg,{icon:2,time:1500,shade: 0.1,});
//             }
//         });
//     })
// }



</script>
</body>
</html>