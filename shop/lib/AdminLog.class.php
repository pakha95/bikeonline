<?php
class AdminLog extends Log {

	/**
	 * ������ �α� �⺻ ��å
	 * View �� �⺻������ ��� �α� ó�� ����
	 * Action �� �⺻������ ��� �α� ó�� ��
	 *
	 * ������������ ����(6���� ����) - ������ġ shop/log/admin/loginfo
	 * ������������� ����(3�� ����) - ������ġ shop/log/admin/logadmin - (level , nowLevel �� 80 �̻� ���)
	 * �⺻ �α� ����(14�� ����) - ������ġ shop/log/admin/logbasic
	 */
	// �α� ���� �⺻ dir
	var $logAdminDir;
	// �α� ���� ����
	var $dataServer;
	var $dataPost;
	var $dataGet;
	var $dataSession;
	// �α� ���� ����
	var $logException;
	// ���� ���
	var $transMode;
	// ���� ����
	var $transFile;
	// �α� ���� ���� �Ⱓ
	var $expiredAdmin = 0;
	var $expiredInfo = 0;
	var $expiredBasic = 0;
	// �⺻ View / Action �α� ���� ����
	var $logViewException;
	var $logActionException;
	// �������� ����
	var $logPersonal;

	function AdminLog($dataServer, $dataPost) {
		// ������ �α� �⺻ Dir
		$this->setLogAdminDir();
		// ������ �α� ��ȣ Dir
		$this->setLogProtectDir($this->getLogAdminDir());
		// ������ �α� ������
		$this->setExpiredTime();
		// ������ �α� ���� ���� ����(View/Action/Personal)
		$this->setLogViewException();
		$this->setLogActionException();
		$this->setLogPersonal();
		// ������ �α� ����
		$this->setServerData($dataServer);
		$this->setPostData($dataPost);
		$this->setSessionData();
		if($dataServer['QUERY_STRING']) {
			$this->setGetData($dataServer['QUERY_STRING']);
		}
		if($this->getServerData()) {
			// ������ �α� ���� ����(order/indb.php)
			$this->setTransFile();
		}
		if($this->getPostData() || $this->getGetData()) {
			// ������ �α� ���� ���
			$this->setTransMode();
		}
		// ������ �α� ó�� ����(�α� �������� ������)
		$this->setLogException();

		// ���� �α������� �����ϸ� ����/��������� �������� ����
		$todayLogFile = $this->buildPath($this->getLogDir(),$this->getLogFile());
		if(!file_exists($todayLogFile)) {
			$this->makeZipAdminLog();
			$this->deletePathArray($this->getExpiredAdminLog());
		}
	}

	function setLogAdminDir() {
		$this->logAdminDir = $this->getAbsolutePath(dirname(__FILE__).'/../log/admin');
	}

	function setExpiredTime() {
		$nowYear = date('Y');
		$nowMon = date('m');
		$nowDay = date('d');
		$this->expiredAdmin = mktime(0, 0, 0, $nowMon, $nowDay-1, $nowYear-3);
		$this->expiredInfo = mktime(0, 0, 0, $nowMon-6, $nowDay-1, $nowYear);
		$this->expiredBasic = mktime(0, 0, 0, $nowMon, $nowDay-15, $nowYear);
	}

	function setServerData($dataServer) {
		$nowtime = $dataServer['REQUEST_TIME'] ? $dataServer['REQUEST_TIME'] : time();
		$this->dataServer = array(
			"REQUEST_TIME"=>date("Y.m.d H:i:s", $nowtime),
			"SCRIPT_FILENAME"=>$dataServer['SCRIPT_FILENAME'],
			"REMOTE_ADDR"=>$dataServer['REMOTE_ADDR'],
//			"REMOTE_PORT"=>$dataServer['REMOTE_PORT'],
//			"DOCUMENT_ROOT"=>$dataServer['DOCUMENT_ROOT'],
//			"HTTP_USER_AGENT"=>$dataServer['HTTP_USER_AGENT'],
//			"HTTP_REFERER"=>$dataServer['HTTP_REFERER'],
//			"HTTP_COOKIE"=>$dataServer['HTTP_COOKIE'],
		);
	}

