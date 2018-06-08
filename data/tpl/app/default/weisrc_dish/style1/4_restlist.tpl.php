<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <meta name="keywords" content="美食,团购,外卖,网上订餐,酒店,旅游,电影票,火车票,飞机票">
    <meta name="description" content="美食攻略,外卖网上订餐,酒店预订,旅游团购,飞机票火车票,电影票,ktv团购吃喝玩乐全都有!店铺信息查询,商家评分/评价一站式生活服务网站">
    <title><?php  echo $setting['title'];?></title>
    <link rel="stylesheet" href="<?php echo RES;?>/plugin/light7/light7.min.css">
    <link rel="stylesheet" type="text/css" href="<?php  echo $this->cur_mobile_path?>/css/iconfont.css"/>
    <link rel="stylesheet" type="text/css" href="<?php  echo $this->cur_mobile_path?>/css/api.css"/>
    <link rel="stylesheet" type="text/css" href="<?php  echo $this->cur_mobile_path?>/css/common.css"/>
    <link rel="stylesheet" href="<?php  echo $this->cur_mobile_path?>/css/shop.css?v=2">
    <link rel="stylesheet" type="text/css" href="<?php  echo $this->cur_mobile_path?>/css/fakeLoader.css">
    <script src="<?php  echo $this->cur_mobile_path?>/script/jquery-1.8.3.min.js"></script>
