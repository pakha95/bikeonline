<?
/*
 * 네이버 EP DB 파일 생성
 * @version 1.0
 * @date 2016-06-30
 */
include dirname(__FILE__) . '/../lib/partner.class.php';

class naverPartner extends Partner
{
	var $tmp_filename = "";
	var $new_filename = "";
	var $offset = "";
	var $goods_cnt = '';
	var $page_cnt = '';
	var $partner = '';

	function __construct()
	{
		global $partner;

		$dirPath = dirname(__FILE__) . '/../conf/naver_ep';
		if (is_dir($dirPath) === false) {
			mkdir($dirPath);
			chmod($dirPath,0707);
		}

		$this->tmp_filename = $dirPath.'/naver2_tmp.txt';
		$this->new_filename = $dirPath.'/naver2_new.txt';
		$this->old_filename = $dirPath.'/naver2_old.txt';
		$this->offset = 200000;
		$this->goods_cnt = 0;
		$this->page_cnt = 1;

		if (!$partner) {
			@include dirname(__FILE__) . "/../conf/partner.php";
		}
		$this->partner = $partner;
	}

	/*
	 * 전체 EP 구성
	 * @return bool
	 */
	function allEp()
	{
		global $db,$cfg,$cfgCoupon,$set,$cfgMobileShop;

		if (!$cfgCoupon) {
			@include dirname(__FILE__) . "/../conf/coupon.php";
		}
		if (!$set) {
			@include dirname(__FILE__) . "/../conf/config.pay.php";
		}
		if (!$cfgMobileShop) {
			@include dirname(__FILE__) . "/../conf/config.mobileShop.php";
		}

		$domain = '';
		if ($_SERVER['HTTP_HOST'] != '') {
			$domain = $_SERVER['HTTP_HOST'];
		}
		else if($cfg['shopUrl']){
			$domain = preg_replace('/http(s)?:\/\//' , '', $cfg['shopUrl']);
		}
		else {
			return false;
		}

		$url = "http://".$domain.$cfg['rootDir'];

		$columns = $this->checkColumnNaver();		// EP 생성에 필요한 컬럼 확인
		$couponData = $this->getCouponInfo();		// 쿠폰
		$memberdc = $this->getBasicDc();			// 회원할인
		$catnm = $this->getCatnm();					// 카테고리명
		$brandnm = $this->getBrand();				// 브랜드명
		$discountData = $this->getDiscount();		// 상품할인
		$review = $this->getReview();				// 리뷰 개수
		$query = $this->getGoodsSql($columns);		// 상품 출력
		$res = $db->query($query);
		$goodsCnt = mysql_num_rows($res);	// 전체 상품 개수

		//파일 초기화
		$this->naverFileDrop("",'',"w");

		while ($v = $db->fetch($res,1)){

			//카테고리
			$length = strlen($v['category'])/3;
			for ($i=1;$i<=4;$i++) {
				$tmp=substr($v['category'],0,$i*3);
				$v['cate'.$i]=($i<=$length) ? strip_tags($catnm[$tmp]) : '';
				$v['caid'.$i]=($i<=$length) ? $tmp : '';
			}

			// 상품별 할인
			$goodsDiscount = 0;
			if ($v['use_goods_discount'] == '1') {
				$goodsDiscount = $this->getDiscountPrice($discountData,$v['goodsno'],$v['goods_price']);
			}

			$couponVersion = false; // 쿠폰 버전
			if ($cfgCoupon['coupon'] && is_file(dirname(__FILE__).'/../data/skin/'.$cfg['tplSkin'].'/proc/popup_coupon_division.htm')) {
				$couponVersion = true;
			}

			//회원할인
			$dcprice = 0;
			if ($this->partner['unmemberdc'] == 'N') {	// 회원할인적용여부
				if (is_array($memberdc) === true) {
					$mdc_exc = chk_memberdc_exc($memberdc,$v['goodsno']); // 회원할인 제외상품 체크
					if ($mdc_exc === false) $dcprice = getDcprice($v['goods_price'],$memberdc['dc'].'%');
				}
			}

			// 쿠폰 할인 적용 여부
			$coupon = 0;		// 쿠폰 할인 금액
			$couponReserve = 0;	// 적립 쿠폰

			if ($cfgCoupon['use_yn'] && $this->partner['uncoupon'] == 'N') {
				list($coupon,$couponReserve) = $this->getCouponPrice($couponData, $v['category'], $v['goodsno'], $v['goods_price']);
				if ($coupon > $v['goods_price'] - $dcprice - $goodsDiscount && $couponVersion === true) $coupon = $v['goods_price'] - $dcprice - $goodsDiscount;
			}

			// 쿠폰 회원할인 중복 할인 체크
			if ($coupon > 0 && $dcprice > 0) {
				if ($cfgCoupon['range'] == 2) $dcprice = 0;
				if ($cfgCoupon['range'] == 1) {
					$coupon = 0;
				}
			}

			// 노출 가격
			$price = 0;
			$price = $v['goods_price'] - $coupon - $dcprice - $goodsDiscount;

			// 배송비
			$deliv = $this->getDeliveryPrice($v,$price);

			// 이미지
			$img_url = '';
			$img_name = '';
			if (!$v['img_l'] || $v['img_l'] == '') {
				if (!$v['img_m'] || $v['img_m'] == '') {
					continue;
				}
				else {
					$img_name = $v['img_m'];
				}
			}
			else {
				$img_name = $v['img_l'];
			}
			$img_url = $this->getGoodsImg($img_name,$url);

			// 적립금
			$point = 0;
			if ($v['use_emoney']=='0') {
				if (!$set['emoney']['chk_goods_emoney']) {
					if ($set['emoney']['goods_emoney']) {
						$dc=$set['emoney']['goods_emoney']."%";
						$tmp_price = $v['goods_price'];
						if ($set['emoney']['cut']) $po = pow(10,$set['emoney']['cut']);
						else $po = 100;
						$tmp_price = (substr($dc,-1)=="%") ? $tmp_price * substr($dc,0,-1) / 100 : $dc;
						$point =  floor($tmp_price / $po) * $po;

					}
				}
				else {
					$point = $set['emoney']['goods_emoney'];
				}
			}
			else {
				$point = $v['goods_reserve'];
			}
			$point += $couponReserve;

			$extra_info = gd_json_decode(stripslashes($row['extra_info']));
			$dlvDesc = '';
			$addPrice = '';
			$isDlv = '';
			$isAddPrice = '';
			$isCoupon = '';
			if (is_array($extra_info)) {
				foreach($extra_info as $key=>$val) {
					if($val['title'] == '배송 · 설치비용'){
						$dlvDesc = $val['desc'];
					}
					if($val['title'] == '추가설치비용'){
						$addPrice = $val['desc'];
					}
				}
			}
			if ($dlvDesc) {
				$isDlv = 'Y';
			}
			if ($addPrice) {
				$isAddPrice = 'Y';
			}
			if ($coupon>0) {
				$isCoupon = 'Y';
			}

			// 브랜드명 가져오기
			$v['brandnm'] = $brandnm[$v['brandno']];

			// 상품명에 머릿말 조합
			$v['goodsnm'] = $this->getGoodsnm($this->partner,$v);

			// 이벤트
			$event = '';
			if ($this->partner['naver_event_common'] === 'Y' && empty($this->partner['eventCommonText']) === false) {	// 공통 문구
				$event = $this->partner['eventCommonText'];
			}

			if ($this->partner['naver_event_goods'] === 'Y' && empty($v['naver_event']) === false) {	// 상품별 문구
				if (empty($event) === false) $event .= ' , ';
				$event .= $v['naver_event'];
			}

			$v['event'] = strip_tags($event);

			$line_data = '<<<begin>>>'.chr(10);
			$line_data .= '<<<mapid>>>'.$v['goodsno'].chr(10);
			$line_data .= '<<<pname>>>'.$v['goodsnm'].chr(10);
			$line_data .= '<<<price>>>'.$price.chr(10);
			$line_data .= '<<<pgurl>>>'.$url.'/goods/goods_view.php?goodsno='.$v['goodsno'].'&inflow=naver'.chr(10);
			$line_data .= '<<<igurl>>>'.$img_url.chr(10);
			$line_data .= '<<<cate1>>>'.$v['cate1'].chr(10);
			$line_data .= '<<<caid1>>>'.$v['caid1'].chr(10);
			$line_data .= '<<<cate2>>>'.$v['cate2'].chr(10);
			$line_data .= '<<<caid2>>>'.$v['caid2'].chr(10);
			$line_data .= '<<<cate3>>>'.$v['cate3'].chr(10);
			$line_data .= '<<<caid3>>>'.$v['caid3'].chr(10);
			$line_data .= '<<<cate4>>>'.$v['cate4'].chr(10);
			$line_data .= '<<<caid4>>>'.$v['caid4'].chr(10);
			if($v['brandnm'])$line_data .= '<<<brand>>>'.$v['brandnm'].chr(10);
			if($v['maker'])$line_data .= '<<<maker>>>'.$v['maker'].chr(10);
			if($v['origin'])$line_data .= '<<<origi>>>'.$v['origin'].chr(10);
			$line_data .= '<<<deliv>>>'.$deliv.chr(10);
			$line_data .= '<<<event>>>'.$v['event'].chr(10);
			if ($coupon)$line_data .= '<<<coupo>>>'.$coupon.chr(10);
			if($this->partner['nv_pcard'])$line_data .= '<<<pcard>>>'.$this->partner['nv_pcard'].chr(10);
			if($point)$line_data .= '<<<point>>>'.$point.chr(10);
			$line_data .= '<<<revct>>>'.(!$review[$v['goodsno']]?0:$review[$v['goodsno']]).chr(10);
			if (isset($cfgMobileShop) && $cfgMobileShop['useMobileShop'] == '1' && $domain) $line_data .= '<<<mourl>>>http://'.$domain.'/m/goods/view.php?goodsno='.$v['goodsno'] .'&inflow=naver'.chr(10);
			else  $line_data .= '<<<mourl>>>'.chr(10);
			$line_data .= '<<<pcpdn>>>'.$isCoupon.chr(10);
			$line_data .= '<<<dlvga>>>'.$isDlv.chr(10);
			$line_data .= '<<<dlvdt>>>'.$dlvDesc.chr(10);
			$line_data .= '<<<insco>>>'.$isAddPrice.chr(10);
			$line_data .= '<<<ftend>>>'.chr(10);

			$fw = '';
			$fw = $this->naverFileDrop($line_data,$this->goods_cnt);
			unset($v);
			unset($line_data);
			if ($fw === false) return false;
			$this->goods_cnt++;
		}

		$this->naverFileMerge($this->page_cnt);
		return true;
	}

