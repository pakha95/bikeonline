<?php /* Template_ 2.2.7 2017/06/15 01:00:39 /www/jbsinttr8192_godo_co_kr/shop/data/skin/damoashop/order/card/lgdacom_std.htm 000009614 */ ?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="<?php if(!empty($_SERVER["HTTPS"])){?>https<?php }else{?>http<?php }?>://xpay.uplus.co.kr/xpay/js/xpay_crossplatform.js" type="text/javascript"></script>
<script language = 'javascript'>

/*
* �����Ұ�
*/
var LGD_window_type = '<?php echo $TPL_VAR["LGD"]["LGD_WINDOW_TYPE"]?>';

/*
* �����Ұ�
*/
function launchCrossPlatform(){
	lgdwin = openXpay(document.getElementById('LGD_PAYINFO'), '<?php echo $TPL_VAR["LGD"]["CST_PLATFORM"]?>', LGD_window_type, null, "", "");
}

/*
* FORM ��  ���� ����
*/
function getFormObject() {
	return document.getElementById("LGD_PAYINFO");
}

/*
 * ������� ó��
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
		alert("LGD_RESPCODE (����ڵ�) : " + fDoc.document.getElementById('LGD_RESPCODE').value + "\n" + "LGD_RESPMSG (����޽���): " + fDoc.document.getElementById('LGD_RESPMSG').value);
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
<input type="hidden" name="CST_PLATFORM" id="CST_PLATFORM" value="<?php echo $TPL_VAR["LGD"]["CST_PLATFORM"]?>">							<!-- �׽�Ʈ, ���� ���� -->
<input type="hidden" name="CST_MID"	id="CST_MID" value="<?php echo $TPL_VAR["LGD"]["CST_MID"]?>">											<!-- �������̵� -->
<input type="hidden" name="LGD_MID"	id="LGD_MID" value="<?php echo $TPL_VAR["LGD"]["LGD_MID"]?>">											<!-- �������̵� -->
<input type="hidden" name="LGD_OID"	id="LGD_OID" value="<?php echo $TPL_VAR["LGD"]["LGD_OID"]?>">											<!-- �ֹ���ȣ -->
<input type="hidden" name="LGD_PRODUCTINFO"	id="LGD_PRODUCTINFO" value="<?php echo $TPL_VAR["LGD"]["LGD_PRODUCTINFO"]?>">					<!-- ��ǰ���� -->
<input type="hidden" name="LGD_AMOUNT" id="LGD_AMOUNT" value="<?php echo $TPL_VAR["LGD"]["LGD_AMOUNT"]?>">								<!-- �����ݾ� -->
<input type="hidden" name="LGD_TAXFREEAMOUNT" id="LGD_TAXFREEAMOUNT" value="">									<!-- �鼼�ݾ� -->
<input type="hidden" name="LGD_BUYER" id="LGD_BUYER" value="<?php echo $TPL_VAR["nameOrder"]?>">										<!-- ������ -->
<input type="hidden" name="LGD_BUYERID"	id="LGD_BUYERID" value="<?php if($GLOBALS["sess"]["m_id"]){?><?php echo $GLOBALS["sess"]["m_id"]?><?php }elseif($TPL_VAR["email"]){?><?php echo $TPL_VAR["email"]?><?php }else{?>guest<?php }?>">	<!-- ������ ID -->
<input type="hidden" name="LGD_BUYERPHONE"	id="LGD_BUYERPHONE" value="<?php echo implode('-',$TPL_VAR["mobileOrder"])?>">			<!-- ������ ��ȭ -->
<input type="hidden" name="LGD_BUYEREMAIL" id="LGD_BUYEREMAIL" value="<?php echo $TPL_VAR["email"]?>">									<!-- ������ �̸��� -->
<input type="hidden" name="LGD_BUYERADDRESS" id="LGD_BUYERADDRESS" value="<?php echo $TPL_VAR["address"]?> <?php echo $TPL_VAR["address_sub"]?>">				<!-- ���ó -->
<input type="hidden" name="LGD_RECEIVER" id="LGD_RECEIVER" value="<?php echo $TPL_VAR["nameReceiver"]?>">								<!-- ������ -->
<input type="hidden" name="LGD_RECEIVERPHONE" id="LGD_RECEIVERPHONE" value="<?php echo implode('-',$TPL_VAR["mobileReceiver"])?>">	<!-- ������ ��ȭ��ȣ -->
<input type="hidden" name="LGD_ACTIVEXYN" id="LGD_ACTIVEXYN" value="<?php echo $TPL_VAR["LGD"]["LGD_ACTIVEXYN"]?>">

<?php if($TPL_VAR["settlekind"]=="c"){?>
<!-- �Һΰ��� ����â ��� ���� �������� hidden���� -->
<input type="hidden" name="LGD_INSTALLRANGE" id="LGD_INSTALLRANGE" value="<?php echo $TPL_VAR["LGD"]["LGD_INSTALLRANGE"]?>">							<!-- �Һΰ��� ����-->
<!-- ������ �Һ�(������ �����δ�) ���θ� �����ϴ� hidden���� -->
<input type="hidden" name="LGD_NOINTINF" id="LGD_NOINTINF" value="<?php echo $TPL_VAR["LGD"]["LGD_NOINTINF"]?>">	<!-- �ſ�ī�� ������ �Һ� �����ϱ� -->
<?php }?>

<?php if($TPL_VAR["settlekind"]=="o"||$TPL_VAR["settlekind"]=="v"){?>
<!--������ü|�������Ա�(�������)-->
<input type="hidden" name="LGD_CASHRECEIPTYN" id="LGD_CASHRECEIPTYN" value="<?php echo $TPL_VAR["LGD"]["LGD_CASHRECEIPTYN"]?>">		<!-- ���ݿ����� ��뿩��(Y:���,N:�̻��) -->
<?php }?>

<?php if($TPL_VAR["settlekind"]=="v"){?>
<!-- �������(������) ���������� �Ͻô� ���  �Ҵ�/�Ա� ����� �뺸�ޱ� ���� �ݵ�� LGD_CASNOTEURL ������ LG �����޿� �����ؾ� �մϴ� . -->
<input type="hidden" name="LGD_CASNOTEURL" id="LGD_CASNOTEURL" value="<?php echo $TPL_VAR["LGD"]["LGD_CASNOTEURL"]?>">				<!-- ������� NOTEURL -->
<?php }?>
<input type="hidden" name="LGD_CUSTOM_SKIN" id="LGD_CUSTOM_SKIN" value="<?php echo $TPL_VAR["LGD"]["LGD_CUSTOM_SKIN"]?>">				<!-- ����â SKIN -->

<input type="hidden" name="LGD_CUSTOM_PROCESSTYPE" id="LGD_CUSTOM_PROCESSTYPE" value="<?php echo $TPL_VAR["LGD"]["LGD_CUSTOM_PROCESSTYPE"]?>">	<!-- Ʈ����� ó����� -->
<input type="hidden" name="LGD_TIMESTAMP" id="LGD_TIMESTAMP" value="<?php echo $TPL_VAR["LGD"]["LGD_TIMESTAMP"]?>">								<!-- Ÿ�ӽ����� -->
<input type="hidden" name="LGD_HASHDATA" id="LGD_HASHDATA" value="<?php echo $TPL_VAR["LGD"]["LGD_HASHDATA"]?>">									<!-- MD5 �ؽ���ȣ�� -->
<input type="hidden" name="LGD_CUSTOM_USABLEPAY" id="LGD_CUSTOM_USABLEPAY" value="<?php echo $TPL_VAR["LGD"]["LGD_CUSTOM_USABLEPAY"]?>">			<!-- �������ǰ������ɼ��� (�ſ�ī��:SC0010,������ü:SC0030,������:SC0040,�޴���:SC0060)-->
<input type="hidden" name="LGD_CUSTOM_PROCESSTIMEOUT" id="LGD_CUSTOM_PROCESSTIMEOUT" value="<?php echo $TPL_VAR["LGD"]["LGD_CUSTOM_PROCESSTIMEOUT"]?>">	<!-- TWOTRŸ�Ӿƿ� �ð� -->
<input type="hidden" name="LGD_PAYKEY"  id="LGD_PAYKEY" value="">									<!-- LG������ PAYKEY(������ �ڵ�����)-->
<input type="hidden" name="LGD_VERSION"	id="LGD_VERSION" value="<?php echo $TPL_VAR["LGD"]["LGD_VERSION"]?>">					<!-- �������� (�������� ������) -->
<input type="hidden" name="LGD_WINDOW_VER"	id="LGD_WINDOW_VER" value="<?php echo $TPL_VAR["LGD"]["LGD_WINDOW_VER"]?>">		<!-- �������� (�������� ������) -->
<input type="hidden" name="LGD_RETURNURL" id="LGD_RETURNURL" value="<?php echo $TPL_VAR["LGD"]["LGD_RETURNURL"]?>"/>

<input type="hidden" name="LGD_ESCROW_USEYN" id="LGD_ESCROW_USEYN" value="<?php echo $TPL_VAR["LGD"]["LGD_ESCROW_USEYN"]?>">				<!-- ����ũ�� ���� : ����(Y),������(N)-->
<?php if($TPL_VAR["LGD"]["LGD_ESCROW_USEYN"]=="Y"){?>
<?php if((is_array($TPL_R1=$TPL_VAR["LGD"]["LGD_ESCROW_GOODS"])&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?>
		<input type="hidden" name="LGD_ESCROW_GOODID" id="LGD_ESCROW_GOODID" value="<?php echo $TPL_V1["LGD_ESCROW_GOODID"]?>">				<!-- ����ũ�λ�ǰ��ȣ -->
		<input type="hidden" name="LGD_ESCROW_GOODNAME" id="LGD_ESCROW_GOODNAME" value="<?php echo $TPL_V1["LGD_ESCROW_GOODNAME"]?>">		<!-- ����ũ�λ�ǰ�� -->
		<input type="hidden" name="LGD_ESCROW_GOODCODE"	id="LGD_ESCROW_GOODCODE" value="<?php echo $TPL_V1["LGD_ESCROW_GOODCODE"]?>">		<!-- ����ũ�λ�ǰ�ڵ� -->
		<input type="hidden" name="LGD_ESCROW_UNITPRICE" id="LGD_ESCROW_UNITPRICE" value="<?php echo $TPL_V1["LGD_ESCROW_UNITPRICE"]?>">		<!-- ����ũ�λ�ǰ���� -->
		<input type="hidden" name="LGD_ESCROW_QUANTITY" id="LGD_ESCROW_QUANTITY" value="<?php echo $TPL_V1["LGD_ESCROW_QUANTITY"]?>">		<!-- ����ũ�λ�ǰ���� -->
<?php }}?>

	<input type="hidden" name="LGD_ESCROW_ZIPCODE" id="LGD_ESCROW_ZIPCODE" value="<?php echo $TPL_VAR["LGD"]["LGD_ESCROW_ZIPCODE"]?>">			<!-- ����ũ�ι����������ȣ (�������ȣ) -->
	<input type="hidden" name="LGD_ESCROW_ADDRESS1"	id="LGD_ESCROW_ADDRESS1" value="<?php echo $TPL_VAR["LGD"]["LGD_ESCROW_ADDRESS1"]?>">			<!-- ����ũ�ι�����ּҵ����� (���θ��ּ�) -->
	<input type="hidden" name="LGD_ESCROW_ADDRESS2"	id="LGD_ESCROW_ADDRESS2" value="<?php echo $TPL_VAR["LGD"]["LGD_ESCROW_ADDRESS2"]?>">			<!-- ����ũ�ι�����ּһ� -->
	<input type="hidden" name="LGD_ESCROW_BUYERPHONE" id="LGD_ESCROW_BUYERPHONE" value="<?php echo $TPL_VAR["LGD"]["LGD_ESCROW_BUYERPHONE"]?>">	<!-- ����ũ�α������޴�����ȣ -->
<?php }?>

<?php if($TPL_VAR["settlekind"]=="u"){?>
<!-- �߱����� ī�� ���� �ʵ� -->
<input type="hidden" name="instance" id="instance" value="<?php if(!empty($_SERVER["HTTPS"])){?>https<?php }else{?>http<?php }?>://xpay.lgdacom.net"/>
<input type="hidden" name="page" id="page" value="/xpay/Request.do"/>
<input type="hidden" name="LGD_PAYWINDOWTYPE" id="LGD_PAYWINDOWTYPE" value="CUPS">
<?php }?>

</form>