<?php /* Template_ 2.2.7 2016/06/20 11:14:29 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/myp/orderview.htm 000011273 */ 
if (is_array($TPL_VAR["item"])) $TPL_item_1=count($TPL_VAR["item"]); else if (is_object($TPL_VAR["item"]) && in_array("Countable", class_implements($TPL_VAR["item"]))) $TPL_item_1=$TPL_VAR["item"]->count();else $TPL_item_1=0;?>
<?php $this->print_("header",$TPL_SCP,1);?>


<?php  $TPL_VAR["page_title"] = "�ֹ����� ��";?>
<?php $this->print_("sub_header",$TPL_SCP,1);?>

<style type="text/css">
section#orderview { background:#FFFFFF; padding:12px;}
section#orderview ul{list-style:none;}
section#orderview .btn_area { text-align:center; }
section#orderview .btn_recoupon { margin:0 auto; margin-top:10px; width:80px; height:27px; line-height:27px; font-size:12px; color:#FFFFFF; font-weight:normal;text-align:center; background:#808591; font-family:dotum; border-radius:3px; }
section#orderview .track_btn_area { text-align:right; }
section#orderview .btn_track_area { width:120px; height:auto;}
section#orderview .btn_track { width:120px; height:auto;}
section#orderview .btn_review { width:120px; height:auto;}
section#orderview .inblock { display:inline-block; }
</style>
<script type="text/javascript">
	$(function () {
		$("#couponCancel").bind("click", function () {
			if(confirm("���� ��볻���� ����ϰ� �̻�� ���·� �����Ͻðڽ��ϱ�?")) {
				$("input[name=mode]").val("recoverCoupon");
				$("#frm").submit();
			}
		});
	});
</script>
<section id="orderview" class="content">
	<form name="frm" id="frm" method="post" action="indb.php">
	<input type="hidden" name="mode" />
	<input type="hidden" name="ordno" value="<?php echo $TPL_VAR["ordno"]?>" />
	<div class="item_list">
		<h4 class="hidden">�ֹ���ǰ</h4>
		<ul>
<?php if($TPL_item_1){foreach($TPL_VAR["item"] as $TPL_V1){?>
			<li>
				<dl>
					<dt class="hidden">��ǰ�̹���</dt>
					<dd class="oil_img"><a href="../goods/view.php?goodsno=<?php echo $TPL_V1["goodsno"]?>"><?php echo goodsimgMobile(array($TPL_V1["img_mobile"],$TPL_V1["img_i"],$TPL_V1["img_s"],$TPL_V1["img_m"]),"60,60")?></a></dd>
					<dt class="hidden">��ǰ��</dt>
					<dd class="oil_name"><a href="../goods/view.php?goodsno=<?php echo $TPL_V1["goodsno"]?>"><?php echo strcut($TPL_V1["goodsnm"], 100)?></a></dd>
					<dt class="hidden">�ɼ�</dt>
					<dd class="oil_option">
<?php if($TPL_V1["opt1"]){?><div>[<?php echo $TPL_V1["opt1"]?><?php if($TPL_V1["opt2"]){?>/<?php echo $TPL_V1["opt2"]?><?php }?>]</div><?php }?>
<?php if($TPL_V1["addopt"]){?><div>[<?php echo str_replace("^","] [",$TPL_V1["addopt"])?>]</div><?php }?>
					</dd>
					<dt class="oil_price_title blt">�ǸŰ� : </dt>
					<dd class="oil_price"><?php echo number_format($TPL_V1["price"])?>��</dd>
					<dt class="oil_ea_title blt">���� : </dt>
					<dd class="oil_ea"><?php echo $TPL_V1["ea"]?>��</dd>
					<dt class="oil_dstep_title blt">��ۻ��� : </dt>
					<dd class="oil_dstep"><?php echo $GLOBALS["r_istep"][$TPL_V1["istep"]]?></dd>
					<div class="btn_area track_btn_area">
<?php if($GLOBALS["set"]["delivery"]["basis"]&&$TPL_V1["dvcode"]){?>
							<div class="btn_track_area inblock">
								<img src="/shop/data/skin_mobileV2/light/common/img/myp/06_btn_01.png" class="btn_track" href="javascript:" onclick="frmMake('<?php echo $GLOBALS["cfg"]["rootDir"]?>/mypage/mypage_delivery.php?item_sno=<?php echo $TPL_V1["sno"]?>','frmDelivery','�����ȸ',false)">
							</div>
<?php }elseif(!$GLOBALS["set"]["delivery"]["basis"]&&$TPL_VAR["deliverycode"]){?>
							<div class="btn_track_area inblock">
								<img src="/shop/data/skin_mobileV2/light/common/img/myp/06_btn_01.png" class="btn_track" href="javascript:" onclick="frmMake('<?php echo $GLOBALS["cfg"]["rootDir"]?>/mypage/mypage_delivery.php?ordno=<?php echo $TPL_V1["ordno"]?>','frmDelivery','�����ȸ',false)">
							</div>
<?php }?>
						<div class="btn_track_area inblock" >
							<img src="/shop/data/skin_mobileV2/light/common/img/myp/06_btn_02.png" class="btn_review" href="javascript:" onclick="window.location.href='review_register.php?mode=add_review&goodsno=<?php echo $TPL_V1["goodsno"]?>&ordsno=<?php echo $TPL_V1["sno"]?>&ordno=<?php echo $TPL_V1["ordno"]?>'">
						</div>
					</div>
				</dl>
			</li>
<?php }}?>
		</ul>
	</div>
	<div class="btn_area">
