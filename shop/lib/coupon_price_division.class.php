<?php
class coupon_price_division extends coupon_price
{
	public $goodsDc;
	public $goodsPrice;
	public $goodsPriceOne;
	public $goodsPriceOrigin;
	public $goodsPriceCopy;
	public $couponcdData;
	public $couponData;
	public $couponDc;
	public $couponDcCopy;
	public $totalDcPrice = 0;

	/*
	 * �� ��ǰ���� ���� �����ؾ� �Ǵ� ��ǰ�� �ݾ� ������
	 * @param array $item �ֹ���ǰ
	 */
	public function discountGoodsPrice ($item, $mobile = false)
	{
		$file = dirname(FILE) . '/../conf/coupon.php';
		if (is_file($file)) include $file;
		// ���� īƮ�� ��� ��ǰ�� ���� �����ݾ��� goodsPrice�� ����
		foreach ($item as $data) {
			$memberdc = $cfgCoupon['range'] == 2 ? 0 : $data['memberdc'];
			$this->goodsPrice[$data['goodsno']] += ($data['price'] + $data['addprice'] - ($memberdc + $data['special_discount_amount'])) * $data['ea'];
			$this->goodsPriceOne[$data['goodsno']] += ($data['price'] + $data['addprice'] - ($memberdc + $data['special_discount_amount']));
		}
		// goodsPrice�� �����ݾ��� ���� üũ�� ����ǹǷ� ���� �����ݾ��� goodsPriceOrigin�� ���� ����
		$this->goodsPriceOrigin = $this->goodsPrice;
		// �������� ������
		$this->get_goods_coupon('order');
		if ($mobile) $this->get_goods_coupon_mobile('order');
	}

	/*
	 * �� ������ ���αݾ�&�� ���αݾ� ����
	 * @param1 array $couponData ������ȣ
	 * @param2 string $mode �ش� Ŭ���� ��� ��ġ
	 */
	public function checkCouponPrice ($couponData = '', $mode = '')
	{
		$this->couponcdData = $couponData;

		$discount = 0;
		// �ش� �������� ������
		$data = $this->getCouponInfo($couponData);

		foreach ($data as $coupon) {
			$couponcd = $coupon['couponcd'];
			if($coupon['ability']) continue;
			// ���� ���αݾ� : couponPrice - �������αݾ�, couponDcPrice - �������� ������ �� �ִ� ��ǰ �� �ݾ� �� �������� ���� ���αݾ����� ���
			$couponPrice = $this->getCouponPrice(array($coupon['couponPrice'], $coupon['couponDcPrice']));
			// �������αݾ� ��й�
			list($this->couponDc, $this->goodsDc, $this->goodsPrice) = $this->restoreGoodsPrice($couponcd, $coupon['goodsnoArray'], $couponPrice);

			foreach ($coupon['goodsnoArray'] as $goodsno) {
				// �������αݾ��� 0�̸� ������ ����� ��ǰ�� ���αݾ��� 0���� �����ϰ� continue;
				if ($couponPrice <= 0) {
					$this->couponDc[$goodsno][$couponcd] = $this->goodsDc[$couponcd][$goodsno] = 0;
					continue;
				}
				if ($this->goodsPrice[$goodsno] >= $couponPrice) {
					// ��ǰ�ݾ��� �������αݾ׺��� Ŭ ��� �������αݾ��� �������ι迭�� �ְ� �������αݾ� 0
					$this->couponDc[$goodsno][$couponcd] = $this->goodsDc[$couponcd][$goodsno] = $couponPrice;
					$this->goodsPrice[$goodsno] -= $couponPrice;
					$couponPrice = 0;
				} else {
					// ��ǰ�ݾ��� �������αݾ׺��� ���� ��� ��ǰ�ݾ��� �������ι迭�� �ְ� ��ǰ�ݾ� 0 & for�� ��� ����
					$this->couponDc[$goodsno][$couponcd] = $this->goodsDc[$couponcd][$goodsno] = $this->goodsPrice[$goodsno];
					$couponPrice -= $this->goodsPrice[$goodsno];
					$this->goodsPrice[$goodsno] = 0;
				}
			}
		}
		$this->totalDcPrice = array_sum($this->goodsPriceOrigin) - array_sum($this->goodsPrice);

		if ($mode == 'order') return $this->totalDcPrice . '|' . $this->allCouponPrice();
		else return $this->totalDcPrice;
	}

