<?php /* Template_ 2.2.7 2017/06/15 01:00:39 /www/jbsinttr8192_godo_co_kr/shop/data/skin/damoashop/order/card/lgdacom_std.htm 000009614 */ ?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="<?php if(!empty($_SERVER["HTTPS"])){?>https<?php }else{?>http<?php }?>://xpay.uplus.co.kr/xpay/js/xpay_crossplatform.js" type="text/javascript"></script>
<script language = 'javascript'>

/*
* 수정불가
*/
var LGD_window_type = '<?php echo $TPL_VAR["LGD"]["LGD_WINDOW_TYPE"]?>';

/*
* 수정불가
*/
function launchCrossPlatform(){
	lgdwin = openXpay(document.getElementById('LGD_PAYINFO'), '<?php echo $TPL_VAR["LGD"]["CST_PLATFORM"]?>', LGD_window_type, null, "", "");
}

/*
* FORM 명만  수정 가능
*/
function getFormObject() {
	return document.getElementById("LGD_PAYINFO");
}

/*
 * 인증결과 처리
 */
function payment_return() {
	var fDoc;
	fDoc = lgdwin.contentWindow || lgdwin.contentDocument;

	if (fDoc.document.getElementById('LGD_RESPCODE').value == "0000") {
			document.getElementById("LGD_PAYKEY").value = fDoc.document.getElementById('LGD_PAYKEY').value;
			document.getElementById("LGD_PAYINFO").target = "_self";
			document.getElementById("LGD_PAYINFO").action = "<?php echo $GLOBALS["cfg"]["rootDir"]?>/order/card/lgdacom/card_return_std.php";
			document.getElementById("LGD_PAYINFO").submit();
	} else {
		alert("LGD_RESPCODE (결과코드) : " + fDoc.document.getElementById('LGD_RESPCODE').value + "\n" + "LGD_RESPMSG (결과메시지): " + fDoc.document.getElementById('LGD_RESPMSG').value);
		closeIframe();
	}
}
</script>

<form name="LGD_PAYINFO" id="LGD_PAYINFO" method="POST" action="<?php echo $GLOBALS["cfg"]["rootDir"]?>/order/card/lgdacom/card_return_std.php">
<input type="hidden" name="LGD_WINDOW_TYPE" id="LGD_WINDOW_TYPE" value="<?php echo $TPL_VAR["LGD"]["LGD_WINDOW_TYPE"]?>" />
<input type="hidden" name="LGD_CUSTOM_FIRSTPAY" id="LGD_CUSTOM_FIRSTPAY" value="<?php echo $TPL_VAR["LGD"]["LGD_CUSTOM_FIRSTPAY"]?>" />
<input type="hidden" name="LGD_CUSTOM_SWITCHINGTYPE" id="LGD_CUSTOM_SWITCHINGTYPE" value="<?php echo $TPL_VAR["LGD"]["LGD_CUSTOM_SWITCHINGTYPE"]?>" />
<input type="hidden" name="LGD_RESPCODE" id="LGD_RESPCODE" value="<?php echo $TPL_VAR["LGD"]["LGD_RESPCODE"]?>" />
<input type="hidden" name="LGD_RESPMSG" id="LGD_RESPMSG" value="<?php echo $TPL_VAR["LGD"]["LGD_RESPMSG"]?>" />
<input type="hidden" name="CST_PLATFORM" id="CST_PLATFORM" value="<?php echo $TPL_VAR["LGD"]["CST_PLATFORM"]?>">							<!-- 테스트, 서비스 구분 -->
<input type="hidden" name="CST_MID"	id="CST_MID" value="<?php echo $TPL_VAR["LGD"]["CST_MID"]?>">											<!-- 상점아이디 -->
<input type="hidden" name="LGD_MID"	id="LGD_MID" value="<?php echo $TPL_VAR["LGD"]["LGD_MID"]?>">											<!-- 상점아이디 -->
<input type="hidden" name="LGD_OID"	id="LGD_OID" value="<?php echo $TPL_VAR["LGD"]["LGD_OID"]?>">											<!-- 주문번호 -->
<input type="hidden" name="LGD_PRODUCTINFO"	id="LGD_PRODUCTINFO" value="<?php echo $TPL_VAR["LGD"]["LGD_PRODUCTINFO"]?>">					<!-- 상품정보 -->
<input type="hidden" name="LGD_AMOUNT" id="LGD_AMOUNT" value="<?php echo $TPL_VAR["LGD"]["LGD_AMOUNT"]?>">								<!-- 결제금액 -->
<input type="hidden" name="LGD_TAXFREEAMOUNT" id="LGD_TAXFREEAMOUNT" value="">									<!-- 면세금액 -->
<input type="hidden" name="LGD_BUYER" id="LGD_BUYER" value="<?php echo $TPL_VAR["nameOrder"]?>">										<!-- 구매자 -->
<input type="hidden" name="LGD_BUYERID"	id="LGD_BUYERID" value="<?php if($GLOBALS["sess"]["m_id"]){?><?php echo $GLOBALS["sess"]["m_id"]?><?php }elseif($TPL_VAR["email"]){?><?php echo $TPL_VAR["email"]?><?php }else{?>guest<?php }?>">	<!-- 구매자 ID -->
<input type="hidden" name="LGD_BUYERPHONE"	id="LGD_BUYERPHONE" value="<?php echo implode('-',$TPL_VAR["mobileOrder"])?>">			<!-- 구매자 전화 -->
<input type="hidden" name="LGD_BUYEREMAIL" id="LGD_BUYEREMAIL" value="<?php echo $TPL_VAR["email"]?>">									<!-- 구매자 이메일 -->
<input type="hidden" name="LGD_BUYERADDRESS" id="LGD_BUYERADDRESS" value="<?php echo $TPL_VAR["address"]?> <?php echo $TPL_VAR["address_sub"]?>">				<!-- 배송처 -->
<input type="hidden" name="LGD_RECEIVER" id="LGD_RECEIVER" value="<?php echo $TPL_VAR["nameReceiver"]?>">								<!-- 수취인 -->
<input type="hidden" name="LGD_RECEIVERPHONE" id="LGD_RECEIVERPHONE" value="<?php echo implode('-',$TPL_VAR["mobileReceiver"])?>">	<!-- 수취인 전화번호 -->
<input type="hidden" name="LGD_ACTIVEXYN" id="LGD_ACTIVEXYN" value="<?php echo $TPL_VAR["LGD"]["LGD_ACTIVEXYN"]?>">

