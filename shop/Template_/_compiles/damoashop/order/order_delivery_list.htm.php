<?php /* Template_ 2.2.7 2016/07/13 18:24:57 /www/jbsinttr8192_godo_co_kr/shop/data/skin/damoashop/order/order_delivery_list.htm 000007725 */ 
if (is_array($TPL_VAR["list"])) $TPL_list_1=count($TPL_VAR["list"]); else if (is_object($TPL_VAR["list"]) && in_array("Countable", class_implements($TPL_VAR["list"]))) $TPL_list_1=$TPL_VAR["list"]->count();else $TPL_list_1=0;?>
<form name="form" method="post" action="<?php echo url("order/order_delivery_indb.php")?>&">
<input type="hidden" name="mode" value="<?php echo $TPL_VAR["mode"]?>" />
<input type="hidden" name="pkind" value="<?php echo $TPL_VAR["pkind"]?>" />
<div class="delivery_div">
	<div id="deliveryList" class="delivery_list">
		<div class="dtitle_popup">
			<span class="dtitle_list">����� ���</span>
			<span class="dtitle_close"><a href="javascript:self.close()"><img src="/shop/data/skin/damoashop/img/common/btn_delivery_closed.png" title="�ݱ�" alt="�ݱ�" /></a></span>
		</div>
		<div class="dcontents">
			<div class="contents_left">
				����� ���ϴ� �ּҸ� �����Ͻø� �ֹ����� �ڵ� �Էµ˴ϴ�.<br />
				������� <span class="bold">�ִ� 10��</span>���� ����� �����մϴ�.
			</div>
			<div class="btn_right">
				<a href="javascript:deli_add();" /><img src="/shop/data/skin/damoashop/img/common/btn_delivery_add.png" title="����� �߰�" /></a>
			</div>
		</div>
		<div class="d_list">
			<table cellpadding="0" cellspacing="0">
				<colgroup><col width="7%"><col width="20%"><col width="*"><col width="20%"><col width="15%"></colgroup>
				<tr>
					<th>����</th>
					<th>�������/<br />�����Ǻ�</th>
					<th>�����ǰ�</th>
					<th>����ó</th>
					<th>����/����</th>
				</tr>
<?php if(count($TPL_VAR["list"])== 0){?>
				<tr>
					<td colspan="5">�����Ͱ� �����ϴ�.</td>
				</tr>
<?php }else{?>
<?php if($TPL_list_1){foreach($TPL_VAR["list"] as $TPL_V1){?>
				<tr>
					<td>
						<a href="javascript:deli_select(<?php echo $TPL_V1["gmd_sno"]?>);"><img src="/shop/data/skin/damoashop/img/common/btn_delivery_select.png" alt="����" title="����" /></a>
						<input type="hidden" id="value_<?php echo $TPL_V1["gmd_sno"]?>" dsno="<?php echo $TPL_V1["gmd_sno"]?>" dtitle="<?php echo $TPL_V1["gmd_title"]?>" dname="<?php echo $TPL_V1["gmd_name"]?>" dzonecode="<?php echo $TPL_V1["gmd_zonecode"]?>" dzipcode="<?php echo $TPL_V1["gmd_zipcode"]?>" droad_address="<?php echo $TPL_V1["gmd_road_address"]?>" daddress="<?php echo $TPL_V1["gmd_address"]?>" daddress_sub="<?php echo $TPL_V1["gmd_address_sub"]?>" dphone="<?php echo $TPL_V1["gmd_phone"]?>" dmobile="<?php echo $TPL_V1["gmd_mobile"]?>" />
					</td>
					<td><a href="javascript:deli_select(<?php echo $TPL_V1["gmd_sno"]?>);"><?php echo $TPL_V1["gmd_title"]?><br /><?php echo $TPL_V1["gmd_name"]?></a></td>
					<td style="text-align:left;">
						<a href="javascript:deli_select(<?php echo $TPL_V1["gmd_sno"]?>);">
							<?php echo $TPL_V1["gmd_zonecode"]?> (<?php echo $TPL_V1["gmd_zipcode"]?>)
<?php if($TPL_V1["gmd_default"]=='y'){?><span class="delivery_default">�⺻�����</span><?php }?><br />
<?php if($TPL_V1["gmd_road_address"]){?>
							<?php echo $TPL_V1["gmd_road_address"]?>

<?php }else{?>
							<?php echo $TPL_V1["gmd_address"]?>

<?php }?>
							<br /><?php echo $TPL_V1["gmd_address_sub"]?>

						</a>
					</td>
					<td>
						<a href="javascript:deli_select(<?php echo $TPL_V1["gmd_sno"]?>);"><?php echo $TPL_V1["gmd_mobile"]?><br /><?php echo $TPL_V1["gmd_phone"]?></a>
					</td>
					<td>
						<a href="javascript:deli_edit(<?php echo $TPL_V1["gmd_sno"]?>);"><img src="/shop/data/skin/damoashop/img/common/btn_delivery_edit.png" alt="����" title="����" /></a>
						<a href="javascript:deli_delete(<?php echo $TPL_V1["gmd_sno"]?>);"><img src="/shop/data/skin/damoashop/img/common/btn_delivery_delete.png" alt="����" title="����" /></a>
					</td>
				</tr>
<?php }}?>
<?php }?>
			</table>
			<div class="btn_div">
				<a href="javascript:self.close();"><img src="/shop/data/skin/damoashop/img/common/btn_delivery_close.png" alt="�ݱ�" title="�ݱ�" /></a>
			</div>
		</div>
	</div>
