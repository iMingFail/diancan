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
    <link rel="stylesheet" type="text/css" href="<?php  echo $this->cur_mobile_path?>/css/food.css"/>
    <link rel="stylesheet" type="text/css" href="<?php  echo $this->cur_mobile_path?>/css/fakeLoader.css">
    <script src="<?php  echo $this->cur_mobile_path?>/script/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="http://api.map.baidu.com/api?ak=qen1OGw9ddzoDQrTX35gote2&v=2.0&services=false"></script>
    <script src="./mindex/jquery-1.8.3.min.js"></script>
</head>
<body>
<div class="fakeloader"></div>
<div id="wrap">
    <header class="bar bar-nav">
        <a class="button button-link button-nav pull-left" href="javascript:void(0)" onclick="history.go(-1)">
             <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1525771380646&di=b90d793de5fade6d03e4fbe4f14ad0ee&imgtype=0&src=http%3A%2F%2Fimgsrc.baidu.com%2Fimage%2Fc0%253Dpixel_huitu%252C0%252C0%252C294%252C40%2Fsign%3D7c4d2e6d084f78f0940692b310496f39%2Fa08b87d6277f9e2f80a8ad311430e924b899f36e.jpg" alt="">
        </a>
        <h1 class="Nav fa fa-navicon" ></h1>
    </header>

    <div class="content">
    <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1525771380646&di=b90d793de5fade6d03e4fbe4f14ad0ee&imgtype=0&src=http%3A%2F%2Fimgsrc.baidu.com%2Fimage%2Fc0%253Dpixel_huitu%252C0%252C0%252C294%252C40%2Fsign%3D7c4d2e6d084f78f0940692b310496f39%2Fa08b87d6277f9e2f80a8ad311430e924b899f36e.jpg" alt="" class="food">
        <ul>

            <li>
                <div class="divleft" style="letter-spacing:2px;">
                    &nbsp;AB<br/>
                    OUT<br/>
                    &nbsp;&nbsp;&nbsp;|
                </div>
                 <div class="divright">
                   卤肉饭
                </div>
            </li>
            <li>
                <div class="divleft">

                </div>
                 <div class="material">
                   五花肉•酱油•白糖•盐•五花肉<br/>
                   白米饭•葱•姜•蒜
                </div>
            </li>
             <li>
                <div class="divleft">
                    ￥45
                </div>
                 <div class="material">
                    <i class="add">
                        <img src="./mindex/add.png" alt="">
                    </i>
                    <input type="text" class="inputnum" value="1">

                    <i class="reduce">
                        <img src="./mindex/reduce.png" alt="">

                    </i>
                </div>
            </li>
              <li>
                <div class="divleft">
                    备注
                </div>
                 <input type="text" class="divcontent" >

            </li>
             <li>
                <div class="divbtu">
                    <img src="./mindex/true.png"  class="true">确定
                </div>
            </li>


        </ul>
    </div>
   <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
</div>
<!-- <div class="alert1">

</div> -->
<div class="alert_content">
    <div class="alert_contenti">
        <div class="alert_top">
            <p><a href=""><i>按销量排序</i></a></p>
            <p><a href=""><i>价钱由高到底</i></a></p>
            <p><a href=""><i>价钱由低到高</i></a></p>
        </div>
    </div>
</div>
    <script>
        $(".fa-navicon").toggle( function(){
        // $(".alert1").show();
        $(".alert_content").show();
    },function(){
        // $(".alert1").hide();
        $(".alert_content").hide();
     })

    $(".add").click(function(event) {
      val =$('.inputnum').val();
      $('.inputnum').val(++val)
    });
    $(".reduce").click(function(event) {
      val =$('.inputnum').val();
      if(val<=0){
        $('.inputnum').val(0)
        return;
      }
      $('.inputnum').val(--val)
    });
    </script>
    </body>
</html>
