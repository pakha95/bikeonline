<?php /* Template_ 2.2.7 2016/06/19 18:24:33 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/myp/review.htm 000009448 */ 
if (is_array($TPL_VAR["review_loop"])) $TPL_review_loop_1=count($TPL_VAR["review_loop"]); else if (is_object($TPL_VAR["review_loop"]) && in_array("Countable", class_implements($TPL_VAR["review_loop"]))) $TPL_review_loop_1=$TPL_VAR["review_loop"]->count();else $TPL_review_loop_1=0;?>
<?php $this->print_("header",$TPL_SCP,1);?>


<?php
	if( $TPL_VAR["goodsno"]) {
		 $TPL_VAR["page_title"] = "상품후기";
	}
	else {
		 $TPL_VAR["page_title"] = "나의 상품후기";
	}
?>
<?php $this->print_("sub_header",$TPL_SCP,1);?>


<style type="text/css">
section#content-wrap { padding:12px; background:#FFFFFF; }
section#nreviewlist {background-color:#FFFFFF;min-height:100%; }
section#nreviewlist table {width:100%; }
/*section#reviewlist table th {height:50px; border-bottom:solid 1px #bbbbbb; background-color:#cccccc; line-height:50px; font-size:16px; text-align:center; border-right:solid 1px #bbbbbb; color:#444444;}*/
section#nreviewlist th { font-size:12px; font-weight:bold; color:#353535; height:33px; line-height:33px; background:url(/shop/data/skin_mobileV2/light/common/img/nmyp/bdtit_bg.png) repeat-x; border-right:solid 1px #DBDBDB; font-family:Dotum; }
section#nreviewlist th.first{ border-left:solid 1px #DBDBDB; }
section#nreviewlist .title td { height:64px; border-right:solid 1px #DBDBDB; border-bottom:solid 1px #DBDBDB; font-size:12px; text-align:center; color:#353535; background-color:#FFFFFF; font-family:Dotum;  vertical-align:middle;}
section#nreviewlist .active td {border-bottom:dashed 1px #DBDBDB; background:#EDF4F8;}

section#nreviewlist .content-board {display:none;}
section#nreviewlist .content-board td { border-left:solid 1px #DBDBDB; border-right:solid 1px #DBDBDB; border-bottom:solid 1px #DBDBDB; font-size:12px; text-align:left; color:#353535; background-color:#FFFFFF; font-family:Dotum;  vertical-align:middle;}
section#nreviewlist .content-board td .content-review{ padding: 12px;}
section#nreviewlist .content-board td .del-btn {float:right; margin-bottom:8px; width:70px; height:27px; line-height:27px; font-size:12px; color:#FFFFFF; font-weight:normal; text-align:center; background:#808591; font-family:dotum; border-radius:3px;}
section#nreviewlist .content-board td .content-reply{ padding: 12px; border-top:dashed 1px #DBDBDB;}
section#nreviewlist .content-board td .content-reply .reply-icon{float:left; background:url("/shop/data/skin_mobileV2/light/common/img/new/btn_re.png") no-repeat; background-size:20px 14px; width:20px; height:14px; margin-right:5px;}

section#nreviewlist td.first{ border-left:solid 1px #DBDBDB; }
section#nreviewlist td.left { padding-left:10px; text-align:left; }
section#nreviewlist td.img { }
section#nreviewlist td.img img{width:48px; height:48px; margin:5px 5px 0px 5px; }
section#nreviewlist .name { font-size:14px; color:#353535; height:25px; line-height:25px; vertical-align:bottom; overflow:hidden; text-align:left; margin-top:12px; }
section#nreviewlist .remain { font-size:12px; height:20px; line-height:20px; vertical-align:top; color:#F03C3C; text-align:left; margin-bottom:8px; }
section#nreviewlist .remain span { font-weight:bold; }
section#nreviewlist .notused { font-weight:bold; color:#F03C3C; border-right:none; }
section#nreviewlist .used { font-weight:bold; color:#797979; border-right:none; }
section#nreviewlist .nolist { border-right:none; }

section#nreviewlist .more-btn {width:300px; margin:auto; text-align:center; height:35px; color:#ffffff; line-height:35px; font-size:15px; font-weight:bold; background:#808591; border-radius:3px; font-family:dotum; margin-top:15px;}

