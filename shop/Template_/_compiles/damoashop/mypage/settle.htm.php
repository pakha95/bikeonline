<?php /* Template_ 2.2.7 2015/06/04 23:11:41 /www/jbsinttr8192_godo_co_kr/shop/data/skin/damoashop/mypage/settle.htm 000011596 */ 
if (is_array($TPL_VAR["item"])) $TPL_item_1=count($TPL_VAR["item"]); else if (is_object($TPL_VAR["item"]) && in_array("Countable", class_implements($TPL_VAR["item"]))) $TPL_item_1=$TPL_VAR["item"]->count();else $TPL_item_1=0;
if (is_array($_POST)) $TPL__POST_1=count($_POST); else if (is_object($_POST) && in_array("Countable", class_implements($_POST))) $TPL__POST_1=$_POST->count();else $TPL__POST_1=0;
if (is_array($GLOBALS["bank"])) $TPL__bank_1=count($GLOBALS["bank"]); else if (is_object($GLOBALS["bank"]) && in_array("Countable", class_implements($GLOBALS["bank"]))) $TPL__bank_1=$GLOBALS["bank"]->count();else $TPL__bank_1=0;?>
<?php $this->print_("header",$TPL_SCP,1);?>


<style>
#orderbox {border:5px solid #F3F3F3; padding:5px 10px;}
#orderbox table th {width:100;}
</style>

<!-- ����̹��� || ������ġ -->
<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr><td><img src="/shop/data/skin/damoashop/img/common/title_payment.gif" border=0></td></tr>
<tr><td class="path">home > <b>�����ϱ�</b></td></tr>
</table>


<div class="indiv"><!-- Start indiv -->

<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr><td height=2 bgcolor="#303030" colspan=10></td></tr>
<tr bgcolor=#F0F0F0 height=23>
	<th colspan=2 class="input_txt">��ǰ����</th>
	<th class="input_txt">������</th>
	<th class="input_txt">�ǸŰ�</th>
	<th class="input_txt">����</th>
	<th class="input_txt">�հ�</th>
</tr>
<tr><td height=1 bgcolor="#D6D6D6" colspan=10></td></tr>
<?php if($TPL_item_1){foreach($TPL_VAR["item"] as $TPL_V1){?>
<tr>
	<td align=center width=60 height=60><?php echo goodsimg($TPL_V1["img_s"], 50)?></td>
	<td>
	<?php echo $TPL_V1["goodsnm"]?>

<?php if($TPL_V1["opt1"]){?>[<?php echo $TPL_V1["opt1"]?><?php if($TPL_V1["opt2"]){?>/<?php echo $TPL_V1["opt2"]?><?php }?>]<?php }?>
<?php if($TPL_V1["addopt"]){?><div>[<?php echo str_replace("^","] [",$TPL_V1["addopt"])?>]</div><?php }?>
	</td>
	<td align=center><?php echo number_format($TPL_V1["reserve"])?>��</td>
	<td align=center><?php echo number_format($TPL_V1["price"])?>��</td>
	<td align=center><?php echo number_format($TPL_V1["ea"])?>��</td>
	<td align=center><?php echo number_format($TPL_V1["price"]*$TPL_V1["ea"])?>��</td>
</tr>
<tr><td colspan=10 height=1 bgcolor=#DEDEDE></td></tr>
<?php }}?>
</table>

<p>

<form name="frmSettle" method="post" action="<?php echo $TPL_VAR["action_url"]?>" target="ifrmHidden">
<?php if($TPL__POST_1){foreach($_POST as $TPL_K1=>$TPL_V1){?>
<?php if(is_array($TPL_V1)){?>
<?php if((is_array($TPL_R2=$TPL_V1)&&!empty($TPL_R2)) || (is_object($TPL_R2) && in_array("Countable", class_implements($TPL_R2)) && $TPL_R2->count() > 0)) {foreach($TPL_R2 as $TPL_V2){?>
	<input type=hidden name="<?php echo $TPL_K1?>[]" value="<?php echo $TPL_V2?>">
<?php }}?>
<?php }else{?>
	<input type=hidden name="<?php echo $TPL_K1?>" value="<?php echo $TPL_V1?>">
<?php }?>
<?php }}?>

