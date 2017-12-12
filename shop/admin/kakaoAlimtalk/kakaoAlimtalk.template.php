<?
$location = "īī�� �˸��� > īī�� �˸��� ���ø� ����";
include "../_header.php";
include "../../lib/page.class.php";
include "../../lib/kakaoAlimtalk.class.php";

$kakaoAlimtalk = new kakaoAlimtalk();

// �׷� ���ø� ���� ����
if ($kakaoAlimtalk->config['use'] == 'y') {
	$kakaoAlimtalk->groupTemplateUpdate();
}

if (!$_GET['page_num']) $_GET['page_num'] = 10;
$selected['page_num'][$_GET['page_num']] = 'selected';
$selected['skey'][$_GET['skey']] = 'selected';
$selected['tmode'][$_GET['tmode']] = 'selected';
$selected['inspection_status'][$_GET['inspection_status']]	 = 'selected';
$checked['useYn'][$_GET['useYn']] = 'checked';

$where = $kakaoAlimtalk->getTemplateQuery($_GET);

$pg = new Page($_GET['page'],$_GET['page_num']);
$pg->setQuery(GD_KAKAOALIMTALK_TEMPLATE,$where,'sno desc');
$pg->exec();

$res = $db->query($pg->query);
?>
<div class="title title_top">īī�� �˸��� ���ø� ���� <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=member&no=34')"><img src="../img/btn_q.gif" border="0" hspace="2" align="absmiddle" /></a></div>

<form>
<table class="tb">
<col class="cellC" /><col class="cellL" style="width:250" />
<col class="cellC" /><col class="cellL" />
<tr>
	<td>�˻���</td>
	<td colspan="3">
	<select name="skey">
		<option value="all" <?=$selected['skey']['all']?>> ���հ˻� </option>
		<option value="code" <?=$selected['skey']['code']?>> ���ø� �ڵ� </option>
		<option value="name" <?=$selected['skey']['name']?>> ���ø��� </option>
		<option value="contents" <?=$selected['skey']['contents']?>> ���ø� ���� </option>
	</select> <input type="text" name="sword" value="<?=$_GET['sword']?>" class="line" />
	</td>
</tr>
<tr>
	<td>�����</td>
	<td colspan="3">
	<input type="text" name="reg_date[]" value="<?=$_GET['reg_date'][0]?>" size="10" onkeydown="onlynumber();" onclick="calendar(event);" class="cline" /> ~
	<input type="text" name="reg_date[]" value="<?=$_GET['reg_date'][1]?>" size="10" onkeydown="onlynumber();" onclick="calendar(event);" class="cline" />
	<a href="javascript:setDate('reg_date[]',<?=date("Ymd")?>,<?=date("Ymd")?>)"><img src="../img/sicon_today.gif" align="absmiddle" /></a>
	<a href="javascript:setDate('reg_date[]',<?=date("Ymd",strtotime("-7 day"))?>,<?=date("Ymd")?>)"><img src="../img/sicon_week.gif" align="absmiddle" /></a>
	<a href="javascript:setDate('reg_date[]',<?=date("Ymd",strtotime("-15 day"))?>,<?=date("Ymd")?>)"><img src="../img/sicon_twoweek.gif" align="absmiddle" /></a>
	<a href="javascript:setDate('reg_date[]',<?=date("Ymd",strtotime("-1 month"))?>,<?=date("Ymd")?>)"><img src="../img/sicon_month.gif" align="absmiddle" /></a>
	<a href="javascript:setDate('reg_date[]',<?=date("Ymd",strtotime("-2 month"))?>,<?=date("Ymd")?>)"><img src="../img/sicon_twomonth.gif" align="absmiddle" /></a>
	<a href="javascript:setDate('reg_date[]')"><img src="../img/sicon_all.gif" align="absmiddle" /></a>
	</td>
