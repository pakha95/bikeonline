<?php /* Template_ 2.2.7 2015/07/21 17:31:47 /www/jbsinttr8192_godo_co_kr/shop/data/skin/damoashop/outline/side/mainleft.htm 000003066 */  $this->include_("dataBoard","dataBank","displaySSLSeal","displayEggBanner","dataBanner");?>
<!-- 카테고리 메뉴 시작 -->
<!-- 관련 세부소스는 '기타/추가페이지(proc) > 카테고리메뉴- menuCategory.htm' 안에 있습니다 -->
<?php $this->print_("menuCategory",$TPL_SCP,1);?>

<!-- 카테고리 메뉴 끝 -->
<div id="comm" style="padding-top:10px;">
	<div><img src="/shop/data/skin/damoashop/img/main/community.gif"></div>
	<ul>
<?php if((is_array($TPL_R1=dataBoard( 20))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?>
<?php if($TPL_V1["id"]=='order'){?>
<?php if($GLOBALS["sess"]["level"]== 100){?>
			<!--li><a href="<?php echo url("board/list.php?")?>&id=<?php echo $TPL_V1["id"]?>"><?php echo $TPL_V1["name"]?></a></li-->
<?php }?>
<?php }?>
<?php }}?>
		<li><a href="<?php echo url("board/list.php?")?>&id=notice">바이크온라인 소식</a></li>
		<li><a href="<?php echo url("board/list.php?")?>&id=specialorder">특별주문 전용게시판</a></li>
		<li><a href="<?php echo url("board/list.php?")?>&id=inquiry">상품 판매 문의</a></li>
		<li><a href="<?php echo url("board/list.php?")?>&id=qna">묻고 답하기</a></li>
	</ul>
</div>
<!-- 메인왼쪽 고객센터 01 : Start -->
<div id="cs">
	<div class="number"><?php echo $GLOBALS["cfg"]['compPhone']?></div>
	<dl>
		<dt>MON - FRI</dt>
		<dd>am 10:00 - pm 18:00</dd>
		<dt>LUNCH</dt>
		<dd>am 12:00 - pm 13:00</dd>
		<dt>SAT, SUN, HOLIDAY </dt>
		<dd>off</dd>
	</dl>
</div>
<!-- 메인왼쪽 고객센터 01 : End -->

<!-- 무통장입금 : Start -->
<div id="bankinfo">
	<div><img src="/shop/data/skin/damoashop/img/main/banking.gif"></div>
	<dl>
<?php if((is_array($TPL_R1=dataBank())&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?>
		<dt><?php echo $TPL_V1["bank"]?></dt>
		<dd><?php echo $TPL_V1["account"]?></dd>
		<dd><?php echo $TPL_V1["name"]?></dd>
<?php }}?>
	</dl>
</div>

<!-- 무통장입금 : End -->
<div style="width:161px;text-align:center;">
	<div style="display:block"><?php echo displaySSLSeal()?></div>
	<br />
	<div style="display:block"><?php echo displayEggBanner()?></div>
</div>

<!-- 메인왼쪽배너 : Start-->
<div style="padding:10px 0;"><!-- (배너관리에서 수정가능) --><?php if((is_array($TPL_R1=dataBanner( 4))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></div>
<div style="padding:10px 0;"><!-- (배너관리에서 수정가능) --><?php if((is_array($TPL_R1=dataBanner( 5))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></div>
<!-- 메인왼쪽배너 : End -->