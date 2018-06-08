<?php
global $_W, $_GPC;
$weid = $this->_weid;
// $from_user = 'oiZGj1Ar0RDKYgtI-wD3y6pvHwN4';
$storeid = intval($_GPC['storeid']);
$queueid = intval($_GPC['queueid']);
$usermobile = trim($_GPC['usermobile']);
$usercount = trim($_GPC['usercount']);
if($_SESSION['from_user']){
    $from_user=$_SESSION['from_user'];
}else{
    $_SESSION['from_user'] =$from_user =md5(time());
}
if (empty($from_user)) {
    $this->showMsg('お手数を掛けますが、もう一回QRコードをスキャンしてください。');
}
if (empty($storeid)) {
    // $this->showMsg('请先选择门店!');
    $this->showMsg('店舗を選んでください。');
}
// if (empty($usermobile)) {
//     $this->showMsg('请输入手机号码!');
// }
if (empty($usercount)) {
    $this->showMsg('请输入用户数量!');
}
$store = pdo_fetch("SELECT * FROM " . tablename($this->table_stores) . " where weid = :weid AND id=:id ORDER BY displayorder DESC LIMIT 1", array(':weid' => $weid, ':id' => $storeid));

$num = 'C001';
$config = $this->module['config']['weisrc_dish'];
if ($queueid == 0) { //未选队列
    if ($store['screen_mode'] == 2) {
        $this->showMsg('请先选择队列!');
    }

    $queueSetting = pdo_fetch("SELECT * FROM " . tablename($this->table_queue_setting) . " WHERE weid = :weid AND storeid =:storeid AND :time>starttime
AND :time<endtime AND :usercount<=limit_num AND status=1 ORDER BY limit_num ASC LIMIT 1", array(':weid' => $this->_weid, ':storeid' => $storeid, ':time' => date('H:i'), ':usercount' => $usercount));

    if (empty($queueSetting)) {
        // $this->showMsg('没有符合您人数的队列!');
        $this->showMsg('人数に合ったキューがありません。');
    }

    $exists_queue = pdo_fetch("SELECT * FROM " . tablename($this->table_queue_order) . " WHERE queueid=:queueid AND from_user=:from_user AND status=1 ORDER BY id DESC LIMIT 1", array(':queueid' => $queueSetting['id'], ':from_user' => $from_user));
    if (!empty($exists_queue)) {
        $day1= date("ymdhi",time());
        $tableday1=date("ymdhi",$exists_queue['dateline']);
        if($day1-$tableday1<5){
          // $this->showMsg('您已经在排队中！5分钟后再试');
          $this->showMsg('人数に合ったキューがありません');
        }
    }

    $queueOrder = pdo_fetch("SELECT * FROM " . tablename($this->table_queue_order) . " WHERE weid = :weid AND storeid =:storeid AND queueid=:queueid ORDER BY id DESC LIMIT 1", array(':weid' => $this->_weid, ':storeid' => $storeid, ':queueid' => $queueSetting['id']));

    if (empty($queueOrder)) {
        $num = $queueSetting['prefix'] . '001';
    } else {
        $num = intval(findNum($queueOrder['num']));
        $nums =$num++;
        ++$nums;
        $num = $queueSetting['prefix'] . str_pad($num, 3, "0", STR_PAD_LEFT);
    }
    $queueid = $queueSetting['id'];
} else { //已选队列
    if (empty($store['screen_mode']) || $store['screen_mode'] == 1) {
        $this->showMsg('请先选择队列!');
    }
    $queueSetting = pdo_fetch("SELECT * FROM " . tablename($this->table_queue_setting) . " WHERE weid = :weid AND storeid =:storeid AND :time>starttime AND :time<endtime AND id=:id AND :usercount<=limit_num LIMIT 1", array(':weid' => $this->_weid, ':storeid' => $storeid, ':time' => date('H:i'), ':id' => $queueid, ':usercount' => $usercount));

    if (empty($queueSetting)) {
        $this->showMsg('人数に合ったキューがありません。');
        // $this->showMsg('没有符合您人数的队列!');
    }

    $exists_queue = pdo_fetch("SELECT * FROM " . tablename($this->table_queue_order) . " WHERE queueid=:queueid AND from_user=:from_user AND status=1 ORDER BY id DESC LIMIT 1", array(':queueid' => $queueSetting['id'], ':from_user' => $from_user));
    if (!empty($exists_queue)) {
         $day1= date("ymdhi",time());
        $tableday1=date("ymdhi",$exists_queue['dateline']);
        if($day1-$tableday1<5){
          // $this->showMsg('您已经在排队中！5分钟后再试');
          $this->showMsg('人数に合ったキューがありません');
        }
    }
    $queueOrder = pdo_fetch("SELECT * FROM " . tablename($this->table_queue_order) . " WHERE weid = :weid AND storeid =:storeid AND queueid=:queueid ORDER BY id DESC LIMIT 1", array(':weid' => $this->_weid, ':storeid' => $storeid, ':queueid' => $queueSetting['id']));

    if (empty($queueOrder)) {
        $num = $queueSetting['prefix'] . '001';
    } else {
        $num = intval(findNum($queueOrder['num']));
        $nums =$num++;
        ++$nums;
        $num = $queueSetting['prefix'] . str_pad($num, 3, "0", STR_PAD_LEFT);
    }
}
 // $this->showMsg(date("d",$exists_queue['dateline']));

$day= date("ymd",time());
$tableday=date("ymd",$exists_queue['dateline']);
if($day!=$tableday){
    $num = $queueSetting['prefix'] . '001';
    $nums=1;
}
$data = array(
    'weid' => $weid,
    'from_user' => $from_user,
    'storeid' => $storeid,
    'queueid' => $queueid,
    'num' => $num,
    'nums' => $nums,
    'remark' => $_POST['remark'],
    'smoke' =>$_POST['smoking'],
    // 'mobile' => $usermobile,
    'usercount' => $usercount,
    'isnotify' => 0,
    'status' => 1, //状态
    'dateline' => TIMESTAMP
);

pdo_insert($this->table_queue_order, $data);
$oid = pdo_insertid();
if ($oid > 0) {
    $_SESSION['queue_orderid']=$oid;
    // $this->showMsg($_SESSION['queue_orderid']);

//     if ($this->_accountlevel == 4) {
//         $this->sendQueueNotice($oid);
//         $setting = $this->getSetting();
//         if (!empty($setting)) {
// //            if (!empty($setting['tpluser'])) {
// //                $tousers = explode(',', $setting['tpluser']);
// //                foreach ($tousers as $key => $value) {
// //                    $this->sendAdminQueueNotice($oid, $value, $setting);
// //                }
// //            }
//             $accounts = pdo_fetchall("SELECT * FROM " . tablename($this->table_account) . " WHERE weid = :weid AND storeid=:storeid AND status=2 AND is_notice_queue=1 ORDER BY id DESC ", array(':weid' => $this->_weid, ':storeid' => $storeid));
//             foreach ($accounts as $key => $value) {
//                 if (!empty($value['from_user'])) {
//                     $this->sendAdminQueueNotice($oid, $value['from_user'], $setting);
//                 }
//             }
//         }
//     }
//
      // $this->showMsg($data);
      echo 1;
      feieSendFreeMessage1($data);

     die;
}
 function feieSendFreeMessage1($data=0)
    {
        global $_W, $_GPC;

        //打印机配置信息
        // echo 111;
        $settings = pdo_fetchall("SELECT * FROM  ims_weisrc_dish_print_setting" . " WHERE storeid = :storeid AND print_status=1 AND type='feie' ", array(':storeid' =>
            $_GPC['storeid']));
        $store = pdo_fetchall("SELECT * FROM  ims_weisrc_dish_stores" . " WHERE id = :storeid ", array(':storeid' =>intval($_GPC['storeid'])));

        $tables = pdo_fetchall("SELECT * FROM  ims_weisrc_dish_tables" . " WHERE id = :tablesid ", array(':tablesid' =>intval($_GPC['tablesid'])));
        if ($settings == false) {
            return -4;
        }

        if($data['smoke'] ==1){
            $type ="喫煙席";
            // $type ="吸烟区";
        }else{
            $type ="禁煙席";
            // $type ="禁烟区";

        }
        $content .= '店舗: ' . $store[0]['title'] . "<BR>";
        $content .= '席番号: ' . $tables[0]['title'].$data['num'] . "<BR>";
        $content .= '待ち人数: ' .$data['nums']. "人<BR>";
        $content .= '予約人数: ' . $data['usercount'] . "<BR>";
        $content .= '类型: ' .$type . "<BR>";
        $content .= '备注: ' . $data['remark'] . "<BR>";
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
$this->showMsg('操作成功!', 1);