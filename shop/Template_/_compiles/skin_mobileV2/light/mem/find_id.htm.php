<?php /* Template_ 2.2.7 2016/07/13 19:56:01 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/mem/find_id.htm 000004122 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>

<?php  $TPL_VAR["page_title"] = "���̵� ã��";?>
<?php $this->print_("sub_header",$TPL_SCP,1);?>


<section class="find_common_layout">
<?php if($TPL_VAR["act"]=='Y'&&$GLOBALS["m_id"]){?>
		<div class="find_common_center">
			<div class="find_id_info"><span><?php echo $GLOBALS["name"]?></span> ȸ������ ���̵�� <span><?php echo $GLOBALS["m_id"]?></span> �Դϴ�.</div>
		</div>
<?php }else{?>
		<form name="fm" id="fm" action="" method="post" onsubmit="return chkForm(this);">
		<input type="hidden" name="act" value="Y">
		<input type="hidden" name="rncheck" value="none">
		<input type="hidden" name="dupeinfo" value="">
			<fieldset>
				<div class="find_common_center">
					<div class="find_common_title">ȸ�������� ã��</div>
					<label for="srch_name">
						<input type="text" name="srch_name" id="srch_name" value="" title="�̸�" required="required" msgR="�̸��� �Է��ϼ���." placeholder="�̸�" tabindex="1" />
					</label>
<?php if($GLOBALS["checked"]["useField"]["email"]){?>
					<label for="srch_mail">
						<input type="email" name="srch_mail" id="srch_mail" value="" title="���� �����ּ�" option=regEmail label="���� �����ּ�" required="required" msgR="���� �����ּҸ� �Է��ϼ���." placeholder="���� �����ּ�" tabindex="1" class="find_common_margin_bottom" />
					</label>
<?php }?>
					<div class="find_common_step_btn"><button id="find_id_btn" type="submit" tabindex="5">ã��</button></div>

<?php if($TPL_VAR["ipinType"]||$TPL_VAR["hpauthyn"]=='y'){?>
					<div class="find_id_authentication">
						<div class="authentication-title">ȸ������ �� ����� �������� �������� ã��</div>

<?php if($TPL_VAR["ipinType"]=='ipin'||$TPL_VAR["ipinType"]=='niceipin'){?>
						<button type="button" id="find_id_ipin">������ ����</button>
						<iframe id="ifrmRnCheck" name="ifrmRnCheck" style="width:500px;height:500px;display:none;"></iframe>
<?php }?>

<?php if($TPL_VAR["hpauthyn"]=='y'){?>
						<button type="button" id="find_id_hpauth">�޴��� ����</button>
<?php }?>

					</div>
<?php }?>
				</div>
			</fieldset>
		</form>
<?php }?>

	<div class="find_common_bottom_center">
		<div class="find_common_bottom_btn">
			<button id="login_btn" tabindex="5" onclick="javascript:location.replace('./login.php');">�α���</button>
			<button id="find_password_btn" tabindex="5" onclick="javascript:location.replace('./find_password.php');">��й�ȣ ã��</button>
		</div>
	</div>
</section>

<script type="text/javascript">
$(document).ready(function(){
	var act = '<?php echo $TPL_VAR["act"]?>';
	if(act == 'Y'){
		var resultID = '<?php echo $GLOBALS["m_id"]?>';
		if(!resultID){
			alert("�Է��Ͻ� ������ ȸ�������� ã�� �� �����ϴ�.\n������ ��Ȯ���� Ȯ�� �� �ٽ� �õ��� �ּ���");
		}
	}

	//������
	$("#find_id_ipin").bind("click", function(){
		var ipinType = '<?php echo $TPL_VAR["ipinType"]?>';
		if(ipinType == 'niceipin' || ipinType == 'ipin'){
			frmMake('', 'popupCertKey', '����������', true);
			$("meta[name='viewport']").attr({"content":"user-scalable=yes, width=480"});
			if(ipinType == 'niceipin'){
				$("#ifrmRnCheck").attr("src", "<?php echo $GLOBALS["cfg"]["rootDir"]?>/member/ipin/IPINMain.php?callType=findid&joinGubun=mobile");
			}
			else {
				$("#ifrmRnCheck").attr("src", "<?php echo $GLOBALS["cfg"]["rootDir"]?>/member/ipin/IPINCheckRequest.php?callType=findid&joinGubun=mobile");
			}
		}
	});

	//�޴�������
	$("#find_id_hpauth").bind("click", function(){
		var protocol = location.protocol;
		var callbackUrl = "<?php echo ProtocolPortDomain()?><?php echo $GLOBALS["cfg"]["rootDir"]?>/member/hpauthDream/hpauthDream_Result.php";
		frmMake(protocol + "//hpauthdream.godo.co.kr/module/Mobile_hpauthDream_Main.php?callType=findid&shopUrl=" + callbackUrl + "&cpid=<?php echo $TPL_VAR["hpauthCPID"]?>", 'hpauthFrame', '�޴�����������', false);
	});
});
</script>

<?php $this->print_("footer",$TPL_SCP,1);?>