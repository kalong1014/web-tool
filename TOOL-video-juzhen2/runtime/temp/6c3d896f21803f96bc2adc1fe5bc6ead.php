<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:89:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/video/addindex.html";i:1667630848;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/header.html";i:1660125746;s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/public/footer.html";i:1660125746;}*/ ?>
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
<link type="text/css" href="/static/admin/jquery-slider-score/css/style.css" rel="stylesheet" />
<link rel="stylesheet" href="/static/admin/colorPicker/colorpicker.css">
<script src="/static/admin/colorPicker/colorpicker.js"></script>
<link rel="stylesheet" type="/static/admin/text/css" href="css/jackwei.slider.css">
<script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>
<script src="/static/admin/JackWeiSlider/js/jackwei.slider.js"></script>

<link rel="stylesheet" href="/static/admin/layui/css/layui.css" media="all">
<div class="wrapper layui-card-body wrapper-content">
    <div class="admin-con">
        <div class="block-box">
            <div class="col-12">
                <div class="block font12 font8c95b0">
                    <p>1. 点击 立即混剪 后,输入的内容不支持修改！</p>
                    <p>2. 创建混剪完成后，点击 <b style="color:red">混剪库列表</b> 查看。</p>
                </div>
            </div>
            <div class="col-12 font13">
                <div class="block">
                    <div class="btn-tishi" style="width:200px;position: absolute;right: 10%;top: 20px;height: 100px;pointer:" title="点我看看呀">
                        <div class="shan"></div>
                        <img src="__IMG__/tishi.png" style="width:100%;opacity: .7;">
                    </div>
                            
                    

        <style>
            .btn-tishi img{
                position:relative;
                animation:mymove 5s infinite;
                -webkit-animation:mymove 5s infinite;
            }
            @keyframes mymove
            {
                0% {left:0px;}
                50%{left:100px;}
                100% {left:0px;}
            }
            @-webkit-keyframes mymove /*Safari and Chrome*/
            {
                0% {left:0px;}
                50%{left:100px;}
                100% {left:0px;}
            }
            .layui-form-label{
                width:140px!important;
            }
            
            
            .layui-form{
                -webkit-text-size-adjust: 100%;
                color: #333;
                font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
                line-height: 24px;
                box-sizing: border-box;
                margin: 0;
                padding: 0;
                -webkit-tap-highlight-color: rgba(0,0,0,0);
            }
            .layui-form-item{
                display: flex;
            }
            
            .layui-form-mid{
                -webkit-text-size-adjust: 100%;
                font: 12px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
                box-sizing: border-box;
                margin: 0;
                -webkit-tap-highlight-color: rgba(0,0,0,0);
                position: relative;
                color: #999!important;
                float: left;
                display: block;
                padding: 9px 0!important;
                line-height: 20px;
                margin-right: 10px;
            }
            
            .layui-inline{height: initial;display: inline-block;}
            
            audio:not([controls]) {
                display: block !important;
            }
            .dtbo_1{float: left;margin:0 15px 10px 0; width:21%;}
            .dtbo_1:nth-child(3){display:block;}
            .dtbo_1:nth-child(2){display:block;}
            .bofang{float: left;}
            .dtbo{float: left;margin:0 15px 10px 0; width:17%;display:none}
            .dtbo:nth-child(3){display:block;}
            .dtbo:nth-child(2){display:block;}
            .word-choose input{vertical-align: super;}
            embed { width:0}
            button.bo{background: none;border-radius: 50%;line-height: 18px;height: 20px;width: 20px;text-align: center;border: 1px solid #3e4040;margin-left:5px;background:#3e4040;font-size:10px;color:#848181;float:left;margin-top:5px;}
            /*button#bo:active + embed { display: block; }*/
            .pickerBox{ max-width: 1200px;}
            .picker {
                width: 30px;
                height: 30px;
                cursor: pointer;
            }
        </style>
        
                    <div class="layui-form-item m-t-md">
                        <label class="layui-form-label">选择混剪类型<span style="color:red;margin:0 5px;">*</span></label>
                        <div class="layui-input-inline">
                            <input type="radio" name="h_type" class="h_type" checked>高级混剪
                            <input type="radio" name="h_type" class="h_type" style="margin-left:30px;" >顺序混剪
                        </div>
                    </div>
                            
                            <div class="layui-form-item m-t-md">
                                <label class="layui-form-label">混剪库名称<span style="color:red;margin:0 5px;">*</span></label>
                                <div class="layui-input-inline">
                                    <input type="text" name="yun_name"  placeholder="请添加混剪库名称" autocomplete="off" class="layui-input" value="">
                                </div>
                                <div class="layui-form-mid layui-word-aux">混剪完毕后，可到混剪库列表查找。</div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">单次生成数量<span style="color:red;margin:0 5px;opacity:1;">*</span></label>
                                <div class="layui-input-inline">
                                    <input type="number" name="yun_num" lay-verify="num" value="1" placeholder="请输入该队列生成视频的数量" autocomplete="off" class="layui-input" >
                                </div>
                                <div class="layui-form-mid layui-word-aux">建议单次最多生成<span style="color:red;margin:0 6px;">20</span>条视频！如不够可点击n次生成,即可生成(单次生成量*n)条视频！</div>
                            </div>
                            <div class="layui-form-item m-t-md">
                                <label class="layui-form-label">选择片头&nbsp;&nbsp;&nbsp;&nbsp;
                                </label>
                                <select name="sucai" class="form-control" id="piantou" style="width:200px">
                                    <option value="0"  >请选择</option>
                                    <?php if(is_array($piantou) || $piantou instanceof \think\Collection): if( count($piantou)==0 ) : echo "" ;else: foreach($piantou as $key=>$vo): ?>
                                    
                                    <option value="<?php echo $vo['id']; ?>"  ><?php echo $vo['uname']; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>

                            </div>
                            <div class="layui-form-item m-t-md">
                                <label class="layui-form-label">选择预剪素材<span style="color:red;margin:0 5px;">*</span></label>
                                <select name="sucai" class="form-control" id="sucai1" style="width:200px">
                                    <?php if(is_array($list) || $list instanceof \think\Collection): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$vo): ?>
                                    <option id="zhida_shipin" value="<?php echo $vo['id']; ?>"  ><?php echo $vo['uname']; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                            <div class="layui-form-item m-t-md">
                                <label class="layui-form-label">选择片尾&nbsp;&nbsp;&nbsp;&nbsp;
                                </label>
                                <select name="sucai" class="form-control" id="pianwei" style="width:200px">
                                     <option value="0"  >请选择</option>
                                    <?php if(is_array($pianwei) || $pianwei instanceof \think\Collection): if( count($pianwei)==0 ) : echo "" ;else: foreach($pianwei as $key=>$vo): ?>
                                   
                                    <option value="<?php echo $vo['id']; ?>"  ><?php echo $vo['uname']; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>

                            </div>
                            <div class="layui-form-item m-t-md">
                                <label class="layui-form-label">选择声音 <span style="color:red;margin:0 5px;">*</span></label>
                                <select name="sucai" class="form-control" id="audio" style="width:200px">
                                     <option value="0"  >请选择</option>
                                    <?php if(is_array($audio) || $audio instanceof \think\Collection): if( count($audio)==0 ) : echo "" ;else: foreach($audio as $key=>$vo): ?>
                                    <option value="<?php echo $vo['id']; ?>"  ><?php echo $vo['uname']; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>

                            </div>
                            <div class="layui-form-item m-t-md">
                                <label class="layui-form-label">选择贴纸素材&nbsp;&nbsp;&nbsp;&nbsp;
                                </label>
                                <select name="stickers" class="form-control" id="stickers" style="width:200px">
                                     <option value="0"  >请选择</option>
                                    <?php if(is_array($stickers) || $stickers instanceof \think\Collection): if( count($stickers)==0 ) : echo "" ;else: foreach($stickers as $key=>$vo): ?>
                                    <option value="<?php echo $vo['id']; ?>"  ><?php echo $vo['uname']; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>

                            </div>
                            <div class="layui-form-item">
                                <div class="layui-inline">
                                    <label class="layui-form-label">生成时长<span style="color:red;margin:0 5px;opacity:1;">*</span></label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="yun_max"  value="20" placeholder="最长时长60s" autocomplete="off" class="layui-input">
                                    </div>
                                    <div class="layui-form-mid">秒</div>
                                </div>
                            </div> 
                            <div class="layui-form-item">
                                <label class="layui-form-label">视频比例<span style="color:red;margin:0 5px;opacity:1;">*</span></label>
                                <div class="layui-input-block font13" style="margin-left:0">
                                    <input type="radio" name="ctype" value="1"  checked="" lay-filter="up_hash" >&nbsp;&nbsp;竖屏（抖音和快手）&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio"  name="ctype"  value="2"   lay-filter="up_hash">&nbsp;&nbsp;横屏（头条和西瓜）&nbsp;&nbsp;&nbsp;&nbsp;
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">请添加主标题</label>
                                <div class="layui-inline">
                                    <textarea rows="10" cols="30" name="yun_ftitle" id="yun_ftitle" class="layui-textare" style="resize:none;width:250px;line-height:38px;height:38px;float:left"  placeholder="在这里可添加主标题"></textarea>
                                    <label class="layui-form-label" style="padding:0">标题文字大小<br><span style="font-size:12px">(建议70)</span><span style="color:red;margin:0 5px;opacity:1;"></span></label>
                                    <div class="layui-input-inline" style="width: 100px;">
                                        <input type="number" name="yun_ftitlesize"  value="70" placeholder="请填写标题文字大小,建议70" autocomplete="off" class="layui-input">
                                    </div>
                                    <label class="layui-form-label">标题文字颜色<span style="color:red;margin:0 5px;opacity:1;"></span></label>
                                    <div class="layui-input-inline" style="width: 100px;">
                                        <div class="pickerBox" style="width: 100%">
                                            <div class="picker" id="color-picker" style="width: 100%"></div>
                                        </div>
                                    </div>
                                    <input type="hidden" class="layui-input yun_ftitlecolor" name="yun_ftitlecolor"  value="#26a699"  autocomplete="off" style="padding:0">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">请添加副标题</label>
                                <div class="layui-inline">
                                    <textarea rows="10" cols="30" name="yun_title" id="yun_title" class="layui-textare font13" style="resize:none;width:250px;line-height:38px;height:38px;float:left"  placeholder="在这里可添加副标题"></textarea>
                                    <label class="layui-form-label" style="padding:0">副标题文字大小<br><span style="font-size:12px">(建议40)</span><span style="color:red;margin:0 5px;opacity:1;"></span></label>
                                    <div class="layui-input-inline" style="width: 100px;">
                                        <input type="number" name="yun_titlesize"  value="40" placeholder="请填写文字大小,建议40" autocomplete="off" class="layui-input">
                                    </div>
                                    <label class="layui-form-label">副标题文字颜色<span style="color:red;margin:0 5px;opacity:1;"></span></label>

                                    <div class="layui-input-inline" style="width: 100px;">
                                        <div class="pickerBox" style="width: 100%">
                                            <div class="picker" id="color-picker2" style="width: 100%"></div>
                                        </div>
                                    </div>
                                    <input type="hidden" class="layui-input yun_titlecolor" name="yun_titlecolor"  value="#c94e4e"  autocomplete="off" style="padding:0">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">请添加字幕<span style="color:red;margin:0 5px;">*</span></label>
                                <div class="layui-inline">
                                     <div class="layui-form-item" style="float:left">
                               
                                <select name="yun_zimu" class="form-control" id="yun_zimu" style="width:200px">
                                     <option value="0"  >请选择</option>
                                    <?php if(is_array($writing) || $writing instanceof \think\Collection): if( count($writing)==0 ) : echo "" ;else: foreach($writing as $key=>$vo): ?>
                                   
                                    <option value="<?php echo $vo['id']; ?>"  ><?php echo $vo['uname']; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>

                            </div>
                                    <label class="layui-form-label" style="padding:0">字幕文字大小<br><span style="font-size:12px">(建议80)</span><span style="color:red;margin:0 5px;opacity:1;"></span></label>
                                    <div class="layui-input-inline" style="width: 100px;">
                                        <input type="number" name="yun_zimusize"  value="80" placeholder="请填写文字大小,建议80" autocomplete="off" class="layui-input">
                                    </div>
                                    <label class="layui-form-label" style="display:none">字幕文字颜色<span style="color:red;margin:0 5px;opacity:1;"></span></label>
                                    <div class="layui-input-inline" style="width: 100px;display:none" >
                                        <div class="pickerBox" style="width: 100%">
                                            <div class="picker" id="color-picker3" style="width: 100%"></div>
                                        </div>
                                    </div>
                                    <input type="hidden" class="layui-input yun_zimucolor" name="yun_zimucolor"  value="#2e498f"  autocomplete="off" style="padding:0;display:none">
                                </div>
                            </div>
                            <div class="layui-form-item m-t-md">
                                <label class="layui-form-label">选择标题位置&nbsp;&nbsp;&nbsp;&nbsp;
                                </label>
                                <select name="titlePosition" class="form-control" id="titlePosition" style="width:200px">
                                     <option value="1" >顶部</option>
                                     <option value="2" >居中</option>
                                  
                                </select>

                            </div>
                            <!--人声开始-->
                            <div class="layui-form-item">
                                <label class="layui-form-label">人声播放<span style="color:red;margin:0 5px;opacity:1;">*</span></label>
                                <div class="layui-input-block" style="width:80%;margin-left:0">
                                    <audio id="embed_id" src=""></audio>
                                    <dt class="dtbo dt_music dt_music_show" style="height:35px;line-height:35px;">
                                        <div style="float:left">
                                            <input type="radio" class="music" name="yun_zimuvideo" value="xiaoyun" title="标准女声" checked="" style="margin-top:0">
                                            <span>标准女声</span>
                                        </div>
                                        <div class="bofang">
                                            <button class="bo">▶</button>
                                            <audio data-src="https://ice-pub-media.myalicdn.com/smart/tts-audio/xiaoyun.MP3?spm=a2c4g.11186623.0.0.5b6745a64RHyWT&amp;file=xiaoyun.MP3" preload="none" style="display:none;"></audio>
                                        </div>
                                    </dt>
                                    <dt class="dtbo dt_music" style="height:35px;line-height:35px;">
                                        <div style="float:left">
                                            <input type="radio" class="music" name="yun_zimuvideo" value="xiaogang" title="标准男声" style="margin-top:0">
                                            <span>标准男声</span>
                                        </div>
                                        <div class="bofang">
                                            <button class="bo">▶</button>
                                            <audio data-src="https://ice-pub-media.myalicdn.com/smart/tts-audio/xiaogang.MP3?spm=a2c4g.11186623.0.0.5b6745a64RHyWT&file=xiaogang.MP3" preload="none" style="display:none;"></audio>
                                        </div>
                                    </dt>
                                    <dt class="dtbo dt_music" style="height:35px;line-height:35px;">
                                        <div style="float:left">
                                            <input type="radio" class="music" name="yun_zimuvideo" value="ruoxi" title="温柔女声" style="margin-top:0">
                                            <span>温柔女声</span>
                                        </div>
                                        <div class="bofang">
                                            <button class="bo">▶</button>
                                            <audio data-src="https://ice-pub-media.myalicdn.com/smart/tts-audio/ruoxi.MP3?spm=a2c4g.11186623.0.0.5b6745a64RHyWT&file=ruoxi.MP3" preload="none" style="display:none;"></audio>
                                        </div>
                                    </dt>
                                    <dt class="dtbo dt_music" style="height:35px;line-height:35px;">
                                        <div style="float:left">
                                            <input type="radio" class="music" name="yun_zimuvideo" value="aikan" title="天津话男声" style="margin-top:0">
                                            <span>天津话男声</span>
                                        </div>
                                        <div class="bofang">
                                            <button class="bo">▶</button>
                                            <audio data-src="https://ice-pub-media.myalicdn.com/smart/tts-audio/aikan.MP3?spm=a2c4g.11186623.0.0.71e65fd8RAhKFd&file=aikan.MP3" preload="none" style="display:none;"></audio>
                                        </div>
                                    </dt>
                                    <dt class="dtbo dt_music" style="height:35px;line-height:35px;">
                                        <div style="float:left">
                                            <input type="radio" class="music" name="yun_zimuvideo" value="jielidou" title="治愈童声" style="margin-top:0">
                                            <span>治愈童声</span>
                                        </div>
                                        <div class="bofang">
                                            <button class="bo">▶</button>
                                            <audio data-src="https://ice-pub-media.myalicdn.com/smart/tts-audio/jielidou.MP3?spm=a2c4g.11186623.0.0.71e65fd8RAhKFd&file=jielidou.MP3" preload="none" style="display:none;"></audio>

                                        </div>
                                    </dt>
                                    <dt class="dtbo dt_music" style="height:35px;line-height:35px;">
                                        <div style="float:left">
                                            <input type="radio" class="music" name="yun_zimuvideo" value="shanshan" title="粤语女声" style="margin-top:0">
                                            <span>粤语女声</span>
                                        </div>
                                        <div class="bofang">
                                            <button class="bo">▶</button>
                                            <audio data-src="https://ice-pub-media.myalicdn.com/smart/tts-audio/taozi.MP3?spm=a2c4g.11186623.0.0.71e65fd8RAhKFd&file=taozi.MP3" preload="none" style="display:none;"></audio>

                                        </div>
                                    </dt>
                                    <dt class="dtbo dt_music" style="height:35px;line-height:35px;">
                                        <div style="float:left">
                                            <input type="radio" class="music" name="yun_zimuvideo" value="chuangirl" title="四川话" style="margin-top:0">
                                            <span>四川话</span>
                                        </div>
                                        <div class="bofang">
                                            <button class="bo">▶</button>
                                            <audio data-src="https://ice-pub-media.myalicdn.com/smart/tts-audio/chuangirl.MP3?spm=a2c4g.11186623.0.0.71e65fd8RAhKFd&file=chuangirl.MP3" preload="none" style="display:none;"></audio>
                                        </div>
                                    </dt>
                                    <dt class="dtbo dt_music" style="height:35px;line-height:35px;">
                                        <div style="float:left">
                                            <input type="radio" class="music" name="yun_zimuvideo" value="luna" title="英音女声" style="margin-top:0">
                                            <span>英音女声</span>
                                        </div>
                                        <div class="bofang">
                                            <button class="bo">▶</button>
                                            <audio data-src="https://ice-pub-media.myalicdn.com/smart/tts-audio/luna.MP3?spm=a2c4g.11186623.0.0.71e65fd8RAhKFd&file=luna.MP3" preload="none" style="display:none;"></audio>
                                        </div>
                                    </dt>
                                    <dt class="dtbo dt_music" style="height:35px;line-height:35px;">
                                        <div style="float:left">
                                            <input type="radio" class="music" name="yun_zimuvideo" value="eric" title="英音男声" style="margin-top:0">
                                            <span>英音男声</span>
                                        </div>
                                        <div class="bofang">
                                            <button class="bo">▶</button>
                                            <audio data-src="https://ice-pub-media.myalicdn.com/smart/tts-audio/luca.MP3?spm=a2c4g.11186623.0.0.71e65fd8RAhKFd&file=luca.MP3" preload="none" style="display:none;"></audio>
                                        </div>
                                    </dt>
                                    <dt class="dtbo dt_music" style="height:35px;line-height:35px;">
                                        <div style="float:left">
                                            <input type="radio" class="music" name="yun_zimuvideo" value="tomoka" title="日语" style="margin-top:0">
                                            <span>日语</span>
                                        </div>
                                        <div class="bofang">
                                            <button class="bo">▶</button>
                                            <audio data-src="https://ice-pub-media.myalicdn.com/smart/tts-audio/tomoka.mp3?spm=a2c4g.11186623.0.0.71e65fd8RAhKFd&file=tomoka.mp3" preload="none" style="display:none;"></audio>
                                        </div>
                                    </dt>
                                    <dt class="dtbo dt_music" style="height:35px;line-height:35px;">
                                        <div style="float:left">
                                            <input type="radio" class="music" name="yun_zimuvideo" value="siqi" title="思琪" style="margin-top:0">
                                            <span>思琪</span>
                                        </div>
                                        <div class="bofang">
                                            <button class="bo">▶</button>
                                            <audio data-src="https://ice-pub-media.myalicdn.com/smart/tts-audio/siqi.MP3?spm=a2c4g.11186623.0.0.71e65fd8RAhKFd&file=siqi.MP3" preload="none" style="display:none;"></audio>

                                        </div>
                                    </dt>
                                    <dt class="dtbo dt_music" style="height:35px;line-height:35px;">
                                        <div style="float:left">
                                            <input type="radio" class="music" name="yun_zimuvideo" value="sicheng" title="思诚" style="margin-top:0">
                                            <span>思诚</span>
                                        </div>
                                        <div class="bofang">
                                            <button class="bo">▶</button>
                                            <audio data-src="https://ice-pub-media.myalicdn.com/smart/tts-audio/sicheng.MP3?spm=a2c4g.11186623.0.0.71e65fd8RAhKFd&file=sicheng.MP3" preload="none" style="display:none;"></audio>
                                        </div>
                                    </dt>
                                    <dt class="dtbo dt_music" style="height:35px;line-height:35px;">
                                        <div style="float:left">
                                            <input type="radio" class="music" name="yun_zimuvideo" value="aijia" title="艾佳" style="margin-top:0">
                                            <span>艾佳</span>
                                        </div>
                                        <div class="bofang">
                                            <button class="bo">▶</button>
                                            <audio data-src="https://ice-pub-media.myalicdn.com/smart/tts-audio/aijia.MP3?spm=a2c4g.11186623.0.0.71e65fd8RAhKFd&file=aijia.MP3" preload="none" style="display:none;"></audio>
                                        </div>
                                    </dt>
                                    <dt class="dtbo dt_music" style="height:35px;line-height:35px;">
                                        <div style="float:left">
                                            <input type="radio" class="music" name="yun_zimuvideo" value="aida" title="艾达" style="margin-top:0">
                                            <span>艾达</span>
                                        </div>
                                        <div class="bofang">
                                            <button class="bo">▶</button>
                                            <audio data-src="https://ice-pub-media.myalicdn.com/smart/tts-audio/aida.MP3?spm=a2c4g.11186623.0.0.71e65fd8RAhKFd&file=aida.MP3" preload="none" style="display:none;"></audio>
                                        </div>
                                    </dt>
                                    <dt class="dtbo dt_music" style="height:35px;line-height:35px;">
                                        <div style="float:left">
                                            <input type="radio" class="music" name="yun_zimuvideo" value="ninger" title="宁儿" style="margin-top:0">
                                            <span>宁儿</span>
                                        </div>
                                        <div class="bofang">
                                            <button class="bo">▶</button>
                                            <audio data-src="https://ice-pub-media.myalicdn.com/smart/tts-audio/ninger.MP3?spm=a2c4g.11186623.0.0.71e65fd8RAhKFd&file=ninger.MP3" preload="none" style="display:none;"></audio>
                                        </div>
                                    </dt>
                                    <dt class="dtbo dt_music" style="height:35px;line-height:35px;">
                                        <div style="float:left">
                                            <input type="radio" class="music" name="yun_zimuvideo" value="ruilin" title="瑞琳" style="margin-top:0">
                                            <span>瑞琳</span>
                                        </div>
                                        <div class="bofang">
                                            <button class="bo">▶</button>
                                            <audio data-src="https://ice-pub-media.myalicdn.com/smart/tts-audio/ruilin.MP3?spm=a2c4g.11186623.0.0.71e65fd8RAhKFd&file=ruilin.MP3" preload="none" style="display:none;"></audio>
                                        </div>
                                    </dt>
                                    <dt class="dtbo dt_music" style="height:35px;line-height:35px;">
                                        <div style="float:left">
                                            <input type="radio" class="music" name="yun_zimuvideo" value="siyue" title="思悦" style="margin-top:0">
                                            <span>思悦</span>
                                        </div>
                                        <div class="bofang">
                                            <button class="bo">▶</button>
                                            <audio data-src="https://ice-pub-media.myalicdn.com/smart/tts-audio/siyue.MP3?spm=a2c4g.11186623.0.0.71e65fd8RAhKFd&file=siyue.MP3" preload="none" style="display:none;"></audio>
                                        </div>
                                    </dt>
                                    <dt class="dtbo dt_music" style="height:35px;line-height:35px;">
                                        <div style="float:left">
                                            <input type="radio" class="music" name="yun_zimuvideo" value="aiya" title="艾雅" style="margin-top:0">
                                            <span>艾雅</span>
                                        </div>
                                        <div class="bofang">
                                            <button class="bo">▶</button>
                                            <audio data-src="https://ice-pub-media.myalicdn.com/smart/tts-audio/aiya.MP3?spm=a2c4g.11186623.0.0.71e65fd8RAhKFd&file=aiya.MP3" preload="none" style="display:none;"></audio>
                                        </div>
                                    </dt>
                                    <dt class="dtbo dt_music" style="height:35px;line-height:35px;">
                                        <div style="float:left">
                                            <input type="radio" class="music" name="yun_zimuvideo" value="aixia" title="亲和女声" style="margin-top:0">
                                            <span>亲和女声</span>
                                        </div>
                                        <div class="bofang">
                                            <button class="bo">▶</button>
                                            <audio data-src="https://ice-pub-media.myalicdn.com/smart/tts-audio/aixia.MP3?spm=a2c4g.11186623.0.0.71e65fd8RAhKFd&file=aixia.MP3" preload="none" style="display:none;"></audio>
                                        </div>
                                    </dt>
                                    <dt class="dtbo dt_music" style="height:35px;line-height:35px;">
                                        <div style="float:left">
                                            <input type="radio" class="music" name="yun_zimuvideo" value="sijing" title="严厉女声" style="margin-top:0">
                                            <span>严厉女声</span>
                                        </div>
                                        <div class="bofang">
                                            <button class="bo">▶</button>
                                            <audio data-src="https://ice-pub-media.myalicdn.com/smart/tts-audio/sijing.MP3?spm=a2c4g.11186623.0.0.5b6745a64RHyWT&file=sijing.MP3" preload="none" style="display:none;"></audio>
                                        </div>
                                    </dt>
                                    <dt class="dtbo dt_music" style="height:35px;line-height:35px;">
                                        <div style="float:left">
                                            <input type="radio" class="music" name="yun_zimuvideo" value="xiaoze" title="湖南口音男声" style="margin-top:0">
                                            <span>湖南口音男声</span>
                                        </div>
                                        <div class="bofang">
                                            <button class="bo">▶</button>
                                            <audio data-src="https://ice-pub-media.myalicdn.com/smart/tts-audio/xiaoze.MP3?spm=a2c4g.11186623.0.0.5b6745a64RHyWT&file=xiaoze.MP3" preload="none" style="display:none;"></audio>
                                        </div>
                                    </dt>
                                    <dt class="dtbo dt_music" style="height:35px;line-height:35px;">
                                        <div style="float:left">
                                            <input type="radio" class="music" name="yun_zimuvideo" value="stella" title="知性女声" style="margin-top:0">
                                            <span>知性女声</span>
                                        </div>
                                        <div class="bofang">
                                            <button class="bo">▶</button>
                                            <audio data-src="https://ice-pub-media.myalicdn.com/smart/tts-audio/stella.MP3?spm=a2c4g.11186623.0.0.5b6745a64RHyWT&file=stella.MP3" preload="none" style="display:none;"></audio>
                                        </div>
                                    </dt>
                                    <dt class="dtbo dt_music" style="height:35px;line-height:35px;">
                                        <div style="float:left">
                                            <input type="radio" class="music" name="yun_zimuvideo" value="rosa" title="自然女声" style="margin-top:0">
                                            <span>自然女声</span>
                                        </div>
                                        <div class="bofang">
                                            <button class="bo">▶</button>
                                            <audio data-src="https://ice-pub-media.myalicdn.com/smart/tts-audio/rosa.MP3?spm=a2c4g.11186623.0.0.5b6745a64RHyWT&file=rosa.MP3" preload="none" style="display:none;"></audio>
                                        </div>
                                    </dt>
                                    <dt class="moreclick" style="height:35px;line-height:35px;float: left">更多</dt>
                                    <dt class="dtbo  moreclose " style="height:35px;line-height:35px;float: left">收回</dt>
                                </div>
                            </div>
                            <!--人声结束-->
        <!--字体开始-->
          <div class="layui-form-item word-choose">
            <label class="layui-form-label">字幕字体选择<span style="color:red;margin:0 5px;opacity:1;">*</span></label>
            <div class="layui-input-block" style="width:80%;margin-left:0">
               
                <dt class="dtbo_1  " style="height:35px;">
                    <div style="float:left">
                        <input type="radio" class="" name="yun_hyzt" value="1"  checked="" style="margin-top:0;">
                        <img src="https://img.alicdn.com/imgextra/i3/O1CN01LOsKYS1mKjkmpKURx_!!6000000004936-2-tps-357-110.png" style="width:65%"  alt="" />
                    </div>
                    
                </dt>
                
                 <dt class="dtbo_1 " style="height:35px;">
                    <div style="float:left">
                        <input type="radio" class="" name="yun_hyzt" value="2"  checked="" style="margin-top:0">
                        <img src="https://img.alicdn.com/imgextra/i3/O1CN01H2O45T1cqfCoJ8lEo_!!6000000003652-2-tps-357-110.png" style="width:65%"  alt="" />
                    </div>
                    
                </dt>
                 <dt class="dtbo_1" style="height:35px;">
                    <div style="float:left">
                        <input type="radio" class="" name="yun_hyzt" value="3"  checked="" style="margin-top:0">
                        <img src="https://img.alicdn.com/imgextra/i3/O1CN01b84RGd1gYa1zZvdU3_!!6000000004154-2-tps-357-110.png" style="width:65%"  alt="" />
                    </div>
                    
                </dt>
                 <dt class="dtbo_1" style="height:35px;">
                    <div style="float:left">
                        <input type="radio" class="" name="yun_hyzt" value="4"  checked="" style="margin-top:0">
                        <img src="https://img.alicdn.com/imgextra/i4/O1CN01Kr3MVq1nJC2EeITAz_!!6000000005068-2-tps-357-110.png" style="width:65%"  alt="" />
                    </div>
                    
                </dt>
                 <dt class="dtbo_1" style="height:35px;">
                    <div style="float:left">
                         <input type="radio" class="" name="yun_hyzt" value="5"  checked="" style="margin-top:0">
                        <img src="https://img.alicdn.com/imgextra/i4/O1CN01UoFBr31ETiaBVgAWr_!!6000000000353-2-tps-357-110.png" style="width:65%"  alt="" />
                    </div>
                    
                </dt>
                 <dt class="dtbo_1" style="height:35px;">
                    <div style="float:left">
                        <input type="radio" class="" name="yun_hyzt" value="6"  checked="" style="margin-top:0">
                        <img src="https://img.alicdn.com/imgextra/i1/O1CN01bh6HHZ1jlLvAxc9ud_!!6000000004588-2-tps-357-110.png" style="width:65%"  alt="" />
                    </div>
                    
                </dt>
                 <dt class="dtbo_1" style="height:35px;">
                    <div style="float:left">
                        <input type="radio" class="" name="yun_hyzt" value="7"  checked="" style="margin-top:0">
                        <img src="https://img.alicdn.com/imgextra/i2/O1CN01d709Ct1Frp2sjC5Po_!!6000000000541-2-tps-357-110.png" style="width:65%"  alt="" />
                    </div>
                    
                </dt>
                  <dt class="dtbo_1" style="height:35px;">
                    <div style="float:left">
                        <input type="radio" class="" name="yun_hyzt" value="8"  checked="" style="margin-top:0">
                        <img src="https://img.alicdn.com/imgextra/i2/O1CN01a9RPAq1VGIRgpcT8W_!!6000000002625-2-tps-357-110.png" style="width:65%"  alt="" />
                    </div>
                    
                </dt>
                 <dt class="dtbo_1" style="height:35px;">
                    <div style="float:left">
                        <input type="radio" class="" name="yun_hyzt" value="9"  checked="" style="margin-top:0">
                        <img src="https://img.alicdn.com/imgextra/i2/O1CN01meakbT21Z8RVpCqlc_!!6000000006998-2-tps-357-110.png" style="width:65%"  alt="" />
                    </div>
                    
                </dt>
                <dt class="dtbo_1" style="height:35px;">
                    <div style="float:left">
                        <input type="radio" class="" name="yun_hyzt" value="10"  checked="" style="margin-top:0">
                        <img src="https://img.alicdn.com/imgextra/i2/O1CN018uqWt91nys4qoJEZs_!!6000000005159-2-tps-357-110.png" style="width:65%"  alt="" />
                    </div>
                    
                </dt>
                 <dt class="dtbo_1" style="height:35px;">
                    <div style="float:left">
                        <input type="radio" class="" name="yun_hyzt" value="11"  checked="" style="margin-top:0">
                        <img src="https://img.alicdn.com/imgextra/i1/O1CN018kikf31NfvgZozOSL_!!6000000001598-2-tps-357-110.png" style="width:65%"  alt="" />
                    </div>
                    
                </dt>
                 <dt class="dtbo_1" style="height:35px;">
                    <div style="float:left">
                        <input type="radio" class="" name="yun_hyzt" value="12"  checked="" style="margin-top:0">
                        <img src="https://img.alicdn.com/imgextra/i1/O1CN016t1Zeq1iF0KVbnDGV_!!6000000004382-2-tps-357-110.png" style="width:65%"  alt="" />
                    </div>
                    
                </dt>
                  <dt class="dtbo_1" style="height:35px;">
                    <div style="float:left">
                        <input type="radio" class="" name="yun_hyzt" value="13"  checked="" style="margin-top:0">
                        <img src="https://img.alicdn.com/imgextra/i4/O1CN01mPgP5726x1AqaRh3b_!!6000000007727-2-tps-357-110.png" style="width:65%"  alt="" />
                    </div>
                    
                </dt>
                <dt class="dtbo_1" style="height:35px;">
                    <div style="float:left">
                        <input type="radio" class="" name="yun_hyzt" value="14"  checked="" style="margin-top:0">
                        <img src="https://img.alicdn.com/imgextra/i2/O1CN01ABkWP91rMdTZIYhMz_!!6000000005617-2-tps-357-110.png" style="width:65%"  alt="" />
                    </div>
                    
                </dt>
                <dt class="dtbo_1" style="height:35px;">
                    <div style="float:left">
                        <input type="radio" class="" name="yun_hyzt" value="15"  checked="" style="margin-top:0">
                        <img src="https://img.alicdn.com/imgextra/i1/O1CN01BdDsqC1XJA9iv2yKS_!!6000000002902-2-tps-357-110.png" style="width:65%"  alt="" />
                    </div>
                </dt>
                 <dt class="dtbo_1" style="height:35px;">
                    <div style="float:left">
                        <input type="radio" class="" name="yun_hyzt" value="16"  checked="" style="margin-top:0">
                        <img src="https://img.alicdn.com/imgextra/i1/O1CN01eVwynt1yV44cuK0wq_!!6000000006583-2-tps-357-110.png" style="width:65%"  alt="" />
                    </div>
                </dt>
                 <dt class="dtbo_1" style="height:35px;">
                    <div style="float:left">
                        <input type="radio" class="" name="yun_hyzt" value="17"  checked="" style="margin-top:0">
                        <img src="https://img.alicdn.com/imgextra/i2/O1CN01E4bBYX1xMX56UwYjp_!!6000000006429-2-tps-357-110.png" style="width:65%"  alt="" />
                    </div>
                </dt>
                <dt class="dtbo_1" style="height:35px;">
                    <div style="float:left">
                        <input type="radio" class="" name="yun_hyzt" value="18"  checked="" style="margin-top:0">
                        <img src="https://img.alicdn.com/imgextra/i3/O1CN01L9j9on1pTqTeg2NST_!!6000000005362-2-tps-357-110.png" style="width:65%"  alt="" />
                    </div>
                </dt>

               
            </div>
        </div>
        <!--字体结束-->
                            <div class="layui-form-item">
                                <label class="layui-form-label">视频原声<span style="color:red;margin:0 5px;opacity:1;">*</span></label>
                                <div class="layui-input-block" style="margin-left:0">
                                    <input type="radio" name="yun_spsy" value="1" title="开启"  style="margin-top:13px">&nbsp;&nbsp;开启&nbsp;&nbsp;
                                    <input type="radio" name="yun_spsy" value="0" title="关闭" checked="" style="margin-top:13px">&nbsp;&nbsp;关闭 &nbsp;&nbsp;
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">动态拼图特效<span style="color:red;margin:0 5px;opacity:1;">*</span></label>
                                <div class="layui-input-block"  style="margin-left:0">
                                    <input type="radio" name="yun_pintu" value="1" title="开启" checked="" style="margin-top:13px">&nbsp;&nbsp;开启&nbsp;&nbsp;
                                    <input type="radio" name="yun_pintu" value="0" title="关闭" style="margin-top:13px">&nbsp;&nbsp;关闭 &nbsp;&nbsp;
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">背景音乐声音<span style="color:red;margin:0 5px;opacity:1;">*</span></label>
                                <div class="User_ratings User_grade" id="div_fraction0">
                                    <div class="ratings_bars">
                                        <span id="title0">0</span>
                                        <span class="bars_10">0</span>
                                        <div class="scale" id="bar0">
                                            <div></div>
                                            <span id="btn0"></span>
                                        </div>
                                        <span class="bars_10">10</span>
                                    </div>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">视频节奏<span style="color:red;margin:0 5px;opacity:1;">*</span></label>
                                <div class="layui-input-block" style="margin-left:0">
                                    <input type="radio" name="yun_jie" value="1" title="正常" checked="" style="margin-top:13px">&nbsp;&nbsp;正常&nbsp;&nbsp;
                                    <input type="radio" name="yun_jie" value="2" title="快节奏" style="margin-top:13px">&nbsp;&nbsp;快节奏&nbsp;&nbsp;
                                    <input type="radio" name="yun_jie" value="3" title="慢节奏" style="margin-top:13px">&nbsp;&nbsp;慢节奏&nbsp;&nbsp;
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-input-block">
                                    <button class="btn btn-success"  type="button" onclick="submit()">立即混剪</button>
                                    <button type="reset" class="btn btn-danger">重置</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        <!--</div>-->
