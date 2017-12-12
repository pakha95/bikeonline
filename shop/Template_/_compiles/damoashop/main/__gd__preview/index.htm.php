<?php /* Template_ 2.2.7 2015/09/20 22:46:58 /www/jbsinttr8192_godo_co_kr/shop/data/skin/damoashop/main/index.htm 000019529 */  $this->include_("dataPopup","dataBanner","dataDisplayGoods");?>
<?php $this->print_("header",$TPL_SCP,1);?>


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

<script language="JavaScript"><!--
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
		<div><a href="/shop/goods/goods_list.php?category=004018"><img src="/shop/data/skin/damoashop/img/main/gimoto.jpg"></a></div>
		<div><a href="/shop/goods/goods_list.php?category=004060"><img src="/shop/data/skin/damoashop/img/main/bmw.jpg"></a></div>
		<div><a href="/shop/goods/goods_list.php?category=004066"><img src="/shop/data/skin/damoashop/img/main/ducati.jpg"></a></div>
		<div><a href="http://moto.brembo.com/en"><img src="/shop/data/skin/damoashop/img/main/brembo.jpg"></a></div>
		<div><a href="/shop/goods/goods_list.php?category=004026"><img src="/shop/data/skin/damoashop/img/main/mamo.jpg"></a></div>
		<div><a href="/shop/goods/goods_list.php?category=004051"><img src="/shop/data/skin/damoashop/img/main/touratech.jpg"></a></div>
		
	</div>
	<!--<img src="/shop/data/skin/damoashop/img/main/main2.jpg"/>-->
	<script src="/shop/lib/js/ierotator.js" type="text/javascript"></script>
	<script>
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
		]
	}
	ier = new ierotator(config);
	</script>
	<!-- 메인 비쥬얼 썸네일 끝 -->
