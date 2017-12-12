<?php /* Template_ 2.2.7 2017/12/06 13:33:30 /www/jbsinttr8192_godo_co_kr/shop/data/skin/damoashop/main/index.htm 000035246 */  $this->include_("dataPopup","dataBanner","dataGoods","dataDisplayGoods");?>
<?php $this->print_("header",$TPL_SCP,1);?>

<!-- script src="/shop/data/skin/damoashop/jquery.cycle.all.js"></script -->
<script type="text/javascript" src="/shop/data/skin/damoashop/jquery.heum.rolling.js"></script>
<!-- 메인팝업창 -->
<?php if((is_array($TPL_R1=dataPopup())&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?>

<?php if($TPL_V1["type"]=='layer'&&isset($_COOKIE['blnCookie_'.$TPL_V1["code"]])===false){?>
<div id="<?php echo 'blnCookie_'.$TPL_V1["code"]?>" STYLE="position:absolute; width:<?php echo $TPL_V1["width"]?>px; height:<?php echo $TPL_V1["height"]?>px; left:<?php echo $TPL_V1["left"]?>px; top:<?php echo $TPL_V1["top"]?>px; z-index:200;">
	<?php echo eval("\$_GET[code]='blnCookie_".$TPL_V1["code"]."';")?>

	<?php echo $this->define('tpl_include_file_1',$TPL_V1["file"])?> <?php $this->print_("tpl_include_file_1",$TPL_SCP,1);?>

</div>
<?php }?>

<?php if($TPL_V1["type"]=='layerMove'&&isset($_COOKIE['blnCookie_'.$TPL_V1["code"]])===false){?>
<!-- 이동레이어 팝업창 시작 -->
<div id="<?php echo 'blnCookie_'.$TPL_V1["code"]?>" STYLE="position:absolute; width:<?php echo $TPL_V1["width"]?>px; height:<?php echo $TPL_V1["height"]?>px; left:<?php echo $TPL_V1["left"]?>px; top:<?php echo $TPL_V1["top"]?>px; z-index:200;">
	<div onmousedown="Start_move(event,'<?php echo 'blnCookie_'.$TPL_V1["code"]?>');" onmouseup="Moveing_stop();" style='cursor:move;'>
		<table border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td>
					<?php echo eval("\$_GET[code]='blnCookie_".$TPL_V1["code"]."';")?>

					<?php echo $this->define('tpl_include_file_1',$TPL_V1["file"])?> <?php $this->print_("tpl_include_file_1",$TPL_SCP,1);?>

				</td>
			</tr>
		</table>
	</div>
</div>
<!-- 이동레이어 팝업창 끝 -->
<?php }?>

<?php }}?>

<script type="text/javascript"><!--
<?php if((is_array($TPL_R1=dataPopup())&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?>
<?php if($TPL_V1["type"]==''){?>
if ( !getCookie( "blnCookie_<?php echo $TPL_V1["code"]?>" ) ) { // <?php echo $TPL_V1["name"]?> 팝업호출
var property = 'width=<?php echo $TPL_V1["width"]?>, height=<?php echo $TPL_V1["height"]?>, top=<?php echo $TPL_V1["top"]?>, left=<?php echo $TPL_V1["left"]?>, scrollbars=no, toolbar=no';
var win=window.open( './html.php?htmid=<?php echo $TPL_V1["file"]?>&code=blnCookie_<?php echo $TPL_V1["code"]?>', '<?php echo $TPL_V1["code"]?>', property );
if(win) win.focus();
}
<?php }?>
<?php }}?>
//--></script>

