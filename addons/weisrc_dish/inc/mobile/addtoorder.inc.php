<?php
global $_W, $_GPC;
$weid = $this->_weid;
if($_SESSION['from_user']){
    $from_user=$_SESSION['from_user'];
}else{
    die;
}
$couponid = intval($_GPC['couponid']);
$storeid = intval($_GPC['storeid']);
$rtype = intval($_GPC['rtype']);

$mode = intval($_GPC['ordertype']) == 0 ? 1 : intval($_GPC['ordertype']);
$lat = trim($_GPC['lat']);
$lng = trim($_GPC['lng']);

$is_handle_goods = 1; //是否处理商品
// if ($mode == 5 || $mode == 6) {
//     $is_handle_goods = 0;
// }
if ($mode == 6) {
    $is_handle_goods = 0;
}

if (empty($from_user)) {
    $this->showTip('お手数を掛けますが、もう一回QRコードをスキャンしてください。');
    // $this->showTip('请重新发送关键字进入系统!');
}
$isvip = $this->get_sys_card($from_user);

if ($mode != 6) {
    if (empty($storeid)) {
        $this->showTip('店舗を選んでください。');
        // $this->showTip('请先选择门店!');
    }
    $store = $this->getStoreById($storeid);
}

//外卖
if ($mode == 2) {
    //距离
    $delivery_radius = floatval($store['delivery_radius']);
    $distance = $this->getDistance($lat, $lng, $store['lat'], $store['lng']);
    $distance = floatval($distance);
    if ($store['not_in_delivery_radius'] == 0) { //只能在距离范围内
        // if ($distance > $delivery_radius) {
        //     $this->showTip('超出配送范围，不允许下单!');
        // }
    }
}

if ($mode != 6) {
    //购物车为空
    $cart = pdo_fetchall("SELECT * FROM " . tablename($this->table_cart) . " WHERE weid = :weid AND from_user = :from_user AND storeid=:storeid", array(':weid' => $weid, ':from_user' => $from_user, ':storeid' => $storeid), 'goodsid');
}
// var_dump($cart);die;

if ($is_handle_goods == 1) {
    if ($rtype != 1) {
        if (empty($cart)) {
            $this->showTip('商品を追加してください。');
            // $this->showTip('请先添加商品!');
        } else {
            $goods = pdo_fetchall("SELECT id, title, thumb, marketprice, unitname FROM " . tablename($this->table_goods) . " WHERE id IN ('" . implode("','", array_keys($cart)) . "')");
        }
    }
}

$guest_name = trim($_GPC['guest_name']); //用户名
$tel = trim($_GPC['tel']); //电话
$sex = trim($_GPC['sex']); //性别
$meal_time = trim($_GPC['meal_time']); //订餐时间
$counts = intval($_GPC['counts']); //预订人数
$seat_type = intval($_GPC['seat_type']); //就餐形式
$carports = intval($_GPC['carports']); //预订车位
$remark = trim($_GPC['remark']); //备注
$address = trim($_GPC['address']); //地址
$dispatcharea = trim($_GPC['dispatcharea']); //地址
$tables = intval($_GPC['tables']); //桌号
$tablezonesid = intval($_GPC['tablezonesid']); //桌台
$smoking = intval($_GPC['smoking']); //桌台
$username = trim($_GPC['username']); //桌台

$append = intval($_GPC['append']); //是否加单

if ($mode != 1 && $mode != 5&& $is_handle_goods == 1) {//非堂点非收银
    if (empty($_GPC['username'])) {
        $this->showTip('お名前を入力してください。');
        // $this->showTip('请输入姓名!');
    }
    if (empty($tel)) {
        $this->showTip('お電話番号を入力してください。');
    }
}

