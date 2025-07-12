<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:89:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/userinfo/index.html";i:1672812360;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/header.html";i:1660125746;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/footer.html";i:1660125746;}*/ ?>
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
            <!--第一行数据-->
            <div class="col-2">
                <!-- 卡片盒子 -->
                <div class="block card-group">
                    <!-- 卡片信息 -->
                    <div class="card-info">
                        <span class="tips">
                            视频总条数
                        </span>
                        <div class="num-or-price">
                            <span><?php echo $all_count; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <!-- 卡片盒子 -->
                <div class="block card-group">
                    <!-- 卡片信息 -->
                    <div class="card-info">
                        <span class="tips">
                            视频总点赞量
                        </span>
                        <div class="num-or-price">
                            <span><?php echo $like_count; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <!-- 卡片盒子 -->
                <div class="block card-group">
                    <!-- 卡片信息 -->
                    <div class="card-info">
                        <span class="tips">
                            视频总曝光量
                        </span>
                        <div class="num-or-price">
                            <span><?php echo $view_count; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <!-- 卡片盒子 -->
                <div class="block card-group">
                    <!-- 卡片信息 -->
                    <div class="card-info">
                        <span class="tips">
                            视频总分享量
                        </span>
                        <div class="num-or-price">
                            <span><?php echo $new_share; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <!-- 卡片盒子 -->
                <div class="block card-group">
                    <!-- 卡片信息 -->
                    <div class="card-info">
                        <span class="tips">
                            视频总转发量
                        </span>
                        <div class="num-or-price">
                            <span><?php echo $forward_count; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <!-- 卡片盒子 -->
                <div class="block card-group">
                    <!-- 卡片信息 -->
                    <div class="card-info">
                        <span class="tips">
                            视频总评论数
                        </span>
                        <div class="num-or-price">
                            <span><?php echo $comment_count; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--绑定账号的平台-->
            <div class="col-12">
                <div class="block">
                    <h6 class="m-b-md font-c8d3f5"><b>绑定账号(直接点击对应平台的图标即可)</b></h6>
                    <div class="enterprise-platform">
                        <div class="douyin" onclick="tianjia()">
                            <button id="p0" class="hl">
                                <img src="__IMG__/duoyin.png">
                            </button>
                        </div>
                        <div class="kuaishou" onclick="tianjia()">
                            <button id="p1" class="hl">
                                <img src="__IMG__/kuaishou.png">
                            </button>
                        </div>
                        <div class="xigua" onclick="no_open()">
                            <button id="p1" class="hl">
                                <img src="__IMG__/xigua.png">
                            </button>
                        </div>
                        <div class="toutiao" onclick="no_open()">
                            <button id="p1" class="hl">
                                <img src="__IMG__/toutiao.png">
                            </button>
                        </div>
                        <div class="hongshu" onclick="no_open()">
                            <button id="p2" class="hl">
                                <img src="__IMG__/hongshu.png">
                            </button>
                        </div>
                        <div class="baijiahao" onclick="no_open()">
                            <button id="p2" class="hl">
                                <img src="__IMG__/baijiahao.png">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--企业号列表-->
            <div class="col-12">
                <div class="block">
                    <!--<table class="layui-hide" id="table-page" lay-filter="table-page"></table>-->
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
                   	 		                视频数量
                   	 		            </div>
                   	 		            <div class="neirong3">
                   	 		                曝光量
                   	 		            </div>
                   	 		            <div class="neirong3">
                   	 		                点赞量
                   	 		            </div>
                   	 		            <div class="neirong3">
                   	 		                评论
                   	 		            </div>
                   	 		            <div class="neirong3">
                   	 		                分享
                   	 		            </div>
                   	 		            <!--<div class="neirong3">-->
                   	 		            <!--    到期时间-->
                   	 		            <!--</div>-->
                   	 		             <div class="neirong3">
                   	 		                授权时间
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
                                      <!--<span class="type">抖音</span>-->
                                      <img class="type" src="__IMG__/dou.jpg">
                                      <?php elseif($vo['type']=='2'): ?>
                                      <!--<span class="type">西瓜</span>-->
                                      <img class="type" src="__IMG__/xig.png">
                                      <?php elseif($vo['type']=='3'): ?>
                                      <!--<span class="type">头条</span>-->
                                      <img class="type" src="__IMG__/tout.png">
                                      <?php else: ?>
                                      <!--<span class="type">快手</span>-->
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
                                      <!--<?php if($vo['all_count'] =='' && $vo['private_count'] == ''): ?>-->
                                      <!--  <p class="p1">0/0</p>-->
                                      <!--<?php else: ?>-->
                                      <!--  <p class="p1"><?php echo $vo['all_count']; ?>/<?php echo $vo['private_count']; ?></p>-->
                                      <!--<?php endif; ?>-->
                   	 				  <?php if($vo['all_count'] =='' && $vo['private_count'] == ''): ?>
                                        <p class="p1">0</p>
                                      <?php else: ?>
                                        <p class="p1"><?php echo $vo['all_count']; ?></p>
                                      <?php endif; ?>
                   	 					<!--<p>视频(总/私)</p>-->
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
                   	 				<!--<div class="neirong3">-->
                         <!--             <p class="p1"><?php echo $vo['addtime']; ?></p>-->
                         <!--           </div>-->
                                    <div class="neirong3">
                                      <p class="p1"><?php echo $vo['addtime']; ?></p>
                                    </div>
                   	 				
                   	 			</div>
       	 			            <div class="neirongdi">
               	 					<a class="" href="<?php echo url('video/single'); ?>" title="发布视频">
                                        <span class="label label-primary" >发布视频</span>
                                    </a>
                                    <a class="" href="<?php echo url('splb'); ?>?id=<?php echo $vo['id']; ?>" title="我的作品">
                                        <span class="label label-primary" style="background:#b572c1">作品</span>
                                    </a>
                                    <a class="" href="javascript:jilu(<?php echo $vo['id']; ?>)" title="任务日志">
                                        <span class="label label-warning" >任务日志</span>
                                    </a>
                                    <a class="" href="javascript:del_del(<?php echo $vo['id']; ?>)" title="解绑">
                                        <span class="label label-danger" >解绑</span>
                                    </a>
                                    <a class="" href="javascript:fz_gh(<?php echo $vo['id']; ?>)" title="移组">
                                        <span class="label label-info" >移组</span>
                                    </a>
                   	 			</div>
                   	 		</div>
       	 	            </div>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        <div class="col-12" style="text-align:center">
                            <?php echo $page; ?>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

  <!-- 选择分组模态框 -->