	/*
	 * üũ���� ���� ������ ���� ���αݾ� 
	 * @param1 array $couponData ������ȣ
	 * @param2 $mode �ش� Ŭ���� ��� ��ġ
	 */
	public function allCouponPrice ($couponData = '', $mode = '')
	{
		// ������ȣ�� ������ ��ü������ȣ ����
		if (!$couponData) $couponData = array_diff(array_keys($this->arCoupon), $this->couponcdData);
		if (!$couponData) return;

		$data = $this->getCouponInfo($couponData);

		if ($mode == 'order') return $this->getCouponPrice(array($data[0]['couponPrice'], $data[0]['couponDcPrice']));

		foreach ($data as $coupon) {
			$couponcd = $coupon['couponcd'];
			if($coupon['ability']) continue;
			$couponPrice = $this->getCouponPrice(array($coupon['couponPrice'], $coupon['couponDcPrice']));

			list($couponDcCopy, $goodsDcCopy, $goodsPriceCopy) = $this->restoreGoodsPrice($couponcd, $coupon['goodsnoArray'], $couponPrice);

			foreach ($coupon['goodsnoArray'] as $goodsno) {
				// �������αݾ��� 0�̸� ������ ����� ��ǰ�� ���αݾ��� 0���� �����ϰ� continue;
				if ($couponPrice <= 0) {
					$couponDcCopy[$goodsno][$couponcd] = $goodsDcCopy[$couponcd][$goodsno] = 0;
					continue;
				}
				if ($goodsPriceCopy[$goodsno] >= $couponPrice) {
					// ��ǰ�ݾ��� �������αݾ׺��� Ŭ ��� �������αݾ��� �������ι迭�� �ְ� �������αݾ� 0
					$couponDcCopy[$goodsno][$couponcd] = $goodsDcCopy[$couponcd][$goodsno] = $couponPrice;
					$goodsPriceCopy[$goodsno] -= $couponPrice;
					$couponPrice = 0;
				} else {
					// ��ǰ�ݾ��� �������αݾ׺��� ���� ��� ��ǰ�ݾ��� �������ι迭�� �ְ� ��ǰ�ݾ� 0 & for�� ��� ����
					$goodsPriceCopy[$goodsno][$couponcd] = $goodsDcCopy[$couponcd][$goodsno] = $goodsPriceCopy[$goodsno];
					$couponPrice -= $goodsPriceCopy[$goodsno];
					$goodsPriceCopy[$goodsno] = 0;
				}
			}

			// üũ���� ���� ������ �� ���αݾ� : ���� �� ��ǰ�ݾ� - üũ���� ���� ������ȣ�� ������ ���αݾ� - üũ�� ���� ���αݾ�
			$nonCheckCouponData[$couponcd] = $couponcd."=".array_sum($goodsDcCopy[$couponcd]);
		}
		foreach ($goodsDcCopy as $key=>$value) {
			if (!$nonCheckCouponData[$key]) $nonCheckCouponData[$key] = $key."=".array_sum($value);
		}
		return @implode($nonCheckCouponData, ',');
	}

