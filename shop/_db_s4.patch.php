<?

// C1. ���̺귯�� �ε�
include "lib/library.php";

// C2. ��������
$query[] = "CREATE TABLE IF NOT EXISTS `gd_order_item_delivery` (
	`oi_delivery_idx` int(11) NOT NULL auto_increment COMMENT '��ۺ� idx',
	`ordno` bigint(20) NOT NULL COMMENT '�ֹ���ȣ',
	`delivery_price` int(11) NOT NULL COMMENT '���ʹ�ۺ�',
	`prn_delivery_price` int(11) NOT NULL COMMENT '��ۺ�(��ҹݿ�)',
	`delivery_type` varchar(3) NOT NULL COMMENT '���Ÿ��(���Ÿ���ڵ�, �߰�����ڵ�-��������ۺ�)',
	`conditional_price` int(11) default NULL COMMENT '���Ǻ� ������� (���ǹ� ���� ����϶� ������ ���ذ�)',
	PRIMARY KEY  (`oi_delivery_idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=euckr AUTO_INCREMENT=1 ;";

$query[] = "CREATE TABLE IF NOT EXISTS `gd_order_item_delivery_log` (
	`oid_log_idx` int(11) NOT NULL auto_increment COMMENT '�����̷� idx',
	`oi_delivery_idx` int(11) NOT NULL COMMENT '��ۺ� idx',
	`delivery_price` int(11) NOT NULL COMMENT '�ΰ�/ȯ�ҵ� ��ۺ�',
	`log_type` varchar(1) NOT NULL COMMENT '����α� Ÿ�� (a = �ֹ����, m = �ֹ���� ����, p = �ֹ���� �ΰ�)',
	`change_date` datetime NOT NULL COMMENT '��������',
	PRIMARY KEY  (`oid_log_idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=euckr AUTO_INCREMENT=1 ;";

$query[] = "CREATE TABLE IF NOT EXISTS `gd_payco_receive_log` (
	`pr_log_idx` int(11) NOT NULL auto_increment,
	`mode` varchar(20),
	`log_date` datetime NOT NULL,
	`data` text NOT NULL,
	`result` text,
	PRIMARY KEY  (`pr_log_idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=euckr AUTO_INCREMENT=1 ;";

$query[] = "CREATE TABLE IF NOT EXISTS `gd_payco_transmit_log` (
	`pt_log_idx` int(11) NOT NULL auto_increment,
	`mode` varchar(20),
	`log_date` datetime NOT NULL,
	`data` text NOT NULL,
	`result` text,
	PRIMARY KEY  (`pt_log_idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=euckr AUTO_INCREMENT=1 ;";

$query[] = "ALTER TABLE `gd_order` ADD `settleInflow` VARCHAR( 10 ) NULL COMMENT '�߰���������(payco)',
ADD `payco_reserve_order_no` varchar(20) NULL COMMENT '������ �ֹ������ȣ',
ADD `payco_use_point` int(11) NOT NULL default 0 COMMENT '�������� > ������ ����Ʈ ���ݾ�',
ADD `payco_use_point_repay` int(11) NOT NULL default 0 COMMENT '������ ����Ʈ ȯ�ұݾ�',
ADD `payco_order_no` varchar(20) NULL COMMENT '������ �ֹ���ȣ',
ADD `payco_settle_type` varchar(8) NULL COMMENT '������ �ֹ����� checkout = ������, easypay = �������',
ADD `add_extra_fee_duplicate_free` ENUM( '1', '0' ) NOT NULL COMMENT '�ֹ���� ������ ��ǰ ������ ��ۺ� �ߺ��ΰ�����(1=�ߺ��ΰ�, 0=1ȸ�ΰ�)',
ADD `add_extra_fee_duplicate_fixEach` ENUM( '1', '0' ) NOT NULL COMMENT '�ֹ���� ������� ��ǰ ������ ��ۺ� �ߺ��ΰ�����(1=�ߺ��ΰ�, 0=1ȸ�ΰ�)',
ADD `add_extra_fee_duplicate_each` ENUM( '1', '0' ) NOT NULL COMMENT '�ֹ���� ������ۻ�ǰ ������ ��ۺ� �ߺ��ΰ�����(1=�ߺ��ΰ�, 0=1ȸ�ΰ�)',
ADD `payco_coupon_use_yn` ENUM( 'Y', 'N' ) NOT NULL default 'N' COMMENT '���������� ��뿩�� Y=���, N=�̻��',
ADD `payco_coupon_price` int(11) NOT NULL default '0' COMMENT '���������� ���ݾ�',
ADD `payco_coupon_repay`  ENUM( 'Y', 'N' ) NOT NULL default 'N' COMMENT '���������� ��ҿ��� Y=�����, N=��Ҿ���',
ADD `payco_firsthand_refund`  ENUM( 'Y', 'N' ) NOT NULL default 'N' COMMENT '������ ����ȯ�ҿ��� Y=����ȯ������, N=����ȯ�ҹ�����',
ADD `freeDelivery` ENUM( '0', '1' ) COMMENT '��ǰ�� �����å > �����ۻ�ǰ 0=�����ۻ�ǰ�� ����, 1=�ֹ�����ü ����',
ADD `goodsDelivery` ENUM( '0', '1', '2' ) COMMENT '��ǰ�� �����å > ��ǰ�� ��ۺ� 0=���ǰ�� ��ۺ�� �⺻��ۺ� �ջ�, 1=��ǰ�� ��ۺ�� �⺻��ۺ� �� �� ū ��ۺ�, 2=��ǰ�� ��ۺ��� ���հ� �⺻��ۺ� �� �� ū ��ۺ�';";

$query[] = "ALTER TABLE `gd_order_item` ADD `oi_delivery_idx` int(11) NULL COMMENT '�������ֹ� item ��ۺ� Table idx ��ۺ� �׷��ȣ ���',
ADD `oi_area_idx` int(11) NULL COMMENT '������ ��ۺ�(gd_order_item_delivery idx)';";

$query[] = "ALTER TABLE `gd_order_cancel` ADD `rpayco_point` INT( 11 ) NOT NULL default 0 COMMENT '��ҵ� ������ ����Ʈ(�����������)',
ADD `rpayco_point_fee` INT( 11 ) NOT NULL default 0 COMMENT '������� ����� ������ ����Ʈ(�����������)';";

$query[] = "ALTER TABLE `gd_order_del` ADD `settleInflow` VARCHAR( 10 ) NULL COMMENT '�߰���������(payco)',
ADD `payco_reserve_order_no` varchar(20) NULL COMMENT '������ �ֹ������ȣ',
ADD `payco_use_point` int(11) NOT NULL default 0 COMMENT '�������� > ������ ����Ʈ ���ݾ�',
ADD `payco_use_point_repay` int(11) NOT NULL default 0 COMMENT '������ ����Ʈ ȯ�ұݾ�',
ADD `payco_order_no` varchar(20) NULL COMMENT '������ �ֹ���ȣ',
ADD `payco_settle_type` varchar(8) NULL COMMENT '������ �ֹ����� checkout = ������, easypay = �������',
ADD `add_extra_fee_duplicate_free` ENUM( '1', '0' ) NOT NULL COMMENT '�ֹ���� ������ ��ǰ ������ ��ۺ� �ߺ��ΰ�����(1=�ߺ��ΰ�, 0=1ȸ�ΰ�)',
ADD `add_extra_fee_duplicate_fixEach` ENUM( '1', '0' ) NOT NULL COMMENT '�ֹ���� ������� ��ǰ ������ ��ۺ� �ߺ��ΰ�����(1=�ߺ��ΰ�, 0=1ȸ�ΰ�)',
ADD `add_extra_fee_duplicate_each` ENUM( '1', '0' ) NOT NULL COMMENT '�ֹ���� ������ۻ�ǰ ������ ��ۺ� �ߺ��ΰ�����(1=�ߺ��ΰ�, 0=1ȸ�ΰ�)',
ADD `payco_coupon_use_yn` ENUM( 'Y', 'N' ) NOT NULL default 'N' COMMENT '���������� ��뿩�� Y=���, N=�̻��',
ADD `payco_coupon_price` int(11) NOT NULL default '0' COMMENT '���������� ���ݾ�',
ADD `payco_coupon_repay`  ENUM( 'Y', 'N' ) NOT NULL default 'N' COMMENT '���������� ��ҿ��� Y=�����, N=��Ҿ���',
ADD `payco_firsthand_refund`  ENUM( 'Y', 'N' ) NOT NULL default 'N' COMMENT '������ ����ȯ�ҿ��� Y=����ȯ������, N=����ȯ�ҹ�����',
ADD `freeDelivery` ENUM( '0', '1' ) COMMENT '��ǰ�� �����å > �����ۻ�ǰ 0=�����ۻ�ǰ�� ����, 1=�ֹ�����ü ����',
ADD `goodsDelivery` ENUM( '0', '1', '2' ) COMMENT '��ǰ�� �����å > ��ǰ�� ��ۺ� 0=���ǰ�� ��ۺ�� �⺻��ۺ� �ջ�, 1=��ǰ�� ��ۺ�� �⺻��ۺ� �� �� ū ��ۺ�, 2=��ǰ�� ��ۺ��� ���հ� �⺻��ۺ� �� �� ū ��ۺ�';";

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