</tr>
<tr>
	<td>���ø� ����</td>
	<td>
		<select name="tmode">
			<option value="" <?=$selected['tmode']['']?>> ��ü���� </option>
			<option value="order" <?=$selected['tmode']['order']?>> �ֹ����� </option>
			<option value="member" <?=$selected['tmode']['member']?>> ȸ������ </option>
			<option value="board" <?=$selected['tmode']['board']?>> �Խù����� </option>
		</select>
	</td>
	<td>�˼�����</td>
	<td>
		<select name="inspection_status">
			<option value="" <?=$selected['inspection_status']['']?>> ��ü���� </option>
			<option value="REG" <?=$selected['inspection_status']['REG']?>> ��� </option>
			<option value="REQ" <?=$selected['inspection_status']['REQ']?>> �ɻ��û </option>
			<option value="APR" <?=$selected['inspection_status']['APR']?>> ���� </option>
			<option value="REJ" <?=$selected['inspection_status']['REJ']?>> �ݷ� </option>
		</select>
	</td>
</tr>
<tr>
	<td>��뿩��</td>
	<td colspan="3">
	<input type="radio" name="useYn" value="" <?=$checked['useYn']['']?> />��ü
	<input type="radio" name="useYn" value="Y" <?=$checked['useYn']['Y']?> />�����
	<input type="radio" name="useYn" value="N" <?=$checked['useYn']['N']?> />������
	</td>
</tr>
</table>

<div style="padding:10px 0px 20px 0px;">
<div style="margin-left:47%; display:inline-block;"><input type="image" src="../img/btn_search2.gif" /></div>
<div style="float:right"><a href="javascript:templateList();"><img src="../img/btn_alimtalk_template_update.png"/></a></div>
</div>

<table width="100%">
<tr>
	<td class="pageInfo">
	<font class="ver8">�˻� <?=number_format($pg->recode['total'])?>�� / <?=number_format($pg->page['now'])?> of <?=number_format($pg->page['total'])?> Pages
	</td>
	<td align="right">
	<select name="page_num" onchange="this.form.submit();" style="padding-right:10px;">
	<?
	$r_pagenum = array(10,20,40,60,100);
	foreach ($r_pagenum as $v) {
	?>
	<option value="<?=$v?>" <?=$selected['page_num'][$v]?>><?=$v?>�� ���</option>
	<? } ?>
	</select>
	<span style="margin-left:20px;"><a href="javascript:popupLayer('kakaoAlimtalkTemplateRegister.php',1000,600)"><img src="../img/btn_alimtalk_template_register.png" border="0" align="absmiddle"/></a><span>
	</td>
</tr>
</table>

<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr><td class="rnd" colspan="11"></td></tr>
<tr class="rndbg">
	<th>��ȣ</th>
	<th>���ø��ڵ�</th>
	<th>���ø�����</th>
	<th>���ø���</th>
	<th>���ø�����</th>
	<th>�˼�����</th>
	<th>��û/����</th>
	<th>�����</th>
	<th>��뿩��</th>
	<th>����</th>
	<th>����</th>
</tr>
<colgroup>
	<col style="width:20px;">
	<col style="width:50px;">
	<col style="width:45px;">
	<col style="width:200px;">
	<col style="width:300px;">
	<col style="width:50px;">
	<col style="width:60px;">
	<col style="width:60px;">
	<col style="width:35px;">
	<col style="width:30px;">
	<col style="width:30px;">
