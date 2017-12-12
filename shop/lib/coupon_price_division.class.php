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
	 * 각 상품별로 실제 지불해야 되는 상품당 금액 재정의
	 * @param array $item 주문상품
	 */
	public function discountGoodsPrice ($item, $mobile = false)
	{
		$file = dirname(FILE) . '/../conf/coupon.php';
		if (is_file($file)) include $file;
		// 최초 카트에 담긴 상품의 실제 결제금액을 goodsPrice에 저장
		foreach ($item as $data) {
			$memberdc = $cfgCoupon['range'] == 2 ? 0 : $data['memberdc'];
			$this->goodsPrice[$data['goodsno']] += ($data['price'] + $data['addprice'] - ($memberdc + $data['special_discount_amount'])) * $data['ea'];
			$this->goodsPriceOne[$data['goodsno']] += ($data['price'] + $data['addprice'] - ($memberdc + $data['special_discount_amount']));
		}
		// goodsPrice의 결제금액은 쿠폰 체크시 변경되므로 최초 결제금액을 goodsPriceOrigin에 따로 저장
		$this->goodsPriceOrigin = $this->goodsPrice;
		// 쿠폰정보 가져옴
		$this->get_goods_coupon('order');
		if ($mobile) $this->get_goods_coupon_mobile('order');
	}

	/*
	 * 각 쿠폰의 할인금액&총 할인금액 정의
	 * @param1 array $couponData 쿠폰번호
	 * @param2 string $mode 해당 클래스 사용 위치
	 */
	public function checkCouponPrice ($couponData = '', $mode = '')
	{
		$this->couponcdData = $couponData;

		$discount = 0;
		// 해당 쿠폰정보 가져옴
		$data = $this->getCouponInfo($couponData);

		foreach ($data as $coupon) {
			$couponcd = $coupon['couponcd'];
			if($coupon['ability']) continue;
			// 실제 할인금액 : couponPrice - 쿠폰할인금액, couponDcPrice - 쿠폰으로 할인할 수 있는 상품 총 금액 중 작은값을 실제 할인금액으로 사용
			$couponPrice = $this->getCouponPrice(array($coupon['couponPrice'], $coupon['couponDcPrice']));
			// 쿠폰할인금액 재분배
			list($this->couponDc, $this->goodsDc, $this->goodsPrice) = $this->restoreGoodsPrice($couponcd, $coupon['goodsnoArray'], $couponPrice);

			foreach ($coupon['goodsnoArray'] as $goodsno) {
				// 쿠폰할인금액이 0이면 쿠폰과 연결된 상품의 할인금액을 0으로 세팅하고 continue;
				if ($couponPrice <= 0) {
					$this->couponDc[$goodsno][$couponcd] = $this->goodsDc[$couponcd][$goodsno] = 0;
					continue;
				}
				if ($this->goodsPrice[$goodsno] >= $couponPrice) {
					// 상품금액이 쿠폰할인금액보다 클 경우 쿠폰할인금액을 쿠폰할인배열에 넣고 쿠폰할인금액 0
					$this->couponDc[$goodsno][$couponcd] = $this->goodsDc[$couponcd][$goodsno] = $couponPrice;
					$this->goodsPrice[$goodsno] -= $couponPrice;
					$couponPrice = 0;
				} else {
					// 상품금액이 쿠폰할인금액보다 작을 경우 상품금액을 쿠폰할인배열에 넣고 상품금액 0 & for문 계속 돌림
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
	 * 체크되지 않은 쿠폰의 실제 할인금액 
	 * @param1 array $couponData 쿠폰번호
	 * @param2 $mode 해당 클래스 사용 위치
	 */
	public function allCouponPrice ($couponData = '', $mode = '')
	{
		// 쿠폰번호가 없으면 전체쿠폰번호 저장
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
				// 쿠폰할인금액이 0이면 쿠폰과 연결된 상품의 할인금액을 0으로 세팅하고 continue;
				if ($couponPrice <= 0) {
					$couponDcCopy[$goodsno][$couponcd] = $goodsDcCopy[$couponcd][$goodsno] = 0;
					continue;
				}
				if ($goodsPriceCopy[$goodsno] >= $couponPrice) {
					// 상품금액이 쿠폰할인금액보다 클 경우 쿠폰할인금액을 쿠폰할인배열에 넣고 쿠폰할인금액 0
					$couponDcCopy[$goodsno][$couponcd] = $goodsDcCopy[$couponcd][$goodsno] = $couponPrice;
					$goodsPriceCopy[$goodsno] -= $couponPrice;
					$couponPrice = 0;
				} else {
					// 상품금액이 쿠폰할인금액보다 작을 경우 상품금액을 쿠폰할인배열에 넣고 상품금액 0 & for문 계속 돌림
					$goodsPriceCopy[$goodsno][$couponcd] = $goodsDcCopy[$couponcd][$goodsno] = $goodsPriceCopy[$goodsno];
					$couponPrice -= $goodsPriceCopy[$goodsno];
					$goodsPriceCopy[$goodsno] = 0;
				}
			}

			// 체크되지 않은 쿠폰의 실 할인금액 : 원래 총 상품금액 - 체크되지 않은 쿠폰번호를 포함한 할인금액 - 체크된 쿠폰 할인금액
			$nonCheckCouponData[$couponcd] = $couponcd."=".array_sum($goodsDcCopy[$couponcd]);
		}
		foreach ($goodsDcCopy as $key=>$value) {
			if (!$nonCheckCouponData[$key]) $nonCheckCouponData[$key] = $key."=".array_sum($value);
		}
		return @implode($nonCheckCouponData, ',');
	}

	/*
	 * 쿠폰할인금액 재정렬
	 * @param1 string $couponcd 쿠폰번호
	 * @param2 array $goodsnoArray 각 쿠폰으로 할인가능한 상품번호
	 * @param3 string $couponPrice 쿠폰 할인 금액
	 */
	private function restoreGoodsPrice ($couponcd, $goodsnoArray, $couponPrice)
	{
		$goodsTotalPrice = 0;
		$couponDc = $this->couponDc;
		$goodsDc = $this->goodsDc;
		$goodsPrice = $this->goodsPrice;

		// 쿠폰과 연결된 상품의 할인(상품할인+회원할인+쿠폰할인)을 차감한 총 금액
		foreach ($goodsnoArray as $goodsno) $goodsTotalPrice += $goodsPrice[$goodsno];

		// 쿠폰 할인금액이 클 경우 해당 쿠폰에 연결된 상품의 할인금액을 재정렬
		if ($goodsTotalPrice < $couponPrice) {
			// 쿠폰과 연결된 상품번호와 쿠폰으로 할인된 상품의 교집합
			$couponIntersect='';
			$couponIntersect = array_intersect(array_keys($couponDc), $goodsnoArray);

			foreach ($goodsDc as $useCouponcd => $goodsDcData) {
				// 상품할인금액이 저장된 배열중에서 선택된 쿠폰과 연결된 상품번호가 동일한 할인의 합을 계산하여 0이면 재정렬하지 않음 (할인금액을 다른 상품으로 보낼 수 없음)
				$goodsReTotalPrice = 0;
				foreach ($goodsnoArray as $goodsno) $goodsReTotalPrice += $goodsDcData[$goodsno];

				if ($goodsReTotalPrice <= 0) continue;
				// 할인금액을 다른 상품으로 보내기 위해 해당 쿠폰과 연결되지 않은 상품번호를 저장, 해당 내용이 없으면 continue
				$goodsDiff = array_diff(array_keys($goodsDcData), $couponIntersect);
				if (!$goodsDiff) continue;

				foreach ($goodsDcData as $goodsno => $dcPrice) {
					if (in_array($goodsno, $goodsDiff)) continue;

					// 실제 할인금액을 계산해서 0이면 continue
					$realDcPrice = $this->getCouponPrice(array($dcPrice,$couponPrice));
					if ($realDcPrice <= 0) continue;

					foreach ($goodsDiff as $diffGoodsno) {

						// $diffGoodsno의 상품금액이 0이거나 할인금액이 0이면 continue
						if ($goodsPrice[$diffGoodsno] <= 0 || $realDcPrice <= 0 || $couponDc[$goodsno][$useCouponcd] <= 0) continue;

						// 해당 쿠폰과 연결되지 않은 쿠폰의 할인금액이 실제 할인금액보다 클 경우
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
						// 해당 쿠폰과 연결되지 않은 쿠폰의 할인금액이 실제 할인금액보다 작을 경우
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
	 * 해당 배열의 최소값 return
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

			// 쿠폰에 연결된 카테고리 번호 가져옴
			$query = $db->query ("SELECT category as coupon_category FROM " . GD_COUPON_CATEGORY . " WHERE couponcd='" . $couponcd . "'");
			while (list($coupon_category) = $db->fetch ($query)) $couponData[$key]['coupon_category'][] = $coupon_category;
			$couponData[$key]['coupon_category'] = @implode ($couponData[$key]['coupon_category'], ',');

			// 쿠폰에 연결된 상품번호 가져옴
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

			// 카트에 담긴 상품중 각 쿠폰에 연결된 상품이 있는지 체크후 있으면 배열에 저장
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
			// 각 쿠폰에서 할인가능한 상품의 총 금액 저장
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

	// 쿠폰 금액 체크
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