<?php

$db = Core::loader('db');
$config = Core::loader('config');
$shopConfig = $config->load('config');
$godoConfig = $config->load('godo');

/**
 * 부가서비스
 */
$additionalMap = array();

// C1. 전자결제 서비스
if ($shopConfig['settlePg']) {
	@include_once $ShopRoot.'/conf/pg.'.$shopConfig['settlePg'].'.php';
	if ($pg['id'] != '') {
		$use_pg = true;
	}
	else {
		$use_pg = false;
	}
}
else {
	$use_pg = false;
}
$paymentGateService = array();
$paymentGateService['Name'] = '전자결제 서비스';
if ($use_pg) {
	$paymentGateService['Enabled'] = true;
	$paymentGateService['URL'] = '../basic/pg.php';
}
else {
	$paymentGateService['URL'] = '../basic/pg.intro.php';
}
$additionalMap[] = $paymentGateService;

// C2. 구매안전 서비스
@include_once $ShopRoot.'/lib/lib.func.egg.php';
if (function_exists('getEggConf') === true) {
	$egg = getEggConf();
}
else {
	$egg = array(
	    'use' => 'N'
	);
}
@include $ShopRoot.'/conf/pg.escrow.php';
$safetyPurchaseService = array();
$safetyPurchaseService['Name'] = '구매안전 서비스';
if($egg['use'] == 'Y' || $escrow['use'] == 'Y'){
	$safetyPurchaseService['Enabled'] = true;
	if ($escrow['use'] == 'Y') {
		$safetyPurchaseService['URL'] = '../basic/pg.php';
	}
	else {
		$safetyPurchaseService['URL'] = '../egg.progress.php';
	}
}
else {
	$safetyPurchaseService['URL'] = '../basic/egg.intro.php';
}
$additionalMap[] = $safetyPurchaseService;

// C3. 무통장자동입금확인
$bankAutoChk[0]	= sprintf("GODO%05d",$godoConfig['sno']);
$bankAutoChk[1]	= readurl("http://bankmatch.godo.co.kr/sock_ismid.php?MID=".$bankAutoChk[0]."&hashdata=" . md5($bankAutoChk[0]));
$accountDepositAutoCheck = array();
$accountDepositAutoCheck['Name'] = '무통장자동입금확인';
if ($bankAutoChk[1] == 'true') {
	$accountDepositAutoCheck['Enabled'] = true;
	$accountDepositAutoCheck['URL'] = '../order/bankda.php';
}
else {
	$accountDepositAutoCheck['URL'] = '../order/bankmatch.intro.php';
}
$additionalMap[] = $accountDepositAutoCheck;

// C4. 포장박스/봉투
$packingService = array();
$packingService['Name'] = '포장박스/봉투';
if (false) {
	$packingService['Enabled'] = true;
	$packingService['URL'] = 'http://www.godo.co.kr/service/box_service.php';
}
else {
	$packingService['URL'] = 'http://www.godo.co.kr/service/box_service.php';
}
$additionalMap[] = $packingService;

// C5. 휴대폰본인인증
$hpauthService = array();
$hpauthService['Name'] = '휴대폰본인인증';
if (file_exists($ShopRoot.'/lib/Hpauth.class.php')) {
	$hpauth = Core::loader('Hpauth');
	$hpauthConfig = $hpauth->loadCurrentServiceConfig();
}
else {
	$hpauthConfig = array(
	    'useyn' => 'n'
	);
}
if ($hpauthConfig['useyn'] == 'y') {
	$hpauthService['Enabled'] = true;
	$hpauthService['URL'] = '../member/adm_member_auth.hpauth.php';
}
else {
	$hpauthService['URL'] = '../member/adm_member_auth.hpauthDream.info.php';
}
$additionalMap[] = $hpauthService;

