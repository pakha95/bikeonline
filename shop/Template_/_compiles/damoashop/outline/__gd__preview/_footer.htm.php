<?php /* Template_ 2.2.7 2015/12/22 13:37:46 /www/jbsinttr8192_godo_co_kr/shop/data/skin/damoashop/outline/_footer.htm 000005520 */  $this->include_("dataBanner");
if (is_array($GLOBALS["todayGoodsList"])) $TPL__todayGoodsList_1=count($GLOBALS["todayGoodsList"]); else if (is_object($GLOBALS["todayGoodsList"]) && in_array("Countable", class_implements($GLOBALS["todayGoodsList"]))) $TPL__todayGoodsList_1=$GLOBALS["todayGoodsList"]->count();else $TPL__todayGoodsList_1=0;?>
<div style="width:0;height:0;font-size:0"></div></td>
<?php if($this->tpl_['side_inc']&&$GLOBALS["cfg"]['outline_sidefloat']=='right'){?>
<td valign=top width=<?php echo $GLOBALS["cfg"]['shopSideSize']?> nowrap><?php $this->print_("side_inc",$TPL_SCP,1);?></td>
<?php }?>
<?php if($TPL_VAR["todayshop_cfg"]['shopMode']!='todayshop'&&!$TPL_VAR["todayshop_cfg"]['isTodayShopPage']){?>
<td width=0 id=pos_scroll valign=top>

<!-- 스크롤 배너 -->

<div id=scroll style="position:absolute; padding-top:0px; padding-left:10px;">
	<p style="margin-top:13px;"><a style="cursor: hand;" onclick="window.open('http://www.bikeonline.co.kr/shop/sizechart.html','sizechart','width=670, height=680, Statusbar=yes, resizable=yes, scrollbars=yes')">
	<img src="/shop/data/skin/damoashop/img/common/size-chart.jpg" alt="어패럴사이즈차트"/></a></p>
<?php if($TPL_VAR["setState"]=='Y'&&$TPL_VAR["Banner"]!=''){?>
<div style="text-align:left;"><?php echo $TPL_VAR["Banner"]?></div>
<?php }else{?>
<div><!-- 맨오른쪽_스크롤배너 (배너관리에서 수정가능) --><?php if((is_array($TPL_R1=dataBanner( 17))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></div>
<?php }?>
<?php if($GLOBALS["viewPageMoveList"]){?>
<script src="/shop/lib/js/prototype.js"></script>
<script language="JavaScript">
addOnloadEvent(function() { scrollCateList_ajax('<?php echo $GLOBALS["_SERVER"]['QUERY_STRING']?>') });
</script>
<div id="scrollMoveList"></div>
<div style="height:4px;"><!-- 여백 --></div>
<?php }?>

<div style="width:90px;">
	<div style="font-size:0; line-height:0;"><img src="/shop/data/skin/damoashop/img/common/wing_bn_top_myview.jpg" border=0></div>
	<table width=100% border=0 cellpadding=0 cellspacing=0 style="border-style:solid;border-color:#E3E3E3;border-width:0px 1px 1px 1px; background-color:#fff;">
	<tr>
		<td align=center>
		<div id=gdscroll style="height:217px;overflow:hidden;">
<?php if($TPL__todayGoodsList_1){$TPL_I1=-1;foreach($GLOBALS["todayGoodsList"] as $TPL_V1){$TPL_I1++;?>
		<div><a href="<?php echo url("goods/goods_view.php?")?>&goodsno=<?php echo $TPL_V1["goodsno"]?>"><?php echo goodsimg($TPL_V1["img"], 70)?></a></div>
<?php if($TPL_I1!=$TPL__todayGoodsList_1- 1){?><div style="height:3px;font-size:0"></div><?php }?>
<?php }}?>
		</div>
		</td>
	</tr>
	<tr><td style="text-align:center;padding:4px 0"><a href="javascript:gdscroll(-107)" onfocus=blur()><img src="/shop/data/skin/damoashop/img/common/sky_btn_up.gif" border=0></a> <a href="javascript:gdscroll(107)" onfocus=blur()><img src="/shop/data/skin/damoashop/img/common/sky_btn_down.gif" border='0'></a></td></tr>
	</table>
</div>
<div style="margin-bottom:5px;">
	<table cellpadding=0 cellspacing=0>
	<tr>
		<td><!-- 맨오른쪽_스크롤배너_top (배너관리에서 수정가능) --><?php if((is_array($TPL_R1=dataBanner( 28))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></td>
		<td><!-- 맨오른쪽_스크롤배너_back (배너관리에서 수정가능) --><?php if((is_array($TPL_R1=dataBanner( 29))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></td>
	</tr>
	</table>
</div>

<div><!-- 맨오른쪽_스크롤배너 (배너관리에서 수정가능) --><?php if((is_array($TPL_R1=dataBanner( 18))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></div>
<div align="center" style="padding-top:10px;"><a href="#top"><img src="/shop/data/skin/damoashop/img/main/wing_bt_top.jpg" width="30" height="30"></a></div>
</div>

<!-- 스크롤 배너 활성화 -->
<script>scrollBanner();</script>

</td>
<?php }?>
</tr>
</table>

</td>
</tr>
<?php if($this->tpl_['footer_inc']){?>
<tr>
<td><?php $this->print_("footer_inc",$TPL_SCP,1);?></td>
</tr>
<?php }?>
</table>

<!-- 절대! 지우지마세요 : Start -->
<iframe name="ifrmHidden" src='<?php echo $GLOBALS["cfg"]["rootDir"]?>/blank.php' style="display:none;width:100%;height:600"></iframe>
<!-- 절대! 지우지마세요 : End -->

<script>
if (typeof nsGodo_cartTab == 'object' && '<?php echo $GLOBALS["cfg"]["cartTabUse"]?>' == 'y' && '<?php echo $TPL_VAR["todayshop_cfg"]['shopMode']?>' != 'todayshop') {
	nsGodo_cartTab.init({
		logged: <?php if(!$GLOBALS["sess"]){?>false<?php }else{?>true<?php }?>,
		skin  : '<?php echo $GLOBALS["cfg"]["tplSkin"]?>',
		tpl  : '<?php echo $GLOBALS["cfg"]["cartTabTpl"]?>',
		dir	: 'horizon',	// horizon or vertical
		width:'<?php echo $GLOBALS["cfg"]["shopSize"]?>'
	});
}
<?php if($GLOBALS["cfg"]["preventContentsCopy"]=='1'){?>
addOnloadEvent(function(){ preventContentsCopy() });
<?php }?>
</script>
</body>
</html>