//堂点
if ($mode == 1) {
    if ($append == 0 && $counts <= 0) {
        // $this->showTip('请输入用餐人数!');
    }
    if ($tables == 0) {
        // $this->showTip('请先扫描桌台!');
        $this->showTip('QRコードをスキャンしてください。');
    }

    if ($store['is_locktables'] == 1) {
        $haveorder = pdo_fetch("SELECT * FROM " . tablename($this->table_order) . " WHERE weid=:weid AND storeid=:storeid AND tables=:tables AND
status<>-1 AND status<>3 LIMIT 1", array(":weid" => $weid, ":storeid" => $storeid, ":tables" => $tables));
        if ($haveorder) {
            if ($haveorder['from_user'] != $from_user) {
                // $this->showTip('餐台已经有人在使用中！');
            }
        }
    }
} else if ($mode == 2) {//外卖
    if (empty($address)) {
        // $this->showTip('请输入联系地址!');
        $this->showTip('連絡先を入力してください。');
    }
} else if ($mode == 3) {
    if ($tables == 0) {
        $this->showTip('席を選んでください。');
        // $this->showTip('请先选择桌台!');
    }
}

$user = $this->getFansByOpenid($from_user);
$fansdata = array('weid' => $weid,
    'from_user' => $from_user,
    'username' => $username,
    // 'username' => $guest_name,
    'address' => $address,
    'mobile' => $tel
);
if (empty($guest_name)) {
    unset($fansdata['username']);
}
if (empty($tel)) {
    unset($fansdata['mobile']);
}
if (empty($address)) {
    unset($fansdata['address']);
}
if ($mode == 2) { //外卖
    $fansdata['lat'] = $lat;
    $fansdata['lng'] = $lng;
}
if (empty($user)) {
    pdo_insert($this->table_fans, $fansdata);
} else {
    pdo_update($this->table_fans, $fansdata, array('id' => $user['id']));
}

//2.购物车 //a.添加订单、订单产品
$totalnum = 0;
$totalprice = 0;
$goodsprice = 0;
$dispatchprice = 0;
$freeprice = 0;
$packvalue = 0;
$teavalue = 0;
$service_money = 0;

foreach ($cart as $value) {
    $total = intval($value['total']);
    $totalnum = $totalnum + intval($value['total']);
    $goodsprice = $goodsprice + ($total * floatval($value['price']));
    if ($mode == 2) { //打包费
        $packvalue = $packvalue + ($total * floatval($value['packvalue']));
    }
}

if ($mode == 2) { //外卖
    $dispatchprice = $store['dispatchprice'];
    $freeprice = floatval($store['freeprice']);
    if ($freeprice > 0.00) {
        if ($goodsprice >= $freeprice) {
            $dispatchprice = 0;
        }
    }
}

if ($mode == 1) { //店内
    if ($store['is_tea_money'] == 1) {
        $teavalue = $counts * floatval($store['tea_money']);
    }
}

$totalprice = $goodsprice + $dispatchprice + $packvalue + $teavalue;

if ($mode == 1) { //店内
    $table = pdo_fetch("SELECT * FROM " . tablename($this->table_tables) . " where weid = :weid AND id=:id LIMIT 1", array(':weid' => $weid, ':id' => $tables));
    $tablezonesid = $table['tablezonesid'];
    $tablezones = pdo_fetch("SELECT * FROM " . tablename($this->table_tablezones) . " WHERE id = :id", array(':id' => $tablezonesid));
    $service_rate = floatval($tablezones['service_rate']);
    if ($service_rate > 0) {
        $service_money = $totalprice * $service_rate / 100;
    }
    $totalprice = $totalprice + $service_money;
}

if ($mode == 3) { //预定
    if ($rtype == 1) {
        $tablezones = pdo_fetch("SELECT * FROM " . tablename($this->table_tablezones) . " WHERE id = :id", array(':id' => $tablezonesid));
        if (floatval($tablezones['reservation_price']) <= 0) {
            $totalprice = 0.01;
        } else {
            $totalprice = floatval($tablezones['reservation_price']);
        }
    }
}

if ($mode == 2) { //外卖
    $sendingprice = floatval($store['sendingprice']);
    if ($sendingprice > 0.00) {
        if ($goodsprice < $store['sendingprice']) {
            // $this->showTip('您的购买金额达不到起送价格!');
            $this->showTip('ご注文は1,500円（消費税含む）以上から承っております。');
        }
    }

    if($_GPC['code']!=0){
        $dispatcharea = pdo_fetchall("SELECT * FROM ims_weisrc_dish_areas"  . " WHERE weid = '$weid'  AND storeid ={$storeid} AND code = {$_GPC['code']}");

        if(!$dispatcharea){
            $this->showTip('エラーが起こりました。');
            // $this->showTip('非法参数');
        }
        $code = $_GPC['code'];
        $areas = $dispatcharea[0]['title'];
    }
}

$coupon = pdo_fetch("SELECT a.*,b.sncode FROM " . tablename($this->table_coupon) . "
        a INNER JOIN " . tablename($this->table_sncode) . " b ON a.id= b.couponid
 WHERE a.weid = :weid AND b.from_user=:from_user AND b.status=0 AND :time<a.endtime AND b.id=:couponid ORDER BY b.id
 DESC LIMIT 1", array(':weid' => $weid, ':from_user' => $from_user, ':time' => TIMESTAMP, ':couponid' => $couponid));

$discount_money = 0;
if ($couponid <> 0 && empty($coupon)) {
    $this->showTip('优惠券不存在!');
} else {
    if ($coupon['type'] == 2) {
        $discount_money = floatval($coupon['dmoney']);
        $totalprice = $totalprice - $coupon['dmoney'];
    }
}
if (!$this->getmodules()) {
    $totalprice = $totalprice;
    $goodsprice = $goodsprice;
}

// if ($mode == 5 || $mode == 6) { //收银
//     $totalprice = floatval($_GPC['total']);
// }
if ($mode == 6) { //收银
    $totalprice = floatval($_GPC['total']);
}
if ($mode == 6) {
    //充值赠送
    $recharge = pdo_fetch("SELECT * FROM " . tablename($this->table_recharge) . " WHERE weid = :weid AND :nowtime<endtime AND :nowtime>starttime AND :recharge_value>=recharge_value ORDER BY `recharge_value` DESC,`id` DESC LIMIT 1", array(':weid' => $weid, ':nowtime' => TIMESTAMP, ':recharge_value' => $totalprice));
    $rechargeid = intval($recharge['id']);
}

//加菜
if ($append == 2) {
    $orderid = intval($_GPC['order_id']);
    $dishInfo = pdo_fetchall("SELECT goodsid,price,total FROM " . tablename($this->table_order_goods) . " WHERE weid=:weid AND storeid=:storeid AND orderid=:orderid", array(":weid" => $weid, ":storeid" => $storeid, ":orderid" => $orderid));
    foreach ($dishInfo as $v) {
        $dishid[] = $v['goodsid'];
    }
    foreach ($cart as $k => $v) {
        if (in_array($v['goodsid'], $dishid)) {
            $dishCon = array(":weid" => $weid, ":storeid" => $storeid, ":orderid" => $orderid, ":goodsid" => $v['goodsid']);
            $sql = "UPDATE " . tablename($this->table_order_goods) . " SET total=total+{$v['total']},dateline=" . time() . " WHERE weid=:weid AND storeid=:storeid AND orderid=:orderid AND goodsid=:goodsid";
            pdo_query($sql, $dishCon);
        } else {
            $parm = array("weid" => $weid, "storeid" => $storeid, "orderid" => $orderid, "goodsid" => $v['goodsid'], "price" => $v['price'], "total" => $v['total'], 'dateline' => time());
            pdo_insert($this->table_order_goods, $parm);
        }
        $goodsName = pdo_fetch("SELECT title FROM " . tablename($this->table_goods) . " WHERE id=:id", array(":id" => $v['goodsid']));
        $appendMes .= $goodsName['title'] . "*" . $v['total'] . ",";
        pdo_query("UPDATE " . tablename($this->table_goods) . " SET today_counts=today_counts+:counts,sales=sales+:counts,lasttime=:time WHERE id=:id", array(':id' => $v['goodsid'], ':counts' => $v['total'], ':time' => TIMESTAMP));
    }
    $orderParm = array(':totalnum' => $totalnum, ':totalprice' => $totalprice, ':goodsprice' => $goodsprice, ':service_money' => $service_money, ':tea_money' => $teavalue, ':id' => $orderid);
    pdo_query("UPDATE " . tablename($this->table_order) . " SET totalnum=totalnum+:totalnum ,totalprice=totalprice+:totalprice,goodsprice=goodsprice+:goodsprice,service_money=service_money+:service_money,tea_money=tea_money+:tea_money,append_dish=1 where id=:id ", $orderParm);
    if ($couponid > 0) {
        pdo_update($this->table_sncode, array('status' => 1), array('id' => $couponid));
    }
    $this->msg_status_success = 2;
} else {
    $data = array(
        'weid' => $weid,
        'from_user' => $from_user,
        'storeid' => $storeid,
        'couponid' => $couponid,
        'discount_money' => $discount_money,
        'ordersn' => date('Ymd') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99)),
        'totalnum' => $totalnum, //产品数量
        'totalprice' => $totalprice, //总价
        'goodsprice' => $goodsprice,
        'tea_money' => $teavalue,
        'service_money' => $service_money,
        'dispatchprice' => $dispatchprice,
        'packvalue' => $packvalue,
        'paytype' => 0, //付款类型
        'username' => $username,
        'tel' => $tel,
        'smoking' => $smoking,
        'meal_time' => $meal_time,
        'counts' => $counts,
        'seat_type' => $seat_type,
        'tables' => $tables,
        'tablezonesid' => $tablezonesid,
        'carports' => $carports,
        'dining_mode' => $mode, //订单类型
        'remark' => $remark, //备注
        'address' => $dispatcharea[0]['title'] . $address, //地址
        'status' => 0, //状态
        'rechargeid' => $rechargeid,
        'lat' => $lat,
        'lng' => $lng,
        'isvip' => $isvip,
        'is_append' => $append,
        'dateline' => TIMESTAMP,
        'code' => $code,
        'areas' => $areas
    );

    if ($mode == 1) { //店内
        unset($data['username']);
        unset($data['tel']);
        unset($data['address']);
    }

    if ($mode == 4) { //快餐
        $quicknum = $this->getQuickNum($storeid);
        $data['quicknum'] = $quicknum;
    }


    if ($mode == 5) { //排队
       if($_SESSION['queue_orderid']){
             $item = pdo_fetch("SELECT * FROM " . tablename($this->table_queue_order) . " WHERE id = :id", array(':id' => $_SESSION['queue_orderid']));
             $data['counts']=$item['usercount'];
             $data['remark']=$item['remark'];
             $data['smoking']=$item['smoke'];
             $data['tel']="排队号".$item['num'];
               // $this->showTip( $item['id']);
       }else{
        // $this->showTip( '出错了！请重新扫码排队');
        $this->showTip( 'お手数を掛けますが、もう一回QRコードをスキャンしてください。');
       }
    }else{
        if($_SESSION['queue_orderid']&& $mode !=5){
             // $this->showTip( '出错了！请重新扫码排队');
        $this->showTip( 'お手数を掛けますが、もう一回QRコードをスキャンしてください。');

         }
    }

    //保存订单
    pdo_insert($this->table_order, $data);
    $orderid = pdo_insertid();
    if ($orderid > 0) {

        if ($couponid > 0) {
            pdo_update($this->table_sncode, array('status' => 1), array('id' => $couponid));
        }
    }
    //保存新订单商品
    if ($is_handle_goods == 1) {
        foreach ($cart as $row) {
            if (empty($row) || empty($row['total']) || $rtype == 1) {
                continue;
            }


            pdo_query("UPDATE " . tablename($this->table_goods) . " SET today_counts=today_counts+:counts,sales=sales+:counts,lasttime=:time WHERE id=:id", array(':id' => $row['goodsid'], ':counts' => $row['total'], ':time' => TIMESTAMP));
            pdo_insert($this->table_order_goods, array(
                'weid' => $_W['uniacid'],
                'storeid' => $row['storeid'],
                'goodsid' => $row['goodsid'],
                'orderid' => $orderid,
                'price' => $row['price'],
                'total' => $row['total'],
                'dateline' => TIMESTAMP,
            ));
        }
    }
    // file_put_contents('fpc1.txt',$orderid);
       $this->feieSendFreeMessage($orderid, 1);

}

