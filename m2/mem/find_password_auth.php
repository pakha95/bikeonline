<?php
include '../_header.php';

if($sess) msg("������ �α��� ���Դϴ�.", '../index.php');

$message = '';
switch($_POST['otpType']){
	case 'mail':
		$message = 'ȸ�������� ��ϵǾ� �ִ� ������ �̸��Ϸ� ������ȣ�� ���۵Ǿ����ϴ�.';
	break;

	case 'mobile':
		$message = 'ȸ�������� ��ϵǾ� �ִ� ������ �޴������� ������ȣ�� ���۵Ǿ����ϴ�.';
	break;
}

$tpl->assign($_POST);
$tpl->assign('message', $message);
$tpl->print_('tpl');
?>