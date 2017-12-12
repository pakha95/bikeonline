<?php /* Template_ 2.2.7 2016/08/04 17:52:19 /www/jbsinttr8192_godo_co_kr/shop/data/skin/damoashop/outline/footer/standard.htm 000003660 */  $this->include_("dataBanner","displayEggBanner");?>
<div align="<?php echo $GLOBALS["cfg"]['shopAlign']?>">
	<div id="footer_top" style="width:<?php echo $GLOBALS["cfg"]['shopSize']?>px">
		<div id="f_logo"><!-- 배너관리에서 수정가능 --><?php if((is_array($TPL_R1=dataBanner( 91))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></div>
		<div style="float:left;">
		<ul id="f_menu">
			<li><a href="<?php echo url("service/company.php")?>&" class="fmenu">회사소개</a>&nbsp;</li>
			<li><img src="/shop/data/skin/damoashop/img/common/bar2.gif"></li>
			<li>&nbsp;<a href="<?php echo url("service/agreement.php")?>&" class="fmenu">이용약관</a>&nbsp;</li>
			<li><img src="/shop/data/skin/damoashop/img/common/bar2.gif"></li>
			<li>&nbsp;<a href="<?php echo url("service/private.php")?>&" class="fmenu"><strong>개인정보취급방침</strong></a>&nbsp;</li>
			<li><img src="/shop/data/skin/damoashop/img/common/bar2.gif"></li>
			<li>&nbsp;<a href="<?php echo url("service/guide.php")?>&" class="fmenu">이용안내</a>&nbsp;</li>
			<li><img src="/shop/data/skin/damoashop/img/common/bar2.gif"></li>
			<li>&nbsp;<a href="<?php echo url("service/sitemap.php")?>&" class="fmenu">사이트맵</a></li>
			
			<li><img src="/shop/data/skin/damoashop/img/common/bar2.gif"></li>
			<li>&nbsp;<a href="javascript:popup('/shop/board/view.php?id=dealer&no=2','564','711');" class="fmenu"><b>딜러계약</b></a>&nbsp;</li>
			
			<li><?php echo displayEggBanner()?></li>
		</ul>
		<div id="f_company">
			<p class="line_h17">
			<span class="txt">회사</span> <?php echo $GLOBALS["cfg"]['compName']?>

			<img src="/shop/data/skin/damoashop/img/common/bar2.gif">
			<span class="txt">주소</span> <?php echo $GLOBALS["cfg"]['address']?>

			</p>
			<p class="line_h17">
			<span class="txt">대표</span> <?php echo $GLOBALS["cfg"]['ceoName']?>

			<img src="/shop/data/skin/damoashop/img/common/bar2.gif">
			<span class="txt">사업자등록번호</span> <?php echo $GLOBALS["cfg"]['compSerial']?> <a href="http://www.ftc.go.kr/info/bizinfo/communicationList.jsp" target="_blank"><img src="/shop/data/skin/damoashop/img/common/btn_business.gif" style="vertical-align:middle;"></a>
			<img src="/shop/data/skin/damoashop/img/common/bar2.gif">
			<span class="txt">통신판매업신고번호</span> <?php echo $GLOBALS["cfg"]['orderSerial']?>

			<img src="/shop/data/skin/damoashop/img/common/bar2.gif">
			<span class="txt">개인정보관리자</span> <?php echo $GLOBALS["cfg"]['adminName']?>

			</p>
			<p class="line_h17">
			<span class="txt">전화번호</span> <?php echo $GLOBALS["cfg"]['compPhone']?>

			<img src="/shop/data/skin/damoashop/img/common/bar2.gif">
			<span class="txt">팩스번호</span> <?php echo $GLOBALS["cfg"]['compFax']?>

			<img src="/shop/data/skin/damoashop/img/common/bar2.gif">
			<span class="txt">메일</span> <a href="javascript:popup('../proc/popup_email.php?to=<?php echo $GLOBALS["cfg"]['adminEmail']?>&hidden=1',650,600)" class="txt"><?php echo $GLOBALS["cfg"]['adminEmail']?></a>
			</p>
			<p class="line_h17">
			<span class="txt">호스팅제공</span> (주)고도소프트
			<img src="/shop/data/skin/damoashop/img/common/footer_godomall.png" style="vertical-align:middle;">
			</p>
			<p class="line_h20">
			Copyright ⓒ <strong><?php echo $GLOBALS["cfg"]['shopUrl']?></strong> All right reserved
			</p>
		</div>
		</div>
	</div>
</div>