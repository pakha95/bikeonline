<?php

include "../lib/library.php";
@include "../conf/natebasket.php";
include "../conf/config.php";
@include "../conf/coupon.php";

//��뿩�� Ȯ��
if($natebasket['useYn'] != 'y') exit;

### ��ǰ ����Ÿ
$query = "
select a.goodsno, a.goodsnm, a.maker, d.brandnm, a.img_l, a.img_m, a.usestock, a.totstock, a.sales_range_start, a.sales_range_end from
        ".GD_GOODS." a
        left join ".GD_GOODS_BRAND." d on a.brandno=d.sno
";
$where[] = "a.open=1";
$where[] = "a.runout=0";

if ($where) $where = " where ".implode(" and ",$where);
$query .= $where;

$res = $db->query($query);

header("Cache-Control: no-cache, must-revalidate");
header("Content-Type: text/plain; charset=euc-kr");
?>
<<<eptime>>><?=date('Y-m-d H:i:s')."\n";?>
<?
$goodsModel = Clib_Application::getModelClass('goods');

while ($v=$db->fetch($res)){		// $res while Start

	// �Ǹ� ����(�Ⱓ �� ����)�� ��� ����
	if (! $goodsModel->setData($v)->canSales()) continue;

	### ǰ�� üũ
	if($v['usestock']=='o' && $v['totstock']==0)	continue;

	### �̹��� ( �⺻���� Ȯ���̹��� , �� ���� ���̹���. �� �� ������ ���� �ȵ�. )
	if(!$v['img_l'] || $v['img_l'] == ''){
		if(!$v['img_m'] || $v['img_m'] == ''){
			continue;
		}else{
			$img_name = $v['img_m'];
		}
	}else{
		$img_name = $v['img_l'];
	}

	$query ="select price from ".GD_GOODS_OPTION." where goodsno='$v[goodsno]' and link and go_is_deleted <> '1' and go_is_display = '1'  limit 1";
	list($v[price]) = $db->fetch($query);

	### ��ǰ�� �Ӹ��� ����
	if($natebasket['nb_goodshead'])$v['goodsnm'] = str_replace(array('{_maker}','{_brand}'),array($v['maker'],$v['brandnm']),$natebasket['nb_goodshead']).$v['goodsnm'];
	$v['goodsnm'] = substr(strip_tags($v['goodsnm']),0,250);	// ���ڼ� ����

	### �Ｎ��������
	$coupon = 0;
	if($cfgCoupon['use_yn'] && $natebasket['uncoupon'] == 'N'){
		list($v[coupon],$v[coupon_emoney]) = getCouponInfo($v[goodsno],$v[price]);
		//$v[reserve] += $v[coupon_emoney];
		if($v[coupon])$coupon = getDcprice($v[price],$v[coupon]);
	}

	### ���� ȸ������ �ߺ� ���� üũ
	if($coupon>0){
		if($cfgCoupon['range'] == 1)$coupon=0;
	}

	### ���� ����
	$coupon += 0;
	$price = 0;
	$price = $v['price'] - $coupon;
?>
<<<begin>>>
<<<mapid>>><?=$v['goodsno']."\n"?>
<<<pname>>><?=$v['goodsnm']."\n"?>
<<<price>>><?=$price."\n"?>
<<<ftend>>>
<?
}
?>
