<? ### 고려택배 (http://http://www.klogis.com/03_business/01_tracking_detail_bcno.asp?bcno=)
$out = split_betweenStr($out,"marginheight=\"0\">","</body>");
$out = str_replace('../','http://www.klogis.com/',$out);
$out = str_replace('images/','http://www.klogis.com/03_business/images/',$out);
?>

<link rel="stylesheet" href="http://www.klogis.com/css.css" type="text/css">
<script src="http://www.klogis.com/Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<?=$out[0]?>