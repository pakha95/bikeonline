<?php /* Template_ 2.2.7 2018/04/24 16:50:10 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/outline/_header.htm 000014168 */ 
if (is_array($TPL_VAR["mobile_script"])) $TPL_mobile_script_1=count($TPL_VAR["mobile_script"]); else if (is_object($TPL_VAR["mobile_script"]) && in_array("Countable", class_implements($TPL_VAR["mobile_script"]))) $TPL_mobile_script_1=$TPL_VAR["mobile_script"]->count();else $TPL_mobile_script_1=0;?>
<!DOCTYPE html>
<head>
<meta name="description" content="<?php echo $GLOBALS["meta_description"]?>" />
<meta name="keywords" content="<?php echo $GLOBALS["meta_keywords"]?>" />
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<meta name="viewport" content="user-scalable=yes, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width, height=device-height" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />

<title><?php echo $GLOBALS["meta_title"]?></title>

<script src="<?php echo $GLOBALS["cfg"]["rootDir"]?>/data/skin_mobileV2/<?php echo $GLOBALS["cfgMobileShop"]["tplSkinMobile"]?>/common/js/common.js?v=201507"></script>
<script src="/shop/data/skin_mobileV2/light/common/js/goods_list_action.js"></script>
<!-- <script src="/shop/data/skin_mobileV2/light/common/js/jquery-1.4.2.min.js"></script> -->
<script src="/shop/data/skin_mobileV2/light/common/js/jquery.js"></script>
<script type="text/javascript">
$(document).bind("mobileinit", function () {
    $.mobile.ajaxEnabled = false;
	$.mobile.ignoreContentEnabled = true;
	$.mobile.keepNative = "select,input";
});
</script>
<script src="/shop/data/skin_mobileV2/light/common/js/jquery.mobile-1.1.1.js"></script>
<script src="/shop/data/skin_mobileV2/light/common/js/jquery.cookie.js"></script>
<script type="text/javascript" src="/shop/lib/js/MobileAnimationBanner.js"></script>
<script type="text/javascript" src="/shop/lib/js/MobileAnimationBannerLoader.js"></script>
<script type="text/javascript" src="/shop/data/skin_mobileV2/light/common/js/jquery.modal.js"></script>

<?php if($TPL_mobile_script_1){foreach($TPL_VAR["mobile_script"] as $TPL_V1){?>
<script src="<?php echo $TPL_V1["script_file"]?>"></script>
<?php }}?>

<script type="text/javascript">
var GD_VERSION = 201507;
function checkVersion(version) { return GD_VERSION >= version; }// ���� üũ
function showSearchArea() {
	if($(".search-area").is(':hidden') == true) {

		$(".search-area").slideDown(30);
	}
	else {

		$(".search-area").slideUp(0);
	}
}

function showCateArea() {

	var now_cate = $("[name=now_cate]").val();

	if($("#cate-area").is(':hidden') == true) {
		$("#page_title").hide();
		$(".content").hide();
		$(".content_goods").hide();
		//$("body").addClass('back_bg');
		$("#cate-area").slideDown(30);
		getCategoryData(now_cate);
	}
	else {
		$("#cate-area").hide();
		//$("body").removeClass('back_bg');
		$("#page_title").show();
		$(".content").show();

	}
}

function goHome() {
	document.location.href="/" + getMobileHomepath() + "/index.php";
}

function goMenu(page_nm) {
	switch(page_nm) {
		case "category" :
			document.location.href="/" + getMobileHomepath() + "/goods/category.php";
			break;
		case "join" :
			document.location.href="/" + getMobileHomepath() + "/mem/join.php";
			break;
		case "my" :
			document.location.href="/" + getMobileHomepath() + "/myp/menu_list.php";
			break;
		case "cart" :
			document.location.href="/" + getMobileHomepath() + "/goods/cart.php";
			break;
		case "wish" :
			document.location.href="/" + getMobileHomepath() + "/myp/wishlist.php";
			break;
		case "login" :
			document.location.href="/" + getMobileHomepath() + "/mem/login.php";
			break;
		case "logout" :
				document.location.href="/" + getMobileHomepath() + "/mem/logout.php";
			break;
		case "viewgoods" :
				document.location.href="/" + getMobileHomepath() + "/myp/viewgoods.php";
			break;
	}
}

