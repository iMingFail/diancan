<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
<title>我要排号</title>
 <meta content="target-densitydpi=320,width=640,user-scalable=no" name="viewport">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta name="applicable-device" content="mobile">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <link rel="stylesheet" type="text/css" href="<?php  echo $this->cur_mobile_path?>/css/api.css"/>
    <link rel="stylesheet" type="text/css" href="<?php  echo $this->cur_mobile_path?>/css/common.css"/>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php  echo $this->cur_mobile_path?>/css/yuyue.css"/>
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
        $languagetxt = '../web/language_'.$_GET["l"].'.txt';
        $languagearr = unserialize(file_get_contents($languagetxt));
    ?>
    <!-- <form action="/app/index.php?i=<?php  echo $_GET['i']?>&c=entry&storeid=<?php  echo $_GET['storeid']?>&mode=<?php  echo $_GET['mode']?>&tablesid=<?php  echo $_GET['tablesid']?>&append=0&do=yuyue&m=weisrc_dish&p=<?php echo $_GET[p]?$_GET[p]:1;?>" method="post" accept-charset="utf-8"> -->

    <div class="content">
        <p class="nums"><?php  echo $user_count['nums'];?></p>
         <input type="text" class="divcontent number"  name="number" value="<?php  echo $queue_count[4]['count'];?>" hidden>
        <ul>

             <li>
                <img src="./mindex/people.png" alt="" style="margin:20px 30px">
                <select  name="peoples" class="peoples">
                <?php  for($i = 1;$i<=10;$i++){?>
                                  <option value="<?php  echo $i;?>" ><?php  echo $i;?><?php
                                    $_GET["l"] =$_GET["l"]?$_GET["l"]:"jp";
                                   $languagetxt = '../web/language_'.$_GET["l"].'.txt';
                                   $languagearr = unserialize(file_get_contents($languagetxt));
                                    echo $languagearr[$_GET['l'].'_p'];;?>
                                  </option>
                              <?php  }?>
                                <option value="11" ><?php  echo $languagearr[$_GET['l'].'_more'];?></option>
                </select>
            </li>
             <li>
                 <img src="./mindex/nosmoking.png" alt="" class="smoke">
                <select  name="type" class="type">
                    <option value="2"><?php   echo $languagearr[$_GET['l'].'_nosmoke'];  ?></option>
                    <option value="1"><?php   echo $languagearr[$_GET['l'].'_issmoke'];  ?></option>
                </select>
            </li>
            <li style="height:auto">
                 <img src="./mindex/beizhu.png" alt="" style="margin: 10px 30px; ">
                <!-- <input type="text" class="divcontent " id="content" value="备注" name="content"> -->
                <textarea class="divcontent " id="content" value="备注" name="content"  style="
                line-height:30px;position:relative;top:20px"><?php   echo $languagearr[$_GET['l'].'_remark'];  ?></textarea>
            </li>


            <?php  if($store['screen_mode']!=2 || $queueid!=0) { ?>
                <!-- <div class="operation-button" onclick="postmain();"  style="color: #fff;">保存</div> -->
                 <div class="divbtu" onclick="postmain();" >
                    <img src="./mindex/true.png" class="true">
                    <input type="submit" value="<?php   echo $languagearr[$_GET['l'].'_true'];  ?>" style="width: 88px;color: white;
    letter-spacing: 2px;font-size: 38px;outline:none;position:relative;top:7px">
                </div>


            <?php  } ?>



        </ul>
    </div>
    <!-- </form> -->
    <div class="trueorder">
        <div class="alert_trueorder">
        <img src="./mindex/succ.png" alt="" class="succ">
        </div>
    </div>
</div>

    <script>

    $('.type').change(function(event) {
        if($(this).val()==1){
            $(".smoke").attr('src','./mindex/smoke.png')
        }else{
            $(".smoke").attr('src','./mindex/nosmoking.png')

        }
    });
        $(".fa-navicon").toggle( function(){
        // $(".alert1").show();
        $(".alert_content").show();
    },function(){
        // $(".alert1").hide();
        $(".alert_content").hide();
     })

    $("#content").focus(function(event) {
        $(this).val('')
    });

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
    $("#content").keydown(function(event) {
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



    // $('.divbtu').click(function(event) {
    //    num =  $(".num").val();
    //    var peoples = $('.peoples option:selected').val();
    //    var type = $('.type option:selected').val();
    //    var content = $('#content').val();
    //     $.ajax({
    //         url:"./index.php?i=4&c=entry&storeid=37&mode=1&tablesid=284&append=0&do=yuyue&m=weisrc_dish&p=1",
    //         type:'post',
    //         data:{num:num,peoples:peoples,type:type,content:content,storeid:<?php  echo $_GET['storeid']?>},
    //         success:function(result){
    //          if(result==1){
    //             $(".trueorder").show()
    //             setTimeout(function(){
    //             window.location.href="./index.php?i=4&c=entry&storeid=37&mode=1&tablesid=284&append=0&do=mindex&m=weisrc_dish&p=1";
    //             },888)
    //             // alert('预约成功!!')
    //             // window.location.href="./index.php?i=4&c=entry&storeid=37&mode=1&tablesid=284&append=0&do=mindex&m=weisrc_dish&p=1"
    //          }else{
    //             alert('预约失败!!')
    //          }
    //      }});
    // });



    function postmain() {
        var url = "<?php  echo $this->createMobileUrl('setqueue', array('storeid' => $storeid, 'queueid' => $queueid), true)?>";
        // var usermobile = $("#usermobile").val();
        var usercount = $(".peoples").val();
        // if (!checkMobile(usermobile)) {
        //     return false;
        // }

        if (usercount == "") {
            alert('请输入人数!');
            return false;
        }

        $.ajax({
            url: url, type: "post", dataType: "json", timeout: "10000",
            data: {
                // "usermobile": usermobile,
                usercount: usercount,
                smoking:$('.type option:selected').val(),
                remark:$('#content').val(),
                number:$('.number').val(),
            },
            success: function (data) {
                console.log(data)
                if (data == 1) {
                    $(".trueorder").show()
                  setTimeout(function(){
                window.location.href="./index.php?i=<?php  echo $_GET['i']?>&c=entry&storeid=<?php  echo $_GET['storeid']?>&mode=5&tablesid=284&append=0&do=mindex&m=weisrc_dish&p="+$('.peoples').val()+"&l=<?php echo $_GET[l]?$_GET[l]:'jp';?>";
                },888)

                } else {
                    alert(data.msg);
                }
            },error: function () {
                alert("インターネット接続に問題がある可能性があります。");
                // alert("网络不稳定，请重新尝试!");
            }
        });
    }

    function checkMobile($mobileVal) {
        // if (checkEmpty($mobileVal) == false) {
        //     alert("请输入手机号码");
        //     return false;
        // }
        // else {
        //     if ($mobileVal.length != 11) {
        //         alert('手机号码长度不正确');
        //         return false;
        //     }
        //     else if (/^(((13[0-9]{1})|15[0-9]{1}|17[0-9]{1}|18[0-9]{1}|14[0-9]{1})+\d{8})$/.test($mobileVal) == false) {
        //         alert('手机号码格式不正确');
        //         return false;
        //     }
        //     else {
        //         return true;
        //     }
        // }
    }

    //非空校验
    function checkEmpty(param) {
        if (param == "" || param == null || param == undefined) {
            return false;
        } else {
            return true;
        }
    }
    </script>
    </body>
</html>
