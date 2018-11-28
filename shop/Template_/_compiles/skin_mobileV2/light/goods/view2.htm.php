<?php /* Template_ 2.2.7 2018/09/01 16:28:07 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/goods/view2.htm 000079382 */  $this->include_("commoninfo","dataGoodsRelation");
if (is_array($GLOBALS["opt"])) $TPL__opt_1=count($GLOBALS["opt"]); else if (is_object($GLOBALS["opt"]) && in_array("Countable", class_implements($GLOBALS["opt"]))) $TPL__opt_1=$GLOBALS["opt"]->count();else $TPL__opt_1=0;
if (is_array($TPL_VAR["l_img"])) $TPL_l_img_1=count($TPL_VAR["l_img"]); else if (is_object($TPL_VAR["l_img"]) && in_array("Countable", class_implements($TPL_VAR["l_img"]))) $TPL_l_img_1=$TPL_VAR["l_img"]->count();else $TPL_l_img_1=0;
if (is_array($GLOBALS["optnm"])) $TPL__optnm_1=count($GLOBALS["optnm"]); else if (is_object($GLOBALS["optnm"]) && in_array("Countable", class_implements($GLOBALS["optnm"]))) $TPL__optnm_1=$GLOBALS["optnm"]->count();else $TPL__optnm_1=0;
if (is_array($GLOBALS["addopt"])) $TPL__addopt_1=count($GLOBALS["addopt"]); else if (is_object($GLOBALS["addopt"]) && in_array("Countable", class_implements($GLOBALS["addopt"]))) $TPL__addopt_1=$GLOBALS["addopt"]->count();else $TPL__addopt_1=0;
if (is_array($GLOBALS["addopt_inputable"])) $TPL__addopt_inputable_1=count($GLOBALS["addopt_inputable"]); else if (is_object($GLOBALS["addopt_inputable"]) && in_array("Countable", class_implements($GLOBALS["addopt_inputable"]))) $TPL__addopt_inputable_1=$GLOBALS["addopt_inputable"]->count();else $TPL__addopt_inputable_1=0;
if (is_array($TPL_VAR["ex"])) $TPL_ex_1=count($TPL_VAR["ex"]); else if (is_object($TPL_VAR["ex"]) && in_array("Countable", class_implements($TPL_VAR["ex"]))) $TPL_ex_1=$TPL_VAR["ex"]->count();else $TPL_ex_1=0;
if (is_array($TPL_VAR["review_loop"])) $TPL_review_loop_1=count($TPL_VAR["review_loop"]); else if (is_object($TPL_VAR["review_loop"]) && in_array("Countable", class_implements($TPL_VAR["review_loop"]))) $TPL_review_loop_1=$TPL_VAR["review_loop"]->count();else $TPL_review_loop_1=0;
if (is_array($TPL_VAR["qna_loop"])) $TPL_qna_loop_1=count($TPL_VAR["qna_loop"]); else if (is_object($TPL_VAR["qna_loop"]) && in_array("Countable", class_implements($TPL_VAR["qna_loop"]))) $TPL_qna_loop_1=$TPL_VAR["qna_loop"]->count();else $TPL_qna_loop_1=0;
if (is_array($TPL_VAR["a_coupon"])) $TPL_a_coupon_1=count($TPL_VAR["a_coupon"]); else if (is_object($TPL_VAR["a_coupon"]) && in_array("Countable", class_implements($TPL_VAR["a_coupon"]))) $TPL_a_coupon_1=$TPL_VAR["a_coupon"]->count();else $TPL_a_coupon_1=0;?>
<?php $this->print_("header",$TPL_SCP,1);?>


<?php $this->print_("sub_header",$TPL_SCP,1);?>

<script src="/shop/lib/js/countdown.js"></script>
<script>

var price = new Array();
var reserve = new Array();
var consumer = new Array();
var memberdc = new Array();
var realprice = new Array();
var couponprice = new Array();
var special_discount_amount = new Array();
var coupon = new Array();
var cemoney = new Array();
var opt1img = new Array();
var opt2icon = new Array();
var oldborder = "";
var opt2kind = "<?php echo $TPL_VAR["optkind"][ 1]?>";
var strprice = '<?php echo $TPL_VAR["strprice"]?>';
var runout = <?php if($TPL_VAR["runout"]){?>true<?php }else{?>false<?php }?>;

<?php if($GLOBALS["opt"]){?>
<?php if($TPL__opt_1){$TPL_I1=-1;foreach($GLOBALS["opt"] as $TPL_V1){$TPL_I1++;?>
<?php if((is_array($TPL_R2=$TPL_V1)&&!empty($TPL_R2)) || (is_object($TPL_R2) && in_array("Countable", class_implements($TPL_R2)) && $TPL_R2->count() > 0)) {$TPL_I2=-1;foreach($TPL_R2 as $TPL_V2){$TPL_I2++;?>
<?php if($TPL_I1== 0&&$TPL_I2== 0){?>
			var fkey = '<?php echo get_js_compatible_key($TPL_V2["opt1"])?><?php if($TPL_V2["opt2"]){?>|<?php echo get_js_compatible_key($TPL_V2["opt2"])?><?php }?>';
<?php }?>
			price['<?php echo get_js_compatible_key($TPL_V2["opt1"])?><?php if($TPL_V2["opt2"]){?>|<?php echo get_js_compatible_key($TPL_V2["opt2"])?><?php }?>'] = <?php echo $TPL_V2["price"]?>;
			reserve['<?php echo get_js_compatible_key($TPL_V2["opt1"])?><?php if($TPL_V2["opt2"]){?>|<?php echo get_js_compatible_key($TPL_V2["opt2"])?><?php }?>'] = <?php echo $TPL_V2["reserve"]?>;
			consumer['<?php echo get_js_compatible_key($TPL_V2["opt1"])?><?php if($TPL_V2["opt2"]){?>|<?php echo get_js_compatible_key($TPL_V2["opt2"])?><?php }?>'] = <?php echo $TPL_V2["consumer"]?>;
			memberdc['<?php echo get_js_compatible_key($TPL_V2["opt1"])?><?php if($TPL_V2["opt2"]){?>|<?php echo get_js_compatible_key($TPL_V2["opt2"])?><?php }?>'] = <?php echo $TPL_V2["memberdc"]?>;
			realprice['<?php echo get_js_compatible_key($TPL_V2["opt1"])?><?php if($TPL_V2["opt2"]){?>|<?php echo get_js_compatible_key($TPL_V2["opt2"])?><?php }?>'] = <?php echo $TPL_V2["realprice"]?>;
			coupon['<?php echo get_js_compatible_key($TPL_V2["opt1"])?><?php if($TPL_V2["opt2"]){?>|<?php echo get_js_compatible_key($TPL_V2["opt2"])?><?php }?>'] = <?php echo $TPL_V2["coupon"]?>;
			couponprice['<?php echo get_js_compatible_key($TPL_V2["opt1"])?><?php if($TPL_V2["opt2"]){?>|<?php echo get_js_compatible_key($TPL_V2["opt2"])?><?php }?>'] = <?php echo $TPL_V2["couponprice"]?>;
			cemoney['<?php echo get_js_compatible_key($TPL_V2["opt1"])?><?php if($TPL_V2["opt2"]){?>|<?php echo get_js_compatible_key($TPL_V2["opt2"])?><?php }?>'] = <?php echo $TPL_V2["coupon_emoney"]?>;
			special_discount_amount['<?php echo get_js_compatible_key($TPL_V2["opt1"])?><?php if($TPL_V2["opt2"]){?>|<?php echo get_js_compatible_key($TPL_V2["opt2"])?><?php }?>'] = <?php echo $TPL_V2["special_discount_amount"]?>;
<?php }}?>
<?php }}?>
<?php }else{?>
		price['base'] = <?php if($TPL_VAR["price"]){?><?php echo $TPL_VAR["price"]?><?php }else{?>0<?php }?>; // 가격
		reserve['base'] = <?php if($TPL_VAR["reserve"]){?><?php echo $TPL_VAR["reserve"]?><?php }else{?>0<?php }?>; // 적립금
		consumer['base'] = <?php if($TPL_VAR["consumer"]){?><?php echo $TPL_VAR["consumer"]?><?php }else{?>0<?php }?>; // 소비자가
		memberdc['base'] = <?php if($TPL_VAR["memberdc"]){?><?php echo $TPL_VAR["memberdc"]?><?php }else{?>0<?php }?>; // 회원할인율
		realprice['base'] = <?php if($TPL_VAR["realprice"]){?><?php echo $TPL_VAR["realprice"]?><?php }else{?>0<?php }?>; // 회원할인가
		coupon['base'] = <?php if($TPL_VAR["coupon"]){?><?php echo $TPL_VAR["coupon"]?><?php }else{?>0<?php }?>; // 쿠폰
		couponprice['base'] = <?php if($TPL_VAR["couponprice"]){?><?php echo $TPL_VAR["couponprice"]?><?php }else{?>0<?php }?>; // 쿠폰 할인가
		cemoney['base'] = <?php if($TPL_VAR["coupon_emoney"]){?><?php echo $TPL_VAR["coupon_emoney"]?><?php }else{?>0<?php }?>; // 쿠폰 적립금
		special_discount_amount['base'] = <?php if($TPL_VAR["special_discount_amount"]){?><?php echo $TPL_VAR["special_discount_amount"]?><?php }else{?>0<?php }?>; // 상품할인가
<?php }?>

var opt = new Array();
opt[0] = new Array("('1차옵션을 먼저 선택해주세요','')");
<?php if($TPL__opt_1){$TPL_I1=-1;foreach($GLOBALS["opt"] as $TPL_V1){$TPL_I1++;?>
opt['<?php echo $TPL_I1+ 1?>'] = new Array("('== 옵션선택 ==','')",<?php if((is_array($TPL_R2=$TPL_V1)&&!empty($TPL_R2)) || (is_object($TPL_R2) && in_array("Countable", class_implements($TPL_R2)) && $TPL_R2->count() > 0)) {$TPL_S2=count($TPL_R2);$TPL_I2=-1;foreach($TPL_R2 as $TPL_V2){$TPL_I2++;?>"('<?php echo addslashes(addslashes($TPL_V2["opt2"]))?><?php if($TPL_V2["price"]!=$TPL_VAR["price"]){?> (<?php echo number_format($TPL_V2["price"])?>원)<?php }?><?php if($TPL_VAR["usestock"]&&!$TPL_V2["stock"]){?> [품절]<?php }?>','<?php echo addslashes(addslashes($TPL_V2["opt2"]))?>','<?php if($TPL_VAR["usestock"]&&!$TPL_V2["stock"]){?>soldout<?php }?>')"<?php if($TPL_I2!=$TPL_S2- 1){?>,<?php }?><?php }}?>);
<?php }}?>

function getCouponlist_scroll(){
<?php if($TPL_VAR["coupon"]||$TPL_VAR["coupon_emoney"]){?>
	couponlist_scroll = new iScroll('scroll-area');
<?php }?>
}

