<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:86:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/index/index.html";i:1667823293;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/header.html";i:1660125746;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/footer.html";i:1660125746;}*/ ?>
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
<style data-for="result" id="css_result" type="text/css">
    
</style>
<link href="/static/admin/css/style66.css" rel="stylesheet">
<link href="/static/admin/css/style2.css" rel="stylesheet">
<link href="__CSS__/people.css" rel="stylesheet">
<link href="__CSS__/total.css" rel="stylesheet" >

<body class="gray-bg">
<div class="wrapper wrapper-content">
    <div class="admin-con">
        <div class="block-box">
            
            <!--第一行数据-->
            <div class="col-3">
                <!-- 卡片盒子 -->
                <div class="block card-group">
                    <!-- 卡片信息 -->
                    <div class="card-info">
                        <span class="tips">
                            账号总数
                        </span>
                        <div class="num-or-price">
                            <span><?php echo $total_number; ?></span>
                        </div>
                    </div>
                    <canvas id="line2" width="153" height="90" style="width: 40%; height: 80px; display: block; box-sizing: border-box;"></canvas>
                </div>
            </div>
            <div class="col-3">
                <!-- 卡片盒子 -->
                <div class="block card-group">
                    <!-- 卡片信息 -->
                    <div class="card-info">
                        <span class="tips">
                            总播放
                        </span>
                        <div class="num-or-price">
                            <span><?php echo $play; ?></span>
                        </div>
                    </div>
                    <canvas id="line2" width="153" height="90" style="width: 40%; height: 80px; display: block; box-sizing: border-box;"></canvas>
                </div>
            </div>
            <div class="col-3">
                <!-- 卡片盒子 -->
                <div class="block card-group">
                    <!-- 卡片信息 -->
                    <div class="card-info">
                        <span class="tips">
                            视频总点赞
                        </span>
                        <div class="num-or-price">
                            <span><?php echo $digg_count; ?></span>
                        </div>
                    </div>
                    <canvas id="line2" width="153" height="90" style="width: 40%; height: 80px; display: block; box-sizing: border-box;"></canvas>
                </div>
            </div>
            <div class="col-3">
                <!-- 卡片盒子 -->
                <div class="block card-group">
                    <!-- 卡片信息 -->
                    <div class="card-info">
                        <span class="tips">
                            总充值
                        </span>
                        <div class="num-or-price">
                            <span><?php echo !empty($recharge)?$recharge:'0'; ?></span>
                        </div>
                    </div>
                    <canvas id="line2" width="153" height="90" style="width: 40%; height: 80px; display: block; box-sizing: border-box;"></canvas>
                </div>
            </div>
            <div class="col-3">
                <!-- 卡片盒子 -->
                <div class="block card-group">
                    <!-- 卡片信息 -->
                    <div class="card-info">
                        <span class="tips">
                            今日消耗
                        </span>
                        <div class="num-or-price">
                            <span><?php echo !empty($consume)?$consume:'0'; ?></span>
                        </div>
                    </div>
                    <canvas id="line2" width="153" height="90" style="width: 40%; height: 80px; display: block; box-sizing: border-box;"></canvas>
                </div>
            </div>
            
            
            <!--第二行数据-->
            <div class="col-25">
                <!-- 卡片盒子 -->
                <div class="block card-group">
                    <div class="boxnav" id="echart4" style="width:100%;height:100%;">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <!-- 卡片盒子 -->
                <div class="block card-group" style="padding:0;background:#0e1222">
                    <div class="main" style="width:100%;">
                        <div class="animate" style="width:100%;">
                            <div class="float">
                                <div class="floating1">
                                    <div id="roate1">
                                        <div class="roate-item">
                                            <p><?php echo $total_number; ?></p>
                                            <span>总帐号</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="floating2">
                                    <div id="roate2">
                                        <div class="roate-item2">
                                            <p><?php echo $play; ?></p>
                                            <span>总播放</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="floating3">
                                    <div id="roate3">
                                        <div class="roate-item3">
                                            <p><?php echo $clips_coun; ?></p>
                                            <span>剪辑数量</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="floating4">
                                    <div id="roate4">
                                        <div class="roate-item4">
                                            <p><?php echo $task_coun; ?></p>
                                            <span>发布数</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="floating5">
                                    <div id="roate5">
                                        <div class="roate-item5">
                                            <p><?php echo $customer; ?></p>
                                            <span>客户数</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sum">
                                <div class="data">
                                    <!--<p>总销售额</p>-->
                                    <!--<span>2621526</span>-->
                                    <!--<img src="/static/admin/images/6f4eb68a8a5012bf4510e633d805667a.png" style="width:8.5rem;margin-top:2rem">-->
                                </div>
                                <div class="cicle1"></div>
                                <canvas id="canvas1"></canvas>
                                <canvas id="canvas2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-25">
                <!-- 卡片盒子 -->
                <div class="block">
                    <h4>
                        数据统计
                    </h4>
                    <div class="card-data">
                        <div class="col-6">
                            <div>
                                <span class="tips">
                                    总充值
                                </span>
                                <span class="num color-green">
                                    <?php echo !empty($recharge)?$recharge:'0'; ?>
                                </span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <span class="tips">
                                    剩余积分
                                </span>
                                <span class="num color-red">
                                   <?php echo $jifen; ?>
                                </span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <span class="tips">
                                    总客户数
                                </span>
                                <span class="num color-blue">
                                   <?php echo $customer; ?>
                                </span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <span class="tips">
                                    本周客户数
                                </span>
                                <span class="num color-yellow">
                                    <?php echo $this_week; ?>
                                </span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <span class="tips">
                                    总互动数
                                </span>
                                <span class="num color-purple">
                                    <?php echo $last_coun; ?>
                                </span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <span class="tips">
                                    本周互动数
                                </span>
                                <span class="num color-pink">
                                    <?php echo $last_this_week; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--第三行数据-->
            <div class="col-12">
                <div class="">
                    <div class="bottom">
                        <div class="ul-box">
                            <ul>
                                <li>
                                    <div class="block card-group2 data-bg-green">
                                        <div class="card-info">
                                            <!--<span class="tips">-->
                                            <!--    企业号授权-->
                                            <!--</span>-->
                                            <div class="num-or-price flex">
                                                <div class="col-4">
                                                    企业号授权
                                                </div>
                                                <div class="col-4">
                                                    <p>总数:<?php echo $enterprise; ?></p>
                                                    <!--<p>21</p>-->
                                                </div>
                                                <div class="col-4">
                                                    <p>禁用:<?php echo $enterprise_st; ?></p>
                                                    <!--<p>179</p>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="block card-group2 data-bg-red">
                                        <div class="card-info">
                                            <!--<span class="tips">-->
                                            <!--    普通号授权-->
                                            <!--</span>-->
                                            <div class="num-or-price flex">
                                                <div class="col-4">
                                                    普通号授权
                                                </div>
                                                <div class="col-4">
                                                    <p>总数:<?php echo $total_number; ?></p>
                                                    <!--<p>21</p>-->
                                                </div>
                                                <div class="col-4">
                                                    <p>禁用:<?php echo $total_number_st; ?></p>
                                                    <!--<p>179</p>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="block card-group2 data-bg-blue">
                                        <div class="card-info">
                                            <!--<span class="tips">-->
                                            <!--    剪辑视频-->
                                            <!--</span>-->
                                            <div class="num-or-price flex">
                                                <div class="col-4">
                                                    剪辑视频
                                                </div>
                                                <div class="col-4">
                                                    <p>已用:<?php echo $task_coun_typ; ?></p>
                                                    <!--<p>21</p>-->
                                                </div>
                                                <div class="col-4">
                                                    <p>剩余:<?php echo $task_coun_lst; ?></p>
                                                    <!--<p>179</p>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="block card-group2 data-bg-ffc126">
                                        <div class="card-info">
                                            <!--<span class="tips">-->
                                            <!--    视频-->
                                            <!--</span>-->
                                            <div class="num-or-price flex">
                                                <div class="col-4">
                                                    视频
                                                </div>
                                                <div class="col-4">
                                                    <p>已用:<?php echo $task_coun; ?></p>
                                                    <!--<p>21</p>-->
                                                </div>
                                                <div class="col-4">
                                                    <p>剩余:<?php echo $video_last; ?></p>
                                                    <!--<p>179</p>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="block card-group2 data-bg-8548ff">
                                        <div class="card-info">
                                            <!--<span class="tips">-->
                                            <!--    关键词数组-->
                                            <!--</span>-->
                                            <div class="num-or-price flex">
                                                <div class="col-4">
                                                    关键词数组
                                                </div>
                                                <div class="col-4">
                                                    <p>总数:<?php echo $keywords; ?></p>
                                                    <!--<p>21</p>-->
                                                </div>
                                                <div class="col-4">
                                                    <p>查询次数:<?php echo $search_count; ?></p>
                                                    <!--<p>179</p>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="block card-group2 data-bg-fc3ca9">
                                        <div class="card-info">
                                            <!--<span class="tips">-->
                                            <!--    排名达标数-->
                                            <!--</span>-->
                                            <div class="num-or-price flex">
                                                <div class="col-4">
                                                    排名达标数
                                                </div>
                                                <div class="col-4">
                                                    <p>达标总数:<?php echo $keywords_log; ?></p>
                                                    <!--<p>21</p>-->
                                                </div>
                                                <div class="col-4">
                                                    <p>未达标总数:<?php echo $keywords_log_out; ?></p>
                                                    <!--<p>179</p>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
