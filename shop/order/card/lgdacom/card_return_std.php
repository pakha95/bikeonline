<?php
/**
 * LG ���÷��� PG ���
 * ���� ���ϸ� payres.php
 * LG ���÷��� PG ���� : LG U+ Xpay PHP_2.5 (ǥ�ذ���â 2.5) (V1.0 - 20160625)
 */

// �⺻ ���� ����
include "../../../lib/library.php";
include "../../../conf/config.mobileShop.php";
include "../../../conf/config.php";
include "../../../conf/pg.lgdacom.php";

// ���� ����Ʈ ����
error_reporting(E_ALL ^ E_NOTICE);

// ���� ������ ó��
$order_end_page = $cfg['rootDir'].'/order/order_end.php';
$order_fail_page = $cfg['rootDir'].'/order/order_fail.php';

// �α� ����
if (function_exists('pg_data_log_write')) {
	$logPath = '../../../log/lgdacom/';
	pg_data_log_write($_POST, 'lguplus', $logPath);
}

// PG���� ������ üũ �� ��ȿ�� üũ
if (function_exists('forge_order_check')) {
	// PG���� ������ üũ �� ��ȿ�� üũ
	if (forge_order_check($_POST['LGD_OID'],$_POST['LGD_AMOUNT']) === false) {
		msg('�ֹ� ������ ���� ������ ���� �ʽ��ϴ�. �ٽ� ���� �ٶ��ϴ�.','../../order_fail.php?ordno='.$_POST['LGD_OID'],'parent');
		exit();
	}
}

// �⺻�� ����
$configPath = $_SERVER['DOCUMENT_ROOT'].$cfg['rootDir'].'/conf/lgdacom';	// LG���÷������� ������ ȯ������("/conf/lgdacom.conf") ��ġ ����.

// LG���÷��� ���̵� ó��
if (empty($pg['serviceType'])) {
	$pg['serviceType'] = 'service';
}
if ($pg['serviceType'] == 'test') {
	$LGD_MID = 't'.$pg['id'];
} else {
	$LGD_MID = $pg['id'];
}

$CST_PLATFORM = $pg['serviceType'];
$CST_MID = $pg['id'];
$LGD_PAYKEY = $_POST['LGD_PAYKEY'];

require_once("./XPayClient.php");
$xpay = &new XPayClient($configPath, $CST_PLATFORM);

$xpay->Init_TX($LGD_MID);

$xpay->Set('LGD_TXNAME', 'PaymentByKey');
$xpay->Set('LGD_PAYKEY', $LGD_PAYKEY);

// �ݾ��� üũ�Ͻñ� ���ϴ� ��� �Ʒ� �ּ��� Ǯ� �̿��Ͻʽÿ�.
// $DB_AMOUNT = 'DB�� ���ǿ��� ������ �ݾ�'; //�ݵ�� �������� �Ұ����� ��(DB�� ����)���� �ݾ��� �������ʽÿ�.
// $xpay->Set('LGD_AMOUNTCHECKYN', 'Y');
// $xpay->Set('LGD_AMOUNT', $DB_AMOUNT);

// �ֹ���ȣ
$LGD_OID = $_POST['LGD_OID'];

// ������ ���� ó�� API ����
if ($xpay->TX()) {
	// �����
	$Response_Code = $xpay->Response_Code();
	$Response_Msg = $xpay->Response_Msg();

	// LG ���÷������� ���� ������� ���� Ű�̸��� ������ ������ ó���� ��
	$tmp = array();
	$tmp_ArrLGResult = $xpay->Response_Names();
	foreach ($tmp_ArrLGResult as $name) {
		$tmp[$name] = $xpay->Response($name, 0);
	}
	extract($tmp);
	unset($tmp);
	unset($tmp_ArrLGResult);

	if ($xpay->Response_Code() == '0000') {
		$isSuccess = true;
	} else {
		$resultMSG = '��������';
	}
} else {
	// API ��û���� ȭ��ó��
	$resultMSG = '��������';
	$resultMSG .= '������û�� �����Ͽ����ϴ�.  <br>';
	$resultMSG .= 'TX Response_code = ' . $xpay->Response_Code() . '<br>';
	$resultMSG .= 'TX Response_msg = ' . $xpay->Response_Msg() . '<p>';
}