function review_qna_tab(){
	var view_area = $("[name=view_area]").val();

	if(view_area == 'review') {
		changeTab('review');
		var area_pos = $(".goods-info-area").offset();
		$('html, body').animate( { scrollTop:area_pos.top }, 300);
	}
	else if(view_area == 'qna') {
		changeTab('qna');
		var area_pos = $(".goods-info-area").offset();
		$('html, body').animate( { scrollTop:area_pos.top }, 300);

	}

	$('.goods-item').each(function(idx){
		$(this).width(($(this).width() - 10) + 'px');
	});
	$('#relativegoods > .inner-wrapper').css({width: (($('.goods-item').eq(0).width() + 15) * $('.goods-item').length) + 'px'});
}

function buyableMember(buyable) // 회원 전용 구매 상품 - 일반결제
{
	if(buyable == 'buyable2')
	{
		if(confirm("회원 전용 구매 상품입니다. 로그인 화면으로 이동합니다.")){
			var returnUrl = "<?php echo urlencode($TPL_VAR["returnUrl"])?>";
			location.href = "../mem/login.php?returnUrl=" + returnUrl;
		}
		else {
			return;
		}
	}
	else if(buyable == 'buyable3') {
		alert("특정 회원 전용 구매 상품입니다.");
	}
}

$(function() {
	$("#kakaoStory").click(function() {
		var post		= "<?php echo $TPL_VAR["msg_kakaoStory_goodsurl"]?>";
		var appid		= "http://<?php echo $GLOBALS["_SERVER"]["HTTP_HOST"]?>";
		var appver		= "1.0";
		var appname		= "<?php echo $TPL_VAR["msg_kakaoStory_shopnm"]?>";
		var imageurl	= "<?php echo $TPL_VAR["msg_kakaoStory_img_l"]?>";
		var title		= "<?php echo $TPL_VAR["msg_kakaoStory_goodsnm"]?>";

		kakao.link("story").send({
			post : post,
			appid : appid,
			appver : appver,
			appname : appname,
			urlinfo : JSON.stringify({title: title, imageurl: [imageurl], type: "website"})
		});
	});
});

function changeTab(tab_type) {
	var thisUrl = location.href.replace(location.hash,"");

	$("[class=^tab-]").removeClass('active-tab');
	$(".tab-basic").removeClass('active-tab');
	$(".tab-review").removeClass('active-tab');
	$(".tab-qna").removeClass('active-tab');

	$(".tab-basic .bar-area").removeClass('active-bar').removeClass('active-bar2');
	$(".tab-review .bar-area").removeClass('active-bar').removeClass('active-bar2');

	$(".content-basic").hide();
	$(".content-review").hide();
	$(".content-qna").hide();

	if(tab_type == 'basic') {
		$(".tab-basic").addClass('active-tab');
		$(".tab-basic .bar-area").addClass('active-bar');
		location.href = thisUrl + "#purchase";

		$(".content-basic").show();
	}
	else if(tab_type == 'review') {
		$(".tab-review").addClass('active-tab');
		$(".tab-basic .bar-area").addClass('active-bar').addClass('active-bar2');
		$(".tab-review .bar-area").addClass('active-bar');
		location.href = thisUrl + "#goods-review";

		$(".content-review").show();
	}
	else if(tab_type == 'qna') {
		$(".tab-qna").addClass('active-tab');
		$(".tab-review .bar-area").addClass('active-bar').addClass('active-bar2');
		location.href = thisUrl + "#goods-qna";

		$(".content-qna").show();
	}
}

function delete_qnaReview( mode, m_no, sno )
{
	if ( m_no > 0 ){
		if(confirm("삭제하시겠습니까?"))
			if (mode == 'delete_qna') frmTitle = '상품문의 삭제';
			else if (mode == 'del_review') frmTitle = '상품후기 삭제';
			else frmTitle = '게시글삭제';
			frmMake("../goods/indb.php?mode=" + mode + "&sno=" + sno + "&m_no=" + m_no,mode,frmTitle,false,true,200);
	}
	else if(mode === 'del_qna') {
		frmMake("../goods/goods_qna_delete.php?mode=" + mode + "&sno=" + sno + "&m_no=" + m_no,'delete_qna','상품문의 삭제',false,true,200);
	}
	else if(mode === 'del_review') {
		frmMake("../goods/review_delete.php?mode=" + mode + "&sno=" + sno + "&m_no=" + m_no,'delete_review','상품후기 삭제',false,true,200);
	}
}

</script>
<script src="/shop/data/skin_mobileV2/light/goods/goods_detail.js"></script>
<style type="text/css">

.swipe {
  overflow: hidden;
  visibility: hidden;
  position: relative;
}
.swipe-wrap {
  overflow: hidden;
  position: relative;
}
.swipe-wrap > div {
  float:left;
  width:100%;
  position: relative;
}

