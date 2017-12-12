<?php
/**
 * LG 유플러스 PG 모듈
 * 원본 파일명 payreq_crossplatform.php
 * LG 유플러스 PG 버전 : LG U+ 표준결제창 2.5 - SmartXPay(V1.2 - 20141212)
 */

// 기본 설정 정보
include "../conf/pg.lgdacom.php";
@include "../conf/pg.escrow.php";

// LG유플러스 아이디 처리
if (empty($pg['serviceType'])) {
	$pg['serviceType'] = 'service';
}
if ($pg['serviceType'] == 'test') {
	$LGD_MID = 't'.$pg['id'];
} else {
	$LGD_MID = $pg['id'];
}

// 상품명 처리
if (!preg_match('/mypage/',$_SERVER['SCRIPT_NAME'])) {
	$item = $cart->item;
}
foreach ($item as $v) {
	$i++;
	if($i == 1) $ordnm = $v['goodsnm'];
}

//상품명에 특수문자 및 태그 제거
$ordnm = pg_text_replace(strip_tags($ordnm));
if ($i > 1) $ordnm .= " 외".($i-1)."건";

// 무이자 여부 (Y:1 / N:0)
if ($pg['zerofee'] == 'yes') {
	$pg['zerofee'] = '1';
} else {
	$pg['zerofee'] = '0';
}

// 무이자 할부 설정
if ($pg['zerofee'] == '0') {
	$pg['zerofee_period'] = '';
}

// 결제수단 설정
$arrSettlekind =array(
	'c' => 'SC0010',
	'o' => 'SC0030',
	'v' => 'SC0040',
	'h' => 'SC0060',
);

/*
 * 1. 기본결제 인증요청 정보 변경
 * 
 * 기본정보를 변경하여 주시기 바랍니다.(파라미터 전달시 POST를 사용하세요)
 */
$configPath = $_SERVER['DOCUMENT_ROOT'].$cfg['rootDir'].'/conf/lgdacom';		// LG유플러스에서 제공한 환경파일("/conf/lgdacom.conf") 위치 지정.
$lguplusReturnUrl = ProtocolPortDomain().$cfg['rootDir'].'/order/card/lgdacom';	// LG유플러스 리턴 URL 공통
$LGD_MID = $LGD_MID;							//상점아이디(자동생성)
$LGD_OID = $_POST['ordno'];						//주문번호(상점정의 유니크한 주문번호를 입력하세요)
$LGD_AMOUNT = $_POST['settleprice'];			//결제금액("," 를 제외한 결제금액을 입력하세요)
$LGD_TIMESTAMP = date(YmdHms);					//타임스탬프

/*
 * 가상계좌(무통장) 결제 연동을 하시는 경우 아래 LGD_CASNOTEURL 을 설정하여 주시기 바랍니다.
 */
$LGD_CASNOTEURL = $lguplusReturnUrl.'/cas_noteurl.php';	// 가상계좌 NOTEURL

/*
 * LGD_RETURNURL 을 설정하여 주시기 바랍니다. 반드시 현재 페이지와 동일한 프로트콜 및  호스트이어야 합니다. 아래 부분을 반드시 수정하십시요.
 */
$LGD_RETURNURL = $lguplusReturnUrl.'/returnurl.php';

/*
 *************************************************
 * 2. MD5 해쉬암호화 (수정하지 마세요) - BEGIN
 * 
 * MD5 해쉬암호화는 거래 위변조를 막기위한 방법입니다.
 *************************************************
 *
 * 해쉬 암호화 적용( LGD_MID + LGD_OID + LGD_AMOUNT + LGD_TIMESTAMP + LGD_MERTKEY )
 * LGD_MID			: 상점아이디
 * LGD_OID			: 주문번호
 * LGD_AMOUNT		: 금액
 * LGD_TIMESTAMP	: 타임스탬프
 * LGD_MERTKEY		: 상점MertKey (mertkey는 상점관리자 -> 계약정보 -> 상점정보관리에서 확인하실수 있습니다)
 * MD5 해쉬데이터 암호화 검증을 위해
 * LG유플러스에서 발급한 상점키(MertKey)를 환경설정 파일(lgdacom/conf/mall.conf)에 반드시 입력하여 주시기 바랍니다.
 */
require_once(dirname(__FILE__)."/XPayClient.php");
$xpay = &new XPayClient($configPath, $LGD_PLATFORM);
$xpay->Init_TX($LGD_MID);
$LGD_HASHDATA = md5($LGD_MID.$LGD_OID.$LGD_AMOUNT.$LGD_TIMESTAMP.$xpay->config[$LGD_MID]);

