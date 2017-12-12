<?php
/**
 * LG 유플러스 PG 모듈
 * 원본 파일명 payres.php
 * LG 유플러스 PG 버전 : LG U+ Xpay PHP_2.5 (표준결제창 2.5) (V1.0 - 20160625)
 */

// 기본 설정 정보
include "../../../lib/library.php";
include "../../../conf/config.mobileShop.php";
include "../../../conf/config.php";
include "../../../conf/pg.lgdacom.php";

// 에러 리포트 수정
error_reporting(E_ALL ^ E_NOTICE);

// 리턴 페이지 처리
$order_end_page = $cfg['rootDir'].'/order/order_end.php';
$order_fail_page = $cfg['rootDir'].'/order/order_fail.php';

// 로그 저장
if (function_exists('pg_data_log_write')) {
	$logPath = '../../../log/lgdacom/';
	pg_data_log_write($_POST, 'lguplus', $logPath);
}

// PG결제 위변조 체크 및 유효성 체크
if (function_exists('forge_order_check')) {
	// PG결제 위변조 체크 및 유효성 체크
	if (forge_order_check($_POST['LGD_OID'],$_POST['LGD_AMOUNT']) === false) {
		msg('주문 정보와 결제 정보가 맞질 않습니다. 다시 결제 바랍니다.','../../order_fail.php?ordno='.$_POST['LGD_OID'],'parent');
		exit();
	}
}

// 기본값 설정
$configPath = $_SERVER['DOCUMENT_ROOT'].$cfg['rootDir'].'/conf/lgdacom';	// LG유플러스에서 제공한 환경파일("/conf/lgdacom.conf") 위치 지정.

// LG유플러스 아이디 처리
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

// 금액을 체크하시기 원하는 경우 아래 주석을 풀어서 이용하십시요.
// $DB_AMOUNT = 'DB나 세션에서 가져온 금액'; //반드시 위변조가 불가능한 곳(DB나 세션)에서 금액을 가져오십시요.
// $xpay->Set('LGD_AMOUNTCHECKYN', 'Y');
// $xpay->Set('LGD_AMOUNT', $DB_AMOUNT);

// 주문번호
$LGD_OID = $_POST['LGD_OID'];

// 동기방식 결제 처리 API 실행
if ($xpay->TX()) {
	// 결과값
	$Response_Code = $xpay->Response_Code();
	$Response_Msg = $xpay->Response_Msg();

	// LG 유플러스에서 결제 결과값을 전부 키이름과 동일한 변수로 처리를 함
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
		$resultMSG = '결제실패';
	}
} else {
	// API 요청실패 화면처리
	$resultMSG = '결제실패';
	$resultMSG .= '결제요청이 실패하였습니다.  <br>';
	$resultMSG .= 'TX Response_code = ' . $xpay->Response_Code() . '<br>';
	$resultMSG .= 'TX Response_msg = ' . $xpay->Response_Msg() . '<p>';
}

/*
 *************************************************
 * 3. 결제 로그 처리
 *************************************************
 */
$ordno = $LGD_OID;	// 주문번호

// 결제 수단
if ($LGD_PAYTYPE=='SC0010') $payTypeStr = "신용카드";
if ($LGD_PAYTYPE=='SC0030') $payTypeStr = "계좌이체";
if ($LGD_PAYTYPE=='SC0040') $payTypeStr = "가상계좌";
if ($LGD_PAYTYPE=='SC0060') $payTypeStr = "핸드폰";

// 결제 로그 처리
$tmp_log = array();
$tmp_log[] = "LG U+ Xpay PHP_2.5 (표준결제창 2.5) 결제요청에 대한 결과";
if ($Response_Code) $tmp_log[] = "TX Response_code : ".$Response_Code;
if ($Response_Msg) $tmp_log[] = "TX Response_msg : ".$Response_Msg;
$tmp_log[] = "결과코드 : ".$LGD_RESPCODE." (0000(성공) 그외 실패)";
if ($LGD_PAYTYPE=='SC0040' && $LGD_RESPCODE =='0000') {
	$tmp_log[] = "결과내용 : 계좌할당 성공\n";
}
else {
	$tmp_log[] = "결과내용 : ".$LGD_RESPMSG."\n".$resultMSG;
}
$tmp_log[] = "해쉬데이타 : ".$LGD_HASHDATA;
$tmp_log[] = "결제금액 : ".$LGD_AMOUNT;
$tmp_log[] = "상점아이디 : ".$LGD_MID;
$tmp_log[] = "거래번호 : ".$LGD_TID;
$tmp_log[] = "주문번호 : ".$LGD_OID;
$tmp_log[] = "결제방법 : ".$payTypeStr;
$tmp_log[] = "결제일시 : ".$LGD_PAYDATE;
$tmp_log[] = "거래번호 : ".$LGD_TID;
$tmp_log[] = "에스크로 적용 여부 : ".$LGD_ESCROWYN;
$tmp_log[] = "결제기관코드 : ".$LGD_FINANCECODE;
$tmp_log[] = "결제기관명 : ".$LGD_FINANCENAME;