<div class="modal  fade" id="fenzu_xuan" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" style="width:50%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title">添加账号之前请选择分组</h3>                  
                </div>
               <!--  <form class="form-horizontal" name="add_rule" id="add_rule" method="post" action="" > -->
                    <div class="ibox-content m-t-md">
                            <div class="form-group">
                                <label class="col-sm-3 control-label text-r" style="line-height:35px;">选择分组&nbsp;&nbsp;</label>
                                <div class="col-sm-8">                                                      
                                    <select name="fenzu" id="select1" class="form-control m-b">
                                       
                                         <?php if(is_array($fenzu) || $fenzu instanceof \think\Collection): if( count($fenzu)==0 ) : echo "" ;else: foreach($fenzu as $key=>$v): ?>
                                  <option value="<?php echo $v['id']; ?>"><?php echo $v['fzname']; ?></option>
                                         <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>                                    
                                </div>

        
                            </div>
                   
                        
            <div style="width: 85%;margin:60px auto 100px">
            <a  href="" target="view_window" class="btn btn-primary" style="margin-left: 2px;width: 24%;float: left;display: none;" id="douyinzi"> 抖音</a>  
            <a  href="javascript:browse();"  class="btn btn-primary" style="margin-left: 2px;width: 24%;float: left;" id="dou1yin1"> 抖音</a>
            <!--<a href="" target="view_window" class="btn btn-primary" style="margin-left: 2px;width: 24%;float: left;display: none;" id="xiguaa"> 西瓜</a> -->
            <!--<a  href="javascript:browse1();"  class="btn btn-primary" style="margin-left: 2px;width: 24%;float: left;" id="xiguab"> 西瓜</a> -->
            <!--<a href="" target="view_window" class="btn btn-primary" style="margin-left: 2px;width: 24%;float: left;display: none;" id="toutiaoa"> 头条</a>  -->
            <!--<a  href="javascript:browse2();"  class="btn btn-primary" style="margin-left: 2px;width: 24%;float: left;" id="toutiaob"> 头条</a>-->
            <a href="" target="view_window" class="btn btn-primary" style="margin-left: 2px;width: 24%;float: left;display: none;" id="kuaishoua"> 快手</a>  
            <a  href="javascript:browse3();"  class="btn btn-primary" style="margin-left: 2px;width: 24%;float: left;" id="kuaishoub"> 快手</a>  
            </div>

                        </div>
                    <div class="modal-footer">
                       <!--  <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#myModal" >确认选择</button> -->
                                         
                    </div>
               <!--  </form> -->
            </div>
        </div>
    </div>
        <!-- 选择分组模态框结束 -->