</div>
</form>
<script type="text/javascript">
	var mode = "<?php echo $TPL_VAR["mode"]?>";
	var pkind = "<?php echo $TPL_VAR["pkind"]?>";

	function deli_add() {
		location.href="<?php echo url("order/order_delivery.php?")?>&mode=form"+(pkind ? "&pkind="+pkind : "");
	}

	function deli_edit(sno) {
		location.href="<?php echo url("order/order_delivery.php?")?>&mode=form&sno="+sno+(pkind ? "&pkind="+pkind : "");
	}

	function deli_delete(sno) {
		location.href="<?php echo url("order/order_delivery_indb.php?")?>&mode=delete&sno="+sno+(pkind ? "&pkind="+pkind : "");
	}

	function deli_list() {
		location.href="<?php echo url("order/order_delivery.php?")?>&mode=list"+(pkind ? "&pkind="+pkind : "");
	}

	function deli_select(sno) {
		var _val = document.getElementById("value_"+sno);
		var a_zipcode = _val.getAttribute("dzipcode").split("-");
		var a_phone = _val.getAttribute("dphone").split("-");
		var a_mobile = _val.getAttribute("dmobile").split("-");
		var alwaysReadonly = new Array("zonecode", "zipcode0", "zipcode1", "address");

		if(opener && !opener.closed){
			opener.document.getElementsByName("nameReceiver")[0].value = _val.getAttribute("dname");
			opener.document.getElementById("zonecode").value = _val.getAttribute("dzonecode");
			opener.document.getElementById("zipcode0").value = a_zipcode[0];
			opener.document.getElementById("zipcode1").value = a_zipcode[1];
			opener.document.getElementById("road_address").value = _val.getAttribute("droad_address");
			opener.document.getElementById("div_road_address").innerHTML = _val.getAttribute("droad_address");
			opener.document.getElementById("address").value = _val.getAttribute("daddress");
			opener.document.getElementById("address_sub").value = _val.getAttribute("daddress_sub");
			opener.document.getElementById("div_road_address_sub").style.display = _val.getAttribute("droad_address") ? "block" : "";
			opener.document.getElementById("div_road_address_sub").innerHTML = _val.getAttribute("droad_address") ? _val.getAttribute("daddress_sub") : "";
			opener.document.getElementsByName("phoneReceiver[]")[0].value =  a_phone[0];
			opener.document.getElementsByName("phoneReceiver[]")[1].value =  a_phone[1];
			opener.document.getElementsByName("phoneReceiver[]")[2].value =  a_phone[2];
			opener.document.getElementsByName("mobileReceiver[]")[0].value =  a_mobile[0];
			opener.document.getElementsByName("mobileReceiver[]")[1].value =  a_mobile[1];
			opener.document.getElementsByName("mobileReceiver[]")[2].value =  a_mobile[2];
			opener.document.getElementById("deli_select3").checked = true;
			opener.document.getElementById("addressSearch").style.display="";
			opener.document.getElementById("delivery_check").style.display="";
			opener.document.getElementById("delivery_add").checked=false;
			opener.document.getElementById("delivery_default").checked=false;

			for (var i=0;i<opener.document.frmOrder.elements.length;i++) {
				chkEl = opener.document.frmOrder.elements[i];
				if (chkEl.getAttribute("readonlyCheck") != null) {
					var org_class = chkEl.className.replace("dark_gray", "");
					chkEl.className = "";
					chkEl.className = org_class+chkEl.className.replace("dark_gray", "");
					for(var j=0 ; j<alwaysReadonly.length ; j++) {
						if(chkEl.id == alwaysReadonly[j]) {
							chkEl.readOnly = true;
							break;
						} else {
							chkEl.readOnly = false;
						}
					}
				}
			}
			opener.getDelivery();
		} else {
			alert("�ֹ��� ��ҵǾ� ������� ������ �� �����ϴ�.");
		}
		self.close();
	}
</script>