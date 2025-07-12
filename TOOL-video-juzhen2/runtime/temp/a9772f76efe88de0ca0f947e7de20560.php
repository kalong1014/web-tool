<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:84:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/tool/help.html";i:1667286305;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/header.html";i:1660125746;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/footer.html";i:1660125746;}*/ ?>
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
                <a href="javascript:add()" class="btn btn-primary">添加</a> 
            </div>
                            
            <div class="col-12">
                <div class="block">
                    <form name="khsearch" class="form-search" method="get" action="">
                        <div class="col-sm-12 m-b-md" style="padding:0;text-align:center;">
                            <div style="display:inline-flex">
                                <select name="time" id="" class="form-control" style="margin:0 10px">
                                    <option value="">投放时长</option>
                                    <option value="2小时">2小时</option>
                                    <option value="6小时">6小时</option>
                                    <option value="12小时">12小时</option>
                                    <option value="24小时">24小时</option>
                                    <option value="3天">3天</option>
                                </select>
                                <select name="type" id="" class="form-control" style="margin:0 10px">
                                    <option value="">加热类别</option>
                                    <option value="1">点赞评论量</option>
                                    <option value="2">粉丝量</option>
                                    <option value="3">主页浏览量</option>
                                    <option value="4">评论链接点击获取客户</option>
                                    <option value="5">抖音私信获取客户</option>
                                </select>
                                <input type="text" id="key" class="form-control" name="dy_code" value="" autocomplete="off" placeholder="请输入抖音号" style="display: block;width: 80%" />
                                <button type="submit" class="btn btn-primary" style="border-top-left-radius:0;border-bottom-left-radius:0;height:35px"><i class="fa fa-search"></i> 搜索</button> 
                            </div>
                        </div>
                    </form>  
                
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="long-tr">
                                <th>id</th>
                                <th>抖音号</th>
                                <th>加热类别</th>
                                <th>投放时长</th>
                                <th>投放金额</th>
                                <th>性别</th>
                                <th>年龄</th>
                                <th>区域</th>
                                <th>视频链接</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        
                        <tbody id="article_list">

                            <?php if(is_array($list) || $list instanceof \think\Collection): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$vo): ?>
                            <tr>
                                <td><?php echo $vo['id']; ?></td>
                                <td><?php echo $vo['dy_code']; ?></td>
                                <td style="color:#1ab394"><?php echo $vo['type_title']; ?></td>
                                <td><?php echo $vo['time']; ?></td>
                                <td><?php echo $vo['price']; ?></td>
                                <td><?php if($vo['sex']==1): ?>男<?php elseif($vo['sex']==2): ?>女<?php else: ?>不限<?php endif; ?></td>
                                <td><?php echo $vo['age']; ?></td>
                                <td><?php echo $vo['place']; ?></td>
                                <td><?php echo $vo['video_link']; ?></td>
                                <td>
                                    <a href="javascript:;"  class="btn btn-primary btn-xs" onclick="del(<?php echo $vo['id']; ?>)">
                                           删除</a>
                                </td>
                            </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                </div>    
            </div>
        </div>
        
    </div>
 </div> 
 
 
 <!--添加视频加热-->
 <div class="modal  fade" id="add" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" style="width:50%">
            <div class="modal-content" style="width:100%;padding-bottom:20px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">添加视频加热</h4>                  
                </div>
               <form class="form-horizontal" name="userAdd"  id="ext_data"  action=""  method="post">
                  <div class="form-group" style="margin-top: 20px;">
                    <label class="col-sm-3 control-label font13">我想要？</label>
                    <div class="input-group col-sm-7">
                        <select name="type" class="form-control font13" style="">
                            <option value="1" class="font13">点赞评论量</option>
                            <option value="2" class="font13">粉丝量</option>
                            <option value="3" class="font13">主页浏览量</option>
                            <option value="4" class="font13">评论链接点击获取客户</option>
                            <option value="5" class="font13">抖音私信获取客户</option>
                        </select>
                    </div>
                  </div>  
                  <div class="form-group" style="margin-top: 20px;">
                    <label class="col-sm-3 control-label font13">抖音号：</label>
                    <div class="input-group col-sm-7">
                        <input type="text" class="form-control" name="dy_code"  >
                    </div>
                  </div>
                  <div class="form-group" style="margin-top: 20px;">
                    <label class="col-sm-3 control-label font13">视频链接：</label>
                    <div class="input-group col-sm-7">
                        <input type="text" class="form-control" name="video_link"  >
                    </div>
                  </div> 
                  <div class="form-group" style="margin-top: 20px;">
                    <label class="col-sm-3 control-label font13">投放时长：</label>
                    <div class="input-group col-sm-7">
                        <label class="font13"><input name="time" class="time_c" type="radio" value="2小时">2小时 </label>&nbsp;&nbsp;&nbsp;
                        <label class="font13"><input name="time" class="time_c" type="radio" value="6小时">6小时 </label>&nbsp;&nbsp;&nbsp;
                        <label class="font13"><input name="time" class="time_c" type="radio" value="12小时">12小时 </label>&nbsp;&nbsp;&nbsp;
                        <label class="font13"><input name="time" class="time_c" type="radio" value="24小时">24小时 </label>&nbsp;&nbsp;&nbsp;
                        <label class="font13"><input name="time" class="time_c" type="radio" value="3天">3天 </label>&nbsp;&nbsp;&nbsp;
                        <label class="font13"><input name="time" type="radio" id="time_radio" value="5">自定义 </label>
                    </div>
                    <label class="col-sm-3 control-label"></label>
                    <div class="input-group col-sm-7">
                        <input type="text" class="form-control" name="time" id="time_input" disabled>
                    </div>
                  </div>
                  <div class="form-group" style="margin-top: 20px;">
                    <label class="col-sm-3 control-label font13">性别：</label>
                    <div class="input-group col-sm-7" style="line-height:35px">
                        <label class="font13"><input name="sex" type="radio" value="0">不限 </label>&nbsp;&nbsp;&nbsp;
                        <label class="font13"><input name="sex" type="radio" value="1">男 </label>&nbsp;&nbsp;&nbsp;
                        <label class="font13"><input name="sex" type="radio" value="2">女 </label>
                    </div>
                  </div> 
                  <div class="form-group" style="margin-top: 20px;">
                    <label class="col-sm-3 control-label font13">年龄：</label>
                    <div class="input-group col-sm-7">
                        <label class="font13"><input name="age" class="age_c" type="radio" value="不限">不限 </label>&nbsp;&nbsp;&nbsp;
                        <label class="font13"><input name="age" class="age_c" type="radio" value="18-23">18-23 </label>&nbsp;&nbsp;&nbsp;
                        <label class="font13"><input name="age" class="age_c" type="radio" value="24-30">24-30 </label>&nbsp;&nbsp;&nbsp;
                        <label class="font13"><input name="age" class="age_c" type="radio" value="31-40">31-40 </label>&nbsp;&nbsp;&nbsp;
                        <label class="font13"><input name="age" class="age_c" type="radio" value="41-50">41-50 </label>&nbsp;&nbsp;&nbsp;
                        <label class="font13"><input name="age" type="radio" id="age_radio" value="5">自定义 </label>
                    </div>
                      <label class="col-sm-3 control-label"></label>
                      <div class="input-group col-sm-7">
                          <input type="text" class="form-control" id="age_input" name="age"  disabled>
                      </div>
                  </div> 
                  <div class="form-group" style="margin-top: 20px;">
                    <label class="col-sm-3 control-label font13">地域：</label>
                    <div class="input-group col-sm-7" style="line-height:35px">
                        <label class="font13"><input name="place" type="radio" value="全国">全国 </label>
                        <label class="font13"><input name="place" type="radio" value="按省市">按省市 </label>
                        <label class="font13"><input name="place" type="radio" value="按区县">按区县 </label>
                        <label class="font13"><input name="place" type="radio" value="按商圈">按商圈 </label>
                    </div>
                  </div> 
                  <div class="form-group" style="margin-top: 20px;">
                    <label class="col-sm-3 control-label font13">投放金额：</label>
                    <div class="input-group col-sm-7">
                        <label class="font13"><input name="price" class="price_c" type="radio" value="100">100 </label>&nbsp;&nbsp;&nbsp;
                        <label class="font13"><input name="price" class="price_c" type="radio" value="500">500 </label>&nbsp;&nbsp;&nbsp;
                        <label class="font13"><input name="price" class="price_c" type="radio" value="1000">1000 </label>&nbsp;&nbsp;&nbsp;
                        <label class="font13"><input name="price" class="price_c" type="radio" value="10000">10000 </label>&nbsp;&nbsp;&nbsp;
                        <label class="font13"><input name="price" class="price_c" type="radio" value="20000">20000 </label>&nbsp;&nbsp;&nbsp;
                        <label class="font13"><input name="price" type="radio" id="price_radio" value="5">自定义 </label>
                    </div>
                    <label class="col-sm-3 control-label"></label>
                    <div class="input-group col-sm-7">
                        <input type="text" class="form-control" id="price_input" name="price"  disabled>
                    </div>
                  </div>
                <div class="form-group">
                    <div class="col-sm-7 col-sm-offset-3">
                        <button class="btn btn-primary" type="button" onclick="confirm()" > 确&nbsp;&nbsp;&nbsp;认</button>
                    </div>
                </div>
                 </form>
            </div>
        </div>
    </div>
