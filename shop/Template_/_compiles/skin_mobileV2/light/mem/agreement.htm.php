<?php /* Template_ 2.2.7 2015/11/14 11:56:19 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/mem/agreement.htm 000007712 */ 
if (is_array($TPL_VAR["consentData"])) $TPL_consentData_1=count($TPL_VAR["consentData"]); else if (is_object($TPL_VAR["consentData"]) && in_array("Countable", class_implements($TPL_VAR["consentData"]))) $TPL_consentData_1=$TPL_VAR["consentData"]->count();else $TPL_consentData_1=0;?>
<?php $this->print_("header",$TPL_SCP,1);?>

<?php  $TPL_VAR["page_title"] = "ȸ������<span class='small_title'>(�������)</span>";?>
<?php $this->print_("sub_header",$TPL_SCP,1);?>

<script type="text/javascript">
	$(document).ready(function(){
		$("#auth-type-ipin").bind("click", function(){
			$("#ipin-description").css("display", "block");
			$("#hpauth-description").css("display", "none");
			$("#next-btn").unbind("click").bind("click", function(){
				nextStep();
				return false;
			});
		});
		$("#auth-type-hpauth").bind("click", function(){
			$("#hpauth-description").css("display", "block");
			$("#ipin-description").css("display", "none");
			$("#next-btn").unbind("click").bind("click", function(){
				goHpauth();
				return false;
			});
		});
		if ($("#auth-type-ipin").length > 0) $("#auth-type-ipin").trigger("click");
		else if ($("#auth-type-hpauth").length > 0) $("#auth-type-hpauth").trigger("click");
		else ;
	});
	function goHpauth()
	{
		if($("[name=chk_agree]").is(":checked") == false) {
			alert("�̿��� �� ����������޹�ħ�� �����ϼž� ȸ�������� �����մϴ�");
			return false;
		}

<?php if($TPL_consentData_1){foreach($TPL_VAR["consentData"] as $TPL_V1){?>
<?php if($TPL_V1["requiredyn"]=='y'){?>
		if ($("[name='consent[<?php echo $TPL_V1["sno"]?>]']").is(":checked") === false){
			alert("<?php echo $TPL_V1["title"]?>�� �����ϼž� ȸ�������� �����մϴ�");
			return false;
		}
<?php }?>
<?php }}?>

		var protocol = location.protocol;
		var callbackUrl = "<?php echo ProtocolPortDomain()?><?php echo $GLOBALS["cfg"]["rootDir"]?>/member/hpauthDream/hpauthDream_Result.php";
		frmMake(protocol + "//hpauthdream.godo.co.kr/module/Mobile_hpauthDream_Main.php?callType=joinmembermobile&shopUrl=" + callbackUrl + "&cpid=<?php echo $TPL_VAR["hpauthCPID"]?>",'hpauthFrame','�޴�����������',false);
	}

	var ipinStatus = '<?php echo $TPL_VAR["ipinStatus"]?>'; // ������ ����

	function nextStep()
	{
		if (ipinStatus == 'y') { // ������ ����
			goIDCheckIpin();
			return;
		}
		else {
			chkForm2();
		}
	}

	function chkForm2()
	{
		if($("[name=chk_agree]").is(":checked") == false) {
			alert("�̿��� �� ����������޹�ħ�� �����ϼž� ȸ�������� �����մϴ�");
			return false;
		}

<?php if($TPL_consentData_1){foreach($TPL_VAR["consentData"] as $TPL_V1){?>
<?php if($TPL_V1["requiredyn"]=='y'){?>
		if ($("[name='consent[<?php echo $TPL_V1["sno"]?>]']").is(":checked") === false){
			alert("<?php echo $TPL_V1["title"]?>�� �����ϼž� ȸ�������� �����մϴ�");
			return false;
		}
<?php }?>
<?php }}?>

		$("#form").submit();

	}
</script>
<section class="content" id="memberjoin">
<form id=form name=frmAgree method=post action="indb.php" target="ifrmHidden" onSubmit="return chkForm2()">
	<input type="hidden" name="mode" value="chkRealName" />
	<input type="hidden" name="rncheck" value="none" />
	<input type="hidden" name="nice_nm" value="" />
	<input type="hidden" name="pakey" value="" />
	<input type="hidden" name="birthday" value="" />
	<input type="hidden" name="sex" value="" />
	<input type="hidden" name="dupeinfo" value="" />
	<input type="hidden" name="foreigner" value="" />
	<input type="hidden" name="type" />
	<input type="hidden" name="mobile" value="" />
	<div class="join_step">
		<div class="join_step1 now_step">�������<div class="join_arrow"></div></div>
		<div class="join_step2">��������<div class="join_arrow"></div></div>
		<div class="join_step4">���ԿϷ�</div>
	</div>
	<div class="agreement_chk">
		<div class="agreement_chk1">
			<label><input type="checkbox" name="chk_agree" value="y" /> <a href="javascript:location.href='../service/agrmt.php';" class="link">�̿���</a> �� <a href="javascript:location.href='../service/termsPolicyCollection2.php';" class="link">����������޹�ħ</a>�� �����մϴ�.<strong style="color:#ff0000;">(�ʼ�)</strong></label>
		</div>
