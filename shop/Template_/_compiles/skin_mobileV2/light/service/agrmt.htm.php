<?php /* Template_ 2.2.7 2014/08/05 12:19:02 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/service/agrmt.htm 000000656 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>


<script type="text/javascript">
$(document).ready(function(){
	$("#agreement > article").html($("#agreement > article").html().replace(/\n/gi, "<br/>"));
});
</script>
<style type="text/css">
#agreement{
	padding: 15px;
}
#agreement h2{
	margin-bottom: 15px;
	font-size: 15px;
}
</style>

<section id="agreement">
	<h2>이용약관</h2>
	<article><?php echo $TPL_VAR["termsAgreement"]?></article>
</section>

<?php $this->print_("footer",$TPL_SCP,1);?>