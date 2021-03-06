<?php /* Template_ 2.2.7 2016/06/20 12:06:45 /www/jbsinttr8192_godo_co_kr/shop/data/skin/damoashop/mypage/mydelivery_form.htm 000006534 */ ?>
<form  name="form" method="post" action="<?php echo url("mypage/mydelivery_indb.php")?>&">
<input type="hidden" name="mode" value="<?php echo $TPL_VAR["mode"]?>" />
<input type="hidden" name="pkind" value="<?php echo $TPL_VAR["pkind"]?>" />
<div class="delivery_div">
	<div id="deliveryForm" class="delivery_form">
		<input type="hidden" name="sno" id="sno" value="<?php echo $TPL_VAR["gmd_sno"]?>" />
		<div class="dtitle"><img src="/shop/data/skin/damoashop/img/common/title_address.png" title="나의 배송지 관리" /></div>
		<div class="path mydtit">HOME &gt; 마이페이지 &gt; <span class="bold">나의 배송지 관리</span></div>
		<div class="dcontents_popup">배송지를 입력해주세요.</div>
		<div class="right">
			<input type="checkbox" name="gmd_default" id="gmd_default" value="y" class="vmiddle" <?php if($TPL_VAR["gmd_default"]){?>checked<?php }?> /><label for="gmd_default">기본 배송지로 설정합니다.</label>
		</div>
		<div class="d_form">
			<table cellpadding="0" cellspacing="0">
				<colgroup><col width="20%"><col width="*"></colgroup>
				<tr>
					<th>배송지명</th>
					<td><input type="text" name="delivery_name" value="<?php echo $TPL_VAR["gmd_title"]?>" class="text w300" /></td>
				</tr>
				<tr>
					<th><span class="red">* </span>받으실분</th>
					<td><input type="text" name="delivery_receiver" value="<?php echo $TPL_VAR["gmd_name"]?>" class="text w300" /></td>
				</tr>
				<tr>
					<th rowspan="3"><span class="red">* </span>받으실곳</th>
					<td style="border:none;height:30px;padding-top:10px;">
					<input type="text" name="zonecode" id="zonecode" size="5" class="text vmiddle" readonly value="<?php echo $TPL_VAR["gmd_zonecode"]?>" />
					( <input type="text" name="zipcode[]" id="zipcode0" size="3" class="text vmiddle" readonly value="<?php echo $TPL_VAR["zipcode"][ 0]?>" /> -
					<input type="text" name="zipcode[]" id="zipcode1" size="3" class="text vmiddle" readonly value="<?php echo $TPL_VAR["zipcode"][ 1]?>" /> )
					<a href="javascript:popup('../proc/popup_address.php',500,432)"><img src="/shop/data/skin/damoashop/img/common/btn_delivery_search.png" class="vmiddle"></a>
					</td>
				</tr>
				<tr>
					<td style="border:none;height:30px;padding-top:10px;">
						<input type="text" name="address" id="address" class="text w300" readonly value="<?php echo $TPL_VAR["gmd_address"]?>">
					</td>
				</tr>
				<tr>
					<td>
						<input type="text" name="address_sub" id="address_sub" class="text w300" value="<?php echo $TPL_VAR["gmd_address_sub"]?>" onkeyup="SameAddressSub(this)" oninput="SameAddressSub(this)" />
						<input type="hidden" name="road_address" id="road_address" style="width:100%" value="<?php echo $TPL_VAR["gmd_road_address"]?>" class="text" />
						<div style="padding:5px 5px 0 1px;font:12px dotum;color:#999;" id="div_road_address"><?php echo $TPL_VAR["gmd_road_address"]?></div>
						<div style="padding:5px 0 0 1px;font:12px dotum;color:#999;" id="div_road_address_sub"><?php if($TPL_VAR["gmd_road_address"]){?><?php echo $TPL_VAR["gmd_address_sub"]?><?php }?></div>
					</td>
				</tr>
				<tr>
					<th><span class="red">* </span>전화번호</th>
					<td>
						<input type="text" name="phoneReceiver[]" value="<?php echo $TPL_VAR["phone"][ 0]?>" maxlength="3" option="regNum" class="w80 text vmiddle" label="수령자 전화번호" /> -
						<input type="text" name="phoneReceiver[]" value="<?php echo $TPL_VAR["phone"][ 1]?>" maxlength="4" option="regNum" class="w80 text vmiddle" label="수령자 전화번호" /> -
						<input type="text" name="phoneReceiver[]" value="<?php echo $TPL_VAR["phone"][ 2]?>" maxlength="4" option="regNum" class="w80 text vmiddle" label="수령자 전화번호" />
					</td>
				</tr>
				<tr>
					<th><span class="red">* </span>휴대폰번호</th>
					<td>
						<input type="text" name="mobileReceiver[]" value="<?php echo $TPL_VAR["mobile"][ 0]?>" maxlength="3" option="regNum" class="w80 text vmiddle" label="수령자 핸드폰번호" /> -
						<input type="text" name="mobileReceiver[]" value="<?php echo $TPL_VAR["mobile"][ 1]?>" maxlength="4" option="regNum" class="w80 text vmiddle" label="수령자 핸드폰번호" /> -
						<input type="text" name="mobileReceiver[]" value="<?php echo $TPL_VAR["mobile"][ 2]?>" maxlength="4" option="regNum" class="w80 text vmiddle" label="수령자 핸드폰번호" />
					</td>
				</tr>
			</table>
			<div class="btn_div">
				<a href="javascript:deli_save();"><img src="/shop/data/skin/damoashop/img/common/btn_delivery_save.png" alt="저장" title="저장" /></a>&nbsp;
				<a href="javascript:deli_list();"><img src="/shop/data/skin/damoashop/img/common/btn_delivery_list2.png" alt="목록" title="목록" /></a>
			</div>
		</div>

	</div>
