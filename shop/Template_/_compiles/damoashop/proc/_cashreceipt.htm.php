<?php /* Template_ 2.2.7 2015/01/28 16:49:46 /www/jbsinttr8192_godo_co_kr/shop/data/skin/damoashop/proc/_cashreceipt.htm 000005987 */ ?>
<script language="javascript">
function chkFormCash(fobj)
{
	if (chkForm(fobj) === false) return false;

	var certNo = fobj.certno.value;
	if (fobj.useopt[0].checked)
	{
		if (certNo.length != 10 && certNo.length != 11 )
		{
			alert("�޴�����ȣ�� ��Ȯ�� �Է��� �ֽñ� �ٶ��ϴ�.");
			fobj.certno.focus();
			return false;
		}
		else if ((certNo.length == 11 ||certNo.length == 10) &&  certNo.substring(0,2) != "01" )
		{
			alert("�޴��� ��ȣ�� ������ �ֽ��ϴ�. �ٽ� Ȯ�� �Ͻʽÿ�. ");
			fobj.certno.focus();
			return false;
		}
	}
	else if (fobj.useopt[1].checked)
	{
		if (certNo.length != 10)
		{
			alert("����ڹ�ȣ�� ��Ȯ�� �Է��� �ֽñ� �ٶ��ϴ�.");
			fobj.certno.focus();
			return false;
		}
		var sum = 0;
		var getlist = new Array(10);
		var chkvalue = new Array("1","3","7","1","3","7","1","3","5");
		for (var i=0; i<10; i++) { getlist[i] = certNo.substring(i, i+1); }
		for (var i=0; i<9; i++) { sum += getlist[i]*chkvalue[i]; }
		sum = sum + parseInt((getlist[8]*5)/10);
		sidliy = sum % 10;
		sidchk = 0;
		if (sidliy != 0) { sidchk = 10 - sidliy; }
		else { sidchk = 0; }
		if (sidchk != getlist[9]) {
			alert("����ڵ�Ϲ�ȣ�� ������ �ֽ��ϴ�. �ٽ� Ȯ���Ͻʽÿ�.");
			fobj.certno.focus();
			return false;
		}
	}

	if(confirm("���ݿ������� �����Ͻðڽ��ϱ�?") === false) return false;
	return true;
}

function setUseopt(robj)
{
	var useopt = document.getElementsByName('useopt');
	if (useopt[0].checked)
	{
		_ID('cert_0').style.display = "block";
		_ID('cert_1').style.display = "none";
		useopt[0].form.certno.setAttribute('label', '�޴�����ȣ');
	}
	else if (useopt[1].checked)
	{
		_ID('cert_0').style.display = "none";
		_ID('cert_1').style.display = "block";
		useopt[1].form.certno.setAttribute('label', '����ڹ�ȣ');
	}
}

function popup_receipt(query)
{
	window.open("./popup_cashreceipt.php?"+query,"","top=10,left=10,width=410,height=628,scrollbars=0");
}
</script>

<table width="100%" style="border:1px solid #DEDEDE" cellpadding="0" cellspacing="0">
<tr>
	<td width="150" valign="top" align="right" bgcolor="#F3F3F3" style="padding-top:13px"><b>���ݿ�����</b></td>
	<td id="orderbox" valign="top">

<?php if(!$TPL_VAR["receipt"]->list&&$TPL_VAR["cashreceipt"]&&$TPL_VAR["receipt"]->printable!=''){?>
	<span class="hand" onclick="popup_receipt('<?php echo $TPL_VAR["receipt"]->printable?>')">���ݿ��������</span>

<?php }elseif(!$TPL_VAR["receipt"]->list&&$TPL_VAR["cashreceipt"]&&$TPL_VAR["receipt"]->printable==''){?>
	���ݿ������� �߱޵Ǿ����ϴ�. ( ���ι�ȣ : <?php echo $TPL_VAR["cashreceipt"]?> )
<?php }?>


	<!-- ��������û : Start -->