<!--    </div>-->
<!--</div>-->
<input type="hidden" name="jinbi" value="<?php echo $jinbi; ?>">

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

<div class="modal fade" id="btn-tishi" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">温馨提示</h4>
            </div>
            <div class="zhida_san_hao" style="padding:20px 0 " id="zhida_san_hao">
                <p class="zhida_er_a">
                    1、创建混剪时需先上传预混剪内容。
                </p>
                <p class="zhida_er_a">
                    2、标题文字大小建议70！
                </p>
                <p class="zhida_er_a">
                    3、副标题文字大小建议40！
                </p>
                <p class="zhida_er_a">
                    4、字幕文字大小建议40！
                </p>
                <p class="zhida_er_a">
                    5、字幕文字与视频时长比例：(建议)100个文字：30秒
                </p>
            </div>
        </div>
    </div>
</div>
<style>
    .zhida_er_a {
        padding-left: 2%;
        background: #3e4040;
        font-size: 12px;
        line-height: 25px;
        margin: 0;
    }
</style>
<script type="text/javascript">
    $(function() {
        // 温馨提示
        $(".btn-tishi").click(function(){
            $("#zhic").css('display',"none");
            $("#btn-tishi").modal('show');
        })
    })
</script>

<script type="text/javascript" charset="utf-8">
    function colorRGB2Hex(color) {
        var rgb = color.split(',');
        var r = parseInt(rgb[0].split('(')[1]);
        var g = parseInt(rgb[1]);
        var b = parseInt(rgb[2].split(')')[0]);

        var hex = "#" + ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1);
        return hex;
    }
    var a = Colorpicker.create({
        el: "color-picker",
        color: "rgba(38, 166, 153, 0.8)",
        change: function (elem, rgba) {
            elem.style.backgroundColor = rgba;
            $('.yun_ftitlecolor').val(colorRGB2Hex(rgba))
        }
    })
    var b = Colorpicker.create({
        el: "color-picker2",
        color: "rgba(201, 78, 78, 0.8)",
        change: function (elem, rgba) {
            elem.style.backgroundColor = rgba;
            $('.yun_titlecolor').val(colorRGB2Hex(rgba))
        }
    })
    var c = Colorpicker.create({
        el: "color-picker3",
        color: "rgba(46, 73, 143, 0.8)",
        change: function (elem, rgba) {
            elem.style.backgroundColor = rgba;
            $('.yun_zimucolor').val(colorRGB2Hex(rgba))
        }
    })

    scale = function (btn, bar, title) {
        this.btn = document.getElementById(btn);
        this.bar = document.getElementById(bar);
        this.title = document.getElementById(title);
        this.step = this.bar.getElementsByTagName("DIV")[0];
        this.init();
    };
    scale.prototype = {
        init: function () {
            var f = this, g = document, b = window, m = Math;
            this.btn.style.left = '15px';
            this.step.style.width = '15px';
            this.title.innerHTML = 1;
            f.btn.onmousedown = function (e) {
                var x = (e || b.event).clientX;
                var l = this.offsetLeft;
                var max = f.bar.offsetWidth - this.offsetWidth;
                g.onmousemove = function (e) {
                    var thisX = (e || b.event).clientX;
                    var to = m.min(max, m.max(-2, l + (thisX - x)));
                    f.btn.style.left = to + 'px';
                    f.ondrag(m.round(m.max(0, to / max) * 100), to);
                    b.getSelection ? b.getSelection().removeAllRanges() : g.selection.empty();
                };
                g.onmouseup = new Function('this.onmousemove=null');
            };
        },
        ondrag: function (pos, x) {
            this.step.style.width = Math.max(0, x) + 'px';
            this.title.innerHTML = Math.round(pos / 10 + '');
        }
    }
    new scale('btn0', 'bar0', 'title0');
