<?

// C1. 라이브러리 로드
include "lib/library.php";

// C2. 실행쿼리
$query[] = "ALTER TABLE `gd_member` ADD `zonecode` varchar(5) default NULL COMMENT '구역번호';";
$query[] = "ALTER TABLE `gd_order` ADD `zonecode` varchar(5) default NULL COMMENT '구역번호';";
$query[] = "ALTER TABLE `gd_order_del` ADD `zonecode` varchar(5) default NULL COMMENT '구역번호';";
$query[] = "ALTER TABLE `gd_favorite_address` ADD `fa_zonecode` varchar(5) default NULL COMMENT '구역번호';";

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