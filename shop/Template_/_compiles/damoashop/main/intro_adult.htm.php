<?php /* Template_ 2.2.7 2015/11/16 15:26:43 /www/jbsinttr8192_godo_co_kr/shop/data/skin/damoashop/main/intro_adult.htm 000006468 */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><?php echo $GLOBALS["meta_title"]?></title>
<script src="/shop/data/skin/damoashop/common.js"></script>
<link rel="styleSheet" href="/shop/data/skin/damoashop/style.css">
<style>
div.head {text-align:center;background-color:#f5f6f6;padding-top:80px;margin-bottom:50px;}
div.head h2 {display:none;}
div.head p {display:block;background:url(/shop/data/skin/damoashop/img/auth/19_img.png) no-repeat center center;height:200px;width:680px;text-indent:-5000px;margin:0 auto;margin-bottom:15px;}
div h3.auth-text{font:bold 24px Malgun Gothic;color:#222222;line-height:1.5em;}
div h3.auth-detail-text{font:14px Malgun Gothic;color:#666666;line-height:1.5em;}
div h3.auth-text span{font:bold 24px Malgun Gothic;color:#e61212;line-height:1.5em;}
div h3.auth-detail-text span{font:bold 14px Malgun Gothic;color:#666666;line-height:1.5em;}
div button.under-19{font-family:'Malgun Gothic';font-size:18px;font-weight:bold;color:#ffffff;width:250px;height:50px;background:#e61212;cursor:pointer;vertical-align:middle;border:0;margin:30px 0 70px 0;}

div.body {width:820px;margin:0 auto 20px;overflow:hidden;border:none;}
div.body h3 {font:bold 12px dotum;color:#f7443f;background:url('/shop/data/skin/damoashop/img/auth/bullet_log_tit.gif') no-repeat top left;padding:0 10px;margin:15px 0; text-align:left;}
div.body div.forms-wrap {border:1px solid #DDDDDD;padding:10px 23px 15px 23px;width:360px;float:left;margin: 0 auto 20px;text-align:center;}
div.body div.forms-wrap-login {border:1px solid #DDDDDD;padding:10px 23px 3px 23px;width:360px;float:right;}

div.body div.forms-wrap div.forms {display:inline;}
div.body div.forms-wrap div.forms div.form {display:inline;text-align:center;}
div.body div.forms-wrap div.forms div.form h4,
div.body div.forms-wrap-login div.forms div.form h4{font:bold 13px Malgun Gothic;color:#333333;padding:0 0 5px 0;margin:5px 0; text-align:left;}

div.body div.forms-wrap div.forms div.form table {}
div.body div.forms-wrap div.forms div.form table th {font-weight:bold;color:#5D5D5D;font-size:11px;letter-spacing:-1px;width:60px;text-align:left;}
div.body div.forms-wrap div.forms div.form table td {}

div.body div.forms-wrap div.forms div.form #ipinyn {padding:5px;font-size:11px; line-height:150%;letter-spacing:-1px; color:#5d5d5d;display:none}
div.body div.forms-wrap div.forms div.form label {cursor:pointer;}
div.body div.forms-wrap div.forms div.form input.fld {border:1px solid #DEDEDE;height:18px;}

div.body p.info {line-height:150%;padding:30px 0; width:580px; margin:0 auto; font-size:11px; letter-spacing:-1px; color:#5d5d5d;text-align:left;}

div.foot {border-top:1px solid #e6e6e6;margin:0 auto;width:680px;padding:10px 100px 0 100px;}
div.foot ul.company {list-style:none; margin-bottom:5px;}
div.foot ul.company li {padding:3px;}
div.foot ul.company li span.divi {color:#cecece;}


div.foot p.copyright {text-align:center;}

</style>


<!--
<!--	==========================================================	-->
<!--	한국신용정보주식회사 처리 모듈 (수정 및 변경하지 마십시오)	-->
<!--	==========================================================	-->
<script type="text/javascript" src="http://secure.nuguya.com/nuguya/nice.nuguya.oivs.crypto.js"></script>
<script type="text/javascript" src="http://secure.nuguya.com/nuguya/nice.nuguya.oivs.msg.js"></script>
<script type="text/javascript" src="http://secure.nuguya.com/nuguya/nice.nuguya.oivs.util.js"></script>
</head>

<body>

<div class="head">
	<h2>19세 미만의 미성년자는 출입을 금합니다.</h2>
	<p>
	이 정보내용은 청소년 유해매체물로서 정보통신망 이용촐진 및 정보보호등에 관한 법률 및 청소년 보호법에 규정에 의하여 19세 미만의 청소년이 이용할 수 없습니다.
	</p>

	<h3 class="auth-text">본 정보 내용은 청소년에게 유해한 정보를 포함하고 있어 <span>성인인증 절차</span>를 거쳐야 합니다.</h3>
	<h3 class="auth-detail-text">본 정보 내용은 청소년 유해매체물로서 정보통신망 이용촉진 및 정보보호등에 관한 법률 및 청소년 보호법의 규정에 의하여 <span>19세 미만의 청소년</span>이 이용할 수 없습니다.</h3>
	<button alt="19세 미만 나가기" onclick="location.href='http://www.godo.co.kr'" class="under-19">19세 미만 나가기</button>
</div>

<div class="body">
	<div class="forms-wrap">

		<div class="forms">
<?php $this->print_("intro_auth",$TPL_SCP,1);?>

			<div style="clear:both;"></div>

		</div>

	</div><!-- class=forms-wrap -->

	<div class="forms-wrap-login">

		<div class="forms">
<?php $this->print_("intro_auth_login",$TPL_SCP,1);?>

			<div style="clear:both;"></div>

		</div>

	</div><!-- class=forms-wrap -->
</div><!-- class=body -->


<div class="foot">

	<div class="logo"><a href="<?php echo url("main/main/main.php")?>&"><?php echo $logoImage;?></a></div>

	<ul class="company">
		<li>
<?php if($GLOBALS["cfg"]['compName']){?>상호명 : <?php echo $GLOBALS["cfg"]['compName']?><?php }?>
<?php if($GLOBALS["cfg"]['compSerial']){?> <span class="divi"> | </span> 사업자등록번호 : <?php echo $GLOBALS["cfg"]['compSerial']?><?php }?>
<?php if($GLOBALS["cfg"]['orderSerial']){?> <span class="divi"> | </span> 통신판매업신고번호 : <?php echo $GLOBALS["cfg"]['orderSerial']?><?php }?>
		</li>
		<li>
<?php if($GLOBALS["cfg"]['ceoName']){?>대표 : <?php echo $GLOBALS["cfg"]['ceoName']?> <?php }?>
<?php if($GLOBALS["cfg"]['adminName']){?> <span class="divi"> | </span> 개인정보관리책임자 : <?php echo $GLOBALS["cfg"]['adminName']?>

<?php if($GLOBALS["cfg"]['adminEmail']){?>(<a href="javascript:popup('./proc/popup_email.php?to=<?php echo $GLOBALS["cfg"]['adminEmail']?>&hidden=1',650,600)"><?php echo $GLOBALS["cfg"]['adminEmail']?></a>)
<?php }?>
<?php }?>
		</li>
		<li>
<?php if($GLOBALS["cfg"]['address']){?>주소 : <?php echo $GLOBALS["cfg"]['address']?> <?php }?>
<?php if($GLOBALS["cfg"]['compPhone']){?> <span class="divi"> | </span> 대표번호 : <?php echo $GLOBALS["cfg"]['compPhone']?><?php }?>
<?php if($GLOBALS["cfg"]['compFax']){?> <span class="divi"> | </span> 팩스번호 : <?php echo $GLOBALS["cfg"]['compFax']?> <?php }?>
		</li>
	</ul>

	<p class="copyright">
	Copyright ⓒ <strong><?php echo $GLOBALS["cfg"]['shopUrl']?></strong> All right reserved
	</p>

</div>

</body>
</html>