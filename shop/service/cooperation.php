<?

include "../_header.php";

if (class_exists('validation') && method_exists('validation', 'xssCleanArray')) {
	$_POST = validation::xssCleanArray($_POST, array(
		validation::DEFAULT_KEY	=> 'text'
	));
}

if ( $_POST['mode'] == 'send' ){
	// euckr������ �Ѵ� Ư�� �ѱ� ȣȯ (cp949 ���ڵ� ����) 2016-03-31
	if($_POST['encode'] == 'cp') {
		$_POST['title'] = iconv('utf8','cp949',urldecode($_POST['encodeTitle']));
		$_POST['content'] = iconv('utf8','cp949',urldecode($_POST['encodeContent']));
		$_POST['name'] = iconv('utf8','cp949',urldecode($_POST['encodeName']));
		$_POST['title'] = validation::xssClean($_POST['title'], 'html', 'ent_quotes');
		$_POST['content'] = validation::xssClean($_POST['content'], 'html', 'ent_quotes');
		$_POST['name'] = validation::xssClean($_POST['name'], 'html', 'ent_quotes');
	
		$regCP949 = '/([\x81-\xA0][\x41-\x5A\x61-\x7A\x81-\xFE])|([\xA1-\xC5][\x41-\x5A\x61-\x7A\x81-\xA0])|([\xC6][\x41-\x52])/';
		$strInput = $_POST['title'].$_POST['content'].$_POST['name'];

		if(preg_match($regCP949, $strInput) == 1) {
			$_POST['title'] = iconv('cp949','utf8',$_POST['title']);
			$_POST['content'] = iconv('cp949','utf8',$_POST['content']);
			$_POST['name'] = iconv('cp949','utf8',$_POST['name']);
			$db->query("set names 'utf8'");
		}
	}

	$db->query("INSERT INTO ".GD_COOPERATION." ( itemcd, name, email, title, content, regdt ) VALUES ( '" . $_POST['itemcd'] . "', '" . $_POST['name'] . "', '" . $_POST['mail'] . "', '" . $_POST['title'] . "', '" . $_POST['content'] . "', now() )");

	msg( '�����Ͻ� ������ ���۵Ǿ����ϴ�.', $_SERVER[HTTP_REFERER] );
}

// ������������ �� �̿뿡 ���� �ȳ�
$termsPolicyCollection4 = getTermsGuideContents('terms', 'termsPolicyCollection4');
$tpl->assign('termsPolicyCollection4', $termsPolicyCollection4);
$tpl->print_('tpl');

?>