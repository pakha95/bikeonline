<?php
//해당 페이지는 사용자가 ISP{국민/BC) 카드 결제를 성공하였을 때, 사용자에게 보여지는 페이지입니다.
include "../../../../lib/library.php";
include "../../../../conf/config.mobileShop.php";
include "../../../../conf/config.php";
include "../../../../conf/pg_mobile.lgdacom.php";

$page_type = $_GET['page_type'];

if($page_type=='mobile') {
	$order_end_page = $cfgMobileShop['mobileShopRootDir'].'/ord/order_end.php';
	$order_fail_page = $cfgMobileShop['mobileShopRootDir'].'/ord/order_fail.php';
}
else {
	$order_end_page = $cfg['rootDir'].'/order/order_end.php';
	$order_fail_page = $cfg['rootDir'].'/order/order_fail.php';
}

$LGD_OID= $HTTP_GET_VARS["LGD_OID"];

$card_nm="ISP";
$sql="select step,step2 from ".GD_ORDER." where ordno='".$LGD_OID."'";
$data = $db->fetch($sql);
if($data[step]==1 && $data[step2]==0){	//결제성공 step,step2 = 1,0:성공 0,54:실패
	$goUrl=$order_end_page."?ordno=".$LGD_OID."&card_nm=".$card_nm;
}
else{
	$goUrl=$order_fail_page."?ordno=".$LGD_OID;
}
	// 결제성공시에만, 고객사에서 생성한 주문번호 (LGD_OID)를 해당페이지로 전송합니다.
	// LGD_KVPMISPNOTEURL 에서 수신한  결제결과값과  연동하여  사용자에게 보여줄  결제완료화면을 구성하시기 바라며,
	// 결제결과는 LGD_KVPMISPNOTEURL 로 먼저 전송되므로 해당건의 DB연동된  결과를 이용하여 결제완료여부를 보이도록 합니다.

	////////////////////////////////////////////////////////////////////////////////////////////////////////
	// 만약, 고객사에서 'App To App' 방식으로 국민, BC카드사에서 받은 결제 승인을 받고 고객사의 앱을 실행하고자 할때
	// 고객사 앱은 initilize function에 응답받는 Custom URL을 호출하면 됩니다.
	// ex) window.location.href = smartxpay://TID=1234567890&OID=0987654321
	//
	// window.location.href = "고객사 앱명://" 로 호출하시면 됩니다.
	////////////////////////////////////////////////////////////////////////////////////////////////////////
go($goUrl);
?>