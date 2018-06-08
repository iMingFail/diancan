<?php
/**
 * @Author: Marte
 * @Date:   2018-05-08 18:59:15
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-05-15 15:14:28
 */
global $_W, $_GPC;
$weid = $this->_weid;
$tablesid = intval($_GPC['tablesid']);
$title = '全部商品';
$mode = intval($_GPC['mode']);
$append = intval($_GPC['append']);
$setting = $this->getSetting();
$storeid = intval($_GPC['storeid']);

if($_SESSION['from_user']){
    $from_user=$_SESSION['from_user'];
}else{
    message('请重新扫码进去!!!');

}

$cart = pdo_fetchall("SELECT * FROM " . tablename($this->table_cart) . " WHERE  storeid=:storeid AND from_user=:from_user AND weid=:weid AND tablesid=:tablesid", array(':storeid' => $storeid, ':from_user' => $from_user, ':weid' => $weid, ':tablesid' => $tablesid));
$totalcount = 0;
$totalprice = 0;
foreach ($cart as $key => $value) {
    $goods_t = pdo_fetch("SELECT * FROM " . tablename($this->table_goods) . " WHERE id = :id LIMIT 1 ", array(':id' => $value['goodsid']));
    $cart[$key]['goodstitle'] = $goods_t['title'];
    $totalcount = $totalcount + $value['total'];
    $totalprice = $totalprice + $value['total'] * $value['price'];
}
include $this->template($this->cur_tpl . '/choujiang');