<?php if($GLOBALS["cfg"]["reOrder"]=='y'){?>
		<div class="btn_reorder inblock" onclick="window.location.href='settle.php?ordno=<?php echo $TPL_VAR["ordno"]?>'">���ֹ�</div>
<?php }?>
<?php if($TPL_VAR["step2"]>= 50&&$GLOBALS["cfg"]["RecoverCoupon"]=='y'&&$TPL_VAR["recovery_coupon"]=='n'){?>
		<div class="btn_recoupon inblock" id="couponCancel">����������</div>
<?php }?>
	</div>

	<div class="info">
		<!-- 01 �ֹ������� -->
		<h4>�ֹ�������</h4>
		<table>
		<tr>
			<th>�ֹ��ڸ�</th>		<td><?php echo $TPL_VAR["nameOrder"]?></td>
		</tr>
		<tr>
			<th>�ֹ��� ��ȭ</th>	<td><?php echo $TPL_VAR["phoneOrder"]?></td>
		</tr>
		<tr>
			<th>�ֹ��� �ڵ���</th>	<td><?php echo $TPL_VAR["mobileOrder"]?></td>
		</tr>
		<tr>
			<th>�̸���</th>			<td><?php echo $TPL_VAR["email"]?></td>
		</tr>
		</table>

		<!-- 02 ������� -->
		<h4>�������</h4>
		<table>
		<tr>
			<th>�޴��ڸ�</th>		<td><?php echo $TPL_VAR["nameReceiver"]?></td>
		</tr>
		<tr>
			<th>�޴��� ��ȭ</th>	<td><?php echo $TPL_VAR["phoneReceiver"]?></td>
		</tr>
		<tr>
			<th>�޴��� �ڵ���</th>	<td><?php echo $TPL_VAR["mobileReceiver"]?></td>
		</tr>
		<tr>
			<th>�����ȣ</th>		<td><?php echo $TPL_VAR["zonecode"]?> (<?php echo $TPL_VAR["zipcode"]?>)</td>
		</tr>
		<tr>
			<th>�ּ�</th>			<td><?php echo $TPL_VAR["address"]?> <?php echo $TPL_VAR["address_sub"]?><div style="padding-top:5px;font:12px dotum;color:#999;"><?php echo $TPL_VAR["road_address"]?> <?php echo $TPL_VAR["address_sub"]?></div></td>
		</tr>