	/*
	 * EP 파일 생성 및 내용 쓰기
	 * @return int
	 */
	function naverFileDrop($line_data,$goods_cnt,$mode="")
	{
		if ($goods_cnt > $this->offset) {
			$this->page_cnt = $this->page_cnt+1;
			$this->offset = $this->offset*$this->page_cnt;
		}

		if ($mode == 'w') {
			$handle = fopen($this->tmp_filename.$this->page_cnt, "w");
		} else {
			$handle = fopen($this->tmp_filename.$this->page_cnt, "a");
		}
		$rc = fwrite($handle,$line_data);
		if ($rc === false) {
			fclose($handle);
			unlink($this->tmp_filename);
			return false;
		}

		fclose($handle);
	}

	/*
	 * 분할된 EP 파일 merge
	 * @return int
	 */
	function naverFileMerge($page_cnt)
	{
		//초기화
		exec("cat /dev/null > ".$this->new_filename);

		for ($i=1; $i<=$page_cnt; $i++) {
			exec("cat ".$this->tmp_filename.$i." >> ".$this->new_filename);
			unlink($this->tmp_filename.$i);
		}

		chmod($this->new_filename,0707);
	}

	/*
	 * 네이버 EP에서 사용되는 컬럼 확인
	 * @return Array
	 */
	function checkColumnNaver()
	{
		global $db;
		$columns = array();
		$naverColumns = array (
			'goodsno', 'goodsnm','goods_price','goods_reserve', 'origin','maker', 'brandno', 'delivery_type', 'goods_delivery', 'img_l', 'img_m', 'use_emoney', 'open_mobile', 'use_goods_discount', 'extra_info', 'naver_event'
			);

		$query = "desc gd_goods";
		$column_name = array();

		$res = $db->query($query);
		while ($column = $db->fetch($res)) {
			if (in_array($column['Field'],$naverColumns)) {
				$columns[] = 'a.'.$column['Field'];
			}
		}
		return $columns;
	}

