<?php /* Template_ 2.2.7 2016/01/20 13:32:05 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/mem/_form.htm 000034834 */ 
if (is_array($TPL_VAR["consentData"])) $TPL_consentData_1=count($TPL_VAR["consentData"]); else if (is_object($TPL_VAR["consentData"]) && in_array("Countable", class_implements($TPL_VAR["consentData"]))) $TPL_consentData_1=$TPL_VAR["consentData"]->count();else $TPL_consentData_1=0;?>
<style rel="stylesheet" type="text/css">
	.top_subtitle { height:40px; border-bottom:solid 1px #dddde1; padding-left:10px; margin-bottom:15px; line-height:40px; font-weight:bold; font-size:14px; }
	.top_subtitle_btm { height:40px; padding-left:10px; line-height:40px; font-weight:bold; font-size:14px; }
	section#myInfo .input_wrap { clear:both; }
	section#myInfo .newPwdDiv { display:none; }
	section#myInfo .terms { padding-bottom:15px; line-height:25px; font-weight:bold; border-top:solid 1px #dddde1; border-bottom:solid 1px #dddde1; }
	section#myInfo .terms a:hover { text-decoration:underline; }
	section#myInfo input[type=text], input[type=number], input[type=email], input[type=password] { border-radius:3px; border:solid 1px #aeaeaf; height:24px; }
	section#myInfo input[type=checkbox], input[type=radio] { height:15px; border:solid 1px #BBBBBB; }
	section#myInfo select { border-radius:3px; border:solid 1px #aeaeaf; height:29px; }
	section#myInfo .asterisk { width:1px; padding-left:10px; color:#f00; float:left; height:30px; line-height:30px; }
	section#myInfo .input_title { width:29%; padding-left:10px; min-width:80px; color:#222222; float:left; height:30px; line-height:30px; }
	section#myInfo .input_content { width:60%; float:left; line-height:30px; margin-bottom:11px; }
	section#myInfo button { width:130px; display:block; margin-bottom:10px; text-align:center; height:30px; color:#FFFFFF; line-height:30px; font-size:11px; background:#808591; border-radius:4px; font-family:dotum; border:none; }
	section#myInfo .description { font-size:11px; color:#9e9e9e; line-height:18px; }
	section#myInfo .confirm_btn { clear:both; width:100%; text-align:center; }
	section#myInfo .iblock { display:inline-block; }
	section#myInfo button.white { width:130px; margin-bottom:10px; text-align:center; height:32px; color:#808591; line-height:30px; font-size:11px; background:#FFFFFF; border-radius:4px; font-family:dotum; border:1px solid #808591; }

	section#myInfo .red { color:#f00; }
	section#myInfo .w100 { width:100%; }
	section#myInfo .w18 { width:18%; }
	section#myInfo .w25 { width:25%; }
	section#myInfo .w45 { width:45px; }
	section#myInfo .w60 { width:60px; }
	section#myInfo .w70 { width:70px; }
	section#myInfo .btn_pad, section#myInfo .noline { padding-top:10px; }
	section#myInfo .block { display:block; }
	section#myInfo #div_road_address { padding:5px 5px 0 1px; font:12px dotum; color:#999; }
	section#myInfo #div_road_address_sub { padding:5px 0 0 1px; font:12px dotum; color:#999; }

	div.passwordStrenth { display:none; }
	div.passwordStrenth dl { margin:0; padding:0 6px 0 0; color:#373737; font-weight:bold; font-size:11px; font-family:dotum; }
	div.passwordStrenth dl dt, div.passwordStrenth dl dd { display:inline; font-size:11px; font-family:dotum; margin:0; height:15px; line-height:15px; }
	div.passwordStrenth dl dt { color:#363636; font-weight:bold; width:95px; }
	div.passwordStrenth dl dd.lv0 { color:#F52D00; }
	div.passwordStrenth dl dd.lv1 { color:#028EFF; }
	div.passwordStrenth dl dd.lv2 { color:#0213FF; }
	div.passwordStrenth dl dd.lv3, div.passwordStrenth dl dd.lv4 { color:#46C32D; }
</style>
<script src="/shop/data/skin_mobileV2/light/godo.password_strength.js" type="text/javascript"></script>
<script type="text/javascript">
	$(function () {
		$("#change-pwd-btn").toggle(function() {
			$("input[name=pwd_chk]").val("n");
			$(".newPwdDiv").show();
		}, function () {
			$("input[name=pwd_chk]").val("");
			$(".pass_all").val("");
			$(".newPwdDiv").hide();
		});

		$("input[name=newPassword]").focus(function () {
			checkPassword(this);
		}).keyup(function () {
			checkPassword(this);
		}).blur(function () {
			emptyPwState();
		});

		$("input[name=confirmPassword]").keyup(function () {
			pwdCheck(this);
		});

		$("input[type=number]").keypress(function (event) {
			onlyNum(event);
			if ($(this).val().length >= $(this).attr("maxlength")) return false;
		}).blur(function () {
			if ($(this).val().length >= $(this).attr("maxlength")) $(this).val($(this).val().substring(0, $(this).attr("maxlength")));
		});

		$("#zipcode-btn").click(function () {
			frmMake("<?php echo $GLOBALS["cfg"]["rootDir"]?>/proc/popup_address.php?isMobile=true&gubun=mobile","searchZipcode","",false);
			return false;
		});

		$("#next-btn").click(function () {
			nextStep();
		});

		$("#cancel-btn").click(function () {
			location.href = "../myp/menu_list.php";
		});

		$("#editNumber").click(function () {
			var protocol = location.protocol;
			var callbackUrl = "<?php echo ProtocolPortDomain()?><?php echo $GLOBALS["cfg"]["rootDir"]?>/member/hpauthDream/hpauthDream_Result.php";
			frmMake(protocol + "//hpauthdream.godo.co.kr/module/Mobile_hpauthDream_Main.php?callType=modifymembermobile&shopUrl=" + callbackUrl + "&cpid=<?php echo $TPL_VAR["hpauthCPID"]?>","hpauthFrame","휴대폰본인인증",false);
			return false;
		});

<?php if($TPL_VAR["hpauthyn"]=='y'&&$TPL_VAR["moduseyn"]=='y'){?>
			$(".mobile_all").click(function () {
				$("#editNumber").trigger("click");
			});
<?php }?>

		$(".zipcode_all").click(function () {
			$("#zipcode-btn").trigger("click");
		});
	});

	function checkPassword(el) {
		if(el.value) {
			var result = nsGodo_PasswordStrength.check( el );
			$("#el-password-strength-indicator-msg").html(result.msg);
			$("#el-password-strength-indicator-level").addClass("lv" + result.level).html(result.levelText);
			$("#el-password-strength-indicator").attr("style", "display:block");
		}
		else {
			emptyPwState();
		}
	}

	function emptyPwState() {
		$("#el-password-strength-indicator").attr("style", "display:none");
	}

	function pwdCheck(obj) {
		$c_pwd = $(obj).val();
		if($("input[name=newPassword]").val() != $c_pwd) {
			$("input[name=pwd_chk]").val("n");
			$("#pwd_description").text("비밀번호가 일치하지 않습니다.");
			$("#pwd_description").addClass("wrong");
		} else {
			$("input[name=pwd_chk]").val("y");
			$("#pwd_description").text("비밀번호가 일치합니다.");
			$("#pwd_description").removeClass("wrong");
		}
	}

	function onlyNum(obj) {
		var ie_11 = /Trident\/(?:[7-9]|\d{2,})\..*rv:(\d+)/.exec(navigator.userAgent);

		if(ie_11 || !window.event) var _code=arguments[1].which;
		else var _code=event.keyCode;

		if ((_code<48) || (_code>57)) {
			if(ie_11 || !window.event) arguments[1].preventDefault();
			else event.returnValue=false;
		}
		else {
			return true;
		}
	}

	function nextStep() {
<?php if($TPL_consentData_1){foreach($TPL_VAR["consentData"] as $TPL_V1){?>
<?php if($TPL_V1["requiredyn"]=='y'){?>
		if ($("input[name=consent[<?php echo $TPL_V1["sno"]?>]]").is(":checked") === false){
			alert("[<?php echo $TPL_V1["title"]?>]에 동의하셔야 회원정보 수정이 가능합니다.");
			$("input[name=consent[<?php echo $TPL_V1["sno"]?>]]").focus();
			return false;
		}
<?php }?>
		if ($("input[name=consent[<?php echo $TPL_V1["sno"]?>]]").is(":checked") === false){
			$("input[name=consents[<?php echo $TPL_V1["sno"]?>]]").val("n");
		} else {
			$("input[name=consents[<?php echo $TPL_V1["sno"]?>]]").val("y");
		}
<?php }}?>
		var check_required = 1;
		var form = document.frmAgree;

		if($("input[name=pwd_chk]").val() && !$("input[name=originalPassword]").val()) {
			alert("비밀번호를 입력해주세요.");
			$("input[name=originalPassword]").focus();
			check_required = 0;
			return false;
		} else if(($("input[name=pwd_chk]").val() == "n" && !$("input[name=newPassword]").val()) || ($("input[name=newPassword]").val() != $("input[name=confirmPassword]").val())) {
			alert("비밀번호가 일치하지 않습니다.");
			$("input[name=newPassword]").focus();
			check_required = 0;
			return false;
		}
<?php if($GLOBALS["checked_mobile"]["reqField"]["email"]){?>
		if (!chkText(form.email,form.email.value,"이메일을 입력해주세요.")) return false;
		if (!chkPatten(form.email,form.email.getAttribute("option"),"정상적인 이메일 주소를 입력해주세요.")) return false;
<?php }?>

		$("input[required='']").each(function(i, obj) {
			if (obj.value == "") {
				check_required = 0;
				alert("필수값("+obj.getAttribute("label")+")을 입력해주세요.");
				obj.focus();
				return false;
			}
		});

		if (check_required == 0) return false;
		$("#frmAgree").attr("action", $("input[name=pAction]").val()).submit();
	}
</script>
<section class="content" id="myInfo">
<form id="frmAgree" name="frmAgree" method="post" action="" target="ifrmHidden">
	<input type="hidden" name="pwd_chk" />
	<input type="hidden" name="mode" value="<?php echo $GLOBALS["mode"]?>" />
	<input type="hidden" name="dupeinfo" value="<?php echo $TPL_VAR["dupeinfo"]?>" />
	<input type="hidden" name="rncheck" value="<?php echo $TPL_VAR["rncheck"]?>" />
<?php if($GLOBALS["sess"]){?><input type="hidden" name="m_id" value="<?php echo $TPL_VAR["m_id"]?>" /><?php }?>
	<input type="hidden" name="passwordSkin" value="Y"><!-- 비밀번호 작성 규칙 보완 스킨패치 여부 -->
	<input type="hidden" name="pAction" value="<?php echo $TPL_VAR["memActionUrl"]?>" />
	<input type="hidden" name="private1" value="<?php echo $TPL_VAR["private1"]?>">
<?php if($TPL_consentData_1){foreach($TPL_VAR["consentData"] as $TPL_V1){?>
	<input type="hidden" name="consents[<?php echo $TPL_V1["sno"]?>]" />
<?php }}?>
<?php if($GLOBALS["cfg"]['private2YN']=='Y'||$GLOBALS["cfg"]['private3YN']=='Y'||count($TPL_VAR["consentData"])> 0){?>
	<div class="top_subtitle_btm">약관 동의</div>
	<div class="terms">
<?php if($GLOBALS["cfg"]['private2YN']=='Y'){?>
		<div>
			<input type="checkbox" name="private2YN" value="y" <?php echo $GLOBALS["checked"]["private2YN"]?> />
			<a href="../service/termsPolicyCollection2.php"><span class="red">[선택]</span> 개인정보 제3자 제공 관련</a>
		</div>
<?php }?>
<?php if($GLOBALS["cfg"]['private3YN']=='Y'){?>
		<div>
			<input type="checkbox" name="private3YN" value="y" <?php echo $GLOBALS["checked"]["private3YN"]?> />
			<a href="../service/termsEntrust.php"><span class="red">[선택]</span> 개인정보취급 위탁 관련</a>
		</div>
<?php }?>
<?php if($TPL_consentData_1){foreach($TPL_VAR["consentData"] as $TPL_V1){?>
		<div>
			<input type="checkbox" name="consent[<?php echo $TPL_V1["sno"]?>]" class="consents" requiredyn="<?php echo $TPL_V1["requiredyn"]?>" value="y" <?php echo $TPL_V1["consentyn"]?> />
			<a href="../service/termsConsent.php?sno=<?php echo $TPL_V1["sno"]?>"><span class="red">[<?php echo $TPL_V1["requiredyn_text"]?>]</span> <?php echo $TPL_V1["title"]?></a>
		</div>
<?php }}?>
	</div>
<?php }?>
	<div class="info">
		<div class="top_subtitle">개인 회원 정보</div>
		<div class="input_wrap">
			<div class="asterisk">*</div>
			<div class="input_title">아이디</div>
			<div class="input_content"><?php echo $TPL_VAR["m_id"]?></div>
		</div>
		<div class="input_wrap">
			<div class="asterisk">*</div>
			<div class="input_title">비밀번호</div>
			<div class="input_content"><button id="change-pwd-btn">비밀번호 변경</button></div>
		</div>
		<div class="newPwdDiv">
			<div class="input_wrap">
				<div class="asterisk">*</div>
				<div class="input_title">현재 비밀번호</div>
				<div class="input_content"><input type="password" name="originalPassword" id="originalPassword" class="w100 pass_all" /></div>
			</div>
			<div class="input_wrap">
				<div class="asterisk">*</div>
				<div class="input_title">새 비밀번호</div>
				<div class="input_content">
					<input type="password" name="newPassword" id="newPassword" onblur="emptyPwState()" label="새 비밀번호" option="regPass" maxlength="16" class="w100 pass_all" />
					<div class="passwordStrenth" id="el-password-strength-indicator">
						<dl>
							<dt>비밀번호 안전도</dt>
							<dd id="el-password-strength-indicator-level"></dd>
						</dl>
					</div>
					<span class="description block" id="el-password-strength-indicator-msg">10 ~ 16자의 영문자, 숫자조합</span>
				</div>
			</div>
			<div class="input_wrap">
				<div class="asterisk">*</div>
				<div class="input_title">새 비밀번호 확인</div>
				<div class="input_content">
					<input type="password" name="confirmPassword" id="confirmPassword" label="새 비밀번호 확인" option="regPass" maxlength="16" class="w100 pass_all" />
					<span class="description block wrong" id="pwd_description">비밀번호가 일치하지 않습니다.</span>
				</div>
			</div>
		</div>
		<div class="input_wrap">
			<div class="asterisk">*</div>
			<div class="input_title">이름</div>
			<div class="input_content"><input type="text" name="name" id="name" value="<?php echo $TPL_VAR["name"]?>" class="w100" /></div>
		</div>
<?php if($GLOBALS["checked_mobile"]["useField"]["nickname"]){?>
		<div class="input_wrap">
			<div class="asterisk"><?php if($GLOBALS["checked_mobile"]["reqField"]["nickname"]){?>*<?php }?></div>
			<div class="input_title">닉네임</div>
			<div class="input_content">
				<input type="text" name="nickname" maxlength="12" class="w100" style="ime-mode:active" label="닉네임" value="<?php echo $TPL_VAR["nickname"]?>" <?php if($GLOBALS["checked_mobile"]["reqField"]["nickname"]){?>required<?php }?> />
			</div>
		</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["sex"]){?>
		<div class="input_wrap">
			<div class="asterisk"><?php if($GLOBALS["checked_mobile"]["reqField"]["sex"]){?>*<?php }?></div>
			<div class="input_title">성별</div>
			<div class="input_content">
				<label><input type="radio" name="sex" label="성별" value="m" <?php echo $GLOBALS["checked"]["sex"]["m"]?> label="성별" <?php if($GLOBALS["checked_mobile"]["reqField"]["sex"]){?>required<?php }?> /> 남자</label>
				<label><input type="radio" name="sex" label="성별" value="w" <?php echo $GLOBALS["checked"]["sex"]["w"]?> label="성별" <?php if($GLOBALS["checked_mobile"]["reqField"]["sex"]){?>required<?php }?> /> 여자</label>
			</div>
		</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["birth"]){?>
		<div class="input_wrap">
			<div class="asterisk"><?php if($GLOBALS["checked_mobile"]["reqField"]["birth"]){?>*<?php }?></div>
			<div class="input_title">생년월일</div>
			<div class="input_content">
				<select name="birth_year" class="w70" <?php if($GLOBALS["checked_mobile"]["reqField"]["birth"]){?>required<?php }?>>
<?php if((is_array($TPL_R1=range(date('Y'), 1900))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?>
					<option value="<?php echo $TPL_V1?>" <?php echo $GLOBALS["selected"]["birth_year"][$TPL_V1]?>><?php echo $TPL_V1?></option>
<?php }}?>
				</select>
				<select name="birth[]" class="w45" <?php if($GLOBALS["checked_mobile"]["reqField"]["birth"]){?>required<?php }?>>
<?php if((is_array($TPL_R1=range( 1, 12))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?>
					<option value="<?php echo sprintf('%02d',$TPL_V1)?>" <?php echo $GLOBALS["selected"]["birth0"][sprintf('%02d',$TPL_V1)]?>><?php echo sprintf('%02d',$TPL_V1)?></option>
<?php }}?>
				</select>
				<select name="birth[]" class="w45" <?php if($GLOBALS["checked_mobile"]["reqField"]["birth"]){?>required<?php }?>>
<?php if((is_array($TPL_R1=range( 1, 31))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?>
					<option value="<?php echo sprintf('%02d',$TPL_V1)?>" <?php echo $GLOBALS["selected"]["birth1"][sprintf('%02d',$TPL_V1)]?>><?php echo sprintf('%02d',$TPL_V1)?></option>
<?php }}?>
				</select>
<?php if($GLOBALS["checked_mobile"]["useField"]["calendar"]){?>
				<div class="noline">
				<input type="radio" name="calendar" value="s" <?php echo $GLOBALS["checked"]["calendar"]["s"]?> label="일월간지" <?php if($GLOBALS["checked_mobile"]["reqField"]["calendar"]){?>required<?php }?> > 양력
				<input type="radio" name="calendar" value="l" <?php echo $GLOBALS["checked"]["calendar"]["l"]?> label="일월간지" <?php if($GLOBALS["checked_mobile"]["reqField"]["calendar"]){?>required<?php }?> > 음력
<?php }?>
			</div>
		</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["marriyn"]){?>
		<div class="input_wrap">
			<div class="asterisk"><?php if($GLOBALS["checked_mobile"]["reqField"]["marriyn"]){?>*<?php }?></div>
			<div class="input_title">결혼여부</div>
			<div class="input_content">
				<label><input type="radio" name="marriyn" label="결혼여부" value="n" <?php echo $GLOBALS["checked"]["marriyn"]["n"]?> label="결혼여부" <?php if($GLOBALS["checked_mobile"]["reqField"]["marriyn"]){?>required<?php }?> /> 미혼</label>
				<label><input type="radio" name="marriyn" label="결혼여부" value="y" <?php echo $GLOBALS["checked"]["marriyn"]["y"]?> label="결혼여부" <?php if($GLOBALS["checked_mobile"]["reqField"]["marriyn"]){?>required<?php }?> /> 기혼</label>
			</div>
		</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["marridate"]){?>
		<div class="input_wrap">
			<div class="asterisk"><?php if($GLOBALS["checked_mobile"]["reqField"]["marridate"]){?>*<?php }?></div>
			<div class="input_title">결혼기념일</div>
			<div class="input_content">
				<select name="marridate[]" class="w70" <?php if($GLOBALS["checked_mobile"]["reqField"]["marridate"]){?>required<?php }?>>
<?php if((is_array($TPL_R1=range(date('Y'), 1900))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?>
					<option value="<?php echo $TPL_V1?>" <?php echo $GLOBALS["selected"]["marridate0"][$TPL_V1]?>><?php echo $TPL_V1?></option>
<?php }}?>
				</select>
				<select name="marridate[]" class="w45" <?php if($GLOBALS["checked_mobile"]["reqField"]["marridate"]){?>required<?php }?>>
<?php if((is_array($TPL_R1=range( 1, 12))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?>
					<option value="<?php echo sprintf('%02d',$TPL_V1)?>" <?php echo $GLOBALS["selected"]["marridate1"][sprintf('%02d',$TPL_V1)]?>><?php echo sprintf('%02d',$TPL_V1)?></option>
<?php }}?>
				</select>
				<select name="marridate[]" class="w45" <?php if($GLOBALS["checked_mobile"]["reqField"]["marridate"]){?>required<?php }?>>
<?php if((is_array($TPL_R1=range( 1, 31))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?>
					<option value="<?php echo sprintf('%02d',$TPL_V1)?>" <?php echo $GLOBALS["selected"]["marridate2"][sprintf('%02d',$TPL_V1)]?>><?php echo sprintf('%02d',$TPL_V1)?></option>
<?php }}?>
				</select>
			</div>
		</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["email"]){?>
		<div class="input_wrap">
			<div class="asterisk"><?php if($GLOBALS["checked_mobile"]["reqField"]["email"]){?>*<?php }?></div>
			<div class="input_title">이메일</div>
			<div class="input_content">
				<input type="email" name="email" value="<?php echo $TPL_VAR["email"]?>" option="regEmail" label="이메일" class="w100" <?php if($GLOBALS["checked_mobile"]["reqField"]["email"]){?>required<?php }?> />
<?php if($GLOBALS["checked"]["useField"]["mailling"]){?>
					<div class="description chk">
						<label><input type="checkbox" name="mailling" <?php echo $GLOBALS["checked"]["mailling"]?> /> 광고성 정보,이벤트메일수신</label>
					</div>
					<span class="description block">※ 주문정보,공지사항 등 주요 안내사항은 동의 여부에 관계없이 자동 발송됩니다.</span>
<?php }?>
					<span class="description block">※ 아이디 / 비밀번호 찾기에 활용 되므로 정확하게 입력해 주세요.</span>
			</div>
		</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["address"]){?>
		<div class="input_wrap">
			<div class="asterisk"><?php if($GLOBALS["checked_mobile"]["reqField"]["address"]){?>*<?php }?></div>
			<div class="input_title">주소</div>
			<div class="input_content">
				<button id="zipcode-btn" class="btn_zipcode">우편번호 검색</button>
				<div>
				<input type="number" name="zonecode" id="zonecode" value="<?php echo $TPL_VAR["zonecode"]?>" maxlength="5" min="00000" max="99999" class="w60 zipcode_all" style="ime-mode:disabled" readonly label="주소" />
				( <input type="number" name="zipcode[]" id="zipcode0" value="<?php echo $TPL_VAR["zipcode"][ 0]?>" maxlength="4" min="0000" max="9999" class="w45 zipcode_all" style="ime-mode:disabled" readonly label="우편번호" <?php if($GLOBALS["checked_mobile"]["reqField"]["address"]){?>required<?php }?> /> -
				<input type="number" name="zipcode[]" id="zipcode1" value="<?php echo $TPL_VAR["zipcode"][ 1]?>" maxlength="4" min="0000" max="9999" class="w45 zipcode_all" style="ime-mode:disabled" readonly label="우편번호" <?php if($GLOBALS["checked_mobile"]["reqField"]["address"]){?>required<?php }?>  /> )
				</div>
				<div>
					<input type="text" name="address" id="address" value="<?php echo $TPL_VAR["address"]?>" class="w100 zipcode_all" style="ime-mode:active" label="주소" <?php if($GLOBALS["checked_mobile"]["reqField"]["address"]){?>required<?php }?> />
					<input type="text" name="address_sub" id="address_sub" value="<?php echo $TPL_VAR["address_sub"]?>" class="w100 zipcode_all" style="ime-mode:active" label="주소" />
					<input type="hidden" name="road_address" id="road_address" value="<?php echo $TPL_VAR["road_address"]?>">
					<span id="div_road_address"><?php echo $TPL_VAR["road_address"]?></span>
					<span id="div_road_address_sub"><?php if($TPL_VAR["road_address"]){?><?php echo $TPL_VAR["address_sub"]?><?php }?></span>
				</div>
			</div>
		</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["mobile"]){?>
		<div class="input_wrap">
			<div class="asterisk"><?php if($GLOBALS["checked_mobile"]["reqField"]["mobile"]){?>*<?php }?></div>
			<div class="input_title">휴대폰</div>
			<div class="input_content">
				<input type="number" name="mobile[]" value="<?php echo $TPL_VAR["mobile"][ 0]?>" placeholder="Enter Text" pattern="[0-9]*" min="000" max="999" maxlength="3" class="w25 mobile_all" style="ime-mode:disabled" label="휴대폰" <?php if($GLOBALS["checked_mobile"]["reqField"]["mobile"]){?>required<?php }?> <?php echo $TPL_VAR["mobileReadonly"]?> /> -
				<input type="number" name="mobile[]" value="<?php echo $TPL_VAR["mobile"][ 1]?>" placeholder="Enter Text" pattern="[0-9]*" min="0000" max="9999" maxlength="4" class="w25 mobile_all" style="ime-mode:disabled" label="휴대폰" <?php if($GLOBALS["checked_mobile"]["reqField"]["mobile"]){?>required<?php }?> <?php echo $TPL_VAR["mobileReadonly"]?> /> -
				<input type="number" name="mobile[]" value="<?php echo $TPL_VAR["mobile"][ 2]?>" placeholder="Enter Text" pattern="[0-9]*" min="0000" max="9999" maxlength="4" class="w25 mobile_all" style="ime-mode:disabled" label="휴대폰" <?php if($GLOBALS["checked_mobile"]["reqField"]["mobile"]){?>required<?php }?> <?php echo $TPL_VAR["mobileReadonly"]?> />
				<div>
<?php if($TPL_VAR["hpauthyn"]=='y'&&$TPL_VAR["moduseyn"]=='y'){?>
					<span class="block btn_pad"><button id="editNumber">번호 변경하기</button></span>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["sms"]){?>
					<span class="block description"><label><input type="checkbox" name="sms" <?php echo $GLOBALS["checked"]["sms"]?> /> 광고성 정보,이벤트SMS수신</label></span>
					<span class="block description">※ 주문정보 등 주요 안내사항은 동의 여부에 관계없이 자동 발송됩니다.</span>
<?php }?>
				</div>
			</div>
		</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["phone"]){?>
		<div class="input_wrap">
			<div class="asterisk"><?php if($GLOBALS["checked_mobile"]["reqField"]["phone"]){?>*<?php }?></div>
			<div class="input_title">전화번호</div>
			<div class="input_content">
				<input type="number" name="phone[]" value="<?php echo $TPL_VAR["phone"][ 0]?>" placeholder="Enter Text" pattern="[0-9]*" maxlength="3" min="000" max="999" class="w25" style="ime-mode:disabled" label="전화번호" <?php if($GLOBALS["checked_mobile"]["reqField"]["phone"]){?>required<?php }?> /> -
				<input type="number" name="phone[]" value="<?php echo $TPL_VAR["phone"][ 1]?>" placeholder="Enter Text" pattern="[0-9]*" maxlength="4" min="0000" max="9999" class="w25" style="ime-mode:disabled" label="전화번호" <?php if($GLOBALS["checked_mobile"]["reqField"]["phone"]){?>required<?php }?> /> -
				<input type="number" name="phone[]" value="<?php echo $TPL_VAR["phone"][ 2]?>" placeholder="Enter Text" pattern="[0-9]*" maxlength="4" min="0000" max="9999" class="w25" style="ime-mode:disabled" label="전화번호" <?php if($GLOBALS["checked_mobile"]["reqField"]["phone"]){?>required<?php }?> />
			</div>
		</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["fax"]){?>
		<div class="input_wrap">
			<div class="asterisk"><?php if($GLOBALS["checked_mobile"]["reqField"]["fax"]){?>*<?php }?></div>
			<div class="input_title">팩스</div>
			<div class="input_content">
				<input type="number" value="<?php echo $TPL_VAR["fax"][ 0]?>" placeholder="Enter Text" pattern="[0-9]*" name="fax[]" maxlength="3" min="000" max="999" class="w25" style="ime-mode:disabled" label="팩스" <?php if($GLOBALS["checked_mobile"]["reqField"]["fax"]){?>required<?php }?>/> -
				<input type="number" value="<?php echo $TPL_VAR["fax"][ 1]?>" placeholder="Enter Text" pattern="[0-9]*" name="fax[]" maxlength="4" min="0000" max="9999" class="w25" style="ime-mode:disabled" label="팩스" <?php if($GLOBALS["checked_mobile"]["reqField"]["fax"]){?>required<?php }?>/> -
				<input type="number" value="<?php echo $TPL_VAR["fax"][ 2]?>" placeholder="Enter Text" pattern="[0-9]*" name="fax[]" maxlength="4" min="0000" max="9999" class="w25" style="ime-mode:disabled" label="팩스" <?php if($GLOBALS["checked_mobile"]["reqField"]["fax"]){?>required<?php }?>/>
			</div>
		</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["company"]){?>
		<div class="input_wrap">
			<div class="asterisk"><?php if($GLOBALS["checked_mobile"]["reqField"]["company"]){?>*<?php }?></div>
			<div class="input_title">회사</div>
			<div class="input_content">
				<input type="text" name="company" value="<?php echo $TPL_VAR["company"]?>" maxlength="10" class="w100" style="ime-mode:active" label="회사" <?php if($GLOBALS["checked_mobile"]["reqField"]["company"]){?>required<?php }?> />
			</div>
		</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["service"]){?>
		<div class="input_wrap">
			<div class="asterisk"><?php if($GLOBALS["checked_mobile"]["reqField"]["service"]){?>*<?php }?></div>
			<div class="input_title">업태</div>
			<div class="input_content">
				<input type="text" name="service" value="<?php echo $TPL_VAR["service"]?>" maxlength="20" class="w100" style="ime-mode:active" label="업태"  <?php if($GLOBALS["checked_mobile"]["reqField"]["service"]){?>required<?php }?> />
			</div>
		</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["item"]){?>
		<div class="input_wrap">
			<div class="asterisk"><?php if($GLOBALS["checked_mobile"]["reqField"]["item"]){?>*<?php }?></div>
			<div class="input_title">종목</div>
			<div class="input_content">
				<input type="text" name="item" value="<?php echo $TPL_VAR["item"]?>" maxlength="20" class="w100" style="ime-mode:active" label="종목" <?php if($GLOBALS["checked_mobile"]["reqField"]["item"]){?>required<?php }?>/>
			</div>
		</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["busino"]){?>
		<div class="input_wrap">
			<div class="asterisk"><?php if($GLOBALS["checked_mobile"]["reqField"]["busino"]){?>*<?php }?></div>
			<div class="input_title">사업자번호</div>
			<div class="input_content">
				<input type="number" name="busino" value="<?php echo $TPL_VAR["busino"]?>" maxlength="11" min="00000000000" max="99999999999" class="w100" style="ime-mode:active" label="사업자번호" <?php if($GLOBALS["checked_mobile"]["reqField"]["busino"]){?>required<?php }?> />
			</div>
		</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["job"]){?>
		<div class="input_wrap">
			<div class="asterisk"><?php if($GLOBALS["checked_mobile"]["reqField"]["job"]){?>*<?php }?></div>
			<div class="input_title">직업</div>
			<div class="input_content">
				<select name="job" class="w100" label="직업" <?php if($GLOBALS["checked_mobile"]["reqField"]["job"]){?>required<?php }?>>
					<option value="">==선택하세요==</option>
<?php if((is_array($TPL_R1=codeitem('job'))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_K1=>$TPL_V1){?>
					<option value="<?php echo $TPL_K1?>" <?php echo $GLOBALS["selected"]["job"][$TPL_K1]?>><?php echo $TPL_V1?></option>
<?php }}?>
				</select>
			</div>
		</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["interest"]){?>
		<div class="input_wrap">
			<div class="asterisk"><?php if($GLOBALS["checked_mobile"]["reqField"]["interest"]){?>*<?php }?></div>
			<div class="input_title">관심분야</div>
			<div class="input_content">
<?php if((is_array($TPL_R1=codeitem('like'))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_K1=>$TPL_V1){?>
				<span class="block"><input type="checkbox" name="interest[]" value="<?php echo pow( 2,$TPL_K1+ 0)?>" <?php if($TPL_VAR["interest"]&pow( 2,$TPL_K1+ 0)){?>checked<?php }?>  label="관심분야" <?php if($GLOBALS["checked_mobile"]["reqField"]["interest"]){?>required<?php }?>/> <?php echo $TPL_V1?></span>
<?php }}?>
			</div>
		</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["ex1"]){?>
		<div class="input_wrap">
			<div class="asterisk"><?php if($GLOBALS["checked_mobile"]["reqField"]["ex1"]){?>*<?php }?></div>
			<div class="input_title"><?php echo $GLOBALS["joinset"]["ex1"]?></div>
			<div class="input_content">
				<input type="text" name="ex1" value="<?php echo $TPL_VAR["ex1"]?>" maxlength="20" class="w100" style="ime-mode:active" label="<?php echo $GLOBALS["joinset"]["ex1"]?>" <?php if($GLOBALS["checked_mobile"]["reqField"]["ex1"]){?>required<?php }?> />
			</div>
		</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["ex2"]){?>
		<div class="input_wrap">
			<div class="asterisk"><?php if($GLOBALS["checked_mobile"]["reqField"]["ex2"]){?>*<?php }?></div>
			<div class="input_title"><?php echo $GLOBALS["joinset"]["ex2"]?></div>
			<div class="input_content">
				<input type="text" name="ex2" value="<?php echo $TPL_VAR["ex2"]?>" maxlength="20" class="w100" style="ime-mode:active" label="<?php echo $GLOBALS["joinset"]["ex2"]?>" <?php if($GLOBALS["checked_mobile"]["reqField"]["ex2"]){?>required<?php }?> />
			</div>
		</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["ex3"]){?>
		<div class="input_wrap">
			<div class="asterisk"><?php if($GLOBALS["checked_mobile"]["reqField"]["ex3"]){?>*<?php }?></div>
			<div class="input_title"><?php echo $GLOBALS["joinset"]["ex3"]?></div>
			<div class="input_content">
				<input type="text" name="ex3" value="<?php echo $TPL_VAR["ex3"]?>" maxlength="20" class="w100" style="ime-mode:active" label="<?php echo $GLOBALS["joinset"]["ex3"]?>" <?php if($GLOBALS["checked_mobile"]["reqField"]["ex3"]){?>required<?php }?> />
			</div>
		</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["ex4"]){?>
		<div class="input_wrap">
			<div class="asterisk"><?php if($GLOBALS["checked_mobile"]["reqField"]["ex4"]){?>*<?php }?></div>
			<div class="input_title"><?php echo $GLOBALS["joinset"]["ex4"]?></div>
			<div class="input_content">
				<input type="text" name="ex4" value="<?php echo $TPL_VAR["ex4"]?>" maxlength="20" class="w100" style="ime-mode:active" label="<?php echo $GLOBALS["joinset"]["ex4"]?>" <?php if($GLOBALS["checked_mobile"]["reqField"]["ex4"]){?>required<?php }?> />
			</div>
		</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["ex5"]){?>
		<div class="input_wrap">
			<div class="asterisk"><?php if($GLOBALS["checked_mobile"]["reqField"]["ex5"]){?>*<?php }?></div>
			<div class="input_title"><?php echo $GLOBALS["joinset"]["ex5"]?></div>
			<div class="input_content">
				<input type="text" name="ex5" value="<?php echo $TPL_VAR["ex5"]?>" maxlength="20" class="w100" style="ime-mode:active" label="<?php echo $GLOBALS["joinset"]["ex5"]?>" <?php if($GLOBALS["checked_mobile"]["reqField"]["ex5"]){?>required<?php }?> />
			</div>
		</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["ex6"]){?>
		<div class="input_wrap">
			<div class="asterisk"><?php if($GLOBALS["checked_mobile"]["reqField"]["ex6"]){?>*<?php }?></div>
			<div class="input_title"><?php echo $GLOBALS["joinset"]["ex6"]?></div>
			<div class="input_content">
				<input type="text" name="ex6" value="<?php echo $TPL_VAR["ex6"]?>" maxlength="20" class="w100" style="ime-mode:active" label="<?php echo $GLOBALS["joinset"]["ex6"]?>" <?php if($GLOBALS["checked_mobile"]["reqField"]["ex6"]){?>required<?php }?> />
			</div>
		</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["memo"]){?>
		<div class="input_wrap">
			<div class="asterisk"><?php if($GLOBALS["checked_mobile"]["reqField"]["memo"]){?>*<?php }?></div>
			<div class="input_title">남기는 말씀</div>
			<div class="input_content">
				<input type="text" name="memo" value="<?php echo $TPL_VAR["memo"]?>" class="w100" style="ime-mode:active" label="남기는말씀" <?php if($GLOBALS["checked_mobile"]["reqField"]["memo"]){?>required<?php }?> />
			</div>
		</div>
<?php }?>
<?php if($GLOBALS["checked_mobile"]["useField"]["recommid"]){?>
		<div class="input_wrap">
			<div class="asterisk"><?php if($GLOBALS["checked_mobile"]["reqField"]["recommid"]){?>*<?php }?></div>
			<div class="input_title">추천인아이디</div>
			<div class="input_content"><?php echo $TPL_VAR["recommid"]?></div>
		</div>
<?php }?>
	</div>
	<div class="confirm_btn">
		<button id="next-btn" class="iblock" />정보수정</button>
		<button id="cancel-btn" class="iblock white" />취소</button>
	</div>
</form>
</section>