</div>
</form>
<script type="text/javascript">
	var mode = "<?php echo $TPL_VAR["mode"]?>";
	var pkind = "<?php echo $TPL_VAR["pkind"]?>";

	function deli_list() {
		location.href="<?php echo url("mypage/mydelivery_indb.php?")?>&mode=list"+(pkind ? "&pkind="+pkind : "");
	}

	function deli_save() {
		var frm = document.form;
		if(!frm.delivery_receiver.value.trim()) {
			alert("받으실 분을 입력해주세요.");
			frm.delivery_receiver.focus();
		} else if(!frm["zipcode[]"][0].value) {
			alert("주소를 입력해주세요.");
			frm["zipcode[]"][0].focus();
		} else if(!frm["phoneReceiver[]"][0].value.trim()) {
			alert("전화번호를 입력해주세요.");
			frm["phoneReceiver[]"][0].focus();
		} else if(!frm["phoneReceiver[]"][1].value.trim()) {
			alert("전화번호를 입력해주세요.");
			frm["phoneReceiver[]"][1].focus();
		} else if(!frm["phoneReceiver[]"][2].value.trim()) {
			alert("전화번호를 입력해주세요.");
			frm["phoneReceiver[]"][2].focus();
		} else if(!frm["mobileReceiver[]"][0].value.trim()) {
			alert("휴대폰번호를 입력해주세요.");
			frm["mobileReceiver[]"][0].focus();
		} else if(!frm["mobileReceiver[]"][1].value.trim()) {
			alert("휴대폰번호를 입력해주세요.");
			frm["mobileReceiver[]"][1].focus();
		} else if(!frm["mobileReceiver[]"][2].value.trim()) {
			alert("휴대폰번호를 입력해주세요.");
			frm["mobileReceiver[]"][2].focus();
		} else {
			var valiCheck = chkForm(frm);
			if(valiCheck) {
				frm.delivery_name.value = !frm.delivery_name.value ? frm.delivery_receiver.value : frm.delivery_name.value;
				frm.mode.value = !frm.sno.value ? "add" : "edit";
				frm.submit();
			}
		}
	}

</script>