<?php
global $_W, $_GPC;
$weid = $this->_weid;
$from_user = 'oiZGj1Ar0RDKYgtI-wD3y6pvHwN4';
$storeid = intval($_GPC['storeid']);

if ($storeid == 0) {
    message('门店不存在！');
}

include $this->template($this->cur_tpl . '/savewine_form');