<?
include "../_header.popup.php";

?>
<div class="title title_top">īī���� �÷���ģ�� ���̵� ���</div>

<form name="form" method="post" action="indb.php" enctype="multipart/form-data">
<input type="hidden" name="mode" value="profileRegister">
<table class="tb">
<col class="cellC"><col class="cellL">
<tr>
	<td>�÷���ģ�� ���̵�</td>
	<td>
		<div style="margin:5px">
			<input type="text" name="plusFriendId" style="width:200px;" value="" placeholder="��) @����"/>
		</div>
		<div style="margin:5px">
			<span class="extext">īī���� �÷���ģ�� �˻��� ���̵� �Է����ּ���. @�� �տ� �ٿ��ּž� �մϴ�. ��) @����<br>īī���� �÷���ģ�� ���̵� ���ٸ� <a href="#" class="extext" style="font-weight:bold" onclick="javascript:window.open('https://center-pf.kakao.com/login');">[īī���� �÷���ģ�� ������]</a>���� �߱޹��� �� ������ּ���.<br>
			�߱޹��� īī���� �÷���ģ�� ���̵�� �ݵ�� Ȩ������ �������ּž� ����� �����մϴ�.</span>
		</div>
	</td>
</tr>
<tr>
	<td>����ڵ����</td>
	<td>
		<div id="license_div" style="margin:5px">
			<input type="file" name="license" value="" style="border:1px solid #bdbdbd"/>
		</div>
		<div style="margin:5px">
			<span class="extext">jpg, png ���ϸ� ���ε� �˴ϴ�. 500KB ������ ���ϸ� ���ε� �����մϴ�.</span>
		</div>
	</td>
</tr>
<tr>
	<td>�޴��� ����</td>
	<td>
		<div style="margin:5px">
			<input type="text" name="phoneNumber" style="width:200px;" value="" placeholder="�޴�����ȣ �Է�"/>
			<a href="javascript:auth();"><img src="../img/btn_smsAuthKey.gif" border="0" align="absmiddle"/></a>
		</div>
		<div style="margin:5px">
			<input type="text" name="authNumber" style="width:200px;" value="" placeholder="������ȣ �Է�"/>
		</div>
		<div style="margin:5px">
			<span class="extext">īī���� �÷���ģ�� �����ڼ����� �� ���� ������ ��ϵ� �޴�����ȣ�� ��ġ�ؾ� ������ȣ�� �߼۵˴ϴ�.</span>
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
		alert('�÷���ģ�� ���̵� ���� �Է����ּ���.');
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
				alert('������ȣ�� ��û�Ͽ����ϴ�. īī������ Ȯ�����ּ���.');
			}
			else {
				alert('������ȣ�� ��û���� ���Ͽ����ϴ�. ��� �� �ٽ� �õ����ּ���.');
			}
		}
	});
}
</script>