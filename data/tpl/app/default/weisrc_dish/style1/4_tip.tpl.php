<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
<title>首页</title>
 <meta content="target-densitydpi=320,width=640,user-scalable=no" name="viewport">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta name="applicable-device" content="mobile">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <link rel="stylesheet" type="text/css" href="<?php  echo $this->cur_mobile_path?>/css/api.css"/>
    <link rel="stylesheet" type="text/css" href="<?php  echo $this->cur_mobile_path?>/css/common.css"/>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php  echo $this->cur_mobile_path?>/css/orders.css"/>
    <link rel="stylesheet" type="text/css" href="<?php  echo $this->cur_mobile_path?>/css/fakeLoader.css">
    <script src="<?php  echo $this->cur_mobile_path?>/script/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="http://api.map.baidu.com/api?ak=qen1OGw9ddzoDQrTX35gote2&v=2.0&services=false"></script>
    <style>
       .mui-content-padded{
            width: 400px;
            height: 300px;
            margin: 100px auto 100px;
        }
        .title{
            text-align:center;
             font-size:30px;
            margin: 40px auto 100px;

        }
    </style>
    <script src="./mindex/jquery-1.8.3.min.js"></script>
</head>
<body>
<div class="fakeloader"></div>
<div id="wrap">
<div class="mui-content-padded"><div class="mui-message"><div class="mui-message-icon"><span class="mui-msg-success" style="background:url(/app/resource/images/msg-success.png);width:200px;height:200px;display:block;margin:auto" ></span></div>
<!-- <h4 class="title">已经通知服务员，请耐心等待!</h4> -->
<h4 class="title">スタッフを呼び出しました。少々お待ちください。</h4>
<p class="mui-desc"></p>
   <!-- <div class="mui-button-area"><a href="/app/index.php?i=4&amp;c=entry&amp;storeid=37&amp;mode=1&amp;tablesid=281&amp;append=0&amp;do=mindex&amp;m=weisrc_dish" class="mui-btn mui-btn-success mui-btn-block">确定</a></div> -->
   </div></div>
   <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
   <script >
   setTimeout(function(){
       window.location.href="/app/index.php?i=<?php  echo $_GET['i']?>&c=entry&storeid=<?php  echo $_GET['storeid']?>&mode=<?php  echo $_GET['mode']?>&tablesid=<?php  echo $_GET['tablesid']?>&append=0&do=mindex&m=weisrc_dish&p=<?php echo $_GET[p]?$_GET[p]:1;?>&l=<?php echo $_GET[l]?$_GET[l]:'jp';?>"

   },1000)
   </script>
</div>

    </body>
</html>
