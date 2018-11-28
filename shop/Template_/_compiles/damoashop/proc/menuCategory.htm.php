<?php /* Template_ 2.2.7 2018/03/16 21:20:23 /www/jbsinttr8192_godo_co_kr/shop/data/skin/damoashop/proc/menuCategory.htm 000007802 */  $this->include_("dataCategory");?>
<div id="left_cate">
	<div><img src="/shop/data/skin/damoashop/img/main/shopping.gif"></div>
<?php if($GLOBALS["cfg"]["subCategory"]!= 2){?>
	<table width="100%" cellpadding=0 cellspacing=0 border=0 id="menuLayer">
<?php if((is_array($TPL_R1=dataCategory($GLOBALS["cfg"]["subCategory"], 1))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?>
		<tr>
<?php if($TPL_V1["category"]=='050'||$TPL_V1["category"]=='002'){?>
			<td class="catebar"><a href="<?php echo url("goods/goods_list.php?")?>&category=<?php echo $TPL_V1["category"]?>&sort=goodsnm" class="cate1"><?php echo $TPL_V1["catnm"]?></a></td>
		<!--
		</tr>
		<tr>
			<td class="catebar"><img src="/shop/data/category/052_basic.jpg"></td>
		-->
<?php }elseif($TPL_V1["category"]=='003'){?>
			<td class="catebar" style="height:30px;"><a href="<?php echo url("goods/goods_list.php?")?>&category=<?php echo $TPL_V1["category"]?>&sort=goodsnm" class="cate1 blinking"><?php echo $TPL_V1["catnm"]?></a></td>
<?php }elseif($TPL_V1["category"]=='051'||$TPL_V1["category"]=='052'||$TPL_V1["category"]=='053'||$TPL_V1["category"]=='054'){?>
			<td class="catebar"><img src="/shop/data/category/052_basic.jpg"></td>
<?php }else{?>
			<td class="catebar"><a href="<?php echo url("goods/goods_list.php?")?>&category=<?php echo $TPL_V1["category"]?>&sort=goodsnm" class="cate1"><?php echo $TPL_V1["catnm"]?></a></td>
<?php }?>
			<td style="z-index:100">
<?php if($TPL_V1["sub"]){?>
				<div style="position:relative">
					<div class=subLayer>
						<table width=100% cellspacing=1 id="table_cate">
<?php if((is_array($TPL_R2=$TPL_V1["sub"])&&!empty($TPL_R2)) || (is_object($TPL_R2) && in_array("Countable", class_implements($TPL_R2)) && $TPL_R2->count() > 0)) {foreach($TPL_R2 as $TPL_V2){?>
							<tr>
<?php if($TPL_V1["category"]=='050'||$TPL_V1["category"]=='002'){?>
									<td nowrap class="cate"><a href="<?php echo url("goods/goods_list.php?")?>&category=<?php echo $TPL_V2["category"]?>&sort=goodsnm" class="cate2"><?php echo $TPL_V2["catnm"]?></a></td>
<?php }elseif($TPL_V1["category"]=='004'){?>
<?php if($TPL_V2["category"]=='004076'){?>
									<td nowrap class="cate"><a href="<?php echo url("goods/goods_list.php?")?>&category=004076&sort=goodsnm" class="cate2"><?php echo $TPL_V2["catnm"]?></a></td>
<?php }elseif($TPL_V2["category"]=='004080'){?>
									<td nowrap class="cate"><a href="<?php echo url("goods/goods_list.php?")?>&category=031005&sort=goodsnm" class="cate2"><?php echo $TPL_V2["catnm"]?></a></td>
<?php }elseif($TPL_V2["category"]=='004081'){?>
									<td nowrap class="cate"><a href="<?php echo url("goods/goods_list.php?")?>&category=004081&sort=goodsnm" class="cate2"><?php echo $TPL_V2["catnm"]?></a></td>
<?php }elseif($TPL_V2["category"]=='004082'){?>
									<td nowrap class="cate"><a href="<?php echo url("goods/goods_list.php?")?>&category=024002&sort=goodsnm" class="cate2"><?php echo $TPL_V2["catnm"]?></a></td>
<?php }elseif($TPL_V2["category"]=='004086'){?>
									<td nowrap class="cate"><a href="<?php echo url("goods/goods_list.php?")?>&category=024012&sort=goodsnm" class="cate2"><?php echo $TPL_V2["catnm"]?></a></td>
<?php }elseif($TPL_V2["category"]=='004088'){?>
									<td nowrap class="cate"><a href="<?php echo url("goods/goods_list.php?")?>&category=031006&sort=goodsnm" class="cate2"><?php echo $TPL_V2["catnm"]?></a></td>
<?php }elseif($TPL_V2["category"]=='004083'){?>
									<td nowrap class="cate"><a href="<?php echo url("goods/goods_list.php?")?>&category=024004&sort=goodsnm" class="cate2"><?php echo $TPL_V2["catnm"]?></a></td>
<?php }elseif($TPL_V2["category"]=='004084'){?>
									<td nowrap class="cate"><a href="<?php echo url("goods/goods_list.php?")?>&category=024005&sort=goodsnm" class="cate2"><?php echo $TPL_V2["catnm"]?></a></td>
<?php }elseif($TPL_V2["category"]=='004087'){?>
									<td nowrap class="cate"><a href="<?php echo url("goods/goods_list.php?")?>&category=024011&sort=goodsnm" class="cate2"><?php echo $TPL_V2["catnm"]?></a></td>
<?php }elseif($TPL_V2["category"]=='004077'){?>
									<td nowrap class="cate"><a href="<?php echo url("goods/goods_list.php?")?>&category=024006&sort=goodsnm" class="cate2"><?php echo $TPL_V2["catnm"]?></a></td>
<?php }elseif($TPL_V2["category"]=='004085'){?>
									<td nowrap class="cate"><a href="<?php echo url("goods/goods_list.php?")?>&category=004085&sort=goodsnm" class="cate2"><?php echo $TPL_V2["catnm"]?></a></td>
<?php }elseif($TPL_V2["category"]=='004078'){?>
									<td nowrap class="cate"><a href="<?php echo url("goods/goods_list.php?")?>&category=004078&sort=goodsnm" class="cate2"><?php echo $TPL_V2["catnm"]?></a></td>
<?php }elseif($TPL_V2["category"]=='004079'){?>
									<td nowrap class="cate"><a href="<?php echo url("goods/goods_list.php?")?>&category=024009&sort=goodsnm" class="cate2"><?php echo $TPL_V2["catnm"]?></a></td>
<?php }elseif($TPL_V2["category"]=='004089'){?>
									<td nowrap class="cate"><a href="<?php echo url("goods/goods_list.php?")?>&category=004089&sort=goodsnm" class="cate2"><?php echo $TPL_V2["catnm"]?></a></td>
<?php }elseif($TPL_V2["category"]=='004090'){?>
									<td nowrap class="cate"><a href="<?php echo url("goods/goods_list.php?")?>&category=055002&sort=goodsnm" class="cate2"><?php echo $TPL_V2["catnm"]?></a></td>
<?php }elseif($TPL_V2["category"]=='004102'){?>
									<td nowrap class="cate"><a href="<?php echo url("goods/goods_list.php?")?>&category=025015&sort=goodsnm" class="cate2"><?php echo $TPL_V2["catnm"]?></a></td>
<?php }else{?>
									<td nowrap class="cate"><a href="<?php echo url("goods/goods_list.php?")?>&category=<?php echo $TPL_V2["category"]?>&sort=goodsnm" class="cate2"><?php echo $TPL_V2["catnm"]?></a></td>
<?php }?>
<?php }else{?>
								<td nowrap class="cate"><a href="<?php echo url("goods/goods_list.php?")?>&category=<?php echo $TPL_V2["category"]?>&sort=goodsnm" class="cate2"><?php echo $TPL_V2["catnm"]?></a></td>
<?php }?>
							</tr>
<?php }}?>
						</table>
					</div>
				</div>
<?php }?>
			</td>
		</tr>
<?php }}?>
	</table>
<?php if($GLOBALS["cfg"]["subCategory"]){?>
	<script>execSubLayer();</script>
<?php }?>

<?php }else{?>
	<table width=100% cellpadding=0 cellspacing=0 class="cateUnfold">
<?php if((is_array($TPL_R1=dataCategory($GLOBALS["cfg"]["subCategory"], 1))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?>
		<tr>
<?php if($TPL_V1["category"]=='050'||$TPL_V1["category"]=='002'){?>
			<td class="catebar"><a href="<?php echo url("goods/goods_list.php?")?>&category=<?php echo $TPL_V1["category"]?>&sort=goodsnm"><?php echo $TPL_V1["catnm"]?></a></td>
<?php }else{?>
			<td class="catebar"><a href="<?php echo url("goods/goods_list.php?")?>&category=<?php echo $TPL_V1["category"]?>&sort=goodsnm"><?php echo $TPL_V1["catnm"]?></a></td>
<?php }?>
		</tr>
<?php if($TPL_V1["sub"]){?>
		<tr>
			<td class="catesub">
				<table>
<?php if((is_array($TPL_R2=$TPL_V1["sub"])&&!empty($TPL_R2)) || (is_object($TPL_R2) && in_array("Countable", class_implements($TPL_R2)) && $TPL_R2->count() > 0)) {foreach($TPL_R2 as $TPL_V2){?>
					<tr>
						<td class="cate"><a href="<?php echo url("goods/goods_list.php?")?>&category=<?php echo $TPL_V2["category"]?>&sort=goodsnm"><?php echo $TPL_V2["catnm"]?></a></td>
					</tr>
<?php }}?>
				</table>
			</td>
		</tr>
<?php }?>
<?php }}?>
	</table>
<?php }?>
</div>