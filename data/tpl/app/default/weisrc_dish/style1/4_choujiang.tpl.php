<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0092)http://www.17sucai.com/preview/622723/2016-09-23/230ed9488a537f8c10aaf2e48195df7f1/demo.html -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

 <meta content="target-densitydpi=320,width=640,user-scalable=no" name="viewport">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta name="applicable-device" content="mobile">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
<title>大转盘抽奖</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link href="./zhuanpan/component.css" rel="stylesheet" type="text/css">
<link href="./zhuanpan/style.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="./zhuanpan/jquery-1.10.2.js.下载"></script>
<script type="text/javascript" src="./zhuanpan/awardRotate.js.下载"></script>
<script type="text/javascript" src="./zhuanpan/index.js.下载"></script>

</head>
<body >
<a href="/app/index.php?i=<?php  echo $_GET['i']?>&c=entry&storeid=<?php  echo $_GET['storeid']?>&mode=<?php  echo $_GET['mode']?>&tablesid=<?php  echo $_GET['tablesid']?>&append=0&do=mindex&m=weisrc_dish&p=<?php echo $_GET[p]?$_GET[p]:1;?>&l=<?php echo $_GET[l]?$_GET[l]:'jp';?>">
        <img src="./mindex/close.png" alt="" style="width:90px;position:absolute;right: 40px;top:107px;z-index:8888;opacity: 0;">
    </a>
    <!-------------抽奖页面-------------->
    <div class="ml-main" id="ml-main" style="background:url(./mindex/bg.png);background-size:100% 100%;">
        <div class="kePublic">
            <!--转盘效果开始-->
            <div style="max-width:640px; margin:0 auto">
                <div class="banner">
                    <div class="turnplate" style="background-image:url(./mindex/turnplate-bg_2.png);background-size:100% 100%;">
                        <canvas class="item" id="wheelcanvas" width="516" height="516" style="transform: rotate(240deg);"></canvas>
                        <img id="tupBtn" class="pointer" src="./mindex/go.png">
                        <!--<button id="tupBtn"><img src="images/turnplate-pointer_2.png"/></button>-->
                    </div>
                </div>
            </div>
            <!--转盘效果结束-->
            <div class="clear"></div>
        </div>
        <div class="content">
        <div class="fcontent" style="background:url(./mindex/txt.png);background-size: 100% 100%">
        <div class="tcontent">
            <p ><i class="pcontent">カミングアウト</i><img src="./mindex/clo.png" class="clo" ></p>
           <!--  <p ><i class="pcontent">做俯卧撑10个2</i><img src="./mindex/close.png" class="clo" ></p>
            <p ><i class="pcontent">做俯卧撑10个3</i><img src="./mindex/close.png" class="clo" ></p> -->
            </div>
            <p><span class="send"  style="background:url(./mindex/send.png);background-size: 100% 100%"></span></p>
               <p class="input"><input type="text" class="value" style="background:url(./mindex/input.png);background-size: 100% 100%"><img src="./mindex/ok1.png" class="true" ></p>
       </div>
            <button class="edit" style="background:url(./mindex/edit.png);background-size: 100% 100%"></button>
             <button class="Refresh" style="background:url(./mindex/ref.png);background-size: 100% 100%"></button>
        </div>
        <!-- <div class="content" style="padding:0px">
            <p><input type="text" class="value"><img src="./mindex/close.png" class="true" ></p>
        </div> -->

    </div>



    <!-------------中奖弹窗页面-------------->
    <div class="zj-main" id="zj-main" style="display: none;">
            <div class="txzl">
                <h3>HI 亲！人品爆发！</h3>
                <h2>恭喜抽中<br><span id="jiangpin"></span></
            </div>
            <div class="close_zj"><img src="./zhuanpan/close_1.png"></div>
    </div>

    <!-------------谢谢参与弹窗-------------->
    <div class="xxcy-main" id="xxcy-main">
        <div class="xxcy">
            <h3>谢谢参与！</h3>
            <p>不要气馁，明天继续投票还可以抽奖哦。</p>

        </div>
        <div class="close_xxcy"><img src="./zhuanpan/close_1.png"></div>
    </div>

    <!-------------提交成功弹窗-------------->
   <!--  <div class="tjcg-main" id="tjcg-main">
        <div class="tjcg">
            <h3>恭喜您提交成功</h3>
            <p>请于2016年5月31日<br>前到院领取奖品</p>

        </div>
        <div class="close_tjcg"><img src="./zhuanpan/close_1.png"></div>
    </div> -->
<script>
$(function(){
    $(".fcontent").hide()
    $(".true").click(function(){
        if(!$(".value").val()){
            // alert("请输入内容");
            alert("入力してください。");
            return ;
        }
        $(".send").show()
        $(".true").attr('src','./mindex/ok1.png')

        $(".tcontent").append(' <p ><i class="pcontent">'+$(".value").val()+'</i><img src="./mindex/clo.png" class="clo" ></p>')
         $(".send").show()
          $(".clo").click(function() {
        // alert(111)
           $(this).parent().remove()
        });
          $(".value").val('')
    });
     var arrays=new Array()
    $(".send").click(function(event) {
         $(".fcontent").hide()
         $(".input input").val('')
       $(".pcontent").each(function(){
           arrays.push($(this).html());
       })
       $(this).hide()
       $(".tcontent").html('')
       //动态添加大转盘的奖品与奖品区域背景颜色
      turnplate.restaraunts =arrays ;
       console.log( turnplate.restaraunts);
        drawRouletteWheel();
    });
     $(".clo").click(function() {
        // alert(111)
       $(this).parent().remove()
    });
     $(".Refresh").click(function(event) {
        $(".input input").val(' ')
        $(".pcontent").html('')
        $(".fcontent").hide()
        turnplate.restaraunts = [ "111333331", "多效水光\n体验券", "面膜", "50元\n话费卡", "洁牙券"];
           drawRouletteWheel();
     });
      $(".edit").click(function(event) {
        $(".send").hide()
        $(".fcontent").show()
        $(".tcontent").show()
     });

    $(".value").click(function(event) {
        $(".true").attr('src','./mindex/ok.png')
    });

})

</script>
</body></html>