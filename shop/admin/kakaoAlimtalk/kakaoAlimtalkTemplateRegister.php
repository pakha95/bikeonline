<?
include "../_header.popup.php";

if ($_GET['code']) {
	$title = '����';
	$mode = 'templateUpdate';
	$disabled = 'style="background-color: #e2e2e2;" disabled';
	$comment = '���ø� ���� �ÿ��� ���ø� ���� ������ �� �� �����ϴ�.';

	include "../../lib/kakaoAlimtalk.class.php";
	$kakaoAlimtalk = new kakaoAlimtalk();
	$data = $kakaoAlimtalk->getTemplateData($_GET['code']);
}
else {
	$title = '���';
	$mode = 'templateRegister';
}

// ġȯ�ڵ� ����
$replacecode = array();
$replacecode['order'] = array('shopName', 'shopUrl', 'ordno', 'nameOrder', 'settleprice', 'account', 'deliverycomp', 'deliverycode');
$replacecode['member'] = array('shopName', 'shopUrl', 'name', 'password', 'toBeDate', 'id', 'smsAgree', 'smsAgreeDate', 'emailAgree', 'emailAgreeDate');
$replacecode['board'] = array('shopName', 'shopUrl', 'name', 'boardName');

$desc = array();
$desc['shopName'] = '���θ� ��, ������';
$desc['shopUrl'] = '���θ� URL';
$desc['ordno'] = '�ֹ���ȣ';
$desc['nameOrder'] = '�ֹ��� �̸�';
$desc['settleprice'] = '���űݾ�';
$desc['account'] = '�Աݰ���/�Ա��ڸ�';
$desc['deliverycomp'] = '�ù������';
$desc['deliverycode'] = '�����ȣ';
$desc['name'] = 'ȸ���̸�';
$desc['password'] = 'ȸ���н�����';
$desc['toBeDate'] = '�޸�ȸ����ȯ������';
$desc['id'] = 'ȸ�����̵�';
$desc['smsAgree'] = 'ȸ�����̵�';
$desc['smsAgreeDate'] = 'SMS ���ŵ�����';
$desc['emailAgree'] = '���� ���ŵ��� ����';
$desc['emailAgreeDate'] = '���� ���ŵ�����';
$desc['boardName'] = '�Խ��� �̸�';

?>
<div class="title title_top">īī�� �˸��� ���ø� <?=$title?></div>

<form name="form" method="post" action="indb.php">
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="code" value="<?=$_GET['code']?>">
<table class="tb" width="100%">
<col class="cellC"><col class="cellL">
<tr>
	<td>���ø� ����</td>
	<td>
		<div style="margin:5px">
			<select name="tmode" <?=$disabled?> onchange="replacecode('off');">
				<option value="order">= �ֹ����� =</option>
				<option value="member">= ȸ������ =</option>
				<option value="board">= �Խ��ǰ��� =</option>
			</select>
			<span class="extext"><?=$comment?></span>
		</div>
	</td>
</tr>
<tr>
	<td>���ø���</td>
	<td>
		<div style="margin:5px">
			<input type="text" name="name" value="<?=$data['name']?>" style="border:1px solid #bdbdbd"/>
		</div>
		<div class="extext">���ø����� ���ø� ������ ���� �Է� �׸��̸�, �˸��� ���뿡 ���Ե��� �ʽ��ϴ�.</div>
	</td>
