<?
class integrate_order_processor_checkout extends integrate_order_processor {

	function extractData($var = null) {

		// �ֹ� ����
		// ���� ����(����غ���) �� üũ�ϱ� ���� �߰� �ʵ带 �����ؾ� �ϳ�, ord_status �ʵ带 Ȱ���մϴ�.
		// ��, ori_status �� ord_status �ʵ� �ΰ��� Ȱ���Ͽ� �ֹ� ���¸� ���� ó�� �մϴ�.
		$query = "
			INSERT
			INTO ".$this->temp_table_order."
			(
				channel,ordno,ord_date,m_id_out,ord_name,ord_phone,ord_mobile,pay_date,pay_method,
				m_no,dlv_date,fin_date,dlv_no,dlv_company,dlv_amount,dlv_message,dlv_method,
				rcv_name, rcv_phone, rcv_mobile, rcv_zipcode, rcv_address,
				reg_date,mod_date,
				cs_type,
				cs_regdt,cs_confirmdt,cs_reason,cs_reason_type,

				ord_amount,pay_amount,dis_amount,

				ori_status,ord_status,cs_type_reason
			)
			SELECT
				'checkout',O.OrderID,O.OrderDate,O.OrdererID,O.OrdererName,O.OrdererTel1,O.OrdererTel2,O.PaymentDate,O.PaymentMeans,
				MB.m_no,D.SendDate,D.DeliveredDate,D.TrackingNumber,D.DeliveryCompany ,PO.DeliveryFeeAmount ,PO.ShippingMemo,D.DeliveryMethod,
				PO.ShippingAddressName,PO.ShippingAddressTel1,PO.ShippingAddressTel2,PO.ShippingAddressZipCode,CONCAT(PO.ShippingAddressBaseAddress,' ',PO.ShippingAddressDetailedAddress),
				NOW(), null,
				PO.ClaimType,
				IF(PO.ClaimType = 'CANCEL',						C.ClaimRequestDate,
				IF(PO.ClaimType = 'RETURN',						R.ClaimRequestDate,
				IF(PO.ClaimType = 'EXCHANGE',					E.ClaimRequestDate,
				IF(PO.ClaimType = 'PURCHASE_DECISION_HOLDBACK', DH.ClaimRequestDate,
				IF(PO.ClaimType = 'ADMIN_CANCEL',				C.ClaimRequestDate,
				''))))),
				IF(PO.ClaimType = 'CANCEL',						C.CancelCompletedDate,
				IF(PO.ClaimType = 'RETURN',						R.CollectCompletedDate,
				IF(PO.ClaimType = 'EXCHANGE',					E.CollectCompletedDate,
				IF(PO.ClaimType = 'PURCHASE_DECISION_HOLDBACK', '',
				IF(PO.ClaimType = 'ADMIN_CANCEL',				C.CancelCompletedDate,
				''))))),
				IF(PO.ClaimType = 'CANCEL',						C.CancelDetailedReason,
				IF(PO.ClaimType = 'RETURN',						R.ReturnDetailedReason,
				IF(PO.ClaimType = 'EXCHANGE',					E.ExchangeDetailedReason,
				IF(PO.ClaimType = 'PURCHASE_DECISION_HOLDBACK', DH.DecisionHoldbackDetailedReason,
				IF(PO.ClaimType = 'ADMIN_CANCEL',				C.CancelDetailedReason,
				''))))),
				IF(PO.ClaimType = 'CANCEL',						C.CancelReason,
				IF(PO.ClaimType = 'RETURN',						R.ReturnReason,
				IF(PO.ClaimType = 'EXCHANGE',					E.ExchangeReason,
				IF(PO.ClaimType = 'PURCHASE_DECISION_HOLDBACK', DH.DecisionHoldbackReason,
				IF(PO.ClaimType = 'ADMIN_CANCEL',				C.CancelDetailedReason,
				''))))),
				SUM(PO.Quantity * PO.UnitPrice), SUM(PO.TotalPaymentAmount), SUM(PO.ProductDiscountAmount),
				PO.ProductOrderStatus,PO.PlaceOrderStatus,PO.ClaimStatus

			FROM ".GD_NAVERCHECKOUT_PRODUCTORDERINFO." AS PO

			INNER JOIN ".GD_NAVERCHECKOUT_ORDERINFO." AS O
				ON PO.OrderID = O.OrderID

			LEFT JOIN ".GD_MEMBER." AS MB
				ON PO.MallMemberID=MB.m_id

			LEFT JOIN ".GD_NAVERCHECKOUT_DELIVERYINFO." AS D
				ON PO.ProductOrderID = D.ProductOrderID

			LEFT JOIN ".GD_NAVERCHECKOUT_CANCELINFO." AS C
				ON PO.ProductOrderID = C.ProductOrderID

			LEFT JOIN ".GD_NAVERCHECKOUT_RETURNINFO." AS R
				ON PO.ProductOrderID = R.ProductOrderID

			LEFT JOIN ".GD_NAVERCHECKOUT_EXCHANGEINFO." AS E
				ON PO.ProductOrderID = E.ProductOrderID

			LEFT JOIN ".GD_NAVERCHECKOUT_DECISIONHOLDBACKINFO." AS DH
				ON PO.ProductOrderID = DH.ProductOrderID

			WHERE
				PO.sync_ = 0

			GROUP BY O.OrderID
		";

		$this->db->query($query);

		if ($this->db->affected() < 1)
			return false;

		// ��ǰ �ֹ� ����
		$query = "
			INSERT
			INTO ".$this->temp_table_item."
			(
				channel,ordno,goodsnm,goodsno,`option`,ea,price,emoney,
				cs,
				cs_status
			)
			SELECT
				'checkout',B.ordno,C.ProductName,C.ProductID,C.ProductOption,C.Quantity,C.UnitPrice,C.eNamooEmoney,
				IF(C.ClaimStatus IN ('CANCEL_DONE','RETURN_DONE','EXCHANGE_DONE','ADMIN_CANCEL_DONE'), 'f',
				IF(C.ClaimStatus > '' , 'y', 'n')),
				C.ClaimStatus


			FROM ".$this->temp_table_order." AS B

			INNER JOIN ".GD_NAVERCHECKOUT_PRODUCTORDERINFO." AS C
				ON B.ordno = C.OrderID
		";
		$this->db->query($query);

		// ���ڵ� �� ����
		$this->adjustData();

		return true;

	}

