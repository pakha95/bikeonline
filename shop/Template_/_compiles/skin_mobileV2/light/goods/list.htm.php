<?php /* Template_ 2.2.7 2018/10/05 19:58:06 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/goods/list.htm 000008363 */  $this->include_("dataSubCategory");?>
<?php $this->print_("header",$TPL_SCP,1);?>


<?php if($TPL_VAR["page_title"]){?>
<?php $this->print_("sub_header",$TPL_SCP,1);?>

<?php }?>

<script type="text/javascript">
// 스토리지 저장용 키
var key = {
	html: 'html_<?php echo $GLOBALS["category"]?>',
	total: 'total_<?php echo $GLOBALS["category"]?>',
	page: 'page_<?php echo $GLOBALS["category"]?>',
	is_last: 'islast_<?php echo $GLOBALS["category"]?>',
	view_type: 'key_<?php echo $GLOBALS["category"]?>'
};
var GD_STORAGE = loadSession(key.html);
var GD_VIEW_TYPE = ($.cookie('goods_view_type') ? $.cookie('goods_view_type') : 'list');
var GD_SORT_TYPE = ($.cookie('sort_type') ? $.cookie('sort_type') : 'sort');

// 뷰타입 선택시 액션
function setViewType(view_type) {
	toggleViewType(view_type);
	$.cookie('goods_view_type', view_type);
	$.cookie('sort_type', GD_SORT_TYPE);
	GD_VIEW_TYPE = view_type;
	loadGoodsHtml(true);
}

// 정렬선택시 액션
function setSortType(sort_type) {
	$.cookie('sort_type', sort_type);
	GD_SORT_TYPE = sort_type;
	loadGoodsHtml(true);
}

// 뷰타입 토글버튼 UI 처리
function toggleViewType(view_type) {
	if(view_type == 'gallery') {
		$(".view-gallery").removeClass("view-gallery-disable");
		$(".view-list").addClass("view-list-disable");
	}
	else {
		$(".view-gallery").addClass("view-gallery-disable");
		$(".view-list").removeClass("view-list-disable");
	}
}

// 각 뷰타입별 상품의 출력 갯수
function getItemCnt() {
	var item_cnt = 0;
	switch(GD_VIEW_TYPE) {
		case 'gallery':
			item_cnt = $(".goods-item").length;
			break;
		case 'gallery1':
			item_cnt = $(".goods-gallery1-item").length;
			break;
		case 'gallery2':
			item_cnt = $(".goods-gallery2-item").length;
			break;
		default:
		case 'list':
			item_cnt = $(".goods-list-item").length;
			break;
	}
	return item_cnt;
}

// HTML 데이터 호출
function loadGoodsHtml(is_empty) {
	var param = {
		kw: '',
		mode:	'get_goods_html',
		category: $("[name=category]").val(),
		view_type: GD_VIEW_TYPE,
		sort_type: GD_SORT_TYPE,
		item_cnt: $("[name=item_cnt]").val()
	};
	param.item_cnt = is_empty ? 0 : getItemCnt();

	if ($("[name=keyword]").val()) {
		param.kw = $("[name=keyword]").val();
//		param.category = '';
	}
	$("[name=item_cnt]").val(param.item_cnt);

	try {
		$.ajax({
			type: "post",
			url: "/"+ mobile_root + "/proc/mAjaxAction.php",
			cache: false,
			async: true,
			data: param,
			beforeSend: function (xhr) {
				// is_empty가 true인 경우 수행
				if(is_empty) {

					$(".goods-content").empty();
				}
				$('.indicator').show();
				$(".more-btn").hide();
			},
			success: function (data) {
				// 화면구성
				$(".goods-content").append(data.html);
				$('.indicator').hide();
				setGoodsImageSoldoutMask();
				if(data.html.length < 5 || getItemCnt() >= data.total) {
					$(".more-btn").hide();
				} else {
					$(".more-btn").show();
				}

				// 데이터 저장
				if (!$("[name=keyword]").val()) {
					saveSession(key.view_type, GD_VIEW_TYPE);
					saveSession(key.html, $('.goods-content').html());
					saveSession(key.total, data.total);
					saveSession(key.page, data.page);
					saveSession(key.is_last, data.is_last_page);
				}
			},
			error: function (xhr, status, error) {
				alert('로딩 중 에러가 발생했습니다. 잠시 후 다시 시도해주세요!')
				$('.indicator').hide();
			},
			dataType:"json"
		});
	}
	catch(e) {
		alert(e);
	}
}
var isloaded = false;//중복실행방지 변수
$(document).ready(function(){
	if (isloaded) { //중복실행방지
		return;
	}
	setSortType('goodsnm');
	//setSortType('goodsnm');
	//setViewType(GD_VIEW_TYPE);
	// UI 초기화
	$('.indicator').css({width: screen.width + 'px', height: (screen.height - 80) + 'px'});
	$("[name=goods_sort]").val(GD_SORT_TYPE);

<?php if($TPL_VAR["goods_total"]){?>
	/*
	 * 스토리지에 값이 있는 경우 : 스토리지의 html 데이터를 본문에 추가
	 * 스토리지에 값이 없는 경우 : Ajax 호출 후 html 데이터를 본문에 추가
	 */
	if(GD_STORAGE && GD_STORAGE != 'null' && !$("[name=keyword]").val()) {
		toggleViewType(GD_VIEW_TYPE);
		//alert("test");
		if (loadSession(key.view_type) == GD_VIEW_TYPE) {
			//alert("test");
			$('.goods-content').html(loadSession(key.html));
			if (getItemCnt() >= loadSession(key.total)) {
				$(".more-btn").hide();
			} else {
				$(".more-btn").show();
			}
			$('.indicator').hide();
		} else {
			setViewType(GD_VIEW_TYPE);
		}
	} else {
		setViewType(GD_VIEW_TYPE);
	}
<?php }?>

	// 탑버튼 클릭
	$("a[href=#top]").bind("click", function(e) {
		e.preventDefault();
		$("html body").animate({scrollTop: 0}, 'fast');
	});

	// 스크롤 최하단시 탑아이콘 출력
	$(window).scroll(function() {
		if ($(window).scrollTop() >= 117) {
			$("#top-anchor").fadeIn(150);
		} else {
			$("#top-anchor").fadeOut(100);
		}
		var left = (screen.width/2) - ($("#top-anchor").width()/2);
		$("#top-anchor").css({left: left + 'px'});
	});

	// 읽어주는 상품설명
	$(".goods-content").find(".speach-description-play").live("click", function(event){
		var $player = $("#speach-description-player");
		if (!$player.length) return false;
		$player.trigger("$play", [$(this).parent()]);
		event.preventDefault();
		event.stopPropagation();
	});
	isloaded = true; //중복실행방지
});
</script>

