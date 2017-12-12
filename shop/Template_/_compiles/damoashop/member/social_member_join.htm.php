<?php /* Template_ 2.2.7 2015/11/14 11:53:46 /www/jbsinttr8192_godo_co_kr/shop/data/skin/damoashop/member/social_member_join.htm 000017748 */ 
if (is_array($TPL_VAR["consentData"])) $TPL_consentData_1=count($TPL_VAR["consentData"]); else if (is_object($TPL_VAR["consentData"]) && in_array("Countable", class_implements($TPL_VAR["consentData"]))) $TPL_consentData_1=$TPL_VAR["consentData"]->count();else $TPL_consentData_1=0;?>
<?php $this->print_("header",$TPL_SCP,1);?>


<style type="text/css">
.scroll	{
scrollbar-face-color: #FFFFFF;
scrollbar-shadow-color: #AFAFAF;
scrollbar-highlight-color: #AFAFAF;
scrollbar-3dlight-color: #FFFFFF;
scrollbar-darkshadow-color: #FFFFFF;
scrollbar-track-color: #F7F7F7;
scrollbar-arrow-color: #838383;
}
#boxScroll{width:96%; height:130px; overflow: auto; BACKGROUND: #ffffff; COLOR: #585858; font:9pt 돋움;border:1px #dddddd solid; overflow-x:hidden;text-align:left;margin-left:10px;}
</style>

