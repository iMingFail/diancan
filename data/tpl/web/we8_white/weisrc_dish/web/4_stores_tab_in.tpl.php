<?php defined('IN_IA') or exit('Access Denied');?><div class="tab-pane" id="tab_in">
<!--     <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">默认用餐人数</label>
        <div class="col-sm-9">
            <select class="form-control" name="default_user_count" >
                <?php  for($i = 1;$i<21;$i++){?>
                <option value="<?php  echo $i;?>" <?php  if($reply['default_user_count']==$i) { ?>selected<?php  } ?>><?php  echo $i;?></option>
                <?php  }?>
            </select>
            <div class="help-block">
                店内点餐时默认的用餐人数
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">锁定桌台</label>
        <div class="col-sm-9">
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_locktables1" value="1" name="is_locktables" <?php  if($reply['is_locktables']==1|| empty($reply)) { ?>checked<?php  } ?>>
                <label for="is_locktables1"> 开启 </label>
            </div>
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_locktables2" value="0" name="is_locktables" <?php  if(isset($reply['is_locktables']) && empty($reply['is_locktables'])) { ?>checked<?php  } ?>>
                <label for="is_locktables2"> 关闭 </label>
            </div>
            <div class="help-block">
                当有用户下单后将会自动锁定桌台，在订单完成前不允许其他用户下单；
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">在线支付需要确认</label>
        <div class="col-sm-9">
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_meal_pay_confirm1" value="1" name="is_meal_pay_confirm"  <?php  if($reply['is_meal_pay_confirm']==1 || empty($reply)) { ?>checked<?php  } ?>>
                <label for="is_meal_pay_confirm1"> 开启 </label>
            </div>
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_meal_pay_confirm2" value="0" name="is_meal_pay_confirm" <?php  if(isset($reply['is_meal_pay_confirm']) && empty($reply['is_meal_pay_confirm'])) { ?>checked<?php  } ?>>
                <label for="is_meal_pay_confirm2"> 关闭 </label>
            </div>
            <div class="help-block">
                用户在线支付是否需要服务员确认订单后才能操作
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否开启茶位费</label>
        <div class="col-sm-9">
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_tea_money1" value="1" name="is_tea_money" <?php  if($reply['is_tea_money']==1) { ?>checked<?php  } ?>>
                <label for="is_tea_money1"> 开启 </label>
            </div>
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_tea_money2" value="0" name="is_tea_money" <?php  if(isset($reply['is_tea_money']) && empty($reply['is_tea_money'])) { ?>checked<?php  } ?>>
                <label for="is_tea_money2"> 关闭 </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">茶位费</label>
        <div class="col-sm-9">
            <input type="text" name="tea_money" class="form-control" value="<?php  echo $reply['tea_money'];?>" />
            <div class="help-block">
                茶位费按人数数量计算
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">茶位费自定义文字</label>
        <div class="col-sm-9">
            <input type="text" name="tea_tip" class="form-control" value="<?php  echo $reply['tea_tip'];?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">服务费</label>
        <div class="col-sm-9 form-control-static">
            <a href="<?php  echo $this->createWebUrl('tablezones', array('storeid' => $storeid, 'op' => 'display'))?>">设置服务费</a>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">最低消费</label>
        <div class="col-sm-9 form-control-static">
            <a href="<?php  echo $this->createWebUrl('tablezones', array('storeid' => $storeid, 'op' => 'display'))?>">设置最低消费</a>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">加菜功能</label>
        <div class="col-sm-9">
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_add_dish1" value="1" name="is_add_dish" <?php  if($reply['is_add_dish']==1 ||empty($reply)) { ?>checked<?php  } ?>>
                <label for="is_add_dish1"> 开启 </label>
            </div>
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_add_dish2" value="0" name="is_add_dish" <?php  if(isset($reply['is_add_dish']) && empty($reply['is_add_dish'])) { ?>checked<?php  } ?>>
                <label for="is_add_dish2"> 关闭 </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">加单功能</label>
        <div class="col-sm-9">
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_add_order1" value="1" name="is_add_order" <?php  if($reply['is_add_order']==1||empty($reply)) { ?>checked<?php  } ?>>
                <label for="is_add_order1"> 开启 </label>
            </div>
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_add_order2" value="0" name="is_add_order" <?php  if(isset($reply['is_add_order']) && empty($reply['is_add_order'])) { ?>checked<?php  } ?>>
                <label for="is_add_order2"> 关闭 </label>
            </div>
        </div>
    </div> -->
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">呼叫服务员通知</label>
        <div class="col-sm-9">
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_operator11" value="1" name="is_operator1" <?php  if($reply['is_operator1']==1 || empty($reply)) { ?>checked<?php  } ?>>
                <label for="is_operator11"> 开启 </label>
            </div>
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_operator12" value="0" name="is_operator1" <?php  if(isset($reply['is_operator1']) && empty($reply['is_operator1'])) { ?>checked<?php  } ?>>
                <label for="is_operator12"> 关闭 </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">打包通知</label>
        <div class="col-sm-9">
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_operator21" value="1" name="is_operator2" <?php  if($reply['is_operator2']==1 || empty($reply)) { ?>checked<?php  } ?>>
                <label for="is_operator21"> 开启 </label>
            </div>
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_operator22" value="0" name="is_operator2" <?php  if(isset($reply['is_operator2']) && empty($reply['is_operator2'])) { ?>checked<?php  } ?>>
                <label for="is_operator22"> 关闭 </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">通知时间间隔</label>
        <div class="col-sm-9">
            <input type="text" name="notice_space_time" class="form-control"
                   value="<?php  echo $reply['notice_space_time'];?>" style="width: 120px;"/>
            <div class="help-block">单位：秒</div>
        </div>
    </div>
</div>