<!--            <div class="col-2">-->
<!--                <div class="block card-group2 data-bg-green">-->
<!--                    <div class="card-info">-->
<!--                        <span class="tips">-->
<!--                            企业号授权-->
<!--                        </span>-->
<!--                        <div class="num-or-price flex">-->
<!--                            <div class="col-6">-->
<!--                                <p>已用</p>-->
<!--                                <p>1890</p>-->
<!--                            </div>-->
<!--                            <div class="col-6">-->
<!--                                <p>剩余</p>-->
<!--                                <p>530</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-2">-->
<!--                <div class="block card-group2 data-bg-red">-->
<!--                    <div class="card-info">-->
<!--                        <span class="tips">-->
<!--                            普通号授权-->
<!--                        </span>-->
<!--                        <div class="num-or-price flex">-->
<!--                            <div class="col-6">-->
<!--                                <p>已用</p>-->
<!--                                <p>0</p>-->
<!--                            </div>-->
<!--                            <div class="col-6">-->
<!--                                <p>剩余</p>-->
<!--                                <p>0</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-2">-->
<!--                <div class="block card-group2 data-bg-blue">-->
<!--                    <div class="card-info">-->
<!--                        <span class="tips">-->
<!--                            剪辑视频-->
<!--                        </span>-->
<!--                        <div class="num-or-price flex">-->
<!--                            <div class="col-6">-->
<!--                                <p>已用</p>-->
<!--                                <p>0</p>-->
<!--                            </div>-->
<!--                            <div class="col-6">-->
<!--                                <p>剩余</p>-->
<!--                                <p>0</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-2">-->
<!--                <div class="block card-group2 data-bg-ffc126">-->
<!--                    <div class="card-info">-->
<!--                        <span class="tips">-->
<!--                            视频-->
<!--                        </span>-->
<!--                        <div class="num-or-price flex">-->
<!--                            <div class="col-6">-->
<!--                                <p>已用</p>-->
<!--                                <p>0</p>-->
<!--                            </div>-->
<!--                            <div class="col-6">-->
<!--                                <p>剩余</p>-->
<!--                                <p>0</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-2">-->
<!--                <div class="block card-group2 data-bg-8548ff">-->
<!--                    <div class="card-info">-->
<!--                        <span class="tips">-->
<!--                            关键词数组-->
<!--                        </span>-->
<!--                        <div class="num-or-price flex">-->
<!--                            <div class="col-6">-->
<!--                                <p>已用</p>-->
<!--                                <p>0</p>-->
<!--                            </div>-->
<!--                            <div class="col-6">-->
<!--                                <p>剩余</p>-->
<!--                                <p>0</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-2">-->
<!--                <div class="block card-group2 data-bg-fc3ca9">-->
<!--                    <div class="card-info">-->
<!--                        <span class="tips">-->
<!--                            排名达标数-->
<!--                        </span>-->
<!--                        <div class="num-or-price flex">-->
<!--                            <div class="col-6">-->
<!--                                <p>已用</p>-->
<!--                                <p>0</p>-->
<!--                            </div>-->
<!--                            <div class="col-6">-->
<!--                                <p>剩余</p>-->
<!--                                <p>0</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
            
            <!--第四行数据-->
            <div class="col-12">
                <div class="block flex">
                    <div class="col-7 tool-box-l">
                        <div class="tool-box-tit">
                            <img src="__IMG__/index-link-1.png">
                            内容创作
                        </div>
                        <div class="tool-box-list flex">
                            <div class="_KmoasPL8">
                                视频制作
                            </div>
                            <div class="tool-box-con-box">
                                <div class="tool-box-con">
                                    <a rel="noopener noreferrer" href="https://lv.ulikecam.com/" target="_blank">
                                        <!--<img src="__IMG__/jianying.png">-->
                                        <span>剪映</span>
                                    </a>
                                </div>
                                <div class="tool-box-con">
                                    <a rel="noopener noreferrer" href="https://cc.oceanengine.com/creative-factory/jishi/0" target="_blank">
                                        <!--<img src="__IMG__/jianying.png">-->
                                        <span>模板视频</span>
                                    </a>
                                </div>
                                <div class="tool-box-con">
                                    <a rel="noopener noreferrer" href="http://kuai.360.cn/home.html" target="_blank">
                                        <!--<img src="__IMG__/jianying.png">-->
                                        <span>快剪辑</span>
                                    </a>
                                </div>
                                <div class="tool-box-con">
                                    <a rel="noopener noreferrer" href="https://www.shencut.com/" target="_blank">
                                        <!--<img src="__IMG__/jianying.png">-->
                                        <span>喵影工厂</span>
                                    </a>
                                </div>
                                <div class="tool-box-con">
                                    <a rel="noopener noreferrer" href="https://cc.oceanengine.com/creative-factory/jishi/4" target="_blank">
                                        <!--<img src="__IMG__/jianying.png">-->
                                        <span>微电影</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="tool-box-list flex">
                            <div class="_KmoasPL8">
                                图片制作
                            </div>
                            <div class="tool-box-con-box">
                                <div class="tool-box-con">
                                    <a rel="noopener noreferrer" href="https://cc.oceanengine.com/creative-factory/tuling/10" target="_blank">
                                        <!--<img src="__IMG__/jianying.png">-->
                                        <span>模板制图</span>
                                    </a>
                                </div>
                                <div class="tool-box-con">
                                    <a rel="noopener noreferrer" href="https://cc.oceanengine.com/creative-factory/tuling/12" target="_blank">
                                        <!--<img src="__IMG__/jianying.png">-->
                                        <span>批量制图</span>
                                    </a>
                                </div>
                                <div class="tool-box-con">
                                    <a rel="noopener noreferrer" href="https://cc.oceanengine.com/creative-factory/tuling/11" target="_blank">
                                        <!--<img src="__IMG__/jianying.png">-->
                                        <span>一键抠图</span>
                                    </a>
                                </div>
                                <div class="tool-box-con">
                                    <a rel="noopener noreferrer" href="https://cc.oceanengine.com/creative-factory/tuling/15" target="_blank">
                                        <!--<img src="__IMG__/jianying.png">-->
                                        <span>手动制图</span>
                                    </a>
                                </div>
                                <div class="tool-box-con">
                                    <a rel="noopener noreferrer" href="https://www.chuangkit.com/" target="_blank">
                                        <!--<img src="__IMG__/jianying.png">-->
                                        <span>创客贴</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="tool-box-list flex">
                            <div class="_KmoasPL8">
                                实用工具
                            </div>
                            <div class="tool-box-con-box">
                                <div class="tool-box-con">
                                    <a rel="noopener noreferrer" href="https://www.apowersoft.cn/free-online-screen-recorder" target="_blank">
                                        <!--<img src="__IMG__/jianying.png">-->
                                        <span>powersoft在线录屏</span>
                                    </a>
                                </div>
                                <div class="tool-box-con">
                                    <a rel="noopener noreferrer" href="https://cc.oceanengine.com/creative-factory/miaobi" target="_blank">
                                        <!--<img src="__IMG__/jianying.png">-->
                                        <span>标题推荐</span>
                                    </a>
                                </div>
                                <div class="tool-box-con">
                                    <a rel="noopener noreferrer" href="https://cc.oceanengine.com/creative-factory/jishi/2" target="_blank">
                                        <!--<img src="__IMG__/jianying.png">-->
                                        <span>视频配乐</span>
                                    </a>
                                </div>
                                <div class="tool-box-con">
                                    <a rel="noopener noreferrer" href="https://cc.oceanengine.com/creative-factory/ai/14" target="_blank">
                                        <!--<img src="__IMG__/jianying.png">-->
                                        <span>图片微动</span>
                                    </a>
                                </div>
                                <div class="tool-box-con">
                                    <a rel="noopener noreferrer" href="https://cc.oceanengine.com/creative-factory/subtitle" target="_blank">
                                        <!--<img src="__IMG__/jianying.png">-->
                                        <span>语音转字幕</span>
                                    </a>
                                </div>
                                <div class="tool-box-con">
                                    <a rel="noopener noreferrer" href="https://cc.oceanengine.com/creative-factory/ai-dubbing" target="_blank">
                                        <!--<img src="__IMG__/jianying.png">-->
                                        <span>AI配音</span>
                                    </a>
                                </div>
                                <div class="tool-box-con">
                                    <a rel="noopener noreferrer" href="https://cc.oceanengine.com/creative-factory/program-creative-package?source=0" target="_blank">
                                        <!--<img src="__IMG__/jianying.png">-->
                                        <span>程序化创意包</span>
                                    </a>
                                </div>
                                <div class="tool-box-con">
                                    <a rel="noopener noreferrer" href="https://taicibao.com/?channel=newrank" target="_blank">
                                        <!--<img src="__IMG__/jianying.png">-->
                                        <span>手机自拍提词器</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="tool-box-tit m-t-lg">
                            <img src="__IMG__/index-link-2.png">
                            运营变现
                        </div>
                        <div class="tool-box-list flex">
                            <div class="_KmoasPL8">
                                广告营销
                            </div>
                            <div class="tool-box-con-box">
                                <div class="col-12 tool-box-con">
                                    <div class="_PX89QzzQ" onclick="javascript:ewm()">
                                        <!--<img src="/static/admin/images/jianying.png">-->
                                        百度<span>-360-搜狗-广告投放平台</span>
                                    </div>
                                </div>
                                <div class="col-12 tool-box-con">
                                    <div class="_PX89QzzQ" onclick="javascript:ewm()">
                                        <!--<img src="/static/admin/images/jianying.png">-->
                                        巨量引擎<span class="_aAzLy2Ia">-官方广告投放平台</span>
                                    </div>
                                </div>
                                <div class="col-12 tool-box-con">
                                    <div class="_PX89QzzQ" onclick="javascript:ewm()">
                                        <!--<img src="/static/admin/images/jianying.png">-->
                                        朋友圈<span class="_aAzLy2Ia">-附近推-小红书-官方投放</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-5 tool-box-r">
                        <div class="tool-box-tit">
                            <img src="__IMG__/index-link-2.png">
                            系统公告
                        </div>

                        <?php if(is_array($notice) || $notice instanceof \think\Collection): if( count($notice)==0 ) : echo "" ;else: foreach($notice as $key=>$vo): ?>
                        <div class="tool-box-list flex notice-con notice-click" data-title="<?php echo $vo['title']; ?>" data-text="<?php echo $vo['text']; ?>">
                            <div class="_KmoasPL8">
                                <?php echo date('Y-m-d',$vo['addtime']); ?>
                            </div>
                            <div class="tool-box-con-box">
                                <div class="col-12 tool-box-con notice">
                                    <?php echo $vo['title']; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        <!--<div class="tool-box-list flex notice-con">-->
                        <!--    <div class="_KmoasPL8">-->
                        <!--        2022-09-28-->
                        <!--    </div>-->
                        <!--    <div class="tool-box-con-box">-->
                        <!--        <div class="col-12 tool-box-con notice">-->
                        <!--            我上线上线上线上线上线上线啦-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                    </div>
                </div>
            </div>
            
            
            
        </div>

    </div>
    
    
    
    <div class="index-foot block-box">
        <div class="_Th2KN6lH _ruHhaXhy flex">
            <div class="col-8">
                <div class="block">
                  <div class=" flex">
                    <div class="_6ycQ4EHN">
                        <div class="_UTBMvBTd">
                          <div class="_12KQ5drD">
                           更多系统
                          </div>
                           <?php if(is_array($gdxt) || $gdxt instanceof \think\Collection): if( count($gdxt)==0 ) : echo "" ;else: foreach($gdxt as $key=>$vo): ?>
                          <a class="_dl5r7+9x _SnfzoUNz" href="<?php echo $vo['url']; ?>" target="_blank">
                             
                              <span class="_yoDD6kvv font13"><?php echo $vo['title']; ?></span>
                              <!--<span class="_cO4V1cE-"><?php echo $vo['ftitle']; ?></span>-->
                          </a>
                           <?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </div>
                        
                    <div class="_N71DZSDo">
                        <div class="_UTBMvBTd">
                          <div class="_12KQ5drD">
                           关于
                          </div>
                          <?php if(is_array($guwm) || $guwm instanceof \think\Collection): if( count($guwm)==0 ) : echo "" ;else: foreach($guwm as $key=>$vo): ?>
                            <a class="_dl5r7+9x _SnfzoUNz" target="_blank" rel="noopener noreferrer" href="<?php echo !empty($vo['url'])?$vo['url']:''; ?>"><?php echo $vo['title']; ?></a>
                          <?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </div>
                        
                    <div class="_mAiMfG19">
                                 
                        <?php if($user['jibie']==0): ?>   
                        <div class="_f8bNF33b">
                            版权信息
                        </div>
                              
                        <ul class="_XtTTn93z">
                                <li class="_JIsNnfgz" id="phone"></li>
                               <li class="_JIsNnfgz" id="xtmc"></li>
                               <li class="_JIsNnfgz" id="bat"></li>
                               <li class="_JIsNnfgz">升级日志：<a href="/admin/user/upgrade_log.html" target="_blank" style="color:red">点击查看</a></li>
                        </ul>
                        <?php else: endif; ?>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-4">
                <div class="block">
                    <div class="_F5uge-P2">
                     <div class="_Z4WWg-nj">
                         
                      <img src="/static/admin/images/<?php echo $gzh['img']; ?>" alt="" />
                      <span><?php echo $gzh['title']; ?></span>
                     </div>
                     
                     <div class="_Z4WWg-nj">
                      <img src="/static/admin/images/<?php echo $kefu['img']; ?>" alt="" />
                      <span><?php echo $kefu['title']; ?></span>
                     </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<input type="hidden" name="jiebie_id"  value="<?php echo $user['jibie']; ?>" />