.coupon-number { margin-top:14px; height:58px; line-height:58px; background-color:#ECECEC; font-size:12px; color:#353535; text-align:center; }
.coupon-number .inputnum { font-size:14px; font-weight:bold; color:#436693; padding:3px 0; width:18%;}
.coupon-regist-description { text-align:center; margin-top:15px; font-size:12px; color:#353535; }
.confirm-coupon-wrap { margin-top:15px; text-align:center; }
button#confirm-coupon { width:94px; height:38px; background:url(/shop/data/skin_mobileV2/light/common/img/detailp/btn_buy_off.png) no-repeat; color:#FFFFFF; font-size:14px; font-weight:bold; border:none; cursor:pointer; }
button#confirm-coupon:active { background:url(/shop/data/skin_mobileV2/light/common/img/detailp/btn_buy_on.png) no-repeat; cursor:pointer; }

.point-star{color:#d4d4d4;display:inline-block;}
.point-star span {color:#d4d4d4;font-weight:bold;background:url("/shop/data/skin_mobileV2/light/common/img/new/btn_star_off.png") no-repeat;display:block;width:20px;height:20px;float:left;font-size:0;background-size: 100% 100%;}
.point-star .active {color:#FECE00;font-weight:bold;background:url("/shop/data/skin_mobileV2/light/common/img/new/btn_star_on.png") no-repeat;display:block;width:20px;height:20px;float:left;font-size:0;background-size: 100% 100%;}

.review-title {font-size:14px; font-weight:bold; font-family:dotum; color:#353535; height:27px; line-height:27px; margin-bottom:12px;}
.review-title .title{float:left;}
.review-title .title .title_cnt{color:#466996}
.review-title .write-btn{float:right;width:80px; height:27px; line-height:27px; font-size:12px; color:#FFFFFF; font-weight:normal;text-align:center; background:#808591; font-family:dotum; border-radius:3px;}


</style>
<script type="text/javascript">

$(document).ready(function(){
	var item_cnt = $("#review-table .title").length;
	if(item_cnt < 10) {
		$(".more-btn").hide();
	}


});

</script>

<?php if($TPL_VAR["goodsno"]){?>
<input type="hidden" name="goodsno" id="goodsno" value="<?php echo $TPL_VAR["goodsno"]?>" />
<?php }?>
<section id="content-wrap" class="content">
<section id="nreviewlist" class="content">
<?php if($TPL_VAR["goodsno"]){?>
	<div class="review-title"><div class="title"><span class="title_cnt">총 <?php echo $TPL_VAR["review_cnt"]?>개</span>의 상품평</div><a href="../myp/review_register.php?mode=add_review&goodsno=<?php echo $TPL_VAR["goodsno"]?>"><div class="write-btn" onClick="';">상품평쓰기</div></a></div>
<?php }?>
	<table id="review-table" border=0 >
	<tr>
		<th class=first width=40>번호</th>
		<th width=58>상품</th>
		<th>제목</th>
	</tr>
<?php if($TPL_review_loop_1){foreach($TPL_VAR["review_loop"] as $TPL_V1){
if (is_array($TPL_V1["reply"])) $TPL_reply_2=count($TPL_V1["reply"]); else if (is_object($TPL_V1["reply"]) && in_array("Countable", class_implements($TPL_V1["reply"]))) $TPL_reply_2=$TPL_V1["reply"]->count();else $TPL_reply_2=0;?>
	<tr class="title" onclick="view_content(this, <?php echo $TPL_V1["sno"]?>);">
		<td class="first"><?php echo $TPL_V1["idx"]?></td>
		<td class="img"><?php echo goodsimgMobile($TPL_V1["img_s"], 48)?></td>
		<td class="left last">
			<div class="point-star"><?php echo $TPL_V1["point_star"]?></div>
<?php if($TPL_VAR["goodsno"]){?>
			<div><?php echo $TPL_V1["review_name"]?> | <?php echo $TPL_V1["regdt"]?></div>
<?php }?>
			<div><?php echo $TPL_V1["subject"]?></div>
		</td>
	</tr>
	<tr class="content-board" id="content-<?php echo $TPL_V1["sno"]?>">
		<td colspan=3 class="">
			<div class="content-review">
				<?php echo $TPL_V1["contents"]?>

<?php if($TPL_V1["image"]){?>
				<div>
				<?php echo $TPL_V1["image"]?>

				</div>
<?php }?>
<?php if($TPL_V1["authdelete"]=='Y'){?>
				<a href="javascript:;" onclick="delete_qnaReview( 'del_review', '<?php echo $TPL_V1["m_no"]?>', '<?php echo $TPL_V1["sno"]?>');"><div class="del-btn">삭 제</div></a>
<?php }?>
			</div>
<?php if($TPL_reply_2){foreach($TPL_V1["reply"] as $TPL_V2){?>
			<div class="content-reply">
				<div class="reply-icon"></div>
<?php if($TPL_V2["subject"]){?>
				<?php echo $TPL_V2["subject"]?> <br />
<?php }?>
				<?php echo $TPL_V2["contents"]?>

<?php if($TPL_V2["authdelete"]=='Y'){?>
				<a href="javascript:;" onclick="delete_qnaReview( 'del_review', '<?php echo $TPL_V2["m_no"]?>', '<?php echo $TPL_V2["sno"]?>');"><div class="del-btn">삭 제</div></a>
<?php }?>
			</div>
<?php }}?>
		</td>
	</tr>
<?php }}else{?>
	<tr class="title">
		<td class="first" colspan="3"> 상품후기가 없습니다.</td>
	</tr>
<?php }?>
	</table>


	<div class="more-btn" onclick="javascript:getReviewData();">더보기</div>


</section>
</section>

<script language="javascript">
function delete_qnaReview( mode, m_no, sno )
{
	if ( m_no > 0 ){
		if(confirm("삭제하시겠습니까?"))
			frmMake("../goods/indb.php?mode=" + mode + "&sno=" + sno + "&m_no=" + m_no,'delete_review','상품후기 삭제',false,true,200);
	}
	else {
		frmMake("../goods/review_delete.php?mode=" + mode + "&sno=" + sno + "&m_no=" + m_no,'delete_review','상품후기 삭제',false,true,200);
	}
}

function view_content(obj, sno) {

	if($("#content-"+sno).css("display") == 'none') {
		$("#content-"+sno).show();
		$(obj).addClass('active');
	}
	else {
		$("#content-"+sno).hide();
		$(obj).removeClass('active');
	}
}

/* 2012.04.03 dn 상품후기 작성페이지 가기 스크립트 추가 시작 */
function goReviewWrite() {
	var goodsno = document.getElementById("goodsno").value;
	document.location.href="review_register.php?mode=add_review&goodsno=" + goodsno;
}
/* 2012.04.03 dn 상품후기 작성페이지 가기 스크립트 추가 끝 */
</script>

<?php $this->print_("footer",$TPL_SCP,1);?>