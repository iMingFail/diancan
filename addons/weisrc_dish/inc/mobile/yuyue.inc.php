<?php
/**
 * @Author: Marte
 * @Date:   2018-05-08 18:59:15
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-06-05 10:41:21
 */
die;
global $_W, $_GPC;
$weid = $this->_weid;
$num = pdo_fetch("SELECT num,date FROM ims_weisrc_dish_yuyue " . " order by id desc");
$user_count = pdo_fetch("SELECT user_count FROM ims_weisrc_dish_tables " . " where id =284");
// var_dump($user_count);
$day= date("d",time());
$tableday=date("d",$num['date']);
// $tableday=date("Y-m-d H:i:s", strtotime("-1 day"));
if($day != $tableday){
    $num['num'] = 0;
}
if($_POST){
    $peoples = trim($_GPC['peoples']); //吃饭人数
    $num = intval($_GPC['num']); //预约人数
    $content = trim($_GPC['content']); //备注
    $type = intval($_GPC['type']); //类型
    $date = time();

    $data = array(
        'peoples' => $peoples,
        'num' => $num,
        'content' => $content,
        'type' => $type,
        'date' => $date
    );
    if(pdo_insert($this->table_yuyue,$data) ==1){
         echo 1;
        feieSendFreeMessage1($data);

     }
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

        if($data['type'] ==1){
            $type ="吸烟区";
        }else{
            $type ="禁烟区";

        }

        $content .= '所属门店: ' . $store[0]['title'] . "<BR>";
        $content .= '台桌: ' . $tables[0]['title'].$data['num'] . "<BR>";
        $content .= '前面还有: ' . --$data['num'] . "人<BR>";
        $content .= '预约人数: ' . $data['peoples'] . "<BR>";
        $content .= '类型: ' .$type . "<BR>";
        $content .= '备注: ' . $data['content'] . "<BR><BR>";

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
// echo $peoples.$num.$content.$type.$date;
include $this->template($this->cur_tpl . '/yuyue');