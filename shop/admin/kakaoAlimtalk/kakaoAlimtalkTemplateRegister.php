<?
include "../_header.popup.php";

if ($_GET['code']) {
	$title = '수정';
	$mode = 'templateUpdate';
	$disabled = 'style="background-color: #e2e2e2;" disabled';
	$comment = '템플릿 수정 시에는 템플릿 구분 수정은 할 수 없습니다.';

	include "../../lib/kakaoAlimtalk.class.php";
	$kakaoAlimtalk = new kakaoAlimtalk();
	$data = $kakaoAlimtalk->getTemplateData($_GET['code']);
}
else {
	$title = '등록';
	$mode = 'templateRegister';
}

// 치환코드 정리
$replacecode = array();
$replacecode['order'] = array('shopName', 'shopUrl', 'ordno', 'nameOrder', 'settleprice', 'account', 'deliverycomp', 'deliverycode');
$replacecode['member'] = array('shopName', 'shopUrl', 'name', 'password', 'toBeDate', 'id', 'smsAgree', 'smsAgreeDate', 'emailAgree', 'emailAgreeDate');
$replacecode['board'] = array('shopName', 'shopUrl', 'name', 'boardName');

$desc = array();
$desc['shopName'] = '쇼핑몰 명, 상점명';
$desc['shopUrl'] = '쇼핑몰 URL';
$desc['ordno'] = '주문번호';
$desc['nameOrder'] = '주문자 이름';
$desc['settleprice'] = '구매금액';
$desc['account'] = '입금계좌/입금자명';
$desc['deliverycomp'] = '택배사정보';
$desc['deliverycode'] = '송장번호';
$desc['name'] = '회원이름';
$desc['password'] = '회원패스워드';
$desc['toBeDate'] = '휴면회원전환예정일';
$desc['id'] = '회원아이디';
$desc['smsAgree'] = '회원아이디';
$desc['smsAgreeDate'] = 'SMS 수신동의일';
$desc['emailAgree'] = '메일 수신동의 여부';
$desc['emailAgreeDate'] = '메일 수신동의일';
$desc['boardName'] = '게시판 이름';

?>
<div class="title title_top">카카오 알림톡 템플릿 <?=$title?></div>

<form name="form" method="post" action="indb.php">
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="code" value="<?=$_GET['code']?>">
<table class="tb" width="100%">
<col class="cellC"><col class="cellL">
<tr>
	<td>템플릿 구분</td>
	<td>
		<div style="margin:5px">
			<select name="tmode" <?=$disabled?> onchange="replacecode('off');">
				<option value="order">= 주문관련 =</option>
				<option value="member">= 회원관련 =</option>
				<option value="board">= 게시판관련 =</option>
			</select>
			<span class="extext"><?=$comment?></span>
		</div>
	</td>
</tr>
<tr>
	<td>템플릿명</td>
	<td>
		<div style="margin:5px">
			<input type="text" name="name" value="<?=$data['name']?>" style="border:1px solid #bdbdbd"/>
		</div>
		<div class="extext">템플릿명은 템플릿 구분을 위한 입력 항목이며, 알림톡 내용에 포함되지 않습니다.</div>
	</td>
</tr>
<tr>
	<td>템플릿내용</td>
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
					<td>치환코드</td>
					<td>설명</td>
					<td>추가</td>
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
			<td style="padding-top:10px;"><div class="extext">템플릿내용은 URL을 포함해 1,000자까지 사용하실수 있습니다.
			<br>치환코드 사용 시 1,000자가 넘지 않도록 주의해주세요.<br>알림톡에 치환코드를 사용하시려면 모든 치환코드 앞에 #을 붙여 입력하셔야 합니다.</div></td>
		</tr>
		</table>
	</td>
</tr>
</table>
<div class="extext" style="padding-top:10px;">모든 템플릿은 등록 후 카카오에서 검수 완료를 해야 사용이 가능합니다.</div>
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
	var comment = ' 치환코드만 노출됩니다.';

	if (mode == 'on') {
		var selectValue = form.tmode.options[form.tmode.selectedIndex].value;
		document.getElementById('order_tb').style.display = 'none';
		document.getElementById('member_tb').style.display = 'none';
		document.getElementById('board_tb').style.display = 'none';
		document.getElementById(selectValue+'_tb').style.display = '';
		document.getElementById('code_on').style.display = 'none';
		document.getElementById('code_off').style.display = '';

		if (selectValue == 'order') {
			document.getElementById('code_comment').innerHTML = '주문관련'+comment;
		}
		else if (selectValue == 'member') {
			document.getElementById('code_comment').innerHTML = '회원관련'+comment;
		}
		else {
			document.getElementById('code_comment').innerHTML = '게시판관련'+comment;
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