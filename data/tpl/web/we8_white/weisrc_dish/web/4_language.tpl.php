<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>

<div class="main">

    <script>
        require(['jquery', 'util'], function($, u){
            $('.account p a').each(function(){
                u.clip(this, $(this).text());
            });
        });
    </script>
    <style>
        .header {
            line-height: 28px;
            margin-bottom: 16px;
            margin-top: 18px;
            padding-bottom: 4px;
            border-bottom: 1px solid #CCC
        }
        .block-gray{
            background-color: #555555;
            color: white;
        }
        .block-red{
            background-color: #ef4437;
            color: white;
        }
        .block-primary{
            background-color: #428bca;
            color: white;
        }
        .block-success{
            background-color: #5cb85c;
            color: white;
        }
        .block-orange{
            background-color: orange;
            color: white;
        }
        #guest-queue-index-body .queue_setting, #queue-setting-index-body .queue_setting {
            display: block;
            float: left;
            height: 100px;
            width: 31.3%;
            margin-right: 2%;
            margin-bottom: 20px;
            text-align: center
        }
        #queue-setting-index-body .queue_setting {
            width: 150px;
            height: 150px;
            border-radius: 1000px;
            margin-right: 20px
        }
        #guest-queue-index-body .queue_setting .name, #queue-setting-index-body .queue_setting .name{
            display: table-cell;
            font-size: 20px;
            font-weight: bold;
            line-height: 30px;
            vertical-align: middle;
            height: 60px
        }
        #queue-setting-index-body .queue_setting .name {
            height: 90px;
        }
        .table-display{
            display: table;
            width: 100%;
        }
        .form-group{
            margin-bottom:5px;
        }
    </style>
    <div class="panel panel-default">
<!-- 姓名：电话：邮编：区域：地址：电话：人数：是否吸烟：时间：桌台：备注：数量：配送费用  合计： -->
<!-- 确认订单 确定 -->
        <div class="panel-body">
            <div class="row">
                <ul class="nav nav-pills" >
                    <li class="active cn">
                        <a href="javascript:void" >简体中文</a>
                    </li>
                    <li  class="en">
                        <a href="javascript:void" >英文</a>
                    </li>

                    <li class="hw">
                        <a href="javascript:void" >韩文</a>
                    </li>
                     <li class="jp">
                        <a href="javascript:void" >日文</a>
                    </li>
                    <li class="ft">
                        <a href="javascript:void" >繁体中文</a>
                    </li>
                     <li class="py">
                        <a href="javascript:void" >py</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>

