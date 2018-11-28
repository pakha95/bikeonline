<?php /* Template_ 2.2.7 2018/10/04 12:12:03 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/index.htm 000011030 */  $this->include_("mobileAnimationBanner");
if (is_array($GLOBALS["cfg_step"])) $TPL__cfg_step_1=count($GLOBALS["cfg_step"]); else if (is_object($GLOBALS["cfg_step"]) && in_array("Countable", class_implements($GLOBALS["cfg_step"]))) $TPL__cfg_step_1=$GLOBALS["cfg_step"]->count();else $TPL__cfg_step_1=0;?>
<?php $this->print_("header",$TPL_SCP,1);?>


<style type="text/css">
#background {
	position : fixed;
	left : 0;
	top : 0;
	bottom:0;
	width : 100%;
	height : 100%;
	background : rgba(0, 0, 0, 0.2);
	display:block;
	z-index:98;
}

#popup {position:fixed; bottom:0px; width:100%;z-index:99;}
#popup .popup_wrap{width:308px; margin:6px auto;}
#popup .popup_wrap .popup_content{width:306px; text-align:center; border:solid 1px #dadada; background:#FFFFFF; min-height:150px;}
#popup .popup_wrap .popup_content img{max-width:100%; }
#popup .popup_wrap .popup_btn {height:26px;}
#popup .popup_wrap .popup_btn .btn-today-close{height:26px; width:176px; background:url('/shop/data/skin_mobileV2/light/common/img/main/btn_p_today.png') no-repeat; float:left; line-height:26px; color:#FFFFFF; text-align:center;}
#popup .popup_wrap .popup_btn .btn-close{height:26px; width:132px; background:url('/shop/data/skin_mobileV2/light/common/img/main/btn_p_close.png') no-repeat;float:left; line-height:26px; color:#FFFFFF; text-align:center;}

.swiper-container {
        width: 100%;


    }
    .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;

        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
    }

</style>
<script type="text/javascript">
function closePop() {
	$("#popup").hide();
	$("#background").hide();
}

function closeTodayPop(popupNo) {
	setCookieMobile('popup_'+popupNo, 1, 1, '/');
	$("#popup").hide();
	$("#background").hide();

}
</script>
<?php if($TPL_VAR["page_cache_enabled"]){?>
<div id="template-mobile-popup" style="display: none;">
	<div class="popup_wrap">
		<div class="popup_content"></div>
		<div class="popup_btn">
			<div class="btn-today-close">오늘하루 닫기</div>
			<div class="btn-close">닫기</div>
		</div>
	</div>
</div>
<div id="background" style="display: none;"></div>
<?php }else{?>
<?php if($TPL_VAR["popup_data"]){?>
<?php if(isset($_COOKIE['popup_'.$TPL_VAR["popup_data"]["mpopup_no"]])===false){?>
<div id="popup" >

<div class="popup_wrap">
<?php if($TPL_VAR["popup_data"]["link_url"]){?>
<a href="http://<?php echo $TPL_VAR["popup_data"]["link_url"]?>">
<?php }?>
<div class="popup_content">
<?php if($TPL_VAR["popup_data"]["popup_type"]=='0'){?>
	<?php echo $TPL_VAR["popup_data"]["popup_img"]?>

<?php }else{?>
	<?php echo $TPL_VAR["popup_data"]["popup_body"]?>

<?php }?>
</div>
<?php if($TPL_VAR["popup_data"]["link_url"]){?>
</a>
<?php }?>
<div class="popup_btn">
	<div class="btn-today-close" onClick="javascript:closeTodayPop('<?php echo $TPL_VAR["popup_data"]["mpopup_no"]?>');">오늘하루 닫기</div>
	<div class="btn-close" onClick="javascript:closePop();">닫기</div>
</div>
</div>

</div>
<!--
오늘 하루 보이지 않음 <input type="checkbox" style="cursor:pointer; background-color:#000000;" onClick="setCookieMobile('popup', 1, 1, '/'); $('div#popup').hide();">
-->
<div id="background"></div>
<?php }?>
<?php }?>
<?php }?>

