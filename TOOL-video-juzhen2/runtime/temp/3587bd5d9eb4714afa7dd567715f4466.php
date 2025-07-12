<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:90:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/video/excellent.html";i:1665217788;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/header.html";i:1660125746;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/footer.html";i:1660125746;}*/ ?>
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
    .zhida_g{
        width: 100%;
        display: inline-block;
        margin-top: 0;
    }
    .zhida_h{
        width: 18%;
        float: left;
        margin: 0 1%;

    }
    .zhida_k{
        height: 40px;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
        border:1px solid #373d4d;
        line-height: 40px;
        text-align: center;
    }
</style>

<body class="gray-bg">
<link rel="stylesheet" href="/static/admin/layui/css/layui.css" media="all">

<div class="wrapper layui-card-body wrapper-content">
    <div class="admin-con">
        <div class="block-box">
            <div class="col-12">
                <div class="block font12 font8c95b0">
                    <p>1.根据提示选择信息内容与输入相关信息！</p>
                    <p>2.一定要选择<b>组词策略</b>哦！</p>
                    <p style="margin:0">3.因西瓜视频和今日头条的规则限制，此标题如需发布到西瓜视频和今日头条，标题需在30个字内，否则发布视频失败！</p>
                </div>  
            </div>
            <div class="col-12">
                <div class="block">      
                
                    <div style="padding-left: 20px;font-size: 13px;margin:10px 0 20px;height:40px;line-height:40px">
                       智能标题： <input type="text" name="ci_name" id="" value="" placeholder="请给智能标题起个名字" style="border:0;border-bottom:1px solid #000"/>
                    </div>
                    <div  id="diyibu" style="width:100%;">
                  
                      
                        <div class="zhida_g">
    
                            <div class="zhida_h">
                                <p class="zhida_k font13">A区：区域(根据推广区域选择)</p>
                                <div class="zhida_l">
                                   <textarea rows="10" cols="30" name="intro" id="diqu" style="text-align:left;resize:none;"></textarea>
                                   
                                </div>
                                
    
                            </div>
                            <div class="zhida_h">
                                <p class="zhida_k font13">B区：词头(插入默认词)</p>
                                <div class="zhida_l">
                                    <textarea rows="10" cols="30" name="intro" id="citou" style="resize:none;"></textarea>
                                  
                                </div>
                                
    
                            </div>
                            <div class="zhida_h">
                                <p class="zhida_k font13">C区：主词(建议20字以内)</p>
                                <div class="zhida_l">
                                    <!-- rows 高度-->
                                    <!-- cols 宽度 -->
                                 <textarea rows="10" cols="30" name="intro" id="zc" style="resize:none;"></textarea>
                                   
                                </div>
                                
    
                            </div>
                            <div class="zhida_h">
                                <p class="zhida_k font13">D区：长尾词(建议20字以内)</p>
                                <div class="zhida_l">
                                    <!-- rows 高度-->
                                    <!-- cols 宽度 -->
                                <textarea rows="10" cols="30" name="intro" id="cwc" style="resize:none;"></textarea>                               
                                </div>
                                
    
                            </div>
                            <div class="zhida_h">
                                <p class="zhida_k font13">E区：话题(如:#采暖专 #喜欢)</p>
                                <div class="zhida_l">
                                    <!-- rows 高度-->
                                    <!-- cols 宽度 -->
                              <textarea rows="10" cols="30" name="intro" id="cycw" style="resize:none;"></textarea>
                                   
                                </div>
                                
    
                            </div>
    
                        </div>
                        <style>
                        .zhida_x{
                            width: 100%;
                            margin-top: 10px;
                        }
                        .zhida_x ul{
                            padding: 0 1%;
                        }
                        .zhida_x li{
                            width: 18%;
                        }
                        .zhida_ct{
                            margin-left: 2.4%;
                        }
                        .zhida_cw{
                            margin-left: 22.4%;
                        }
                        .zhida_cycw{
                            margin-left: 2%;
                        }
                        .zhida_v{
                            width: 100%;
                            padding: 20px;
                        }
                        .checkbox-inline{
                            
                            
                            float: left;
                            margin-left: 10px;
                            
    
    
                        }
                        .zhida_chec{
                            /*//margin-top: 15px;*/
                            /*float: left;*/
                        }
                        .zhida_span{
                        
                            margin-top: -8px;
                            color: #d9d9d9;
                            float: left;
                            
                            display: block;
                        }
                    </style>
    
                        <div class="zhida_x">
                            <ul>
                                <li class="btn btn-success font13" data-toggle="modal" data-target="#myModalchengshi">插入城市</li>
                                <!-- <li class="btn btn-success">插入三级地区</li> -->
                                <li class="btn btn-success zhida_ct font13" onclick="crct()">插入默认词头</li>
                                <li class="btn btn-success zhida_cw font13" onclick="crcw()">插入默认尾词</li>
                                <!--<li class="btn btn-success zhida_cycw" onclick="cycw()">插入系统创意词尾</li>-->
                            </ul>
                        </div>
        
                        <div class="zhida_v" style="">
                                <p class="font13 m-b-md">选择组词策略:</p>
        
                                <label class="checkbox-inline">
                                <input type="checkbox" id="" value="1" name="biaoti"  class="zhida_chec"><span class="zhida_span">B+C</span>
                                </label>
                                <label class="checkbox-inline">
                                <input type="checkbox" id="" value="2" name="biaoti"   class="zhida_chec"><span class="zhida_span">C+D</span>
                                </label>
                                <label class="checkbox-inline">
                                <input type="checkbox" id="" value="3" name="biaoti"   class="zhida_chec"><span class="zhida_span">A+C</span>
                                </label>
                                <label class="checkbox-inline">
                                <input type="checkbox" id="" value="4" name="biaoti"  class="zhida_chec"><span class="zhida_span">A+B+C</span> 
                                </label>
                                <label class="checkbox-inline">
                                <input type="checkbox" id="" value="5" name="biaoti"  class="zhida_chec"><span class="zhida_span">A+C+D</span>
                                </label>
                                <label class="checkbox-inline">
                                <input type="checkbox" id="" value="6" name="biaoti"  class="zhida_chec"><span class="zhida_span">B+C+D</span>
                                </label>
                                <label class="checkbox-inline">
                                <input type="checkbox" id="" value="7" name="biaoti"  class="zhida_chec"><span class="zhida_span">A+B+C+D</span>
                                </label>
        
                        </div>
                      
                        <div class="zhida_az" style="width:100%;margin-top: 30px;text-align:center">
                           
                            <button type="button" class="btn btn-info font13" style="width:15%" onclick="baocun()">保&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;存</button>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
</div>
         
        <!--城市-->
        <div class="modal fade" id="myModalchengshi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="width:60%">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                        </button>
                        <h4 class="modal-title" id="myModalLabel">
                            选择区域
                        </h4>
                    </div>
                    <div class="modal-body">
                        <div class="test-div">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="guanbi">关闭
                        </button>
                        <button type="button" class="btn btn-primary btntest1" data-dismiss="modal">
                            确定
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!--城市结束-->
        
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
<script src="/static/admin/chengshi/jquery.min.js"></script>
<script src="/static/admin/chengshi/bootstrap.min.js"></script>
<script src="/static/admin/chengshi/RegionalChoice.js"></script>
<script type="text/javascript" charset="utf-8">
            $(function () {
            //------生成地区
            GetRegionPlug();
           
            //------选择后确定按钮
            $(".btntest1").click(function () {
                var areas = GetChecked().join(",");//已选择的城市名
              
                var diqu = $("#diqu").val();
                asr = $.trim(diqu);
                //去除最后的逗号
                var lastIndex = asr.lastIndexOf(',');
                if (lastIndex > -1) {
                   asr = asr.substring(0, lastIndex) + asr.substring(lastIndex + 1, asr.length);
                    }
                    asr = asr+','+areas;
                   
                $("#diqu").val(asr);
                // $("#areas").html(areas);//显示在页面
                // $("#selectedareas").val(areas);//存入隐藏的input
                 //$('#myModalchengshi').modal('hide');//完后隐藏模态框
                 //$("#guanbi").trigger("click");
        })
    })  
function crct(){
    
    value = '专业的,正规的,靠谱的,放心的,知名的,老牌的,有实力的,大型的,规模大的,口碑好的,好口碑的,性价比高的,平价的,服务好的,服务专业的,有名气的,名气大的,实惠的,好的,质量好的,价格低的,很好的,优质的,优良的,优惠的,省心的,齐全的,技术好的,应用多的,效果好的,稳定的,耐用的,好用的';
    $("#citou").val(value);
        
}
function crcw(){
    value = "公司,企业,厂,厂家,厂商,生产厂,生产厂家,公司推荐,工厂,工厂店,公司有哪些,收费标准,厂家报价,厂家定制,厂商定制,厂商销售,生产厂商,生产厂商定制,生产厂商销售,供应商,制造厂家,设计,设计方案,生产,供应,定做,定制,来图加工制作,专业定制,可定制加工,订做,订制,加工,加盟,有哪些,哪家好,哪家不错,哪家有名,哪家服务好,哪家质量好,哪家值得信赖,哪家专业,哪家靠谱,哪家合适,哪里好,哪里不错,哪里有名,哪里专业,哪里靠谱,哪里实惠,哪家正规,哪家实惠,哪个品牌好,哪好"
    $("#cwc").val(value);
}

function cycw(){
    value = "供应信息,厂家货源,接受定制,款式新颖,上门定制,金质服务,质优价廉,技术雄厚,品质保障,专业生,品质精良,精细到位,型号齐全,厂家订做,24小时服务,售后无忧,现货供应,大批量现货,批发采购,保质保量,型号齐全,质量上乘,以客为尊,产品展示,信誉保证,值得信赖,诚信互利,来电咨询.推荐咨询,欢迎来电,创造辉煌,铸造辉煌,信息推荐,服务至上,诚信经营,欢迎咨询,优质推荐,卓越服务,服务为先,薄利多销,质量过关,非标定制,口碑推荐,创新服务,感谢咨询,诚信服务,承诺守信,源头厂家,优质推荐,源头工厂"
    $("#cycw").val(value);
}

/*保存*/
function baocun(){
    //  layer.msg('请至少选择一种组合',{icon:2,time:1500,shade: 0.1,});
    //获取主词内容 
    var zc = $("#zc").val();
    //获取词头内容
    var citou = $("#citou").val();
    //获取地区内容
    var diqu = $("#diqu").val();
    //获取长尾词
    var cwc = $("#cwc").val();
    ////获取创意词尾
    var cycw  = $("#cycw").val();
     ci_name = $('input[name="ci_name"]').val();
     
   if(ci_name ==''){
       layer.msg('请填写优化名称',{icon:2,time:1500,shade: 0.1,});
       return false;
   }
     //去除换行符号 
     if(citou.indexOf("\\n") == -1){
        citou =   citou.replace(/[\r\n]/g,'');
     }
     if(zc.indexOf("\\n") == -1){
        zc =   zc.replace(/[\r\n]/g,'');
     }
     if(diqu.indexOf("\\n") == -1){
        diqu =   diqu.replace(/[\r\n]/g,'');
     }
     if(cwc.indexOf("\\n") == -1){
        cwc =   cwc.replace(/[\r\n]/g,'');
     }
     if(cycw.indexOf("\\n") == -1){
        cycw =   cycw.replace(/[\r\n]/g,'');
     }
   // pid = $('input[name=pid]').val();
    zuhe = '';
    $('input[name="biaoti"]:checked').each(function(){ 
        
        zuhe += $(this).val()+',';       
    });
    if(zuhe==''){
         layer.msg('请至少选择一种组合',{icon:2,time:1500,shade: 0.1,});
         return false;
    }
   
    reg1 = RegExp(/1/);reg2 = RegExp(/2/);reg3 = RegExp(/3/);reg4 = RegExp(/4/);reg5 = RegExp(/5/);reg6 = RegExp(/6/);
    reg7 = RegExp(/7/);
    if(reg1.exec(zuhe)){
        //判断主词和词头内容是否为空
       if(zc =='' || citou==''){
            layer.msg('主词和词头不能为空',{icon:2,time:1500,shade: 0.1,}); 
            return false;
       }
    }
    if(reg2.exec(zuhe)){
        //判断主词和长尾词内容是否为空
       if(zc =='' || cwc==''){
            layer.msg('主词和长尾词不能为空',{icon:2,time:1500,shade: 0.1,}); 
            return false;
       }
    }
    if(reg3.exec(zuhe)){
        //判断区域和主词内容是否为空
       if(diqu =='' || zc==''){
            layer.msg('主词和区域不能为空',{icon:2,time:1500,shade: 0.1,}); 
            return false;
       }
    }
    if(reg4.exec(zuhe)){
        //判断区域和主词内容是否为空
       if(diqu =='' || zc=='' || citou==''){
            layer.msg('主词和区域和词头不能为空',{icon:2,time:1500,shade: 0.1,}); 
            return false;
       }
    }
    if(reg5.exec(zuhe)){
        //判断区域和主词和长尾词内容是否为空
       if(diqu =='' || zc=='' || cwc==''){
            layer.msg('主词和区域和长尾词不能为空',{icon:2,time:1500,shade: 0.1,}); 
            return false;
       }
    }
    if(reg6.exec(zuhe)){
        //判断词头和主词和长尾词内容是否为空
       if(citou =='' || zc=='' || cwc==''){
            layer.msg('主词和词头和长尾词不能为空',{icon:2,time:1500,shade: 0.1,}); 
            return false;
       }
    }
    if(reg7.exec(zuhe)){
        //判断区域和词头和主词和长尾词内容是否为空
       if(citou =='' || zc=='' || cwc==''){
            layer.msg('区域和词头或主词或者长尾词不能为空',{icon:2,time:1500,shade: 0.1,}); 
            return false;
       }
    }
    //去除字符串最后得逗号
    var lastIndex = zuhe.lastIndexOf(',');
     
    if (lastIndex > -1) {
       zuhe = zuhe.substring(0, lastIndex) + zuhe.substring(lastIndex + 1, zuhe.length);
        }
    
    $.post('<?php echo url("ci_list"); ?>',
     {zc:zc,citou:citou,cwc:cwc,diqu:diqu,cycw:cycw,zuhe:zuhe,ci_name:ci_name},
    function(data){
        if(data.code==1){
              layer.msg('保存成功',{icon:1,time:1500,shade: 0.1,},function() {
                  window.location.href="/admin/video/cizu_list"
              });
        }else{
             layer.msg(data.msg,{icon:2,time:1500,shade: 0.1,});
        }
        
    })
    layer.close(index);
}

</script>
</body>
</html>






