<?php /* Template_ 2.2.7 2015/10/11 11:08:19 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/outline/_off_canvas.htm 000002254 */ ?>
<div class="gd-flipcover">
	<div class="gd-member-btn">
<?php if($GLOBALS["sess"]){?>
		<span class="btn"><a href="#" class="btn-register" style="background-color:transparent;text-align:left;" onclick="javascript:goMenu('my');"><?php echo $GLOBALS["member"]["name"]?> ��</a></span>
		<span class="btn"><a href="#" class="btn-login" onclick="javascript:goMenu('logout');">�α׾ƿ�</a></span>
<?php }else{?>
		<span class="btn"><a href="#" class="btn-login" onclick="javascript:goMenu('login');">�α���</a></span>
		<span class="btn"><a href="#" class="btn-register" onclick="javascript:goMenu('join');">ȸ������</a></span>
<?php }?>
		<!-- <span class="btn"><a href="#" class="btn-register" onclick="javascript:location.replace('mem/join.php');">ȸ������</a></span> -->
			
	</div>
	<nav class="gd-gnb">
		<ul class="dep1">
			<li><a href="#" class="item wishlist<?php if(!$GLOBALS["sess"]){?> login<?php }?>">�� ����Ʈ</a></li>
			<li><a href="#" id="viewgoods-btn" onclick="javascript:goMenu('viewgoods');">�ֱ� �� ��ǰ <span class="viewgoods-quantity"></span></a> </li>
			<li class="board-nav"><button type="button" class="btn-reset gnb-arr"><span class="sprite-icon icon-arr-b-white"></span></button>
				<a href="#">�Խ���</a>
				<ul class="dep2" style="display: none;">
					<li class="item"><a href="/m2/goods/review.php">��ǰ�ı�</a></li>
					<li class="item"><a href="/m2/goods/goods_qna_list.php?isAll=Y">��ǰ����</a></li>
					<li class="item"><a href="/m2/board/list.php?id=notice">��������</a></li>
				</ul>
			</li>
			<li class="category-menu-area">
				<button type="button" class="btn-reset gnb-arr" onClick="javascript:showCateMenu(this, '');"><span class="sprite-icon icon-arr-b-white"></span></button>
				<a href="#" id="category-menu" onClick="javascript:showCateMenu(this, '');">ī�װ�</a>
			</li>
		</ul>
	</nav>
</div>
<button class="js-navtoggle gd-gnb-close" style="background-color:#<?php echo $GLOBALS["cfgMobileShop"]["offCanvasBtnColor"]?>;"><span class="sprite-icon icon-x-white"></span></button>
<div class="js-navtoggle gd-flipbg"></div>