function searchKw() {
	if(!$("[name=kw]").val()) {
		alert("�˻� Ű���带 �Է��� �ֽñ� �ٶ��ϴ�");
		return false;
	}
}

function getMobileHomepath() {
	//�� URL �ֻ��� ȨPATH�� ���Ѵ�. ������� Ȩ�� ���� �����ϼ� �����Ƿ�  2012-09-20 khs
	var path1 = document.location.pathname;

	if (path1.charAt(0) == '/')	{
		path1 = path1.substring(1);
	}
	var x = path1.split("/");

	return x[0];
}

function showCategoryMsg(message) {

	var sec = 1000;

	$("[id=goodsres-hide] .text_msg").text(message);
	$("[id=goodsres-hide]").fadeIn(300);

	setTimeout( function() {
		$("[id=goodsres-hide]").fadeOut(300);
	}, sec);
}

$(document).ready(function(){
	$.ajax({
		"url" : "<?php echo $GLOBALS["mobileRootDir"]?>/proc/mAjaxAction.php",
		"type" : "post",
		"data" : {
			"mode" : "get_cart_item"
		},
		"cash" : false,
		"dataType" : "json",
		"success" : function(cartItem)
		{
			if (cartItem.quantity) {
				$("#cart-btn .cart-item-quantity").text(" ("+cartItem.quantity.toString()+")");
			}
		}
	});

	try {
		var todayGoodsMobileIdx = $.cookie('todayGoodsMobileIdx');

		if(todayGoodsMobileIdx != "undefined" && todayGoodsMobileIdx != "") {

			var goods_idx = todayGoodsMobileIdx.split(',');
			var view_cnt = goods_idx.length - 1;
			$("#viewgoods-btn .viewgoods-quantity").text(" ("+view_cnt.toString()+")");
		}
	}
	catch(e) {}



});

</script>
<link rel="stylesheet" type="text/css" href="/shop/data/skin_mobileV2/light/common/css/reset.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS["cfg"]["rootDir"]?>/data/skin_mobileV2/<?php echo $GLOBALS["cfgMobileShop"]["tplSkinMobile"]?>/common/css/style.css?v=201507" />
<link rel="stylesheet" type="text/css" href="/shop/data/skin_mobileV2/light/common/css/attendance.css" />
<link rel="stylesheet" type="text/css" href="/shop/data/skin_mobileV2/light/common/css/jquery.modal.css" />
<link rel="stylesheet" type="text/css" href="/shop/data/skin_mobileV2/light/common/css/jquery.modal.theme-xenon.css" />

<!-- Link Swiper's CSS -->
	<link rel="stylesheet" type="text/css" href="/shop/data/skin_mobileV2/light/common/css/swiper.min.css">
<style type="text/css">
.cart-item-quantity{font-weight:normal;}
.viewgoods-quantity{font-weight:normal;}