switch ($LGD_PAYTYPE) {
	case "SC0010":	// 신용카드
		$tmp_log[] = "결제기관승인번호 : ".$LGD_FINANCEAUTHNUM;
		$tmp_log[] = "신용카드할부개월 : ".$LGD_CARDINSTALLMONTH;
		$tmp_log[] = "신용카드무이자여부 : ".$LGD_CARDNOINTYN." (1:무이자, 0:일반)";
		$settlekind = 'c';
		break;
	case "SC0030":	// 계좌이체
		if ($LGD_CASHRECEIPTNUM)	$tmp_log[] = "현금영수증승인번호 : ".$LGD_CASHRECEIPTNUM;
		if ($LGD_CASHRECEIPTSELFYN)	$tmp_log[] = "현금영수증자진발급제유무 : ".$LGD_CASHRECEIPTSELFYN." (Y: 자진발급)";
		if ($LGD_CASHRECEIPTKIND)	$tmp_log[] = "현금영수증종류 : ".$LGD_CASHRECEIPTKIND." (0:소득공제, 1:지출증빙)";
		if ($LGD_ACCOUNTOWNER)		$tmp_log[] = "계좌소유주이름 : ".$LGD_ACCOUNTOWNER;
		$settlekind = 'o';
		break;
	case "SC0040":	// 가상계좌
		if ($LGD_CASHRECEIPTNUM)	$tmp_log[] = "현금영수증승인번호 : ".$LGD_CASHRECEIPTNUM;
		if ($LGD_CASHRECEIPTSELFYN)	$tmp_log[] = "현금영수증자진발급제유무 : ".$LGD_CASHRECEIPTSELFYN." (Y: 자진발급)";
		if ($LGD_CASHRECEIPTKIND)	$tmp_log[] = "현금영수증종류 : ".$LGD_CASHRECEIPTKIND." (0:소득공제, 1:지출증빙)";
		if ($LGD_ACCOUNTNUM)		$tmp_log[] = "가상계좌발급번호 : ".$LGD_ACCOUNTNUM;
		if ($LGD_PAYER)				$tmp_log[] = "가상계좌입금자명 : ".$LGD_PAYER;
		if ($LGD_CASTAMOUNT)		$tmp_log[] = "입금누적금액 : ".$LGD_CASTAMOUNT;
		if ($LGD_CASCAMOUNT)		$tmp_log[] = "현입금금액 : ".$LGD_CASCAMOUNT;
		if ($LGD_CASFLAG)			$tmp_log[] = "거래종류 : ".$LGD_CASFLAG." (R:할당,I:입금,C:취소)";
		if ($LGD_CASSEQNO)			$tmp_log[] = "가상계좌일련번호 : ".$LGD_CASSEQNO;
		$settlekind = 'v';
		break;
	case "SC0060":	// 핸드폰
		$settlekind = 'h';
		break;
}

// 최종 결제 로그 내용
$settlelog = "{$ordno} (" . date('Y:m:d H:i:s') . ")\n----------------------------------------------------\n" . implode( "\n", $tmp_log ) . "\n----------------------------------------------------\n";
unset($tmp_log);

/*
 *************************************************
 * 4. DB 처리
 *************************************************
 */

// 전자보증보험 발급
@session_start();
if (session_is_registered('eggData') === true && $xpay->Response_Code() == "0000" ){
	if ($_SESSION[eggData][ordno] == $ordno && $_SESSION[eggData][resno1] != '' && $_SESSION[eggData][resno2] != '' && $_SESSION[eggData][agree] == 'Y'){
		include '../../../lib/egg.class.usafe.php';
		$eggData = $_SESSION[eggData];
		switch ($xpay->Response("LGD_PAYTYPE",0)){
			case "SC0010":
				$eggData[payInfo1] = $LGD_FINANCENAME; # (*) 결제정보(카드사)
				$eggData[payInfo2] = $LGD_FINANCEAUTHNUM; # (*) 결제정보(승인번호)
				break;
			case "SC0030":
				$eggData[payInfo1] = $LGD_FINANCENAME; # (*) 결제정보(은행명)
				$eggData[payInfo2] = $LGD_TID; # (*) 결제정보(승인번호 or 거래번호)
				break;
			case "SC0040":
				$eggData[payInfo1] = $LGD_FINANCENAME; # (*) 결제정보(은행명)
				$eggData[payInfo2] = $LGD_ACCOUNTNUM; # (*) 결제정보(계좌번호)
				break;
		}
		$eggCls = new Egg( 'create', $eggData );
	}
	session_unregister('eggData');
}

