<?php /* Template_ 2.2.7 2016/06/20 12:06:45 /www/jbsinttr8192_godo_co_kr/shop/data/skin/damoashop/mypage/mydelivery_list.htm 000003723 */ 
if (is_array($TPL_VAR["list"])) $TPL_list_1=count($TPL_VAR["list"]); else if (is_object($TPL_VAR["list"]) && in_array("Countable", class_implements($TPL_VAR["list"]))) $TPL_list_1=$TPL_VAR["list"]->count();else $TPL_list_1=0;?>
<form  name="form" method="post" action="<?php echo url("mypage/mydelivery_indb.php")?>&">
<input type="hidden" name="mode" value="<?php echo $TPL_VAR["mode"]?>" />
<input type="hidden" name="pkind" value="<?php echo $TPL_VAR["pkind"]?>" />
<div class="delivery_div">
	<div id="deliveryList" class="delivery_list">
		<div class="dtitle"><img src="/shop/data/skin/damoashop/img/common/title_address.png" title="���� ����� ����" /></div>
		<div class="path mydtit">HOME &gt; ���������� &gt; <span class="bold">���� ����� ����</span></div>
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
				<colgroup><col width="20%"><col width="*"><col width="20%"><col width="15%"></colgroup>
				<tr><th colspan="4" class="bordertop"></th></tr>
				<tr class="input_txt">
					<th>�������/<br />�����Ǻ�</th>
					<th>�����ǰ�</th>
					<th>����ó</th>
					<th>����/����</th>
				</tr>
				<tr><th colspan="4" class="borderbtm"></th></tr>
<?php if(count($TPL_VAR["list"])== 0){?>
				<tr>
					<td colspan="4">�����Ͱ� �����ϴ�.</td>
				</tr>
<?php }else{?>
<?php if($TPL_list_1){foreach($TPL_VAR["list"] as $TPL_V1){?>
				<tr>
					<td><?php echo $TPL_V1["gmd_title"]?><br /><?php echo $TPL_V1["gmd_name"]?></td>
					<td style="text-align:left;">
						<?php echo $TPL_V1["gmd_zonecode"]?> (<?php echo $TPL_V1["gmd_zipcode"]?>)
<?php if($TPL_V1["gmd_default"]=='y'){?><span class="delivery_default">�⺻�����</span><?php }?><br />
<?php if($TPL_V1["gmd_road_address"]){?>
						<?php echo $TPL_V1["gmd_road_address"]?>

<?php }else{?>
						<?php echo $TPL_V1["gmd_address"]?>

<?php }?>
						<br /><?php echo $TPL_V1["gmd_address_sub"]?>

					</td>
					<td><?php echo $TPL_V1["gmd_mobile"]?><br /><?php echo $TPL_V1["gmd_phone"]?></td>
					<td>
						<a href="javascript:deli_edit(<?php echo $TPL_V1["gmd_sno"]?>);"><img src="/shop/data/skin/damoashop/img/common/btn_delivery_edit.png" alt="����" title="����" /></a>
						<a href="javascript:deli_delete(<?php echo $TPL_V1["gmd_sno"]?>);"><img src="/shop/data/skin/damoashop/img/common/btn_delivery_delete.png" alt="����" title="����" /></a>
					</td>
				</tr>
<?php }}?>
<?php }?>
			</table>
		</div>
	</div>
</div>
</form>
<script type="text/javascript">
	var mode = "<?php echo $TPL_VAR["mode"]?>";
	var pkind = "<?php echo $TPL_VAR["pkind"]?>";

	function deli_add() {
		location.href="<?php echo url("mypage/mydelivery.php?")?>&mode=form"+(pkind ? "&pkind="+pkind : "");
	}

	function deli_edit(sno) {
		location.href="<?php echo url("mypage/mydelivery.php?")?>&mode=form&sno="+sno+(pkind ? "&pkind="+pkind : "");
	}

	function deli_delete(sno) {
		location.href="<?php echo url("mypage/mydelivery_indb.php?")?>&mode=delete&sno="+sno+(pkind ? "&pkind="+pkind : "");
	}

	function deli_list() {
		location.href="<?php echo url("mypage/mydelivery.php?")?>&mode=list"+(pkind ? "&pkind="+pkind : "");
	}
</script>