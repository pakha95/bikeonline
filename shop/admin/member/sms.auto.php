<?

$location = "SMS���� > SMS �ڵ��߼�/����";
include "../_header.php";
include dirname(__FILE__)."/../../lib/callNumber.class.php";
@include "../../conf/kakaoAlimtalk.config.php";
$sms080service = Core::loader('sms080service');
$sms080config = $sms080service->getConfig();

//����ȣ����, �ܺ�ȣ����
$outsideServer = false;
if($godo['webCode'] == 'webhost_outside' || $godo['webCode'] == 'webhost_server'){
	$outsideServer = true;
}

$r_deny = array(
		'join'			=> '000',
		'id_pass'		=> '011',
		'order'			=> '000',
		'incash'		=> '000',
		'account'		=> '011',
		'delivery'		=> '011',
		'dcode'			=> '011',
		'cancel'		=> '011',
		'repay'			=> '011',
		'runout'		=> '100',
		'qna_register'	=> '000',
		'birth'			=> '011',
		'qna'			=> '011',
		'buy_coupon'	=> '011',
		'member'		=> '011',
		'dormant'		=> '011',
		'reception_agreement'		=> '011',
		'coupon_expire'	=> '011',
	);

$r_code = array(
		'join'			=> 'ȸ�����Խ� �߼�',
		'id_pass'		=> '��й�ȣã��� �߼�',
		'order'			=> '�ֹ������� �߼� <font class="small1">(�������ֹ��� �ش�, ī������ֹ��� �߼��� �ȵ˴ϴ�)',
		'incash'		=> '�Ա�Ȯ�ν� �߼� <font class="small1">(�������Ա�Ȯ��, ī��������ν� �߼۵˴ϴ�)',
		'account'		=> '�Աݿ�û �߼� <font class="small1">(�������ֹ��� �ش�, �ֹ������� �߼۵˴ϴ�)',
		'delivery'		=> '��ǰ��۽� �߼� <font class="small1">(����� ���·� �ٲ���� �� �߼۵˴ϴ�)',
		'dcode'			=> '�����ȣ �߼� <font class="small1">(����� ���·� �ٲ���� �� �߼۵˴ϴ�)',
		'cancel'		=> '�ֹ���ҽ� �߼� <font class="small1">(�ֹ���� ���·� �ٲ���� �� �߼۵˴ϴ�)',
		'repay'			=> 'ȯ�ҿϷ�� �߼�',
		'runout'		=> '��ǰǰ���� �߼� <font class="small1">(�ֹ��� ��ǰ�� ǰ���Ǿ����� �����ڿ��� �߼۵˴ϴ�)',
		'qna_register'		=> '1:1���ǿ� ��ǰ���� ��Ͻ� �߼�<font class="small1"></br><span style="margin-left:8px;">(�ۼ��� �ڵ�����ȣ�� �Է��� �����Ը� �߼�)</span>',
		'qna'			=> '1:1���� �亯��Ͻ� �߼�',
		'buy_coupon'		=> '���� �� �ڵ��߱� ���� �߱޽� �߼�',
		'birth'			=> '����ȸ�� �ڵ��߼� <font class="small1">(���� �����ڰ� �ִ°�� �����ڸ��ο��� Ȯ��)',
		'dormant'		=> '�޸� ��ȯ ���� �ȳ� �߼�',
		'reception_agreement'		=> '���ŵ��ǿ��� Ȯ�� �ȳ� �߼� <img src="../img/btn_smsAutoSendGuide.gif" border="0" onclick="javascript:smsAutoSendLayerInfoBox(event, \'agreement\', 450, 330);" style="cursor: pointer;" align="absmiddle" />',
		'coupon_expire'	=> '���� ���� �ȳ� �ڵ��߼�&nbsp;<img src="../img/btn_smsAutoSendGuide.gif" alt="���ȳ�" title="���ȳ�" border="0" onclick="javascript:smsAutoSendLayerInfoBox(event, \'coupon_expire\', 500, 250);" style="cursor: pointer;" align="absmiddle" />',
	);

