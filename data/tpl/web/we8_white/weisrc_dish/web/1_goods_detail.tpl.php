<?php defined('IN_IA') or exit('Access Denied');?><div class="main">
    <div class="panel panel-default">
        <div class="panel-body">
            <a class="btn btn-warning" href="<?php  echo $this->createWebUrl('goods', array('op' => 'display', 'storeid' => $storeid))?>">返回商品管理
            </a>
        </div>
    </div>
<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">

        <input type="hidden" name="storeid" value="<?php  echo $storeid;?>" />
        <input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="nav nav-pills">

                    <li role="presentation" class="active"><a href="#tab_basic" aria-controls="tab_basic" role="tab" data-toggle="pill">简体中文</a></li>
                   <!--  <li role="presentation" class=""><a href="#tab_content" aria-controls="tab_content" role="tab"
                                                        data-toggle="pill">商品详情1</a></li> -->
                    <!-- <li role="presentation" class=""><a href="#tab_commission" aria-controls="tab_commission" role="tab" data-toggle="pill">佣金设置</a></li> -->
                    <li role="presentation" class=""><a href="#en" aria-controls="tab_content" role="tab"       data-toggle="pill">英文</a></li>
                    <li role="presentation" class=""><a href="#jp" aria-controls="tab_commission" role="tab" data-toggle="pill">日文</a></li>
                     <li role="presentation" class=""><a href="#hw" aria-controls="tab_commission" role="tab" data-toggle="pill">韩文</a></li>
                      <li role="presentation" class=""><a href="#ft" aria-controls="tab_commission" role="tab" data-toggle="pill">繁体中文</a></li>
                       <li role="presentation" class=""><a href="#py" aria-controls="tab_commission" role="tab" data-toggle="pill">py</a></li>
                    <!-- <li role="presentation" class=""><a href="#tab_options" aria-controls="tab_options" role="tab" data-toggle="pill">规格设置</a></li> -->


                </ul>
            </div>
        </div>
        <div class="tab-content">
            <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/goods_tab_basic', TEMPLATE_INCLUDEPATH)) : (include template('web/goods_tab_basic', TEMPLATE_INCLUDEPATH));?>
            <?php 
                  $arr = unserialize(file_get_contents('en.txt'));
                    $id = $_GET['id'];
                if(is_array($arr[$id])){
                    $en_description =$arr[$id]['en_description'];
                    $en_title =$arr[$id]['en_title'];
                }

                $jparr = unserialize(file_get_contents('jp.txt'));
                    $id = $_GET['id'];
                if(is_array($jparr[$id])){
                    $jp_description =$jparr[$id]['jp_description'];
                    $jp_title =$jparr[$id]['jp_title'];

                }
                $hwarr = unserialize(file_get_contents('hw.txt'));
                    $id = $_GET['id'];
                if(is_array($hwarr[$id])){
                    $hw_description =$hwarr[$id]['hw_description'];
                    $hw_title =$hwarr[$id]['hw_title'];

                }
                $ftarr = unserialize(file_get_contents('ft.txt'));
                    $id = $_GET['id'];
                if(is_array($ftarr[$id])){
                    $ft_description =$ftarr[$id]['ft_description'];
                    $ft_title =$ftarr[$id]['ft_title'];

                }

                $pyarr = unserialize(file_get_contents('py.txt'));
                    $id = $_GET['id'];
                if(is_array($pyarr[$id])){
                    $py_description =$pyarr[$id]['py_description'];
                    $py_title =$pyarr[$id]['py_title'];

                }
            ?>
            <div class="tab-pane" id="en">
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品名称</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="en_title" value="<?php   echo  $en_title;?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品描述</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="en_description" value="<?php   echo  $en_description;?>" />
                         <input type="hidden" class="form-control" name="en_laug" value="en" />
                    </div>
                </div>
            </div>
              <div class="tab-pane" id="jp">
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品名称</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="jp_title" value="<?php   echo  $jp_title;?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品描述</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="jp_description" value="<?php   echo  $jp_description;?>" />
                         <input type="hidden" class="form-control" name="jp_laug" value="jp" />
                    </div>
                </div>
            </div>
             <div class="tab-pane" id="hw">
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品名称</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="hw_title" value="<?php   echo  $hw_title;?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品描述</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="hw_description" value="<?php   echo  $hw_description;?>" />
                         <input type="hidden" class="form-control" name="hw_laug" value="hw" />
                    </div>
                </div>
            </div>
             <div class="tab-pane" id="ft">
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品名称</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="ft_title" value="<?php   echo  $ft_title;?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品描述</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="ft_description" value="<?php   echo  $ft_description;?>" />
                         <input type="hidden" class="form-control" name="ft_laug" value="ft" />
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="py">
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品名称</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="py_title" value="<?php   echo  $py_title;?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品描述</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="py_description" value="<?php   echo  $py_description;?>" />
                         <input type="hidden" class="form-control" name="py_laug" value="py" />
                    </div>
                </div>
            </div>
            <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/goods_tab_commission', TEMPLATE_INCLUDEPATH)) : (include template('web/goods_tab_commission', TEMPLATE_INCLUDEPATH));?>
        </div>
        <div class="form-group col-sm-12">
            <input type="submit" name="submit" value="保存设置" class="btn btn-primary col-lg-3" />
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
        </div>
    </form>
</div>
<script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script type="text/javascript">
    require(['util', 'clockpicker'], function(u, $){
        u.editor($('.richtext')[1]);
    });
</script>
<script type="text/javascript">
    <!--
    var category = <?php  echo json_encode($children)?>;
    //-->
</script>