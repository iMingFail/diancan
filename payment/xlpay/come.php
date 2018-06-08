<?php
require_once './db/mysql_operate.php';
$fan=json_encode($_REQUEST);
$str = str_replace(array("{","}",":","\\","\""),"",$fan);
$sas = explode(',',$str); 
$num = substr($sas[3],8);
$result = db_select('ims_weisrc_dish_order',array('ordersn'=>$num));
if($result){
	// header("location:http://a.y89jd.top/app/index.php?i=4&c=entry&do=orderdetail&m=weisrc_dish&orderid=440");
	header("location:http://".$_SERVER['SERVER_NAME']."/app/index.php?i={$result[0]['weid']}&c=entry&do=order&m=weisrc_dish");
}else{
	echo "<center><h2 style='color:red;margin-top:50%;font-size:30px'>出错了!!!,请联系服务员。</h2></center>";
}