.goods_price2 {height:20px;line-height:20px;text-align:right;}
.goods_dc {height:20px;line-height:20px;text-align:right;color:#88eeff;}
section#goodsview2 {background:#FFFFFF;}
	section#goodsview2 .top_title{clear:both; /*height:36px;*/ line-height:20px; background:#f9f9f9; color:#222222; font-size:14px; font-weight:bold; text-align:left; font-family:dotum; border-bottom:solid 1px #969ca3; padding-left:10px;  white-space: normal;overflow: hidden;}
section#goodsview2 .top_btn{clear:both; height:40px;background:#FFFFFF; line-height:40px; border-bottom:solid 1px #dbdcde;}
section#goodsview2 .top_btn .left_list_btn{ float:left; width:58px; height:27px; background:url('/shop/data/skin_mobileV2/light/common/img/new/btn_list_view.png') no-repeat; background-size:58px 27px; line-height:27px; color:#FFFFFF; font-size:12px; text-align:center; margin-left:7px; margin-top:7px;}
section#goodsview2 .top_btn .right_other_btn{float:right; width:104px; height:27px; background:url('/shop/data/skin_mobileV2/light/common/img/new/btn_more_view.png') no-repeat; background-size:104px 27px; line-height:27px; color:#FFFFFF; font-size:12px; text-align:center; margin-right:7px; margin-top:7px;}
section#goodsview2 .top_btn .right_other_btn2{float:right; width:104px; height:27px; background:url('/shop/data/skin_mobileV2/light/common/img/new/btn_more_view_up.png') no-repeat; background-size:104px 27px; line-height:27px; color:#FFFFFF; font-size:12px; text-align:center; margin-right:7px; margin-top:7px;}


section#goodsview2 .goods-other-wrap { height:76px; background:#FFFFFF; border-bottom:solid 1px #dbdcde;}
section#goodsview2 .goods-other-area { width:320px; margin:auto;}
section#goodsview2 .goods-other-area .goods-other-content { width:320px; margin:auto; }
section#goodsview2 .goods-other-area .goods-other-content .goods-other-item{ width:50px; height:50px; float:left; margin-top:13px;}
section#goodsview2 .goods-other-area .goods-other-content .left-margin{ margin-left:11px;}
section#goodsview2 .goods-other-area .goods-other-content .right-margin{ margin-right:12px;}
section#goodsview2 .goods-other-area .goods-other-content .goods-other-item img{ width:100%; height:100%;}

section#goodsview2 .goods-other-wrap { height:76px; background:#FFFFFF;}
section#goodsview2 .goods-other-wrap .goods-other-arrow { position:absolute; width:100%;}
section#goodsview2 .goods-other-wrap .goods-other-arrow-left {position:absolute; width:27px; z-index:99; float:left;}
section#goodsview2 .goods-other-wrap .goods-other-arrow .left-arrow{ width:27px; height:37px; margin-top:20px; float:left; background:url('/shop/data/skin_mobileV2/light/common/img/detailp/btn_arrow_pre.png') no-repeat; z-index:99;}
section#goodsview2 .goods-other-wrap .goods-other-arrow-right {position:absolute; width:27px; z-index:99; float:right; right:0px;}
section#goodsview2 .goods-other-wrap .goods-other-arrow .right-arrow{  width:27px; height:37px; margin-top:20px; float:right; background:url('/shop/data/skin_mobileV2/light/common/img/detailp/btn_arrow_next.png') no-repeat; z-index:99;}

section#goodsview2 .goods-contents-area {padding-bottom:26px;}
section#goodsview2 .goods-contents-area .goods-contents-area-top{padding:12px;}
section#goodsview2 .goods-contents-area .thumbnail-area{border:solid 1px #d9d9d9;}
section#goodsview2 .goods-contents-area .thumbnail-area .thumbnail-img{padding:0 0 11px;margin:none;}
section#goodsview2 .goods-contents-area .thumbnail-area .thumbnail-img img{width:100%; margin:none; margin-bottom:-3px;}
section#goodsview2 .goods-contents-area .thumbnail-area .goods-speach-description{background-image: url('/shop/data/skin_mobileV2/light/common/img/goods/btn_goods_play.png'); background-size: 65px 65px; background-position: -8.5px -4px; z-index: 99; position: relative; height: 50px; width: 50px; color: #ffffff; text-align: center; float: left; margin-top: -50px;}
section#goodsview2 .goods-contents-area .thumbnail-area .goods-speach-description.playing{background-image: url('/shop/data/skin_mobileV2/light/common/img/goods/btn_goods_stop.png');}
section#goodsview2 .goods-contents-area .thumbnail-area .goods-speach-description .speach-description-play{display: block; width: 100%; height: 100%; font-size: 0;}
section#goodsview2 .goods-contents-area .thumbnail-area .goods-speach-description .speach-description-timer{position: absolute; left: 0; right: 0; bottom: 1px; font-size: 11px; line-height: 12px; height: 12px; display: none;}
section#goodsview2 .goods-contents-area .thumbnail-area .goods-speach-description.playing .speach-description-timer{display: block;}
section#goodsview2 .goods-contents-area .thumbnail-area .zoom-area{z-index:99; position:relative; width:50px; height:50px; background:url('/shop/data/skin_mobileV2/light/common/img/goods/btn_goods_view.png') no-repeat; background-size: 100% 100%; float:right; margin-top:-50px;}
section#goodsview2 .goods-contents-area .price-area {border:solid 1px #d9d9d9; border-top:none; height:46px;}
section#goodsview2 .goods-contents-area .price-area .price-text{float:left; }
section#goodsview2 .goods-contents-area .price-area .price-text .goods_price{ color:#f03c3c; font-size:16px; font-weight:bold; font-family:dotum; margin-left:15px; line-height:30px;}
section#goodsview2 .goods-contents-area .price-area .price-text .goods_dc{ color:#56758F; font-size:12px; font-weight:bold; font-family:dotum; margin-left:15px; line-height:16px; }
section#goodsview2 .goods-contents-area .price-area .goods_coupon{ background:url('/shop/data/skin_mobileV2/light/common/img/new/btn_coupon.png') no-repeat; background-size:51px 20px; width:51px; height:20px; color:#FFFFFF; font-size:12px; float:right; text-align:center; margin-top:4px; margin-right:15px;}

section#goodsview2 .goods-contents-area .share-area {border:solid 1px #d9d9d9; height:43px; margin-top:8px; clear:both;}
section#goodsview2 .goods-contents-area .share-area .share-title{height:43px; font-size:12px; color:#353535; margin-left:15px; line-height:43px; margin-right:18px; float:left;}
section#goodsview2 .goods-contents-area .share-area .share-btn {float:left; width:218px;}
section#goodsview2 .goods-contents-area .share-area .share-btn .sns01{background:transparent url("/shop/data/skin_mobileV2/light/common/img/detailp/icon_twitter_off.png") no-repeat;  width:29px; height:29px; float:left; margin-right:8px; margin-top:7px; background-size:29px 29px;}
section#goodsview2 .goods-contents-area .share-area .share-btn .sns01:active{background:transparent url("/shop/data/skin_mobileV2/light/common/img/detailp/icon_twitter_on.png") no-repeat;}
section#goodsview2 .goods-contents-area .share-area .share-btn .sns02{background:transparent url("/shop/data/skin_mobileV2/light/common/img/detailp/icon_facebook_off.png") no-repeat;  width:29px; height:29px; float:left; margin-right:8px; margin-top:7px; background-size:29px 29px;}
section#goodsview2 .goods-contents-area .share-area .share-btn .sns02:active{background:transparent url("/shop/data/skin_mobileV2/light/common/img/detailp/icon_facebook_on.png") no-repeat;}
section#goodsview2 .goods-contents-area .share-area .share-btn .sns03{background:transparent url("/shop/data/skin_mobileV2/light/common/img/detailp/icon_kakao_off.png") no-repeat;  width:29px; height:29px; float:left; margin-right:8px; margin-top:7px; background-size:29px 29px;}
section#goodsview2 .goods-contents-area .share-area .share-btn .sns03:active{background:transparent url("/shop/data/skin_mobileV2/light/common/img/detailp/icon_kakao_on.png") no-repeat;}
section#goodsview2 .goods-contents-area .share-area .share-btn .sns04{background:transparent url("/shop/data/skin_mobileV2/light/common/img/detailp/icon_me2day_off.png") no-repeat;  width:29px; height:29px; float:left; margin-right:8px; margin-top:7px; background-size:29px 29px;}
section#goodsview2 .goods-contents-area .share-area .share-btn .sns04:active{background:transparent url("/shop/data/skin_mobileV2/light/common/img/detailp/icon_me2day_on.png") no-repeat;}
section#goodsview2 .goods-contents-area .share-area .share-btn .sns05{background:transparent url("/shop/data/skin_mobileV2/light/common/img/detailp/icon_cyworld_off.png") no-repeat;  width:29px; height:29px; float:left; margin-top:7px; background-size:29px 29px;}
section#goodsview2 .goods-contents-area .share-area .share-btn .sns05:active{background:transparent url("/shop/data/skin_mobileV2/light/common/img/detailp/icon_cyworld_on.png") no-repeat;}
section#goodsview2 .goods-contents-area .share-area .share-btn .sns06{background:transparent url("/shop/data/skin_mobileV2/light/common/img/detailp/icon_kakaoStory_off.png") no-repeat;  width:29px; height:29px; float:left; margin-right:12px; margin-top:7px; display: block !important; background-size:29px 29px;}
section#goodsview2 .goods-contents-area .share-area .share-btn .sns06:active{background:transparent url("/shop/data/skin_mobileV2/light/common/img/detailp/icon_kakaoStory_on.png") no-repeat; display: block !important;}
section#goodsview2 .goods-contents-area .share-area .share-btn .sns07{background:transparent url("/shop/data/skin_mobileV2/light/common/img/detailp/icon_pinterest_off.png") no-repeat;  width:29px; height:29px; float:left; margin-right:8px; margin-top:7px; display: block !important; background-size:29px 29px;}
section#goodsview2 .goods-contents-area .share-area .share-btn .sns07:active{background:transparent url("/shop/data/skin_mobileV2/light/common/img/detailp/icon_pinterest_on.png") no-repeat; display: block !important;}
section#goodsview2 .goods-contents-area .share-area .share-btn .sns08{background:transparent url("/shop/data/skin_mobileV2/light/common/img/detailp/icon_url_off.png") no-repeat;  width:29px; height:29px; float:left;margin-top:7px; display: block !important; cursor:pointer; background-size:29px 29px;}
section#goodsview2 .goods-contents-area .share-area .share-btn .sns08:active{background:transparent url("/shop/data/skin_mobileV2/light/common/img/detailp/icon_url_on.png") no-repeat; display: block !important;}

section#goodsview2 .goods-contents-area .buy-info-area {margin-top:13px; margin-bottom:18px;clear: both;}
section#goodsview2 .goods-contents-area .buy-info-item {height:26px; margin-bottom:4px; line-height:26px;}
section#goodsview2 .goods-contents-area .buy-info-item .buy-info-title {float:left; max-width:40%; color:#353535;}
section#goodsview2 .goods-contents-area .buy-info-item .buy-info-contents {float:right; max-width:60%;}
section#goodsview2 .goods-contents-area .buy-info-item .buy-info-contents select{height:26px; width:174px; text-align:right;}
section#goodsview2 .goods-contents-area .buy-info-item .buy-info-contents input{height:20px; text-align:right; float:right; width:50px;}
section#goodsview2 .goods-contents-area .buy-info-item .buy-info-contents input.inputable-addoption{width:165px;}	/* select element's width -9px (padding + border) */
section#goodsview2 .goods-contents-area .buy-info-item .buy-info-contents .cnt_plus{width:26px; height:26px; background:url("/shop/data/skin_mobileV2/light/common/img/new/btn_amount_plus.png") no-repeat; background-size:26px 26px;float:right; margin-left:5px; }
section#goodsview2 .goods-contents-area .buy-info-item .buy-info-contents .cnt_minus{width:26px; height:26px; background:url("/shop/data/skin_mobileV2/light/common/img/new/btn_amount_.png") no-repeat; background-size:26px 26px; float:right; margin-left:5px;}
section#goodsview2 .goods-contents-area .buy-info-item p {height:16px;line-height:16px; margin-bottom:8px;}

#el-multi-option-display  table {border:0; border-collapse: separate; border-spacing: 3px;}
#el-multi-option-display  table td {border:1px solid #ccc; }
.goods-multi-option {display:none;}
.order-contents-area  {margin-top:2px; margin-left:8px; margin-right:4px;}
.order-contents-area  {height:20px; margin-bottom:2px; line-height:20px;}
.goods-multi-option table {border:1px solid #D3D3D3;}
.goods-multi-option table td {border-bottom:1px solid #D3D3D3;padding:10px;}
.goods-multi-option .order-contents-area {margin-top:2px; margin-left:8px; margin-right:4px; height:20px; margin-bottom:2px; line-height:20px;}
.goods-multi-option .order-contents-area  .buy-info-title {float:left; max-width:50%; color:#353535;}
.goods-multi-option .order-contents-area  .buy-info-title .cnt_plus{width:26px; height:26px; background:url("/shop/data/skin_mobileV2/light/common/img/new/btn_amount_plus.png") no-repeat; background-size:26px 26px;float:right; margin-left:5px; }
.goods-multi-option .order-contents-area  .buy-info-title .cnt_minus{width:26px; height:26px; background:url("/shop/data/skin_mobileV2/light/common/img/new/btn_amount_.png") no-repeat; background-size:26px 26px; float:right; margin-left:5px;}
.goods-multi-option .order-contents-area  .buy-info-contents {float:right; max-width:50%;}
.goods-multi-option .order-contents-area .buy-info-contents .del_multi_opt{width:11px; height:11px; background:url("/shop/data/skin_mobileV2/light/common/img/new/btn_multioption_del.gif") no-repeat; background-size:11px 11px; margin-left:5px; display:inline-block;}
.order-contents-area  p {height:16px;line-height:16px; margin-bottom:8px;}

.add-option-area {width:296px;margin:auto; margin-bottom:18px;}
.add-option-area .btn-add-option {width:296px; height:38px; background:#FFFFFF; line-height:38px; text-align:center; font-size:14px; color:#808591; border-radius:4px; border:solid 1px #cecfcf; font-weight:bold;}

section#goodsview2 .goods-contents-area .btn-area {width:296px; height:38px; margin:auto;  text-align:center; color:#ffffff; font-size:14px; line-height:38px; margin:0 auto;}
section#goodsview2 .goods-contents-area .btn-area .btn-buy {width:94px; height:38px; background:#f35151; float:left; margin-right:6px; border-radius:4px; font-weight:Bold;}
section#goodsview2 .goods-contents-area .btn-area .btn-cart {width:94px; height:38px; background:#808591; float:left; margin-right:6px;border-radius:4px; font-weight:Bold;}
section#goodsview2 .goods-contents-area .btn-area .btn-wish {width:94px; height:38px; background:#808591; float:left; border-radius:4px; font-weight:Bold;}
section#goodsview2 .goods-contents-area .btn-area .btn-soldout {width:296px; height:38px; background:#5AAEFF; float:left; margin-right:6px; border-radius:4px; font-weight:Bold;}

section#goodsview2 .goods-contents-area .other-settle-area {margin:18px 0px;}

section#goodsview2 .goods-contents-area .detail-view-area {width:296px;margin:auto; margin-bottom:18px;}
section#goodsview2 .goods-contents-area .detail-view-area .btn-detail {width:296px; height:38px; background:#FFFFFF; line-height:38px; text-align:center; font-size:14px; color:#808591; border-radius:4px; border:solid 1px #cecfcf; font-weight:bold;}

section#goodsview2 .goods-contents-area .goods-info-area {}
section#goodsview2 .goods-contents-area .goods-info-area .tab-area{ height:33px; font-family:dotum; padding-left:10px; padding-right:10px;}
section#goodsview2 .goods-contents-area .goods-info-area .tab-area .tab-basic{ float:left; background:#FFFFFF; repeat-x; width:33%; font-size:14px; color:#94959d; line-height:33px;text-align:center; font-weight:bold; border-bottom:solid 1px #dadada;}
section#goodsview2 .goods-contents-area .goods-info-area .tab-area .tab-review{ float:left; background:#FFFFFF; width:33%; font-size:14px; color:#94959d; line-height:33px;text-align:center; font-weight:bold;border-bottom:solid 1px #dadada;}
section#goodsview2 .goods-contents-area .goods-info-area .tab-area .tab-qna{ float:left; background:#FFFFFF; width:33%; font-size:14px; color:#94959d; line-height:33px;text-align:center; font-weight:bold;border-bottom:solid 1px #dadada;}
section#goodsview2 .goods-contents-area .tab-relative{ background:#FFFFFF; font-size:14px; color:#353535; line-height:33px; font-weight:bold;border-bottom:solid 1px #dadada; border-top:solid 1px #dadada; margin:30px 10px 0; padding-left: 10px;}
section#goodsview2 .goods-contents-area .goods-info-area .tab-area .bar-area{float:right; width:0px;height:33px;  no-repeat;}
section#goodsview2 .goods-contents-area .goods-info-area .tab-area .active-bar{}
section#goodsview2 .goods-contents-area .goods-info-area .tab-area .active-bar2{}
section#goodsview2 .goods-contents-area .goods-info-area .tab-area .active-tab {background:#FFFFFF; line-height:32px; border:solid 1px #dadada; border-bottom:none; color:#353535;}
section#goodsview2 .goods-contents-area .goods-info-area .content-area {padding:12px 12px 0px 15px;}
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-basic .content-item {clear:both; height:24px;}
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-basic .content-item .content-title{font-size:12px; color:#353535; float:left; width:102px; line-height:24px; height:24px;}
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-basic .content-item .content-content{font-size:12px; color:#353535; float:left;line-height:24px; height:24px;}
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-basic .content-item .red{color:#f03c3c;font-weight:bold;}
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-basic .content-item .blue{color:#56758F;font-weight:bold;}

section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-review .review-title {font-size:14px; font-weight:bold; font-family:dotum; color:#353535; height:27px; line-height:27px;}
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-review .review-title .title{float:left;}
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-review .review-title .title .title_cnt{color:#466996}
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-review .review-title .write-btn{float:right;width:80px; height:27px; line-height:27px; font-size:12px; color:#FFFFFF; font-weight:normal;text-align:center; background:#808591; font-family:dotum; border-radius:3px;}
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-review .review-item { border:solid 1px #d9d9d9; border-bottom:none; margin-top:8px;}
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-review .review-item .review-item-title { border-bottom:solid 1px #d9d9d9; padding:8px 14px 8px 14px;}
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-review .review-item .review-item-title .review-item-subject {font-weight:bold; color:#353535; line-height:19px;}
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-review .review-item .review-item-title .review-item-id {color:#353535; line-height:19px; }
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-review .review-item .review-item-title .review-item-id .review-item-star {float:right; color:#d4d4d4; font-size:12px;}
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-review .review-item .review-item-title .review-item-id .review-item-star .active{color:#FECE00;}
section#goodsview2 .review-item-star{color:#d4d4d4;display:inline-block;}
section#goodsview2 .review-item-star span {color:#d4d4d4;font-weight:bold;background:url("/shop/data/skin_mobileV2/light/common/img/new/btn_star_off.png") no-repeat;display:block;width:12px;height:12px;float:left;font-size:0;background-size: 100% 100%;}
section#goodsview2 .review-item-star .active {color:#FECE00;font-weight:bold;background:url("/shop/data/skin_mobileV2/light/common/img/new/btn_star_on.png") no-repeat;display:block;width:12px;height:12px;float:left;font-size:0;background-size: 100% 100%;}
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-review .review-item .review-item-content { background:#F5F5F5;display:none;}
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-review .review-item .review-item-content .review-item-content-review{ border-bottom:solid 1px #d9d9d9; padding:8px 14px 8px 14px; }
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-review .review-item .review-item-content .review-item-content-reply{ border-bottom:solid 1px #d9d9d9; padding:8px 14px 8px 14px; }
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-review .review-item .review-item-content .review-item-content-reply .reply-icon {float:left; background:url("/shop/data/skin_mobileV2/light/common/img/new/btn_re.png") no-repeat; background-size:20px 14px; width:20px; height:14px; margin-right:5px; }
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-review .review-more-btn {width:300px; margin:auto; text-align:center; height:35px; color:#ffffff; line-height:35px; font-size:15px; font-weight:bold; background:#808591; border-radius:3px; font-family:dotum; margin-top:15px;}

section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-qna .qna-title {font-size:14px; font-weight:bold; font-family:dotum; color:#353535;  height:27px;  line-height:27px;}
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-qna .qna-title .title{float:left;}
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-qna .qna-title .title .title_cnt{color:#466996}
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-qna .qna-title .write-btn{float:right;width:80px; height:27px; line-height:27px; font-size:12px; color:#FFFFFF; font-weight:normal;text-align:center; background:#808591; font-family:dotum; border-radius:3px;}

section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-qna .qna-item { border:solid 1px #d9d9d9; border-bottom:none; margin-top:8px;}
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-qna .qna-item .qna-item-title { border-bottom:solid 1px #d9d9d9; padding:8px 14px 8px 14px;}
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-qna .qna-item .qna-item-title .qna-item-subject {font-weight:bold; color:#353535; line-height:19px;}
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-qna .qna-item .qna-item-title .qna-item-id {color:#353535; line-height:19px; }
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-qna .qna-item .qna-item-title .qna-item-id .answer-n {float:right; width:53px; height:17px; background:url("/shop/data/skin_mobileV2/light/common/img/new/btn_q_ready.png") no-repeat; background-size:53px 17px;}
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-qna .qna-item .qna-item-title .qna-item-id .answer-y {float:right;  width:53px; height:17px; background:url("/shop/data/skin_mobileV2/light/common/img/new/btn_q_complete.png") no-repeat; background-size:53px 17px;}
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-qna .qna-item .qna-item-content { background:#F5F5F5; display:none;}
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-qna .qna-item .qna-item-content .qna-item-content-question{ border-bottom:solid 1px #d9d9d9; padding:8px 14px 8px 14px; }
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-qna .qna-item .qna-item-content .qna-item-content-answer{ border-bottom:solid 1px #d9d9d9; padding:8px 14px 8px 14px; }
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-qna .qna-item .qna-item-content .qna-item-content-answer .answer-icon {float:left; background:url("/shop/data/skin_mobileV2/light/common/img/new/btn_a.png") no-repeat; background-size:16px 14px; width:16px; height:14px; margin-right:5px;}
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-qna .qna-item .qna-item-content .qna-item-content-question .question-icon {float:left; background:url("/shop/data/skin_mobileV2/light/common/img/new/btn_q.png") no-repeat; background-size:16px 14px; width:16px; height:14px; margin-right:5px;}
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-qna .qna-more-btn {width:300px; margin:auto; text-align:center; height:35px; color:#ffffff; line-height:35px; font-size:15px; font-weight:bold; background:#808591; border-radius:3px; font-family:dotum; margin-top:15px;}


section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-basic .commoninfo-area { margin-top:16px;}
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-basic .commoninfo-area .commoninfo-wrap {border:solid 1px #d9d9d9; border-bottom:none; }
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-basic .commoninfo-area .commoninfo-wrap .commoninfo-title{border-bottom:solid 1px #d9d9d9; padding:0px 10px 0px 10px; height:33px; line-height:33px;}
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-basic .commoninfo-area .commoninfo-wrap .commoninfo-title .down_arrow{background:url("/shop/data/skin_mobileV2/light/common/img/info/icon_arrow_down.png") no-repeat; width:15px; height:15px; margin-top:9px;float:right;}
section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-basic .commoninfo-area .commoninfo-wrap .commoninfo-title .up_arrow{background:url("/shop/data/skin_mobileV2/light/common/img/info/icon_arrow_up.png") no-repeat; width:15px; height:15px; margin-top:9px;float:right;}

section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-basic .commoninfo-area .commoninfo-wrap .active_title{color:#436593; font-weight:bold;}

section#goodsview2 .goods-contents-area .goods-info-area .content-area .content-basic .commoninfo-area .commoninfo-wrap .commoninfo-content{border-bottom:solid 1px #d9d9d9; padding:12px 12px 12px 12px; background:#f5f5f5; display:none;}
section#goodsview2 .goods-contents-area .del-btn {float:right; margin-bottom:8px; width:70px; height:27px; line-height:27px; font-size:12px; color:#FFFFFF; font-weight:normal; text-align:center; background:#808591; font-family:dotum; border-radius:3px;}

section#goodsview2 .goods-contents-area .couponlist-area {bottom:0px; position:fixed; width:100%; background:#FFFFFF; z-index:99; display:none;}
section#goodsview2 .goods-contents-area .couponlist-title {background:#313030; border-bottom:solid 1px #b2b2b2; height:48px;}
section#goodsview2 .goods-contents-area .couponlist-title .title{height:48px; line-height:48px; margin-left:15px; font-size:16px; color:#FFFFFF; font-family:dotum;font-weight:bold;float:left;}
section#goodsview2 .goods-contents-area .couponlist-title .title .title_cnt{font-size:14px;}
section#goodsview2 .goods-contents-area .couponlist-title .close-btn{background:url("/shop/data/skin_mobileV2/light/common/img/new/btn_close.png") no-repeat; background-size:31px 31px; width:31px; height:31px; margin-top:8px;float:right;margin-right:10px;}
section#goodsview2 .goods-contents-area .couponlist-item{height:43px; border-bottom:solid 1px #dbdbdb;}
section#goodsview2 .goods-contents-area .couponlist-item .couponlist-item-name{height:43px; line-height:43px; font-size:12px; color:#353535; margin-left:15px;  float:left;}
section#goodsview2 .goods-contents-area .couponlist-item .couponlist-item-name .mobile_coupon{color:#f03c3c;}
section#goodsview2 .goods-contents-area .couponlist-item .download-btn{background:#f35151; border-radius:3px; width:80px; height:27px; margin-top:8px; line-height:27px; font-size:12px; color:#FFFFFF; float:right; margin-right:12px;text-align:center;}
section#goodsview2 .goods-contents-area .couponlist-title .close-btn{background:url("/shop/data/skin_mobileV2/light/common/img/new/btn_close.png") no-repeat; background-size:31px 31px; width:31px; height:31px; margin-top:8px;float:right;margin-right:10px;}

section#goodsview2 .goods-contents-area .couponlist-area .couponlist-item-area {position:relative; max-height:220px; width:100%; overflow:hidden;}

.goods-qna-certification {background:url("/shop/data/skin_mobileV2/light/common/img/nlist/btn_delete02_off.png") no-repeat; background-size:40px 21px; width:40px; height:21px; border:none; font-size:10px; padding:none; text-align:center;}
.goods-qna-certification:active {background:url("/shop/data/skin_mobileV2/light/common/img/nlist/btn_delete02_on.png") no-repeat;}

#background {
	position : fixed;
	left : 0;
	top : 0;
	bottom:0px;
	width : 100%;
	height : 100%;
	background : rgba(0, 0, 0, 0.2);
	display:none;
	z-index:98;
}

/* 모바일전용, 무통장전용 쿠폰*/
section#goodsview2 .goods-contents-area .couponlist-item .couponlist-item-name .couponInfoOnlyBtn							{ height: 16px; width: 130px; }
section#goodsview2 .goods-contents-area .couponlist-item .couponlist-item-name .couponInfoOnlyName							{ height: 26px; line-height: 26px; }
section#goodsview2 .goods-contents-area .couponlist-item .couponlist-item-name .couponInfoOnlyBtn .onlyMobileCouponBtn		{ margin: 0px 3px 0px 0px; float: left; width: 60px; height: 15px; color: #ffffff; font-size: 10px; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; background-color: #56ca81; font-weight: bold; text-align: center; line-height: 15px; }
section#goodsview2 .goods-contents-area .couponlist-item .couponlist-item-name .couponInfoOnlyBtn .onlyBankBookCouponBtn	{ margin: 0px 3px 0px 0px; float: left; width: 60px; height: 15px; color: #ffffff; font-size: 10px; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; background-color: #7b9ff0; font-weight: bold; text-align: center; line-height: 15px; }

/* 관련상품 */
#relativegoods {overflow:hidden;overflow-x:scroll;clear:both; margin:auto; min-width:296px; padding:12px;}
#relativegoods .inner-wrapper{padding:1px;}
#relativegoods .goods-item{width:30%; margin-bottom:18px; display:block; float:left; min-width:87px;}
#relativegoods .goods-item .goods-img{position:relative; width:100%; text-align:center;}
#relativegoods .goods-item .goods-img .goods-speach-description{display: block !important; background-image: url('/shop/data/skin_mobileV2/light/img/goods/btn_main_play.png'); background-size: 100% 100%; position: relative; height: 32px; color: #ffffff; width: 32px; text-align: center; margin-top: -36px; margin-left: 1px;}
#relativegoods .goods-item .goods-price .red {color: #f03c3c;font-size: 12px;font-weight: bold;}
#relativegoods .goods-item .goods-price {font-weight:bold;width:100%; height:18px; font-size:13px; color:#222222; line-height:18px; text-align:center;}
#relativegoods .goods-item .goods-price a{font-weight:bold; font-size:13px; color:#222222;}
#relativegoods .goods-item .goods-price .red{color:#f03c3c; font-size:12px; font-weight:bold; !important;}
#relativegoods .goods-item .goods-discount {font-weight:bold; color:#fb0e0e; width:100%; height:18px; font-size:12px; line-height:18px; text-align:center; display: block !important;}
#relativegoods .goods-item .goods-dc {width:100%; height:18px; font-size:12px; font-weight:bold; color:#436693; line-height:15px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
#relativegoods .goods-item .goods-dc a{font-size:12px; font-weight:bold; color:#436693;}
#relativegoods .goods-item .goods-consumer {text-align:center; font-size:13px; color:#222222; padding-left:3px; padding-right:3px; overflow:hidden;white-space:nowrap; display:block !important;}
#relativegoods .goods-item .goods-coupon-price {text-align:center; font-size:12px; color:#fb0e0e; padding-left:3px; padding-right:3px; overflow:hidden;white-space:nowrap; display:block !important;}
#relativegoods .goods-item .goods-coupon-price .goods-coupon-icon { width:21px; height:12px; background:url('/shop/data/skin_mobileV2/light/img/good_icon_coupon.gif') no-repeat; display: inline-block !important;}

/* 상품확대사진 스와이프 */
.goods_banner {clear:both;padding:0px;margin-bottom:10px; position:static;}
.goods_banner .swipe_detail {width:100%}
.goods_banner .swipe_detail .list_content_border {border-bottom:solid 1px #cccccc; float:left; width:100%; margin-bottom:10px;}
.goods_banner .swipe_detail .list_content {width:100%; padding-bottom:10px; float:left;}
.goods_banner .swipe_detail .list_content .list_item { text-align:center;}
.goods_banner .swipe_detail .list_content .list_item>img {height:auto;}
.goods_banner .list_page {height:29px; text-align:center; padding-left:32%; padding-right:32%; margin-top:10px;}
.goods_banner .list_page .list_page_wrap {text-align:center}
.goods_banner .list_page .list_page_box {background:url('/shop/data/skin_mobileV2/light/common/img/new/b_off.png') center center no-repeat; height:10px; width:14px; background-size:10px 10px;  display:inline-block; margin-left:1%; margin-right:1%;}
.goods_banner .list_page .now_page {background:url('/shop/data/skin_mobileV2/light/common/img/new/b_on.png') center center no-repeat; height:10px; width:14px; background-size:10px 10px;}
.goods_banner .list_margin {height:10px;float:left; width:100%;}
</style>


<input type="hidden" name="list_category" value="<?php echo $TPL_VAR["category"]?>" />
<input type="hidden" name="list_kw" value="<?php echo $TPL_VAR["kw"]?>" />
<input type="hidden" name="view_area" value="<?php echo $TPL_VAR["view_area"]?>" />

<section id="goodsview2" class="content">
	<div class="top_title">
		<div class="goods_nm">
<?php if($TPL_VAR["clevel"]=='0'||$TPL_VAR["slevel"]>=$TPL_VAR["clevel"]){?>
		<?php echo $TPL_VAR["goods_prefix"]?><?php echo $TPL_VAR["goodsnm"]?>

<?php }elseif($TPL_VAR["slevel"]<$TPL_VAR["clevel"]&&$TPL_VAR["auth_step"][ 1]=='Y'){?>
		<?php echo $TPL_VAR["goods_prefix"]?><?php echo $TPL_VAR["goodsnm"]?>

<?php }?>
		</div>
	</div>
	<div class="top_btn">
<?php if($TPL_VAR["kw"]){?>
		<div class="left_list_btn" onClick="javascript:document.location.href='/'+mobile_root+'/goods/list.php?kw=<?php echo $TPL_VAR["kw"]?>';">
				&nbsp;&nbsp;&nbsp;
		</div>
<?php }elseif($TPL_VAR["category"]){?>
		<div class="left_list_btn" onClick="javascript:document.location.href='/'+mobile_root+'/goods/list.php?category=<?php echo $TPL_VAR["category"]?>';">
				&nbsp;&nbsp;&nbsp;
		</div>
<?php }elseif($TPL_VAR["referer"]){?>
		<div class="left_list_btn" onClick="javascript:document.location.href='<?php echo $TPL_VAR["referer"]?>';">
				&nbsp;&nbsp;&nbsp;
		</div>
<?php }?>
<?php if($TPL_VAR["category"]||$TPL_VAR["kw"]){?>
		<div class="right_other_btn" onClick="javascript:showOtherGodds();">
			&nbsp;&nbsp;&nbsp;
		</div>
<?php }?>
	</div>
	<div class="goods-other-wrap">
		<div class="goods-other-arrow">
			<div class="goods-other-arrow-left"><div class="left-arrow" onClick="javascript:objSwipe.prev();"></div></div>
			<div class="goods-other-arrow-right"><div class="right-arrow" onClick="javascript:objSwipe.next();"></div></div>
		</div>
		<div  id="swipe-other-goods" class="goods-other-area" >
			<div>

			</div>
		</div>
	</div>
	<div class="goods-contents-area">
		<div class="goods-contents-area-top">
		<div class="thumbnail-area">
			<div class="thumbnail-img">
				<div class="goods_banner" id="banner-detail" style="margin-bottom:0;">
					<div class="list_content_border"></div>
					<div class="swipe_detail" id="swipe_detail">
						<div>
<?php if($TPL_l_img_1){$TPL_I1=-1;foreach($TPL_VAR["l_img"] as $TPL_V1){$TPL_I1++;?>
							<div class="list_content<?php if($TPL_I1!= 0){?> hidden<?php }?>" id="banner-detail-<?php echo $TPL_I1+ 1?>">
								<div class="list_item">
									<?php echo goodsimgMobile($TPL_V1, 500)?>

								</div>
							</div>
<?php }}?>
						</div>
					</div>
					<div class="list_content_border"></div>
					<div class="list_page">
						<div class="list_page_wrap">
<?php if((is_array($TPL_R1=range( 0,$TPL_l_img_1- 1))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {$TPL_I1=-1;foreach($TPL_R1 as $TPL_V1){$TPL_I1++;?>
							<div class="list_page_box<?php if($TPL_I1== 0){?> now_page<?php }?>" id="banner-detail-page-box-<?php echo $TPL_I1+ 1?>"></div>
<?php }}?>
							<div class="list_page_num hidden"><span id="swipe_detail-page" class="n_page">1</span> / <span id="banner-detail-tpage"><?php echo $TPL_l_img_1?></span></div>
						</div>
					</div>
					<div class="list_margin"></div>
				</div>
			</div>
<?php if($TPL_VAR["tts_url"]){?>
			<div class="goods-speach-description">
				<span class="speach-description-play" data-src="<?php echo $TPL_VAR["tts_url"]?>">재생</span>
				<span class="speach-description-timer"></span>
				<audio id="speach-description-player"></audio>
			</div>
<?php }?>
			<div class="zoom-area"  onClick="javascript:document.location.href='/'+mobile_root+'/goods/view_bigimg.php?goodsno=<?php echo $TPL_VAR["goodsno"]?>';">
				<div class="zoom-icon"></div>
			</div>
		</div>
		<div class="price-area">
			<div class="price-text">
<?php if($TPL_VAR["clevel"]=='0'||$TPL_VAR["slevel"]>=$TPL_VAR["clevel"]){?>
<?php if($TPL_VAR["runout"]&&$GLOBALS["cfg_soldout"]["price"]=='image'){?>
			<div class="goods_price"><img src="../data/goods/icon/custom/soldout_price"></div>
<?php }elseif($TPL_VAR["runout"]&&$GLOBALS["cfg_soldout"]["price"]=='string'){?>
			<div class="goods_price"><?php echo $GLOBALS["cfg_soldout"]["price_string"]?></div>
<?php }else{?>
			<div class="goods_price"><?php if(!$TPL_VAR["strprice"]){?> <?php echo number_format($TPL_VAR["price"])?>원 <?php }else{?> <?php echo $TPL_VAR["strprice"]?> <?php }?></div>
<?php }?>
<?php if($TPL_VAR["discount_mobile"]){?>
			<div class="goods_dc"><?php echo $TPL_VAR["discount_mobile"]?></div>
<?php }?>
<?php }elseif($TPL_VAR["slevel"]<$TPL_VAR["clevel"]&&$TPL_VAR["auth_step"][ 2]=='Y'){?>
<?php if($TPL_VAR["runout"]&&$GLOBALS["cfg_soldout"]["price"]=='image'){?>
			<div class="goods_price"><img src="../data/goods/icon/custom/soldout_price"></div>
<?php }elseif($TPL_VAR["runout"]&&$GLOBALS["cfg_soldout"]["price"]=='string'){?>
			<div class="goods_price"><?php echo $GLOBALS["cfg_soldout"]["price_string"]?></div>
<?php }else{?>
			<div class="goods_price"><?php if(!$TPL_VAR["strprice"]){?> <?php echo number_format($TPL_VAR["price"])?>원 <?php }else{?> <?php echo $TPL_VAR["strprice"]?> <?php }?></div>
<?php }?>
<?php if($TPL_VAR["discount_mobile"]){?>
			<div class="goods_dc"><?php echo $TPL_VAR["discount_mobile"]?></div>
<?php }?>
<?php }?>
			</div>
			<!-- 할인쿠폰 다운받기 -->
<?php if($TPL_VAR["coupon"]||$TPL_VAR["coupon_emoney"]){?>
            <div class="goods_coupon" onClick="javascript:showCouponList();">
            </div>
<?php }?>
		</div>
<?php if($TPL_VAR["sales_status"]=='range'){?>
		<div class="goods_sales_status">
		남은시간 : <span id="el-countdown-1"></span>
		</div>
		<script type="text/javascript">
		Countdown.init('<?php echo date('Y-m-d H:i:s',$TPL_VAR["sales_range_end"])?>', 'el-countdown-1');
		</script>
<?php }elseif($TPL_VAR["sales_status"]=='before'){?>
		<div class="goods_sales_status">
		<?php echo date('Y-m-d H:i:s',$TPL_VAR["sales_range_start"])?> 판매시작합니다.
		</div>
<?php }elseif($TPL_VAR["sales_status"]=='end'){?>
		<div class="goods_sales_status">
		판매가 종료되었습니다.
		</div>
<?php }?>

<?php if($TPL_VAR["snsBtn"]){?>
		<div class="share-area">
			<div class="share-title">
				공유하기
			</div>
			<div class="share-btn">
				<?php echo $TPL_VAR["snsBtn"]?>

			</div>
		</div>
<?php }?>
		<!-- <form name="frmView" method="post" onsubmit="return false;"> -->
		<form name="frmView" method="post">
		<input type="hidden" name="mode" value="" />
		<input type="hidden" name="goodsno" value="<?php echo $TPL_VAR["goodsno"]?>" />
		<input type="hidden" name="goodsCoupon" value="<?php echo $TPL_VAR["coupon"]?>" />
		<input type="hidden" name="min_ea" value="<?php echo $TPL_VAR["min_ea"]?>">
		<input type="hidden" name="max_ea" value="<?php echo $TPL_VAR["max_ea"]?>">
		<input type="hidden" name="ea" step="<?php if($TPL_VAR["sales_unit"]){?><?php echo $TPL_VAR["sales_unit"]?><?php }else{?>1<?php }?>" min="<?php if($TPL_VAR["min_ea"]){?><?php echo $TPL_VAR["min_ea"]?><?php }else{?>1<?php }?>" max="<?php if($TPL_VAR["max_ea"]){?><?php echo $TPL_VAR["max_ea"]?><?php }else{?>0<?php }?>" value=<?php if($TPL_VAR["min_ea"]){?><?php echo $TPL_VAR["min_ea"]?><?php }else{?>1<?php }?>>

<?php if(!$TPL_VAR["strprice"]){?>
			<div class="buy-info-area">
<?php if($GLOBALS["opt"]&&$GLOBALS["typeOption"]=="single"){?>
					<div class="buy-info-item">
						<div class="buy-info-title">선택옵션</div>
						<div class="buy-info-contents">
							<select name="opt[]" onchange="chkOption(this);nsGodo_MultiOption.set();" required fld_esssential msgR="옵션을 선택해주세요">
								<option value="">선택사항</option>
<?php if($TPL__opt_1){foreach($GLOBALS["opt"] as $TPL_V1){?><?php if((is_array($TPL_R2=$TPL_V1)&&!empty($TPL_R2)) || (is_object($TPL_R2) && in_array("Countable", class_implements($TPL_R2)) && $TPL_R2->count() > 0)) {foreach($TPL_R2 as $TPL_V2){?>
								<!-- 옵션품절 수정 by jung -->
								<!-- <option value="<?php echo $TPL_V2["opt1"]?><?php if($TPL_V2["opt2"]){?>|<?php echo $TPL_V2["opt2"]?><?php }?>" <?php if($TPL_VAR["usestock"]&&!$TPL_V2["stock"]){?> disabled class=disabled<?php }?>> <?php if($TPL_VAR["usestock"]&&!$TPL_V2["stock"]){?>[품절]<?php }?> <?php echo $TPL_V2["opt1"]?><?php if($TPL_V2["opt2"]){?>/<?php echo $TPL_V2["opt2"]?><?php }?> <?php if($TPL_V2["price"]!=$TPL_VAR["price"]){?>(<?php echo number_format($TPL_V2["price"])?>원)<?php }?></option> -->
								<option value="<?php echo $TPL_V2["opt1"]?><?php if($TPL_V2["opt2"]){?>|<?php echo $TPL_V2["opt2"]?><?php }?>" <?php if($TPL_VAR["usestock"]&&!$TPL_V2["stock"]){?> <?php }?>><?php echo $TPL_V2["opt1"]?><?php if($TPL_V2["opt2"]){?>/<?php echo $TPL_V2["opt2"]?><?php }?><?php if($TPL_V2["stock"]){?> (재고 <?php echo $TPL_V2["stock"]?>개)<?php }?><?php if($TPL_V2["price"]!=$TPL_VAR["price"]){?>(<?php echo number_format($TPL_V2["price"])?>원)<?php }?>
<?php if($TPL_VAR["usestock"]&&!$TPL_V2["stock"]){?> [해외주문]<?php }?>
<?php }}?><?php }}?>
							</select>
						</div>
					</div>
<?php }?>

<?php if($GLOBALS["opt"]&&$GLOBALS["typeOption"]=="double"){?>
<?php if($TPL__optnm_1){$TPL_I1=-1;foreach($GLOBALS["optnm"] as $TPL_V1){$TPL_I1++;?>
					<div class="buy-info-item">
						<div class="buy-info-title"><?php echo $TPL_V1?></div>
						<!-- 옵션 선택 -->
						<div class="buy-info-contents">
<?php if(!$TPL_I1){?>
							<select name="opt[]" onchange="subOption(this);" required fld_esssential msgR="<?php echo $TPL_V1?> 선택을 해주세요">
							<option value="">옵션선택</option>
<?php if((is_array($TPL_R2=($GLOBALS["opt"]))&&!empty($TPL_R2)) || (is_object($TPL_R2) && in_array("Countable", class_implements($TPL_R2)) && $TPL_R2->count() > 0)) {foreach($TPL_R2 as $TPL_K2=>$TPL_V2){?><option value="<?php echo $TPL_K2?>"><?php echo $TPL_K2?></option><?php }}?></select>
<?php }else{?>
							<select name="opt[]" onchange="chkOption(this);nsGodo_MultiOption.set();" required fld_esssential msgR="<?php echo $TPL_V1?> 선택을 해주세요"><option value="">선택사항</option></select>
<?php }?>
						</div>

						<input type="hidden" name="opt_txt[]" value="">

					</div>


<?php }}?>
				<script>subOption(document.getElementsByName('opt[]')[0])</script>
<?php }?>

<?php if(!$GLOBALS["opt"]){?><?php if(!$GLOBALS["addopt"]){?><?php if(!$GLOBALS["addopt_inputable"]){?>
<?php if($TPL_VAR["runout"]< 1||$TPL_VAR["usestock"]&&$TPL_VAR["totstock"]> 0){?>
					<div class="buy-info-item" id="none_option">
						<div class="buy-info-contents" style="float:left;">
							<div class="cnt_plus" onClick="javascript:orderCntCalc(1);"></div>
							<div class="cnt_minus" onClick="javascript:orderCntCalc(-1);"></div>
							<input type="number" data-price="<?php echo $TPL_VAR["price"]?>" id="ea" name="ea" size="5" value="<?php if($TPL_VAR["min_ea"]){?><?php echo $TPL_VAR["min_ea"]?><?php }else{?>1<?php }?>" step="<?php if($TPL_VAR["sales_unit"]){?><?php echo $TPL_VAR["sales_unit"]?><?php }else{?>1<?php }?>" min="<?php if($TPL_VAR["min_ea"]){?><?php echo $TPL_VAR["min_ea"]?><?php }else{?>1<?php }?>" max="<?php if($TPL_VAR["max_ea"]){?><?php echo $TPL_VAR["max_ea"]?><?php }else{?>0<?php }?>" onchange="orderCntCalc(this, this.value, true);"/>
						</div>
						<div class="buy-info-contents">
							원
						</div>
						<div class="buy-info-contents" name="order_price" id="order_price">
							<script type="text/javascript">
								var div = document.getElementById("order_price");
								var min_price = show_price(<?php echo $TPL_VAR["price"]?>, <?php echo $TPL_VAR["min_ea"]?>);
								var order_price = comma(min_price);
								div.textContent = order_price;
							</script>
						</div>
					</div>
<?php }?><?php }?><?php }?><?php }?>

				<!-- 추가 옵션 -->
<?php if($GLOBALS["addopt"]){?>
<?php if($TPL__addopt_1){$TPL_I1=-1;foreach($GLOBALS["addopt"] as $TPL_K1=>$TPL_V1){$TPL_I1++;?>
				<div class="buy-info-item">
					<div class="buy-info-title"><?php echo $TPL_K1?><?php if($GLOBALS["addoptreq"][$TPL_I1]=='o'){?>(필수)<?php }?></div>
					<div class="buy-info-contents">
<?php if($GLOBALS["addoptreq"][$TPL_I1]){?>
							<select name="addopt[]" required fld_esssential label="<?php echo $TPL_K1?>" onchange="nsGodo_MultiOption.set();">
							<option value="">==<?php echo $TPL_K1?> 선택==
<?php }else{?>
							<select name="addopt[]" label="<?php echo $TPL_K1?>" onchange="nsGodo_MultiOption.set();">
							<option value="">==<?php echo $TPL_K1?> 선택==
							<option value="-1">선택안함
<?php }?>
<?php if((is_array($TPL_R2=$TPL_V1)&&!empty($TPL_R2)) || (is_object($TPL_R2) && in_array("Countable", class_implements($TPL_R2)) && $TPL_R2->count() > 0)) {foreach($TPL_R2 as $TPL_V2){?>
						<option value="<?php echo $TPL_V2["sno"]?>^<?php echo $TPL_K1?>^<?php echo $TPL_V2["opt"]?>^<?php echo $TPL_V2["addprice"]?>"><?php echo $TPL_V2["opt"]?>

<?php if($TPL_V2["addprice"]){?>(<?php echo number_format($TPL_V2["addprice"])?>원 추가)<?php }?>
<?php }}?>
						</select>
					</div>
				</div>
<?php }}?>
<?php }?>

				<!-- 입력 옵션 -->
<?php if($GLOBALS["addopt_inputable"]){?><?php if($TPL__addopt_inputable_1){$TPL_I1=-1;foreach($GLOBALS["addopt_inputable"] as $TPL_K1=>$TPL_V1){$TPL_I1++;?>
					<div class="buy-info-item">
						<div class="buy-info-title"><?php echo $TPL_K1?><?php if($GLOBALS["addopt_inputable_req"][$TPL_I1]=='o'){?>(필수)<?php }?></div>
						<div class="buy-info-contents">
							<input type="hidden" name="_addopt_inputable[]" value="">
							<input type="text" name="addopt_inputable[]" label="<?php echo $TPL_K1?>" option-value="<?php echo $TPL_V1["sno"]?>^<?php echo $TPL_K1?>^<?php echo $TPL_V1["opt"]?>^<?php echo $TPL_V1["addprice"]?>" value="" <?php if($GLOBALS["addopt_inputable_req"][$TPL_I1]){?>required fld_esssential<?php }?> maxlength="<?php echo $TPL_V1["opt"]?>" class="inputable-addoption">
						</div>
					</div>
<?php }}?><?php }?>

<?php if($TPL_VAR["min_ea"]||$TPL_VAR["max_ea"]||$TPL_VAR["sales_unit"]){?>
					<div class="buy-info-item" style="height:auto; !important;">
						<div style="clear:both;text-align:right;">
<?php if($TPL_VAR["min_ea"]> 1){?><p>최소구매수량 : <?php echo $TPL_VAR["min_ea"]?>개</p><?php }?>
<?php if($TPL_VAR["max_ea"]){?><p>최대구매수량 : <?php echo $TPL_VAR["max_ea"]?>개</p><?php }?>
<?php if($TPL_VAR["sales_unit"]> 1){?><p>묶음주문단위 : <?php echo $TPL_VAR["sales_unit"]?>개</p><?php }?>
						</div>
					</div>
<?php }?>

				<!-- 입력 옵션 -->
<?php if($GLOBALS["addopt_inputable"]){?><?php if($TPL__addopt_inputable_1){foreach($GLOBALS["addopt_inputable"] as $TPL_V1){?>
					<div class="add-option-area">
						<div class="btn-add-option" id="input_option_btn" onClick="nsGodo_MultiOption.set_input();">입력한 옵션으로 선택</div>
					</div>
<?php }}?><?php }?>

			</div>
<?php }?>

		<div id="el-multi-option-display" class="goods-multi-option">
			<table width="100%"border="0" cellpadding="0" cellspacing="0">
			<col>
			</table>

			<div style="font-size:12px;text-align:right;padding:10px 20px 10px 0;border-bottom:1px solid #D3D3D3;margin-bottom:5px;">
				총 금액 : <span style="color:#E70103;font-weight:bold;" id="el-multi-option-total-price"></span>
			</div>
		</div>
<?php if($TPL_VAR["clevel"]=='0'||$TPL_VAR["slevel"]>=$TPL_VAR["clevel"]){?>
		<div class="btn-area">
<?php if($TPL_VAR["runout"]> 0||$TPL_VAR["usestock"]&&$TPL_VAR["totstock"]< 1){?>
				<div class="btn-soldout" onClick="javascript:;">SOLD OUT</div>
<?php }else{?>
<?php if($TPL_VAR["goodsBuyable"]===true){?>
					<div class="btn-buy" onClick="javascript:indbAction2('goodsorder-hide');">바로구매</div>
					<div class="btn-cart" onClick="javascript:indbAction2('goodscart-hide');">장바구니</div>
					<div class="btn-wish" onClick="javascript:indbAction2('goodswish-hide');">찜하기</div>
<?php }else{?>
					<div class="btn-buy" onClick="javascript:buyableMember('<?php echo $TPL_VAR["goodsBuyable"]?>');">바로구매</div>
					<div class="btn-cart" onClick="javascript:buyableMember('<?php echo $TPL_VAR["goodsBuyable"]?>');">장바구니</div>
					<div class="btn-wish" onClick="javascript:buyableMember('<?php echo $TPL_VAR["goodsBuyable"]?>');">찜하기</div>
<?php }?>
<?php }?>
		</div>
<?php }?>
		</form>
		<!-- 네이버 체크아웃, 옥션 아이페이 등 -->
		<div class="other-settle-area">
			<?php echo $TPL_VAR["Payco"]?>

		</div>

		<div class="other-settle-area">
			<?php echo $TPL_VAR["naverCheckout"]?>

		</div>

		<div class="detail-view-area">
			<div class="btn-detail" onClick="javascript:location.href='/'+mobile_root+'/goods/view_detail.php?goodsno=<?php echo $TPL_VAR["goodsno"]?>';">상세정보 보기</div>
		</div>
		</div>
		<div class="goods-info-area">
			<div class="tab-area">
				<div class="tab-basic active-tab" onclick="javascript:changeTab('basic');">기본정보<div class="bar-area active-bar"></div></div>
				<div class="tab-review" onclick="javascript:changeTab('review');">상품평 <?php if($TPL_VAR["review_cnt"]> 0){?>(<?php echo $TPL_VAR["review_cnt"]?>)<?php }?><div class="bar-area"></div></div>
				<div class="tab-qna" onclick="javascript:changeTab('qna');">상품문의 <?php if($TPL_VAR["qna_cnt"]> 0){?>(<?php echo $TPL_VAR["qna_cnt"]?>)<?php }?></div>
			</div>
			<div class="content-area">
				<!-- 상품 기본정보 시작 -->
				<div class="content-basic">
<?php if($TPL_VAR["clevel"]=='0'||$TPL_VAR["slevel"]>=$TPL_VAR["clevel"]||($TPL_VAR["slevel"]<$TPL_VAR["clevel"]&&$TPL_VAR["auth_step"][ 2]=='Y')){?>
<?php if($TPL_VAR["strprice"]){?>
						<div class="content-item">
							<div class="content-title">판매가격</div>
							<div class="content-content red"><?php echo $TPL_VAR["strprice"]?></div>
						</div>
<?php }else{?>
							<div class="content-item">
								<div class="content-title">판매가격</div>
								<div class="content-content red"><?php echo number_format($TPL_VAR["price"])?>원</div>
							</div>
<?php if($TPL_VAR["consumer"]){?>
							<div class="content-item">
								<div class="content-title">소비자가격</div>
								<div class="content-content red"><?php echo number_format($TPL_VAR["consumer"])?>원</div>
							</div>
<?php }?>
<?php if($TPL_VAR["discount_mobile"]){?>
							<div class="content-item">
								<div class="content-title">모바일할인</div>
								<div class="content-content blue"><?php echo $TPL_VAR["discount_mobile"]?></div>
							</div>
<?php }?>
<?php if($TPL_VAR["special_discount_amount"]){?>
							<div class="content-item">
								<div class="content-title">상품할인금액</div>
								<div class="content-content blue">- <?php echo number_format($TPL_VAR["special_discount_amount"])?>원</div>
							</div>
<?php }?>

<?php if($TPL_VAR["realprice"]){?>
							<div class="content-item">
								<div class="content-title">회원할인가격</div>
								<div class="content-content blue"><?php echo number_format($TPL_VAR["realprice"])?>원</div>
							</div>
<?php }?>
<?php if($TPL_VAR["reserve"]){?>
							<div class="content-item">
								<div class="content-title">배송기간</div>
								<div class="content-content blue">평균 <?php echo number_format($TPL_VAR["reserve"])?>영업일 소요</div>
							</div>
<?php }?>
<?php if($TPL_VAR["naverNcash"]=='Y'){?>
							<div class="content-item">
								<div class="content-title">네이버마일리지</div>
								<div class="content-content blue"><?php if($TPL_VAR["exception"]){?><?php echo $TPL_VAR["exception"]?><?php }else{?><?php if($TPL_VAR["N_ba"]){?><span id="naver-mileage-base-accum-rate" style="font-weight:bold;color:#1ec228;"><?php echo $TPL_VAR["N_ba"]?>%</span><?php }?><span id="naver-mileage-add-accum-rate" style="font-weight:bold;color:#1ec228;"></span> 적립<?php }?>&nbsp;<img src="/shop/data/skin_mobileV2/light/img/nmileage/n_mileage_info2.gif" onclick="javascript:mileage_info();" style="cursor: pointer; vertical-align: middle;"></div>
							</div>
<?php }?>
<?php if($TPL_VAR["coupon"]){?>
							<div class="content-item">
								<div class="content-title">쿠폰적용가격</div>
								<div class="content-content red"><?php echo number_format($TPL_VAR["couponprice"])?>원</div>
							</div>
<?php }?>
<?php if($TPL_VAR["coupon_emoney"]){?>
							<div class="content-item">
								<div class="content-title">쿠폰적립금</div>
								<div class="content-content blue"><?php echo number_format($TPL_VAR["coupon_emoney"])?>원</div>
							</div>
<?php }?>

<?php if($TPL_VAR["delivery_type"]== 1){?>
							<div class="content-item">
								<div class="content-title">배송비</div>
								<div class="content-content">무료배송</div>
							</div>
<?php }elseif($TPL_VAR["delivery_type"]== 2){?>
							<div class="content-item">
								<div class="content-title">개별배송비</div>
								<div class="content-content"><?php echo number_format($TPL_VAR["goods_delivery"])?>원</div>
							</div>
<?php }elseif($TPL_VAR["delivery_type"]== 3){?>
							<div class="content-item">
								<div class="content-title">착불배송비</div>
								<div class="content-content"><?php echo number_format($TPL_VAR["goods_delivery"])?>원</div>
							</div>
<?php }elseif($TPL_VAR["delivery_type"]== 4){?>
							<div class="content-item">
								<div class="content-title">고정배송비</div>
								<div class="content-content"><?php echo number_format($TPL_VAR["goods_delivery"])?>원</div>
							</div>
<?php }elseif($TPL_VAR["delivery_type"]== 5){?>
							<div class="content-item">
								<div class="content-title">수량별배송비</div>
								<div class="content-content"><?php echo number_format($TPL_VAR["goods_delivery"])?>원 (수량에따라 배송비 추가)</div>
							</div>
<?php }?>
<?php }?>
<?php }?>
<?php if($TPL_VAR["goodscd"]){?>
					<div class="content-item">
						<div class="content-title">제품코드</div>
						<div class="content-content"><?php echo $TPL_VAR["goodscd"]?></div>
					</div>
<?php }?>
<?php if($TPL_VAR["origin"]){?>
					<div class="content-item">
						<div class="content-title">원산지</div>
						<div class="content-content"><?php echo $TPL_VAR["origin"]?></div>
					</div>
<?php }?>
<?php if($TPL_VAR["maker"]){?>
					<div class="content-item">
						<div class="content-title">제조사</div>
						<div class="content-content"><?php echo $TPL_VAR["maker"]?></div>
					</div>
<?php }?>
<?php if($TPL_VAR["brand"]){?>
					<div class="content-item">
						<div class="content-title">브랜드</div>
						<div class="content-content"><?php echo $TPL_VAR["brand"]?> <a href="../goods/brand.php?brand=<?php echo $TPL_VAR["brandno"]?>">[브랜드바로가기]</a></div>
					</div>
<?php }?>
<?php if($TPL_VAR["launchdt"]){?>
					<div class="content-item">
						<div class="content-title">출시일</div>
						<div class="content-content"><?php echo $TPL_VAR["launchdt"]?></div>
					</div>
<?php }?>
<?php if($TPL_ex_1){foreach($TPL_VAR["ex"] as $TPL_K1=>$TPL_V1){?>
					<div class="content-item">
						<div class="content-title"><?php echo $TPL_K1?></div>
						<div class="content-content"><?php echo $TPL_V1?></div>
					</div>
<?php }}?>
<?php if(commoninfo()){?>
					<div class="commoninfo-area">
						<div class="commoninfo-wrap">
<?php if((is_array($TPL_R1=commoninfo())&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?>
							<div class="commoninfo-title" id="commoninfo-title-<?php echo $TPL_V1["idx"]?>" onClick="javascript:showCommonInfo('<?php echo $TPL_V1["idx"]?>');">
								<?php echo $TPL_V1["title"]?><div class="down_arrow"></div>
							</div>
							<div class="commoninfo-content" id="commoninfo-content-<?php echo $TPL_V1["idx"]?>">
								<?php echo $TPL_V1["info"]?>

							</div>
<?php }}?>
						</div>
					</div>
<?php }?>

				</div>
				<!-- 상품 기본정보 끝 -->
				<!-- 상품 후기 시작 -->
				<div class="content-review" style="display:none;">
<?php if($TPL_VAR["review_cnt"]){?>
					<div class="review-title"><div class="title"><span class="title_cnt">총 <?php echo $TPL_VAR["review_cnt"]?>개</span>의 상품평</div><a href="../myp/review_register.php?mode=add_review&goodsno=<?php echo $TPL_VAR["goodsno"]?>"><div class="write-btn">상품평쓰기</div></a></div>
					<div class="review-list">
						<div class="review-item">
<?php if($TPL_review_loop_1){foreach($TPL_VAR["review_loop"] as $TPL_V1){
if (is_array($TPL_V1["reply"])) $TPL_reply_2=count($TPL_V1["reply"]); else if (is_object($TPL_V1["reply"]) && in_array("Countable", class_implements($TPL_V1["reply"]))) $TPL_reply_2=$TPL_V1["reply"]->count();else $TPL_reply_2=0;?>
							<div class="review-item-title" onClick="javascript:showReviewContent('<?php echo $TPL_V1["sno"]?>');">
								<div class="review-item-subject"><?php echo $TPL_V1["subject"]?></div>
								<div class="review-item-id"><?php echo $TPL_V1["review_name"]?> | <?php echo $TPL_V1["regdt"]?><div class="review-item-star"><?php echo $TPL_V1["point_star"]?></div></div>
							</div>
							<div class="review-item-content" id="review-item-content-<?php echo $TPL_V1["sno"]?>">
								<div class="review-item-content-review">
									<div class="review-item-content-review">
										<?php echo $TPL_V1["contents"]?>

<?php if($TPL_V1["image"]){?>
										<div>
										<?php echo $TPL_V1["image"]?>

										</div>
<?php }?>
<?php if($TPL_V1["authdelete"]=='Y'){?>
										<a href="javascript:" onclick="delete_qnaReview( 'del_review', '<?php echo $TPL_V1["m_no"]?>', '<?php echo $TPL_V1["sno"]?>');"><div class="del-btn">삭 제</div></a>
										<div style="clear:both;"></div>
<?php }?>
									</div>
								</div>
<?php if($TPL_reply_2){foreach($TPL_V1["reply"] as $TPL_V2){?>
								<div class="review-item-content-reply">
									<div class="reply-icon"></div><?php echo $TPL_V2["contents"]?>

<?php if($TPL_V2["authdelete"]=='Y'){?>
									<a href="javascript:" onclick="delete_qnaReview( 'del_review', '<?php echo $TPL_V2["m_no"]?>', '<?php echo $TPL_V2["sno"]?>');"><div class="del-btn">삭 제</div></a>
									<div style="clear:both;"></div>
<?php }?>
								</div>
<?php }}?>
							</div>
<?php }}?>
						</div>
<?php if($TPL_VAR["review_cnt"]> 10){?>
						<div class="review-more-btn" onClick="document.location.href='../myp/review.php?goodsno=<?php echo $TPL_VAR["goodsno"]?>';">더보기</div>
<?php }?>

<?php }else{?>
					<div class="review-title"><div class="title">상품평이 없습니다</div><a href="../myp/review_register.php?mode=add_review&goodsno=<?php echo $TPL_VAR["goodsno"]?>"><div class="write-btn">상품평쓰기</div></a></div>
					<div class="review-list">
<?php }?>
					</div>
				</div>
				<!-- 상품 후기 끝 -->
				<!-- 상품 문의 시작 -->
				<div class="content-qna" style="display:none;">
<?php if($TPL_VAR["qna_cnt"]){?>
					<div class="qna-title"><div class="title"><span class="title_cnt">총 <?php echo $TPL_VAR["qna_cnt"]?>개</span>의 상품문의</div><a href="../goods/goods_qna_register.php?mode=add_qna&goodsno=<?php echo $TPL_VAR["goodsno"]?>"><div class="write-btn">문의하기</div></a></div>
					<div class="qna-list">
						<div class="qna-item">
<?php if($TPL_qna_loop_1){foreach($TPL_VAR["qna_loop"] as $TPL_V1){
if (is_array($TPL_V1["reply"])) $TPL_reply_2=count($TPL_V1["reply"]); else if (is_object($TPL_V1["reply"]) && in_array("Countable", class_implements($TPL_V1["reply"]))) $TPL_reply_2=$TPL_V1["reply"]->count();else $TPL_reply_2=0;?>
							<div class="qna-item-title" onClick="javascript:showQnaContent('<?php echo $TPL_V1["sno"]?>');">
								<div class="qna-item-subject"><?php echo $TPL_V1["subject"]?></div>
								<div class="qna-item-id"><?php echo $TPL_V1["qna_name"]?> | <?php echo $TPL_V1["regdt"]?>

<?php if($TPL_V1["reply_cnt"]> 0){?>
								<div class="answer-y"></div>
<?php }else{?>
								<div class="answer-n"></div>
<?php }?>
								</div>

							</div>
							<div class="qna-item-content"  id="qna-item-content-<?php echo $TPL_V1["sno"]?>">

<?php if($TPL_V1["accessable"]){?>
								<div class="qna-item-content-question">
									<div class="question-icon"></div><?php echo $TPL_V1["contents"]?>

<?php if($TPL_V1["authdelete"]=='Y'){?>
										<a href="javascript:;" onclick="delete_qnaReview( 'del_qna', '<?php echo $TPL_V1["m_no"]?>', '<?php echo $TPL_V1["sno"]?>');"><div class="del-btn">삭 제</div></a>
										<div style="clear:both;"></div>
<?php }?>
								</div>
<?php if($TPL_reply_2){foreach($TPL_V1["reply"] as $TPL_V2){?>
								<div class="qna-item-content-answer">
									<div class="answer-icon"></div><?php echo $TPL_V2["contents"]?>

<?php if($TPL_V2["authdelete"]=='Y'){?>
										<a href="javascript:;" onclick="delete_qnaReview( 'del_qna', '<?php echo $TPL_V2["m_no"]?>', '<?php echo $TPL_V2["sno"]?>');"><div class="del-btn">삭 제</div></a>
										<div style="clear:both;"></div>
<?php }?>
								</div>
<?php }}?>
<?php }else{?>
								<div class="qna-item-content-question">
<?php if($TPL_V1["m_no"]> 0){?>
									비밀글 입니다.
<?php }else{?>
									비밀번호 :
									<input type="password" id="goods-qna-password-<?php echo $TPL_V1["sno"]?>" name="password" required="required"/>
									<button type="button" data-sno="<?php echo $TPL_V1["sno"]?>"  class="goods-qna-certification">확인</button>
<?php }?>
								</div>
<?php }?>


							</div>
<?php }}?>
						</div>
<?php if($TPL_VAR["qna_cnt"]> 10){?>
						<div class="qna-more-btn" onClick="document.location.href='../goods/goods_qna_list.php?goodsno=<?php echo $TPL_VAR["goodsno"]?>';">더보기</div>
<?php }?>
					</div>
<?php }else{?>
					<div class="qna-title"><div class="title">상품문의가 없습니다</div><a href="../goods/goods_qna_register.php?mode=add_qna&goodsno=<?php echo $TPL_VAR["goodsno"]?>"><div class="write-btn">문의하기</div></a></div>
					<div class="qna-list">
<?php }?>
				</div>
				<!-- 상품 문의 끝 -->
			</div>
		</div>

		<!-- 관련상품 시작 -->
		<div class="tab-relative">관련상품</div>
		<div id="relativegoods">
			<div class="inner-wrapper">
<?php if((is_array($TPL_R1=dataGoodsRelation($TPL_VAR["goodsno"],$GLOBALS["cfg_related"]["max"]))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?>
				<div class="goods-item" style="margin-right:15px;">
<?php if($GLOBALS["cfg_related"]["dp_image"]){?>
					<div class="goods-img">
						<a href="view.php?goodsno=<?php echo $TPL_V1["goodsno"]?>"<?php if($GLOBALS["cfg_related"]["link_type"]=='blank'){?> target="_blank"<?php }?>><?php echo goodsimgMobile($TPL_V1["img_x"],$GLOBALS["cfg_related"]["size"])?></a>
<?php if($TPL_V1["tts_url"]){?>
						<div class="goods-speach-description" style="display:none;">
							<span class="speach-description-play" data-src="<?php echo $TPL_V1["tts_url"]?>">재생</span>
							<span class="speach-description-timer"></span>
						</div>
<?php }?>
					</div>
<?php }?>
<?php if($GLOBALS["cfg_related"]["dp_goodsnm"]){?>
					<div class="goods-nm"><a href="view.php?goodsno=<?php echo $TPL_V1["goodsno"]?>"><?php echo $TPL_V1["goods_prefix"]?><?php echo $TPL_V1["goodsnm"]?></a></div>
<?php }?>
<?php if($GLOBALS["cfg_related"]["dp_price"]){?>
<?php if(!$TPL_V1["strprice"]){?>
<?php if($TPL_V1["consumer"]){?>
					<div class="goods-consumer" style="display: none;"><strike><?php echo number_format($TPL_V1["consumer"])?>원</strike>↓</div>
<?php }?>
<?php }?>
<?php if($TPL_V1["strprice"]){?>
					<div class="goods-price"><a href="<?php echo $TPL_VAR["goods_src"]?>&goodsno=<?php echo $TPL_V1["goodsno"]?>"><?php echo $TPL_V1["strprice"]?></a></div>
<?php }elseif($TPL_V1["price"]){?>
					<div class="goods-price"><a href="<?php echo $TPL_VAR["goods_src"]?>&amp;goodsno=<?php echo $TPL_V1["goodsno"]?>"><span class="red"><?php echo number_format($TPL_V1["price"])?>원</span></a></div>
<?php }?>
<?php if($TPL_V1["special_discount"]){?>
					<div class="goods-discount" style="display: none;">(<?php echo number_format($TPL_V1["special_discount"])?>

<?php if(strstr('원',$TPL_V1["special_discount"])){?>원<?php }?>
<?php if(strstr('%',$TPL_V1["special_discount"])){?>%<?php }?>
					 할인)</div>
<?php }?>
<?php if($TPL_V1["coupon"]){?>
					<div class="goods-coupon-price" style="display: none;"><?php echo number_format($TPL_V1["coupon"])?>원 <div class="goods-coupon-icon"></div></div>
<?php }?>
<?php }?>
<?php if($GLOBALS["cfg_related"]["use_cart"]){?>
<?php }?>
<?php if($TPL_V1["icon"]){?><?php }?>
				</div>
<?php }}?>
			</div>
		</div>
		<!-- 관련상품 끝 -->

<?php if($TPL_VAR["coupon"]||$TPL_VAR["coupon_emoney"]){?>
		<div class="couponlist-area">
			<div class="couponlist-title">
				<div class="title">다운로드 쿠폰 List <?php if($TPL_VAR["coupon_cnt"]> 0){?><span class="titl_cnt">(<?php echo $TPL_VAR["coupon_cnt"]?>)<?php }?></span> </div>
				<div class="close-btn" onClick="javascript:closeCouponList();"></div>
			</div>
			<div class="couponlist-item-area">
				<div id="scroll-area">
				<ul>
<?php if($TPL_a_coupon_1){foreach($TPL_VAR["a_coupon"] as $TPL_V1){?>
				<li>
				<div class="couponlist-item">
					<div class="couponlist-item-name">
						<div class="couponInfoOnlyBtn">
<?php if($TPL_V1["c_screen"]=='m'){?><div class="onlyMobileCouponBtn">모바일전용</div><?php }?>
<?php if($TPL_V1["payMethod"]== 1){?><div class="onlyBankBookCouponBtn">무통장전용</div><?php }?>
						</div>
						<div class="couponInfoOnlyName"><?php echo $TPL_V1["coupon"]?></div>
					</div>
					<a href="<?php echo $GLOBALS["cfg"]["rootDir"]?>/proc/dn_coupon_goods.php?goodsno=<?php echo $TPL_VAR["goodsno"]?>&couponcd=<?php echo $TPL_V1["couponcd"]?>'" target="ifrmHidden"><div class="download-btn">쿠폰받기</div></a>
				</div>
				</li>
<?php }}?>
				</ul>
				</div>
			</div>
		</div>
<?php }?>
		<div id="background"></div>
	</div>
</section>


<?php $this->print_("footer",$TPL_SCP,1);?>