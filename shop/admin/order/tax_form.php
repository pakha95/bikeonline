<?

include "../../conf/config.pay.php";
@include '../../conf/config.taxGuide.php'; //세금계산서 이용안내, 마감안내 문구

$set = $set['tax'];

if(!$set['tax_delivery']) $set['tax_delivery'] = "n";
if(!$set['period']) $set['period'] = "nolimit";

$checked['useyn'][$set[useyn]] = "checked";
$checked['step'][$set[step]] = "checked";
$checked['tax_delivery'][$set['tax_delivery']] = "checked";

$checked['use_a'][$set[use_a]] = "checked";
$checked['use_c'][$set[use_c]] = "checked";
$checked['use_o'][$set[use_o]] = "checked";
$checked['use_v'][$set[use_v]] = "checked";
$checked['period'][$set['period']] = "checked";
?>
<style>
.FontColorRed							{ color: #FF0000; line-height:180%;}
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
<form method=post action="../order/tax_indb.php" enctype="multipart/form-data">
<input type=hidden name=mode value="tax">

<div class="title title_top">세금계산서설정<span>회원에게 발행되는 세금계산서 대한 정책입니다</span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=order&no=7')"><img src="../img/btn_q.gif" border=0 hspace=2 align=absmiddle></a></div>
<table class=tb>
<col class=cellC><col class=cellL>
<tr>
	<td>발행 사용여부</td>
	<td class=noline>
	<input type=radio name=useyn value='y' <?=$checked['useyn']['y']?>> 사용
	<input type=radio name=useyn value='n' <?=$checked['useyn']['n']?>> 사용안함
	</td>
</tr>
<tr>
	<td>발행 결제조건</td>
	<td class=noline>
	<input type=checkbox name=use_a <?=$checked['use_a']['on']?>> 무통장입금
	<input type=checkbox name=use_c <?=$checked['use_c']['on']?> disabled> 신용카드
	<input type=checkbox name=use_o <?=$checked['use_o']['on']?>> 계좌이체
	<input type=checkbox name=use_v <?=$checked['use_v']['on']?>> 가상계좌
	</td>
</tr>
<tr>
	<td>발행 시작단계</td>
	<td class=noline>
	<input type=radio name=step value='1' <?=$checked['step']['1']?>> 입금확인
	<input type=radio name=step value='2' <?=$checked['step']['2']?>> 배송준비중
	<input type=radio name=step value='3' <?=$checked['step']['3']?>> 배송중
	<input type=radio name=step value='4' <?=$checked['step']['4']?>> 배송완료
	</td>
</tr>
<tr>
	<td>배송비 포함여부</td>
	<td class=noline>
	<input type=radio name=tax_delivery value='y' <?=$checked['tax_delivery']['y']?>> 배송비 포함
	<input type=radio name=tax_delivery value='n' <?=$checked['tax_delivery']['n']?>> 배송비 비포함
	</td>
</tr>
<tr>	<td>발행 신청기간설정</td>
	<td class=noline>
	<input type=radio name=period value='limit' <?=$checked['period']['limit']?> onclick="chk_display(this.value)"> 입금확인기준 다음달 10일까지 제한&nbsp;<span class="extext">입금확인날 기준으로 익월 10일까지 세금계산서 발행 신청을 할 수 있으며 이후 발행신청이 불가합니다.</span></br>
	<input type=radio name=period value='nolimit' <?=$checked['period']['nolimit']?> onclick="chk_display(this.value)"> 기간 제한 없음&nbsp;<span class="extext">발행기간이 지난 세금계산서에 대해서는 가산세가 부과됩니다.</span>
	</td>
</tr>
<tr>
	<td>이용안내 문구</td>
	<td class=noline>
		<textarea name="guideWords" class="TextAreaSize"><?=$cfgtaxGuide['guideWords']?></textarea></br>
		<span class="FontWeightBold FontColorRed" >※ 이용안내 문구는 스킨패치를 적용하신 후에 노출이 됩니다. 스킨패치 미적용시 노출되지 않습니다.</span></br>
		<span class="extext">&nbsp;- 이용안내 문구는 설정여부에 따라 수정하셔서 사용하시기 바랍니다.</br>
		&nbsp;- 회사팩스번호는 치환코드{compFax}로 제공되어 회사정보 설정에 등록된 "팩스번호"가 자동으로 표시됩니다.</br>
		&nbsp;- 등록한 내용은 [주문상세조회 페이지]에 표시됩니다.</span>
	</td>
</tr>
<?
	$str = "none";
	if(!$checked['period']['nolimit']){
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
		&nbsp;- 치환코드{adminEmail}와 {compPhone}가 제공되어 회사정보 설정에 등록된 '관리자 E-mail'과 '전화번호'가 자동으로 표시됩니다. </span>
	</td>
</tr>
<tr>
	<td>인감이미지</td>
	<td>
	<input type="file" name="seal_up" size="50" class=line><input type="hidden" name="seal" value="<?=$set[seal]?>">
	<a href="javascript:webftpinfo( '<?=( $set[seal] != '' ? '/data/skin/' . $cfg['tplSkin'] . '/img/common/' . $set[seal] : '' )?>' );"><img src="../img/codi/icon_imgview.gif" border="0" alt="이미지 보기" align="absmiddle"></a>
	<? if ( $set[seal] != '' ){ ?>&nbsp;&nbsp;<span class="noline"><input type="checkbox" name="seal_del" value="Y">삭제</span><? } ?>
	</td>
</tr>
</table>

<div class=button>
<input type=image src="../img/btn_save.gif">
<a href="javascript:history.back()"><img src="../img/btn_cancel.gif"></a>
</div>

</form>
<span class="FontWeightBold FontColorRed">※ 2016년 03월 31일 이전 제작 무료 스킨</span>을 사용하시는 경우
<span class="FontWeightBold TextUnderline">반드시 스킨패치를 적용</span>해야 기능 사용이 가능합니다.
<a href="http://www.godo.co.kr/customer_center/patch.php?sno=2359" target="_blank" class="FontColorSky TextUnderline FontWeightBold">[패치 바로가기]</a></br>
<span>- 스킨패치 후에는 디자인관리 페이지에서 제공하던 이용/탈퇴안내 관련 텍스트(txt)파일은 더 이상 사용하지 않으므로 쇼핑몰 정책에 따른 이용안내 및 탈퇴안내 관련 내용을
위의 각입력 항목에 입력 또는 수정하여 완성해 주시기 바랍니다.</span>
<div id=MSG01>
<table cellpadding=1 cellspacing=0 border=0 class=small_ex>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">신용카드 결제주문은 세금계산서를 발행하지 않습니다.</td></tr>
<tr><td style="padding-left:7pt;">2004년 개정된 부가가치세법에 의하면, 2004년 7월 1일 이후 신용카드로 결제된 건에 대해서는 세금 계산서 발행이 불가</font>하며 신용카드 매출전표로 부가가치세 신고</font>를 하셔야 합니다.<br>
[ 부가가치세법 시행령 57조 관련법규 참조 ]</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">인감이미지의 사이즈는 가로/세로 74 pixel로 만드시고, 파일종류는 JPG 또는 GIF파일로 만드세요.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">일반세금계산서 발행방식 안내
<ol type="a" style="margin:0px 0px 0px 40px;">
<li>세금계산서를 수기로 작성한 후 우편발송이나 직접 전달하는 종이 세금계산서를 뜻합니다.</li>
<li>고도몰에서는 종이 세금계산서를 손쉽게 작성/전달 할 수 있도록 프린트 기능을 제공하고 있습니다.</li>
</ol>
</td></tr>
</table>
</div>
<script>cssRound('MSG01')</script>