<?php /* Template_ 2.2.7 2016/07/13 18:53:06 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/goods/review.htm 000010482 */ 
if (is_array($TPL_VAR["review_loop"])) $TPL_review_loop_1=count($TPL_VAR["review_loop"]); else if (is_object($TPL_VAR["review_loop"]) && in_array("Countable", class_implements($TPL_VAR["review_loop"]))) $TPL_review_loop_1=$TPL_VAR["review_loop"]->count();else $TPL_review_loop_1=0;?>
<?php $this->print_("header",$TPL_SCP,1);?>



<?php $this->print_("sub_header",$TPL_SCP,1);?>


<style type="text/css">
section#content-wrap {background:#FFFFFF;}
section#nreviewlist {background-color:#FFFFFF;min-height:100%; padding:12px;}
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
section#nreviewlist td.left { padding-left:10px; padding-right:10px; text-align:left; }
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

#page_title{position:relative;}
#page_title .btn_back {position:absolute; top:5px; left:10px; border:none; font-size:0; width:38px; height:27px; background-image:url("/shop/data/skin_mobileV2/light/common/img/new/btn_back.png"); background-size:100% 100%;}
#page_title .btn_write {position:absolute; top:5px; right:10px; border:none; font-size:0; width:56px; height:27px; background-image:url("/shop/data/skin_mobileV2/light/common/img/new/btn_postscript.png"); background-size:100% 100%;}
</style>
<script type="text/javascript">

$(document).ready(function(){
	$("#review-table .title .first.img").click(function(event){
		var goodsno = this.getAttribute("data-goodsno");
		if (parseInt(goodsno) > 0) {
			location.href = "./view.php?goodsno=" + goodsno;
			event.stopPropagation();
		}
	});
});



</script>

<section id="content-wrap" class="content">
	<section id="page_title">
		<button class="btn_back" onclick="history.back();">뒤로</button>
		<div class="top_title">상품후기</div>
		<button class="btn_write" onclick="location.href='/'+getMobileHomepath()+'/goods/review_register.php?mode=add_review';">후기작성</button>
	</section>

	<section id="nreviewlist" class="content">
		<table id="review-table" border="">
			<colgroup>
				<col width="58"/>
				<col/>
			</colgroup>
			<tr>
				<th class="first">상품</th>
				<th>제목</th>
			</tr>
<?php if($TPL_review_loop_1){foreach($TPL_VAR["review_loop"] as $TPL_V1){
if (is_array($TPL_V1["reply"])) $TPL_reply_2=count($TPL_V1["reply"]); else if (is_object($TPL_V1["reply"]) && in_array("Countable", class_implements($TPL_V1["reply"]))) $TPL_reply_2=$TPL_V1["reply"]->count();else $TPL_reply_2=0;?>
			<tr class="title" onclick="view_content(this, <?php echo $TPL_V1["sno"]?>);">
<?php if($TPL_V1["notice"]){?>
				<td class="first img notice" ><img src="/shop/data/skin_mobileV2/light/common/img/icon_notice.png"></td>
				<td class="left">
				<div style="margin-bottom:4px;">
					<img src="/shop/data/skin_mobileV2/light/common/img/btn_notice.png" style="display:inline-block; vertical-align:middle;" />
					<span style="color:#f45152; "> <?php echo $TPL_V1["subject"]?></span>
				</div>
				<div>관리자 | <?php echo str_replace('-','.',substr($TPL_V1["regdt"], 0, 10))?></div>
<?php }else{?>
				<td class="first img non-notice" data-goodsno="<?php echo $TPL_V1["goodsno"]?>"><?php echo goodsimgMobile($TPL_V1["img_s"], 48)?></td>
				<td class="left">
				<div class="point-star"><?php echo $TPL_V1["point_star"]?></div>
				<div style="word-break: break-all;"><?php echo $TPL_V1["subject"]?></div>
				<div><?php echo $TPL_V1["review_name"]?> | <?php echo str_replace('-','.',substr($TPL_V1["regdt"], 0, 10))?></div>
<?php }?>
				</td>
			</tr>

			<tr class="content-board" id="content-<?php echo $TPL_V1["sno"]?>">
				<td colspan="2">
					<div class="content-review">
						<?php echo $TPL_V1["contents"]?>

<?php if($TPL_V1["image"]){?>
						<div>
						<?php echo $TPL_V1["image"]?>

						</div>
<?php }?>
<?php if($TPL_V1["authdelete"]=='Y'){?>
						<a href="javascript:" onclick="delete_qnaReview( 'del_review', '<?php echo $TPL_V1["m_no"]?>', '<?php echo $TPL_V1["sno"]?>');"><div class="del-btn">삭 제</div></a> 
<?php }?>
					</div>
<?php if($TPL_reply_2){foreach($TPL_V1["reply"] as $TPL_V2){?>
					<div class="content-reply">
						<div class="reply-icon"></div>
<?php if($TPL_V2["subject"]){?>
						<?php echo $TPL_V2["subject"]?> <br/>
<?php }?>
						<?php echo $TPL_V2["contents"]?>

<?php if($TPL_V2["authdelete"]=='Y'){?>
						<a href="javascript:" onclick="delete_qnaReview( 'del_review', '<?php echo $TPL_V2["m_no"]?>', '<?php echo $TPL_V2["sno"]?>');"><div class="del-btn">삭 제</div></a> 
<?php }?>
					</div>
<?php }}?>
				</td>
			</tr>
<?php }}else{?>
			<tr class="title">
				<td class="first" colspan="2"> 상품후기가 없습니다.</td>
			</tr>
<?php }?>
		</table>

<?php if($TPL_VAR["review_total"]> 10){?>
		<div class="more-btn" onclick="javascript:getGoodsReviewData();">더보기</div>
<?php }?>

	</section>
</section>

<script type="text/javascript">

function delete_qnaReview( mode, m_no, sno )
{
	if ( m_no > 0 ){
		if(confirm("삭제하시겠습니까?"))
			frmMake("../goods/indb.php?mode=" + mode + "&sno=" + sno + "&m_no=" + m_no,'delete_qna','상품후기 삭제',false,true,200);
	}
	else {
		frmMake("../goods/review_delete.php?mode=" + mode + "&sno=" + sno + "&m_no=" + m_no,'delete_qna','상품후기 삭제',false,true,200);
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