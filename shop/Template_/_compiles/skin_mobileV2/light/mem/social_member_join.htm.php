<?php /* Template_ 2.2.7 2015/11/14 11:56:20 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/mem/social_member_join.htm 000014482 */ 
if (is_array($TPL_VAR["consentData"])) $TPL_consentData_1=count($TPL_VAR["consentData"]); else if (is_object($TPL_VAR["consentData"]) && in_array("Countable", class_implements($TPL_VAR["consentData"]))) $TPL_consentData_1=$TPL_VAR["consentData"]->count();else $TPL_consentData_1=0;?>
<?php $this->print_("header",$TPL_SCP,1);?>

<?php  $TPL_VAR["page_title"] = "SNS계정 회원가입";?>
<?php $this->print_("sub_header",$TPL_SCP,1);?>

<script type="text/javascript">
var checkedID;
window.onload = function()
{
	var socialMemberJoinForm = document.getElementById("form");
	var checkIDDuplicate = document.getElementById("check-id-duplicate");

	socialMemberJoinForm.submit = function()
	{
		this.action = "./social_member.php";
		this.target = "ifrmHidden";
		
		var formSubmit = document.getElementById("form-submit");
		formSubmit.click();
	};
	checkIDDuplicate.onclick = function()
	{
		checkedID = socialMemberJoinForm.m_id.value;
		idCheck(checkedID);
	};

	// 본인확인 로직에서는 frmAgree를 사용
	document.frmAgree = document.frmMember;
};

var checkSubmit = function()
{
	var socialMemberJoinForm = document.getElementById("form");
	var rdo_ipin = document.getElementById("auth-type-ipin");
	var rdo_hpauthDream = document.getElementById("auth-type-hpauth");

	if($("[name=chk_agree]").is(":checked") == false) {
		alert("이용약관 및 개인정보 취급방침에 동의하셔야 회원가입이 가능합니다");
		return;
	}

<?php if($TPL_consentData_1){foreach($TPL_VAR["consentData"] as $TPL_V1){?>
<?php if($TPL_V1["requiredyn"]=='y'){?>
	if ($("[name='consent[<?php echo $TPL_V1["sno"]?>]']").is(":checked") === false){
		alert("<?php echo $TPL_V1["title"]?>에 동의하셔야 회원가입이 가능합니다");
		return false;
	}
<?php }?>
<?php }}?>

	if (checkedID !== socialMemberJoinForm.m_id.value) {
		socialMemberJoinForm.id_chk.value = "";
	}
	if (socialMemberJoinForm.id_chk.value !== "y") {
		alert("아이디 중복체크를 해주시기 바랍니다.");
		return false;
	}
	if (!socialMemberJoinForm.m_id.value.match(/^[a-zA-Z0-9_-]{6,16}$/)) {
		alert('아이디 입력 형식 오류입니다');
		return false;
	}

	// 만14세 미만 회원가입 가능여부 생년월일로 체크
	var under14Code = '<?php echo $TPL_VAR["under14Code"]?>';
	var under14Status = '<?php echo $TPL_VAR["under14Status"]?>';
	if (under14Code == 'needBirthCheck') {
		var birthDay = '';
		if ($("[name=birth_year]").length && $("[name=birth[]]").length) {
			bY = '0000' + $("[name=birth_year]").val();
			bM = '00' + $("[name=birth[]]").eq(0).val();
			bD = '00' + $("[name=birth[]]").eq(1).val();
			birthDay = bY.substring(bY.length-4) + bM.substring(bM.length-2) + bD.substring(bD.length-2);
		}
		if (chkUnder14(birthDay, under14Status, under14Code) === false) {
			return false;
		}
	}

	if (rdo_ipin && rdo_ipin.checked) {
		goIDCheckIpin();
	}
	else if (rdo_hpauthDream && rdo_hpauthDream.checked) {
		goHpauth();
	}
	else {
		if (chkagreement(socialMemberJoinForm)) {
			socialMemberJoinForm.submit();
		}
	}
	return false;
};
var chkagreement = function(fm)
{
	if($("[name=chk_agree]").is(":checked") == false) {
		alert("이용약관 및 개인정보 취급방침에 동의하셔야 회원가입이 가능합니다");
		return false;
	}

<?php if($TPL_consentData_1){foreach($TPL_VAR["consentData"] as $TPL_V1){?>
<?php if($TPL_V1["requiredyn"]=='y'){?>
	if ($("[name='consent[<?php echo $TPL_V1["sno"]?>]']").is(":checked") === false){
		alert("<?php echo $TPL_V1["title"]?>에 동의하셔야 회원가입이 가능합니다");
		return false;
	}
<?php }?>
<?php }}?>

	return true;
};