<img src="/shop/data/skin/damoashop/img/common/payment_txt_01.gif" border=0>
<!-- 01 �ֹ������� -->
<table width=100% style="border:1px solid #DEDEDE" cellpadding=0 cellspacing=0>
<tr>
	<td width=150 valign=top align=right bgcolor="#F3F3F3"><img src="/shop/data/skin/damoashop/img/common/order_step_01.gif"></td>
	<td id="orderbox">

	<table>
	<col width=100>
	<tr>
		<td>�ֹ��ڸ�</td>
		<td><?php echo $TPL_VAR["nameOrder"]?></td>
	</tr>
	<tr>
		<td>�ֹ��� ��ȭ</td>
		<td><?php echo implode("-",$TPL_VAR["phoneOrder"])?></td>
	</tr>
	<tr>
		<td>�ֹ��� �ڵ���</td>
		<td><?php echo implode("-",$TPL_VAR["mobileOrder"])?></td>
	</tr>
	<tr>
		<td>�̸���</td>
		<td><?php echo $TPL_VAR["email"]?></td>
	</tr>
	</table>

	</td>
</tr>
</table><div style="font-size:0;height:5px"></div>

<!-- 02 ������� -->
<table width=100% style="border:1px solid #DEDEDE" cellpadding=0 cellspacing=0>
<tr>
	<td width=150 valign=top align=right bgcolor="#F3F3F3"><img src="/shop/data/skin/damoashop/img/common/order_step_02.gif"></td>
	<td id="orderbox">

	<table>
	<col width=100>
	<tr>
		<td>�޴��ڸ�</td>
		<td><?php echo $TPL_VAR["nameReceiver"]?></td>
	</tr>
	<tr>
		<td>�޴��� ��ȭ</td>
		<td><?php echo implode("-",$TPL_VAR["phoneReceiver"])?></td>
	</tr>
	<tr>
		<td>�޴��� �ڵ���</td>
		<td><?php echo implode("-",$TPL_VAR["mobileReceiver"])?></td>
	</tr>
	<tr>
		<td>�����ȣ</td>
		<td><?php echo $TPL_VAR["zipcode"]?></td>
	</tr>
	<tr>
		<td>�ּ�</td>
		<td><?php echo $TPL_VAR["address"]?> <?php echo $TPL_VAR["address_sub"]?><div style="padding-top:5px;font:12px dotum;color:#999;"><?php echo $TPL_VAR["road_address"]?> <?php echo $TPL_VAR["address_sub"]?></div></td>
	</tr>
	</table>

	</td>
</tr>
</table><div style="font-size:0;height:5px"></div>

<!-- 03 �����ݾ� -->
<table width=100% style="border:1px solid #DEDEDE" cellpadding=0 cellspacing=0>
<tr>
	<td width=150 valign=top align=right bgcolor="#F3F3F3"><img src="/shop/data/skin/damoashop/img/common/order_step_03.gif"></td>
	<td id="orderbox">

	<table>
	<col width=100><col align="right">
	<tr>
		<td>���ֹ��ݾ�</td>
		<td><?php echo number_format($TPL_VAR["goodsprice"])?>��</td>
	</tr>
<?php if($TPL_VAR["deli_title"]){?>
	<tr>
		<td>��ۼ���</td>
		<td>
		<?php echo $TPL_VAR["deli_title"]?>

		</td>
	</tr>
<?php }?>
	<tr>
		<td>��ۺ�</td>
		<td>
<?php if(!$TPL_VAR["deli_msg"]){?><?php echo number_format($TPL_VAR["delivery"])?><?php }else{?><?php echo $TPL_VAR["deli_msg"]?><?php }?>
		��</td>
	</tr>
	<tr>
		<td>ȸ������</td>
		<td>- <?php echo number_format($TPL_VAR["memberdc"])?>��</td>
	</tr>
