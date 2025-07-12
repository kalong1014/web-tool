<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/login.html";i:1661220620;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="renderer" content="webkit"> 
    <title><?php echo $management['biaoti']; ?></title>
    <link href="__CSS__/bootstrap.min.css" rel="stylesheet">
    <link href="__CSS__/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="__CSS__/animate.min.css" rel="stylesheet">
    <link href="__CSS__/style.min.css" rel="stylesheet">
    <link href="__CSS__/login.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/static/admin/cssbutton/css/style.css">
    <script>
        if(window.top!==window.self){window.top.location=window.location};
    </script>
    <style>
        body{
            background-color: #282626;
        }
        .col-sm-7{
            width:100%!important;
        }
    </style>

</head>

<body class="">
    

<div style="position: fixed;height:  100%;bottom:  0;top: 0;left:  0;width:  100%;">
<div class="container" style="width:100%;height:100%">
    <div id="particles-js"></div>
</div>
<div class="signinpanel" style="width:30%;opacity: 0.9;left:35%;background:#333636;border-color:#333636;">
    <!--<div class="row">--> 
        <!--<div class="col-sm-5" style="padding-left:0">
            <div class="signin-info" style="background:Url(/static/admin/images/<?php echo $management['img']; ?>)no-repeat;background-size:100% 100%;height:100%;border-top-left-radius:15px;border-bottom-left-radius:15px">
                <div class="m-b" style="color:#fff;padding:15% 0 0 5%;font-size: 20px;"><strong><?php echo $management['fubiaoti']; ?></strong></div>
            </div>
        </div> -->
        <div class="col-sm-7">
            <form method="post" action="<?php echo Url('admin/index/index'); ?>" style="border-radius: 15px;background:#333636;">
                <div class="m-t-md" style="color:#000;margin:10% 0 13%;text-align:center">
                    <strong style="font-size: 26px;color: #fff;font-weight: bold;"><?php echo $management['biaoti']; ?></strong> 
                    <!--<div style="color: #fff;width: 120%;margin-left:-10%">如需使用、代理、购买源代码可联系:&nbsp;<?php echo $management['phone']; ?></div>-->
                </div>
                <div id="err_msg">
                    
                </div>
                <input type="text" class="form-control uname" placeholder="请输入用户名" id="username" />
                <input type="password" class="form-control pword" placeholder="请输入密码" id="password" />
                <div style="display:inline-block;height:initial;width: 100%;margin-top:10%">
                    <input type="text" class="form-control" placeholder="请输入验证码" style="color:black;width:65%;float:left;margin:0px 0px;" name="code" id="code"/>
                    <img src="<?php echo url('checkVerify'); ?>" onclick="javascript:this.src='<?php echo url('checkVerify'); ?>?tm='+Math.random();" style="width:35%;height:35px;float:right;cursor: pointer"/>
                </div>
                <button id="login_btn" type="button"  class="btn btn-success btn-block shiny" style="color:#fff;margin-left:0">登录</button>
                <!--<input class="btn btn-success btn-block" id="login_btn" readonly value="登录"/>-->
            </form>
        </div>
    <!--</div>-->
    <div class="signup-footer" style="color:#fff;">
        <div class="pull-left" style="text-align: center;width: 100%;margin-top: 8%;">
            <text><?php echo $management['dibu']; ?></text>
            <p>
                备案: <a href="https://www.beianx.cn/" style="color:#fff;"  target="view_window"><?php echo $management['beian']; ?></a> 
            </p>
        </div>

    </div>
</div>
</div>
<script src="__JS__/jquery.min.js?v=2.1.4"></script>
<script src="__JS__/bootstrap.min.js?v=3.3.6"></script>
<script src="__JS__/layer/layer.js"></script>
<script src="/static/admin/jqbg/js/particles.js"></script>
<script src="/static/admin/jqbg/js/app.js"></script>
<script type="text/javascript">
    document.onkeydown=function(event){
        var e = event || window.event || arguments.callee.caller.arguments[0];
        if(e && e.keyCode==13){ // enter 键
            $('#login_btn').click();
        }
    };
    var lock = false;
    $(function () {
        $('#login_btn').click(function(){
            if(lock){
                return;
            }
            lock = true;
            $('#err_msg').hide();
            $('#login_btn').removeClass('btn-success').addClass('btn-danger').val('登陆中...');
            var username = $('#username').val();
            var password = $('#password').val();
            var code = $('#code').val();
            $.post("<?php echo url('login/doLogin'); ?>",{'username':username, 'password':password, 'code':code},function(data){
                lock = false;
                $('#login_btn').val('登录').removeClass('btn-danger').addClass('btn-success');
                if(data.code!=1){
                    $('#err_msg').show().html("<span style='color:red'>"+data.msg+"</span>");
                    return;
                }else{
                    layer.msg('恭喜您，登录成功', {icon: 1,time:2000}, function(index){
                        window.location.href=data.data;
                    });
                }
            });
        });
    });
</script>
</body>
</html>