$(document).ready(function(){
	$("#auth-type-ipin").bind("click", function(){
		$("#ipin-description").css("display", "block");
		$("#hpauth-description").css("display", "none");
	});
	$("#auth-type-hpauth").bind("click", function(){
		$("#hpauth-description").css("display", "block");
		$("#ipin-description").css("display", "none");
	});
	$("#next-btn").unbind("click").bind("click", function(){
		checkSubmit();
		return false;
	});
	if ($("#auth-type-ipin").length > 0) $("#auth-type-ipin").trigger("click");
	else if ($("#auth-type-hpauth").length > 0) $("#auth-type-hpauth").trigger("click");
	else ;
});
function goHpauth()
{
	if($("[name=chk_agree]").is(":checked") == false) {
		alert("이용약관 및 개인정보 취급방침에 동의하셔야 회원가입이 가능합니다");
		return false;
	}

<?php if($TPL_consentData_1){foreach($TPL_VAR["consentData"] as $TPL_V1){?>
<?php if($TPL_V1["requiredyn"]=='y'){?>
	if ($("[name='consent[<?php echo $TPL_V1["sno"]?>]']").is(":checked") === false){
		alert("<?php echo $TPL_V1["title"]?>에 동의하셔야 회원가입이 가능합니다");
		return false;
	}
<?php }?>
<?php }}?>

	var protocol = location.protocol;
	var callbackUrl = "<?php echo ProtocolPortDomain()?><?php echo $GLOBALS["cfg"]["rootDir"]?>/member/hpauthDream/hpauthDream_Result.php";
	frmMake(protocol + "//hpauthdream.godo.co.kr/module/Mobile_hpauthDream_Main.php?callType=joinmembermobile&shopUrl=" + callbackUrl + "&cpid=<?php echo $TPL_VAR["hpauthCPID"]?>",'hpauthFrame','휴대폰본인인증',false);
}

var ipinStatus = '<?php echo $TPL_VAR["ipinStatus"]?>'; // 아이핀 인증

function nextStep()
{
	if (ipinStatus == 'y') { // 아이핀 인증
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
		alert("이용약관 및 개인정보 취급방침에 동의하셔야 회원가입이 가능합니다");
		return false;
	}

<?php if($TPL_consentData_1){foreach($TPL_VAR["consentData"] as $TPL_V1){?>
<?php if($TPL_V1["requiredyn"]=='y'){?>
	if ($("[name='consent[<?php echo $TPL_V1["sno"]?>]']").is(":checked") === false){
		alert("<?php echo $TPL_V1["title"]?>에 동의하셔야 회원가입이 가능합니다");
		return false;
	}
<?php }?>
<?php }}?>

	return;
}
function idCheck(id) {

	var $id = id;

	if($id.length < 6) {
		$("[name=id_chk]").val('n');
		$("#id_description").addClass("wrong");
		$("#id_description").text('아이디는 6자 이상으로 입력해 주세요');
	}
	else {
		var data_param = "mode=id_check&id="+$id;

		$.ajax({
			type : "post",
			url : "/"+mobile_root+"/proc/mAjaxAction.php",
			cache:false,
			async:false,
			data: data_param,
			success: function (res) {
				chk_data = res;
				
				$("[name=id_chk]").val(chk_data.code);
				$("#id_description").text(chk_data.msg);

				if(chk_data.code == "n") {
					$("#id_description").addClass("wrong");
				}
				else {
					$("#id_description").removeClass("wrong");
				}
			},
			dataType:"json"
		});
	}
}
</script>
<section class="content" id="socialjoin">
<form id=form name=frmAgree method=post action="social_member.php" target="ifrmHidden">
	<input type="hidden" name="MODE" value="join"/>
	<input type="hidden" name="SOCIAL_CODE" value="<?php echo $TPL_VAR["SOCIAL_CODE"]?>"/>
	<input type="hidden" name="id_chk" value="" />
	<input type="hidden" name="email" value="<?php echo $TPL_VAR["email"]?>"/>
	<input type="hidden" name="mode" value="chkRealName">
	<input type="hidden" name="rncheck" value="none" />
	<input type="hidden" name="nice_nm" value="" />
	<input type="hidden" name="mobile" value="" />
	<input type="hidden" name="dupeinfo" value="" />
	<input type="hidden" name="type" />
