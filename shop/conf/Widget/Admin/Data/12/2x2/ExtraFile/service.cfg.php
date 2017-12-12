<?php

$db = Core::loader('db');
$config = Core::loader('config');
$shopConfig = $config->load('config');
$godoConfig = $config->load('godo');

/**
 * �ΰ�����
 */
$additionalMap = array();

// C1. ���ڰ��� ����
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
$paymentGateService['Name'] = '���ڰ��� ����';
if ($use_pg) {
	$paymentGateService['Enabled'] = true;
	$paymentGateService['URL'] = '../basic/pg.php';
}
else {
	$paymentGateService['URL'] = '../basic/pg.intro.php';
}
$additionalMap[] = $paymentGateService;

// C2. ���ž��� ����
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
$safetyPurchaseService['Name'] = '���ž��� ����';
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

// C3. �������ڵ��Ա�Ȯ��
$bankAutoChk[0]	= sprintf("GODO%05d",$godoConfig['sno']);
$bankAutoChk[1]	= readurl("http://bankmatch.godo.co.kr/sock_ismid.php?MID=".$bankAutoChk[0]."&hashdata=" . md5($bankAutoChk[0]));
$accountDepositAutoCheck = array();
$accountDepositAutoCheck['Name'] = '�������ڵ��Ա�Ȯ��';
if ($bankAutoChk[1] == 'true') {
	$accountDepositAutoCheck['Enabled'] = true;
	$accountDepositAutoCheck['URL'] = '../order/bankda.php';
}
else {
	$accountDepositAutoCheck['URL'] = '../order/bankmatch.intro.php';
}
$additionalMap[] = $accountDepositAutoCheck;

// C4. ����ڽ�/����
$packingService = array();
$packingService['Name'] = '����ڽ�/����';
if (false) {
	$packingService['Enabled'] = true;
	$packingService['URL'] = 'http://www.godo.co.kr/service/box_service.php';
}
else {
	$packingService['URL'] = 'http://www.godo.co.kr/service/box_service.php';
}
$additionalMap[] = $packingService;

// C5. �޴�����������
$hpauthService = array();
$hpauthService['Name'] = '�޴�����������';
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

// C6. ������ ����Ȯ��
include $ShopRoot.'/conf/fieldset.php';
$ipinService = array();
$ipinService['Name'] = '������ ����Ȯ��';
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

// C8. �Ŀ�����
$powerMail = array();
$powerMail['Name'] = '�Ŀ�����';
if (file_exists($ShopRoot.'/conf/amail.set.php')) {
	$powerMail['Enabled'] = true;
	$powerMail['URL'] = '../member/power.mail.php';
}
else {
	$powerMail['URL'] = '../member/set.amail.php';
}
$additionalMap[] = $powerMail;

// C9. �����ݼ��� CTI
$ctiService = array();
$ctiService['Name'] = '�����ݼ��� CTI';
if (false) {
	$ctiService['Enabled'] = true;
	$ctiService['URL'] = 'http://www.godo.co.kr/service/smartcti_info.php';
}
else {
	$ctiService['URL'] = 'http://www.godo.co.kr/service/smartcti_info.php';
}
$additionalMap[] = $ctiService;

// C10. ������ݼ���
$mobileCallCenter = array();
$mobileCallCenter['Name'] = '������ݼ���';
if (false) {
	$mobileCallCenter['Enabled'] = true;
	$mobileCallCenter['URL'] = 'http://www.godo.co.kr/service/mobilecti_info.php';
}
else {
	$mobileCallCenter['URL'] = 'http://www.godo.co.kr/service/mobilecti_info.php';
}
$additionalMap[] = $mobileCallCenter;

// C11. ���̽�ī����
@include $ShopRoot.'/conf/config.acecounter.php'; 
$aceCounterService = array();
$aceCounterService['Name'] = '���̽�ī����';
if ($acecounter['status_use'] == 'Y') {
	$aceCounterService['Enabled'] = true;
	$aceCounterService['URL'] = '../acecounter/acecounter_con.php';
}
else {
	$aceCounterService['URL'] = '../acecounter/acecounter_info.php';
}
$additionalMap[] = $aceCounterService;

// C12. ����Ʈ
list($cntWebfont) = $db->fetch("SELECT COUNT(*) FROM gd_webfont");
$webFontService = array();
$webFontService['Name'] = '����Ʈ';
if ($cntWebfont > 0) {
	$webFontService['Enabled'] = true;
	$webFontService['URL'] = '../design/codi.php?ifrmCodiHref=iframe.webfont.buy.php';
}
else {
	$webFontService['URL'] = '../design/codi.php?ifrmCodiHref=iframe.webfont.intro.php';
}
$additionalMap[] = $webFontService;

