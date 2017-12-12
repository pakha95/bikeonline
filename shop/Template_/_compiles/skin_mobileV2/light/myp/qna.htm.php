<?php /* Template_ 2.2.7 2015/11/16 15:34:04 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/myp/qna.htm 000007799 */ 
if (is_array($TPL_VAR["member_qna_loop"])) $TPL_member_qna_loop_1=count($TPL_VAR["member_qna_loop"]); else if (is_object($TPL_VAR["member_qna_loop"]) && in_array("Countable", class_implements($TPL_VAR["member_qna_loop"]))) $TPL_member_qna_loop_1=$TPL_VAR["member_qna_loop"]->count();else $TPL_member_qna_loop_1=0;?>
<?php $this->print_("header",$TPL_SCP,1);?>


<?php  $TPL_VAR["page_title"] = "1:1문의";?>
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
section#nreviewlist .content-board td .content-review{ padding: 12px; line-height:16px;}
section#nreviewlist .content-board td .content-reply{ padding: 12px; border-top:dashed 1px #DBDBDB; line-height:14px;}
section#nreviewlist .content-board td .content-reply .answer-icon {float:left; background:url("/shop/data/skin_mobileV2/light/common/img/new/btn_a.png") no-repeat; background-size:16px 14px; width:16px; height:14px; margin-right:5px;}
section#nreviewlist .content-board td .content-review .question-icon {float:left; background:url("/shop/data/skin_mobileV2/light/common/img/new/btn_q.png") no-repeat; background-size:16px 14px; width:16px; height:14px; margin-right:5px;}

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


.review-title {font-size:14px; font-weight:bold; font-family:dotum; color:#353535; height:27px; line-height:27px; margin-bottom:12px;}
.review-title .title{float:left;}
.review-title .title .title_cnt{color:#466996}
.review-title .write-btn{float:right;width:80px; height:27px; line-height:27px; font-size:12px; color:#FFFFFF; font-weight:normal;text-align:center; background:#808591; font-family:dotum; border-radius:3px;}

.answer-yn .answer-n {width:53px; height:17px; background:url("/shop/data/skin_mobileV2/light/common/img/new/btn_q_ready.png") no-repeat; background-size:53px 17px; margin-bottom:5px;}
.answer-yn .answer-y {width:53px; height:17px; background:url("/shop/data/skin_mobileV2/light/common/img/new/btn_q_complete.png") no-repeat; background-size:53px 17px; margin-bottom:5px;}

</style>

<script type="text/javascript">
$(document).ready(function(){
	var item_cnt = $("#member-qna-table .title").length;
	
	if(item_cnt < 10) {
		$(".more-btn").hide();
	} 
});
</script>

<section id="content-wrap" class="content">
<section id="nreviewlist" class="content">
	<div class="review-title"><div class="title"><span class="title_cnt">총 <?php echo $TPL_VAR["member_qna_cnt"]?>개</span>의 1:1문의</div><a href="../myp/qna_register.php?mode=add_qna"><div class="write-btn" onClick="';">문의하기</div></a></div>
	<table id="member-qna-table">
	<tr>
		<th class=first width=40>번호</th>
		<th class=first width=100>질문유형</th>
		<th>제목</th>
	</tr>
<?php if($TPL_member_qna_loop_1){foreach($TPL_VAR["member_qna_loop"] as $TPL_V1){
if (is_array($TPL_V1["reply"])) $TPL_reply_2=count($TPL_V1["reply"]); else if (is_object($TPL_V1["reply"]) && in_array("Countable", class_implements($TPL_V1["reply"]))) $TPL_reply_2=$TPL_V1["reply"]->count();else $TPL_reply_2=0;?>
	<tr class="title" onclick="view_content(this, <?php echo $TPL_V1["sno"]?>);">
		<td class="first"><?php echo $TPL_V1["idx"]?></td>
		<td class=""><?php echo $TPL_V1["itemcd"]?></td>
		<td class="left last">
			<div class="answer-yn"><?php if($TPL_V1["reply_cnt"]> 0){?><div class="answer-y"></div><?php }elseif($TPL_V1["notice"]== 1){?><?php }else{?> <div class="answer-n"></div><?php }?></div>
			<div><?php echo $TPL_V1["subject"]?></div>
		</td>
	</tr>
	<tr class="content-board" id="content-<?php echo $TPL_V1["sno"]?>">
		<td colspan=3 class="">
			<div class="content-review">
				<div class="question-icon"></div><?php if($TPL_V1["ordno"]!='0'){?>주문번호 : <?php echo $TPL_V1["ordno"]?><br /><?php }?><?php echo $TPL_V1["contents"]?>

			</div>
<?php if($TPL_reply_2){foreach($TPL_V1["reply"] as $TPL_V2){?>
			<div class="content-reply">
				<div class="answer-icon"></div>
<?php if($TPL_V2["subject"]){?>
				<?php echo $TPL_V2["subject"]?> <br />
<?php }?>
				<?php echo $TPL_V2["contents"]?>

			</div>
<?php }}?>
		</td>
	</tr>	
<?php }}?>
	</table>
	<div class="more-btn" onclick="javascript:getMemberQnaData();">더보기</div>
</section>
</section>
<script type="text/javascript">
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
</script>
<?php $this->print_("footer",$TPL_SCP,1);?>