<?php

//include "../_header.php";
//include "../../lib/page.class.php";
//include "../../conf/config.pay.php";
$db_host = 'localhost';
$db_user = 'jbsinter3272835';
$db_pass = 'piston3535';
$db_name = 'jbsinttr8192_godo_co_kr';

$db = new mysqli($db_host, $db_user, $db_pass, $db_name);

$res = $db->query("select goodsno,img_m from gd_goods order by goodsno asc");
while ($img_url= mysqli_fetch_array($res)) {

	$img_m =  explode("|",$img_url[img_m]);
	sort($img_m);
	$log_txt = "";
	foreach($img_m as $key => $value){
		$log_txt = $value; 
		//echo $log_txt;
		$log_dir = "/www/jbsinttr8192_godo_co_kr/shop/log";   
		$log_file = fopen($log_dir."/img_m_db.txt", "a");  
		fwrite($log_file, $log_txt."\r\n");  
		fclose($log_file);  
	}
	
	//$goodsno = $img_url[goodsno];
	//if (@getimagesize($external_link)) {
	
	//} else {
		//$log_txt = $goodsno." || ".$external_link;
		//$log_dir = "/www/jbsinttr8192_godo_co_kr/shop/log";   
		//$log_file = fopen($log_dir."/img_src_log.txt", "a");  
		//fwrite($log_file, $log_txt."\r\n");  
		//fclose($log_file);  
	//}


}

?>