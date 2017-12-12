<?
class kakaoAlimtalk
{
	var $db, $config, $ordno, $kakaoAlimtalkAPI, $smsPt;

	function __construct()
	{
		global $db, $alimtalk;

		$this->db = $db;

		if (!$alimtalk) {
			@include dirname(__FILE__)."/../conf/kakaoAlimtalk.config.php";
		}
		$this->config = $alimtalk;

		if (!$kakaoAlimtalkAPI) {
			@include_once dirname(__FILE__)."/../lib/kakaoAlimtalkAPI.class.php";
			 $kakaoAlimtalkAPI = new  kakaoAlimtalkAPI();
		}
		$this->kakaoAlimtalkAPI = $kakaoAlimtalkAPI;

		$this->smsPt = $this->getSmsPoint();
	}

	/*
	 * 환경파일 저장
	 * @param array
	 * @return array
	 */
	function configSave($post)
	{
		@include_once dirname(__FILE__)."/../lib/qfile.class.php";
		$qfile = new qfile();

		unset($post['mode']);

		if ($this->config) {
			$post = array_merge($this->config, $post);
		}

		$qfile->open(dirname(__FILE__)."/../conf/kakaoAlimtalk.config.php");
		$qfile->write("<? \n");
		$qfile->write("\$alimtalk = array( \n");
		foreach ($post as $k=>$v) {
			if (strstr($v,'Array')) {
				$qfile->write("'$k' => array( \n");
				foreach ($v as $k2=>$v2) {
					$qfile->write("'$k2' => '$v2', \n");
				}
				$qfile->write("), \n");
			}else{
				$qfile->write("'$k' => '$v', \n");
			}
		}
		$qfile->write(") \n;");
		$qfile->write("?>");
		$qfile->close();
 
		@chmod(dirname(__FILE__)."/../conf/kakaoAlimtalk.config.php",0707);

		$this->templateUseUpdate($post);
	}

	/*
	 * 템플릿 저장
	 * @param array
	 * @return array
	 */
	function templateSave($post)
	{
		$query = "
		INSERT INTO ".GD_KAKAOALIMTALK_TEMPLATE." SET
			code = 'user_".$post["tmode"]."_".str_pad($post["increment"],'4','0',STR_PAD_LEFT)."',
			profile_type = 'g',
			mode = '".$post["tmode"]."',
			name = '".$post["name"]."',
			contents = '".$post["contents"]."',
			useYn = 'N',
			status = 'R',
			inspection_status = 'REG',
			reg_date = now()
		";

		$this->db->query($query);
	}

	/*
	 * 템플릿 Auto_increment 다음 번호 가져오기
	 * @param string
	 * @return array
	 */
	function getTemplateAuto_increment()
	{
		@include dirname(__FILE__)."/../conf/db.conf.php";
		$increment = $this->db->fetch("SHOW TABLE STATUS FROM ".$db_name." LIKE '".GD_KAKAOALIMTALK_TEMPLATE."'");

		return $increment['Auto_increment'];
	}

	/*
	 * 템플릿 리스트 쿼리
	 * @param string
	 * @return array
	 */
	function getTemplateQuery($get)
	{
		// 검색어
		if ($_GET['skey'] && $get['sword']) {
			if ($get['skey'] == 'all'){
				$where[] = "( concat( code, name, contents ) like '%".$get['sword']."%' )";
			}
			else $where[] = $get['skey']." like '%".$get['sword']."%'";
		}

		// 등록일
		if ($get['reg_date'][0] && $get['reg_date'][1]) {
			$where[] = "reg_date between date_format('".$get['reg_date'][0]."','%Y-%m-%d 00:00:00') and date_format('".$get['reg_date'][1]."','%Y-%m-%d 23:59:59')";
		}

		// 템플릿 구분
		if ($get['tmode'] != '') {
			$where[] = "mode='".$get['tmode']."'";
		}

		// 검수상태
		if ($get['inspection_status'] != '') {
			$where[] = "inspection_status='".$get['inspection_status']."'";
		}

		// 사용여부
		if ($get['useYn'] != '') {
			$where[] = "useYn='".$get['useYn']."'";
		}

		return $where;
	}

