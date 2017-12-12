<?php /* Template_ 2.2.7 2013/07/22 16:59:57 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/mem/endjoin.htm 000001049 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>

<?php  $TPL_VAR["page_title"] = "회원가입<span class='small_title'>(가입완료)</span>";?>
<?php $this->print_("sub_header",$TPL_SCP,1);?>


<section class="content" id="memberjoin">

	<div class="join_step">
		<div class="join_step1">약관동의<div class="join_arrow"></div></div>
		<div class="join_step2">계정생성<div class="join_arrow"></div></div>
		<div class="join_step4 now_step">가입완료</div>
	</div>
	<div class="account">
		<div class="join_text">
			<div class="join_end"><span class="join_id"><?php echo $GLOBALS["sess"]["m_id"]?></span> 님 가입을 축하드립니다</div>
		</div>
	</div>
	<div class="step_btn">
		<div class="confirm_btn"><button id="confirm-btn" tabindex="5" onclick="javascript:location.href='/'+mobile_root+'/index.php';return false;">확인</button></div>
	</div>
</section>

<?php $this->print_("footer",$TPL_SCP,1);?>