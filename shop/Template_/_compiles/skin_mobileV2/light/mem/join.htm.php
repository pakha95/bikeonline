<?php /* Template_ 2.2.7 2015/11/14 11:56:19 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/mem/join.htm 000029538 */ 
if (is_array($TPL_VAR["ts_category_all"])) $TPL_ts_category_all_1=count($TPL_VAR["ts_category_all"]); else if (is_object($TPL_VAR["ts_category_all"]) && in_array("Countable", class_implements($TPL_VAR["ts_category_all"]))) $TPL_ts_category_all_1=$TPL_VAR["ts_category_all"]->count();else $TPL_ts_category_all_1=0;?>
<?php $this->print_("header",$TPL_SCP,1);?>

<?php  $TPL_VAR["page_title"] = "ȸ������<span class='small_title'>(��������)</span>";?>
<?php $this->print_("sub_header",$TPL_SCP,1);?>

<script src="/shop/data/skin_mobileV2/light/godo.password_strength.js" type="text/javascript"></script>
<style type="text/css">
div.passwordStrenth				{ display:none; }
div.passwordStrenth dl			{ margin:0; padding:0 6px 0 0; color:#373737; font-weight:bold; font-size:11px; font-family:dotum; }
div.passwordStrenth dl dt,
div.passwordStrenth dl dd		{ display:inline; font-size:11px; font-family:dotum; margin:0; height:15px; line-height:15px; }
div.passwordStrenth dl dt		{ color:#363636; font-weight:bold; width:95px; }
div.passwordStrenth dl dd.lv0	{ color:#F52D00; }
div.passwordStrenth dl dd.lv1	{ color:#028EFF; }
div.passwordStrenth dl dd.lv2	{ color:#0213FF; }
div.passwordStrenth dl dd.lv3	{ color:#46C32D; }
div.passwordStrenth dl dd.lv4	{ color:#46C32D; }
</style>

<script type="text/javascript">
function checkPassword(el) {
	if(el.value) {
		var result = nsGodo_PasswordStrength.check( el );

		_ID('el-password-strength-indicator-msg').innerHTML		= result.msg;
		_ID('el-password-strength-indicator-level').className	= 'lv' + result.level;
		_ID('el-password-strength-indicator-level').innerHTML	= result.levelText;
		_ID('el-password-strength-indicator').style.display		= 'block';
	}
	else {
		emptyPwState();
	}
}

function emptyPwState() {
	_ID('el-password-strength-indicator').style.display = "none";
}

function idCheck(obj) {

	var $id = $(obj).val();

	if($id.length < 6) {
		$("[name=id_chk]").val('n');
		$("#id_description").addClass("wrong");
		$("#id_description").text('���̵�� 6�� �̻����� �Է��� �ּ���');
	}
	else {
		var data_param = "mode=id_check&id="+$id;

		$.ajax({
			type : "post",
			url : "/"+mobile_root+"/proc/mAjaxAction.php",
			cache:false,
			async:false,
			data: data_param,
			success: function (res) {
				chk_data = res;

				$("[name=id_chk]").val(chk_data.code);
				$("#id_description").text(chk_data.msg);

				if(chk_data.code == "n") {
					$("#id_description").addClass("wrong");
				}
				else {
					$("#id_description").removeClass("wrong");
				}
			},
			dataType:"json"
		});
	}
}

function pwdCheck(obj) {

	var $pwd = $("[name=password]").val();

	if($pwd.length < 10 || $pwd.length > 16 ) {
		alert('��й�ȣ�� 10~16���� ������, ������������ �Է����ּ���');
		$("[name=pwd_chk]").val('n');
		$("[name=password]").focus();
		return;
	}
	else {
		$c_pwd = $(obj).val();

		if($pwd != $c_pwd) {
			$("[name=pwd_chk]").val('n');
			$("#pwd_description").text('��й�ȣ�� ��ġ���� �ʽ��ϴ�');
			$("#pwd_description").addClass("wrong");
		}
		else {
			$("[name=pwd_chk]").val('y');
			$("#pwd_description").text('��й�ȣ�� ��ġ�մϴ�');
			$("#pwd_description").removeClass("wrong");
		}
	}
}

function onlyNum(obj) {
	if ((event.keyCode<48) || (event.keyCode>57)) {
		event.returnValue = false;
		return false;
	}
	else {
		return true;
	}
}

function nextField(obj, len, nextObjName) {
	if (obj.value.length == len) {
		alert(obj.value.length);
		obj.nextSibling.focus();
	}
}

function nextStep() {
	var check_required = 1;

	if(!$("[name=m_id]").val()) {
		alert("���̵� �Է����ּ���");
		$("[name=m_id]").focus();
		return;
	}
	if(!$("[name=password]").val()) {
		alert("��й�ȣ�� �Է����ּ���");
		$("[name=password]").focus();
		return;
	}
	if($("[name=id_chk]").val() != 'y') {
		alert('���̵� Ȯ���� �ּ���');
		$("[name=m_id]").focus();
		return;
	}
	if($("[name=pwd_chk]").val() != 'y') {
		alert('��й�ȣ�� ��ġ���� �ʽ��ϴ�');
		$("[name=password2]").focus();
		return;
	}

	$("input[required='']").each(function(i, obj) {
		if (obj.value == '') {
			check_required = 0;
			alert("�ʼ���("+obj.getAttribute('label')+")�� �Է��ϼ���.");
			obj.focus();
			return false;
		}
	});
	if (check_required == 0) return;

	// ��14�� �̸� ȸ������ ���ɿ��� ������Ϸ� üũ
	var under14Code = '<?php echo $TPL_VAR["under14Code"]?>';
	var under14Status = '<?php echo $TPL_VAR["under14Status"]?>';
	if (under14Code == 'needBirthCheck') {
		var birthDay = '';
		if ($("[name=birth_year]").length && $("[name=birth[]]").length) {
			bY = '0000' + $("[name=birth_year]").val();
			bM = '00' + $("[name=birth[]]").eq(0).val();
			bD = '00' + $("[name=birth[]]").eq(1).val();
			birthDay = bY.substring(bY.length-4) + bM.substring(bM.length-2) + bD.substring(bD.length-2);
		}
		if (chkUnder14(birthDay, under14Status, under14Code) === false) {
			return;
		}
	}

	$frm = $("#form");
	$frm.submit();
}

</script>

<section class="content" id="memberjoin">
<form id=form name=frmAgree method=post action="<?php echo $TPL_VAR["memActionUrl"]?>" target="ifrmHidden">
	<input type="hidden" name="mode" value="member_join" />
	<input type="hidden" name="id_chk" value="" />
	<input type="hidden" name="pwd_chk" value="" />
	<input type="hidden" name="type" />
	<input type="hidden" name="rncheck" value="<?php echo $TPL_VAR["rncheck"]?>" />
	<input type="hidden" name="dupeinfo" value="<?php echo $TPL_VAR["dupeinfo"]?>" />
	<input type="hidden" name="pakey" value="<?php echo $TPL_VAR["pakey"]?>" />
	<input type="hidden" name="foreigner" value="<?php echo $TPL_VAR["foreigner"]?>" />
	<input type="hidden" name="passwordSkin" value="Y"><!-- ��й�ȣ �ۼ� ��Ģ ���� ��Ų��ġ ���� -->
	<input type="hidden" name="private2" value="<?php echo $TPL_VAR["chk_termsThirdPerson"]?>" />
	<input type="hidden" name="private3" value="<?php echo $TPL_VAR["chk_termsEntrust"]?>" />
<?php if((is_array($TPL_R1=$_POST["consent"])&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_K1=>$TPL_V1){?>
	<input type=hidden name=consent[<?php echo $TPL_K1?>] value="<?php echo $TPL_V1?>">
<?php }}?>
	<div class="join_step">
		<div class="join_step1" onclick="javascript:history.back(-2);">�������<div class="join_arrow"></div></div>
		<div class="join_step2 now_step">��������<div class="join_arrow"></div></div>
		<div class="join_step4">���ԿϷ�</div>
	</div>
	<div class="account">
		<div class="account_title"><div class="title">���� �����ϱ�</div></div>
		<div class="account_content">
			<div class="input_wrap">
			<div class="input_title">���̵�</div>

			<div class="input_content">
				<input type="text" name="m_id" size="13" maxlength="16" style="ime-mode:diable" class="wp100" onKeyUp="javascript:idCheck(this);"/>
				<div class="description_wrap">
					<div class="description">6~16���� ������, ��������</div>
					<div class="description wrong" id="id_description">���̵�� 6�� �̻����� �Է��� �ּ���</div>
				</div>
			</div>
			</div>
			<div class="input_wrap">
			<div class="input_title">��й�ȣ</div>

			<div class="input_content">
				<input type="password" name="password" size="13" maxlength="16" class="wp100" style="ime-mode:disabled" onfocus="checkPassword(this)" onkeyup="checkPassword(this)" onblur="emptyPwState()" />
				<div class="description_wrap">
					<div class="passwordStrenth" id="el-password-strength-indicator">
						<dl>
							<dt>��й�ȣ ������</dt>
							<dd id="el-password-strength-indicator-level"></dd>
						</dl>
					</div>
					<div class="description" id="el-password-strength-indicator-msg">10~16���� ������, ��������</div>
				</div>
			</div>
			</div>
			<div class="input_wrap">
			<div class="input_title">��й�ȣȮ��</div>

			<div class="input_content">
				<input type="password" name="password2" size="13" maxlength="16" style="ime-mode:disabled" class="wp100" onKeyUp="javascript:pwdCheck(this);" />
				<div class="description_wrap">
					<div class="description wrong" id="pwd_description">��й�ȣ�� ��ġ���� �ʽ��ϴ�</div>
				</div>
			</div>
			</div>
			<div class="input_wrap">
			<div class="input_title">�̸�</div>

			<div class="input_content">
<?php if($GLOBALS["mode"]=="joinMember"&&$TPL_VAR["name"]){?>
				<input type="text" value="<?php echo $TPL_VAR["name"]?>" readonly="readonly"/>
				<input type="hidden" name="name" value="<?php echo $TPL_VAR["name"]?>"/>
<?php }else{?>
				<input type="text" name="name" value="<?php echo $TPL_VAR["name"]?>" size="13" maxlength="10" style="ime-mode:active" class="wp100" required label="�̸�" /> <span class="description">6~16��</span>
<?php }?>
			</div>
			</div>

<?php if($GLOBALS["checked_mobile"]["useField"]["nickname"]){?>
			<div class="input_wrap">
			<div class="input_title"><?php if($GLOBALS["checked_mobile"]["reqField"]["nickname"]){?><?php }?>�г���</div>

			<div class="input_content">
				<input type="text" name="nickname" size="13" maxlength="12" class="wp100" style="ime-mode:active" <?php if($GLOBALS["checked_mobile"]["reqField"]["nickname"]){?>required<?php }?> label="�г���"/>
			</div>
			</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["sex"]){?>
			<div class="input_wrap">
			<div class="input_title"><?php if($GLOBALS["checked_mobile"]["reqField"]["sex"]){?><?php }?>����</div>

			<div class="input_content">
				<label><input type="radio" name="sex" label="����" value="m" <?php echo $GLOBALS["checked"]["sex"]["m"]?> label="����" <?php if($GLOBALS["checked_mobile"]["reqField"]["sex"]){?>required<?php }?> /> ����</label>
				<label><input type="radio" name="sex" label="����" value="w" <?php echo $GLOBALS["checked"]["sex"]["w"]?> label="����" <?php if($GLOBALS["checked_mobile"]["reqField"]["sex"]){?>required<?php }?> /> ����</label>
			</div>
			</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["birth"]){?>
			<div class="input_wrap">
			<div class="input_title"><?php if($GLOBALS["checked_mobile"]["reqField"]["birth"]){?><?php }?>�������</div>

			<div class="input_content">
				<input type="number" pattern="[0-9]*" name="birth_year" value="<?php echo $TPL_VAR["birth_year"]?>" size="4" maxlength="4" onKeyPress="javascript:onlyNum(this, event);" class="w30" style="ime-mode:disabled" label="�������" <?php if($GLOBALS["checked_mobile"]["reqField"]["birth"]){?>required<?php }?> /> ��
				<input type="number" pattern="[0-9]*" name="birth[]" value="<?php echo $TPL_VAR["birth"][ 0]?>" size="2" maxlength="2" onKeyPress="javascript:onlyNum(this, event);" class="w25" style="ime-mode:disabled" label="�������" <?php if($GLOBALS["checked_mobile"]["reqField"]["birth"]){?>required<?php }?> /> ��
				<input type="number" pattern="[0-9]*" name="birth[]" value="<?php echo $TPL_VAR["birth"][ 1]?>" size="2" maxlength="2" onKeyPress="javascript:onlyNum(this, event);" class="w25"  style="ime-mode:disabled" label="�������" <?php if($GLOBALS["checked_mobile"]["reqField"]["birth"]){?>required<?php }?> /> ��
<?php if($GLOBALS["checked_mobile"]["useField"]["calendar"]){?>
				<div class=noline style="padding-top:10px">
				<input type=radio name=calendar value="s" <?php echo $GLOBALS["checked"]["calendar"]["s"]?> label="�Ͽ�����" <?php if($GLOBALS["checked_mobile"]["reqField"]["calendar"]){?>required<?php }?> > ���
				<input type=radio name=calendar value="l" <?php echo $GLOBALS["checked"]["calendar"]["l"]?> label="�Ͽ�����" <?php if($GLOBALS["checked_mobile"]["reqField"]["calendar"]){?>required<?php }?> > ����
				</div>
<?php }?>
			</div>
			</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["marriyn"]){?>
			<div class="input_wrap">
			<div class="input_title"><?php if($GLOBALS["checked_mobile"]["reqField"]["marriyn"]){?><?php }?>��ȥ����</div>

			<div class="input_content">
				<label><input type="radio" name="marriyn" label="��ȥ����" value="n" checked label="��ȥ����" <?php if($GLOBALS["checked_mobile"]["reqField"]["marriyn"]){?>required<?php }?> /> ��ȥ</label>
				<label><input type="radio" name="marriyn" label="��ȥ����" value="y" label="��ȥ����" <?php if($GLOBALS["checked_mobile"]["reqField"]["marriyn"]){?>required<?php }?> /> ��ȥ</label>
			</div>
			</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["marridate"]){?>
			<div class="input_wrap">
			<div class="input_title"><?php if($GLOBALS["checked_mobile"]["reqField"]["marridate"]){?><?php }?>��ȥ�����</div>

			<div class="input_content">
				<input type="number"  pattern="[0-9]*"  name="marridate[]" size="4" maxlength="4" onKeyPress="javascript:onlyNum(this, event);" class="w30" style="ime-mode:disabled" label="��ȥ�����" <?php if($GLOBALS["checked_mobile"]["reqField"]["marridate"]){?>required<?php }?> /> ��
				<input type="number"  pattern="[0-9]*" name="marridate[]" size="2" maxlength="2" onKeyPress="javascript:onlyNum(this, event);" class="w25" style="ime-mode:disabled" label="��ȥ�����" <?php if($GLOBALS["checked_mobile"]["reqField"]["marridate"]){?>required<?php }?> /> ��
				<input type="number"  pattern="[0-9]*" name="marridate[]" size="2" maxlength="2" onKeyPress="javascript:onlyNum(this, event);" class="w25" style="ime-mode:disabled" label="��ȥ�����" <?php if($GLOBALS["checked_mobile"]["reqField"]["marridate"]){?>required<?php }?> /> ��
			</div>
			</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["email"]){?>
			<div class="input_wrap">
			<div class="input_title"><?php if($GLOBALS["checked_mobile"]["reqField"]["email"]){?><?php }?>�̸���</div>

			<div class="input_content">
				<input type="email" name="email" size="17" class="wp100" style="ime-mode:inactive" label="�̸���" <?php if($GLOBALS["checked_mobile"]["reqField"]["email"]){?>required<?php }?> />
				<div class="description_wrap">
<?php if($GLOBALS["checked"]["useField"]["mailling"]){?>
					<div class="description chk">
						<label><input type="checkbox" name="mailling" /> ���� ����,�̺�Ʈ���ϼ���</label>
					</div>
					<div class="description">
						�� �ֹ�����,�������� �� �ֿ� �ȳ������� ���� ���ο� ������� �ڵ� �߼۵˴ϴ�.
					</div>
<?php }?>
					<div class="description">
						�� ���̵� / ��й�ȣ ã�⿡ Ȱ�� �ǹǷ� ��Ȯ�ϰ� �Է��� �ּ���.
					</div>
				</div>
			</div>
			</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["address"]){?>
			<div class="input_wrap">
			<div class="input_title"><?php if($GLOBALS["checked_mobile"]["reqField"]["address"]){?><?php }?>�ּ�</div>

			<div class="input_content">
				<button id="zipcode-btn" class="btn_zipcode" type="button" onclick="frmMake('<?php echo $GLOBALS["cfg"]["rootDir"]?>/proc/popup_address.php?isMobile=true&gubun=mobile','searchZipcode','',false)">�����ȣ �˻�</button>
				<input type="number" name="zonecode" id="zonecode" size="5" maxlength="5" onKeyPress="javascript:onlyNum(this, event);" class="w60" style="ime-mode:disabled" readonly label="�ּ�" />
				( <input type="number" name="zipcode[]" id="zipcode0" size="3" maxlength="4" onKeyPress="javascript:onlyNum(this, event);" class="w50" style="ime-mode:disabled" readonly label="�ּ�" <?php if($GLOBALS["checked_mobile"]["reqField"]["address"]){?>required<?php }?>  /> -
				<input type="number" name="zipcode[]" id="zipcode1" size="3" maxlength="4" onKeyPress="javascript:onlyNum(this, event);" class="w50" style="ime-mode:disabled" readonly label="�ּ�" <?php if($GLOBALS["checked_mobile"]["reqField"]["address"]){?>required<?php }?>  /> )
			</div>
			</div>
			<div class="input_wrap">
			<div class="input_title"></div>

			<div class="input_content">
				<input type="text" name="address" id="address" size="20" class="wp100" style="ime-mode:active" label="�ּ�" <?php if($GLOBALS["checked_mobile"]["reqField"]["address"]){?>required<?php }?>  />
			</div>
			</div>
			<div class="input_wrap">
			<div class="input_title"></div>

			<div class="input_content">
				<input type="text" name="address_sub" id="address_sub" size="20" class="wp100" onkeyup="SameAddressSub(this)" oninput="SameAddressSub(this)" style="ime-mode:active" label="�ּ�"/>
				<br/>
				<input type="hidden" name="road_address" id="road_address" value="<?php echo $TPL_VAR["road_address"]?>">
				<span style="padding:5px 5px 0 1px;font:12px dotum;color:#999;" id="div_road_address"><?php echo $TPL_VAR["road_address"]?></span>
				<span style="padding:5px 0 0 1px;font:12px dotum;color:#999;" id="div_road_address_sub"><?php if($TPL_VAR["road_address"]){?><?php echo $TPL_VAR["address_sub"]?><?php }?></span>
			</div>
			</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["mobile"]){?>
			<div class="input_wrap">
			<div class="input_title"><?php if($GLOBALS["checked_mobile"]["reqField"]["mobile"]){?><?php }?>�޴���</div>

			<div class="input_content">
				<input type="number" value="<?php echo $TPL_VAR["mobile"][ 0]?>" placeholder="Enter Text" pattern="[0-9]*" name="mobile[]" size="3" maxlength="3" onKeyPress="javascript:onlyNum(this, event);" class="w30" style="ime-mode:disabled" label="�޴���" <?php if($GLOBALS["checked_mobile"]["reqField"]["mobile"]){?>required<?php }?> <?php echo $TPL_VAR["mobileReadonly"]?> /> -
				<input type="number" value="<?php echo $TPL_VAR["mobile"][ 1]?>" placeholder="Enter Text" pattern="[0-9]*" name="mobile[]" size="4" maxlength="4" onKeyPress="javascript:onlyNum(this, event);" class="w40" style="ime-mode:disabled" label="�޴���" <?php if($GLOBALS["checked_mobile"]["reqField"]["mobile"]){?>required<?php }?> <?php echo $TPL_VAR["mobileReadonly"]?> /> -
				<input type="number" value="<?php echo $TPL_VAR["mobile"][ 2]?>" placeholder="Enter Text" pattern="[0-9]*" name="mobile[]" size="4" maxlength="4" onKeyPress="javascript:onlyNum(this, event);" class="w40" style="ime-mode:disabled" label="�޴���" <?php if($GLOBALS["checked_mobile"]["reqField"]["mobile"]){?>required<?php }?> <?php echo $TPL_VAR["mobileReadonly"]?> />
				<div class="description_wrap">
<?php if($GLOBALS["checked_mobile"]["useField"]["sms"]){?>
				<div class="description chk">
					<label><input type="checkbox" name="sms"  /> ���� ����,�̺�ƮSMS����</label>
				</div>
				<div class="description">
					�� �ֹ����� �� �ֿ� �ȳ������� ���� ���ο� ������� �ڵ� �߼۵˴ϴ�.
				</div>
<?php }?>
				</div>
			</div>
			</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["phone"]){?>
			<div class="input_wrap">
			<div class="input_title"><?php if($GLOBALS["checked_mobile"]["reqField"]["phone"]){?><?php }?>��ȭ��ȣ</div>

			<div class="input_content">
				<input type="number"  placeholder="Enter Text" pattern="[0-9]*" name="phone[]" size="3" maxlength="3" onKeyPress="javascript:onlyNum(this, event);" class="w30" style="ime-mode:disabled" label="��ȭ��ȣ" <?php if($GLOBALS["checked_mobile"]["reqField"]["phone"]){?>required<?php }?>/> -
				<input type="number"  placeholder="Enter Text" pattern="[0-9]*" name="phone[]" size="4" maxlength="4" onKeyPress="javascript:onlyNum(this, event);" class="w40" style="ime-mode:disabled" label="��ȭ��ȣ" <?php if($GLOBALS["checked_mobile"]["reqField"]["phone"]){?>required<?php }?>/> -
				<input type="number"  placeholder="Enter Text" pattern="[0-9]*" name="phone[]" size="4" maxlength="4" onKeyPress="javascript:onlyNum(this, event);" class="w40" style="ime-mode:disabled" label="��ȭ��ȣ" <?php if($GLOBALS["checked_mobile"]["reqField"]["phone"]){?>required<?php }?>/>
			</div>
			</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["fax"]){?>
			<div class="input_wrap">
			<div class="input_title"><?php if($GLOBALS["checked_mobile"]["reqField"]["fax"]){?><?php }?>�ѽ�</div>

			<div class="input_content">
				<input type="number"  placeholder="Enter Text" pattern="[0-9]*" name="fax[]" size="3" maxlength="3" onKeyPress="javascript:onlyNum(this, event);" class="w30" style="ime-mode:disabled" label="�ѽ�" <?php if($GLOBALS["checked_mobile"]["reqField"]["fax"]){?>required<?php }?>/> -
				<input type="number"  placeholder="Enter Text" pattern="[0-9]*" name="fax[]" size="4" maxlength="4" onKeyPress="javascript:onlyNum(this, event);" class="w40" style="ime-mode:disabled" label="�ѽ�" <?php if($GLOBALS["checked_mobile"]["reqField"]["fax"]){?>required<?php }?>/> -
				<input type="number"  placeholder="Enter Text" pattern="[0-9]*" name="fax[]" size="4" maxlength="4" onKeyPress="javascript:onlyNum(this, event);" class="w40" style="ime-mode:disabled" label="�ѽ�" <?php if($GLOBALS["checked_mobile"]["reqField"]["fax"]){?>required<?php }?>/>
			</div>
			</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["company"]){?>
			<div class="input_wrap">
			<div class="input_title"><?php if($GLOBALS["checked_mobile"]["reqField"]["fax"]){?><?php }?>ȸ��</div>

			<div class="input_content">
				<input type="text" name="company" size="17" maxlength="10" class="wp100" style="ime-mode:active" label="ȸ��" <?php if($GLOBALS["checked_mobile"]["reqField"]["company"]){?>required<?php }?>/>
			</div>
			</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["service"]){?>
			<div class="input_wrap">
			<div class="input_title"><?php if($GLOBALS["checked_mobile"]["reqField"]["service"]){?><?php }?>����</div>

			<div class="input_content">
				<input type="text" name="service" size="17" maxlength="20" class="wp100" style="ime-mode:active" label="����"  <?php if($GLOBALS["checked_mobile"]["reqField"]["service"]){?>required<?php }?> />
			</div>
			</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["item"]){?>
			<div class="input_wrap">
			<div class="input_title"><?php if($GLOBALS["checked_mobile"]["reqField"]["item"]){?><?php }?>����</div>

			<div class="input_content">
				<input type="text" name="item" size="17" maxlength="20" class="wp100" style="ime-mode:active" label="����" <?php if($GLOBALS["checked_mobile"]["reqField"]["item"]){?>required<?php }?>/>
			</div>
			</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["busino"]){?>
			<div class="input_wrap">
			<div class="input_title"><?php if($GLOBALS["checked_mobile"]["reqField"]["busino"]){?><?php }?>����ڹ�ȣ</div>

			<div class="input_content">
				<input type="number" name="busino" size="13" maxlength="11" class="wp100" style="ime-mode:active" label="����ڹ�ȣ" <?php if($GLOBALS["checked_mobile"]["reqField"]["busino"]){?>required<?php }?>/>
			</div>
			</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["job"]){?>
			<div class="input_wrap">
			<div class="input_title"><?php if($GLOBALS["checked_mobile"]["reqField"]["job"]){?><?php }?>����</div>

			<div class="input_content">
				<select name="job" class="wp100" label="����" <?php if($GLOBALS["checked_mobile"]["reqField"]["job"]){?>required<?php }?>>
					<option value="">==�����ϼ���==
<?php if((is_array($TPL_R1=codeitem('job'))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_K1=>$TPL_V1){?>
					<option value="<?php echo $TPL_K1?>" <?php echo $GLOBALS["selected"]["job"][$TPL_K1]?>><?php echo $TPL_V1?>

<?php }}?>
				</select>
			</div>
			</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["interest"]){?>
			<div class="input_wrap">
			<div class="input_title"><?php if($GLOBALS["checked_mobile"]["reqField"]["interest"]){?><?php }?>���ɺо�</div>

			<div class="input_content">
<?php if((is_array($TPL_R1=codeitem('like'))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_K1=>$TPL_V1){?>
				<input type="checkbox" name="interest[]" value="<?php echo pow( 2,$TPL_K1+ 0)?>" label="���ɺо�" <?php if($GLOBALS["checked_mobile"]["reqField"]["interest"]){?>required<?php }?>/> <?php echo $TPL_V1?><br />
<?php }}?>
			</div>
			</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["ex1"]){?>
			<div class="input_wrap">
			<div class="input_title"><?php if($GLOBALS["checked_mobile"]["reqField"]["ex1"]){?><?php }?><?php echo $GLOBALS["joinset"]["ex1"]?></div>

			<div class="input_content">
				<input type="text" name="ex1" size="17" maxlength="20" class="wp100" style="ime-mode:active" label="<?php echo $GLOBALS["joinset"]["ex1"]?>" <?php if($GLOBALS["checked_mobile"]["reqField"]["ex1"]){?>required<?php }?>/>
			</div>
			</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["ex2"]){?>
			<div class="input_wrap">
			<div class="input_title"><?php if($GLOBALS["checked_mobile"]["reqField"]["ex2"]){?>--<?php }?><?php echo $GLOBALS["joinset"]["ex2"]?></div>

			<div class="input_content">
				<input type="text" name="ex2" size="17" maxlength="20" class="wp100" style="ime-mode:active" label="<?php echo $GLOBALS["joinset"]["ex2"]?>" <?php if($GLOBALS["checked_mobile"]["reqField"]["ex2"]){?>required<?php }?>/>
			</div>
			</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["ex3"]){?>
			<div class="input_wrap">
			<div class="input_title"><?php if($GLOBALS["checked_mobile"]["reqField"]["ex3"]){?><?php }?><?php echo $GLOBALS["joinset"]["ex3"]?></div>

			<div class="input_content">
				<input type="text" name="ex3" size="17" maxlength="20" class="wp100" style="ime-mode:active" label="<?php echo $GLOBALS["joinset"]["ex3"]?>" <?php if($GLOBALS["checked_mobile"]["reqField"]["ex3"]){?>required<?php }?>/>
			</div>
			</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["ex4"]){?>
			<div class="input_wrap">
			<div class="input_title"><?php if($GLOBALS["checked_mobile"]["reqField"]["ex4"]){?><?php }?><?php echo $GLOBALS["joinset"]["ex4"]?></div>

			<div class="input_content">
				<input type="text" name="ex4" size="17" maxlength="20" class="wp100" style="ime-mode:active" label="<?php echo $GLOBALS["joinset"]["ex4"]?>" <?php if($GLOBALS["checked_mobile"]["reqField"]["ex4"]){?>required<?php }?>/>
			</div>
			</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["ex5"]){?>
			<div class="input_wrap">
			<div class="input_title"><?php if($GLOBALS["checked_mobile"]["reqField"]["ex5"]){?><?php }?><?php echo $GLOBALS["joinset"]["ex5"]?></div>

			<div class="input_content">
				<input type="text" name="ex5" size="17" maxlength="20" class="wp100" style="ime-mode:active" label="<?php echo $GLOBALS["joinset"]["ex5"]?>" <?php if($GLOBALS["checked_mobile"]["reqField"]["ex5"]){?>required<?php }?>/>
			</div>
			</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["ex6"]){?>
			<div class="input_wrap">
			<div class="input_title"><?php if($GLOBALS["checked_mobile"]["reqField"]["ex6"]){?><?php }?><?php echo $GLOBALS["joinset"]["ex6"]?></div>

			<div class="input_content">
				<input type="text" name="ex6" size="17" maxlength="20" class="wp100" style="ime-mode:active" label="<?php echo $GLOBALS["joinset"]["ex6"]?>" <?php if($GLOBALS["checked_mobile"]["reqField"]["ex6"]){?>required<?php }?>/>
			</div>
			</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["interest_category"]){?>
			<div class="input_wrap">
			<div class="input_title"><?php if($GLOBALS["checked_mobile"]["reqField"]["interest_category"]){?><?php }?>���ɺз�</div>

			<div class="input_content">
				<select name="interest_category" label="���ɺз�" <?php if($GLOBALS["checked_mobile"]["reqField"]["interest_category"]){?>required<?php }?>>
					<option value="">==�����ϼ���==
<?php if($TPL_ts_category_all_1){foreach($TPL_VAR["ts_category_all"] as $TPL_K1=>$TPL_V1){?>
					<option value="<?php echo $TPL_V1["category"]?>" <?php echo $GLOBALS["selected"]["interest_category"][$TPL_K1]?>><?php echo $TPL_V1["catnm"]?>

<?php }}?>
				</select>
			</div>
			</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["memo"]){?>
			<div class="input_wrap">
			<div class="input_title"><?php if($GLOBALS["checked_mobile"]["reqField"]["memo"]){?><?php }?>����� ����</div>

			<div class="input_content">
				<input type="text" name="memo" size="17" class="wp100" style="ime-mode:active" label="����¸���" <?php if($GLOBALS["checked_mobile"]["reqField"]["memo"]){?>required<?php }?>/>
			</div>
			</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["recommid"]){?>
			<div class="input_wrap">
			<div class="input_title"><?php if($GLOBALS["checked_mobile"]["reqField"]["recommid"]){?><?php }?>��õ�ξ��̵�</div>

			<div class="input_content">
				<input type="text" name="recommid" size="18" class="wp100" style="ime-mode:active" label="��õ�ξ��̵�" <?php if($GLOBALS["checked_mobile"]["reqField"]["recommid"]){?>required<?php }?>/>
			</div>
			</div>
<?php }?>
		</div>

	</div>
	<div class="step_btn">
		<div class="next_btn"><button id="next-btn" tabindex="5" onclick="javascript:nextStep();return false;">�����ܰ�</button></div>
		<div class="cancel_btn"><button id="cancel-btn" tabindex="5" onclick="javascript:location.href='/'+mobile_root+'/index.php';return false;">�������</button></div>
	</div>
</form>
</section>

<?php $this->print_("footer",$TPL_SCP,1);?>