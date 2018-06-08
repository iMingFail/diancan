<?php
global $_W, $_GPC;
$weid = $this->_weid;
// $from_user = 'oiZGj1Ar0RDKYgtI-wD3y6pvHwN4';
$storeid = intval($_GPC['storeid']);
$username = trim($_GPC['username']);
$peoples = trim($_GPC['peoples']);
$smoking = intval($_GPC['smoking']);
$remarks = trim($_GPC['remarks']);
$times = trim($_GPC['time']);
$tid = trim($_GPC['tables']);
$tel = trim($_GPC['tel']);
$rtype = !isset($_GPC['rtype']) ? 1 : intval($_GPC['rtype']);
$timeid = intval($_GPC['timeid']);
// $select_date = "2018-05-23"=trim($_GPC['selectdate']);
// var_dump($_SESSION);



if($_SESSION['userinfo']){
    unset($_SESSION['userinfo']);
}
$store = $this->getStoreById($storeid);
if ($store['is_reservation'] == 0) {
    echo "'商家已经关闭预定功能，您暂时不能使用!'";die;
    }
$dates = array();
for ($i = 0; $i < $store['reservation_days']; $i++) {
    if ($i == 0) {
        $dates[] = date("Y-m-d", TIMESTAMP);
    } else {
        $dates[] = date("Y-m-d", strtotime("+{$i} day"));
    }
}
$time = pdo_fetch("SELECT * FROM " . tablename($this->table_reservation) . " WHERE weid = :weid AND storeid =:storeid ORDER BY id LIMIT 1", array(':weid' => $this->_weid, ':storeid' => $storeid, ));

// $time = pdo_fetch("SELECT * FROM " . tablename($this->table_reservation) . " WHERE weid = :weid AND storeid =:storeid  ORDER BY id LIMIT 3", array(':weid' => $this->_weid, ':storeid' => $storeid));

// var_dump($time);
// die;

