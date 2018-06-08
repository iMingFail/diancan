<?php

    $url = 'https://showmoney.cn/scanpay/unified';
    $mch_id = '308533773720001';
    $key = '44cb8825044b62a36062f67a76e4ff20';
    $inscd = '93081888';
    $data = array(
        'version'    => '2.2',
        'signType'   => 'SHA256',
        'charset'    => 'utf-8',
        'orderNum'   => 'test'.time(),
        'busicd'     => 'WPAY',
        'mchntid'    => $mch_id,
        'terminalid' => $inscd,
        'txamt'      => str_pad(1, 12, "0", STR_PAD_LEFT),
        'backUrl'    => 'http://qq.com',
        'frontUrl'   => 'http://qq.com',
        'chcd'       => 'WXP',
        'paylimit'   => 'credit'
    );
    ksort($data);

    //file_put_contents('log.log', 'Success notify  => '.serialize($data['orderNum'])."\r\n", FILE_APPEND);
    $signOStr = '';
    foreach ($data as $k => $val) {
        if ($signOStr != '') {
            $signOStr .= '&';
        }
        $signOStr .= $k . '=' . $val;
    }
    $signOStr .= $key;
    $sign = hash("sha256", $signOStr);
    $data['sign'] = $sign;

    $data = base64_encode(json_encode($data));

    header('Location:'.$url.'?data='.$data);
