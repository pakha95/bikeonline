<?
$location = "°Ë»ö ±¤°í > AK mall SNS ±¤°í";
include "../_header.php";
$requestVar = array(
	'code'=>'marketing_ak_mall_sns'
);
?>
<div class="title title_top">AK mall SNS ±¤°í</div>
<iframe name="inguide" src="../proc/remote_godopage.php?<?=http_build_query($requestVar)?>" frameborder="0" marginwidth="0" marginheight="0" width="100%" height="500" scrolling="no"></iframe>
<? include "../_footer.php"; ?>