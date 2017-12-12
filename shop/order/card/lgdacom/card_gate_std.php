<?php
/**
 * LG ���÷��� PG ���
 * ���� ���ϸ� payreq_crossplatform.php
 * LG ���÷��� PG ���� : LG U+ ǥ�ذ���â 2.5 - SmartXPay(V1.2 - 20141212)
 */

// �⺻ ���� ����
include "../conf/pg.lgdacom.php";
@include "../conf/pg.escrow.php";

// LG���÷��� ���̵� ó��
if (empty($pg['serviceType'])) {
	$pg['serviceType'] = 'service';
}
if ($pg['serviceType'] == 'test') {
	$LGD_MID = 't'.$pg['id'];
} else {
	$LGD_MID = $pg['id'];
}

// ��ǰ�� ó��
if (!preg_match('/mypage/',$_SERVER['SCRIPT_NAME'])) {
	$item = $cart->item;
}
foreach ($item as $v) {
	$i++;
	if($i == 1) $ordnm = $v['goodsnm'];
}

//��ǰ�� Ư������ �� �±� ����
$ordnm = pg_text_replace(strip_tags($ordnm));
if ($i > 1) $ordnm .= " ��".($i-1)."��";

// ������ ���� (Y:1 / N:0)
if ($pg['zerofee'] == 'yes') {
	$pg['zerofee'] = '1';
} else {
	$pg['zerofee'] = '0';
}

// ������ �Һ� ����
if ($pg['zerofee'] == '0') {
	$pg['zerofee_period'] = '';
}

// �������� ����
$arrSettlekind =array(
	'c' => 'SC0010',
	'o' => 'SC0030',
	'v' => 'SC0040',
	'h' => 'SC0060',
);

/*
 * 1. �⺻���� ������û ���� ����
 * 
 * �⺻������ �����Ͽ� �ֽñ� �ٶ��ϴ�.(�Ķ���� ���޽� POST�� ����ϼ���)
 */
$configPath = $_SERVER['DOCUMENT_ROOT'].$cfg['rootDir'].'/conf/lgdacom';		// LG���÷������� ������ ȯ������("/conf/lgdacom.conf") ��ġ ����.
$lguplusReturnUrl = ProtocolPortDomain().$cfg['rootDir'].'/order/card/lgdacom';	// LG���÷��� ���� URL ����
$LGD_MID = $LGD_MID;							//�������̵�(�ڵ�����)
$LGD_OID = $_POST['ordno'];						//�ֹ���ȣ(�������� ����ũ�� �ֹ���ȣ�� �Է��ϼ���)
$LGD_AMOUNT = $_POST['settleprice'];			//�����ݾ�("," �� ������ �����ݾ��� �Է��ϼ���)
$LGD_TIMESTAMP = date(YmdHms);					//Ÿ�ӽ�����

/*
 * �������(������) ���� ������ �Ͻô� ��� �Ʒ� LGD_CASNOTEURL �� �����Ͽ� �ֽñ� �ٶ��ϴ�.
 */
$LGD_CASNOTEURL = $lguplusReturnUrl.'/cas_noteurl.php';	// ������� NOTEURL

/*
 * LGD_RETURNURL �� �����Ͽ� �ֽñ� �ٶ��ϴ�. �ݵ�� ���� �������� ������ ����Ʈ�� ��  ȣ��Ʈ�̾�� �մϴ�. �Ʒ� �κ��� �ݵ�� �����Ͻʽÿ�.
 */
$LGD_RETURNURL = $lguplusReturnUrl.'/returnurl.php';