	/*
	 * 템플릿 데이터 전체 조회
	 * @param sno
	 * @return array
	 */
	function getTemplate()
	{
		$res = $this->db->query("SELECT code, mode, name, contents FROM ".GD_KAKAOALIMTALK_TEMPLATE." where inspection_status = 'APR' ",1);
		while ($temp = $this->db->fetch($res,1)) {
			$data[] = $temp;
		}

		return $data;
	}

	/*
	 * 템플릿 데이터 조회
	 * @param sno
	 * @return array
	 */
	function getTemplateData($code)
	{
		$query = $this->db->_query_print("SELECT code, mode, name, contents FROM ".GD_KAKAOALIMTALK_TEMPLATE." where code = [s]", $code);
		$data = $this->db->fetch($query,1);

		return $data;
	}

	/*
	 * 템플릿 데이터 수정
	 * @param array
	 * @return array
	 */
	function templateUpdate($post)
	{
		$this->db->query("UPDATE  ".GD_KAKAOALIMTALK_TEMPLATE." SET name = '".$post['name']."', contents = '".$post['contents']."' where code = '".$post['code']."'");

		return $data;
	}

	/*
	 * 템플릿 상태변경
	 * @param array
	 * @return array
	 */
	function templateStatusUpdate($post)
	{
		$this->db->query("UPDATE  ".GD_KAKAOALIMTALK_TEMPLATE." SET inspection_status = '".$post['inspection_status']."' where code = '".$post['code']."'");

		return $data;
	}

	/*
	 * 템플릿 사용여부 변경
	 * @param array
	 */
	function templateUseUpdate($post)
	{
		$this->db->query("UPDATE  ".GD_KAKAOALIMTALK_TEMPLATE." SET useYn = 'N' ");

		foreach($post as $k=> $v){
			foreach ($v as $k2 => $v2) {
				if ($k2 == 'memTemplate' || $k2 == 'adminTemplate') {
					$template[] = $v2;
				}
			}
		}

		$code = implode("','",$template);
		$this->db->query("UPDATE  ".GD_KAKAOALIMTALK_TEMPLATE." SET useYn = 'Y' where code in ('".$code."')");
	}

	/*
	 * 일반 템플릿 갱신
	 * @param array
	 * @return array
	 */
	function templateListUpdate($post)
	{
		$this->db->query("UPDATE  ".GD_KAKAOALIMTALK_TEMPLATE." SET contents = '".$post['contents']."' , inspection_status = '".$post['inspection_status']."' , status = '".$post['status']."' where code = '".$post['code']."'");

		return $data;
	}

