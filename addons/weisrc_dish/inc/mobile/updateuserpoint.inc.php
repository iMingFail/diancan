<?php
global $_W, $_GPC;
$weid = $this->_weid;
$from_user = 'oiZGj1Ar0RDKYgtI-wD3y6pvHwN4';
$lat = trim($_GPC['lat']);
$lng = trim($_GPC['lng']);

pdo_update($this->table_account, array('lat' => $lat, 'lng' => $lng), array('from_user' => $from_user, 'weid' => $weid));
$this->showMsg('success', 1);