<a href="#top" id="top-anchor">TOP</a>
<?php if(!$TPL_VAR["kw"]){?>
<!-- 하위 카테고리 출력 시작 -->
<section id="subcategory-list">
	<ul class="top_title">
<?php if((is_array($TPL_R1=dataSubCategory($GLOBALS["category"],true))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?>
		<li<?php if($GLOBALS["category"]==$TPL_V1["category"]){?> class="on"<?php }?>>
			<a href="?category=<?php echo $TPL_V1["category"]?>"><?php echo $TPL_V1["catnm"]?><!--<font color=#777777>(<?php echo $TPL_V1["gcnt"]+ 0?>)</font>--></a>
		</li>
<?php }}?>
	</ul>
</section>
<!-- 하위 카테고리 출력 끝 -->
<?php }?>

<section id="goodslist" class="content">
	<input type="hidden" name="category" value="<?php echo $TPL_VAR["category"]?>" />
	<input type="hidden" name="keyword" value="<?php echo $TPL_VAR["kw"]?>" />
	<input type="hidden" name="item_cnt" value="0" />
	<div class="goods-sort-area">
		<div class="goods-sort">
			<select name="goods_sort" onChange="javascript:setSortType(this.value);">
				<option value="sort">상품정렬</option>
				<option value="goodsnm">상품명순</option>
				<option value="regdt">등록순</option>
				<option value="low_price">낮은가격순</option>
				<option value="high_price">높은가격순</option>
			</select>
		</div>
		<div class="goods-view-type">
			<div class="view-list" onClick="javascript:setViewType('list');"></div>
			<div class="view-gallery" onClick="javascript:setViewType('gallery');"></div>
		</div>
	</div>
<?php if(!$TPL_VAR["goods_total"]){?>
	<ul class="goods_item_list" id="goods-item-list">
		<li class="more">
<?php if($GLOBALS["kw"]){?>
			검색 결과가 없습니다.
<?php }else{?>
			해당 분류에 상품이 없습니다.
<?php }?>
		</li>
	</ul>
<?php }else{?>
	<audio id="speach-description-player"></audio>
	<div class="goods-area">
		<!-- 동적 상품리스트 시작 -->
		<div class="goods-content">	</div>
		<!-- 동적 상품리스트 끝 -->
		<div class="more-btn hidden" onclick="javascript:loadGoodsHtml();">더보기</div>
	</div>
<?php }?>
</section>

<div class="indicator"<?php if(!$TPL_VAR["goods_total"]){?> style="display:none"<?php }?>></div>

<!-- 품절상품 마스크 -->
<div id="el-goods-soldout-image-mask" style="display:none;position:absolute;top:0;left:0;background:url(<?php if($GLOBALS["cfg_soldout"]["mobile_display_overlay"]=='custom'){?><?php echo $GLOBALS["cfg"]["rootDir"]?>/data/goods/icon/mobile_custom_soldout<?php }else{?><?php echo $GLOBALS["cfg"]["rootDir"]?>/data/goods/icon/mobile_icon_soldout<?php echo $GLOBALS["cfg_soldout"]["mobile_display_overlay"]?><?php }?>) no-repeat center center; background-size:cover;"></div>
<script>
addOnloadEvent(function(){ setGoodsImageSoldoutMask() });
</script>

<?php $this->print_("footer",$TPL_SCP,1);?>