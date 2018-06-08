<?php

    //飞鹅
     function feieSendFreeMessage($orderid = 0, $position_type = 0)
    {
        global $_W, $_GPC;

        if ($orderid == 0) {
            return -2;
        }

        $order = $this->getOrderById($orderid);
        if (empty($order)) {
            return -3;
        }

        $weid = $order['weid'];
        $storeid = $order['storeid'];

        $store = $this->getStoreById($storeid);
        //打印机配置信息
        $settings = pdo_fetchall("SELECT * FROM " . tablename($this->table_print_setting) . " WHERE storeid = :storeid AND print_status=1 AND type='feie' ", array(':storeid' => $storeid));

        if ($settings == false) {
            return -4;
        }

        //1:店内2:外卖3:预定4:快餐
        $dining_mode = $order['dining_mode'];
        $paytype = $this->getPayType($dining_mode);
        $ordertype = $this->getOrderType();

        //商品id数组
        $goodsid = pdo_fetchall("SELECT goodsid,total,price FROM " . tablename($this->table_order_goods) . " WHERE orderid = :orderid", array(':orderid' => $orderid), 'goodsid');

        $paystatus = $order['ispay'] == 0 ? '未支付' : '已支付';

        $content = "订单编号:" . $order['ordersn'] . "<BR>";
        if ($dining_mode == 4) {
            $content .= '领餐牌号:' . $order['quicknum'] . "<BR>";
        }
        $content .= '订单类型:' . $ordertype[$dining_mode] . "<BR>";
        $content .= '所属门店:' . $store['title'] . "<BR>";
        $content .= '支付方式:' . $paytype[$order['paytype']] . "(" . $paystatus . ")<BR>";
        $content .= '下单日期:' . date('Y-m-d H:i:s', $order['dateline']) . "<BR>";
        if ($dining_mode == 3) {
            $tablezones = pdo_fetch("SELECT * FROM " . tablename($this->table_tablezones) . " where weid = :weid AND id=:id LIMIT 1", array(':weid' => $weid, ':id' => $order['tablezonesid']));
            $content .= "桌台类型：{$tablezones['title']}<BR>";
        }
        if (!empty($order['tables'])) {
            $content .= '桌台信息:<B>' . $this->getTableName($order['tables']) . "</B><BR>";
        }
        if (!empty($order['counts'])) {
            $content .= '用餐人数:' . $order['counts'] . "<BR>";
        }
        if (!empty($order['remark'])) {
            $content .= '备注:' . $order['remark'] . "<BR>";
        }
        $content .= '门店地址:' . $store['address'] . "<BR>";
        $content .= '门店电话:' . $store['tel'] . "<BR>";

        $content2 = "-------------------------<BR>";
        $packvalue = floatval($order['packvalue']);
        $tea_money = floatval($order['tea_money']);
        $service_money = floatval($order['service_money']);
        if ($packvalue > 0 && $dining_mode == 2) {
            $content2 .= "打包费:{$packvalue}元<BR>";
        }
        if ($tea_money > 0 && $dining_mode == 1) {
            $content2 .= "{$store['tea_tip']}:{$tea_money}元<BR>";
        }
        if ($service_money > 0 && $dining_mode == 1) {
            $content2 .= "服务费:{$service_money}元<BR>";
        }
        $content2 .= "总数量:" . $order['totalnum'] . "   总价:" . number_format($order['totalprice'], 2) . "元<BR>";
        if ($dining_mode != 4 && !empty($order['meal_time'])) {
            $content2 .= '预定时间:' . $order['meal_time'] . "<BR>";
        }
        if (!empty($order['username'])) {
            $content2 .= '姓名:' . $order['username'] . "<BR>";
        }
        if (!empty($order['tel'])) {
            $content2 .= '手机:' . $order['tel'] . "<BR>";
        }
        if (!empty($order['address'])) {
            $content2 .= '地址:' . $order['address'] . "<BR>";
        }
        $content2 .= "-------------------------<BR>";

        //打印机
        foreach ($settings as $item => $value) {
            //判断打印订单类型（是否已经支付的单子）
            //支付模式未支付时
            if ($value['print_type'] == 1 && $order['ispay'] == 0) {
                continue;
            }
            //已确认模式未确认订单
            if ($value['print_type'] == 2 && $order['status'] == 0) {
                continue;
            }
            //前台模式 后厨打印机
            if ($position_type == 1 && $value['position_type'] == 2) {
                continue;
            }
            //后厨模式 前台打印机
            if ($position_type == 2 && $value['position_type'] == 1) {
                continue;
            }

            $loop_first = 0;
            if ($value['is_meal'] == 1 && $dining_mode == 1) {
                $loop_first = 1;
            }
            if ($value['is_delivery'] == 1 && $dining_mode == 2) {
                $loop_first = 1;
            }
            if ($value['is_reservation'] == 1 && $dining_mode == 3) {
                $loop_first = 1;
            }
            if ($value['is_snack'] == 1 && $dining_mode == 4) {
                $loop_first = 1;
            }
            if ($value['is_shouyin'] == 1 && $dining_mode == 5) {
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

            $client = new HttpClient($FEIE_IP, FEIE_PORT);
            if ($order['status'] == -1) {
                $print_order_data = array(
                    'weid' => $weid,
                    'orderid' => $orderid,
                    'print_usr' => $value['print_usr'],
                    'print_status' => -1,
                    'dateline' => TIMESTAMP
                );
                pdo_insert($this->table_print_order, $print_order_data);
                $oid = pdo_insertid();

                $cancelcontent = '^订单已取消' . "\n";
                $cancelcontent .= '编号:' . $order['ordersn'];
                $feie_content = array(
                    'sn' => $value['print_usr'],
                    'printContent' => $cancelcontent,
                    'key' => $value['feyin_key'],
                    'times' => 1//打印次数
                );
                $result = $client->post(FEIE_HOSTNAME . '/printOrderAction', $feie_content);
                $_feiestatus = $result['responseCode'];
                pdo_update('weisrc_dish_print_order', array('print_status' => $_feiestatus), array('id' => $oid));
                return;
            }

            if (!empty($value['print_top'])) {
                $print_top = "<CB>" . $value['print_top'] . "</CB><BR>";
            }
            if (!empty($value['print_bottom'])) {
                $print_bottom = "<C>" . $value['print_bottom'] . "</C>";
            }
            //商品
            if ($value['print_label'] == '0') {
                $goods = pdo_fetchall("SELECT * FROM " . tablename($this->table_goods) . "  WHERE id IN ('" . implode("','", array_keys($goodsid)) . "')");
            } else {
                //餐桌
                $table_label = pdo_fetch("SELECT * FROM " . tablename($this->table_tables) . " WHERE id=:id", array(":id" => $order['tables']));
                if (in_array($table_label['print_label'], explode(',', $value['print_label']))) {
                    $goods = pdo_fetchall("SELECT * FROM " . tablename($this->table_goods) . "  WHERE id IN ('" . implode("','", array_keys($goodsid)) . "')");
                } else {
                    $goods = pdo_fetchall("SELECT * FROM " . tablename($this->table_goods) . "  WHERE id IN ('" . implode("','", array_keys($goodsid)) . "') AND labelid IN(" . $value['print_label'] . ")");
                }
            }
            if (empty($goods) && $dining_mode != 3 && $dining_mode != 5) {
                continue;
            }
            $order['goods'] = $goods;
            if ($goods) {
                if ($order['isvip'] == 1) {
                    $viptip = "(会员)";
                }
                if ($order['is_append'] == 1) {
                    $appendtip = "(加单)";
                }
                $content1 = "商品列表{$viptip}{$appendtip}<BR>";
                $content1 .= "-------------------------<BR>";
            }

            if ($value['is_print_all'] == 1) {
                if ($value['type'] == 'feie') {
                    $print_order_data = array(
                        'weid' => $weid,
                        'orderid' => $orderid,
                        'print_usr' => $value['print_usr'],
                        'print_status' => -1,
                        'dateline' => TIMESTAMP
                    );
                    pdo_insert($this->table_print_order, $print_order_data);
                    $oid = pdo_insertid();
                }
                foreach ($order['goods'] as $v) {
                    $money = $goodsid[$v['id']]['price'];
                    $content1 .= $v['title'] . ' ' . $goodsid[$v['id']]['total'] . $v['unitname'] . ' ' . number_format($money, 2) . "元\n";
                }
                if (!empty($value['qrcode_url']) && !empty($value['qrcode_status'])) {
                    $print_bottom .= "<QR>" . $value['qrcode_url'] . "</QR>";
                }
                //喇叭
                $a = array("\x1b", "\x64", "\x01", "\x1b", "\x70", "\x30", "\x1e", "\x78");
                $box = implode("", $a);

                $printContent = $print_top . $content . $content1 . $content2 . $print_bottom . $box;

                $feie_content = array(
                    'sn' => $value['print_usr'],
                    'printContent' => $printContent,
                    'key' => $value['feyin_key'],
                    'times' => $value['print_nums']//打印次数
                );

                $result = $client->post(FEIE_HOSTNAME . '/printOrderAction', $feie_content);
                $_feiestatus = $result['responseCode'];
                pdo_update('weisrc_dish_print_order', array('print_status' => $_feiestatus), array('id' => $oid));
            } else { //分单
                $content = '订单编号:' . $order['ordersn'] . "<BR>";
                $content .= '下单日期:' . date('Y-m-d H:i:s', $order['dateline']) . "<BR>";
                if (!empty($order['tables'])) {
                    $content .= '<B>桌台信息:</B><DB>' . $this->getTableName($order['tables']) . "</DB><BR>";
                }
                if (!empty($order['remark'])) {
                    $content .= '<DB>备注:' . $order['remark'] . "</DB><BR>";
                }
                foreach ($order['goods'] as $v) {
                    if ($value['type'] == 'feie') { //飞印
                        $print_order_data = array(
                            'weid' => $weid,
                            'orderid' => $orderid,
                            'print_usr' => $value['print_usr'],
                            'print_status' => -1,
                            'dateline' => TIMESTAMP
                        );
                        pdo_insert($this->table_print_order, $print_order_data);
                        $oid = pdo_insertid();
                    }
                    $content1 = '';
                    $content1 .= "------------------------------------------------<BR>";
                    $content1 .= '<B>名称:' . $v['title'] . "</B><BR>";
                    $content1 .= '<B>数量:' . $goodsid[$v['id']]['total'] . $v['unitname'] . "</B><BR>";
                    $money = $goodsid[$v['id']]['price'];
                    $content1 .= '<B>价格:' . number_format($money, 2) . "元</B><BR>";
                    $content1 .= "------------------------------------------------<BR>";
                    $printContent = $print_top . $content . $content1 . $print_bottom;
                    $feie_content = array(
                        'sn' => $value['print_usr'],
                        'printContent' => $printContent,
                        'key' => $value['feyin_key'],
                        'times' => $value['print_nums']//打印次数
                    );

                    $result = $client->post(FEIE_HOSTNAME . '/printOrderAction', $feie_content);
                    $_feiestatus = $result['responseCode'];
                    pdo_update('weisrc_dish_print_order', array('print_status' => $_feiestatus), array('id' => $oid));
                }
            }
        }
    }
?>