<script type="text/javascript">
var checkedID;
window.onload = function()
{
	var socialMemberJoinForm = document.getElementById("form");
	var checkIDDuplicate = document.getElementById("check-id-duplicate");

	socialMemberJoinForm.submit = function()
	{
		this.action = "./social_member.php";
		var formSubmit = document.getElementById("form-submit");
		formSubmit.click();
	};
	checkIDDuplicate.onclick = function()
	{
		checkedID = socialMemberJoinForm.m_id.value;
		ifrmHidden.location.href="<?php echo url("member/indb.php?")?>&mode=chkId&m_id=" + socialMemberJoinForm.m_id.value;
	};

	// 본인확인 로직에서는 frmAgree를 사용
	document.frmAgree = document.frmMember;

	defaultRnCheckType();
};
var checkSubmit = function()
{
	var socialMemberJoinForm = document.getElementById("form");
	var rdo_ipin = document.getElementById("RnCheckType_ipin");
	var rdo_hpauthDream = document.getElementById("RnCheckType_hpauthDream");

	var result = chkForm2(socialMemberJoinForm);
	if (!result) {
		return;
	}
	else {
		if (checkedID !== socialMemberJoinForm.m_id.value) {
			socialMemberJoinForm.chk_id.value = "";
		}
		if (socialMemberJoinForm.chk_id.value !== "1") {
			alert("아이디 중복체크를 해주시기 바랍니다.");
			return;
		}
		if (!socialMemberJoinForm.m_id.value.match(/^[\xa1-\xfea-zA-Z0-9_-]{4,20}$/)) {
			alert('아이디 입력 형식 오류입니다');
			return;
		}

		// 만14세 미만 회원가입 가능여부 생년월일로 체크
		var under14Code = '<?php echo $TPL_VAR["under14Code"]?>';
		var under14Status = '<?php echo $TPL_VAR["under14Status"]?>';
		if (under14Code == 'needBirthCheck') {
			var birthDay = '';
			if (typeof(socialMemberJoinForm['birth_year']) != 'undefined' && typeof(socialMemberJoinForm['birth[]'][0]) != 'undefined' && typeof(socialMemberJoinForm['birth[]'][0]) != 'undefined') {
				bY = '0000' + socialMemberJoinForm['birth_year'].value;
				bM = '00' + socialMemberJoinForm['birth[]'][0].value;
				bD = '00' + socialMemberJoinForm['birth[]'][1].value;
				birthDay = bY.substring(bY.length-4) + bM.substring(bM.length-2) + bD.substring(bD.length-2);
			}
			if (chkUnder14(birthDay, under14Status, under14Code) === false) {
				return;
			}
		}
	}
	
	if (rdo_ipin && rdo_ipin.checked) {
		goIDCheckIpin();
	}
	else if (rdo_hpauthDream && rdo_hpauthDream.checked) {
		gohpauthDream();
	}
	else {
		if (chkagreement(socialMemberJoinForm)) {
			socialMemberJoinForm.submit();
		}
	}
};
var defaultRnCheckType = function()
{
	var authtype = document.getElementsByName("RnCheckType");

	if (authtype.item(0) != null) {
		var div_jumin = document.getElementById("div_RnCheck_jumin");
		var div_ipin = document.getElementById("div_RnCheck_ipin");
		var div_hpauthDream = document.getElementById("div_RnCheck_hpauthDream");

		if (authtype.item(0).value == "jumin") {
			div_jumin.style.display = "";
		}
		else if (authtype.item(0).value == "ipin") {
			div_ipin.style.display = "";
		}
		else if (authtype.item(0).value == "hpauthDream") {
			div_hpauthDream.style.display = "";
		}
		authtype.item(0).checked = true;
	}	
};
var selectRnCheckType = function()
{
	var div_jumin = document.getElementById("div_RnCheck_jumin");
	var div_ipin = document.getElementById("div_RnCheck_ipin");
	var div_hpauthDream = document.getElementById("div_RnCheck_hpauthDream");

	var rdo_jumin = document.getElementById("RnCheckType_jumin");
	var rdo_ipin = document.getElementById("RnCheckType_ipin");
	var rdo_hpauthDream = document.getElementById("RnCheckType_hpauthDream");

	if (rdo_jumin && rdo_jumin.checked == true) {
		if (div_jumin != null) {
			div_jumin.style.display = "";
		}
		if (div_ipin != null) {
			div_ipin.style.display = "none";
		}
		if (div_hpauthDream != null) {
			div_hpauthDream.style.display = "none";
		}
	}
	if (rdo_ipin && rdo_ipin.checked == true) {
		if (div_jumin != null) {
			div_jumin.style.display = "none";
		}
		if (div_ipin != null) {
			div_ipin.style.display = "";
		}
		if (div_hpauthDream != null) {
			div_hpauthDream.style.display = "none";
		}
	}
	if (rdo_hpauthDream && rdo_hpauthDream.checked == true) {
		if (div_jumin != null) {
			div_jumin.style.display = "none";
		}
		if (div_ipin != null) {
			div_ipin.style.display = "none";
		}
		if (div_hpauthDream != null) {
			div_hpauthDream.style.display = "";
		}
	}
};
var chkForm2 = function(fm)
{
	if (typeof(goIDCheck) != "undefined") {
		if (goIDCheck(fm) === false) {
			return false;
		}
	}

	return chkagreement(fm);
};
var chkagreement = function(fm)
{
	if (chkRadioSelect(fm, "agree", "y", "[회원가입 이용약관]에 동의를 하셔야 회원가입이 가능합니다.") === false) {
		return false;
	}
	if (chkRadioSelect(fm, "private1", "y", "[개인정보취급방침]에 동의를 하셔야 회원가입이 가능합니다.") === false) {
		return false;
	}

<?php if($TPL_consentData_1){foreach($TPL_VAR["consentData"] as $TPL_V1){?>
<?php if($TPL_V1["requiredyn"]=='y'){?>
	if (chkRadioSelect(fm, "consent[<?php echo $TPL_V1["sno"]?>]", "y", "[<?php echo $TPL_V1["title"]?>]에 동의를 하셔야 회원가입이 가능합니다.") === false) {
		return false;
	}
<?php }?>
<?php }}?>

	return true;
};
</script>

<!-- 상단이미지 || 현재위치 -->
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td><img src="/shop/data/skin/damoashop/img/common/title_join.gif" border="0"></td>
	</tr>
	<tr>
		<td class="path">HOME > 회원가입 > <strong>SNS계정 회원가입</strong></td>
	</tr>
</table>


<div class="indiv"><!-- Start indiv -->

	<form id="form" name="frmMember" method="post" action="<?php echo url("member/social_member.php")?>&" target="ifrmHidden">
		<input type="hidden" name="MODE" value="join">
		<input type="hidden" name="SOCIAL_CODE" value="<?php echo $TPL_VAR["SOCIAL_CODE"]?>"/>
		<input type="hidden" name="chk_id" value=""/>
		<input type="hidden" name="email" value="<?php echo $TPL_VAR["email"]?>"/>
		<input type="hidden" name="mode" value="chkRealName">
		<input type="hidden" name="rncheck" value="none">
		<input type="hidden" name="nice_nm" value="">
		<input type="hidden" name="pakey" value="">
		<input type="hidden" name="mobile" value="">
		<input type="hidden" name="dupeinfo" value="">