<?php if($GLOBALS["cfg"]["private2YN"]=='Y'){?>
		<div class="agreement_chk2">
			<label><input type="checkbox" name="chk_termsThirdPerson" value="y" /> <a href="javascript:location.href='../service/termsThirdPerson.php';" class="link">�������� ��3�� ����</a>�� �����մϴ�.<strong style="color:#ff0000;">(����)</strong></label>
		</div>
<?php }?>
<?php if($GLOBALS["cfg"]["private3YN"]=='Y'){?>
		<div class="agreement_chk3">
			<label><input type="checkbox" name="chk_termsEntrust" value="y" /> <a href="javascript:location.href='../service/termsEntrust.php';" class="link">�������� ��޾��� ��Ź</a>�� �����մϴ�.<strong style="color:#ff0000;">(����)</strong></label>
		</div>
<?php }?>
<?php if($TPL_consentData_1){foreach($TPL_VAR["consentData"] as $TPL_V1){?>
		<div class="agreement_chk3">
			<label><input type="checkbox" name="consent[<?php echo $TPL_V1["sno"]?>]" value="y" /> <a href="javascript:location.href='../service/termsConsent.php?sno=<?php echo $TPL_V1["sno"]?>';" class="link"><?php echo $TPL_V1["title"]?></a>�� �����մϴ�.<strong style="color:#ff0000;">(<?php echo $TPL_V1["requiredyn_text"]?>)</strong></label>
		</div>
<?php }}?>
	</div>
	<div class="certify">
<?php if($TPL_VAR["ipinyn"]=='y'||$TPL_VAR["niceipinyn"]=='y'){?>
		<span style="margin: 10px; display: inline-block;">
			<input id="auth-type-ipin" name="auth_type" type="radio" value="ipin" required="required"/>
			<label for="auth-type-ipin">
				<img src="/shop/data/skin_mobileV2/light/common/img/ipin/Regist_realName_title_2.gif" style="width: 124px; height: 16px; vertical-align: middle;" alt="������(i-pin)���� ����" />
			</label>
		</span>
<?php }?>
		
<?php if($TPL_VAR["hpauthyn"]=='y'){?>
		<span style="margin: 10px; display: inline-block;">
			<input id="auth-type-hpauth" name="auth_type" type="radio" value="hpauth" required="required"/>
			<label for="auth-type-hpauth">
				<img src="/shop/data/skin_mobileV2/light/common/img/auth/hpauth_title_3.gif" style="width: 111px; height: 16px; vertical-align: middle;" alt="�޴������� ��������" />
			</label>
		</span>
<?php }?>

		<div id="ipin-description">
<?php if($TPL_VAR["ipinyn"]=='y'){?>
			<?php echo $this->define('tpl_include_file_1',"mem/NiceIpin.htm")?> <?php $this->print_("tpl_include_file_1",$TPL_SCP,1);?>

<?php }?>

<?php if($TPL_VAR["niceipinyn"]=='y'){?>
			<?php echo $this->define('tpl_include_file_2',"mem/NewNiceIpin.htm")?> <?php $this->print_("tpl_include_file_2",$TPL_SCP,1);?>

<?php }?>
		</div>
		
		<div id="hpauth-description">
<?php if($TPL_VAR["hpauthyn"]=='y'){?>
			<div id="div_RnCheck_hpauth" class="div_RnCheck_hpauth">
			<ul class="info">
				<li>���� ������ �޴�����ȣ�� �ƴ� ��� ����Ȯ�� ���� �� ȸ�����Կ� ���ѵǴ�, �����Ͻñ� �ٶ��ϴ�.</li>
				<li>����Ȯ�� ������ �Է��� ������ ����Ȯ�� �뵵 �ܿ��� ���ǰų�, �������� �ʽ��ϴ�.</li>
				<li>����Ȯ�� ������ �߻��ϴ� ����� ���� �δ�˴ϴ�.</li>
			</ul>
			</div>
<?php }?>
		</div>
	</div>
	<div class="step_btn">
		<div class="next_btn"><button id="next-btn" tabindex="5">�����ܰ�</button></div>
		<div class="cancel_btn"><button id="cancel-btn" tabindex="5" onclick="javascript:location.href='/'+mobile_root+'/index.php';return false;">�������</button></div>
	</div>
</form>
</section>

<?php $this->print_("footer",$TPL_SCP,1);?>