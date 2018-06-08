<?php
/**
 * @Author: Marte
 * @Date:   2018-05-08 14:06:46
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-06-04 16:00:37
 */

global $_W, $_GPC;
$weid = $this->_weid;
if($_SESSION['from_user']){
    $from_user=$_SESSION['from_user'];
}else{
    message('お手数を掛けますが、もう一回QRコードをスキャンしてください。');

}
$tablesid = intval($_GPC['tablesid']);
$classid = intval($_GPC['classid']);
$title = '全部商品';
$mode = intval($_GPC['mode']);
$append = intval($_GPC['append']);
$setting = $this->getSetting();

$storeid = intval($_GPC['storeid']);
if ($storeid == 0) {
    $storeid = $this->getStoreID();
}
if (empty($storeid)) {
    // message('请先选择门店', $this->createMobileUrl('waprestlist'));
    message('店舗を選んでください。', $this->createMobileUrl(''));
}
if (empty($classid)) {
    // message('请先选择分类');
    message('分類が違います。');
}
if ($mode == 0) {
    // message('请先选择下单模式', $this->createMobileUrl('detail', array('id' => $storeid)));
    message('注文方式を選んでください。', $this->createMobileUrl('detail', array('id' => $storeid)));
}

$agentid = intval($_GPC['agentid']);
$agentid2 = 0;
$agentid3 = 0;

$method = 'mindex'; //method
$host = $this->getOAuthHost();
if ($mode == 1) {
    $authurl = $host . 'app/' . $this->createMobileUrl($method, array('storeid' => $storeid, 'mode' => $mode, 'tablesid' => $tablesid, 'append' => $append, 'agentid' => $agentid), true) . '&authkey=1';
    $url = $host . 'app/' . $this->createMobileUrl($method, array('storeid' => $storeid, 'mode' => $mode, 'tablesid' => $tablesid, 'append' => $append, 'agentid' => $agentid), true);
} else {
    $authurl = $host . 'app/' . $this->createMobileUrl($method, array('storeid' => $storeid, 'mode' => $mode, 'agentid' => $agentid), true) . '&authkey=1';
    $url = $host . 'app/' . $this->createMobileUrl($method, array('storeid' => $storeid, 'mode' => $mode, 'agentid' => $agentid), true);
}


if ($mode == 1) {
    $table = pdo_fetch("SELECT * FROM " . tablename($this->table_tables) . " where weid = :weid AND id=:id LIMIT 1", array(':weid' => $weid, ':id' => $tablesid));
    if (empty($table)) {
        // exit('餐桌不存在！');

     // message('餐桌不存在！');
     message('席が間違っています。');

    } else {
    $tablezones = pdo_fetch("SELECT * FROM " . tablename($this->table_tablezones) . " where weid = :weid AND id=:id LIMIT 1", array(':weid' => $weid, ':id' => $table['tablezonesid']));
        if (empty($tablezones)) {
            // exit('餐桌类型不存在！');
            message('席が間違っています。');

        }
        $table_title = $tablezones['title'] . '-' . $table['title'];
        pdo_update($this->table_tables, array('status' => 1), array('id' => $tablesid));
        pdo_insert($this->table_tables_order, array('from_user' => $from_user, 'weid' => $weid, 'tablesid' => $tablesid, 'storeid' => $storeid, 'dateline' => TIMESTAMP));
    }
}
//if (empty($from_user)) {
//    message('会话已过期，请重新发送关键字!');
//}

$this->resetHour();
$store = $this->getStoreById($storeid);
$collection = pdo_fetch("SELECT * FROM " . tablename($this->table_collection) . " where weid = :weid AND storeid=:storeid AND from_user=:from_user LIMIT 1", array(':weid' => $weid, ':storeid' => $storeid, ':from_user' => $from_user));

$isrest = 0;
if ($mode != 3 && $mode != 5) {
    if ($store['is_rest'] != 1) {
        $isrest = 1;
    }
}
if ($store['is_show'] != 1) {
    // message('门店暂停营业中,暂不接单!');
    message('本日は、一時休業させて頂きます。');
}
if ($mode == 1) { //店内
    if ($store['is_meal'] == 0) {
        // message('商家已经关闭店内点餐模式，您暂时不能使用!');
        message('システムのメンテナンス作業実施のため、店内注文のご利用を一時停止させて頂きます。');
    }
}
if ($mode == 2) { //外卖
    if ($store['is_delivery'] == 0) {
        // message('商家已经关闭外卖功能，您暂时不能使用!');
        message('システムのメンテナンス作業実施のため、出前サービスのご利用を一時停止させて頂きます。');
    }
}
if ($mode == 4) {
    if ($store['is_snack'] == 0) {
        message('商家已经关闭快餐功能，您暂时不能使用!');
    }
}
if ($mode == 3) {
    if ($store['is_reservation'] == 0) {
        // message('商家已经关闭预定功能，您暂时不能使用!');
        message('システムのメンテナンス作業実施のため、予約サービスのご利用を一時停止させて頂きます。');
    }
}

