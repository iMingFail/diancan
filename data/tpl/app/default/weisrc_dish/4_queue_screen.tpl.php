<?php defined('IN_IA') or exit('Access Denied');?><html>
<head>
    <meta charset="utf-8">
    <title><?php  echo $store['screen_title'];?></title>
    <script type="text/javascript" src="<?php echo RES;?>/js/2/jQuery.js" charset="utf-8"></script>
    <style type="text/css">
        body{
            overflow-y:auto;
        }
    </style>
    <link href="<?php echo RES;?>/mobile/queue_screen/reset.css" rel="stylesheet">
    <link href="<?php echo RES;?>/mobile/queue_screen/style.css" rel="stylesheet">
</head>
<body>
<style>
    .fl{
        float: none;
    }
    body{
        background: url(<?php  echo tomedia($store['screen_bg'])?>) no-repeat;
        background-size: 100% 100%;
    }
</style>
<div class="wrap">
    <div class="wrap-top">
        <span class="name"><?php  echo $store['screen_title'];?></span>
    </div>
    <div class="wrap-con">
        <div id="con" class="wrap-con-c">
            <ul id="con1"></ul>
            <ul id="con2"></ul>
        </div>
    </div>
    <div class="wrap-bot clearfix">
        <span class="wrap-bot-l fl">
            <?php  echo $store['screen_bottom'];?>
        </span>
        <span class="wrap-bot-r fr">
            <img src="<?php  echo $this->fm_qrcode($url);?>" width="148" height="148">
        </span>
    </div>
</div>
<script language="javascript">
    window.moduleurl = '<?php  echo $_W['siteroot'];?>app/index.php?i=<?php  echo $weid;?>&c=entry&m=weisrc_dish&storeid=<?php  echo $storeid;?>&do=';
</script>
<script type="text/javascript" src="<?php echo RES;?>/mobile/queue_screen/js.js"></script>
</body>
</html>