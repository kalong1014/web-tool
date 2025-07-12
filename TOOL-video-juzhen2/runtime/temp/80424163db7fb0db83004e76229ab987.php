<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:91:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/user/upgrade_log.html";i:1660125746;}*/ ?>
<html>
  	<head>
    	<meta name="wechat-enable-text-zoom-em" content="true">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>更新日志</title>
		<meta name="description" content="">
		<meta name="keywords" content="">
		<style>
			body{
		    background-color:#2b2b2e !important;font-family: !important;}
		    .position-absolute{
		    	position: absolute;
		    }
		    .position-relative{
		    	position: relative;
		    }
		    .log-go a{text-decoration:none;    color: #fff!important;}
		    .log-go{
    text-align: center;
    width: 108px;
    height: 38px;
    line-height: 38px;
    background: #ff7752;
    border-radius: 3px;
    font-size: 16px;
		    }
			.log_list_pag {
			    max-width: 1170px;margin:0 auto;
			}
			.log-body{
				padding-left: 3rem!important;flex: 0 0 75%;max-width: 75%;box-sizing: border-box;
			}
			.pl{
				padding: 1.5rem;list-style: none;
			}
			.xian{width: 1px;height: 100%;background: #ecebeb;position: absolute;left: 0;top: 0;
			}
			.text-muted{
				    padding: .25rem;left: -124px;top: 25px;color: #d6d6d6;font-size: 1rem
			}
			.rounded-circle{
				padding: .25rem;color: #26b1e7;left: -11px;top: 5px;font-size: 65px;
			}
			font.h5{
				font-size: 20px;color: #d9d9d9;
			}
			.log-oya{
				padding: 1rem;margin-top:1rem;margin-left:0;position: relative;display: -ms-flexbox;display: flex;-ms-flex-direction: column;flex-direction: column;min-width: 0;word-wrap: break-word;background-clip: border-box;border: 1px solid #3e4040;border-radius: .25rem;
			}
			.log-editor{
				max-height: 300px;font-size: 14px;color: #6c757d;width: 100%;max-width: 100%;line-height: 1.8;word-wrap: break-word;    overflow: auto;
			}
		</style>
	</head>

	<body>
		<div class="log-go">
			<a href="<?php echo url('index/index'); ?>">返&nbsp;&nbsp;回</a>
		</div>
		<main class="log_list_pag">
			<div class="log-body">
			    <ul class="log-list ">
			         <?php if(is_array($rest) || $rest instanceof \think\Collection): if( count($rest)==0 ) : echo "" ;else: foreach($rest as $key=>$vo): ?>
			        <li class="position-relative pl">
			        	<div class="xian"></div>
			            <h3 class="position-absolute text-muted"><?php echo $vo['banbentime']; ?></h3>
			            <span class="rounded-circle position-absolute">·</span>
			            <dl class="mb-0">
			                <dt><font class="h5"><?php echo $vo['banbenhao']; ?></font></dt>
			                <dd class="log-oya log-scrollbar">
			                    <div class="log-editor">
			                        <?php echo $vo['banbencount']; ?>
			                     		<!--新增静态页生成规则<br/>-->
			                     		<!--新增定时更新静态页功能<br/>-->
			                     		<!--互动模块（留言、反馈等）增加编辑《个人信息隐私政策》（或类似声明）功能<br/>-->
			                     		<!--新增静态页生成规则<br/>-->
			                    </div>
			                </dd>
			            </dl>
			        </li>
                     <?php endforeach; endif; else: echo "" ;endif; ?>
			        <!--<li class="position-relative pl">-->
			        <!--	<div class="xian"></div>-->
			        <!--    <h3 class="position-absolute text-muted">2022.3.28</h3>-->
			        <!--    <span class="rounded-circle position-absolute">·</span>-->
			        <!--    <dl class="mb-0">-->
			        <!--        <dt><font class="h5">MetInfo 7.6 更新日志</font></dt>-->
			        <!--        <dd class="log-oya log-scrollbar">-->
			        <!--            <div class="log-editor">-->
			        <!--             		新增静态页生成规则<br/>-->
			        <!--             		新增定时更新静态页功能<br/>-->
			        <!--             		互动模块（留言、反馈等）增加编辑《个人信息隐私政策》（或类似声明）功能<br/>-->
			        <!--             		新增静态页生成规则<br/>-->
			        <!--             		新增定时更新静态页功能<br/>-->
			        <!--             		互动模块（留言、反馈等）增加编辑《个人信息隐私政策》（或类似声明）功能<br/>新增静态页生成规则<br/>-->
			        <!--             		新增定时更新静态页功能<br/>-->
			        <!--             		互动模块（留言、反馈等）增加编辑《个人信息隐私政策》（或类似声明）功能<br/>新增静态页生成规则<br/>-->
			        <!--             		新增定时更新静态页功能<br/>互动模块（留言、反馈等）增加编辑《个人信息隐私政策》（或类似声明）功能<br/>新增静态页生成规则<br/>-->
			        <!--             		新增定时更新静态页功能<br/>-->
			        <!--            </div>-->
			        <!--        </dd>-->
			        <!--    </dl>-->
			        <!--</li>-->
			   	</ul>
		    </div>
		</main>

	</body>
</html>