/*
 *************************************************
 * 3. ���� �α� ó��
 *************************************************
 */
$ordno = $LGD_OID;	// �ֹ���ȣ

// ���� ����
if ($LGD_PAYTYPE=='SC0010') $payTypeStr = "�ſ�ī��";
if ($LGD_PAYTYPE=='SC0030') $payTypeStr = "������ü";
if ($LGD_PAYTYPE=='SC0040') $payTypeStr = "�������";
if ($LGD_PAYTYPE=='SC0060') $payTypeStr = "�ڵ���";

// ���� �α� ó��
$tmp_log = array();
$tmp_log[] = "LG U+ Xpay PHP_2.5 (ǥ�ذ���â 2.5) ������û�� ���� ���";
if ($Response_Code) $tmp_log[] = "TX Response_code : ".$Response_Code;
if ($Response_Msg) $tmp_log[] = "TX Response_msg : ".$Response_Msg;
$tmp_log[] = "����ڵ� : ".$LGD_RESPCODE." (0000(����) �׿� ����)";
if ($LGD_PAYTYPE=='SC0040' && $LGD_RESPCODE =='0000') {
	$tmp_log[] = "������� : �����Ҵ� ����\n";
}
else {
	$tmp_log[] = "������� : ".$LGD_RESPMSG."\n".$resultMSG;
}
$tmp_log[] = "�ؽ�����Ÿ : ".$LGD_HASHDATA;
$tmp_log[] = "�����ݾ� : ".$LGD_AMOUNT;
$tmp_log[] = "�������̵� : ".$LGD_MID;
$tmp_log[] = "�ŷ���ȣ : ".$LGD_TID;
$tmp_log[] = "�ֹ���ȣ : ".$LGD_OID;
$tmp_log[] = "������� : ".$payTypeStr;
$tmp_log[] = "�����Ͻ� : ".$LGD_PAYDATE;
$tmp_log[] = "�ŷ���ȣ : ".$LGD_TID;
$tmp_log[] = "����ũ�� ���� ���� : ".$LGD_ESCROWYN;
$tmp_log[] = "��������ڵ� : ".$LGD_FINANCECODE;
$tmp_log[] = "��������� : ".$LGD_FINANCENAME;

switch ($LGD_PAYTYPE) {
	case "SC0010":	// �ſ�ī��
		$tmp_log[] = "����������ι�ȣ : ".$LGD_FINANCEAUTHNUM;
		$tmp_log[] = "�ſ�ī���Һΰ��� : ".$LGD_CARDINSTALLMONTH;
		$tmp_log[] = "�ſ�ī�幫���ڿ��� : ".$LGD_CARDNOINTYN." (1:������, 0:�Ϲ�)";
		$settlekind = 'c';
		break;
	case "SC0030":	// ������ü
		if ($LGD_CASHRECEIPTNUM)	$tmp_log[] = "���ݿ��������ι�ȣ : ".$LGD_CASHRECEIPTNUM;
		if ($LGD_CASHRECEIPTSELFYN)	$tmp_log[] = "���ݿ����������߱������� : ".$LGD_CASHRECEIPTSELFYN." (Y: �����߱�)";
		if ($LGD_CASHRECEIPTKIND)	$tmp_log[] = "���ݿ��������� : ".$LGD_CASHRECEIPTKIND." (0:�ҵ����, 1:��������)";
		if ($LGD_ACCOUNTOWNER)		$tmp_log[] = "���¼������̸� : ".$LGD_ACCOUNTOWNER;
		$settlekind = 'o';
		break;
	case "SC0040":	// �������
		if ($LGD_CASHRECEIPTNUM)	$tmp_log[] = "���ݿ��������ι�ȣ : ".$LGD_CASHRECEIPTNUM;
		if ($LGD_CASHRECEIPTSELFYN)	$tmp_log[] = "���ݿ����������߱������� : ".$LGD_CASHRECEIPTSELFYN." (Y: �����߱�)";
		if ($LGD_CASHRECEIPTKIND)	$tmp_log[] = "���ݿ��������� : ".$LGD_CASHRECEIPTKIND." (0:�ҵ����, 1:��������)";
		if ($LGD_ACCOUNTNUM)		$tmp_log[] = "������¹߱޹�ȣ : ".$LGD_ACCOUNTNUM;
		if ($LGD_PAYER)				$tmp_log[] = "��������Ա��ڸ� : ".$LGD_PAYER;
		if ($LGD_CASTAMOUNT)		$tmp_log[] = "�Աݴ����ݾ� : ".$LGD_CASTAMOUNT;
		if ($LGD_CASCAMOUNT)		$tmp_log[] = "���Աݱݾ� : ".$LGD_CASCAMOUNT;
		if ($LGD_CASFLAG)			$tmp_log[] = "�ŷ����� : ".$LGD_CASFLAG." (R:�Ҵ�,I:�Ա�,C:���)";
		if ($LGD_CASSEQNO)			$tmp_log[] = "��������Ϸù�ȣ : ".$LGD_CASSEQNO;
		$settlekind = 'v';
		break;
	case "SC0060":	// �ڵ���
		$settlekind = 'h';
		break;
}

