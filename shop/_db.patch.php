<?

// C1. ���̺귯�� �ε�
include "lib/library.php";

// C2. ��������
$query[] = "CREATE TABLE IF NOT EXISTS `gd_kakaoAlimtalk_sendlist` (
  `sno` int(10) unsigned NOT NULL auto_increment,
  `send_key` bigint(20) NOT NULL COMMENT '�߰輭�� ����Ű',
  `sms_mode` enum('r','i') NOT NULL COMMENT '�߼�����',
  `alimtalk_memNo` int(10) NOT NULL COMMENT 'ȸ����ȣ',
  `alimtalk_logNo` int(10) NOT NULL COMMENT 'gd_kakaoAlimtalk_sendlog ���̺��ȣ',
  `sms_logNo` int(10) NOT NULL,
  `send_contents` text NOT NULL COMMENT '���۵� �޼���',
  `send_name` varchar(20) default NULL COMMENT '�����ڸ�',
  `send_number` varchar(20) default NULL COMMENT '���Ź�ȣ',
  `send_status` char(1) default NULL COMMENT '�߼ۻ���',
  `send_date` datetime default NULL COMMENT '���� ����',
  `fail_code` varchar(255) default NULL COMMENT '���и޼���',
  PRIMARY KEY  (`sno`)
);";

$query[] = "CREATE TABLE IF NOT EXISTS `gd_kakaoAlimtalk_sendlog` (
  `sno` int(10) unsigned NOT NULL auto_increment,
  `template_name` varchar(255) NOT NULL COMMENT '���ø���',
  `template_contents` text NOT NULL COMMENT '���ø�����',
  `send_status` char(1) NOT NULL COMMENT '�߼ۻ���',
  `send_date` datetime NOT NULL COMMENT '�߼۽ð�',
  `reserve_date` datetime NOT NULL COMMENT '����ð�',
  `send_count` int(10) default NULL COMMENT '�߼۰Ǽ�',
  `send_success_count` int(10) default NULL COMMENT '�߼� ���� �Ǽ�',
  `send_fail_count` int(10) default NULL COMMENT '�߼� ���� �Ǽ�',
  `request_fail_count` int(10) default NULL COMMENT '��û ���� �Ǽ�',
  `send_type` varchar(30) default NULL COMMENT '�߼�Ÿ��',
  PRIMARY KEY  (`sno`)
);";

$query[] = "CREATE TABLE IF NOT EXISTS `gd_kakaoAlimtalk_template` (
  `sno` int(10) unsigned NOT NULL auto_increment,
  `code` varchar(255) NOT NULL COMMENT '���ø��ڵ�',
  `profile_type` varchar(1) NOT NULL COMMENT '�߽�������Ÿ��',
  `mode` varchar(255) NOT NULL COMMENT '���ø�����',
  `name` varchar(255) NOT NULL COMMENT '���ø���',
  `contents` text NOT NULL COMMENT '���ø�����',
  `useYn` varchar(1) default NULL COMMENT '��뿩��',
  `status` varchar(1) default NULL,
  `inspection_status` varchar(15) default NULL COMMENT '�˻����',
  `reg_date` datetime default NULL COMMENT '�����',
  PRIMARY KEY  (`sno`),
  INDEX `code` (`code`)
);";

// C3. �����߻�����
$occursError = false;

// C4. ���� ����
if (strtoupper(get_class($db)) === 'GODO_DB') { // GODO DB��ü�϶�(����4 �̻�)
	foreach ($query as $v) {
		$db->query($v);
		if ($db->errorCode()) {
			debug($db->errorInfo());
			$occursError = true;
		}
	}
}
else if (strtoupper(get_class($db)) === 'DB') { // DB��ü�϶�(����1,2,3)
	foreach ($query as $v) {
		$db->query($v);
		if (mysql_errno($db->db_conn)) {
			debug(mysql_error($db->db_conn));
			$occursError = true;
		}
	}
}
else { // ������ DB��ü�� �ƴѰ��
	debug('DB��ü�� ã�� �� �����ϴ�. �����ͷ� �����ֽñ� �ٶ��ϴ�.');
	$occursError = true;
}

// C5. ������ �߻����� �ʾҴٸ� ��ġ�������� ���
if ($occursError === false) debug('���������� DB��ġ�� �Ϸ�Ǿ����ϴ�.');

?>