<!-- 메인 상단 배너 (배너관리에서 수정가능) -->
<div id="main_top_banner">
	<!-- 메인 비쥬얼 썸네일 시작 -->
	<div id="main_banner">
		<div><a href="/shop/goods/goods_list.php?category=003&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/main/1_how_to_search.png" alt="HowToSearch" ></a></div>
		<div><a href="/shop/goods/goods_list.php?category=024001&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/main/2_akrapovic.jpg" alt="Akrapovic" ></a></div>
		<div><a href="/shop/goods/goods_list.php?&category=004069&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/main/2_mra.jpg" alt="MRA" ></a></div>
		<div><a href="/shop/goods/goods_list.php?category=004004&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/main/2_answer_racing.jpg" alt="Answer Racing" ></a></div>
		<div><a href="/shop/goods/goods_list.php?category=048005&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/main/2_bell.jpg" alt="Bell" ></a></div>
		<div><a href="/shop/goods/goods_list.php?&category=004027&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/main/2_moose_racing.jpg" alt="Moose Racing" ></a></div>
		<div><a href="/shop/goods/goods_list.php?category=004048&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/main/10_thormx.jpg" alt="Thor MX" ></a></div>
		<div><a href="/shop/goods/goods_list.php?category=004106&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/main/2_evotech.jpg" alt="Evotech Performance" ></a></div>
		<div><a href="/shop/goods/goods_list.php?category=048014&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/main/3_nolan.jpg" alt="Nolan" ></a></div>
		<div><a href="/shop/goods/goods_list.php?&category=004033&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/main/4_pro_circuit.jpg" alt="Pro circuit" ></a></div>
		<div><a href="/shop/goods/goods_list.php?category=048024&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/main/1_biltwell.jpg" alt="Biltwell" ></a></div>
		<div><a href="/shop/goods/goods_list.php?category=048023&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/main/2_just1.jpg" alt="Just1" ></a></div>

		<!--
		<div><img name="n2_thor_ansr_msr_moose" src="/shop/data/skin/damoashop/img/main/2_thor_ansr_msr_moose.png" width="790" height="459" id="n2_thor_ansr_msr_moose" usemap="#m_2_thor_ansr_msr_moose" alt="" />
			<map name="m_2_thor_ansr_msr_moose" id="m_2_thor_ansr_msr_moose">
				<area shape="rect" coords="0,245,408,459" href="/shop/goods/goods_list.php?category=004028&amp;sort=goodsnm" target="_self" title="MSR" alt="MSR" />
				<area shape="rect" coords="414,246,790,459" href="/shop/goods/goods_list.php?category=004027&amp;sort=goodsnm" target="_self" title="Moose racing" alt="Moose racing" />
				<area shape="rect" coords="383,0,790,240" href="/shop/goods/goods_list.php?category=004004&amp;sort=goodsnm" target="_self" title="ANSR" alt="ANSR" />
				<area shape="rect" coords="0,0,377,240" href="/shop/goods/goods_list.php?category=004048&amp;sort=goodsnm" target="_self" title="Thor" alt="Thor" />
			</map>
		</div>
		-->
	</div>

	<script src="/shop/lib/js/ierotator.js" type="text/javascript"></script>
	<script type='text/javascript'>
	var config = {
		'id':'main_banner',
		'effect':'FILTER: progid:DXImageTransform.Microsoft.Fade(Overlap=0.25,Duration=0.7)',
		'width':790,
		'height':459,
		'wait':3000,
		'numDisplay':'block',
		'numimg':[
			['/shop/data/skin/damoashop/img/main/main_rolling_on.png','/shop/data/skin/damoashop/img/main/main_rolling_off.png'],
			['/shop/data/skin/damoashop/img/main/main_rolling_on.png','/shop/data/skin/damoashop/img/main/main_rolling_off.png'],
			['/shop/data/skin/damoashop/img/main/main_rolling_on.png','/shop/data/skin/damoashop/img/main/main_rolling_off.png'],
			['/shop/data/skin/damoashop/img/main/main_rolling_on.png','/shop/data/skin/damoashop/img/main/main_rolling_off.png'],
			['/shop/data/skin/damoashop/img/main/main_rolling_on.png','/shop/data/skin/damoashop/img/main/main_rolling_off.png'],
			['/shop/data/skin/damoashop/img/main/main_rolling_on.png','/shop/data/skin/damoashop/img/main/main_rolling_off.png'],
			['/shop/data/skin/damoashop/img/main/main_rolling_on.png','/shop/data/skin/damoashop/img/main/main_rolling_off.png'],
			['/shop/data/skin/damoashop/img/main/main_rolling_on.png','/shop/data/skin/damoashop/img/main/main_rolling_off.png'],
			['/shop/data/skin/damoashop/img/main/main_rolling_on.png','/shop/data/skin/damoashop/img/main/main_rolling_off.png'],
			['/shop/data/skin/damoashop/img/main/main_rolling_on.png','/shop/data/skin/damoashop/img/main/main_rolling_off.png'],
			['/shop/data/skin/damoashop/img/main/main_rolling_on.png','/shop/data/skin/damoashop/img/main/main_rolling_off.png'],
			['/shop/data/skin/damoashop/img/main/main_rolling_on.png','/shop/data/skin/damoashop/img/main/main_rolling_off.png'],
			['/shop/data/skin/damoashop/img/main/main_rolling_on.png','/shop/data/skin/damoashop/img/main/main_rolling_off.png'],
		]
	}
	ier = new ierotator(config);
	</script>


	<!-- 메인 비쥬얼 썸네일 끝 -->
