<?php /* Template_ 2.2.7 2017/03/04 00:10:17 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/ord/order.htm 000038129 */ 
if (is_array($TPL_VAR["list"])) $TPL_list_1=count($TPL_VAR["list"]); else if (is_object($TPL_VAR["list"]) && in_array("Countable", class_implements($TPL_VAR["list"]))) $TPL_list_1=$TPL_VAR["list"]->count();else $TPL_list_1=0;
if (is_array($GLOBALS["r_deli"])) $TPL__r_deli_1=count($GLOBALS["r_deli"]); else if (is_object($GLOBALS["r_deli"]) && in_array("Countable", class_implements($GLOBALS["r_deli"]))) $TPL__r_deli_1=$GLOBALS["r_deli"]->count();else $TPL__r_deli_1=0;?>
<?php $this->print_("header",$TPL_SCP,1);?>


<?php  $TPL_VAR["page_title"] = "�ֹ��ϱ�";?>
<?php $this->print_("sub_header",$TPL_SCP,1);?>

<style type="text/css">
section#m_order{background:#FFFFFF;}

section#nm_order {background:#FFFFFF; padding:12px;font-family:dotum;font-size:12px;}
section#nm_order .sub_title{height:22px; line-height:22px; color:#436693; font-weight:bold; font-size:12px;}
section#nm_order .sub_title .point {width:4px; height:22px; background:url('/shop/data/skin_mobileV2/light/common/img/bottom/icon_guide.png') no-repeat center left; float:left; margin-right:7px;}
section#nm_order table{border:none; border-top:solid 1px #dbdbdb;width:100%; margin-bottom:20px;}
section#nm_order table td{padding:8px 0px 8px 10px; vertical-align:middle; border-bottom:solid 1px #dbdbdb;}
section#nm_order table th{text-align:center; background:#f5f5f5; width:70px; vertical-align:middle; border-bottom:solid 1px #dbdbdb; color:#353535; font-size:12px;}
section#nm_order table .img{padding:5px; width:60px;}
section#nm_order table .img img{border:solid 1px #d9d9d9;}
section#nm_order table td input[type=text], input[type=password], input[type=email], input[type=number], select{height:21px;}