</head>
<body>
<div class="fakeloader"></div>
<?php  $url_search = $this->createMobileUrl('search', array(), true);?>
<?php  $url_user = $this->createMobileUrl('usercenter', array(), true);?>
<div id="wrap" style="height:100%;overflow: scroll;overflow-y:scroll;-webkit-overflow-scrolling:touch;">
    <div id="header">
        <div class="search" tapmode="topbar-active" onclick="javascript:window.location.href='<?php  echo $url_search;?>'">
            <i class="i-search"></i>
        </div>
        <div class="flex-full">商家列表</div>
        <div class="map" tapmode="topbar-active"  onclick="javascript:window.location.href='<?php  echo $url_user;?>'">
            <i class="i-user"></i>
        </div>
    </div>
    <span class="filter">
        <div class="filter-header">
            <a class="filter-nav" href="javascript:" data-value="0">
                <span><?php  echo $curtype;?></span><i class="i-up"></i>
            </a>
            <a class="filter-nav" href="javascript:"  data-value="0">
                <span><?php  echo $curarea;?></span><i class="i-up"></i>
            </a>
            <a class="filter-nav filter-nav-more" href="javascript:" data-value="0">
                <span><?php  echo $cursort;?></span><i class="i-up"></i>
            </a>
        </div>
        <section class="filter-extend filter-category">
            <div class="filter-scroller">
                <ul class="shoptype">
                    <li data-id="0" <?php  if($typeid == 0) { ?>class="active"<?php  } ?>>
                        <span>门店类型</span>
                        <i class="i-right"></i>
                    </li>
                    <?php  if(is_array($shoptype)) { foreach($shoptype as $item) { ?>
                    <li data-id="<?php  echo $item['id'];?>"  <?php  if($typeid ==  $item['id']) { ?>class="active"<?php  } ?>>
                        <span><?php  echo $item['name'];?></span>
                        <i class="i-right"></i>
                    </li>
                    <?php  } } ?>
                </ul>
            </div>
        </section>
        <section class="filter-extend filter-sort">
            <ul class="areatype">
                <li <?php  if($areaid == 0) { ?>class="active"<?php  } ?> data-id="0">
                    <span>全城</span>
                    <i class="i-right"></i>
                </li>
                <?php  if(is_array($area)) { foreach($area as $item) { ?>
                <li <?php  if($areaid == $item['id']) { ?> class="active"<?php  } ?>  data-id="<?php  echo $item['id'];?>">
                    <span><?php  echo $item['name'];?></span>
                    <i class="i-right"></i>
                </li>
                <?php  } } ?>
            </ul>
        </section>
        <section class="filter-extend filter-more">
            <ul class="shopsort">
                <li <?php  if($sortid == 0) { ?>class="active"<?php  } ?> data-id="0">
                    <span>
                        综合排序
                    </span>
                </li>
                <li data-id="1" <?php  if($sortid == 1) { ?>class="active"<?php  } ?>>
                    <span>
                        正在营业
                    </span>
                </li>
                <li data-id="2" <?php  if($sortid == 2) { ?>class="active"<?php  } ?>>
                    <span>
                        距离优先
                    </span>
                </li>
            </ul>
        </section>
    </span>
    <div id="main" style="margin-top:84px;padding-bottom: 70px;">
        <div class="box item-list" id="index-data">
            <?php  if(is_array($restlist)) { foreach($restlist as $item) { ?>
            <?php  if($item['default_jump']==1) { ?>
            <?php  $url = $this->createMobileUrl('detail', array('id' => $item['id']), true);?>
            <?php  } else if($item['default_jump']==2) { ?>
            <?php  $url = $this->createMobileUrl('mindex', array('storeid' => $item['id'], 'mode' => 2), true);?>
            <?php  } else if($item['default_jump']==3) { ?>
            <?php  $url = $this->createMobileUrl('mindex', array('storeid' => $item['id'], 'mode' => 4), true);?>
            <?php  } else if($item['default_jump']==4) { ?>
            <?php  $url = $this->createMobileUrl('queue', array('storeid' => $item['id']), true);?>
            <?php  } else if($item['default_jump']==5) { ?>
            <?php  $url = $this->createMobileUrl('reservationIndex', array('storeid' => $item['id'], 'mode' => 3), true);?>
            <?php  } else if($item['default_jump']==6) { ?>
            <?php  $url = $item['default_jump_url'];?>
            <?php  } ?>
            <section class="item" onclick="location.href='<?php  echo $url;?>'">
                <div class="left-wrap">
                    <img class="logo" src="<?php  echo tomedia($item['logo']);?>" onerror="this.src='<?php  echo tomedia('./addons/weisrc_dish/icon.jpg');?>'">
                    <?php  if($item['is_rest'] == 0) { ?>
                    <span class="status-tip" style="background-color: rgb(192, 192, 192);"> 商家休息 </span>
                    <?php  } ?>
                </div>
                <div class="right-wrap">
                    <section class="line">
                        <h3 class="shopname<?php  if($item['is_brand']==1) { ?> premium<?php  } ?>"><?php  echo $item['title'];?></h3>
                        <div class="support-wrap">
                            <?php  if($item['is_meal']==1) { ?>
                            <div class="activity-wrap nowrap">
                                <i class="activity-icon icononly"
                                   style="color: rgb(153, 153, 153); border-color: rgb(221, 221, 221);"> 店 </i>
                            </div>
                            <div class="tag label-red ng-scope"></div>
                            <?php  } ?>
                            <?php  if($item['is_delivery']==1) { ?>
                            <div class="activity-wrap nowrap">
                                <i class="activity-icon icononly"
                                   style="color: rgb(153, 153, 153); border-color: rgb(221, 221, 221);"> 外 </i>
                            </div>
                            <?php  } ?>
                        </div>
                    </section>
                    <section class="line">
                        <div class="rate-wrap">
                       	<span>
                            <?php  for($i=0;$i < $item['level']; $i++){ ?>
                            <i class="i-star i-star-gold"></i>
                            <?php  }?>
                            <!--<i class="i-star i-star-gold"></i>-->
                            <!--<i class="i-star i-star-gold"></i>-->
                            <!--<i class="i-star i-star-gold"></i>-->
                            <!--<i class="i-star i-star-gray">-->
                                <!--<i class="i-star i-star-gold"></i>-->
                            <!--</i>-->
                            <!--<i class="i-star i-star-gray"></i>-->
                        </span>
                            <!--<span class="rate">4.6</span>-->
                            <?php  if($item['sales']>0) { ?>
                            <span>已售<?php  echo $item['sales'];?>份</span>
                            <?php  } ?>
                        </div>
                        <div class="delivery-wrap">
                            <span class="icon-delivery">
                                <?php  if($item['is_delivery']==1) { ?>
                                准时达
                                <?php  } else { ?>
                                商家联盟
                                <?php  } ?>
                            </span>
                        </div>
                    </section>
                    <section class="line">
                        <div class="moneylimit">
                            <?php  if($item['is_delivery']==1) { ?>
                            <?php  if(!empty($item['sendingprice'])) { ?>
                            <span>¥<?php  echo $item['sendingprice'];?>起送</span>
                            <?php  } ?>
                            <?php  if($item['dispatchprice']>0) { ?>
                            <span>配送费约¥<?php  echo $item['dispatchprice'];?></span>
                            <?php  } else { ?>
                            <span>免配送费</span>
                            <?php  } ?>
                            <?php  if($item['freeprice']!=0.00) { ?>
                            <span>满<?php  echo intval($item['freeprice'])?>免配送费</span>
                            <?php  } ?>
                            <?php  } else { ?>
                            <span><?php  echo $item['address'];?></span>
                            <?php  } ?>
                        </div>
                        <div class="timedistance-wrap">
                            <span class="distance-wrap"><?php  echo $this->getDistance($item['lat'], $item['lng'], $lat, $lng).'km';?></span>
                            <!--<span class="time-wrap">42分钟</span>-->
                        </div>
                    </section>
                </div>
            </section>
            <?php  } } ?>
        </div>

        <div class="popup-overlay"></div>

        <div class="top-btn" style="display: block;">
            <a class="react">
                <i class="text-icon">⇧</i>
            </a>
        </div>
        <input type="hidden" id="curlat" name="curlat" value="0"/>
        <input type="hidden" id="curlng" name="curlng" value="0"/>
        <input type="hidden" id="isposition" name="isposition" value="<?php  echo $isposition;?>" />
        <input type="hidden" id="cururl" name="cururl" value="<?php  echo $this->createMobileurl('waprestlist', array('typeid' => $typeid), true)?>" />
        <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=5PESLgvMcSbSUbPjmDKgvGZ3"></script>
        <?php  if($isposition==0) { ?>
        <script type="text/javascript" src="../addons/weisrc_dish/template/js/postion.js?v=3"></script>
        <?php  } ?>
        <script>
            //top行为
            $('.top-btn').on('click',function(){
                $("html, body").animate({ scrollTop: 0 }, "slow");
            });
            if ($(document).scrollTop() == 0) {
                $('.top-btn').css('display','none');
            }
            $(document).bind('scroll',function() {
                if ($(document).scrollTop() == 0) {
                    $('.top-btn').css('display','none');
                }else{
                    $('.top-btn').css('display','block');
                }
            })
        </script>
        <script src="<?php  echo $this->cur_mobile_path?>/script/fakeLoader.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
