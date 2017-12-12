<?php /* Template_ 2.2.7 2015/12/24 11:50:57 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/myp/couponlist.htm 000009901 */ 
if (is_array($TPL_VAR["loop"])) $TPL_loop_1=count($TPL_VAR["loop"]); else if (is_object($TPL_VAR["loop"]) && in_array("Countable", class_implements($TPL_VAR["loop"]))) $TPL_loop_1=$TPL_VAR["loop"]->count();else $TPL_loop_1=0;?>
<?php $this->print_("header",$TPL_SCP,1);?>


<?php  $TPL_VAR["page_title"] = "쿠폰내역";?>
<?php $this->print_("sub_header",$TPL_SCP,1);?>


<style type="text/css">
#regist-coupon-layer {
	position : absolute;
	left : 10%;
	width : 80%;
	background : #ffffff;
	display : block;
	border-radius:1em;
	box-shadow:2px 2px 4px #7f7f7f;
	z-index: 1000;
	padding-bottom:20px;
}

.regist_coupon_title {
	background:#313030;
	width:100%;
	border-top-left-radius:1em;
	border-top-right-radius:1em;
	height:45px;
	border-bottom:solid 1px #b2b2b2;
	margin-bottom:6px;
	position: relative;
}

.regist_coupon_title .title{
	padding-left:14px;
	line-height:45px;
	font-size:16px;
	font-weight:bold;
	color:#FFFFFF;
	font-family:dotum;
}

.regist_coupon_title .close {
	position: absolute;
	line-height:45px;
	font-size:16px;
	font-weight:bold;
	color:#FFFFFF;
	font-family:dotum;
	top: 7px;
	right: 10px;
	cursor: pointer;
	width:31px;
	height:32px;
	background:url(/shop/data/skin_mobileV2/light/common/img/nmyp/btn_close_off.png) no-repeat;
}
.regist_coupon_title .close:active { background:url(/shop/data/skin_mobileV2/light/common/img/nmyp/btn_close_on.png) no-repeat; }

#background {
	position : absolute;
	left : 0;
	top : 0;
	width : 100%;
	height : 100%;
	background : #000000;
	display : none;
	z-index: 999;
}

section#content-wrap { padding:12px; background:#FFFFFF; }
section#coupon-list {background-color:#eeeeee;min-height:100%; }
section#coupon-list table {width:100%; }
/*section#coupon-list table th {height:50px; border-bottom:solid 1px #bbbbbb; background-color:#cccccc; line-height:50px; font-size:16px; text-align:center; border-right:solid 1px #bbbbbb; color:#444444;}*/
section#coupon-list th { font-size:12px; font-weight:bold; color:#353535; height:33px; line-height:33px; background:url(/shop/data/skin_mobileV2/light/common/img/nmyp/bdtit_bg.png) repeat-x; border-right:solid 1px #DBDBDB; font-family:Dotum; }
section#coupon-list th.first{ border-left : solid 1px #DBDBDB;}
section#coupon-list td { height:65px; border-right:solid 1px #DBDBDB; border-bottom:solid 1px #DBDBDB; font-size:14px; text-align:center; color:#353535; background-color:#FFFFFF; font-family:Dotum; vertical-align:middle; }
section#coupon-list td.first{ border-left : solid 1px #DBDBDB;}
section#coupon-list td.left { padding-left:10px; }
section#coupon-list .name { font-size:14px; color:#353535; height:25px; line-height:25px; vertical-align:bottom; overflow:hidden; text-align:left; margin-top:12px; }
section#coupon-list .remain { font-size:12px; height:20px; line-height:20px; vertical-align:top; color:#F03C3C; text-align:left; margin-bottom:8px; }
section#coupon-list .remain span { font-weight:bold; }
section#coupon-list .notused { font-weight:bold; color:#F03C3C; }
section#coupon-list .used { font-weight:bold; color:#797979; }
section#coupon-list .nolist { border-left:solid 1px #DBDBDB;}

section#coupon-action { margin-top:10px; text-align:right; }
button#regist-coupon { width:94px; height:38px; background:#808591; color:#FFFFFF; font-size:14px; font-weight:bold; border:none; cursor:pointer; border-radius:3px;}

