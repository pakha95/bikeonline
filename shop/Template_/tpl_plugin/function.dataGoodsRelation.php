<?php

/* Return Goods Relation Data Function */

function dataGoodsRelation( $goodsno, $limit=0 ){

	global $db, $cfg_related;

	$goods = array();
	$category = $_GET['category'];

	if (empty($category) === true || strlen($category) < 3) {
		list ($category, $relationis, $relation) = $db->fetch("select category, relationis, relation from
			".GD_GOODS." a
			left join ".GD_GOODS_LINK." b on a.goodsno=b.goodsno
		where
			a.goodsno='$goodsno'
			and open
		order by b.category desc
		limit 1
		"); # �� ���ڵ��
	}
	else {
		list ($relationis, $relation) = $db->fetch("select relationis, relation from
			".GD_GOODS." a
			left join ".GD_GOODS_LINK." b on a.goodsno=b.goodsno
		where
			a.goodsno='$goodsno'
			and open
			and b.category='$category'"
		); # �� ���ڵ��
	}

	### ���û�ǰ ����Ʈ
	if (!$relationis){
		// ��ǰ�з� ������ ��ȯ ���ο� ���� ó��
		$categoryWhere	= getCategoryLinkQuery('category', $category, 'where');

		// ǰ�� ��ǰ ���ܽ�
		if ($cfg_related['exclude_soldout']) {
			$soldout = "and !(g.runout = 1 or (g.usestock = 'o' and g.usestock is not null and g.totstock < 1)) ";
		}

		//������ ��ǰ�� ���� ī�װ� �� �Ǹŷ��� ���� ��ǰ
		$query = "
		select gl.goodsno,g.goodsnm,g.img_i,g.img_s,g.img_m,g.img_l,g.use_mobile_img,g.img_x,g.img_pc_x,go.price,g.strprice,g.shortdesc,g.icon,oi.totea sort,g.regdt from
			(select goodsno, sum(ea) totea from ".GD_ORDER." o
			left join ".GD_ORDER_ITEM." oi on oi.ordno=o.ordno WHERE o.step2 < 40 and o.step > 0 and o.orddt > date_add(now(), interval -1 month) group by goodsno) oi,
			".GD_GOODS_LINK." gl,
			".GD_GOODS." g
			left join ".GD_GOODS_OPTION." go on g.goodsno=go.goodsno and link and go_is_deleted <> '1' and go_is_display = '1'
		where
			g.goodsno = oi.goodsno
			and gl.goodsno=g.goodsno
			and open
			and gl.goodsno!='$goodsno'
			and ".$categoryWhere."
			".$soldout."
		group by oi.goodsno
		order by sort desc
		limit 100
		";

		//DB Cache ��� 141030
		$dbCache = Core::loader('dbcache')->setLocation('relation');

		if (!$arr_sales = $dbCache->getCache($query)) {
			$res = $db->query($query);
			while ( $data = $db->fetch( $res, 1 ) ) {
				$data[icon] = setIcon($data[icon],$data[regdt]);

				// PC�� ����� �̹����� ��� �������̵� ó��
				if (Clib_Application::isMobile()) {
					if ($data['use_mobile_img'] === '0') {
						$imgArr = explode('|', $data[$data['img_pc_x']]);
						$data['img_x'] = $imgArr[0];
					}
				}
				$arr_sales[] = $data;
			}
			if ($dbCache) { $dbCache->setCache($query, $arr_sales); }
			$rows = count($arr_sales);
		}
		else {
			$rows = count($arr_sales);
		}

		if ($rows < 100) {

			//������ ��ǰ�� ���� ī�װ� �� �Ż�ǰ
			$query = "
			select gl.goodsno,g.goodsnm,g.img_i,g.img_s,g.img_m,g.img_l,g.use_mobile_img,g.img_x,g.img_pc_x,go.price,g.strprice,g.shortdesc,g.icon,(0) sort,g.regdt
			from
				(select goodsno, category from ".GD_GOODS_LINK." where ".$categoryWhere." and goodsno!='$goodsno' group by goodsno having category='$category' or ".$categoryWhere.") gl,
				".GD_GOODS." g
				left join ".GD_GOODS_OPTION." go on g.goodsno=go.goodsno and link and go_is_deleted <> '1' and go_is_display = '1'
				left join ".GD_ORDER_ITEM." oi on g.goodsno=oi.goodsno
			where
				oi.goodsno is null
				and gl.goodsno=g.goodsno
				and open
				".$soldout."
			order by goodsno desc
			limit ".(100-$rows);

			if (!$arr_relation = $dbCache->getCache($query)) {
				$res = $db->query($query);
				while ( $data = $db->fetch( $res, 1 ) ) {
					$data[icon] = setIcon($data[icon],$data[regdt]);

					// PC�� ����� �̹����� ��� �������̵� ó��
					if (Clib_Application::isMobile()) {
						if ($data['use_mobile_img'] === '0') {
							$imgArr = explode('|', $data[$data['img_pc_x']]);
							$data['img_x'] = $imgArr[0];
						}
					}
					$arr_relation[] = $data;
				}
				if ($dbCache) { $dbCache->setCache($query, $arr_relation); }
			}
		}

		//�Ǹŷ��� �Ż�ǰ ��� ����
		if (!is_array($arr_sales) && !is_array($arr_relation)) return false;
		else if (is_array($arr_sales) && is_array($arr_relation)) $arr_relation = array_merge($arr_sales,$arr_relation);
		else if (is_array($arr_sales) && !is_array($arr_relation)) $arr_relation = $arr_sales;

		//���յ� ����� ������ ���Ⱚ ������ŭ �������� �迭����
		$rows = count($arr_relation);
		if ($rows < $limit) $limit = $rows;
		$random = array_rand($arr_relation,$limit);
		shuffle($random);
		if (!is_array($random) && strlen($random) > 0) $arr_temp[] = $arr_relation[0];
		else {
			for($i=0;$i<count($random);$i++) {
				$arr_temp[] = $arr_relation[$random[$i]];
			}
		}

		$arr_relation = $arr_temp;

	} else {
		if (!$relation) return false;

		// ������ �̼��� ȣȯ �ڵ�
		if ($relation == 'new_type') {

			$query = "
			SELECT

				G.goodsno,G.goodsnm,G.img_i,G.img_s,G.img_m,G.img_l,G.use_mobile_img,G.img_x,G.img_pc_x,O.price,G.strprice,G.shortdesc,G.icon,G.regdt

			FROM ".GD_GOODS_RELATED." AS R

			INNER JOIN ".GD_GOODS." AS G
			ON R.r_goodsno = G.goodsno
			INNER JOIN ".GD_GOODS_OPTION." AS O
			ON G.goodsno = O.goodsno AND O.link = 1 and go_is_deleted <> '1' and go_is_display = '1'

			WHERE
				R.goodsno = $goodsno
			AND G.open
			AND (
					(R.r_start IS NULL OR R.r_start <= CURDATE())
				AND
					(R.r_end IS NULL OR R.r_end >= CURDATE())
				)
			";

			// ǰ�� ��ǰ ���ܽ�
			if ($cfg_related['exclude_soldout']) {
				$query .= "
				AND !(
						G.runout = 1
					OR
						(G.usestock = 'o' AND G.usestock IS NOT NULL AND G.totstock < 1)
					)
				";
			}

			$query .= "
				ORDER BY R.sort ASC
			";

			// �� �����Ϳ� ȣȯ ó���� ���� �ڵ� ���ó�� �����ϵ��� ��.
			$relationis = 0;

		}
		else {
			$query = "
			select a.goodsno,a.goodsnm,a.img_i,a.img_s,a.img_m,a.img_l,a.use_mobile_img,a.img_x,a.img_pc_x,b.price,a.strprice,a.shortdesc,a.icon,a.regdt from
				".GD_GOODS." a,
				".GD_GOODS_OPTION." b
			where
				a.goodsno=b.goodsno and link and go_is_deleted <> '1' and go_is_display = '1'
				and a.goodsno in ($relation)
				and open
			";

			// ǰ�� ��ǰ ���ܽ�
			if ($cfg_related['exclude_soldout']) {
				$query .= "
				AND !(
						a.runout = 1
					OR
						(a.usestock = 'o' AND a.usestock IS NOT NULL AND a.totstock < 1)
					)
				";
			}
		}

		if ( $limit > 0 ) $query .= " limit " . $limit;

		//DB Cache ��� 141030
		$dbCache = Core::loader('dbcache')->setLocation('relation');

		if (!$arr_relation = $dbCache->getCache($query)) {
			$res = $db->query($query);
			while ( $data = $db->fetch( $res, 1 ) ) {
				$data[icon] = setIcon($data[icon],$data[regdt]);

				// PC�� ����� �̹����� ��� �������̵� ó��
				if (Clib_Application::isMobile()) {
					if ($data['use_mobile_img'] === '0') {
						$imgArr = explode('|', $data[$data['img_pc_x']]);
						$data['img_x'] = $imgArr[0];
					}
				}
				$arr_relation[] = $data;
			}
			if ($dbCache) { $dbCache->setCache($query, $arr_relation); }
		}
	}

	if($relationis){
		$arr  = explode(',',$relation);
		foreach($arr as $k2 => $v2)if($arr_relation)foreach($arr_relation as $k => $v)if($v2 == $v[goodsno])$goods[] = $v;
	}else $goods = $arr_relation;

	return $goods;
}
?>