	function setPostData($dataPost) {
		if($this->getTransFile() == 'order/indb.php') {
			$this->dataPost = $dataPost;
		} else {
			$this->dataPost = array(
				"mode"=>$dataPost['mode'],
				"mId"=>$dataPost['m_id'],
				"level"=>$dataPost['level'],
				"ordNo"=>$dataPost['ordno'],
				"step"=>$dataPost['step'],
				"chk"=>$dataPost['chk'],
				"step"=>$dataPost['case'],
				"sno"=>$dataPost['sno'],
				"goodsno"=>$dataPost['goodsno'],
				"category"=>$dataPost['category'],
				"hidden"=>$dataPost['hidden'],
				"hiddenMoblie"=>$dataPost['hidden_moblie'],
				"price"=>$dataPost['goods_price'],
				"ord_status"=>$dataPost['ord_status'],
				"process"=>$dataPost['process'],
			);
			if($this->dataPost['mId'] && $this->dataPost['level']) {
				$this->dataPost['nowLevel'] = $this->getMemberLevel($this->dataPost['mId']);
			}
		}
	}

	function setGetData($queryString) {
		parse_str($queryString,$dataGet);
		if($this->getTransFile() == 'order/indb.php') {
			$this->dataGet = $dataGet;
		} else {
			$this->dataGet = array(
				"mode"=>$dataGet['mode'],
				"mId"=>$dataGet['m_id'],
				"level"=>$dataGet['level'],
				"ordNo"=>$dataGet['ordno'],
				"sno"=>$dataGet['sno'],
				"goodsno"=>$dataGet['goodsno'],
				"category"=>$dataGet['category'],
				"hidden"=>$dataGet['hidden'],
				"hiddenMoblie"=>$dataGet['hidden_moblie'],
				"price"=>$dataGet['goods_price'],
				"func"=>$dataGet['func'],
				"type"=>$dataGet['type'],
				"goodstype"=>$dataGet['goodstype'],
				"OrderID"=>$dataGet['OrderID'],
				"ProductOrderIDList"=>$dataGet['ProductOrderIDList'],
			);
			if($this->dataGet['mId'] && $this->dataGet['level']) {
				$this->dataGet['nowLevel'] = $this->getMemberLevel($this->dataGet['mId']);
			}
		}
	}

	function setSessionData() {
		$this->dataSession = array(
			"adminId"=>$_SESSION['sess']['m_id'],
			"adminLevel"=>$_SESSION['sess']['level'],
		);
	}

	function setTransFile() {
		$dataServer = $this->getServerData();
		// ������ ���� ������ ����/���ϸ� (ex, order/indb.php)
		$fileUrl = $dataServer['SCRIPT_FILENAME'];
		$thisUrlArr = explode(DIRECTORY_SEPARATOR, $fileUrl);
		$this->transFile = $thisUrlArr[sizeof($thisUrlArr)-2].DIRECTORY_SEPARATOR.$thisUrlArr[sizeof($thisUrlArr)-1];
	}

	function setTransMode() {
		$dataPost = $this->getPostData();
		$dataGet = $this->getGetData();
		// ������ ó�� mode
		$this->transMode = $dataPost['mode'] ? $dataPost['mode'] : $dataGet['mode'];
	}

