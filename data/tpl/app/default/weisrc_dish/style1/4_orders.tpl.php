<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
<title>订单页</title>
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
    <script src="./mindex/jquery-1.8.3.min.js"></script>
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
        <a class="button button-link button-nav pull-left" href="javascript:" onclick="history.go(-1)" >
            <span class="icon-left" style="background:url(./mindex/ic_back.png);margin-top：-10px"></span>
        </a>
        <h1 class="Nav " ><?php  echo $languagearr[$_GET['l'].'_trueorder'];?></h1>
    </header>

    <div class="content">
        <ul>

            <?php  if(is_array($cart)) { foreach($cart as $key => $item) { ?>

            <?php  if($item['total']>0) { ?>

            <li style="background:<?php 
                ++$key;
                if($key%2!=0){
                  echo "#f2f2f2";
                }else{
                  echo "#fff";
                }
             ?>">
                <div class="divleft" style="letter-spacing:2px;">
                   <img src="<?php  echo tomedia($item['thumb']);?>" alt="" class ="addfood">
                </div>
                 <div class="divcenter">

                   <p class="fan"><?php  echo $item['title'];?></p>
                   <p class="price">￥<?php  echo $item['price'];?></p>
                </div>
                   <div class="divright">
                   <p class="del" ids="<?php  echo $item['goodsid'];?>">
                        <img src="./mindex/del.png" alt="">
                    </p>
                    <i class="add" ids="<?php  echo $item['goodsid'];?>">
                        <img src="./mindex/add.png" alt="">
                    </i>
                    <input type="text" class="inputnum" value="<?php  echo $item['total'];?>" disabled="">

                    <i class="reduce" ids="<?php  echo $item['goodsid'];?>">
                        <img src="./mindex/reduce.png" alt="">

                    </i>
                </div>

            </li>

            <?php  } ?>

            <?php  } } ?>

        </ul>
          <div style="clear: both;">
        </div>
         <?php  if($totalcount>0) { ?>
         <div class="info">
              <?php 
            if($_GET['mode']==2){

            ?>


           <p class="Remarks">
                  <em><?php  echo $languagearr[$_GET['l'].'_name']?>：</em>
                <input type="text" class="divcontent remark username" value="<?php  echo
                $_SESSION['userinfo']['username']; ?>"></p>
             <p class="Remarks">
                  <em><?php  echo $languagearr[$_GET['l'].'_tel'];?>：</em>
                <input type="text" class="divcontent remark tel" value="<?php  echo
                $_SESSION['userinfo']['tel']; ?>"></p>
            <p class="Remarks">
                  <em><?php  echo $languagearr[$_GET['l'].'_code'];?>：</em>
                   <select class="code" name="code" >

                <?php  if(is_array($dispatcharea)) { foreach($dispatcharea as $row) { ?>
                <option value="<?php  echo $row['code'];?>"  id="<?php  echo $row['title'];?>"><?php  echo $row['code'];?></option>
                <?php  } } ?>
            </select>
               </p>

              <p class="Remarks address areas" >
                  <em><?php  echo $languagearr[$_GET['l'].'_area'];?>：</em>
                <input type="text" class="divcontent remark area" disabled ></p>

               <p class="Remarks address">
                  <em><?php  echo $languagearr[$_GET['l'].'_address'];?>：</em>
              <!--   <input type="text" class="divcontent remark addressd" value="<?php  echo
                $_SESSION['userinfo']['tel']; ?>"></p> -->
                    <textarea  class="divcontent remark addressd" style="
                 border-bottom:3px solid black;
                line-height: 30px;"><?php  echo
                $_SESSION['userinfo']['tel']; ?></textarea>
            <?php 
            }
        ?>
        <div style="clear:both">

        </div>
        <?php 
            if($_SESSION['userinfo']){

            ?>
           <p class="Remarks">
                  <em><?php  echo $languagearr[$_GET['l'].'_name'];?>：</em>
                <input type="text" class="divcontent remark username" value="<?php  echo
                $_SESSION['userinfo']['username']; ?>"></p>
             <p class="Remarks">
                  <em><?php  echo $languagearr[$_GET['l'].'_tel'];?>：</em>
                <input type="text" class="divcontent remark tel" value="<?php  echo
                $_SESSION['userinfo']['tel']; ?>"></p>

             <p class="Remarks">
                  <em><?php  echo $languagearr[$_GET['l'].'_people'];?>：</em>
                <input type="text" class="divcontent remark peoples" value="<?php  echo
                $_SESSION['userinfo']['peoples']; ?>"></p>

               <p class="Remarks" style="margin-bottom:10px;line-height: 60px;">
                  <em><?php  echo $languagearr[$_GET['l'].'_smoke'];?>：</em>

                  <input type="text" class="divcontent remark smoking" name="smoking" value="<?php  echo
                $_SESSION['userinfo']['smoking']; ?>" hidden>
                <img src="./mindex/nosmoking.png" alt="">
                <?php 
                if($_SESSION['userinfo']['smoking']==1){
                ?>
                  <img src="./mindex/slide1.png" alt="" class="styles" style="width: 100px;">
                  <?php 
                }else{

                ?>
                  <img src="./mindex/slide2.png" alt="" class="styles" style="width: 100px;">

                <?php 
                }

                ?>
                <img src="./mindex/smoke.png" alt="">
                 <p class="Remarks">
                  <em><?php  echo $languagearr[$_GET['l'].'_time'];?>：</em>
                  <!-- <?php   var_dump($_SESSION); ?> -->
                <input type="text" class="divcontent remark times" name="time" value="<?php  echo $_SESSION['userinfo']['time'];?>" style="width:45%;">

                 <!--   <select class="time" >
                <?php  if(is_array($dates)) { foreach($dates as $date) { ?>
                <option value="<?php  echo $date;?>" <?php  if($date==$_SESSION['userinfo']['time']) { ?>selected="selected"<?php  } ?>><?php  echo $date;?></option>
                <?php  } } ?>
            </select> -->

                </p>

                <p class="Remarks" style="display:none;">
                  <em><?php  echo $languagearr[$_GET['l'].'_table'];?>：</em>
                    <select name="tables" class="tables">
                        <?php  if(is_array($tables)) { foreach($tables as $item) { ?>
                        <option value="<?php  echo $item['id'];?>"  <?php  if($item['id']==$_SESSION['userinfo']['tablesid']) { ?>selected="selected"<?php  } ?>><?php  echo $item['title'];?></option>
                        <?php  } } ?>
                  </select>
                </p>
                <p class="Remarks" style="margin-bottom:40px;">
                  <em><?php  echo $languagearr[$_GET['l'].'_remark'];?>：</em>
               <!--  <input type="text" class="divcontent remark remarks" value="<?php  echo
                $_SESSION['userinfo']['remarks']; ?>" ></p> -->
                 <textarea  class="divcontent remark remarks" style="
                line-height: 30px;border-bottom:3px solid black"><?php  echo
                $_SESSION['userinfo']['remarks']; ?></textarea>
            <?php 
            }elseif(!$_SESSION['queue_orderid']){

            ?>
                  <p class="Remarks">
                  <em><?php  echo $languagearr[$_GET['l'].'_remark'];?>：</em>
                  <!-- <em>备注：</em> -->
                <!-- <input type="text" class="divcontent remark remarks" ></p> -->
               <textarea  class="divcontent remark remarks" style="
                border-bottom:3px solid black;
                line-height: 30px;"></textarea>
            <?php 

            }elseif($_SESSION['queue_orderid']){

            ?>
              <p class="Remarks">
                  <em><?php  echo $languagearr[$_GET['l'].'_remark'];?>：</em>
                  <!-- <em>备注：</em> -->
                <!-- <input type="text" class="divcontent remark remarks" ></p> -->
               <textarea  class="divcontent remark remarks" style="
                border-bottom:3px solid black;
                line-height: 30px;"></textarea>
            <?php 
            }
        ?>


        <div style="clear:both">
        </div>
        <div  class="all">
        <span class="spanl"><?php  echo $languagearr[$_GET['l'].'_num'];?>：</span><span class="spanr totalcount"><?php  echo $totalcount;?></span>
      <div style="clear:both">
        </div>

        <!--   <?php  if($mode==2) { ?>
                            <?php  if($store['freeprice']>0) { ?>
                            <?php  if($totalprice<=$store['freeprice']) { ?>
                             <span class="spanl dispatchprice">
                            配送费用<?php  if($store['freeprice']!=0.00) { ?>(<font color="#f00" style="font-size:20px">本店满<?php  echo $store['freeprice'];?>提供送餐</font>)<?php  } ?>
                           </span>
                             <span class="spanr dispatchprice">
                               ￥<?php  echo $store['dispatchprice'];?>
                           </span>
                            <?php  } ?>
                            <?php  } else { ?>
                            <span class="spanr dispatchprice">
                            配送费用<em>￥<?php  echo $store['dispatchprice'];?></em>
                            </span>
                            <?php  } ?>
                            <?php  } ?> -->
         <input type="hidden" name="" value="<?php  echo $store['freeprice'];?>" id="freeprice">
        <div style="clear:both">
        </div>
        <span class="spanl"><?php  echo $languagearr[$_GET['l'].'_count'];?>：</span>
        <span class="spanr totalprice">￥<?php  echo $totalprice;?></span>
        <div style="clear:both">
        </div>
        </div>

       <!--  <div  class="num"><span class="spanl">数量：</span><span class="spanr totalcount"><?php  echo $totalcount;?></span></div> -->

        <div class="divbtu addorder">
                    <img src="./mindex/true.png" class="true"><?php  echo $languagearr[$_GET['l'].'_true'];?>
                </div>
                </div>
         <?php  } ?>
    </div>

   <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
