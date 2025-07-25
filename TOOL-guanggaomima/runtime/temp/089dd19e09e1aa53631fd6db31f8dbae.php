<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:73:"/www/wwwroot/cg.2sb.top/public/../application/admin/view/index/login.html";i:1711598594;s:63:"/www/wwwroot/cg.2sb.top/application/admin/view/common/meta.html";i:1711598594;s:65:"/www/wwwroot/cg.2sb.top/application/admin/view/common/script.html";i:1711598594;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">
<meta name="referrer" content="never">
<meta name="robots" content="noindex, nofollow">

<link rel="shortcut icon" href="/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<?php if(\think\Config::get('fastadmin.adminskin')): ?>
<link href="/assets/css/skins/<?php echo \think\Config::get('fastadmin.adminskin'); ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">
<?php endif; ?>

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/assets/js/html5shiv.js"></script>
  <script src="/assets/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
    var require = {
        config:  <?php echo json_encode($config ?? ''); ?>
    };
</script>


    <style type="text/css">
        body {
            color: #999;
            background-color: #f1f4fd;
            background-size: cover;
        }

        a {
            color: #444;
        }


        .login-screen {
            max-width: 430px;
            padding: 0;
            margin: 100px auto 0 auto;

        }

        .login-screen .well {
            border-radius: 3px;
            -webkit-box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
            background: rgba(255, 255, 255, 1);
            border: none;
            /*overflow: hidden;*/
            padding: 0;
        }

        @media (max-width: 767px) {
            .login-screen {
                padding: 0 20px;
            }
        }

        .profile-img-card {
            width: 100px;
            height: 100px;
            display: block;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border-radius: 50%;
            margin: -93px auto 30px;
            border: 5px solid #fff;
        }

        .profile-name-card {
            text-align: center;
        }

        .login-head {
            background: #899fe1;
            border-radius: 3px 3px 0 0;
        }

        .login-form {
            padding: 40px 30px;
            position: relative;
            z-index: 99;
        }

        #login-form {
            margin-top: 20px;
        }

        #login-form .input-group {
            margin-bottom: 15px;
        }

        #login-form .form-control {
            font-size: 13px;
        }

    </style>
    <!--@formatter:off-->
    <?php if($background): ?>
        <style type="text/css">
            body{
                background-image: url('<?php echo $background; ?>');
            }
        </style>
    <?php endif; ?>
    <!--@formatter:on-->
</head>
<body>
<div class="container">
    <div class="login-wrapper">
        <div class="login-screen">
            <div class="well">
                <div class="login-head">
                    <img src="/assets/img/login-head.png" style="width:100%;"/>
                </div>
                <div class="login-form">
                    <img id="profile-img" class="profile-img-card" src="/assets/img/avatar.png"/>
                    <p id="profile-name" class="profile-name-card"></p>

                    <form action="" method="post" id="login-form">
                        <!--@AdminLoginFormBegin-->
                        <div id="errtips" class="hide"></div>
                        <?php echo token(); ?>
                        <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
                            <input type="text" class="form-control" id="pd-form-username" placeholder="<?php echo __('Username'); ?>" name="username" autocomplete="off" value="" data-rule="<?php echo __('Username'); ?>:required;username"/>
                        </div>

                        <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></div>
                            <input type="password" class="form-control" id="pd-form-password" placeholder="<?php echo __('Password'); ?>" name="password" autocomplete="off" value="" data-rule="<?php echo __('Password'); ?>:required;password"/>
                        </div>
                        <!--@CaptchaBegin-->
                        <?php if(\think\Config::get('fastadmin.login_captcha')): ?>
                        <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"></span></div>
                            <input type="text" name="captcha" class="form-control" placeholder="<?php echo __('Captcha'); ?>" data-rule="<?php echo __('Captcha'); ?>:required;length(<?php echo \think\Config::get('captcha.length'); ?>)" autocomplete="off"/>
                            <span class="input-group-addon" style="padding:0;border:none;cursor:pointer;">
                                    <img src="<?php echo rtrim('/', '/'); ?>/index.php?s=/captcha" width="100" height="30" onclick="this.src = '<?php echo rtrim('/', '/'); ?>/index.php?s=/captcha&r=' + Math.random();"/>
                            </span>
                        </div>
                        <?php endif; ?>
                        <!--@CaptchaEnd-->
                        <?php if($keeyloginhours>0): ?>
                        <div class="form-group checkbox">
                            <label class="inline" for="keeplogin" data-toggle="tooltip" title="<?php echo __('The duration of the session is %s hours', $keeyloginhours); ?>">
                                <input type="checkbox" name="keeplogin" id="keeplogin" value="1"/>
                                <?php echo __('Keep login'); ?>
                            </label>
                        </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-lg btn-block" style="background:#708eea;"><?php echo __('Sign in'); ?></button>
                        </div>
                        <!--@AdminLoginFormEnd-->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo htmlentities($site['version'] ?? ''); ?>"></script>
</body>
</html>