	/*
	 * 상품 데이터 쿼리
	 * @param Array $columns (checkColumnNaver 리턴값)
	 * @return string
	 */
	function getGoodsSql($columns){
		// 상품 데이타
		$query = "SELECT ".implode(',',$columns)." , b.category FROM ".GD_GOODS." a ,";
		$query .= "(SELECT c.goodsno, ".getCategoryLinkQuery('c.category', null, 'max')." FROM ".GD_GOODS_LINK." c left join gd_category gc on gc.category=left(c.category,3) WHERE c.category!='' and gc.category is not null and c.hidden='0' GROUP BY c.goodsno) b ";
		$query .= "WHERE a.goodsno=b.goodsno ";
		$query .= "AND a.open=1 ";
		$query .= "AND !( a.runout = 1 OR (a.usestock = 'o' AND a.usestock IS NOT NULL AND a.totstock < 1) ) ";
		$query .= "AND ( (a.sales_range_start < UNIX_TIMESTAMP() AND UNIX_TIMESTAMP() < a.sales_range_end) ";
		$query .= "OR (a.sales_range_start < UNIX_TIMESTAMP() AND a.sales_range_end = '') ";
		$query .= "OR (UNIX_TIMESTAMP() < a.sales_range_end AND a.sales_range_start = '') ";
		$query .= "OR (a.sales_range_start = '' AND a.sales_range_end = '') )";

		return $query;
	}

