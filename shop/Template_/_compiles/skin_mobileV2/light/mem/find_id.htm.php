<?php /* Template_ 2.2.7 2016/07/13 19:56:01 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/mem/find_id.htm 000004122 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>

<?php  $TPL_VAR["page_title"] = "아이디 찾기";?>
<?php $this->print_("sub_header",$TPL_SCP,1);?>


<section class="find_common_layout">
<?php if($TPL_VAR["act"]=='Y'&&$GLOBALS["m_id"]){?>
		<div class="find_common_center">
			<div class="find_id_info"><span><?php echo $GLOBALS["name"]?></span> 회원님의 아이디는 <span><?php echo $GLOBALS["m_id"]?></span> 입니다.</div>
		</div>
<?php }else{?>
		<form name="fm" id="fm" action="" method="post" onsubmit="return chkForm(this);">
		<input type="hidden" name="act" value="Y">
		<input type="hidden" name="rncheck" value="none">
		<input type="hidden" name="dupeinfo" value="">
			<fieldset>
				<div class="find_common_center">
					<div class="find_common_title">회원정보로 찾기</div>
					<label for="srch_name">
						<input type="text" name="srch_name" id="srch_name" value="" title="이름" required="required" msgR="이름을 입력하세요." placeholder="이름" tabindex="1" />
					</label>
<?php if($GLOBALS["checked"]["useField"]["email"]){?>
					<label for="srch_mail">
						<input type="email" name="srch_mail" id="srch_mail" value="" title="가입 메일주소" option=regEmail label="가입 메일주소" required="required" msgR="가입 메일주소를 입력하세요." placeholder="가입 메일주소" tabindex="1" class="find_common_margin_bottom" />
					</label>
<?php }?>
					<div class="find_common_step_btn"><button id="find_id_btn" type="submit" tabindex="5">찾기</button></div>

<?php if($TPL_VAR["ipinType"]||$TPL_VAR["hpauthyn"]=='y'){?>
					<div class="find_id_authentication">
						<div class="authentication-title">회원가입 시 사용한 본인인증 수단으로 찾기</div>

<?php if($TPL_VAR["ipinType"]=='ipin'||$TPL_VAR["ipinType"]=='niceipin'){?>
						<button type="button" id="find_id_ipin">아이핀 인증</button>
						<iframe id="ifrmRnCheck" name="ifrmRnCheck" style="width:500px;height:500px;display:none;"></iframe>
<?php }?>

<?php if($TPL_VAR["hpauthyn"]=='y'){?>
						<button type="button" id="find_id_hpauth">휴대폰 인증</button>
<?php }?>

					</div>
<?php }?>
				</div>
			</fieldset>
		</form>
<?php }?>

	<div class="find_common_bottom_center">
		<div class="find_common_bottom_btn">
			<button id="login_btn" tabindex="5" onclick="javascript:location.replace('./login.php');">로그인</button>
			<button id="find_password_btn" tabindex="5" onclick="javascript:location.replace('./find_password.php');">비밀번호 찾기</button>
		</div>
	</div>
</section>

<script type="text/javascript">
$(document).ready(function(){
	var act = '<?php echo $TPL_VAR["act"]?>';
	if(act == 'Y'){
		var resultID = '<?php echo $GLOBALS["m_id"]?>';
		if(!resultID){
			alert("입력하신 정보로 회원정보를 찾을 수 없습니다.\n정보가 정확한지 확인 후 다시 시도해 주세요");
		}
	}

	//아이핀
	$("#find_id_ipin").bind("click", function(){
		var ipinType = '<?php echo $TPL_VAR["ipinType"]?>';
		if(ipinType == 'niceipin' || ipinType == 'ipin'){
			frmMake('', 'popupCertKey', '아이핀인증', true);
			$("meta[name='viewport']").attr({"content":"user-scalable=yes, width=480"});
			if(ipinType == 'niceipin'){
				$("#ifrmRnCheck").attr("src", "<?php echo $GLOBALS["cfg"]["rootDir"]?>/member/ipin/IPINMain.php?callType=findid&joinGubun=mobile");
			}
			else {
				$("#ifrmRnCheck").attr("src", "<?php echo $GLOBALS["cfg"]["rootDir"]?>/member/ipin/IPINCheckRequest.php?callType=findid&joinGubun=mobile");
			}
		}
	});

	//휴대폰인증
	$("#find_id_hpauth").bind("click", function(){
		var protocol = location.protocol;
		var callbackUrl = "<?php echo ProtocolPortDomain()?><?php echo $GLOBALS["cfg"]["rootDir"]?>/member/hpauthDream/hpauthDream_Result.php";
		frmMake(protocol + "//hpauthdream.godo.co.kr/module/Mobile_hpauthDream_Main.php?callType=findid&shopUrl=" + callbackUrl + "&cpid=<?php echo $TPL_VAR["hpauthCPID"]?>", 'hpauthFrame', '휴대폰본인인증', false);
	});
});
</script>

<?php $this->print_("footer",$TPL_SCP,1);?>