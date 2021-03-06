<?php defined('IN_IA') or exit('Access Denied');?><html ng-app="diandanbao" class="ng-scope"><head><style type="text/css">@charset "UTF-8";[ng\:cloak],[ng-cloak],[data-ng-cloak],[x-ng-cloak],.ng-cloak,.x-ng-cloak,.ng-hide:not(.ng-hide-animate){display:none !important;}ng\:form{display:block;}</style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta content="telephone=no" name="format-detection">
    <meta name="wechat_account_be_verified" content="true">
    <title><?php  echo $setting['title'];?></title>
    <link data-turbolinks-track="true" href="<?php echo RES;?>/mobile/<?php  echo $this->cur_tpl?>/assets/diandanbao/weixin.css" media="all" rel="stylesheet">

    <link rel="stylesheet" href="<?php  echo $this->cur_mobile_path?>/mvalidate/validate.css" />
    <script src="<?php  echo $this->cur_mobile_path?>/script/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php  echo $this->cur_mobile_path?>/mvalidate/jquery-mvalidate.js" ></script>
    </head>
<body>
<div ng-view="" style="height: 100%;" class="ng-scope"><div id="addresses-new-page" class="ng-scope">
    <div class="ddb-nav-header">
        <div class="nav-left-item" onclick="javascript:history.back();"><i class="fa fa-angle-left"></i></div>
        <div class="header-title ng-binding">订单评论</div>
        <div class="nav-right-item">
            <div class="operation-button" onclick="submit()" style="color: #fff;">保存</div>
        </div>
    </div>
    <div class="main-view">
        <input type="hidden" name="star" id="star" value="5">
        <div class="space-12"></div>
        <div class="section new-order-comment-form">
            <div class="ddb-form-control list-item">
                <div class="ddb-form-label">星级</div>
                <div class="comments-level red">
                    <span class="fa fa-star rating-star" onclick="change_rating(1)" id="star1"></span>
                    <span class="fa fa-star rating-star" onclick="change_rating(2)" id="star2"></span>
                    <span class="fa fa-star rating-star" onclick="change_rating(3)" id="star3"></span>
                    <span class="fa fa-star rating-star" onclick="change_rating(4)" id="star4"></span>
                    <span class="fa fa-star rating-star" onclick="change_rating(5)" id="star5"></span>
                </div>
            </div>
            <div class="list-item ddb-form-control">
                <textarea placeholder="请输入对该订单的评价" id="content" class="ng-pristine ng-untouched ng-valid"></textarea>
            </div>
            <div class="space"></div>
        </div>
    </div>
</div>
</div>
<script>
    function change_rating(num) {
        //重置
        for (i = 1;i <= 5; i++) {
            $("#star" + i).attr("class", "fa fa-star-o rating-star")
        }

        for (i = 1;i <= num; i++) {
            $("#star" + i).attr("class", "fa fa-star rating-star")
        }
        $("#star").val(num);
    }

    var issubmit = false;
    function submit()
    {
        var url = "<?php  echo $this->createMobileurl('addfeedback', array('orderid' => $orderid), true);?>";
        if (issubmit == true) {
            return false;
        }
        var star = $("#star").val();
        var content = $("#content").val();

        var req = {
            star: star,
            content: content
        }

        if(!req.content){
            $.mvalidateTip("请输入对该订单的评价");
            return;
        }

        issubmit = true;
        $.ajax({
            url: url,
            type:"post",
            data:req,
            dataType:"JSON",
            success: function(data) {
                issubmit = false;
                $.mvalidateTip(data.msg);
                intervalId = setInterval("time_jump()",1500);
            },
            error: function(data){
                alert('网络异常哦!');
                return false;
            }
        });
    }

    function time_jump(){
        window.location.href = "<?php  echo $this->createMobileUrl('order', array(), true)?>";
    }
</script>
</body>
</html>