<?php /* Template_ 2.2.7 2014/08/05 12:19:02 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/proc/guide.htm 000000824 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>


<script type="text/javascript">
$(document).ready(function(){
	//$("#guide > article").html($("#guide > article").html().replace(/\n/gi, "<br/>"));
});
</script>

<style type="text/css">
html, body{ width:100%; height:100%; margin:0; padding:0; background-color:#ffffff;}

#top_title {
	text-align:center;
}
#guide{
	padding: 12px;
}
</style>

<section id="page_title" class="content">
	<div id="top_title" class="top_title">이용안내</div>
</section>

<section id="guide"  class="content">
	<article>
		<?php echo $TPL_VAR["guideOperate"]?>

	</article>
</section>


<?php $this->print_("footer",$TPL_SCP,1);?>