	function setLogViewException() {
		$this->logViewException = array(
			"File" => array(
				"member/info.php",// ȸ�� ���� ����
				"member/Crm_view.php",// CRM ȸ�� ���� ����
				"order/view.php",// �ֹ� ���� ����
				"member/list.php",// ȸ������Ʈ
				"member/Crm_info.php",// CRM
				"member/orderlist.php",// ���ų���
				"member/popup.emoney.php",// �����ݳ���
				"member/popup.coupon.php",// ��������
				"member/Crm_counsel.php",// ��㳻��
				"member/Crm_member_qna.php",// 1:1���ǳ���
				"member/hack_register.php",// ȸ��Ż�𳻿� �󼼳���
				"member/hack.php",// ȸ��Ż��/��������
				"member/batch.php",// ȸ���ϰ�����
				"member/mail.php",// ����/��ü ���Ϻ�����
				"member/sms.php",// SMS ������
				"member/popup.sms.php",// SMS �ۼ�
				"member/sms.member_list.php",// SMS ȸ�� �ּҷ�
				"member/sms.address_list.php",// SMS �Ϲ� �ּҷ�
				"member/popup.sms.sendList.php",// SMS �߼۰�� ��
				"log/popu.cart.detail.php",// �� ��ǰ�� ��ٱ��Ͽ� ���� �� ����Ʈ
				"log/index.php",// �湮�м�
				"log/mem.emoney.php",// ȸ�� ������ �м�
				"dormant/adm_dormant_dormantMemberList.php",// �޸� ȸ�� ����Ʈ
				"dormant/adm_dormant_dormantTobeMemberList.php",// �޸� ��ȯ ���� ȸ�� ����Ʈ
				"order/_paper.php",// �ֹ����� ����Ʈ
				"order/list.php",// �ֹ� ����Ʈ
				"order/misu_list.php",// �Աݴ�⸮��Ʈ
				"order/cs.php",// �ֹ���Ҹ���Ʈ
				"order/regoods.php",// ��ǰ/��ȯ��������Ʈ
				"order/repay.php",// ȯ����������Ʈ
				"order/member_qna.php",// 1:1 ���ǰ���
				"order/list.integrate.php",// �ֹ����ո���Ʈ
				"order/dnXls_integrate.php",// �ֹ� ��������
				"order/list.step0.php",// �Աݴ�� ����Ʈ
				"order/list.step1.php",// �Ա�Ȯ�� ����Ʈ
				"order/list.step2.php",// ����غ��� ����Ʈ
				"order/list.step3.php",// ����� ����Ʈ
				"order/list.step4.php",// ��ۿϷ� ����Ʈ
				"order/list.cancel.php",// ��� ����Ʈ
				"order/list.claim.php",// ��ǰ/��ȯ ����Ʈ
				"order/list.repay.php",// ȯ�� ����Ʈ
				"order/favoriteAddress_list.php",// ���� ���� �ּҷ�
				"board/list_management_indb.php",// �Խñ� ó��
				"board/list_management.php",// �Խñ� ���հ���
				"board/goods_qna.php",// ��ǰ���ǰ���
				"board/goods_review.php",// ��ǰ�ı����
				"board/member_qna.php",// 1:1 ���ǰ���
				"board/cooperation.php",// �������޹���
				"board/customer_register.php",// 1:1���� �亯����
				"event/coupon_apply.php",// �����߱�/��ȸ
				"event/popup.member.php",// ȸ���˻�
				"event/attendance_list.php",// �⼮üũ ����Ʈ
				"event/attendance_detail.php",// �⼮üũ �⼮�� ��Ȳ
				"event/attendance.indb.php",// �⼮üũ ó��
				"order/todayshop_list_i.php",// �����̼� �ֹ�����Ʈ
				"order/todayshop_list_b.php",// �����̼� �ֹ�����Ʈ
				"order/checkout.orderlist.php",// ���̹�üũ�ƿ� 4.0 ��ü�ֹ���ȸ
				"order/checkout.view.php",// ���̹�üũ�ƿ� 4.0 �ֹ���
				"order/checkout.api.process.php",// ���̹�üũ�ƿ� 4.0 ó��
				"order/checkout.payed.php",// ���̹�üũ�ƿ� 4.0 �Ա�Ȯ�θ���Ʈ
				"order/checkout.placed.php",// ���̹�üũ�ƿ� 4.0 ����غ��߸���Ʈ
				"order/checkout.delivering.php",// ���̹�üũ�ƿ� 4.0 ����߸���Ʈ
				"order/checkout.delivered.php",// ���̹�üũ�ƿ� 4.0 ��ۿϷḮ��Ʈ
				"order/checkout.complete.php",// ���̹�üũ�ƿ� 4.0 ����Ȯ������Ʈ
				"order/checkout.cancel.php",// ���̹�üũ�ƿ� 4.0 ��Ҹ���Ʈ
				"order/checkout.return.php",// ���̹�üũ�ƿ� 4.0 ��ǰ����Ʈ
				"order/checkout.exchange.php",// ���̹�üũ�ƿ� 4.0 ��ȯ����Ʈ
				"order/checkout.list.php",// ���̹�üũ�ƿ� ��ü�ֹ���ȸ
				"order/checkout.placeorder.php",// ���̹�üũ�ƿ� ����ó��
				"order/checkout.shiporder.php",// ���̹�üũ�ƿ� �߼�ó��
				"order/checkout.cancelsale.php",// ���̹�üũ�ƿ� �Ǹ����ó��
				"order/checkout.cancelorder.php",// ���̹�üũ�ƿ� �ֹ����ó��
				"order/checkout.cancelshipping.php",// ���̹�üũ�ƿ� �߼����ó��
				"order/checkout.api.PlaceOrder.php",// ���̹� üũ�ƿ�
				"order/checkout.api.ShipOrder.php",// ���̹� üũ�ƿ�
				"order/checkout.api.CancelSale.php",// ���̹� üũ�ƿ�
				"order/checkout.api.CancelOrder.php",// ���̹� üũ�ƿ�
				"order/checkout.api.CancelShipping.php",// ���̹� üũ�ƿ�
				"order/checkout.inquiry.php",// ���̹�üũ�ƿ� ���ǰ�
				"order/cashreceipt.list.php",// ���ݿ����� �߱�/��ȸ
				"order/cashreceipt.info.php",// ���ݿ����� ��û���� ��ȸ
				"order/taxapp.php",// �Ϲݹ����û����Ʈ
				"order/taxissue.php",// �Ϲݹ��೻������Ʈ
				"order/tax_dnXls.php",// �Ϲݹ��೻�� ó��
				"order/godotax.list.php",// ���ڼ��ݰ�꼭 �߱޿�û���
				"order/godotax.modify.indb.php",// 
				"order/godotax.send.indb.php",// 
				"order/indb.godopost.reserve.php",// ��ü���ù� ó��
				"order/post_list.php",// ��ü���ù� �����ȣ�߱�
				"order/post_reserve.php",// ��ü���ù� �����ϱ�
				"order/goodsflow.invoice.php",// �½��÷� �����ȣ �߱�
				"order/popup.favorite_address.php",// ���� ���� �ּҷ� ó��
				"order/ghostbanker.php",// ��Ȯ�� �Ա��� ����Ʈ ����
				"order/bankmatch.php",// �Ա���ȸ / �ǽð��Ա�Ȯ��
				"order/goodsflow.standby.php",// �½��÷� ��۴�⸮��Ʈ
				"auctionIpay/orderlist.php",// ���� iPay ���� �ֹ�����Ʈ
				"goods/goods_qna.php",// ��ǰ���ǰ���
				"goods/goods_review.php",// ��ǰ�ı����
				"member/delivery_list.php",//����� ���� �˾�
				"member/delivery_form.php",//����� ���� �˾�
				"member/delivery_indb.php",//����� ���� �˾�
			),
		);
	}