</div>
<div class="alert1">

</div>
<div class="alert_content">
    <div class="alert_contenti">
        <div class="alert_top">
            <p><a href=""><i>按销量排序</i></a></p>
            <p><a href=""><i>价钱由高到底</i></a></p>
            <p><a href=""><i>价钱由低到高</i></a></p>
        </div>
    </div>
</div>
<div class="trueorder">
    <div class="alert_trueorder">
    <img src="./mindex/succ.png" alt="" class="succ">
        <div class="alert_contents">
             <p styled="margin-bottom:40px;height:80px;" class="con"><?php   echo $languagearr[$_GET['l'].'_true1'];  ?>?</p>
            <p><span class="trues"><img src="./mindex/t.png" alt=""><?php   echo $languagearr[$_GET['l'].'_true2'];  ?></span><em class="cancel"><img src="./mindex/q.png" alt=""><?php   echo $languagearr[$_GET['l'].'_true3'];  ?></em></p>
        </div>
    </div>
</div>
    <script>
    $(function(){
      var jmz = {};
      jmz.GetLength = function(str) {
        ///<summary>获得字符串实际长度，中文2，英文1</summary>
        ///<param name="str">要获得长度的字符串</param>
        var realLength = 0, len = str.length, charCode = -1;
        for (var i = 0; i < len; i++) {
          charCode = str.charCodeAt(i);
          if (charCode >= 0 && charCode <= 128)
             realLength += 1;
          else
             realLength += 2;
        }
        return realLength;
      };
      $(".remarks,.addressd").keydown(function(event) {
        va = jmz.GetLength($(this).val());
        console.log(va/20)
        console.log(va/60)
        console.log(va/40)

          if(va/80>1){
            $(this).css('height','160px')
            return false;
          }
           if(va/60>1){
            $(this).css('height','140px')
            return false;
          }
           if(va/40>1){
            $(this).css('height','120px')
            return false;

          }
          if(va/20>1){
             // alert(0)
            $(this).css('height','80px')
          }
      });
      $(".succ").hide()
      v =$('.code').find("option:selected").attr('id');
      // alert(v)
       $(".area").val(v);
    })
    $(".fa-navicon").toggle( function(){
        // $(".alert1").show();
        $(".alert_content").show();
    },function(){
        // $(".alert1").hide();
        $(".alert_content").hide();
     })
    $(".styles").toggle(function(){
        v =$(".smoking").val();
        alert
        if(v==1){
          $(".smoking").val(2)
         $(this).attr('src','./mindex/slide2.png')
        }else{
           $(".smoking").val(1)
         $(this).attr('src','./mindex/slide1.png')
        }
    },function(){
        v =$(".smoking").val();
        if(v==1){
          $(".smoking").val(2)
         $(this).attr('src','./mindex/slide2.png')
        }else{
           $(".smoking").val(1)
         $(this).attr('src','./mindex/slide1.png')
        }

    })
    $(".addorder").click( function(){
        $(".trueorder").show();
        $(".alert1").show();
    })

    $(".cancel").click(function(event) {
        $(".trueorder").hide()
         $(".alert1").hide();
    });

     $(".code").change(function(event) {
          area = $(this).find("option:selected").attr('id');
          codeval = $(this).find("option:selected").val();
          if(codeval==0){
          $(".area").val('');
          $(".areas").hide();
            return;
          }
          $(".area").val(area);
          $(".areas").show();
          // alert(area)
          return;
     });
    // code = $(".code").find("option:selected").val();
    //   area = $(".code").find("option:selected").attr('id');
    //   $(".area").val(area).show();
    //   alert(area)
    //   return;
    $(".trues").click(function(event) {

       postmain();
    });
    $(".add").click(function(event) {
      val =$(this).siblings('.inputnum').val();
      $(this).siblings('.inputnum').val(++val)
       var url = "<?php  echo $this->createMobileUrl('UpdateDishNumOfCategorys', array('storeid' => $storeid, 'from_user' => $from_user), true)?>";
            var params = {
                'dishid': $(this).attr('ids'),
                'o2uNum': val,
                'thumb':$(".addfood").attr('src')
            };
            $.ajax({
                url: url,
                type: "post",
                data: params,
                dataType: 'json',
                success: function (data) {
                   $('.totalprice').html(data['message']['totalprice'])
                   $('.totalcount').html(data['message']['totalcount'])
                   $('#amount').html(data['message']['totalcount'])
                     freeprice =$("#freeprice").val();
                     totalprice = data['message']['totalprice']
                     // alert(freeprice)
                     // alert(totalprice)
                     if(totalprice>freeprice){
                        $(".dispatchprice").hide()
                     }else{
                        $(".dispatchprice").show()

                     }
                 }
       });
    });
    $(".reduce").click(function(event) {
      val =$(this).siblings('.inputnum').val();
      if(val>1){
      $(this).siblings('.inputnum').val(--val)
    }else{
      $(this).siblings('.inputnum').val(1)
    }
       var url = "<?php  echo $this->createMobileUrl('UpdateDishNumOfCategorys', array('storeid' => $storeid, 'from_user' => $from_user), true)?>";
            var params = {
                'dishid': $(this).attr('ids'),
                'o2uNum': val,
                'thumb':$(".addfood").attr('src')
            };
            $.ajax({
                url: url,
                type: "post",
                data: params,
                dataType: 'json',
                success: function (data) {
                    if(data['message']['totalcount']<=0){
                        $(".info").hide()
                    }
                    $('.totalprice').html(data['message']['totalprice'])
                    $('.totalcount').html(data['message']['totalcount'])
                    $('#amount').html(data['message']['totalcount'])
                     freeprice =$("#freeprice").val();
                     totalprice = data['message']['totalprice']
                     // alert(freeprice)
                     // alert(totalprice)
                     if(totalprice>freeprice){
                        $(".dispatchprice").hide()
                     }else{
                        $(".dispatchprice").show()

                     }
                 }
       });
       if(val<=0){
          $(this).parent().parent().remove()
       }
    });

    $(".del").click(function(){
      var url = "<?php  echo $this->createMobileUrl('UpdateDishNumOfCategorys', array('storeid' => $storeid, 'from_user' => $from_user), true)?>";
            var params = {
                'dishid': $(this).attr('ids'),
                'o2uNum': 0,
                'thumb':$(".addfood").attr('src')
            };
            $.ajax({
                url: url,
                type: "post",
                data: params,
                dataType: 'json',
                success: function (data) {
                    if(data['message']['totalcount']<=0){
                        $(".info").hide()
                        $("#amount").hide()
                    }
                   $('.totalprice').html(data['message']['totalprice'])
                   $('.totalcount').html(data['message']['totalcount'])
                   $('#amount').html(data['message']['totalcount'])
                    freeprice =$("#freeprice").val();
                     totalprice = data['message']['totalprice']
                     // alert(freeprice)
                     // alert(totalprice)
                     if(totalprice>freeprice){
                        $(".dispatchprice").hide()
                     }else{
                        $(".dispatchprice").show()

                     }
                 }
       });
       $(this).parent().parent().remove()
    })

       function postmain() {
          // alert( $(".smoking").val());return;
            var url = "<?php  echo $this->createMobileUrl('addtoorder', array('storeid' => $storeid, 'from_user' => $from_user), true)?>";
        //     url = url.split("&");
        // alert(url[5])
        //     return;
            var totalprice = parseFloat($(".totalprice").val());
            // alert($(".remark").val());return;

            $.ajax({
                url: url, type: "post", dataType: "json", timeout: "10000",
                data: {
                    "type": "add",
                    "total": totalprice,
                    "tables": <?php echo $_GET['tablesid']?$_GET['tablesid']:0; ?>,
                    "order_id" :<?php  echo $orderid;?>,
                    "counts": <?php  echo $_GET['p']; ?>,
                    "remark": $(".remarks").val(),
                    'ordertype':<?php echo $_GET['mode']?$_GET['mode']:0; ?>,

                    <?php 
                      if($_SESSION['userinfo']){
                      ?>
                    "username": $(".username").val(),
                    "tel":$(".tel").val(),
                    "meal_time":$(".time").val(),
                    "tables":$(".tables").val(),
                    'ordertype':<?php echo $_GET['mode']?$_GET['mode']:0; ?>,
                    'smoking': $(".smoking").val(),
                    <?php 
                     }
                  ?>

                    <?php 
                      if($_GET['mode']==2){
                      ?>
                    "username": $(".username").val(),
                    "tel":$(".tel").val(),
                    'ordertype':<?php echo $_GET['mode']?$_GET['mode']:0; ?>,
                    'address':$(".addressd").val(),
                    'code': $('.code').find("option:selected").val(),
                    <?php 
                     }
                  ?>
                },
                success: function (data) {
                  console.log(data)
                    if (data.message['code'] != 0) {
                        // if (data.message['code'] == 2){
                        //     alert("加菜成功");
                        //     var url = "<?php  echo $this->createMobileUrl('orderdetail', array(), true)?>" + "&orderid=" + data.message['orderid'];
                        // } else{
                            "<?php  if($store['is_order_tip'] == 1) { ?>"
                            var url = "<?php  echo $this->createMobileUrl('tip', array(), true)?>" + "&orderid=" + data.message['orderid']+"&i=<?php  echo $_GET['i']?>"+"&storeid=<?php  echo $_GET['storeid']?>"+"&mode=<?php  echo $_GET['mode']?>"+"&tablesid=<?php  echo $_GET['tablesid']?>";
                            "<?php  } else { ?>"
                            var url = "<?php  echo $this->createMobileUrl('pay', array(), true)?>" + "&orderid=" + data.message['orderid'];
                            "<?php  } ?>"
                        // }
                        $(".alert_contents").hide()
                        $(".alert_trueorder").css('background','none')
                        $(".succ").show()
                        setTimeout(function(){
                          window.location.href="/app/index.php?i=<?php  echo $_GET['i']?>&c=entry&storeid=<?php  echo $_GET['storeid']?>&mode=<?php  echo $_GET['mode']?>&tablesid=<?php  echo $_GET['tablesid']?>&append=0&do=mindex&m=weisrc_dish&p=<?php echo $_GET[p]?$_GET[p]:1;?>&l=<?php echo $_GET[l]?$_GET[l]:'en';?>";
                        },888)
                        // location.href = url;
                    } else {
                        alert(data.message['msg']);
                    }
                    $("#btnselect").show();
                },error: function () {
                    // alert("订单提交失败！");
                    alert("ご注文に失敗しました。再度入力をご理解ください。");
                }
            });

    }
    </script>
    </body>
</html>