if (!empty($time)) {
    $reservation_time = $select_date . ' ' . $time['time'];
    $tablezones = pdo_fetch("SELECT * FROM " . tablename($this->table_tablezones) . " WHERE weid = :weid AND storeid =:storeid AND id=:id ORDER BY id LIMIT 1", array(':weid' => $this->_weid, ':storeid' => $storeid, ':id' => $time['tablezonesid']));
    $tablezonesid = intval($tablezones['id']);

    $cur_date = date("Y-m-d", TIMESTAMP);
    if ($select_date == $cur_date) {
        $tables = pdo_fetchall("SELECT * FROM " . tablename($this->table_tables) . " WHERE storeid =:storeid AND
tablezonesid=:tablezonesid AND status=0 ORDER BY id DESC", array(':storeid' => $storeid, ':tablezonesid' => $tablezonesid), 'id');
    } else {
        $tables = pdo_fetchall("SELECT * FROM " . tablename($this->table_tables) . " WHERE storeid =:storeid AND
tablezonesid=:tablezonesid ORDER BY id DESC", array(':storeid' => $storeid, ':tablezonesid' => $tablezonesid), 'id');
    }

    if ($tables) {
        $order = pdo_fetchall("SELECT * FROM " . tablename($this->table_order) . " WHERE weid = :weid AND storeid=:storeid AND tables IN ('" . implode("','", array_keys($tables)) . "') AND
meal_time=:meal_time AND dining_mode=3  AND status<>-1 AND paytype<>0", array(':weid' => $this->_weid, ':storeid' => $storeid, ':meal_time' => $reservation_time));
        foreach ($tables as $key => $value) {
            $tables[$key]['title'] = $value['title'] . '(' . $value['user_count'] . '人桌)';
            foreach($order as $okey => $ovalue) {
                if ($value['id'] == $ovalue['tables']) {
                    $tables[$key]['title'] = $value['title'] . '(' . $value['user_count'] . '人桌)' . '(已预订)';
//                    unset($tables[$key]);
                } else {
                    $tables[$key]['title'] = $value['title'] . '(' . $value['user_count'] . '人桌)';
                }
            }
        }
    }

    if (empty($tables)) {
        message('没有可预订的桌台!');
    }
}
if($_POST){

    if ($store['is_reservation'] == 0) {
    echo "'商家已经关闭预定功能，您暂时不能使用!'";
    die;
    }
    if (!$username) {
        echo '请输入联系人！';
        die;
    }
    if (!$tel) {
        echo '请输入您的电话号码！';
        die;
    }
    if (!$tid) {
        echo $tid.'出错了,请重新扫码！';
        die;
    }


    $_SESSION['userinfo']['username']=$username;
    $_SESSION['userinfo']['peoples']=$peoples;
    $_SESSION['userinfo']['smoking']=$smoking;
    $_SESSION['userinfo']['remarks']=$remarks;
    $_SESSION['userinfo']['time']=$times;
    $_SESSION['userinfo']['tablesid']=$tid;
    $_SESSION['userinfo']['tel']=$tel;
    $_SESSION['userinfo']['sid']=$storeid;
    // echo 14345;
    echo 1;

    $data = $_SESSION['userinfo'];
    feieSendFreeMessage1($data);
    die;
}
// feieSendFreeMessage1();
    //飞鹅
     function feieSendFreeMessage1($data=0)
    {
        global $_W, $_GPC;

        //打印机配置信息
        // echo 111;
        $settings = pdo_fetchall("SELECT * FROM  ims_weisrc_dish_print_setting" . " WHERE storeid = :storeid AND print_status=1 AND type='feie' ", array(':storeid' => $_GPC['storeid']));
        $store = pdo_fetchall("SELECT * FROM  ims_weisrc_dish_stores" . " WHERE id = :storeid ", array(':storeid' =>intval($_GPC['storeid'])));

        $tables = pdo_fetchall("SELECT * FROM  ims_weisrc_dish_tables" . " WHERE id = :tablesid ", array(':tablesid' =>intval($_GPC['tablesid'])));
        if ($settings == false) {
            return -4;
        }

        if($data['smoking'] ==1){
            // $type ="吸烟区";
            $type ="喫煙席";
        }else{
            // $type ="禁烟区";
            $type ="禁煙席";

        }

        $content .= '店舗: ' . $store[0]['title'] . "<BR>";
        // $content .= '台桌: ' . $tables[0]['title'] . "<BR>";
        $content .= '席番号: 予約席'  . "<BR>";
        // $content .= '前面还有: ' . --$data['num'] . "人<BR>";
        $content .= '联系人: ' . $data['username'] . "<BR>";
        $content .= '電話番号: ' . $data['tel'] . "<BR>";
        $content .= '到着時間: ' . $data['time'] . "<BR>";
        $content .= '予約人数: ' . $data['peoples'] . "<BR>";
        $content .= '種類: ' .$type . "<BR>";
        $content .= 'その他: ' . $data['remarks'] . "<BR>";
        $content .= '注文時間: ' . date("Y-m-d H:i:s",time()) . "<BR><BR>";

        //打印机
        foreach ($settings as $item => $value) {
            $loop_first = 0;
            if ($value['is_meal'] == 1 ) {
                $loop_first = 1;
            }
            if ($value['is_delivery'] == 1 ) {
                $loop_first = 1;
            }
            if ($value['is_reservation'] == 1) {
                $loop_first = 1;
            }
            if ($value['is_snack'] == 1 ) {
                $loop_first = 1;
            }
            if ($value['is_shouyin'] == 1 ) {
                $loop_first = 1;
            }
            if ($loop_first == 0) {
                continue;
            }
            $FEIE_IP = 'dzp.feieyun.com';
            $api_type = intval($value['api_type']);
            if ($api_type == 0) {
                $pos = strpos($value['print_usr'], '6');
                if ($pos == 2) {
                    $FEIE_IP = 'api163.feieyun.com';
                }
                $pos = strpos($value['print_usr'], '7');
                if ($pos == 2) {
                    $FEIE_IP = 'api174.feieyun.com';
                }
            } elseif ($api_type == 1) {
                $FEIE_IP = 'dzp.feieyun.com';
            } elseif ($api_type == 2) {
                $FEIE_IP = 'api163.feieyun.com';
            } elseif ($api_type == 3) {
                $FEIE_IP = 'api174.feieyun.com';
            } elseif ($api_type == 4) {
                $FEIE_IP = 'api.feieyun.cn';
            }

             if (!empty($value['qrcode_url']) && !empty($value['qrcode_status'])) {
                    $content .= "<QR>" . $value['qrcode_url'] . "</QR>";
            }
             $feie_content = array(
                        'sn' => $value['print_usr'],
                        'printContent' => $content,
                        'key' => $value['feyin_key'],
                        'times' => $value['print_nums']//打印次数
                    );

            $client = new HttpClient($FEIE_IP, 80);
            // if (!empty($value['print_top'])) {
            //     $print_top = "<CB>" . $value['print_top'] . "</CB><BR>";
            // }
            // if (!empty($value['print_bottom'])) {
            //     $print_bottom = "<C>" . $value['print_bottom'] . "</C>";
            // }
            $result = $client->post(FEIE_HOSTNAME . '/printOrderAction', $feie_content);
                $_feiestatus = $result['responseCode'];
          // var_dump($feie_content);
          if($result){
                $print_order_data = array(
                    'weid' => $weid,
                    'print_usr' => $value['print_usr'],
                    'print_status' => -1,
                    'dateline' => TIMESTAMP
                );
                pdo_insert($this->table_print_order, $print_order_data);
          }

        }
    }
// $cart = pdo_fetchall("SELECT * FROM " . tablename($this->table_cart) . " a LEFT JOIN " . tablename('weisrc_dish_goods') . " b ON a.goodsid=b.id WHERE a.weid=:weid AND a.from_user=:from_user AND a.storeid=:storeid", array(':weid' => $weid, ':from_user' => $from_user, ':storeid' => $storeid));
// $totalcount = 0;
// $totalprice = 0;
// foreach ($cart as $key => $value) {
//     $totalcount = $totalcount + $value['total'];
//     $totalprice = $totalprice + $value['total'] * $value['price'];
// }

// $url1 = $this->createMobileUrl('reservationdetail', array('storeid' => $storeid, 'mode' => 3, 'selectdate' => $select_date, 'timeid' => $timeid, 'rtype' => 1), true);
// $url2 = $this->createMobileUrl('mindex', array('storeid' => $storeid, 'mode' => 3, 'selectdate' => $select_date, 'timeid' => $timeid, 'rtype' => 2), true);

include $this->template($this->cur_tpl . '/reservation_details');