// 가상계좌 결제의 재고 체크 단계 설정
$res_cstock = true;
if ($cfg['stepStock'] == '1' && $xpay->Response("LGD_PAYTYPE",0) == "SC0040") $res_cstock = false;

// 재고체크
include "../../../lib/cardCancel.class.php";
$cancel = new cardCancel();
if (!$cancel->chk_item_stock($ordno) && $res_cstock) {
	$step = 51;
	msg('해당 상품의 재고가 부족하여 주문이 완료되지 않았습니다. 결제승인 후 자동으로 취소가 되지 않는다면, 관리자에게 문의하여 주시기 바랍니다.');
}

// 주문 정보
$oData = $db->fetch("SELECT step, vAccount FROM ".GD_ORDER." WHERE ordno='".$ordno."'");

// 중복 결제 체크
if ($oData['step'] > 0 || $oData['vAccount'] != '' || !strcmp($LGD_RESPCODE,'S007')) {
	// 로그 저장
	$db->query("UPDATE ".GD_ORDER." SET settlelog=CONCAT(IFNULL(settlelog,''),'".$settlelog."') WHERE ordno='".$ordno."'");

	// DB 처리후 이동할 페이지
	$goUrl = $order_end_page.'?ordno='.$ordno.'&card_nm='.$LGD_FINANCENAME;
}
// 결제성공
else if ($isSuccess === true && $step != 51) {
	// 주문 데이터 추출
	$query = "SELECT * FROM ".GD_ORDER." a LEFT JOIN ".GD_LIST_BANK." b ON a.bankAccount = b.sno WHERE a.ordno='".$ordno."'";
	$data = $db->fetch($query);

	// 에스크로 여부 확인
	if ($LGD_ESCROWYN == 'Y') {
		$escrowyn = 'y';
		$escrowno = $LGD_TID;
	}
	else {
		$escrowyn = 'n';
		$escrowno = '';
	}

	// 결제 정보 쿼리
	$step = 1;
	$qrc1 = "cyn='y', cdt=now(), cardtno='".$LGD_TID."', settlekind='".$settlekind."',";
	$qrc2 = "cyn='y',";

	// 가상계좌 결제시 계좌정보 쿼리
	if ($LGD_PAYTYPE == 'SC0040') {
		$vAccount = $LGD_FINANCENAME.' '.$LGD_ACCOUNTNUM.' '.$LGD_PAYER;
		$step = 0;
		$qrc1 = '';
		$qrc2 = '';
	}

	// 현금영수증 정보 쿼리
	if ($LGD_CASHRECEIPTNUM) {
		$qrc1 .= "cashreceipt='".$LGD_CASHRECEIPTNUM."',";
	}

	// 주문 데이터 업데이트
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

	// 주문 상품 데이터 업데이트
	$db->query("UPDATE ".GD_ORDER_ITEM." SET ".$qrc2." istep='".$step."' WHERE ordno='".$ordno."'");

	// 주문로그 저장
	orderLog($ordno,$r_step2[$data[step2]]." > ".$r_step[$step]);

	// 재고 처리
	setStock($ordno);

	// 상품구입시 적립금 사용
	if ($data['m_no'] && $data['emoney']) {
		setEmoney($data['m_no'],-$data['emoney'],"상품구입시 적립금 결제 사용",$ordno);
	}

	// 주문확인메일
	if(function_exists('getMailOrderData')) {
		sendMailCase($data['email'],0,getMailOrderData($ordno));
	}

	// SMS 변수 설정
	$dataSms = $data;

	// 상황별 SMS / Email 전송
	if ($LGD_PAYTYPE != 'SC0040') {
		sendMailCase($data['email'],1,$data);		// 입금확인 메일
		sendSmsCase('incash',$data['mobileOrder']);	// 입금확인 SMS
	} else {
		sendSmsCase('order',$data['mobileOrder']);	// 주문확인 SMS
	}

	// DB 처리후 이동할 페이지
	$goUrl = $order_end_page.'?ordno='.$ordno.'&card_nm='.$LGD_FINANCENAME;
}
// 결제실패
else {
	if ($step == '51') {
		$cancel->cancel_db_proc($ordno);
	}
	else {
		// 실패에 대한 주문 데이타와 로그 업데이트
		$db->query("UPDATE ".GD_ORDER." SET step2=54, settlelog=CONCAT(IFNULL(settlelog,''),'".$settlelog."') WHERE ordno='".$ordno."' AND step2=50");
		$db->query("UPDATE ".GD_ORDER_ITEM." SET istep=54 WHERE ordno='".$ordno."' AND istep=50");
	}

	// DB 처리후 이동할 페이지
	$goUrl = $order_fail_page.'?ordno='.$ordno;
}

go($goUrl);
?>