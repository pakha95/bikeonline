<?php /* Template_ 2.2.7 2016/11/08 15:35:58 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/goods/category.htm 000001611 */ 
if (is_array($TPL_VAR["loop"])) $TPL_loop_1=count($TPL_VAR["loop"]); else if (is_object($TPL_VAR["loop"]) && in_array("Countable", class_implements($TPL_VAR["loop"]))) $TPL_loop_1=$TPL_VAR["loop"]->count();else $TPL_loop_1=0;?>
<?php $this->print_("header",$TPL_SCP,1);?>


<?php if($TPL_VAR["page_title"]){?>
<?php $this->print_("sub_header",$TPL_SCP,1);?>

<?php }?>

<script type="text/javascript">

$(document).ready(function(){

});

</script>
<section id="categorylist" class="content">
	<nav class="gd-gnb">
		<ul class="dep1">
			<li>
				<ul class="dep2">
<?php if($TPL_loop_1){foreach($TPL_VAR["loop"] as $TPL_V1){?>
<?php if($TPL_V1["category"]!="051"&&$TPL_V1["category"]!="052"&&$TPL_V1["category"]!="053"&&$TPL_V1["category"]!="054"){?>
					<li class="category-menu-area">
						<button type="button" class="btn-reset gnb-arr" onClick="goCate('<?php echo $TPL_V1["category"]?>')"><span class="sprite-icon icon-arr-b-white"></span></button>
<?php if($TPL_V1["sub_count"]> 0){?>
						<a href="#" onClick="javascript:showCateMenu(this, '<?php echo $TPL_V1["category"]?>');" class="sub-icon"><span class="sprite-icon icon-plus1"></span><?php echo $TPL_V1["catnm"]?></a>
<?php }else{?>
						<a href="#" onClick="goCate('<?php echo $TPL_V1["category"]?>')"><?php echo $TPL_V1["catnm"]?></a>
<?php }?>
					</li>
<?php }?>
<?php }}?>
				</ul>
			</li>
		</ul>
	</nav>
</section>

<?php $this->print_("footer",$TPL_SCP,1);?>