<?php /* Template_ 2.2.7 2015/01/28 16:49:46 /www/jbsinttr8192_godo_co_kr/shop/data/skin/damoashop/member/confirm_social_member.htm 000001793 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>


<style type="text/css">
.indiv {
	text-align: center;
}
button.btn {
	cursor: pointer;
	border: none;
	font-size: 0;
}
#sns-confirm {
	margin-top: 30px;
}
#sns-confirm div.outer-border {
	border: 1px solid #dedede;
}
#sns-confirm div.inner-border {
	border: 4px solid #f3f3f3;
	color: #404040;
	padding: 33px 0px;
	text-align: center;
}
#sns-confirm button.btn-facebook {
	width: 125px;
	height: 31px;
	background: url('/shop/data/skin/damoashop/img/login_sns_<?php echo strtolower($TPL_VAR["SocialCode"])?>.gif') no-repeat;
}
#sns-confirm div.sns-confirm-description {
	margin-top: 20px;
}
</style>

<!-- ����̹��� || ������ġ -->
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td><img src="/shop/data/skin/damoashop/img/common/title_modifyinfo.gif" border="0"></td>
	</tr>
	<tr>
		<td class="path">HOME > ���������� > <strong>ȸ����������</strong></td>
	</tr>
</table>


<div class="indiv"><!-- Start indiv -->

	<h2>SNS���� ������</h2>
	<div>
		<strong>ȸ������ ������ �����ϰ� ��ȣ</strong>�ϱ� ���Ͽ� <strong>ȸ�� ���������� ������</strong>�� �ʿ��մϴ�.
	</div>

	<div id="sns-confirm">
		<div class="outer-border">
			<div class="inner-border">
				<button class="btn btn-facebook" onclick="popup('<?php echo $TPL_VAR["SocialConfirmMemberURL"]?>', 400, 300);">���̽���</button>
				<div class="sns-confirm-description">
					ȸ�� ������ �������� ���Ͽ� �α��� �Ǿ� �ִ� SNS�� Ŭ���� �ּ���.
				</div>
			</div>
		</div>
	</div>

</div><!-- End indiv -->

<?php $this->print_("footer",$TPL_SCP,1);?>