// ���� ���� �α� ����
$settlelog = "{$ordno} (" . date('Y:m:d H:i:s') . ")\n----------------------------------------------------\n" . implode( "\n", $tmp_log ) . "\n----------------------------------------------------\n";
unset($tmp_log);

/*
 *************************************************
 * 4. DB ó��
 *************************************************
 */

// ���ں������� �߱�
@session_start();
if (session_is_registered('eggData') === true && $xpay->Response_Code() == "0000" ){
	if ($_SESSION[eggData][ordno] == $ordno && $_SESSION[eggData][resno1] != '' && $_SESSION[eggData][resno2] != '' && $_SESSION[eggData][agree] == 'Y'){
		include '../../../lib/egg.class.usafe.php';
		$eggData = $_SESSION[eggData];
		switch ($xpay->Response("LGD_PAYTYPE",0)){
			case "SC0010":
				$eggData[payInfo1] = $LGD_FINANCENAME; # (*) ��������(ī���)
				$eggData[payInfo2] = $LGD_FINANCEAUTHNUM; # (*) ��������(���ι�ȣ)
				break;
			case "SC0030":
				$eggData[payInfo1] = $LGD_FINANCENAME; # (*) ��������(�����)
				$eggData[payInfo2] = $LGD_TID; # (*) ��������(���ι�ȣ or �ŷ���ȣ)
				break;
			case "SC0040":
				$eggData[payInfo1] = $LGD_FINANCENAME; # (*) ��������(�����)
				$eggData[payInfo2] = $LGD_ACCOUNTNUM; # (*) ��������(���¹�ȣ)
				break;
		}
		$eggCls = new Egg( 'create', $eggData );
	}
	session_unregister('eggData');
}

// ������� ������ ��� üũ �ܰ� ����
$res_cstock = true;
if ($cfg['stepStock'] == '1' && $xpay->Response("LGD_PAYTYPE",0) == "SC0040") $res_cstock = false;

// ���üũ
include "../../../lib/cardCancel.class.php";
$cancel = new cardCancel();
if (!$cancel->chk_item_stock($ordno) && $res_cstock) {
	$step = 51;
	msg('�ش� ��ǰ�� ��� �����Ͽ� �ֹ��� �Ϸ���� �ʾҽ��ϴ�. �������� �� �ڵ����� ��Ұ� ���� �ʴ´ٸ�, �����ڿ��� �����Ͽ� �ֽñ� �ٶ��ϴ�.');
}

// �ֹ� ����
$oData = $db->fetch("SELECT step, vAccount FROM ".GD_ORDER." WHERE ordno='".$ordno."'");

