<?php /* Template_ 2.2.7 2015/11/14 21:39:39 /www/jbsinttr8192_godo_co_kr/shop/data/skin/damoashop/goods/goods_estimate.htm 000007188 */ 
if (is_array($TPL_VAR["item"])) $TPL_item_1=count($TPL_VAR["item"]); else if (is_object($TPL_VAR["item"]) && in_array("Countable", class_implements($TPL_VAR["item"]))) $TPL_item_1=$TPL_VAR["item"]->count();else $TPL_item_1=0;?>
<style type = "text/css">
table {border-collapse:collapse; border:3px solid gray; border-spacing:0px;}
th,td {border:1px solid gray;}
.common {font: 12pt Dodum; color: #464646;}
.left {font: 12pt Dodum; color: #464646; text-align:left; padding-left:10px;}
.bold {font:bold 12pt Dodum; color: #464646;}
.title {font: bold 24pt Dodum; color: #464646; padding-bottom:10px; padding-top:10px;}
.name {font: bold 16pt Dodum; color: #464646; text-align:right;}
.number {font: 12pt Dodum; color: #464646; text-align:right; padding-right:10px;}
.print-btn {font: 14pt Dodum; color: #FFFFFF; width:106px; height:33px; background:#464646; line-height:33px; cursor:pointer; display:inline-block;}
.close-btn {font: 14pt Dodum; color: #464646; width:106px; height:33px; background:#BDBDBD; line-height:33px; cursor:pointer; display:inline-block;}
@media print {
	#button {display: none;}
	#input {border:none;}
	#etc {display: none;}
}
</style>


<div id="title" align="center" class="title">견 적 서</div>
<table id="contents" align="center" width="904px" cellspacing="0"cellpadding="0" style="background-position : 620px 0px; background-image : url(../<?php echo $TPL_VAR["cartCfg"]["estimateSeal"]?>); background-repeat: no-repeat;">
	<tr align="center">
		<td rowspan=5 class="bold" width="40px;" height="160px;">공<br>급<br>자</td>
		<th class="bold" height="30px;">사업자 등록번호</th>
		<td class="left" colspan=4><?php echo $TPL_VAR["cfg"]["compSerial"]?></td>

		<td rowspan=5 colspan=2 width="200px;" style="border-left-width: 3px; border-right-width: 3px;">
			<div class="common" style="text-decoration:underline"><b>일자: <? echo date("Y년 m월 d일"); ?> </b></div></br>
			<input id="input" type='text' class="name" size="10" value=<?php echo $TPL_VAR["memberName"]?> >
			<div class="common">아래와 같이 견적합니다.</div>
		</td>
	</tr>
	<tr align="center" height="30px;">
		<th class="bold">상 호</th>
		<td class="left"><?php echo $TPL_VAR["cfg"]["compName"]?></td>
		<th class="bold">대표자명</th>
		<td class="left" colspan=2><?php echo $TPL_VAR["cfg"]["ceoName"]?></td>
	</tr>
	<tr align="center" height="30px;">
		<th class="bold">사업장 소재지</th>
<?php if(!$TPL_VAR["cfg"]["road_address"]){?>
		<td colspan=4 class="left" style="padding-left:10px;">(<?php echo $TPL_VAR["cfg"]["zipcode"]?>) <?php echo $TPL_VAR["cfg"]["address"]?> </td>
<?php }else{?>
		<td colspan=4 class="left" style="padding-left:10px;">(<?php echo $TPL_VAR["cfg"]["zipcode"]?>) <?php echo $TPL_VAR["cfg"]["road_address"]?> </td>
<?php }?>
	</tr>
	<tr align="center" height="30px;">
		<th class="bold">업태</th>
		<td class="left"><?php echo $TPL_VAR["cfg"]["service"]?></td>
		<th class="bold">종목</th>
		<td class="left" colspan=2><?php echo $TPL_VAR["cfg"]["item"]?></td>
	</tr>
	<tr align="center" height="30px;">
		<th class="bold">전화</th>
		<td class="left"><?php echo $TPL_VAR["cfg"]["compPhone"]?></td>
		<th class="bold">팩스</th>
		<td class="left" colspan=2><?php echo $TPL_VAR["cfg"]["compFax"]?></td>
	</tr>
	<tr align="center">
		<th colspan=2 class="bold" height="47px;" style="border-top-width: 3px; border-bottom-width: 3px;">합계 금액<br>(공급가액+부가세)</th>
		<td class="common" align="left" colspan=6 style="border-right-width: 3px; border-top-width: 3px; border-bottom-width: 3px; padding-left:10px;">일금 <?php echo $TPL_VAR["priceKor"]?>원정 (\<?php echo number_format($TPL_VAR["totalPrice"])?>)</td>
	</tr>
	<tr align=center height="30px;" class="bold">
		<th>순번</th>
		<th colspan=3>품명</th>
		<th width="40px;">수량</th>
		<th width="100px;">단가</th>
		<th width="100px;">공급가액</th>
		<th width="100px;" style="border-right-width: 3px;">세액</td>
	</tr>

<?php if($TPL_item_1){foreach($TPL_VAR["item"] as $TPL_V1){?>
	<tr align=center height="30px;">	
		<td class="common"><?php echo $TPL_V1["idxs"]?></td>
		<td class="common" align="left" style="padding-left:10px;" colspan=3><?php echo $TPL_V1["goodsnm"]?><br>
<?php if($TPL_V1["opt"]){?>
				선택옵션 : [<?php echo implode("/",$TPL_V1["opt"])?>]
<?php }?>
<?php if($TPL_V1["select_addopt"]){?>
<?php if($TPL_V1["opt"]){?> , <?php }?>
				추가옵션 : <?php if((is_array($TPL_R2=$TPL_V1["select_addopt"])&&!empty($TPL_R2)) || (is_object($TPL_R2) && in_array("Countable", class_implements($TPL_R2)) && $TPL_R2->count() > 0)) {foreach($TPL_R2 as $TPL_V2){?>[<?php echo $TPL_V2["optnm"]?>:<?php echo $TPL_V2["opt"]?>]<?php }}?>
<?php }?>
<?php if($TPL_V1["input_addopt"]){?>
<?php if($TPL_V1["opt"]||$TPL_V1["select_addopt"]){?> , <?php }?>
				입력옵션 : <?php if((is_array($TPL_R2=$TPL_V1["input_addopt"])&&!empty($TPL_R2)) || (is_object($TPL_R2) && in_array("Countable", class_implements($TPL_R2)) && $TPL_R2->count() > 0)) {foreach($TPL_R2 as $TPL_V2){?>[<?php echo $TPL_V2["optnm"]?>:<?php echo $TPL_V2["opt"]?>]<?php }}?>
<?php }?>
		</td>
		<td class="common" ><?php echo $TPL_V1["ea"]?></td>
<?php if($TPL_V1["tax"]!='1'){?>
		<td class="number"><?php echo number_format($TPL_V1["price"]+$TPL_V1["addprice"])?></td>
		<td class="number"><?php echo number_format($TPL_V1["supply"])?></td>
		<td class="number" style="border-right-width: 3px;">0</td>
<?php }else{?>
		<td class="number"><?php echo number_format($TPL_V1["price"]+$TPL_V1["addprice"])?></td>
		<td class="number"><?php echo number_format($TPL_V1["supply"])?></td>
		<td class="number" style="border-right-width: 3px;"><?php echo number_format((($TPL_V1["price"]+$TPL_V1["addprice"])*$TPL_V1["ea"])-$TPL_V1["supply"])?></td>
<?php }?>
	</tr>
<?php }}?>

	<tr align=center> 
		<th colspan=6 class="bold" height="30px;">소계</th>
		<td class="number"><?php echo number_format($TPL_VAR["totalSupplyPrice"])?></td>
		<td class="number" style="border-right-width: 3px;"><?php echo number_format($TPL_VAR["totalPrice"]-$TPL_VAR["totalSupplyPrice"])?> </td>
	</tr>
	<tr align=center height=60>
		<th class="bold">비고</th>
		<td colspan=8><?php echo $TPL_VAR["cartCfg"]["estimateMessage"]?></td>
	</tr>
</table>

<div id="button" align="center" style="padding-top:20px;">
	<span class="print-btn" onclick="javascript:window.print();">인쇄</span>&nbsp;
	<span class="close-btn" onclick="javascript:window.close();">닫기</span>
</div>

<div id="etc" class="common" align="left" style="padding-left:415px; padding-top:15px;">※ 견적서 인쇄시 직인(도장이미지)도 인쇄되려면 아래와 같이 설정되어 있어야 가능합니다.</div>
<div id="etc" class="common" align="left" style="padding-left:430px;">1) 인터넷 익스플로러 : 브라우저의 [도구 메뉴]-[인터넷옵션]-[고급]-[인쇄] 에서 [배경색 및 이미지 인쇄] 체크</br>
2) 파이어폭스 : 브라우저의 [파일]-[페이지 설정]-[용지 및 배경]-[설정]에서 [배경 인쇄(색상 및 이미지)] 체크</br>
3) 크롬 : 인쇄 화면 좌측의 [옵션] 에서 [배경그래픽] 체크</div>