	function setLogActionException() {
		$this->logActionException = array(
			// �⺻ Action �α����� �̳� �α����� ���ϸ���Ʈ
			"File" => array(
				"basic/popup.newAreaDeliveryAdd.php",// ��������ۺ� ����ϴ� �˾�
				"design/iframe.default.php",// ������ �⺻ ����
				"codi/_ajax.php",// ������ �⺻
				"proc/adm_panel_API.php",// ������ ���� �ε�
				"basic/adm_basic_widget_service_execute.php",// ������ ���� �ε�
				"proc/remote_godopage.php",// ������
			),
			// �⺻ Action �α����� �̳� �α����� mode����Ʈ
			"Mode" => array(
				"getPanel",// �г�
				"getCodiTree",// �г�
				"month_info",// �г�
				"get",// �г�
				"getCategory",// �г�
			),
		);
	}

	function setLogPersonal() {
		$this->logPersonal = array(
			// ���������� ó���Ǵ� ���ϸ���Ʈ
			"Information" => array(
				"member/indb.php?addGrp", // ȸ�� �׷��߰�
				"member/indb.php?modGrp", // ȸ�� �׷����
				"member/indb.php?delGrp", // ȸ�� �׷����
				"member/indb.php?modify", // ȸ�� ����
				"member/indb.php?delete", // ȸ�� ����
				"member/info.php",// ȸ�� ���� ����
				"member/Crm_view.php",// CRM ȸ�� ���� ����
				"order/view.php",// �ֹ� ���� ����
				"member/indb.php?emoney_add",
				"member/indb.php?emoney_delete",
				"member/hack_indb.php?delete",
			),
			// ������������ڷ� ó���Ǵ� ���ϸ���Ʈ
			"Admin" => array(
				"member/indb.php?adminModify", // ������ ��� ����
				"member/indb.php?addGrp", // ȸ�� �׷��߰�
				"member/indb.php?modGrp", // ȸ�� �׷����
				"member/indb.php?delGrp", // ȸ�� �׷����
				"member/indb.php?modify", // ȸ�� ����
				"member/indb.php?delete", // ȸ�� ����
			),
		);
	}

