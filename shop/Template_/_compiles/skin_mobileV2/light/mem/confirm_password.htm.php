<?php /* Template_ 2.2.7 2016/01/20 13:32:04 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/mem/confirm_password.htm 000002751 */ ?>
<style rel="stylesheet" type="text/css">
	#page_title .top_subtitle { height:30px; border-bottom:solid 1px #dddde1; padding:10px 0; line-height:30px; font-weight:bold; font-size:14px; text-align:center; font-family:dotum; }
	.top_subtitle_btm { height:100%; border-bottom:solid 1px #dddde1; padding-left:10px; margin-bottom:15px; line-height:30px; font-size:14px; text-align:center; }
	section#confirmPwd { padding-top:10px; }
	section#confirmPwd .input_wrap { clear:both; }
	section#confirmPwd input[type=text], input[type=number], input[type=email], input[type=password] { border-radius:3px; border:solid 1px #aeaeaf; height:30px; width:90%; }
	section#confirmPwd .input_title { width:25%; padding-left:5%; min-width:80px; font-size:13px; color:#222222; float:left; height:30px; line-height:30px; }
	section#confirmPwd .input_content { width:70%; font-size:14px; float:left; line-height:30px; margin-bottom:11px; }
	section#confirmPwd .confirm_btn { clear:both; width:100%; text-align:center; }
	section#confirmPwd .confirm_btn button { width:45%; min-width:60px; text-align:center; height:35px; color:#FFFFFF; line-height:35px; font-size:15px; font-weight:bold; background:#808591; border-radius:4px; font-family:dotum; border:none; }
</style>
<script type="text/javascript">
	$(function () {
		$("#next-btn").click(function () {
			var pwd = $("input[name=password]");
			if(pwd.val() == "") {
				alert("��й�ȣ�� Ȯ�����ּ���.");
				pwd.focus();
				return false;
			}
		});
		$("#cancel-btn").click(function () {
			location.href = "../myp/menu_list.php";
			return false;
		});
	});
</script>

<section id="page_title">
	<div class="top_subtitle">��й�ȣ ��Ȯ��</div>
	<div class="top_subtitle_btm">ȸ������ ������ �����ϰ� ��ȣ �ϱ� ����<Br />��й�ȣ�� �ٽ� �ѹ� Ȯ�� �� �ּ���.</div>
</section>
<section class="content" id="confirmPwd">
<form id="form" name="frmAgree" method="post" action="indb.php">
	<input type="hidden" name="mode" value="confirm_password" />
	<input type="hidden" name="type" />
	<div class="confirm_pwd">
		<div class="input_wrap">
			<div class="input_title">���̵�</div>
			<div class="input_content"><?php echo $TPL_VAR["m_id"]?></div>
		</div>
		<div class="input_wrap">
			<div class="input_title">��й�ȣ</div>
			<div class="input_content"><input type="password" name="password" size="13" maxlength="16" class="wp100" style="ime-mode:disabled" /></div>
		</div>
		<div class="confirm_btn">
			<button id="next-btn" />Ȯ��</button>
			<button id="cancel-btn" />���</button>
		</div>
	</div>
</form>
</section>