//������� ����
$smsMessageBoxIndex = array(
	'�ֹ�����' => array(
		'order',	//�ֹ�����
		'incash',	//�Ա�Ȯ��
		'account',	//�Աݿ�û
		'delivery',	//��ǰ���
		'dcode',	//�����ȣ
		'cancel',	//�ֹ����
		'repay',	//ȯ�ҿϷ�
		'runout',	//��ǰǰ��
	),
	'ȸ������' => array(
		'join',		//ȸ������
		'id_pass',	//��й�ȣã��
		'dormant',	//�޸�ȸ�� ��ȯ ���� �ȳ�
		'reception_agreement',	//���ŵ��ǿ��� Ȯ�� �ȳ� �߼�
	),
	'�Խ��ǰ���' => array(
		'qna_register',	//1:1���ǿ� ��ǰ���� ���
		'qna',			//1:1���� �亯���
	),
	'���θ��' => array(
		'birth',		//����ȸ��
		'buy_coupon',	//������ �ڵ��߱� ���� �߱�
		'coupon_expire',//�������� �ȳ�
	),
);

$smsRecall	= explode("-",$cfg['smsRecall']);
$smsAdmin	= explode("-",$cfg['smsAdmin']);

# �߰������� ����
$smsAddAdminArr	= explode("|",$cfg['smsAddAdmin']);
$smsAddAdmin[0]	= explode("-",$smsAddAdminArr[0]);

if(!$cfg['smsAutoSendType'])$cfg['smsAutoSendType']="LIMIT";
$checked = array(
    'smsAutoSendType' => array($cfg['smsAutoSendType'] => ' checked="checked"'),
);

$info_cfg = $config->load('member_info');

$callNumber = new callNumber;
$callbackData = $callNumber->getCallNumberData('callback');

if($cfg['smsPass']){
	$smsPassStatus = '****';
	$smsPassChkValue = '����';
}
else {
	$smsPassStatus = '�̵��';
	$smsPassChkValue = '���';
}

// īī�� �˸��� ���� Ȯ��
$alimtalkTemp = array();
if ($alimtalk['order_use'] == 'y') {
	$alimtalkTemp[] = '[�ֹ�����]';
}
if ($alimtalk['member_use'] == 'y') {
	$alimtalkTemp[] = '[ȸ������]';
}
if ($alimtalk['board_use'] == 'y') {
	$alimtalkTemp[] = '[�Խ��ǰ���]';
}

$alimtalkComment = implode(', ',$alimtalkTemp);
?>
<script type="text/javascript" src="../godo_ui.js?ts=<?=date('Ym')?>"></script>
<script Language=javascript>
/*** �߰������� ***/
function addfld(obj)
{
	var tb = document.getElementById(obj);
	oTr = tb.insertRow();
	oTd = oTr.insertCell();
	oTd.innerHTML = "<span>" + tb.rows[0].cells[0].getElementsByTagName('span')[0].innerHTML + "</span> <a href='javascript:void(0);' onClick='delfld(this)'><img src='../img/i_del.gif' align='absmiddle' /></a>";
	oTd = oTr.insertCell();
	oTd = oTr.insertCell();
}

function delfld(obj)
{
	var tb = obj.parentNode.parentNode.parentNode.parentNode;
	tb.deleteRow(obj.parentNode.parentNode.rowIndex);
}
function smsPassDisplay(smsPassEl)
{
	if(smsPassEl.checked == true){
		document.getElementById("smsPass").style.display = '';
	}
	else {
		document.getElementById("smsPass").style.display = 'none';
	}
}
</script>
<form method="post" action="indb.php">
<input type="hidden" name="mode" value="sms_auto" />

<div class="title title_top"><font face="����" color="black"><b>SMS</b></font> ���������� �Է�<span>SMS ������������ �Է��ϼ���</span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=member&no=8')"><img src="../img/btn_q.gif" border="0" align="absmiddle" hspace="2" /></a></div>

