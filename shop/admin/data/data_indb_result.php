<?
include "../lib.php";
$cachePath = $cfg['rootDir'].'/cache';
$rPath = realpath($_GET['path']);
$extName = substr($_GET['name'],-4);

if ($rPath != '' && $cfg['rootDir'] != '' && strpos($rPath,$cachePath) !== false && $extName == '.xls') {
	error_reporting(0);

	if ($fp = @fopen($rPath, "r")) {

		setlocale(LC_CTYPE, 'ko_KR.eucKR');

		header( 'Content-type: application/vnd.ms-excel' );
		header( 'Content-Disposition: attachment; filename='.$_GET['name'] );
		header( 'Content-Description: PHP5 Generated Data' );

		while (!feof($fp)) {
			echo fread($fp, 8192);
		}
		fclose($fp);

		@unlink($rPath);
	}
}
?>