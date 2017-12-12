<?php
$location = "고도전자세금계산서 > 고도전자세금계산서 설정";
include "../_header.php";
@include '../../conf/config.taxGuide.php'; //세금계산서 이용안내, 마감안내 문구
$config_pay = $config->load('configpay');
$config_tax = $config_pay['tax'];
$config_godotax = $config->load('godotax');
if(!$config_tax['period']) $config_tax['period'] = "nolimit";
?>
<style>
.FontColorRed							{ color: #FF0000; line-height:180%; }
.FontColorSky							{ color: #0080FF; }
.FontWeightBold						{ font-weight: bold; }
.TextUnderline							{ text-decoration:underline; }
.TextAreaSize							{ width:100%; height:150px; margin-bottom:5px; }
</style>
<script>
	function chk_display(chk){
		if(chk == "limit"){
			document.getElementById("endRow").style.display ="";
		}else{
			document.getElementById("endRow").style.display ="none";
		}
	}
</script>
<form method="post" action="../order/godotax.setting.indb.php" target="ifrmHidden" id="frmTax">
<div class="title title_top">고도빌 신청/관리<span>고도빌(전자세금계산서) 서비스를 신청 및 관리하는 페이지 입니다.</span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=order&no=20')"><img src="../img/btn_q.gif" border="0" align="absmiddle"></a></div>
<table class="tb">
<col class="cellC"><col class="cellL">
<tr>
	<td>발행 사용여부</td>
	<td class="noline">
	<input type="radio" name=useyn value='y' <?=frmChecked($config_tax['useyn'],'y')?>> 사용
	<input type="radio" name=useyn value='n' <?=frmChecked($config_tax['useyn'],'n')?>> 사용안함
	</td>
</tr>
<tr>
	<td>발행 결제조건</td>
	<td class=noline>
	<input type=checkbox name=use_a <?=frmChecked($config_tax['use_a'],'on')?> value="on"> 무통장입금
	<input type=checkbox name=use_c disabled> 신용카드
	<input type=checkbox name=use_o <?=frmChecked($config_tax['use_o'],'on')?> value="on"> 계좌이체
	<input type=checkbox name=use_v <?=frmChecked($config_tax['use_v'],'on')?> value="on"> 가상계좌
	</td>
</tr>
<tr>
	<td>발행 시작단계</td>
	<td class=noline>
	<input type=radio name=step value='1' <?=frmChecked($config_tax['step'],'1')?>> 입금확인
	<input type=radio name=step value='2' <?=frmChecked($config_tax['step'],'2')?>> 배송준비중
	<input type=radio name=step value='3' <?=frmChecked($config_tax['step'],'3')?>> 배송중
	<input type=radio name=step value='4' <?=frmChecked($config_tax['step'],'4')?>> 배송완료
	</td>
</tr>
<tr>
	<td>발행 신청기간설정</td>
	<td class=noline>
	<input type=radio name=period value='limit' <?=frmChecked($config_tax['period'],'limit')?> onclick="chk_display(this.value)"> 입금확인기준 다음달 10일까지 제한&nbsp;<span class="extext">입금확인날 기준으로 익월 10일까지 세금계산서 발행 신청을 할 수 있으며 이후 발행신청이 불가합니다.</span></br>
	<input type=radio name=period value='nolimit' <?=frmChecked($config_tax['period'],'nolimit')?> onclick="chk_display(this.value)"> 기간 제한 없음&nbsp;<span class="extext">발행기간이 지난 세금계산서에 대해서는 가산세가 부과됩니다.</span>
	</td>
</tr>
<tr>
	<td>이용안내 문구</td>
	<td class=noline>
		<textarea name="guideWords" class="TextAreaSize"><?=$cfgtaxGuide['guideWords']?></textarea></br>
		<span class="FontWeightBold FontColorRed">※ 이용안내 문구는 스킨패치를 적용하신 후에 노출이 됩니다. 스킨패치 미적용시 노출되지 않습니다.</span></br>
		<span class="extext">&nbsp;- 이용안내 문구는 설정여부에 따라 수정하셔서 사용하시기 바랍니다.</br>
		&nbsp;- 회사팩스번호는 치환코드{compFax}로 제공되어 회사정보 설정에 등록된 "팩스번호"가 자동으로 표시됩니다.</br>
		&nbsp;- 등록한 내용은 [주문상세조회 페이지]에 표시됩니다.</span>
	</td>
</tr>
<?
	$str = "none";
	if($config_tax['period'] != 'nolimit'){
		$str = "";
	}
?>
<tr id="endRow" style="display:<?=$str?>">
	<td>발행 신청 </br>마감 안내 문구</td>
	<td class=noline>
		<textarea name="endWords" class="TextAreaSize"><?=$cfgtaxGuide['endWords']?></textarea></br>
		<span class="FontWeightBold FontColorRed">※ 이용안내 문구는 스킨패치를 적용하신 후에 노출이 됩니다. 스킨패치 미적용시 노출되지 않습니다.</span></br>
		<span class="extext">&nbsp;- 세금계산서 발행신청 기간이 지난 주문건에 대해서만 노출됩니다.</br>
		&nbsp;- 세금계산서 이용안내 문구는 쇼핑몰의 '주문상세조회 페이지'에 표시됩니다.</br>
		&nbsp;- 치환코드{adimEmail}와 {compPhone}가 제공되어 회사정보 설정에 등록된 '관리자 E-mail'과 '전화번호'가 자동으로 표시됩니다. </span>
	</td>
</tr>
</table>
<br><br>
<table class="tb">
<col class="cellC"><col class="cellL">
<tr>
	<td>고도빌 회원 ID</td>
	<td>
		<input type="text" name="godotax_site_id" value="<?=$config_godotax['site_id']?>" class="line" style="width:170px" maxlength="16">
	</td>
</tr>
<tr>
	<td>고도빌 API_KEY</td>
	<td>
		<input type="text" name="godotax_api_key" value="<?=$config_godotax['api_key']?>" class="line" style="width:300px" maxlength="32"><br>
		<div class="extext" style="padding-top: 3px;">
		 고도빌 홈페이지에서 로그인 후, 로그인박스에 있는 [API KEY] 버튼을 클릭하면 확인할 수 있습니다. <br>
		 API KEY 값을 복사하여, 삽입하시면 됩니다.
		</div>
	</td>
</tr>

</table>

<div style="position:relative;">
	<div class=button >
	<input type=image src="../img/btn_save.gif">
	</div>
	<a href="http://www.godobill.com" target="_blank" style="display:block;position:absolute;right:10px;top:0px"><img src="../img/btn_godobill_go2.gif"></a>
</div>

</form>
<span class="FontWeightBold FontColorRed">※ 2016년 03월 31일 이전 제작 무료 스킨</span>을 사용하시는 경우
<span class="FontWeightBold TextUnderline">반드시 스킨패치를 적용</span>해야 기능 사용이 가능합니다.
<a href="http://www.godo.co.kr/customer_center/patch.php?sno=2359" target="_blank" class="FontColorSky TextUnderline FontWeightBold">[패치 바로가기]</a></br>
<span>- 스킨패치 후에는 디자인관리 페이지에서 제공하던 이용/탈퇴안내 관련 텍스트(txt)파일은 더 이상 사용하지 않으므로 쇼핑몰 정책에 따른 이용안내 및 탈퇴안내 관련 내용을
위의 각입력 항목에 입력 또는 수정하여 완성해 주시기 바랍니다.</span>
<div id=MSG01>
<table cellpadding=1 cellspacing=0 border=0 class=small_ex>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">발행 결제조건에서 신용카드의 경우에는 세금계산서 발급이 불가능합니다.
신용카드 매출전표를 세금계산서 대용으로 사용하면 됩니다.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">고도빌 회원ID, 고도빌 API_KEY 는 고도빌에 회원가입을 하면 발급이 되는 정보입니다. 고도빌 홈페이지에서 확인 후 입력하시면 됩니다.
</td></tr>
</table>
</div>
<script>cssRound('MSG01')</script>
<? include "../_footer.php"; ?>