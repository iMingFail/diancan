<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<?php  if($operation == 'display') { ?>
<link rel="stylesheet" type="text/css" href="<?php  echo $_W['siteroot'];?>addons/weisrc_dish/template/css/main.css"/>
<div class="main">
    <ul class="nav nav-tabs" role="tablist">
        <li>
            <a href="<?php  echo $this->createWebUrl('tablezones', array('op' => 'display', 'storeid' => $storeid))?>">餐桌类型</a>
        </li>
        <li class="active">
            <a href="<?php  echo $this->createWebUrl('tables', array('op' => 'display', 'storeid' => $storeid))?>">餐桌管理</a>
        </li>
    </ul>
    <div class="lastest-notification alert alert-info">
        <div class="notification-label">
            温馨提示:<br/>
            1.删除桌台请先切换二维码模式,再点击垃圾桶标志删除.<br/>
            2.桌台的二维码请切换二维码模式.
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">

            <div class="header">
                <h3>桌台 列表</h3>
            </div>
            <div class="form-group">
                <a class="btn btn-success btn-sm" href="<?php  echo $this->createWebUrl('tables', array('op' => 'display', 'storeid' => $storeid, 'type' => 'state'))?>"><i class="fa fa-circle-o"></i> 桌台状态</a>
                <a class="btn btn-success btn-sm" href="<?php  echo $this->createWebUrl('tables', array('op' => 'display', 'storeid' => $storeid, 'type' => 'qrcode'))?>"><i class="fa fa-qrcode"></i> 二维码</a>
                <a class="btn btn-primary btn-sm" href="<?php  echo $this->createWebUrl('tables', array('op' => 'post', 'storeid' => $storeid))?>">新建 桌台</a>
                <a class="btn btn-primary btn-sm" href="<?php  echo $this->createWebUrl('tables', array('op' => 'batch', 'storeid' => $storeid))?>">批量新建</a>
                <a class="btn btn-warning btn-sm" href="<?php  echo $this->createWebUrl('tables', array('op' => 'clear', 'storeid' => $storeid))?>" onclick="return confirm('确认操作吗？');return false;">一键清台</a>
                <div class="form-group inline-form" style="display: inline-block;margin-bottom: 0px;">
                    <form accept-charset="UTF-8" action="./index.php" class="form-inline" id="diandanbao/table_search" method="get" role="form">
                        <div style="margin:0;padding:0;display:inline">
                            <input name="utf8" type="hidden" value="✓"></div>
                        <input type="hidden" name="c" value="site" />
                        <input type="hidden" name="a" value="entry" />
                        <input type="hidden" name="m" value="weisrc_dish" />
                        <input type="hidden" name="do" value="tables" />
                        <input type="hidden" name="storeid" value="<?php  echo $storeid;?>" />
                        <div class="form-group">
                            <label class="sr-only" for="q_name">名字(桌台号)</label>
                            <input class="form-control" id="keyword" name="keyword" placeholder="名字(桌台号)" type="search">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="q_table_zone_id_eq">Table zone 等于</label>
                            <select id="tablezonesid" name="tablezonesid" class="form-control-excel">
                                <option value="">桌台类型</option>
                                <?php  if(is_array($tablezones)) { foreach($tablezones as $row) { ?>
                                <option value="<?php  echo $row['id'];?>" <?php  if($row['id'] == $item['tablezonesid'] || $row['id'] == $tablezonesid) { ?> selected="selected"<?php  } ?>><?php  echo $row['title'];?></option>
                                <?php  } } ?>
                            </select>
                        </div>
                        <input class="btn btn-sm btn-success" name="commit" type="submit" value="搜索">
                        <!--<a class="btn btn-success btn-sm" data-remote="true" href="">批量导出桌子二维码供打印(横版)</a>-->
                        <!--<a class="btn btn-primary btn-sm" data-remote="true" href="">批量导出桌子二维码供打印(竖版)</a>-->
                    </form>
                </div>
            </div>
            <div id="queue-setting-index-body">
                <?php  if($type == 'state') { ?>
                <div class="table-state-tables">
                    <div class="col-xs-12">
                        <?php  if(is_array($list)) { foreach($list as $item) { ?>
                        <?php  if($item['status']==0) { ?>
                        <?php  $status = 'idle';?>
                        <?php  $title = '空闲';?>
                        <?php  } else if($item['status']==1) { ?>
                        <?php  $status = 'opened';?>
                        <?php  $title = '已开台';?>
                        <?php  } else if($item['status']==2) { ?>
                        <?php  $status = 'ordered';?>
                        <?php  $title = '已下单';?>
                        <?php  } else if($item['status']==3) { ?>
                        <?php  $status = 'paid';?>
                        <?php  $title = '已支付';?>
                        <?php  } ?>
                        <div class="state-table" data-id="<?php  echo $item['id'];?>">
                            <a class="<?php  echo $status;?> round" href="<?php  echo $this->createWebUrl('tables', array('op' => 'detail', 'storeid' => $storeid, 'tablesid' => $item['id']))?>" data-remote="" title="点击查看订单详情">
                                <div class="state"><?php  echo $title;?></div>
                            </a>
                            <div style="color:green;font-size:12px;text-align:center">
                                <?php  $ishavelabel = 0;?>
                                <?php  if(is_array($table_label)) { foreach($table_label as $v) { ?>
                                <?php  if($v['id']==$item['print_label']) { ?>
                                标签：<?php  echo $v['title'];?><?php  $ishavelabel=1?><?php  } ?>
                                <?php  } } ?>
                                <?php  if($ishavelabel==0) { ?>
                                标签：无
                                <?php  } ?>
                            </div>
                            <div class="name overflow-ellipsis">
                                <span><a href="<?php  echo $this->createWebUrl('tables', array('op' => 'detail', 'storeid' => $storeid, 'tablesid' => $item['id']))?>"><?php  echo $item['title'];?></a></span>
                                <form accept-charset="UTF-8" action="<?php  echo $this->createWebUrl('tables', array('op' => 'updatestate', 'storeid' => $storeid, 'tablesid' => $item['id']))?>" data-remote="true" method="post" style="display:inline-block;">
                                    <div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="✓">
                                        <input name="_method" type="hidden" value="PUT">
                                    </div>
                                    <select id="workflow_state" name="workflow_state" onchange="$(this.form).submit();">
                                        <option value="0" <?php  if($item['status']==0) { ?>selected="selected"<?php  } ?>>空闲</option>
                                        <option value="1" <?php  if($item['status']==1) { ?>selected="selected"<?php  } ?>>已开台</option>
                                        <option value="2" <?php  if($item['status']==2) { ?>selected="selected"<?php  } ?>>已下单</option>
                                        <!--<option selected="selected" value="check_outing">结帐中</option>-->
                                        <option value="3" <?php  if($item['status']==3) { ?>selected="selected"<?php  } ?>>已支付</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                        <?php  } } ?>
                    </div>
                    <div class="col-xs-4">
                        <div class="table-order"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <?php  } else { ?>
                <div class="alert alert-success">
                    将如下桌台二维码打印并分别贴在对应桌台上，即可实现扫码下单的功能。微信用户到店后只需拿起微信轻轻一扫，即可实现全自动点菜下单。
                </div>
                <div class="qr-code-table">
                    <?php  if(is_array($list)) { foreach($list as $item) { ?>
                    <?php  if($item['status']==0) { ?>
                    <?php  $status = 'idle';?>
                    <?php  $title = '空闲';?>
                    <?php  } else if($item['status']==1) { ?>
                    <?php  $status = 'opened';?>
                    <?php  $title = '已开台';?>
                    <?php  } else if($item['status']==2) { ?>
                    <?php  $status = 'ordered';?>
                    <?php  $title = '已下单';?>
                    <?php  } else if($item['status']==3) { ?>
                    <?php  $status = 'paid';?>
                    <?php  $title = '已支付';?>
                    <?php  } ?>
                    <div class="qr-code-item">
                        <div class="qr-code-op">
                            <a data-rel="tooltip" href="<?php  echo $this->createWebUrl('tables', array('id' => $item['id'], 'storeid' => $storeid, 'op' => 'post'))?>" title="编辑"><icon class="fa fa-edit"></icon></a>
                            <a data-confirm="确定删除?" data-method="delete" data-rel="tooltip" href="<?php  echo $this->createWebUrl('tables', array('id' => $item['id'], 'storeid' => $storeid, 'op' => 'delete'))?>" onclick="return confirm('确认操作吗？');return false;" rel="nofollow" title="删除"><icon class="fa fa-trash-o"></icon></a>
                        </div>
                        <a href="<?php  echo $this->createWebUrl('tables', array('op' => 'detail', 'storeid' => $storeid, 'tablesid' => $item['id']))?>">
                            <div class="qr-code-box">
                                <div class="qr-code-item-image">
                                    <img alt="<?php  echo $item['title'];?>" src="<?php echo $this->fm_qrcode($_W['siteroot'] . 'app/index.php?i=' . $_W['uniacid'] . '&c=entry&mode=1&storeid=' . $storeid . '&tablesid=' . $item['id'] . '&do=mindex&m=weisrc_dish', 'qrcode_' . $item['id'], '', $logo);?>" width="100%">
                                </div>
                                <div class="qr-code-item-info">
                                    <?php  echo $item['title'];?>
                                </div>
                            </div>
                            <div class="qr-code-item-footer">
                                扫描次数: <?php  if(empty($tablesorder[$item['id']]['count'])) { ?>0<?php  } else { ?><?php  echo $tablesorder[$item['id']]['count'];?><?php  } ?>
                                <br>
                                当前状态
                                :
                                <span class="label label-info"><?php  echo $title;?></span>
                                <br>
                                桌台类型: <?php  echo $tablezones[$item['tablezonesid']]['title'];?>
                            </div>
                        </a>
                    </div>
                    <?php  } } ?>
                    <div class="space"></div>
                </div>
                <?php  } ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<?php  } else if($operation == 'batch') { ?>
<div class="main">
    <div class="panel panel-default">
        <div class="panel-body">
            <a class="btn btn-warning" href="<?php  echo $this->createWebUrl('tables', array('op' => 'display', 'storeid' => $storeid))?>">返回餐桌管理
            </a>
        </div>
    </div>
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
        <input type="hidden" name="storeid" value="<?php  echo $storeid;?>" />
        <input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
        <div class="panel panel-default">
            <div class="panel-heading">
                批量创建桌台
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">起始桌台号</label>
                    <div class="col-sm-9">
                        <input type="text" name="title" class="form-control" value="<?php  echo $item['title'];?>"  placeholder=""/>
                        <span class="help-block">例如：C001<code>注意:填的时候台号要4位至少</code></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">可供就餐人数</label>
                    <div class="col-sm-9">
                        <input type="number" name="user_count" class="form-control" value="<?php  echo $item['user_count'];?>" placeholder=""/>
                        <span class="help-block">
                            设置为自动排号时，当排号客户的用餐人数少于等于此人数时，系统将自动为排号客户分配此队列
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">桌台类型</label>
                    <div class="col-sm-9">
                        <select class="form-control" style="margin-right:15px;" name="tablezonesid" autocomplete="off" class="form-control">
                            <?php  if(is_array($tablezones)) { foreach($tablezones as $row) { ?>
                            <option value="<?php  echo $row['id'];?>" <?php  if($row['id'] == $item['tablezonesid'] || $row['id'] == $tablezonesid) { ?> selected="selected"<?php  } ?>><?php  echo $row['title'];?></option>
                            <?php  } } ?>
                        </select>
                        <div class="help-block">
                            还没有分类，点我 <a href="<?php  echo $this->createWebUrl('tablezones', array('op' => 'post', 'storeid' => $storeid))?>"><i class="fa fa-plus-circle"></i> 添加分类</a>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">桌台标签</label>
                    <div class="col-sm-9">
                        <select class="form-control" style="margin-right:15px;" name="table_label_id" autocomplete="off" class="form-control">
                            <option value="0" selected="selected">无</option>
                            <?php  if(is_array($table_label)) { foreach($table_label as $v) { ?>
                            <option value="<?php  echo $v['id'];?>" <?php  if($v['id'] == $item['print_label']) { ?> selected="selected"<?php  } ?>><?php  echo $v['title'];?></option>
                            <?php  } } ?>
                        </select>
                        <div class="help-block">
                            还没有标签，点我 <a href="<?php  echo $this->createWebUrl('printlabel', array('op' => 'post', 'storeid' => $storeid))?>"><i class="fa fa-plus-circle"></i> 添加标签</a>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">创建桌台数量</label>
                    <div class="col-sm-9">
                        <input type="number" name="table_count" class="form-control" value="<?php  echo $item['table_count'];?>" placeholder=""/>
                        <span class="help-block">
                            根据创建的桌台数量，系统会自动依据起始桌台号依次递增,<br/> 例如C001, C002, C003, C004.....,一次最多创建10张桌台
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
                    <div class="col-sm-9">
                        <input type="text" name="displayorder" class="form-control" value="<?php  echo $item['displayorder'];?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <input type="submit" name="submit" value="创建" class="btn btn-primary col-lg-1" />
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
        </div>
    </form>
</div>
<?php  } else if($operation == 'post') { ?>
<div class="main">
    <div class="panel panel-default">
        <div class="panel-body">
            <a class="btn btn-warning" href="<?php  echo $this->createWebUrl('tables', array('op' => 'display', 'storeid' => $storeid))?>">返回餐桌管理
            </a>
        </div>
    </div>
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
        <input type="hidden" name="storeid" value="<?php  echo $storeid;?>" />
        <input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
        <div class="panel panel-default">
            <div class="panel-heading">
                桌台 详情
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">名字(桌台号)</label>
                    <div class="col-sm-9">
                        <input type="text" name="title" class="form-control" value="<?php  echo $item['title'];?>"  placeholder=""/>
                        <span class="help-block">例如：C001</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">可供就餐人数</label>
                    <div class="col-sm-9">
                        <input type="number" name="user_count" class="form-control" value="<?php  echo $item['user_count'];?>" placeholder=""/>
                        <span class="help-block">
                            设置为自动排号时，当排号客户的用餐人数少于等于此人数时，系统将自动为排号客户分配此队列
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">桌台类型</label>
                    <div class="col-sm-9">
                        <select class="form-control" style="margin-right:15px;" name="tablezonesid" autocomplete="off" class="form-control">
                            <?php  if(is_array($tablezones)) { foreach($tablezones as $row) { ?>
                            <option value="<?php  echo $row['id'];?>" <?php  if($row['id'] == $item['tablezonesid'] || $row['id'] == $tablezonesid) { ?> selected="selected"<?php  } ?>><?php  echo $row['title'];?></option>
                            <?php  } } ?>
                        </select>
                        <div class="help-block">
                            还没有分类，点我 <a href="<?php  echo $this->createWebUrl('tablezones', array('op' => 'post', 'storeid' => $storeid))?>"><i class="fa fa-plus-circle"></i> 添加分类</a>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">标签</label>
                    <div class="col-sm-9">
                        <select class="form-control" style="margin-right:15px;" name="table_label_id" autocomplete="off" class="form-control">
                            <option value="0" selected="selected">无</option>
                            <?php  if(is_array($table_label)) { foreach($table_label as $v) { ?>
                            <option value="<?php  echo $v['id'];?>" <?php  if($v['id'] == $item['print_label']) { ?> selected="selected"<?php  } ?>><?php  echo $v['title'];?></option>
                            <?php  } } ?>
                        </select>
                        <div class="help-block">
                            还没有标签，点我 <a href="<?php  echo $this->createWebUrl('printlabel', array('op' => 'post', 'storeid' => $storeid))?>"><i class="fa fa-plus-circle"></i> 添加标签</a>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
                    <div class="col-sm-9">
                        <input type="text" name="displayorder" class="form-control" value="<?php  echo $item['displayorder'];?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-3" />
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
        </div>
    </form>
</div>
<?php  } else if($operation == 'detail') { ?>
<link rel="stylesheet" type="text/css" href="<?php  echo $_W['siteroot'];?>addons/weisrc_dish/template/css/main.css"/>
<div class="main">
    <div class="alert alert-info">
        <i class="fa fa-info-circle"></i>提示：取消和完成的订单不会列入统计
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row-fluid">
                <div style="width:300px;">
                    总金额:<strong class="text-danger"><?php  echo $totalprice;?></strong>
                    ,已支付:<strong class="text-danger"><?php  echo $payprice;?></strong>
                    ,未支付:<strong class="text-danger"><?php  echo $notprice;?></strong>
                </div>
                <div>
                    <select id="paytype" name="paytype" class="form-control-excel">
                        <option value="0">请选择支付方式</option>
                        <option value="1"<?php  if($_GPC['paytype'] == 1) { ?> selected="selected"<?php  } ?>>余额支付</option>
                        <option value="2"<?php  if($_GPC['paytype'] == 2) { ?> selected="selected"<?php  } ?>>微信支付</option>
                        <option value="3"<?php  if($_GPC['paytype'] == 3) { ?> selected="selected"<?php  } ?>>现金付款</option>
                        <option value="4"<?php  if($_GPC['paytype'] == 4) { ?> selected="selected"<?php  } ?>>支付宝</option>
                        <option value="10"<?php  if($_GPC['paytype'] == 10) { ?> selected="selected"<?php  } ?>>pos刷卡</option>
                        <option value="11"<?php  if($_GPC['paytype'] == 11) { ?> selected="selected"<?php  } ?>>挂帐</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <form action="" method="post" class="form-horizontal form" >
                <input type="hidden" name="storeid" value="<?php  echo $storeid;?>" />
                <div class="table-responsive panel-body">
                    <table class="table table-hover">
                        <thead class="navbar-inner">
                        <tr>
                            <th class='with-checkbox' style="width:2%;"><input type="checkbox" class="check_all" checked="checked"/></th>
                            <th style="width:5%;">编号</th>
                            <th style="width:16%;">订单号</th>
                            <th style="width:10%;">订单总额</th>
                            <th style="width:15%;">联系信息</th>
                            <th style="width:8%;">状态</th>
                            <th style="width:10%;">支付状态</th>
                            <th style="width:10%;">下单时间</th>
                            <th style="width:12%; text-align:right;"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php  if(is_array($orderlist)) { foreach($orderlist as $item) { ?>
                        <tr>
                            <td class="with-checkbox"><input type="checkbox" name="check" value="<?php  echo $item['id'];?>" checked="checked"></td>
                            <td>
                                <?php  echo $item['id'];?>
                            </td>
                            <td>
                                <?php  echo $item['ordersn'];?>
                                <?php  $br = 0?>
                                <?php  if($item['is_append']==1) { ?>
                                <br/>
                                <span class="label label-success">加单</span>
                                <?php  $br = 1?>
                                <?php  } ?>
                                <?php  if($item['append_dish']==1) { ?>
                                <?php  if($br == 0) { ?><br/><?php  } ?>
                                <span class="label label-danger">加菜</span>
                                <?php  $br = 1?>
                                <?php  } ?>
                                <?php  if($item['isvip']==1) { ?>
                                <?php  if($br == 0) { ?><br/><?php  } ?>
                                <span class="label label-success">会员</span>
                                <?php  } ?>
                                <?php  if($item['ismerge']==1) { ?>
                                <br/>
                                <span class="label label-success">并单</span>
                                <?php  } ?>
                            </td>
                            <td>
                                <span class="label label-warning" style="font-weight:bold;">￥<?php  echo $item['totalprice'];?></span>
                            </td>
                            <td>
                                <a href="<?php  echo $this->createWebUrl('fans', array('id' => $item['fansid'], 'op' => 'post'))?>">
                                    <img src="<?php  echo tomedia($item['headimgurl']);?>" style="width:30px;height:30px;padding:1px;border:1px solid #ccc"/>
                                    </br><?php  echo $item['nickname'];?>
                                </a>
                            </td>
                            <td>
                                <?php  if($item['status'] == 0) { ?><span class="label label-info">待处理</span><?php  } ?>
                                <?php  if($item['status'] == 1) { ?><span class="label label-warning">已确认</span><?php  } ?>
                                <?php  if($item['status'] == 2) { ?><span class="label label-success">已并台</span><?php  } ?>
                                <?php  if($item['status'] == 3) { ?><span class="label label-success">已完成</span><?php  } ?>
                                <?php  if($item['status'] == -1) { ?><span class="label label-danger">已取消</span><?php  } ?>
                            </td>
                            <td>
                                <?php  if($item['paytype']) { ?>
                                <?php  if($item['paytype'] == 1) { ?>
                                <span class="label label-success"><i class="fa fa-money">&nbsp;余额支付</i></span>
                                <?php  } ?>
                                <?php  if($item['paytype'] == 2) { ?>
                                <span class="label label-success"><i class="fa fa-check-circle">&nbsp;微信支付</i></span>
                                <?php  } ?>
                                <?php  if($item['paytype'] == 3) { ?>
                                <span class="label label-success"><i class="fa fa-money">&nbsp;现金支付</i></span>
                                <?php  } ?>
                                <?php  if($item['paytype'] == 4) { ?>
                                <span class="label label-info"><i class="fa fa-alipay">&nbsp;支付宝</i></span>
                                <?php  } ?>
                                <!--5现金，6银行卡，7会员卡，8微信，9支付宝-->
                                <?php  if($item['paytype'] == 5) { ?>
                                <span class="label label-info"><i class="fa fa-alipay">&nbsp;现金</i></span>
                                <?php  } ?>
                                <?php  if($item['paytype'] == 6) { ?>
                                <span class="label label-info"><i class="fa fa-alipay">&nbsp;银行卡</i></span>
                                <?php  } ?>
                                <?php  if($item['paytype'] == 7) { ?>
                                <span class="label label-info"><i class="fa fa-alipay">&nbsp;会员卡</i></span>
                                <?php  } ?>
                                <?php  if($item['paytype'] == 8) { ?>
                                <span class="label label-info"><i class="fa fa-alipay">&nbsp;微信</i></span>
                                <?php  } ?>
                                <?php  if($item['paytype'] == 9) { ?>
                                <span class="label label-info"><i class="fa fa-alipay">&nbsp;支付宝</i></span>
                                <?php  } ?>
                                <?php  if($item['paytype'] == 10) { ?>
                                <span class="label label-info"><i class="fa fa-alipay">&nbsp;pos刷卡</i></span>
                                <?php  } ?>
                                <?php  if($item['paytype'] == 11) { ?>
                                <span class="label label-info"><i class="fa fa-alipay">&nbsp;挂帐</i></span>
                                <?php  } ?>
                                <br/>
                                <?php  } ?>
                                <?php  if($item['ispay'] == 0) { ?><span class="label label-warning">未支付</span><?php  } ?>
                                <?php  if($item['ispay'] == 1) { ?><span class="label label-success"><i class="fa fa-cloud">已支付</i></span><?php  } ?>
                                <?php  if($item['ispay'] == 2) { ?><span class="label label-info">待退款</span><?php  } ?>
                                <?php  if($item['ispay'] == 3) { ?><span class="label label-danger">已退款</span><?php  } ?>
                                <?php  if($item['ispay'] == 4) { ?><span class="label label-danger">退款失败</span><?php  } ?>
                            </td>
                            <td>
                                <?php  echo date("Y-m-d", $item['dateline'])?><br/>
                                <?php  echo date("H:i:s", $item['dateline'])?>
                            </td>
                            <td style="text-align:left;">
                                <a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('allorder', array('op' => 'detail', 'id' => $item['id'], 'storeid' => $storeid))?>" title="详情">详情</a>
                                <?php  if($item['dining_mode']==2) { ?>
                                <a class="btn btn-warning btn-sm btn_table_show" href="javascript:void(0);" title="配送" data-value="<?php  echo $item['id'];?>">配送</a><?php  } ?>

                                <?php  if($item['status'] != 3 && $item['ispay'] != 3) { ?>
                                <?php  if($item['ispay'] == 1 || $item['ispay'] == 2 || $item['ispay'] == 4) { ?>
                                <a class="btn btn-danger btn-sm" href="<?php  echo $this->createWebUrl('allorder', array('op' => 'refund', 'id' => $item['id'], 'storeid' => $storeid))?>" title="退款" onclick="return confirm('此操作不可恢复，确认退款？');return false;">退款</a>
                                <?php  } ?>
                                <?php  } ?>
                            </td>
                        </tr>
                        <?php  } } ?>
                        </tbody>
                    </table>
                    <?php  echo $pager;?>
                </div>
                <div style="height: 50px;"></div>
            </form>
        </div>
        <div class="shop-preview col-xs-12 col-sm-9 col-lg-10">
            <div class="text-left alert alert-info">
                <div style="margin-top: 0px;">
                    <input type="button" class="btn btn-success" name="btn_printall" value="前台打印" />
                    <input type="button" class="btn btn-warning" name="btn_finishall" value="结账并清台" />
                </div>
            </div>
        </div>
        <style>
            .shop-preview {
                position: fixed;
                padding: 0 15px;
                bottom: 0;
                right: 0;
                z-index: 10000;
                width: 83.33333333%;
            }

            .shop-preview div {
                /*background: rgba(255, 254, 220, 0.8);*/
                filter:alpha(opacity=20);
                /*opacity: 0.8;*/
            }
        </style>
    </div>
</div>
<div class="main">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="header">
                <h3>桌台 详情 <a class="btn btn-primary btn-sm" href="<?php  echo $this->createWebUrl('tables', array('op' => 'post', 'storeid' => $storeid, 'id' => $tablesid))?>">编辑</a>
                    <a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('tables', array('op' => 'display', 'storeid' => $storeid))?>">返回</a></h3>
            </div>
            <div class="model-show">
                <p>
                    <b>
                        名字(桌台号)
                        :
                    </b>
                    <?php  echo $item['title'];?><?php  if(!empty($label)) { ?>&nbsp;&nbsp;(<span style="color:green">标签：<?php  echo $label['title'];?></span>)<?php  } ?>
                </p>
                <p>
                    <b>
                        桌台类型
                        :
                    </b>
                    <?php  echo $cate['title'];?>
                </p>
                <p>
                    <b>
                        可供就餐人数
                        :
                    </b>
                    <?php  echo $item['user_count'];?>
                </p>
                <p>
                    <b>
                        当前状态
                        :
                    </b>
                    <?php  if($item['status']==0) { ?>空闲<?php  } else if($item['status']==1) { ?>已开台<?php  } else if($item['status']==2) { ?>已下单<?php  } else if($item['status']==3) { ?>已支付<?php  } ?>
                </p>
                <p>
                    <b>
                        扫描人数
                        :
                    </b>
                    <?php  if(empty($tablesorderuser)) { ?>0<?php  } else { ?><?php  echo $tablesorderuser;?><?php  } ?>
                </p>
                <p>
                    <b>
                        所属门店
                        :
                    </b>
                    <?php  echo $store['title'];?>
                </p>
                <p>
                    <b>
                        扫描次数
                        :
                    </b>
                    <?php  if(empty($tablesorder)) { ?>0<?php  } else { ?><?php  echo $tablesorder;?><?php  } ?>
                </p>
                <p>
                    <b>
                        排序
                        :
                    </b>
                    <?php  echo $item['displayorder'];?>
                </p>
                <p>
                    <b>
                        二维码图片
                        :
                    </b>
                    <img alt="" src="<?php echo$this->fm_qrcode($_W['siteroot'] . 'app/index.php?i=' . $_W['uniacid'] . '&c=entry&mode=1&storeid=' . $storeid . '&tablesid=' . $item['id'] . '&do=mindex&m=weisrc_dish', 'qrcode_' . $item['id'], '', $logo);?>">
                </p>
                <div class="space"></div>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">
    $(function () {
        $(".check_all").click(function () {
            var checked = $(this).get(0).checked;
            $("input[type=checkbox]").attr("checked", checked);
        });

        $("input[name=btn_printall]").click(function () {
            var check = $("input[type=checkbox][class!=check_all]:checked");
            if (check.length < 1) {
                alert('请选择要打印的订单!');
                return false;
            }
//            if (confirm("确认要打印选择的订单?")) {
                var id = new Array();
                check.each(function (i) {
                    id[i] = $(this).val();
                });
                var url = "<?php  echo $this->createWebUrl('tables', array('op' => 'printall', 'storeid' => $storeid, 'position_type' => 1))?>";
                $.post(
                        url,
                        {idArr: id},
                        function (data) {
                            alert(data.error);
                            location.reload();
                        }, 'json'
                );
//            }
        });

        $("input[name=btn_finishall]").click(function () {
            var check = $("input[type=checkbox][class!=check_all]:checked");
            if (check.length < 1) {
                alert('请选择要结账的订单!');
                return false;
            }
            if (confirm("确定要结账选择的订单?")) {
                var paytype = $("#paytype").val();
                var id = new Array();
                check.each(function (i) {
                    id[i] = $(this).val();
                });
                var url = "<?php  echo $this->createWebUrl('tables', array('op' => 'finishall', 'storeid' => $storeid))?>";
                $.post(
                        url,
                        {
                            idArr: id,
                            paytype:paytype
                        },
                        function (data) {
                            alert(data.error);
//                            location.reload();
                            window.location.href = window.location.href + '&paytype=' + paytype;
                        }, 'json'
                );
            }
        });
    });
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>