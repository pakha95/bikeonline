<?php /* Template_ 2.2.7 2015/11/14 11:53:44 /www/jbsinttr8192_godo_co_kr/shop/data/skin/damoashop/member/NewNiceIpin.htm 000002596 */ 
if (is_array($TPL_VAR["consentData"])) $TPL_consentData_1=count($TPL_VAR["consentData"]); else if (is_object($TPL_VAR["consentData"]) && in_array("Countable", class_implements($TPL_VAR["consentData"]))) $TPL_consentData_1=$TPL_VAR["consentData"]->count();else $TPL_consentData_1=0;?>
<script language="javascript">
	function validate(fm)
	{
		if (chkRadioSelect(fm,'agree','y','[ȸ������ �̿���]�� ���Ǹ� �ϼž� ȸ�������� �����մϴ�.') === false) return false;
		if (chkRadioSelect(fm,'private1','y','[����������޹�ħ]�� ���Ǹ� �ϼž� ȸ�������� �����մϴ�.') === false) return false;

<?php if($TPL_consentData_1){foreach($TPL_VAR["consentData"] as $TPL_V1){?>
<?php if($TPL_V1["requiredyn"]=='y'){?>
		if (chkRadioSelect(fm, "consent[<?php echo $TPL_V1["sno"]?>]", "y", "[<?php echo $TPL_V1["title"]?>]�� ���Ǹ� �ϼž� ȸ�������� �����մϴ�.") === false) return false;
<?php }?>
<?php }}?>

		return true;
	}

	function goIDCheckIpin()
	{
		var fm ;
		fm = document.getElementById("form");
		if (!validate(fm)) {
			return;
		} else {
			var popupWindow = window.open( "", "popupCertKey", "width=450, height=550, top=100, left=100, fullscreen=no, menubar=no, status=no, toolbar=no, titlebar=yes, location=no, scrollbar=no" );
			ifrmRnCheck.location.href="<?php echo url("member/ipin/IPINMain.php?")?>&callType=joinmember";
		}
		return;
	}

</script>

<div id="div_RnCheck_ipin" style="width:100%;display:none;">

<div style="border:1px solid #DEDEDE;" class="hundred">
<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr>
	<td style="border:5px solid #F3F3F3;padding:10">

	<table align=center>
	<col width=80%>
	<tr>
		<td align=left style="padding-right:20px"><font color='5d5d5d'>
			<img src="/shop/data/skin/damoashop/img/ipin/Regist_box_icon.gif"/> ������(i-PIN)�� ����������ȸ���� �ְ��ϴ� �ֹε�Ϲ�ȣ ��ü�������� ȸ������ �ֹε�Ϲ�ȣ ���<br>&nbsp;&nbsp;&nbsp;&nbsp;������ ID�� NICE�ſ�������(��)
			�κ��� �߱޹޾� ����Ȯ���� �ϴ� �����Դϴ�.<br><br>
			<img src="/shop/data/skin/damoashop/img/ipin/Regist_box_icon.gif"/> i-PIN �������� ���Խ� i-PIN ��������� ���� �Ǹ������� �ް� �ǹǷ�<br>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $TPL_VAR["shopName"]?>���� ȸ������ �ֹε�Ϲ�ȣ�� ������� �ʽ��ϴ�.
			</font>
		</td>
	</tr>
	</table>
	</td>
</tr>
</table>
<iframe id="ifrmRnCheck" name="ifrmRnCheck" style="width:500px;height:500px;display:none;"></iframe>
</div>

</div>