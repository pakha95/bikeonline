<?php /* Template_ 2.2.7 2018/10/05 19:53:30 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/goods/list/tpl_01.htm 000005178 */ 
if (is_array($TPL_VAR["loop"])) $TPL_loop_1=count($TPL_VAR["loop"]); else if (is_object($TPL_VAR["loop"]) && in_array("Countable", class_implements($TPL_VAR["loop"]))) $TPL_loop_1=$TPL_VAR["loop"]->count();else $TPL_loop_1=0;?>
<?php if($TPL_loop_1){foreach($TPL_VAR["loop"] as $TPL_V1){?>
<div class="goods-list-item">
	<div class="goods-list-img">

		<a href="#" onclick="goGoods(<?php echo $TPL_V1["goodsno"]?>)"><?php echo $TPL_V1["img_html"]?></a>
<?php if($TPL_V1["tts_url"]){?>
		<div class="goods-speach-description">
			<span class="speach-description-play" data-src="<?php echo $TPL_V1["tts_url"]?>">재생</span>
			<span class="speach-description-timer"></span>
		</div>
<?php }?>
	</div>
	<div class="goods-list-info">

		<a href="#" onclick="goGoods(<?php echo $TPL_V1["goodsno"]?>)">
			<div class="goods-nm"><?php echo $TPL_V1["goods_prefix"]?><?php echo $TPL_V1["goodsnm"]?></div>
<?php if($TPL_V1["strprice"]){?>
			<div class="goods-price">상품가격 : <span class="red"><?php echo $TPL_V1["strprice"]?></span></div>
<?php if($TPL_V1["reserve"]){?>

<?php }?>
<?php }elseif($TPL_V1["goodsDiscountPrice"]){?>
<?php if($TPL_V1["oriPrice"]){?>
			<div class="goods-consumer" style="display: none;">상품가격 : <strike><?php echo $TPL_V1["oriPrice"]?>원</strike>↓</div>
			<div class="goods-price">
				<span class="red"><?php echo number_format($TPL_V1["goodsDiscountPrice"])?>원</span>
<?php if($TPL_V1["special_discount"]){?>
				<span class="goods-discount" style="display: none;">(<?php echo number_format($TPL_V1["special_discount"])?>

<?php if(strstr('원',$TPL_V1["special_discount"])){?>원<?php }?>
<?php if(strstr('%',$TPL_V1["special_discount"])){?>%<?php }?>
				 할인)</span>
<?php }?>
			</div>
<?php }else{?>
			<div class="goods-price">
				<span class="goods-consumer" style="display: none;"> 상품가격 : </span> <span class="red" style="margin-left:0px;"><?php echo number_format($TPL_V1["goodsDiscountPrice"])?>원</span>
<?php if($TPL_V1["special_discount"]){?>
				<span class="goods-discount" style="display: none;">(<?php echo number_format($TPL_V1["special_discount"])?>

<?php if(strstr('원',$TPL_V1["special_discount"])){?>원<?php }?>
<?php if(strstr('%',$TPL_V1["special_discount"])){?>%<?php }?>
				 할인)</span>
<?php }?>
			</div>
<?php }?>
<?php if($TPL_V1["coupon"]){?>
			<div class="goods-coupon-price" style="display: none;">쿠폰할인 : <span class="red"><?php echo number_format($TPL_V1["coupon"])?>원</span> <div class="goods-coupon-icon"></div></div>
<?php }?>

<?php if($TPL_V1["reserve"]){?>

<?php }?>
<?php }elseif($TPL_V1["price"]){?>
<?php if(!$TPL_V1["strprice"]){?>
<?php if($TPL_V1["consumer"]){?>
			<div class="goods-consumer" style="display: none;">상품가격 : <strike><?php echo $TPL_V1["consumer"]?>원</strike>↓</div>
			<div class="goods-price">
				<span class="red"><?php echo number_format($TPL_V1["price"])?>원</span>
<?php if($TPL_V1["special_discount"]){?>
				<span class="goods-discount" style="display: none;">(<?php echo number_format($TPL_V1["special_discount"])?>

<?php if(strstr('원',$TPL_V1["special_discount"])){?>원<?php }?>
<?php if(strstr('%',$TPL_V1["special_discount"])){?>%<?php }?>
				 할인)</span>
<?php }?>
			</div>
<?php }else{?>
			<div class="goods-price">
				<span class="goods-consumer" style="display: none;"> 상품가격 : </span> <span class="red" style="margin-left:0px;"><?php echo number_format($TPL_V1["price"])?>원</span>
<?php if($TPL_V1["special_discount"]){?>
				<span class="goods-discount" style="display: none;">(<?php echo number_format($TPL_V1["special_discount"])?>

<?php if(strstr('원',$TPL_V1["special_discount"])){?>원<?php }?>
<?php if(strstr('%',$TPL_V1["special_discount"])){?>%<?php }?>
				 할인)</span>
<?php }?>
			</div>
<?php }?>
<?php }elseif($TPL_V1["strprice"]){?>
			<div class="goods-price">
				<span class="goods-consumer" style="display: none;"> 상품가격 : </span> <span class="red" style="margin-left:0px;"><?php echo number_format($TPL_V1["price"])?>원</span>
<?php if($TPL_V1["special_discount"]){?>
				<span class="goods-discount" style="display: none;">(<?php echo number_format($TPL_V1["special_discount"])?>

<?php if(strstr('원',$TPL_V1["special_discount"])){?>원<?php }?>
<?php if(strstr('%',$TPL_V1["special_discount"])){?>%<?php }?>
				 할인)</span>
<?php }?>
			</div>
<?php }?>
<?php if($TPL_V1["coupon"]){?>
			<div class="goods-coupon-price" style="display: none;">쿠폰할인 : <span class="red"><?php echo number_format($TPL_V1["coupon"])?>원</span> <div class="goods-coupon-icon"></div></div>
<?php }?>
<?php if($TPL_V1["reserve"]){?>

<?php }?>
<?php }else{?>
			<div class="goods-price"></div>
<?php }?>
		</a>
	</div>
	<!-- <a href="<?php echo $TPL_VAR["goods_src"]?>&amp;goodsno=<?php echo $TPL_V1["goodsno"]?>"><div class="goods-list-arrow"></div></a> -->
	<a href="#" onclick="goGoods(<?php echo $TPL_V1["goodsno"]?>)"><div class="goods-list-arrow"></div></a>
</div>
<?php }}?>