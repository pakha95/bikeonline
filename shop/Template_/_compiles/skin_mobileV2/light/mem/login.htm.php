<?php /* Template_ 2.2.7 2016/07/13 19:51:51 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/mem/login.htm 000003340 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>

<?php  $TPL_VAR["page_title"] = "�α���";?>
<?php $this->print_("sub_header",$TPL_SCP,1);?>

<section class="content <?php echo $TPL_VAR["csslight"]?>" id="login">
	<form name="login_form" action="<?php echo $TPL_VAR["loginActionUrl"]?>" method="post" onSubmit="chk_save(this);return chkForm(this);">
	<input type=hidden name=returnUrl value="<?php echo $GLOBALS["returnUrl"]?>">
	<input type=hidden name=close value="<?php echo $GLOBALS["close"]?>">
		<fieldset>
			<legend class="hidden">�α��� ��</legend>
			<div class="login_center">
			<div class="login_b">
				<div class="login_title">ȸ���α���</div>
				<label class="input_id">
					<span class="hidden">���̵�</span>
					<input type="text" name="m_id" value="" maxlength="12" title="���̵�" required="required" msgR="���̵� �Է��ϼ���." onfocus="if(this.value=='ȸ�����̵�'){this.value='';}" placeholder="���̵�" tabindex="1" />
				</label>
				<label class="input_pw">
					<span class="hidden">��й�ȣ</span>
					<input type="password" name="password" maxlength="34" title="��й�ȣ" required="required" msgR="��й�ȣ�� �Է��ϼ���." placeholder="��й�ȣ" tabindex="2" />
				</label>
				<label class="save_login_status"><input type="checkbox" name="save_login_status" value="y" tabindex="3" /> �ڵ��α���</label>
				<label class="save_id"><input type="checkbox" name="save_id" value="y" onclick="chk_save_id(this.checked);" tabindex="4" /> ���̵� ����</label>
				<div class="login_btn"><button id="login-btn" type="submit" tabindex="5" >�α���</button></div>
				<div class="find_id_password">
					<div class="find_id" onclick="javascript:location.href='./find_id.php';">���̵� ã��</div>
					<div class="find_partition">|</div>
					<div class="find_password" onclick="javascript:location.href='./find_password.php';">��й�ȣ ã��</div>
				</div>

<?php if($TPL_VAR["SocialMemberEnabled"]){?>
				<div class="sns-account">
					<div class="login-title">SNS ���� �α���</div>
<?php if($TPL_VAR["FacebookLoginURL"]){?>
					<button type="button" class="login-facebook" onclick="javascript:location.replace('<?php echo $TPL_VAR["FacebookLoginURL"]?>');return false;">���̽���</button>
<?php }?>
				</div>
<?php }?>

<?php if($_GET["guest"]){?>
				<div class="nomember_btn"><button id="nomember-btn" tabindex="5" onclick="javascript:location.replace('../ord/order.php?guest=1');return false;">��ȸ�� �ֹ�</button></div>
<?php }else{?>
				<div class="nomember_btn"><button id="nomember-btn" tabindex="5" onclick="javascript:location.replace('./nomember_order.php');return false;">��ȸ�� �ֹ�Ȯ��</button></div>
<?php }?>
				<div class="joinmember_btn"><button id="joinmember-btn" tabindex="5" onclick="javascript:location.replace('./join.php'); return false;">ȸ������</button></div>
			</div>
			</div>
		</fieldset>
	</form>
</section>

<script language="javascript">var shop_key = "<?php echo $_SERVER['HTTP_HOST'];?>";</script>
<script src="/shop/data/skin_mobileV2/light/common/js/base64.js"></script>
<script src="/shop/data/skin_mobileV2/light/common/js/login.js"></script>

<?php $this->print_("footer",$TPL_SCP,1);?>