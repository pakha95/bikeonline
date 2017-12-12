<?
$design_skin = array();

$design_skin['default'] = array(
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
);

$design_skin['outline/_header.htm'] = array(
'linkurl'			=> 'outline/_header.php',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '상단레이아웃',
'_et'			=> 'codemirror',
);

$design_skin['outline/_footer.htm'] = array(
'linkurl'			=> 'main/index.php',
'text'			=> '하단레이아웃',
);

$design_skin['outline/_sub_header.htm'] = array(
'linkurl'			=> 'main/index.php',
'text'			=> '서브 상단 디자인',
);

$design_skin['index.htm'] = array(
'linkurl'			=> 'index.php',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '모바일 메인페이지',
'_et'			=> 'codemirror',
);

$design_skin['goods/list.htm'] = array(
'linkurl'			=> 'goods/list.php',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '분류/검색 상품리스트',
'_et'			=> 'codemirror',
);

$design_skin['goods/goods_view.htm'] = array(
'linkurl'			=> 'goods/goods_view.php',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '상품상세화면',
);

$design_skin['goods/view_detail.htm'] = array(
'linkurl'			=> 'goods/view_detail.php',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '상품상세설명',
'_et'			=> 'codemirror',
);

$design_skin['goods/event.htm'] = array(
'linkurl'			=> 'goods/event.php',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '모바일이벤트',
'_et'			=> 'codemirror',
);

$design_skin['goods/cart.htm'] = array(
'linkurl'			=> 'goods/cart.php',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '장바구니',
'_et'			=> 'codemirror',
);

$design_skin['ord/order.htm'] = array(
'linkurl'			=> 'ord/order.php',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '주문하기(주문서작성)',
'_et'			=> 'codemirror',
);

$design_skin['ord/order_end.htm'] = array(
'linkurl'			=> 'ord/order_end.php',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '주문완료',
'_et'			=> 'codemirror',
);

$design_skin['ord/order_fail.htm'] = array(
'linkurl'			=> 'ord/order_fail.php',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '주문실패',
'_et'			=> 'codemirror',
);

$design_skin['ord/settle.htm'] = array(
'text'			=> '결제하기(무통장)',
'linkurl'			=> 'ord/settle.php',
);

$design_skin['mem/login.htm'] = array(
'text'			=> '로그인',
'linkurl'			=> 'mem/login.php',
);

$design_skin['mem/addinfo.htm'] = array(
'text'			=> '가입후추가정보',
'linkurl'			=> 'mem/join.php',
);

$design_skin['mem/join.htm'] = array(
'linkurl'			=> 'mem/join.php',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '가입하기',
'_et'			=> 'codemirror',
);

$design_skin['mem/endjoin.htm'] = array(
'text'			=> '가입완료',
'linkurl'			=> 'mem/join.php',
);

$design_skin['mem/agreement.htm'] = array(
'text'			=> '약관동의',
'linkurl'			=> 'mem/join.php',
);

$design_skin['mem/nomember_order.htm'] = array(
'text'			=> '비회원주문확인',
'linkurl'			=> 'mem/nomember_order.php',
);

$design_skin['myp/couponlist.htm'] = array(
'text'			=> '할인쿠폰내역',
'linkurl'			=> 'myp/couponlist.php',
);

$design_skin['myp/emoneylist.htm'] = array(
'linkurl'			=> 'myp/emoneylist.php',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '적립금내역',
);

$design_skin['myp/menu_list.htm'] = array(
'text'			=> '마이페이지',
'linkurl'			=> 'myp/menu_list.php',
);

$design_skin['myp/orderlist.htm'] = array(
'text'			=> '주문내역/배송조회',
'linkurl'			=> 'myp/orderlist.php',
);

$design_skin['myp/orderview.htm'] = array(
'linkurl'			=> 'myp/orderview.php',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '주문내역상세보기',
'_et'			=> 'codemirror',
);

$design_skin['myp/qna.htm'] = array(
'text'			=> '1대1문의',
'linkurl'			=> 'myp/qna.php',
);

$design_skin['myp/review.htm'] = array(
'text'			=> '나의상품후기',
'linkurl'			=> 'myp/review.php',
);

$design_skin['myp/wishlist.htm'] = array(
'text'			=> '상품보관함',
'linkurl'			=> 'myp/wishlist.php',
);

$design_skin['proc/coupon_list.htm'] = array(
'text'			=> '할인쿠폰적용하기',
'linkurl'			=> 'proc/coupon_list.php',
);

$design_skin['proc/orderitem.htm'] = array(
'linkurl'			=> 'proc/orderitem.php',
'text'			=> '주문상품',
);

$design_skin['goods/list/tpl_02.htm'] = array(
'linkurl'			=> 'goods/goods_list.php',
'text'			=> '리스트형',
'_et'			=> 'codemirror',
);

$design_skin['goods/goods_qna_list_v2.htm'] = array(
'linkurl'			=> 'goods/goods_qna_list.php',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '상품문의 리스트',
'_et'			=> 'codemirror',
);

$design_skin['goods/review.htm'] = array(
'linkurl'			=> 'goods/review.php',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '상품후기',
'_et'			=> 'codemirror',
);

$design_skin['goods/goods_qna_delete.htm'] = array(
'linkurl'			=> 'm2/html.php?htmid=goods/goods_qna_delete.htm',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '상품문의 삭제',
'_et'			=> 'codemirror',
);

$design_skin['goods/review_delete.htm'] = array(
'linkurl'			=> 'm2/html.php?htmid=goods/review_delete.htm',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '상품후기 삭제',
'_et'			=> 'codemirror',
);

$design_skin['goods/view.htm'] = array(
'linkurl'			=> 'goods/view.php',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '상품페이지',
'_et'			=> 'codemirror',
);

$design_skin['goods/view_detail2.htm'] = array(
'linkurl'			=> 'goods/view_detail.php',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '상품페이지_상세2',
'_et'			=> 'codemirror',
);

$design_skin['goods/view2.htm'] = array(
'linkurl'			=> 'goods/view.php',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '상품페이지2',
'_et'			=> 'codemirror',
);

$design_skin['myp/viewgoods.htm'] = array(
'linkurl'			=> 'myp/viewgoods.php',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '최근본상품 리스트',
'_et'			=> 'codemirror',
);

$design_skin['goods/list/tpl_01.htm'] = array(
'linkurl'			=> 'm2/goods/list.php',
'text'			=> '리스트형',
'_et'			=> 'codemirror',
);

?>