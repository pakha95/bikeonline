<?php /* Template_ 2.2.7 2016/07/13 19:56:16 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/mem/find_password.htm 000002917 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>

<?php  $TPL_VAR["page_title"] = "��й�ȣ ã��";?>
<?php $this->print_("sub_header",$TPL_SCP,1);?>


<section class="find_common_layout">
	<form name="find_password_form" id="find_password_form" method="post">
	<input type="hidden" name="m_id" value="" />
	<input type="hidden" name="token" value="" />
	<input type="hidden" name="otpType" value="" />
		<fieldset>
			<div class="find_common_center">
				<div class="find_common_title">ȸ�������� ã��</div>
				<label for="srch_id">
					<input type="text" name="srch_id" id="srch_id" value="" title="���̵�" required="required" msgR="���̵� �Է��ϼ���." placeholder="���̵�" tabindex="1" />
				</label>
				<label for="srch_name">
					<input type="text" name="srch_name" id="srch_name" value="" title="�̸�" required="required" msgR="�̸��� �Է��ϼ���."  placeholder="�̸�" tabindex="2" />
				</label>
<?php if($TPL_VAR["use_choice_mail"]=='y'){?>
				<label for="srch_mail">
					<input type="email" name="srch_mail" id="srch_mail" value="" title="���� �����ּ�" required="required" msgR="���� �����ּҸ� �Է��ϼ���." placeholder="���� �����ּ�" tabindex="3" />
				</label>
				<div class="find_common_step_btn"><button id="find_password_email_btn" type="button" tabindex="4">ȸ�������� ��ϵ� �̸��Ϸ� ����</button></div>
<?php }?>
<?php if($TPL_VAR["use_choice_hp"]=='y'){?>
				<div class="find_common_step_btn"><button id="find_password_hpauth_btn" type="button" tabindex="5">ȸ�������� ��ϵ� �޴������� ����</button></div>
<?php }?>
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

<script src="<?php echo $GLOBALS["mobileRootDir"]?>/lib/js/godo.password_finder.js?ver=20160225"></script>
<script type="text/javascript">
var passwordFinder = new passwordFinder();

$(document).ready(function(){
	$("#find_password_email_btn").bind("click", function(){
		if(check_find_password_form() === true){
			passwordFinder.setToken('mail', $("#srch_id").val(), $("#srch_name").val(), $("#srch_mail").val());
		};
	});
	$("#find_password_hpauth_btn").bind("click", function(){
		if(check_find_password_form() === true){
			passwordFinder.setToken('mobile', $("#srch_id").val(), $("#srch_name").val(), $("#srch_mail").val());
		};
	});

	function check_find_password_form()
	{
		return chkForm(document.find_password_form);
	}
});
</script>

<?php $this->print_("footer",$TPL_SCP,1);?>