	/**
	 * �α� ������� �ʴ� ���� Ȯ��
	 * ������ ����,����,������ �ƴ� �ҷ����� ���� file �� �α� ��� ����
	 */
	function setLogException() {
		$this->logException = FALSE;
		$thisFile = $this->getTransFile();
		$thisMode = $this->getTransMode();

		$logView = 0;
		foreach($this->logViewException['File'] as $value) {
			if($thisFile == $value) {
				$logView++;
			}
		}

		if(ADMINLOGSTATE != 'NO' || $logView > 0) {
			$logFile = 0;
			foreach($this->logActionException['File'] as $value) {
				if($thisFile == $value) {
					$logFile++;
				}
			}
			$logMode = 0;
			foreach($this->logActionException['Mode'] as $value) {
				if($thisMode == $value) {
					$logMode++;
				}
			}
			if($logFile == 0 && $logMode == 0) {
				$this->logException = TRUE;
			}
		}
	}

	function getExpiredTime() {
		$expiredTime['logadmin'] = $this->expiredAdmin;
		$expiredTime['loginfo'] = $this->expiredInfo;
		$expiredTime['logbasic'] = $this->expiredBasic;
		return $expiredTime;
	}

	function getTransFile() {
		return $this->transFile;
	}
	function getTransMode() {
		return $this->transMode;
	}

	function getServerData() {
		return $this->dataServer;
	}

	function getPostData() {
		return $this->dataPost;
	}

	function getGetData() {
		return $this->dataGet;
	}

	function getSessionData() {
		return $this->dataSession;
	}

	function getLogException() {
		return $this->logException;
	}

	function getLogAdminDir() {
		return $this->logAdminDir;
	}

	function getLogViewException() {
		return $this->logViewException;
	}

	function getLogActionException() {
		return $this->logActionException;
	}