<?php if($TPL_VAR["realnameyn"]=='y'||$TPL_VAR["ipinyn"]=='y'||$TPL_VAR["niceipinyn"]=='y'||$TPL_VAR["hpauthDreamyn"]=='y'){?>
		<input type="hidden" name="birthday" value="">
<?php }?>
		<input type="hidden" name="sex" value="">
		<input type="hidden" name="foreigner" value="">
		<input type="hidden" name="type">
<?php if($TPL_VAR["realnameyn"]=='y'||$TPL_VAR["ipinyn"]=='y'||$TPL_VAR["niceipinyn"]=='y'||$TPL_VAR["hpauthDreamyn"]=='y'){?>
		<input type="hidden" name="name" value="<?php echo $TPL_VAR["name"]?>"/>
<?php }?>

		<!-- 이용약관 -->
		<div style="margin-bottom:10px;"><strong>이용약관</strong></div>
		<table width="100%" height="160" cellpadding="0" cellspacing="0" border="0" style="border:1px solid #ccc; margin-bottom:25px;">
		<tr>
			<td><div style="height:160px; padding:20px; overflow-y:scroll;"><?php echo nl2br($TPL_VAR["termsAgreement"])?></div></td>
			<td width="130" style="padding:17px; background:#f1f1f1; border-left:1px solid #ccc;">
				<input type="radio" name="agree" value="y" style="border:0; background:;"> 동의합니다<br />
				<input type="radio" name="agree" value="n" style="border:0; background:;"> 동의하지 않습니다
			</td>
		</tr>
		</table>
		<!-- 개인정보취급방침 -->
		<div style="margin-bottom:10px;"><strong><span style="color:#ff0000;">[필수]</span> 개인정보취급방침</strong> <span style="font-size:.9em; color:#858585;">(자세한 내용은 “<a href="<?php echo url("service/private.php")?>&" style="color:#858585;">개인정보취급방침</a>”을 확인하시기 바랍니다)</span></div>
		<table width="100%" height="160" cellpadding="0" cellspacing="0" border="0" style="border:1px solid #ccc; margin-bottom:25px;">
		<tr>
			<td><div style="height:160px; padding:20px; overflow-y:scroll;"><?php echo $TPL_VAR["termsPolicyCollection2"]?></div></td>
			<td width="130" style="padding:17px; background:#f1f1f1; border-left:1px solid #ccc;">
				<input type="radio" name="private1" value="y" style="border:0; background:;"> 동의합니다<br />
				<input type="radio" name="private1" value="n" style="border:0; background:;"> 동의하지 않습니다
			</td>
		</tr>
		</table>

<?php if($GLOBALS["cfg"]['private2YN']=='Y'){?>
		<div style="margin-bottom:10px;"><strong><span style="color:#ff0000;">[선택]</span> 개인정보 제3자 제공 관련</strong></div>
		<table width="100%" height="160" cellpadding="0" cellspacing="0" border="0" style="border:1px solid #ccc; margin-bottom:25px;">
		<tr>
			<td><div style="height:160px; padding:20px; overflow-y:scroll;"><?php echo $TPL_VAR["termsThirdPerson"]?></div></td>
			<td width="130" style="padding:17px; background:#f1f1f1; border-left:1px solid #ccc;">
				<input type="radio" name="private2" value="y" style="border:0; background:;" label="개인정보 제3자 제공 관련" msgR="동의 여부를 체크해주세요."> 동의합니다<br />
				<input type="radio" name="private2" value="n" style="border:0; background:;" label="개인정보 제3자 제공 관련" msgR="동의 여부를 체크해주세요."> 동의하지 않습니다
			</td>
		</tr>
		</table>
<?php }?>

<?php if($GLOBALS["cfg"]['private3YN']=='Y'){?>
		<div style="margin-bottom:10px;"><strong><span style="color:#ff0000;">[선택]</span> 개인정보취급 위탁 관련</strong></div>
		<table width="100%" height="160" cellpadding="0" cellspacing="0" border="0" style="border:1px solid #ccc; margin-bottom:25px;">
		<tr>
			<td><div style="height:160px; padding:20px; overflow-y:scroll;"><?php echo $TPL_VAR["termsEntrust"]?></div></td>
			<td width="130" style="padding:17px; background:#f1f1f1; border-left:1px solid #ccc;">
				<input type="radio" name="private3" value="y" style="border:0; background:;" label="개인정보취급 위탁 관련" msgR="동의 여부를 체크해주세요."> 동의합니다<br />
				<input type="radio" name="private3" value="n" style="border:0; background:;" label="개인정보취급 위탁 관련" msgR="동의 여부를 체크해주세요."> 동의하지 않습니다
			</td>
		</tr>
		</table>
<?php }?>

