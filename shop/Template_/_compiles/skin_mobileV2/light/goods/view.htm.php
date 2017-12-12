<?php /* Template_ 2.2.7 2017/02/21 19:54:47 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/goods/view.htm 000025445 */ 
if (is_array($TPL_VAR["a_coupon"])) $TPL_a_coupon_1=count($TPL_VAR["a_coupon"]); else if (is_object($TPL_VAR["a_coupon"]) && in_array("Countable", class_implements($TPL_VAR["a_coupon"]))) $TPL_a_coupon_1=$TPL_VAR["a_coupon"]->count();else $TPL_a_coupon_1=0;
if (is_array($GLOBALS["opt"])) $TPL__opt_1=count($GLOBALS["opt"]); else if (is_object($GLOBALS["opt"]) && in_array("Countable", class_implements($GLOBALS["opt"]))) $TPL__opt_1=$GLOBALS["opt"]->count();else $TPL__opt_1=0;
if (is_array($GLOBALS["addopt"])) $TPL__addopt_1=count($GLOBALS["addopt"]); else if (is_object($GLOBALS["addopt"]) && in_array("Countable", class_implements($GLOBALS["addopt"]))) $TPL__addopt_1=$GLOBALS["addopt"]->count();else $TPL__addopt_1=0;
if (is_array($GLOBALS["addopt_inputable"])) $TPL__addopt_inputable_1=count($GLOBALS["addopt_inputable"]); else if (is_object($GLOBALS["addopt_inputable"]) && in_array("Countable", class_implements($GLOBALS["addopt_inputable"]))) $TPL__addopt_inputable_1=$GLOBALS["addopt_inputable"]->count();else $TPL__addopt_inputable_1=0;?>
<?php $this->print_("header",$TPL_SCP,1);?>


<?php $this->print_("sub_header",$TPL_SCP,1);?>

<script type="text/javascript">
var strprice = '<?php echo $TPL_VAR["strprice"]?>';

