<?

include "../_header.php";

### ȸ����������
if( $sess ){
	msg("������ �α��� ���Դϴ�.",$code=-1 );
}

if (!$_GET['returnUrl']) $returnUrl = $_SERVER['HTTP_REFERER'];
else $returnUrl = $_GET['returnUrl'];

if(!$returnUrl) $returnUrl = $mobileRootDir;

$tpl->print_('tpl');

?>