<?php if($TPL_VAR["settlekind"]=="c"){?>
<!-- 할부개월 선택창 제어를 위한 선택적인 hidden정보 -->
<input type="hidden" name="LGD_INSTALLRANGE" id="LGD_INSTALLRANGE" value="<?php echo $TPL_VAR["LGD"]["LGD_INSTALLRANGE"]?>">							<!-- 할부개월 범위-->
<!-- 무이자 할부(수수료 상점부담) 여부를 선택하는 hidden정보 -->
<input type="hidden" name="LGD_NOINTINF" id="LGD_NOINTINF" value="<?php echo $TPL_VAR["LGD"]["LGD_NOINTINF"]?>">	<!-- 신용카드 무이자 할부 적용하기 -->
<?php }?>

<?php if($TPL_VAR["settlekind"]=="o"||$TPL_VAR["settlekind"]=="v"){?>
<!--계좌이체|무통장입금(가상계좌)-->
<input type="hidden" name="LGD_CASHRECEIPTYN" id="LGD_CASHRECEIPTYN" value="<?php echo $TPL_VAR["LGD"]["LGD_CASHRECEIPTYN"]?>">		<!-- 현금영수증 사용여부(Y:사용,N:미사용) -->
<?php }?>

<?php if($TPL_VAR["settlekind"]=="v"){?>
<!-- 가상계좌(무통장) 결제연동을 하시는 경우  할당/입금 결과를 통보받기 위해 반드시 LGD_CASNOTEURL 정보를 LG 데이콤에 전송해야 합니다 . -->
<input type="hidden" name="LGD_CASNOTEURL" id="LGD_CASNOTEURL" value="<?php echo $TPL_VAR["LGD"]["LGD_CASNOTEURL"]?>">				<!-- 가상계좌 NOTEURL -->
<?php }?>
<input type="hidden" name="LGD_CUSTOM_SKIN" id="LGD_CUSTOM_SKIN" value="<?php echo $TPL_VAR["LGD"]["LGD_CUSTOM_SKIN"]?>">				<!-- 결제창 SKIN -->

