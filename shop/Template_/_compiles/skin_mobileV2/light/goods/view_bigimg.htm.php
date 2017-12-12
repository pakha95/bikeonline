<?php /* Template_ 2.2.7 2015/09/21 18:38:52 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/goods/view_bigimg.htm 000002743 */ 
if (is_array($TPL_VAR["l_img"])) $TPL_l_img_1=count($TPL_VAR["l_img"]); else if (is_object($TPL_VAR["l_img"]) && in_array("Countable", class_implements($TPL_VAR["l_img"]))) $TPL_l_img_1=$TPL_VAR["l_img"]->count();else $TPL_l_img_1=0;?>
<?php $this->print_("header",$TPL_SCP,1);?>


<?php $this->print_("sub_header",$TPL_SCP,1);?>


<script type="text/javascript">
var strprice = "<?php echo $TPL_VAR["strprice"]?>";

$(document).ready(function(){
	$("meta[name=viewport]").attr("content", "user-scalable=yes, initial-scale=1.0, maximum-scale=10.0, minimum-scale=1.0, width=device-width, height=device-height");
});

</script>
<style type="text/css">
.goods_price2 {height:20px;line-height:20px;text-align:right;}
.goods_dc {height:20px;line-height:20px;text-align:right;color:#88eeff;}

section#goodsbigimg {background:#FFFFFF;}
section#goodsbigimg .top_title{clear:both; height:36px; line-height:36px; background:#f9f9f9; color:#222222; font-size:14px; font-weight:bold; text-align:center; font-family:dotum; border-bottom:solid 1px #969ca3; padding-left:10px;  white-space: nowrap;overflow: hidden;}
section#goodsbigimg .top_title .back_btn{float:left; background:url('/shop/data/skin_mobileV2/light/common/img/new/btn_back.png') no-repeat; background-size:38px 27px; width:38px; height:27px; margin-top:5px; position:absolute;}
section#goodsbigimg .img-area {padding:0px 12px 12px 12px; }
section#goodsbigimg .img-area .thumbnail-area {border:solid 1px #d9d9d9;}
section#goodsbigimg .img-area .img-area-info{height:40px; text-align:center; font-size:12px; color:#353535; line-height:40px;}

</style>
<form name="frmView" method="post" onsubmit="return false;">
	<input type="hidden" name="mode" value="" />
	<input type="hidden" name="goodsno" value="<?php echo $TPL_VAR["goodsno"]?>" />
	<input type="hidden" name="goodsCoupon" value="<?php echo $TPL_VAR["coupon"]?>" />
	<input type="hidden" name="ea" value="" />
	<input type="hidden" name="opt[]" value="" />
	<input type="hidden" name="addopt[]" value="" />
</form>


<section id="goodsbigimg" class="content">
	<div class="top_title">
		<div class="back_btn" onClick="javascript:history.go(-1);"></div>
		<div class="goods_nm">상품이미지 확대보기</div>
	</div>
	<div class="img-area">
		<div class="img-area-info">
			상품이미지를 확대하실 수 있습니다.
		</div>
		<div class="thumbnail-area">
<?php if($TPL_l_img_1){foreach($TPL_VAR["l_img"] as $TPL_V1){?>
		<?php echo goodsimgMobile($TPL_V1)?>

<?php }}?>
		</div>

	</div>

</section>



<?php $this->print_("footer",$TPL_SCP,1);?>