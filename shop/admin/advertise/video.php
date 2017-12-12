<?php
$location = "기타광고 > 동영상 마케팅";
include "../_header.php";
$requestVar = array(
	'code'=>'marketing_video'
);
?>
<div class="title title_top">동영상 마케팅</div>
<iframe name="inguide" src="../proc/remote_godopage.php?<?=http_build_query($requestVar)?>" frameborder="0" marginwidth="0" marginheight="0" width="100%" height="500" scrolling="no"></iframe>
<? include "../_footer.php"; ?>