.coupon-number { margin-top:14px; height:58px; line-height:58px; background-color:#ECECEC; font-size:12px; color:#353535; text-align:center; }
.coupon-number .inputnum { font-size:14px; font-weight:bold; color:#436693; padding:3px 0; width:18%;}
.coupon-regist-description { text-align:center; margin-top:15px; font-size:12px; color:#353535; }
.confirm-coupon-wrap { margin-top:15px; text-align:center; }
button#confirm-coupon { width:94px; height:38px; background:#f35151; color:#FFFFFF; font-size:14px; font-weight:bold; border:none; cursor:pointer; border-radius:3px;}

/* 모바일전용, 무통장전용 쿠폰*/
.couponInfoOnlyBtn		{ width:100%; height: 23px; margin-bottom: -5px;}
.onlyMobileCouponBtn	{ float: left; margin:5px 3px 0px 0px; width: 55px; height: 20px; color: #ffffff; font-size: 10px; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; background-color: #56ca81; font-weight: bold; text-align: center; line-height: 20px; }
.onlyBankBookCouponBtn	{ float: left; margin:5px 3px 0px 0px; width: 55px; height: 20px; color: #ffffff; font-size: 10px; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; background-color: #7b9ff0; font-weight: bold; text-align: center; line-height: 20px; }
#coupon-description { padding-top:10px; color:#436693; }
#coupon-description a { color:#436693; text-decoration:underline; }
</style>
<script type="text/javascript">
$(document).ready(function(){
	var
	$registCouponLayer = $("#regist-coupon-layer").bind('open', function(){
		$("#regist-coupon-layer [name=coupon_number[]]").val("");
		$(this).fadeIn("fast").css({
			"top" : ($(window).scrollTop()+150)+"px"
		});
		$("#background").fadeIn("fast");
	}).bind('close', function(){
		$(this).fadeOut("fast");
		$("#background").fadeOut("fast");
	});
	$("#background").css({
		"opacity" : "0.2",
		"height" : ($("#wrap").height()+"px")
	}).click(function(){
		$registCouponLayer.trigger('close');
	});
	$("#regist-coupon").click(function(){
		$registCouponLayer.trigger('open');
	});
	$("#regist-coupon-layer .regist_coupon_title .close").click(function(){
		$registCouponLayer.trigger('close');
	});
	$("#regist-coupon-form").submit(function(){
		var $this = $(this);
		for (var index = 0; index < this["coupon_number[]"].length; index++) {
			if (this["coupon_number[]"][index].value.trim().length < 1) {
				alert("쿠폰번호를 입력해 주세요.");
				this["coupon_number[]"][index].focus();
				return;
			}
		}

		$.ajax({
			"url" : $this.attr("action"),
			"type" : $this.attr("method"),
			"data" : $this.serialize(),
			"dataType" : "json",
			"success" : function(responseData)
			{
				alert(responseData.message);
				if (responseData.result === "success") location.reload();
			},
			"error" : function(xhr)
			{
				ifrmHidden.document.write(xhr.responseText);
			}
		});

		return false;
	});
});

</script>

<section id="content-wrap" class="content">
	<section id="coupon-list" class="content">
		<table>
		<thead>
		<tr>
			<th class="first" width="46%">쿠폰명</th>
			<th width="27%">할인/적립</th>
			<th>사용여부</th>
		</tr>
		</thead>
		<tbody>
<?php if($TPL_loop_1){foreach($TPL_VAR["loop"] as $TPL_V1){?>
		<tr>
			<td  class="left first">
<?php if($TPL_V1["c_screen"]=='m'||$TPL_V1["payMethod"]== 1){?>
					<div class="couponInfoOnlyBtn">
<?php if($TPL_V1["c_screen"]=='m'){?><div class="onlyMobileCouponBtn">모바일전용</div><?php }?>
<?php if($TPL_V1["payMethod"]== 1){?><div class="onlyBankBookCouponBtn">무통장전용</div><?php }?>
					</div>
<?php }?>
				<div class="name"><?php echo $TPL_V1["coupon"]?></div>
				<div class="remain"><?php if($TPL_V1["cnt"]!='사용'){?><?php if($TPL_V1["remain_hour"]> 23){?><span><?php echo $TPL_V1["remain_date"]?></span>일<?php }elseif($TPL_V1["remain_minute"]> 60){?><span><?php echo $TPL_V1["remain_hour"]?></span>시간<?php }elseif($TPL_V1["remain_minute"]){?><span><?php echo $TPL_V1["remain_minute"]?></span>분<?php }?> 남았습니다.<?php }else{?>사용했습니다.<?php }?></div>
			</td>
			<td><?php echo number_format($TPL_V1["price"])?><?php if(substr($TPL_V1["price"], - 1)!='%'){?>원<?php }else{?>%<?php }?><br />(<?php echo $GLOBALS["r_couponAbility"][$TPL_V1["ability"]]?>)</td>
			<td <?php if($TPL_V1["cnt"]=='사용'){?>class="used"<?php }else{?>class="notused"<?php }?>><?php echo $TPL_V1["cnt"]?></td>
		</tr>
<?php }}else{?>
		<tr>
			<td colspan="3" class="nolist">쿠폰내역이 없습니다.</td>
		</tr>
<?php }?>
		</tbody>
		</table>
	</section>

	<section id="coupon-action" class="content">
		<button type="button" id="regist-coupon">쿠폰등록</button>
	</section>
	<section id="coupon-description" class="content">
		* 아래와 같이 정상적으로 결제가 완료되지 않은 경우에는 쿠폰 사용 취소 후 다시 사용하실 수 있습니다.<br />
		1) 결제가 진행되는 과정에서 직접 취소한 경우<br />
		2) 인터넷 환경 등의 시스템 문제로 인하여 결제가 완료되지 못한 경우<br />
		3) 신용카드 상태 등의 문제로 결제가 실패한 경우<br />
		<a href="orderlist.php" title="주문내역바로가기">[주문내역 바로가기 >]</a><br />
	</section>
</section>

<section id="regist-coupon-layer" style="display:none;">
	<div class="regist_coupon_title">
		<div class="title">쿠폰 등록하기</div>
		<div class="close"></div>
	</div>
	<form id="regist-coupon-form" method="post" target="ifrmHidden" action="indb.paper.php">
		<input type="hidden" name="sno" value="<?php echo $GLOBALS["sno"]?>"/>
		<div class="coupon-number">
			<input type="text" name="coupon_number[]" size="5" maxlength="4" label="쿠폰번호" class="inputnum" required/> -
			<input type="text" name="coupon_number[]" size="5" maxlength="4" label="쿠폰번호" class="inputnum" required/> -
			<input type="text" name="coupon_number[]" size="5" maxlength="4" label="쿠폰번호" class="inputnum" required/> -
			<input type="text" name="coupon_number[]" size="5" maxlength="4" label="쿠폰번호" class="inputnum" required/>
		</div>
		<div class="coupon-regist-description">발급받으신 쿠폰번호를 입력해 주세요.</div>
		<div class="confirm-coupon-wrap"><button id="confirm-coupon" type="submit">확 인</button></div>
	</form>
	<iframe id="checkout-button-area" style="display:none;"></iframe>
</section>

<div id="background"></div>

<?php $this->print_("footer",$TPL_SCP,1);?>