//                $(".fakeloader").fakeLoader({
//                    timeToHide:1200,
//                    bgColor:"#1abc9c",
//                    spinner:"spinner6"
//                });
            });

            //区域
            $('.areatype > li').click(function () {
                var curlat = $('#curlat').val();
                var curlng = $('#curlng').val();
                var id = $(this).attr("data-id");

                window.location.href = "<?php  echo $this->createMobileurl('waprestlist', array('storeid' => $storeid, 'sortid' => $sortid, 'typeid' => $typeid), true)?>" + '&areaid=' + id + '&lat=' + curlat + '&lng=' + curlng;
            });
            //商家类型
            $('.shoptype > li').click(function () {
                var curlat = $('#curlat').val();
                var curlng = $('#curlng').val();
                var id = $(this).attr("data-id");
                window.location.href = "<?php  echo $this->createMobileurl('waprestlist', array('storeid' => $storeid, 'sortid' => $sortid, 'areaid' => $areaid), true)?>" + '&typeid=' + id + '&lat=' + curlat + '&lng=' + curlng;
            });
            //排序
            $('.shopsort > li').click(function () {
                var curlat = $('#curlat').val();
                var curlng = $('#curlng').val();
                var id = $(this).attr("data-id");
                window.location.href = "<?php  echo $this->createMobileurl('waprestlist', array('storeid' => $storeid, 'typeid' => $typeid, 'areaid' => $areaid), true)?>" + '&sortid=' + id + '&lat=' + curlat + '&lng=' + curlng;
            });
        </script>
    </div>
    <script>
        $(document).ready(function(e) {
            $('.filter-header .filter-nav').click(function(e) {
                var index=$(this).index()
                var datavalue=$(this).attr('data-value')//判断是否显示
                if(datavalue==1){
                    $('.filter-header .filter-nav').attr('data-value',0)
                    $(this).find('.i-up').css({"transform":"rotate(0deg)"})
                    $(this).find('span').removeClass('curt')
                    $('.filter-extend').eq(index).removeClass('open');
                    $('.popup-overlay').removeClass('modal-overlay-visible')
                }else{
                    $('.filter-header .filter-nav').attr('data-value',0)
                    $(this).attr('data-value',1)//判断是否显示
                    $('.filter-header .filter-nav span').removeClass('curt')
                    $(this).find('span').addClass('curt')
                    $('.filter-header .filter-nav').find('.i-up').css({"transform":"rotate(0deg)"})
                    $(this).find('.i-up').css({"transform":"rotate(180deg)"})
                    $('.filter-extend').removeClass('open')
                    $('.filter-extend').eq(index).addClass('open');
                    $('.popup-overlay').addClass('modal-overlay-visible')
                }
            });


        });
    </script>

</div>
<?php  echo register_jssdk(false);?>
<script>
    wx.ready(function () {
        sharedata = {
            title: '<?php  echo $share_title;?>',
            desc: '<?php  echo $share_desc;?>',
            link: '<?php  echo $share_url;?>',
            imgUrl: '<?php  echo $share_image;?>',
            success: function(){
                //alert('感谢分享');
            },
            cancel: function(){
                //alert('cancel');
            }
        };
        wx.onMenuShareAppMessage(sharedata);
        wx.onMenuShareTimeline(sharedata);
    });
</script>
<?php  include $this->template($this->cur_tpl.'/_nave');?>

<script type="text/javascript">
    var page = 2;
    var loading  = false;
    var stop_track = false;

    $(document).ready(function() {
        $('#wrap').scroll(function(){
//            if ($(window).scrollTop() + $(window).height() == $(document).height()) {
                if(stop_track == false && loading==false) {
                    loading = true;
                    var loadurl ="<?php  echo $this->createMobileurl('getmorestore', array('areaid' => $areaid, 'typeid' => $typeid), true)?>";
                    $.ajax({
                        type: 'POST',
                        url: loadurl,
                        data: {
                            'page': page
                        },
                        dataType: 'json',
                        timeout: 3000,
                        context: $('body'),
                        success: function(data){
                            if (data == '0') {
                                stop_track = true;
                            } else {
                                $("#index-data").append(data);
                                if (data == '') {
                                    stop_track = true;
                                }
//                                $('.animation_image').hide();
                                page++;
                                loading = false;
                            }
                        },
                        error: function (xhr) {
                            alert('网络通讯失败，请重试!');
                        }
                    });
                }
//            }
        });
    });
</script>
</body>
</html>
