<?php
	include dirname(__FILE__) . "/../_header.php";

	### 변수할당
	$goodsno = $_GET['goodsno'];

	// 상품분류 연결방식 전환 여부에 따른 처리
	$whereArr	= getCategoryLinkQuery('b.category', $db->_escape($_GET['category']));
	if ($_GET[category]) $qrTmp = "and ".$whereArr['where'];

	### 상품 데이타
	if ($ici_admin === false) $where = "c.hidden_mobile=0 and";
	$query = "
	select a.*,".$whereArr['max']." from
		".GD_GOODS." a
		left join ".GD_GOODS_LINK." b on a.goodsno=b.goodsno $qrTmp
		left join ".GD_CATEGORY." c on b.category=c.category
	where $where
		a.goodsno='$goodsno'
	limit 1
	";
	$data = $db->fetch($query,1);

	### 상품 진열 여부 체크
	if (!$data[open_mobile]) msg("해당상품은 진열이 허용된 상품이 아닙니다",-1);

	### 이미지 배열
	$data[r_img] = explode("|",$data[img_m]);
	$data[l_img] = explode("|",$data[img_l]);
	$data[t_img] = array_map("toThumb",$data[r_img]);

	### 템플릿 출력
	$tpl->assign($data);
	$tpl->print_('tpl');
?>