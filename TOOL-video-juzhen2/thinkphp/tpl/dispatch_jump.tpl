
<html >
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes" />  
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>跳转提示</title>
   
    <style type="text/css">
        body, h1, h2, p,dl,dd,dt{margin: 0;padding: 0;font: 15px/1.5 微软雅黑,tahoma,arial;}
        body{background:#2b2b2e;}
        h1, h2, h3, h4, h5, h6 {font-size: 100%;cursor:default;}
        ul, ol {list-style: none outside none;}
        a {text-decoration: none;color:#447BC4}
        a:hover {text-decoration: underline;}
        .ip-attack{ margin:100px auto 0;}
        .ip-attack dl{  padding:30px; }
        .ip-attack dt{text-align:center;}
        .ip-attack dd{font-size:16px; color:#d9d9d9; text-align:center;}
        .tips{text-align:center; font-size:14px; line-height:50px; color:#fff;}
    </style>

    
</head>
<body>
    <div class="ip-attack"><dl>
        <?php switch ($code) {?>
            <?php case 1:?>
            <dt style="color: green"><?php echo(strip_tags($msg));?></dt>
            <?php break;?>
            <?php case 0:?>
            <dt style="color: red"><?php echo(strip_tags($msg));?></dt>
            <?php break;?>
        <?php } ?>
        <br>
        <dt>
<span style="color:#fff">页面自动 </span><a id="href" href="<?php echo($url);?>">跳转</a> <span style="color:#fff">等待时间： </span> <b id="wait" style"color:#fff"><?php echo($wait);?></b>
        </dt></dl>
    </div>
    <script type="text/javascript">
        (function(){
            var wait = document.getElementById('wait'),
                href = document.getElementById('href').href;
            var interval = setInterval(function(){
                var time = --wait.innerHTML;
                if(time <= 0) {
                    location.href = href;
                    clearInterval(interval);
                };
            }, 1000);
        })();
    </script>
</body>
</html>