<?php
require_once './db/mysql_operate.php';
// $oid= 476;
// echo $oid;
// file_get_contents('http://'.$_SERVER['SERVER_NAME'].'/addons/weisrc_dish/admin/index.php?c=site&a=entry&op=printall&storeid=34&position_type=1&do=feie&m=weisrc_dish&ids='.$oid);
// echo 1111;die;
$fan=json_encode($_REQUEST);
$str = str_replace(array("{","}",":","\\","\""),"",$fan);
$str_arr = explode("&",$str);
foreach($str_arr as $sa){
	$s = explode('=',$sa);
	$sas[$s[0]] = $s[1];
}
// file_put_contents('test.txt',json_encode($sas));

if($sas['errorDetail']=='SUCCESS'){
   	//查找订单状态
   	$result = db_select('ims_weisrc_dish_order',array('ordersn'=>$sas['orderNum'],'ispay'=>'0'));
   	if($result){
   		
   		//查找昵称 判断用户是否正常
	    $userInfo = db_select('ims_weisrc_dish_fans',array('from_user'=>$result[0]['from_user']));
	    if($userInfo[0]['status'] !=1){
	        echo "用户不可法";die;
	    }
	    //更新订单状态
		db_update('ims_weisrc_dish_order',array('ispay'=>'1','status'=>'0'),array('id'=>$result[0]['id'],'ispay'=>'0'));
		 //查找用户昵称
	   	$info = db_select('ims_weisrc_dish_fans',array('from_user'=>$result[0]['from_user']));
		//更新订单日志
	    $param = array('weid'=>'2','orderid'=>$result[0]['id'],'content'=>"用户{$info[0]['nickname']}支付订单",'storeid'=>$userInfo[0]['storeid'],'dateline'=>time());
		db_insert('ims_weisrc_dish_order_log',$param);
		//打印
   		file_get_contents('http://'.$_SERVER['SERVER_NAME'].'/addons/weisrc_dish/admin/index.php?c=site&a=entry&op=printall&storeid=34&position_type=1&do=feie&m=weisrc_dish&ids='.$result[0]['id']);
   		
   	}
	echo "success";
}
