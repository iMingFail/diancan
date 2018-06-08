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
    <link rel="stylesheet" type="text/css" href="<?php  echo $this->cur_mobile_path?>/css/mindex.css"/>
    <link rel="stylesheet" type="text/css" href="<?php  echo $this->cur_mobile_path?>/css/fakeLoader.css">
    <link rel="stylesheet" type="text/css" href="./mindex/swiper.min.css">
    <script src="<?php  echo $this->cur_mobile_path?>/script/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="http://api.map.baidu.com/api?ak=qen1OGw9ddzoDQrTX35gote2&v=2.0&services=false"></script>
    <script src="./mindex/jquery-1.8.3.min.js"></script>
    <script src="./mindex/swiper.min.js"></script>
    <style>
    .swiper-container{
      width: 100%;
      height: 100%;
    }
    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;

      /* Center slide text vertically */
      display: -webkit-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      -webkit-justify-content: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      -webkit-align-items: center;
      align-items: center;
    }

    </style>
</head>
<body>
<div class="fakeloader"></div>
<?php
  $_GET["l"] =$_GET["l"]?$_GET["l"]:"jp";
    $txt = '../web/store_'.$_GET["l"].'.txt';
    $arr = unserialize(file_get_contents($txt));
     $storeid = $_GET['storeid'];
    if(is_array($arr[$storeid])){

      $title =$arr[$storeid][$_GET[l]."_title"];
      $address =$arr[$storeid][$_GET[l]."_address"];

    }
  ?>
<div id="wrap">
    <header class="bar bar-nav">
        <a class="button button-link button-nav pull-left" href="javascript:void(0)">
          <img src="<?php  echo tomedia($store['logo']);?>" alt="">
        </a>
        <h1 class="Nav fa fa-navicon" ></h1>
    </header>

    <div class="content">
        <div class="list-block address-editor">
            <div class="swiper-container" style="margin-bottom: 110px;">
                <div class="swiper-wrapper">
                 <?php   $store['thumbs'] = iunserializer($store['thumbs']); ?>
             <?php  if(!empty($store['thumbs'])) { ?>
            <?php  if(is_array($store['thumbs'])) { foreach($store['thumbs'] as $slide) { ?>
               <div class="swiper-slide"><a href="<?php  echo $slide['url']; ?>"><img src="<?php  echo tomedia($slide['image']);?>" alt="" width="100%" height="400px"></a></div>
            <?php  } } ?>

            <?php  } ?>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
              </div>

                <ul class="full-width-form full-width-form2">

                    <li>
                        <img src="./mindex/people.png" alt="" style="top:20px">
                        <select name="counts" id="counts1" onchange="select_count(this)">

                            <?php  for($i = 1;$i<=10;$i++){?>
                                  <option value="<?php  echo $i;?>" <?php 

                                    if($i ==$_GPC['p']){
                                      echo "selected";
                                    }
                                   ?> ><?php  echo $i;?>
                                    <?php 
                                   $languagetxt = '../web/language_'.$_GET["l"].'.txt';
                                   $languagearr = unserialize(file_get_contents($languagetxt));
                                    echo $languagearr[$_GET['l'].'_p'];;?>
                                  </option>
                              <?php  }?>
                                <option value="11" ><?php  echo $languagearr[$_GET['l'].'_more'];?></option>

                        </select>
                    </li>

            </ul>
             <ul class="full-width-form full-width-form2">
                      <li>
                        <img src="./mindex/lauguage.png" alt="">
                        <select name="counts" id="counts" class ="select_Language">
                           <!--  <option value="cn"
                            <?php  if($_GET['l']=="cn"){
                                echo "selected";
                            }; ?>
                            >Language</option> -->
                            <option value="en"
                               <?php  if($_GET['l']=="en"){
                                echo "selected";
                            }; ?>
                            >English</option>
                              <option value="jp"
                               <?php  if($_GET['l']=="jp"){
                                echo "selected";
                            }; ?>
                            >日本语</option>
                            <option value="cn"
                             <?php  if($_GET['l']=="cn"){
                                echo "selected";
                            }; ?>
                            >简体中文</a></option>
                              <option value="ft"
                             <?php  if($_GET['l']=="ft"){
                                echo "selected";
                            }; ?>
                            >繁体中文</a></option>
                            <option value="py"
                               <?php  if($_GET['l']=="py"){
                                echo "selected";
                            }; ?>
                            >py</option>
                            <option value="hw"
                               <?php  if($_GET['l']=="hw"){
                                echo "selected";
                            }; ?>
                            >韩文</option>

                        </select>
                    </li>


            </ul>
            </div>


            <div class="list-block"  styled="overflow:hidden;">
                <ul class="full-width-form full-width-form1" style="width:97%;background:none;border:none;margin-top:30px">
                   <?php  if(is_array($category)) { foreach($category as $item) { ?>

                    <li class="item-content1">
                    <a href="<?php  echo $jump_url;?>&classid=<?php  echo $item['id'];?>&tablesid=<?php  echo $_GET['tablesid'];?>&p=<?php 
                      if($_GET['p']){
                        echo $_GET['p'];
                      }else{
                        echo 1;

                      }
                    ?>&l=<?php  echo $_GET['l']; ?>" class="hrefs">
                    <img src="<?php  if($item['pic']) { ?><?php  echo tomedia($item['pic']);?><?php  } else { ?><?php  echo tomedia('./addons/weisrc_dish/icon.jpg');?><?php  } ?>" alt="">
                        <?php 
                          if($_GET['l'] !="cn"){
                            if($item[$_GET['l'].'_name']){
                             echo $item[$_GET['l'].'_name'];
                            }else{
                              echo $item['name'];

                            }
                          }else{
                            echo $item['name'];
                          }
                        ?>
                    </a>
                    </li>

                  <?php  } } ?>

                <div style="clear:both;"></div>
                </ul>
            </div>

            <div class="list-block words"   >OUR<br/>BEST FOOD
            </div>
                <?php  if(is_array($intelligent_goods)) { foreach($intelligent_goods as $goods) { ?>
                <a  style="display: block;">
                 <img class="imgs"  src="<?php  if($goods[0]['thumb']) { ?><?php  echo tomedia($goods[0]['thumb']);?><?php  } else { ?><?php  echo tomedia('./addons/weisrc_dish/icon.jpg');?><?php  } ?>"><br/></a>
                <?php  } } ?>



        </div>
    </div>
   <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