$payReqMap = array();
$payReqMap['CST_PLATFORM'] = $pg['serviceType'];							// LG유플러스 결제 서비스 선택(test:테스트, service:서비스)
$payReqMap['LGD_WINDOW_TYPE'] = 'iframe';									// 수정불가
$payReqMap['CST_MID'] = $pg['id'];											// 상점아이디(LG유플러스으로 부터 발급받으신 상점아이디를 입력하세요 - 테스트 아이디는 't'를 반드시 제외하고 입력하세요.)
$payReqMap['LGD_MID'] = $LGD_MID;											// 상점아이디(자동생성 - 테스트 인경우 자동으로 앞에 t를 붙임)
$payReqMap['LGD_OID'] = $LGD_OID;											// 주문번호
$payReqMap['LGD_AMOUNT'] = $LGD_AMOUNT;										// 결제금액("," 를 제외한 결제금액을 입력하세요)
$payReqMap['LGD_BUYER'] = $_POST['nameOrder'];								// 구매자명
$payReqMap['LGD_PRODUCTINFO'] = $ordnm;										// 상품명
$payReqMap['LGD_BUYEREMAIL'] = $_POST['email'];								// 구매자 이메일
$payReqMap['LGD_CUSTOM_SKIN'] = $pg['skin'];								// 상점정의 결제창 스킨
$payReqMap['LGD_CUSTOM_PROCESSTYPE'] = 'TWOTR';								// 트랜잭션 처리방식 (TWOTR : 동기 방식 결제 흐름, ONETR : 비동기 방식 결제 흐름)
$payReqMap['LGD_TIMESTAMP'] = $LGD_TIMESTAMP;								// 타임스탬프
$payReqMap['LGD_VERSION'] = 'PHP_2.5';										// 버전정보 (삭제하지 마세요)
$payReqMap['LGD_WINDOW_VER'] = '2.5';										// 버전정보 (삭제하지 마세요)
$payReqMap['LGD_HASHDATA'] = $LGD_HASHDATA;									// MD5 해쉬암호값
$payReqMap['LGD_CUSTOM_FIRSTPAY'] = $arrSettlekind[$_POST['settlekind']];	// 상점정의 초기결제수단
$payReqMap['LGD_CUSTOM_USABLEPAY'] = $arrSettlekind[$_POST['settlekind']];	// 디폴트 결제수단
$payReqMap['LGD_CUSTOM_SWITCHINGTYPE'] = 'IFRAME';							// 신용카드 카드사 인증 페이지 연동 방식
$payReqMap['LGD_ACTIVEXYN'] = 'N';											// ActiveX 사용 여부

if( $_POST['settlekind'] == 'c') {
	$payReqMap['LGD_INSTALLRANGE'] = $pg['quota'];							// 할부개월 범위
	$payReqMap['LGD_NOINTINF'] = $pg['zerofee_period'];						// 무이자 할부(수수료 상점부담) 적용 : 특정카드/특정개월무이자셋팅
}

if( $_POST['settlekind'] == 'o' || $_POST['settlekind'] == 'v' ) {
	$payReqMap['LGD_CASHRECEIPTYN'] = ($pg['receipt'] != 'Y'?'N':'Y');		// 현금영수증 미사용여부(Y:사용,N:미사용)
}

$payReqMap['LGD_ESCROW_USEYN'] = $_POST['escrow'];							// 에스크로 여부 : 적용(Y),미적용(N)
if ($payReqMap['LGD_ESCROW_USEYN'] == 'Y') {
	// 상품정보가 복수개일 때 해당 필드를 중복해서 사용 (5개의 에스크로 필드를 반드시 한쌍으로 적용)
	$payReqMap['LGD_ESCROW_GOODS'] = array();
	foreach($cart->item as $row) {
		$payReqMap['LGD_ESCROW_GOODS'][] = array(
			'LGD_ESCROW_GOODID' => $row['goodsno'],									// 에스크로상품번호
			'LGD_ESCROW_GOODNAME' => pg_text_replace(strip_tags($row['goodsnm'])),	// 에스크로상품명
			'LGD_ESCROW_GOODCODE' => '',											// 에스크로상품코드
			'LGD_ESCROW_UNITPRICE' => ($row['price']+$row['addprice']),				// 에스크로상품가격
			'LGD_ESCROW_QUANTITY' => $row['ea'],									// 에스크로상품수량
		);
	}
	if($_POST['zonecode']){
		$payReqMap['LGD_ESCROW_ZIPCODE'] = $_POST['zonecode'];					// 에스크로배송지구역번호 (새우편번호)
		$payReqMap['LGD_ESCROW_ADDRESS1'] = $_POST['road_address'];				// 에스크로배송지주소동까지 (도로명주소)
	}
	else {
		$payReqMap['LGD_ESCROW_ZIPCODE'] = implode('-',$_POST['zipcode']);		// 에스크로배송지우편번호
		$payReqMap['LGD_ESCROW_ADDRESS1'] = $_POST['address'];					// 에스크로배송지주소동까지
	}
	$payReqMap['LGD_ESCROW_ADDRESS2'] = $_POST['address_sub'];					// 에스크로배송지주소상세
	$payReqMap['LGD_ESCROW_BUYERPHONE'] = implode('-',$_POST['mobileOrder']);	// 에스크로구매자휴대폰번호
}

/*
 *************************************************
 * 3. 경로 설정
 *************************************************
 */
if( $_POST['settlekind'] == 'v'){
	// 가상계좌(무통장) 결제연동을 하시는 경우  할당/입금 결과를 통보받기 위해 반드시 LGD_CASNOTEURL 정보를 LG 유플러스에 전송해야 합니다 .
	$payReqMap['LGD_CASNOTEURL'] = $LGD_CASNOTEURL;	// 가상계좌 NOTEURL
}

// LGD_RETURNURL 을 설정하여 주시기 바랍니다. 반드시 현재 페이지와 동일한 프로트콜 및  호스트이어야 합니다. 아래 부분을 반드시 수정하십시요.
$payReqMap['LGD_RETURNURL'] = $LGD_RETURNURL;	// 응답수신페이지

// Return URL에서 인증 결과 수신 시 셋팅될 파라미터 입니다.*/
$payReqMap['LGD_RESPCODE'] = '';
$payReqMap['LGD_RESPMSG'] = '';
$payReqMap['LGD_PAYKEY'] = '';

// 처리 페이지에서 유효성 체크를 위한 모든 변수를 세션에 저장
$_SESSION['PAYREQ_MAP'] = $payReqMap;

$tpl->assign('LGD',$payReqMap);
?>