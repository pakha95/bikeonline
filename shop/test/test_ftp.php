<?php

function remoteFileName($server_path,$search){
  $pdfName = array();
  $ftp_host = "jbsinter2.godohosting.com";    // ftp host명
  $ftp_id = "jbsinter2";           // ftp 아이디
  $ftp_pw = "piston3535";   // ftp 비밀번호
  $ftp_port = "21";            // ftp 포트
    if(!($fc = ftp_connect($ftp_host, $ftp_port))) die("$server_host : $server_post - 연결에 실패하였습니다.");
    if(!ftp_login($fc, $ftp_id, $ftp_pw)) die("$server_id - 로그인에 실패하였습니다.");
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
