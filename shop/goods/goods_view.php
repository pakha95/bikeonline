<?
if(!preg_match('/^[0-9]*$/',$_GET['goodsno'])) exit;
if(!preg_match('/^[0-9]*$/',$_GET['category'])) exit;

### �����Ҵ�
$goodsno = $_GET['goodsno'];

include "../_header.php";
include "../conf/config.pay.php";
@include "../conf/coupon.php";
@include "../conf/config.plusCheeseCfg.php"; //�÷���ġ��
require "../lib/load.class.php";
require "../lib/nateClipping.class.php";
require "../lib/plusCheese.class.php";
@include "../conf/naverCheckout.cfg.php";
@include "../conf/auctionIpay.cfg.php";
@include "../conf/sns.cfg.php";
@include "../conf/qr.cfg.php";
include "../lib/cart.class.php";
@include "../../shop/setGoods/data/config/setGoodsConfig.php";
include '../lib/Lib_Robot.php';

$jQueryPath = $cfg['rootDir'] . '/lib/js/jquery-1.11.3.min.js';
$jQueryUiCssPath =  $cfg['rootDir'] . '/lib/js/jquery-ui-1.10.4.custom.css';
$jQueryUiPath =  $cfg['rootDir'] . '/lib/js/jquery-ui.js';
$jQueryHashtagJsPath = $cfg['rootDir'] . '/proc/hashtag/hashtagControl.js?actTime='.time();

if (is_file("../conf/config.checkout_review.php")) include "../conf/config.checkout_review.php"; //��ǰ�ı� ���� ����

if (is_file("../conf/config.related.goods.php")) include "../conf/config.related.goods.php";
else {
	// �⺻ ���� ��
	$cfg_related['horizontal'] =  5;
	$cfg_related['vertical'] =  1;
	$cfg_related['size'] =  $cfg[img_s];

	$cfg_related['dp_image'] = 1;	// ����
	$cfg_related['dp_goodsnm'] =  1;
	$cfg_related['dp_price'] = 1;
	$cfg_related['dp_shortdesc'] = $cfg[img_s];

	$cfg_related['use_cart'] = 0;
	$cfg_related['cart_icon'] = 1;

	$cfg_related['exclude_soldout'] =  0;
	$cfg_related['link_type'] = 'self';
}
if (is_file(dirname(__FILE__) . "/../conf/config.soldout.php"))
	include dirname(__FILE__) . "/../conf/config.soldout.php";

if(!$set['emoney']['cut'])$set['emoney']['cut']=0;
$set['emoney']['base'] = pow(10,$set['emoney']['cut']);
$dealer = $db->fetch("select gd_amount from gd_goods_discount where gd_goodsno = '".$goodsno."'");
$dealer_price = $dealer[gd_amount];
$dealer_price = explode(",",$dealer_price);
$dealera_price = $dealer_price[0]/100;
$dealerb_price = $dealer_price[1]/100;
$dealerc_price = $dealer_price[2]/100;

//��ǰ���䰳��
list ($review_count) = $db->fetch("select count(*) as cnt from gd_goods_review where goodsno = '".$goodsno."'");
//��ǰ���ǰ���
list ($qna_count) = $db->fetch("select count(*) as cnt from gd_goods_qna where goodsno = '".$goodsno."'");
//������ ��� �ݿ��ǵ��� �߰� by jung
$gd_reserve = $db->fetch("select goods_reserve from gd_goods where goodsno='".$goodsno."' limit 1 ");
$gd_reserve = $gd_reserve[goods_reserve];