<table class="tb">
<col class="cellC"><col class="cellL">
<tr>
	<td>SMS ��й�ȣ ����</td>
	<td>
	<?php echo $smsPassStatus; ?>
	&nbsp;&nbsp;
	<input type="checkbox" name="smsPassChk" value="y" valign="bottom" onclick="javascript:smsPassDisplay(this);" /><?php echo $smsPassChkValue; ?>
	<input type="password" name="smsPass" id="smsPass" value="" maxlength="4" onkeydown="onlynumber();"  class="line" style="display: none; margin-right: 5px;" />
	<font class="extext"><a href="https://www.godo.co.kr/mygodo/myGodo_shopMain.php" target="_blank"><font class=extext_l>[���̰� > ���� ���θ�]</font></a> ���� ��й�ȣ�� ���� ����ϰ�, ������ ��й�ȣ�� �Է��ϼ���</font></td>
</tr>
<tr>
	<?
	$tooltipMsg = "
		<span class='red'>�ڵ��߼�/������ ����� �߽Ź�ȣ�� �Ʒ��� ���� �߼� �� �߽Ź�ȣ�� ���˴ϴ�.</span>
		<ul style='margin:0;padding-left:20px;'>
			<li style='list-style:disc'>ȸ������ Ȯ�� ����</li>
			<li style='list-style:disc'>��й�ȣ ã�� Ȯ�� ����</li>
			<li style='list-style:disc'>������ �ֹ� Ȯ�� ����</li>
			<li style='list-style:disc'>ī�����/������ �Ա� Ȯ�� ����</li>
			<li style='list-style:disc'>������ �ֹ� �Ա� ��û ����</li>
			<li style='list-style:disc'>��ǰ ����� �ȳ� ����</li>
			<li style='list-style:disc'>���� ��ȣ Ȯ�� ����</li>
			<li style='list-style:disc'>�ֹ���� Ȯ�� ����</li>
			<li style='list-style:disc'>ȯ�ҿϷ� Ȯ�� ����</li>
			<li style='list-style:disc'>��ǰ ǰ���� �ȳ� ����</li>
			<li style='list-style:disc'>����ȸ�� ���� ����</li>
			<li style='list-style:disc'>1:1���� �亯 �Ϸ� ����</li>
			<li style='list-style:disc'>��ٱ��� �˸�����</li>
		</ul>
	";
	?>
	<td>�߽Ź�ȣ <img src="../img/btn_question.gif" style="vertical-align:middle;cursor:pointer;" class="godo-tooltip" tooltip="<?echo $tooltipMsg?>"></td>
	<td>
		<input type="text" name="smsRecall" value="<?=str_replace("-","",$cfg[smsRecall])?>" size="12"  class="line" readonly="readonly" />
		<a onclick="popup_return('../member/popup.callNumber.php?target=smsRecall&changeColor=Y','callNumber',450,250,0,0,'yes')" class="hand"><img src="../img/call_number_btn.gif" align="absmiddle"></a>
		<span id="smsRecallText" class="red"></span>
	</td>
</tr>
<tr>
	<td>������ �ڵ���</td>
	<td>
	<input type="text" name="smsAdmin[]" size="4" maxlength="3" value="<?=$smsAdmin[0]?>" onkeydown="onlynumber();"  class="line"/> -
	<input type="text" name="smsAdmin[]" size="4" maxlength="4" value="<?=$smsAdmin[1]?>" onkeydown="onlynumber();"  class="line"/> -
	<input type="text" name="smsAdmin[]" size="4" maxlength="4" value="<?=$smsAdmin[2]?>" onkeydown="onlynumber();"  class="line"/>
	<font class="extext">�����ڿ��Ե� �޼����� �뺸�� �� �ʿ��� ��ȭ��ȣ (������ �ڵ��� ��ȣ)</td>
</tr>
<tr>
	<td>�߰� ������</td>
	<td>

	<table id="addadminField" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse">
	<tr>
		<td>
		<span>
		<input type="text" name="smsAddAdmin1[]" size="4" maxlength="3" value="<?=$smsAddAdmin[0][0]?>" onkeydown="onlynumber();" class="line" /> -
		<input type="text" name="smsAddAdmin2[]" size="4" maxlength="4" value="<?=$smsAddAdmin[0][1]?>" onkeydown="onlynumber();" class="line" /> -
		<input type="text" name="smsAddAdmin3[]" size="4" maxlength="4" value="<?=$smsAddAdmin[0][2]?>" onkeydown="onlynumber();" class="line" />
		</span>
				<a href="javascript:addfld('addadminField');"><img src="../img/i_add.gif" align="absmiddle" /></a>
		<font class="extext">������ �̿��� �߰��� �޾ƾ� �� ����ڰ� ������ �ʿ��� ��ȭ��ȣ</td>

		</td>
	</tr>
	</table>
