<?
$noDemoMsg = 1;
include "../_header.php";
if($_GET['htmid'] == "proc/dealer_map.htm"||$_GET['htmid'] == "proc/dealer_map2.htm") {
	$query = "select m_id,name,address,address_sub,mobile,company from ".GD_MEMBER." where (level = '3' or level = '4') and company<>''	";
	$mbInfo =array();
	$res = $db->query($query);
	while ( $data = $db->fetch( $res, 1 ) ){
	   $mbInfo[] = $data;

	}
	$tpl->assign('mbInfo', $mbInfo);


}

function _realpath($path)
{
	$path = str_replace('\\',  '/', $path);
	$path = preg_replace('/\/+/', '/', $path);

	$segments = explode('/', $path);
	$parts = array();

	foreach ($segments as $segment) {
		if ($segment == '..') {
			array_pop($parts);
		}
		else if ($segment == '.') {
			continue;
		}
		else {
			$parts[] = $segment;
		}
	}
	return implode(DIRECTORY_SEPARATOR, $parts);
}

$file = _realpath($tpl->template_dir . DIRECTORY_SEPARATOR . $_GET['htmid']);

if (!in_array(pathinfo($file, PATHINFO_EXTENSION ), array('htm'))) {
	$error = true;
}
else if (!preg_match('/^(\/data)?\/skin/', str_replace('\\','/',str_replace(SHOPROOT, '', $file)), $matches)) {
	$error = true;
}
else {
	$error = false;
}

if ($error === true) {
	go('../');
	exit;
}

### 팝업타이틀 변수 할당
if ( ereg("^popup/",$key_file) ) $popup_title = $data_file['text'];

$tpl->print_('tpl');
?>
