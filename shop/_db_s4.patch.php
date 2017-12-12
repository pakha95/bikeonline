<?

// C1. 라이브러리 로드
include "lib/library.php";

// C2. 실행쿼리
$query[] = "CREATE TABLE IF NOT EXISTS `gd_order_item_delivery` (
	`oi_delivery_idx` int(11) NOT NULL auto_increment COMMENT '배송비 idx',
	`ordno` bigint(20) NOT NULL COMMENT '주문번호',
	`delivery_price` int(11) NOT NULL COMMENT '최초배송비',
	`prn_delivery_price` int(11) NOT NULL COMMENT '배송비(취소반영)',
	`delivery_type` varchar(3) NOT NULL COMMENT '배송타입(배송타입코드, 추가배송코드-지역별배송비)',
	`conditional_price` int(11) default NULL COMMENT '조건부 배송조건 (조건무 무료 배송일때 무료배송 기준값)',
	PRIMARY KEY  (`oi_delivery_idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=euckr AUTO_INCREMENT=1 ;";

$query[] = "CREATE TABLE IF NOT EXISTS `gd_order_item_delivery_log` (
	`oid_log_idx` int(11) NOT NULL auto_increment COMMENT '변경이력 idx',
	`oi_delivery_idx` int(11) NOT NULL COMMENT '배송비 idx',
	`delivery_price` int(11) NOT NULL COMMENT '부과/환불된 배송비',
	`log_type` varchar(1) NOT NULL COMMENT '변경로그 타입 (a = 주문등록, m = 주문취소 차감, p = 주문취소 부과)',
	`change_date` datetime NOT NULL COMMENT '변경일자',
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

$query[] = "ALTER TABLE `gd_order` ADD `settleInflow` VARCHAR( 10 ) NULL COMMENT '추가결제수단(payco)',
ADD `payco_reserve_order_no` varchar(20) NULL COMMENT '페이코 주문예약번호',
ADD `payco_use_point` int(11) NOT NULL default 0 COMMENT '결제내역 > 페이코 포인트 사용금액',
ADD `payco_use_point_repay` int(11) NOT NULL default 0 COMMENT '페이코 포인트 환불금액',
ADD `payco_order_no` varchar(20) NULL COMMENT '페이코 주문번호',
ADD `payco_settle_type` varchar(8) NULL COMMENT '페이코 주문유형 checkout = 간편구매, easypay = 간편결제',
ADD `add_extra_fee_duplicate_free` ENUM( '1', '0' ) NOT NULL COMMENT '주문당시 무료배송 상품 지역별 배송비 중복부과여부(1=중복부과, 0=1회부과)',
ADD `add_extra_fee_duplicate_fixEach` ENUM( '1', '0' ) NOT NULL COMMENT '주문당시 고정배송 상품 지역별 배송비 중복부과여부(1=중복부과, 0=1회부과)',
ADD `add_extra_fee_duplicate_each` ENUM( '1', '0' ) NOT NULL COMMENT '주문당시 개별배송상품 지역별 배송비 중복부과여부(1=중복부과, 0=1회부과)',
ADD `payco_coupon_use_yn` ENUM( 'Y', 'N' ) NOT NULL default 'N' COMMENT '페이코쿠폰 사용여부 Y=사용, N=미사용',
ADD `payco_coupon_price` int(11) NOT NULL default '0' COMMENT '페이코쿠폰 사용금액',
ADD `payco_coupon_repay`  ENUM( 'Y', 'N' ) NOT NULL default 'N' COMMENT '페이코쿠폰 취소여부 Y=취소함, N=취소안함',
ADD `payco_firsthand_refund`  ENUM( 'Y', 'N' ) NOT NULL default 'N' COMMENT '페이코 수기환불여부 Y=수기환불진행, N=수기환불미진행',
ADD `freeDelivery` ENUM( '0', '1' ) COMMENT '상품별 배송정책 > 무료배송상품 0=무료배송상품만 무료, 1=주문건전체 무료',
ADD `goodsDelivery` ENUM( '0', '1', '2' ) COMMENT '상품별 배송정책 > 상품별 배송비 0=비상품별 배송비와 기본배송비를 합산, 1=상품별 배송비와 기본배송비 중 더 큰 배송비, 2=상품별 배송비의 총합과 기본배송비 중 더 큰 배송비';";

$query[] = "ALTER TABLE `gd_order_item` ADD `oi_delivery_idx` int(11) NULL COMMENT '페이코주문 item 배송비 Table idx 배송비 그룹번호 사용',
ADD `oi_area_idx` int(11) NULL COMMENT '지역별 배송비(gd_order_item_delivery idx)';";

$query[] = "ALTER TABLE `gd_order_cancel` ADD `rpayco_point` INT( 11 ) NOT NULL default 0 COMMENT '취소된 페이코 포인트(가상계좌전용)',
ADD `rpayco_point_fee` INT( 11 ) NOT NULL default 0 COMMENT '수수료로 사용한 페이코 포인트(가상계좌전용)';";

$query[] = "ALTER TABLE `gd_order_del` ADD `settleInflow` VARCHAR( 10 ) NULL COMMENT '추가결제수단(payco)',
ADD `payco_reserve_order_no` varchar(20) NULL COMMENT '페이코 주문예약번호',
ADD `payco_use_point` int(11) NOT NULL default 0 COMMENT '결제내역 > 페이코 포인트 사용금액',
ADD `payco_use_point_repay` int(11) NOT NULL default 0 COMMENT '페이코 포인트 환불금액',
ADD `payco_order_no` varchar(20) NULL COMMENT '페이코 주문번호',
ADD `payco_settle_type` varchar(8) NULL COMMENT '페이코 주문유형 checkout = 간편구매, easypay = 간편결제',
ADD `add_extra_fee_duplicate_free` ENUM( '1', '0' ) NOT NULL COMMENT '주문당시 무료배송 상품 지역별 배송비 중복부과여부(1=중복부과, 0=1회부과)',
ADD `add_extra_fee_duplicate_fixEach` ENUM( '1', '0' ) NOT NULL COMMENT '주문당시 고정배송 상품 지역별 배송비 중복부과여부(1=중복부과, 0=1회부과)',
ADD `add_extra_fee_duplicate_each` ENUM( '1', '0' ) NOT NULL COMMENT '주문당시 개별배송상품 지역별 배송비 중복부과여부(1=중복부과, 0=1회부과)',
ADD `payco_coupon_use_yn` ENUM( 'Y', 'N' ) NOT NULL default 'N' COMMENT '페이코쿠폰 사용여부 Y=사용, N=미사용',
ADD `payco_coupon_price` int(11) NOT NULL default '0' COMMENT '페이코쿠폰 사용금액',
ADD `payco_coupon_repay`  ENUM( 'Y', 'N' ) NOT NULL default 'N' COMMENT '페이코쿠폰 취소여부 Y=취소함, N=취소안함',
ADD `payco_firsthand_refund`  ENUM( 'Y', 'N' ) NOT NULL default 'N' COMMENT '페이코 수기환불여부 Y=수기환불진행, N=수기환불미진행',
ADD `freeDelivery` ENUM( '0', '1' ) COMMENT '상품별 배송정책 > 무료배송상품 0=무료배송상품만 무료, 1=주문건전체 무료',
ADD `goodsDelivery` ENUM( '0', '1', '2' ) COMMENT '상품별 배송정책 > 상품별 배송비 0=비상품별 배송비와 기본배송비를 합산, 1=상품별 배송비와 기본배송비 중 더 큰 배송비, 2=상품별 배송비의 총합과 기본배송비 중 더 큰 배송비';";

// C3. 에러발생여부
$occursError = false;

// C4. 쿼리 실행
if (strtoupper(get_class($db)) === 'GODO_DB') { // GODO DB객체일때(시즌4 이상)
	foreach ($query as $v) {
		$db->query($v);
		if ($db->errorCode()) {
			debug($db->errorInfo());
			$occursError = true;
		}
	}
}
else if (strtoupper(get_class($db)) === 'DB') { // DB객체일때(시즌1,2,3)
	foreach ($query as $v) {
		$db->query($v);
		if (mysql_errno($db->db_conn)) {
			debug(mysql_error($db->db_conn));
			$occursError = true;
		}
	}
}
else { // 지정된 DB객체가 아닌경우
	debug('DB객체를 찾을 수 없습니다. 고객센터로 문의주시기 바랍니다.');
	$occursError = true;
}

// C5. 에러가 발생하지 않았다면 패치성공여부 출력
if ($occursError === false) debug('정상적으로 DB패치가 완료되었습니다.');

?>