<?php if($TPL_consentData_1){foreach($TPL_VAR["consentData"] as $TPL_V1){?>
		<div style="margin-bottom:10px;"><strong><span style="color:#ff0000;">[<?php echo $TPL_V1["requiredyn_text"]?>]</span> <?php echo $TPL_V1["title"]?></strong></div>
		<table width="100%" height="160" cellpadding="0" cellspacing="0" border="0" style="border:1px solid #ccc; margin-bottom:25px;">
		<tr>
			<td><div style="height:160px; padding:20px; overflow-y:scroll;"><?php echo nl2br($TPL_V1["termsContent"])?></div></td>
			<td width="130" style="padding:17px; background:#f1f1f1; border-left:1px solid #ccc;">
				<input type="radio" name="consent[<?php echo $TPL_V1["sno"]?>]" value="y" style="border:0; background:;" label="<?php echo $TPL_V1["title"]?>" msgR="동의 여부를 체크해주세요."> 동의합니다<br />
				<input type="radio" name="consent[<?php echo $TPL_V1["sno"]?>]" value="n" style="border:0; background:;" label="<?php echo $TPL_V1["title"]?>" msgR="동의 여부를 체크해주세요."> 동의하지 않습니다
			</td>
		</tr>
		</table>
<?php }}?>

		<div style="padding-left: 7px; color: #f7443f; font-weight: bold; margin-top: 20px; margin-bottom: 10px;">필수등록정보확인</div>
		<div style="border: 1px solid #dedede; margin-bottom: 20px;" class="hundred">
			<div style="border: 5px solid #f3f3f3; padding: 10px;">
				<table>
					<tr>
						<td>아이디</td>
						<td>
							<input type="text" name="m_id" value="<?php echo $TPL_VAR["email_id"]?>" label="아이디" fld_esssential/>
							<button id="check-id-duplicate" type="button" style="width: 79px; height: 17px; vertical-align: middle; background: url('/shop/data/skin/damoashop/img/common/btn_idcheck.gif') no-repeat; border: none; font-size: 0; text-indent: -9999px; display: inline-block;">중복체크</button>
						</td>
					</tr>
<?php if($TPL_VAR["realnameyn"]!=='y'&&$TPL_VAR["ipinyn"]!=='y'&&$TPL_VAR["niceipinyn"]!=='y'&&$TPL_VAR["hpauthDreamyn"]!=='y'){?>
					<tr>
						<td>이름</td>
						<td>
							<input type="text" name="name" value="<?php echo $TPL_VAR["name"]?>" label="이름" fld_esssential/>
						</td>
					</tr>
<?php }?>
<?php if($GLOBALS["checked"]["useField"]["birth"]&&$TPL_VAR["realnameyn"]!=='y'&&$TPL_VAR["ipinyn"]!=='y'&&$TPL_VAR["niceipinyn"]!=='y'&&$TPL_VAR["hpauthDreamyn"]!=='y'){?>
					<tr>
						<td>생년월일</td>
						<td>
						<input type=text name=birth_year value="<?php echo $TPL_VAR["birth_year"]?>" <?php echo $GLOBALS["required"]["birth"]?> label="생년월일" size=4 maxlength=4>년
						<input type=text name=birth[] value="<?php echo $TPL_VAR["birth"][ 0]?>" <?php echo $GLOBALS["required"]["birth"]?> label="생년월일" size=2 maxlength=2>월
						<input type=text name=birth[] value="<?php echo $TPL_VAR["birth"][ 1]?>" <?php echo $GLOBALS["required"]["birth"]?> label="생년월일" size=2 maxlength=2>일

<?php if($GLOBALS["checked"]["useField"]["calendar"]){?>
						<span class=noline style="padding-left:10px">
						<input type=radio name=calendar value="s" checked> 양력
						<input type=radio name=calendar value="l" <?php echo $GLOBALS["checked"]["calendar"]["l"]?>> 음력
						</span>
<?php }?>
						</td>
					</tr>
<?php }?>
<?php if($GLOBALS["checked"]["useField"]["mailling"]){?>
					<tr>
						<td colspan="2"><span class=noline"><input type=checkbox name=mailling <?php echo $GLOBALS["checked"]["mailling"]?>><span style="font:8pt 돋움;color:#007FC8" >정보,이벤트메일수신</span></span>
						<div style="letter-spacing:-1;color:#FF6000">※ <span style="font-size:8pt;">주문 관련 정보, 주요 공지사항 및 이벤트 당첨 안내 등은 수신 동의 여부에 관계없이 자동 발송됩니다.</span></div></td>
					</tr>
<?php }?>
				</table>
			</div>
		</div>

		<!-- 본인확인 인증수단 -->