<link rel="stylesheet" type="text/css" href="../addons/weisrc_dish/plugin/clockpicker/clockpicker.css" media="all">
<script type="text/javascript" src="../addons/weisrc_dish/plugin/clockpicker/clockpicker.js"></script>
<link rel="stylesheet" type="text/css" href="../addons/weisrc_dish/plugin/clockpicker/standalone.css" media="all">
<div class="main">
 <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
        <input type="hidden" name="storeid" value="<?php  echo $storeid;?>" />
        <input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
        <!--英文-->
        <?php 
             $arr = unserialize(file_get_contents('language_en.txt'));
             $jparr = unserialize(file_get_contents('language_jp.txt'));
             $hwarr = unserialize(file_get_contents('language_hw.txt'));
             $ftarr = unserialize(file_get_contents('language_ft.txt'));
             $pyarr = unserialize(file_get_contents('language_py.txt'));
             $cnarr = unserialize(file_get_contents('language_cn.txt'));
        ?>
        <div class="panel panel-default" id="cn">
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">人</label>
                    <div class="col-sm-9">
                        <input type="text" name="cn_p" class="form-control" value="<?php  echo $cnarr['cn_p'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">更多</label>
                    <div class="col-sm-9">
                        <input type="text" name="cn_more" class="form-control" value="<?php  echo $cnarr['cn_more'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">首页</label>
                    <div class="col-sm-9">
                        <input type="text" name="cn_index" class="form-control" value="<?php  echo $cnarr['cn_index'];?>" />

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">按销量排序</label>
                    <div class="col-sm-9">
                        <input type="text" name="cn_sale" class="form-control" value="<?php  echo $cnarr['cn_sale'];?>" />

                    </div>
                </div>
                  <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">价格由高到底</label>
                    <div class="col-sm-9">
                        <input type="text" name="cn_orderh" class="form-control" value="<?php  echo $cnarr['cn_orderh'];?>" />

                    </div>
                </div>
                  <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">价格由低到高</label>
                    <div class="col-sm-9">
                        <input type="text" name="cn_orders" class="form-control" value="<?php  echo $cnarr['cn_orders'];?>" />

                    </div>
                </div>
                  <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">姓名</label>
                    <div class="col-sm-9">
                        <input type="text" name="cn_name" class="form-control" value="<?php  echo $cnarr['cn_name'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">电话</label>
                    <div class="col-sm-9">
                        <input type="text" name="cn_tel" class="form-control" value="<?php  echo $cnarr['cn_tel'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">邮编</label>
                    <div class="col-sm-9">
                        <input type="text" name="cn_code" class="form-control" value="<?php  echo $cnarr['cn_code'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">区域</label>
                    <div class="col-sm-9">
                        <input type="text" name="cn_area" class="form-control" value="<?php  echo $cnarr['cn_area'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">地址</label>
                    <div class="col-sm-9">
                        <input type="text" name="cn_address" class="form-control" value="<?php  echo $cnarr['cn_address'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">人数</label>
                    <div class="col-sm-9">
                        <input type="text" name="cn_people" class="form-control" value="<?php  echo $cnarr['cn_people'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否吸烟</label>
                    <div class="col-sm-9">
                        <input type="text" name="cn_smoke" class="form-control" value="<?php  echo $cnarr['cn_smoke'];?>" />

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">吸烟</label>
                    <div class="col-sm-9">
                        <input type="text" name="cn_issmoke" class="form-control" value="<?php  echo $cnarr['cn_issmoke'];?>" />

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">禁烟</label>
                    <div class="col-sm-9">
                        <input type="text" name="cn_nosmoke" class="form-control" value="<?php  echo $cnarr['cn_nosmoke'];?>" />

                    </div>
                </div>
                   <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">时间</label>
                    <div class="col-sm-9">
                        <input type="text" name="cn_time" class="form-control" value="<?php  echo $cnarr['cn_time'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">桌台</label>
                    <div class="col-sm-9">
                        <input type="text" name="cn_table" class="form-control" value="<?php  echo $cnarr['cn_table'];?>" />

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">备注</label>
                    <div class="col-sm-9">
                        <input type="text" name="cn_remark" class="form-control" value="<?php  echo $cnarr['cn_remark'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">数量</label>
                    <div class="col-sm-9">
                        <input type="text" name="cn_num" class="form-control" value="<?php  echo $cnarr['cn_num'];?>" />

                    </div>
                </div>
               <!--   <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">配送费用</label>
                    <div class="col-sm-9">
                        <input type="text" name="cn_free" class="form-control" value="<?php  echo $cnarr['cn_free'];?>" />

                    </div>
                </div> -->
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">合计</label>
                    <div class="col-sm-9">
                        <input type="text" name="cn_count" class="form-control" value="<?php  echo $cnarr['cn_count'];?>" />

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">确认订单</label>
                    <div class="col-sm-9">
                        <input type="text" name="cn_trueorder" class="form-control" value="<?php  echo $cnarr['cn_trueorder'];?>" />

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否确定</label>
                    <div class="col-sm-9">
                        <input type="text" name="cn_true1" class="form-control" value="<?php  echo $cnarr['cn_true1'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是</label>
                    <div class="col-sm-9">
                        <input type="text" name="cn_true2" class="form-control" value="<?php  echo $cnarr['cn_true2'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">否</label>
                    <div class="col-sm-9">
                        <input type="text" name="cn_true3" class="form-control" value="<?php  echo $cnarr['cn_true3'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">确定</label>
                    <div class="col-sm-9">
                        <input type="text" name="cn_true" class="form-control" value="<?php  echo $cnarr['cn_true'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">预约席位</label>
                    <div class="col-sm-9">
                        <input type="text" name="cn_yuyue" class="form-control" value="<?php  echo $cnarr['cn_yuyue'];?>" />

                    </div>
                </div>
            </div>
        </div>


        <div class="panel panel-default" id="en" style="display:none">
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">人</label>
                    <div class="col-sm-9">
                        <input type="text" name="en_p" class="form-control" value="<?php  echo $arr['en_p'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">更多</label>
                    <div class="col-sm-9">
                        <input type="text" name="en_more" class="form-control" value="<?php  echo $arr['en_more'];?>" />

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">首页</label>
                    <div class="col-sm-9">
                        <input type="text" name="en_index" class="form-control" value="<?php  echo $arr['en_index'];?>" />

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">按销量排序</label>
                    <div class="col-sm-9">
                        <input type="text" name="en_sale" class="form-control" value="<?php  echo $arr['en_sale'];?>" />

                    </div>
                </div>
                  <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">价格由高到底</label>
                    <div class="col-sm-9">
                        <input type="text" name="en_orderh" class="form-control" value="<?php  echo $arr['en_orderh'];?>" />

                    </div>
                </div>
                  <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">价格由低到高</label>
                    <div class="col-sm-9">
                        <input type="text" name="en_orders" class="form-control" value="<?php  echo $arr['en_orders'];?>" />

                    </div>
                </div>
                  <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">姓名</label>
                    <div class="col-sm-9">
                        <input type="text" name="en_name" class="form-control" value="<?php  echo $arr['en_name'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">电话</label>
                    <div class="col-sm-9">
                        <input type="text" name="en_tel" class="form-control" value="<?php  echo $arr['en_tel'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">邮编</label>
                    <div class="col-sm-9">
                        <input type="text" name="en_code" class="form-control" value="<?php  echo $arr['en_code'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">区域</label>
                    <div class="col-sm-9">
                        <input type="text" name="en_area" class="form-control" value="<?php  echo $arr['en_area'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">地址</label>
                    <div class="col-sm-9">
                        <input type="text" name="en_address" class="form-control" value="<?php  echo $arr['en_address'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">人数</label>
                    <div class="col-sm-9">
                        <input type="text" name="en_people" class="form-control" value="<?php  echo $arr['en_people'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否吸烟</label>
                    <div class="col-sm-9">
                        <input type="text" name="en_smoke" class="form-control" value="<?php  echo $arr['en_smoke'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">吸烟</label>
                    <div class="col-sm-9">
                        <input type="text" name="en_issmoke" class="form-control" value="<?php  echo $arr['en_issmoke'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">禁烟</label>
                    <div class="col-sm-9">
                        <input type="text" name="en_nosmoke" class="form-control" value="<?php  echo $arr['en_nosmoke'];?>" />

                    </div>
                </div>
                   <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">时间</label>
                    <div class="col-sm-9">
                        <input type="text" name="en_time" class="form-control" value="<?php  echo $arr['en_time'];?>" />
                    </div>
                </div>
                <!-- <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">桌台</label>
                    <div class="col-sm-9">
                        <input type="text" name="en_table" class="form-control" value="<?php  echo $arr['en_table'];?>" />

                    </div>
                </div> -->
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">备注</label>
                    <div class="col-sm-9">
                        <input type="text" name="en_remark" class="form-control" value="<?php  echo $arr['en_remark'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">数量</label>
                    <div class="col-sm-9">
                        <input type="text" name="en_num" class="form-control" value="<?php  echo $arr['en_num'];?>" />

                    </div>
                </div>
               <!--   <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">配送费用</label>
                    <div class="col-sm-9">
                        <input type="text" name="en_free" class="form-control" value="<?php  echo $arr['en_free'];?>" />

                    </div>
                </div> -->
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">合计</label>
                    <div class="col-sm-9">
                        <input type="text" name="en_count" class="form-control" value="<?php  echo $arr['en_count'];?>" />

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">确认订单</label>
                    <div class="col-sm-9">
                        <input type="text" name="en_trueorder" class="form-control" value="<?php  echo $arr['en_trueorder'];?>" />

                    </div>
                </div>
                    <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否确定</label>
                    <div class="col-sm-9">
                        <input type="text" name="en_true1" class="form-control" value="<?php  echo $arr['en_true1'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是</label>
                    <div class="col-sm-9">
                        <input type="text" name="en_true2" class="form-control" value="<?php  echo $arr['en_true2'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">否</label>
                    <div class="col-sm-9">
                        <input type="text" name="en_true3" class="form-control" value="<?php  echo $arr['en_true3'];?>" />

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">确定</label>
                    <div class="col-sm-9">
                        <input type="text" name="en_true" class="form-control" value="<?php  echo $arr['en_true'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">预约席位</label>
                    <div class="col-sm-9">
                        <input type="text" name="en_yuyue" class="form-control" value="<?php  echo $arr['en_yuyue'];?>" />

                    </div>
                </div>
            </div>
        </div>

        <!--日文-->
                <div class="panel panel-default" id="jp" style="display:none;">
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">人</label>
                    <div class="col-sm-9">
                        <input type="text" name="jp_p" class="form-control" value="<?php  echo $jparr['jp_p'];?>" />

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">更多</label>
                    <div class="col-sm-9">
                        <input type="text" name="jp_more" class="form-control" value="<?php  echo $jparr['jp_more'];?>" />

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">首页</label>
                    <div class="col-sm-9">
                        <input type="text" name="jp_index" class="form-control" value="<?php  echo $jparr['jp_index'];?>" />

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">按销量排序</label>
                    <div class="col-sm-9">
                        <input type="text" name="jp_sale" class="form-control" value="<?php  echo $jparr['jp_sale'];?>" />

                    </div>
                </div>
                  <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">价格由高到底</label>
                    <div class="col-sm-9">
                        <input type="text" name="jp_orderh" class="form-control" value="<?php  echo $jparr['jp_orderh'];?>" />

                    </div>
                </div>
                  <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">价格由低到高</label>
                    <div class="col-sm-9">
                        <input type="text" name="jp_orders" class="form-control" value="<?php  echo $jparr['jp_orders'];?>" />

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">姓名</label>
                    <div class="col-sm-9">
                        <input type="text" name="jp_name" class="form-control" value="<?php  echo $jparr['jp_name'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">电话</label>
                    <div class="col-sm-9">
                        <input type="text" name="jp_tel" class="form-control" value="<?php  echo $jparr['jp_tel'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">邮编</label>
                    <div class="col-sm-9">
                        <input type="text" name="jp_code" class="form-control" value="<?php  echo $jparr['jp_code'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">区域</label>
                    <div class="col-sm-9">
                        <input type="text" name="jp_area" class="form-control" value="<?php  echo $jparr['jp_area'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">地址</label>
                    <div class="col-sm-9">
                        <input type="text" name="jp_address" class="form-control" value="<?php  echo $jparr['jp_address'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">人数</label>
                    <div class="col-sm-9">
                        <input type="text" name="jp_people" class="form-control" value="<?php  echo $jparr['jp_people'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否吸烟</label>
                    <div class="col-sm-9">
                        <input type="text" name="jp_smoke" class="form-control" value="<?php  echo $jparr['jp_smoke'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">吸烟</label>
                    <div class="col-sm-9">
                        <input type="text" name="jp_issmoke" class="form-control" value="<?php  echo $jparr['jp_issmoke'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">禁烟</label>
                    <div class="col-sm-9">
                        <input type="text" name="jp_nosmoke" class="form-control" value="<?php  echo $jparr['jp_nosmoke'];?>" />

                    </div>
                </div>
                   <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">时间</label>
                    <div class="col-sm-9">
                        <input type="text" name="jp_time" class="form-control" value="<?php  echo $jparr['jp_time'];?>" />

                    </div>
                </div>
               <!--  <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">桌台</label>
                    <div class="col-sm-9">
                        <input type="text" name="jp_table" class="form-control" value="<?php  echo $jparr['jp_table'];?>" />

                    </div>
                </div> -->
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">备注</label>
                    <div class="col-sm-9">
                        <input type="text" name="jp_remark" class="form-control" value="<?php  echo $jparr['jp_remark'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">数量</label>
                    <div class="col-sm-9">
                        <input type="text" name="jp_num" class="form-control" value="<?php  echo $jparr['jp_num'];?>" />

                    </div>
                </div>
               <!--   <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">配送费用</label>
                    <div class="col-sm-9">
                        <input type="text" name="jp_free" class="form-control" value="<?php  echo $jparr['jp_free'];?>" />

                    </div>
                </div> -->
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">合计</label>
                    <div class="col-sm-9">
                        <input type="text" name="jp_count" class="form-control" value="<?php  echo $jparr['jp_count'];?>" />

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">确认订单</label>
                    <div class="col-sm-9">
                        <input type="text" name="jp_trueorder" class="form-control" value="<?php  echo $jparr['jp_trueorder'];?>" />

                    </div>
                </div>

                  <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否确定</label>
                    <div class="col-sm-9">
                        <input type="text" name="jp_true1" class="form-control" value="<?php  echo $jparr['jp_true1'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是</label>
                    <div class="col-sm-9">
                        <input type="text" name="jp_true2" class="form-control" value="<?php  echo $jparr['jp_true2'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">否</label>
                    <div class="col-sm-9">
                        <input type="text" name="jp_true3" class="form-control" value="<?php  echo $jparr['jp_true3'];?>" />

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">确定</label>
                    <div class="col-sm-9">
                        <input type="text" name="jp_true" class="form-control" value="<?php  echo $jparr['jp_true'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">预约席位</label>
                    <div class="col-sm-9">
                        <input type="text" name="jp_yuyue" class="form-control" value="<?php  echo $jparr['jp_yuyue'];?>" />

                    </div>
                </div>
            </div>
        </div>

            <!--韩文-->
            <div class="panel panel-default" id="hw" style="display:none;">
              <div class="panel-body">

              <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">人</label>
                    <div class="col-sm-9">
                        <input type="text" name="hw_p" class="form-control" value="<?php  echo $hwarr['hw_p'];?>" />

                    </div>
                </div>

              <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">更多</label>
                    <div class="col-sm-9">
                        <input type="text" name="hw_more" class="form-control" value="<?php  echo $hwarr['hw_more'];?>" />

                    </div>
                </div>
                   <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">首页</label>
                    <div class="col-sm-9">
                        <input type="text" name="hw_index" class="form-control" value="<?php  echo $hwarr['hw_index'];?>" />

                    </div>
                </div>
              <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">按销量排序</label>
                    <div class="col-sm-9">
                        <input type="text" name="hw_sale" class="form-control" value="<?php  echo $hwarr['hw_sale'];?>" />

                    </div>
                </div>
                  <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">价格由高到底</label>
                    <div class="col-sm-9">
                        <input type="text" name="hw_orderh" class="form-control" value="<?php  echo $hwarr['hw_orderh'];?>" />

                    </div>
                </div>
                  <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">价格由低到高</label>
                    <div class="col-sm-9">
                        <input type="text" name="hw_orders" class="form-control" value="<?php  echo $hwarr['hw_orders'];?>" />

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">姓名</label>
                    <div class="col-sm-9">
                        <input type="text" name="hw_name" class="form-control" value="<?php  echo $hwarr['hw_name'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">电话</label>
                    <div class="col-sm-9">
                        <input type="text" name="hw_tel" class="form-control" value="<?php  echo $hwarr['hw_tel'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">邮编</label>
                    <div class="col-sm-9">
                        <input type="text" name="hw_code" class="form-control" value="<?php  echo $hwarr['hw_code'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">区域</label>
                    <div class="col-sm-9">
                        <input type="text" name="hw_area" class="form-control" value="<?php  echo $hwarr['hw_area'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">地址</label>
                    <div class="col-sm-9">
                        <input type="text" name="hw_address" class="form-control" value="<?php  echo $hwarr['hw_address'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">人数</label>
                    <div class="col-sm-9">
                        <input type="text" name="hw_people" class="form-control" value="<?php  echo $hwarr['hw_people'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否吸烟</label>
                    <div class="col-sm-9">
                        <input type="text" name="hw_smoke" class="form-control" value="<?php  echo $hwarr['hw_smoke'];?>" />

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">吸烟</label>
                    <div class="col-sm-9">
                        <input type="text" name="hw_issmoke" class="form-control" value="<?php  echo $hwarr['hw_issmoke'];?>" />

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">禁烟</label>
                    <div class="col-sm-9">
                        <input type="text" name="hw_nosmoke" class="form-control" value="<?php  echo $hwarr['hw_nosmoke'];?>" />

                    </div>
                </div>
                   <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">时间</label>
                    <div class="col-sm-9">
                        <input type="text" name="hw_time" class="form-control" value="<?php  echo $hwarr['hw_time'];?>" />

                    </div>
                </div>
               <!--  <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">桌台</label>
                    <div class="col-sm-9">
                        <input type="text" name="hw_table" class="form-control" value="<?php  echo $hwarr['hw_table'];?>" />

                    </div>
                </div> -->
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">备注</label>
                    <div class="col-sm-9">
                        <input type="text" name="hw_remark" class="form-control" value="<?php  echo $hwarr['hw_remark'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">数量</label>
                    <div class="col-sm-9">
                        <input type="text" name="hw_num" class="form-control" value="<?php  echo $hwarr['hw_num'];?>" />

                    </div>
                </div>
                <!--  <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">配送费用</label>
                    <div class="col-sm-9">
                        <input type="text" name="hw_free" class="form-control" value="<?php  echo $hwarr['hw_free'];?>" />

                    </div>
                </div> -->
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">合计</label>
                    <div class="col-sm-9">
                        <input type="text" name="hw_count" class="form-control" value="<?php  echo $hwarr['hw_count'];?>" />

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">确认订单</label>
                    <div class="col-sm-9">
                        <input type="text" name="hw_trueorder" class="form-control" value="<?php  echo $hwarr['hw_trueorder'];?>" />

                    </div>
                </div>
                  <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否确定</label>
                    <div class="col-sm-9">
                        <input type="text" name="hw_true1" class="form-control" value="<?php  echo $hwarr['hw_true1'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是</label>
                    <div class="col-sm-9">
                        <input type="text" name="hw_true2" class="form-control" value="<?php  echo $hwarr['hw_true2'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">否</label>
                    <div class="col-sm-9">
                        <input type="text" name="hw_true3" class="form-control" value="<?php  echo $hwarr['hw_true3'];?>" />

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">确定</label>
                    <div class="col-sm-9">
                        <input type="text" name="hw_true" class="form-control" value="<?php  echo $hwarr['hw_true'];?>" />

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">预约席位</label>
                    <div class="col-sm-9">
                        <input type="text" name="hw_yuyue" class="form-control" value="<?php  echo $hwarr['hw_yuyue'];?>" />

                    </div>
                </div>
            </div>
        </div>

            <!--繁体中文-->
            <div class="panel panel-default" id="ft" style="display:none;">
              <div class="panel-body">
            <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">人</label>
                    <div class="col-sm-9">
                        <input type="text" name="ft_p" class="form-control" value="<?php  echo $ftarr['ft_p'];?>" />

                    </div>
                </div>
               <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">更多</label>
                    <div class="col-sm-9">
                        <input type="text" name="ft_more" class="form-control" value="<?php  echo $ftarr['ft_more'];?>" />

                    </div>
                </div>
             <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">首页</label>
                    <div class="col-sm-9">
                        <input type="text" name="ft_index" class="form-control" value="<?php  echo $ftarr['ft_index'];?>" />

                    </div>
                </div>
             <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">按销量排序1</label>
                    <div class="col-sm-9">
                        <input type="text" name="ft_sale" class="form-control" value="<?php  echo $ftarr['ft_sale'];?>" />

                    </div>
                </div>
                  <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">价格由高到底</label>
                    <div class="col-sm-9">
                        <input type="text" name="ft_orderh" class="form-control" value="<?php  echo $ftarr['ft_orderh'];?>" />

                    </div>
                </div>
                  <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">价格由低到高</label>
                    <div class="col-sm-9">
                        <input type="text" name="ft_orders" class="form-control" value="<?php  echo $ftarr['ft_orders'];?>" />

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">姓名</label>
                    <div class="col-sm-9">
                        <input type="text" name="ft_name" class="form-control" value="<?php  echo $ftarr['ft_name'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">电话</label>
                    <div class="col-sm-9">
                        <input type="text" name="ft_tel" class="form-control" value="<?php  echo $ftarr['ft_tel'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">邮编</label>
                    <div class="col-sm-9">
                        <input type="text" name="ft_code" class="form-control" value="<?php  echo $ftarr['ft_code'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">区域</label>
                    <div class="col-sm-9">
                        <input type="text" name="ft_area" class="form-control" value="<?php  echo $ftarr['ft_area'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">地址</label>
                    <div class="col-sm-9">
                        <input type="text" name="ft_address" class="form-control" value="<?php  echo $ftarr['ft_address'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">人数</label>
                    <div class="col-sm-9">
                        <input type="text" name="ft_people" class="form-control" value="<?php  echo $ftarr['ft_people'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否吸烟</label>
                    <div class="col-sm-9">
                        <input type="text" name="ft_smoke" class="form-control" value="<?php  echo $ftarr['ft_smoke'];?>" />

                    </div>
                </div>
                  <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">吸烟</label>
                    <div class="col-sm-9">
                        <input type="text" name="ft_issmoke" class="form-control" value="<?php  echo $ftarr['ft_issmoke'];?>" />

                    </div>
                </div>
                  <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">禁烟</label>
                    <div class="col-sm-9">
                        <input type="text" name="ft_nosmoke" class="form-control" value="<?php  echo $ftarr['ft_nosmoke'];?>" />

                    </div>
                </div>
                   <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">时间</label>
                    <div class="col-sm-9">
                        <input type="text" name="ft_time" class="form-control" value="<?php  echo $ftarr['ft_time'];?>" />

                    </div>
                </div>
              <!--   <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">桌台</label>
                    <div class="col-sm-9">
                        <input type="text" name="ft_table" class="form-control" value="<?php  echo $ftarr['ft_table'];?>" />

                    </div>
                </div> -->
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">备注</label>
                    <div class="col-sm-9">
                        <input type="text" name="ft_remark" class="form-control" value="<?php  echo $ftarr['ft_remark'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">数量</label>
                    <div class="col-sm-9">
                        <input type="text" name="ft_num" class="form-control" value="<?php  echo $ftarr['ft_num'];?>" />

                    </div>
                </div>
               <!--   <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">配送费用</label>
                    <div class="col-sm-9">
                        <input type="text" name="ft_free" class="form-control" value="<?php  echo $ftarr['ft_free'];?>" />

                    </div>
                </div> -->
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">合计</label>
                    <div class="col-sm-9">
                        <input type="text" name="ft_count" class="form-control" value="<?php  echo $ftarr['ft_count'];?>" />

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">确认订单</label>
                    <div class="col-sm-9">
                        <input type="text" name="ft_trueorder" class="form-control" value="<?php  echo $ftarr['ft_trueorder'];?>" />

                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否确定</label>
                    <div class="col-sm-9">
                        <input type="text" name="ft_true1" class="form-control" value="<?php  echo $ftarr['ft_true1'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是</label>
                    <div class="col-sm-9">
                        <input type="text" name="ft_true2" class="form-control" value="<?php  echo $ftarr['ft_true2'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">否</label>
                    <div class="col-sm-9">
                        <input type="text" name="ft_true3" class="form-control" value="<?php  echo $ftarr['ft_true3'];?>" />

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">确定</label>
                    <div class="col-sm-9">
                        <input type="text" name="ft_true" class="form-control" value="<?php  echo $ftarr['ft_true'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">预约席位</label>
                    <div class="col-sm-9">
                        <input type="text" name="ft_yuyue" class="form-control" value="<?php  echo $ftarr['ft_yuyue'];?>" />

                    </div>
                </div>
            </div>
        </div>

            <!--PY-->
                <div class="panel panel-default" id="py" style="display:none;">
            <div class="panel-body">
            <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">人</label>
                    <div class="col-sm-9">
                        <input type="text" name="py_p" class="form-control" value="<?php  echo $pyarr['py_p'];?>" />

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">更多</label>
                    <div class="col-sm-9">
                        <input type="text" name="py_more" class="form-control" value="<?php  echo $pyarr['py_more'];?>" />

                    </div>
                </div>
              <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">首页</label>
                    <div class="col-sm-9">
                        <input type="text" name="py_index" class="form-control" value="<?php  echo $pyarr['py_index'];?>" />

                    </div>
                </div>
             <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">按销量排序</label>
                    <div class="col-sm-9">
                        <input type="text" name="py_sale" class="form-control" value="<?php  echo $pyarr['py_sale'];?>" />

                    </div>
                </div>
                  <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">价格由高到底</label>
                    <div class="col-sm-9">
                        <input type="text" name="py_orderh" class="form-control" value="<?php  echo $pyarr['py_orderh'];?>" />

                    </div>
                </div>
                  <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">价格由低到高</label>
                    <div class="col-sm-9">
                        <input type="text" name="py_orders" class="form-control" value="<?php  echo $pyarr['py_orders'];?>" />

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">姓名</label>
                    <div class="col-sm-9">
                        <input type="text" name="py_name" class="form-control" value="<?php  echo $pyarr['py_name'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">电话</label>
                    <div class="col-sm-9">
                        <input type="text" name="py_tel" class="form-control" value="<?php  echo $pyarr['py_tel'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">邮编</label>
                    <div class="col-sm-9">
                        <input type="text" name="py_code" class="form-control" value="<?php  echo $pyarr['py_code'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">区域</label>
                    <div class="col-sm-9">
                        <input type="text" name="py_area" class="form-control" value="<?php  echo $pyarr['py_area'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">地址</label>
                    <div class="col-sm-9">
                        <input type="text" name="py_address" class="form-control" value="<?php  echo $pyarr['py_address'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">人数</label>
                    <div class="col-sm-9">
                        <input type="text" name="py_people" class="form-control" value="<?php  echo $pyarr['py_people'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否吸烟</label>
                    <div class="col-sm-9">
                        <input type="text" name="py_smoke" class="form-control" value="<?php  echo $pyarr['py_smoke'];?>" />

                    </div>
                </div>
                  <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">吸烟</label>
                    <div class="col-sm-9">
                        <input type="text" name="py_issmoke" class="form-control" value="<?php  echo $pyarr['py_issmoke'];?>" />

                    </div>
                </div>
                  <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">禁烟</label>
                    <div class="col-sm-9">
                        <input type="text" name="py_nosmoke" class="form-control" value="<?php  echo $pyarr['py_nosmoke'];?>" />

                    </div>
                </div>
                   <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">时间</label>
                    <div class="col-sm-9">
                        <input type="text" name="py_time" class="form-control" value="<?php  echo $pyarr['py_time'];?>" />

                    </div>
                </div>
               <!--  <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">桌台</label>
                    <div class="col-sm-9">
                        <input type="text" name="py_table" class="form-control" value="<?php  echo $pyarr['py_table'];?>" />

                    </div>
                </div> -->
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">备注</label>
                    <div class="col-sm-9">
                        <input type="text" name="py_remark" class="form-control" value="<?php  echo $pyarr['py_remark'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">数量</label>
                    <div class="col-sm-9">
                        <input type="text" name="py_num" class="form-control" value="<?php  echo $pyarr['py_num'];?>" />

                    </div>
                </div>
                <!--  <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">配送费用</label>
                    <div class="col-sm-9">
                        <input type="text" name="py_free" class="form-control" value="<?php  echo $pyarr['py_free'];?>" />

                    </div>
                </div> -->
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">合计</label>
                    <div class="col-sm-9">
                        <input type="text" name="py_count" class="form-control" value="<?php  echo $pyarr['py_count'];?>" />

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">确认订单</label>
                    <div class="col-sm-9">
                        <input type="text" name="py_trueorder" class="form-control" value="<?php  echo $pyarr['py_trueorder'];?>" />

                    </div>
                </div>
                     <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否确定</label>
                    <div class="col-sm-9">
                        <input type="text" name="py_true1" class="form-control" value="<?php  echo $pyarr['py_true1'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是</label>
                    <div class="col-sm-9">
                        <input type="text" name="py_true2" class="form-control" value="<?php  echo $pyarr['py_true2'];?>" />

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">否</label>
                    <div class="col-sm-9">
                        <input type="text" name="py_true3" class="form-control" value="<?php  echo $pyarr['py_true3'];?>" />

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">确定</label>
                    <div class="col-sm-9">
                        <input type="text" name="py_true" class="form-control" value="<?php  echo $pyarr['py_true'];?>" />

                    </div>
                </div>
                  <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">预约席位</label>
                    <div class="col-sm-9">
                        <input type="text" name="py_yuyue" class="form-control" value="<?php  echo $pyarr['py_yuyue'];?>" />

                    </div>
                </div>
            </div>
        </div>





        <div class="form-group col-sm-12">
            <input type="submit" name="submit" value="更新排号设置" class="btn btn-primary col-lg-3" />
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
        </div>
        </form>
