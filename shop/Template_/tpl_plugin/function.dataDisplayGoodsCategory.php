<?php

/* Return Display Goods Data Function */

function dataDisplayGoodsCategory( $mode, $img='img_s',$limit=0 ){

	global $db, $cfg ,$lstcfg;
	include dirname(__FILE__) . "/../../conf/config.pay.php";

	if (is_file(dirname(__FILE__) . "/../../conf/config.soldout.php"))
		include dirname(__FILE__) . "/../../conf/config.soldout.php";

	$goods = array();

	if ($GLOBALS['tpl']->var_['']['connInterpark']) $where .= "and b.inpk_prdno!=''";
	if (isset($GLOBALS['tpl']->var_['']['id'])) $GLOBALS['tpl']->var_['']['id'] = '';

	$orderby = 'order by a.sort';

	/* ���� ������ ��ǰ ������ ��� ��Ų�� ó�� */
	if ( strlen($mode) == 1 ){
		if( $cfg['shopMainGoodsConf'] == "E" ){
			$where .= " and tplSkin = '".$cfg['tplSkin']."'";
		}else{
			$where .= " and (tplSkin = '' OR tplSkin IS NULL)";
		}

		// ǰ�� ��ǰ ����
		if ($cfg_soldout['exclude_main']) {
			$where .= " AND !( b.runout = 1 OR (b.usestock = 'o' AND b.totstock < 1) ) ";
		}
		// ���ܽ�Ű�� �ʴ� �ٸ�, �� �ڷ� �������� ����
		else if ($cfg_soldout['back_main']) {
			$orderby = "order by `soldout` ASC, a.sort";
			$_add_field = ",IF (b.runout = 1 , 1, IF (b.usestock = 'o' AND b.totstock = 0, 1, 0)) as `soldout`";
		}
	}
    //$query_cate="select count(*) from ".GD_GOODS_LINK." a left join ".GD_GOODS." b on a.goodsno = b.goodsno where (a.category in ('050','002')) and b.totstock   ";
	
	$query = "
	select
		*,b.$img img_s
		$_add_field
	from
		".GD_GOODS_DISPLAY." a
		left join ".GD_GOODS." b on a.goodsno=b.goodsno
		left join ".GD_GOODS_OPTION." c on a.goodsno=c.goodsno and link and go_is_deleted <> '1' and go_is_display = '1'
		left join ".GD_GOODS_BRAND." d on b.brandno=d.sno
		//left join ".GD_GOODS_LINK." e on b.goodsno = e.goodsno
	where
		//e.category = '050' and b.totstock > 0
		b.goodsnm NOT LIKE '%�ؿ��ֹ�%'
		and a.mode = '$mode'
		and b.open
		{$where}
	{$orderby}
	";
	

	if ( $limit > 0 ) $query .= " limit " . $limit;

	//DB Cache ��� 141030
	$dbCache = Core::loader('dbcache')->setLocation('display');

	if (!$goods = $dbCache->getCache($query)) {
		$res = $db->query($query);
		while ( $data = $db->fetch( $res, 1 ) ){

			### ����� ���� �ڵ� ǰ�� ó��
			$data['stock'] = $data['totstock'];
			//if ($data[usestock] && $data[stock]<=0) $data[runout] = 1;

			### ����
			list($data['coupon'],$data['coupon_emoney']) = getCouponInfo($data['goodsno'],$data['price']);

			### ������ ����
			if(!$data['use_emoney']){
				if( !$set['emoney']['chk_goods_emoney'] ){
					if( $set['emoney']['goods_emoney'] ) $tmp['reserve'] = getDcprice($data['price'],$set['emoney']['goods_emoney'].'%');
				}else{
					$tmp['reserve'] = $set['emoney']['goods_emoney'];
				}
				$data['reserve'] = $tmp['reserve'];
			}

			$data['reserve'] += $data['coupon_emoney'];

			### ������
			$data[icon] = setIcon($data[icon],$data[regdt]);

			$data['shortdesc'] = ($lstcfg[rtpl] == "tpl_10") ? htmlspecialchars($data['shortdesc']) : $data['shortdesc'];	// ©������ ���� ����

			// ��� ����
			$goods[] = setGoodsOuputVar($data);
		}
		if ($dbCache) { $dbCache->setCache($query, $goods); }
	}

	return $goods;
}
?>