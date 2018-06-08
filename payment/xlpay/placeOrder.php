<?php
placeOrder();
function placeOrder(){
        // echo 1111;die;
        header("Content-type: text/html; charset=utf-8");
        $miyao="zsdfyreuoyamdphhaweyrjbvzkgfdycs";
        $mchntid = '100000000000203';
        $terminalid = 'xlsj0001';
        $inscd ='10130001';
        $data = array();
        $qxdata = array();
        $data['version'] = "2.2";
        $data['signType'] = 'SHA256';
        $data['charset'] = 'utf-8';
        $data['orderNum'] = '20180425416760989397';
        $data['busicd'] = 'PURC';
        $data['inscd'] = $inscd;
        $data['mchntid'] = $mchntid;
        $data['terminalid'] = $terminalid;
        $data['txndir'] = 'Q';
        $data['txamt'] = str_pad(2*100, 12, "0", STR_PAD_LEFT);
        $data['scanCodeId'] = '20180425416760989397';
        ksort($data);
        $str = '';
        foreach($data as $k=>$v){
            if($str!=''){
                $str .= '&';
            }
            $str .= $k.'='.$v;
        }
        $str.= $miyao;
        $sign=hash("sha256", $str);
        $data['sign'] = $sign;
        $data=json_encode($data);
    // $pc = json_decode(post_curl('http://showmoney.cn/scanpay/unified',$data),true);
        $pc = json_decode(post_curl('http://sandbox.showmoney.cn/scanpay/unified',$data),true);
         var_dump($pc);
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