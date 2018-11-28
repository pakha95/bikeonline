<?php
setlocale(LC_CTYPE, 'ko_KR.utf8'); 
$db_host = 'localhost';
$db_user = 'jbsinter3272835';
$db_pass = 'piston3535';
$db_name = 'jbsinttr8192_godo_co_kr';

$db = new mysqli($db_host, $db_user, $db_pass, $db_name);

//$res = $db->query("select goodsno,img_m from gd_goods order by goodsno asc");
$fp = fopen("./test_img_comp.txt","r");
$i = 0;
$doc =array();
while( !feof($fp) ) {
    $doc[$i] = fgets($fp);
	$doc1 = trim($doc[$i]);
	$doc1 = iconv("utf-8","euc-kr",$doc1);
	$sql = "select goodsno,img_m from gd_goods where img_m like '%".$doc1."%' order by goodsno asc";
	$res = $db->query($sql);
	//echo $sql."<br>\r\n";
	//echo $doc1."<br>\r\n";
	while ($img_url= mysqli_fetch_array($res)) {
		//if(strpos($img_url[img_m], $doc[$i]) !== false) {
			$log_txt = $img_url[goodsno]." || ".$doc1; 
			//echo $log_txt."\r\n";
			$log_dir = "/www/jbsinttr8192_godo_co_kr/shop/test";   
			$log_file = fopen($log_dir."/test_img_comp_list.txt", "a");  
			fwrite($log_file, $log_txt."\r\n");  
			fclose($log_file);  
		//}
	}
	
	$i++;
}
fclose($fp);

?>