<input type="hidden" name="LGD_CUSTOM_PROCESSTYPE" id="LGD_CUSTOM_PROCESSTYPE" value="<?php echo $TPL_VAR["LGD"]["LGD_CUSTOM_PROCESSTYPE"]?>">	<!-- 트랜잭션 처리방식 -->
<input type="hidden" name="LGD_TIMESTAMP" id="LGD_TIMESTAMP" value="<?php echo $TPL_VAR["LGD"]["LGD_TIMESTAMP"]?>">								<!-- 타임스탬프 -->
<input type="hidden" name="LGD_HASHDATA" id="LGD_HASHDATA" value="<?php echo $TPL_VAR["LGD"]["LGD_HASHDATA"]?>">									<!-- MD5 해쉬암호값 -->
<input type="hidden" name="LGD_CUSTOM_USABLEPAY" id="LGD_CUSTOM_USABLEPAY" value="<?php echo $TPL_VAR["LGD"]["LGD_CUSTOM_USABLEPAY"]?>">			<!-- 상점정의결제가능수단 (신용카드:SC0010,계좌이체:SC0030,무통장:SC0040,휴대폰:SC0060)-->
<input type="hidden" name="LGD_CUSTOM_PROCESSTIMEOUT" id="LGD_CUSTOM_PROCESSTIMEOUT" value="<?php echo $TPL_VAR["LGD"]["LGD_CUSTOM_PROCESSTIMEOUT"]?>">	<!-- TWOTR타임아웃 시간 -->
<input type="hidden" name="LGD_PAYKEY"  id="LGD_PAYKEY" value="">									<!-- LG데이콤 PAYKEY(인증후 자동셋팅)-->
<input type="hidden" name="LGD_VERSION"	id="LGD_VERSION" value="<?php echo $TPL_VAR["LGD"]["LGD_VERSION"]?>">					<!-- 버전정보 (삭제하지 마세요) -->
<input type="hidden" name="LGD_WINDOW_VER"	id="LGD_WINDOW_VER" value="<?php echo $TPL_VAR["LGD"]["LGD_WINDOW_VER"]?>">		<!-- 버전정보 (삭제하지 마세요) -->
<input type="hidden" name="LGD_RETURNURL" id="LGD_RETURNURL" value="<?php echo $TPL_VAR["LGD"]["LGD_RETURNURL"]?>"/>

<input type="hidden" name="LGD_ESCROW_USEYN" id="LGD_ESCROW_USEYN" value="<?php echo $TPL_VAR["LGD"]["LGD_ESCROW_USEYN"]?>">				<!-- 에스크로 여부 : 적용(Y),미적용(N)-->
<?php if($TPL_VAR["LGD"]["LGD_ESCROW_USEYN"]=="Y"){?>
<?php if((is_array($TPL_R1=$TPL_VAR["LGD"]["LGD_ESCROW_GOODS"])&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?>
		<input type="hidden" name="LGD_ESCROW_GOODID" id="LGD_ESCROW_GOODID" value="<?php echo $TPL_V1["LGD_ESCROW_GOODID"]?>">				<!-- 에스크로상품번호 -->
		<input type="hidden" name="LGD_ESCROW_GOODNAME" id="LGD_ESCROW_GOODNAME" value="<?php echo $TPL_V1["LGD_ESCROW_GOODNAME"]?>">		<!-- 에스크로상품명 -->
		<input type="hidden" name="LGD_ESCROW_GOODCODE"	id="LGD_ESCROW_GOODCODE" value="<?php echo $TPL_V1["LGD_ESCROW_GOODCODE"]?>">		<!-- 에스크로상품코드 -->
		<input type="hidden" name="LGD_ESCROW_UNITPRICE" id="LGD_ESCROW_UNITPRICE" value="<?php echo $TPL_V1["LGD_ESCROW_UNITPRICE"]?>">		<!-- 에스크로상품가격 -->
		<input type="hidden" name="LGD_ESCROW_QUANTITY" id="LGD_ESCROW_QUANTITY" value="<?php echo $TPL_V1["LGD_ESCROW_QUANTITY"]?>">		<!-- 에스크로상품수량 -->
<?php }}?>

	<input type="hidden" name="LGD_ESCROW_ZIPCODE" id="LGD_ESCROW_ZIPCODE" value="<?php echo $TPL_VAR["LGD"]["LGD_ESCROW_ZIPCODE"]?>">			<!-- 에스크로배송지구역번호 (새우편번호) -->
	<input type="hidden" name="LGD_ESCROW_ADDRESS1"	id="LGD_ESCROW_ADDRESS1" value="<?php echo $TPL_VAR["LGD"]["LGD_ESCROW_ADDRESS1"]?>">			<!-- 에스크로배송지주소동까지 (도로명주소) -->
	<input type="hidden" name="LGD_ESCROW_ADDRESS2"	id="LGD_ESCROW_ADDRESS2" value="<?php echo $TPL_VAR["LGD"]["LGD_ESCROW_ADDRESS2"]?>">			<!-- 에스크로배송지주소상세 -->
	<input type="hidden" name="LGD_ESCROW_BUYERPHONE" id="LGD_ESCROW_BUYERPHONE" value="<?php echo $TPL_VAR["LGD"]["LGD_ESCROW_BUYERPHONE"]?>">	<!-- 에스크로구매자휴대폰번호 -->
<?php }?>

<?php if($TPL_VAR["settlekind"]=="u"){?>
<!-- 중국은련 카드 관련 필드 -->
<input type="hidden" name="instance" id="instance" value="<?php if(!empty($_SERVER["HTTPS"])){?>https<?php }else{?>http<?php }?>://xpay.lgdacom.net"/>
<input type="hidden" name="page" id="page" value="/xpay/Request.do"/>
<input type="hidden" name="LGD_PAYWINDOWTYPE" id="LGD_PAYWINDOWTYPE" value="CUPS">
<?php }?>

</form>