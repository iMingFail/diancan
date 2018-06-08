<?php
global $_GPC, $_W;
$weid = $this->_weid;
$action = 'goods';
$storeid = intval($_GPC['storeid']);
//检查门店
$this->checkStore($storeid);
$title = $this->actions_titles[$action];
$returnid = $this->checkPermission($storeid);
$deleted = intval($_GPC['deleted']);
//当前门店
$cur_store = $this->getStoreById($storeid);
//设置菜单
$GLOBALS['frames'] = $this->getNaveMenu($storeid,$action);

$category = pdo_fetchall("SELECT * FROM " . tablename($this->table_category) . " WHERE weid = :weid And storeid=:storeid ORDER BY parentid ASC, displayorder DESC", array(':weid' => $weid, ':storeid' => $storeid), 'id');
if (!empty($category)) {
    $children = '';
    foreach ($category as $cid => $cate) {
        if (!empty($cate['parentid'])) {
            $children[$cate['parentid']][$cate['id']] = array($cate['id'], $cate['name']);
        }
    }
}

$label = pdo_fetchall("SELECT * FROM " . tablename($this->table_print_label) . " WHERE weid = :weid And storeid=:storeid ORDER BY displayorder DESC", array(':weid' => $weid, ':storeid' => $storeid), 'id');

$nowtime = mktime(0, 0, 0);
pdo_query("UPDATE " . tablename($this->table_goods) . " SET today_counts=0,lasttime=:time WHERE storeid=:storeid AND lasttime<:nowtime", array(':storeid' => $storeid, ':time' => TIMESTAMP, ':nowtime' => $nowtime));

