<?
$location = "��Ÿ���� > ��������ó�� �α� Ȯ�� ";
include "../_header.php";
$logDataArray = array();

if ($_GET['mode'] == 'searchLog') {
	$logDate = $_GET['logDate'];

	if (!$logDate[0] || !$logDate[1]) {
		msg('��¥�� �Է����ּ���.',-1);
		exit;
	}

	$getLogDate1 = strtotime($logDate[0]);
	$getLogDate2 = strtotime($logDate[1]);
	$interval = round(($getLogDate2 - $getLogDate1) / (60*60*24));

	if ($interval < 0) {
		msg('��ȸ�Ⱓ�� Ȯ�����ּ���.',-1);
		exit;
	} else if ($interval > 7) {
		msg('�ִ� �����ϵ����� �α׸� ��ȸ�� �����մϴ�.',-1);
		exit;
	}

	include_once "../../lib/pclzip/pclzip.lib.php";

	$logPath = array('../../log/','../../log/admin/logbasic/','../../log/admin/loginfo/'); // �α�������
	$logContinuePath = array('.','..'); // �ش� ������ ������ �о�ý� continue
	$monthArray = array_unique(array(date('Ym',$getLogDate1),date('Ym',$getLogDate2)));
	$logInOut = array('login_','logout_');
	$adminID = array();

	$query = $db->query("SELECT m_id FROM ".GD_MEMBER." WHERE level >= 80");
	while ($data = $db->fetch($query)) $adminID[] = $data['m_id'];

	$chkarray = array(
		'member/list.php' => 'ȸ������Ʈ',
		'member/Crm_view.php' =>'CRM',
		'member/Crm_info.php' => 'ȸ����������',
		'member/indb.php' => 'ȸ������ ó��',
		'member/orderlist.php' => '���ų���',
		'member/popup.emoney.php' => '�����ݳ���',
		'member/popup.coupon.php' => '��������',
		'member/Crm_counsel.php' => '��㳻��',
		'member/Crm_member_qna.php' => '1:1���ǳ���',
		'member/info.php' => 'ȸ����������',
		'member/hack.php' => 'ȸ��Ż��/��������',
		'member/hack_register.php' => 'ȸ��Ż�𳻿� �󼼳���',
		'member/hack_indb.php' => 'ȸ��Ż�� ó��',
		'member/batch.php' => 'ȸ���ϰ�����',
		'member/mail.php' => '����/��ü ���Ϻ�����',
		'member/iframe.email.php' => '����/��ü ���Ϻ�����',
		'member/popup.sms.php' => 'SMS �ۼ�',
		'member/sms.php' => 'SMS ������',
		'member/sms.member_list.php' => 'SMS ȸ�� �ּҷ�',
		'member/sms.address_list.php' => 'SMS �Ϲ� �ּҷ�',
		'member/popup.sms.sendList.php' => 'SMS �߼۰�� ��',
		'member/delivery_list.php' => '����� ���',
		'member/delivery_form.php' => '����� ���',
		'member/delivery_indb.php' => '����� ó��',
		'dormant/adm_dormant_dormantMemberList.php' => '�޸� ȸ�� ����Ʈ',
		'dormant/adm_dormant_indb.php' => '�޸� ȸ�� ó��',
		'dormant/adm_dormant_dormantTobeMemberList.php' => '�޸� ��ȯ ���� ȸ�� ����Ʈ',
		'auctionIpay/orderlist.php' => '���� iPay ���� �ֹ�����Ʈ',
		'order/list.php' => '�ֹ� ����Ʈ',
		'order/view.php' => '�ֹ��󼼳���',
		'order/indb.php' => '�ֹ����� ó��',
		'order/dnXls.php' => '�ֹ� ��������',
		'order/_paper.php' => '�ֹ����� ����Ʈ',
		'order/misu_list.php' => '�Աݴ�⸮��Ʈ',
		'order/cs.php' => '�ֹ���Ҹ���Ʈ',
		'order/regoods.php' => '��ǰ/��ȯ��������Ʈ',
		'order/repay.php' => 'ȯ����������Ʈ',
		'order/member_qna.php' => '1:1 ���ǰ���',
		'order/list.integrate.php' => '�ֹ����ո���Ʈ',
		'order/dnXls_integrate.php' => '�ֹ� ��������',
		'order/list.step0.php' => '�Աݴ�� ����Ʈ',
		'order/list.step1.php' => '�Ա�Ȯ�� ����Ʈ',
		'order/list.step2.php' => '����غ��� ����Ʈ',
		'order/list.step3.php' => '����� ����Ʈ',
		'order/list.step4.php' => '��ۿϷ� ����Ʈ',
		'order/list.cancel.php' => '��� ����Ʈ',
		'order/list.claim.php' => '��ǰ/��ȯ ����Ʈ',
		'order/list.repay.php' => 'ȯ�� ����Ʈ',
		'order/self_order.php' => '�ֹ� ������',
		'order/indb.self_order.php' => '�ֹ� ������ ó��',
		'order/favoriteAddress_list.php' => '���� ���� �ּҷ�',
		'order/indb.favorite_address.php' => '���� ���� �ּҷ� ó��',
		'order/popup.favorite_address.php' => '���� ���� �ּҷ� ���',
		'order/todayshop_list_i.php' => '�����̼� �ֹ�����Ʈ',
		'order/todayshop_list_b.php' => '�����̼� �ֹ�����Ʈ',
		'order/checkout.list.php' => '���̹�üũ�ƿ� ��ü�ֹ���ȸ',
		'order/checkout.placeorder.php' => '���̹�üũ�ƿ� ����ó��',
		'order/checkout.shiporder.php' => '���̹�üũ�ƿ� �߼�ó��',
		'order/checkout.cancelsale.php' => '���̹�üũ�ƿ� �Ǹ����ó��',
		'order/checkout.cancelorder.php' => '���̹�üũ�ƿ� �ֹ����ó��',
		'order/checkout.cancelshipping.php' => '���̹�üũ�ƿ� �߼����ó��',
		'order/checkout.inquiry.php' => '���̹�üũ�ƿ� ���ǰ���',
		'order/checkout.api.PlaceOrder.php' => '���̹� üũ�ƿ�',
		'order/checkout.api.ShipOrder.php' => '���̹� üũ�ƿ�',
		'order/checkout.api.CancelSale.php' => '���̹� üũ�ƿ�',
		'order/checkout.api.CancelOrder.php' => '���̹� üũ�ƿ�',
		'order/checkout.api.CancelShipping.php' => '���̹� üũ�ƿ�',
		'order/post_list.php' => '��ü���ù� �����ȣ�߱�',
		'order/indb.godopost.assign.php' => '��ü���ù� ó��',
		'order/post_reserve.php' => '��ü���ù� �����ϱ�',
		'order/indb.godopost.reserve.php' => '��ü���ù� ó��',
		'order/goodsflow.invoice.php' => '�½��÷� �����ȣ �߱�',
		'order/indb.goodsflow.php' => '�½��÷� ó��',
		'order/goodsflow.standby.php' => '�½��÷� ��۴�⸮��Ʈ',
		'order/bankmatch.php' => '�Ա���ȸ / �ǽð��Ա�Ȯ��',
		'order/bankmatch.ajax.php' => '�Ա���ȸ / �ǽð��Ա� ó��',
		'order/ghostbanker.php' => '��Ȯ�� �Ա��� ����Ʈ ����',
		'order/ax.indb.ghostbanker.php' => '��Ȯ�� �Ա��� ó��',
		'order/cashreceipt.list.php' => '���ݿ����� �߱�/��ȸ',
		'order/cashreceipt.indb.php' => '���ݿ����� ó��',
		'order/cashreceipt.info.php' => '���ݿ����� ��û���� ��ȸ',
		'order/cashreceipt.singly.php' => '���ݿ����� �����߱�',
		'order/cashreceipt.indb.php' => '���ݿ����� �߱� ó��',
		'order/taxapp.php' => '�Ϲݹ����û����Ʈ',
		'order/tax_indb.php' => '�Ϲݹ����û ó��',
		'order/taxissue.php' => '�Ϲݹ��೻������Ʈ',
		'order/tax_dnXls.php' => '�Ϲݹ��೻�� ó��',
		'order/godotax.list.php' => '���ڼ��ݰ�꼭 �߱޿�û���',
		'order/checkout.orderlist.php' => '���̹�üũ�ƿ� 4.0 ��ü�ֹ���ȸ',
		'order/checkout.view.php' => '���̹�üũ�ƿ� 4.0 �ֹ���',
		'order/checkout.payed.php' => '���̹�üũ�ƿ� 4.0 �Ա�Ȯ�θ���Ʈ',
		'order/checkout.placed.php' => '���̹�üũ�ƿ� 4.0 ����غ��߸���Ʈ',
		'order/checkout.delivering.php' => '���̹�üũ�ƿ� 4.0 ����߸���Ʈ',
		'order/checkout.delivered.php' => '���̹�üũ�ƿ� 4.0 ��ۿϷḮ��Ʈ',
		'order/checkout.complete.php' => '���̹�üũ�ƿ� 4.0 ����Ȯ������Ʈ',
		'order/checkout.cancel.php' => '���̹�üũ�ƿ� 4.0 ��Ҹ���Ʈ',
		'order/checkout.return.php' => '���̹�üũ�ƿ� 4.0 ��ǰ����Ʈ',
		'order/checkout.exchange.php' => '���̹�üũ�ƿ� 4.0 ��ȯ����Ʈ',
		'order/checkout.api.process.php' => '���̹�üũ�ƿ� 4.0 ó��',
		'order/checkout.inquiry.php' => '���̹� üũ�ƿ� ���ǰ���',
		'board/customer_register.php' => '1:1���� �亯����',
		'board/customer_indb.php' => '���� ó��',
		'board/list_management.php' => '�Խñ� ���հ���',
		'board/indb.php' => '�Խñ� ó��',
		'board/list_excel_management.php' => '�Խñ� �����ٿ�ε�',
		'board/list_management_indb.php' => '�Խñ� ó��',
		'board/goods_qna.php' => '��ǰ���ǰ���',
		'board/goods_qna_excel_list.php' => '��ǰ���� �����ٿ�ε�',
		'board/goods_qna_indb.php' => '��ǰ���� ó��',
		'board/goods_review.php' => '��ǰ�ı����',
		'board/goods_review_indb.php' => '��ǰ�ı� ó��',
		'board/goods_review_excel_list.php' => '��ǰ�ı� �����ٿ�ε�',
		'board/member_qna.php' => '1:1 ���ǰ���',
		'board/member_qna_indb.php' => '1:1 ���� ó��',
		'board/member_qna_excel_list.php' => '1:1 ���� �����ٿ�ε�',
		'board/cooperation.php' => '�������޹���',
		'board/cooperation_indb.php' => '�������޹��� ó��',
		'event/coupon_apply.php' => '�����߱�/��ȸ',
		'event/popup.member.php' => 'ȸ���˻�',
		'event/attendance_list.php' => '�⼮üũ ����Ʈ',
		'event/attendance_detail.php' => '�⼮üũ �⼮�� ��Ȳ',
		'event/attendance.indb.php' => '�⼮üũ ó��',
		'log/index.php' => '�湮�м�',
		'log/popu.cart.detail.php' => '�� ��ǰ�� ��ٱ��Ͽ� ���� �� ����Ʈ',
		'log/mem.emoney.php' => 'ȸ�� ������ �м�',
		'log/indb.excel.mem.emoney.php' => 'ȸ�� ������ �м� �����ٿ�ε�',
		'data/data_membercsv_indb.php' => 'ȸ��CSV���� �ø���',
		'data/adm_data_member_excel_download.php' => 'ȸ��DB�ٿ�ε�',
		'data/data_memberxls_indb.php' => 'ȸ��DB�ٿ�ε�',
		'goods/goods_qna.php' => '��ǰ���ǰ���',
		'goods/goods_review.php' => '��ǰ�ı����',
		'login_' => '�α���',
		'logout_' => '�α׾ƿ�',
	);
	$chkmode = array(
		'member/hack_indb.php?delete' => 'ȸ������',
		'member/indb.php?modify' => '����',
		'member/delivery_list.php?' => '��ȸ',
		'member/delivery_form.php?add' => '�����',
		'member/delivery_form.php?edit' => '�����',
		'member/delivery_indb.php?add' => '�߰�',
		'member/delivery_indb.php?edit' => '����',
		'member/delivery_indb.php?delete' => '����',
		'board/customer_register.php?memberQnaReply' => '�����',
		'board/customer_indb.php?memberQnaReply' => '1:1���� �亯���',
		'board/customer_indb.php?reply_end' => '1:1���� �亯���',
		'board/customer_indb.php?reviewReply' => '1:1���� �亯���',
		'board/list_excel_management.php?' => '�����ٿ�ε�',
		'board/list_management_indb.php?reply_end' => '�Խñ� �亯 ���',
		'board/goods_qna_excel_list.php?' => '�����ٿ�ε�',
		'board/goods_qna_indb.php?delete' => '���Ǳ� ����',
		'board/goods_review_indb.php?delete' => '��ǰ�ı� ����',
		'board/goods_review_excel_list.php?' => '�����ٿ�ε�',
		'board/member_qna_indb.php?delete' => '1:1 ���� ����',
		'board/member_qna_excel_list.php?' => '�����ٿ�ε�',
		'board/cooperation_indb.php?modify' => '�亯',
		'board/cooperation_indb.php?delete' => '����',
		'order/dnXls_integrate.php?goods' => '��ǰ�� �������� �ٿ�ε�',
		'order/todayshop_list_b.php?goods' => '�ǹ�(�ϰ��߼�)',
		'order/checkout.api.PlaceOrder.php?' => '����ó��',
		'order/checkout.api.ShipOrder.php?' => '�߼�ó��',
		'order/checkout.api.CancelSale.php?' => '�Ǹ����ó��',
		'order/checkout.api.CancelOrder.php?' => '���ó��',
		'order/checkout.api.CancelShipping.php?' => '�߼����ó��',
		'order/ax.indb.ghostbanker.php?download' => '�����ٿ�ε�',
		'order/tax_dnXls.php?tax' => '�����ٿ�ε�',
		'order/dnXls.php?goods' => '��ǰ�� �������� �ٿ�ε�',
		'order/_paper.php?tax' => '���ݰ�꼭',
		'order/_delivery.php?' => '���',
		'order/_delivery.php?list' => '���',
		'order/_delivery.php?form' => '�����',
		'order/_delivery.php?add' => '�߰�',
		'order/_delivery.php?edit' => '����',
		'order/_delivery.php?delete' => '����',
		'log/indb.excel.mem.emoney.php?' => '�����ٿ�ε�',
		'data/data_membercsv_indb.php?' => 'ȸ��CSV���ε�',
		'order/cashreceipt.indb.php?cancel' => '���ݿ����� ���',
		'data/data_memberxls_indb.php?' => 'ȸ��DB�ٿ�ε�',
		'emoney_add' => '����������/����',
		'emoney_delete' => '�����ݳ��� ����',
		'dormantRestoreAdmin' => '�޸�ȸ�� ����',
		'dormantMemberDelete' => '�޸�ȸ�� ����',
		'dormantAdmin' => '�޸�ȸ�� ��ȯ',
		'dormantMemberToBeDelete' => 'ȸ�� ����',
		'emoney' => '������ �ϰ�����/����',
		'level' => 'ȸ���׷� �ϰ�����',
		'status' => 'ȸ�����λ��� �ϰ�����',
		'sms' => 'SMS �ϰ��߼�',
		'sendmail' => '���Ϲ߼�',
		'member/popup.sms.php?' => 'SMS �ۼ�',
		'send_sms' => 'SMS �߼�',
		'group' => '��ȸ',
		'modOrder' => '�ֹ�����',
		'order' => '�ֹ��� �������� �ٿ�ε�',
		'report' => '�ֹ�������',
		'report_customer' => '�ֹ�������(����)',
		'reception' => '���̿�����',
		'particular' => '�ŷ�����',
		'requestSMS' => '�Աݿ�û SMS �߼�',
		'regoods' => '��ǰ�Ϸ�',
		'exc_ok' => '��ȯ�Ϸ� �� ���ֹ� �ֱ�',
		'repay' => 'ȯ�ҿϷ�',
		'integrate_multi_action31' => '��ǰ�Ϸ�',
		'integrate_multi_action41' => '��ȯ�Ϸ� �� ���ֹ� �ֱ�',
		'writeOrder' => '�ֹ� ������',
		'orderDeliveryPay' => '��ۺ� ���',
		'specialDC' => '���� ���',
		'selectMember' => 'ȸ������',
		'memberDC' => 'ȸ�� ���� ���',
		'addGoods' => '��ǰ �߰�',
		'destroyUniqueId' => '����',
		'faRegist' => '���',
		'faDelete' => '����',
		'groupcoupon' => '����(��ù߱�)',
		'coupon' => '����(�ϰ��߱�)',
		'groupgoods' => '�ǹ�(��ù߼�)',
		'order_assign' => '�����ȣ �߱޹ޱ�',
		'order_reserve' => '�����ϱ�',
		'casebyorder' => '�ֹ��Ǻ� �����ȣ �߱�',
		'package' => '������ �����ȣ �߱�',
		'order/indb.goodsflow.php?delivery' => '����� ó��',
		'bankMatching' => '�ǽð� �Ա�Ȯ��',
		'accountList' => '�����Աݳ��� �ǽð� ��ȸ',
		'bankUpdate' => '�ϰ�����',
		'approval' => '���ݿ����� ó��',
		'refuse' => '���ݿ����� ����',
		'put' => '�߱�',
		'allmodify' => '�ϰ�����',
		'agree' => '��û����',
		'PlaceProductOrder' => '����Ȯ��',
		'DelayProductOrder' => '�߼�����',
		'CancelSale' => '�Ǹ����',
		'ShipProductOrder' => '�߼�ó��',
		'RequestReturn' => '��ǰ��û',
		'ApproveCancelApplication' => '��ҿ�û����',
		'ApproveReturnApplication' => '��ǰ��û����',
		'ApproveCollectedExchange' => '��ȯ���ſϷ�',
		'ApproveExchangeApplication' => '��ȯ��û����',
		'ReDeliveryExchange' => '��ȯ����',
		'list_delete' => '�Խñ� ����',
		'reply' => '�Խñ� �亯 ���',
		'reserve' => '������ ��������',
		'event/attendance.indb.php?add' => '�⼮üũ ���',
		'attd_delete' => '�⼮üũ ����',
		'log/index.php?' => '�湮�� �м�',
		'referer' => '�湮 ��κм�',
		'client' => '�湮�� ȯ��м�',
		'iplist' => '�湮�� IPȮ��',
		'downloadPasswordExcel' => 'ȸ��DB�ٿ�ε�',
		'batch_emoney' => '������ �ϰ�����/����',
		'batch_level' => 'ȸ���׷� �ϰ�����',
		'batch_status' => '	ȸ�����λ��� �ϰ�����',
		'batch_sms' => 'SMS �ϰ��߼�',
		'casebyorderinvoice' => '�ֹ��Ǻ� �����ȣ �߱�',
		'packageinvoice' => '������ �����ȣ �߱�',
		'qnaReply' => '���Ǵ亯',
		'login_' => '�α���',
		'logout_' => '�α׾ƿ�',
	);

	foreach ($logPath as $key => $path) {
		if ($key === 0) {
			foreach ($monthArray as $month) foreach ($logInOut as $logHead) {
				$fullPath = $path.$logHead.$month.'.log';
				if (file_exists($fullPath)) {
					$fp = @fopen($fullPath,'r');
					$fr = @fread($fp,filesize($fullPath));
					@fclose($fp);

					$logLine = array_filter(explode(PHP_EOL,$fr));
					foreach ($logLine as $k => $logLineData) {
						$logLineDataArray = explode('	',$logLineData);
						if (in_array(date('Ymd',strtotime($logLineDataArray[0])),range(date('Ymd',$getLogDate1),date('Ymd',$getLogDate2))) && in_array($logLineDataArray[2],$adminID)) {
							$REQUEST_TIME = $REQUEST_TIME_KEY = strtotime($logLineDataArray[0]);
							if ($logDataArray[$REQUEST_TIME_KEY]) $REQUEST_TIME_KEY .= '_'.$k;
							$SCRIPT_FILENAME = $logHead;
							$REMOTE_ADDR = $logLineDataArray[1];
							$adminId = $logLineDataArray[2];

							$logDataArray[$REQUEST_TIME_KEY] = array('REQUEST_TIME'=>$logLineDataArray[0], 'SCRIPT_FILENAME'=>$SCRIPT_FILENAME, 'REMOTE_ADDR'=>$REMOTE_ADDR, 'adminId'=>$adminId, 'mode'=>$SCRIPT_FILENAME);
						}
					}
				} else {/* �ش� ���� �α����� ���� */}
			}
		} else {
			foreach ($monthArray as $month) {
				if (!is_dir($path.$month)) continue;
				$dir = @opendir($path.$month);
				while ($logFile = @readdir($dir)) {
					if (in_array($logFile,$logContinuePath)) continue;
					$fullPath = $path.$month.'/'.$logFile;
					$ext = explode('.',$logFile);

					if ((date('Ymd',$getLogDate1) <= $month.$ext[0]) && (date('Ymd',$getLogDate2) >= $month.$ext[0])) {
						if (strtolower($ext[count($ext)-1]) == 'zip') {
								$zip = new PclZip($fullPath);
								$extract = $zip->extract(PCLZIP_OPT_PATH,'/');

								if ($extract[0]['status'] == 'ok') {
									$fullPath = $extract[0]['filename'];
									$logDataArray = logSearchData($fullPath,$logDataArray,$chkarray);

									@unlink($extract[0]['filename']);
								} else {/* �α����� �������� ����*/}
							
						} else {
							$fp = fopen($fullPath);
							$fr = fread($fp,filesize($fullPath));
							fclose($fp);

							$logDataArray = logSearchData($fullPath,$logDataArray,$chkarray);
						}
					}
				}
				@fclose($dir);
			}
		}
	}
} else {
	$logDate = array(date('Ymd'),date('Ymd'));
}
$logDataArray = array_filter($logDataArray);
krsort($logDataArray);
?>
<script type="text/javascript">
function searchLog(){
	var logDate1 = document.getElementsByName('logDate[]')[0].value;
	var logDate2 = document.getElementsByName('logDate[]')[1].value;

	if (!logDate1 || !logDate2) {
		alert("��¥�� �Է����ּ���.");
		return false;
	} else {
		var date1 = new Date(logDate1.substr(0,4),logDate1.substr(4,2)-1,logDate1.substr(6,2));
		var date2 = new Date(logDate2.substr(0,4),logDate2.substr(4,2)-1,logDate2.substr(6,2));
		var interval = (date2 - date1) / (1000*60*60*24);

		if (interval < 0) {
			alert("��ȸ�Ⱓ�� Ȯ�����ּ���.");
			return false;
		} else if (interval > 7) {
			alert("�ִ� �����ϵ����� �α׸� ��ȸ�� �����մϴ�.");
			return false;
		}
	}
}
</script>

