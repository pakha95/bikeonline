<?
$_POST['mode'] = ($_GET['mode'] ? $_GET['mode'] : $_POST['mode'] );
$_POST['id'] = ($_GET['id'] ? $_GET['id'] : $_POST['id'] );

if(!preg_match('/^[a-zA-Z0-9_]*$/',$_POST['id'])) exit;
include "../../conf/bd_$_POST[id].php";
require_once "../lib.php";
require_once "../../lib/library.php";
require_once("../../lib/upload.lib.php");

$_POST['subject'] = html_entity_decode($_POST['subject']);
$_POST['contents'] = html_entity_decode($_POST['contents']);

// euckr������ �Ѵ� Ư�� �ѱ� ȣȯ (cp949 ���ڵ� ����) 2016-03-31
if($_POST['encode'] == 'cp') {
	$_POST['subject'] = iconv('utf8','cp949',urldecode($_POST['encodeSubject']));
	$_POST['contents'] = iconv('utf8','cp949',urldecode($_POST['encodeContents']));
	$_POST['name'] = iconv('utf8','cp949',urldecode($_POST['encodeName']));
	$_POST['subject'] = validation::xssClean($_POST['subject'], 'html', 'ent_quotes');
	$_POST['contents'] = validation::xssClean($_POST['contents'], 'html', 'ent_quotes');
	$_POST['name'] = validation::xssClean($_POST['name'], 'html', 'ent_quotes');
	
	$regCP949 = '/([\x81-\xA0][\x41-\x5A\x61-\x7A\x81-\xFE])|([\xA1-\xC5][\x41-\x5A\x61-\x7A\x81-\xA0])|([\xC6][\x41-\x52])/';
	$strInput = $_POST['subject'].$_POST['contents'].$_POST['name'];

	if(preg_match($regCP949, $strInput) == 1) {
		$_POST['subject'] = iconv('cp949','utf8',$_POST['subject']);
		$_POST['contents'] = iconv('cp949','utf8',$_POST['contents']);
		$_POST['name'] = iconv('cp949','utf8',$_POST['name']);
		$db->query("set names 'utf8'");
	}
}

// ���� ��Ÿ���� �ִ°��
if(is_array($_POST['titleStyle'])) {
	if($_POST['titleStyle']['C']) $titleStyle['C'] = "^C:".$_POST['titleStyle']['C']; // ���� ����
	if($_POST['titleStyle']['S']) $titleStyle['S'] = "^S:".$_POST['titleStyle']['S']; // ���� ũ��
	if($_POST['titleStyle']['B']) $titleStyle['B'] = "^B:".$_POST['titleStyle']['B']; // ���� ����

	if(is_array($titleStyle)) $titleStyle	= implode("|",$titleStyle);
}


//* bd class *//

if($_POST['mode']=="reply")
{
	$query = "select no from `".GD_BD_.$_POST[id]."` where no='".$_POST['no']."'";
	list($tmp) = $db->fetch($query);
	if(!$tmp) msg("������ �����Ǿ� �亯���� ���� �� �����ϴ�",-1);
}

$bd = Core::loader('miniSave');

$bd->db		= &$db;
$bd->id		= $_POST[id];
$bd->no		= $_POST[no];
$bd->mode	= $_POST[mode] == 'register' ? 'write' : $_POST[mode];	// �� register = write (ġȯó�� ��)
$bd->sess	= $sess;
$bd->style	= $titleStyle;
$bd->ici_admin	= $ici_admin;

$bd->bdMaxSize	= $bdMaxSize;
$bd->exec_();


switch($_POST['mode']) {

	case "register":
		//���Ẹ�ȼ���
		$write_end_url = $sitelink->link("admin/board/list_management_indb.php?id=".$_POST['id']."&mode=register_end","regular");
		echo "<script>location.href='$write_end_url';</script>";
		exit;
	break;

	case "reply":
		//���Ẹ�ȼ���
		$write_end_url = $sitelink->link("admin/board/list_management_indb.php?id=".$_POST['id']."&mode=reply_end","regular");
		echo "<script>location.href='$write_end_url';</script>";
		exit;
	break;

	case "modify":
		//���Ẹ�ȼ���
		$write_end_url = $sitelink->link("admin/board/list_management_indb.php?id=".$_POST['id']."&mode=modify_end","regular");
		echo "<script>location.href='$write_end_url';</script>";
		exit;
	break;

	case "register_end":
		//���Ẹ�ȼ��� ���� �θ�â ���ΰ�ħ�� ���� https ���� http�� ��ȯ
		echo "<script>alert('���� ����߽��ϴ�.');opener.location.reload();window.close()</script>";
		exit;

	case "reply_end":
		//���Ẹ�ȼ��� ���� �θ�â ���ΰ�ħ�� ���� https ���� http�� ��ȯ
		echo "<script>alert('�亯�� �ۼ��߽��ϴ�.');opener.location.reload();window.close()</script>";
		exit;
	break;

	case "modify_end":
		//���Ẹ�ȼ��� ���� �θ�â ���ΰ�ħ�� ���� https ���� http�� ��ȯ
		echo "<script>alert('���� �����߽��ϴ�.');opener.location.reload();window.close()</script>";
		exit;
	break;
}
?>
