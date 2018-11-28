<?php 
$fp = fopen("goods_img_list.txt","r");
while( !feof($fp) ) {
    $doc = fgets($fp);
	$doc_data = explode("\"",$doc);
	$log_txt = $doc_data[0];
		$log_dir = "/www/jbsinttr8192_godo_co_kr/shop/log";   
		$log_file = fopen($log_dir."/img_list_log.txt", "a");  
		fwrite($log_file, $log_txt."\r\n");  
		fclose($log_file);  
}
fclose($fp);
echo $doc_data;
?>