if ($is_handle_goods == 1) {
    if ($rtype != 1) {
        pdo_delete($this->table_cart, array('weid' => $weid, 'from_user' => $from_user, 'storeid' => $storeid));
    }
}

$touser = empty($user['nickname']) ? $user['from_user'] : $user['nickname'];
if ($this->msg_status_success == 2) {
    $touser .= '&nbsp;加菜：' . $appendMes;
}

$this->addOrderLog($orderid, $touser, 1, 1, 1);

//if ($mode == 5) {
//    $params['tid'] = $orderid;
//    $params['user'] = $_W['fans']['from_user'];
//    $params['fee'] = $data['totalprice'];
//    $params['ordersn'] = $data['ordersn'];
//    $params['virtual'] = true;
//    $params['module'] = 'weisrc_dish';
//    $params['title'] = '餐饮' . $data['ordersn'];
//    $log = pdo_get('core_paylog', array('uniacid' => $_W['uniacid'], 'module' => $params['module'], 'tid' => $params['tid']));
//    if (empty($log)) {
//        $log = array(
//            'uniacid' => $_W['uniacid'],
//            'acid' => $_W['acid'],
//            'openid' => $_W['member']['uid'],
//            'module' => $this->module['name'], //模块名称，请保证$this可用
//            'tid' => $params['tid'],
//            'fee' => $params['fee'],
//            'card_fee' => $params['fee'],
//            'status' => '0',
//            'is_usecard' => '0',
//        );
//        pdo_insert('core_paylog', $log);
//    }
//
//    $result['orderid'] = $orderid;
//    $result['code'] = $this->msg_status_success;
//    $result['params'] = base64_encode(json_encode($params));
//    $result['msg'] = '操作成功';
//    message($result, '', 'ajax');
//
//} else {
    $result['orderid'] = $orderid;
    $result['code'] = $this->msg_status_success;
    $result['msg'] = '操作成功';
    // unset( $_SESSION['userinfo']);
    message($result, '', 'ajax');
//}



