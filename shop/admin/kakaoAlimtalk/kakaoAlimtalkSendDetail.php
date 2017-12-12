<?
include "../_header.popup.php";
include "../../lib/page.class.php";
include "../../lib/kakaoAlimtalk.class.php";

$kakaoAlimtalk = new kakaoAlimtalk();

if (!$_GET['page_num']) $_GET['page_num'] = 10;
$selected['page_num'][$_GET['page_num']] = 'selected';
$selected['skey'][$_GET['skey']] = 'selected';
$selected['fail_code'][$_GET['fail_code']] = 'selected';
$selected['send_status'][$_GET['send_status']] = 'selected';

$where = $kakaoAlimtalk->getSendAlimtalkDetailQuery($_GET);

$pg = new Page($_GET['page'],$_GET['page_num']);
$pg->setQuery(GD_KAKAOALIMTALK_SENDLIST,$where,'sno desc');
$pg->exec();

$res = $db->query($pg->query);
?>
<div class="title title_top">�˸��� �߼۳��� ��</div>
<form>
<table class="tb" width="100%">
<col class="cellC" /><col class="cellL" style="width:250" />
<col class="cellC" /><col class="cellL" />
<tr>
	<td>�˻���</td>
	<td colspan="3">
	<select name="skey">
		<option value="all" <?=$selected['skey']['all']?>> ���հ˻� </option>
		<option value="send_number" <?=$selected['skey']['send_number']?>> ���Ź�ȣ </option>
		<option value="send_contents" <?=$selected['skey']['send_contents']?>> ���� </option>
	</select> <input type="text" name="sword" value="<?=$_GET['sword']?>" class="line" />
	</td>
</tr>
<tr>
	<td>�߼۰��</td>
	<td>
	<select name="send_status">
		<option value="" <?=$selected['send_status']['']?>> ��ü���� </option>
		<option value="s" <?=$selected['send_status']['s']?>> �߼ۼ��� </option>
		<option value="f" <?=$selected['send_status']['f']?>> �߼۽��� </option>
		<option value="w" <?=$selected['send_status']['w']?>> ������Ŵ�� </option>
	</select>
	</td>

	<td>���л���</td>
	<td>
	<select name="fail_code">
		<option value="" <?=$selected['fail_code']['']?>> ��ü���� </option>
		<option value="1" <?=$selected['fail_code']['1']?>> �޽����� ������ �� ���� </option>
		<option value="2" <?=$selected['fail_code']['2']?>> ��ȭ��ȣ ���� </option>
		<option value="3" <?=$selected['fail_code']['3']?>> �޽��� �������� </option>
		<option value="4" <?=$selected['fail_code']['4']?>> �ý��� ���� </option>
		<option value="5" <?=$selected['fail_code']['5']?>> ��Ÿ ���� </option>
	</select>
	</td>
</tr>
</table>

<div class="button_top"><input type="image" src="../img/btn_search2.gif" /></div>

<table width="100%">
<tr>
	<td align="right">
	<select name="page_num" onchange="this.form.submit();" style="padding-right:10px;">
	<?
	$r_pagenum = array(10,20,40,60,100);
	foreach ($r_pagenum as $v) {
	?>
	<option value="<?=$v?>" <?=$selected['page_num'][$v]?>><?=$v?>�� ���</option>
	<? } ?>
	</select>
	</td>
</tr>
</table>

<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr><td class="rnd" colspan="7"></td></tr>
<tr class="rndbg">
	<th>��ȣ</th>
	<th>�˸��� �����Ͻ�</th>
	<th>�̸�</th>
	<th>���Ź�ȣ</th>
	<th>�޽���</th>
	<th>�߼۰��</th>
	<th>���л���</th>
</tr>
<colgroup>
	<col style="width:20px;">
	<col style="width:50px;">
	<col style="width:30px;">
	<col style="width:60px;">
	<col style="width:100px;">
	<col style="width:80px;">
	<col style="width:80px;">
</colgroup>
<?
while ($data = $db->fetch($res,1)) {
?>
<tr height="40" align="center">
	<td><?=$pg->idx--?></td>
	<td><?=$data['send_date']?></td>
	<td><?=$data['send_name']?></td>
	<td><?=$data['send_number']?></td>
	<td style="text-align:left; padding:10px 0px 10px 0px;"><?=nl2br($data['send_contents'])?></td>
	<td>
	<? if ($data['send_status'] == 's') {?>�߼ۼ���
	<? } else if ($data['send_status'] == 'f') {?>�߼۽���<br><?if ($data['sms_logNo']) {?><a href="javascript:popup('../member/popup.sms.sendList.php?sms_logNo=<?=$data['sms_logNo']?>&apiPermission=y',800,750)"><font color="blue"><u>(SMS �߼۳��� Ȯ��)</u></font></a><?}?>
	<? } else {?>������Ŵ��<?}?>
	</td>
	<td><?=$kakaoAlimtalk->errorCode($data['fail_code'])?></td>
</tr>
<tr><td colspan="7" class="rndline"></td></tr>
<? } ?>
</table>

<table cellpadding="0" cellspacing="0" border="0" width="100%" style="padding-top:30px;">
<tr>
	<td align="center"><font class="ver8"><?=$pg->page['navi']?></font></td>
</tr>
</table>

<div class="extext">�߼۽��е� ���� SMS/LMS�� ��߼۵˴ϴ�. SMS �߼۳������� Ȯ�����ּ���.</div>
</form>