<?php if($GLOBALS["cfgMobileShop"]["mobileShopMainBanner"]){?>
<div class="main_banner content" ><img src="<?php echo $GLOBALS["cfg"]["rootDir"]?>/data/skin_mobileV2/<?php echo $GLOBALS["cfgMobileShop"]["tplSkinMobile"]?>/<?php echo $GLOBALS["cfgMobileShop"]["mobileShopMainBanner"]?>" alt="메인배너이미지" /></div>
<hr class="hidden" />
<?php }?>

<?php echo mobileAnimationBanner()?>

<!-- 메인스크롤배너추가 -->
<!-- Swiper -->
    <div class="swiper-container">
			<div class="swiper-wrapper">
					<div class="swiper-slide"><a href="#" onclick="goCate('003')"><img src="/shop/data/skin/damoashop/img/main/1_how_to_search.png" alt="HowToSearch" ></a></div>
					<div class="swiper-slide"><a href="#" onclick="goCate('048033')"><img src="/shop/data/skin/damoashop/img/main/airoh_2018.jpg" alt="Airoh" ></a></div>
					<div class="swiper-slide"><a href="#" onclick="goCate('048005')"><img src="/shop/data/skin/damoashop/img/main/bell_2018.jpg" alt="Bell" ></a></div>
					<div class="swiper-slide"><a href="#" onclick="goCate('004106')"><img src="/shop/data/skin/damoashop/img/main/evotech_2018.jpg" alt="Evotech" ></a></div>
					<div class="swiper-slide"><a href="#" onclick="goCate('025015')"><img src="/shop/data/skin/damoashop/img/main/ilmberger_2018.jpg" alt="Ilmberger" ></a></div>
					<div class="swiper-slide"><a href="#" onclick="goCate('004081')"><img src="/shop/data/skin/damoashop/img/main/akrapovic_2018.jpg" alt="Akrapovic" ></a></div>
					<div class="swiper-slide"><a href="#" onclick="goCate('048008')"><img src="/shop/data/skin/damoashop/img/main/icon_2018.jpg" alt="Icon" ></a></div>
					<div class="swiper-slide"><a href="#" onclick="goCate('004103')"><img src="/shop/data/skin/damoashop/img/main/sidi_2018.jpg" alt="Sidi" ></a></div>
					<div class="swiper-slide"><a href="#" onclick="goCate('004096')"><img src="/shop/data/skin/damoashop/img/main/eks_2018.jpg" alt="EKS Brand" ></a></div>
					<div class="swiper-slide"><a href="#" onclick="goCate('004094')"><img src="/shop/data/skin/damoashop/img/main/magura_2018.jpg" alt="Magura" ></a></div>
					<div class="swiper-slide"><a href="#" onclick="goCate('004016')"><img src="/shop/data/skin/damoashop/img/main/gaerne_2018.jpg" alt="Gaerne" ></a></div>
					<div class="swiper-slide"><a href="#" onclick="goCate('048022')"><img src="/shop/data/skin/damoashop/img/main/bmw_helmet_2018.jpg" alt="BMW Helmet" ></a></div>
					<div class="swiper-slide"><a href="#" onclick="goCate('004003')"><img src="/shop/data/skin/damoashop/img/main/alpinestars_2018.jpg" alt="Alpinestars" ></a></div>

					<!-- <div class="swiper-slide"><a href="#" onclick="goCate('004069')"><img src="/shop/data/skin/damoashop/img/main/2_mra.jpg" alt="Revit" ></a></div> -->
			<!--
			<div class="swiper-slide">Slide 1</div>
            <div class="swiper-slide">Slide 2</div>
            <div class="swiper-slide">Slide 3</div>
            <div class="swiper-slide">Slide 4</div>
            <div class="swiper-slide">Slide 5</div>
            <div class="swiper-slide">Slide 6</div>
            <div class="swiper-slide">Slide 7</div>
            <div class="swiper-slide">Slide 8</div>
            <div class="swiper-slide">Slide 9</div>
            <div class="swiper-slide">Slide 10</div>
			-->
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
        <!-- Add Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

    <!-- Swiper JS -->
    <script src="/shop/data/skin_mobileV2/light/common/js/swiper.jquery.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        paginationClickable: true,
        spaceBetween: 0,
        centeredSlides: true,
        autoplay: 5000,
        autoplayDisableOnInteraction: false
    });
    </script>
	<!--<div id="main_banner" data-role="none">
		<div><a href="/m2/goods/list.php?category=004018&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/main/1_gimoto.png" alt="Gimoto" ></a></div>
		<div><a href="/m2/goods/list.php?category=048025&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/main/1_momodesign.jpg" alt="Momo" ></a></div>
		<div><a href="/m2/goods/list.php?category=004001002&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/main/2_100percent.png" alt="100%" ></a></div>
		<div><a href="/m2/goods/list.php?category=004020&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/main/1_hepco.png" alt="Hepco&Becker" ></a></div>
		<div><a href="/m2/goods/list.php?category=048016&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/main/2_schuberth.png" alt="Schuberth" ></a></div>
		<div><a href="/m2/goods/list.php?category=004007&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/main/3_barkbusters.png" alt="Barkbusters" ></a></div>
		<div><a href="/m2/goods/list.php?category=048002&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/main/4_agv.png" alt="AGV" ></a></div>
		<div><a href="/m2/goods/list.php?category=004027014&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/main/5_moose_racing.png" alt="Moose Racing" ></a></div>
		<div><a href="/m2/goods/list.php?category=003&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/main/1_how_to_search.png" alt="HowToSearch" ></a></div>
		<div><a href="/m2/goods/list.php?category=025015&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/main/3_ilmberger.png" alt="Ilmberger" ></a></div>
	</div>-->

	<!-- 메인스크롤배너 끝 -->
