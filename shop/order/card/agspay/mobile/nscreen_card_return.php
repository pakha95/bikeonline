<?php
/********************************************************************************
*
* AGSMobile V2.0
*
* �ô�����Ʈ ����� ���� ������ (EUC-KR)
*
********************************************************************************/

include "../../../../lib/library.php";
include "../../../../conf/config.php";
include "../../../../conf/pg.agspay.php";
include "../../../../conf/config.mobileShop.php";
require_once ("./lib/AGSMobile.php");

$page_type = $_GET['page_type'];

if($page_type=='mobile') {
	$order_end_page = $cfgMobileShop['mobileShopRootDir'].'/ord/order_end.php';
	$order_fail_page = $cfgMobileShop['mobileShopRootDir'].'/ord/order_fail.php';
}
else {
	$order_end_page = $cfg['rootDir'].'/order/order_end.php';
	$order_fail_page = $cfg['rootDir'].'/order/order_fail.php';
}

function iconvArray($data)
{
	if(is_array($data)){
		return array_map('iconvArray', $data); 
	}
	else {
		return iconv("UTF-8", "EUC-KR", $data);
	}
}
$banks = array(
	'39' => '�泲����',
	'34' => '��������',
	'04' => '��������',
	'03' => '�������',
	'11' => '����',
	'31' => '�뱸����',
	'32' => '�λ�����',
	'02' => '�������',
	'45' => '�������ݰ�',
	'07' => '����',
	'88' => '��������',
	'48' => '����',
	'05' => '��ȯ����',
	'20' => '�츮����',
	'71' => '��ü��',
	'37' => '��������',
	'35' => '��������',
	'81' => '�ϳ�����',
	'27' => '�ѱ���Ƽ����',
	'23' => 'SC����',
	'09' => '��������',
	'78' => '���ѱ�����������',
	'40' => '�Ｚ����',
	'30' => '�̷���������',
	'43' => '�ѱ���������',
	'69' => '��ȭ����',
);
$cards = array(
	'0100' => '��',
	'0202' => '����',
	'0203' => '�ѹ�',
	'0205' => '�츮',
	'0206' => '��Ƽ',
	'0207' => '�ż����ѹ�',
	'0302' => '����',
	'0303' => '����',
	'0200' => 'KB����',
	'0201' => 'NH',
	'0300' => '�ϳ�(�� ��ȯ)',
	'0700' => '�ؿ�JCB', // �¶��ΰŷ� �Ұ�
	'1000' => '�ؿ�visa', // �¶��ΰŷ� �Ұ�
	'1100' => '�ؿ�master', // �¶��ΰŷ� �Ұ�
	'0310' => '�ϳ�',
	'0400' => '�Ｚ',
	'0901' => '�ؿ�AMEX', // �¶��ΰŷ� �Ұ�
	'0500' => '����',
	'0301' => '����',
	'0800' => '����',
	'0208' => '����üũ',
	'0801' => '�ؿ�Diners', // �¶��ΰŷ� �Ұ�
	'0110' => '�ؿ�����', // �¶��ΰŷ� �Ұ�
	'0900' => '�Ե�',
);

$log_path = '/../../../../../log/agspay/log';
// log���� ������ ������ ��θ� �����մϴ�.
// ����� ���� null�� �Ǿ����� ��� "���� �۾� ���丮�� /lib/log/"�� ����˴ϴ�.

$agsMobile = new AGSMobile($_REQUEST["StoreId"], $_REQUEST["tracking_id"], $_REQUEST["transaction"], $log_path);
$agsMobile->setLogging(true); //true : �αױ��, false : �αױ�Ͼ���.

////////////////////////////////////////////////////////
//
// getTrackingInfo() �� ���� �ô�����Ʈ �������� ȣ���� �� ���� �ߴ� Form ������ Array()�� ����Ǿ� �ֽ��ϴ�.
//
////////////////////////////////////////////////////////

$info = $agsMobile->getTrackingInfo(); //$info ������ array() �����Դϴ�.
if(is_array($info)){
	$info = array_map('iconvArray', $info);
}