</div>
<script >
    $(".jp").click(function(event) {
        $("#en").hide()
        $("#jp").show()
        $("#ft").hide()
        $("#hw").hide()
        $("#py").hide()
        $("#cn").hide()
        $(this).addClass("active").siblings().removeClass('active')
    })
     $(".hw").click(function(event) {
        $("#en").hide()
        $("#jp").hide()
        $("#ft").hide()
        $("#hw").show()
        $("#py").hide()
        $("#cn").hide()
        $(this).addClass("active").siblings().removeClass('active')

    })
      $(".en").click(function(event) {
        $("#en").show()
        $("#cn").hide()
        $("#jp").hide()
        $("#ft").hide()
        $("#hw").hide()
        $("#py").hide()
        $(this).addClass("active").siblings().removeClass('active')

    })
    $(".cn").click(function(event) {
        $("#cn").show()
        $("#en").hide()
        $("#jp").hide()
        $("#ft").hide()
        $("#hw").hide()
        $("#py").hide()
        $(this).addClass("active").siblings().removeClass('active')

    })
    $(".ft").click(function(event) {
        // alert(111)
        $("#en").hide()
        $("#jp").hide()
        $("#ft").show()
        $("#hw").hide()
        $("#py").hide()
        $("#cn").hide()
        $(this).addClass("active").siblings().removeClass('active')

    })
      $(".py").click(function(event) {
        $("#en").hide()
        $("#jp").hide()
        $("#ft").hide()
        $("#hw").hide()
        $("#py").show()
        $("#cn").hide()
        $(this).addClass("active").siblings().removeClass('active')


    })

</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>