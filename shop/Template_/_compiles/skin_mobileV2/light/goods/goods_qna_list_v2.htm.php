<?php /* Template_ 2.2.7 2016/07/13 18:51:11 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/goods/goods_qna_list_v2.htm 000013753 */ 
if (is_array($TPL_VAR["qna_loop"])) $TPL_qna_loop_1=count($TPL_VAR["qna_loop"]); else if (is_object($TPL_VAR["qna_loop"]) && in_array("Countable", class_implements($TPL_VAR["qna_loop"]))) $TPL_qna_loop_1=$TPL_VAR["qna_loop"]->count();else $TPL_qna_loop_1=0;?>
<?php $this->print_("header",$TPL_SCP,1);?>


<?php $this->print_("sub_header",$TPL_SCP,1);?>


<style type="text/css">
section#content-wrap { padding:12px; background:#FFFFFF; }
section#nqnalist {background-color:#FFFFFF;min-height:100%; }
section#nqnalist table {width:100%; }
/*section#qnalist table th {height:50px; border-bottom:solid 1px #bbbbbb; background-color:#cccccc; line-height:50px; font-size:16px; text-align:center; border-right:solid 1px #bbbbbb; color:#444444;}*/
section#nqnalist th { font-size:12px; font-weight:bold; color:#353535; height:33px; line-height:33px; background:url(/shop/data/skin_mobileV2/light/common/img/nmyp/bdtit_bg.png) repeat-x; border-right:solid 1px #DBDBDB; font-family:Dotum; }
section#nqnalist th.first{ border-left:solid 1px #DBDBDB; }
section#nqnalist .title td { height:64px; border-right:solid 1px #DBDBDB; border-bottom:solid 1px #DBDBDB; font-size:12px; text-align:center; color:#353535; background-color:#FFFFFF; font-family:Dotum;  vertical-align:middle;}
section#nqnalist .active td {border-bottom:dashed 1px #DBDBDB; background:#EDF4F8;}

section#nqnalist .content-board {display:none;}
section#nqnalist .content-board td { border-left:solid 1px #DBDBDB; border-right:solid 1px #DBDBDB; border-bottom:solid 1px #DBDBDB; font-size:12px; text-align:left; color:#353535; background-color:#FFFFFF; font-family:Dotum;  vertical-align:middle;}
section#nqnalist .content-board td .content-qna{ padding: 12px;}
section#nqnalist .content-board td .del-btn {float:right; margin-bottom:8px; width:70px; height:27px; line-height:27px; font-size:12px; color:#FFFFFF; font-weight:normal; text-align:center; background:#808591; font-family:dotum; border-radius:3px;}
section#nqnalist .content-board td .content-reply{ padding: 12px; border-top:dashed 1px #DBDBDB;}
section#nqnalist .content-board td .content-reply .answer-icon {float:left; background:url("/shop/data/skin_mobileV2/light/common/img/new/btn_a.png") no-repeat; background-size:16px 14px; width:16px; height:14px; margin-right:5px;}
section#nqnalist .content-board td .content-qna .question-icon {float:left; background:url("/shop/data/skin_mobileV2/light/common/img/new/btn_q.png") no-repeat; background-size:16px 14px; width:16px; height:14px; margin-right:5px;}

section#nqnalist td.first{ border-left:solid 1px #DBDBDB; }
section#nqnalist td.left { padding-left:10px; text-align:left; }
section#nqnalist td.img { }
section#nqnalist td.img img{width:48px; height:48px; margin:5px 5px 0px 5px; }
section#nqnalist .name { font-size:14px; color:#353535; height:25px; line-height:25px; vertical-align:bottom; overflow:hidden; text-align:left; margin-top:12px; }
section#nqnalist .remain { font-size:12px; height:20px; line-height:20px; vertical-align:top; color:#F03C3C; text-align:left; margin-bottom:8px; }
section#nqnalist .remain span { font-weight:bold; }
section#nqnalist .notused { font-weight:bold; color:#F03C3C; border-right:none; }
section#nqnalist .used { font-weight:bold; color:#797979; border-right:none; }
section#nqnalist .nolist { border-right:none; }

