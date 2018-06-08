<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
<title>分类页</title>
 <meta content="target-densitydpi=320,width=640,user-scalable=no" name="viewport">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta name="applicable-device" content="mobile">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <link rel="stylesheet" type="text/css" href="<?php  echo $this->cur_mobile_path?>/css/api.css"/>
    <link rel="stylesheet" type="text/css" href="<?php  echo $this->cur_mobile_path?>/css/common.css"/>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php  echo $this->cur_mobile_path?>/css/class.css"/>
    <link rel="stylesheet" type="text/css" href="<?php  echo $this->cur_mobile_path?>/css/fakeLoader.css">
    <script src="<?php  echo $this->cur_mobile_path?>/script/jquery-1.8.3.min.js"></script>
    <script src="<?php  echo $this->cur_mobile_path?>/script/jquery.fly.min.js"></script>
    <script type="text/javascript" src="http://api.map.baidu.com/api?ak=qen1OGw9ddzoDQrTX35gote2&v=2.0&services=false"></script>
</head>
<body>
<div class="fakeloader"></div>
<div id="wrap">
<?php
    $_GET["l"] =$_GET["l"]?$_GET["l"]:"jp";
    $txt = '../web/'.$_GET["l"].'.txt';
    $languagetxt = '../web/language_'.$_GET["l"].'.txt';
    $arr = unserialize(file_get_contents($txt));
    $languagearr = unserialize(file_get_contents($languagetxt));
  ?>
    <header class="bar bar-nav">
        <a class="button button-link button-nav pull-left" >
    <marquee width="130"  direction="right" behavior="alternate" scrollamount="4" scrolldelay="88" style="float:left">
            <img src="<?php  if($category[0]['pic']) { ?><?php  echo tomedia($category[0]['pic']);?><?php  } else { ?><?php  echo tomedia('./addons/weisrc_dish/icon.jpg');?><?php  } ?>" alt="">
        </marquee>

            <span class="icon-left">
                 <?php 
                   if($_GET['l'] !="cn"){
                        if($category['0'][$_GET['l'].'_name']){
                             echo $category['0'][$_GET['l'].'_name'];
                        }else{
                            echo $category[0]['name'];

                         }
                    }else{
                        echo $category[0]['name'];
                    }
                ?>
            </span>
        </a>
        <h1 class="Nav fa fa-navicon" ></h1>
    </header>

    <div class="content">
        <ul>
          <?php  if(is_array($goodslist)) { foreach($goodslist as $goods) { ?>
            <!-- <?php  var_dump($goods);?> -->
                 <li><a href="javascript:" style="display: block;" class="detail" classid =<?php  echo $_GET['classid'];?> fid="<?php  echo $goods['id'];?>"><img src="<?php  if($goods['thumb']) { ?><?php  echo tomedia($goods['thumb']);?><?php  } else { ?><?php  echo tomedia('./addons/weisrc_dish/icon.jpg');?><?php  } ?>"/>
                <p>￥<?php  echo $goods['marketprice'];?>&nbsp;&nbsp;&nbsp;&nbsp;
                <?php 
                 if(is_array($arr[$goods['id']])){
                  $title =$arr[$goods['id']][$_GET[l]."_title"];
                    echo $title;
                }else{
                echo $goods['title'];
                }
                ?>
                <!-- <?php  echo $goods['title'];?> -->
    </p></a></li>
            <?php  } } ?>

        </ul>
    </div>
       <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
</div>
<!-- <div class="alert1">

</div> -->
    <div class="details" style="margin-bottom:100px;">
    <img src="./mindex/close.png" alt="" class="close">
    <img src="" class="foodimg food">

        <ul>

            <li>
                <div class="divleft" style="letter-spacing:2px;">
                    &nbsp;AB<br/>
                    OUT<br/>
                    &nbsp;&nbsp;&nbsp;|
                </div>
                 <div class="divright title">
                   卤肉饭
                </div>
            </li>
            <li>
                <div class="divleft">

                </div>
                 <div class="material description">

                </div>
            </li>
             <li styled="margin-bottom:56px">
                <div class="divleft marketprice">
                    ￥45
                </div>
                 <div class="material">
                    <i class="add">
                        <img src="./mindex/add.png" alt="">
                    </i>
                    <input type="text" class="inputnum" value="1" disabled>

                    <i class="reduce">
                        <img src="./mindex/reduce.png" alt="">

                    </i>
                </div>
            </li>
             <!--  <li>
                <div class="divleft remarks">
                    备注
                </div>
                 <input type="text" class="divcontent" >

            </li> -->
             <li>
                <div class="divbtu add-food" >
                    <img src="./mindex/true.png"  class="true">确定
                </div>
            </li>


        </ul>
    </div>

<div class="alert_content">
    <div class="alert_contenti" style="height:100vh;background:rgba(255,255,255,0.8)">
        <div class="alert_top">

            <p><a href="<?php  echo $jump_url;?>&classid=<?php  echo $_GET['classid'];?>&orderby=sales desc&l=<?php  echo $_GPC['l'];?>"><?php  echo $languagearr[$_GET['l'].'_sale'];?></a></p>
            <p><a href="<?php  echo $jump_url;?>&classid=<?php  echo $_GET['classid'];?>&orderby=marketprice desc&l=<?php  echo $_GPC['l'];?>"><?php  echo $languagearr[$_GET['l'].'_orderh'];?></a></p>
            <p><a href="<?php  echo $jump_url;?>&classid=<?php  echo $_GET['classid'];?>&orderby=marketprice&l=<?php  echo $_GPC['l'];?>"><?php  echo $languagearr[$_GET['l'].'_orders'];?></a></p>
        </div>
    </div>