<?php if($TPL_VAR["realnameyn"]=='y'||$TPL_VAR["ipinyn"]=='y'||$TPL_VAR["niceipinyn"]=='y'||$TPL_VAR["hpauthyn"]=='y'){?>
	<input type="hidden" name="name" value="<?php echo $TPL_VAR["name"]?>"/>
<?php }?>
	<input type="hidden" name="pakey" value="" />
<?php if($TPL_VAR["realnameyn"]=='y'||$TPL_VAR["ipinyn"]=='y'||$TPL_VAR["niceipinyn"]=='y'||$TPL_VAR["hpauthyn"]=='y'){?>
	<input type="hidden" name="birthday" value="" />
<?php }?>
	<input type="hidden" name="sex" value="" />
	<input type="hidden" name="foreigner" value="" />
	<div class="agreement_chk">
		<div class="agreement_chk1">
			<label><input type="checkbox" name="chk_agree" value="y" /> <a href="javascript:location.href='../service/agrmt.php';" class="link">이용약관</a> 및 <a href="javascript:location.href='../service/termsPolicyCollection2.php';" class="link">개인정보취급방침</a>에 동의 합니다.<strong style="color:#ff0000;">(필수)</strong></label>
		</div>
<?php if($GLOBALS["cfg"]["private2YN"]=='Y'){?>
		<div class="agreement_chk2">
			<label><input type="checkbox" name="chk_termsThirdPerson" value="y" /> <a href="javascript:location.href='../service/termsThirdPerson.php';" class="link">개인정보 제3자 제공</a> 에 동의 합니다.<strong style="color:#ff0000;">(선택)</strong></label>
		</div>
<?php }?>
<?php if($GLOBALS["cfg"]["private3YN"]=='Y'){?>
		<div class="agreement_chk3">
			<label><input type="checkbox" name="chk_termsEntrust" value="y" /> <a href="javascript:location.href='../service/termsEntrust.php';" class="link">개인정보 취급업무 위탁</a> 에 동의 합니다.<strong style="color:#ff0000;">(선택)</strong></label>
		</div>
<?php }?>
<?php if($TPL_consentData_1){foreach($TPL_VAR["consentData"] as $TPL_V1){?>
		<div class="agreement_chk3">
			<label><input type="checkbox" name="consent[<?php echo $TPL_V1["sno"]?>]" value="y" /> <a href="javascript:location.href='../service/termsConsent.php?sno=<?php echo $TPL_V1["sno"]?>';" class="link"><?php echo $TPL_V1["title"]?></a>에 동의합니다.<strong style="color:#ff0000;">(<?php echo $TPL_V1["requiredyn_text"]?>)</strong></label>
		</div>
<?php }}?>
	</div>
	<div class="account">
		<div class="account_content">
			<div class="input_wrap">
			<div class="input_title">아이디</div>

			<div class="input_content">
				<input type="text" name="m_id" value="<?php echo $TPL_VAR["email_id"]?>" size="12" maxlength="16" style="ime-mode:diable" class="w120" required/>
				<button id="check-id-duplicate" type="button">중복체크</button>
				<div class="description_wrap">
					<div class="description">6~16자의 영문자, 숫자조합</div>
					<div class="description wrong" id="id_description">아이디는 6자 이상으로 입력해 주세요</div>
				</div>
			</div>
			</div>
