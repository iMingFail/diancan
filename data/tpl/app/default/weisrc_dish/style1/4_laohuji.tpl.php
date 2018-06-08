<?php defined('IN_IA') or exit('Access Denied');?>﻿<!DOCTYPE html>
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

<style type="text/css">
body, div, dl, dt, dd, ul, ol, li, h1, h2, h3, h4, h5, h6, pre, code, form, fieldset, legend, input, button, textarea, blockquote, th, td, p { margin:0; padding:0 }
input, button, select, textarea, a:fouse {outline:none}
li {list-style:none;}
img {border:none;}
textarea {resize:none;}
body {margin:0;font:12px "微软雅黑"; background:white;}
/* === End CSS Reset ========== */
/* body{max:600px;_width:expression((document.documentElement.clientWidth||document.body.clientWidth)<600?"600px":"");background:url(./mindex/laohujibg.png);} */
body{width:640px;height:100vh;background:url(./mindex/laohujibg.png);background-size:100% 100%;}
a{text-decoration:none;}
.clearfix:after {visibility:hidden;display:block;font-size:0;content:" ";clear:both;height:0;}
.clearfix{*zoom:1;}
.container{width:600px;margin:0 auto;position:relative;/*height:198px;*/}
/* main2 */
.main2{background:url("./mindex/main2.png") no-repeat center;
height:689px;position:relative;left:0%;top:30px;}
.main3{_width:expression((document.documentElement.clientWidth||document.body.clientWidth)<600?"600px":"");}
.main3-text{color:#744b00;font-size:23px;font-weight:bold;position:absolute;left:74px;top:210px;}
.main3-text2{color:#744b00;font-size:14px;position:absolute;left:74px;top:254px;line-height:22px;width:867px;}
.main-text{position:absolute;left:360px;top:325px;color:#b03b01;font-size:16px;}
.main2-text1{position:absolute;left:79px;top:45px;color:#ffffff;font-size:16px;}
.main2-text2{position:absolute;left:69px;top:67px;color:#ffffff;font-size:23px;font-weight:bold;}
.main2-text2 span{color:#ffff00;}
.main2-text3{position:absolute;left:69px;top:97px;color:#ffffff;font-size:18px;}
.main2-text4{position:absolute;left:382px;top:34px;color:#ffffff;font-size:18px;}
.main2-text4 span{color:#ffe700;font-weight:bold;}
.main2-text5{position:absolute;left:665px;top:34px;color:#ffffff;font-size:18px;}
.main2-text5 span{color:#ffe700;font-weight:bold;}
.num{position:absolute;left:133px;top:329px;width:112px;height:152px;overflow:hidden;}
.num-con{position:relative;top:-304px;}
.num-img{background:url("./mindex/num.png") no-repeat;width:124px;height:1520px;margin-bottom:4px;}
.num2{left:244px;}
.num3{left:355px;}
.main3-btn{width:150px;height:150px;margin:60px auto;cursor:pointer;background:url(./mindex/btn.png);background-size:100% 100%;}
</style>

    <script src="./mindex/jquery-1.8.3.min.js"></script>
</head>
<body>
 <!--   <a href="/app/index.php?i=<?php  echo $_GET['i']?>&c=entry&storeid=<?php  echo $_GET['storeid']?>&mode=<?php  echo $_GET['mode']?>&tablesid=<?php  echo $_GET['tablesid']?>&append=0&do=mindex&m=weisrc_dish&p=<?php echo $_GET[p]?$_GET[p]:1;?>">
        <img src="./mindex/close.png" alt="" style="width:50px;position:absolute;right: 30px;top:50px;z-index:8888">
    </a> -->
<div class="main2">
    <div class="container">
        <div class="num num1">
            <div class="num-con num-con1">
                <div class="num-img"></div>
                <!-- <div class="num-img"></div> -->
            </div>
        </div>
        <div class="num num2">
            <div class="num-con num-con2">
                <div class="num-img"></div>
                <!-- <div class="num-img"></div> -->
            </div>
        </div>
        <div class="num num3">
            <div class="num-con num-con3">
                <!-- <div class="num-img"></div> -->
                <div class="num-img"></div>
            </div>
        </div>
    </div>
</div>

<div class="main3">
    <div class="container">
        <div class="main3-btn"></div>
    </div>
</div>

</body>
</html>
<script type="text/javascript"  src="./mindex/jquery.js"></script>
<script type="text/javascript">


var flag=false;
var index=0;
var TextNum1
var TextNum2
var TextNum3

function letGo(){
    var t = Math.floor(Math.random()*10+1);
    console.log(t);
    var v;
    switch(t){
        case 1:
        case 2:
        case 3:
        case 4:
        case 5:
            v = Math.floor(Math.random()*9);
            TextNum1=parseInt(v);//随机数
            TextNum2=parseInt(v);
            TextNum3=parseInt(v);
            break;
        default:
            TextNum1=parseInt(Math.random()*Math.floor(Math.random()*9));//随机数
            TextNum2=parseInt(Math.random()*Math.floor(Math.random()*9));
            TextNum3=parseInt(Math.random()*Math.floor(Math.random()*9));
    }



    var num1=[0,-152,-304,-456,-608,-760,-912,-1064,-1216,-1368][TextNum1];
    var num2=[0,-152,-304,-456,-608,-760,-912,-1064,-1216,-1368][TextNum2];
    var num3=[0,-152,-304,-456,-608,-760,-912,-1064,-1216,-1368][TextNum3];

    // var num1=[-549,-668,-786,-904][TextNum1];//在这里随机
    // var num2=[-1377,-1495,-1614,-430,-549,-668,-786,-904][TextNum2];
    // var num3=[-1377,-1495,-1614,-430,-549,-668,-786,-904][TextNum3];
    $(".num-con1").animate({"top":-1064},1000,"linear", function () {
        $(this).css("top",0).animate({"top":num1},1000,"linear");
    });
    $(".num-con2").animate({"top":-1064},1000,"linear", function () {
        $(this).css("top",0).animate({"top":num2},1800,"linear");
    });
    $(".num-con3").animate({"top":-1064},1000,"linear", function () {
        $(this).css("top",0).animate({"top":num3},1300,"linear");
    });
    number =[];
    number['num1'] =num1;
    number['num2'] =num2;
    number['num3'] =num3;
    console.log(number)
    return number;

}

function reset(){
    // $(".num-con1,.num-con2,.num-con3").css({"top":-420});
}
$(".main3-btn").click(function () {
    if(!flag){
        flag=true;
        reset();
        array = letGo();
        // alert(array['num1'])
        setTimeout(function () {
             if(array['num1']==array['num2']&& array['num1']==array['num3']){
                // alert("恭喜您，中奖了!")
                alert("おめでとう")
                window.location.href="/app/index.php?i=<?php  echo $_GET['i']?>&c=entry&storeid=<?php  echo $_GET['storeid']?>&mode=<?php  echo $_GET['mode']?>&tablesid=<?php  echo $_GET['tablesid']?>&append=0&do=mindex&m=weisrc_dish&p=<?php echo $_GET[p]?$_GET[p]:1;?>&l=<?php echo $_GET[l]?$_GET[l]:'jp';?>";
             }else{
                // alert("很遗憾，没有中奖!")
                alert("残念")

                 window.location.href="/app/index.php?i=<?php  echo $_GET['i']?>&c=entry&storeid=<?php  echo $_GET['storeid']?>&mode=<?php  echo $_GET['mode']?>&tablesid=<?php  echo $_GET['tablesid']?>&append=0&do=mindex&m=weisrc_dish&p=<?php echo $_GET[p]?$_GET[p]:1;?>&l=<?php echo $_GET[l]?$_GET[l]:'jp';?>";

             }

            // flag=false;
            // if(index==2){
            //     // alert(111)
            //     $(".fix,.pop-form").show();
            // }else{
            //     // alert(222)
            //     $(".fix,.pop").show();
            //     $(".pop-text span").text(""+String(4-TextNum1)+(8-TextNum2))
            // }
        },3000);
        // index++;
    }
});
</script>


    </body>
</html>
