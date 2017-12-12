<?php /* Template_ 2.2.7 2016/07/13 19:56:25 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/mem/find_password_auth.htm 000002587 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>

<?php  $TPL_VAR["page_title"] = "��й�ȣ ã��";?>
<?php $this->print_("sub_header",$TPL_SCP,1);?>


<section class="find_common_layout">
	<form name="find_password_auth_form" id="find_password_auth_form" method="post">
	<input type="hidden" name="m_id" value="<?php echo $TPL_VAR["m_id"]?>" />
	<input type="hidden" name="token" value="<?php echo $TPL_VAR["token"]?>" />
		<fieldset>
			<div class="find_common_center">
				<div class="find_common_title">������ȣ �Է�</div>
				<div class="find_password_message"><?php echo $TPL_VAR["message"]?></div>
				<label for="certKey">
					<input type="number" name="certKey" id="certKey" value="" title="������ȣ" required="required" maxlength="8" placeholder="������ȣ" tabindex="1" />
				</label>
				<div class="find_common_step_btn"><button id="find_password_certKey_btn" type="button" tabindex="5">����</button></div>
				<div class="find_password_auth_resend">������ȣ�� ���� �ʾҳ���? <span id="otpResend">������ȣ ������</span></div>
			</div>
		</fieldset>
	</form>

	<div class="find_common_bottom_center">
		<div class="find_common_bottom_btn">
			<button id="login_btn" tabindex="5" onclick="javascript:location.replace('./login.php');">�α���</button>
			<button id="find_password_btn" tabindex="5" onclick="javascript:location.replace('./find_id.php');">���̵� ã��</button>
		</div>
	</div>
</section>

<script type="text/javascript" src="<?php echo $GLOBALS["mobileRootDir"]?>/lib/js/godo.password_finder.js?ver=20160225"></script>
<script type="text/javascript">
var passwordFinder = new passwordFinder();

$(document).ready(function(){
	var token = $("#find_password_auth_form input[name='token']").val();
	var m_id = $("#find_password_auth_form input[name='m_id']").val();

	$("#otpResend").bind("click", function(){
		if(confirm("������ȣ�� ������ �Ͻðڽ��ϱ�?\n\n�� ������ȣ�� �������Ͻø�\n������ ���۵Ǿ��� ������ȣ�� ����Ͻ� �� �����ϴ�.")) {
			passwordFinder.resendOTP('<?php echo $TPL_VAR["otpType"]?>', token, m_id);
		}
	});
	$("#find_password_certKey_btn").bind("click", function(){
		if(!$("#certKey").val() || $("#certKey").val().length < 8){
			alert("������ȣ�� ��Ȯ�� �Է��� �ּ���.");
			$("#certKey").focus();
			return;
		}

		passwordFinder.compareOTP(token, m_id, $("#certKey").val());
	});
});
</script>

<?php $this->print_("footer",$TPL_SCP,1);?>