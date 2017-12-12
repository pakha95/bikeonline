<?php
$location = "모바일광고 > 카카오톡 옐로아이디";
include "../_header.php";
$requestVar = array(
	'code'=>'marketing_kakaotalk_biz'
);
?>
<div class="title title_top">카카오톡 옐로아이디</div>
<iframe name="inguide" src="../proc/remote_godopage.php?<?=http_build_query($requestVar)?>" frameborder="0" marginwidth="0" marginheight="0" width="100%" height="500" scrolling="no"></iframe>
<? include "../_footer.php"; ?>