</div>

<div id="main_top_banner2" style="WIDTH: 790px; OVERFLOW-X: hidden">
	<!-- 메인 배너 영역 --><?php if((is_array($TPL_R1=dataBanner( 3))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?>
<?php if($GLOBALS["sess"]["level"]>='100'){?>

<?php if((is_array($TPL_R1=dataGoods( 002, 1, 20))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?>
	<?php echo $TPL_V1["goodsnm"]?>

<?php }}?>
<?php }?>

	<script type="text/javascript">
	/*
	$(document).ready(function() {
    	$('.slideshow').cycle({
			fx: 'fade' // choose your transition type, ex: fade, scrollUp, shuffle, etc...
		});
	});
	*/
	<!--
	$(document).ready(function() {
//$(window).load(function(){
        $("#rolling1").heumRolling({
                groupsize : 750
        });
		$("#rolling2").heumRolling({
                groupsize : 750,rolling : "prev"
        });

		$("#rolling1").mouseenter(function(){
			$("#rolling1").heumRolling().pause();
		});
		$("#rolling1").mouseleave(function(){
			$("#rolling1").heumRolling().start();
		});
		$("#rolling2").mouseenter(function(){
			$("#rolling2").heumRolling().pause();
		});
		$("#rolling2").mouseleave(function(){
			$("#rolling2").heumRolling().start();
		});
});
	//-->
	</script>

<!-- 카테고리1번 : 시작 -->
<div style="border-bottom:2px solid grey;TEXT-ALIGN: left"><a href="<?php echo url("goods/goods_list.php?")?>&category=002&sort=goodsnm"><span style="font-weight:bold;font-size:1.2em;">특별할인상품</span></a><a href="<?php echo url("goods/goods_list.php?")?>&category=002&sort=goodsnm"><span class="banner_more">더보기</span></a></div>
	<div id="rolling1" style="padding:0px 20px;">
     <ul class="heum-item-group" >

<?php if((is_array($TPL_R1=dataGoods('002','', 20))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?>
		<li class="item" style="margin:10px;width:130px;word-break:break-all;white-space:pre-line;text-align:center;"><a href="<?php echo url("goods/goods_view.php?")?>&goodsno=<?php echo $TPL_V1["goodsno"]?>"><?php echo goodsimg($TPL_V1["img_s"], 130)?></a><br><a href="<?php echo url("goods/goods_view.php?")?>&goodsno=<?php echo $TPL_V1["goodsno"]?>"><?php echo $TPL_V1["goodsnm"]?><br><?php if($TPL_V1["consumer"]){?><strike><?php echo number_format($TPL_V1["consumer"])?></strike>↓<br><?php }?><b><?php echo number_format($TPL_V1["price"])?>원</b></a>
		</li>
<?php }}?>
     </ul>
	</div>
<!-- 카테고리1번 : 끝 -->

<!-- 카테고리2번 : 시작 -->
<div style="border-bottom:2px solid grey;TEXT-ALIGN: left"><a href="<?php echo url("goods/goods_list.php?")?>&category=050&sort=goodsnm"><span style="font-weight:bold;font-size:1.2em;">국내재고상품</span></a><a href="<?php echo url("goods/goods_list.php?")?>&category=050&sort=goodsnm"><span class="banner_more">더보기</span></a></div>
	<div id="rolling2" style="padding:0px 20px;">
     <ul class="heum-item-group" >
<?php if((is_array($TPL_R1=dataGoods('050','', 20))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?>
		<li class="item" style="margin:10px;width:130px;word-break:break-all;white-space:pre-line;text-align:center;"><a href="<?php echo url("goods/goods_view.php?")?>&goodsno=<?php echo $TPL_V1["goodsno"]?>"><?php echo goodsimg($TPL_V1["img_s"], 130)?></a><br><a href="<?php echo url("goods/goods_view.php?")?>&goodsno=<?php echo $TPL_V1["goodsno"]?>"><?php echo $TPL_V1["goodsnm"]?><br><b><?php echo number_format($TPL_V1["price"])?>원</b></a>
		</li>
<?php }}?>
     </ul>
	</div>
<!-- 카테고리2번 : 끝 -->
<!--
	<div class="slideshow">
		<img src="http://malsup.github.com/images/beach1.jpg" width="200" height="200" />
		<img src="http://malsup.github.com/images/beach2.jpg" width="200" height="200" />
		<img src="http://malsup.github.com/images/beach3.jpg" width="200" height="200" />
		<img src="http://malsup.github.com/images/beach4.jpg" width="200" height="200" />
		<img src="http://malsup.github.com/images/beach5.jpg" width="200" height="200" />
	</div>
-->
<!-- <div class="contents"> -->
<?php if($GLOBALS["cfg_step"][ 0]["chk"]){?>
		<?php echo $this->assign('loop',dataDisplayGoods( 0,$GLOBALS["cfg_step"][ 0]["img"],$GLOBALS["cfg_step"][ 0]["page_num"]))?>

		<?php echo $this->assign('cols',$GLOBALS["cfg_step"][ 0]["cols"])?>

		<?php echo $this->assign('size',$GLOBALS["cfg"][$GLOBALS["cfg_step"][ 0]["img"]])?>

		<?php echo $this->assign('id',"main_list_01")?>

		<?php echo $this->assign('dpCfg',$GLOBALS["cfg_step"][ 0])?>

		<?php echo $this->define('tpl_include_file_3',"goods/list/".$GLOBALS["cfg_step"][ 0]["tpl"].".htm")?> <?php $this->print_("tpl_include_file_3",$TPL_SCP,1);?>

<?php }?>
<!-- </div> -->
</div>
<div id="brand_banner">
	<ul>
		<li><a href="/shop/goods/goods_list.php?category=004001&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/100.jpg" width="191" height="63" alt="100%"/></a></li>
<!--		<li><a href="/shop/goods/goods_list.php?category=004002&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/acerbis.jpg" width="191" height="63"  alt="Acerbis"/></a></li> -->
		<li><a href="/shop/goods/goods_list.php?category=024010&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/ac.jpg" width="191" height="63"  alt="Ac"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=048001&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/afx.jpg" width="191" height="63"  alt="AFX"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=048002&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/agv.jpg" width="191" height="63"  alt="AGV"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=024001&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/akrapovic.jpg" width="191" height="63"  alt="Akrapovic"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004061&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/alpha Racing.jpg" width="191" height="63"  alt="Alpha Racing"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=031005&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/alpina.jpg" width="191" height="63"  alt="Alpina"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004003&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/alpinestars.jpg"  width="191" height="63" alt="Alpinestars"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004004&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/answer Racing.jpg"  width="191" height="63" alt="Answer Racing"/></a></li>
<!--		<li><a href="/shop/goods/goods_list.php?category=048004&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/arai.jpg"  width="191" height="63" alt="Arai"/></a></li> -->
		<li><a href="/shop/goods/goods_list.php?category=024002&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/arrow.jpg"  width="191" height="63" alt="Arrow"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004091&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/atlas.png"  width="191" height="63" alt="Atlas"/></a></li>
<!--		<li><a href="/shop/goods/goods_list.php?category=004005#"><img src="/shop/data/skin/damoashop/img/banner/s_banner/axo.jpg" alt="Axo"/></a></li> -->
		<li><a href="/shop/goods/goods_list.php?category=004007&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/barkbusters.jpg"  width="191" height="63" alt="Barkbusters"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=048005&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/bell.jpg"  width="191" height="63" alt="Bell"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=025001&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/bestem.jpg"  width="191" height="63" alt="Bestem USA"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=048024&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/biltwell.png"  width="191" height="63" alt="Biltwell"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004060&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/bmw.jpg"  width="191" height="63" alt="BMW"/></a></li>
<!--		<li><a href="/shop/goods/goods_list.php?category=026001"><img src="/shop/data/skin/damoashop/img/banner/s_banner/braking.jpg" alt="Braking"/></a></li> -->
		<li><a href="/shop/goods/goods_list.php?category=004009&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/brembo.jpg"  width="191" height="63" alt="Brembo"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004010&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/crg.jpg"  width="191" height="63" alt="CRG"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004011&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/dainese.jpg"  width="191" height="63" alt="Dainese"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004099&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/denali.png"  width="191" height="63" alt="Denali"/></a></li>
<!--		<li><a href="/shop/goods/goods_list.php?category=030001&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/denso.jpg"  width="191" height="63" alt="Denso"/></a></li> -->

		<li><a href="/shop/goods/goods_list.php?category=004066&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/ducati.jpg"  width="191" height="63" alt="Ducati"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=026004&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/ebc.jpg"  width="191" height="63" alt="EBC"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004096&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/eks.png"  width="191" height="63" alt="EKS"/></a></li>
		<li><a href="/shop/goods/goods_list.php?&category=004106&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/evotech2.png"  width="191" height="63" alt="Evotech Performance"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004013&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/evs.jpg"  width="191" height="63" alt="EVS"/></a></li>
<!--	<li><a href="/shop/goods/goods_list.php?category=026005&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/ferodo.jpg"  width="191" height="63" alt="Ferodo"/></a></li> -->
		<li><a href="/shop/goods/goods_list.php?category=004014&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/firstgear.jpg"  width="191" height="63" alt="Firstgear"/></a></li>
<!--		<li><a href="/shop/goods/goods_list.php?category=004015&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/fox.jpg"  width="191" height="63" alt="Fox"/></a></li> -->
		<li><a href="/shop/goods/goods_list.php?category=004016&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/gaerne.jpg"  width="191" height="63" alt="Gaerne"/></a></li>
<!--		<li><a href="/shop/goods/goods_list.php?category=004017"><img src="/shop/data/skin/damoashop/img/banner/s_banner/gilles.jpg" alt="Gilles"/></a></li> -->
		<li><a href="/shop/goods/goods_list.php?category=004018&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/gimoto.jpg"  width="191" height="63" alt="Gimoto"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004019&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/givi.jpg"  width="191" height="63" alt="Givi"/></a></li>
<!--	<li><a href="/shop/goods/goods_list.php?category=048025&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/gpa.jpg"  width="191" height="63" alt="GPA"/></a></li> -->
		<li><a href="/shop/goods/goods_list.php?category=024012&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/gpr.jpg"  width="191" height="63" alt="GPR"/></a></li>
		<li><a href="/shop/goods/goods_list.php?&category=004107&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/hebo.png"  width="191" height="63" alt="Hebo"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004020&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/hepco.jpg"  width="191" height="63" alt="Hepco & Becker"/></a></li>
<!--	<li><a href="/shop/goods/goods_list.php?category=004059&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/hinson.jpg" width="191" height="63" alt="Hinson"/></a></li> -->

		<li><a href="/shop/goods/goods_list.php?category=004062&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/hornig.jpg" width="191" height="63"  alt="Hornig"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004022&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/icon.jpg" width="191" height="63"  alt="Icon"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=025015&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/ilmberger.png" width="191" height="63"  alt="Ilmberger"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004063&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/llium.jpg" width="191" height="63"  alt="Ilium Works"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=055002&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/ims.jpg" width="191" height="63"  alt="IMS"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=048023&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/just1.png" width="191" height="63"  alt="Just1"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=031006&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/kineo.jpg " width="191" height="63"  alt="Kineo "/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004024&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/klim.jpg" width="191" height="63"  alt="Klim"/></a></li>
<!--		<li><a href="/shop/goods/goods_list.php?category=004067"><img src="/shop/data/skin/damoashop/img/banner/s_banner/ktm.jpg" alt="KTM"/></a></li> -->
		<li><a href="/shop/goods/goods_list.php?category=004025&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/leatt.jpg" width="191" height="63"  alt="Leatt"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=024004&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/leo.jpg" width="191" height="63"  alt="Leo Vince"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=024005&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/m4.jpg" width="191" height="63"  alt="M4"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004026&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/machineart.jpg" width="191" height="63"  alt="Machine Art Moto"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004094&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/magura.png" width="191" height="63"  alt="Magura"/></a></li>

		<li><a href="/shop/goods/goods_list.php?category=004029&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/maier.jpg" width="191" height="63"  alt="Maier USA"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=024011&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/mivv.jpg" width="191" height="63"  alt="Mivv"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004092&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/mobius.png" width="191" height="63"  alt="Mobius"/></a></li>
		<li><a href="/shop/goods/goods_list.php?&category=048025&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/momodesign.png" width="191" height="63"  alt="Momodesign"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004027&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/moose.jpg" width="191" height="63"  alt="Moose Racing"/></a></li>
<!--		<li><a href="/shop/goods/goods_list.php?category=026006&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/motozen.jpg" width="191" height="63"  alt="Motozen"/></a></li> -->
		<li><a href="/shop/goods/goods_list.php?category=004069&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/mra.jpg" width="191" height="63"  alt="MRA"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004028&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/msr.jpg" width="191" height="63"  alt="MSR Racing"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=048014&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/nolan.jpg"  width="191" height="63" alt="Nolan"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004031&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/ogio.jpg"  width="191" height="63" alt="Ogio"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=031007&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/oz.jpg"  width="191" height="63" alt="Oz"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=030003&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/piaa.jpg" width="191" height="63"  alt="Piaa"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004033&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/procircuit.jpg"  width="191" height="63" alt="Pro Circuit"/></a></li>
<!--		<li><a href="/shop/goods/goods_list.php?category=004034&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/progrip.jpg"  width="191" height="63" alt="Pro grip"/></a></li> -->

		<li><a href="/shop/goods/goods_list.php?category=004035&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/psr.jpg"  width="191" height="63" alt="PSR"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004058&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/puig.jpg"  width="191" height="63" alt="Puig"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004075&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/pyramid.jpg"  width="191" height="63" alt="Pyramid"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=024006&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/remus.jpg"  width="191" height="63" alt="Remus"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004040&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/renthal.jpg"  width="191" height="63" alt="Renthal"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004057&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/revit.jpg"  width="191" height="63" alt="Revit"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004068&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/rizoma.jpg"  width="191" height="63" alt="Rizoma"/></a></li>
<!--	<li><a href="/shop/goods/goods_list.php?category=004037&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/rk.png"  width="191" height="63" alt="RK"/></a></li> -->
		<li><a href="/shop/goods/goods_list.php?category=004100&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/roland_sands.png"  width="191" height="63" alt="Roland Sands Design"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004101&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/rotopax.jpg"  width="191" height="63" alt="Rotopax"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004038&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/rox.jpg"  width="191" height="63" alt="Rox"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=048016&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/schuberth.jpg"  width="191" height="63" alt="Schuberth"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004041&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/scott.jpg"  width="191" height="63" alt="Scott"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=048017&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/shoei.jpg"  width="191" height="63" alt="Shoei"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004103&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/sidi.png"  width="191" height="63" alt="Sidi"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004098&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/sixsixone.png"  width="191" height="63" alt="Sixsixone"/></a></li>
<!--	<li><a href="/shop/goods/goods_list.php?category=004044&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/spidi.jpg"  width="191" height="63" alt="Spidi"/></a></li> -->
		<li><a href="/shop/goods/goods_list.php?category=004046&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/stompgrip.jpg"  width="191" height="63" alt="Stompgrip"/></a></li>

		<!-- <li><a href="/shop/goods/goods_list.php?category=044"><img src="/shop/data/skin/damoashop/img/banner/s_banner/suzuk.jpg" alt="Suzuk"/></a></li> -->
<!--		<li><a href="/shop/goods/goods_list.php?category=048018&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/suomy.jpg"  width="191" height="63" alt="Suomy"/></a></li> -->
		<li><a href="/shop/goods/goods_list.php?category=004047&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/sw-motech.jpg"  width="191" height="63" alt="SW-Motech"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004097&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/techmount.png"  width="191" height="63" alt="Techmount"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=027007005&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/techspec.jpg"  width="191" height="63" alt="Techspec"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=024007&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/termignoni.jpg"  width="191" height="63" alt="Termignoni"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004051&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/touratech.jpg"  width="191" height="63" alt="Touratech"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004048&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/thor.jpg" width="191" height="63"  alt="Thor"/></a></li>
<!--	<li><a href="/shop/goods/goods_list.php?category=004050&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/troylee.jpg"  width="191" height="63" alt="Troy Lee Designs"/></a></li> -->
		<li><a href="/shop/goods/goods_list.php?&category=024008&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/twobrothers.jpg" width="191" height="63"  alt="Two Brothers"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004053&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/vortex.jpg" width="191" height="63" alt="Vortex"/></a></li>

		<li><a href="/shop/goods/goods_list.php?category=004105&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/wunderlich.png" alt="Wunderlich"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=024009&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/yoshimura.jpg" width="191" height="63"  alt="Yoshimura"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004095&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/zard.png"  width="191" height="63" alt="Zard"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=025008&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/zero.jpg"  width="191" height="63" alt="Zero Gravity"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004065&sort=goodsnm"><img src="/shop/data/skin/damoashop/img/banner/s_banner/ztechnik.jpg"  width="191" height="63" alt="Ztechnik"/></a></li>

	</ul>

</div>
<?php if($GLOBALS["sess"]["level"]>='100'){?>
<!-- <div id="main_contents">
	<div id="new_arrival">
		<div class="title"><a href="<?php echo url("goods/goods_grp_01.php")?>&"><img src="/shop/data/skin/damoashop/img/main/newarrival.gif"></a></div>
		<div class="contents"> -->
<?php if($GLOBALS["cfg_step"][ 0]["chk"]){?>
		<?php echo $this->assign('loop',dataDisplayGoods( 0,$GLOBALS["cfg_step"][ 0]["img"],$GLOBALS["cfg_step"][ 0]["page_num"]))?>

		<?php echo $this->assign('cols',$GLOBALS["cfg_step"][ 0]["cols"])?>

		<?php echo $this->assign('size',$GLOBALS["cfg"][$GLOBALS["cfg_step"][ 0]["img"]])?>

		<?php echo $this->assign('id',"main_list_01")?>

		<?php echo $this->assign('dpCfg',$GLOBALS["cfg_step"][ 0])?>

		<?php echo $this->define('tpl_include_file_3',"goods/list/".$GLOBALS["cfg_step"][ 0]["tpl"].".htm")?> <?php $this->print_("tpl_include_file_3",$TPL_SCP,1);?>

<?php }?>
		<!-- </div>
	</div> -->
	<!-- <div id="best_item">
		<div class="title"><a href="<?php echo url("goods/goods_grp_03.php")?>&"><img src="/shop/data/skin/damoashop/img/main/bestitem.gif"></a></div>
		<div class="contents"> -->
<?php if($GLOBALS["cfg_step"][ 2]["chk"]){?>
		<?php echo $this->assign('loop',dataDisplayGoods( 2,$GLOBALS["cfg_step"][ 2]["img"],$GLOBALS["cfg_step"][ 2]["page_num"]))?>

		<?php echo $this->assign('cols',$GLOBALS["cfg_step"][ 2]["cols"])?>

		<?php echo $this->assign('size',$GLOBALS["cfg"][$GLOBALS["cfg_step"][ 2]["img"]])?>

		<?php echo $this->assign('id',"main_list_03")?>

		<?php echo $this->assign('dpCfg',$GLOBALS["cfg_step"][ 2])?>

		<?php echo $this->define('tpl_include_file_5',"goods/list/".$GLOBALS["cfg_step"][ 2]["tpl"].".htm")?> <?php $this->print_("tpl_include_file_5",$TPL_SCP,1);?>

<?php }?>
		<!-- </div>
	</div>
</div -->
<?php }?>

<!-- 멀티 팝업 -->
<script type="text/javascript" src="/shop/data/skin/damoashop/proc/multi_popup.js"></script>
<script type="text/javascript">multiPopup('<?php echo $GLOBALS["cfg"]["tplSkin"]?>');</script>

<?php $this->print_("footer",$TPL_SCP,1);?>
