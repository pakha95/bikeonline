<?
$location = "카카오 알림톡 > 카카오 알림톡 템플릿 설정";
include "../_header.php";
include "../../lib/page.class.php";
include "../../lib/kakaoAlimtalk.class.php";

$kakaoAlimtalk = new kakaoAlimtalk();

// 그룹 템플릿 최초 갱신
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
<div class="title title_top">카카오 알림톡 템플릿 설정 <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=member&no=34')"><img src="../img/btn_q.gif" border="0" hspace="2" align="absmiddle" /></a></div>

<form>
<table class="tb">
<col class="cellC" /><col class="cellL" style="width:250" />
<col class="cellC" /><col class="cellL" />
<tr>
	<td>검색어</td>
	<td colspan="3">
	<select name="skey">
		<option value="all" <?=$selected['skey']['all']?>> 통합검색 </option>
		<option value="code" <?=$selected['skey']['code']?>> 템플릿 코드 </option>
		<option value="name" <?=$selected['skey']['name']?>> 템플릿명 </option>
		<option value="contents" <?=$selected['skey']['contents']?>> 템플릿 내용 </option>
	</select> <input type="text" name="sword" value="<?=$_GET['sword']?>" class="line" />
	</td>
</tr>
<tr>
	<td>등록일</td>
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
	<td>템플릿 구분</td>
	<td>
		<select name="tmode">
			<option value="" <?=$selected['tmode']['']?>> 전체보기 </option>
			<option value="order" <?=$selected['tmode']['order']?>> 주문관련 </option>
			<option value="member" <?=$selected['tmode']['member']?>> 회원관련 </option>
			<option value="board" <?=$selected['tmode']['board']?>> 게시물관련 </option>
		</select>
	</td>
	<td>검수상태</td>
	<td>
		<select name="inspection_status">
			<option value="" <?=$selected['inspection_status']['']?>> 전체보기 </option>
			<option value="REG" <?=$selected['inspection_status']['REG']?>> 등록 </option>
			<option value="REQ" <?=$selected['inspection_status']['REQ']?>> 심사요청 </option>
			<option value="APR" <?=$selected['inspection_status']['APR']?>> 승인 </option>
			<option value="REJ" <?=$selected['inspection_status']['REJ']?>> 반려 </option>
		</select>
	</td>
</tr>
<tr>
	<td>사용여부</td>
	<td colspan="3">
	<input type="radio" name="useYn" value="" <?=$checked['useYn']['']?> />전체
	<input type="radio" name="useYn" value="Y" <?=$checked['useYn']['Y']?> />사용함
	<input type="radio" name="useYn" value="N" <?=$checked['useYn']['N']?> />사용안함
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
	<font class="ver8">검색 <?=number_format($pg->recode['total'])?>개 / <?=number_format($pg->page['now'])?> of <?=number_format($pg->page['total'])?> Pages
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
	<span style="margin-left:20px;"><a href="javascript:popupLayer('kakaoAlimtalkTemplateRegister.php',1000,600)"><img src="../img/btn_alimtalk_template_register.png" border="0" align="absmiddle"/></a><span>
	</td>
</tr>
</table>

<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr><td class="rnd" colspan="11"></td></tr>
<tr class="rndbg">
	<th>번호</th>
	<th>템플릿코드</th>
	<th>템플릿구분</th>
	<th>템플릿명</th>
	<th>템플릿내용</th>
	<th>검수상태</th>
	<th>요청/문의</th>
	<th>등록일</th>
	<th>사용여부</th>
	<th>수정</th>
	<th>삭제</th>
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
	<? if ($data['mode'] == 'order') {?>주문관련
	<? } else if ($data['mode'] == 'member') {?>회원관련
	<? } else {?>게시판관련<?}?>
	</td>
	<td><?=$data['name']?></td>
	<td style="text-align:left; padding:10px 0px 10px 0px;"><?=nl2br($data['contents'])?></td>
	<td>
	<? if ($data['inspection_status'] == 'REG') {?><span>등록</span>
	<? } else if ($data['inspection_status'] == 'REQ') {?><span>심사요청</span>
	<? } else if ($data['inspection_status'] == 'APR') {?><span>승인</span>
	<? } else if ($data['inspection_status'] == 'REJ') {?><span>반려</span><?}?>
	</td>
	<td>
	<? if ($data['inspection_status'] == 'REG') {?><span style="cursor:pointer" onclick="templateRequest('<?=$data['code']?>');"><img src="../img/btn_alimtalk_template_request.png" border="0" align="absmiddle"/></span>
	<? } else if ($data['inspection_status'] == 'REQ' || $data['inspection_status'] == 'REJ') {?><span style="cursor:pointer" onclick="templateComment('<?=$data['code']?>');"><img src="../img/btn_alimtalk_template_comment.png" border="0" align="absmiddle"/></span>
	<? } else {?><span> - </span><?}?>
	</td>
	<td><?=substr($data['reg_date'],0,10)?></td>
	<td>
	<? if ($data['useYn'] == 'Y') {?>사용함
	<? } else {?>사용안함<?}?>
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
// 템플릿 수정
function templateUpdate(code) {
	popupLayer('kakaoAlimtalkTemplateRegister.php?code='+code,1000,600);
}

// 템플릿 삭제
function templateDelete(code) {
	if (confirm('정말 삭제하시겠습니까?')) {
		var ajax = new Ajax.Request("indb.php",
		{
			method: "post",
			parameters: "mode=templateDelete&code=" + code,
			onComplete: function (req)
			{
				var res = req.responseText;
				if (res == 'success') {
					alert('템플릿을 삭제하였습니다.');
					window.location.reload();
				}
				else {
					alert('템플릿 삭제를 실패하였습니다. 잠시 후 다시 시도해주세요.');
				}
			}
		});
	}
}

// 문의하기
function templateComment(code) {
	popupLayer('kakaoAlimtalkTemplateComment.php?code='+code,1000,600);
}

// 검수요청
function templateRequest(code) {
	var ajax = new Ajax.Request("indb.php",
	{
		method: "post",
		parameters: "mode=templateRequest&code=" + code,
		onComplete: function (req)
		{
			var res = req.responseText;
			if (res == 'success') {
				alert('검수요청에 성공하였습니다.');
				window.location.reload();
			}
			else {
				alert('검수 요청에 실패하였습니다. 잠시 후 다시 시도해주세요.');
			}
		}
	});
}

// 템플릿 리스트 갱신
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
				alert('템플릿 목록을 불러올 수 없습니다. 잠시 후 다시 시도해주세요..');
			}
		}
	});
}
</script>
<? include "../_footer.php"; ?>