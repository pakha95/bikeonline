<?

include "../lib.php";
require_once("../../lib/qfile.class.php");
$qfile = new qfile();

switch ($_POST[mode]){

	case "natebasket":

		// ����
		$natebasket = array();
		@include "../../conf/natebasket.php";

		$natebasket = array_map("addslashes",array_map("stripslashes",$natebasket));
		$natebasket = array_merge($natebasket,$_POST);

		// ��ǰ���� ����
		$natebasket['uncoupon'] = ($natebasket['incoupon'] == 'Y' ? 'N' : 'Y');

		$qfile->open("../../conf/natebasket.php");
		$qfile->write("<? \n");
		$qfile->write("\$natebasket = array( \n");
		foreach ($natebasket as $k=>$v){
			if(in_array($k,array('mode','incoupon'))) continue;
			$qfile->write("'$k' => '$v', \n");
		}
		$qfile->write(") \n;");
		$qfile->write("?>");
		$qfile->close();

		break;
}

go($_SERVER[HTTP_REFERER]);

?>