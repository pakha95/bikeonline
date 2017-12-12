<?
include "../_header.popup.php";

?>
<div class="title title_top">카카오톡 플러스친구 아이디 등록</div>

<form name="form" method="post" action="indb.php" enctype="multipart/form-data">
<input type="hidden" name="mode" value="profileRegister">
<table class="tb">
<col class="cellC"><col class="cellL">
<tr>
	<td>플러스친구 아이디</td>
	<td>
		<div style="margin:5px">
			<input type="text" name="plusFriendId" style="width:200px;" value="" placeholder="예) @고도몰"/>
		</div>
		<div style="margin:5px">
			<span class="extext">카카오톡 플러스친구 검색용 아이디를 입력해주세요. @를 앞에 붙여주셔야 합니다. 예) @고도몰<br>카카오톡 플러스친구 아이디가 없다면 <a href="#" class="extext" style="font-weight:bold" onclick="javascript:window.open('https://center-pf.kakao.com/login');">[카카오톡 플러스친구 관리자]</a>에서 발급받은 후 등록해주세요.<br>
			발급받은 카카오톡 플러스친구 아이디는 반드시 홈공개로 설정해주셔야 등록이 가능합니다.</span>
		</div>
	</td>
</tr>
<tr>
	<td>사업자등록증</td>
	<td>
		<div id="license_div" style="margin:5px">
			<input type="file" name="license" value="" style="border:1px solid #bdbdbd"/>
		</div>
		<div style="margin:5px">
			<span class="extext">jpg, png 파일만 업로드 됩니다. 500KB 이하인 파일만 업로드 가능합니다.</span>
		</div>
	</td>
</tr>
<tr>
	<td>휴대폰 인증</td>
	<td>
		<div style="margin:5px">
			<input type="text" name="phoneNumber" style="width:200px;" value="" placeholder="휴대폰번호 입력"/>
			<a href="javascript:auth();"><img src="../img/btn_smsAuthKey.gif" border="0" align="absmiddle"/></a>
		</div>
		<div style="margin:5px">
			<input type="text" name="authNumber" style="width:200px;" value="" placeholder="인증번호 입력"/>
		</div>
		<div style="margin:5px">
			<span class="extext">카카오톡 플러스친구 관리자센터의 내 계정 정보에 등록된 휴대폰번호와 일치해야 인증번호가 발송됩니다.</span>
		</div>
	</td>
</tr>
</table>
<div class="button">
<input type="image" src="../img/btn_register.gif">
</div>
</form>

<script type="text/javascript" src="../../lib/js/jquery-1.11.3.min.js"></script>
<script>
function auth() {
	var plusFriendId = $('[name="plusFriendId"]').val();
	var phoneNumber = $('[name="phoneNumber"]').val();

	if (plusFriendId == '') {
		alert('플러스친구 아이디를 먼저 입력해주세요.');
		return;
	}

	var ajax = new Ajax.Request("indb.php",
	{
		method: "post",
		parameters: "mode=mobileAuth&plusFriendId=" + plusFriendId + "&phoneNumber=" + phoneNumber,
		onComplete: function (req)
		{
			var res = req.responseText;
			if (res == 'success') {
				alert('인증번호를 요청하였습니다. 카카오톡을 확인해주세요.');
			}
			else {
				alert('인증번호를 요청하지 못하였습니다. 잠시 후 다시 시도해주세요.');
			}
		}
	});
}
</script>