<div style="width:100%;height:20px; text-align:center" id="dibubanquanxinxi">
    <p style="margin-top:20px"><?php echo $management['dibu']; ?></p>
</div>


<!-- 二维码提示框 -->
 <div class="modal  fade" id="ewm-open" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" style="width:20%;margin-top: 15%;">
        <div class="modal-content" style="width:100%;padding-bottom: 20px;">
            <div class="modal-header" style="border:0">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" style="text-align:center">更多详细信息请联系客服</h4>  
            </div>

            <div class="form-group" style="margin-top: 20px;text-align:center">
                <img src="/static/admin/images/<?php echo $kefu['img']; ?>" style="width:80%">
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
<script src="https://cdn.bootcdn.net/ajax/libs/echarts/5.3.3/echarts.js"></script>
<script src="/static/admin/js/jquery.leoweather.min.js"></script>
    <script>
        $(".notice-click").click(function() {
            var title = $(this).attr('data-title')
            var text = $(this).attr('data-text')
            layer.open({
                type: 1,
                title: title,
                skin: 'layui-layer-lan', //加上边框
                area: ['40%', '50%'],
                anim: 2,
                content: text
            });
        })
    </script>
<script type="text/javascript">
    var myChart = echarts.init(document.getElementById('echart4'));
    option = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            }
        },
        legend: {
            data: ['视频数量', '发布数量'],
            top:'2%',
            textStyle: {
                color: "rgba(255,255,255,.5)",
                fontSize: '12',

            },
            itemWidth: 12,
            itemHeight: 12,
            //itemGap: 35
        },
        grid: {
            left: '0%',
            top:'40px',
            right: '0%',
            bottom: '0%',
            containLabel: true
        },
        xAxis: [{
            type: 'category',
            data: ['周一', '周二', '周三', '周四', '周五', '周六', '周日'],
            axisLine: {
                show: true,
                lineStyle: {
                    color: "rgba(255,255,255,.1)",
                    width: 1,

                },
            },

            axisTick: {
                show: false,
            },
            axisLabel:  {
                interval: 0,
                // rotate:50,
                show: true,
                splitNumber: 15,
                textStyle: {
                    color: "rgba(255,255,255,.6)",
                    fontSize: '12',

                },
            },
        }],
        yAxis: [{
            type: 'value',
            axisLabel: {
                //formatter: '{value} %'
                show:true,
                textStyle: {
                    color: "rgba(255,255,255,.6)",
                    fontSize: '12',
                },
            },
            axisTick: {
                show: false,
            },
            axisLine: {
                show: false,
            },
            splitLine: {
                lineStyle: {
                    color: "rgba(255,255,255,.1)",
                    type: "dotted"
                }
            }
        }],
        series: [{
            name: '视频数量',
            type: 'bar',
            data: ["<?php echo $sunday_coun_1; ?>", "<?php echo $sunday_coun_2; ?>", "<?php echo $sunday_coun_3; ?>", "<?php echo $sunday_coun_4; ?>", "<?php echo $sunday_coun_5; ?>", "<?php echo $sunday_coun_6; ?>", "<?php echo $sunday_coun_7; ?>"],
            barWidth:'15%', //柱子宽度
            // barGap: 1, //柱子之间间距
            itemStyle: {
                normal: {
                    color:'#2f89cf',
                    opacity: 1,
                    barBorderRadius: 5,
                }
            }
        }, {
            name: '发布数量',
            type: 'bar',
            data: ["<?php echo $Sunday_data_1; ?>", "<?php echo $Sunday_data_2; ?>", "<?php echo $Sunday_data_3; ?>", "<?php echo $Sunday_data_4; ?>", "<?php echo $Sunday_data_5; ?>", "<?php echo $Sunday_data_6; ?>", "<?php echo $Sunday_data_7; ?>"],
            barWidth:'15%',
            // barGap: 1,
            itemStyle: {
                normal: {
                    color:'#62c98d',
                    opacity: 1,
                    barBorderRadius: 5,
                }
            }
        },
        ]
    };
    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);

    var myChart2 = echarts.init(document.getElementById('echart6'));
    option2 = {
        legend: {
            icon:"circle",
            top: "0",
            width:'100%',
            right: 'center',
            itemWidth: 10,
            itemHeight: 10,
            data: ['注册人数', '使用人数'],
            textStyle: {
                color: "rgba(255,255,255,.5)" },
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                lineStyle: {
                    color: '#dddc6b'
                }
            }
        },
        grid: {
            left: '0',
            top: '30',
            right: '10',
            bottom: '-15',
            containLabel: true
        },
        xAxis: [{
            type: 'category',
            boundaryGap: false,
            axisLabel:  {
                textStyle: {
                    color: "rgba(255,255,255,.5)",
                    //  fontSize:10
                },
            },
            axisLine: {
                lineStyle: {
                    color: 'rgba(255,255,255,.1)'
                }
            },
            data: ['周一', '周二', '周三', '周四', '周五', '周六', '周日']

        }, {
            axisPointer: {show: false},
            axisLine: {  show: false},
            position: 'bottom',
            offset: 20,
        }],
        yAxis: [{
            type: 'value',
            axisTick: {show: false},
            splitNumber: 4,
            axisLine: {
                lineStyle: {
                    color: 'rgba(255,255,255,.1)'
                }
            },
            axisLabel:  {
                textStyle: {
                    color: "rgba(255,255,255,.5)",
                    //fontSize:10
                },
            },

            splitLine: {
                lineStyle: {
                    color: 'rgba(255,255,255,.1)',
                    type: 'dotted',
                }
            }
        }],
        series: [
            {
                name: '注册人数',
                type: 'line',
                smooth: true,
                symbol: 'circle',
                symbolSize: 5,
                showSymbol: false,
                lineStyle: {

                    normal: {
                        color: 'rgba(31, 174, 234, 1)',
                        width: 2
                    }
                },
                areaStyle: {
                    normal: {
                        color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                            offset: 0,
                            color: 'rgba(31, 174, 234, 0.4)'
                        }, {
                            offset: 0.8,
                            color: 'rgba(31, 174, 234, 0.1)'
                        }], false),
                        shadowColor: 'rgba(0, 0, 0, 0.1)',
                    }
                },
                itemStyle: {
                    normal: {
                        color: '#1f7eea',
                        borderColor: 'rgba(31, 174, 234, .1)',
                        borderWidth: 5
                    }
                },
                data: [3, 6, 3, 6, 3, 9, 3]

            },
            {
                name: '使用人数',
                type: 'line',
                smooth: true,
                symbol: 'circle',
                symbolSize: 5,
                showSymbol: false,
                lineStyle: {

                    normal: {
                        color: '#6bdd9b',
                        width: 2
                    }
                },
                areaStyle: {
                    normal: {
                        color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                            offset: 0,
                            color: 'rgba(107, 221, 155, 0.4)'
                        }, {
                            offset: 0.8,
                            color: 'rgba(107, 221, 155, 0.1)'
                        }], false),
                        shadowColor: 'rgba(0, 0, 0, 0.1)',
                    }
                },
                itemStyle: {
                    normal: {
                        color: '#6bdd9b',
                        borderColor: 'rgba(107, 221, 155, .1)',
                        borderWidth: 5
                    }
                },
                data: [ 5, 3, 7, 1, 8, 3, 5]

            },
        ]
    };
    // 使用刚指定的配置项和数据显示图表。
    myChart2.setOption(option2);
</script>
<script type="text/javascript">
    $(document).ready(function(){

            $(".baike").click(function(){
                $(".baike").addClass("cur");
                $(".bangzhu").removeClass("cur");
                $("#baike").show();
                $("#bangzhu").hide();

            });
            $(".bangzhu").click(function(){
                $(".bangzhu").addClass("cur");
                $(".baike").removeClass("cur");
                $("#bangzhu").show();
                $("#baike").hide();

            });

    });
    /*积分充值*/
    function ewm(){
      $('#ewm-open').modal('show');
    }
    
/*获取版权信息*/
$(function(){
      $.post('<?php echo url("cloud/bat"); ?>',
            {type:1},
             function(data){
             console.log(data)
              $("#xtmc").html('系统名称：'+data.xtmc);
              $("#phone").html('联系方式：'+data.phone);
              $("#bat").html('当前版本：'+data.bat);
                
            });
   
    
   
})

    
</script>

</body>
</html>