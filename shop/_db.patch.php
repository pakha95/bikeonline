<?

// C1. 라이브러리 로드
include "lib/library.php";

// C2. 실행쿼리
$query[] = "CREATE TABLE IF NOT EXISTS `gd_kakaoAlimtalk_sendlist` (
  `sno` int(10) unsigned NOT NULL auto_increment,
  `send_key` bigint(20) NOT NULL COMMENT '중계서버 구분키',
  `sms_mode` enum('r','i') NOT NULL COMMENT '발송형태',
  `alimtalk_memNo` int(10) NOT NULL COMMENT '회원번호',
  `alimtalk_logNo` int(10) NOT NULL COMMENT 'gd_kakaoAlimtalk_sendlog 테이블번호',
  `sms_logNo` int(10) NOT NULL,
  `send_contents` text NOT NULL COMMENT '전송된 메세지',
  `send_name` varchar(20) default NULL COMMENT '수신자명',
  `send_number` varchar(20) default NULL COMMENT '수신번호',
  `send_status` char(1) default NULL COMMENT '발송상태',
  `send_date` datetime default NULL COMMENT '수신 일자',
  `fail_code` varchar(255) default NULL COMMENT '실패메세지',
  PRIMARY KEY  (`sno`)
);";

$query[] = "CREATE TABLE IF NOT EXISTS `gd_kakaoAlimtalk_sendlog` (
  `sno` int(10) unsigned NOT NULL auto_increment,
  `template_name` varchar(255) NOT NULL COMMENT '템플릿명',
  `template_contents` text NOT NULL COMMENT '템플릿내용',
  `send_status` char(1) NOT NULL COMMENT '발송상태',
  `send_date` datetime NOT NULL COMMENT '발송시간',
  `reserve_date` datetime NOT NULL COMMENT '예약시간',
  `send_count` int(10) default NULL COMMENT '발송건수',
  `send_success_count` int(10) default NULL COMMENT '발송 성공 건수',
  `send_fail_count` int(10) default NULL COMMENT '발송 실패 건수',
  `request_fail_count` int(10) default NULL COMMENT '요청 실패 건수',
  `send_type` varchar(30) default NULL COMMENT '발송타입',
  PRIMARY KEY  (`sno`)
);";

$query[] = "CREATE TABLE IF NOT EXISTS `gd_kakaoAlimtalk_template` (
  `sno` int(10) unsigned NOT NULL auto_increment,
  `code` varchar(255) NOT NULL COMMENT '템플릿코드',
  `profile_type` varchar(1) NOT NULL COMMENT '발신프로필타입',
  `mode` varchar(255) NOT NULL COMMENT '템플릿구분',
  `name` varchar(255) NOT NULL COMMENT '템플릿명',
  `contents` text NOT NULL COMMENT '템플릿내용',
  `useYn` varchar(1) default NULL COMMENT '사용여부',
  `status` varchar(1) default NULL,
  `inspection_status` varchar(15) default NULL COMMENT '검사상태',
  `reg_date` datetime default NULL COMMENT '등록일',
  PRIMARY KEY  (`sno`),
  INDEX `code` (`code`)
);";

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