	/*
	 * 쿠폰 가격 계산
	 * @param $couponData(쿠폰데이터),$category(상품카테고리),$goodsno(상품번호),$price(상품가격)
	 * @return Array ($coupon : 쿠폰할인가격, $couponReserve : 적립금)
	 */
	function getCouponPrice($couponData,$category,$goodsno,$price)
	{
		global $cfgCoupon;
		$arCategory = array();
		$couponcd = array();
		$coupon = 0;
		$mobileCoupon = 0;

		// 카테고리 분류별로 분류
		for($i=3; $i<=strlen($category); $i=$i+3) {
			$arCategory[] = substr($category,0,$i);
		}

		for ($i=0; $i<count($couponData); $i++) {
			// 한번 계산된 쿠폰이면 제외
			if (in_array($couponData[$i]['couponcd'],$couponcd)) {
				continue;
			}
			// 금액 제한이 상품 가격보다 높으면 제외
			else if ($couponData[$i]['excPrice'] > $price) {
				continue;
			}

			$couponTemp = 0;
			$reserveTemp = 0;
			if ($couponData[$i]['goodstype'] == '0' ||	// 전체상품 발급 쿠폰일때
				($couponData[$i]['goodstype'] == '1' && $couponData[$i]['goodsno'] != '' && $goodsno == $couponData[$i]['goodsno']) ||	// 특정 상품 발급 쿠폰일때
				($couponData[$i]['goodstype'] == '1' && $couponData[$i]['category'] != '' && in_array($couponData[$i]['category'],$arCategory))) {	// 특정 카테고리 발급 쿠폰일때
				$couponcd[] = $couponData[$i]['couponcd'];	// 계산할 쿠폰번호 배열에 저장

				// 적립금 쿠폰
				if ($couponData[$i]['ability'] == '1') {
					if (strpos($couponData[$i]['price'],'%') == true) {
						$reserveTemp = substr($couponData[$i]['price'] , 0, -1);
						$reserveTemp = $reserveTemp/100*$price;
					}
					else $reserveTemp = $couponData[$i]['price'];
					$reserveTemp = $this->cut($reserveTemp);	// 절사

					// 쿠폰 사용 중복 가능
					if ($cfgCoupon['double'] == '1' && $couponData[$i]['c_screen'] != 'm') {
						$couponReserve += $reserveTemp;
					}
					// 쿠폰 중복 사용 불가
					else if ($reserveTemp > $couponReserve && $couponData[$i]['c_screen'] != 'm') {
						$couponReserve = $reserveTemp;
					}
				}
				// 금액 할인 쿠폰
				else if ($couponData[$i]['ability'] == '0') {
					if (strpos($couponData[$i]['price'],'%') == true) {
						$couponTemp = substr($couponData[$i]['price'] , 0, -1);
						$couponTemp = $couponTemp/100*$price;
					}
					else $couponTemp = $couponData[$i]['price'];
					$couponTemp = $this->cut($couponTemp);	// 절사

					// 쿠폰 사용 중복 가능
					if ($cfgCoupon['double'] == '1' && $couponData[$i]['c_screen'] != 'm') {
						$coupon += $couponTemp;
					}
					// 쿠폰 중복 사용 불가
					else if ($couponTemp > $coupon && $couponData[$i]['c_screen'] != 'm') {
						$coupon = $couponTemp;
					}
				}
			}
		}

		$return = array($coupon,$couponReserve);
		return $return;
	}

