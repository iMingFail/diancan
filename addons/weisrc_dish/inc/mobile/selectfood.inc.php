
<?php
/**
 * @Author: Marte
 * @Date:   2018-05-09 18:48:08
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-05-30 10:37:35
 */
header("Content-type: text/html; charset=utf-8");

global $_W, $_GPC;
$weid = $this->_weid;
$from_user = 'oiZGj1Ar0RDKYgtI-wD3y6pvHwN4';
$tablesid = intval($_GPC['tablesid']);
$classid = intval($_GPC['classid']);
$fid = intval($_GPC['fid']);
$l = trim($_GPC['l']);
$action = $_GPC['action'];
$title = '全部商品';
$mode = intval($_GPC['mode']);
$append = intval($_GPC['append']);
$setting = $this->getSetting();

$storeid = intval($_GPC['storeid']);
if ($storeid == 0) {
    $storeid = $this->getStoreID();
}
if (empty($storeid)) {
   echo '请先选择门店';
}
if (empty($classid)) {
    echo '请先选择分类';
}


if($action == 'selectfood'){
    if (empty($fid)) {
    echo '商品不存在';
    }
    $goodslist = array();
    $goods = pdo_fetchall("SELECT * FROM " . tablename($this->table_goods) . " WHERE id =:id and weid = '{$weid}' AND  storeid={$storeid} AND status = '1'
    AND deleted=0 AND pcate=:pcate  ORDER BY displayorder DESC, subcount DESC, id DESC ", array(':pcate' => $classid,':id' => $fid));
    $goodslist = $goods[0];
    $txt = '../web/'.$l.'.txt';
    $arr = unserialize(file_get_contents($txt));
    // echo $l;die;
    if(is_array($arr[$fid])){
        $title =$arr[$fid][$l."_title"];
        $description =$arr[$fid][$l."_description"];
        $goodslist['title']= $title;
        $goodslist['description']= $description;
    }
    $goodslist['url']="http://".$_SERVER['SERVER_NAME']."/attachment";
   echo json_encode($goodslist);
}

if($action == 'selectclass'){
    $goodslist = array();
    $goods = pdo_fetchall("SELECT * FROM " . tablename($this->table_goods) . " WHERE  weid = '{$weid}' AND  storeid={$storeid} AND status = '1'
    AND deleted=0   ORDER BY displayorder DESC, subcount DESC, id DESC ");
    $goodslist = $goods;
    // $goodslist['url']="http://".$_SERVER['SERVER_NAME']."/attachment";
   // echo json_encode($goodslist);
    message($goodslist, '', 'ajax');
}


// if ($mode == 0) {
//     echo '请先选择下单模式';
// }