/////////////////////////////////////////////////////////////////////////////////
//	-- tracking_info�� ����ִ� �÷� --
//
//	������� : AuthTy (card,hp,virtual)
//	���������� : SubTy (ī���� ��� ���� : isp,visa3d)
//
//	ȸ�����̵� : UserId
//	�������̸� : OrdNm
//	�����̸� : StoreNm
//	������� : Job
//	��ǰ�� : ProdNm
//
//	�޴�����ȣ : OrdPhone
//	�����ڸ� : RcpNm
//	�����ڿ���ó : RcpPhone
//	�ֹ����ּ� : OrdAddr
//	�ֹ���ȣ : OrdNo
//	������ּ� : DlvAddr
//	��ǰ�ڵ� : ProdCode
//	�Աݿ����� : VIRTUAL_DEPODT
//	��ǰ���� : HP_UNITType
//	���� URL : RtnUrl
//	�������̵� : StoreId
//	���� : Amt
//	�̸��� : UserEmail
//	����URL : MallUrl
//	��� URL : CancelUrl
//	�뺸������ : MallPage
//
//	��Ÿ�䱸���� : Remark
//	�߰�����ʵ�1 : Column1
//	�߰�����ʵ�1 : Column2
//	�߰�����ʵ�1 : Column3
//	CP���̵� : HP_ID
//	CP��й�ȣ :  HP_PWD
//	SUB-CP���̵� : HP_SUBID
//	��ǰ�ڵ� :  ProdCode
//	�������� : DeviId ( 9000400001:�Ϲݰ���, 9000400002:�����ڰ���)
//	ī��缱�� : CardSelect
//	�ҺαⰣ :  QuotaInf
//	������ �ҺαⰣ: NointInf
//
////////////////////////////////////////////////////////////////////////////////////////////////

// tracking_info�� �������� �Ʒ��� ������� �������ø� �˴ϴ�
//
//	print_r($info); //tracking_info
//	echo "�ֹ���ȣ : ".$info["OrdNo"]."</br>";
//	echo "��ǰ�� : ".$info["ProdNm"]."</br>";
//	echo "������� : ".$info["Job"]."</br>";
//	echo "ȸ�����̵� : ".$info["UserId"]."</br>";
//	echo "�������̸� : ".$info["OrdNm"]."</br>";
////////////////////////////////////////////////////////////////////////////////////////////////


// PG���� ������ üũ �� ��ȿ�� üũ
if (forge_order_check($info['OrdNo'], $info['Amt']) === false) {
	msg('�ֹ� ������ ���� ������ ���� �ʽ��ϴ�. �ٽ� ���� �ٶ��ϴ�.', $order_fail_page.'?ordno='.$info['OrdNo'], 'parent');
	exit();
}

