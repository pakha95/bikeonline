<?php /* Template_ 2.2.7 2015/11/14 11:54:57 /www/jbsinttr8192_godo_co_kr/shop/data/skin/damoashop/proc/member_join_auth.htm 000011758 */ 
if (is_array($TPL_VAR["consentData"])) $TPL_consentData_1=count($TPL_VAR["consentData"]); else if (is_object($TPL_VAR["consentData"]) && in_array("Countable", class_implements($TPL_VAR["consentData"]))) $TPL_consentData_1=$TPL_VAR["consentData"]->count();else $TPL_consentData_1=0;?>
<script language="javascript">
function checkSubmit() {
	var oForm = document.getElementById("form");

	var rdo_jumin		= document.getElementById("RnCheckType_jumin");
	var rdo_ipin		= document.getElementById("RnCheckType_ipin");
	var rdo_hpauthDream = document.getElementById("RnCheckType_hpauthDream");
	
	if (rdo_ipin && rdo_ipin.checked)  {
		goIDCheckIpin();
	} else if (rdo_hpauthDream && rdo_hpauthDream.checked) {
		gohpauthDream();
	} else if (rdo_jumin && rdo_jumin.checked) {
		if(chkagreement(oForm)) {
			if (chkForm2(oForm)) {
				oForm.submit();
			}
		}
	}else {
		if (chkagreement(oForm)) oForm.submit();

	}
}
</script>

<!-- ����̹��� || ������ġ -->
<TABLE width=100% cellpadding=0 cellspacing=0 border=0>
<tr>
	<td><img src="/shop/data/skin/damoashop/img/common/title_join.gif" border=0></td>
</tr>
<TR>
	<td class="path">HOME > ȸ������ > <B>�̿���</B></td>
</TR>
</TABLE>


<div class="indiv"><!-- Start indiv -->

<form id=form name=frmAgree method=post action="<?php echo url("member/indb.php")?>&" target="ifrmHidden" onSubmit="return chkForm2(this)">
<input type=hidden name=mode value="chkRealName">
<input type=hidden name=rncheck value="none">
<input type=hidden name=nice_nm value="">
<input type=hidden name=pakey value="">
<input type=hidden name=birthday value="">
<input type=hidden name=mobile value="">
<input type=hidden name=sex value="">
<input type=hidden name=dupeinfo value="">
<input type=hidden name=foreigner value="">
<input type=hidden name=phone value="">
<input type=hidden name=type>

<!-- ���̹�üũ�ƿ�(ȸ������) -->
<?php echo $TPL_VAR["naverCheckout_oneclickStep"]?>


<!-- �̿��� -->
<div style="margin-bottom:10px;"><strong>�̿���</strong></div>
<table width="100%" height="160" cellpadding="0" cellspacing="0" border="0" style="border:1px solid #ccc; margin-bottom:25px;">
<tr>
	<td><div style="height:160px; padding:20px; overflow-y:scroll;"><?php echo nl2br($TPL_VAR["termsAgreement"])?></div></td>
	<td width="130" style="padding:17px; background:#f1f1f1; border-left:1px solid #ccc;">
		<input type="radio" name="agree" value="y" style="border:0; background:;"> �����մϴ�<br />
		<input type="radio" name="agree" value="n" style="border:0; background:;"> �������� �ʽ��ϴ�
	</td>
</tr>
</table>

<!-- ����������޹�ħ -->
<div style="margin-bottom:10px;"><strong><span style="color:#ff0000;">[�ʼ�]</span> ����������޹�ħ</strong> <span style="font-size:.9em; color:#858585;">(�ڼ��� ������ ��<a href="<?php echo url("service/private.php")?>&" style="color:#858585;">����������޹�ħ</a>���� Ȯ���Ͻñ� �ٶ��ϴ�)</span></div>
<table width="100%" height="160" cellpadding="0" cellspacing="0" border="0" style="border:1px solid #ccc; margin-bottom:25px;">
<tr>
	<td><div style="height:160px; padding:20px; overflow-y:scroll;"><?php echo $TPL_VAR["termsPolicyCollection2"]?></div></td>
	<td width="130" style="padding:17px; background:#f1f1f1; border-left:1px solid #ccc;">
		<input type="radio" name="private1" value="y" style="border:0; background:;"> �����մϴ�<br />
		<input type="radio" name="private1" value="n" style="border:0; background:;"> �������� �ʽ��ϴ�
	</td>
</tr>
</table>

