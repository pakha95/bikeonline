<?php /* Template_ 2.2.7 2014/06/02 14:14:40 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/mem/join_type.htm 000001471 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>

<?php  $TPL_VAR["page_title"] = "ȸ�����Թ��";?>
<?php $this->print_("sub_header",$TPL_SCP,1);?>

<section class="member-join">
	<form name="login_form" action="login_ok.php" method="post" onSubmit="chk_save(this);return chkForm(this);">
	<input type=hidden name=returnUrl value="<?php echo $GLOBALS["returnUrl"]?>">
	<input type=hidden name=close value="<?php echo $GLOBALS["close"]?>">
<?php if($TPL_VAR["SocialMemberEnabled"]){?>
	<div class="sns-account">
		<div class="login-title">SNS �������� �����ϱ�</div>
<?php if($TPL_VAR["FacebookLoginURL"]){?>
		<button type="button" class="login-facebook" onclick="javascript:location.replace('<?php echo $TPL_VAR["FacebookLoginURL"]?>');return false;">���̽���</button>
<?php }?>
	</div>
<?php }?>
	<div class="mall-join">
		<div class="login-title">���θ� ���� �����ϱ�</div>
		<button type="button" onclick="javascript:location.href='./join.php?MODE=agreement';return false;">���θ�</button>
	</div>
	</form>
</section>

<script language="javascript">var shop_key = "<?php echo $_SERVER['HTTP_HOST'];?>";</script>
<script src="/shop/data/skin_mobileV2/light/common/js/base64.js"></script>
<script src="/shop/data/skin_mobileV2/light/common/js/login.js"></script>

<?php $this->print_("footer",$TPL_SCP,1);?>