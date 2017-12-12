<?php /* Template_ 2.2.7 2016/07/13 19:55:45 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/mem/change_password.htm 000004845 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>

<?php  $TPL_VAR["page_title"] = "��й�ȣ ã��";?>
<?php $this->print_("sub_header",$TPL_SCP,1);?>


<style rel="stylesheet" type="text/css">
div.passwordStrenth { display:none; margin-top: 5px; }
div.passwordStrenth dl { margin:0; padding:0 6px 0 0; color:#373737; font-weight:bold; font-size:11px; font-family:dotum; }
div.passwordStrenth dl dt, div.passwordStrenth dl dd { display:inline; font-size:11px; font-family:dotum; margin:0; height:15px; line-height:15px; }
div.passwordStrenth dl dt { color:#363636; font-weight:bold; width:95px; }
div.passwordStrenth dl dd.lv0 { color:#F52D00; }
div.passwordStrenth dl dd.lv1 { color:#028EFF; }
div.passwordStrenth dl dd.lv2 { color:#0213FF; }
div.passwordStrenth dl dd.lv3, div.passwordStrenth dl dd.lv4 { color:#46C32D; }
</style>

<section class="find_common_layout">
	<fieldset>
		<div class="find_common_center">
			<div class="find_common_title">��й�ȣ �缳��</div>
			<div class="find_password_message">���ο� ��й�ȣ�� ������ּ���</div>
			<label for="newPassword">
				<input type="password" name="newPassword" id="newPassword" maxlength="16" title="�� ��й�ȣ" required="required" placeholder="�� ��й�ȣ" tabindex="1" />
				<div class="passwordStrenth" id="el-password-strength-indicator">
				<dl>
					<dt>��й�ȣ ������</dt>
					<dd id="el-password-strength-indicator-level"></dd>
				</dl>
				</div>
				<div class="find_password_message_input" id="el-password-strength-indicator-msg">��й�ȣ�� 10 ~ 16�� ���� �Է��� �ּ���.</div>
			</label>
			<label for="confirmPassword">
				<input type="password" name="confirmPassword" id="confirmPassword" maxlength="16" title="�� ��й�ȣ Ȯ��" required="required" placeholder="�� ��й�ȣ Ȯ��" tabindex="1" />
				<div class="find_password_message_input" id="pwd_description">��й�ȣ ��ġ���� �ʽ��ϴ�.</div>
			</label>
			<div class="find_common_step_btn"><button id="find_password_change_btn" type="button" tabindex="5">��й�ȣ �缳��</button></div>
		</div>
	</fieldset>

	<div class="find_common_bottom_center">
		<div class="find_common_bottom_btn">
			<button id="login_btn" tabindex="5" onclick="javascript:location.replace('./login.php');">�α���</button>
			<button id="find_password_btn" tabindex="5" onclick="javascript:location.replace('./find_id.php');">���̵� ã��</button>
		</div>
	</div>
</section>

<script src="/shop/data/skin_mobileV2/light/godo.password_strength.js" type="text/javascript"></script>
<script src="<?php echo $GLOBALS["mobileRootDir"]?>/lib/js/godo.password_finder.js?ver=20160225"></script>
<script type="text/javascript">
var passwordFinder = new passwordFinder();

$(document).ready(function(){
	$('#find_password_change_btn').click(function(){
		var newPassword = $('#newPassword');
		var confirmPassword = $('#confirmPassword');

		if(!newPassword.val()) {
			alert("�� ��й�ȣ�� �Է��� �ּ���.");
			newPassword.focus();
			return;
		}
		if(!confirmPassword.val()){
			alert("�� ��й�ȣ Ȯ���� �Է��� �ּ���.");
			confirmPassword.focus();
			return;
		}

		var newPasswordLength = newPassword.val().length;
		if(newPasswordLength < 10 || newPasswordLength > 16){
			alert("��й�ȣ�� 10 ~ 16�� ���� �Է��� �ּ���.");
			newPassword.focus();
			return;
		}
		if(newPassword.val() != confirmPassword.val()){
			alert("�� ��й�ȣ�� �����ȣ Ȯ���� ��ġ���� �ʽ��ϴ�.");
			confirmPassword.focus();
			return;
		}

		passwordFinder.changePwd('<?php echo $_POST["token"]?>', '<?php echo $_POST["m_id"]?>', newPassword.val());
	});

	$("#newPassword").bind("focus keyup", function(){
		if(this.value) {
			var result = nsGodo_PasswordStrength.check(this);
			$("#el-password-strength-indicator-msg").html(result.msg);
			$("#el-password-strength-indicator-level").attr('class', "lv" + result.level).html(result.levelText);
			$("#el-password-strength-indicator").attr("style", "display:block");
		}
		else {
			emptyPwState();
		}
	});
	$("#newPassword").blur(function(){
		emptyPwState();
	});

	$("#confirmPassword").keyup(function () {
		$c_pwd = $(this).val();
		if($("#newPassword").val() != $c_pwd) {
			$("input[name=pwd_chk]").val("n");
			$("#pwd_description").text("��й�ȣ�� ��ġ���� �ʽ��ϴ�.");
			$("#pwd_description").addClass("wrong");
		} else {
			$("input[name=pwd_chk]").val("y");
			$("#pwd_description").text("��й�ȣ�� ��ġ�մϴ�.");
			$("#pwd_description").removeClass("wrong");
		}
	});

	function emptyPwState() {
		$("#el-password-strength-indicator").attr("style", "display:none");
	}

});
</script>

<?php $this->print_("footer",$TPL_SCP,1);?>