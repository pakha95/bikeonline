<?php
require "../lib/library.php";
require "../lib/partner.class.php";
require "../conf/config.php";
include '../conf/config.pay.php';
@include "../conf/coupon.php";
@require "../conf/daumCpc.cfg.php";

if ($daumCpc['useYN']!= 'Y') exit;

// 쇼핑하우 DB 정리
daum_goods_diff_check();

// 현재 판매 기간이 종료된 상품
$query = "select goodsno,from_unixtime(sales_range_end) sales_range_end from ".GD_GOODS." where sales_range_end <> 0 and sales_range_end < unix_timestamp(now())";
$salesEnd = $db->query($query);
while ($end = $db->fetch($salesEnd,1)) {
	// 종료 시간이 수집 날짜 당일이고 바로전 수집시간 이후인 상품만 데이터 생성
	if ($end['sales_range_end'] > date("Y-m-d") && $end['sales_range_end'] > date("Y-m-d H:i:s",strtotime("-2 hours"))) {
		daum_goods_runout($end['goodsno']);
	}
}

$query = "select no,class,mapid,date_format(utime,'%Y%m%d%H%i%s') utime,pname,price,pgurl,igurl,cate1,cate2,cate3,cate4,caid1,caid2,caid3,caid4,model,brand,maker,deliv,event,point,adult,discount from ".GD_GOODS_UPDATE_DAUM;
$result = $db->query($query);

$partner = new Partner();
$couponData = $partner->getCouponInfo();	// 쿠폰
$discountData = $partner->getDiscount();	// 상품할인

$couponVersion = false; // 쿠폰 버전
if($cfgCoupon['coupon'] && is_file(dirname(__FILE__).'/../data/skin/'.$cfg['tplSkin'].'/proc/popup_coupon_division.htm')) {
	$couponVersion = true;
}