#goodsres-hide2 {display:none;}
.goodsres_wrap {position : fixed;left : 10%;width : 80%;background : #ffffff;display : block;border-radius:1em;box-shadow:2px 2px 4px #7f7f7f;z-index: 1000; bottom:20%;}
.goodsres_wrap .goodsres_title {background:#313030;width:100%;border-top-left-radius:1em;border-top-right-radius:1em;height:45px;border-bottom:solid 1px #b2b2b2;margin-bottom:6px;}
.goodsres_wrap .goodsres_title .title{padding-left:14px;line-height:45px;font-size:16px;font-weight:bold;color:#FFFFFF;font-family:dotum;}
.goodsres_wrap .goodsres_msg { padding:15px; }
.goodsres_wrap .goodsres_msg .text_msg{ font-size:12px; color:#353535;}

</style>
<!--<link rel="stylesheet" href="/shop/data/skin_mobileV2/light/style_screen.css" type="text/css" media="screen and (min-width: 321px)"  />-->

<?php if($GLOBALS["cfgMobileShop"]["mobileShopIcon"]){?>
<link rel="apple-touch-icon-precomposed" href="<?php echo $GLOBALS["cfg"]["rootDir"]?>/data/skin_mobileV2/<?php echo $GLOBALS["cfgMobileShop"]["tplSkinMobile"]?>/<?php echo $GLOBALS["cfgMobileShop"]["mobileShopIcon"]?>" />
<?php }else{?>
<link rel="apple-touch-icon-precomposed" href="/shop/data/skin_mobileV2/light/outline/<?php echo $GLOBALS["cfg"]["rootDir"]?>/data/skin_mobileV2/<?php echo $GLOBALS["cfgMobileShop"]["tplSkinMobile"]?>/common/img.png" />
<?php }?>

<?php echo $TPL_VAR["customHeader"]?>

</head>

<body>

<div id="dynamic"></div>

<div id="wrap">

<header>
<div class="gnb">
	<div id="logo"<?php if($GLOBALS["cfgMobileShop"]["useOffCanvas"]){?> class="sliding-menu"<?php }?>>
<?php if($GLOBALS["cfgMobileShop"]["mobileShopLogo"]){?>
		<a href="javascript:goHome();"><img src="<?php echo $GLOBALS["cfg"]["rootDir"]?>/data/skin_mobileV2/<?php echo $GLOBALS["cfgMobileShop"]["tplSkinMobile"]?>/<?php echo $GLOBALS["cfgMobileShop"]["mobileShopLogo"]?>" alt="<?php echo $GLOBALS["cfg"]["shopName"]?>" title="<?php echo $GLOBALS["cfg"]["shopName"]?>" width="110px" height="35px"/></a>
<?php }else{?>
		<div class="top_title"><a href="<?php echo $GLOBALS["mobileRootDir"]?>"><?php echo $GLOBALS["shop_name"]?></a></div>
<?php }?>

	</div>
	<div id="logo-right">
		<div id="search-btn" onClick="javascript:showSearchArea();"><img src="/shop/data/skin_mobileV2/light/common/img/new/seach.png" /></div>
<?php if($TPL_VAR["page_cache_enabled"]){?>
		<div class="top_global">
			<span onClick="javascript:goMenu('my');">����������</span>
			<span class="user-status-login" onClick="javascript:goMenu('logout');" style="display: none;">�α׾ƿ�</span>
			<span class="user-status-logout" onClick="javascript:goMenu('login');" style="display: none;">�α���</span>
		</div>
<?php }else{?>
		<div class="top_global" ><span onClick="javascript:goMenu('my');" >����������</span><?php if($GLOBALS["sess"]){?><span onClick="javascript:goMenu('logout');" >�α׾ƿ�</span><?php }else{?><span onClick="javascript:goMenu('login');" >�α���</span><?php }?></div>
<?php }?>
	</div>
</div>
<div class="search-area">
	<form action="<?php echo $GLOBALS["mobileRootDir"]?>/goods/list.php" method="get" onsubmit="return searchKw();" >
	<div id="search-box">
		<input type="text" name="kw" placeholder="�˻�� �Է��� �ּ���"/>
	</div>
	<input id="search-box-btn" type="submit" value="�˻�">
	</form>
</div>
<div class="new-menu-area">
	<div id="category-btn" onClick="javascript:goMenu('category');">ī�װ�<div class="bar_area"><img src="/shop/data/skin_mobileV2/light/common/img/new/menu_p.png" /></div></div>
	<div id="cart-btn" onClick="javascript:goMenu('cart');">��ٱ���<span class="cart-item-quantity"></span><div class="bar_area"><img src="/shop/data/skin_mobileV2/light/common/img/new/menu_p.png" /></div></div>
	<div id="viewgoods-btn" onClick="javascript:goMenu('viewgoods');">�ֱٺ���ǰ<span class="viewgoods-quantity"></span></div>
	<div id="more-view-btn"><div class="bar_area"><img src="/shop/data/skin_mobileV2/light/common/img/new/menu_p.png" /></div>������</div>
	<div id="more-view-menu" style="display: none;">
		<ul>
			<li class="item wishlist">���� ��ǰ</li>
			<!-- <li class="item goods-review">��ǰ�ı�</li> -->
			<!-- <li class="item goods-qna">��ǰ����</li> -->
			<!-- <li class="item community">�Խ���</li> -->
			<li class="item notice">��������</li>
      <li class="item community">���� �Խ���</li>
		</ul>
	</div>
</div>
<?php if($GLOBALS["cfgMobileShop"]["useOffCanvas"]){?>
<!-- �����̵� �޴� ��ư Start -->
<div class="gd-flipcover-btn js-navtoggle">
	<button type="button" class="btn-reset" style="background-color:#<?php echo $GLOBALS["cfgMobileShop"]["offCanvasBtnColor"]?>;"><span class="sprite-icon icon-gnb">nav</span></button>
</div>
<!-- �����̵� �޴� ��ư End -->
<?php }?>

</header>
<?php if($GLOBALS["cfgMobileShop"]["useOffCanvas"]){?>
<!-- �����̵� �޴� Start -->
<?php $this->print_("off_canvas",$TPL_SCP,1);?>

<!-- �����̵� �޴� End -->
<?php }?>
<div class="clearb"></div>

<section id="goodsres-hide" class="content_goods">
	<div class="pop_back">
		<div class="pop_effect">
			<div class="text_msg"></div>
		</div>
	</div>
</section>

<section id="goodsres-hide2" class="content_goods">
	<div class="goodsres_wrap">
		<div class="goodsres_title"><div class="title">�˸�</div></div>
		<div class="goodsres_msg"><div class="text_msg"></div></div>
	</div>
</section>

<!-- Start : �⼮üũ ���ø� -->
<section id="attendance-popup" style="display: none;" data-root-dir="<?php echo $GLOBALS["cfgMobileShop"]["mobileShopRootDir"]?>">
	<h1 id="attendance-title"></h1>
	<div id="attendance-close">�ݱ�</div>
	<div id="attendance-info-straight" class="condition-type">
		<div class="attendance-period">
			<span class="attendance-start-date"></span> ~ <span class="attendance-end-date"></span> ����
		</div>
		<div class="attendance-description">
			���� <span class="attendance-condition-period"></span>�� �̻� �⼮�ϸ� �������� ��������!
		</div>
	</div>
	<div id="attendance-info-sum" class="condition-type">
		<div class="attendance-period">
			�Ⱓ : <span class="attendance-start-date"></span> ~ <span class="attendance-end-date"></span> �ȿ�
		</div>
		<div class="attendance-description">
			<span class="attendance-condition-period"></span>�� �̻� �⼮�ϸ� �������� ��������!
		</div>
	</div>
	<h2 id="attendance-calendar-title">
		<button id="attendance-calendar-previous-month">���� ��</button>
		<span id="attendance-calendar-month">
			<span id="attendance-calendar-month-1">January</span>
			<span id="attendance-calendar-month-2">February</span>
			<span id="attendance-calendar-month-3">March</span>
			<span id="attendance-calendar-month-4">April</span>
			<span id="attendance-calendar-month-5">May</span>
			<span id="attendance-calendar-month-6">June</span>
			<span id="attendance-calendar-month-7">July</span>
			<span id="attendance-calendar-month-8">August</span>
			<span id="attendance-calendar-month-9">September</span>
			<span id="attendance-calendar-month-10">October</span>
			<span id="attendance-calendar-month-11">November</span>
			<span id="attendance-calendar-month-12">December</span>
		</span>
		<span id="attendance-calendar-year"></span>
		<button id="attendance-calendar-next-month">���� ��</button>
	</h2>
	<table id="attendance-date-list">
		<tbody>
			<tr class="attendance-calendar-date-floor">
				<td class="attendance-calendar-date-space"></td>
				<td class="attendance-calendar-date-space"></td>
				<td class="attendance-calendar-date-space"></td>
				<td class="attendance-calendar-date-space"></td>
				<td class="attendance-calendar-date-space"></td>
				<td class="attendance-calendar-date-space"></td>
				<td class="attendance-calendar-date-space"></td>
			</tr>
		</tbody>
	</table>
</section>
<!-- End : �⼮üũ ���ø� -->