<?
$location = "카카오 알림톡 > 카카오 알림톡 안내";
include '../_header.php';
$requestVar = array(
	'code'=>'service_kakao'
);
?>
<div class="title title_top">카카오 알림톡 안내</div>
<iframe name="inguide" src="../proc/remote_godopage.php?<?=http_build_query($requestVar)?>" frameborder="0" marginwidth="0" marginheight="0" width="100%" height="500" scrolling="no"></iframe>
<?php include '../_footer.php'; ?>