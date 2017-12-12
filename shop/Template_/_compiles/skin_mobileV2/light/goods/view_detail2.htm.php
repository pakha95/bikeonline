<?php /* Template_ 2.2.7 2015/10/18 22:21:54 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/goods/view_detail2.htm 000012624 */ 
if (is_array($TPL_VAR["extra_info"])) $TPL_extra_info_1=count($TPL_VAR["extra_info"]); else if (is_object($TPL_VAR["extra_info"]) && in_array("Countable", class_implements($TPL_VAR["extra_info"]))) $TPL_extra_info_1=$TPL_VAR["extra_info"]->count();else $TPL_extra_info_1=0;?>
<?php $this->print_("header",$TPL_SCP,1);?>


<?php $this->print_("sub_header",$TPL_SCP,1);?>


<script type="text/javascript">
var strprice = "<?php echo $TPL_VAR["strprice"]?>";

$(document).ready(function(){
	$("[id=goodsorder-hide]").css("height", $("[id=goodsorder-hide]").height()+30);
	$("[id=goodscart-hide]").css("height", $("[id=goodscart-hide]").height()+30);
	$("[id=goodswish-hide]").css("height", $("[id=goodswish-hide]").height()+30);
	$("#goodsorder-hide").css("position", "absolute");
	$("#goodscart-hide").css("position", "absolute");
	$("#goodswish-hide").css("position", "absolute");

	$("meta[name=viewport]").attr("content", "user-scalable=yes, initial-scale=1.0, maximum-scale=10.0, minimum-scale=1.0, width=device-width, height=device-height");
});
function popOpt(btn_nm) {
	if (strprice.length > 0) {
		$("[id=goodsres-hide] .text_msg").text("가격대체문구 상품입니다");
		$("[id=goodsres-hide]").fadeIn(300);
		setTimeout( function() {
			$("[id=goodsres-hide]").fadeOut(300);
		}, 1000);
		return;
	}
	var opt_visiable = false;

	if($("[id=goods"+btn_nm+"-hide]").is(':hidden') == false) {
		opt_visiable = true;
	}

	$("[id$=hide]").fadeOut(300);

	if(!opt_visiable) $("[id=goods"+btn_nm+"-hide]").fadeIn(300).css("top", ($(window).scrollTop()+10)+"px");
}

function buyableMember(buyable)
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

function showResMsg(obj) {

	var sec = 0;

	if(obj.sec == null || obj.sec == "undefined") {
		sec = 1000;
	}
	else {
		sec = obj.sec;
	}

	$("[id=goodsres-hide] .text_msg").text(obj.msg);
	$("[id=goodsres-hide]").fadeIn(300);

	setTimeout( function() {
		$("[id=goodsres-hide]").fadeOut(300);

		if(obj.url && obj.url != "undefined") {
			document.location.href = obj.url;
		}

	}, sec);
}