</script>
<script>
    $(".h_type").change(function() {
        window.location.href="/admin/video/mix_order.html"
    })
    function submit(){
        layer.load(3)
        var  sucai1 = $('#sucai1  option:selected').val();//获取选中的预剪素材
        //判断有没有图片或视频
        $.ajax({
            type: "POST",
            url: "/admin/video/sucaipd",
            data: {sucai1:sucai1},
            success: function(data){
                if(data.code == -1){
                    layer.closeAll('loading');
                    layer.msg(data.msg,{icon:2,time:1500,shade: 0.1,});
                    return false;
                }
            },
            error:function() {
                layer.closeAll('loading');
                layer.alert('选择的素材库有问题，请检查')
            }
        });
        var  audio = $('#audio  option:selected').val();//声音
        if(0 == audio){
            layer.closeAll('loading');
            layer.msg('请选择声音',{icon:2,time:1500,shade: 0.1}); return false;
        }
        //var yun_zimu = $("#yun_zimu").val();//字幕
        var  yun_zimu = $('#yun_zimu  option:selected').val();//字幕
        // if(0 == yun_zimu){
        //     layer.closeAll('loading');
        //     layer.msg('请选字幕',{icon:2,time:1500,shade: 0.1}); return false;
        // }
        var yun_name = $("input[name='yun_name']").val();//混剪名称
        var yun_num = $("input[name='yun_num']").val();//混剪数量
        var yun_max = $("input[name='yun_max']").val();//混剪时间
        var bili = $("input[name='ctype']:checked").val();//比例
        if(bili==1){
            yun_width = 720;
            yun_height=1280;
        }else{
            yun_width = 1920
            yun_height=1080;
        }
        //横屏
        //竖屏
        //  if(bili==1){
        //     yun_width = 1080;
        //     yun_height=1920;
        // }else{
        //     yun_width = 1920;
        //     yun_height=1440;
        // }
        var  pianwei = $('#pianwei  option:selected').val();//片尾
        var  piantou = $('#piantou  option:selected').val();//片头
        var yun_pintu = $("input[name='yun_pintu']:checked").val();//动态拼图特效
        var yun_dong = $('#title0').text();//声音大小

        var yun_jie = $("input[name='yun_jie']:checked").val();//视频节奏
        var yun_title = $("#yun_title").val();//标题
        var yun_titlecolor = $("input[name='yun_titlecolor']").val();//标题颜色
        var yun_titlesize = $("input[name='yun_titlesize']").val();//标题文字大小
        var yun_ftitle = $("#yun_ftitle").val();//副标题
        var yun_ftitlesize = $("input[name='yun_ftitlesize']").val();//副标题文字大小
        var yun_ftitlecolor = $("input[name='yun_ftitlecolor']").val();//副标题颜色
        
        var yun_zimusize = $("input[name='yun_zimusize']").val();//字幕文字大小
        var yun_zimucolor = $("input[name='yun_zimucolor']").val();//字幕颜色
        var yun_zimuvideo = $("input[name=yun_zimuvideo]:checked").val();//人声
        var yun_spsy = $("input[name='yun_spsy']:checked").val();//动态拼图特效
        var yun_hyzt = $("input[name=yun_hyzt]:checked").val();//字体
        var  stickers = $('#stickers  option:selected').val();//贴纸
        var  titlePosition = $('#titlePosition  option:selected').val();//标题位置
        if('' == yun_name){
            layer.closeAll('loading');
            layer.msg('混剪任务名称不能为空',{icon:2,time:1500,shade: 0.1}); return false;
        }
        if(yun_num <=0){
            layer.closeAll('loading');
            layer.msg('请填写混剪数量',{icon:2,time:1500,shade: 0.1}); return false;
        }   
            jinbi = $('input[name="jinbi"]').val();
          
            jinbi = yun_num * jinbi
            layer.confirm('确认生成？将消耗您'+jinbi+'个积分?', {icon: 3, title:'提示'}, function(index){
            console.log(index)
            var formData = new FormData();
            formData.append("yun_name", yun_name);
            formData.append("yun_num", yun_num);
            formData.append("yun_max", yun_max);
            formData.append("yun_width", yun_width);
            formData.append("yun_height", yun_height);
            formData.append("yun_pintu", yun_pintu);
            formData.append("yun_dong", yun_dong);
            formData.append("yun_jie", yun_jie);
            formData.append("yun_title", yun_title);
            formData.append("yun_titlecolor", yun_titlecolor);
            formData.append("yun_titlesize", yun_titlesize);
            formData.append("yun_ftitlecolor", yun_ftitlecolor);
            formData.append("yun_zimu", yun_zimu);
            formData.append("yun_zimusize", yun_zimusize);
            formData.append("yun_zimucolor", yun_zimucolor);
            formData.append("yun_zimuvideo", yun_zimuvideo);
            formData.append("yun_ftitle", yun_ftitle);
            formData.append("yun_ftitlesize", yun_ftitlesize);
            formData.append("yun_spsy", yun_spsy);
            formData.append("jinbi", jinbi);
            formData.append("sucai1", sucai1);
            formData.append("pianwei", pianwei);
            formData.append("piantou", piantou);
            formData.append("audio", audio);
            formData.append("yun_hyzt", yun_hyzt);
            formData.append("stickers", stickers);
            formData.append("titlePosition", titlePosition);
            console.log(formData);
            $.ajax({
                type: "POST",
                url: "/admin/video/senior_task",
                data: formData,
                contentType : false,
                processData : false,
                success: function(data){
                    layer.closeAll('loading');
                    if(data.code==1){
                        layer.msg(data.msg,{icon:1,time:1500,shade: 0.1,});
                        setInterval(function(){
                            window.location.href="/admin/video/videolist";
                        },1000)
                    }else{
                        //发布失败
                        layer.msg(data.msg,{icon:2,time:1500,shade: 0.1,});
                        return false;
                    }
                },
                error:function() {
                    layer.closeAll('loading');
                    layer.alert('发布失败')

                }
            });
        },function() {
            layer.closeAll('loading');
        })
    }
    $(function() {
        $(".bo").click(function(){
            var src = $(this).next().attr('data-src');
            $("#embed_id").attr('src',src);
            var audio = document.getElementById('embed_id');
            audio.play()
        });
    })
    $(".check-music").click(function() {
        $(".check-music").hide()
        $(this).show()
        $(".reset_user").show();
    })
    $(".reset_user").click(function() {
        $(".check-music").show()
        $(this).hide();
    })
    $(".moreclick").click(function(){
        $(".dtbo").css('display','block');
        $(".moreclick").css('display','none');
    });
    //  $(".moreclick_1").click(function(){
    //     $(".dtbo_1").css('display','block');
    //      $(".moreclick_1").css('display','none');
    //   // $(".moreclick").css('display','none');
    // });
    $(".moreclose").click(function(){
        $(".moreclick").css('display','block');
        $(".dtbo").css('display','none');
        $('.dt_music_show').show();
        $(".moreclose").css('display','none');
    });
    $(".music").click(function() {
        $(".dt_music").hide();
        $(this).parent().parent().show();
        $(".dt_music_show").removeClass('dt_music_show');
        $(this).parent().parent().addClass('dt_music_show');
        $(".moreclose").hide();
        $(".moreclick").show();
    })
</script>
