<?
$location = "īī�� �˸��� > īī�� �˸��� �߼۳���";
include "../_header.php";
include "../../lib/page.class.php";
include "../../lib/kakaoAlimtalk.class.php";

$kakaoAlimtalk = new kakaoAlimtalk();

// �߼� ����Ʈ �˻����� �ʾ��� ���, �ٷ����� ���ŵ� ��� : ���� X
if ($_GET || $_SESSION['kakaoSendUpdate'] == 'Y') {
	$update = '';
	unset($_SESSION['kakaoSendUpdate']);
}
else {
	$update = 'y';
}

if (!$_GET['page_num']) $_GET['page_num'] = 10;
$selected['page_num'][$_GET['page_num']] = 'selected';
$selected['skey'][$_GET['skey']] = 'selected';
$checked['send_status'][$_GET['send_status']] = 'checked';

$where = $kakaoAlimtalk->getSendAlimtalkQuery($_GET);

//�˻� - ���Ź�ȣ 
if ($_GET['skey'] == 'send_number' || $_GET['skey'] == 'all') {
	$res = $db->query("SELECT alimtalk_logNo FROM ".GD_KAKAOALIMTALK_SENDLIST." WHERE send_number like '%".$_GET['sword']."%'");
	while($row = $db->fetch($res)){
		$_logNoArr[] = $row['alimtalk_logNo'];
	}
	if (count($_logNoArr) > 0) {
		$kakao_logNoArr = array_unique($_logNoArr);
		$where[] = "sno in ('" . implode("','", $kakao_logNoArr) . "')";
	}
}

$pg = new Page($_GET['page'],$_GET['page_num']);
$pg->setQuery(GD_KAKAOALIMTALK_SENDLOG,$where,'sno desc');
$pg->exec();

$res = $db->query($pg->query);
?>
<div class="title title_top">īī�� �˸��� �߼۳��� <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=member&no=35')"><img src="../img/btn_q.gif" border="0" hspace="2" align="absmiddle" /></a></div>
<table border="1" bordercolor="#cccccc" style="border-collapse:collapse; width:100%; margin-bottom:10px;">
	<tr>
		<td>
		<span style="color: #0074ba;">�� �˸��� �߼۳��� �ȳ�</span><br>
		- īī�� �˸��� �߼� �� 1�Ǵ� SMS 0.6����Ʈ�� �����˴ϴ�.<br>
		- īī�� �˸��� �߼۽��� �� �ڵ����� SMS/LMS �� �����۵˴ϴ�. (������ �ÿ��� �ణ�� �ð� ����(�ִ� 1�ð�)�� ���� �� �ֽ��ϴ�.)<br>
		&nbsp;&nbsp;�߼۽��е� ���� SMS �߼۳������� Ȯ�����ּ���.
		</td>
	</tr>
</table>

<form>
<table class="tb">
<col class="cellC" /><col class="cellL" style="width:250" />
<col class="cellC" /><col class="cellL" />
<tr>
	<td>�˻���</td>
	<td colspan="3">
	<select name="skey">
		<option value="all" <?=$selected['skey']['all']?>> ���հ˻� </option>
		<option value="template_name" <?=$selected['skey']['template_name']?>> ���ø��� </option>
		<option value="template_contents" <?=$selected['skey']['template_contents']?>> ���ø����� </option>
	</select> <input type="text" name="sword" value="<?=$_GET['sword']?>" class="line" />
	</td>
</tr>
<tr>
	<td>�߼۽ð�</td>
	<td colspan="3">
	<input type="text" name="send_date[]" value="<?=$_GET['send_date'][0]?>" size="10" onkeydown="onlynumber();" onclick="calendar(event);" class="cline" /> ~
	<input type="text" name="send_date[]" value="<?=$_GET['send_date'][1]?>" size="10" onkeydown="onlynumber();" onclick="calendar(event);" class="cline" />
	<a href="javascript:setDate('send_date[]',<?=date("Ymd")?>,<?=date("Ymd")?>)"><img src="../img/sicon_today.gif" align="absmiddle" /></a>
	<a href="javascript:setDate('send_date[]',<?=date("Ymd",strtotime("-7 day"))?>,<?=date("Ymd")?>)"><img src="../img/sicon_week.gif" align="absmiddle" /></a>
	<a href="javascript:setDate('send_date[]',<?=date("Ymd",strtotime("-15 day"))?>,<?=date("Ymd")?>)"><img src="../img/sicon_twoweek.gif" align="absmiddle" /></a>
	<a href="javascript:setDate('send_date[]',<?=date("Ymd",strtotime("-1 month"))?>,<?=date("Ymd")?>)"><img src="../img/sicon_month.gif" align="absmiddle" /></a>
	<a href="javascript:setDate('send_date[]',<?=date("Ymd",strtotime("-2 month"))?>,<?=date("Ymd")?>)"><img src="../img/sicon_twomonth.gif" align="absmiddle" /></a>
	<a href="javascript:setDate('send_date[]')"><img src="../img/sicon_all.gif" align="absmiddle" /></a>
	</td>