// C6. 아이핀 본인확인
include $ShopRoot.'/conf/fieldset.php';
$ipinService = array();
$ipinService['Name'] = '아이핀 본인확인';
if ($ipin['nice_useyn'] == 'y') {
	$ipinService['Enabled'] = true;
	$ipinService['URL'] = '../member/ipin_new.php';
}
else if ($ipin['useyn'] == 'y') {
	$ipinService['Enabled'] = true;
	$ipinService['URL'] = '../member/ipin.php';
}
else {
	$ipinService['URL'] = '../member/realname_info.php';
}
$additionalMap[] = $ipinService;

// C7. SMS
$smsService = array();
$smsService['Name'] = 'SMS';
if (getSmsPoint() > 0) {
	$smsService['Enabled'] = true;
	$smsService['URL'] = '../member/sms.pay.php';
}
else {
	$smsService['URL'] = '../member/sms.intro.php';
}
$additionalMap[] = $smsService;

// C8. 파워메일
$powerMail = array();
$powerMail['Name'] = '파워메일';
if (file_exists($ShopRoot.'/conf/amail.set.php')) {
	$powerMail['Enabled'] = true;
	$powerMail['URL'] = '../member/power.mail.php';
}
else {
	$powerMail['URL'] = '../member/set.amail.php';
}
$additionalMap[] = $powerMail;

// C9. 통합콜센터 CTI
$ctiService = array();
$ctiService['Name'] = '통합콜센터 CTI';
if (false) {
	$ctiService['Enabled'] = true;
	$ctiService['URL'] = 'http://www.godo.co.kr/service/smartcti_info.php';
}
else {
	$ctiService['URL'] = 'http://www.godo.co.kr/service/smartcti_info.php';
}
$additionalMap[] = $ctiService;

// C10. 모바일콜센터
$mobileCallCenter = array();
$mobileCallCenter['Name'] = '모바일콜센터';
if (false) {
	$mobileCallCenter['Enabled'] = true;
	$mobileCallCenter['URL'] = 'http://www.godo.co.kr/service/mobilecti_info.php';
}
else {
	$mobileCallCenter['URL'] = 'http://www.godo.co.kr/service/mobilecti_info.php';
}
$additionalMap[] = $mobileCallCenter;

// C11. 에이스카운터
@include $ShopRoot.'/conf/config.acecounter.php'; 
$aceCounterService = array();
$aceCounterService['Name'] = '에이스카운터';
if ($acecounter['status_use'] == 'Y') {
	$aceCounterService['Enabled'] = true;
	$aceCounterService['URL'] = '../acecounter/acecounter_con.php';
}
else {
	$aceCounterService['URL'] = '../acecounter/acecounter_info.php';
}
$additionalMap[] = $aceCounterService;

// C12. 웹폰트
list($cntWebfont) = $db->fetch("SELECT COUNT(*) FROM gd_webfont");
$webFontService = array();
$webFontService['Name'] = '웹폰트';
if ($cntWebfont > 0) {
	$webFontService['Enabled'] = true;
	$webFontService['URL'] = '../design/codi.php?ifrmCodiHref=iframe.webfont.buy.php';
}
else {
	$webFontService['URL'] = '../design/codi.php?ifrmCodiHref=iframe.webfont.intro.php';
}
$additionalMap[] = $webFontService;

// C13. 촬영장비
$photographingService = array();
$photographingService['Name'] = '촬영장비';
if (false) {
	$photographingService['Enabled'] = true;
	$photographingService['URL'] = 'http://camera.godo.co.kr/shop/main/index.php';
}
else {
	$photographingService['URL'] = 'http://camera.godo.co.kr/shop/main/index.php';
}
$additionalMap[] = $photographingService;

// C14. 상품촬영이미지제작
$makeProductImage = array();
$makeProductImage['Name'] = '상품촬영이미지제작';
if (false) {
	$makeProductImage['Enabled'] = true;
	$makeProductImage['URL'] = 'http://www.godo.co.kr/service/photograph/index.html';
}
else {
	$makeProductImage['URL'] = 'http://www.godo.co.kr/service/photograph/index.html';
}
$additionalMap[] = $makeProductImage;