	function getLogPersonal() {
		return $this->logPersonal;
	}
	/**
	 * ��������/��������ó����/�⺻ �� Ȯ��
	 * �������� �� ��������ó���� ó���� ���� ������ �����ϱ� ����
	 */
	function getLogDirectory() {
		// �⺻
		$logDirType = 'logbasic';
		$thisFile = $this->getTransFile();
		$thisMode = $this->getTransMode();
		$logPersonal = $this->getLogPersonal();
		$dataPost = $this->getPostData();
		$dataGet = $this->getGetData();

		// ����� �������� ���� ���� üũ
		foreach($logPersonal['Information'] as $value) {
			$urlParse = parse_url($value);
			$url = $urlParse['path'];
			$mode = $urlParse['query'];
			if($thisFile == $url && $thisMode == $mode) {
				$logDirType = 'loginfo';
			}
		}
		// ����� �������������� ���� ���� üũ
		foreach($logPersonal['Admin'] as $value) {
			$urlParse = parse_url($value);
			$url = $urlParse['path'];
			$mode = $urlParse['query'];
			if($thisFile == $url && $thisMode == $mode) {
				// old_level / level �� 80 �̻� üũ
				if($dataPost['nowLevel'] >= 80 || $dataPost['level'] >= 80) {
					$logDirType = 'logadmin';
				} else if($dataGet['nowLevel'] >= 80 || $dataGet['level'] >= 80) {
					$logDirType = 'logadmin';
				}
			}
		}
		// shop/log/admin/�ش�����/���/
		$saveDir = $this->buildPath($this->getLogAdminDir(), $logDirType, date('Ym'));
		return $saveDir;
	}

	/**
	 * ȸ�� ������ LEVEL
	 * @param string $memberId ȸ�����̵�
	 * @return number ó�����
	 */
	function getMemberLevel($memberId) {
		global $db;
		$query = "select level from ".GD_MEMBER." where m_id = '".$memberId."'";
		list($nowLevel) = $db->fetch($query);
		return (int)$nowLevel;
	}

	/**
	 * �α� �����Ⱓ ���� ���� ã��
	 *
	 * ??
	 * ���� ó���� ������ ���õ� (�⺻ / �������� / �������������) �͸� ó�� �� ������ ??
	 * �Ʒ��� ���� � ó�� �����̵� ���� ó�� �� ������ ??
	 */
	function getExpiredAdminLog() {
		$delDate = $this->getExpiredTime();
		$expiredPath = array();
		foreach($delDate as $logDir=>$expiredDate) {
			$expiredDirFilePath = array();
			$expiredDir = date('Ym', $expiredDate);
			$expiredDay = date('d', $expiredDate);
			$expiredDirPath = $this->buildPath($this->getLogAdminDir(), $logDir);
			$targetDirPathArr = glob($expiredDirPath.DIRECTORY_SEPARATOR."*",GLOB_ONLYDIR);
			foreach($targetDirPathArr as $value) {
				$thisValueArr = explode(DIRECTORY_SEPARATOR, $value);
				$thisValue = $thisValueArr[sizeof($thisValueArr)-1];
				if($thisValue < $expiredDir) {
					$expiredPath[] = $value;
				}
			}
			$expiredDirPath = $this->buildPath($this->getLogAdminDir(), $logDir, $expiredDir);
			$targetFilePathArr = glob($expiredDirPath.DIRECTORY_SEPARATOR."*.log.zip",GLOB_BRACE);
			foreach($targetFilePathArr as $value) {
				$thisValueArr = explode(DIRECTORY_SEPARATOR, $value);
				$thisValue = $thisValueArr[sizeof($thisValueArr)-1];

				$thisFileValueArr = explode('.', $thisValue);
				$thisFileValue = $thisFileValueArr[0];
				if($thisFileValue < $expiredDay) {
					$expiredPath[] = $value;
				}
			}
		}

		return $expiredPath;
	}

