<?php
$noDemoMsg = 1;
include dirname(__FILE__) . "/../_header.php";
@include $shopRootDir . "/lib/cart.class.php";

## ���� ���� ����
@include $shopRootDir . "/conf/config.pay.php";
@include $shopRootDir . "/conf/coupon.php";

if(!$cfgCoupon['use_yn']) $cfgCoupon['use_yn'] = 0;	// ���� ��뿩��(0:����������� 1:���)
if(!$cfgCoupon['range']) $cfgCoupon['range'] = 0;	// �ߺ����ο���(0:��������, ȸ������ ���û��  1:ȸ�����θ� ��� 2: �������θ� ���)
if(!$cfgCoupon['double']) $cfgCoupon['double'] = 0;	// ���� �������(0:�� �ֹ��� ���� ���� ��밡��   1:�� �ֹ��� �Ѱ� ������ ���)
if(!$cfgCoupon['coupon']) $cfgCoupon['coupon'] = 0;	// �ֹ����� ���ι��(0:�ֹ��� �� �����ݾ׿� ���� �ݾ� ����   1:���� ���� ��� ��ǰ���� ���� �ݾ� ����)

## ȸ������ ���뿩��
if(!$cfgCoupon['use_yn'] || ($cfgCoupon['range'] != '2' && $cfgCoupon['use_yn']))$ableDc = true;
else $ableDc = false;

## ���� ���뿩��
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

//����ϼ� �������� ���� �Լ��� ���� 2013-05-13 dn
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

if(!$sess['m_no'])	echo("<script>alert('ȸ���� ��������� �����մϴ�.!');self.close();</script>");
if(!$ableCoupon) {
	echo("<script>alert('��������� �Ұ��մϴ�.!');self.close();</script>");
	exit;
}

$tpl->assign(array('cart' => $Cart));
$tpl->print_('tpl');
?>