</tr>
<tr>
	<td>���ø�����</td>
	<td>
		<table cellpadding="0px" cellspacing="0px" style="border-collapse:collapse;">
		<tr>
			<td id="code_on" style="text-align:right; padding-bottom:5px;"><img src="../img/btn_alimtalk_replacecode_open.png" style="cursor:pointer" onclick="replacecode('on');"/></td>
			<td id="code_off" style="text-align:right; padding-bottom:5px; display:none;"><img src="../img/btn_alimtalk_replacecode_close.png" style="cursor:pointer" onclick="replacecode('off');"/></td>
			<td id="code_comment" class="extext" style="padding-left:5px;"></td>
		</tr>
		<tr>
			<td style="border:1px solid #bdbdbd; height:38px; text-align:center; background-color:#FEE800;"><img src="../img/alimtalk_icon.png" style="height:100%;"/></td>
			<td style="padding-left:5px; vertical-align: top;width:300px;" rowspan="2">
				<div style="width:100%; height:220px; overflow:auto">
				<? foreach($replacecode as $k => $v) {?>
				<table class="tb" id="<?=$k?>_tb" style="display:none;">
				<col class="cellC"><col class="cellL">
				<tr>
					<td>ġȯ�ڵ�</td>
					<td>����</td>
					<td>�߰�</td>
				</tr>
				<?foreach($v as $v2) {?>
				<tr>
					<td>#{<?=$v2?>}</td>
					<td><?=$desc[$v2]?></td>
					<td><a href="javascript:insertCode('#{<?=$v2?>}');"><img src="../img/i_add.gif" border="0" align="absmiddle"/></a></td>
				</tr>
				<?}?>
				</table>
				<?}?>
				</div>
			</td>
		</tr>
		<tr>
			<td style="width:264px; height:180px; border:1px solid #bdbdbd;">
			<textarea id="contents" name="contents" style="border:0px; width:100%; height:100%; background-color:#fefcea"><?=$data['contents']?></textarea>
			</td>
		</tr>
		<tr>
			<td><span class="inputSize:{target:'contents',max:1000}"></span></td>
		</tr>
		<tr>
			<td style="padding-top:10px;"><div class="extext">���ø������� URL�� ������ 1,000�ڱ��� ����ϽǼ� �ֽ��ϴ�.
			<br>ġȯ�ڵ� ��� �� 1,000�ڰ� ���� �ʵ��� �������ּ���.<br>�˸��忡 ġȯ�ڵ带 ����Ͻ÷��� ��� ġȯ�ڵ� �տ� #�� �ٿ� �Է��ϼž� �մϴ�.</div></td>
		</tr>
		</table>
	</td>
</tr>
</table>
<div class="extext" style="padding-top:10px;">��� ���ø��� ��� �� īī������ �˼� �ϷḦ �ؾ� ����� �����մϴ�.</div>
<div class="button">
<input type="image" src="../img/btn_register.gif">
</div>
</form>

<script type="text/javascript" src="../js/adm_form.js?ts=<?=date('Ym')?>"></script>
<script type="text/javascript">
Event.observe(document, "dom:loaded", function(){
	nsAdminForm.init($("goods-form"));
	nsAdminForm.inputSizeIndicator.init();
});

function replacecode(mode) {
	var comment = ' ġȯ�ڵ常 ����˴ϴ�.';

	if (mode == 'on') {
		var selectValue = form.tmode.options[form.tmode.selectedIndex].value;
		document.getElementById('order_tb').style.display = 'none';
		document.getElementById('member_tb').style.display = 'none';
		document.getElementById('board_tb').style.display = 'none';
		document.getElementById(selectValue+'_tb').style.display = '';
		document.getElementById('code_on').style.display = 'none';
		document.getElementById('code_off').style.display = '';

		if (selectValue == 'order') {
			document.getElementById('code_comment').innerHTML = '�ֹ�����'+comment;
		}
		else if (selectValue == 'member') {
			document.getElementById('code_comment').innerHTML = 'ȸ������'+comment;
		}
		else {
			document.getElementById('code_comment').innerHTML = '�Խ��ǰ���'+comment;
		}
	}
	else {
		document.getElementById('order_tb').style.display = 'none';
		document.getElementById('member_tb').style.display = 'none';
		document.getElementById('board_tb').style.display = 'none';
		document.getElementById('code_on').style.display = '';
		document.getElementById('code_off').style.display = 'none';
		document.getElementById('code_comment').innerHTML = '';
	}
}

function insertCode(code) {
	document.getElementById('contents').value += code;
	nsAdminForm.inputSizeIndicator.init();
}
</script>