	/*
	 * �������αݾ� ������
	 * @param1 string $couponcd ������ȣ
	 * @param2 array $goodsnoArray �� �������� ���ΰ����� ��ǰ��ȣ
	 * @param3 string $couponPrice ���� ���� �ݾ�
	 */
	private function restoreGoodsPrice ($couponcd, $goodsnoArray, $couponPrice)
	{
		$goodsTotalPrice = 0;
		$couponDc = $this->couponDc;
		$goodsDc = $this->goodsDc;
		$goodsPrice = $this->goodsPrice;

		// ������ ����� ��ǰ�� ����(��ǰ����+ȸ������+��������)�� ������ �� �ݾ�
		foreach ($goodsnoArray as $goodsno) $goodsTotalPrice += $goodsPrice[$goodsno];

		// ���� ���αݾ��� Ŭ ��� �ش� ������ ����� ��ǰ�� ���αݾ��� ������
		if ($goodsTotalPrice < $couponPrice) {
			// ������ ����� ��ǰ��ȣ�� �������� ���ε� ��ǰ�� ������
			$couponIntersect='';
			$couponIntersect = array_intersect(array_keys($couponDc), $goodsnoArray);

			foreach ($goodsDc as $useCouponcd => $goodsDcData) {
				// ��ǰ���αݾ��� ����� �迭�߿��� ���õ� ������ ����� ��ǰ��ȣ�� ������ ������ ���� ����Ͽ� 0�̸� ���������� ���� (���αݾ��� �ٸ� ��ǰ���� ���� �� ����)
				$goodsReTotalPrice = 0;
				foreach ($goodsnoArray as $goodsno) $goodsReTotalPrice += $goodsDcData[$goodsno];

				if ($goodsReTotalPrice <= 0) continue;
				// ���αݾ��� �ٸ� ��ǰ���� ������ ���� �ش� ������ ������� ���� ��ǰ��ȣ�� ����, �ش� ������ ������ continue
				$goodsDiff = array_diff(array_keys($goodsDcData), $couponIntersect);
				if (!$goodsDiff) continue;

				foreach ($goodsDcData as $goodsno => $dcPrice) {
					if (in_array($goodsno, $goodsDiff)) continue;

					// ���� ���αݾ��� ����ؼ� 0�̸� continue
					$realDcPrice = $this->getCouponPrice(array($dcPrice,$couponPrice));
					if ($realDcPrice <= 0) continue;

					foreach ($goodsDiff as $diffGoodsno) {

						// $diffGoodsno�� ��ǰ�ݾ��� 0�̰ų� ���αݾ��� 0�̸� continue
						if ($goodsPrice[$diffGoodsno] <= 0 || $realDcPrice <= 0 || $couponDc[$goodsno][$useCouponcd] <= 0) continue;

						// �ش� ������ ������� ���� ������ ���αݾ��� ���� ���αݾ׺��� Ŭ ���
						if ($goodsPrice[$diffGoodsno] >= $realDcPrice) {
							if ($couponDc[$goodsno][$useCouponcd] > $realDcPrice) $subDc = $realDcPrice;
							else $subDc = $couponDc[$goodsno][$useCouponcd];

							$couponDc[$goodsno][$useCouponcd] -= $subDc;
							$couponDc[$diffGoodsno][$useCouponcd] += $subDc;

							$goodsDc[$useCouponcd][$goodsno] -= $subDc;
							$goodsDc[$useCouponcd][$diffGoodsno] += $subDc;

							$goodsPrice[$goodsno] += $subDc;
							$goodsPrice[$diffGoodsno] -= $subDc;

							$couponPrice -= $subDc;
							$realDcPrice = 0;
						// �ش� ������ ������� ���� ������ ���αݾ��� ���� ���αݾ׺��� ���� ���
						} else {
							if ($couponDc[$goodsno][$useCouponcd] > $goodsPrice[$diffGoodsno]) $subDc = $goodsPrice[$diffGoodsno];
							else $subDc = $couponDc[$goodsno][$useCouponcd];

							$couponDc[$goodsno][$useCouponcd] -= $subDc;
							$couponDc[$diffGoodsno][$useCouponcd] += $subDc;

							$goodsDc[$useCouponcd][$goodsno] -= $subDc;
							$goodsDc[$useCouponcd][$diffGoodsno] += $subDc;

							$goodsPrice[$goodsno] += $subDc;
							$goodsPrice[$diffGoodsno] -= $subDc;

							$couponPrice -= $subDc;
							$realDcPrice -= $subDc;
						}
					}
				}
			}
		}

		return array($couponDc, $goodsDc, $goodsPrice);
	}

	/*
	 * �ش� �迭�� �ּҰ� return
	 * @param1 array $coupon
	 */
	private function getCouponPrice ($coupon = array())
	{
		return min($coupon);
	}