<?php if($GLOBALS["cfg"]['private2YN']=='Y'){?>
<div style="margin-bottom:10px;"><strong><span style="color:#ff0000;">[����]</span> �������� ��3�� ���� ����</strong></div>
<table width="100%" height="160" cellpadding="0" cellspacing="0" border="0" style="border:1px solid #ccc; margin-bottom:25px;">
<tr>
	<td><div style="height:160px; padding:20px; overflow-y:scroll;"><?php echo $TPL_VAR["termsThirdPerson"]?></div></td>
	<td width="130" style="padding:17px; background:#f1f1f1; border-left:1px solid #ccc;">
		<input type="radio" name="private2" value="y" style="border:0; background:;" label="�������� ��3�� ���� ����" msgR="���� ���θ� üũ���ּ���."> �����մϴ�<br />
		<input type="radio" name="private2" value="n" style="border:0; background:;" label="�������� ��3�� ���� ����" msgR="���� ���θ� üũ���ּ���."> �������� �ʽ��ϴ�
	</td>
</tr>
</table>
<?php }?>
<?php if($GLOBALS["cfg"]['private3YN']=='Y'){?>
<div style="margin-bottom:10px;"><strong><span style="color:#ff0000;">[����]</span> ����������� ��Ź ����</strong></div>
<table width="100%" height="160" cellpadding="0" cellspacing="0" border="0" style="border:1px solid #ccc; margin-bottom:25px;">
<tr>
	<td><div style="height:160px; padding:20px; overflow-y:scroll;"><?php echo $TPL_VAR["termsEntrust"]?></div></td>
	<td width="130" style="padding:17px; background:#f1f1f1; border-left:1px solid #ccc;">
		<input type="radio" name="private3" value="y" style="border:0; background:;" label="����������� ��Ź ����" msgR="���� ���θ� üũ���ּ���."> �����մϴ�<br />
		<input type="radio" name="private3" value="n" style="border:0; background:;" label="����������� ��Ź ����" msgR="���� ���θ� üũ���ּ���."> �������� �ʽ��ϴ�
	</td>
</tr>
</table>
<?php }?>
<?php if($TPL_consentData_1){foreach($TPL_VAR["consentData"] as $TPL_V1){?>
<div style="margin-bottom:10px;"><strong><span style="color:#ff0000;">[<?php echo $TPL_V1["requiredyn_text"]?>]</span> <?php echo $TPL_V1["title"]?></strong></div>
<table width="100%" height="160" cellpadding="0" cellspacing="0" border="0" style="border:1px solid #ccc; margin-bottom:25px;">
<tr>
	<td><div style="height:160px; padding:20px; overflow-y:scroll;"><?php echo nl2br($TPL_V1["termsContent"])?></div></td>
	<td width="130" style="padding:17px; background:#f1f1f1; border-left:1px solid #ccc;">
		<input type="radio" name="consent[<?php echo $TPL_V1["sno"]?>]" value="y" style="border:0; background:;" label="<?php echo $TPL_V1["title"]?>" msgR="���� ���θ� üũ���ּ���."> �����մϴ�<br />
		<input type="radio" name="consent[<?php echo $TPL_V1["sno"]?>]" value="n" style="border:0; background:;" label="<?php echo $TPL_V1["title"]?>" msgR="���� ���θ� üũ���ּ���."> �������� �ʽ��ϴ�
	</td>
</tr>
</table>
<?php }}?>

<!-- ����Ȯ�� �������� -->
<?php if($TPL_VAR["realnameyn"]=='y'||$TPL_VAR["ipinyn"]=='y'||$TPL_VAR["niceipinyn"]=='y'||$TPL_VAR["hpauthDreamyn"]=='y'){?>
<div style="padding-left:7"><font color=f7443f><b>����Ȯ�� ���� ����</b></font></div>
<table height="35">
	<tr>
<?php if($TPL_VAR["realnameyn"]=='y'){?>	
		<td class="noline">
			<label for="RnCheckType_jumin" style="width:130px;height:20px;display:inline-block;background:url('/shop/data/skin/damoashop/img/ipin/Regist_realName_title_1.gif') no-repeat 17px 3px;">
			<input type="radio" name="RnCheckType" value="jumin" id="RnCheckType_jumin" onclick="selectRnCheckType()">
			</label>
		</td>
		<td width="5">&nbsp;</td>				
<?php }?>
<?php if($TPL_VAR["ipinyn"]=='y'||$TPL_VAR["niceipinyn"]=='y'){?>
		<td class="noline">
			<label for="RnCheckType_ipin" style="width:150px;height:20px;display:inline-block;background:url('/shop/data/skin/damoashop/img/ipin/Regist_realName_title_2.gif') no-repeat 17px 3px;">
			<input type="radio" name="RnCheckType" value="ipin" id="RnCheckType_ipin" onclick="selectRnCheckType()">
			</label>
		</td>
		<td width="5">&nbsp;</td>
<?php }?>
<?php if($TPL_VAR["hpauthDreamyn"]=='y'){?>
		<td class="noline">
			<label for="RnCheckType_hpauthDream" style="width:150px;height:20px;display:inline-block;background:url('/shop/data/skin/damoashop/img/auth/hpauth_title_3.gif') no-repeat 17px 3px;">
			<input type="radio" name="RnCheckType" value="hpauthDream" id="RnCheckType_hpauthDream" onclick="selectRnCheckType()">
			</label>
		</td>
		<td width="5">&nbsp;</td>
<?php }?>		
</tr>
</table>
<?php }?>