<!--移动账号分组开始-->
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
<!--移动账号分组结束-->
        <!-- 记录模态框 -->
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
<!-- 记录模态框结束 -->
<input type="hidden" name="jiedian" id="" value="<?php echo $tianjia; ?>" />
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

<script>
    var edit_m = false;
    
    layui.define(['table','form','upload'],function (exports) {
        var table = layui.table;
        var form = layui.form
        var upload = layui.upload
        //基本实例
        var tableInit = table.render({
            elem: '#table-page'//绑定容器
            ,url: '/static/admin/layui/demo1.json'
            ,page: true
            ,limit:10
            ,toolbar: "#toolbar"
            ,title:'矩阵号列表'
            ,defaultToolbar: []
            ,autoSort:false
            ,parseData: function(res){ //res 即为原始返回的数据
                return {
                    "code": res.code, //解析接口状态
                    "msg": res.msg, //解析提示文本
                    "count": res.count, //解析数据长度
                    "data": res.data //解析数据列表
                };
            }
            ,response: {
                statusCode: 1 //规定成功的状态码，默认：0
            }
            ,cellMinWidth:100
            ,cols: [[ //在表头设置对应的字段
                { minWidth:10, type: 'checkbox'}
                ,{field: 'platform', title: '平台',}
                ,{field: 'avatar', title: '头像', width: 50}
                ,{field: 'nickname', title: '达人名称'}
                ,{field: 'all_count', title: '视频数量'}
                ,{field: 'view_count', title: '曝光量'}
                ,{field: 'like_count', title: '点赞量', }
                ,{field: 'comment_count', title: '评论'}
                ,{field: 'new_share', title: '分享',}
                ,{field: 'addtime', title: '授权时间', sort: true}
                ,{field: 'stoptime', title: '到期时间', sort: true}
                ,{title:'操作', align:'center', toolbar: '#action'}
            ]]
        });
        //监听工具条
        table.on('tool(table-page)', function(obj){ //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
            var data = obj.data; //获得当前行数据
            var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
            var tr = obj.tr; //获得当前行 tr 的 DOM 对象（如果有的话）

            if(layEvent === 'edit'){ //编辑
                open_edit(data.id);
            } else if(layEvent === 'LAYTABLE_TIPS'){
                layer.alert('Hi，头部工具栏扩展的右侧图标。');
            }
        });
        table.on('edit(table-page)', function(obj){
            var param = {
                field:obj.field,
                value:obj.value,
                id:obj.data.id
            };
            $.post("/admin/huoke/ledit",param)
                .success(function (response) {
                    if(response.code != 1) {
                        layer.msg(response.msg,{icon:2,time:1500,shade: 0.1,});
                        setTimeout(function () {
                            tableInit.reload();
                        },1000);
                    }
                    // obj.update({title:title});
                })
                .complete(function (response) {
                });
        });

        table.on('sort(table-page)', function(obj){
            console.log(obj)
            table.reload('table-page', {
                initSort: obj //记录初始排序
                , where: {
                    field: obj.field //排序字段
                    , order: obj.type //排序方式
                }
            });
        });
        form.on('submit(search-btn)',function (data) {
            table.reload('table-page', {
                where: data.field
            });
            return false;
        });

        var loading = '';
        upload.render({
            elem: "#uploadExcel",
            url:  '/admin/huoke/import',
            size: '800',
            accept: "file",
            exts: 'csv',
            before: function () {
                loading = layer.load(2);
            },
            done: function (result) {
                if (result.code == 1) {
                    layer.msg(result.msg,{icon:1,time:1500,shade: 0.1,});
                    setTimeout(function () {
                        tableInit.reload();
                    },1000);
                } else {
                    layer.msg(result.msg,{icon:1,time:1500,shade: 0.1,});
                }
                layer.close(loading);
            }
        });
    });
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
// $('#myModal5').map(function() );
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

function no_open() {
    layer.msg('敬请期待')
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