	private function getCouponInfo ($data) {
		GLOBAL $db, $sess;
		$couponData = array();

		foreach ($data as $key => $couponcd) {
			$couponData[$key]['couponcd'] = $couponcd;

			// ������ ����� ī�װ� ��ȣ ������
			$query = $db->query ("SELECT category as coupon_category FROM " . GD_COUPON_CATEGORY . " WHERE couponcd='" . $couponcd . "'");
			while (list($coupon_category) = $db->fetch ($query)) $couponData[$key]['coupon_category'][] = $coupon_category;
			$couponData[$key]['coupon_category'] = @implode ($couponData[$key]['coupon_category'], ',');

			// ������ ����� ��ǰ��ȣ ������
			if ($this->arCoupon[$couponcd]['coupontype'] === '0') {
				$query = $db->query ("SELECT goodsno as coupon_goodsno FROM " . GD_COUPON_GOODSNO . " WHERE couponcd='" . $couponcd . "'");
				while (list($coupon_goodsno) = $db->fetch ($query)) $couponData[$key]['coupon_goodsno'][] = $coupon_goodsno;
				$couponData[$key]['coupon_goodsno'] = @implode ($couponData[$key]['coupon_goodsno'], ',');
			} else if ($this->arCoupon[$couponcd]['coupontype'] === '1') {
				$query = $db->query ("SELECT ca.goodsno as coupon_goodsno FROM " . GD_COUPON_APPLY . " ca LEFT JOIN ".GD_COUPON_APPLYMEMBER." cam ON ca.sno=cam.applysno WHERE cam.m_no='" . $sess['m_no'] . "' AND ca.couponcd='" . $couponcd . "'");
				while (list($coupon_goodsno) = $db->fetch ($query)) $couponData[$key]['coupon_goodsno'][] = $coupon_goodsno;
				$couponData[$key]['coupon_goodsno'] = @implode ($couponData[$key]['coupon_goodsno'], ',');
			} else {
				$couponData[$key]['coupon_goodsno'] = @implode ($couponData[$key]['coupon_goodsno'], ',');
			}

			$couponData[$key]['couponPrice'] = 0;
			if($this->arCoupon[$couponcd]['sale']) $couponData[$key]['couponPrice'] = @array_sum($this->arCoupon[$couponcd]['sale']);
			if($this->arCoupon[$couponcd]['reserve']) $couponData[$key]['couponPrice'] = @array_sum($this->arCoupon[$couponcd]['reserve']);
			$couponData[$key]['ability'] = $this->arCoupon[$couponcd]['ability'];

			$couponPrice = $couponData[$key]['couponPrice'];
			$category = @explode(',', $couponData[$key]['coupon_category']);
			$goodsno = @explode(',', $couponData[$key]['coupon_goodsno']);
			$goodsnoArr = array();

			// īƮ�� ��� ��ǰ�� �� ������ ����� ��ǰ�� �ִ��� üũ�� ������ �迭�� ����
			foreach ($this->item as $_item) {
				if ($couponData[$key]['coupon_goodsno']){
					if (in_array($_item['goodsno'], $goodsno)) {
						$goodsnoArr[] = $_item['goodsno'];
					}
				} else if ($couponData[$key]['coupon_category']){
					foreach ($_item['category'] as $_category) if (in_array($_category, $category)) {
						$goodsnoArr[] = $_item['goodsno'];
					}
				} else {
					$goodsnoArr[] = $_item['goodsno'];
				}
			}

			$goodsnoArr = array_unique($goodsnoArr);
			$couponData[$key]['goodsnoArray'] = $this->couponData[$couponcd] = $goodsnoArr;
			// �� �������� ���ΰ����� ��ǰ�� �� �ݾ� ����
			foreach ($goodsnoArr as $goodsno) {
				if ($this->arCoupon[$couponcd]['coupontype'] === '1' && !$this->arCoupon[$couponcd]['eactl'] && !$this->arCoupon[$couponcd]['ability']) {
					$couponData[$key]['couponDcPrice'] += $this->goodsPriceOne[$goodsno];
				} else if($this->arCoupon[$couponcd]['ability']) {
					$couponData[$key]['couponDcPrice'] += @array_sum($this->arCoupon[$couponcd]['reserve']);
				} else {
					$couponData[$key]['couponDcPrice'] += $this->goodsPriceOrigin[$goodsno];
				}
			}
		}
		return $couponData;
	}

	// ���� �ݾ� üũ
	function check_coupon($couponSale,$couponReserve,$settlekind,$arApply){
		$totSale = $totReserve = 0;
		$tmpSaleCoupon = array();

		if(!$arApply) return true;

		if ( is_array($this->arCoupon)) {
			foreach($this->arCoupon as $idx => $coupon){
				if(!in_array($coupon[sno],$arApply)) continue;
				if($coupon['pay_method']=='cash' && $settlekind!='a') return "cash";

				if(is_array($coupon['sale']) || $coupon['sale']){
					$tmpSaleCoupon[] = $idx;
				}

				if(is_array($coupon['reserve'])){
					$totReserve += (int) array_sum($coupon['reserve']);
				}else if($coupon['reserve']){
					 $totReserve += (int) $coupon['reserve'];
				}
			}
			$totSale = $this->checkCouponPrice($tmpSaleCoupon);
		}

		if($couponSale!=$totSale) return "sale";
		if($couponReserve!=$totReserve) return "reserve";
		return true;
	}
}