section#nm_order table td.phone input[type=number]{width:45px;height:21px;}
section#nm_order table td.zipcode input[type=text]{width:60px;height:21px;}
section#nm_order table td.zipcode input[type=number]{width:30px;height:21px;}
section#nm_order table td.zipcode #zonecode {width:45px;height:21px;}
section#nm_order table td.coupon input[type=number]{width:100px;height:21px;}
section#nm_order table td.emoney input[type=number]{width:100px;height:21px;}
section#nm_order table td textarea{width:95%;height:116px;}
section#nm_order .btn_center {margin:auto; width:198px; height:34px; margin-top:20px; margin-bottom:20px;}
section#nm_order .btn_center .btn_payment{border:none; background:#f35151; color:#FFFFFF; font-size:14px; width:94px; height:34px; float:left; font-family:dotum; line-height:34px; border-radius:3px;}
section#nm_order .btn_center .btn_prev{border:none; background:#808591;  color:#FFFFFF; font-size:14px; width:94px; height:34px; float:right; font-family:dotum; line-height:34px; border-radius:3px;}
section#nm_order .goods-nm{color:#353535; font-weight:bold; fonst-size:14px; margin-bottom:5px; overflow:hidden;text-overflow:ellipsis;white-space:nowrap; }
section#nm_order .goods-price{color:#f03c3c; font-size:12px;}
#zipcode_list ul {list-style:none;}
#zipcode_list li {padding:5px; 0px;}
.btn_zipcode {background:#808591; width:73px; height:25px; border:none; color:#FFFFFF; text-align:center; margin-left:10px;line-height:25px; border-radius:3px;vertical-align:middle;}
.coupon-btn-area {margin-bottom:10px;}
.btn_coupon {background:#808591; width:73px; height:25px; border:none; color:#FFFFFF; text-align:center; margin-right:10px;line-height:25px; border-radius:3px;}
.max_width{width:95%;}

section#nm_order #couponListTable th:first-child		{ width: 15%; }
section#nm_order #couponListTable th:last-child			{ width: 25%; }
section#nm_order #couponListTable td:nth-child(1)		{ text-align: center; padding-left:0px; }
section#nm_order #couponListTable td:nth-child(2) div	{ width: 100%;}
section#nm_order #couponListTable td:nth-child(3)		{ text-align: center; padding-left:0px; }

/* ���������, ���������� ����*/
section#nm_order #couponListTable td:nth-child(2) div.couponInfoOnlyBtn { height: 23px; }
section#nm_order #couponListTable td:nth-child(2) div.couponInfoOnlyBtn div.onlyMobileCouponBtn{ float: left; margin:0px 3px 3px 0px; width: 55px; height: 15px; color: #ffffff; font-size: 9px; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; background-color: #56ca81; font-weight: bold; text-align: center; line-height: 15px; }
section#nm_order #couponListTable td:nth-child(2) div.couponInfoOnlyBtn div.onlyBankBookCouponBtn	{ float: left; margin:0px 3px 3px 0px; width: 55px; height: 15px; color: #ffffff; font-size: 9px; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; background-color: #7b9ff0; font-weight: bold; text-align: center; line-height: 15px; }
.delivery_radio { height:30px; line-height:30px; }
.delivery_select { height:30px; line-height:30px; }
#delivery_list { width:100%; }
.dark_gray { background:#B9B9B9 !important; }
</style>

<?php echo $TPL_VAR["NaverMileageScript"]?>

<script id="delivery"></script>
<form id="form" name="frmOrder" action="settle.php" method="post" onsubmit="return chkForm2(this)" accept-charset="UTF-8">
<input type="hidden" name="ordno" value="<?php echo $TPL_VAR["ordno"]?>">
<input type="hidden" name="couponVersion" id="couponVersion" value="<?php echo $TPL_VAR["couponVersion"]?>">
<div id="apply_coupon"></div>
<section id="m_order" class="content">
<?php if((is_array($TPL_R1=$TPL_VAR["cart"]->item)&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?>
<input type="hidden" name=item_apply_coupon[]>
<?php }}?>
<?php echo $this->define('tpl_include_file_1',"proc/orderitem.htm")?> <?php $this->print_("tpl_include_file_1",$TPL_SCP,1);?>

</section>
<section id="nm_order" class="content" data-enhance="false">

<?php if(!$GLOBALS["sess"]){?>
<!-- �������� ���� ���� -->
<div class="sub_title"><div class="point"></div>�������� ���� ����</div>
<div style="padding-top: 10px; background: #f1f1f1; margin-bottom: 20px;">
	<div style="font-size: 11px; padding: 5px;">
		<span style="font-weight: bold;">�� ��ȸ�� �ֹ��� ���� �������� ������ ���� ����</span>
		<span>(�ڼ��� ������ ��<a href="../service/private.php">����������޹�ħ</a>���� Ȯ���Ͻñ� �ٶ��ϴ�)</span>
	</div>
	<div class="agreement-content" style="height: 100px; overflow-y: scroll; border: solid #dddddd 1px; background: #ffffff; padding: 5px;">
		<?php echo $TPL_VAR["termsPolicyCollection3"]?>

	</div>
	<div style="text-align: center; padding: 5px;">
		<input id="guest-private-agreement" type="hidden"/>
		<input id="private-agree" type="radio" name="private" value="y"/>
		<label for="private-agree">�����մϴ�</label>
		<input id="private-disagree" type="radio" name="private" value=""/>
		<label for="private-disagree">�������� �ʽ��ϴ�</label>
	</div>
</div>
<?php }?>

<!-- 01 �ֹ������� -->
<div class="sub_title"><div class="point"></div>�ֹ�������</div>
<table>
	<tr>
		<th>�ֹ��ڸ�</th>
		<td>
			<input type="text" name="nameOrder" value="<?php echo $TPL_VAR["name"]?>" <?php echo $GLOBALS["style_member"]?> required msgR="�ֹ��Ͻôº��� �̸��� �����ּ���" class="max_width"/>
		</td>
	</tr>
<?php if($TPL_VAR["address"]){?>
	<tr>
		<th>�ּ�</th>
		<td>
			<?php echo $TPL_VAR["address"]?><br /><?php echo $TPL_VAR["address_sub"]?>

<?php if($TPL_VAR["road_address"]){?><div style="padding-top:5px;font:12px dotum;color:#999;"><?php echo $TPL_VAR["road_address"]?> <?php echo $TPL_VAR["address_sub"]?></div><?php }?>
		</td>
	</tr>
<?php }?>
	<tr>
		<th>��ȭ��ȣ</th>
		<td class="phone">
			<input type="number" name="phoneOrder[]" value="<?php echo $TPL_VAR["phone"][ 0]?>" size="3" maxlength="3" required /> -
			<input type="number" name="phoneOrder[]" value="<?php echo $TPL_VAR["phone"][ 1]?>" size="4" maxlength="4" required /> -
			<input type="number" name="phoneOrder[]" value="<?php echo $TPL_VAR["phone"][ 2]?>" size="4" maxlength="4" required />
		</td>
	</tr>
	<tr>
		<th>�޴���</th>
		<td class="phone">
			<input type="number" name="mobileOrder[]" value="<?php echo $TPL_VAR["mobile"][ 0]?>" size="3" maxlength="3" required /> -
			<input type="number" name="mobileOrder[]" value="<?php echo $TPL_VAR["mobile"][ 1]?>" size="4" maxlength="4" required /> -
			<input type="number" name="mobileOrder[]" value="<?php echo $TPL_VAR["mobile"][ 2]?>" size="4" maxlength="4" required />
		</td>
	</tr>
	<tr>
		<th>�̸���</th>
		<td class="email">
			<input type="text" name="email" value="<?php echo $TPL_VAR["email"]?>" required option=regEmail class="max_width" />
		</td>
	</tr>
</table>
<div class="sub_title"><div class="point"></div>�������</div>
<table>
<?php if($GLOBALS["sess"]){?>
	<tr>
		<th>�����<br />����</th>
		<td>
			<div class="delivery_radio">
				<input type="radio" name="deli_select" id="deli_select1" value="1" onclick="ctrl_field(1)" checked /><label for="deli_select1"> �⺻ �����</label>
				<input type="radio" name="deli_select" id="deli_select2" value="2" onclick="ctrl_field(2)" /><label for="deli_select2"> �ֱ� �����</label>
				<input type="radio" name="deli_select" id="deli_select3" value="3" onclick="ctrl_field(0)" /><label for="deli_select3"> �ű� �����</label>
			</div>
			<div class="delivery_select">
				<select name="delivery_list" id="delivery_list">
					<option value="">����� ��Ͽ��� ����</option>
<?php if($TPL_list_1){foreach($TPL_VAR["list"] as $TPL_V1){?>
					<option value="<?php echo $TPL_V1["gmd_sno"]?>">
<?php if($TPL_V1["gmd_road_address"]){?>
						<?php echo $TPL_V1["gmd_road_address"]?>

<?php }else{?>
						<?php echo $TPL_V1["gmd_address"]?>

<?php }?>
						<?php echo $TPL_V1["gmd_address_sub"]?>

					</option>
<?php }}?>
				</select>
			</div>
		</td>
	</tr>
<?php }else{?>
	<tr>
		<th>�����</th>
		<td>
			<label><input type="checkbox" onclick="ctrl_field(this.checked)" <?php if($GLOBALS["sess"]){?>checked<?php }?> /> �ֹ����� ������ �����մϴ�</label>
		</td>
	</tr>
<?php }?>
	<tr>
		<th>�����Ǻ�</th>
		<td>
			<input type="text" name="nameReceiver" value="<?php echo $TPL_VAR["name"]?>" required class="max_width clear readonlyCheck" fld_esssential label="�����Ǻ�" />
		</td>
	</tr>
	<tr>
		<th>������ȣ</th>
		<td class="zipcode">
			<div>
			<input type="number" class="zonecode clear readonlyCheck" name="zonecode" id="zonecode" size="5" readonly value="<?php echo $TPL_VAR["zonecode"]?>" />
			( <input type="number" name="zipcode[]" id="zipcode0" size=3 readonly value="<?php echo $TPL_VAR["zipcode"][ 0]?>" required class="clear readonlyCheck" /> -
			<input type="number" name="zipcode[]" id="zipcode1" size=3 readonly value="<?php echo $TPL_VAR["zipcode"][ 1]?>" required class="clear readonlyCheck" /> )
			<button id="zipcode-btn" class="btn_zipcode" type="button" onclick="frmMake('<?php echo $GLOBALS["cfg"]["rootDir"]?>/proc/popup_address.php?isMobile=true&gubun=mobile','searchZipcode','',false)" <?php if($GLOBALS["sess"]){?>style="display:none;"<?php }?>>������ȣ</button>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="2">

		</td>
	</tr>
	<tr>
		<th>�ּ�</th>
		<td>
			<div><input type="text" name="address" id="address" value="<?php echo $TPL_VAR["address"]?>" readonly required class="max_width clear readonlyCheck" onFocus="search_zipcode();this.blur();" fld_esssential label="�ּ�" /></div>
		</td>
	</tr>
	<tr>
		<th>�����ּ�</th>
		<td>
			<input type="text" name="address_sub" id="address_sub" value="<?php echo $TPL_VAR["address_sub"]?>"  label="�����ּ�" class="max_width clear readonlyCheck" label="�����ּ�" onkeyup="SameAddressSub(this)" oninput="SameAddressSub(this)"/>
			<input type="hidden" name="road_address" id="road_address" style="width:100%" value="<?php echo $TPL_VAR["road_address"]?>" class="line clear">
			<div style="padding:5px 5px 0 1px;font:12px dotum;color:#999;" id="div_road_address"><?php echo $TPL_VAR["road_address"]?></div>
			<div style="padding:5px 0 0 1px;font:12px dotum;color:#999;" id="div_road_address_sub"><?php if($TPL_VAR["road_address"]){?><?php echo $TPL_VAR["address_sub"]?><?php }?></div>
		</td>
	</tr>
	<tr>
		<th>��ȭ��ȣ</th>
		<td class="phone">
			<input type="number" name="phoneReceiver[]" value="<?php echo $TPL_VAR["phone"][ 0]?>" pattern="[0-9]*" min="000" max="999" maxlength="3" class="clear readonlyCheck" /> -
			<input type="number" name="phoneReceiver[]" value="<?php echo $TPL_VAR["phone"][ 1]?>" pattern="[0-9]*" min="0000" max="9999" maxlength="4" class="clear readonlyCheck" /> -
			<input type="number" name="phoneReceiver[]" value="<?php echo $TPL_VAR["phone"][ 2]?>" pattern="[0-9]*" min="0000" max="9999" maxlength="4" class="clear readonlyCheck" />
		</td>
	</tr>
	<tr>
		<th>�޴���</th>
		<td class="phone">
			<input type="number" name="mobileReceiver[]" value="<?php echo $TPL_VAR["mobile"][ 0]?>" pattern="[0-9]*" min="000" max="999" maxlength="3" required fld_esssential label="�����Ǻ� �޴�����ȣ" class="clear readonlyCheck" /> -
			<input type="number" name="mobileReceiver[]" value="<?php echo $TPL_VAR["mobile"][ 1]?>" pattern="[0-9]*" min="0000" max="9999" maxlength="4" required fld_esssential label="�����Ǻ� �޴�����ȣ" class="clear readonlyCheck" /> -
			<input type="number" name="mobileReceiver[]" value="<?php echo $TPL_VAR["mobile"][ 2]?>" pattern="[0-9]*" min="0000" max="9999" maxlength="4" required fld_esssential label="�����Ǻ� �޴�����ȣ" class="clear readonlyCheck" />
		</td>
	</tr>
	<tr>
		<th>�޽���</th>
		<td>
			<textarea name="memo"><?php echo $TPL_VAR["memo"]?></textarea>
		</td>
	</tr>
	<tr id="delivery_check" style="display:none;">
		<th>ȸ������<br/>�ݿ�</th>
		<td>
			<input type="checkbox" name="delivery_add" id="delivery_add" value="y" /><label for="delivery_add">����� ��Ͽ� �߰�</label>
			<input type="checkbox" name="delivery_default" id="delivery_default" value="y" /><label for="delivery_default">�⺻ ������� ����</label>
		</td>
	</tr>
</table>

<div class="sub_title"><div class="point"></div>��ۼ���</div>
<table>
	<tr>
		<th>��ۼ���</th>
		<td>
			<div><input type="radio" name="deliPoli" value="0" checked onclick="getDelivery()" onblur="chk_emoney(document.frmOrder.emoney)" /> �⺻���</div>
<?php if($TPL__r_deli_1){$TPL_I1=-1;foreach($GLOBALS["r_deli"] as $TPL_V1){$TPL_I1++;?>
<?php if($TPL_V1){?>
			<div><input type="radio" name="deliPoli" value="<?php echo $TPL_I1+ 1?>" onclick="getDelivery()" onblur="chk_emoney(document.frmOrder.emoney)" /> <?php echo $TPL_V1?></div>
<?php }?>
<?php }}?>
		</td>
	</tr>
</table>

<div class="sub_title"><div class="point"></div>�����ݾ�</div>
<table>
	<tr>
		<th>�հ�ݾ�</th>
		<td>
			<span id="paper_goodsprice"><?php echo number_format($TPL_VAR["cart"]->goodsprice)?></span> ��
		</td>
	</tr>
	<tr>
		<th>��ۺ�</th>
		<td>
			<div id="paper_delivery_msg1"><span id="paper_delivery"></span> ��</div>
			<div id="paper_delivery_msg2"></div>
			<div id="paper_delivery_msg_extra" style="display:none;"></div>
		</td>
	</tr>
<?php if($TPL_VAR["cart"]->special_discount_amount){?>
	<tr>
		<th>��ǰ����</th>
		<td><span id='special_discount_amount' style="width:145;text-align:right"><?php echo number_format($TPL_VAR["cart"]->special_discount_amount)?></span> ��</td>
	</tr>
<?php }?>
<?php if($GLOBALS["sess"]){?>
	<tr>
		<th>ȸ������</th>
		<td>
			<span id='memberdc'><?php echo number_format($TPL_VAR["cart"]->dcprice)?></span> ��
		</td>
	</tr>
	<tr>
		<th>��������</th>
		<td class="coupon">
			<div class="coupon-btn-area">
				<button class="btn_coupon" type="button" onClick="removeCoupon();">�������</button>
				<button class="btn_coupon" type="button" onClick="getCoupon();">������ȸ</button>
			</div>
			<div id="coupon_list"></div>
			<div style="height:32px;">����:<input type="text" id="coupon" name="coupon" size="5" style="text-align:right" value="0" readonly> ��</div>
			<div style="height:32px;">����:<input type="text" id="coupon_emoney" name="coupon_emoney" size="5" style="text-align:right" value="0" readonly> ��</div>
			<div style="color:#436693;">
				* ���������� ������ �Ϸ���� ���� �ֹ��� ����� ������ [����������] > [�ֹ�����] > [�󼼺���] ���������� ���� ��� ��� �� �ٽ� ����Ͻ� �� �ֽ��ϴ�.
			</div>
		</td>
	</tr>
	<tr>
		<th>������</th>
		<td class="emoney">
			<input type="text" name="emoney"  size="5" style="text-align:right" value="0" onblur="chk_emoney(this);" onkeyup="calcu_settle();" onkeydown="if (event.keyCode == 13) {return false;}" <?php if($GLOBALS["set"]["emoney"]["totallimit"]>$TPL_VAR["cart"]->goodsprice){?>disabled<?php }?>> �� (���������� : <?php echo number_format($GLOBALS["member"]["emoney"])?>��)

<?php if($GLOBALS["member"]["emoney"]<$GLOBALS["set"]["emoney"]["hold"]){?>

			<div style="font-size:12px;color:#436693;margin-top:7px;">
			������������ <?php echo number_format($GLOBALS["set"]["emoney"]["hold"])?>���̻� �� ��� ����Ͻ� �� �ֽ��ϴ�.
			</div>
<?php if($GLOBALS["set"]["emoney"]["totallimit"]>$TPL_VAR["cart"]->goodsprice){?>
			<div style="font-size:12px;color:#436693;margin-top:7px;">
			<?php echo number_format($GLOBALS["set"]["emoney"]["totallimit"])?>�� �̻� �ֹ��� ������ ��� ����.
			</div>
<?php }?>


<?php }else{?>

			<div style="font-size:12px;color:#436693;margin-top:7px;">
<?php if($GLOBALS["emoney_max"]&&$GLOBALS["emoney_max"]>=$GLOBALS["set"]["emoney"]["min"]){?>
				<?php echo number_format($GLOBALS["set"]["emoney"]["min"])?>������ <span id=print_emoney_max><?php echo number_format($GLOBALS["emoney_max"])?></span>������ ����� �����մϴ�.
<?php }elseif($GLOBALS["emoney_max"]&&$GLOBALS["emoney_max"]<$GLOBALS["set"]["emoney"]["min"]){?>
				�ּ� <?php echo number_format($GLOBALS["set"]["emoney"]["min"])?>�� �̻� ����Ͽ��� �մϴ�.
<?php }elseif(!$GLOBALS["emoney_max"]){?>
				���������ݸ�ŭ ��밡���մϴ�.
<?php }?>
			</div>

<?php }?>
			<input type="hidden" name="emoney_max" value="<?php echo $GLOBALS["emoney_max"]?>">
		</td>
	</tr>
<?php }?>
<?php if($TPL_VAR["NaverMileageForm2"]){?>
	<tr>
		<td colspan="3">
		<?php echo $TPL_VAR["NaverMileageForm2"]?>

		</td>
	</tr>
<?php }?>
	<tr>
		<th>�����ݾ�</th>
		<td>
			<span id=paper_settlement style="width:146px;text-align:right; color:FF6C68;"><?php echo number_format($TPL_VAR["cart"]->totalprice-$TPL_VAR["cart"]->dcprice-$TPL_VAR["cart"]->special_discount_amount)?></span> ��
		</td>
	</tr>
</table>


<div class="sub_title"><div class="point"></div>��������</div>
<table>
	<tr>
		<th>��������</th>
		<td>
			<input type="hidden" name="escrow" value="N" />
<?php if($TPL_VAR["Payco"]){?>
			<div><label><input type=radio name=settlekind value="t" onclick="input_escrow(this,'N')" style="height:30px"/><?php echo $TPL_VAR["Payco"]?></label></div>
<?php }?>
<?php if($GLOBALS["set"]["use"]["a"]){?>
			<div><label><input type=radio name=settlekind value="a" onclick="input_escrow(this,'N')" style="height:30px"/>�������Ա�</label></div>
<?php }?>
<?php if($GLOBALS["set"]["use_mobile"]["c"]){?>
			<div><label><input type=radio name=settlekind value="c" onclick="input_escrow(this,'N')" style="height:30px"/>�ſ�ī��</label></div>
<?php }?>
<?php if($GLOBALS["set"]["use_mobile"]["v"]){?>
			<div><label><input type=radio name=settlekind value="v" onclick="input_escrow(this,'N')" style="height:30px"/>�������</label></div>
<?php }?>
<?php if($GLOBALS["set"]["use_mobile"]["h"]){?>
			<div><label><input type=radio name=settlekind value="h" onclick="input_escrow(this,'N')" style="height:30px"/>�ڵ���</label></div>
<?php }?>

<?php if($GLOBALS["escrow"]["use"]=='Y'&&$GLOBALS["cfg"]['settlePg']==$GLOBALS["escrow"]["pg"]&&$TPL_VAR["cart"]->totalprice-$TPL_VAR["cart"]->dcprice>=$GLOBALS["escrow"]["min"]){?>
<?php if($GLOBALS["escrow"]["c"]){?>
			<div><label><input type=radio name=settlekind value="c" onclick="input_escrow(this,'Y')" style="height:30px"/>����ũ�� �ſ�ī��</label></div>
<?php }?>
<?php if($GLOBALS["escrow"]["v"]){?>
			<div><label><input type=radio name=settlekind value="v" onclick="input_escrow(this,'Y')" style="height:30px"/>����ũ�� �������</label></div>
<?php }?>
<?php }?>
		</td>
	</tr>
</table>

<?php if($GLOBALS["pg_mobile"]["receipt"]=='Y'&&$GLOBALS["set"]["receipt"]["order"]=='Y'){?>
<!-- 05 ���ݿ��������� -->
<div  id="cash">
<div class="sub_title"><div class="point"></div>���ݿ���������</div>
<?php echo $this->define('tpl_include_file_2',"proc/_cashreceiptOrder.htm")?> <?php $this->print_("tpl_include_file_2",$TPL_SCP,1);?>

</div>
<?php }?>

<?php if($GLOBALS["cfg"]["orderDoubleCheck"]=='y'){?>
<div class="sub_title"><div class="point"></div>���ų���Ȯ��</div>
<table>
	<tr>
		<th>���ų���Ȯ��</th>
		<td class="noline">
			<input type="checkbox" name="doubleCheck" id="doubleCheck" value="y" required fld_esssential label="���ų���Ȯ��" msgR="���� ���뿡 �����ϼž� ������ �����մϴ�." />
			�����Ͻ� ��ǰ�� ��ǰ���� �� ������ Ȯ���Ͽ�����, �̿������մϴ�. (���ڻ�ŷ��� ��8�� ��2��)
		</td>
	</tr>
</table>
<?php }?>

<div class="m_ord">
<div class="btn_center">
	<div class="btn_pay"><button type="submit" id="payment-btn" class="btn_payment">�����ϱ�</button></div>
	<div class="btn_pre"><button type="button" id="prev-btn" class="btn_prev"  onclick="history.back();">���</button></div>
</div>
</div>

</section>

</form>

<div id=dynamic></div>

<script>
$(function () {
	$('#doubleCheck').click(function () {
            if ($('#doubleCheck').val() != undefined) {
				var msg1 = '�ؿ��ֹ� Ư���� ������ �ؿܿ� �ֹ��� �� �Ŀ��� <br>���� öȸ�� �Ұ����ϸ� ';
				var msg2 = '<span style="color:red;font-weight:bold">������ ������ (25%)</span> ';
				var msg3 = '�� <br>�����Բ� �ΰ��Ǵ� ������ �ֹ����ֽñ� �ٶ��ϴ�.<br>���� ��� ��ǰ�� ��� �պ� �ù�� �δ��Ͻø�<br> ������ ���� û��öȸ �� ��ȯ�� �����մϴ�.';
				alertBox(msg1+msg2+msg3, goUrl);
			function goUrl(){
				  //location.href = "http://www.naver.com";
			   }



                //checked
            }
            else {
                
                //not checked
            }

        });
	 //$("input[type=number]").attr("data-enhance","none");
	var alwaysReadonly = new Array("zonecode", "zipcode0", "zipcode1", "address");
	var address = "<?php echo $TPL_VAR["address"]?>" ;
	var select_delivery = 1;
<?php if($GLOBALS["sess"]){?>
	if(!address) {
		$('input:radio[name=deli_select]:input[value=3]').attr("checked", true);
		select_delivery = 3;
		ctrl_field(0);
	}
	readonlyEvent();
<?php }?>
	$("#delivery_list").change(function () {
		$('input:radio[name=deli_select]:input[value=3]').attr("checked", true);
		readonlyEvent();
		if($(this).val()) {
			$.ajax({
				url : "<?php echo $GLOBALS["cfg"]["rootDir"]?>/order/order_delivery_indb.php",
				type : "post",
				dataType: "json",
				async : false,
				data : "mode=select&sno="+$(this).val(),
				success : function(res) {
					$("input[name=nameReceiver]").val(res.name);
					$("#zipcode0").val(res.zipcode0);
					$("#zipcode1").val(res.zipcode1);
					$("#zonecode").val(res.zonecode);
					$("#address").val(res.address);
					$("#address_sub").val(res.address_sub);
					$("#road_address").val(res.road_address);
					$("#div_road_address").html(res.road_address);
					$("#div_road_address_sub").html(res.road_address ? res.address_sub : "");
					$("input[name=phoneReceiver[]]:eq(0)").val(res.phone0);
					$("input[name=phoneReceiver[]]:eq(1)").val(res.phone1);
					$("input[name=phoneReceiver[]]:eq(2)").val(res.phone2);
					$("input[name=mobileReceiver[]]:eq(0)").val(res.mobile0);
					$("input[name=mobileReceiver[]]:eq(1)").val(res.mobile1);
					$("input[name=mobileReceiver[]]:eq(2)").val(res.mobile2);
<?php if($GLOBALS["sess"]){?>
					$("#delivery_check").attr("style", "display:");
					$("#zipcode-btn").attr("style", "display:");
<?php }?>
					getDelivery();
				}
			});
		} else {
			$(".clear").each(function() {
				$(this).val("");
			});
			$("#div_road_address").html("");
			$("#div_road_address_sub").html("");
<?php if($GLOBALS["sess"]){?>
			$("#delivery_check").attr("style", "display:");
			$("#zipcode-btn").attr("style", "display:");
<?php }?>
		}
	});

	$("#delivery_add, #delivery_default").click(function() {
		var _val = $(this).is(":checked");
		if(_val) {
			$.ajax({
				url : "<?php echo $GLOBALS["cfg"]["rootDir"]?>/order/order_delivery_indb.php",
				type : "post",
				data : "mode=check",
				dataType: "html",
				success : function(res){
					if(res) {
						alert("��ϰ����� ������� ��� ����Ͽ����ϴ�.\n����� ��� ������ PC���θ����� �� �� �ֽ��ϴ�.");
						$("#delivery_add").attr("checked", false);
						$("#delivery_default").attr("checked", false);
					}
				}
			});
		}
	});

	$("input[type=number]").keypress(function (event) {
		onlyNum(event);
		if ($(this).val().length >= $(this).attr("maxlength")) return false;
	}).blur(function () {
		if ($(this).val().length >= $(this).attr("maxlength")) $(this).val($(this).val().substring(0, $(this).attr("maxlength")));
	});
});

function readonlyEvent() {
	var select_delivery = $('input:radio[name=deli_select]:checked').val();
	var alwaysReadonly = new Array("zonecode", "zipcode0", "zipcode1", "address");
	$(".readonlyCheck").each(function() {
		$(this).removeClass("dark_gray");
		if(select_delivery == 1 || select_delivery == 2) {
			$(this).addClass("dark_gray").attr("readonly", true);
		} else {
			$(this).removeClass("dark_gray");
			for(var i=0 ; i<alwaysReadonly.length ; i++) {
				if($(this).attr("id") == alwaysReadonly[i]) {
					$(this).attr("readonly", true);
					break;
				} else {
					$(this).attr("readonly", false);
				}
			}
		}
	});

}

function onlyNum(obj) {
	var ie_11 = /Trident\/(?:[7-9]|\d{2,})\..*rv:(\d+)/.exec(navigator.userAgent);

	if(ie_11 || !window.event) var _code=arguments[1].which;
	else var _code=event.keyCode;

	if ((_code<48) || (_code>57)) {
		if(ie_11 || !window.event) arguments[1].preventDefault();
		else event.returnValue=false;
	}
	else {
		return true;
	}
}

var emoney_max = <?php echo $GLOBALS["emoney_max"]?>;
function chkForm2(fm)
{
<?php if($GLOBALS["sess"]){?>
	var select_delivery = $('input:radio[name=deli_select]:checked').val();
	var pass = true;
	if(select_delivery == 1 || select_delivery == 2) {
		$(".readonlyCheck").each(function() {
			if(!$(this).val() && $(this).attr("id") != "zonecode" && $(this).attr("id") != "address_sub") {
				var ment = select_delivery == 1 ? "�⺻ ������� ��ۿ� �ʿ��� �׸� �� ���� �׸��� �ֽ��ϴ�. " : "�ֱ� ������� �����ϴ�. ";
				alert(ment+"\n�ű� ����� Ȥ�� ����� ��Ͽ��� ������� �߰��� �ּ���.");
				pass = false;
				return false;
			}
		});
	}
	if(!pass) return false;
<?php }?>

	var guestPrivateAgreement = document.getElementById("guest-private-agreement");
	var privateAgreement = jQuery(fm).find("[name=private]:checked").val();
	if (guestPrivateAgreement != null) {
		if (privateAgreement !== "y") {
			alert("��ȸ�� �������� ������ ���Ǹ� �ϼž߸� �ֹ��� �����մϴ�.");
			return false;
		}
	}

	if (typeof(fm.settlekind)=="undefined"){
		alert("���������� Ȱ��ȭ�� �� �Ǿ����ϴ�. �����ڿ��� �����ϼ���.");
		return false;
	}

	var obj = document.getElementsByName('settlekind');
	if (obj[0].getAttribute('required') == undefined){
		obj[0].setAttribute('required', '');
		obj[0].setAttribute('label', '��������');
	}
	// ���⿡�� ���� ����ó��
	var checked_count =0;
	var chks = document.getElementsByName('coupon_[]');
	for (var i=0,m=chks.length;i<m ;i++) {
		if (chks[i].checked == true) {
			checked_count ++;
		}
	}
	// ���õ� ������ �ϳ��� ���ٸ� , ���������� ���� �����ؾ� �Ѵ�.
	if (checked_count == 0) {
		removeCoupon();
	}

	return chkForm(fm);
}

function input_escrow(obj,val)
{
	obj.form.escrow.value = val;
	if (typeof(cash_required) == 'function') cash_required();
}

function ctrl_field(val)
{
	if (val == 1) copy_field();
	else if (val == 2) last_field();
	else clear_field();
}
function copy_field()
{
	var form = document.frmOrder;
	form.nameReceiver.value = form.nameOrder.value;
	form['zipcode[]'][0].value = "<?php echo $TPL_VAR["zipcode"][ 0]?>";
	form['zipcode[]'][1].value = "<?php echo $TPL_VAR["zipcode"][ 1]?>";
	form['zonecode'].value = "<?php echo $TPL_VAR["zonecode"]?>";
	form.address.value = "<?php echo $TPL_VAR["address"]?>";
	form.address_sub.value = "<?php echo $TPL_VAR["address_sub"]?>";
	form.road_address.value = "<?php echo $TPL_VAR["road_address"]?>";
	document.getElementById("div_road_address").innerHTML =  "<?php echo $TPL_VAR["road_address"]?>";
	document.getElementById("div_road_address_sub").innerHTML =  form.road_address.value ? "<?php echo $TPL_VAR["address_sub"]?>" : "";
	form['phoneReceiver[]'][0].value = form['phoneOrder[]'][0].value;
	form['phoneReceiver[]'][1].value = form['phoneOrder[]'][1].value;
	form['phoneReceiver[]'][2].value = form['phoneOrder[]'][2].value;
	form['mobileReceiver[]'][0].value = form['mobileOrder[]'][0].value;
	form['mobileReceiver[]'][1].value = form['mobileOrder[]'][1].value;
	form['mobileReceiver[]'][2].value = form['mobileOrder[]'][2].value;
	form.memo.value = "<?php echo $TPL_VAR["memo"]?>";

<?php if($GLOBALS["sess"]){?>
	document.getElementById("delivery_check").style.display="none";
	document.getElementById("zipcode-btn").style.display="none";
	document.getElementById("delivery_list").options[0].selected = "selected";
	readonlyEvent();
<?php }?>

	getDelivery();
}
function last_field() 
{
	var form = document.frmOrder;
	form.nameReceiver.value = "<?php echo $TPL_VAR["last_name"]?>";
	form['zipcode[]'][0].value = "<?php echo $TPL_VAR["last_zipcode"][ 0]?>";
	form['zipcode[]'][1].value = "<?php echo $TPL_VAR["last_zipcode"][ 1]?>";
	form.zonecode.value = "<?php echo $TPL_VAR["last_zonecode"]?>";
	form.address.value = "<?php echo $TPL_VAR["last_address"]?>";
	form.address_sub.value = "";
	form.road_address.value = "<?php echo $TPL_VAR["last_road_address"]?>";
	document.getElementById("div_road_address").innerHTML =  "<?php echo $TPL_VAR["last_road_address"]?>";
	document.getElementById("div_road_address_sub").innerHTML = "";
	form['phoneReceiver[]'][0].value = "<?php echo $TPL_VAR["last_phone"][ 0]?>";
	form['phoneReceiver[]'][1].value = "<?php echo $TPL_VAR["last_phone"][ 1]?>";
	form['phoneReceiver[]'][2].value = "<?php echo $TPL_VAR["last_phone"][ 2]?>";
	form['mobileReceiver[]'][0].value = "<?php echo $TPL_VAR["last_mobile"][ 0]?>";
	form['mobileReceiver[]'][1].value = "<?php echo $TPL_VAR["last_mobile"][ 1]?>";
	form['mobileReceiver[]'][2].value = "<?php echo $TPL_VAR["last_mobile"][ 2]?>";

<?php if($GLOBALS["sess"]){?>
	document.getElementById("delivery_check").style.display="none";
	document.getElementById("zipcode-btn").style.display="none";
	document.getElementById("delivery_list").options[0].selected = "selected";
	readonlyEvent();
<?php }?>

	getDelivery();
}
function clear_field()
{
	var form = document.frmOrder;
	form.nameReceiver.value = "";
	form['zipcode[]'][0].value = "";
	form['zipcode[]'][1].value = "";
	form['zonecode'].value = "";
	form.address.value = "";
	form.address_sub.value = "";
	form.road_address.value = "";
	document.getElementById("div_road_address").innerHTML =  "";
	document.getElementById("div_road_address_sub").innerHTML =  "";
	form['phoneReceiver[]'][0].value = "";
	form['phoneReceiver[]'][1].value = "";
	form['phoneReceiver[]'][2].value = "";
	form['mobileReceiver[]'][0].value = "";
	form['mobileReceiver[]'][1].value = "";
	form['mobileReceiver[]'][2].value = "";
	form.memo.value = "";

<?php if($GLOBALS["sess"]){?>
	document.getElementById("delivery_check").style.display="";
	document.getElementById("zipcode-btn").style.display="";
	document.getElementById("delivery_list").options[0].selected = "selected";
	readonlyEvent();
<?php }?>
}
function cutting(emoney)
{
	var chk_emoney = new String(emoney);
	reg = /(<?php echo substr($GLOBALS["set"]["emoney"]["base"], 1)?>)$/g;
	if (emoney && !chk_emoney.match(reg)){
		emoney = Math.floor(emoney/<?php echo $GLOBALS["set"]["emoney"]["base"]?>) * <?php echo $GLOBALS["set"]["emoney"]["base"]?>;
	}
	return emoney;
}
function chk_emoney(obj)
{
	if (typeof obj == 'undefined') {
		calcu_settle();
		return;
	}
	var form = document.frmOrder;
	var my_emoney = <?php echo $TPL_VAR["emoney"]+ 0?>;
	var max = '<?php echo $GLOBALS["set"]["emoney"]["max"]?>';
	var min = '<?php echo $GLOBALS["set"]["emoney"]["min"]?>';
	var hold = '<?php echo $GLOBALS["set"]["emoney"]["hold"]?>';

	var delivery	= uncomma(document.getElementById('paper_delivery').innerHTML);
	var goodsprice = uncomma(document.getElementById('paper_goodsprice').innerText);
<?php if($GLOBALS["set"]["emoney"]["emoney_use_range"]){?>
	var erangeprice = goodsprice + delivery;
<?php }else{?>
	var erangeprice = goodsprice;
<?php }?>
	var max_base = erangeprice - uncomma(_ID('memberdc').innerHTML) - uncomma(document.getElementsByName('coupon')[0].value);
	if( form.coupon ){
		 var coupon = uncomma(form.coupon.value);
	}
	max = getDcprice(max_base,max,<?php echo $GLOBALS["set"]["emoney"]["base"]?>);
	min = parseInt(min);

	if (max > max_base)  max = max_base;
	if( _ID('print_emoney_max') && _ID('print_emoney_max').innerHTML != comma(max)  )_ID('print_emoney_max').innerHTML = comma(max);

	var emoney = uncomma(obj.value);
	if (emoney>my_emoney) emoney = my_emoney;

	// ����/�̸Ӵ� �ߺ� ��� üũ
	var dup = <?php if($GLOBALS["set"]["emoney"]["useduplicate"]=='1'){?>true<?php }else{?>false<?php }?>;
	if (my_emoney > 0 && emoney > 0 && (parseInt(coupon) > 0 || parseInt(coupon_emoney)) > 0 && !dup) {
		alert('�����ݰ� ���� ����� �ߺ�������� �ʽ��ϴ�.');
		emoney = 0;
	}

	if(my_emoney > 0 && emoney > 0 && my_emoney < hold){
		alert("������������ "+ comma(hold) + "�� �̻� �� ��쿡�� ����Ͻ� �� �ֽ��ϴ�.");
		emoney = 0;
	}
	if (min && emoney > 0 && emoney < min){
		alert("�������� " + comma(min) + "�� ����  ����� �����մϴ�");
		emoney = 0;
	} else if (max && emoney > max && emoney > 0){
		if(emoney_max < min){
			alert("�ֹ� ��ǰ �ݾ��� �ּ� ��� ������ " + comma(min) + "�� ����  �۽��ϴ�.");
			emoney = 0;
		}else{
			alert("�������� " + comma(min) + "�� ���� " + comma(max) + "�� ������ ����� �����մϴ�");
			emoney = max;
		}
	}

	obj.value = comma(cutting(emoney));
	calcu_settle();
}

function calcu_settle()
{
	var dc=0;
	var special_discount_amount = 0;
	var coupon = settleprice = 0;
	var goodsprice	= uncomma(document.getElementById('paper_goodsprice').innerHTML);
	var delivery	= uncomma(document.getElementById('paper_delivery').innerHTML);
	if(_ID('memberdc')) dc = uncomma(_ID('memberdc').innerHTML);
	if(_ID('special_discount_amount')) special_discount_amount = uncomma(_ID('special_discount_amount').innerHTML);
	var emoney = (document.frmOrder.emoney) ? uncomma(document.frmOrder.emoney.value) : 0;
	if (document.frmOrder.coupon){
		coupon = uncomma(document.frmOrder.coupon.value);
		if (goodsprice + delivery - dc - coupon - emoney < 0){
<?php if($GLOBALS["set"]["emoney"]["emoney_use_range"]){?>
			emoney = goodsprice + delivery - dc - coupon - special_discount_amount;
<?php }else{?>
			emoney = goodsprice - dc - coupon - special_discount_amount;
<?php }?>
			document.frmOrder.emoney.value = comma(cutting(emoney));
		}
		dc += coupon + emoney;
	}
	var settlement = (goodsprice + delivery - dc - special_discount_amount);
	<?php echo $TPL_VAR["NaverMileageCalc"]?>

	document.getElementById('paper_settlement').innerHTML = comma(settlement);
}

function getDelivery(){
	var form = document.frmOrder;
	var obj = form.deliPoli;
	var coupon = 0;
	var emoney = 0;

	var deliPoli = 0;
	for(var i=0;i<obj.length;i++){
		if(obj[i].checked){
			deliPoli = i;
		}
	}
	if( form.coupon ) coupon = form.coupon.value;
	if( form.emoney ) emoney = form.emoney.value;
	var zipcode = form['zipcode[]'][0].value + '-' + form['zipcode[]'][1].value;
	var mode = 'order';
	var road_address = form.road_address.value;
	var address = form.address.value;
	var address_sub = form.address_sub.value;

	$.ajax({
		url : '<?php echo $GLOBALS["cfg"]["rootDir"]?>/proc/getdelivery.php',
		type : 'get',
		async : false,
		data : "zipcode="+zipcode+"&deliPoli="+deliPoli+"&coupon="+coupon+"&emoney="+emoney+"&mode="+mode+"&road_address="+road_address+"&address="+address+"&address_sub="+address_sub,
		success : function(res) {
			eval(res);
		}
	});
}


function getCoupon(){

	$('#coupon_list').show();
	$.ajax({
		url : '../proc/coupon_list.php',
		dataType : 'html',
		success : function(result){

			$('#coupon_list').html(result);
		},
		error: function(){
			alert('error');

		}
	});
}

function removeCoupon(){

	$('#coupon_list').html('');
	var apply_coupon = document.getElementById('apply_coupon');
	apply_coupon.innerHTML = '';
	if (typeof document.frmOrder.coupon != 'undefined') document.frmOrder.coupon.value = '0';
	if (typeof document.frmOrder.coupon_emoney != 'undefined') document.frmOrder.coupon_emoney.value = '0';
	chk_emoney(document.frmOrder.emoney);
	getDelivery();
	calcu_settle();
}

/*** �������� ù��° ��ü �ڵ� ���� ***/
window.onload = function (){
	var obj = document.getElementsByName('settlekind');
	for (var i = 0; i < obj.length; i++){
		if (obj[i].checked != true) continue;
		obj[i].onclick();
		var idx = i;
		break;
	}
	if (obj[0] && idx == null){ obj[0].checked = true; obj[0].onclick(); }

	getDelivery();
	$(".m_rightlongtext").css("width", (document.body.clientWidth-70-20-14)+"px");
}


</script>

<?php $this->print_("footer",$TPL_SCP,1);?>