	function adjustData() {


		$_tmp = array(
			// �ֹ� ����
			0 => array(array('cs_type' => '', 'ori_status' => 'PAYMENT_WAITING')),
			// �Ա�Ȯ��
			1 => array(array('cs_type' => '', 'ori_status' => 'PAYED', 'ord_status' => 'NOT_YET')),
			// ����غ���
			2 => array(array('cs_type' => '', 'ori_status' => 'PAYED', 'ord_status' => 'OK')),
			// �����
			3 => array(array('cs_type' => '', 'ori_status' => 'DELIVERING'),array('cs_type' => 'CANCEL', 'ori_status' => 'DELIVERING', 'cs_type_reason' => 'CANCEL_REJECT'),array('cs_type' => 'RETURN', 'ori_status' => 'DELIVERING', 'cs_type_reason' => 'RETURN_REJECT'),array('cs_type' => 'EXCHANGE', 'ori_status' => 'DELIVERING', 'cs_type_reason' => 'EXCHANGE_REJECT')),
			// ��ۿϷ�, ����Ȯ��
			4 => array(array('cs_type' => '', 'ori_status' => 'DELIVERED'),array('cs_type' => '', 'ori_status' => 'PURCHASE_DECIDED')),

			// ��� (�Ϸᰡ �ƴҶ�)
			10 => array(array('cs_type' => 'CANCEL', 'cs_type_reason' => 'CANCEL_REQUEST')),
			// ��ҿϷ�
			11 => array(array('cs_type' => 'CANCEL', 'ori_status' => 'CANCELED'),array('cs_type' => 'CANCEL', 'ori_status' => 'CANCELED_BY_NOPAYMENT'),array('cs_type' => 'ADMIN_CANCEL', 'cs_type_reason' => 'ADMIN_CANCEL_DONE')),

			// ��ǰ (�Ϸᰡ �ƴҶ�)
			30 => array(array('cs_type' => 'RETURN', 'cs_type_reason' => 'RETURN_REQUEST')),
			// ��ǰ�Ϸ�
			31 => array(array('cs_type' => 'RETURN', 'ori_status' => 'PAYMENT_WAITING'),array('cs_type' => 'RETURN', 'ori_status' => 'RETURNED')),

			// ��ȯ (�Ϸᰡ �ƴҶ�)
			40 => array(array('cs_type' => 'EXCHANGE', 'cs_type_reason' => 'EXCHANGE_REQUEST')),
			// ��ȯ�Ϸ�
			41 => array(array('cs_type' => 'EXCHANGE', 'ori_status' => 'EXCHANGED')),
			);

$ordnoArray = $_where = $__where = array();
$fieldChange = array('cs_type' => 'ClaimType', 'ori_status' => 'ProductOrderStatus', 'ord_status' => 'PlaceOrderStatus', 'cs_type_reason' => 'ClaimStatus');
$query = $this->db->query("SELECT ordno FROM ".$this->temp_table_order." WHERE channel = 'checkout'");
while (list($ordno) = $this->db->fetch($query)) $ordnoArray[] = $ordno;

foreach ($_tmp as $_status => $_conds) {
	if (strlen($_status) == 2) continue;

	foreach($_conds as $key => $_cond) {
		foreach ($_cond as $_fld => $_val) $_where[$_status][$key][] = " ".$fieldChange[$_fld]." = '$_val' ";
	}
}

foreach ($_where as $_status => $_conds) {
	foreach($_conds as $key => $_cond) {
		$__where[] = "(".@implode(' AND ', $_cond).")";
	}
}

// �ֹ� �ٽ� ����
foreach ($ordnoArray as $value) {
	foreach ($_tmp as $_status => $_conds) {
		foreach($_conds as $_cond) {
			$breakYn = false;
			$_where_ = array();
			$_where_[] = " OrderID = '$value' ";
			foreach ($_cond as $_fld => $_val) $_where_[] = " ".$fieldChange[$_fld]." = '$_val' ";

			$query = $this->db->query("
				SELECT ClaimType, ProductOrderStatus, PlaceOrderStatus, ClaimStatus, SUM(Quantity * UnitPrice) as ord_amount, SUM(TotalPaymentAmount) as pay_amount, SUM(ProductDiscountAmount) as dis_amount
				FROM ".GD_NAVERCHECKOUT_PRODUCTORDERINFO."
				WHERE ".implode(' AND ', $_where_)." GROUP BY OrderID");

			$data = $this->db->fetch($query);

			if ($data) {
				$breakYn = true;

				if (!$__where) $__whereQry = " OrderID = '$value' ";
				else $__whereQry = " OrderID = '$value' AND (".implode(' OR ', $__where).") ";

				$_query = $this->db->query("
					SELECT SUM(Quantity * UnitPrice) as ord_amount, SUM(TotalPaymentAmount) as pay_amount, SUM(ProductDiscountAmount) as dis_amount
					FROM ".GD_NAVERCHECKOUT_PRODUCTORDERINFO."
					WHERE ".$__whereQry." GROUP BY OrderID");
				list($data['ord_amount'], $data['pay_amount'], $data['dis_amount']) = $this->db->fetch($_query);

				$query = "
				UPDATE
					".$this->temp_table_order."
				SET
					cs_type = '".$data['ClaimType']."', ori_status = '".$data['ProductOrderStatus']."', ord_status = '".$data['PlaceOrderStatus']."', cs_type_reason = '".$data['ClaimStatus']."', pay_amount = '".$data['pay_amount']."', ord_amount = '".$data['ord_amount']."', dis_amount = '".$data['dis_amount']."'
				WHERE
					ordno = '".$value."'
				";

				$this->db->query($query);
				break;
			}
		}
		if ($breakYn == true) {
			break;
		}
	}
}

		// �ֹ����� ����
		foreach ($_tmp as $_status => $_conds) {
			foreach($_conds as $_cond) {

				$_where = array();
				foreach ($_cond as $_fld => $_val) $_where[] = " $_fld = '$_val' ";
				if (sizeof($_where) === 0) continue;

				$query = "
				UPDATE ".$this->temp_table_order." SET
					ord_status = $_status
				WHERE ".implode(' AND ', $_where);

				$this->db->query($query);
			}
		}

		// ��Ÿ ��� ����
		$query = "
			UPDATE ".$this->temp_table_order." SET
				old_ordno = '',
				pay_method = IF(pay_method = '�ſ�ī��' OR pay_method = '�ſ�ī�� �������','c',
							 IF(pay_method = '�������Ա�','a',
							 IF(pay_method = '�ǽð�������ü','o',
							 IF(pay_method = '�޴���' OR pay_method = '�޴��� �������','h',
							 IF(pay_method = '����Ʈ����','d',
							 IF(pay_method = '���̹� ĳ��','NAVER_CASH',''))))))
		";
		$this->db->query($query);

	}

	function setSyncComplete() {

		if ($this->update('checkout')) {

			$query = "
			UPDATE ".GD_NAVERCHECKOUT_PRODUCTORDERINFO." AS A
			INNER JOIN ".$this->temp_table_order." AS B
			ON A.OrderID = B.ordno

			SET A.sync_ = 1,A.uptdt_ = '".date('Y-m-d H:i:s',$this->now)."'
			";
			$this->db->query($query);

			$this->db->query("TRUNCATE TABLE ".$this->temp_table_order);
			$this->db->query("TRUNCATE TABLE ".$this->temp_table_item);

		}

	}

	// üũ�ƿ� ��ü ����.
	function &getApiInstance() {
        static $ins = null;

        if ($ins === null)
			$ins = Core::loader('naverCheckoutAPI_4');

        return $ins;

	}

	function getProductOrderIDList($ordno) {

		// �ֹ���ȣ ���̷� 3.0 ����, 4.0 ���� üũ.
		if (strlen((string)$ordno) >= 15) {
			// 4.0
			$query = "
			SELECT
				ProductOrderID
			FROM ".GD_NAVERCHECKOUT_PRODUCTORDERINFO."
			WHERE OrderID = '$ordno'
			";
			$rs = $this->db->query($query);
			$ordnos = array();
			while ($row = $this->db->fetch($rs,1)) {
				$ordnos[] = $row['ProductOrderID'];
			}
			return $ordnos;
		}
		else {
			// 3.0 (���̱׷��̼� �ʿ���)
			return false;
		}

	}

	// �ֹ� ó�� ���� �޼��� (������� �ʰų� �������� �ʴ� �޼���� �����ص� ������)
	function setOrderDeliveryReady($ordno) {	// ����ó��

		$api = $this->getApiInstance();

		if (($ordnos = $this->getProductOrderIDList($ordno)) === false) {
			msg('���̹� üũ�ƿ� 3.0 �ֹ����� ���̱׷����̼� �� �����մϴ�.',-1);
			exit;
		}

		foreach ($ordnos as $ProductOrderID) {
			$param = array(
				'ProductOrderID' => $ProductOrderID
			);
			$rs = $api->request( 'PlaceProductOrder' , $param );
		}

	}

	function setOrderDelivery($ordno,$extra) {

		$api = $this->getApiInstance();

		if (($ordnos = $this->getProductOrderIDList($ordno)) === false) {
			msg('���̹� üũ�ƿ� 3.0 �ֹ����� ���̱׷����̼� �� �����մϴ�.',-1);
			exit;
		}

		$DispatchDate = date('Ymd');

		foreach ($ordnos as $ProductOrderID) {
			$param = array(
				'ProductOrderID' => $ProductOrderID,
				'DeliveryMethodCode' => 'DELIVERY',	// �Ϲ� �ù�� ����
				'DeliveryCompanyCode' => $extra['dlv_company'],
				'TrackingNumber' => $extra['dlv_no'],
				'DispatchDate' => $DispatchDate
			);
			$api->request( 'ShipProductOrder' , $param );
		}

	}



}
?>
