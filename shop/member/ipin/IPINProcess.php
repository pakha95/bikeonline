<?php
	include dirname(__FILE__)."/../../lib/library.php";
	include_once( dirname(__FILE__)."/../../conf/config.php" );
	include_once( dirname(__FILE__)."/../../conf/fieldset.php" );

	/********************************************************************************************************************************************
		NICE신용평가정보 Copyright(c) KOREA INFOMATION SERVICE INC. ALL RIGHTS RESERVED
		
		서비스명 : 가상주민번호서비스 (IPIN) 서비스
		페이지명 : 가상주민번호서비스 (IPIN) 사용자 인증 정보 처리 페이지
		
				   수신받은 데이터(인증결과)를 메인화면으로 되돌려주고, close를 하는 역활을 합니다.
	*********************************************************************************************************************************************/
	
	// 사용자 정보 및 CP 요청번호를 암호화한 데이타입니다. (ipin_main.php 페이지에서 암호화된 데이타와는 다릅니다.)
	$sResponseData = $_POST['enc_data'];
	
	// ipin_main.php 페이지에서 설정한 데이타가 있다면, 아래와 같이 확인가능합니다.
	$sReservedParam1  = $_POST['param_r1'];
	$sReservedParam2  = $_POST['param_r2'];
	$sReservedParam3  = $_POST['param_r3'];
	
	// 회원가입시 가입경로가 모바일인지 체크, 모바일의 아이핀체크에서 세션에 저장한 값을 불러옴
	$joinGubun = $_SESSION['joinGubun'];
	
	//////////////////////////////////////////////// 문자열 점검///////////////////////////////////////////////
    if(preg_match('~[^0-9a-zA-Z+/=]~', $sResponseData, $match)) {echo "입력 값 확인이 필요합니다"; exit;}
	if(base64_encode(base64_decode($sResponseData))!= $sResponseData) {echo " 입력 값 확인이 필요합니다"; exit;}	
    if(preg_match("/[#\&\\+\-@=\/\\\:;,\\'\"\^`~\|\!\/\?\*$#<>()\[\]\{\}]/i", $sReservedParam1, $match)) {echo "문자열 점검 : ".$match[0]; exit;}
    if(preg_match("/[#\&\\+\-%@=\/\\\:;,\.\'\"\^`~\_|\!\/\?\*$#<>()\[\]\{\}]/i", $sReservedParam2, $match)) {echo "문자열 점검 : ".$match[0]; exit;}
    if(preg_match("/[#\&\\+\-%@=\/\\\:;,\.\'\"\^`~\_|\!\/\?\*$#<>()\[\]\{\}]/i", $sReservedParam3, $match)) {echo "문자열 점검 : ".$match[0]; exit;}
	///////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	// 암호화된 사용자 정보가 존재하는 경우
	if ($sResponseData != "") {

?>

<html>
<head>
	<title>NICE신용평가정보 가상주민번호 서비스</title>
	<script language='javascript'>
		var _joinGubun="<? echo $joinGubun?>";
		function fnLoad()
		{
			var _joinGubunHeader = (_joinGubun == "mobile") ? parent : opener;
			// 당사에서는 최상위를 설정하기 위해 'parent.opener.parent.document.'로 정의하였습니다.
			// 따라서 귀사에 프로세스에 맞게 정의하시기 바랍니다.
			_joinGubunHeader.document.getElementById('ifrmRnCheck').contentWindow.document.vnoform.enc_data.value = "<?= $sResponseData ?>";
			
			_joinGubunHeader.document.getElementById('ifrmRnCheck').contentWindow.document.vnoform.param_r1.value = "<?= $sReservedParam1 ?>";
			_joinGubunHeader.document.getElementById('ifrmRnCheck').contentWindow.document.vnoform.param_r2.value = "<?= $sReservedParam2 ?>";
			_joinGubunHeader.document.getElementById('ifrmRnCheck').contentWindow.document.vnoform.param_r3.value = "<?= $sReservedParam3 ?>";
			
			_joinGubunHeader.document.getElementById('ifrmRnCheck').contentWindow.document.vnoform.target = "Parent_window";
			
			// 인증 완료시에 인증결과를 수신하게 되는 귀사 클라이언트 결과 페이지 URL
			_joinGubunHeader.document.getElementById('ifrmRnCheck').contentWindow.document.vnoform.action = "IPINResult.php";
			_joinGubunHeader.document.getElementById('ifrmRnCheck').contentWindow.document.vnoform.submit();
			
			if (_joinGubun == "mobile"){
				if (typeof(parent.frmMaskRemove) != 'undefined') parent.frmMaskRemove('popupCertKey');
				else self.close();
			}
			else self.close();
		}
	</script>
</head>
<body onLoad="fnLoad()">

<?
	} else {
?>

<html>
<head>
	<title>NICE신용평가정보 가상주민번호 서비스</title>
	<body onLoad="self.close()">

<?
	}
?>

</body>
</html>