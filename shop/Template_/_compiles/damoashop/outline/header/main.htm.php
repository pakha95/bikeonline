<?php /* Template_ 2.2.7 2016/09/29 12:00:53 /www/jbsinttr8192_godo_co_kr/shop/data/skin/damoashop/outline/header/main.htm 000005049 */  $this->include_("dataBanner");?>
<a name="top"></a>
<div id="header_1" align="<?php echo $GLOBALS["cfg"]['shopAlign']?>">
	<div id="top_1" style="width:<?php echo $GLOBALS["cfg"]['shopSize']?>px;">
		<div style="float:left">
		<div id="top_logo"><!-- 배너관리에서 수정가능 --><?php if((is_array($TPL_R1=dataBanner( 90))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></div>
		<div id="top_banner"><!-- 배너관리에서 수정가능 --><?php if((is_array($TPL_R1=dataBanner( 2))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></div>
		</div>
		<div style="float:left">
			<div id="div_search"> 
			<!-- 검색 시작----------------------------------->
				<form action="<?php echo url("goods/goods_search.php")?>&" onsubmit="return chkForm(this)">
					<input type=hidden name=searched value="Y">
					<input type=hidden name=log value="1">
					<input type=hidden name=skey value="all">
					<input type="hidden" name="hid_pr_text" value="<?php echo $GLOBALS["s_type"]['pr_text']?>" />
					<input type="hidden" name="hid_link_url" value="<?php echo $GLOBALS["s_type"]['link_url']?>" />
					<input type="hidden" id="edit" name="edit" value=""/>
<?php if($GLOBALS["s_type"]['keyword_chk']=='on'&&$GLOBALS["s_type"]['pr_text']&&!$_GET['sword']){?>
					<?php
					 $TPL_VAR["id"] = "sword";
					 $TPL_VAR["onkeyup"] = "document.getElementById('edit').value='Y'";
					 $TPL_VAR["onclick"] = "document.getElementById('sword').value=''";
					 $TPL_VAR["value"] =  $GLOBALS["s_type"]['pr_text'];
					?>
<?php }else{?>
					<?php
					 $TPL_VAR["value"] =  $_GET['sword'];
					?>
<?php }?>
					<table cellpadding="0" cellspacing="0" border="0" class="search_table">
						<tr>
							<td class="search_td"><input name=sword type=text id="<?php echo $TPL_VAR["id"]?>" class="search_input" onkeyup="<?php echo $TPL_VAR["onkeyup"]?>" onclick="<?php echo $TPL_VAR["onclick"]?>" value="<?php echo $TPL_VAR["value"]?>" required label="검색어"></td>
							<td>&nbsp;&nbsp;<input type=image src="/shop/data/skin/damoashop/img/main/icon_search.gif" class="search_btn"></td>
						</tr>
					</table>
				</form>
			<!-- 검색 끝--------------------------------------> 
			</div>
		</div>
		<div style="float:right;" class="menubar">
		<ul id="top_menu">
<?php if(!$GLOBALS["sess"]){?>
			<li><a href="<?php echo url("member/login.php")?>&" class="menu"><img src="/shop/data/skin/damoashop/img/main/01login.gif"></a></li>
			<li><a href="<?php echo url("member/join.php")?>&" class="menu"><img src="/shop/data/skin/damoashop/img/main/02join.gif"></a></li>
<?php }else{?>
			<li><a href="<?php echo url("member/logout.php")?>&" class="menu"><img src="/shop/data/skin/damoashop/img/main/01logout.gif"></a></li>
<?php }?>
			<li><a href="<?php echo url("mypage/mypage.php?")?>&&" <?php if($TPL_VAR["useMypageLayerBox"]=='y'){?>onClick="return fnMypageLayerBox(<?php if($GLOBALS["sess"]){?>true<?php }?>);"<?php }?> class="menu"><img src="/shop/data/skin/damoashop/img/main/03mypage.gif"></a></li>
			<li><a href="<?php echo url("goods/goods_cart.php")?>&" class="menu"><img src="/shop/data/skin/damoashop/img/main/04cart.gif"></a></li>
			<li><a href="javascript:chk()" class="menu" id="current"><img src="/shop/data/skin/damoashop/img/main/05board.gif"></a>
				<ul id="dropMenu" >
     				<li><a href="<?php echo url("board/list.php?")?>&id=notice">바이크온라인 소식</a></li>
					<li><a href="<?php echo url("board/list.php?")?>&id=specialorder">특별주문 전용게시판</a></li>
					<li><a href="<?php echo url("board/list.php?")?>&id=inquiry">상품 판매 문의</a></li>
					<li><a href="<?php echo url("board/list.php?")?>&id=qna">묻고 답하기</a></li>
    			</ul>
			</li>
		</ul>
		<div id="top_delivery"><a href="<?php echo url("mypage/mypage_orderlist.php")?>&" class="menu"><img src="/shop/data/skin/damoashop/img/main/delivery.jpg"></a></div>
		<div id="top_delivery"><a href="javascript:popup('/shop/board/view.php?id=dealer&no=2','720','720');" class="menu"><img src="/shop/data/skin/damoashop/img/main/dealer.jpg"></a></div>
		
		</div>
		<div style="background: url('/shop/data/skin/damoashop/img/main/main_top_notice.png') no-repeat;margin-left: 50px;height: 72px;width: 790px;float: left;"></div>		
	</div>
	<!-- <div style="line-height: 1.5em;float: left;position: relative;text-align: left;top: 25px;left: -150px;font-weight:bold;font-size:1.2em;color: #4c4c96;">바이크 온라인의 모든 상품은 관세/부가세나 운송비 등의 <span style="color:#B20000">추가 비용이 없습니다.</span>(헬멧제외)<br>바이크 온라인은 총판 및 딜러계약을 통해 수입하며, 구매대행사가 아닙니다.</div> -->
</div>