// C15. 디테일뷰
$detailView = array();
$detailView['Name'] = '디테일뷰';
if (false) {
	$detailView['Enabled'] = true;
	$detailView['URL'] = 'http://www.godo.co.kr/service/detail_view.php';
}
else {
	$detailView['URL'] = 'http://www.godo.co.kr/service/detail_view.php';
}
$additionalMap[] = $detailView;

// C16. 보안서버
$sslService = array();
$sslService['Name'] = '보안서버';
if ($shopConfig['ssl']) {
	$sslService['Enabled'] = true;
	$sslService['URL'] = 'http://hosting.godo.co.kr/valueadd/ssl_service.php';
}
else {
	$sslService['URL'] = 'http://hosting.godo.co.kr/valueadd/ssl_service.php';
}
$additionalMap[] = $sslService;


/**
 * 마케팅 서비스
 */
$marketingMap = array();

// C1. 통합 키워드 광고
$keywordAdvertise = array();
$keywordAdvertise['Name'] = '통합 키워드 광고';
if (false) {
	$keywordAdvertise['Enabled'] = true;
	$keywordAdvertise['URL'] = '../keyword/register.php';
}
else {
	$keywordAdvertise['URL'] = '../keyword/register.php';
}
$marketingMap[] = $keywordAdvertise;

// C2. 네이버 지식쇼핑
@include $ShopRoot.'/conf/partner.php';
$naverShopping = array();
$naverShopping['Name'] = '네이버 쇼핑';
if ($partner['useYn'] == 'y') {
	$naverShopping['Enabled'] = true;
	$naverShopping['URL'] = '../naver/partner.php';
}
else {
	$naverShopping['URL'] = '../naver/naver.php';
}
$marketingMap[] = $naverShopping;

// C3. 네이버 페이
@include $ShopRoot.'/conf/naverCheckout.cfg.php';
$naverCheckout = array();
$naverCheckout['Name'] = '네이버 페이';
if ($checkoutCfg['useYn'] == 'y') {
	$naverCheckout['Enabled'] = true;
	$naverCheckout['URL'] = '../naverCheckout/partner.php';
}
else {
	$naverCheckout['URL'] = '../naverCheckout/info.php';
}
$marketingMap[] = $naverCheckout;

// C4. 네이버 마일리지
// 서비스 종료 2015-07-30

// C5. 다음 쇼핑하우
@include $ShopRoot.'/conf/daumCpc.cfg.php';
$daumShoppingHow = array();
$daumShoppingHow['Name'] = '다음 쇼핑하우';
if ($daumCpc['useYN'] == 'Y') {
	$daumShoppingHow['Enabled'] = true;
	$daumShoppingHow['URL'] = '../daumcpc/partner.php';
}
else {
	$daumShoppingHow['URL'] = '../daumcpc/info.php';
}
$marketingMap[] = $daumShoppingHow;

// C6. 크리테오 광고
@include $ShopRoot.'/conf/criteo.cfg.php';
$criteoService = array();
$criteoService['Name'] = '크리테오 광고';
if ($criteo) {
	$criteoService['Enabled'] = true;
	$criteoService['URL'] = '../criteo/criteo.php';
}
else {
	$criteoService['URL'] = '../criteo/info.php';
}
$marketingMap[] = $criteoService;

// C7. 바이럴 마케팅
$viralMarketing = array();
$viralMarketing['Name'] = '바이럴 마케팅';
if (false) {
	$viralMarketing['Enabled'] = true;
	$viralMarketing['URL'] = '../keyword/viral.php';
}
else {
	$viralMarketing['URL'] = '../keyword/viral.php';
}
$marketingMap[] = $viralMarketing;

// C8. 다음 모바일 쇼핑박스
$daumShoppingBox = array();
$daumShoppingBox['Name'] = '다음 모바일 쇼핑박스';
if (false) {
	$daumShoppingBox['Enabled'] = true;
	$daumShoppingBox['URL'] = '../daumcpc/shoppingbox_mobile.php';
}
else {
	$daumShoppingBox['URL'] = '../daumcpc/shoppingbox_mobile.php';
}
$marketingMap[] = $daumShoppingBox;