try {

	$goodsHelper   = Clib_Application::getHelperClass('front_goods');

	$goodsModel    = $goodsHelper->getGoodsModel(Clib_Application::request()->get('goodsno'));
	if (!$goodsModel->hasLoaded()) {
		throw new Clib_Exception('��ǰ������ �����ϴ�.');
	}

	$categoryModel = $goodsHelper->getCategoryModel(Clib_Application::request()->get('category'), $goodsModel);

	// ���� ������ �ʿ��� ��ǰ�� ���
	if ($goodsModel->getUseOnlyAdult() && !Clib_Application::session()->canAccessAdult()) {
		Clib_Application::response()->redirect(
			$goodsHelper->getGoodsViewUrl($goodsModel)
		);
	}

	// ī�װ��� ���� ����, ���� ���� üũ
	if (!$goodsHelper->canAccessLinkedCategory($goodsModel)) {
		throw new Clib_Exception('�̿� ������ �����ϴ�.\\nȸ������� ���ų� ȸ�������� �ʿ��մϴ�.');
	}

	// ��ǰ ���� ���� üũ
	if(!$goodsModel->getData('open')) {
		Clib_Application::response()->jsAlert('�ش��ǰ�� ������ ���� ��ǰ�� �ƴմϴ�.')->historyBack();
	}

	// ������ũ ���𷺼�
	if (strpos($_SERVER['HTTP_HOST'], ".godo.interpark.com") !== false) {
		$url = sprintf("http://www.interpark.com/product/MallDisplay.do?_method=detail&sc.shopNo=0000100000&sc.dispNo=%s&sc.prdNo=%s", $goodsModel['inpk_dispno'], $goodsModel['inpk_prdno']);
		Clib_Application::response()->redirect($url);
	}
	else if ( ! $goodsModel->hasLoaded() && Clib_Application::cookie()->get('cc_inflow') == 'openstyleOutlink') {
		Clib_Application::response()->jsAlert('�ش��ǰ�� ������ ���� ��ǰ�� �ƴմϴ�.')->redirect('/shop');
	}
	else {
		// nothing to do;
	}

	// ������ȯ�� ��Ű
	$params = array(
		'nv_pchs' => Clib_Application::request()->get('nv_pchs'),
		'ref' => Clib_Application::request()->get('ref'),
		'clickid' => Clib_Application::request()->get('clickid'),
		'clickDate' => Clib_Application::request()->get('clickDate'),
		'clickNo' => Clib_Application::request()->get('clickNo'),
		'adType' => Clib_Application::request()->get('adType'),
		'cpcType' => Clib_Application::request()->get('cpcType'),
	);
	$goodsHelper->setMarketingCookies($params);

// �������� ī����
if (Lib_Robot::isRobotAccess() === false) {
	$db->silent(true);
	$db->query("INSERT INTO ".GD_GOODS_PAGEVIEW." SET date = CURDATE(), goodsno = $goodsno, cnt = 1 ON DUPLICATE KEY UPDATE cnt = cnt + 1");
	$db->silent();
}

	$data = $goodsHelper->getGoodsDataArray($goodsModel, $categoryModel);

	$tpl->assign(array('clevel'	=> $categoryModel->getLevel(),
					   'slevel'=> Clib_Application::session()->getMemberLevel(),
					   'level_auth'=> $categoryModel->getLevelAuth()));

	$tpl->assign('systemHeadTagEnd', $systemHeadTagEnd);

	Clib_Application::storage()->toGlobal();

	//PDF���� ����üũ by jung
	function remoteFileName($server_path,$search){
	  $pdfName = array();
	  $ftp_host = "jbsinter2.godohosting.com";    // ftp host��
	  $ftp_id = "jbsinter2";           // ftp ���̵�
	  $ftp_pw = "piston3535";   // ftp ��й�ȣ
	  $ftp_port = "21";            // ftp ��Ʈ
	    if(!($fc = ftp_connect($ftp_host, $ftp_port))) die("$server_host : $server_post - ���ῡ �����Ͽ����ϴ�.");
	    if(!ftp_login($fc, $ftp_id, $ftp_pw)) die("$server_id - �α��ο� �����Ͽ����ϴ�.");
	    //$server_path = "/pdf/";
	    ftp_chdir($fc, $server_path);
	    $contents = ftp_nlist($fc, $server_path);
			$search2 = substr($search,0,-2)."_";
			$search3 = substr($search,0,-2)."-";
	    foreach($contents as $value){
				if(strpos($value, $search) !== false) {
	      	$pdfName[] = "http://jbsinter2.godohosting.com".$value;
	    	}elseif(strpos($value, $search2) !== false){
					$pdfName[] = "http://jbsinter2.godohosting.com".$value;
				}elseif(strpos($value, $search3) !== false){
					$pdfName[] = "http://jbsinter2.godohosting.com".$value;
				}
			}
	  return $pdfName;
	  ftp_quit($fc);
	}
	$goodscd = $db->fetch("select goodscd from gd_goods where goodsno = '".$goodsno."' limit 1");
	$goodscd = $goodscd[goodscd];
	$pdfNameArr = remoteFileName("/pdf/",$goodscd);


	/*
	$remot_file_name = "http://jbsinter2.godohosting.com/pdf/".$goodscd.".pdf";
	function remoteFileExist($filepath) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$filepath);
		curl_setopt($ch, CURLOPT_NOBODY, 1);
		curl_setopt($ch, CURLOPT_FAILONERROR, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		if(curl_exec($ch)!==false) {
			return true;
		} else {
			return false;
		}
	}

	if(remoteFileExist($remot_file_name) == 1) {
		$pdfExist = true;
	} else {
		$pdfExist = false;
	}
	//PDF��
	*/
	### ���ø� ���
	$tpl->assign('cartCfg',$cart = new Cart);
	$tpl->assign($data);
	$tpl->assign('returnUrl', $_SERVER['REQUEST_URI']);
	$tpl->assign('customHeader', $customHeader);
	$tpl->assign('category', $categoryModel->getId());
	$_GET['category'] = $category = $categoryModel->getId();
	$lstcfg = $categoryModel->getConfig();
 	$tpl->assign('lstcfg', $lstcfg);

	$tpl->assign('review_count', $review_count);
	$tpl->assign('qna_count', $qna_count);

	$tpl->assign('dealera_price', $dealera_price);
	$tpl->assign('dealerb_price', $dealerb_price);
	$tpl->assign('dealerc_price', $dealerc_price);
	
	//PDF���� �߰� by jung
	//$tpl->assign('remot_file_name', $remot_file_name);
	//$tpl->assign('pdfExist', $pdfExist);
	$tpl->assign('pdfLoop',$pdfNameArr);
	//������ ��ùݿ��ǵ��� �߰� by jung
	$tpl->assign('gd_reserve', $gd_reserve);
$jQueryUse = false;
	if($data['hashtag']){
		$tpl->assign('jQueryHashtagJsPath', $jQueryHashtagJsPath);
		$jQueryUse = true;
	}

	$tpl->assign('jQueryUse', $jQueryUse);
	if($jQueryUse === true){
		$tpl->assign('jQueryPath', $jQueryPath);
		$tpl->assign('jQueryUiPath', $jQueryUiPath);
		$tpl->assign('jQueryUiCssPath', $jQueryUiCssPath);
	}

	if (Clib_Application::request()->get('preview') == 'y' && is_file($tpl->template_dir.'/'.'goods/goods_preview.htm')) {
		$tpl->define('tpl','goods/goods_preview.htm');
	}

	if (Clib_Application::storage()->get('about_coupon')) {
		$tpl->assign('about_coupon', Clib_Application::storage()->get('about_coupon'));
	}

	### ���½�Ÿ���� ���
	if(Clib_Application::cookie()->get('cc_inflow') == "openstyleOutlink") {
		echo "<script src='http://www.interpark.com/malls/openstyle/OpenStyleEntrTop.js'></script>";
	}

	$goodsBuyable = getGoodsBuyable($goodsno);
	$tpl->assign('goodsBuyable', $goodsBuyable);
	$tpl->print_('tpl');

### ���̿��� ��ũ�� ��ũ��Ʈ
$nate = Core::loader('NateClipping');
$nateyn = $nate->chk_goods($_GET['goodsno'],$cfg,&$db);
if($nateyn){
	$src = $nate->get_cyopenscrap($goodsno,$cfg['rootDir']);
?>
<script type="text/javascript">
function open_cyword(){
	var src = "<?php echo $src; ?>";
	window.open(src,'cyopenscrap','width=450,height=410,scrollbars=0');
}
</script>
<?php
	}
}
catch (Clib_Exception $e) {
	Clib_Application::response()->jsAlert($e)->historyBack();
}