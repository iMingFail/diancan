<?php defined('IN_IA') or exit('Access Denied');?><!-- <div class="tab-pane" id="tab_en">
   11111
</div> -->
<div style="margin-bottom: 30px;">

</div>
<?php 
                  $arr = unserialize(file_get_contents('store_en.txt'));
                    $id = $_GET['id'];
                if(is_array($arr[$id])){
                    $en_address =$arr[$id]['en_address'];
                    $en_title =$arr[$id]['en_title'];
                }

                $jparr = unserialize(file_get_contents('store_jp.txt'));
                    $id = $_GET['id'];
                if(is_array($jparr[$id])){
                    $jp_address =$jparr[$id]['jp_address'];
                    $jp_title =$jparr[$id]['jp_title'];

                }
                $hwarr = unserialize(file_get_contents('store_hw.txt'));
                    $id = $_GET['id'];
                if(is_array($hwarr[$id])){
                    $hw_address =$hwarr[$id]['hw_address'];
                    $hw_title =$hwarr[$id]['hw_title'];

                }
                $ftarr = unserialize(file_get_contents('store_ft.txt'));
                    $id = $_GET['id'];
                if(is_array($ftarr[$id])){
                    $ft_address =$ftarr[$id]['ft_address'];
                    $ft_title =$ftarr[$id]['ft_title'];

                }

                $pyarr = unserialize(file_get_contents('store_py.txt'));
                    $id = $_GET['id'];
                if(is_array($pyarr[$id])){
                    $py_address =$pyarr[$id]['py_address'];
                    $py_title =$pyarr[$id]['py_title'];

                }
            ?>
     <div class="tab-pane" id="en">
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商家名称</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="en_title" value="<?php   echo  $en_title;?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商家地址</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="en_address" value="<?php   echo  $en_address;?>" />
                    </div>
                </div>


            </div>
              <div class="tab-pane" id="jp">
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商家名称</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="jp_title" value="<?php   echo  $jp_title;?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商家地址</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="jp_address" value="<?php   echo  $jp_address;?>" />
                         <input type="hidden" class="form-control" name="jp_laug" value="jp" />
                    </div>
                </div>
            </div>
             <div class="tab-pane" id="hw">
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商家名称</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="hw_title" value="<?php   echo  $hw_title;?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商家地址</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="hw_address" value="<?php   echo  $hw_address;?>" />
                         <input type="hidden" class="form-control" name="hw_laug" value="hw" />
                    </div>
                </div>
            </div>
             <div class="tab-pane" id="ft">
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商家名称</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="ft_title" value="<?php   echo  $ft_title;?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商家地址</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="ft_address" value="<?php   echo  $ft_address;?>" />
                         <input type="hidden" class="form-control" name="ft_laug" value="ft" />
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="py">
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商家名称</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="py_title" value="<?php   echo  $py_title;?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商家地址</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="py_address" value="<?php   echo  $py_address;?>" />
                         <input type="hidden" class="form-control" name="py_laug" value="py" />
                    </div>
                </div>
            </div>