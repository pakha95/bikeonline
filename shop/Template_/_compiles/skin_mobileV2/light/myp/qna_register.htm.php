<?php /* Template_ 2.2.7 2017/10/31 19:09:38 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/myp/qna_register.htm 000008748 */ 
if (is_array($TPL_VAR["order_list"])) $TPL_order_list_1=count($TPL_VAR["order_list"]); else if (is_object($TPL_VAR["order_list"]) && in_array("Countable", class_implements($TPL_VAR["order_list"]))) $TPL_order_list_1=$TPL_VAR["order_list"]->count();else $TPL_order_list_1=0;?>
<?php $this->print_("header",$TPL_SCP,1);?>

<?php  $TPL_VAR["page_title"] = "1:1 문의하기";?>
<?php $this->print_("sub_header",$TPL_SCP,1);?>

<style type="text/css">
section#nreviewregister {background:#FFFFFF; padding:12px;}
section#nreviewregister table{border:none; border-top:solid 1px #dbdbdb;width:100%;}
section#nreviewregister table td{padding:8px 0px 8px 10px; vertical-align:middle; border-bottom:solid 1px #dbdbdb;}
section#nreviewregister table th{padding:8px 0px 8px 0px; text-align:center; background:#f5f5f5; width:70px; vertical-align:middle; border-bottom:solid 1px #dbdbdb; color:#353535; font-size:12px;}
section#nreviewregister table .img{padding:5px; width:60px;}
section#nreviewregister table .img img{border:solid 1px #d9d9d9;}
section#nreviewregister table td input[type=text], input[type=password], select{width:95%;height:21px;}
section#nreviewregister table td textarea{width:95%;height:116px;}
section#nreviewregister .btn_center {margin:auto; width:198px; height:34px; margin-top:20px; margin-bottom:20px;}
section#nreviewregister .btn_center .btn_save{border:none; background:#f35151; border-radius:3px; color:#FFFFFF; font-size:13px; width:94px; height:34px; float:left; font-family:dotum; font-weight:bold;}
section#nreviewregister .btn_center .btn_prev{border:none; background:#808591; border-radius:3px; color:#FFFFFF; font-size:13px; width:94px; height:34px; float:right; font-family:dotum; font-weight:bold;}
.goods-nm{color:#353535; font-weight:bold; fonst-size:14px; margin-bottom:5px; overflow:hidden;text-overflow:ellipsis;white-space:nowrap; }
.goods-price{color:#f03c3c; font-size:12px;}
.btn_order_search {float:right;width:73px; height:25px; line-height:27px; font-size:12px; color:#FFFFFF; font-weight:normal;text-align:center; background:#808591; font-family:dotum; border-radius:3px;}
.orderlist-area {bottom:0px; position:fixed; width:100%; background:#FFFFFF; z-index:99;display:none;}
.orderlist-title {background:#313030; border-bottom:solid 1px #b2b2b2; height:48px;}
.orderlist-title .title{height:48px; line-height:48px; margin-left:15px; font-size:16px; color:#FFFFFF; font-family:dotum;font-weight:bold;float:left;}
.orderlist-title .title .title_cnt{font-size:14px;}
.orderlist-title .close-btn{background:url("/shop/data/skin_mobileV2/light/common/img/new/btn_close.png") no-repeat; background-size:31px 31px; width:31px; height:31px; margin-top:8px;float:right;margin-right:10px;}
.orderlist-item{height:43px; border-bottom:solid 1px #dbdbdb;}
.orderlist-item .orderlist-item-name{height:43px; font-size:12px; color:#353535; margin-left:15px;  float:left; max-width:60%; overflow:hidden;}
.orderlist-item .orderlist-item-name .mobile_coupon{color:#f03c3c;}
.orderlist-item .download-btn{background:url("/shop/data/skin_mobileV2/light/common/img/info/icon_radio01.png") no-repeat; width:22px; height:22px; margin-top:8px;  float:right; margin-right:12px;text-align:center;}
.orderlist-item .active-btn{background:url("/shop/data/skin_mobileV2/light/common/img/info/icon_radio02.png") no-repeat;}
.orderlist-title .close-btn{background:url("/shop/data/skin_mobileV2/light/common/img/new/btn_close.png") no-repeat; background-size:31px 31px; width:31px; height:31px; margin-top:8px;float:right;margin-right:10px;}

.orderlist-area .orderlist-item-area {position:relative; max-height:220px; width:100%; overflow:hidden;}


#background {
	position : fixed;
	left : 0;
	top : 0;
	bottom:0px;
	width : 100%;
	height : 100%;
	background : rgba(0, 0, 0, 0.2);
	display:none;
	z-index:98;
}


</style>
<script type="text/javascript">
var orderlist_scroll;
function showOrderList() {
	$("#background").show();

	$(".orderlist-area").css("bottom", "-"+$(".orderlist-area").height()+"px");
	$(".orderlist-area").show();

	$(".orderlist-area").animate({bottom:0}, 300, function(){
		orderlist_scroll.refresh();
	});
}

function closeOrderList() {

	$(".orderlist-area").animate({bottom:$(".orderlist-area").height()-($(".orderlist-area").height()*2)}, 300, function(){
		$(".orderlist-area").hide();
		$("#background").hide();
	});

}

function setQnaOrdno(ordno) {
	$(".download-btn").removeClass('active-btn');
	$("#download-btn-"+ordno).addClass('active-btn');
	$("[name=ordno]").val(ordno);
	closeOrderList();
}
$(document).ready(function(){
	orderlist_scroll = new iScroll('scroll-area');

});
</script>


<form method=post action="<?php echo $TPL_VAR["myqnaActionUrl"]?>" enctype="multipart/form-data" onSubmit="return chkForm(this)">
<input type=hidden name=mode value="add_member_qna">
<input type=hidden name=referer value="<?php echo $GLOBALS["referer"]?>">

<section id="nreviewregister"  class="content">
	<table>
	<tr>
		<th>아이디</th>
		<td>
			<?php echo $GLOBALS["data"]["m_id"]?>

		</td>
	</tr>
	<tr>
		<th>질문유형</th>
		<td><select name="itemcd" required label="질문유형" class=select>
		<option value="">상담내용을 선택하세요</option>
<?php if((is_array($TPL_R1=codeitem('question'))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_K1=>$TPL_V1){?>
		<option value="<?php echo $TPL_K1?>" <?php if($GLOBALS["data"]["itemcd"]==$TPL_K1){?>selected<?php }?>><?php echo $TPL_V1?></option>
<?php }}?>
		</select></td>
	</tr>
	<tr>
		<th>주문번호</th>
		<td>
			<input type="number" name="ordno"  label="주문번호" value="<?php echo $GLOBALS["data"]["email"]?>" style="width:110px"/><div class="btn_order_search" onClick="javascript:showOrderList();">주문조회</div>
		</td>
	</tr>
	<tr>
		<th>이메일</th>
		<td>
			<input type="email" name="email"  label="이메일" value="<?php echo $GLOBALS["data"]["email"]?>" />
		</td>
	</tr>
	<tr>
		<th>휴대폰</th>
		<td>
			<input type="number" name="phone"  label="휴대폰번호" value="<?php echo $GLOBALS["data"]["phone"]?>" />
		</td>
	</tr>
	<tr>
		<th>제목</th>
		<td>
			<input type="text" name="subject" required label="제목" value="<?php echo $GLOBALS["data"]["subject"]?>" />
		</td>
	</tr>
	<tr>
		<th>내용</th>
		<td>
			<textarea name="contents" required label="내용"  ><?php echo $GLOBALS["data"]["contents"]?></textarea>
		</td>
	</tr>
	</table>

	<div style="width:100%; margin:10px auto 0; text-align:left; border:1px solid #DEDEDE; ">
		<div style="height:100px; padding:5px; overflow-y:scroll;">
			<div style="margin-bottom:10px; color:#3e90ff;"><strong>개인정보수집 및 이용에 대한 안내</strong></div>
			<?php echo $TPL_VAR["termsPolicyCollection4"]?>

		</div>
		<div style="padding:5px; text-align:center;">
			<input type="radio" name="agreeyn" value="y"> 동의합니다. &nbsp;
			<input type="radio" name="agreeyn" value="n"> 동의하지 않습니다.
		</div>
	</div>

	<div class="m_review">
		<div class="btn_center">
			<button type="submit" id="save-btn" class="btn_save">확 인</button>
			<button type="button" id="prev-btn" class="btn_prev"  onclick="history.back();">취 소</button>
		</div>
	</div>


</section>


<div class="orderlist-area" class="content">
	<div class="orderlist-title">
		<div class="title">주문 List <?php if($TPL_VAR["order_cnt"]> 0){?><span class="title_cnt">(<?php echo $TPL_VAR["order_cnt"]?>)</span><?php }?></div>
		<div class="close-btn" onClick="javascript:closeOrderList();"></div>
	</div>
	<div class="orderlist-item-area">
		<div id="scroll-area">
		<ul>
<?php if($TPL_order_list_1){foreach($TPL_VAR["order_list"] as $TPL_V1){?>
		<li>
		<div class="orderlist-item" onClick="javascript:setQnaOrdno(<?php echo $TPL_V1["ordno"]?>);">
			<div class="orderlist-item-name"><span class="goods-price"><?php echo $TPL_V1["ordno"]?></span> (<?php echo $TPL_V1["orddt"]?>)<br /><span class="goods-nm"><?php echo $TPL_V1["goods_prefix"]?><?php echo $TPL_V1["goodsnm"]?></span></div>
			<div class="download-btn" id="download-btn-<?php echo $TPL_V1["ordno"]?>" onClick="javascript:setQnaOrdno(<?php echo $TPL_V1["ordno"]?>);"></div>
		</div>
		</li>
<?php }}else{?>
		<li>
		<div class="orderlist-item">
			<div class="orderlist-item-name">주문내역이 없습니다</div>
		</div>
		</li>
<?php }?>
		</ul>
		</div>
	</div>
</div>
<div id="background"></div>
</form>

<?php $this->print_("footer",$TPL_SCP,1);?>