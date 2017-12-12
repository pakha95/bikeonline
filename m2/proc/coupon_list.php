<?php
$noDemoMsg = 1;
include dirname(__FILE__) . "/../_header.php";
@include $shopRootDir . "/lib/cart.class.php";

## 쿠폰 설정 정보
@include $shopRootDir . "/conf/config.pay.php";
@include $shopRootDir . "/conf/coupon.php";

if(!$cfgCoupon['use_yn']) $cfgCoupon['use_yn'] = 0;	// 쿠폰 사용여부(0:사용하지않음 1:사용)
if(!$cfgCoupon['range']) $cfgCoupon['range'] = 0;	// 중복할인여부(0:쿠폰할인, 회원할인 동시사용  1:회원할인만 사용 2: 쿠폰할인만 사용)
if(!$cfgCoupon['double']) $cfgCoupon['double'] = 0;	// 쿠폰 사용제한(0:한 주문에 여러 쿠폰 사용가능   1:한 주문에 한개 쿠폰만 사용)
if(!$cfgCoupon['coupon']) $cfgCoupon['coupon'] = 0;	// 주문쿠폰 할인방법(0:주문서 총 결제금액에 할인 금액 적용   1:쿠폰 할인 대상 상품에만 할인 금액 적용)

## 회원할인 적용여부
if(!$cfgCoupon['use_yn'] || ($cfgCoupon['range'] != '2' && $cfgCoupon['use_yn']))$ableDc = true;
else $ableDc = false;

## 쿠폰 적용여부
if($cfgCoupon['range'] != '1' && $cfgCoupon['use_yn'])$ableCoupon = true;
else $ableCoupon = false;

$versionFile = '/proc/coupon_list_division.htm';
if($cfgCoupon['coupon'] && is_file($tpl->template_dir.$versionFile)) {
	$coupon_price = Core::loader('coupon_price_division');
	$tpl->define(array('tpl'=>$versionFile));
	$couponVersion = 1;
} else {
	$coupon_price = Core::loader('coupon_price');
	$couponVersion = 0;
}
$Cart = Core::loader('Cart', $_COOKIE[gd_isDirect]);
$Goods = Core::loader('Goods');
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

if($Cart -> item)foreach($Cart -> item as $v) {
	if($abledc) $dc = getDcPrice($v[price],$Cart->dc);
	else $dc = 0;
	$arCategory = $Goods->get_goods_category($v['goodsno']);
	$coupon_price->set_item($v['goodsno'],$v['price'],$v['ea'],$arCategory,$v['opt'][0],$v['opt'][1],$v['addopt'],$v['goodsnm']);
	$goodsPrice += ($v['price'] + $v['addprice']) * $v['ea'];
}

//모바일샵 전용쿠폰 포함 함수로 변경 2013-05-13 dn
//$coupon_price->get_goods_coupon('order');
$coupon_price->get_goods_coupon_mobile('order');
if($couponVersion) $coupon_price->discountGoodsPrice($Cart->item, true);
if($coupon_price->arCoupon)foreach($coupon_price->arCoupon as $data){
	if($data['excPrice'] && $data['excPrice'] > $goodsPrice) continue;
	if($data['pay_limit'] == "limited" && $data['limit_amount'] && $goodsPrice < $data['limit_amount']) continue;
	$data['apr']=0;
	if($data['sale']) $data['apr'] = @array_sum($data['sale']);
	if($data['reserve']) $data['apr'] = @array_sum($data['reserve']);
	if($couponVersion) $data['apr'] = $coupon_price->allCouponPrice(array($data['couponcd']), 'order');
	$loop[] = $data;
}

if(!$sess['m_no'])	echo("<script>alert('회원만 쿠폰사용이 가능합니다.!');self.close();</script>");
if(!$ableCoupon) {
	echo("<script>alert('쿠폰사용이 불가합니다.!');self.close();</script>");
	exit;
}

$tpl->assign(array('cart' => $Cart));
$tpl->print_('tpl');
?>