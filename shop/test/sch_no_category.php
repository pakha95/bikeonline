<?php
setlocale(LC_CTYPE, 'ko_KR.utf8'); 
$db_host = 'localhost';
$db_user = 'jbsinter3272835';
$db_pass = 'piston3535';
$db_name = 'jbsinttr8192_godo_co_kr';

$db = new mysqli($db_host, $db_user, $db_pass, $db_name);
$res = $db->query("SELECT a.goodsno,goodsnm FROM gd_goods a LEFT OUTER JOIN gd_goods_link b ON (a.goodsno = b.goodsno) WHERE b.goodsno IS NULL;");
	while ($noCate= mysqli_fetch_array($res)) {
		
			$goodsname = explode(">",$noCate[goodsnm]);
			
			$log_txt = $noCate[goodsno]."||".$goodsname[2]; 
			echo $log_txt."\r\n";
			$log_dir = "/www/jbsinttr8192_godo_co_kr/shop/log";   
			$log_file = fopen($log_dir."/test_no_category.txt", "a");  
			fwrite($log_file, $log_txt."\r\n");  
			fclose($log_file);  
		
	}
?>