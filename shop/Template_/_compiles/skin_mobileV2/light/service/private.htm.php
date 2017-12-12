<?php /* Template_ 2.2.7 2014/08/05 12:19:02 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/service/private.htm 000000664 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>


<script type="text/javascript">
$(document).ready(function(){
	$("#private > article").html($("#private > article").html().replace(/\n/gi, "<br/>"));
});
</script>
<style type="text/css">
#private{
	padding: 15px;
}
#private h2{
	margin-bottom: 15px;
	font-size: 15px;
}
</style>

<section id="private">
	<h2>개인정보취급방침</h2>
	<article><?php echo $TPL_VAR["termsPolicyCollection1"]?></article>
</section>

<?php $this->print_("footer",$TPL_SCP,1);?>