</tr>
<tr>
	<td>�߼ۻ���</td>
	<td colspan="3">
	<label><input type="radio" name="send_status" value="" <?=$checked['send_status']['']?> />��ü</label>
	<label><input type="radio" name="send_status" value="s" <?=$checked['send_status']['s']?> />�߼ۼ���</label>
	<label><input type="radio" name="send_status" value="f" <?=$checked['send_status']['f']?> />�߼۽���</label>
	<label><input type="radio" name="send_status" value="w" <?=$checked['send_status']['w']?> />������Ŵ��</label>
	</td>
</tr>
</table>

<div class="button_top"><input type="image" src="../img/btn_search2.gif" /></div>

<table width="100%">
<tr>
	<td class="pageInfo">
	�˻� <?=number_format($pg->recode['total'])?>�� / <?=number_format($pg->page['now'])?> of <?=number_format($pg->page['total'])?> Pages
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
	</td>
</tr>
</table>

<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr><td class="rnd" colspan="8"></td></tr>
<tr class="rndbg">
	<th>��ȣ</th>
	<th>����</th>
	<th>�߼۽ð�/<br>�߼ۿ���ð�</th>
	<th>���ø���</th>
	<th>���ø�����</th>
	<th>�߼۰Ǽ�<br>(����/����)</th>
	<th>�߼ۻ���</th>
	<th>�ڼ���</th>
</tr>
<tr><td class="rnd" colspan="8"></td></tr>
<col width="10" align="center">
<col width="20" align="center">
<col width="20" align="center">
<col width="80" align="center">
<col width="80" align="center">
<col width="30" align="center">
<col width="30" align="center">
<col width="30" align="center">
<?
while ($data = $db->fetch($res,1)) {
?>
<tr height=40 align="center">
	<td><?=$pg->idx--?></td>
	<td>
	<? if ($data['reserve_date'] != '0000-00-00 00:00:00' && $data['reserve_date'] != '') {?>����߼�
	<? } else {?> ��ù߼� <?}?>
	</td>
	<td>
	<? if ($data['reserve_date'] != '0000-00-00 00:00:00' && $data['reserve_date'] != '') { echo $data['reserve_date']; ?>
	<? } else { echo $data['send_date']; }?>
	</td>
	<td><?=$data['template_name']?></td>
	<td style="text-align:left; padding:10px 0px 10px 0px;"><?=nl2br($data['template_contents'])?></td>
	<td><?=$data['send_count']?><br>( <?=$data['send_success_count']?> / <?=$data['send_fail_count']+$data['request_fail_count']?> )</td>
	<td>
	<? if ($data['send_status'] == 's') {?>�߼ۼ���
	<? } else if ($data['send_status'] == 'f') {?>�߼۽���
	<? } else if ($data['send_status'] == 'w') {?>������Ŵ��<?}?>
	</td>
	<td><a href="javascript:popup('kakaoAlimtalkSendDetail.php?alimtalk_logNo=<?=$data['sno']?>',1000,900)"><img src="../img/btn_sendlist_result_info.gif" border="0" align="absmiddle"/></a></td>
</tr>
<tr><td colspan="8" class="rndline"></td></tr>
<? } ?>
</table>

<table cellpadding="0" cellspacing="0" border="0" width="100%" style="padding-top:30px;">
<tr>
	<td align="center"><font class="ver8"><?=$pg->page['navi']?></font></td>
</tr>
</table>
</form>

<script type="text/javascript" src="../../lib/js/jquery-1.11.3.min.js"></script>
<script>
var update = '<?=$update?>';

window.onload = function(){
	if (update == 'y') {
		sendAlimtalkUpdate();
	}
}

function sendAlimtalkUpdate() {
	progressBarOn();
	var ajax = new Ajax.Request("indb.php",
	{
		method: "post",
		parameters: "mode=sendAlimtalkUpdate",
		onComplete: function (req)
		{
			var res = req.responseText;
			if (res == 'success') {
				window.location.reload(true);
			}
			else if (res == 'falil') {
				alert('���۳��� ���ſ� �����Ͽ����ϴ�. ��� �� �ٽ� �õ����ּ���.');
			}
			progressBarOff();
		}
	});
}

function progressBarOn() {
	var divHeight = (jQuery(window).height() > jQuery('body').height()) ? jQuery(window).height() : jQuery('body').height();

	jQuery("body").append('<div id="progressbar"><div style="position:absolute;top:0;left:0;background:#44515b;filter:alpha(opacity=80);opacity:0.8;width:100%;height:'+divHeight+'px;cursor:progress;z-index:999;margin:0 auto;text-align: center;"></div><div style="position:absolute;top:0;left:0;width:100%;height:'+divHeight+'px;margin:0 auto;text-align: center;z-index:1000;"><img src="../img/progress_bar2.gif" border="0" style="margin-top:400px;"/></div></div>');
}

function progressBarOff() {
	jQuery("#progressbar").remove();
}
</script>


<? include "../_footer.php"; ?>