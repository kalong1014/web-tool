<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:89:"D:\php\xp\phpstudy_pro\WWW\chigua.cc\public/../application/admin\view\wz\conent\edit.html";i:1722083312;s:79:"D:\php\xp\phpstudy_pro\WWW\chigua.cc\application\admin\view\layout\default.html";i:1711598594;s:76:"D:\php\xp\phpstudy_pro\WWW\chigua.cc\application\admin\view\common\meta.html";i:1711598594;s:78:"D:\php\xp\phpstudy_pro\WWW\chigua.cc\application\admin\view\common\script.html";i:1711598594;}*/ ?>
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

    </head>

    <body class="inside-header inside-aside <?php echo defined('IS_DIALOG') && IS_DIALOG ? 'is-dialog' : ''; ?>">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section class="content-header hide">
                                <h1>
                                    <?php echo __('Dashboard'); ?>
                                    <small><?php echo __('Control panel'); ?></small>
                                </h1>
                            </section>
                            <?php if(!IS_DIALOG && !\think\Config::get('fastadmin.multiplenav') && \think\Config::get('fastadmin.breadcrumb')): ?>
                            <!-- RIBBON -->
                            <div id="ribbon">
                                <ol class="breadcrumb pull-left">
                                    <?php if($auth->check('dashboard')): ?>
                                    <li><a href="dashboard" class="addtabsit"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
                                    <?php endif; ?>
                                </ol>
                                <ol class="breadcrumb pull-right">
                                    <?php foreach($breadcrumb as $vo): ?>
                                    <li><a href="javascript:;" data-url="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a></li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                            <!-- END RIBBON -->
                            <?php endif; ?>
                            <div class="content">
                                <form id="edit-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Title'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-title" data-rule="required" class="form-control" name="row[title]" type="text" value="<?php echo htmlentities($row['title'] ?? ''); ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('B1_text'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-b1_text" data-rule="required" class="form-control" name="row[b1_text]" type="text" value="<?php echo htmlentities($row['b1_text'] ?? ''); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('B1_url'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-b1_url" data-rule="required" class="form-control" name="row[b1_url]" type="text" value="<?php echo htmlentities($row['b1_url'] ?? ''); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('B2_text'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-b2_text" data-rule="required" class="form-control" name="row[b2_text]" type="text" value="<?php echo htmlentities($row['b2_text'] ?? ''); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('B2_url'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-b2_url" data-rule="required" class="form-control" name="row[b2_url]" type="text" value="<?php echo htmlentities($row['b2_url'] ?? ''); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('B3_text'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-b3_text" data-rule="required" class="form-control" name="row[b3_text]" type="text" value="<?php echo htmlentities($row['b3_text'] ?? ''); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('B3_url'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-b3_url" data-rule="required" class="form-control" name="row[b3_url]" type="text" value="<?php echo htmlentities($row['b3_url'] ?? ''); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Pwd'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-pwd" data-rule="required" class="form-control" name="row[pwd]" type="text" value="<?php echo htmlentities($row['pwd'] ?? ''); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Wz_nr'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-wz_nr" data-rule="required" class="form-control editor" rows="5" name="row[wz_nr]" cols="50"><?php echo htmlentities($row['wz_nr'] ?? ''); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Sort'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-sort" data-rule="required" class="form-control" name="row[sort]" type="number" value="<?php echo htmlentities($row['sort'] ?? ''); ?>">
        </div>
    </div>
    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <button type="submit" class="btn btn-primary btn-embossed disabled"><?php echo __('OK'); ?></button>
        </div>
    </div>
</form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo htmlentities($site['version'] ?? ''); ?>"></script>
    </body>
</html>