</colgroup>
<?
while ($data = $db->fetch($res,1)) {
?>
<tr align="center">
	<td><?=$pg->idx--?></td>
	<td><?=$data['code']?></td>
	<td>
	<? if ($data['mode'] == 'order') {?>�ֹ�����
	<? } else if ($data['mode'] == 'member') {?>ȸ������
	<? } else {?>�Խ��ǰ���<?}?>
	</td>
	<td><?=$data['name']?></td>
	<td style="text-align:left; padding:10px 0px 10px 0px;"><?=nl2br($data['contents'])?></td>
	<td>
	<? if ($data['inspection_status'] == 'REG') {?><span>���</span>
	<? } else if ($data['inspection_status'] == 'REQ') {?><span>�ɻ��û</span>
	<? } else if ($data['inspection_status'] == 'APR') {?><span>����</span>
	<? } else if ($data['inspection_status'] == 'REJ') {?><span>�ݷ�</span><?}?>
	</td>
	<td>
	<? if ($data['inspection_status'] == 'REG') {?><span style="cursor:pointer" onclick="templateRequest('<?=$data['code']?>');"><img src="../img/btn_alimtalk_template_request.png" border="0" align="absmiddle"/></span>
	<? } else if ($data['inspection_status'] == 'REQ' || $data['inspection_status'] == 'REJ') {?><span style="cursor:pointer" onclick="templateComment('<?=$data['code']?>');"><img src="../img/btn_alimtalk_template_comment.png" border="0" align="absmiddle"/></span>
	<? } else {?><span> - </span><?}?>
	</td>
	<td><?=substr($data['reg_date'],0,10)?></td>
	<td>
	<? if ($data['useYn'] == 'Y') {?>�����
	<? } else {?>������<?}?>
	</td>
	<td><? if ($data['inspection_status'] == 'REG' || $data['inspection_status'] == 'REJ') {?><span style="cursor:pointer" onclick="templateUpdate('<?=$data['code']?>');"><img src="../img/i_edit.gif" border="0" align="absmiddle"/></span></td><?}?>
	<td><? if ($data['inspection_status'] == 'REG' || $data['inspection_status'] == 'REJ') {?><span style="cursor:pointer" onclick="templateDelete('<?=$data['code']?>');"><img src="../img/i_del.gif" border="0" align="absmiddle"/></span></td><?}?>
</tr>
<tr><td colspan="11" class="rndline"></td></tr>
<? } ?>
</table>

<table cellpadding="0" cellspacing="0" border="0" width="100%" style="padding-top:30px;">
<tr>
	<td align="center"><font class="ver8"><?=$pg->page['navi']?></font></td>
</tr>
</table>
</form>

<script>
// ���ø� ����
function templateUpdate(code) {
	popupLayer('kakaoAlimtalkTemplateRegister.php?code='+code,1000,600);
}

// ���ø� ����
function templateDelete(code) {
	if (confirm('���� �����Ͻðڽ��ϱ�?')) {
		var ajax = new Ajax.Request("indb.php",
		{
			method: "post",
			parameters: "mode=templateDelete&code=" + code,
			onComplete: function (req)
			{
				var res = req.responseText;
				if (res == 'success') {
					alert('���ø��� �����Ͽ����ϴ�.');
					window.location.reload();
				}
				else {
					alert('���ø� ������ �����Ͽ����ϴ�. ��� �� �ٽ� �õ����ּ���.');
				}
			}
		});
	}
}

// �����ϱ�
function templateComment(code) {
	popupLayer('kakaoAlimtalkTemplateComment.php?code='+code,1000,600);
}

// �˼���û
function templateRequest(code) {
	var ajax = new Ajax.Request("indb.php",
	{
		method: "post",
		parameters: "mode=templateRequest&code=" + code,
		onComplete: function (req)
		{
			var res = req.responseText;
			if (res == 'success') {
				alert('�˼���û�� �����Ͽ����ϴ�.');
				window.location.reload();
			}
			else {
				alert('�˼� ��û�� �����Ͽ����ϴ�. ��� �� �ٽ� �õ����ּ���.');
			}
		}
	});
}

// ���ø� ����Ʈ ����
function templateList() {
	var ajax = new Ajax.Request("indb.php",
	{
		method: "post",
		parameters: "mode=templateList",
		onComplete: function (req)
		{
			var res = req.responseText;
			if (res == 'success') {
				window.location.reload();
			}
			else {
				alert('���ø� ����� �ҷ��� �� �����ϴ�. ��� �� �ٽ� �õ����ּ���..');
			}
		}
	});
}
</script>
<? include "../_footer.php"; ?>