<section id="main" class="content" >


	<audio id="speach-description-player"></audio>
	<!-- 아래 상품리스트에 쓰이는 세부소스는 '디자인관리 > 상품(goods) > 상품목록 > 상품스크롤형,이미지스크롤형,탭형,매거진스크롤형,이벤트롤링형' 에 있습니다  -->
<?php if($TPL__cfg_step_1){foreach($GLOBALS["cfg_step"] as $TPL_V1){?>
<?php if($TPL_V1["chk"]){?>
<?php if($TPL_V1["page_type"]=='cate'){?><?php if($TPL_V1["text_temp1"]){?><div><?php }?><?php }?>
	<?php echo $this->assign('id',"main_list_01")?>

	<?php echo $this->assign('dpCfg',$TPL_V1)?>

	<?php echo $this->define('tpl_include_file_1',"goods/list/".$TPL_V1["tpl"].".htm")?> <?php $this->print_("tpl_include_file_1",$TPL_SCP,1);?>

<?php if($TPL_V1["page_type"]=='cate'){?><?php if($TPL_V1["text_temp1"]){?></div><?php }?><?php }?>
	<div style="padding-top:15px"></div>
<?php }?>
<?php }}?>
</section>

<!-- 품절상품 마스크 -->
<div id="el-goods-soldout-image-mask" style="display:none;position:absolute;top:0;left:3px;background:url(<?php if($GLOBALS["cfg_soldout"]["mobile_display_overlay"]=='custom'){?><?php echo $GLOBALS["cfg"]["rootDir"]?>/data/goods/icon/mobile_custom_soldout<?php }else{?><?php echo $GLOBALS["cfg"]["rootDir"]?>/data/goods/icon/mobile_icon_soldout<?php echo $GLOBALS["cfg_soldout"]["mobile_display_overlay"]?><?php }?>) no-repeat center center; background-size:cover;"></div>
<script>
addOnloadEvent(function(){ setGoodsImageSoldoutMask() });
</script>

<?php $this->print_("footer",$TPL_SCP,1);?>