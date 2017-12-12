<?php
include dirname(__FILE__) . "/../_header.php";

## 쿠폰 설정 정보
@include $shopRootDir . "/conf/config.pay.php";
@include $shopRootDir . "/conf/coupon.php";

$Cart = Core::loader('Cart', $_COOKIE[gd_isDirect]);
$Goods = Core::loader('Goods');

$coupon_price = Core::loader('coupon_price_division');
$coupon_price->set_config($cfgCoupon);

if ($sess){
	$query = "
	select * from
		".GD_MEMBER." a
		left join ".GD_MEMBER_GRP." b on a.level=b.level
	where
		m_no='$sess[m_no]'
	";
	$member = $db->fetch($query,1);
}

$Cart->excep = $member['excep'];
$Cart->excate = $member['excate'];
$Cart->dc = $member['dc'].'%';
$Cart->calcu();

if($Cart -> item)foreach($Cart -> item as $k => $v) {
	if($abledc) $dc = getDcPrice($v[price],$Cart->dc);
	else $dc = 0;
	$arCategory = $Goods->get_goods_category($v['goodsno']);
	$memberDC = $member['dc'] ? $member['dc'].'%' : 0;
	$goodsDC = $v['special_discount_amount'] ? $v['special_discount_amount'] : 0;
	$coupon_price->set_item($v['goodsno'],$v['price'],$v['ea'],$arCategory,$v['opt'][0],$v['opt'][1],$v['addopt'],$v['goodsnm'], $memberDC,$goodsDC);
	$goodsPrice += ($v['price'] + $v['addprice']) * $v['ea'];
}

$totalDcPrice = 0;
$coupon_price->discountGoodsPrice($Cart->item, true);

$arrayUseData = @array_filter(@explode(',', $_POST['useData']));
$checkCouponPrice = $coupon_price->checkCouponPrice($arrayUseData, 'order');

echo $checkCouponPrice;
exit;
?>