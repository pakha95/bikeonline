<?
require "../lib/library.php";
require "../conf/config.pay.php";
require "../conf/config.php";
require "../lib/load.class.php";
require "../lib/partner.class.php";
@include "../conf/coupon.php";
@require "../conf/daumCpc.cfg.php";

if($daumCpc['useYN']!= 'Y') exit;

class DaumCpcList Extends LoadClass
{
	function getDeliveryPrice($v,$price){
		global $set;
		$deliv = 0;
		if($v['delivery_type'] == 0){
			if($set['delivery']['free'] && $set['delivery']['default'] && $set['delivery']['deliveryType'] != "�ĺ�"){
				if ($price >= $set['delivery']['free'])
					$deliv = 0;
				else
					$deliv = $set['delivery']['default'];
			}
		}else if($v['delivery_type'] == 1){
			$deliv = 0;
		}
		else if($v['delivery_type'] == 3){
			$deliv = -1;
		}
		else if($v['delivery_type'] == 4 || $v['delivery_type'] == 5){
			$deliv = $v['goods_delivery'];
		}
		return $deliv;
	}

	function exec(){
		global $db,$daumCpc,$cfg,$cfgCoupon,$set;
		$url = "http://".$_SERVER['HTTP_HOST'].$cfg['rootDir'];
		$this->class_load('Partner','Partner');
		$godo = $this->class['Partner']->getGodoCfg();
		$memberdc = $this->class['Partner']->getBasicDc();
		$catnm = $this->class['Partner']->getCatnm();
		$query = $this->class['Partner']->getGoodsSql($mode);
		$res = $db->query($query);
		$tdate = date('Ymd',time());

		$goodsModel = Clib_Application::getModelClass('Goods_Discount');

		$tocnt = mysql_num_rows($res);	// ��ü ��ǰ ����
		echo('<<<tocnt>>>'.$tocnt.chr(10));
		$arrayData = array();
		while ($v = $db->fetch($res,1)){
			list($v['price'],$v['reserve']) = $this->class['Partner']->getGoodsOption($v['goodsno']);

			// ��ǰ�� ����
			$goodsDiscount = 0;
			$goodsDiscount = $goodsModel->getDiscountAmountSearch($v,0);

			### ��ǰ�� �Ӹ��� ����
			$v['goodsnm'] = $this->class['Partner']->getGoodsnm($daumCpc,$v);

			### �Ｎ��������
			list($v['coupon'],$v['coupon_emoney'],$v['couponPrice']) = getCouponInfo($v['goodsno'],$v['price'],'','Y');
			$v['reserve'] += $v['coupon_emoney'];
			$coupon = 0;
			if($v['coupon'])$coupon = getDcprice($v['price'],$v['coupon']);

			// ���� ���� ���κ� �з�
			for ($i=0; $i<count($v['couponPrice']); $i++) {
				if (strpos($v['couponPrice'][$i],'%') === false) $v['couponPrice'][$i] = $v['couponPrice'][$i].'��';	// %���� �ƴϸ� �ڿ� ���� �������
			}

			// ����� ���� ���� ����
			if ($v['open_mobile'] === '1') {
				list($v['mobileCoupon'],$v['mobile_coupon_emoney'],$v['mobileCouponPrice']) = getCouponInfoMobile($v['goodsno'],$v['price'],'','Y');

				// ����� ���� ���� ���κ� �з�
				for ($i=0; $i<count($v['mobileCouponPrice']); $i++) {
					if (strpos($v['mobileCouponPrice'][$i],'%') === false) $v['mobileCouponPrice'][$i] = $v['mobileCouponPrice'][$i].'��';	// %���� �ƴϸ� �ڿ� ���� �������
				}
			}

			### ȸ������
			$dcprice = 0;
			if (is_array($memberdc) === true) {
				$mdc_exc = chk_memberdc_exc($memberdc,$v['goodsno']); // ȸ������ ���ܻ�ǰ üũ
				if($mdc_exc === false)$dcprice = getDcprice($v['price'],$memberdc['dc'].'%');
			}

			### ���� ȸ������ �ߺ� ���� üũ
			if($coupon>0 && $dcprice>0){
				if($cfgCoupon['range'] == 2)$dcprice=0;
				if($cfgCoupon['range'] == 1){
					$coupon=0;
				}
			}

			### ���� ����
			$coupon += 0;
			$dcprice += 0;

			// ��ǰ�� ���ΰ� ���� ���ο� ���� ���� ���
			$price = 0;
			if ($goodsDiscount && $cfgCoupon['double'] === '1') {	// ��ǰ�� ���ΰ� ���� �ߺ� ��� ����
				$price = $v['price'] - $coupon - $dcprice - $goodsDiscount;
			}
			else if ($goodsDiscount) {	// ��ǰ�� ���θ� ���� ��
				$price = $v['price'] - $dcprice - $goodsDiscount;
			}
			else {
				$price = $v['price'] - $dcprice;
			}

			// �������� ū ���� ��󳻱�
			if (isset($v['couponPrice'])) {
				$couponPrice = 0;	// ���� ����
				$tmp = 0;	// �������� ū ���� ���� ����
				$fixMax = 0;	// �� ���αݾ�
				$percentMax = 0;	// % ���� �ݾ�
				$coupo = '';
				for ($i=0; $i<count($v['couponPrice']); $i++) {
					if (strpos($v['couponPrice'][$i],'%') === false) {
						$couponPrice = substr($v['couponPrice'][$i] , 0, -2);
						$tmp = $couponPrice;
						if($fixMax < $tmp) $fixMax = $tmp;
					}
					else {
						$couponPrice = substr($v['couponPrice'][$i] , 0, -1);
						$tmp = $couponPrice;
						if($percentMax < $tmp) $percentMax = $tmp;
					}
				}
				if (($price-$fixMax <= $price-($price*($percentMax/100))) || $price-$fixMax < 0) {
					$coupo = $fixMax.'��';
					if ($cfgCoupon['double'] === '0')	// ���� �ߺ� �Ұ� ��
						$price = $price-$fixMax;
				}
				else {
					$coupo = $percentMax.'%';
					if ($cfgCoupon['double'] === '0')	// ���� �ߺ� �Ұ� ��
						$price = $price-($price*($percentMax/100));
				}
			}

			// �������� ū ����� ���� ��󳻱�
			if (isset($v['mobileCouponPrice'])) {
				$mobileCouponPrice = 0;
				$tmp = 0;
				$fixMax = 0;	// �� ���αݾ�
				$percentMax = 0;	// % ���� �ݾ�
				$mcoupon= '';
				$mobilePrice = 0;
				for ($i=0; $i<count($v['mobileCouponPrice']); $i++) {
					if (strpos($v['mobileCouponPrice'][$i],'%') === false) {
						$mobileCouponPrice = substr($v['mobileCouponPrice'][$i] , 0, -2);
						$tmp = $mobileCouponPrice;
						if($fixMax < $tmp) $fixMax = $tmp;
					}
					else {
						$mobileCouponPrice = substr($v['mobileCouponPrice'][$i] , 0, -1);
						$tmp = $mobileCouponPrice;
						if($percentMax < $tmp) $percentMax = $tmp;
					}
				}
				
				// ����� ������ ���� ����� ����
				if (($v['price']-$fixMax <= $v['price']-($v['price']*($percentMax/100))) || $v['price']-$fixMax < 0) {
					$mcoupon = $fixMax.'��';
					if ($cfgCoupon['double'] === '0')	// ���� �ߺ� �Ұ� ��
						$mobilePrice = $v['price']-$fixMax-$dcprice;
					else
						$mobilePrice = $price-$fixMax;
				}
				else {
					$mcoupon = $percentMax.'%';
					if ($cfgCoupon['double'] === '0') {	// ���� �ߺ� �Ұ� ��
						$mobilePrice = $v['price']-($v['price']*($percentMax/100));
					}
					else
						$mobilePrice = $price-($v['price']*($percentMax/100));
				}
			}

			### ��ۺ�
			$deliv = 0;
			$deliv = $this->getDeliveryPrice($v,$price);

			// �̹���
			$img_url = '';
			$img_url = $this->class['Partner']->getGoodsImg($v['img_m'],$url);

			### review
			$review = 0;
			$review = $this->class['Partner']->getReviewCnt($v['goodsno']);

			###������
			$point = 0;
			if($v['use_emoney']=='0')
			{
				if( !$set['emoney']['chk_goods_emoney'] ){
					if( $set['emoney']['goods_emoney'] ) {
						$dc=$set['emoney']['goods_emoney']."%";
						$tmp_price = $v['price'];
						if( $set['emoney']['cut'] ) $po = pow(10,$set['emoney']['cut']);
						else $po = 100;
						$tmp_price = (substr($dc,-1)=="%") ? $tmp_price * substr($dc,0,-1) / 100 : $dc;
						$point =  floor($tmp_price / $po) * $po;

					}
				}else{
					$point	= $set['emoney']['goods_emoney'];
				}
			}
			else
			{
				$point=$v['reserve'];
			}

			if($catnm[substr($v['category'],0,3)] && $godo['sno'] && $v['goodsno'] && $price != "" && $v['goodsnm']){
				echo('<<<begin>>>'.chr(10));
				echo('<<<mapid>>>'.$v['goodsno'].chr(10));
				if($v['price'] != $price)echo('<<<lprice>>>'.$v['price'].chr(10));
				echo('<<<price>>>'.$price.chr(10));
				if(isset($v['mobileCouponPrice']) && $v['open_mobile'] === '1')echo('<<<mpric>>>'.$mobilePrice.chr(10));
				echo('<<<pname>>>'.$v['goodsnm'].chr(10));
				echo('<<<pgurl>>>'.$url.'/goods/goods_view.php?inflow=daumCpc&goodsno='.$v['goodsno'].chr(10));
				echo('<<<igurl>>>'.$img_url.chr(10));
				for ($i=1;$i<=strlen($v['category'])/3;$i++) echo('<<<cate'.$i.'>>>'.$catnm[substr($v['category'],0,$i*3)].chr(10));
				for ($i=1;$i<=strlen($v['category'])/3;$i++) echo('<<<caid'.$i.'>>>'.substr($v['category'],0,$i*3).chr(10));
				if($v['model_name'])echo('<<<model>>>'.$v['model_name'].chr(10));
				if($v['brandnm'])echo('<<<brand>>>'.$v['brandnm'].chr(10));
				if($v['maker'])echo('<<<maker>>>'.$v['maker'].chr(10));
				if ($coupon > 0)echo('<<<coupo>>>'.$coupo.chr(10));
				if (isset($v['mobileCouponPrice']))echo('<<<mcoupon>>>'.$mcoupon.chr(10));
				if($daumCpc['nv_pcard'])echo('<<<pcard>>>'.$daumCpc['nv_pcard'].chr(10));
				if($point)echo('<<<point>>>'.$point.chr(10));
				echo('<<<deliv>>>'.$deliv.chr(10));
				if($review)echo('<<<revct>>>'.$review.chr(10));
				if($v['naver_event'])echo('<<<event>>>'.$v['naver_event'].chr(10));
				if($v['use_only_adult'] === '1')echo('<<<adult>>>Y'.chr(10));
				echo('<<<ftend>>>'.chr(10));
			}
			flush();
		}
	}
	function check_accept_ip(){
		$out = readurl("http://gongji.godo.co.kr/userinterface/serviceIp/daumCpc.php");
		$arr = explode(chr(10),$out);
		$ret = false;
		foreach($arr as $v){
			$v = trim($v);
			if($v&&preg_match('/'.$v.'/',$_SERVER['REMOTE_ADDR']))$ret = true;
		}
		if(preg_match('/admin\/daumcpc\/partner.php/',$_SERVER['HTTP_REFERER'])) $ret = true;
		return $ret;
	}
}

$ds = new DaumCpcList;
if(!$ds->check_accept_ip()) exit;

header("Cache-Control: no-cache, must-revalidate");
header("Content-Type: text/plain; charset=euc-kr");

$ds -> exec();
?>