<div class="title title_top">��������ó�� �α� Ȯ�� <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=basic&no=')"><img src="../img/btn_q.gif" border="0" align="absmiddle"></a></div>
<div style="border:1px solid #000; padding:5px 5px 5px 15px; margin-bottom:20px;">
	<div style="font-weight:bold;">�� ���������� ������ Ȯ���� �ʿ��� ��ġ�� ���� ����</div>
	<div style="padding-left:13px;">
		���������� ����� ������ ��ȣ��ġ ���ؿ� ���� ������ż��� �����ڵ��� ������������ڰ� ��������ó���ý��ۿ� ������ ����� �� 1ȸ �̻� ���������� Ȯ�Ρ������Ͽ��� �ϸ�, �ý��� �̻� ������ Ȯ�� ���� ���� �ּ� 6���� �̻� ���ӱ���� �����������Ͽ��� �մϴ�.
	</div>
</div>

<form method="get" onsubmit="return searchLog();">
<input type="hidden" name="mode" value="searchLog"/>
<table class="tb" style="width: 100%;">
<col class=cellC><col class=cellL>
<tr>
	<th style="width: 150px;">��ȸ ����</th>
	<td>
		<input type="text" name="logDate[]" value="<?=$logDate[0]?>" maxlength="8" onclick="calendar(event)" onkeydown="onlynumber()" class="ac" readonly /> - <input type="text" name="logDate[]" value="<?=$logDate[1]?>" maxlength="8" onclick="calendar(event)" onkeydown="onlynumber()" class="ac" readonly /> 
		<a href="javascript:setDate('logDate[]',<?=date("Ymd")?>,<?=date("Ymd")?>)"><img src="../img/sicon_today.gif" valign="middle"></a> <a href="javascript:setDate('logDate[]',<?=date("Ymd",strtotime("-7 day"))?>,<?=date("Ymd")?>)"><img src="../img/sicon_week.gif" valign="middle"></a><br />
		<span class="extext">�ֱ� 6���� �� ���θ� �α׸� Ȯ���� �����մϴ�.</span>
	</td>
