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


<div id="title" align="center" class="title">�� �� ��</div>
<table id="contents" align="center" width="904px" cellspacing="0"cellpadding="0" style="background-position : 620px 0px; background-image : url(../<?php echo $TPL_VAR["cartCfg"]["estimateSeal"]?>); background-repeat: no-repeat;">
	<tr align="center">
		<td rowspan=5 class="bold" width="40px;" height="160px;">��<br>��<br>��</td>
		<th class="bold" height="30px;">����� ��Ϲ�ȣ</th>
		<td class="left" colspan=4><?php echo $TPL_VAR["cfg"]["compSerial"]?></td>

		<td rowspan=5 colspan=2 width="200px;" style="border-left-width: 3px; border-right-width: 3px;">
			<div class="common" style="text-decoration:underline"><b>����: <? echo date("Y�� m�� d��"); ?> </b></div></br>
			<input id="input" type='text' class="name" size="10" value=<?php echo $TPL_VAR["memberName"]?> >
			<div class="common">�Ʒ��� ���� �����մϴ�.</div>
		</td>
	</tr>
	<tr align="center" height="30px;">
		<th class="bold">�� ȣ</th>
		<td class="left"><?php echo $TPL_VAR["cfg"]["compName"]?></td>
		<th class="bold">��ǥ�ڸ�</th>
		<td class="left" colspan=2><?php echo $TPL_VAR["cfg"]["ceoName"]?></td>
	</tr>
	<tr align="center" height="30px;">
		<th class="bold">����� ������</th>
<?php if(!$TPL_VAR["cfg"]["road_address"]){?>
		<td colspan=4 class="left" style="padding-left:10px;">(<?php echo $TPL_VAR["cfg"]["zipcode"]?>) <?php echo $TPL_VAR["cfg"]["address"]?> </td>
<?php }else{?>
		<td colspan=4 class="left" style="padding-left:10px;">(<?php echo $TPL_VAR["cfg"]["zipcode"]?>) <?php echo $TPL_VAR["cfg"]["road_address"]?> </td>
<?php }?>
	</tr>
	<tr align="center" height="30px;">
		<th class="bold">����</th>
		<td class="left"><?php echo $TPL_VAR["cfg"]["service"]?></td>
		<th class="bold">����</th>
		<td class="left" colspan=2><?php echo $TPL_VAR["cfg"]["item"]?></td>
	</tr>
	<tr align="center" height="30px;">
		<th class="bold">��ȭ</th>
		<td class="left"><?php echo $TPL_VAR["cfg"]["compPhone"]?></td>
		<th class="bold">�ѽ�</th>
		<td class="left" colspan=2><?php echo $TPL_VAR["cfg"]["compFax"]?></td>
	</tr>
	<tr align="center">
		<th colspan=2 class="bold" height="47px;" style="border-top-width: 3px; border-bottom-width: 3px;">�հ� �ݾ�<br>(���ް���+�ΰ���)</th>
		<td class="common" align="left" colspan=6 style="border-right-width: 3px; border-top-width: 3px; border-bottom-width: 3px; padding-left:10px;">�ϱ� <?php echo $TPL_VAR["priceKor"]?>���� (\<?php echo number_format($TPL_VAR["totalPrice"])?>)</td>
	</tr>
	<tr align=center height="30px;" class="bold">
		<th>����</th>
		<th colspan=3>ǰ��</th>
		<th width="40px;">����</th>
		<th width="100px;">�ܰ�</th>
		<th width="100px;">���ް���</th>
		<th width="100px;" style="border-right-width: 3px;">����</td>
	</tr>

<?php if($TPL_item_1){foreach($TPL_VAR["item"] as $TPL_V1){?>
	<tr align=center height="30px;">	
		<td class="common"><?php echo $TPL_V1["idxs"]?></td>
		<td class="common" align="left" style="padding-left:10px;" colspan=3><?php echo $TPL_V1["goodsnm"]?><br>
<?php if($TPL_V1["opt"]){?>
				���ÿɼ� : [<?php echo implode("/",$TPL_V1["opt"])?>]
<?php }?>
<?php if($TPL_V1["select_addopt"]){?>
<?php if($TPL_V1["opt"]){?> , <?php }?>
				�߰��ɼ� : <?php if((is_array($TPL_R2=$TPL_V1["select_addopt"])&&!empty($TPL_R2)) || (is_object($TPL_R2) && in_array("Countable", class_implements($TPL_R2)) && $TPL_R2->count() > 0)) {foreach($TPL_R2 as $TPL_V2){?>[<?php echo $TPL_V2["optnm"]?>:<?php echo $TPL_V2["opt"]?>]<?php }}?>
<?php }?>
<?php if($TPL_V1["input_addopt"]){?>
<?php if($TPL_V1["opt"]||$TPL_V1["select_addopt"]){?> , <?php }?>
				�Է¿ɼ� : <?php if((is_array($TPL_R2=$TPL_V1["input_addopt"])&&!empty($TPL_R2)) || (is_object($TPL_R2) && in_array("Countable", class_implements($TPL_R2)) && $TPL_R2->count() > 0)) {foreach($TPL_R2 as $TPL_V2){?>[<?php echo $TPL_V2["optnm"]?>:<?php echo $TPL_V2["opt"]?>]<?php }}?>
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
		<th colspan=6 class="bold" height="30px;">�Ұ�</th>
		<td class="number"><?php echo number_format($TPL_VAR["totalSupplyPrice"])?></td>
		<td class="number" style="border-right-width: 3px;"><?php echo number_format($TPL_VAR["totalPrice"]-$TPL_VAR["totalSupplyPrice"])?> </td>
	</tr>
	<tr align=center height=60>
		<th class="bold">���</th>
		<td colspan=8><?php echo $TPL_VAR["cartCfg"]["estimateMessage"]?></td>
	</tr>
</table>

<div id="button" align="center" style="padding-top:20px;">
	<span class="print-btn" onclick="javascript:window.print();">�μ�</span>&nbsp;
	<span class="close-btn" onclick="javascript:window.close();">�ݱ�</span>
</div>

<div id="etc" class="common" align="left" style="padding-left:415px; padding-top:15px;">�� ������ �μ�� ����(�����̹���)�� �μ�Ƿ��� �Ʒ��� ���� �����Ǿ� �־�� �����մϴ�.</div>
<div id="etc" class="common" align="left" style="padding-left:430px;">1) ���ͳ� �ͽ��÷η� : �������� [���� �޴�]-[���ͳݿɼ�]-[���]-[�μ�] ���� [���� �� �̹��� �μ�] üũ</br>
2) ���̾����� : �������� [����]-[������ ����]-[���� �� ���]-[����]���� [��� �μ�(���� �� �̹���)] üũ</br>
3) ũ�� : �μ� ȭ�� ������ [�ɼ�] ���� [���׷���] üũ</div>