	/**
	 * �α� ���� ����
	 * ������ ���� ���� (shop/admin/lib.php ���� ��)
	 * ���� ���� �Ϸ� �� �α� ������ ���� �� ����
	 * shop/log/admin/�ش�����/��¥.log.zip ������
	 *
	 * ??
	 * ���� ó���� ������ ���õ� (�⺻ / �������� / �������������) �͸� ó�� �� ������ ??
	 * �Ʒ��� ���� � ó�� �����̵� ���� ó�� �� ������ ??
	 */
	function makeZipAdminLog() {
		$nowYear = date('Y');
		$nowMon = date('m');
		$nowDay = date('d');

		$yesterDay = mktime(0, 0, 0, $nowMon, $nowDay-1, $nowYear);
		$zipTargetDir = date('Ym', $yesterDay);
		$zipTargetFile = date('d',$yesterDay);
		$logFile = $zipTargetFile.'.log';

		$zipTargetDirAdmin = $this->buildPath($this->getLogAdminDir(), "logadmin", $zipTargetDir);
		$zipTargetDirInfo = $this->buildPath($this->getLogAdminDir(), "loginfo", $zipTargetDir);
		$zipTargetDirBasic = $this->buildPath($this->getLogAdminDir(), "logbasic", $zipTargetDir);

		$zipTargetFilePathAdmin = $this->buildPath($zipTargetDirAdmin, $logFile);
		$zipTargetFilePathInfo = $this->buildPath($zipTargetDirInfo, $logFile);
		$zipTargetFilePathBasic = $this->buildPath($zipTargetDirBasic, $logFile);

		if(file_exists($zipTargetFilePathAdmin)) {
			$returnZip['Admin'] = $this->makeZipLogFile($zipTargetDirAdmin, $logFile);
		}
		if(file_exists($zipTargetFilePathInfo)) {
			$returnZip['Info'] = $this->makeZipLogFile($zipTargetDirInfo, $logFile);
		}
		if(file_exists($zipTargetFilePathBasic)) {
			$returnZip['Basic'] = $this->makeZipLogFile($zipTargetDirBasic, $logFile);
		}

		return $returnZip;
	}

	/**
	 * �α� ��� ������ ����
	 */
	function makeMsg() {
		$msg[] = "=============";
		$msg[] = "*SERVER=>".urldecode($this->_http_build_query($this->getServerData()));
		$msg[] = "*SESSION=>".urldecode($this->_http_build_query($this->getSessionData()));
		$msg[] = "*POST=>".urldecode($this->_http_build_query($this->getPostData()));
		$msg[] = "*GET=>".urldecode($this->_http_build_query($this->getGetData()));
		$msg[] = "";

		$msg = implode(PHP_EOL, $msg);
		return $msg;
	}

	/**
	 * http_build_query php5 �̻�����
	 * php5�̸� �� lib.core.php �� http_build_query�� �����Ǿ� ������
	 * �󰪿� ���� ó���� ���� �ʾ� �α׿����� ���� �ʿ���� �����ϱ� ����
	 * ���� �����Ͽ� �α׿����� ����ϴ� �뵵�� ����
	 */
	function _http_build_query( $formdata, $numeric_prefix = null, $key = null ) {
		$res = array();
		foreach((array)$formdata as $k=>$v) {
			if($v) {
				$tmp_key = urlencode(is_int($k) ? $numeric_prefix.$k : $k);
				if ($key) {
					$tmp_key = $key.'['.$tmp_key.']';
				}
				if ( is_array($v) || is_object($v) ) {
					$res[] = $this->_http_build_query($v, null, $tmp_key);
				} else {
					$res[] = $tmp_key."=".urlencode($v);
				}
			}
		}
		return implode("&", $res);
	}

	/**
	 * ������ �α� �ۼ�
	 */
	function writeAdminLog() {
		if($this->getLogException()) {
			// ������ �α� ���� ����
			$this->setLogMsg($this->makeMsg());
			// ������ �α� ���� Dir
			$this->setLogDir($this->getLogDirectory());
			// ������ �α� ���� ���ϸ�
			$this->setLogFile(date("d").".log");
			$this->writeLog();
		}
	}
}
?>