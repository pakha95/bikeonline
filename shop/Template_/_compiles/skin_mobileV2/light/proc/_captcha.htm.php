<?php /* Template_ 2.2.7 2013/08/12 13:19:29 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/proc/_captcha.htm 000002246 */ ?>
<div>
<div style="float:left;">
	<IMG src="/shop/proc/captcha.php" align="absmiddle" id="el-captcha-text">
</div>
<div style="float:left; margin-left:15px;">
	<a href="javascript:void(0);" onClick="fnRefreshCaptchaText();"><div style="margin-top:5px;width:60px; height:27px; line-height:27px; font-size:12px; color:#FFFFFF; font-weight:normal;text-align:center; background:#808591; border-radius:3px;">���ΰ�ħ</div></a>
</div>
</div>
<div style="clear:both;">
<div class=stxt>���̴� ������� ���� �� ���ڸ� ��� �Է��� �ּ���.</div>
<div><input name=captcha_key style="width:95%;height:20px;" maxlength=5 style="ime-mode:disabled;text-transform:uppercase;" onKeyUp="javascript:this.value=this.value.toUpperCase();" onfocus="this.select()" label="�ڵ���Ϲ�������" class=linebg required></div>
</div>

<script type="text/javascript">
var chkFormSubExist = false;
if (typeof(chkFormSub) == 'function') {
	chkFormSubExist = true;
}
if (chkFormSubExist === false) {
	var funStr = chkForm.toString().replace('chkForm','chkFormSub');
	eval(funStr);
}
</script>
<script type="text/javascript">
if (chkFormSubExist === false) {
	function chkForm(form)
	{
		if (typeof(form['captcha_key']) == 'object') {
			if (form['captcha_key'].value == '') {
				alert('[�ڵ���Ϲ���] �ʼ��Է»���');
				return false;
			}

			// �ڵ���Ϲ��� ����
			if (window.XMLHttpRequest)
				xmlHttp = new XMLHttpRequest();
			else if (window.ActiveXObject)
				xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");

			var url = "/shop/proc/captcha_indb.php";
			xmlHttp.open("POST", url, false);
			xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlHttp.send("mode=chkBoardCaptcha&id=" + form['id'].value+"&captcha_key=" + form['captcha_key'].value);
			if (xmlHttp.responseText != 'true') {
				alert(xmlHttp.responseText);
				return false;
			}
		}

		return chkFormSub(form);
	}
}

function fnRefreshCaptchaText() {
	var img = document.getElementById('el-captcha-text');
	img.src = "/shop/proc/captcha.php?" + new Date().getTime();
}
</script>