/*
 *************************************************
 * 2. MD5 �ؽ���ȣȭ (�������� ������) - BEGIN
 * 
 * MD5 �ؽ���ȣȭ�� �ŷ� �������� �������� ����Դϴ�.
 *************************************************
 *
 * �ؽ� ��ȣȭ ����( LGD_MID + LGD_OID + LGD_AMOUNT + LGD_TIMESTAMP + LGD_MERTKEY )
 * LGD_MID			: �������̵�
 * LGD_OID			: �ֹ���ȣ
 * LGD_AMOUNT		: �ݾ�
 * LGD_TIMESTAMP	: Ÿ�ӽ�����
 * LGD_MERTKEY		: ����MertKey (mertkey�� ���������� -> ������� -> ���������������� Ȯ���ϽǼ� �ֽ��ϴ�)
 * MD5 �ؽ������� ��ȣȭ ������ ����
 * LG���÷������� �߱��� ����Ű(MertKey)�� ȯ�漳�� ����(lgdacom/conf/mall.conf)�� �ݵ�� �Է��Ͽ� �ֽñ� �ٶ��ϴ�.
 */
require_once(dirname(__FILE__)."/XPayClient.php");
$xpay = &new XPayClient($configPath, $LGD_PLATFORM);
$xpay->Init_TX($LGD_MID);
$LGD_HASHDATA = md5($LGD_MID.$LGD_OID.$LGD_AMOUNT.$LGD_TIMESTAMP.$xpay->config[$LGD_MID]);

$payReqMap = array();
$payReqMap['CST_PLATFORM'] = $pg['serviceType'];							// LG���÷��� ���� ���� ����(test:�׽�Ʈ, service:����)
$payReqMap['LGD_WINDOW_TYPE'] = 'iframe';									// �����Ұ�
$payReqMap['CST_MID'] = $pg['id'];											// �������̵�(LG���÷������� ���� �߱޹����� �������̵� �Է��ϼ��� - �׽�Ʈ ���̵�� 't'�� �ݵ�� �����ϰ� �Է��ϼ���.)
$payReqMap['LGD_MID'] = $LGD_MID;											// �������̵�(�ڵ����� - �׽�Ʈ �ΰ�� �ڵ����� �տ� t�� ����)
$payReqMap['LGD_OID'] = $LGD_OID;											// �ֹ���ȣ
$payReqMap['LGD_AMOUNT'] = $LGD_AMOUNT;										// �����ݾ�("," �� ������ �����ݾ��� �Է��ϼ���)
$payReqMap['LGD_BUYER'] = $_POST['nameOrder'];								// �����ڸ�
$payReqMap['LGD_PRODUCTINFO'] = $ordnm;										// ��ǰ��
$payReqMap['LGD_BUYEREMAIL'] = $_POST['email'];								// ������ �̸���
$payReqMap['LGD_CUSTOM_SKIN'] = $pg['skin'];								// �������� ����â ��Ų
$payReqMap['LGD_CUSTOM_PROCESSTYPE'] = 'TWOTR';								// Ʈ����� ó����� (TWOTR : ���� ��� ���� �帧, ONETR : �񵿱� ��� ���� �帧)
$payReqMap['LGD_TIMESTAMP'] = $LGD_TIMESTAMP;								// Ÿ�ӽ�����
$payReqMap['LGD_VERSION'] = 'PHP_2.5';										// �������� (�������� ������)
$payReqMap['LGD_WINDOW_VER'] = '2.5';										// �������� (�������� ������)
$payReqMap['LGD_HASHDATA'] = $LGD_HASHDATA;									// MD5 �ؽ���ȣ��
$payReqMap['LGD_CUSTOM_FIRSTPAY'] = $arrSettlekind[$_POST['settlekind']];	// �������� �ʱ��������
$payReqMap['LGD_CUSTOM_USABLEPAY'] = $arrSettlekind[$_POST['settlekind']];	// ����Ʈ ��������
$payReqMap['LGD_CUSTOM_SWITCHINGTYPE'] = 'IFRAME';							// �ſ�ī�� ī��� ���� ������ ���� ���
$payReqMap['LGD_ACTIVEXYN'] = 'N';											// ActiveX ��� ����

if( $_POST['settlekind'] == 'c') {
	$payReqMap['LGD_INSTALLRANGE'] = $pg['quota'];							// �Һΰ��� ����
	$payReqMap['LGD_NOINTINF'] = $pg['zerofee_period'];						// ������ �Һ�(������ �����δ�) ���� : Ư��ī��/Ư�����������ڼ���
}