<?
	for($i = 1; $i < sizeof($smsAddAdminArr); $i++){
		$smsAddAdmin[$i]	= explode("-",$smsAddAdminArr[$i]);
?>
	<table id="addadminField<?=$i?>" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse">
	<tr>
		<td>
		<a href="javascript:void(0);" onClick="delfld(this)"><img src="../img/i_del.gif" align="absmiddle" /></a>
		<span>
		<input type="text" name="smsAddAdmin1[]" size="4" maxlength="3" value="<?=$smsAddAdmin[$i][0]?>" onkeydown="onlynumber();" /> -
		<input type="text" name="smsAddAdmin2[]" size="4" maxlength="4" value="<?=$smsAddAdmin[$i][1]?>" onkeydown="onlynumber();" /> -
		<input type="text" name="smsAddAdmin3[]" size="4" maxlength="4" value="<?=$smsAddAdmin[$i][2]?>" onkeydown="onlynumber();" />
		<font class="extext">�������̿� �߰��� �޾ƾ� �� ����ڰ� ������ �ʿ��� ��ȭ��ȣ</td>
		</span>
		</td>
	</tr>
	</table>
<?
	}
?>
	</td>
</tr>
<tr>
	<td>90Byte �ʰ���<br>�޽��� ���� ���</td>
	<td>
		<input type="radio" name="smsAutoSendType" value="LIMIT" <?php echo $checked['smsAutoSendType']['LIMIT']; ?> />90Byte ������ SMS �߼�
		<input type="radio" name="smsAutoSendType" value="MULTI" <?php echo $checked['smsAutoSendType']['MULTI']; ?> />���� SMS �߼�<br>
		<font class="extext"><?=$lmsPatchText?>�ڵ��߼� ������ ���θ���, �ֹ���ȣ ������ ���Ͽ� 90Byte�� �ʰ��� ����� �޽��� ���� ��� �Դϴ�.<br>��90Byte ������ SMS �߼ۡ����� ������ ��� 90Byte �ʰ��� �޽����� ©�� �� �ֽ��ϴ�.</td>
</tr>
</table>


<div id="MSG01">
<table cellpadding="1" cellspacing="0" border="0" class="small_ex">
<tr><td><img src="../img/icon_list.gif" align="absmiddle" />�߽Ź�ȣ�� ������ �޼����� �߼۽� �߽Ź�ȣ�� ������ ��ȭ��ȣ�Դϴ�. ������ȭ��ȣ �Ǵ� �ڵ�����ȣ�� �Է��ϼ���</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle" />�������ڵ����� �Ʒ� �ڵ��߼۱�ɿ��� �����ڰ� �޼����� �ް��� �� �� �ʿ��մϴ�</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle" />�߰������ڴ� �������̿� �߰��� �޾ƾ� �� ����ڰ� ������ ����� �ϽǼ� �ֽ��ϴ�.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle" />SMS ����Ʈ�� �����Ǿ� �־�� �߼��� �����մϴ�. <a href="sms.pay.php"><font color=white><u>[SMS ����Ʈ �����ϱ�]</u></font></a> ���� �����ϼ���</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle" />������ �߼� �ý��ۻ� ������ �ƴ� ��Ż� ������å �� ��Ÿ ������ ���� ���ڹ߼� ���п� ���� ������ å���� ������, �� ��Ż翡 ����Ȯ���� ���θ��� �����մϴ�.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle" />�߽Ź�ȣ�� ���� ��ϵ��� ������ SMS�� �߼۵��� �ʽ��ϴ�. <a href="http://www.godo.co.kr/news/notice_view.php?board_idx=1247&page=2
" target="_blank"><font color=white><u>�߽Ź�ȣ ��������� �ȳ�</u></font></a></td></tr>

</table>
</div>
<script>cssRound('MSG01');</script>

<div style="padding-top:20px"></div>