<?php if($TPL_VAR["goodsDc"]){?>
	<tr>
		<td>��ǰ����</td>
		<td>- <?php echo number_format($TPL_VAR["goodsDc"])?>��</td>
	</tr>
<?php }?>
<?php if($TPL_VAR["coupon"]){?>
	<tr>
		<td>��������</td>
		<td>- <?php echo number_format($TPL_VAR["coupon"])?>��</td>
	</tr>
<?php }?>
<?php if($TPL_VAR["coupon_emoney"]){?>
	<tr>
		<td>��������</td>
		<td><?php echo number_format($TPL_VAR["coupon_emoney"])?>��</td>
	</tr>
<?php }?>
	<tr>
		<td>������ ���</td>
		<td>- <?php echo number_format($TPL_VAR["emoney"])?>��</td>
	</tr>
<?php if($GLOBALS["data"]["ncash_emoney"]){?>
	<tr>
		<td>���̹����ϸ���</td>
		<td>- <span id="paper_emoney"><?php echo number_format($TPL_VAR["ncash_emoney"])?></span>��</td>
	</tr>
<?php }?>
<?php if($GLOBALS["data"]["ncash_cash"]){?>
	<tr>
		<td>���̹�ĳ��</td>
		<td>- <span id="paper_emoney"><?php echo number_format($TPL_VAR["ncash_cash"])?></span>��</td>
	</tr>
<?php }?>
<?php if($TPL_VAR["eggFee"]){?>
	<tr>
		<td>�������� ������</td>
		<td><?php echo number_format($TPL_VAR["eggFee"])?>��</td>
	</tr>
<?php }?>
	<tr>
		<td>�����ݾ�</td>
		<td><b><?php echo number_format($TPL_VAR["settleprice"])?>��</b></td>
	</tr>
	</table>

	</td>
</tr>
</table><div style="font-size:0;height:5px"></div>

<!-- 04-1 �������Ա� --><?php if($TPL_VAR["settlekind"]=="a"){?>
<table width=100% style="border:1px solid #DEDEDE" cellpadding=0 cellspacing=0>
<tr>
	<td width=150 valign=top align=right bgcolor="#F3F3F3"><img src="/shop/data/skin/damoashop/img/common/order_step_04.gif"></td>
	<td id="orderbox">

	<table>
	<col width=100>
	<tr>
		<td>�Աݰ��¼���</td>
		<td>
		<select name=bankAccount required label="�Աݰ���">
		<option value="">== �Աݰ��¸� �������ּ��� ==
<?php if($TPL__bank_1){foreach($GLOBALS["bank"] as $TPL_V1){?>
		<option value="<?php echo $TPL_V1["sno"]?>"><?php echo $TPL_V1["bank"]?> <?php echo $TPL_V1["account"]?> <?php echo $TPL_V1["name"]?>

<?php }}?>
		</select>
		</td>
	</tr>
	<tr>
		<td>�Ա��ڸ�</td>
		<td>
		<input type=text name=bankSender class=line value="<?php echo $TPL_VAR["nameOrder"]?>" required  label="�Ա��ڸ�">
		</td>
	</tr>
	<tr>
		<td>�Աݱݾ�</td>
		<td><b class=red><?php echo number_format($TPL_VAR["settleprice"])?>��</b></td>
	</tr>
	</table>

	</td>
</tr>
</table><div style="font-size:0;height:5px"></div>
<?php }?>

</form>

