<?
$noDemoMsg = 1;
include "../_header.php";

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

$query = "SELECT  *,count(*) as cnt FROM ".GD_MEMBER." WHERE level = 2 or level = 3 ";
$res = $db->query($query);
while($data = $db->fetch($res,1)){


	$_loop[] = $data;
}
$loop = $_loop;

### 팝업타이틀 변수 할당
if ( ereg("^popup/",$key_file) ) $popup_title = $data_file['text'];

$tpl->assign(array(
			'loop'	=> $loop,
			'slevel' =>  Clib_Application::session()->getMemberLevel(),
			));
$tpl->print_('tpl');
?>