	/*
	 * 그룹 템플릿 최초 갱신
	 * @param array
	 * @return array
	 */
	function groupTemplateUpdate()
	{
		// 템플릿 테이블에 데이터 체크
		$query = $this->db->_query_print("SELECT 1 FROM ".GD_KAKAOALIMTALK_TEMPLATE." limit 1");
		$checkData = $this->db->fetch($query,1);

		if ($checkData) {
			return;
		}

		$res = $this->kakaoAlimtalkAPI->groupTemplateList();
		if ($res['code'] == 'success') {
			for ($i=0; $i<count($res['data']); $i++) {
				$mode = explode('_',$res['data'][$i]['templateCode']);
				
				$query = $this->db->_query_print("
				INSERT INTO ".GD_KAKAOALIMTALK_TEMPLATE." SET
					code = [s],
					profile_Type = 'g',
					mode = [s],
					name = [s],
					contents = [s],
					useYn='N',
					inspection_status = [s],
					status = [s],
					reg_date = now()", $res['data'][$i]['templateCode'], $mode[1], $res['data'][$i]['templateName'], $res['data'][$i]['templateContent'], $res['data'][$i]['inspectionStatus'], $res['data'][$i]['status']);

				$this->db->query($query);
			}
		}

		return $data;
	}

	/*
	 * 발송메세지 기본 설정
	 * @param array
	 * @return array
	 */
	function alimtalkInitConfig()
	{
		if ($this->config['order']) {
			return;
		}

		$data = array(
			'use' => 'n',
			'order_use' => 'y', 
			'member_use' => 'y', 
			'board_use' => 'y', 
			'order' => array( 
				'sendDate' => '15', 
				'memTemplate' => 'group_order_0001', 
				'send_c' => 'on', 
				'adminTemplate' => 'group_order_0004', 
			), 
			'incash' => array( 
				'sendDate' => '15', 
				'memTemplate' => 'group_order_0005', 
				'send_c' => 'on', 
				'adminTemplate' => 'group_order_0006', 
			), 
			'account' => array( 
				'sendDate' => '15', 
				'useAccountAutoSend' => 'y', 
				'afterDate' => '3', 
				'accountSendTime' => '8', 
				'memTemplate' => 'group_order_0007', 
				'send_c' => 'on', 
			), 
			'delivery' => array( 
				'sendDate' => '15', 
				'memTemplate' => 'group_order_0008', 
				'send_c' => 'on', 
			), 
			'dcode' => array( 
				'sendDate' => '15', 
				'memTemplate' => 'group_order_0009', 
				'send_c' => 'on', 
			), 
			'cancel' => array( 
				'sendDate' => '15', 
				'memTemplate' => 'group_order_0010', 
				'send_c' => 'on', 
			), 
			'repay' => array( 
				'sendDate' => '15', 
				'memTemplate' => 'group_order_0011', 
				'send_c' => 'on', 
			), 
			'runout' => array( 
				'adminTemplate' => 'group_order_0012', 
			), 
			'join' => array( 
				'memTemplate' => 'group_member_0013', 
				'send_c' => 'on', 
				'adminTemplate' => 'group_member_0014', 
			), 
			'id_pass' => array( 
				'memTemplate' => 'group_member_0015', 
				'send_c' => 'on', 
			), 
			'dormant' => array( 
				'sendBeforeDay_30' => 'y', 
				'sendBeforeDay_7' => 'y', 
				'sendTime' => '9', 
				'memTemplate' => 'group_member_0016', 
				'send_c' => 'on', 
			), 
			'reception_agreement' => array( 
				'sendTime' => '9', 
				'memTemplate' => 'group_member_0017', 
				'send_c' => 'on', 
			), 
			'qna_register' => array( 
				'memTemplate' => 'group_board_0018', 
				'send_c' => 'on', 
				'adminTemplate' => 'group_board_0019', 
				'send_a' => 'on', 
				'send_m' => 'on', 
			), 
			'qna' => array( 
				'memTemplate' => 'group_board_0020', 
				'send_c' => 'on', 
			)
		);

		$this->configSave($data);
	}

	/*
	 * 템플릿 데이터 삭제
	 * @param sno
	 * @return array
	 */
	function templateDelete($post) {
		$this->db->query("DELETE FROM ".GD_KAKAOALIMTALK_TEMPLATE." where code = '".$post['code']."'");
	}

	/*
	 * 템플릿 데이터 초기화
	 * @param sno
	 * @return array
	 */
	function templateReset() {
		$this->db->query("DELETE FROM ".GD_KAKAOALIMTALK_TEMPLATE);
	}

	/*
	 * 발송내역 리스트 쿼리
	 * @param string
	 * @return array
	 */
	function getSendAlimtalkQuery($get)
	{
		// 검색어
		if ($_GET['skey'] && $get['sword']) {
			if ($get['skey'] == 'all'){
				$where[] = "( concat( template_name, template_contents ) like '%".$get['sword']."%' )";
			}
			else $where[] = $get['skey']." like '%".$get['sword']."%'";
		}

		// 발송시간
		if ($get['send_date'][0] && $get['send_date'][1]) {
			$where[] = "send_date between date_format('".$get['send_date'][0]."','%Y-%m-%d 00:00:00') and date_format('".$get['send_date'][1]."','%Y-%m-%d 23:59:59')";
		}

		// 발송상태
		if ($get['send_status'] != '') {
			$where[] = "send_status='".$get['send_status']."'";
		}

		return $where;
	}

	/*
	 * 발송내역 상세 리스트 쿼리
	 * @param string
	 * @return array
	 */
	function getSendAlimtalkDetailQuery($get)
	{
		// alimtalk_logNo
		if ($get['alimtalk_logNo'] != '') {
			$where[] = "alimtalk_logNo='".$get['alimtalk_logNo']."'";
		}

		// 검색어
		if ($_GET['skey'] && $get['sword']) {
			if ($get['skey'] == 'all'){
				$where[] = "( concat( send_number, send_contents ) like '%".$get['sword']."%' )";
			}
			else $where[] = $get['skey']." like '%".$get['sword']."%'";
		}

		// 발송상태
		if ($get['send_status'] != '') {
			$where[] = "send_status = '".$get['send_status']."'";
		}

		// 발송상태
		if ($get['fail_code'] != '') {
			switch ($get['fail_code']) {
				case 1 :
					$fail_code = "= 'K101'";
				break;

				case 2 :
					$fail_code = "= 'K102'";
				break;

				case 3 :
					$fail_code = "= 'K103'";
				break;

				case 4 :
					$fail_code = "= 'K104'";
				break;

				default :
					$fail_code = "NOT IN ('K101', 'K102', 'K103' ,'K104')";
				break;
			}
			$where[] = "fail_code ".$fail_code."";
		}

		return $where;
	}

	/*
	 * 알림톡 설정 체크
	 * @param string
	 * @return array
	 */
	function alimtalkConfigCheck($case='')
	{
		if ($this->config['use'] == 'y') {

			if ($case != '') {
				$res = $this->alimtalkDivisionCheck($case);
				return $res;
			}

			return true;
		}
		else {
			return false;
		}
	}

	/*
	 * 알림톡 구분 설정 체크
	 * @param string
	 * @return array
	 */
	function alimtalkDivisionCheck($case)
	{
		$orderDivision = array('order', 'incash', 'account', 'delivery', 'dcode', 'cancel', 'repay', 'runout');
		$memberDivision = array('join', 'id_pass', 'dormant', 'reception_agreement');
		$boardDivision = array('qna_register', 'qna');

		if (in_array($case,$orderDivision) === true) {
			if ($this->config['order_use'] == 'y') {
				return true;
			}
		}
		else if (in_array($case,$memberDivision) === true) {
			if ($this->config['member_use'] == 'y') {
				return true;
			}
		}
		else if (in_array($case,$boardDivision) === true) {
			if ($this->config['board_use'] == 'y') {
				return true;
			}
		}

		return false;
	}

	/*
	 * 알림톡 전송
	 * @param case : 발송타입 , code : 템플릿코드 , phoneNumber : 수신번호 , sendTime : 발송예약 시간
	 * @return array
	 */
	function sendAlimtalk($case, $code, $phoneNumber, $sendTime='', $m_no='')
	{
		// 수신번호 개수 체크
		if (is_array($phoneNumber) === true) {
			$count = count($phoneNumber);
		}
		else {
			$count = 1;
			$phoneNumber = array($phoneNumber);
		}

		// 템플릿 정보 조회
		$data = $this->getTemplateData($code);

		// 즉시 발송, 예약 발송 체크
		if (!$sendTime) {
			$data['tranDTime'] = 'now';
			$sms_mode = 'i';
		}
		else {
			$data['tranDTime'] = $sendTime;
			$sms_mode = 'r';
		}

		// 알림톡 전송 gd_kakaoAlimtalk_sendlog 저장
		$this->sendAlimtalkLogSave($data, $case, $count, $sendTime);
		$logSno = $this->db->_last_insert_id();

		// 치환코드 파싱
		$data['contents'] = $this->alimtalkParseCode($data['contents']);

		// 알림톡 전송
		$fail = 0;
		for ($i=0; $i<$count; $i++) {
			$data['phoneNumber'] = $phoneNumber[$i];
			$data['kakaoSendKey'] = time().str_pad(mt_rand(0,9999),"4","0",STR_PAD_LEFT);

			if ($m_no) {
				$member = $this->getMember('',$m_no);
			}
			else {
				$member = $this->getMember($data['phoneNumber'],'');
			}

			if ($this->smsPt < 0.6) {
				$this->sendAlimtalkListSave($data, $sms_mode, $member, $logSno, 'point', 'f');
				$fail = $count;
			}
			else {
				$this->sendAlimtalkListSave($data, $sms_mode, $member, $logSno, '', 'w');
				// 알림톡 발송
				$sendResult = $this->kakaoAlimtalkAPI->sendAlimtalk($data);

				if ($sendResult['result'] == 'success') {
					$this->smsPt = $this->smsPt - 0.6;
				}
				else {
					sendSmsLenType($data['contents'],$data['phoneNumber'],$case,'90');
					$sms_logNo = $this->getSmsLogNo($data['phoneNumber']);
					$this->sendAlimtalkListUpdate($data['kakaoSendKey'], 'f', $sendResult['msg'], $sms_logNo, '');

					$fail++;
				}

				$return[$member['m_no']] = $sendResult['result'];
			}
		}

		if ($fail > 0) {
			$send_status = 'f';
		}
		else {
			$send_status = 'w';
		}

		// 전송 실패 상태와 개수 업데이트
		$this->sendAlimtalkLogUpdate($logSno, $send_status, 0, $fail);

		// 포인트 갱신
		$this->updateSmsPoint();

		return $return;
	}

	/*
	 * 알림톡 전송 gd_kakaoAlimtalk_sendlog 데이터 저장
	 * @param sno
	 * @return array
	 */
	function sendAlimtalkLogSave($data, $case, $count, $sendTime)
	{
		$query = "
		INSERT INTO ".GD_KAKAOALIMTALK_SENDLOG." SET
			template_name = '".$data['name']."',
			template_contents = '".$data['contents']."',
			send_status = 'w',
			send_date = now(),
			reserve_date = '".$sendTime."',
			send_count = '".$count."',
			send_success_count = '0',
			send_fail_count = '0',
			request_fail_count = '0',
			send_type = '".$case."'
		";

		$this->db->query($query);
	}

	/*
	 * 알림톡 전송 gd_kakaoAlimtalk_sendlist 데이터 저장
	 * @param sno
	 * @return array
	 */
	function sendAlimtalkListSave($data, $sms_mode, $member, $logSno, $fail_code, $send_status)
	{
		$query = "
		INSERT INTO ".GD_KAKAOALIMTALK_SENDLIST." SET
			send_key = '".$data['kakaoSendKey']."',
			sms_mode = '".$sms_mode."',
			alimtalk_memNo = '".$member['m_no']."',
			alimtalk_logNo = '".$logSno."',
			send_contents = '".$data['contents']."',
			send_name = '".$member['name']."',
			send_number = '".$data['phoneNumber']."',
			send_status = '".$send_status."',
			fail_code = '".$fail_code."'
		";

		$this->db->query($query);
	}

	/*
	 * 발송 결과 갱신
	 * @return bool
	 */
	function updateSendResult($post)
	{
		$temp = array();

		if ($post['data']) {
			foreach ($post['data'] as $k => $v) {
				$logNo = $this->getSendlistLogNo($k);
				if (!$logNo) continue;

				if ($v['resultCode'] == 'K000') {
					$this->sendAlimtalkListUpdate($k, 's', '', '', $v['resultDate']);
					$temp[$logNo['alimtalk_logNo']]['s']++;
				}
				else {
					$sendData = $this->getSmsSendData($k);
					sendSmsLenType($sendData['send_contents'],$sendData['send_number'],$sendData['send_type'],'90');
					$sms_logNo = $this->getSmsLogNo($sendData['send_number']);

					$this->sendAlimtalkListUpdate($k, 'f', $v['resultCode'], $sms_logNo, $v['resultDate']);
					$temp[$logNo['alimtalk_logNo']]['f']++;
				}
			}

			foreach ($temp as $k2 => $v2) {
				$count = $this->getSendlogSendCount($k2);

				// 실패 이력이 존재하면 실패
				if ($v2['f'] > 0 || $count['request_fail_count'] > 0) {
					$send_status = 'f';
				}
				// 전부 성공
				else if ($v2['s'] == $count['send_count']) {
					$send_status = 's';
				}
				// 수신되지 않은 건이 있을경우
				if ($count['send_count'] > $v2['s']+$v2['f']){
					$send_status = 'w';
				}

				$this->sendAlimtalkLogUpdate($k2, $send_status, $v2['s']+$count['send_success_count'], $v2['f']+$count['request_fail_count']);
			}
		}
		else {
			return false;
		}

		return true;
	}

	/*
	 * gd_kakoAlimtalk_sendlist -> alimtalk_logNo 조회
	 * @param send_key
	 * @return alimtalk_logNo
	 */
	function getSendlistLogNo($send_key)
	{
		$alimtalk_logNo = $this->db->fetch("SELECT alimtalk_logNo FROM " . GD_KAKAOALIMTALK_SENDLIST . " WHERE send_key = '".$send_key."' and send_status = 'w' ",1);

		return $alimtalk_logNo;
	}

	/*
	 * SMS 재발송건을 위한 조회
	 * @param send_key
	 * @return alimtalk_logNo
	 */
	function getSmsSendData($send_key)
	{
		$sendlist = $this->db->fetch("SELECT list.send_contents, list.send_name, list.send_number, log.send_type FROM " . GD_KAKAOALIMTALK_SENDLIST . " list LEFT JOIN " . GD_KAKAOALIMTALK_SENDLOG . " log on list.alimtalk_logNo = log.sno WHERE send_key = '".$send_key."'",1);

		return $sendlist;
	}

	/*
	 * 알림톡 전송 LIST 결과 갱신
	 * @param sno
	 * @return array
	 */
	function sendAlimtalkListUpdate($send_key, $send_status, $fail_code, $sms_logNo='', $send_date)
	{
		$this->db->query("UPDATE ".GD_KAKAOALIMTALK_SENDLIST." SET send_status = '".$send_status."', fail_code = '".$fail_code."', sms_logNo = '".$sms_logNo."', send_date = '".$send_date."' where send_key = '".$send_key."'");
	}

	/*
	 * gd_kakoAlimtalk_sendlog -> send_count 조회
	 * @param sno
	 * @return send_count
	 */
	function getSendlogSendCount($sno)
	{
		$count = $this->db->fetch("SELECT send_count, send_success_count, send_fail_count, request_fail_count FROM " . GD_KAKAOALIMTALK_SENDLOG . " WHERE sno = '".$sno."'",1);

		return $count;
	}

	/*
	 * 알림톡 전송 요청실패
	 * @param sno
	 */
	function sendAlimtalkRequestFail($sno, $request_fail_count)
	{
		$this->db->query("UPDATE ".GD_KAKAOALIMTALK_SENDLOG." SET request_fail_count = '".$request_fail_count."' where sno = '".$sno."'");
	}

	/*
	 * 알림톡 전송 결과 갱신
	 * @param sno
	 */
	function sendAlimtalkLogUpdate($sno, $send_status, $send_success_count, $send_fail_count)
	{
		$this->db->query("UPDATE ".GD_KAKAOALIMTALK_SENDLOG." SET send_status = '".$send_status."', send_success_count = '".$send_success_count."', send_fail_count = '".$send_fail_count."' where sno = '".$sno."'");
	}

	/*
	 * 회원정보 조회
	 * @param sno
	 * @return array
	 */
	function getMember($phoneNumber, $m_no)
	{
		if ($m_no) {
			$member = $this->db->fetch("SELECT m_no, name FROM " . GD_MEMBER . " WHERE m_no = '" . $m_no . "' LIMIT 1",1);
		}
		else {
			$member = $this->db->fetch("SELECT m_no, name FROM " . GD_MEMBER . " WHERE mobile = '" . $phoneNumber . "' LIMIT 1",1);
		}

		return $member;
	}

	/*
	 * 재전송 된 SMS에서 sms_logNo 가져오기
	 * @param sno
	 * @return array
	 */
	function getSmsLogNo($phoneNumber)
	{
		$sms_logNo = $this->db->fetch("SELECT sms_logNo FROM " . GD_SMS_SENDLIST . " WHERE sms_phoneNumber = '" . $phoneNumber . "' ORDER BY sms_no DESC LIMIT 1",1);

		return $sms_logNo['sms_logNo'];
	}

	/*
	 * 발송상태
	 * @param char
	 * @return string
	 */
	function getSendStatus($status)
	{
		$array = array(
			's' => '발송성공',
			'f' => '발송실패',
			'w' => '결과수신대기',
			'r' => '발송대기',
		);

		return $array[$status];
	}

	/*
	 * 에러코드
	 * @param errorCode 에러코드
	 * @return string
	 */
	function errorCode($errorCode)
	{
		$code = array(
			'K000' => '성공',
			'K101' => '메시지를 전송할 수 없음',
			'K102' => '전화번호 오류',
			'K103' => '메시지 길이제한 오류',
//			'K104' => '템플릿을 찾을 수 없음',
//			'K105' => '메시지 내용이 템플릿과 일치하지 않음',
//			'K106' => '첨부 이미지 URL 또는 링크가 올바르지 않음',
			'K999' => '시스템오류',
//			'E101' => '요청 데이터 오류',
//			'E102' => '발신 프로필키 없거나 유효하지 않음',
//			'E103' => '템플릿 코드가 없음',
//			'E104' => '잘못된 전화번호',
//			'E105' => '유효하지 않은 SMS 발신번호',
//			'E106' => '메시지 내용이 없음',
//			'E108' => '잘못된 예약일자',
//			'E109' => '중복된 Msg ID',
//			'E110' => 'Msg ID 찾을 수 없음',
//			'E111' => '첨부 이미지 URL 정보를 찾을 수 없음',
//			'E112' => '메시지 길이제한 오류',
//			'E113' => '메시지 ID 길이제한 오류',
//			'E998' => '최대 요청 수 초과',
//			'E999' => '시스템오류'
			'point' => '포인트 부족'
		);

		if (!$errorCode) {
			$code[$errorCode] = '-';
		}
		else if (!$code[$errorCode]) {
			$code[$errorCode] = '기타 사유';
		}

		return $code[$errorCode];
	}

	/*
	 * 치환코드 파싱
	 * @param sno
	 * @return array
	 */
	function alimtalkParseCode($str)
	{
		@extract($GLOBALS['cfg']); @extract($GLOBALS['dataSms']); @extract($_REQUEST);

		// 환불 메세지 전송시 주문번호가 배열로 되어 있어서 재정의
		if ($this->ordno != '') {
			$ordno = $this->ordno;
		}

		if (!preg_match('/http(s)?:\/\//' , $shopUrl)) {
			$shopUrl = 'http://'.$shopUrl;
		}
		else {
			$shopUrl = $shopUrl;
		}

		$orderhp = '';
		if(count($mobileOrder) > 1)$orderhp = implode('-',$mobileOrder);
		else $orderhp = $mobileOrder;

		$str = preg_replace("/#+{([a-zA-Z]+)}/","{\$$1}",$str);
		eval("\$str = \"$str\";");
		$str = remainOnlyEucKr($str);
		$this->ordno = '';
		return $str;
	}

	/*
	 * 로그
	 * @param 
	 * @return array
	 */
	function alimtalkLog($message)
	{
		if (is_array($message)) {
			foreach ($message as $k => $v) {
				$msg .= $k.' : '.$v.chr(9);
			}
		}
		else {
			$msg = $message;
		}

		if (is_dir(dirname(__FILE__) . '/../log') === true) {
			$logPath = dirname(__FILE__) . '/../log/kakaoAlimtalk';
			if (is_dir($logPath) === false) {
				mkdir($logPath);
				chmod($logPath,0707);
			}

			$saveLogFileName = $logPath . '/alimtalkLog_' . date('Ym') . '.log';
			$logMessage = ' [' . date('Y-m-d H:i:s') . '] ' . $msg . PHP_EOL;
			@error_log($logMessage, 3, $saveLogFileName);
		}
	}

	/*
	 * sms 포인트 확인
	 * @param 
	 * @return array
	 */
	function getSmsPoint()
	{
		if (file_exists(dirname(__FILE__)."/../conf/sms.cfg.php")) {
			$file = file(dirname(__FILE__)."/../conf/sms.cfg.php");
			$sms = trim($file[1]);
		}
		else {
			@include_once dirname(__FILE__)."/../lib/sms.class.php";
			$smscl = new Sms();
			$smscl -> update();
			$sms = $smscl -> smsPt;
		}
		return $sms;
	}

	/*
	 * sms 포인트 갱신
	 * @param
	 * @return
	 */
	function updateSmsPoint()
	{
		$file = dirname(__FILE__)."/../conf/sms.cfg.php";
		if(is_file($file)) unlink($file);
		$fp = fopen($file,"w");
		fwrite($fp,"<?/* \n");
		fwrite($fp,$this->smsPt."\n");
		fwrite($fp,"*/?>");
		fclose($fp);
		@chmod($file,0707);
	}
}
?>