<?php if($TPL_VAR["memo"]){?>
		<tr>
			<th>��۸޼���</th>		<td><?php echo $TPL_VAR["memo"]?></td>
		</tr>
<?php }?>
<?php if($TPL_VAR["deliverycode"]){?>
		<tr>
			<th>�����ȣ</th>		<td><?php echo $TPL_VAR["deliverycomp"]?> <?php echo $TPL_VAR["deliverycode"]?></td>
		</tr>
<?php }?>
		</table>

		<!-- 03 �����ݾ� -->
		<h4>�����ݾ�</h4>
		<table>
		<tr>
			<th>���ֹ��ݾ�</th>
			<td><span id="paper_goodsprice"><?php echo number_format($TPL_VAR["goodsprice"])?></span>�� <?php if($TPL_VAR["diffPrice"]){?><font color=red></span>(��ǰ�����ݾ� <?php echo number_format($TPL_VAR["diffPrice"])?>��)</font><?php }?></td>
		</tr>
		<tr>
			<th>ȸ������</th>
				<td>- <span id="paper_memberdc"><?php echo number_format($TPL_VAR["memberdc"])?></span>��</td>
		</tr>
		<tr>
			<th>��ǰ����</th>
			<td>- <?php echo number_format($TPL_VAR["goodsDc"])?>��</td>
		</tr>
		<tr>
			<th>��������</th>
				<td>- <span id="paper_coupon"><?php echo number_format($TPL_VAR["coupon"])?></span>��</td>
		</tr>
		<tr>
			<th>������ ���</th>
				<td>- <span id="paper_emoney"><?php echo number_format($GLOBALS["data"]["emoney"])?></span>��</td>
		</tr>
<?php if($TPL_VAR["enuri"]){?>
		<tr>
			<th>������</th>
			<td><?php echo number_format($TPL_VAR["enuri"]* - 1)?>��</td>
		</tr>
<?php }?>
		<?php echo $TPL_VAR["NaverMileageAmount"]?>

<?php if($TPL_VAR["eggFee"]){?>
		<tr>
			<th>�������� ������</th>
			<td><span id="paper_eggfee"><?php echo number_format($TPL_VAR["eggFee"])?></span>��</td>
		</tr>
<?php }?>
		<tr>
			<th>��ۺ�</th>
			<td>
				<div id="paper_delivery_msg1" <?php if($TPL_VAR["deli_msg"]){?>style="display:none"<?php }?>><span id="paper_delivery"><?php echo number_format($TPL_VAR["delivery"])?></span>��</div>
				<div id="paper_delivery_msg2" style="float:left;margin:0;" <?php if(!$TPL_VAR["deli_msg"]){?>style="display:none"<?php }?>><?php echo $TPL_VAR["deli_msg"]?></div>
			</td>
		</tr>
		<tr>
			<th>�����ݾ�</th>
			<td><b><span id="paper_settlement"><?php echo number_format($TPL_VAR["prn_settleprice"])?></span>��</b> <?php if($GLOBALS["prnSettleEtcMsg"]){?><?php echo $GLOBALS["prnSettleEtcMsg"]?><?php }?></td>
		</tr>
<?php if($TPL_VAR["canceled_price"]){?>
		<tr>
			<th>��ҿϷ�ݾ�</th>
			<td><?php echo number_format($TPL_VAR["canceled_price"]* - 1)?>��</td>
		</tr>
<?php }?>
<?php if($TPL_VAR["canceling_price"]){?>
		<tr>
			<th>��������ݾ�</th>
			<td><?php echo number_format($TPL_VAR["canceling_price"])?>��</td>
		</tr>
<?php }?>
<?php if($TPL_VAR["canceling_RealPrnSettlePrice"]){?>
		<tr>
			<th>��ҽð����ݾ�</th>
			<td><?php echo number_format($TPL_VAR["canceling_RealPrnSettlePrice"])?>��</td>
		</tr>
<?php }?>
		</table>

		<!-- 04 �������� -->
		<h4>��������</h4>
		<table>