$pindex = max(1, intval($_GPC['page']));
$psize = 20;
$condition = '';

if ($mode == 1 || $mode == 5) {

    $condition .= " AND is_meal=1 ";
} elseif ($mode == 2) {
    unset($_SESSION['queue_orderid']);
    unset( $_SESSION['userinfo']);
    $condition .= " AND is_delivery=1 ";
} elseif ($mode == 3) {
    unset($_SESSION['queue_orderid']);
    $condition .= " AND is_reservation=1 ";
} elseif ($mode == 4) {
    $condition .= " AND is_snack=1 ";
}

$children = array();


$category = pdo_fetchall("SELECT * FROM " . tablename($this->table_category) . " WHERE id = :id and weid = :weid AND storeid=:storeid {$condition} ORDER BY
displayorder DESC,id DESC", array(':weid' => $weid, ':storeid' => $storeid,':id' => $classid));

$category1 = pdo_fetchall("SELECT * FROM " . tablename($this->table_category) . " WHERE id != :id and weid = :weid AND storeid=:storeid {$condition} ORDER BY
displayorder DESC,id DESC", array(':weid' => $weid, ':storeid' => $storeid,':id' => $classid));
if (empty($category)) {
    message('分類が違います。');
    // message('分类不存在');
}

$catecount = count($category);
$cateheight = (($catecount + 1) * 62) + 200;

$cid = intval($category[0]['id']);

$week = date("w");

$goodslist = array();
if($_GPC['orderby']){
    $where = $_GPC['orderby'];
}else{
    $where = 'sales DESC';

}
foreach ($category as $key => $value) {
    $goods = pdo_fetchall("SELECT * FROM " . tablename($this->table_goods) . " WHERE weid = '{$weid}' AND  storeid={$storeid} AND status = '1'
AND deleted=0 AND pcate=:pcate AND find_in_set(".$week.",week) ORDER BY ".$where.", subcount DESC, id DESC ", array(':pcate' => $value['id']));
    $goodslist = $goods;
}
// var_dump($goodslist);die;

$dish_arr = $this->getDishCountInCart($storeid);
// $cart = pdo_fetchall("SELECT * FROM " . tablename($this->table_cart) . " WHERE  storeid=:storeid AND from_user=:from_user AND weid=:weid", array(':storeid' => $storeid, ':from_user' => $from_user, ':weid' => $weid));
$cart = pdo_fetchall("SELECT * FROM " . tablename($this->table_cart) . " WHERE  storeid=:storeid AND from_user=:from_user AND weid=:weid AND tablesid=:tablesid", array(':storeid' => $storeid, ':from_user' => $from_user, ':weid' => $weid, ':tablesid' => $tablesid));
$totalcount = 0;
$totalprice = 0;
foreach ($cart as $key => $value) {
    $goods_t = pdo_fetch("SELECT * FROM " . tablename($this->table_goods) . " WHERE id = :id LIMIT 1 ", array(':id' => $value['goodsid']));
    $cart[$key]['goodstitle'] = $goods_t['title'];
    $totalcount = $totalcount + $value['total'];
    $totalprice = $totalprice + $value['total'] * $value['price'];
}

$jump_url = $this->createMobileurl('classify', array('storeid' => $storeid, 'mode' => $mode), true);
$limitprice = 0;
$is_add_order = 0;
if ($mode == 1) {
   unset($_SESSION['queue_orderid']);
   unset( $_SESSION['userinfo']);

    if ($append == 0) {
        $limitprice = floatval($tablezones['limit_price']);
    }
    $jump_url = $this->createMobileurl('classify', array('storeid' => $storeid, 'mode' => $mode, 'tablesid' => $tablesid, 'append' => $append, 'orderid' => intval($_GPC['orderid'])), true);

    $order = pdo_fetch("SELECT * FROM " . tablename($this->table_order) . " WHERE weid=:weid AND from_user=:from_user AND dining_mode=1 AND
status<>3 AND status<>-1 ORDER BY id DESC LIMIT 1", array(':from_user' => $from_user, ':weid' => $weid));
    if ($order) {
        $is_add_order = 1;
    }
} elseif ($mode == 2) {
     unset( $_SESSION['userinfo']);
    $limitprice = floatval($store['sendingprice']);
} elseif ($mode == 3) {
    $rtype = 2;
    $timeid = intval($_GPC['timeid']);
    $select_date = trim($_GPC['selectdate']);
    $time = pdo_fetch("SELECT * FROM " . tablename($this->table_reservation) . " WHERE weid = :weid AND storeid =:storeid AND id=:id ORDER BY id LIMIT 1", array(':weid' => $this->_weid, ':storeid' => $storeid, ':id' => $timeid));
    if (!empty($time)) {
        $tablezones = pdo_fetch("SELECT * FROM " . tablename($this->table_tablezones) . " WHERE weid = :weid AND storeid =:storeid AND id=:id ORDER BY id LIMIT 1", array(':weid' => $this->_weid, ':storeid' => $storeid, ':id' => $time['tablezonesid']));
        $limitprice = floatval($tablezones['limit_price']);
    }
    // $jump_url = $this->createMobileUrl('reservationdetail', array('storeid' => $storeid, 'mode' => 3, 'selectdate' => $select_date, 'timeid' => $timeid, 'rtype' => 2), true);
     if(!$_SESSION[userinfo]){
        echo "出错了!!!";die;
    }
    $jump_url = $this->createMobileUrl('classify', array('storeid' => $storeid, 'mode' => 3, 'rtype' => 2,'tablesid' => $_SESSION['userinfo'][tablesid]), true);

} elseif ($mode == 5) {//排队
    // $jump_url = $this->createMobileurl('queue', array('from_user' => $from_user, 'storeid' => $storeid), true);
      unset( $_SESSION['userinfo']);
    if ($append == 0) {
        $limitprice = floatval($tablezones['limit_price']);
    }
    $jump_url = $this->createMobileurl('classify', array('storeid' => $storeid, 'mode' => $mode, 'tablesid' => $tablesid, 'append' => $append, 'orderid' => intval($_GPC['orderid'])), true);

    $order = pdo_fetch("SELECT * FROM " . tablename($this->table_order) . " WHERE weid=:weid AND from_user=:from_user AND dining_mode=1 AND
status<>3 AND status<>-1 ORDER BY id DESC LIMIT 1", array(':from_user' => $from_user, ':weid' => $weid));
    if ($order) {
        $is_add_order = 1;
    }
}

//智能点餐
$intelligents = pdo_fetchall("SELECT 1 FROM " . tablename($this->table_intelligent) . " WHERE weid=:weid AND storeid=:storeid GROUP BY name ORDER by name", array(':weid' => $weid, ':storeid' => $storeid));

$share_title = !empty($setting['share_title']) ? str_replace("#username#", $nickname, $setting['share_title']) : "您的朋友{$nickname}邀请您来吃饭";
$share_desc = !empty($setting['share_desc']) ? str_replace("#username#", $nickname, $setting['share_desc']) : "最新潮玩法，快来试试！";
$share_image = !empty($setting['share_image']) ? tomedia($setting['share_image']) : tomedia("../addons/weisrc_dish/icon.jpg");
$share_url = $host . 'app/' . $this->createMobileUrl('mindex', array('storeid' => $storeid, 'mode' => $mode, 'tablesid' => $tablesid, 'agentid' => $fans['id']), true);

$ispop = 0;
if ($setting['tiptype'] == 1) { //关注后隐藏
    if ($sub == 0) {
        $ispop = 1;
    }
} else if ($setting['tiptype'] == 2) {
    $ispop = 1;
}

$follow_title = !empty($setting['follow_title']) ? $setting['follow_title'] : "立即关注";
$follow_desc = !empty($setting['follow_desc']) ? $setting['follow_desc'] : "欢迎关注智慧点餐点击马上加入,
助力品牌推广 ";
$follow_image = !empty($setting['follow_logo']) ? tomedia($setting['follow_logo']) : tomedia("../addons/weisrc_dish/icon.jpg");
$tipqrcode = tomedia($setting['tipqrcode']);
$tipbtn = intval($setting['tipbtn']);
$follow_url = $setting['follow_url'];
include $this->template($this->cur_tpl . '/class');