<div class="title title_top"><font face="����" color="black"><b>SMS</b></font> �ڵ��߼�/�������� <span>�Ʒ� ������ üũ�Ͻø� �޼����� �ڵ��߼۵˴ϴ�. ������ ������ �� ��Ϲ�ư�� ��������.</span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=member&no=8')"><img src="../img/btn_q.gif" border="0" align="absmiddle" hspace="2" /></a></div>

<div style="color: #0074ba; border: 1px #e8e8e8 solid; padding: 5px; width: 100%; margin: 5px 0 10px 0; line-height: 20px;">
	<div>����! ���� SMS �ڵ��߼� �׸��� ��� (����)������ 080���Űź� ��ȣ�� ������ �߰��ϼž� �մϴ�. <a href="http://www.godo.co.kr/echost/better_godomall.gd?code=enamoo_knowhow&page=1&postNo=23" target="_blank" style="color: #0074ba; font-weight: bold;">[�������� �ڼ��� ����]</a></div>
	<?php if($sms080config['status'] === 'P' || $sms080config['status'] === 'O'){ ?>
		<div>��������� 080���Űź� ��ȣ: <strong><?php echo $sms080config['phoneNumber']; ?></strong></div>
	<?php } else { ?>
		<div>��������� 080���Űź� ��ȣ: 080���Űź� ��ȣ ���� ��û�� ���� ���ּ���. <a href="../member/adm_member_sms080service_info.php" target="_blank" style="color: #0074ba; font-weight: bold;">[080���Űź� ���� �ȳ�/��û �ٷΰ���]</a></div>
	<?php } ?>
</div>
<?if ($alimtalk['use'] == 'y' && $alimtalkComment) {?>
<div style="color: red; border: 1px #e8e8e8 solid; padding: 5px; width: 100%; margin: 5px 0 10px 0; line-height: 20px;">
	<b><?=$alimtalkComment?></b> �׸��� īī�� �˸������� �߼��� �Ǹ�, �ڵ� SMS�� ���ÿ� ����Ͻ� �� �����ϴ�.<br>
	�ٽ� �ڵ� SMS�� ����Ͻ÷���, ȸ�� > īī�� �ϸ��� ���� ���� ���˸��� ��� �������� �������ԡ� ���� �������ּ���
</div>
<?}?>