<!--添加-->


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
    $(".time_c").click(function() {
        $("#time_input").attr('disabled',true)
    })
    $(".age_c").click(function() {
        $("#age_input").attr('disabled',true)
    })
    $(".price_c").click(function() {
        $("#price_input").attr('disabled',true)
    })
    $("#time_radio").click(function() {
        $("#time_input").attr('disabled',false)
    })
    $("#age_radio").click(function() {
        $("#age_input").attr('disabled',false)
    })
    $("#price_radio").click(function() {
        $("#price_input").attr('disabled',false)
    })

    // 添加
    function add(){
        $('#add').modal('show');
    }

    function edit(id) {
        layer.open({
            type: 2,
            area: ['800px', '600px'],
            content: '/admin/tool/edit?id='+id
        });
    }

    function give(id) {
        layer.open({
            type: 2,
            area: ['800px', '600px'],
            content: '/admin/tool/give?id='+id
        });
    }


    function del(id) {
        layer.confirm("确认删除此推广吗？",function (index) {
            layer.close(index);
            var load_index = layer.load(2);
            $.post("/admin/tool/hdel",{id:id})
                .success(function (response) {
                    layer.msg(response.msg,{icon:1,time:1500,shade: 0.1,});
                    layer.close(load_index);
                    setTimeout(() => {
                        window.location.reload();
                    }, 500);
                })
                .complete(function () {
                    layer.close(load_index);
                });
        });
    }

    function check_valid(key) {
        switch (key) {
            case ("type"):
                return '我想要？不能为空';
                break;
            case ("dy_code"):
                return '抖音号不能为空';
                break;
            case ("video_link"):
                return '视频链接不能为空';
                break;
            case ("time"):
                return '投放时长不能为空';
                break;
            case ("sex"):
                return '性别不能为空';
                break;
            case ("age"):
                return '年龄不能为空';
                break;
            case ("place"):
                return '地域不能为空';
                break;
            case ("price"):
                return '投放金额不能为空';
                break;
        }
    }

    //提交
    function confirm() {
        var load_index = layer.load(2);
        var formData = $('#ext_data').serializeArray();
        // $.each(formData, function(i, field){
        //     if(!field.value || field.value<=0) {
        //         console.log(field.name+'---'+field.value)
        //         var msg = check_valid(field.name)
        //         if(msg) {
        //             layer.alert(msg)
        //             return false;
        //         }
        //     }
        // });
        $.ajax({
            type: "POST",
            url: "/admin/tool/hedit",
            data: formData,
            success: function(data){
                layer.closeAll('loading');
                if(data.code == 1) {
                    layer.alert(data.msg)
                    return false;
                }
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            },
            error:function() {
                layer.closeAll('loading');
                layer.alert('添加失败')
            }
        });
    }
</script>
</body>
</html>