</div>
<div id="main_top_banner2">
	<!-- 메인 배너 영역 --><?php if((is_array($TPL_R1=dataBanner( 3))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?>
</div>
<div id="brand_banner">
	<ul>
		<li><a href="/shop/goods/goods_list.php?&category=004001"><img src="/shop/data/skin/damoashop/img/banner/s_banner/100.jpg" alt="100%"/></a></li>
		<li><a href="/shop/goods/goods_list.php?&category=004002"><img src="/shop/data/skin/damoashop/img/banner/s_banner/acerbis.jpg" alt="Acerbis"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=048001"><img src="/shop/data/skin/damoashop/img/banner/s_banner/afx.jpg" alt="AFX"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=048002"><img src="/shop/data/skin/damoashop/img/banner/s_banner/agv.jpg" alt="AGV"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=024001"><img src="/shop/data/skin/damoashop/img/banner/s_banner/akrapovic.jpg" alt="Akrapovic"/></a></li>
		<li><a href="/shop/goods/goods_list.php?&category=004061"><img src="/shop/data/skin/damoashop/img/banner/s_banner/alpha Racing.jpg" alt="Alpha Racing"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004003"><img src="/shop/data/skin/damoashop/img/banner/s_banner/alpinestars.jpg" alt="Alpinestars"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004004"><img src="/shop/data/skin/damoashop/img/banner/s_banner/answer Racing.jpg" alt="Answer Racing"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=048004"><img src="/shop/data/skin/damoashop/img/banner/s_banner/arai.jpg" alt="Arai"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=024002"><img src="/shop/data/skin/damoashop/img/banner/s_banner/arrow.jpg" alt="Arrow"/></a></li>
		
		
		<li><a href="/shop/goods/goods_list.php?category=004005#"><img src="/shop/data/skin/damoashop/img/banner/s_banner/axo.jpg" alt="Axo"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004007"><img src="/shop/data/skin/damoashop/img/banner/s_banner/barkbusters.jpg" alt="Barkbusters"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=048005"><img src="/shop/data/skin/damoashop/img/banner/s_banner/bell.jpg" alt="Bell"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=025001"><img src="/shop/data/skin/damoashop/img/banner/s_banner/bestem.jpg" alt="Bestem USA"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004060"><img src="/shop/data/skin/damoashop/img/banner/s_banner/bmw.jpg" alt="BMW"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=026001"><img src="/shop/data/skin/damoashop/img/banner/s_banner/braking.jpg" alt="Braking"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004009"><img src="/shop/data/skin/damoashop/img/banner/s_banner/brembo.jpg" alt="Brembo"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004010"><img src="/shop/data/skin/damoashop/img/banner/s_banner/crg.jpg" alt="CRG"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004011"><img src="/shop/data/skin/damoashop/img/banner/s_banner/dainese.jpg" alt="Dainese"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=030001"><img src="/shop/data/skin/damoashop/img/banner/s_banner/denso.jpg" alt="Denso"/></a></li>
		
		<li><a href="/shop/goods/goods_list.php?category=004066"><img src="/shop/data/skin/damoashop/img/banner/s_banner/ducati.jpg" alt="Ducati"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=026004"><img src="/shop/data/skin/damoashop/img/banner/s_banner/ebc.jpg" alt="EBC"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004013"><img src="/shop/data/skin/damoashop/img/banner/s_banner/evs.jpg" alt="EVS"/></a></li>
		<li><a href="/shop/goods/goods_list.php?&category=026005"><img src="/shop/data/skin/damoashop/img/banner/s_banner/ferodo.jpg" alt="Ferodo"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004014"><img src="/shop/data/skin/damoashop/img/banner/s_banner/firstgear.jpg" alt="Firstgear"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004015"><img src="/shop/data/skin/damoashop/img/banner/s_banner/fox.jpg" alt="Fox"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004017"><img src="/shop/data/skin/damoashop/img/banner/s_banner/gilles.jpg" alt="Gilles"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004018"><img src="/shop/data/skin/damoashop/img/banner/s_banner/gimoto.jpg" alt="Gimoto"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004019"><img src="/shop/data/skin/damoashop/img/banner/s_banner/givi.jpg" alt="Givi"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004020"><img src="/shop/data/skin/damoashop/img/banner/s_banner/hepco.jpg" alt="Hepco & Becker"/></a></li>
		
		<li><a href="/shop/goods/goods_list.php?category=004062"><img src="/shop/data/skin/damoashop/img/banner/s_banner/hornig.jpg" alt="Hornig"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004022"><img src="/shop/data/skin/damoashop/img/banner/s_banner/icon.jpg" alt="Icon"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004016"><img src="/shop/data/skin/damoashop/img/banner/s_banner/gaerne.jpg" alt="Gaerne"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004063"><img src="/shop/data/skin/damoashop/img/banner/s_banner/llium.jpg" alt="Ilium Works"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004024"><img src="/shop/data/skin/damoashop/img/banner/s_banner/klim.jpg" alt="Klim"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004067"><img src="/shop/data/skin/damoashop/img/banner/s_banner/ktm.jpg" alt="KTM"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004025"><img src="/shop/data/skin/damoashop/img/banner/s_banner/leatt.jpg" alt="Leatt"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=024004"><img src="/shop/data/skin/damoashop/img/banner/s_banner/leo.jpg" alt="Leo Vince"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=024005"><img src="/shop/data/skin/damoashop/img/banner/s_banner/m4.jpg" alt="M4"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004026"><img src="/shop/data/skin/damoashop/img/banner/s_banner/machineart.jpg" alt="Machine Art Moto"/></a></li>
		
		<li><a href="/shop/goods/goods_list.php?category=004029"><img src="/shop/data/skin/damoashop/img/banner/s_banner/maier.jpg" alt="Maier USA"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004027"><img src="/shop/data/skin/damoashop/img/banner/s_banner/moose.jpg" alt="Moose Racing"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=026006"><img src="/shop/data/skin/damoashop/img/banner/s_banner/motozen.jpg" alt="Motozen"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=025005"><img src="/shop/data/skin/damoashop/img/banner/s_banner/mra.jpg" alt="MRA"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004028"><img src="/shop/data/skin/damoashop/img/banner/s_banner/msr.jpg" alt="MSR Racing"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=048014"><img src="/shop/data/skin/damoashop/img/banner/s_banner/nolan.jpg" alt="Nolan"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004031"><img src="/shop/data/skin/damoashop/img/banner/s_banner/ogio.jpg" alt="Ogio"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=030003"><img src="/shop/data/skin/damoashop/img/banner/s_banner/piaa.jpg" alt="Piaa"/></a></li>		
		<li><a href="/shop/goods/goods_list.php?category=004033"><img src="/shop/data/skin/damoashop/img/banner/s_banner/procircuit.jpg" alt="Pro Circuit"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004034"><img src="/shop/data/skin/damoashop/img/banner/s_banner/progrip.jpg" alt="Pro grip"/></a></li>
		
		<li><a href="/shop/goods/goods_list.php?category=004035"><img src="/shop/data/skin/damoashop/img/banner/s_banner/psr.jpg" alt="PSR"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004058"><img src="/shop/data/skin/damoashop/img/banner/s_banner/puig.jpg" alt="Puig"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=025006"><img src="/shop/data/skin/damoashop/img/banner/s_banner/pyramid.jpg" alt="Pyramid"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=024006"><img src="/shop/data/skin/damoashop/img/banner/s_banner/remus.jpg" alt="Remus"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004040"><img src="/shop/data/skin/damoashop/img/banner/s_banner/renthal.jpg" alt="Renthal"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004057"><img src="/shop/data/skin/damoashop/img/banner/s_banner/revit.jpg" alt="Revit"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=025007"><img src="/shop/data/skin/damoashop/img/banner/s_banner/rizoma.jpg" alt="Rizoma"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004038"><img src="/shop/data/skin/damoashop/img/banner/s_banner/rox.jpg" alt="Rox"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=048016"><img src="/shop/data/skin/damoashop/img/banner/s_banner/schuberth.jpg" alt="Schuberth"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004041"><img src="/shop/data/skin/damoashop/img/banner/s_banner/scott.jpg" alt="Scott"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=048017"><img src="/shop/data/skin/damoashop/img/banner/s_banner/shoei.jpg" alt="Shoei"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004043"><img src="/shop/data/skin/damoashop/img/banner/s_banner/sidi.jpg" alt="Sidi"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004044"><img src="/shop/data/skin/damoashop/img/banner/s_banner/spidi.jpg" alt="Spidi"/></a></li>
		
		<!--<li><a href="/shop/goods/goods_list.php?&category=044"><img src="/shop/data/skin/damoashop/img/banner/s_banner/suzuk.jpg" alt="Suzuk"/></a></li>-->
		<li><a href="/shop/goods/goods_list.php?category=048018"><img src="/shop/data/skin/damoashop/img/banner/s_banner/suomy.jpg" alt="Suomy"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004047"><img src="/shop/data/skin/damoashop/img/banner/s_banner/sw-motech.jpg" alt="SW-Motech"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=024007"><img src="/shop/data/skin/damoashop/img/banner/s_banner/termignoni.jpg" alt="Termignoni"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004051"><img src="/shop/data/skin/damoashop/img/banner/s_banner/touratech.jpg" alt="Touratech"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004048"><img src="/shop/data/skin/damoashop/img/banner/s_banner/thor.jpg" alt="Thor"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004050"><img src="/shop/data/skin/damoashop/img/banner/s_banner/troylee.jpg" alt="Troy Lee Designs"/></a></li>
		<li><a href="/shop/goods/goods_list.php?&category=024008"><img src="/shop/data/skin/damoashop/img/banner/s_banner/twobrothers.jpg" alt="Two Brothers"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004052"><img src="/shop/data/skin/damoashop/img/banner/s_banner/vonzipper.jpg" alt="Von Zipper"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004053"><img src="/shop/data/skin/damoashop/img/banner/s_banner/vortex.jpg" alt="Vortex"/></a></li>
		
		<li><a href="/shop/goods/goods_list.php?category=004064"><img src="/shop/data/skin/damoashop/img/banner/s_banner/wunderlich.jpg" alt="Wunderlich"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=024009"><img src="/shop/data/skin/damoashop/img/banner/s_banner/yoshimura.jpg" alt="Yoshimura"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=025008"><img src="/shop/data/skin/damoashop/img/banner/s_banner/zero.jpg" alt="Zero Gravity"/></a></li>
		<li><a href="/shop/goods/goods_list.php?category=004065"><img src="/shop/data/skin/damoashop/img/banner/s_banner/ztechnik.jpg" alt="Ztechnik"/></a></li>
		
	</ul>
	
</div>
<!--div id="main_contents">
	<div id="new_arrival">
		<div class="title"><a href="<?php echo url("goods/goods_grp_01.php")?>&"><img src="/shop/data/skin/damoashop/img/main/newarrival.gif"></a></div>
		<div class="contents">-->
<?php if($GLOBALS["cfg_step"][ 0]["chk"]){?> 
		<?php echo $this->assign('loop',dataDisplayGoods( 0,$GLOBALS["cfg_step"][ 0]["img"],$GLOBALS["cfg_step"][ 0]["page_num"]))?>

		<?php echo $this->assign('cols',$GLOBALS["cfg_step"][ 0]["cols"])?>

		<?php echo $this->assign('size',$GLOBALS["cfg"][$GLOBALS["cfg_step"][ 0]["img"]])?>

		<?php echo $this->assign('id',"main_list_01")?>

		<?php echo $this->assign('dpCfg',$GLOBALS["cfg_step"][ 0])?>

		<?php echo $this->define('tpl_include_file_3',"goods/list/".$GLOBALS["cfg_step"][ 0]["tpl"].".htm")?> <?php $this->print_("tpl_include_file_3",$TPL_SCP,1);?>

<?php }?> 
		<!--</div>
	</div>-->
	<!--div id="best_item">
		<div class="title"><a href="<?php echo url("goods/goods_grp_03.php")?>&"><img src="/shop/data/skin/damoashop/img/main/bestitem.gif"></a></div>
		<div class="contents">-->
<?php if($GLOBALS["cfg_step"][ 2]["chk"]){?> 
		<?php echo $this->assign('loop',dataDisplayGoods( 2,$GLOBALS["cfg_step"][ 2]["img"],$GLOBALS["cfg_step"][ 2]["page_num"]))?>

		<?php echo $this->assign('cols',$GLOBALS["cfg_step"][ 2]["cols"])?>

		<?php echo $this->assign('size',$GLOBALS["cfg"][$GLOBALS["cfg_step"][ 2]["img"]])?>

		<?php echo $this->assign('id',"main_list_03")?>

		<?php echo $this->assign('dpCfg',$GLOBALS["cfg_step"][ 2])?>

		<?php echo $this->define('tpl_include_file_4',"goods/list/".$GLOBALS["cfg_step"][ 2]["tpl"].".htm")?> <?php $this->print_("tpl_include_file_4",$TPL_SCP,1);?>

<?php }?> 
		<!--</div>
	</div>-->
</div-->

<!-- 멀티 팝업 -->
<script src="/shop/data/skin/damoashop/proc/multi_popup.js"></script>
<script>multiPopup('<?php echo $GLOBALS["cfg"]["tplSkin"]?>');</script>

<?php $this->print_("footer",$TPL_SCP,1);?>