<?php if($TPL_VAR["realnameyn"]=='y'){?>	
<?php echo $this->define('tpl_include_file_1',"member/NiceCheck.htm")?> <?php $this->print_("tpl_include_file_1",$TPL_SCP,1);?>

<?php }?>

<?php if($TPL_VAR["ipinyn"]=='y'){?>
<?php echo $this->define('tpl_include_file_2',"member/NiceIpin.htm")?> <?php $this->print_("tpl_include_file_2",$TPL_SCP,1);?>

<?php }else{?>
<?php echo $this->define('tpl_include_file_3',"member/NewNiceIpin.htm")?> <?php $this->print_("tpl_include_file_3",$TPL_SCP,1);?>

<?php }?>

<?php if($TPL_VAR["hpauthDreamyn"]=='y'){?>
<?php echo $this->define('tpl_include_file_4',"member/hpauthDream.htm")?> <?php $this->print_("tpl_include_file_4",$TPL_SCP,1);?>

<?php }?>

<!-- �ϴܹ�ư -->
<div align=center style="padding:50px 0 20px 0" class=noline>
<a href="javascript:checkSubmit();"><img src="/shop/data/skin/damoashop/img/common/btn_join.gif"></a>
<a href="javascript:history.back()"><img src="/shop/data/skin/damoashop/img/common/btn_back.gif" border=0></a>
</div>

</form>

</div><!-- End indiv -->

<script>
function defaultRnCheckType() {
	var authtype = document.getElementsByName("RnCheckType");

	if (authtype.item(0) != null) {
		var div_jumin		= document.getElementById("div_RnCheck_jumin");
		var div_ipin		= document.getElementById("div_RnCheck_ipin");
		var div_hpauthDream = document.getElementById("div_RnCheck_hpauthDream");

		if (authtype.item(0).value == 'jumin')
		{
			div_jumin.style.display='';
		} else if(authtype.item(0).value == 'ipin') {
			div_ipin.style.display='';
		} else if(authtype.item(0).value == 'hpauthDream') {
			div_hpauthDream.style.display='';
		}
		authtype.item(0).checked = true;
	}	
}

function selectRnCheckType(){

	var div_jumin		= document.getElementById("div_RnCheck_jumin");
	var div_ipin		= document.getElementById("div_RnCheck_ipin");
	var div_hpauthDream = document.getElementById("div_RnCheck_hpauthDream");

	var rdo_jumin		= document.getElementById("RnCheckType_jumin");
	var rdo_ipin		= document.getElementById("RnCheckType_ipin");
	var rdo_hpauthDream = document.getElementById("RnCheckType_hpauthDream");

	if(rdo_jumin && rdo_jumin.checked == true){
		if (div_jumin != null) { div_jumin.style.display=''; }
		if (div_ipin != null) { div_ipin.style.display='none'; }
		if (div_hpauthDream != null) { div_hpauthDream.style.display='none'; }
	}
	if(rdo_ipin && rdo_ipin.checked == true){
		if (div_jumin != null)	{ div_jumin.style.display='none'; }
		if (div_ipin != null)	{ div_ipin.style.display=''; }
		if (div_hpauthDream != null) { div_hpauthDream.style.display='none'; }
	}
	if(rdo_hpauthDream && rdo_hpauthDream.checked == true){
		if (div_jumin != null)	{ div_jumin.style.display='none'; }
		if (div_ipin != null)	{ div_ipin.style.display='none'; }
		if (div_hpauthDream != null) { div_hpauthDream.style.display=''; }
	}
}

function chkForm2(fm)
{
	if (typeof(goIDCheck) != "undefined"){
		if (goIDCheck(fm) === false) return false;
	}

	return chkForm(fm);
}

function chkagreement(fm){
	if (chkRadioSelect(fm,'agree','y','[ȸ������ �̿���]�� ���Ǹ� �ϼž� ȸ�������� �����մϴ�.') === false) return false;
	if (chkRadioSelect(fm,'private1','y','[����������޹�ħ]�� ���Ǹ� �ϼž� ȸ�������� �����մϴ�.') === false) return false;

<?php if($TPL_consentData_1){foreach($TPL_VAR["consentData"] as $TPL_V1){?>
<?php if($TPL_V1["requiredyn"]=='y'){?>
	if (chkRadioSelect(fm,'consent[<?php echo $TPL_V1["sno"]?>]','y','[<?php echo $TPL_V1["title"]?>]�� ���Ǹ� �ϼž� ȸ�������� �����մϴ�.') === false) return false;
<?php }?>
<?php }}?>

	return true;
}
</script>
<script>defaultRnCheckType();</script>