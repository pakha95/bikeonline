<?php /* Template_ 2.2.7 2016/06/20 11:52:41 /www/jbsinttr8192_godo_co_kr/shop/data/skin/damoashop/outline/side/mypage.htm 000003138 */  $this->include_("dataBanner");?>
<div id="left_mypage" style="width:<?php echo $GLOBALS["cfg"]['shopSideSize']?>px;">
	<div class="title_mypage"><a href="<?php echo url("mypage/mypage.php")?>&">마이페이지</a></div>
	<div class="line_cs"></div>
	<div class="line_mypage"></div>
	<!-- 쇼핑정보박스 : START -->
	<div id="mem_box">
		<span style="font-weight:bold; color:#343434; padding-left:5px;"><?php echo $GLOBALS["member"]["name"]?></span> 님의 쇼핑정보
		<div class="line_mypage2"></div>
		<table cellpadding=0 cellspacing=0 border=0>
		<tr><td align="left"><?php $this->print_("myBox",$TPL_SCP,1);?></td></tr>
		</table>
	</div>
	<!-- 쇼핑정보박스 : END -->

	<!-- 마이페이지 메뉴 시작 -->
	<div class="line_mypage"></div>
	<table width="100%" cellpadding=0 cellspacing=0 border=0 class="lnbMyMenu">
	<tr>
		<th>개인정보</th>
	</tr>
	<tr>
		<td>
			<div><a href="<?php echo url("member/myinfo.php")?>&" class="lnbmenu">ㆍ회원정보수정</a></div>
			<div><a href="<?php echo url("mypage/mydelivery.php")?>&" class="lnbmenu">ㆍ나의 배송지 관리</a></div>
			<div><a href="<?php echo url("member/hack.php")?>&" class="lnbmenu">ㆍ회원탈퇴</a></div>
		</td>
	</tr>
	<tr>
		<th>내 쇼핑정보</th>
	</tr>
	<tr>
		<td>
			<div><a href="<?php echo url("mypage/mypage_orderlist.php")?>&" class="lnbmenu">ㆍ주문내역/배송조회</a></div>
			<div><a href="<?php echo url("mypage/mypage_emoney.php")?>&" class="lnbmenu">ㆍ적립금내역</a></div>
			<div><a href="<?php echo url("mypage/mypage_coupon.php")?>&" class="lnbmenu">ㆍ할인쿠폰내역</a></div>
			<div><a href="<?php echo url("mypage/mypage_wishlist.php")?>&" class="lnbmenu">ㆍ상품보관함</a></div>
		</td>
	</tr>
	<tr>
		<th><a href="<?php echo url("mypage/mypage_qna.php")?>&" style="color:#525252">1:1 문의게시판</a></th>
	</tr>
	<tr>
		<th><a href="<?php echo url("mypage/mypage_review.php")?>&" style="color:#525252">나의 상품후기</a></th>
	</tr>
	<tr>
		<th><a href="<?php echo url("mypage/mypage_qna_goods.php")?>&" style="color:#525252">나의 상품문의</a></th>
	</tr>
	<tr>
		<th class="unline"><a href="<?php echo url("mypage/mypage_today.php")?>&" style="color:#525252">최근 본 상품 목록</a></th>
	</tr>
	</table>
	<!-- 마이페이지 메뉴 끝 -->
</div>

<!-- 메인왼쪽배너 : Start -->
<table cellpadding="0" cellspacing="0" border="0" width=100% style="padding:10px 0;">
<tr><td align="center"><!-- (배너관리에서 수정가능) --><?php if((is_array($TPL_R1=dataBanner( 4))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></td></tr>
<tr><td align="center"><!-- (배너관리에서 수정가능) --><?php if((is_array($TPL_R1=dataBanner( 5))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></td></tr>
</table>
<!-- 메인왼쪽배너 : End -->