<?php if($TPL_VAR["realnameyn"]!=='y'&&$TPL_VAR["ipinyn"]!=='y'&&$TPL_VAR["niceipinyn"]!=='y'&&$TPL_VAR["hpauthyn"]!=='y'){?>
			<div class="input_wrap">
			<div class="input_title">이름</div>

			<div class="input_content">
				<input type="text" name="name" value="<?php echo $TPL_VAR["name"]?>" size="12" maxlength="10" style="ime-mode:active" class="w120" required />
			</div>
			</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["birth"]&&$TPL_VAR["realnameyn"]!=='y'&&$TPL_VAR["ipinyn"]!=='y'&&$TPL_VAR["niceipinyn"]!=='y'&&$TPL_VAR["hpauthyn"]!=='y'){?>
			<div class="input_wrap">
			<div class="input_title">생년월일</div>

			<div class="input_content">
				<input type=text name=birth_year value="<?php echo $TPL_VAR["birth_year"]?>" <?php echo $GLOBALS["required"]["birth"]?> label="생년월일" size=4 maxlength=4>년
				<input type=text name=birth[] value="<?php echo $TPL_VAR["birth"][ 0]?>" <?php echo $GLOBALS["required"]["birth"]?> label="생년월일" size=2 maxlength=2>월
				<input type=text name=birth[] value="<?php echo $TPL_VAR["birth"][ 1]?>" <?php echo $GLOBALS["required"]["birth"]?> label="생년월일" size=2 maxlength=2>일

<?php if($GLOBALS["checked_mobile"]["useField"]["calendar"]){?>
				<div class="description_wrap">
				<input type=radio name=calendar value="s" checked> 양력
				<input type=radio name=calendar value="l" <?php echo $GLOBALS["checked"]["calendar"]["l"]?>> 음력
				</div>
<?php }?>
			</div>
			</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["mailling"]){?>
			<div class="input_wrap">
			<div class="input_title"></div>
			<div class="input_content">
				<div class="description_wrap">
				<div class="description chk">
					<label><input type="checkbox" name="mailling" <?php echo $GLOBALS["checked"]["mailling"]?>/>  정보,이벤트메일수신</label>
				</div>
				<div class="description">
					※ 주문정보,공지사항 등 주요 안내사항은 동의 여부에 관계없이 자동 발송됩니다.
				</div>
				</div>
			</div>
			</div>
<?php }?>
		</div>
	</div>
	<div class="certify">
<?php if($TPL_VAR["ipinyn"]=='y'||$TPL_VAR["niceipinyn"]=='y'){?>
		<span style="margin: 10px; display: inline-block;">
			<input id="auth-type-ipin" name="auth_type" type="radio" value="ipin" required="required"/>
			<label for="auth-type-ipin">
				<img src="/shop/data/skin_mobileV2/light/common/img/ipin/Regist_realName_title_2.gif" style="width: 124px; height: 16px; vertical-align: middle;" alt="아이핀(i-pin)으로 인증" />
			</label>
		</span>
<?php }?>

<?php if($TPL_VAR["hpauthyn"]=='y'){?>
		<span style="margin: 10px; display: inline-block;">
			<input id="auth-type-hpauth" name="auth_type" type="radio" value="hpauth" required="required"/>
			<label for="auth-type-hpauth">
				<img src="/shop/data/skin_mobileV2/light/common/img/auth/hpauth_title_3.gif" style="width: 111px; height: 16px; vertical-align: middle;" alt="휴대폰으로 본인인증" />
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
				<li>본인 소유의 휴대폰번호가 아닌 경우 본인확인 인증 및 회원가입에 제한되니, 유의하시기 바랍니다.</li>
				<li>본인확인 인증시 입력한 정보는 본인확인 용도 외에는 사용되거나, 보관하지 않습니다.</li>
				<li>본인확인 인증시 발생하는 비용은 에서 부담됩니다.</li>
			</ul>
			</div>
<?php }?>
		</div>
	</div>
	<div class="step_btn">
		<input id="form-submit" type="submit" style="display: none;"/>
		<div class="next_btn"><button id="next-btn" tabindex="5">다음단계</button></div>
		<div class="cancel_btn"><button id="cancel-btn" tabindex="5" onclick="javascript:location.href='/'+mobile_root+'/index.php';return false;">가입취소</button></div>
	</div>
</form>
</section>

<?php $this->print_("footer",$TPL_SCP,1);?>