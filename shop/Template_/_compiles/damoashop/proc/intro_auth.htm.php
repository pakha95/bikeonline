<?php /* Template_ 2.2.7 2015/11/16 15:26:50 /www/jbsinttr8192_godo_co_kr/shop/data/skin/damoashop/proc/intro_auth.htm 000004835 */ ?>
<script language="javascript">
<!--
function goIDCheckIpin(){
<?php if($TPL_VAR["ipinyn"]=='y'){?>
		var popupWindow = window.open( "", "popupCertKey", "top=100, left=200, status=0, width=417, height=490" );
		ifrmRnCheck.location.href="<?php echo url("member/ipin/IPINCheckRequest.php?")?>&callType=adultcheck";
<?php }elseif($TPL_VAR["niceipinyn"]=='y'){?>
		var popupWindow = window.open( "", "popupCertKey", "width=450, height=550, top=100, left=100, fullscreen=no, menubar=no, status=no, toolbar=no, titlebar=yes, location=no, scrollbar=no" );
		ifrmRnCheck.location.href="<?php echo url("member/ipin/IPINMain.php?")?>&callType=adultcheck";
<?php }?>
	return;
}

function frmChk(){
	var frm = document.form1;

	if(frm.name.value ==""){
		alert("�̸��� �Է��Ͽ� �ֽʽÿ�.");
		frm.name.focus();
		return false;
	}else if(frm['resno[]'][0].value ==""){
		alert("�ֹι�ȣ�� �Է��Ͽ� �ֽʽÿ�.");
		frm['resno[]'][0].focus();
		return false;
	}else if(frm['resno[]'][1].value ==""){
		alert("�ֹι�ȣ�� �Է��Ͽ� �ֽʽÿ�.");
		frm['resno[]'][1].focus();
		return false;
	}

	/*
		strForeigner : 1(������), 2(�ܱ���)
		strRsn : 10(ȸ������), 20(����ȸ��Ȯ��), 30(��������), 40(��ȸ��Ȯ��), 90(��Ÿ����)
	*/
	var strForeigner = '1';
	var strRsn = '30';
	var strNm = frm['name'].value;
	var strNo = frm['resno[]'][0].value + frm['resno[]'][1].value;

	frm.SendInfo.value = makeSendInfo( frm.name.value, strNo, strRsn, strForeigner );

	return true;
}

function rnWayChk(){
	var ryn = document.getElementById("realname");
	var ayn = document.getElementById("auth");

	var realname	= document.getElementById("realnameyn");

	if(realname && realname.checked == true) {
		ryn.style.display = "block";
		ayn.style.display = "none";
	} else {
		ryn.style.display = "none";
		ayn.style.display = "block";
	} 
}

function gohpauthDream(){ //�޴�����������
	var protocol = location.protocol;
	var callbackUrl = "<?php echo ProtocolPortDomain()?><?php echo $GLOBALS["cfg"]["rootDir"]?>/member/hpauthDream/hpauthDream_Result.php";
	ifrmHpauth.location.href=protocol+"//hpauthdream.godo.co.kr/module/NEW_hpauthDream_Main.php?callType=adultcheck&shopUrl="+callbackUrl+"&cpid=<?php echo $TPL_VAR["hpauthDreamcpid"]?>";
	return;
}
//-->
</script>

<?php if($TPL_VAR["realnameyn"]=='y'||$TPL_VAR["ipinyn"]=='y'||$TPL_VAR["niceipinyn"]=='y'||$TPL_VAR["hpauthDreamyn"]=='y'){?>
<form method=post action="<?php echo $TPL_VAR["loginActionUrl"]?>" id="form1" name="form1" onsubmit="return frmChk();">
<div class="form">	

	<h4>��ȸ�� ���� ����</h4>
<?php if($TPL_VAR["realnameyn"]=='y'){?>
		<input type="checkbox" name="rnWay" id="realnameyn" value="realnameyn" onclick="rnWayChk();" />�Ǹ�Ȯ��			
<?php }?>

	<input type="hidden" name="returnUrl" value="<?php echo $GLOBALS["returnUrl"]?>">
	<input type="hidden" name="mode" value="adult_guest">
	<input type="hidden" name="SendInfo" value="">					

	<!-- �Ǹ�Ȯ�� -->
	<div id="realname" style="display:none;">
		<table>
			<tr>
				<th>�̸�</th>
				<td><input type=text class="fld" name=name size=20 tabindex=1></td>
				<td rowspan=2 class=noline><input type=image src="/shop/data/skin/damoashop/img/btn_ok.gif" tabindex=4></td>
			</tr>
			<tr>
				<th>�ֹι�ȣ</th>
				<td>
					<input type=text name=resno[] maxlength=6 size=6 required label="�ֹε�Ϲ�ȣ" onkeyup="if (this.value.length==6) this.nextSibling.nextSibling.focus()" onkeydown="onlynumber()"  class="fld"> -
					<input type=password name=resno[] maxlength=7 size=10 required label="�ֹε�Ϲ�ȣ" onkeydown="onlynumber()" class="fld">
				</td>
			</tr>
		</table>
	</div>

	<!-- �������� -->
	<div id="auth">
<?php if($TPL_VAR["ipinyn"]=='y'||$TPL_VAR["niceipinyn"]=='y'){?>
		<button alt="������ ���� �ޱ�" onclick="goIDCheckIpin();" class="ipinAuth">������ ���� �ޱ�</button>
<?php }?>
<?php if($TPL_VAR["hpauthDreamyn"]=='y'){?>
		<button alt="�޴��� ���� �ޱ�" onclick="gohpauthDream();" class="phoneAuth">�޴��� ���� �ޱ�</button>
<?php }?>
	</div>

</div>
</form>
<style>
div.body div.forms-wrap {width:360px;}
button.ipinAuth, button.phoneAuth {font-family:'Malgun Gothic';font-size:15px;font-weight:bold;color:#ffffff;width:100%;height:50px;    float: left;background:#a3a3a3;cursor:pointer;display:table-cell;vertical-align:middle;border:0;}
button.ipinAuth {margin-bottom:10px;}
</style>
<?php }else{?>
<style>div.body div.forms-wrap {width:360px;}</style>
<?php }?>

<iframe id="ifrmRnCheck" name="ifrmRnCheck" style="width:500px;height:500px;display:none;"></iframe>
<iframe id="ifrmHpauth" name="ifrmHpauth" style="width:300px;height:200px;display:none;"></iframe>