<?php /* Template_ 2.2.7 2014/08/05 12:19:02 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/service/customer.htm 000000914 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>


<style type="text/css">
.customer					{ padding: 15px; }
.customer div				{ line-height: 130%;}
.customer h2				{ margin-bottom: 15px; font-size: 15px; }
.customer .customerTitle	{ padding: 20px 0 10px 0 ; }
</style>

<section class="customer">
	<h2>고객센터</h2>
	<article>
		<div class="customerTitle">연락처 안내</div>
		<div>전화번호 : <?php echo $GLOBALS["cfg"]['customerPhone']?></div>
		<div>팩스번호 : <?php echo $GLOBALS["cfg"]['customerFax']?></div>
		<div>E-Mail : <?php echo $GLOBALS["cfg"]['customerEmail']?></div>

		<div class="customerTitle">운영시간 안내</div>
		<div><?php echo $GLOBALS["cfg"]['customerHour']?></div>
	</article>
</section>

<?php $this->print_("footer",$TPL_SCP,1);?>