<?php if($TPL_VAR["settlekind"]=="a"){?>
		<tr>
			<th>�Ա�����</th>
			<td><?php echo $TPL_VAR["bank"]?></td>
		</tr>
		<tr>
			<th>�Աݰ���</th>
			<td><?php echo $TPL_VAR["account"]?></td>
		</tr>
		<tr>
			<th>�����ָ�</th>
			<td><?php echo $TPL_VAR["name"]?></td>
		</tr>
		<tr>
			<th>�Ա��ڸ�</th>
			<td><?php echo $TPL_VAR["bankSender"]?></td>
		</tr>
<?php }elseif($TPL_VAR["settlekind"]=="c"){?>
		<tr>
			<th>�������</th>
			<td>�ſ�ī��</td>
		</tr>
<?php }elseif($TPL_VAR["settlekind"]=="o"){?>
		<tr>
			<th>�������</th>
			<td>������ü</td>
		</tr>
<?php }elseif($TPL_VAR["settlekind"]=="v"){?>
		<tr>
			<th>�������</th>
			<td><?php echo $TPL_VAR["vAccount"]?></td>
		</tr>
<?php }elseif($TPL_VAR["settlekind"]=="p"){?>
		<tr>
			<th>�������</th>
			<td>����Ʈ����</td>
		</tr>
<?php }elseif($TPL_VAR["settlekind"]=="e"){?>
		<tr>
			<th>�������</th>
			<td>������ ����Ʈ</td>
		</tr>
<?php }elseif($TPL_VAR["settlekind"]=="h"){?>
		<tr>
			<th>�������</th>
			<td>�ڵ���</td>
		</tr>
<?php }elseif($TPL_VAR["settlekind"]=="d"){?>
		<tr>
			<th>�������</th>
			<td>�������� ���� (������ ���)</td>
		</tr>
<?php if($TPL_VAR["memberdc"]){?>
		<tr>
			<th>ȸ������</th>
			<td id="memberdc"><?php echo number_format($TPL_VAR["memberdc"])?>��</td>
		</tr>
<?php }?>
<?php if($TPL_VAR["coupon"]){?>
		<tr>
			<th>��������</th>
			<td><?php echo number_format($TPL_VAR["coupon"])?>��</td>
		</tr>
<?php }?>
		<tr>
			<th>�����ݰ���</th>
			<td><b><?php echo number_format($TPL_VAR["emoney"])?>��</b></td>
		</tr>
<?php }?>
<?php if($TPL_VAR["step"]== 0&&$TPL_VAR["step2"]== 54&&in_array($TPL_VAR["settlekind"],array('c','o','v'))&&$TPL_VAR["pgfailreason"]){?><!-- �������л��� -->
		<tr>
			<th>�������л���</th>
			<td><?php echo $TPL_VAR["pgfailreason"]?></td>
		</tr>
<?php }?>
<?php if($TPL_VAR["eggyn"]=='y'){?>
		<tr>
			<th>���ں�������</th>
			<td><a href="javascript:popupEgg('<?php echo $GLOBALS["egg"]["usafeid"]?>', '<?php echo $TPL_VAR["ordno"]?>')"><font color=#0074BA><b><u><?php echo $TPL_VAR["eggno"]?> <font class=small>(���������)</a></td>
		</tr>
<?php }elseif($GLOBALS["egg"]["use"]=='N'&&$TPL_VAR["eggyn"]=='f'){?>
		<tr>
			<th>���ں�������</th>
			<td>������ �߱� ����.</td>
		</tr>
<?php }elseif($GLOBALS["egg"]["use"]=='Y'&&$TPL_VAR["eggyn"]=='f'){?>
		<tr>
			<th>���ں�������</th>
			<td>������ �߱� ����. ��߱� ��������.</td>
		</tr>
<?php }?>
		</table>

	</div>
	</form>
</section>
<?php $this->print_("footer",$TPL_SCP,1);?>