$(document).ready(function(){
	$("[id=goodsorder-hide]").css("height", $("[id=goodsorder-hide]").height()+30);
	$("[id=goodscart-hide]").css("height", $("[id=goodscart-hide]").height()+30);
	$("[id=goodswish-hide]").css("height", $("[id=goodswish-hide]").height()+30);
	$("#goodsorder-hide").css("position", "absolute");
	$("#goodscart-hide").css("position", "absolute");
	$("#goodswish-hide").css("position", "absolute");
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

function m2CheckForm(obj_id) {
	var $ea = $("form[name=frmView] [name=ea]");
	var $opt = $("form[name=frmView] [name='opt[]']");

	$opt.val($("#"+obj_id+" [name=goods_opt]").val());
	if($("#"+obj_id+" [name=goods_opt]>option").length > 1) {
		if($opt.val() == "" || $opt.val() == "undefined") {
			alert('선택사항을 선택해 주세요');
			$("#"+obj_id+" [name=goods_opt]").focus();
			return false;
		}
	}
	if(obj_id!="goodswish-hide") {
		$ea.val($("#"+obj_id+" [name=order_cnt]").val());
		if(isNaN($ea.val()) || $ea.val() < 1) {
			alert('수량은 숫자로 입력해 주세요');
			$("#"+obj_id+" [name=order_cnt]").focus();
			return false;
		}
	}

	// 추가옵션 체크  및 처리
	//------------------------------------------------------------------------------
	var $_add_opt_val = new Array();
	var check_add_opt = true;
	$("#"+obj_id+" [name=addopt[]]").each(function(index, Element) {
		if (Element.getAttribute("required")!= null ) {
			if (chkText(Element,Element.value,Element.getAttribute("msgR")) == false) {
				check_add_opt = false;
				return;
			}
		}
	});
	if (check_add_opt == false) return false;

	// Form 에 엘레먼트 추가하기
	if ($("#"+obj_id+" [name=addopt[]]").length > 0) {
		$("form [name=addopt[]]").remove();
		$addopt_new = $("#"+obj_id+" [name=addopt[]]").clone();
		$addopt_new.each( function(index, Element) {
			Element.value = $("#"+obj_id+" [name=addopt[]]").get(index).value;
		});
		$addopt_new.css("display", "none");
		$("form[name=frmView]").append($addopt_new);
	}
	//------------------------------------------------------------------------------

	// 입력옵션 체크 및 처리
	// 특정 블록내부 엘리먼트를 직접 체크 chkForm, chkText 함수 참조
	var check_add_opt = true;
	var v, tmp;
	$('#'+obj_id+' input[name="addopt_inputable[]"]').each(function(idx, el){
		el = $(el);

		if (el.attr('required') || el.attr('fld_esssential')) {
			if (chkText(el.get(0), el.val(), el.attr('msgR')) == false) {
				check_add_opt = false;
				return false;
			}
		}

		v = '';

		if (el.val()) {
			tmp = el.attr('option-value').split('^');
			tmp[2] = el.val();
			v = tmp.join('^');
		}

		$('#'+obj_id+' input[name="_addopt_inputable[]"]').eq(idx).val(v);

	});
	if (check_add_opt == false) return false;

	// 폼 (form[name=frmView]) 에 _addopt_inputable 엘리먼트 생성 (기존것은 삭제)
	if ($('#'+obj_id+' input[name="_addopt_inputable[]"]').length > 0) {
		$("form [name=_addopt_inputable[]]").remove();

		$addopt_new = $('#'+obj_id+' input[name="_addopt_inputable[]"]').clone();
		$addopt_new.each( function(index, Element) {
			Element.value = $('#'+obj_id+' input[name="_addopt_inputable[]"]').get(index).value;
		});
		$addopt_new.css("display", "none");
		$("form[name=frmView]").append($addopt_new);
	}

	return true;
}

function indbAction(obj_id) {
	if (strprice.length > 0) {
		$("[id=goodsres-hide] .text_msg").text("가격대체문구 상품입니다");
		$("[id=goodsres-hide]").fadeIn(300);
		setTimeout( function() {
			$("[id=goodsres-hide]").fadeOut(300);
		}, 1000);
		return;
	}
	switch(obj_id) {
		case 'goodsorder-hide' :
			var $frm = $("form[name=frmView]");
			var $mode =	$("form[name=frmView] [name=mode]");

			$mode.val('addItem');
			if(m2CheckForm(obj_id)===false) return;

			$frm.attr("action", "../ord/order.php");
			$frm.submit();
			break;

		case 'goodscart-hide' :
			var $frm = $("form[name=frmView]");
			var $mode =	$("form[name=frmView] [name=mode]");

			$mode.val('addCart');
			if(m2CheckForm(obj_id)===false) return;

			var serializedData = $("form[name=frmView]").serialize();

			$.ajax({
				type:"post",
				url:"./ajaxAction.php",
				dataType:"json",
				data: serializedData,
				success:function(result){
					$("form [name=addopt[]]").remove();
					popOpt('cart');
					showResMsg(result);
				},
				error:function(xhr, ajaxOptions, thrownError){
					n1 = xhr.responseText.indexOf("<script>");
					n2 = xhr.responseText.indexOf("<\/script>");
					if (n1>0 && n2 >n1) {
						errmsg = xhr.responseText.substring(n1+"<script>".length, n2);
						errmsg = errmsg.replace(/alert/gi, "");
						alert(errmsg);
					} else {
						alert('장바구니 추가실패!\n다시 시도하여주시기 바랍니다.');
					}
				}
			});
			$("form [name=addopt[]]").remove();
			break;

		case 'goodswish-hide' :
			var $frm = $("form[name=frmView]");
			var $mode =	$("form[name=frmView] [name=mode]");

			$mode.val('addWishlist');
			if(m2CheckForm(obj_id)===false) return;

			var serializedData = $("form[name=frmView]").serialize();
			$.ajax({
				type:"post",
				url:"./ajaxAction.php",
				dataType:"json",
				data: serializedData,
				success:function(result){
					$("form [name=addopt[]]").remove();
					popOpt('wish');
					showResMsg(result);
				},
				error:function(){
					alert('일시적인 에러가 발생하였습니다.\n다시 시도하여주시기 바랍니다.');
				}
			});
			$("form [name=addopt[]]").remove();
			break;
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

$.fn.scrollView = function () {
    return this.each(function () {
        $('html, body').animate({
            scrollTop: $(this).offset().top
        }, 1000);
    });
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
</script>
<style type="text/css">
.goods_price2 {height:20px;line-height:20px;text-align:right;}
.goods_dc {height:20px;line-height:20px;text-align:right;color:#88eeff;}
</style>
<form name="frmView" method="post" onsubmit="return false;">
	<input type="hidden" name="mode" value="" />
	<input type="hidden" name="goodsno" value="<?php echo $TPL_VAR["goodsno"]?>" />
	<input type="hidden" name="goodsCoupon" value="<?php echo $TPL_VAR["coupon"]?>" />
	<input type="hidden" name="ea" value="" />
	<input type="hidden" name="opt[]" value="" />
</form>

<section id="goodsview" class="content">
	<div class="top_title" >
		<div class="goods_nm">
<?php if($TPL_VAR["clevel"]=='0'||$TPL_VAR["slevel"]>=$TPL_VAR["clevel"]){?>
			<?php echo $TPL_VAR["goodsnm"]?>

<?php }elseif($TPL_VAR["slevel"]<$TPL_VAR["clevel"]&&$TPL_VAR["auth_step"][ 1]=='Y'){?>
			<?php echo $TPL_VAR["goodsnm"]?>

<?php }?>
		</div>
		<div class="goods_price">
<?php if($TPL_VAR["clevel"]=='0'||$TPL_VAR["slevel"]>=$TPL_VAR["clevel"]){?>
			<span style="font-size:14px;"><?php if(!$TPL_VAR["strprice"]){?> ￦<?php echo number_format($TPL_VAR["price"])?>원 <?php }else{?> <?php echo $TPL_VAR["strprice"]?> <?php }?></span>
<?php }elseif($TPL_VAR["slevel"]<$TPL_VAR["clevel"]&&$TPL_VAR["auth_step"][ 2]=='Y'){?>
			<span style="font-size:14px;"><?php if(!$TPL_VAR["strprice"]){?> ￦<?php echo number_format($TPL_VAR["price"])?>원 <?php }else{?> <?php echo $TPL_VAR["strprice"]?> <?php }?></span>
<?php }?>
		</div>
	</div>
	<div class="thumbnail-area">
		<div class="zoom-area">
			<div class="zoom-icon" onClick="javascript:location.href='/'+mobile_root+'/goods/view_detail.php?goodsno=<?php echo $TPL_VAR["goodsno"]?>';"></div>
		</div>
		<div class="thumbnail-img">
			<?php echo goodsimgMobile($TPL_VAR["l_img"][ 0], 500)?>

		</div>
	</div>
<?php if($TPL_VAR["coupon"]||$TPL_VAR["coupon_emoney"]){?>
	<div id="goods_coupon">
		<!-- 할인쿠폰 다운받기 -->
		<h4 class="hidden">할인쿠폰 다운받기</h4>
		<ul>
			<li><img src="/shop/data/skin_mobileV2/light/common/img/coupon_txt.gif" alt="할인쿠폰 다운받기" /></li>
<?php if($TPL_a_coupon_1){foreach($TPL_VAR["a_coupon"] as $TPL_V1){?>
			<li>
				<a class="coupon_img type_0<?php echo ($TPL_V1["coupon_img"]+ 1)?>" href="<?php echo $GLOBALS["cfg"]["rootDir"]?>/proc/dn_coupon_goods.php?goodsno=<?php echo $TPL_VAR["goodsno"]?>&couponcd=<?php echo $TPL_V1["couponcd"]?>'" target="ifrmHidden">
				<?php echo $GLOBALS["r_couponAbility"][$TPL_V1["ability"]]?><?php if(substr($TPL_V1["price"], - 1)!="%"){?><?php echo number_format($TPL_V1["price"])?>원<?php }else{?><?php echo $TPL_V1["price"]?><?php }?>
				</a>
			</li>
<?php }}?>
		</ul>
		<hr class="hidden" />
	</div>
<?php }?>
	<div class="btn-area">
		<div class="btn-area-effect">
<?php if($TPL_VAR["clevel"]=='0'||$TPL_VAR["slevel"]>=$TPL_VAR["clevel"]){?>
			<div id="order-btn">
				<div id="order-btn-effect">
					<div id="order-btn-object" onClick="javascript:popOpt('order');"></div>
				</div>
			</div>
			<div id="wish-btn">
				<div id="wish-btn-effect">
					<div id="wish-btn-object" onClick="javascript:popOpt('wish');"></div>
				</div>
			</div>
			<div id="cart-btn">
				<div id="cart-btn-effect">
					<div id="cart-btn-object" onClick="javascript:popOpt('cart');"></div>
				</div>
			</div>
<?php }else{?>
			<div id="order-btn">
			</div>
			<div id="wish-btn">
			</div>
			<div id="cart-btn">
			</div>
<?php }?>
			<div id="review-btn">
				<div id="review-btn-effect">
					<div id="review-btn-object" onClick="javascript:location.href='/'+mobile_root+'/myp/review.php?goodsno=<?php echo $TPL_VAR["goodsno"]?>';"></div>
				</div>
			</div>
			<div id="sns-btn">
				<div id="sns-btn-effect">
					<div id="sns-btn-object" onClick="javascript:popOpt('sns');"></div>
				</div>
			</div>
		</div>
	<div>
</section>
<section id="goodsorder-hide" class="content_goods">
	<div class="pop_back">
		<div class="pop_effect">
			<div class="pop_body">
				<div class="pop_title">선택옵션</div>
				<div class="pop_content">
					<div class="pop_content_opt">
						<div class="pop_content_title">선택</div>
						<div class="pop_content_content">
							<select name="goods_opt">
<?php if($GLOBALS["opt"]){?>
								<option value="">선택사항</option>
<?php if($TPL__opt_1){foreach($GLOBALS["opt"] as $TPL_V1){?><?php if((is_array($TPL_R2=$TPL_V1)&&!empty($TPL_R2)) || (is_object($TPL_R2) && in_array("Countable", class_implements($TPL_R2)) && $TPL_R2->count() > 0)) {foreach($TPL_R2 as $TPL_V2){?>
								<option value="<?php echo $TPL_V2["opt1"]?><?php if($TPL_V2["opt2"]){?>|<?php echo $TPL_V2["opt2"]?><?php }?>" <?php if($TPL_VAR["usestock"]&&!$TPL_V2["stock"]){?> disabled class=disabled<?php }?>> <?php if($TPL_VAR["usestock"]&&!$TPL_V2["stock"]){?>[품절]<?php }?> <?php echo $TPL_V2["opt1"]?><?php if($TPL_V2["opt2"]){?>/<?php echo $TPL_V2["opt2"]?><?php }?> <?php if($TPL_V2["price"]!=$TPL_VAR["price"]){?>(<?php echo number_format($TPL_V2["price"])?>원)<?php }?></option>
<?php if($TPL_VAR["usestock"]&&!$TPL_V2["stock"]){?> [품절]<?php }?>
<?php }}?><?php }}?>
<?php }else{?>
								<option value="">선택사항없음</option>
<?php }?>
							</select>
						</div>
					</div>
					<div class="pop_content_cnt">
						<div class="pop_content_title">수량</div>
						<div class="pop_content_content">
							<input type="text" name="order_cnt" size="5" value="<?php if($TPL_VAR["min_ea"]){?><?php echo $TPL_VAR["min_ea"]?><?php }else{?>1<?php }?>" <?php if($TPL_VAR["min_ea"]){?>min="<?php echo $TPL_VAR["min_ea"]?>"<?php }?> <?php if($TPL_VAR["max_ea"]){?>max="<?php echo $TPL_VAR["max_ea"]?>"<?php }?> <?php if($TPL_VAR["sales_unit"]){?>step="<?php echo $TPL_VAR["sales_unit"]?>"<?php }?> onchange="orderCntCalc(this, this.value, true);"/>
						</div>
					</div>
				</div>
				<!-- 추가 옵션 -->
<?php if($GLOBALS["addopt"]){?>
				<div class="pop_title">추가옵션</div>
				<div class="pop_content">
<?php if($TPL__addopt_1){$TPL_I1=-1;foreach($GLOBALS["addopt"] as $TPL_K1=>$TPL_V1){$TPL_I1++;?>
					<div class="pop_content_opt">
						<div class="pop_content_title"><?php echo $TPL_K1?><?php if($GLOBALS["addoptreq"][$TPL_I1]=='o'){?>(필수)<?php }?></div>
						<div class="pop_content_content">
							<select name="addopt[]" <?php if($GLOBALS["addoptreq"][$TPL_I1]=='o'){?> required="required" label="<?php echo $TPL_K1?>"<?php }?>> msgR="<?php echo $TPL_K1?>"
							<option value="">==<?php echo $TPL_K1?> 선택==
<?php if(!$GLOBALS["addoptreq"][$TPL_I1]){?><option value="-1">선택안함<?php }?>
<?php if((is_array($TPL_R2=$TPL_V1)&&!empty($TPL_R2)) || (is_object($TPL_R2) && in_array("Countable", class_implements($TPL_R2)) && $TPL_R2->count() > 0)) {foreach($TPL_R2 as $TPL_V2){?>
							<option value="<?php echo $TPL_V2["sno"]?>^<?php echo $TPL_K1?>^<?php echo $TPL_V2["opt"]?>^<?php echo $TPL_V2["addprice"]?>"><?php echo $TPL_V2["opt"]?>

<?php if($TPL_V2["addprice"]){?>(<?php echo number_format($TPL_V2["addprice"])?>원)<?php }?>
<?php }}?>
							</select>
						</div>
					</div>
<?php }}?>
				</div>
<?php }?>

				<!-- 입력 옵션 -->
<?php if($GLOBALS["addopt_inputable"]){?>
				<div class="pop_title">입력옵션</div>
				<div class="pop_content">
<?php if($TPL__addopt_inputable_1){$TPL_I1=-1;foreach($GLOBALS["addopt_inputable"] as $TPL_K1=>$TPL_V1){$TPL_I1++;?>
					<div class="pop_content_opt">
						<div class="pop_content_title"><?php echo $TPL_K1?><?php if($GLOBALS["addopt_inputable_req"][$TPL_I1]=='o'){?>(필수)<?php }?></div>
						<div class="pop_content_content">
							<input type="hidden" name="_addopt_inputable[]" value="">
							<input type="text" name="addopt_inputable[]" label="<?php echo $TPL_K1?>" option-value="<?php echo $TPL_V1["sno"]?>^<?php echo $TPL_K1?>^<?php echo $TPL_V1["opt"]?>^<?php echo $TPL_V1["addprice"]?>" value="" <?php if($GLOBALS["addopt_inputable_req"][$TPL_I1]){?>required fld_esssential<?php }?> maxlength="<?php echo $TPL_V1["opt"]?>">
						</div>
					</div>
<?php }}?>
				</div>
<?php }?>
				<div class="pop_btn">
					<div id="pop-left-btn" onClick="javascript:popOpt('order');">취소</div>
					<div id="pop-right-btn" onClick="javascript:indbAction('goodsorder-hide');">주문하기</div>
				</div>
				<?php echo $TPL_VAR["Payco"]?>

				<?php echo $TPL_VAR["naverCheckout"]?>

			</div>
		</div>
	</div>
</section>

<section id="goodscart-hide" class="content_goods">
	<div class="pop_back">
		<div class="pop_effect">
			<div class="pop_body">
				<div class="pop_title">선택옵션</div>
				<div class="pop_content">
					<div class="pop_content_opt">
						<div class="pop_content_title">선택</div>
						<div class="pop_content_content">
							<select name="goods_opt">
<?php if($GLOBALS["opt"]){?>
								<option value="">선택사항</option>
<?php if($TPL__opt_1){foreach($GLOBALS["opt"] as $TPL_V1){?>
<?php if((is_array($TPL_R2=$TPL_V1)&&!empty($TPL_R2)) || (is_object($TPL_R2) && in_array("Countable", class_implements($TPL_R2)) && $TPL_R2->count() > 0)) {foreach($TPL_R2 as $TPL_V2){?>
								<option value="<?php echo $TPL_V2["opt1"]?><?php if($TPL_V2["opt2"]){?>|<?php echo $TPL_V2["opt2"]?><?php }?>" <?php if($TPL_VAR["usestock"]&&!$TPL_V2["stock"]){?> disabled class=disabled<?php }?>><?php if($TPL_VAR["usestock"]&&!$TPL_V2["stock"]){?>[품절]<?php }?><?php echo $TPL_V2["opt1"]?><?php if($TPL_V2["opt2"]){?>/<?php echo $TPL_V2["opt2"]?><?php }?> <?php if($TPL_V2["price"]!=$TPL_VAR["price"]){?>(<?php echo number_format($TPL_V2["price"])?>원)<?php }?></option>
<?php if($TPL_VAR["usestock"]&&!$TPL_V2["stock"]){?> [품절]<?php }?>
<?php }}?><?php }}?>
<?php }else{?>
								<option value="">선택사항없음</option>
<?php }?>
							</select>
						</div>
					</div>
					<div class="pop_content_cnt">
						<div class="pop_content_title">수량</div>
						<div class="pop_content_content">
							<input type="text" name="order_cnt" size="5" value="1"/>
						</div>
					</div>
				</div>
				<!-- 추가 옵션 -->
<?php if($GLOBALS["addopt"]){?>
				<div class="pop_title">추가옵션</div>
				<div class="pop_content">
<?php if($TPL__addopt_1){$TPL_I1=-1;foreach($GLOBALS["addopt"] as $TPL_K1=>$TPL_V1){$TPL_I1++;?>
					<div class="pop_content_opt">
						<div class="pop_content_title"><?php echo $TPL_K1?><?php if($GLOBALS["addoptreq"][$TPL_I1]=='o'){?>(필수)<?php }?></div>
						<div class="pop_content_content">
							<select name="addopt[]" <?php if($GLOBALS["addoptreq"][$TPL_I1]=='o'){?> required="required" label="<?php echo $TPL_K1?>"<?php }?>> msgR="<?php echo $TPL_K1?>"
							<option value="">==<?php echo $TPL_K1?> 선택==
<?php if(!$GLOBALS["addoptreq"][$TPL_I1]){?><option value="-1">선택안함<?php }?>
<?php if((is_array($TPL_R2=$TPL_V1)&&!empty($TPL_R2)) || (is_object($TPL_R2) && in_array("Countable", class_implements($TPL_R2)) && $TPL_R2->count() > 0)) {foreach($TPL_R2 as $TPL_V2){?>
							<option value="<?php echo $TPL_V2["sno"]?>^<?php echo $TPL_K1?>^<?php echo $TPL_V2["opt"]?>^<?php echo $TPL_V2["addprice"]?>"><?php echo $TPL_V2["opt"]?>

<?php if($TPL_V2["addprice"]){?>(<?php echo number_format($TPL_V2["addprice"])?>원)<?php }?>
<?php }}?>
							</select>
						</div>
					</div>
<?php }}?>
				</div>
<?php }?>
				<!-- 입력 옵션 -->
<?php if($GLOBALS["addopt_inputable"]){?>
				<div class="pop_title">입력옵션</div>
				<div class="pop_content">
<?php if($TPL__addopt_inputable_1){$TPL_I1=-1;foreach($GLOBALS["addopt_inputable"] as $TPL_K1=>$TPL_V1){$TPL_I1++;?>
					<div class="pop_content_opt">
						<div class="pop_content_title"><?php echo $TPL_K1?><?php if($GLOBALS["addopt_inputable_req"][$TPL_I1]=='o'){?>(필수)<?php }?></div>
						<div class="pop_content_content">
							<input type="hidden" name="_addopt_inputable[]" value="">
							<input type="text" name="addopt_inputable[]" label="<?php echo $TPL_K1?>" option-value="<?php echo $TPL_V1["sno"]?>^<?php echo $TPL_K1?>^<?php echo $TPL_V1["opt"]?>^<?php echo $TPL_V1["addprice"]?>" value="" <?php if($GLOBALS["addopt_inputable_req"][$TPL_I1]){?>required fld_esssential<?php }?> maxlength="<?php echo $TPL_V1["opt"]?>">
						</div>
					</div>
<?php }}?>
				</div>
<?php }?>
				<div class="pop_btn">
					<div id="pop-left-btn" onClick="javascript:popOpt('cart');">취소</div>
					<div id="pop-right-btn" onClick="javascript:indbAction('goodscart-hide');">장바구니</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="goodswish-hide" class="content_goods">
	<div class="pop_back">
		<div class="pop_effect">
			<div class="pop_body">
				<div class="pop_title">선택옵션</div>
				<div class="pop_content">
					<div class="pop_content_opt">
						<div class="pop_content_title">선택</div>
						<div class="pop_content_content">
							<select name="goods_opt">
<?php if($GLOBALS["opt"]){?>
								<option value="">선택사항</option>
<?php if($TPL__opt_1){foreach($GLOBALS["opt"] as $TPL_V1){?><?php if((is_array($TPL_R2=$TPL_V1)&&!empty($TPL_R2)) || (is_object($TPL_R2) && in_array("Countable", class_implements($TPL_R2)) && $TPL_R2->count() > 0)) {foreach($TPL_R2 as $TPL_V2){?>
								<option value="<?php echo $TPL_V2["opt1"]?><?php if($TPL_V2["opt2"]){?>|<?php echo $TPL_V2["opt2"]?><?php }?>" <?php if($TPL_VAR["usestock"]&&!$TPL_V2["stock"]){?> disabled class=disabled<?php }?>><?php if($TPL_VAR["usestock"]&&!$TPL_V2["stock"]){?>[품절]<?php }?><?php echo $TPL_V2["opt1"]?><?php if($TPL_V2["opt2"]){?>/<?php echo $TPL_V2["opt2"]?><?php }?> <?php if($TPL_V2["price"]!=$TPL_VAR["price"]){?>(<?php echo number_format($TPL_V2["price"])?>원)<?php }?></option>
<?php if($TPL_VAR["usestock"]&&!$TPL_V2["stock"]){?> [품절]<?php }?>
<?php }}?><?php }}?>
<?php }else{?>
								<option value="">선택사항없음</option>
<?php }?>
							</select>
						</div>
					</div>
				</div>
				<!-- 추가 옵션 -->
<?php if($GLOBALS["addopt"]){?>
				<div class="pop_content">
				<div class="pop_title">추가옵션</div>
<?php if($TPL__addopt_1){$TPL_I1=-1;foreach($GLOBALS["addopt"] as $TPL_K1=>$TPL_V1){$TPL_I1++;?>
					<div class="pop_content_opt">
						<div class="pop_content_title"><?php echo $TPL_K1?><?php if($GLOBALS["addoptreq"][$TPL_I1]=='o'){?>(필수)<?php }?></div>
						<div class="pop_content_content">
							<select name="addopt[]" <?php if($GLOBALS["addoptreq"][$TPL_I1]=='o'){?> required="required" label="<?php echo $TPL_K1?>"<?php }?>> msgR="<?php echo $TPL_K1?>"
							<option value="">==<?php echo $TPL_K1?> 선택==
<?php if(!$GLOBALS["addoptreq"][$TPL_I1]){?><option value="-1">선택안함<?php }?>
<?php if((is_array($TPL_R2=$TPL_V1)&&!empty($TPL_R2)) || (is_object($TPL_R2) && in_array("Countable", class_implements($TPL_R2)) && $TPL_R2->count() > 0)) {foreach($TPL_R2 as $TPL_V2){?>
							<option value="<?php echo $TPL_V2["sno"]?>^<?php echo $TPL_K1?>^<?php echo $TPL_V2["opt"]?>^<?php echo $TPL_V2["addprice"]?>"><?php echo $TPL_V2["opt"]?>

<?php if($TPL_V2["addprice"]){?>(<?php echo number_format($TPL_V2["addprice"])?>원)<?php }?>
<?php }}?>
							</select>
						</div>
					</div>
<?php }}?>
				</div>
<?php }?>
				<!-- 입력 옵션 -->
<?php if($GLOBALS["addopt_inputable"]){?>
				<div class="pop_title">입력옵션</div>
				<div class="pop_content">
<?php if($TPL__addopt_inputable_1){$TPL_I1=-1;foreach($GLOBALS["addopt_inputable"] as $TPL_K1=>$TPL_V1){$TPL_I1++;?>
					<div class="pop_content_opt">
						<div class="pop_content_title"><?php echo $TPL_K1?><?php if($GLOBALS["addopt_inputable_req"][$TPL_I1]=='o'){?>(필수)<?php }?></div>
						<div class="pop_content_content">
							<input type="hidden" name="_addopt_inputable[]" value="">
							<input type="text" name="addopt_inputable[]" label="<?php echo $TPL_K1?>" option-value="<?php echo $TPL_V1["sno"]?>^<?php echo $TPL_K1?>^<?php echo $TPL_V1["opt"]?>^<?php echo $TPL_V1["addprice"]?>" value="" <?php if($GLOBALS["addopt_inputable_req"][$TPL_I1]){?>required fld_esssential<?php }?> maxlength="<?php echo $TPL_V1["opt"]?>">
						</div>
					</div>
<?php }}?>
				</div>
<?php }?>
				<div class="pop_btn">
					<div id="pop-left-btn" onClick="javascript:popOpt('wish');">취소</div>
					<div id="pop-right-btn" onClick="javascript:indbAction('goodswish-hide');">찜하기</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="goodssns-hide" class="content_goods">
	<div class="sns_icon" style="position:fixed; bottom:52px;">
	<?php echo $TPL_VAR["snsBtn"]?>

	</div>
</section>

<section id="goodsres-hide" class="content_goods">
	<div class="pop_back">
		<div class="pop_effect">
			<div class="text_msg"></div>
		</div>
	</div>
</section>

<?php $this->print_("footer",$TPL_SCP,1);?>