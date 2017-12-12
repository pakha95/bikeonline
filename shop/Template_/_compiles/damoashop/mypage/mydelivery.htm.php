<?php /* Template_ 2.2.7 2016/06/20 12:06:46 /www/jbsinttr8192_godo_co_kr/shop/data/skin/damoashop/mypage/mydelivery.htm 000002106 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>

<title>나의 배송지 관리</title>
<script src="/shop/data/skin/damoashop/common.js"></script>
<link rel="styleSheet" href="/shop/data/skin/damoashop/style.css">
<style type="text/css">
	.delivery_div { overflow:hidden; }
	.delivery_div .dtitle { width:100%; font-weight:bold; font-size: 22px; height:50px; line-height:50px; }
	.delivery_div .dcontents { padding:15px 0 13px 15px; color:#444; }
	.delivery_div .dcontents_popup { padding:15px 0 0px 15px; color:#444; }
	.delivery_div .mydtit { height:25px; line-height:25px; }
	.d_list table { width:98%; margin:0 auto; }
	.d_list table td { height:73px; border-bottom:1px solid #C1C1C1; text-align:center; color:#444; }
	.d_list table td a { color:#444; }
	.d_form input[type=text], input.text { clear:both; border:1px solid #ccc; height:28px; background:#FCFCFC; line-height:24px; }
	.d_form table { width:98%; border-top:1px solid #C1C1C1; margin:0 auto; }
	.d_form table th { height:50px; border-right:1px solid #C1C1C1; border-bottom:1px solid #C1C1C1; text-align:center; background:#FAFAFA; color:#444; }
	.d_form table td { height:50px; border-bottom:1px solid #C1C1C1; padding-left:10px; }
	.btn_div { text-align:center; height:50px; margin-top:30px; }
	.vmiddle { vertical-align:middle; }
	.w80 { width:80px; }
	.w300 { width:300px; }
	.right { text-align:right; height:25px; padding-right:10px; }
	.contents_left { float:left; }
	.btn_right { text-align:right; padding-right:10px; }
	.input_txt {font:bold 8pt 돋움; color:#5D5D5D; letter-spacing:-1;padding-top:4px;background:#F0F0F0;}
	.bordertop { height:2px; background:#303030; }
	.borderbtm { height:1px; background:#D6D6D6; }
	.btn_div { text-align:center; height:50px; margin-top:30px; }
	.bold { font-weight:bold; }
	.delivery_default { color:#007FC8; font-weight:bold; }
</style>
<?php $this->print_("deliveryData",$TPL_SCP,1);?>

<?php $this->print_("footer",$TPL_SCP,1);?>