if( $_POST['settlekind'] == 'o' || $_POST['settlekind'] == 'v' ) {
	$payReqMap['LGD_CASHRECEIPTYN'] = ($pg['receipt'] != 'Y'?'N':'Y');		// ���ݿ����� �̻�뿩��(Y:���,N:�̻��)
}

$payReqMap['LGD_ESCROW_USEYN'] = $_POST['escrow'];							// ����ũ�� ���� : ����(Y),������(N)
if ($payReqMap['LGD_ESCROW_USEYN'] == 'Y') {
	// ��ǰ������ �������� �� �ش� �ʵ带 �ߺ��ؼ� ��� (5���� ����ũ�� �ʵ带 �ݵ�� �ѽ����� ����)
	$payReqMap['LGD_ESCROW_GOODS'] = array();
	foreach($cart->item as $row) {
		$payReqMap['LGD_ESCROW_GOODS'][] = array(
			'LGD_ESCROW_GOODID' => $row['goodsno'],									// ����ũ�λ�ǰ��ȣ
			'LGD_ESCROW_GOODNAME' => pg_text_replace(strip_tags($row['goodsnm'])),	// ����ũ�λ�ǰ��
			'LGD_ESCROW_GOODCODE' => '',											// ����ũ�λ�ǰ�ڵ�
			'LGD_ESCROW_UNITPRICE' => ($row['price']+$row['addprice']),				// ����ũ�λ�ǰ����
			'LGD_ESCROW_QUANTITY' => $row['ea'],									// ����ũ�λ�ǰ����
		);
	}
	if($_POST['zonecode']){
		$payReqMap['LGD_ESCROW_ZIPCODE'] = $_POST['zonecode'];					// ����ũ�ι����������ȣ (�������ȣ)
		$payReqMap['LGD_ESCROW_ADDRESS1'] = $_POST['road_address'];				// ����ũ�ι�����ּҵ����� (���θ��ּ�)
	}
	else {
		$payReqMap['LGD_ESCROW_ZIPCODE'] = implode('-',$_POST['zipcode']);		// ����ũ�ι���������ȣ
		$payReqMap['LGD_ESCROW_ADDRESS1'] = $_POST['address'];					// ����ũ�ι�����ּҵ�����
	}
	$payReqMap['LGD_ESCROW_ADDRESS2'] = $_POST['address_sub'];					// ����ũ�ι�����ּһ�
	$payReqMap['LGD_ESCROW_BUYERPHONE'] = implode('-',$_POST['mobileOrder']);	// ����ũ�α������޴�����ȣ
}

/*
 *************************************************
 * 3. ��� ����
 *************************************************
 */
if( $_POST['settlekind'] == 'v'){
	// �������(������) ���������� �Ͻô� ���  �Ҵ�/�Ա� ����� �뺸�ޱ� ���� �ݵ�� LGD_CASNOTEURL ������ LG ���÷����� �����ؾ� �մϴ� .
	$payReqMap['LGD_CASNOTEURL'] = $LGD_CASNOTEURL;	// ������� NOTEURL
}

// LGD_RETURNURL �� �����Ͽ� �ֽñ� �ٶ��ϴ�. �ݵ�� ���� �������� ������ ����Ʈ�� ��  ȣ��Ʈ�̾�� �մϴ�. �Ʒ� �κ��� �ݵ�� �����Ͻʽÿ�.
$payReqMap['LGD_RETURNURL'] = $LGD_RETURNURL;	// �������������

// Return URL���� ���� ��� ���� �� ���õ� �Ķ���� �Դϴ�.*/
$payReqMap['LGD_RESPCODE'] = '';
$payReqMap['LGD_RESPMSG'] = '';
$payReqMap['LGD_PAYKEY'] = '';

// ó�� ���������� ��ȿ�� üũ�� ���� ��� ������ ���ǿ� ����
$_SESSION['PAYREQ_MAP'] = $payReqMap;

$tpl->assign('LGD',$payReqMap);
?>