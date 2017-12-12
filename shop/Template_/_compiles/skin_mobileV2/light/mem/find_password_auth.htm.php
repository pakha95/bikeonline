<?php /* Template_ 2.2.7 2016/07/13 19:56:25 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/mem/find_password_auth.htm 000002587 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>

<?php  $TPL_VAR["page_title"] = "비밀번호 찾기";?>
<?php $this->print_("sub_header",$TPL_SCP,1);?>


<section class="find_common_layout">
	<form name="find_password_auth_form" id="find_password_auth_form" method="post">
	<input type="hidden" name="m_id" value="<?php echo $TPL_VAR["m_id"]?>" />
	<input type="hidden" name="token" value="<?php echo $TPL_VAR["token"]?>" />
		<fieldset>
			<div class="find_common_center">
				<div class="find_common_title">인증번호 입력</div>
				<div class="find_password_message"><?php echo $TPL_VAR["message"]?></div>
				<label for="certKey">
					<input type="number" name="certKey" id="certKey" value="" title="인증번호" required="required" maxlength="8" placeholder="인증번호" tabindex="1" />
				</label>
				<div class="find_common_step_btn"><button id="find_password_certKey_btn" type="button" tabindex="5">다음</button></div>
				<div class="find_password_auth_resend">인증번호가 오지 않았나요? <span id="otpResend">인증번호 재전송</span></div>
			</div>
		</fieldset>
	</form>

	<div class="find_common_bottom_center">
		<div class="find_common_bottom_btn">
			<button id="login_btn" tabindex="5" onclick="javascript:location.replace('./login.php');">로그인</button>
			<button id="find_password_btn" tabindex="5" onclick="javascript:location.replace('./find_id.php');">아이디 찾기</button>
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
		if(confirm("인증번호를 재전송 하시겠습니까?\n\n※ 인증번호를 재전송하시면\n이전에 전송되었던 인증번호는 사용하실 수 없습니다.")) {
			passwordFinder.resendOTP('<?php echo $TPL_VAR["otpType"]?>', token, m_id);
		}
	});
	$("#find_password_certKey_btn").bind("click", function(){
		if(!$("#certKey").val() || $("#certKey").val().length < 8){
			alert("인증번호를 정확히 입력해 주세요.");
			$("#certKey").focus();
			return;
		}

		passwordFinder.compareOTP(token, m_id, $("#certKey").val());
	});
});
</script>

<?php $this->print_("footer",$TPL_SCP,1);?>