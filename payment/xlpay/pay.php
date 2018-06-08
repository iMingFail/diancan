<?php
//
require_once './db/mysql_operate.php';
header("Content-type: text/html; charset=utf-8");

$orderNum = $_GET['orderNum'];  //订单编号
$miyao="c6842f00a2297767be8c2664b745d1cb";  //签名秘钥
$mchntid = '391581758120001';  //商务号
$inscd = '93911888';    //机构号
$data['version'] = "2.2";
$data['signType'] = 'SHA256';
$data['charset'] = 'utf-8';
$data['orderNum'] = $orderNum;
$data['busicd'] = 'WPAY';
$data['backUrl'] = 'http://'.$_SERVER['SERVER_NAME']."/payment/xlpay/back.php";
//http://a.y89jd.top/app/index.php?i=4&c=entry&mode=1&storeid=34&tablesid=260&do=waplist&m=weisrc_dish
$data['frontUrl'] = 'http://'.$_SERVER['SERVER_NAME']."/app/index.php?i=4&c=entry&mode=1&storeid=34&tablesid=260&do=waplist&m=weisrc_dish";
$data['mchntid'] = $mchntid;
$data['terminalid'] = '00000001';
$data['inscd'] = $inscd;
$data['chcd'] = 'YSY';
$data['paylimit'] = 'credit';
$data['txamt'] = str_pad(100, 12, "0", STR_PAD_LEFT);
ksort($data);
$str = '';
foreach($data as $k=>$v){
	if($str!=''){
		$str .= '&';
	}
	$str .= $k.'='.$v;
}
$str.= $miyao;
$data['sign']=hash("sha256", $str);
//file_put_contents('data.txt',json_encode($data));
header('Location:https://showmoney.cn/scanpay/unified?data='.base64_encode(json_encode($data)));
//$pay_json = json_decode(post_curl('https://showmoney.cn/scanpay/unified',json_encode($data)),true);



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
