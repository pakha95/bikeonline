<?
$location = "카카오 알림톡 > 카카오 알림톡 발송내역";
include "../_header.php";
include "../../lib/page.class.php";
include "../../lib/kakaoAlimtalk.class.php";

$kakaoAlimtalk = new kakaoAlimtalk();

// 발송 리스트 검색하지 않았을 경우, 바로전에 갱신된 경우 : 갱신 X
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

//검색 - 수신번호 
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
<div class="title title_top">카카오 알림톡 발송내역 <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=member&no=35')"><img src="../img/btn_q.gif" border="0" hspace="2" align="absmiddle" /></a></div>
<table border="1" bordercolor="#cccccc" style="border-collapse:collapse; width:100%; margin-bottom:10px;">
	<tr>
		<td>
		<span style="color: #0074ba;">※ 알림톡 발송내역 안내</span><br>
		- 카카오 알림톡 발송 시 1건당 SMS 0.6포인트가 차감됩니다.<br>
		- 카카오 알림톡 발송실패 시 자동으로 SMS/LMS 로 재전송됩니다. (재전송 시에는 약간의 시간 간격(최대 1시간)이 있을 수 있습니다.)<br>
		&nbsp;&nbsp;발송실패된 건은 SMS 발송내역에서 확인해주세요.
		</td>
	</tr>
</table>

<form>
<table class="tb">
<col class="cellC" /><col class="cellL" style="width:250" />
<col class="cellC" /><col class="cellL" />
<tr>
	<td>검색어</td>
	<td colspan="3">
	<select name="skey">
		<option value="all" <?=$selected['skey']['all']?>> 통합검색 </option>
		<option value="template_name" <?=$selected['skey']['template_name']?>> 템플릿명 </option>
		<option value="template_contents" <?=$selected['skey']['template_contents']?>> 템플릿내용 </option>
	</select> <input type="text" name="sword" value="<?=$_GET['sword']?>" class="line" />
	</td>
</tr>
<tr>
	<td>발송시간</td>
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
	<td>발송상태</td>
	<td colspan="3">
	<label><input type="radio" name="send_status" value="" <?=$checked['send_status']['']?> />전체</label>
	<label><input type="radio" name="send_status" value="s" <?=$checked['send_status']['s']?> />발송성공</label>
	<label><input type="radio" name="send_status" value="f" <?=$checked['send_status']['f']?> />발송실패</label>
	<label><input type="radio" name="send_status" value="w" <?=$checked['send_status']['w']?> />결과수신대기</label>
	</td>
</tr>
</table>

<div class="button_top"><input type="image" src="../img/btn_search2.gif" /></div>

<table width="100%">
<tr>
	<td class="pageInfo">
	검색 <?=number_format($pg->recode['total'])?>개 / <?=number_format($pg->page['now'])?> of <?=number_format($pg->page['total'])?> Pages
	</td>
	<td align="right">
	<select name="page_num" onchange="this.form.submit();" style="padding-right:10px;">
	<?
	$r_pagenum = array(10,20,40,60,100);
	foreach ($r_pagenum as $v) {
	?>
	<option value="<?=$v?>" <?=$selected['page_num'][$v]?>><?=$v?>개 출력</option>
	<? } ?>
	</select>
	</td>
</tr>
</table>

<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr><td class="rnd" colspan="8"></td></tr>
<tr class="rndbg">
	<th>번호</th>
	<th>구분</th>
	<th>발송시간/<br>발송예약시간</th>
	<th>템플릿명</th>
	<th>템플릿내용</th>
	<th>발송건수<br>(성공/실패)</th>
	<th>발송상태</th>
	<th>자세히</th>
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
	<? if ($data['reserve_date'] != '0000-00-00 00:00:00' && $data['reserve_date'] != '') {?>예약발송
	<? } else {?> 즉시발송 <?}?>
	</td>
	<td>
	<? if ($data['reserve_date'] != '0000-00-00 00:00:00' && $data['reserve_date'] != '') { echo $data['reserve_date']; ?>
	<? } else { echo $data['send_date']; }?>
	</td>
	<td><?=$data['template_name']?></td>
	<td style="text-align:left; padding:10px 0px 10px 0px;"><?=nl2br($data['template_contents'])?></td>
	<td><?=$data['send_count']?><br>( <?=$data['send_success_count']?> / <?=$data['send_fail_count']+$data['request_fail_count']?> )</td>
	<td>
	<? if ($data['send_status'] == 's') {?>발송성공
	<? } else if ($data['send_status'] == 'f') {?>발송실패
	<? } else if ($data['send_status'] == 'w') {?>결과수신대기<?}?>
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
				alert('전송내역 갱신에 실패하였습니다. 잠시 후 다시 시도해주세요.');
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