<?php if($TPL_VAR["realnameyn"]=='y'||$TPL_VAR["ipinyn"]=='y'||$TPL_VAR["niceipinyn"]=='y'||$TPL_VAR["hpauthDreamyn"]=='y'){?>
		<div style="padding-left:7"><font color=f7443f><b>본인확인 인증 수단</b></font></div>
		<table height="35">
			<tr>
<?php if($TPL_VAR["realnameyn"]=='y'){?>	
				<td class="noline">
					<label for="RnCheckType_jumin" style="width:130px;height:20px;display:inline-block;background:url('/shop/data/skin/damoashop/img/ipin/Regist_realName_title_1.gif') no-repeat 17px 3px;">
					<input type="radio" name="RnCheckType" value="jumin" id="RnCheckType_jumin" onclick="selectRnCheckType()">
					</label>
				</td>
				<td width="5">&nbsp;</td>				
<?php }?>
<?php if($TPL_VAR["ipinyn"]=='y'||$TPL_VAR["niceipinyn"]=='y'){?>
				<td class="noline">
					<label for="RnCheckType_ipin" style="width:150px;height:20px;display:inline-block;background:url('/shop/data/skin/damoashop/img/ipin/Regist_realName_title_2.gif') no-repeat 17px 3px;">
					<input type="radio" name="RnCheckType" value="ipin" id="RnCheckType_ipin" onclick="selectRnCheckType()">
					</label>
				</td>
				<td width="5">&nbsp;</td>
<?php }?>
<?php if($TPL_VAR["hpauthDreamyn"]=='y'){?>
				<td class="noline">
					<label for="RnCheckType_hpauthDream" style="width:150px;height:20px;display:inline-block;background:url('/shop/data/skin/damoashop/img/auth/hpauth_title_3.gif') no-repeat 17px 3px;">
					<input type="radio" name="RnCheckType" value="hpauthDream" id="RnCheckType_hpauthDream" onclick="selectRnCheckType()">
					</label>
				</td>
				<td width="5">&nbsp;</td>
<?php }?>		
			</tr>
		</table>
<?php }?>


<?php if($TPL_VAR["realnameyn"]=='y'){?>	
		<?php echo $this->define('tpl_include_file_1',"member/NiceCheck.htm")?> <?php $this->print_("tpl_include_file_1",$TPL_SCP,1);?>

<?php }?>

<?php if($TPL_VAR["ipinyn"]=='y'){?>
		<?php echo $this->define('tpl_include_file_2',"member/NiceIpin.htm")?> <?php $this->print_("tpl_include_file_2",$TPL_SCP,1);?>

<?php }else{?>
		<?php echo $this->define('tpl_include_file_3',"member/NewNiceIpin.htm")?> <?php $this->print_("tpl_include_file_3",$TPL_SCP,1);?>

<?php }?>

<?php if($TPL_VAR["hpauthDreamyn"]=='y'){?>
		<?php echo $this->define('tpl_include_file_4',"member/hpauthDream.htm")?> <?php $this->print_("tpl_include_file_4",$TPL_SCP,1);?>

<?php }?>

		<!-- 하단버튼 -->
		<div align="center" style="padding: 50px 0 20px 0" class="noline">
			<input id="form-submit" type="submit" style="display: none;"/>
			<a href="javascript:checkSubmit();"><img src="/shop/data/skin/damoashop/img/common/btn_join.gif"/></a>
			<a href="javascript:history.back();"><img src="/shop/data/skin/damoashop/img/common/btn_back.gif" border="0"/></a>
		</div>

	</form>

</div><!-- End indiv -->

<?php $this->print_("footer",$TPL_SCP,1);?>