<?php if($TPL_VAR["receipt"]->writeable===true&&$TPL_VAR["step"]== 0){?>
	�Ա��ϼž� ���ݿ������� ��û�Ͻ� �� �ֽ��ϴ�.

<?php }elseif($TPL_VAR["receipt"]->writeable===true&&$TPL_VAR["step2"]){?>
	������̰ų� ��ҵ� �ֹ��� ���ݿ������� �߱��Ͻ� �� �����ϴ�.

<?php }elseif($TPL_VAR["receipt"]->writeable===true&&$TPL_VAR["step"]&&!$TPL_VAR["step2"]&&$GLOBALS["set"]["receipt"]["period"]&&$TPL_VAR["orddt"]&&(strtotime($TPL_VAR["orddt"])+( 86400*$GLOBALS["set"]["receipt"]["period"]))<time()){?>
	�ֹ��Ϸκ��� <?php echo $GLOBALS["set"]["receipt"]["period"]?>���� ����Ͽ� ��û�� �� �����ϴ�. (<?php echo date('y-m-d H:i',(strtotime($TPL_VAR["orddt"])+( 86400*$GLOBALS["set"]["receipt"]["period"])))?>)

<?php }elseif($TPL_VAR["receipt"]->writeable===true&&$TPL_VAR["step"]&&!$TPL_VAR["step2"]){?>
	<form name="fmCash"  method="POST" action="<?php echo url("mypage/indb.php")?>&" target="ifrmHidden" onsubmit="return chkFormCash(this);">
	<input type="hidden" name="mode" value="add_cashreceipt">
	<input type="hidden" name="ordno" value="<?php echo $TPL_VAR["ordno"]?>">
	<table>
	<tr>
		<td width="100">����뵵</td>
		<td>
		<input type="radio" name="useopt" value="0" onClick="setUseopt()" checked>�ҵ������
		<input type="radio" name="useopt" value="1" onClick="setUseopt()">����������
		</td>
	</tr>
	<tr>
		<td>
		<span id="cert_0" style="display:block;">�޴�����ȣ</span>
		<span id="cert_1" style="display:none;">����ڹ�ȣ</span>
		</td>
		<td><input type="text" name="certno" value="<?php echo str_replace('-','',$TPL_VAR["mobileOrder"])?>" required label="�޴�����ȣ" option="regNum" class="line"> <span class="small">("-" ����)</span></td>
	</tr>
	</table>
	</form>
	<input type="button" value="���ݿ������߱޿�û" name="app_btn" onClick="javascript:if (chkFormCash(document.fmCash)) document.fmCash.submit();">
<?php }?>
	<!-- ��������û : End -->


<?php if($TPL_VAR["receipt"]->writeable=='true'&&($TPL_VAR["receipt"]->list||$TPL_VAR["cashreceipt"])){?><div style="margin-bottom:30px;"><!-- ���ΰ��� --></div><?php }?>


	<!-- ��������û���� : Start -->
<?php if($TPL_VAR["receipt"]->list){?>
	<table cellpadding="3" cellspacing="2" border="1" borderColor="#EFEFEF" style="border-collapse: separate;">
	<col width="50"><col width="110"><col width="80"><col width="80">
	<tr align="center">
		<td><b>No.</b></td>
		<td><b>ó����</b></td>
		<td><b>����뵵</b></td>
		<td><b>ó������</b></td>
		<td><b>���</b></td>
	</tr>
<?php if((is_array($TPL_R1=$TPL_VAR["receipt"]->list)&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {$TPL_I1=-1;foreach($TPL_R1 as $TPL_V1){$TPL_I1++;?>
	<tr align="center">
		<td><?php echo ($TPL_I1+ 1)?></td>
		<td><?php echo substr($TPL_V1["moddt"], 2, - 3)?></td>
		<td><?php echo $TPL_V1["useoptStr"]?></td>
		<td><?php echo $TPL_V1["statusStr"]?></td>
		<td><?php if($TPL_V1["printable"]){?><span class="hand" onclick="popup_receipt('<?php echo $TPL_V1["printable"]?>')">[������]</span><?php }?>&nbsp;</td>
	</tr>
<?php }}?>
	</table>
<?php }?>
	<!-- ��������û���� : End -->

	</td>
</tr>
</table>