	/*
	 * 네이버 EP 자동생성 사용 여부 체크
	 * @return bool
	 */
	function epAutoUseChk()
	{
		if ($this->partner['auto_create_use'] == 'Y') {
			return true;
		}
		else {
			return false;
		}
	}

	/*
	 * 네이버 EP 수집된 파일 여부 체크
	 * @param $file : 파일명
	 * @return bool
	 */
	function epFileChk($file)
	{
		if (file_exists($file)) {
			return true;
		}
		else {
			return false;
		}
	}

	/*
	 * 네이버 EP 파일 출력후 파일명 변경
	 * return void
	 */
	function epPrint()
	{
		// new 파일이 생성된지 24시간(수집 주기) 초과되었다면 다시 생성
		$fileTime = time() - filemtime($this->new_filename);
		if ($fileTime/3600 > 24) {
			$this->epCreatePrint();
		}
		else {
			if ($this->epFileChk($this->new_filename) === true) {
				copy($this->new_filename,$this->old_filename);
				$location = str_replace($_SERVER['DOCUMENT_ROOT'], '', $this->new_filename);
				header("Location:" . $location);
				exit;
			}
		}
	}

	/*
	 * 네이버 EP 파일 생성 후 파일 출력 및 파일 수정
	 * return void
	 */
	function epCreatePrint()
	{
		// EP 파일 생성
		$result = $this->allEp();

		// 파일쓰기 도중 종료시 old파일 출력
		if ($result === false) {
			if ($this->epFileChk($this->old_filename) === true) {
				$location = str_replace($_SERVER['DOCUMENT_ROOT'], '', $this->old_filename);
				header("Location:" . $location);
				exit;
			}
		}
		// 생성된 파일 보여주고 new 파일 old로 복사
		else {
			if ($this->epFileChk($this->new_filename) === true) {
				copy($this->new_filename,$this->old_filename);
				$location = str_replace($_SERVER['DOCUMENT_ROOT'], '', $this->new_filename);
				header("Location:" . $location);
				exit;
			}
		}
	}

