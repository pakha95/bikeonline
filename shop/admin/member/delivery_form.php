<?
include "../_header.popup.php";
include '../../conf/fieldset.php';

$mode = empty($_REQUEST['mode']) ? 'add' : $_REQUEST['mode'];
$mno = empty($_REQUEST['mno']) ? '' : $_REQUEST['mno'];
$sno = empty($_REQUEST['sno']) ? '' : $_REQUEST['sno'];

$cnt_query = "SELECT COUNT(*) FROM ".GD_MEMBER_DELIVERY." dm WHERE dm.gmd_m_no = ".$mno;
list ($cnt) = $db->fetch($cnt_query);
if($cnt >= 10 && !$sno) {
	msg('��ϰ����� ������� ��� ����Ͽ����ϴ�. ����� ���� �� �ٽ� �õ����ּ���.', -1);
} else {
	if($mode == "edit") {
		$q_select = "SELECT * FROM ".GD_MEMBER_DELIVERY." dm WHERE dm.gmd_sno = ".$sno;
		$edit = $db->fetch($q_select, 1);
		$a_zipcode = explode('-', $edit['gmd_zipcode']);
		$edit['zipcode'][0] = $a_zipcode[0];
		$edit['zipcode'][1] = $a_zipcode[1];
		$a_phone = explode('-', $edit['gmd_phone']);
		$edit['phone'][0] = $a_phone[0];
		$edit['phone'][1] = $a_phone[1];
		$edit['phone'][2] = $a_phone[2];
		$a_mobile = explode('-', $edit['gmd_mobile']);
		$edit['mobile'][0] = $a_mobile[0];
		$edit['mobile'][1] = $a_mobile[1];
		$edit['mobile'][2] = $a_mobile[2];
	}
}
?>
<style type="text/css">
	.delivery_div { overflow:hidden; }
	.delivery_div .dtitle_popup { width:100%; font-weight:bold; font-size: 22px; height:50px; line-height:50px; padding-left:15px; border-bottom:1px solid #D8D8D8; background:#fff; color:#000; }
	.delivery_div .dcontents_popup { padding:15px 0 0px 15px; color:#444; }
	.delivery_div .mydtit { height:25px; line-height:25px; }
	.d_form input[type=text], input.text { clear:both; border:1px solid #ccc; height:28px; background:#FCFCFC; line-height:24px; }
	.d_form table { width:98%; border-top:1px solid #C1C1C1; margin:0 auto; }
	.d_form table th { height:50px; border-right:1px solid #C1C1C1; border-bottom:1px solid #C1C1C1; text-align:center; background:#FAFAFA; color:#444; }
	.d_form table td { height:50px; border-bottom:1px solid #C1C1C1; padding-left:10px; }
	.btn_div { text-align:center; height:50px; margin-top:30px; }
	.vmiddle { vertical-align:middle; }
	.w80 { width:80px; }
	.w300 { width:300px; }
	.right { text-align:right; height:25px; padding-right:10px; }
</style>
<form  name="form" method="post" action="delivery_indb.php">
<input type="hidden" name="mode" value="<?=$mode?>" />
<input type="hidden" name="mno" value="<?=$mno?>" />
<input type="hidden" name="sno" id="sno" value="<?=$sno?>" />
<div class="delivery_div">
	<div id="deliveryForm" class="delivery_form">
		<div class="dtitle_popup">����� <?=$sno ? '����' : '�߰�' ?></div>
		<div class="dcontents_popup">������� �Է����ּ���.</div>
		<div class="right">
			<input type="checkbox" name="gmd_default" id="gmd_default" value="y" class="vmiddle" <?=$edit['gmd_default'] ? 'checked' : ''?> /><label for="gmd_default">�⺻ ������� �����մϴ�.</label>
		</div>
		<div class="d_form">
			<table cellpadding="0" cellspacing="0">
				<colgroup><col width="20%"><col width="*"></colgroup>
				<tr>
					<th>�������</th>
					<td><input type="text" name="delivery_name" value="<?=$edit['gmd_title']?>" class="text w300" /></td>
				</tr>
				<tr>
					<th><span class="red">* </span>�����Ǻ�</th>
					<td><input type="text" name="delivery_receiver" value="<?=$edit['gmd_name']?>" class="text w300" /></td>
				</tr>
				<tr>
					<th rowspan="3"><span class="red">* </span>�����ǰ�</th>
					<td style="border:none;height:30px;padding-top:10px;">
					<input type="text" name="zonecode" id="zonecode" size="5" class="text vmiddle" readonly value="<?=$edit['gmd_zonecode']?>" />
					( <input type="text" name="zipcode[]" id="zipcode0" size="3" class="text vmiddle" readonly value="<?=$edit['zipcode'][0]?>" /> -
					<input type="text" name="zipcode[]" id="zipcode1" size="3" class="text vmiddle" readonly value="<?=$edit['zipcode'][1]?>" /> )
					<a href="javascript:popup('../../proc/popup_address.php',500,432)"><img src="../img/btn_delivery_search.png" class="vmiddle"></a>
					</td>
				</tr>
				<tr>
					<td style="border:none;height:30px;padding-top:10px;">
						<input type="text" name="address" id="address" class="text w300" readonly value="<?=$edit['gmd_address']?>">
					</td>
				</tr>
				<tr>
					<td>
						<input type="text" name="address_sub" id="address_sub" class="text w300" value="<?=$edit['gmd_address_sub']?>" onkeyup="SameAddressSub(this)" oninput="SameAddressSub(this)" />
						<input type="hidden" name="road_address" id="road_address" style="width:100%" value="<?=$edit['gmd_road_address']?>" class="text" />
						<div style="padding:5px 5px 0 1px;font:12px dotum;color:#999;" id="div_road_address"><?=$edit['gmd_road_address']?></div>
						<div style="padding:5px 0 0 1px;font:12px dotum;color:#999;" id="div_road_address_sub"><?=$edit['gmd_road_address'] ? $edit['gmd_address_sub'] : '' ?></div>
					</td>
				</tr>
				<tr>
					<th><span class="red">* </span>��ȭ��ȣ</th>
					<td>
						<input type="text" name="phoneReceiver[]" value="<?=$edit['phone'][0]?>" maxlength="3" option="regNum" class="w80 text vmiddle" label="������ ��ȭ��ȣ" /> -
						<input type="text" name="phoneReceiver[]" value="<?=$edit['phone'][1]?>" maxlength="4" option="regNum" class="w80 text vmiddle" label="������ ��ȭ��ȣ" /> -
						<input type="text" name="phoneReceiver[]" value="<?=$edit['phone'][2]?>" maxlength="4" option="regNum" class="w80 text vmiddle" label="������ ��ȭ��ȣ" />
					</td>
				</tr>
				<tr>
					<th><span class="red">* </span>�޴�����ȣ</th>
					<td>
						<input type="text" name="mobileReceiver[]" value="<?=$edit['mobile'][0]?>" maxlength="3" option="regNum" class="w80 text vmiddle" label="������ �ڵ�����ȣ" /> -
						<input type="text" name="mobileReceiver[]" value="<?=$edit['mobile'][1]?>" maxlength="4" option="regNum" class="w80 text vmiddle" label="������ �ڵ�����ȣ" /> -
						<input type="text" name="mobileReceiver[]" value="<?=$edit['mobile'][2]?>" maxlength="4" option="regNum" class="w80 text vmiddle" label="������ �ڵ�����ȣ" />
					</td>
				</tr>
			</table>
			<div class="btn_div">
				<a href="javascript:deli_save();"><img src="../img/btn_delivery_save.png" alt="����" title="����" /></a>&nbsp;
				<a href="javascript:deli_list();"><img src="../img/btn_delivery_list2.png" alt="���" title="���" /></a>
			</div>
		</div>

	</div>
</div>
</form>
<script type="text/javascript">
	var mode = "<?=$mode?>";
	var mno = "<?=$mno?>";

	function deli_list() {
		location.href="./popup.delivery.php?mode=list&mno="+mno;
	}

	function deli_save() {
		var frm = document.form;
		if(!frm.delivery_receiver.value.trim()) {
			alert("������ ���� �Է����ּ���.");
			frm.delivery_receiver.focus();
		} else if(!frm["zipcode[]"][0].value) {
			alert("�ּҸ� �Է����ּ���.");
			frm["zipcode[]"][0].focus();
		} else if(!frm["phoneReceiver[]"][0].value.trim()) {
			alert("��ȭ��ȣ�� �Է����ּ���.");
			frm["phoneReceiver[]"][0].focus();
		} else if(!frm["phoneReceiver[]"][1].value.trim()) {
			alert("��ȭ��ȣ�� �Է����ּ���.");
			frm["phoneReceiver[]"][1].focus();
		} else if(!frm["phoneReceiver[]"][2].value.trim()) {
			alert("��ȭ��ȣ�� �Է����ּ���.");
			frm["phoneReceiver[]"][2].focus();
		} else if(!frm["mobileReceiver[]"][0].value.trim()) {
			alert("�޴�����ȣ�� �Է����ּ���.");
			frm["mobileReceiver[]"][0].focus();
		} else if(!frm["mobileReceiver[]"][1].value.trim()) {
			alert("�޴�����ȣ�� �Է����ּ���.");
			frm["mobileReceiver[]"][1].focus();
		} else if(!frm["mobileReceiver[]"][2].value.trim()) {
			alert("�޴�����ȣ�� �Է����ּ���.");
			frm["mobileReceiver[]"][2].focus();
		} else {
			var valiCheck = chkForm(frm);
			if(valiCheck) {
				frm.delivery_name.value = !frm.delivery_name.value ? frm.delivery_receiver.value : frm.delivery_name.value;
				frm.submit();
			}
		}
	}
</script>