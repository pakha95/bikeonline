<?php
define('SHOP_DIR', realpath(dirname(__FILE__).'/../../'));
include SHOP_DIR . '/lib/library.php';

ignore_user_abort(true);
set_time_limit(0);
ini_set("memory_limit", -1);
if ($_SERVER['SERVER_ADDR'] == '') $_SERVER['SERVER_ADDR'] = gethostbyname(php_uname('n'));

$receptionAgreement = Core::loader('receptionAgreement');

//�������� ���ŵ��� ���� Ȯ�� �ȳ� �߼�
$receptionAgreement->autoSend();
?>