<?php

function remoteFileName($server_path,$search){
  $pdfName = array();
  $ftp_host = "jbsinter2.godohosting.com";    // ftp host��
  $ftp_id = "jbsinter2";           // ftp ���̵�
  $ftp_pw = "piston3535";   // ftp ��й�ȣ
  $ftp_port = "21";            // ftp ��Ʈ
    if(!($fc = ftp_connect($ftp_host, $ftp_port))) die("$server_host : $server_post - ���ῡ �����Ͽ����ϴ�.");
    if(!ftp_login($fc, $ftp_id, $ftp_pw)) die("$server_id - �α��ο� �����Ͽ����ϴ�.");
    //$server_path = "/pdf/";
    ftp_chdir($fc, $server_path);
    $contents = ftp_nlist($fc, $server_path);
    foreach($contents as $value){
      if(strpos($value, $search) !== false) {
        $pdfName[] = "http://jbsinter2.godohosting.com".$value;
      }
    }
  return $pdfName;
  ftp_quit($fc);
}
$pdfNameArr = remoteFileName("/pdf/",".pdf");
foreach($pdfNameArr as $value) {
  echo $value."<br>";
}
?>
