<?php /* Template_ 2.2.7 2017/10/31 19:08:36 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/goods/list/tpl_02.htm 000003249 */ 
if (is_array($TPL_VAR["loop"])) $TPL_loop_1=count($TPL_VAR["loop"]); else if (is_object($TPL_VAR["loop"]) && in_array("Countable", class_implements($TPL_VAR["loop"]))) $TPL_loop_1=$TPL_VAR["loop"]->count();else $TPL_loop_1=0;?>
<?php if($TPL_loop_1){$TPL_I1=-1;foreach($TPL_VAR["loop"] as $TPL_V1){$TPL_I1++;?>
<?php if(($TPL_I1+ 1)% 3== 1){?>
<div class="goods-row">
<?php }?>
	<div class="goods-item"<?php if(($TPL_I1+ 1)% 3== 1||($TPL_I1+ 1)% 3== 2){?> style="margin-right:5%;"<?php }?>>
		<div class="goods-img">
<?php if($TPL_V1["coupon_discount"]){?>
			<div class="goods-coupon"></div>
<?php }?>
			<!-- <a href="<?php echo $TPL_VAR["goods_src"]?>&amp;goodsno=<?php echo $TPL_V1["goodsno"]?>"><?php echo $TPL_V1["img_html"]?></a> -->
			<a href="#" onclick="goGoods(<?php echo $TPL_V1["goodsno"]?>)"><?php echo $TPL_V1["img_html"]?></a>
<?php if($TPL_V1["tts_url"]){?>
			<div class="goods-speach-description" style="display:none;">
				<span class="speach-description-play" data-src="<?php echo $TPL_V1["tts_url"]?>">재생</span>
				<span class="speach-description-timer"></span>
			</div>
<?php }?>
		</div>
		<div class="goods-nm"><a href="#" onclick="goGoods(<?php echo $TPL_V1["goodsno"]?>)"><?php echo $TPL_V1["goods_prefix"]?><?php echo $TPL_V1["goodsnm"]?></a></div>
<?php if(!$TPL_V1["strprice"]){?>
<?php if($TPL_V1["goodsDiscountPrice"]){?>
<?php if($TPL_V1["oriPrice"]){?>
				<div class="goods-consumer" style="display: none;"><strike><?php echo number_format($TPL_V1["oriPrice"])?>원</strike>↓</div>
<?php }?>
<?php }elseif($TPL_V1["consumer"]){?>
		<div class="goods-consumer" style="display: none;"><strike><?php echo number_format($TPL_V1["consumer"])?>원</strike>↓</div>
<?php }?>
<?php }?>
<?php if($TPL_V1["strprice"]){?>
		<div class="goods-price"><a href="<?php echo $TPL_VAR["goods_src"]?>&goodsno=<?php echo $TPL_V1["goodsno"]?>"><?php echo $TPL_V1["strprice"]?></a></div>
<?php }elseif($TPL_V1["goodsDiscountPrice"]){?>
		<div class="goods-price"><a href="<?php echo $TPL_VAR["goods_src"]?>&amp;goodsno=<?php echo $TPL_V1["goodsno"]?>"><span class="red"><?php echo number_format($TPL_V1["goodsDiscountPrice"])?>원</span></a></div>

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
	</div>
<?php if(($TPL_I1+ 1)% 3== 0||($TPL_I1+ 1)==$TPL_loop_1){?>
	<div style="width:100%; height:0px; clear:both;"></div>
</div>
<?php }?>
<?php }}?>