$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
if ($operation == 'post') {
    load()->func('tpl');

    $id = intval($_GPC['id']);
    if (!empty($id)) {
        $item = pdo_fetch("SELECT * FROM " . tablename($this->table_goods) . " WHERE id = :id", array(':id' => $id));
        if (empty($item)) {
            message('抱歉，商品不存在或是已经删除！', '', 'error');
        } else {
            if (!empty($item['thumb_url'])) {
                $item['thumbArr'] = explode('|', $item['thumb_url']);
            }
            if (!empty($item['week'])) {

                $weeks = explode(',', $item['week']);
            }
        }
    }
    if (checksubmit('submit')) {
        $data = array(
            'weid' => intval($weid),
            'storeid' => $storeid,
            'title' => trim($_GPC['goodsname']),
            'labelid' => intval($_GPC['labelid']),
            'pcate' => intval($_GPC['pcate']),
            'ccate' => intval($_GPC['ccate']),
            'thumb' => trim($_GPC['thumb']),
            'week' => trim(implode(',', $_GPC['week'])),
            'credit' => intval($_GPC['credit']),
            'unitname' => trim($_GPC['unitname']),
            'description' => trim($_GPC['description']),
            'content' => trim($_GPC['content']),
            'taste' => trim($_GPC['taste']),
            'counts' => intval($_GPC['counts']),
            'today_counts' => intval($_GPC['today_counts']),
            'sales' => intval($_GPC['sales']),
            'isspecial' => empty($_GPC['marketprice']) ? 1 : 2,
            'marketprice' => floatval($_GPC['marketprice']),
            'commission_money1' => floatval($_GPC['commission_money1']),
            'commission_money2' => floatval($_GPC['commission_money2']),
            'memberprice' => !empty($_GPC['memberprice']) ? floatval($_GPC['memberprice']) : '',
            'productprice' => !empty($_GPC['productprice']) ? floatval($_GPC['productprice']) : '',
            'packvalue' => floatval($_GPC['packvalue']),
            'delivery_commission_money' => floatval($_GPC['delivery_commission_money']),
            'subcount' => intval($_GPC['subcount']),
            'status' => intval($_GPC['status']),
            'recommend' => intval($_GPC['recommend']),
            'displayorder' => intval($_GPC['displayorder']),
            'dateline' => TIMESTAMP,
        );
        if ($_W['role'] == 'operator') {
            unset($data['credit']);
        }

        if (empty($data['title'])) {
            message('请输入商品名称！');
        }
        if (empty($data['pcate'])) {
            message('请选择商品分类！');
        }

        if (!empty($_FILES['thumb']['tmp_name'])) {
            load()->func('file');
            file_delete($_GPC['thumb_old']);
            $upload = file_upload($_FILES['thumb']);
            if (is_error($upload)) {
                message($upload['message'], '', 'error');
            }
            $data['thumb'] = $upload['path'];
        }
        if (empty($id)) {
            pdo_insert($this->table_goods, $data);
        } else {
            unset($data['dateline']);
            pdo_update($this->table_goods, $data, array('id' => $id));
        }
        $en_title= $_POST['en_title'];
        $en_description= $_POST['en_description'];
        $jp_title= $_POST['jp_title'];
        $jp_description= $_POST['jp_description'];
        $hw_title= $_POST['hw_title'];
        $hw_description= $_POST['hw_description'];
        $ft_title= $_POST['ft_title'];
        $ft_description= $_POST['ft_description'];
        $py_title= $_POST['py_title'];
        $py_description= $_POST['py_description'];
        if($en_title && $en_description){
            if (!empty($id)) {

                $arr = unserialize(file_get_contents('en.txt'));
                if(is_array($arr[$id])){
                    $arr[$id]['en_description']=$en_description;
                    $arr[$id]['en_title']=$en_title;
                }else{
                    $enarray1 =array("en_title"=>$entitle,'en_description'=>$en_description);
                    $arr[$id]= $enarray1 ;
                }
                // var_dump($arr);die;
                file_put_contents('en.txt',serialize($arr));
            }
        }
        if($jp_title && $jp_description){
            if (!empty($id)) {
                $jparr = unserialize(file_get_contents('jq.txt'));
                if(is_array($jparr[$id])){
                    $jparr[$id]['jp_description']=$jp_description;
                    $jparr[$id]['jp_title']=$jp_title;
                }else{
                    $jqenarray1 =array("jp_title"=>$jp_title,'jp_description'=>$jp_description);
                    $jparr[$id]= $jqenarray1 ;
                }
                file_put_contents('jp.txt',serialize($jparr));
            }
        }

        if($hw_title && $hw_description){
            if (!empty($id)) {

                $hwarr = unserialize(file_get_contents('hw.txt'));
                if(is_array($hwarr[$id])){
                    $hwarr[$id]['hw_description']=$hw_description;
                    $hwarr[$id]['hw_title']=$hw_title;
                }else{
                    $hwenarray1 =array("hw_title"=>$hw_title,'hw_description'=>$hw_description);
                    $hwarr[$id]= $hwenarray1 ;
                }
                file_put_contents('hw.txt',serialize($hwarr));
            }
        }

        if($ft_title && $ft_description){
            if (!empty($id)) {

                $ftarr = unserialize(file_get_contents('ft.txt'));
                if(is_array($ftarr[$id])){
                    $ftarr[$id]['ft_description']=$ft_description;
                    $ftarr[$id]['ft_title']=$ft_title;
                }else{
                    $ftenarray1 =array("ft_title"=>$ft_title,'ft_description'=>$ft_description);
                    $ftarr[$id]= $ftenarray1 ;
                }
                file_put_contents('ft.txt',serialize($ftarr));
            }
        }

         if($py_title && $py_description){
            if (!empty($id)) {

                $pyarr = unserialize(file_get_contents('py.txt'));
                if(is_array($pyarr[$id])){
                    $pyarr[$id]['py_description']=$py_description;
                    $pyarr[$id]['py_title']=$py_title;
                }else{
                    $pyenarray1 =array("py_title"=>$py_title,'py_description'=>$py_description);
                    $pyarr[$id]= $pyenarray1 ;
                }
                file_put_contents('py.txt',serialize($pyarr));
            }
        }

        // die;
        message('商品更新成功！', $this->createWebUrl('goods', array('op' => 'display', 'storeid' => $storeid)), 'success');
    }
} elseif ($operation == 'display') {
    if (!empty($_GPC['displayorder'])) {
        foreach ($_GPC['displayorder'] as $id => $displayorder) {
            pdo_update($this->table_goods, array('displayorder' => $displayorder), array('id' => $id));
        }
        message('排序更新成功！', $this->createWebUrl('goods', array('op' => 'display', 'storeid' => $storeid)), 'success');
    }

    $pindex = max(1, intval($_GPC['page']));
    $psize = 8;
    $condition = '';
    if (!empty($_GPC['keyword'])) {
        $condition .= " AND title LIKE '%{$_GPC['keyword']}%'";
    }

    if (!empty($_GPC['category_id'])) {
        $cid = intval($_GPC['category_id']);
        $condition .= " AND pcate = '{$cid}'";
    }

    if (isset($_GPC['status'])) {
        $condition .= " AND status = '" . intval($_GPC['status']) . "'";
    }

    $list = pdo_fetchall("SELECT * FROM " . tablename($this->table_goods) . " WHERE weid = '{$weid}' AND storeid ={$storeid} AND deleted={$deleted} $condition ORDER BY status DESC, displayorder DESC, id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize);

    $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename($this->table_goods) . " WHERE weid = '{$weid}' AND storeid ={$storeid} AND deleted=0 $condition");

    $pager = pagination($total, $pindex, $psize);
} elseif ($operation == 'delete') {
    $id = intval($_GPC['id']);
    $row = pdo_fetch("SELECT id, thumb FROM " . tablename($this->table_goods) . " WHERE id = :id", array(':id' => $id));
    if (empty($row)) {
        message('抱歉，商品 不存在或是已经被删除！');
    }
    pdo_update($this->table_goods, array('deleted' => 1), array('id' => $id, 'weid' => $weid));
    message('删除成功！', referer(), 'success');
}  elseif ($operation == 'restore') {
    $id = intval($_GPC['id']);
    $row = pdo_fetch("SELECT id, thumb FROM " . tablename($this->table_goods) . " WHERE id = :id", array(':id' => $id));
    if (empty($row)) {
        message('抱歉，商品 不存在或是已经被删除！');
    }
    pdo_update($this->table_goods, array('deleted' => 0), array('id' => $id, 'weid' => $weid));
    message('操作成功！', referer(), 'success');
} elseif ($operation == 'deleteall') {
    $rowcount = 0;
    $notrowcount = 0;
    foreach ($_GPC['idArr'] as $k => $id) {
        $id = intval($id);
        if (!empty($id)) {
            $goods = pdo_fetch("SELECT * FROM " . tablename($this->table_goods) . " WHERE id = :id", array(':id' => $id));
            if (empty($goods)) {
                $notrowcount++;
                continue;
            }
            pdo_update($this->table_goods, array('deleted' => 1), array('id' => $id, 'weid' => $weid));
            $rowcount++;
        }
    }
    $this->message("操作成功！共删除{$rowcount}条数据,{$notrowcount}条数据不能删除!", '', 0);
} elseif ($operation == 'upall') {
    $rowcount = 0;
    $notrowcount = 0;
    foreach ($_GPC['idArr'] as $k => $id) {
        $id = intval($id);
        if (!empty($id)) {
            $goods = pdo_fetch("SELECT * FROM " . tablename($this->table_goods) . " WHERE id = :id", array(':id' => $id));
            if (empty($goods)) {
                $notrowcount++;
                continue;
            }
            pdo_update($this->table_goods, array('status' => 1), array('id' => $id, 'weid' => $weid));
            $rowcount++;
        }
    }
    $this->message("操作成功！共操作{$rowcount}条数据,{$notrowcount}条数据操作失败!", '', 0);
}  elseif ($operation == 'downall') {
    $rowcount = 0;
    $notrowcount = 0;
    foreach ($_GPC['idArr'] as $k => $id) {
        $id = intval($id);
        if (!empty($id)) {
            $goods = pdo_fetch("SELECT * FROM " . tablename($this->table_goods) . " WHERE id = :id", array(':id' => $id));
            if (empty($goods)) {
                $notrowcount++;
                continue;
            }
            pdo_update($this->table_goods, array('status' => 0), array('id' => $id, 'weid' => $weid));
            $rowcount++;
        }
    }
    $this->message("操作成功！共操作{$rowcount}条数据,{$notrowcount}条数据操作失败!", '', 0);
} elseif ($operation == 'opengoods') {
    pdo_update($this->table_goods, array('status' => 1), array('weid' => $weid, 'storeid' => $storeid));
    message('商品上架成功！', $this->createWebUrl('goods', array('op' => 'display', 'storeid' => $storeid)), 'success');
} elseif ($operation == 'closegoods') {
    pdo_update($this->table_goods, array('status' => 0), array('weid' => $weid, 'storeid' => $storeid));
    message('商品下架成功！', $this->createWebUrl('goods', array('op' => 'display', 'storeid' => $storeid)), 'success');
}
include $this->template('web/goods');