</div>
<!-- <div class="alert1">

</div> -->
<div class="alert_content" >


    <div class="alert_contenti" style="background:url(./mindex/touming.png);height:400px">
        <div class="alert_top" style="width: 48%;margin: 20px;">
            <p><img src="./mindex/home.png"><i>
              <?php 
                if(is_array($arr[$storeid])){
                  echo $title;
                }else{
                  echo  $store['title'];
                }
                ?>
            </i></p>
            <p><img src="./mindex/address.png"><i>
              <?php 
                if(is_array($arr[$storeid])){
                  echo $address;
                }else{
                  echo  $store['address'];
                }
                ?>

            </i></p>
            <p><img src="./mindex/tel.png"><i><?php  echo $store['tel'];?></i></p>
            <p><img src="./mindex/wifi.png"><i><?php  echo $store['wifi'];?></i></p>
            <p><img src="./mindex/pass.png"><i><?php  echo $store['wifipwd'];?></i></p>
            <!-- <p><img src="./mindex/f.png"><i>扫码加关注</i></p> -->
        </div>
        <!-- <img src="/attachment/<?php  echo $store['kefu_qrcode'];?>" alt="" class="erweima"> -->
    </div>
</div>
 <?php  if($_GET['op'] == 'alert') { ?>
 <div class="trueorder">
        <div class="alert_trueorder">
        <a href="./index.php?i=<?php  echo $_GET['i'] ?>&c=entry&storeid=<?php  echo $_GET['storeid'] ?>&mode=2&do=mindex&m=weisrc_dish"><img src="./mindex/waimai.png" alt="" class="succ"></a>
        <a href="./index.php?i=<?php  echo $_GET['i'] ?>&c=entry&storeid=<?php  echo $_GET['storeid'] ?>&mode=3&selectdate=&timeid=8&rtype=2&do=reservationdetails&m=weisrc_dish"><img src="./mindex/yuyue.png" alt="" class="succ"></a>

        </div>
</div>
<?php  } ?>
    <script>
        $(".fa-navicon").toggle( function(){
        // $(".alert1").show();
        $(".alert_content").show();
    },function(){
        // $(".alert1").hide();
        $(".alert_content").hide();
     })

      function select_count() {
        $(".hrefs").each(function(){
            $(this).attr('href', $(this).attr('href')+"&p="+$('#counts1 option:selected').val())
        })
      }
       $(".select_Language").change(function(event) {
         /* Act on the event */
          v = $('.select_Language option:selected') .val();//选中的值
          window.location.href="<?php  echo $this->createMobileUrl('mindex', array('storeid' => $_GET['storeid'], 'mode' => $_GET['mode'], 'tablesid' => $_GET['tablesid'], 'type' => 1), true)?>&l="+v;
       })

      $(function(){
        $(".hrefs").each(function(){
            // $(this).attr('href', $(this).attr('href')+"&p=1")
        })
      })
    var swiper = new Swiper('.swiper-container', {
          pagination: {
            el: '.swiper-pagination',
          },
          autoplay: {
          delay: 3000,
          disableOnInteraction: false,
        },
    });
    </script>
    </body>
</html>