section#nqnalist .more-btn {width:300px; margin:auto; text-align:center; height:35px; color:#ffffff; line-height:35px; font-size:15px; font-weight:bold; background:#808591; border-radius:3px; font-family:dotum; margin-top:15px;}

.coupon-number { margin-top:14px; height:58px; line-height:58px; background-color:#ECECEC; font-size:12px; color:#353535; text-align:center; }
.coupon-number .inputnum { font-size:14px; font-weight:bold; color:#436693; padding:3px 0; width:18%;}
.coupon-regist-description { text-align:center; margin-top:15px; font-size:12px; color:#353535; }
.confirm-coupon-wrap { margin-top:15px; text-align:center; }
button#confirm-coupon { width:94px; height:38px; background:url(/shop/data/skin_mobileV2/light/common/img/detailp/btn_buy_off.png) no-repeat; color:#FFFFFF; font-size:14px; font-weight:bold; border:none; cursor:pointer; }
button#confirm-coupon:active { background:url(/shop/data/skin_mobileV2/light/common/img/detailp/btn_buy_on.png) no-repeat; cursor:pointer; }


.qna-title {font-size:14px; font-weight:bold; font-family:dotum; color:#353535; height:27px; line-height:27px; margin-bottom:12px;}
.qna-title .title{float:left;}
.qna-title .title .title_cnt{color:#466996}
.qna-title .write-btn{float:right;width:80px; height:27px; line-height:27px; font-size:12px; color:#FFFFFF; font-weight:normal;text-align:center; background:#808591; font-family:dotum; border-radius:3px;}

.answer-yn .answer-n {width:53px; height:17px; background:url("/shop/data/skin_mobileV2/light/common/img/new/btn_q_ready.png") no-repeat; background-size:53px 17px; margin-bottom:5px;}
.answer-yn .answer-y {width:53px; height:17px; background:url("/shop/data/skin_mobileV2/light/common/img/new/btn_q_complete.png") no-repeat; background-size:53px 17px; margin-bottom:5px;}
.goods-qna-certification {background:url("/shop/data/skin_mobileV2/light/common/img/nlist/btn_delete02_off.png") no-repeat; background-size:40px 21px; width:40px; height:21px; border:none; font-size:10px; padding:none; text-align:center;}
.secret-icon {margin-left:5px;width:10px; height:13px; background:url("/shop/data/skin_mobileV2/light/common/img/new/icon_secret.png") no-repeat; background-size:10px 13px; margin-bottom:5px;}
.goods-qna-certification:active {background:url("/shop/data/skin_mobileV2/light/common/img/nlist/btn_delete02_on.png") no-repeat;}
#page_title{position:relative;}
#page_title .btn_back {position:absolute; top:5px; left:10px; border:none; font-size:0; width:38px; height:27px; background-image:url("/shop/data/skin_mobileV2/light/common/img/new/btn_back.png"); background-size:100% 100%;}
#page_title .btn_write {position:absolute; top:5px; right:10px; border:none; font-size:0; width:56px; height:27px; background-image:url("/shop/data/skin_mobileV2/light/common/img/new/btn_qna.png"); background-size:100% 100%;}
</style>

<script type="text/javascript">
$(document).ready(function(){
	$("#qna-table .title .first.img").click(function(event){
		var goodsno = this.getAttribute("data-goodsno");

		if (parseInt(goodsno) > 0) {
			location.href = "./view.php?goodsno=" + goodsno;
			event.stopPropagation();
		}
	});
	
	$(".goods-qna-certification").click(function(){
		var $this = $(this), sno = $this.attr("data-sno"), password = $("#goods-qna-password-"+sno).val();
		if (!password) {
			alert("비밀번호를 입력해주세요.");
			return false;
		}
		$.ajax({
			"url" : "ajaxAction.php",
			"type" : "post",
			"data" : "sno="+sno+"&password="+$("#goods-qna-password-"+sno).val()+"&mode=getGoodsQna",
			"dataType" : "json",
			"success" : function(responseData)
			{
				if (!responseData || !responseData.contents) {
					alert("비밀번호가 일치하지 않습니다.");
				}
				else {
					var add_html = '';
					add_html +='<div class="content-qna">';
					add_html +='<div class="question-icon"></div>'+responseData.contents+'</div>';

					for(var i=0; i<responseData.reply.length; i++) {
						add_html+= '			<div class="content-reply"><div class="answer-icon"></div>';
						add_html+= '				<div class="reply-icon"></div>';
						if(responseData.reply[i].subject) {
							add_html+= responseData.reply[i].subject +'<br /><br />';
						}
						add_html+= responseData.reply[i].contents;
						add_html+= '			</div>';
					}

					$this.parent().parent().html(add_html);
				}
			}
		});
		return false;
	});

	var item_cnt = $("#qna-table .title").length;
<?php if($TPL_VAR["qna_cnt"]){?>
	qna_cnt = <?php echo $TPL_VAR["qna_cnt"]?>;
	if(qna_cnt <= 10 ) {
		$(".more-btn").hide();
	}
<?php }?>
	if(item_cnt < 10 ) {
		$(".more-btn").hide();
	}
});
</script>

<style type="text/css">
.answer_yn {float:right; margin-right:5px;}
</style>
<section id="page_title">
	<button class="btn_back" onclick="history.back();">뒤로</button>
	<div class="top_title"><?php if($_GET["isAll"]=='Y'||$_GET["goodsno"]){?>상품문의<?php }else{?>나의 상품문의<?php }?></div>
	<button class="btn_write" onclick="location.href='/'+getMobileHomepath()+'/goods/goods_qna_register.php?mode=add_qna&isAll=<?php echo $_GET["isAll"]?>';">문의하기</button>
</section>
	
<?php if($TPL_VAR["goodsno"]){?>
<input type="hidden" name="goodsno" id="goodsno" value="<?php echo $TPL_VAR["goodsno"]?>" />
<?php }?>
<section id="content-wrap" class="content">
<section id="nqnalist" class="content">
<?php if($TPL_VAR["goodsno"]){?>
	<div class="qna-title"><div class="title"><span class="title_cnt">총 <?php echo $TPL_VAR["qna_cnt"]?>개</span>의 상품문의</div><a href="../goods/goods_qna_register.php?mode=add_qna&goodsno=<?php echo $TPL_VAR["goodsno"]?>&isAll=<?php echo $_GET["isAll"]?>"><div class="write-btn" onClick="';">문의하기</div></a></div>
<?php }?>
	<table id="qna-table">
	<tr>
		<th width=58 class='first'>상품</th>
		<th>제목</th>
	</tr>
<?php if($TPL_qna_loop_1){foreach($TPL_VAR["qna_loop"] as $TPL_V1){
if (is_array($TPL_V1["reply"])) $TPL_reply_2=count($TPL_V1["reply"]); else if (is_object($TPL_V1["reply"]) && in_array("Countable", class_implements($TPL_V1["reply"]))) $TPL_reply_2=$TPL_V1["reply"]->count();else $TPL_reply_2=0;?>
	<tr class="title" onclick="view_content(this, <?php echo $TPL_V1["sno"]?>);">
<?php if($TPL_V1["notice"]){?>
		<td class="first img notice" ><img src="/shop/data/skin_mobileV2/light/common/img/icon_notice.png"></td>
		<td class="left last" >
			<div style="margin-bottom:4px;">
			<img src="/shop/data/skin_mobileV2/light/common/img/btn_notice.png" style="display:inline-block; vertical-align:middle;" />
			<span style="color:#f45152; "> <?php echo $TPL_V1["subject"]?></span>
			</div>
<?php if($TPL_V1["secret"]){?>
			<div class="secret-icon" style="float:left"></div>
<?php }?>
			<div style="clear:both"></div>
			<div>관리자 | <?php echo str_replace('-','.',substr($TPL_V1["regdt"], 0, 10))?></div>
		
<?php }else{?>
		<td class="first img non-notice" data-goodsno="<?php echo $TPL_V1["goodsno"]?>"><?php echo goodsimgMobile($TPL_V1["img_s"], 48)?></td>
		<td class="left last" >
			<div class="answer-yn"><?php if($TPL_V1["reply_cnt"]> 0){?><div class="answer-y"></div><?php }else{?><div class="answer-n"></div><?php }?></div>
			<div style="float:left"><?php echo $TPL_V1["subject"]?></div>
<?php if($TPL_V1["secret"]){?>
			<div class="secret-icon" style="float:left"></div>
<?php }?>
			<div style="clear:both"></div>
			<div><?php echo $TPL_V1["qna_name"]?> | <?php echo str_replace('-','.',substr($TPL_V1["regdt"], 0, 10))?></div>
<?php }?>
		</td>
	</tr>
	<tr class="content-board" id="content-<?php echo $TPL_V1["sno"]?>">
		<td colspan=2 class="">
<?php if($TPL_V1["accessable"]){?>
			<div class="content-qna">
				<div class="question-icon"></div><?php echo $TPL_V1["contents"]?>

<?php if($TPL_V1["authdelete"]=='Y'){?>
					<a href="javascript:;" onclick="delete_qnaReview( 'del_qna', '<?php echo $TPL_V1["m_no"]?>', '<?php echo $TPL_V1["sno"]?>');"><div class="del-btn">삭 제</div></a>
<?php }?>
				</div>
<?php if($TPL_reply_2){foreach($TPL_V1["reply"] as $TPL_V2){?>
				<div class="content-reply">
					<div class="answer-icon"></div>
<?php if($TPL_V2["subject"]){?>
					<?php echo $TPL_V2["subject"]?> <br/><br/>
<?php }?>
					<?php echo $TPL_V2["contents"]?>

<?php if($TPL_V2["authdelete"]=='Y'){?>
					<a href="javascript:;" onclick="delete_qnaReview( 'del_qna', '<?php echo $TPL_V2["m_no"]?>', '<?php echo $TPL_V2["sno"]?>');"><div class="del-btn">삭 제</div></a>
<?php }?>
			</div>
<?php }}?>
<?php }else{?>
			<div class="content-qna">
<?php if($TPL_V1["m_no"]> 0){?>
				비밀글 입니다.
<?php }else{?>
				비밀번호 :
				<input type="password" id="goods-qna-password-<?php echo $TPL_V1["sno"]?>" name="password" required="required"/>
				<button type="button" data-sno="<?php echo $TPL_V1["sno"]?>"  class="goods-qna-certification">확인</button>
<?php }?>
			</div>
<?php }?>
		</td>
	</tr>
<?php }}else{?>
	<tr class="title">
		<td class="first" colspan="3"> 상품문의가 없습니다.</td>
	</tr>
<?php }?>

	</table>
	<div class="more-btn" onclick="javascript:getQnaM2Data('<?php echo $_GET["isAll"]?>');">더보기</div>
</section>
</section>

<script language="javascript">

function delete_qnaReview( mode, m_no, sno )
{
	if ( m_no > 0 ){
		if(confirm("삭제하시겠습니까?"))
			frmMake("../goods/indb.php?mode=" + mode + "&sno=" + sno + "&m_no=" + m_no,'delete_qna','상품문의 삭제',false,true,200);
	}
	else {
		frmMake("../goods/goods_qna_delete.php?mode=" + mode + "&sno=" + sno + "&m_no=" + m_no,'delete_qna','상품문의 삭제',false,true,200);
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
function goQnaWrite() {
	var goodsno = document.getElementById("goodsno").value;
	document.location.href="goods_qna_register.php?mode=add_qna&goodsno=" + goodsno+"&isAll=<?php echo $_GET["isAll"]?>";
}
/* 2012.04.03 dn 상품후기 작성페이지 가기 스크립트 추가 끝 */
</script>

<?php $this->print_("footer",$TPL_SCP,1);?>