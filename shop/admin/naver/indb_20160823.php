<?

include "../lib.php";
@include '../../lib/naverPartner.class.php';

if(class_exists('NaverCommonInflowScript', false)===false) include dirname(__FILE__).'/../../lib/naverCommonInflowScript.class.php';
$naverCommonInflowScript = new NaverCommonInflowScript();
if($naverCommonInflowScript->isEnabled===false) exit('
<script type="text/javascript">
alert("네이버 공통인증키를 저장하셔야 설정하실수 있습니다.");
</script>
');

require_once("../../lib/qfile.class.php");
$qfile = new qfile();

switch ($_POST[mode]){

	case "naver":

		if($_POST['cpaAgreement']!=='true')
		{
			msg('CPA 주문수집에 동의하여주시기 바랍니다.');
			exit;
		}

		// 상품가격 설정
		$_POST['partner']['cpaAgreement'] = $_POST['cpaAgreement'];
		$_POST['partner']['unmemberdc'] = ($_POST['inmemberdc'] == 'Y' ? 'N' : 'Y');
		$_POST['partner']['uncoupon'] = ($_POST['incoupon'] == 'Y' ? 'N' : 'Y');
		$_POST['partner']['naver_version'] = $_POST['naver_version'];
		$_POST['partner']['useYn'] = $_POST['useYn'];
		$_POST['partner']['naver_event_common'] = $_POST['naver_event_common'];
		$_POST['partner']['naver_event_goods'] = $_POST['naver_event_goods'];
		$_POST['partner']['auto_create_use'] = $_POST['auto_create_use'];
		$_POST['partner']['auto_excute_time'] = $_POST['auto_excute_time'];

		// 저장
		$partner = array();
		@include "../../conf/partner.php";

		if($_POST['partner']['cpaAgreement']==='true')
		{
			if(isset($partner['cpaAgreement'])===false || strlen($partner['cpaAgreement'])<1) $_POST['partner']['cpaAgreementTime'] = date('Y.m.d h:i');
		}
		else
		{
			if(isset($partner['cpaAgreementTime'])) unset($partner['cpaAgreementTime']);
		}

		$partner = array_map("addslashes",array_map("stripslashes",$partner));
		$partner = array_merge($partner,$_POST[partner]);

		$qfile->open("../../conf/partner.php");
		$qfile->write("<? \n");
		$qfile->write("\$partner = array( \n");
		foreach ($partner as $k=>$v) $qfile->write("'$k' => '$v', \n");
		$qfile->write(") \n;");
		$qfile->write("?>");
		$qfile->close();

		break;

	//네이버 쇼핑 상품 노출 설정
	case 'naverShopingGoods' :
		$message = "저장을 실패하였습니다. 고객센터에 문의하여 주세요.";
		$naver = new naverPartner();
		if(!is_object($naver)){
			msg($message, -1);
			exit;
		}

		$saveResult = false;
		$saveResult = $naver->saveDisplayCategory($_POST['category']);
		if($saveResult === false){
			msg($message, -1);
			exit;
		}

		break;
}

msg("정상적으로 저장되었습니다.");

?>
