<?php
global $_W, $_GPC;
$weid = $this->_weid;
$from_user = 'oiZGj1Ar0RDKYgtI-wD3y6pvHwN4';
$storeid = intval($_GPC['storeid']);
$queueid = intval($_GPC['queueid']);

$store = pdo_fetch("SELECT * FROM " . tablename($this->table_stores) . " where weid = :weid AND id=:id ORDER BY displayorder DESC LIMIT 1", array(':weid' => $weid, ':id' => $storeid));
if ($store['screen_mode'] == 2) {
    $list = pdo_fetchall("SELECT * FROM " . tablename($this->table_queue_setting) . " WHERE weid = :weid AND storeid =:storeid AND :time>starttime AND :time<endtime  ORDER BY id ASC", array(':weid' => $this->_weid, ':storeid' => $storeid, ':time' => date('H:i')));
}
if ($store['is_queue'] == 0) {
    // echo "该店已关闭排队！！";
    echo "システムのメンテナンス作業実施のため、番号呼出サービスのご利用を一時停止させて頂きます。";
    die;
}
$queue_count = pdo_fetchall("SELECT queueid,COUNT(1) as count FROM " . tablename($this->table_queue_order) . " where storeid=:storeid AND status=1 AND  weid = :weid GROUP BY queueid", array(':weid' => $this->_weid, ':storeid' => $storeid), 'queueid');
// include $this->template($this->cur_tpl . '/queue_form');
$user_count = pdo_fetch("SELECT nums FROM ims_weisrc_dish_queue_order where status=1 order by id desc limit 1");
// var_dump($user_count);
include $this->template($this->cur_tpl . '/yuyue');