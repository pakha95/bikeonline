<?php /* Template_ 2.2.7 2015/11/16 15:26:49 /www/jbsinttr8192_godo_co_kr/shop/data/skin/damoashop/proc/intro_auth_login.htm 000001445 */ ?>
<form method=post action="<?php echo $TPL_VAR["loginActionUrl"]?>" id=form name=form>
	<div class="form">

		<h4>ȸ�� �α���</h4>
		<input type="hidden" name="returnUrl" value="<?php echo $GLOBALS["returnUrl"]?>">

		<!-- �������� -->
		<div id="auth">
			<table>
				<tr>
					<td style="vertical-align:top"><input type=text class="fld" name=m_id size=20 placeholder="���̵� �Է��ϼ���." tabindex=5></td>
					<td rowspan=2 class=noline><button alt="�α���" class="btn-login">�α���</button></td>
				</tr>
				<tr>
					<td style="vertical-align:top"><input type=password class="fld" name=password size=20 placeholder="��й�ȣ�� �Է��ϼ���." tabindex=6></td>
				</tr>
			</table>
		</div>
	</div>
</form>

<style>
div.body div.forms-wrap {width:360px;}
div#auth input.fld {font-family:'Malgun Gothic';font-size:15px;color:#000000;width:214px;height:44px;    float: left;cursor:pointer;display:table-cell;vertical-align:middle;margin-right:10px;border:1px solid #d3d3d3;padding-left:10px;padding-right:10px;}
button.btn-login {font-weight:bold;font-family:'Malgun Gothic';font-size:15px;color:#ffffff;width:110px;height:110px;    float: left;background:#a3a3a3;cursor:pointer;display:table-cell;vertical-align:middle;margin-bottom:10px;margin-right:10px;border:0;}
</style>