</tr>
</table>

<div style="width: 100%; padding: 20px; text-align: center;">
	<input type="image" src="../img/btn_search2.gif" style="border:none;">
</div>
</form>

<table width="100%" cellpadding="0" cellspacing="0" border="0">
<col width="150"><col width="200"><col width="150"><col><col width="200">
<tr><td class="rnd" colspan="16"></td></tr>
<tr class="rndbg">
	<th>�����Ͻ�</th>
	<th>IP</th>
	<th>��� ID</th>
	<th>���������� (�������� ����)</th>
	<th>�������</th>
</tr>
<tr><td class="rnd" colspan="16"></td></tr>
</table>
<div style="width:100%; height:700px; border-left:1px solid #dcd8d6; border-bottom:1px solid #dcd8d6; overflow-y:scroll">
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<col width="150"><col width="200"><col width="150"><col><col width="200">
<?
foreach ($logDataArray as $k => $v) if ($k) {
$mode = $v['mode'].$v['func'].$v['type'].$v['ord_status'].$v['goodstype'].$v['process'];
$urlMode = $v['SCRIPT_FILENAME'].'?'.$mode;
?>
<tr height=30 align="center">
	<td><?=$v['REQUEST_TIME']?></td>
	<td><?=$v['REMOTE_ADDR']?></td>
	<td><?=$v['adminId']?></td>
	<td align="left"><?=$chkarray[$v['SCRIPT_FILENAME']]?></td>
	<td><?=$chkmode[$urlMode] ? $chkmode[$urlMode] : ($chkmode[$mode] ? $chkmode[$mode] : '��ȸ')?></td>
</tr>
<tr><td colspan="16" class="rndline"></td></tr>
<?}?>
</table>
</div>

<?php include "../_footer.php"; ?>