while($row = $db->fetch($result,1))
{
	$query = "select a.goodsno,a.goodsnm,a.maker,a.img_l,a.model_name,a.delivery_type,a.goods_delivery,a.use_emoney,a.goods_reserve,a.use_only_adult,a.naver_event,a.open_mobile,a.use_goods_discount,b.price,c.brandnm,d.category from ".GD_GOODS." as a left join ".GD_GOODS_OPTION." as b on a.goodsno=b.goodsno and go_is_deleted <> '1' and go_is_display = '1' left join ".GD_GOODS_BRAND." as c on a.brandno=c.sno left join ".GD_GOODS_LINK." as d on a.goodsno=d.goodsno where b.link=1 and a.goodsno='$row[mapid]'";
	$_row = $db->fetch($query,1);

	// 판매불가 -> 판매가능 상품
	if ($row['price'] == null) {
		foreach ($_row as $k => $v) {
			if ($k === 'goodsnm') {
				$row['pname'] = $v;
			}
			else if ($k === 'category') {
				for ($i=1;$i<=4;$i++) {
					$tmp_nm="";
					$tmp_code = substr($v,0,3*$i);
					if (strlen($tmp_code)==$i*3) {
						list($tmp_nm) = $db->fetch("select catnm from ".GD_CATEGORY." where category='$tmp_code'");
						$row['caid'.$i]=strip_tags($tmp_code);
						$row['cate'.$i]=strip_tags($tmp_nm);
					}
				}
			}
			else if ($k === 'brandnm') {
				$row['brand'] = $v;
			}
			else if ($k === 'img_l') {
				if (preg_match('/^http(s)?:\/\//', $v)) {
					$row['igurl'] = $v;
				}
				else {
					$row['igurl'] = 'http://'.$_SERVER['HTTP_HOST'].$cfg['rootDir'].'/data/goods/'.$v;
				}
			}
			else if ($k === 'delivery_type') {
				$row['deliv'] = $partner->getDeliveryPrice($_row,$_row['price']);
			}
			else if ($k === 'naver_event') {
				$row['event'] = $v;
			}
			else if ($k === 'use_emoney' && $v === '0') {
				if (!$set['emoney']['chk_goods_emoney'] && $set['emoney']['goods_emoney']) {
					$row['point'] = getDcprice($_row['price'],$set['emoney']['goods_emoney'].'%');
				}
				else {
					$row['point'] = $set['emoney']['goods_emoney'];
				}
			}
			else if ($k === 'use_emoney' && $v === '1') {
				$row['point'] = $_row['goods_reserve'];
			}
			else if ($k === 'use_only_adult') {
				$row['adult'] = $v;
			}
			else if ($k === 'model_name') {
				$row['model'] = $v;
			}
			else {
				$row[$k] = $v;
			}
		}
	}

	// 상품별 할인
	$goodsDiscount = 0;
	if ($_row['use_goods_discount'] == '1') {
		$goodsDiscount = $partner->getDiscountPrice($discountData,$row['mapid'],$row['price']);
	}

	// 즉석할인쿠폰
	$coupon = 0;
	if ($cfgCoupon['use_yn'] == '1') {
		list($coupon,$mobileCoupon,$couponReserve,$coupo,$mcoupon) = $partner->getCouponPrice($couponData, $_row['category'], $row['mapid'], $row['price'], $_row['open_mobile']);
	}

	// 적립금
	$row['point'] += $couponReserve;

	// 회원할인
	$dcprice = 0;
	$memberdc = '';
	$memberdc = $partner->getBasicDc();
	if (is_array($memberdc) === true) {
		$mdc_exc = chk_memberdc_exc($memberdc,$row['mapid']); // 회원할인 제외상품 체크
		if($mdc_exc === false)$dcprice = getDcprice($row['price'],$memberdc['dc'].'%');
	}

	// 쿠폰 회원할인 중복 할인 체크
	if ($coupon>0 && $dcprice>0) {
		if ($cfgCoupon['range'] == 2) $dcprice=0;
		if ($cfgCoupon['range'] == 1) {
			$coupon=0;
		}
	}

	// 상품별 할인과 쿠폰 할인에 대한 가격 계산
	$price = 0;
	$row['mpric'] = 0;

	if ($row['price'] > $coupon + $dcprice + $goodsDiscount) $price = $row['price'] - $coupon - $dcprice - $goodsDiscount;
	else $price = 0;

	if ($couponVersion === true && $coupon > $row['price'] - $dcprice - $goodsDiscount) {
		$coupon = $row['price'] - $dcprice - $goodsDiscount;
		$coupo = $coupon.'원';
	}
	if ($coupon) $row['coupo'] = $coupo;

	// 모바일 쿠폰 가격 계산
	if ($row['price'] > $mobileCoupon + $dcprice + $goodsDiscount && $mobileCoupon) $row['mpric'] = $row['price'] - $mobileCoupon - $dcprice - $goodsDiscount;
	else $row['mpric'] = '0';

	if ($couponVersion === true && $mobileCoupon > $row['price'] - $dcprice - $goodsDiscount) {
		$mcoupon = $row['price'] - $dcprice - $goodsDiscount;
		$mcoupon = $mcoupon.'원';
	}
	if ($mobileCoupon) $row['mcoupon'] = $mcoupon;

	// 빈 카테고리 정리
	for ($i=1; $i<5; $i++) {
		if ($row['cate'.$i] == '') {
			unset($row['cate'.$i]);
			unset($row['caid'.$i]);
		}
	}

	// 상품명 머릿말
	$goodsnm = '';
	if ($daumCpc['goodshead']) {
		if ($row['maker'] || $row['brand']) {
			$goodsnm = str_replace(array('{_maker}','{_brand}'),array($row['maker'],$row['brand']),$daumCpc['goodshead']).$row['pname'];
		}
		else {
			$goodsnm = str_replace(array('{_maker}','{_brand}'),array($_row['maker'],$_row['brandnm']),$daumCpc['goodshead']).$row['pname'];
		}
	}
	else {
		$goodsnm = $row['pname'];
	}

	// 성인인증 상품
	if ($row['adult'] === '1') {
		$row['adult'] = 'Y';
	}
	else
		unset($row['adult']);

	$mapid = $row['mapid'];
	$class = $row['class'];
	$utime = $row['utime'];
	$lprice = $row['price'];

	unset($row['no']);
	unset($row['mapid']);
	unset($row['price']);
	unset($row['utime']);
	unset($row['class']);
	unset($row['pname']);
	unset($row['discount']);
	unset($row['goods_delivery']);
	unset($row['goods_reserve']);

header("Cache-Control: no-cache, must-revalidate");
header("Content-Type: text/plain; charset=euc-kr");

	echo "<<<begin>>>\n";
	echo '<<<mapid>>>'.$mapid."\n";
	if ($class != 'D') {
		if ($price != $lprice) {
			echo '<<<lprice>>>'.$lprice."\n";
		}
		echo '<<<price>>>'.$price."\n";
	}
	echo '<<<class>>>'.$class."\n";
	echo '<<<utime>>>'.$utime."\n";
	if( $class != 'D') {
		echo "<<<pname>>>".$goodsnm."\n";
		foreach ($row as $key=>$value) {
			if ($value != null) {
					echo '<<<'.$key.'>>>'.strip_tags($value)."\n";
					if ($key == 'igurl' && $class == 'U') echo '<<<upimg>>>Y'."\n";
				}
		}
	}
	echo "<<<ftend>>>\n";
}

?>
