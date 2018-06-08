<?php

// echo 111;die;
// header("Content-type: text/html; charset=utf-8");
// $miyao="zsdfyreuoyamdphhaweyrjbvzkgfdycs";
// $mchntid = '100000000000203';
// $terminalid = 'xlsj0001';
// $inscd ='10130001';
require_once './db/mysql_operate.php';
$order = db_select('ims_weisrc_dish_order',array('status'=>'-2','ispay'=>'0'),$params="id,ordersn,dateline,weid,storeid,from_user,xl_terminalNum,xl_shopNum,xl_key,xl_code","limit 10",array('id'=>'desc')); 
// echo $order;die;
if($order==0){
	echo time();
	$order2 = db_select('ims_weisrc_dish_order',array('status'=>'0','ispay'=>'0'),$params="id,ordersn,dateline,weid,storeid,from_user","limit 10",array('id'=>'desc'));
	if($order2){		
		foreach($order2 as $orderlist){
			if(time()-$orderlist['dateline']>=60){
 			//查找用户昵称
			$info = db_select('ims_weisrc_dish_fans',array('from_user'=>$orderlist['from_user']));
			 //更新订单状态
			db_update('ims_weisrc_dish_order',array('status'=>'-1'),array('id'=>$orderlist['id']));
			//更新订单日志
	    	$param = array('weid'=>$orderlist['weid'],'orderid'=>$orderlist['id'],'content'=>"用户{$info[0]['nickname']}取消订单",'storeid'=>$orderlist['storeid'],'dateline'=>time());
	    	// var_dump($param);die;
		    db_insert('ims_weisrc_dish_order_log',$param);
			}
		}	
	}
	die;
}

foreach($order as $orders){ 
	echo $orders['id'];
	echo time();
	$data = array();
	$data['version'] = "2.2";
	$data['signType'] = 'SHA256';
	$data['charset'] = 'utf-8';
	$data['origOrderNum'] = $orders['ordersn'];
	$data['busicd'] = 'INQY';
	//$data['respcd'] = '00';
	$data['inscd'] = $orders['xl_code'];
	$data['mchntid'] = $orders['xl_shopNum'];
	$data['terminalid'] = $orders['xl_terminalNum'];
	$data['txndir'] = 'Q';
	ksort($data);
	$str = '';
	foreach($data as $k=>$v){
		if($str!=''){
			$str .= '&';
		}
		$str .= $k.'='.$v;
	}
	$str.= $orders['xl_key'];
	$sign=hash("sha256", $str);
	$data['sign'] = $sign;
	$data=json_encode($data);
	// $pc = json_decode(post_curl('http://showmoney.cn/scanpay/unified',$data),true);
	$pc = json_decode(post_curl('http://sandbox.showmoney.cn/scanpay/unified',$data),true);
	echo $pc['errorDetail'];
	if($pc['errorDetail']=='待买家支付' && time()-$orders['dateline']>=60){ 
		// echo 22222;
			$qxdata = array();
			$qxdata['busicd'] = 'CANC';
			$qxdata['charset'] = 'utf-8';
			$qxdata['inscd'] = $orders['xl_code'];
			$qxdata['mchntid'] = $orders['xl_shopNum'];
			$qxdata['terminalid'] = $orders['xl_terminalNum'];
			$qxdata['orderNum'] = time().rand(1000,9999);
			$qxdata['origOrderNum'] = $orders['ordersn'];
			$qxdata['signType'] = 'SHA256';
			$qxdata['txndir'] = 'Q';
			$qxdata['version'] = '2.2';
			ksort($qxdata);
			$str = '';
			foreach($qxdata as $k=>$v){
				if($str!=''){
					$str .= '&';
				}
				$str .= $k.'='.$v;
			}
			$str.= $orders['xl_key'];
			$qxdata['sign'] = hash("sha256", $str);
			// var_dump($qxdata);die;
			$qpc = json_decode(post_curl('http://sandbox.showmoney.cn/scanpay/unified',json_encode($qxdata)),true);
			if($qpc['errorDetail']=="成功"){
				echo "string";
			 //查找用户昵称
			$info = db_select('ims_weisrc_dish_fans',array('from_user'=>$orders['from_user']));
			 //更新订单状态
			db_update('ims_weisrc_dish_order',array('status'=>'-1','ordersn'=>$qxdata['orderNum'],'origOrderNum'=>$orders['ordersn']),array('id'=>$orders['id']));
			//更新订单日志
	    	$param = array('weid'=>$orders['weid'],'orderid'=>$orders['id'],'content'=>"用户{$info[0]['nickname']}取消订单",'storeid'=>$orders['storeid'],'dateline'=>time());
	    	// var_dump($param);die;
		    db_insert('ims_weisrc_dish_order_log',$param);

			}
	   		
	}elseif($pc['errorDetail']=='成功'){
	
	}elseif($pc['errorDetail']=='订单不存在' && time()-$orders['dateline']>=60){
		
	}
}

function post_curl($url,$data){
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$result = curl_exec($ch);
	if (curl_errno($ch)) {
		print curl_error($ch);
	}
	curl_close($ch);
	return $result;
}
function post_curl1($url,$data){
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$result = curl_exec($ch);
	if (curl_errno($ch)) {
		print curl_error($ch);
	}
	curl_close($ch);
	return $result;
}