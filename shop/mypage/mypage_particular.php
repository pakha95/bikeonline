<?
include '../_header.php';

// ����
include_once dirname(__FILE__) . '/../conf/config.pay.php';
$sealpath = '/shop/data/skin/' . $cfg['tplSkin'] . '/img/common/' . $set['tax']['seal'];

$ordno = $_GET['ordno'];

$order = new order();
$order->load($ordno);

// ���� üũ
if ($sess['m_no']){
	if ($order['m_no'] != $sess['m_no']) msg("���ٱ����� �����ϴ�",-1);
} else {
	if ($order['nameOrder'] != $_COOKIE['guest_nameOrder'] || $order['m_no']) msg("���ٱ����� �����ϴ�",-1);
}

// ���� ���� üũ
if ($order['step'] < $cfg['particularPermit']) msg('�߸��� �����Դϴ�.',-1);

//����������
if (!$cfg['road_address']) {
	$address = $cfg['address'];
} else {
	$address = $cfg['road_address'];
}

//�հ�
$totalAmount = $order->getRealPrnSettleAmount();

//��ü��ҵ� �ֹ���
if((int)$order['step2'] == 44){
	$totalAmount = 0;
}

$total = array(
	'etc' => $totalAmount,
	'supply' => 0,
	'tax' => 0,
);

$rowCount = 0;
$refundedFeeAmount = 0; //ȯ�Ҽ�����
$item = array();
foreach ($order->getOrderItems() as $v) {
	$tmp = array();
	if ($v->hasCancelCompleted()) {
		$refundedFeeAmount += array_sum($v->getRefundedFeeAmount());
		continue;
	}

	$rowCount++;

	// �ݾ� ���
	$supply = $v->getSupplyPrice();
	$tax = $v->getTax();

	// �ݾ� ����
	$total['etc'] -= $v->getAmount();
	$total['supply'] += $supply;
	$total['tax'] += $tax;

	// ��ǰ��
	$tmp['goodsnm'] = $v['goodsnm'];
	if ($v['opt1']) {
		$tmp['goodsnm'] .= " [".$v['opt1'];
		if ($v['opt2']) $tmp['goodsnm'] .= "/".$v['opt2'];
		$tmp['goodsnm'] .= ']';
	}
	if ($v['addopt']) $tmp['addopt'] = '['.str_replace('^','] [',$v['addopt']).']';

	$tmp['ea'] = $v['ea'];
	$tmp['price'] = $v['price'];
	$tmp['supply'] = $supply;
	$tmp['tax'] = $tax;

	$item[] = $tmp;
}

if ($total['etc']) {
	//��ۺ� + ������������� + ȯ�Ҽ�����
	$total['etcAddPrice'] = $order->getTaxAddAmount() + $refundedFeeAmount - $order->getCancelCompletedDeliveryFee();
	if($total['etcAddPrice'] > 0){
		$total['etcAddPriceSupply'] = round($total['etcAddPrice']/1.1);
		$total['etcAddPriceSurtax'] = $total['etcAddPrice'] - $total['etcAddPriceSupply'];
	}

	//����
	$total['discount'] = $order->getDiscount() - $order->getCancelCompletedMemberDiscount() - $order->getCancelCompletedGoodsDiscount() - $order->getCancelCompletedCouponDiscount() - $order->getCancelCompletedEmoney();
	if($total['discount'] > 0){
		$total['discountSupply'] = round($total['discount']/1.1);
		$total['discountSurtax'] = $total['discount'] - $total['discountSupply'];
	}

	$total['supply'] = $total['supply']+$total['etcAddPriceSupply']-$total['discountSupply'];
	$total['tax'] = $total['tax']+$total['etcAddPriceSurtax']-$total['discountSurtax'];

	$rowCount++;
}

$orddt = $order['orddt'];
$nameOrder = $order['nameOrder'];

$tpl->assign('cfg',$cfg);
$tpl->assign('sealpath',$sealpath);
$tpl->assign('address',$address);
$tpl->assign('orddt',$orddt);
$tpl->assign('nameOrder',$nameOrder);
$tpl->assign('item',$item);
$tpl->assign('total',$total);
$tpl->assign('totalAmount',$totalAmount);
$tpl->assign('rowCount',$rowCount);

$tpl->print_('tpl');

?>