<!-- SMS �޽��� ����-->
<table width="800">
<?php
foreach ($smsMessageBoxIndex as $indexKey => $indexValue){
	$paddingTop = '';
	if($indexKey !== '�ֹ�����') $paddingTop = 'padding-top: 50px;';
?>
<tr>
	<td style="<?php echo $paddingTop; ?>color: #627dce; font-weight: bold; font-size: 13px;" colspan="2"><img src="../img/icon_menuon_bg.gif" align="absmiddle" /><?php echo $indexKey; ?></td>
</tr>
<tr>
	<td style="background-color: #C8C8C8; height: 1px;" colspan="2"></td>
</tr>
<tr>
	<?
	$idx=0;
	foreach ($indexValue as $v){
		$k = '';
		$k = $v;

		//legacy ����
		if(!array_key_exists($v, $r_code)){
			continue;
		}
		//���� ���� �ȳ� �ڵ��߼��� ����ȣ����, �ܺ�ȣ���� ���� ��� �Ұ���
		if($k == 'coupon_expire' && $outsideServer === true){
			continue;
		}

		unset($checked);
		unset($sms_auto);

		@include "../../conf/sms/$k.php";
		if ($sms_auto['send_c']) $checked['send_c'] = "checked";
		if ($sms_auto['send_a']) $checked['send_a'] = "checked";
		if ($sms_auto['send_m']) $checked['send_m'] = "checked";

		$deny['member']	= substr($r_deny[$k],0,1);
		$deny['admin']	= substr($r_deny[$k],1,1);
		$deny['madmin']	= substr($r_deny[$k],2,1);

		$disabled['member']	= ($deny['member']) ? "disabled" : "";
		$disabled['admin']	= ($deny['admin']) ? "disabled" : "";
		$disabled['madmin']	= ($deny['madmin']) ? "disabled" : "";

		if ($k == 'id_pass' && isset($info_cfg['finder_use_mobile'])) {
			$disabled['member']	= "disabled";
			$disabled['admin']	= "disabled";
			$disabled['madmin']	= "disabled";
			$checked['send_c'] = "";
			$checked['send_a'] = "";
			$checked['send_m'] = "";
		}
		$receiveRefuseMessage = '';

		if($k === 'birth' || $k === 'buy_coupon' || $k === 'coupon_expire'){
			$receiveRefuseMessage = '<div style="color: red; margin-top: 2px;">*���Űźΰ� ����</div>';
		}
	?>
	<td valign="abstop">

	<table border="1" bordercolor="#cccccc" style="border-collapse:collapse;">
	<tr>
		<td colspan="2" class="noline" width="350" height="25">&nbsp;&nbsp;<font color="#0074ba"><b><?=$r_code[$v]?></b></font></td>
	</tr>
<?php
	if (in_array($k, $r_sendDateCode['sms'])) {
		// �⺻�� ó��
		if (empty($sms_auto['sendDate'])) {
			$sms_auto['sendDate']	= $r_sendDateDefault['sms'];
		}
?>
	<tr>
		<td colspan="2" class="noline" width="350" height="25">
			&nbsp;&nbsp;<font color="#0074ba">�߼۴�� : �ֱ�</font>
			<select name="auto[<?php echo $k;?>]['sendDate']">
				<?php foreach ($r_sendDatePeriod['sms'] as $dayVal) {?>
				<option value="<?php echo $dayVal;?>" <?php if ($sms_auto['sendDate'] == $dayVal) echo 'selected="selected"';?>><?php echo $dayVal;?>��</option>
				<?php }?>
			</select>
			<font color="#0074ba">�ֹ��Ǹ�</font>
		</td>
	</tr>
<?php
	}
?>
	<?php
	if($k === 'dormant'){
		if(!$sms_auto['sendTime']) $sms_auto['sendTime'] = '9';
		$selected['sendTime'][$sms_auto['sendTime']] = "selected='selected'";
	?>
	<tr>
		<td colspan="2" class="noline" width="350" height="25">
			<span style="color: #0074ba;">&nbsp;&nbsp;�߼� ��� : �޸�ȸ�� ��ȯ
			<input type="checkbox" name="auto[<?=$k?>]['sendBeforeDay_30']" value='y' <?php if($sms_auto['sendBeforeDay_30'] == 'y') echo 'checked="checked"'; ?> />�Ѵ� ��,
			<input type="checkbox" name="auto[<?=$k?>]['sendBeforeDay_7']" value='y' <?php if($sms_auto['sendBeforeDay_7'] == 'y') echo 'checked="checked"'; ?> />������ ��
			�߼�</span>
		</td>
	</tr>
	<tr>
		<td colspan="2" class="noline" width="350" height="25">
			<span style="color: #0074ba;">&nbsp;&nbsp;�߼� ���� : ����
			<select name="auto[<?=$k?>]['sendTime']">
				<?php for($i=8; $i<22; $i++){ ?>
				<option value="<?php echo $i; ?>" <?php echo $selected['sendTime'][$i]; ?>><?php echo $i; ?></option>
				<?php } ?>
			</select>
			�� �߼�</span>
		</td>
	</tr>
	<?php
	//���� ���� �ȳ� �ڵ��߼�
	} else if ($k === 'coupon_expire') {
		if(!$sms_auto['beforeDate']) $sms_auto['beforeDate'] = '7';
		if(!$sms_auto['couponExpireSendTime']) $sms_auto['couponExpireSendTime'] = '14';
		$selected['beforeDate'][$sms_auto['beforeDate']] = "selected='selected'";
		$selected['couponExpireSendTime'][$sms_auto['couponExpireSendTime']] = "selected='selected'";
	?>
	<tr>
		<td colspan="2" class="noline" width="350" height="25">
			<span style="color: #0074ba;">&nbsp;&nbsp;���� ���� ����ȸ������
			<select name="auto[<?=$k?>]['beforeDate']">
				<?php for($i=1; $i<8; $i++){ ?>
				<option value="<?php echo $i; ?>" <?php echo $selected['beforeDate'][$i]; ?>><?php echo $i; ?>��</option>
				<?php } ?>
			</select>
			��&nbsp;
			<select name="auto[<?=$k?>]['couponExpireSendTime']">
				<?php for($i=8; $i<22; $i++){ ?>
				<option value="<?php echo $i; ?>" <?php echo $selected['couponExpireSendTime'][$i]; ?>><?php echo $i; ?>��</option>
				<?php } ?>
			</select>
			�߼�</span>
		</td>
	</tr>
	<?php
	} else if($k === 'account'){
		//����ȣ����, �ܺ�ȣ������ �Աݿ�û �߼� - �߰��߼��� ��� �� �� ����
		if($outsideServer === false){
			if(!$sms_auto['afterDate']) $sms_auto['afterDate'] = '3';
			if(!$sms_auto['accountSendTime']) $sms_auto['accountSendTime'] = '13';
			$checked['useAccountAutoSend']['y'] = "checked='checked'";
			$selected['afterDate'][$sms_auto['afterDate']] = "selected='selected'";
			$selected['accountSendTime'][$sms_auto['accountSendTime']] = "selected='selected'";
	?>
	<tr>
		<td colspan="2" class="noline" width="350" height="25">
			<span style="color: #0074ba;">
			<input type="checkbox" name="auto[<?=$k?>]['useAccountAutoSend']" value='y' <?php echo $checked['useAccountAutoSend'][$sms_auto['useAccountAutoSend']]; ?> />
			�ֹ�
			<select name="auto[<?=$k?>]['afterDate']">
				<?php for($i=1; $i<8; $i++){ ?>
				<option value="<?php echo $i; ?>" <?php echo $selected['afterDate'][$i]; ?>><?php echo $i; ?>��</option>
				<?php } ?>
			</select>
			��&nbsp;
			<select name="auto[<?=$k?>]['accountSendTime']">
				<?php for($i=8; $i<22; $i++){ ?>
				<option value="<?php echo $i; ?>" <?php echo $selected['accountSendTime'][$i]; ?>><?php echo $i; ?>��</option>
				<?php } ?>
			</select>
			�� �߰��߼�
			</span>
			&nbsp;<img src="../img/btn_smsAutoSendGuide.gif" alt="���ȳ�" title="���ȳ�" border="0" onclick="javascript:smsAutoSendLayerInfoBox(event, 'account', 550, 130);" style="cursor: pointer;" align="absmiddle" />
		</td>
	</tr>
	<?php
		}
	} else if($k === 'reception_agreement') {
		include '../../lib/receptionAgreement.class.php';
		$receptionAgreement = new receptionAgreement();
		if($receptionAgreement->migration === false) {
			$disabled[member] = 'disabled';
		}

		$selected[$k]['sendTime'][$sms_auto['sendTime']] = "selected='selected'";

		$sms080_disabled = 'disabled="disabled"';

		//SMS080����
		if(is_file(dirname(__FILE__).'/../../lib/sms080service.class.php')){
			$sms080service = Core::loader('sms080service');
			$sms080config = $sms080service->getConfig();
			if($sms080config['status'] == 'O' && $sms080config['useyn'] == 'y'){
				$sms080_disabled = '';
			}
		}
	?>
	<tr>
		<td colspan="2" class="noline" width="350" height="25">
			<span style="color: #0074ba;">&nbsp;&nbsp;�߼� ��� : ���ŵ��� �� 1�� 11������ ���� ȸ�� <img src="../img/icons/icon_qmark.gif" border="0" onclick="javascript:smsAutoSendLayerInfoBox(event, 'agreementMember', 450, 50);" style="cursor: pointer;" align="absmiddle" /></span>
		</td>
	</tr>
	<tr>
		<td colspan="2" class="noline" width="350" height="25">
			<span style="color: #0074ba;">&nbsp;&nbsp;�߼� ���� : ����
			<select name="auto[<?=$k?>]['sendTime']">
				<?php for($i=8; $i<22; $i++){ ?>
				<option value="<?php echo $i; ?>" <?php echo $selected[$k]['sendTime'][$i]; ?>><?php echo $i; ?></option>
				<?php } ?>
			</select>
			�� �߼�</span>
		</td>
	</tr>
	<tr>
		<td colspan="2" class="noline" width="350" height="25">
			<span style="margin-left:8px;"><input type="checkbox" id="sms080warning" name="auto[<?=$k?>]['sendBeforeDay_30']" value='y' <?=$sms080_disabled?> <?php if($sms_auto['sendBeforeDay_30'] == 'y') echo 'checked="checked"'; ?> onclick="javascript:sms080warningContents('receptAgree', 'auto[<?=$k?>][\'msg_c\']');" /><span style="color: #0074ba;">������Űź� ��ȣ �߰�</span></span>
			<img src="..//img/icons/icon_qmark.gif" alt="���ȳ�" title="���ȳ�" border="0" onclick="javascript:smsAutoSendLayerInfoBox(event, 'agreement080', 550, 50);" style="cursor: pointer;" align="absmiddle" />
		</td>
	</tr>
	<?php
	}else {}
	?>
	<tr>
		<td align="center" style="padding-bottom:5px" valign="top">

		<? if (!$deny['member']){ ?>
		<table cellpadding="0" cellspacing="0">
		<tr><td><img src="../img/sms_top.gif" /></td></tr>
		<tr>
			<td background="../img/sms_bg.gif" align="center" height="81" align="center">
			<textarea id="auto[<?=$k?>]['msg_c']" name="auto[<?=$k?>]['msg_c']" cols="16" rows="5" style="font:9pt ����ü;overflow:hidden;border:0;background-color:transparent;" onkeydown="return chkLength(this)"><?=$sms_auto['msg_c']?></textarea>
			</td>
		</tr>
		<tr><td><img src="../img/sms_bottom.gif" /></td></tr>
		<tr><td height=3></td></tr>
		</table>
		<? } else {?>
		<img src="../img/sms_only_admin.gif" />
		<? } ?>
		<div><input type="checkbox" name="auto[<?=$k?>]['send_c']" <?=$checked['send_c']?> <?=$disabled['member']?> class="null" />������ �ڵ��߼�</div>
		<?php echo $receiveRefuseMessage; ?>
		</td>
		<td align="center" style="padding-bottom:5px" valign="top">

		<? if (!$deny['admin']){ ?>
		<table cellpadding="0" cellspacing="0">
		<tr><td><img src="../img/sms_top.gif" /></td></tr>
		<tr>
			<td background="../img/sms_bg.gif" align="center" height="81" align="center">
			<textarea name="auto[<?=$k?>]['msg_a']" cols="16" rows="5" style="font:9pt ����ü;overflow:hidden;border:0;background-color:transparent;" onkeydown="return chkLength(this)"><?=$sms_auto['msg_a']?></textarea>
			</td>
		</tr>
		<tr><td><img src="../img/sms_bottom.gif" /></td></tr>
		<tr><td height=3></td></tr>
		</table>
		<? } else {?>
		<img src="../img/sms_only_user.gif" />
		<? } ?>
		<div style="text-align:left;padding-left:13px;"><input type="checkbox" name="auto[<?=$k?>]['send_a']" <?=$checked['send_a']?> <?=$disabled['admin']?> class="null" />�����ڿ��Ե� �߼�</div>
		<div style="text-align:left;padding-left:13px;"><input type="checkbox" name="auto[<?=$k?>]['send_m']" <?=$checked['send_m']?> <?=$disabled['madmin']?> class="null" />�߰������ڿ��Ե� �߼�</div>
		</td>
	</tr>
	</table>

<?php
	if($k === 'reception_agreement') {
		echo $receptionAgreement->migration_sms();
	}
?>

	</td>
	<? if ($idx++%2){ ?></tr><tr><? } ?>
	<? } ?>
</tr>
<?php
}
?>
</table>

<div class="button">
<table width="800" border="0" align="left">
<tr><td width="343" align="right"><input type="image" src="../img/btn_register.gif" /></td>
<td width="5"></td>
<td width="452" align="left"><a href="javascript:history.back();"><img src="../img/btn_cancel.gif" /></a></td>
</tr></table>
</div>

</form>
<script type="text/javascript">
smsRecallColor('smsRecall','<?echo str_replace("-","",$cfg[smsRecall])?>','<?echo @implode($callbackData, ",")?>');
</script>

<? include "../_footer.php"; ?>