// C13. �Կ����
$photographingService = array();
$photographingService['Name'] = '�Կ����';
if (false) {
	$photographingService['Enabled'] = true;
	$photographingService['URL'] = 'http://camera.godo.co.kr/shop/main/index.php';
}
else {
	$photographingService['URL'] = 'http://camera.godo.co.kr/shop/main/index.php';
}
$additionalMap[] = $photographingService;

// C14. ��ǰ�Կ��̹�������
$makeProductImage = array();
$makeProductImage['Name'] = '��ǰ�Կ��̹�������';
if (false) {
	$makeProductImage['Enabled'] = true;
	$makeProductImage['URL'] = 'http://www.godo.co.kr/service/photograph/index.html';
}
else {
	$makeProductImage['URL'] = 'http://www.godo.co.kr/service/photograph/index.html';
}
$additionalMap[] = $makeProductImage;

// C15. �����Ϻ�
$detailView = array();
$detailView['Name'] = '�����Ϻ�';
if (false) {
	$detailView['Enabled'] = true;
	$detailView['URL'] = 'http://www.godo.co.kr/service/detail_view.php';
}
else {
	$detailView['URL'] = 'http://www.godo.co.kr/service/detail_view.php';
}
$additionalMap[] = $detailView;

// C16. ���ȼ���
$sslService = array();
$sslService['Name'] = '���ȼ���';
if ($shopConfig['ssl']) {
	$sslService['Enabled'] = true;
	$sslService['URL'] = 'http://hosting.godo.co.kr/valueadd/ssl_service.php';
}
else {
	$sslService['URL'] = 'http://hosting.godo.co.kr/valueadd/ssl_service.php';
}
$additionalMap[] = $sslService;


/**
 * ������ ����
 */
$marketingMap = array();

// C1. ���� Ű���� ����
$keywordAdvertise = array();
$keywordAdvertise['Name'] = '���� Ű���� ����';
if (false) {
	$keywordAdvertise['Enabled'] = true;
	$keywordAdvertise['URL'] = '../keyword/register.php';
}
else {
	$keywordAdvertise['URL'] = '../keyword/register.php';
}
$marketingMap[] = $keywordAdvertise;

// C2. ���̹� ���ļ���
@include $ShopRoot.'/conf/partner.php';
$naverShopping = array();
$naverShopping['Name'] = '���̹� ����';
if ($partner['useYn'] == 'y') {
	$naverShopping['Enabled'] = true;
	$naverShopping['URL'] = '../naver/partner.php';
}
else {
	$naverShopping['URL'] = '../naver/naver.php';
}
$marketingMap[] = $naverShopping;

// C3. ���̹� ����
@include $ShopRoot.'/conf/naverCheckout.cfg.php';
$naverCheckout = array();
$naverCheckout['Name'] = '���̹� ����';
if ($checkoutCfg['useYn'] == 'y') {
	$naverCheckout['Enabled'] = true;
	$naverCheckout['URL'] = '../naverCheckout/partner.php';
}
else {
	$naverCheckout['URL'] = '../naverCheckout/info.php';
}
$marketingMap[] = $naverCheckout;

// C4. ���̹� ���ϸ���
// ���� ���� 2015-07-30

// C5. ���� �����Ͽ�
@include $ShopRoot.'/conf/daumCpc.cfg.php';
$daumShoppingHow = array();
$daumShoppingHow['Name'] = '���� �����Ͽ�';
if ($daumCpc['useYN'] == 'Y') {
	$daumShoppingHow['Enabled'] = true;
	$daumShoppingHow['URL'] = '../daumcpc/partner.php';
}
else {
	$daumShoppingHow['URL'] = '../daumcpc/info.php';
}
$marketingMap[] = $daumShoppingHow;

// C6. ũ���׿� ����
@include $ShopRoot.'/conf/criteo.cfg.php';
$criteoService = array();
$criteoService['Name'] = 'ũ���׿� ����';
if ($criteo) {
	$criteoService['Enabled'] = true;
	$criteoService['URL'] = '../criteo/criteo.php';
}
else {
	$criteoService['URL'] = '../criteo/info.php';
}
$marketingMap[] = $criteoService;

// C7. ���̷� ������
$viralMarketing = array();
$viralMarketing['Name'] = '���̷� ������';
if (false) {
	$viralMarketing['Enabled'] = true;
	$viralMarketing['URL'] = '../keyword/viral.php';
}
else {
	$viralMarketing['URL'] = '../keyword/viral.php';
}
$marketingMap[] = $viralMarketing;

// C8. ���� ����� ���ιڽ�
$daumShoppingBox = array();
$daumShoppingBox['Name'] = '���� ����� ���ιڽ�';
if (false) {
	$daumShoppingBox['Enabled'] = true;
	$daumShoppingBox['URL'] = '../daumcpc/shoppingbox_mobile.php';
}
else {
	$daumShoppingBox['URL'] = '../daumcpc/shoppingbox_mobile.php';
}
$marketingMap[] = $daumShoppingBox;