// �ô�����Ʈ ���������� ���� ��û
$ret = $agsMobile->approve();
if($ret['message']){
	$ret['message'] = iconv("UTF-8", "EUC-KR", $ret['message']);
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
// ��������� ���� ����DB ���� �� ��Ÿ �ʿ��� ó���۾��� �����ϴ� �κ��Դϴ�.
// �Ʒ��� ��������� ���Ͽ� �� �������ܺ� ����������� ����Ͻ� �� �ֽ��ϴ�.
//
// $ret�� array() �������� ������ ���� ������ �����ϴ�.
//
// $ret = array (
//	   'status' => 'ok' | 'error' //���μ����� ��� ok , ���и� error
//		  'message' => '������ ��� �����޽���'
//		  'data' => �������ܺ� ���� array() //���μ����� ��츸 ���õ˴ϴ�.
//	)
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//�ֹ���ȣ
$ordno = $info['OrdNo'];

//�α�
$tmp = '';
if ($info['AuthTy'] == 'card') {
	if ($info['SubTy'] == 'isp') {
		$tmp = '�ſ�ī�����-��������(ISP)';
	} else if($info['SubTy'] == 'visa3d') {
		$tmp = '�ſ�ī�����-�Ƚ�Ŭ��';
	} else if($info['SubTy'] == 'normal') {
		$tmp = '�ſ�ī�����-�Ϲݰ���';
	}
} else if($info['AuthTy'] == 'hp') {
	$tmp = '�ڵ�������';
} else if($info['AuthTy'] == 'virtual') {
	$tmp = '������°���';
}

$tmp_log = array();
$tmp_log[] = '�������� : '.$tmp;
$tmp_log[] = '�������̵� : '.$info['StoreId'];
$tmp_log[] = '�ֹ���ȣ : '.$info['OrdNo'];
$tmp_log[] = '�ֹ��ڸ� : '.$info['OrdNm'];
$tmp_log[] = '��ǰ�� : '.$info['ProdNm'];
$tmp_log[] = '�����ݾ� : '.$info['Amt'];
$tmp_log[] = '�������� : '.$ret['status'];
$tmp_log[] = '������� : '.$ret['message'];
switch($info['AuthTy']){
	case 'card' :
		if($ret["data"]["CardCd"] && !$cards[$ret["data"]["CardCd"]]) $card_nm = $ret["data"]["CardNm"];

		$tmp_log[] = '���νð� : '.$ret["data"]['AdmTime'];
		$card_nm = $cards[$ret["data"]["CardCd"]];
		$tmp_log[] = '�����ڵ� : '.$ret["data"]["BusiCd"];
		$tmp_log[] = '���ι�ȣ : '.$ret["data"]["AdmNo"];
		$tmp_log[] = 'ī����ڵ� : '.$ret["data"]["CardCd"].'('.$card_nm.')';
		$tmp_log[] = '�ŷ���ȣ : '.$ret["data"]["DealNo"];
		$tmp_log[] = '����ũ�ο��� : '.$ret["data"]["EscrowYn"];  //y�̸� escrow
		$tmp_log[] = '����ũ��������ȣ : '.$ret["data"]["EscrowSendNo"];
		$tmp_log[] = '�����ڿ���: '.$ret["data"]["NoInt"];  //y�̸� ������
	break;

	case 'hp' :
		$tmp_log[] = '���νð� : '.$ret["data"]['AdmTime'];
		$tmp_log[] = '�ڵ�������TID : '.$ret["data"]["AdmTID"];
		$tmp_log[] = '�ڵ��������ڵ�����ȣ : '.$ret["data"]["Phone"];
		$tmp_log[] = '�ڵ���������Ż�� : '.$ret["data"]["PhoneCompany"];
	break;

	case 'virtual' :
		$tmp_log[] = '���νð� : '.$ret["data"]['SuccessTime'];
		$bank_nm = $banks[$ret["data"]["BankCode"]];
		$tmp_log[] = '������¹�ȣ : '.$ret["data"]["VirtualNo"];
		$tmp_log[] = '������������ڵ� : ' . $bank_nm;
		$tmp_log[] = '�Աݱ��� : '.$ret["data"]["DueDate"];
		$tmp_log[] = '����ũ�ο��� : '.$ret["data"]["EscrowYn"];  //y�̸� escrow
		$tmp_log[] = '����ũ��������ȣ : '.$ret["data"]["EscrowSendNo"];
	break;
}

$settlelog = $ordno." (" . date('Y:m:d H:i:s') . ")\n-----------------------------------\n" . implode( "\n", $tmp_log ) . "\n-----------------------------------\n";

//DB(����&����) ó��
$oData = $db->fetch("select step, vAccount from ".GD_ORDER." where ordno='".$ordno."'");

// �ߺ�����
if ($oData['step'] > 0 || $oData['vAccount'] != '') {
	$db->query("UPDATE ".GD_ORDER." SET settlelog=concat(ifnull(settlelog,''),'".$settlelog."') WHERE ordno='".$ordno."'");
	go($order_end_page . '?ordno='.$ordno.'&card_nm='.$card_nm);
	exit;
}

//item check stock
if($info['AuthTy'] != 'virtual'){
	include '../../../../lib/cardCancel.class.php';
	$cancel = new cardCancel();
	if(!$cancel->chk_item_stock($ordno)){
		$cancel->cancel_db_proc($ordno);
		go($order_fail_page . '?ordno='.$ordno, 'parent');
		exit;
	}
}

// ���� ����
if($ret['status'] == 'ok'){
	$query = "SELECT * FROM ".GD_ORDER." a LEFT JOIN ".GD_LIST_BANK." b ON a.bankAccount = b.sno WHERE a.ordno='".$ordno."'";
	$data = $db->fetch($query);

	//����ũ�� ���� Ȯ��
	if ($ret["data"]["EscrowYn"] == 'y') {
		$escrowyn = 'y';
		$escrowno = $ret["data"]["EscrowSendNo"];
	} else {
		$escrowyn = 'n';
		$escrowno = '';
	}

	//���� ���� ����
	$step = 1;
	$qrc1 = "cyn='y', cdt=now(),";
	$qrc2 = "cyn='y',";

	//���ݿ����� ����
	if (strpos($ret["message"], '���ݿ��������༺��') !== false) {
		$qrc1 .= "cashreceipt='pg-agspay',";
	}

	//PG���� ����
	switch($info['AuthTy']){
		//�ſ�ī��
		case 'card':
			$qrc1 .= "
				cardtno		= '".$ret["data"]["DealNo"]."',
				pgAppNo		= '".$ret["data"]["AdmNo"]."',
				pgCardCd		= '".$ret["data"]["CardCd"]."',
				pgAppDt		= '".$ret["data"]['AdmTime']."',
			";
		break;

		//�������
		case 'virtual':
			$step = 0;
			$qrc1 = $qrc2 = '';
			//������°����� ��� �Ա��� �Ϸ���� ���� �Աݴ�����(������� �߱޼���)�̹Ƿ� ��ǰ�� ����Ͻø� �ȵ˴ϴ�.
			$vAccount = $bank_nm.' '.$ret["data"]["VirtualNo"].' '.$ret['StoreNm'];
			$qrc1 .= "
				pgAppDt		= '".$ret["data"]['SuccessTime']."',
			";
		break;

		//�޴�������
		case 'hp':
			$qrc1 .= "
				cardtno		= '".$ret["data"]["AdmTID"]."',
				pgAppDt		= '".$ret["data"]['AdmTime']."',
			";
		break;
	}

	//�ǵ���Ÿ ����
	$db->query("
		UPDATE ".GD_ORDER." SET ".$qrc1."
			step		= '".$step."',
			step2		= '',
			escrowyn	= '".$escrowyn."',
			escrowno	= '".$escrowno."',
			vAccount	= '".$vAccount."',
			settlelog	= concat(ifnull(settlelog,''),'".$settlelog."')
		WHERE ordno='".$ordno."'"
	);
	$db->query("UPDATE ".GD_ORDER_ITEM." SET ".$qrc2." istep='".$step."' WHERE ordno='".$ordno."'");

	//�ֹ��α� ����
	orderLog($ordno, $r_step2[$data['step2']]." > ".$r_step[$step]);

	//��� ó��
	setStock($ordno);

	//��ǰ���Խ� ������ ���
	if ($data['m_no'] && $data['emoney']) {
		setEmoney($data['m_no'], -$data['emoney'], '��ǰ���Խ� ������ ���� ���', $ordno);
	}

	//�ֹ�Ȯ�θ���
	if(function_exists('getMailOrderData')){
		sendMailCase($data['email'], 0, getMailOrderData($ordno));
	}

	//SMS ���� ����
	$dataSms = $data;

	if ($info['AuthTy'] != 'virtual') {
		//�Ա�Ȯ�θ���
		sendMailCase($data['email'], 1, $data);
		//�Ա�Ȯ��SMS
		sendSmsCase('incash', $data['mobileOrder']);
	} else {
		//�ֹ�Ȯ��SMS
		sendSmsCase('order', $data['mobileOrder']);
	}

	go($order_end_page . '?ordno='.$ordno.'&card_nm='.$card_nm);

}
else {
	// ���� ����
	$db->query("UPDATE ".GD_ORDER." SET step2='54', settlelog=concat(ifnull(settlelog,''),'".$settlelog."') WHERE ordno='".$ordno."'");
	$db->query("UPDATE ".GD_ORDER_ITEM." SET istep='54' WHERE ordno='".$ordno."'");

	go($order_fail_page . '?ordno='.$ordno, 'parent');
}
?>