<?php /* Template_ 2.2.7 2015/01/28 16:49:46 /www/jbsinttr8192_godo_co_kr/shop/data/skin/damoashop/member/auth_by_mb_email.htm 000002764 */ ?>
<html>
<head>
<title>�̸��� ����</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script src="/shop/data/skin/damoashop/common.js"></script>
<link rel="styleSheet" href="/shop/data/skin/damoashop/style.css">
</head>

<script language="JavaScript">
function chkForm2(f) {
	if(!f.certKey.value || f.certKey.value.length < 8) {
		alert("������ȣ�� ��Ȯ�� �Է��� �ּ���.");
		f.certKey.focus();
		return false;
	}

	parent.nsGodo_PasswordFinder.compareOTP(f.certKey.value, '<?php echo $TPL_VAR["m_id"]?>', '<?php echo $TPL_VAR["token"]?>');

	return false;
}

addOnloadEvent(function() {_ID('certKey').focus();});
</script>

<style type="text/css">
body {background:#ffffff;margin:0;}

.password-auth-form-wrapper {border:2px solid #c7c7c7;width:100%;height:100%;}
.password-auth-form-wrapper h1 {width:100%;height:43px;margin:0;background:url('/shop/data/skin/damoashop/img/common/h_email_authentication.gif') no-repeat top left;text-indent:-1000px;}

.password-auth-form-wrapper .contents {margin:20px 30px;color:#6E6E6E; font-family:dotum; font-size:12px; }
.password-auth-form-wrapper .contents p {margin:0;line-height:130%;}

.password-auth-form-wrapper .contents .form {background:#f1f1f1; border:1px solid #dbdbdb;height:40px;width:100%;margin:20px 0 20px 0;text-align:center;}
	#certKey { border:1px solid #dedede; height:20px; margin-top:10px; width:164px; }

.password-auth-form-wrapper .contents .buttons {text-align:center;}

</style>

<body>

<div class="password-auth-form-wrapper">
	<h1>e-mail �ּ� ����</h1>

	<div class="contents">

		<p>
		ȸ�������� ��ϵǾ� �ִ� �������� e-mail �ּҷ� ������ȣ�� ���۵Ǿ����ϴ�.
		���۵� ������ȣ�� �Է��Ͽ� �ּ���.
		���۷��� ���� ��� ������ �� �ֽ��ϴ�.
		</p>

		<form name="certForm" method="post" action="" onsubmit="return chkForm2(this)">

			<div class="form">
				<img src="/shop/data/skin/damoashop/img/common/h1_authentication.gif" alt="������ȣ" />
				<input type="text" name="certKey" id="certKey" maxlength="8" onkeydown="onlynumber()" />
				<a href="javascript:parent.resend_certKey(<?php echo $GLOBALS["_GET"]["type"]?>);"><img src="/shop/data/skin/damoashop/img/common/btn_re_send.gif" align="absbottom" /></a>
			</div>

			<div class="buttons">
				<input type="image" src="/shop/data/skin/damoashop/img/common/btn_confirm.gif" align="absmiddle" />
				<a href="javascript:parent.closeAuthLayer();"><img src="/shop/data/skin/damoashop/img/common/btn_cancel2.gif" align="absmiddle" /></a>
			</div>

		</form>


	</div>

</div>

</body>
</html>