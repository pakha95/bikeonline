<?php
setlocale(LC_CTYPE, 'ko_KR.utf8');
$db_host = 'localhost';
$db_user = 'jbsinter3272835';
$db_pass = 'piston3535';
$db_name = 'jbsinttr8192_godo_co_kr';

$dbc = new mysqli($db_host, $db_user, $db_pass, $db_name);
//mysqli_set_charset($dbc, 'utf8');
$percent = $_POST['percent'];
if($percent!="" && $percent!= 0) {
$goodsnum = $_POST['goodsNo'];
  foreach($goodsnum as $goodsNo){
      $sql = "UPDATE gd_goods SET goods_price = TRUNCATE(goods_price*($percent/100+1) ,-3) WHERE goodsno = $goodsNo";
      $res = $dbc->query($sql);
      $sql = "UPDATE gd_goods_option SET price = TRUNCATE(price*($percent/100+1) ,-3) WHERE goodsno = $goodsNo AND go_is_deleted = '0' ";
      $res = $dbc->query($sql);
      $sql = "UPDATE gd_goods_add SET addprice = TRUNCATE(addprice*($percent/100+1) ,-3) WHERE goodsno = $goodsNo";
      $res = $dbc->query($sql);
  }
  $msgFin = "가격 수정 완료";
  $msgFin = rawurlencode(iconv("CP949", "UTF-8", $msgFin));

  echo $msgFin;
}//if percent

 ?>