<!-- 04-2 �ſ�ī�� --><?php if($TPL_VAR["settlekind"]=="c"){?>
<table width=100% style="border:1px solid #DEDEDE" cellpadding=0 cellspacing=0>
<tr>
	<td width=150 valign=top align=right bgcolor="#F3F3F3"><img src="/shop/data/skin/damoashop/img/common/order_step_04.gif"></td>
	<td id="orderbox">

	<table width=100%>
	<col width=100>
	<tr>
		<td>ī�����</td>
		<td>�ſ�ī��</td>
	</tr>
	<tr>
		<td>�����ݾ�</td>
		<td><b class=red><?php echo number_format($TPL_VAR["settleprice"])?>��</b></td>
	</tr>
	</table>

<?php $this->print_("card_gate",$TPL_SCP,1);?>


	</td>
</tr>
</table><div style="font-size:0;height:5px"></div>

<!-- 04-3 ������ü --><?php }elseif($TPL_VAR["settlekind"]=="o"){?>
<table width=100% style="border:1px solid #DEDEDE" cellpadding=0 cellspacing=0>
<tr>
	<td width=150 valign=top align=right bgcolor="#F3F3F3"><img src="/shop/data/skin/damoashop/img/common/order_step_04.gif"></td>
	<td id="orderbox">

	<table width=100%>
	<col width=100>
	<tr>
		<td>�������</td>
		<td>������ü</td>
	</tr>
	<tr>
		<td>�����ݾ�</td>
		<td><b class=red><?php echo number_format($TPL_VAR["settleprice"])?>��</b></td>
	</tr>
	</table>

<?php $this->print_("card_gate",$TPL_SCP,1);?>


	</td>
</tr>
</table><div style="font-size:0;height:5px"></div>

<!-- 04-4 ������� --><?php }elseif($TPL_VAR["settlekind"]=="v"){?>
<table width=100% style="border:1px solid #DEDEDE" cellpadding=0 cellspacing=0>
<tr>
	<td width=150 valign=top align=right bgcolor="#F3F3F3"><img src="/shop/data/skin/damoashop/img/common/order_step_04.gif"></td>
	<td id="orderbox">

	<table width=100%>
	<col width=100>
	<tr>
		<td>�������</td>
		<td>�������</td>
	</tr>
	<tr>
		<td>�����ݾ�</td>
		<td><b class=red><?php echo number_format($TPL_VAR["settleprice"])?>��</b></td>
	</tr>
	</table>

<?php $this->print_("card_gate",$TPL_SCP,1);?>


	</td>
</tr>
</table><div style="font-size:0;height:5px"></div>

<!-- 04-5 �ڵ��� --><?php }elseif($TPL_VAR["settlekind"]=="h"){?>
<table width=100% style="border:1px solid #DEDEDE" cellpadding=0 cellspacing=0>
<tr>
	<td width=150 valign=top align=right bgcolor="#F3F3F3"><img src="/shop/data/skin/damoashop/img/common/order_step_04.gif"></td>
	<td id="orderbox">

	<table width=100%>
	<col width=100>
	<tr>
		<td>�������</td>
		<td>�ڵ���</td>
	</tr>
	<tr>
		<td>�����ݾ�</td>
		<td><b class=red><?php echo number_format($TPL_VAR["settleprice"])?>��</b></td>
	</tr>
	</table>

<?php $this->print_("card_gate",$TPL_SCP,1);?>


	</td>
</tr>
</table><div style="font-size:0;height:5px"></div>
<?php }?>

<div style="padding:20px" align=center id="avoidDblPay">
<a href="javascript:submitSettleForm()"><img src="/shop/data/skin/damoashop/img/common/btn_payment.gif"></a>
<a href="javascript:history.back();"><img src="/shop/data/skin/damoashop/img/common/btn_back.gif"></a>
</div>

</div><!-- End indiv -->


<script>
function submitSettleForm()
{
	var fm = document.frmSettle;

	if (!chkForm(fm)) return;

	/*** �ֹ��ʼ����� üũ ***/

	if (document.getElementById('avoidDblPay')) document.getElementById('avoidDblPay').innerHTML = "--- ���� ����ó�����Դϴ�. ��ø� ��ٷ��ּ���. ---";

<?php if($GLOBALS["cfg"]["settlePg"]=='dacom'){?>
	window.open("","Window","width=330, height=430, status=yes, scrollbars=no,resizable=yes, menubar=no");
<?php }?>

	fm.submit();
}
</script>

<?php $this->print_("footer",$TPL_SCP,1);?>