<?
if ($mainpage === true) $skin_key_file = 'main/intro.php';
include "../_header.php";

if ( $cfg['introUseYN'] != 'Y' ){ // ��Ʈ�� �̻��
	header("location:index.php");
}

$tpl->print_('tpl');
?>