$(function() {
	var msg = "<?php echo $TPL_VAR["msg_kakao2"]?>";
	var url = "<?php echo $TPL_VAR["msg_kakao3"]?>";
	var appname = "<?php echo $TPL_VAR["msg_kakao1"]?>";
	var link = new com.kakao.talk.KakaoLink("<?php echo $GLOBALS["_SERVER"]['HTTP_HOST']?>", "1.0", url, msg, appname);

	$("#kakao").click(function() {// button click event
		link.execute();
	});
});
/*
$(document).ready(function(){
	var msg_obj = {};
	msg_obj.msg = '스크롤을 내려주세요';
	msg_obj.sec = 2000;
	showResMsg(msg_obj);
});
*/
</script>
<?php if($TPL_VAR["QuickMenuEnabled"]){?>
<?php $this->print_("QuickMenuScript",$TPL_SCP,1);?>

<?php }?>
<style type="text/css">
.goods_price2 {height:20px;line-height:20px;text-align:right;}
.goods_dc {height:20px;line-height:20px;text-align:right;color:#88eeff;}

section#goodsdetail2 {background:#FFFFFF;}
section#goodsdetail2 .top_title{position:relative;clear:both; height:36px; line-height:36px; background:#f9f9f9; color:#222222; font-size:14px; font-weight:bold; text-align:center; font-family:dotum; border-bottom:solid 1px #969ca3; padding-left:10px;  white-space: nowrap;overflow: hidden;}
section#goodsdetail2 .top_title .back_btn{float:left; background:url('/shop/data/skin_mobileV2/light/common/img/new/btn_back.png') no-repeat; background-size:38px 27px; width:38px; height:27px; margin-top:5px; position:absolute;}

section#goodsdetail2 .desc-area .desc-area-info{height:40px; text-align:center; font-size:12px; color:#353535; line-height:40px;}

html {overflow-y: visible;}
#goods-desc-quick-menu {position: fixed; right: 0; bottom: 10px; z-index: 1000;}
#goods-desc-quick-menu.hide {position: static; display: none;}
#goods-desc-quick-menu .toggle-button {width: 50px; height: 49px; font-size: 0; border: none; background: url("/shop/data/skin_mobileV2/light/common/img/goods/btn_detail_out.png") transparent; background-size: 100% 100%; float: right; margin-right: 15px;}
#goods-desc-quick-menu .toggle-button.active {background-image: url("/shop/data/skin_mobileV2/light/common/img/goods/btn_detail_over.png");}
#goods-desc-quick-menu .navigation {position: absolute; right: 10px; bottom: 52px; display: none;}
#goods-desc-quick-menu .navigation a {display: block; margin: 0; width: 79px; padding-left: 36px;}
#goods-desc-quick-menu .navigation a.goods-qna { height: 39px; line-height: 39px; background: url("/shop/data/skin_mobileV2/light/common/img/goods/btn_quick_01.png") transparent; background-size: 100% 100%; color: #ffffff;}
#goods-desc-quick-menu .navigation a.goods-review {height: 39px; line-height: 39px; background: url("/shop/data/skin_mobileV2/light/common/img/goods/btn_quick_02.png") transparent; background-size: 100% 100%; color: #ffffff;}
#goods-desc-quick-menu .navigation a.purchase {height: 39px; line-height: 39px; background: url("/shop/data/skin_mobileV2/light/common/img/goods/btn_quick_03.png") transparent; background-size: 100% 100%; color: #ff3333;}
#goods-desc-quick-menu .navigation a.move-top {height: 41px; line-height: 38px; background: url("/shop/data/skin_mobileV2/light/common/img/goods/btn_quick_04.png") transparent; background-size: 100% 100%; color: #ffffff;}
#goods-order-layer {position : absolute; left : 2%; width : 96%; background : #ffffff; display : block; border-radius:1em; box-shadow:2px 2px 4px #7f7f7f; z-index: 999;}
.goods_order_title {background:#313030; width:100%; border-top-left-radius:1em; border-top-right-radius:1em; height:45px; border-bottom:solid 1px #b2b2b2; margin-bottom:6px;}
.goods_order_title .title {padding-left:14px; line-height:45px; font-size:16px; font-weight:bold; color:#FFFFFF; font-family:dotum; float:left;}
.goods_order_title #cancel-goods-btn {float:right; background:url("/shop/data/skin_mobileV2/light/common/img/nmyp/btn_close_off.png") no-repeat; border:none; width:31px; height:32px; margin-top:7px; margin-right:7px;}
.goods_order_title #cancel-goods-btn:active {background:url("/shop/data/skin_mobileV2/light/common/img/nmyp/btn_close_on.png") no-repeat;}
.goods_order_btn {margin-top:16px; margin-bottom:25px; text-align:center;}
#checkout-button-area {width: 100%; height:0px;}
#background {position: absolute; left : 0; top : 0; width : 100%; height : 100%; background : #000000; display : none; z-index: 998;}
.origin-goods-order-layer-item { padding-left:14px; padding-right:18px; height:26px; padding-top:4px;}
.origin-goods-order-layer-item .title{ font-size:12px; line-height:26px; height:26px; width:38%; font-family:dotum; display:block; float:left; text-align:left;}
.origin-goods-order-layer-item .content{ font-size:12px; line-height:26px; height:26px; width:62%; font-family:dotum; display:block; float:right; text-align:right;}
.origin-goods-order-layer-item .content select{ height:26px; width:100%;}
.cnt_minus_btn {background:url("/shop/data/skin_mobileV2/light/common/img/new/btn_amount_.png") top left no-repeat; background-size:26px 26px; height:26px; width:26px; border:none; text-align:center; color:#ffffff; margin-left:3px;}
.cnt_plus_btn {background:url("/shop/data/skin_mobileV2/light/common/img/new/btn_amount_plus.png") top left no-repeat; background-size:26px 26px; height:26px; width:26px; border:none; text-align:center; color:#ffffff; margin-left:3px;}
#order-goods-btn {background:#f35151; height:30px; width:75px; border:none; text-align:center; font-size:13px; font-weight:bold; color:#ffffff; font-family:dotum; border-radius:3px;-webkit-appearance: none;}
#cart-goods-btn {background:#808591;  height:30px; width:75px; border:none; text-align:center; font-size:13px; font-weight:bold; color:#ffffff; font-family:dotum; border-radius:3px;-webkit-appearance: none;}
#wish-goods-btn {background:#808591;  height:30px; width:75px; border:none; text-align:center; font-size:13px; font-weight:bold; color:#ffffff; font-family:dotum; border-radius:3px;-webkit-appearance: none;}
#disable-order-goods-btn {background:#f35151; height:30px; width:75px; border:none; text-align:center; font-size:13px; font-weight:bold; color:#ffffff; font-family:dotum; border-radius:3px;-webkit-appearance: none;}
#disable-cart-goods-btn {background:#808591;  height:30px; width:75px; border:none; text-align:center; font-size:13px; font-weight:bold; color:#ffffff; font-family:dotum; border-radius:3px;-webkit-appearance: none;}
#disable-wish-goods-btn {background:#808591;  height:30px; width:75px; border:none; text-align:center; font-size:13px; font-weight:bold; color:#ffffff; font-family:dotum; border-radius:3px;-webkit-appearance: none;}
</style>

<section id="goodsdetail2" class="content">
	<div class="top_title">
		<div class="back_btn" onClick="javascript:history.go(-1);"></div>
		<div class="goods_nm">상품상세설명</div>
	</div>
	<div class="desc-area">
		<div class="desc-area-info">
			상품 상세설명을 확대하실 수 있습니다.
		</div>
		<?php echo $TPL_VAR["NaverMileageAccum"]?>

<?php if($TPL_VAR["mlongdesc"]){?><?php echo $TPL_VAR["mlongdesc"]?><?php }else{?><?php echo $TPL_VAR["longdesc"]?><?php }?>
<?php if($TPL_extra_info_1){?>
			<style>
			table.extra-information {background:#e0e0e0;margin:30px 0 60px 0;}
			table.extra-information th,
			table.extra-information td {font-weight:normal;text-align:left;padding-left:15px;background:#ffffff;font-family:Dotum;font-size:11px;height:28px;}

			table.extra-information th {width:15%;background:#f5f5f5;color:#515151;}
			table.extra-information td {width:35%;color:#666666;}

			</style>
			<table width=100% border=0 cellpadding=0 cellspacing=1 class="extra-information">
			<tr>
<?php if($TPL_extra_info_1){foreach($TPL_VAR["extra_info"] as $TPL_K1=>$TPL_V1){?>
				<th><?php echo $TPL_V1["title"]?></th>
				<td <?php if($TPL_V1["colspan"]> 1){?>colspan="<?php echo $TPL_V1["colspan"]?>"<?php }?>><?php echo $TPL_V1["desc"]?></td>
<?php if($TPL_V1["nkey"]&&(!$GLOBALS["extra_info"][$TPL_V1["nkey"]]||$TPL_K1% 2== 0)){?>
				</tr><tr>
<?php }?>
<?php }}?>
			</tr>
			</table>
<?php }?>
	</div>

</section>

<?php if($TPL_VAR["QuickMenuEnabled"]){?>
<div id="goods-desc-quick-menu">
	<a class="toggle-button">보기/닫기</a>
	<nav class="navigation">
		<a href="./view.php?goodsno=<?php echo $TPL_VAR["goodsno"]?>#goods-qna" class="goods-qna">상품문의(<?php echo $TPL_VAR["cnt_goods_qna"]?>)</a>
		<a href="./view.php?goodsno=<?php echo $TPL_VAR["goodsno"]?>#goods-review" class="goods-review">상품평(<?php echo $TPL_VAR["cnt_goods_review"]?>)</a>
		<a class="purchase">구매하기</a>
		<a href="#" class="move-top">맨위로</a>
	</nav>
</div>
<section id="goods-order-layer" style="display: none;">
	<div class="goods_order_title"><div class="title">옵션선택</div><input id="cancel-goods-btn" class="cancel-goods" type="button" value=""/></div>
	<form name="frmView" method="post" action="" onsubmit="return false;">
		<input type="hidden" name="mode" value=""/>
		<input type="hidden" name="goodsno" value=""/>
		<article class="option-select-item-list"></article>
		<div class="goods_order_btn">
<?php if($TPL_VAR["goodsBuyable"]===true){?>
				<input id="order-goods-btn" class="order-goods" type="button" value="구매하기"/>
				<input id="cart-goods-btn" class="cart-goods" type="button" value="장바구니"/>
				<input id="wish-goods-btn" class="wish-goods" type="button" value="찜하기"/>
<?php }else{?>
				<input id="disable-order-goods-btn" class="order-goods" type="button" onClick="javascript:buyableMember('<?php echo $TPL_VAR["goodsBuyable"]?>');" value="구매하기"/>
				<input id="disable-cart-goods-btn" class="cart-goods" type="button" onClick="javascript:buyableMember('<?php echo $TPL_VAR["goodsBuyable"]?>');" value="장바구니"/>
				<input id="disable-wish-goods-btn" class="wish-goods" type="button" onClick="javascript:buyableMember('<?php echo $TPL_VAR["goodsBuyable"]?>');" value="찜하기"/>
<?php }?>
		</div>
	</form>
	<?php echo $TPL_VAR["Payco"]?>

	<iframe id="checkout-button-area"></iframe>
</section>
<div id="background"></div>
<?php }?>


<?php $this->print_("footer",$TPL_SCP,1);?>