	/*
	 * 요약 EP 구성
	 * @return bool
	 */
	function summaryEp()
	{
		global $db, $cfgCoupon, $cfg, $cfgMobileShop;

		$memberdc = $this->getBasicDc();		// 기본 회원 할인율
		$discountData = $this->getDiscount();	// 상품 할인 데이터
		$couponData = $this->getCouponInfo();	// 쿠폰 데이터

		$tmp = date("Y-m-d 00:00:00");
		$db->query("delete from ".GD_GOODS_UPDATE_NAVER." where utime < '$tmp'");
		$query = "select
					no,class,mapid,utime,pname,price,pgurl,igurl,cate1,cate2,cate3,cate4,caid1,caid2,caid3,caid4,
					model,brand,maker,origi,pdate,deliv,event,coupo,pcard,point,modig,score,mvurl,ptype,dterm,risky
					from ".GD_GOODS_UPDATE_NAVER." order by no asc";
		$result = $db->query($query);

		$couponVersion = false; // 쿠폰 버전
		if($cfgCoupon['coupon'] && is_file(dirname(__FILE__).'/../data/skin/'.$cfg['tplSkin'].'/proc/popup_coupon_division.htm')) {
			$couponVersion = true;
		}

		while($row = $db->fetch($result,1))
		{
			$query = "select a.goodsnm, b.price, a.maker, c.brandnm, a.sales_range_start, a.sales_range_end, d.category from ".GD_GOODS." as a left join ".GD_GOODS_OPTION." as b on a.goodsno=b.goodsno and go_is_deleted <> '1' and go_is_display = '1' left join ".GD_GOODS_BRAND." as c on a.brandno=c.sno left join ".GD_GOODS_LINK." as d on a.goodsno=d.goodsno where b.link=1 and a.goodsno='$row[mapid]'";
			$_row = $db->fetch($query);

			// 판매 중지(기간 외 포함)인 경우 제외
			if (($_row['sales_range_start'] > time() && time() > $_row['sales_range_end']) ||
				($_row['sales_range_start'] > time() && $_row['sales_range_end'] == '') ||
				(time() > $_row['sales_range_end'] && $_row['sales_range_start'] == '') ||
				($_row['sales_range_start'] == '' && $_row['sales_range_end'] == '')) {
				continue;
			}

			// 회원할인적용
			$dcprice = 0;
			if ($this->partner['unmemberdc'] === 'N') {
				if (is_array($memberdc) === true) {
					$mdc_exc = chk_memberdc_exc($memberdc, $row['mapid']); // 회원할인 제외상품 체크
					if ($mdc_exc === false) {
						$dcprice = getDcprice($_row['price'], $memberdc['dc'].'%');
					}
				}
			}

			// 할인가격
			$discountPrice = $this->getDiscountPrice($discountData,$row['mapid'],$_row['price']);

			// 즉석할인쿠폰
			$coupon = 0;
			if ($cfgCoupon['use_yn'] && $this->partner['uncoupon'] === 'N') {
				list($couponDiscount, $couponEmoney) = $this->getCouponPrice($couponData, $row['category'], $row['mapid'], $_row['price']);
				if ($couponDiscount) {
					$coupon = getDcprice($_row['price'], $couponDiscount);
				}
			}

			// 쿠폰 회원할인 중복 할인 체크
			if ($coupon > 0 && $dcprice > 0) {
				if ($cfgCoupon['range'] == 2) {
					$dcprice = 0;
				}
				if ($cfgCoupon['range'] == 1) {
					$coupon = 0;
				}
			}

			// 노출 가격
			$coupon += 0;
			$dcprice += 0;
			if ($coupon > $_row['price'] - $dcprice - $discountPrice && $couponVersion === true) $coupon = $_row['price'] - $dcprice - $discountPrice;
			$_row['price'] = $_row['price'] - $coupon - $dcprice - $discountPrice;

			if ($_row) extract($_row);

			if($this->partner['goodshead']){
				$goodsnm=str_replace(array('{_maker}','{_brand}'),array($maker,$brandnm),$this->partner['goodshead']).strip_tags($goodsnm);
			}else{
				$goodsnm=strip_tags($goodsnm);
			}

			// 이벤트
			if ($row['event'] != null) {
				$event = '';
				if ($this->partner['naver_event_common'] === 'Y' && empty($this->partner['eventCommonText']) === false) {	// 공통 문구
					$event = $this->partner['eventCommonText'];
				}

				if ($this->partner['naver_event_goods'] === 'Y' && empty($row['event']) === false) {	// 상품별 문구
					if (empty($event) === false) $event .= ' , ';
					$event .= $row['event'];
				}

				$row['event'] = strip_tags($event);
			}

			$mapid = $row['mapid'];
			$class = $row['class'];
			$utime = $row['utime'];

			unset($row['no']);
			unset($row['mapid']);
			unset($row['class']);
			unset($row['utime']);
			unset($row['pname']);
			unset($row['price']);

			echo "<<<begin>>>\n";
			echo '<<<mapid>>>'.$mapid."\n";
			if($class != 'D'){
				echo "<<<pname>>>".$goodsnm."\n";
				echo '<<<price>>>'.$price."\n";
				if (isset($cfgMobileShop) && $cfgMobileShop['useMobileShop'] == '1') {
					$row['mourl'] = 'http://'.$_SERVER['HTTP_HOST'].'/m/goods/view.php?goodsno='.$mapid.'&inflow=naver';
				}
				else {
					$row['mourl'] = '';
				}
			}
			foreach($row as $key=>$value)
			{
				if($key == 'pdate') continue;
				if(!is_null($value)) echo '<<<'.$key.'>>>'.$value."\n";
			}
			echo '<<<class>>>'.$class."\n";
			echo '<<<utime>>>'.$utime."\n";
			echo "<<<ftend>>>\n";
		}
	}
}
?>