// �ߺ� ���� üũ
if ($oData['step'] > 0 || $oData['vAccount'] != '' || !strcmp($LGD_RESPCODE,'S007')) {
	// �α� ����
	$db->query("UPDATE ".GD_ORDER." SET settlelog=CONCAT(IFNULL(settlelog,''),'".$settlelog."') WHERE ordno='".$ordno."'");

	// DB ó���� �̵��� ������
	$goUrl = $order_end_page.'?ordno='.$ordno.'&card_nm='.$LGD_FINANCENAME;
}
// ��������
else if ($isSuccess === true && $step != 51) {
	// �ֹ� ������ ����
	$query = "SELECT * FROM ".GD_ORDER." a LEFT JOIN ".GD_LIST_BANK." b ON a.bankAccount = b.sno WHERE a.ordno='".$ordno."'";
	$data = $db->fetch($query);

	// ����ũ�� ���� Ȯ��
	if ($LGD_ESCROWYN == 'Y') {
		$escrowyn = 'y';
		$escrowno = $LGD_TID;
	}
	else {
		$escrowyn = 'n';
		$escrowno = '';
	}

	// ���� ���� ����
	$step = 1;
	$qrc1 = "cyn='y', cdt=now(), cardtno='".$LGD_TID."', settlekind='".$settlekind."',";
	$qrc2 = "cyn='y',";

	// ������� ������ �������� ����
	if ($LGD_PAYTYPE == 'SC0040') {
		$vAccount = $LGD_FINANCENAME.' '.$LGD_ACCOUNTNUM.' '.$LGD_PAYER;
		$step = 0;
		$qrc1 = '';
		$qrc2 = '';
	}

	// ���ݿ����� ���� ����
	if ($LGD_CASHRECEIPTNUM) {
		$qrc1 .= "cashreceipt='".$LGD_CASHRECEIPTNUM."',";
	}

	// �ֹ� ������ ������Ʈ
	$db->query("
	UPDATE ".GD_ORDER." SET ".$qrc1."
		step		= '".$step."',
		step2		= '',
		escrowyn	= '".$escrowyn."',
		escrowno	= '".$escrowno."',
		vAccount	= '".$vAccount."',
		settlelog	= CONCAT(IFNULL(settlelog,''),'".$settlelog."')
	WHERE ordno='".$ordno."'"
	);

	// �ֹ� ��ǰ ������ ������Ʈ
	$db->query("UPDATE ".GD_ORDER_ITEM." SET ".$qrc2." istep='".$step."' WHERE ordno='".$ordno."'");

	// �ֹ��α� ����
	orderLog($ordno,$r_step2[$data[step2]]." > ".$r_step[$step]);

	// ��� ó��
	setStock($ordno);

	// ��ǰ���Խ� ������ ���
	if ($data['m_no'] && $data['emoney']) {
		setEmoney($data['m_no'],-$data['emoney'],"��ǰ���Խ� ������ ���� ���",$ordno);
	}

	// �ֹ�Ȯ�θ���
	if(function_exists('getMailOrderData')) {
		sendMailCase($data['email'],0,getMailOrderData($ordno));
	}

	// SMS ���� ����
	$dataSms = $data;

	// ��Ȳ�� SMS / Email ����
	if ($LGD_PAYTYPE != 'SC0040') {
		sendMailCase($data['email'],1,$data);		// �Ա�Ȯ�� ����
		sendSmsCase('incash',$data['mobileOrder']);	// �Ա�Ȯ�� SMS
	} else {
		sendSmsCase('order',$data['mobileOrder']);	// �ֹ�Ȯ�� SMS
	}

	// DB ó���� �̵��� ������
	$goUrl = $order_end_page.'?ordno='.$ordno.'&card_nm='.$LGD_FINANCENAME;
}
// ��������
else {
	if ($step == '51') {
		$cancel->cancel_db_proc($ordno);
	}
	else {
		// ���п� ���� �ֹ� ����Ÿ�� �α� ������Ʈ
		$db->query("UPDATE ".GD_ORDER." SET step2=54, settlelog=CONCAT(IFNULL(settlelog,''),'".$settlelog."') WHERE ordno='".$ordno."' AND step2=50");
		$db->query("UPDATE ".GD_ORDER_ITEM." SET istep=54 WHERE ordno='".$ordno."' AND istep=50");
	}

	// DB ó���� �̵��� ������
	$goUrl = $order_fail_page.'?ordno='.$ordno;
}

go($goUrl);
?>