</div>
<div class="alert_content1">
    <div class="alert_contenti1" style="height:100vh;background:rgba(255,255,255,0.8)">
        <div class="alert_top1">

            <?php  if(is_array($category1)) { foreach($category1 as $category1) { ?>
            <p><a href="<?php  echo $jump_url;?>&classid=<?php  echo $category1['id'];?>&tablesid=<?php  echo $_GET['tablesid'];?>&p=<?php 
                      if($_GET['p']){
                        echo $_GET['p'];
                      }else{
                        echo 1;

                      }
                    ?>&l=<?php  echo $_GET['l']; ?>" class="classid">
            <img src="<?php  if($category1['pic']) { ?><?php  echo tomedia($category1['pic']);?><?php  } else { ?><?php  echo tomedia('./addons/weisrc_dish/icon.jpg');?><?php  } ?>" alt="">
            <i>
              <?php 
                   if($_GET['l'] !="cn"){
                        if($category1[$_GET['l'].'_name']){
                             echo $category1[$_GET['l'].'_name'];
                        }else{
                            echo $category1['name'];

                         }
                    }else{
                        echo $category1['name'];
                    }
                ?>
            </i></a></p>
            <?php  } } ?>
            <p><a href="/app/index.php?i=<?php  echo $_GET['i']?>&c=entry&storeid=<?php  echo $_GET['storeid']?>&mode=<?php  echo $_GET['mode']?>&tablesid=<?php  echo $_GET['tablesid']?>&append=0&do=mindex&m=weisrc_dish&p=<?php echo $_GET[p]?$_GET[p]:1;?>&l=<?php echo $_GET[l]?$_GET[l]:'en';?>" class="classid">
            <img src="<?php  echo tomedia($store['logo']);?>" alt="">
             <i>  <?php 
                        echo $languagearr[$_GET['l'].'_index'];
                ?></i></a></p>
        </div>
    </div>
</div>
    <script>
        $(".fa-navicon").toggle( function(){
        $(".alert_content1").hide();
        $(".alert_content").show();
    },function(){
        $(".alert_content").hide();
     })

    $(".pull-left").toggle( function(){
        $(".alert_content").hide();
        $(".alert_content1").slideDown(400);
    },function(){
        $(".alert_content1").slideUp(400);
     })

    $(".add").click(function(event) {
      val =$('.inputnum').val();
      $('.inputnum').val(++val)
    });
    $(".reduce").click(function(event) {
      val =$('.inputnum').val();
      if(val<=1){
        $('.inputnum').val(1)
        return;
      }
      $('.inputnum').val(--val)
    });

    $(".close").click(function(event) {
        $(".details").hide();
        // $(".alert1").hide();
    });
      $(".detail").click(function(event) {
         $(".alert_content").hide();
        $(".alert_content1").hide();
        // $(".alert1").show();
        $(".add-food").show()
        classid =$(this).attr('classid');
        fid =$(this).attr('fid');
          var url = "<?php  echo $this->createMobileUrl('selectfood', array('storeid' => $storeid, 'from_user' => $from_user, 'type' => 'ajax'), true)?>";
          url = url +"&classid="+classid+"&fid="+fid+"&action=selectfood"+"&l=<?php  echo $_GET['l']?>";
          // alert(url);
        var params = {};
         $.ajax({
            url: url,
            type: "post",
            data: params,
            success: function (data) {
                // console.log(data)
                if(data){
                   data = eval('(' + data + ')');
                    $(".marketprice").html("￥"+data.marketprice);
                    $(".title").html(data.title);
                    $(".food").attr('src',data.url+'/'+data.thumb);
                    $(".inputnum").val(1);
                    $(".add-food").attr('ids',data.id);
                    $(".add-food").attr('tablesid',<?php  echo intval($_GPC['tablesid']); ?>);
                    $(".description").html(data.description);
                    $('.details').show()
                }

             }
         });
     })
    function addFly(obj,event) {

            var offset = $('#amount').offset();
            var img =$(".foodimg").attr('src');//获取当前点击图片链接
          fimg=$(".foodimg").offset();
          // alert(x.left)
            var flyer = $('<img class="u-flyer"   src="'+img+'"/>');//抛物体对象
            flyer.fly({
                start: {
                    // left: event.pageX-40,//抛物体起点横坐标
                    // top: event.pageY-20,//抛物体起点纵坐标
                    // zIndex:1111111111111,
                    left:fimg.left,//抛物体起点横坐标
                    top: fimg.top,//抛物体起点纵坐标
                },
                end: {
                    left: offset.left,//抛物体终点横坐标
                    top: offset.top,//抛物体终点纵坐标
                    width: 30,
                    height: 30,
                    zIndex:1,
                },
                onEnd:function(){
                    flyer.remove();
                    setTimeout(function(){
                     $(".details").hide();
                     $(".alert1").hide();
                    },0)
                }
            });
        }
        $(".add-food").on("click",function(){ //增加数量
              $("#amount").show();
             $(".add-food").hide()
                addFly(this,event)

                var n=$('.inputnum').val();
                var num=parseInt(n);
                if(num==0){return;}
            var url = "<?php  echo $this->createMobileUrl('UpdateDishNumOfCategorys', array('storeid' => $storeid, 'from_user' => $from_user), true)?>";
            var params = {
                'dishid': $(this).attr('ids'),
                'tablesid': $(this).attr('tablesid'),
                'o2uNum': num,
                'thumb':$(".foodimg").attr('src')
            };
            // alert(num);return;
            $.ajax({
                url: url,
                type: "post",
                data: params,
                dataType: "json",
                success: function (data) {
                    console.log(data['message'].totalcount)

                     $("#amount").html(data['message'].totalcount);

                 }
             });

            });


    </script>
    </body>
</html>
