<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:90:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/usersite/notice.html";i:1665555745;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/header.html";i:1660125746;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/footer.html";i:1660125746;}*/ ?>
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
                <a href="javascript:tianjia();">
                            <button class="btn btn-outline btn-primary" type="button">添加</button>
                </a>
            </div>
            <div class="col-12">
                <div class="block">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="long-tr">
                               <th>类型</th>
                                <th>标题</th>
                                <th>添加时间</th>
                                <th style="width:50%">公告内容</th>

                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody id="article_list">
                             <?php if(is_array($list) || $list instanceof \think\Collection): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$vo): ?>
                             <tr>
                                 <td><?php if($vo['type']==1): ?>系统公告<?php else: ?>常见问题<?php endif; ?></td>
                                 <td><?php echo $vo['title']; ?></td>
                                 <td><?php echo date('Y-m-d H:i:s',$vo['addtime']); ?></td>
                                 <td><?php echo $vo['text']; ?></td>
                                 <td> 
                                  <a href="javascript:;"  onclick="edit(<?php echo $vo['id']; ?>)">
                                           编辑</a>&nbsp;&nbsp;
                                 <a href="javascript:del(<?php echo $vo['id']; ?>)"  class="btn btn-danger btn-xs">
                                            删除</a></td>
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
<!--添加公告模态框-->
<div class="modal fade" id="add" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" style="width:50%">
            <div class="modal-content" style="width:100%;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">添加公告</h4>                  
                </div>
                <div class="add-renwu">
                    <div style="padding:5% 0">
                            <form  id="add-renwuform"  >
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label font13 text-r" style="line-height:35px;">选择类型：</label>
                                    <div class="input-group col-sm-8">
                                        <select class="form-control" name="type" id="type" >
                                             <option value="1">系统公告</option>
                                             <option value="2">常见问题</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label font13 text-r" style="line-height:35px;">填写标题：</label>
                                    <div class="input-group col-sm-8">
                                        <input  type="text" class="form-control" name="title" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label font13 text-r" style="line-height:35px;">公告内容：</label>
                                    <div class="input-group col-sm-8">
                                        <textarea class="text" name="text" id="" cols="50" rows="10"></textarea>

<!--                                        <input  type="text" class="form-control" name="url" >-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-col-sm-offset-3">
                                        <botton class="btn btn-primary ml-30 mt-5"  id='zhida_baocun' onclick="sub()" >
                                            保&nbsp;&nbsp;&nbsp;存
                                        </botton>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div> 
            </div>
        </div>
    </div>
<!--添加任务模态框结束-->    
<!--编辑模态框-->
<div class="modal fade" id="edit" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" style="width:50%">
            <div class="modal-content" style="width:100%;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">编辑公告</h4>                  
                </div>
                <div class="add-renwu">
                    <div style="padding:5% 0">
                            <form  id="add-renwuform"  >
                                <div class="form-group">
                                    <label class="col-sm-2 control-label font13 text-r" style="line-height:35px;">类型：</label>
                                    <div class="input-group col-sm-8">
                                        <input  type="text" class="form-control" name="notice_type"  readonly=“readonly” >
                                            <em class="font12 font8c95b0">此类型不可编辑</em>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label font13 text-r" style="line-height:35px;">填写标题：</label>
                                    <div class="input-group col-sm-8">
                                        <input  type="text" class="form-control" name="notice_title" >
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label font13 text-r" style="line-height:35px;">公告内容：</label>
                                    <div class="input-group col-sm-8">
                                        <textarea class="text2 font13" name="text" id="" cols="50" rows="10"></textarea>
                                    </div>
                                </div>
<!--                                <div class="form-group">-->
<!--                                    <label class="col-sm-2 control-label font14 text-r" style="line-height:35px;">填写url：</label>-->
<!--                                    <div class="input-group col-sm-6">-->
<!--                                        <input  type="text" class="form-control" name="notice_url" >-->
<!--                                        -->
<!--                                    </div>-->
<!--                                </div>-->
                                    <input type="hidden" name="notice_id" id="" value="" />
                                   
                                <div class="form-group">
                                    <div class="col-col-sm-offset-3">
                                        <botton class="btn btn-primary ml-30 mt-5"  id='zhida_baocun' onclick="edit_baocun()" >
                                            保&nbsp;&nbsp;&nbsp;存
                                        </botton>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div> 
            </div>
        </div>
    </div>
<!--编辑模态框结束-->    


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
/*添加*/
function sub(){
    // name =  $("input[name='rwname']").val();
   var  type = $('#type  option:selected').val();//获取选中类型
   var  title =  $("input[name='title']").val();//标题
   // var  url =  $("input[name='url']").val();//链接地址
    var  text =  $(".text").val();//链接地址
   if(title ==''){
       layer.msg('请填写标题',{icon:1,time:1500,shade: 0.1,});
   }
   //  if(url ==''){
   //     layer.msg('请填链接地址',{icon:1,time:1500,shade: 0.1,});
   // }
    if(text ==''){
        layer.msg('请填链接地址',{icon:1,time:1500,shade: 0.1,});
    }
   
    $.post('<?php echo url("add_notice"); ?>',
     {type:type,title:title,text:text},
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
    function del(id){
         $.post('<?php echo url("del_notice"); ?>',
     {id:id},
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
function tianjia(){
    $("#add").modal('show');
}
/*编辑获取数据*/
function edit(id){
     $("#edit").modal('show');
            $.post('<?php echo url("edit_notice"); ?>',
         {id:id},
        function(data){
              if(data.code==1){
                  console.log(data.msg)
                  $("input[name='notice_title']").val(data.msg.title);//标题
                  $("input[name='notice_url']").val(data.msg.url);//链接地址
                  $(".text2").val(data.msg.text);//链接地址
                  $("input[name='notice_id']").val(data.msg.id);//id
                
                 
                  if(data.msg.type ==1){
                      $("input[name='notice_type']").val('系统公告');//类型 
                  }else{
                       $("input[name='notice_type']").val('常见问题');//类型
                  }
                   
              } else{
                 layer.msg(data.msg,{icon:2,time:1500,shade: 0.1,});
                setInterval(function(){
                    location.reload();
                 },1000)
                
                return false;  
              }     
            
        });
}

/*保存编辑*/
function edit_baocun(){
   
   var title =  $("input[name='notice_title']").val();//标题
   var url =  $("input[name='notice_url']").val();//链接地址
   var id  =  $("input[name='notice_id']").val();//id
    var  text =  $(".text2").val();//链接地址
    if(title ==''){
         layer.msg('请填写标题名称',{icon:2,time:1500,shade: 0.1,});
    }
    if(url ==''){
         layer.msg('请填写URL地址',{icon:2,time:1500,shade: 0.1,});
    }
    if(text ==''){
        layer.msg('请填链接地址',{icon:1,time:1500,shade: 0.1,});
    }
 
     $.post('<?php echo url("edit_baocun"); ?>',
     {title:title,url:url,id:id,text:text},
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
</body>
</html>