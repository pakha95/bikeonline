<?php /* Template_ 2.2.7 2015/11/14 11:54:59 /www/jbsinttr8192_godo_co_kr/shop/data/skin/damoashop/proc/popup_email.htm 000003221 */ ?>
<html>
<head>
<title>이메일보내기</title>
<script src="/shop/data/skin/damoashop/common.js"></script>
<link rel="styleSheet" href="/shop/data/skin/damoashop/style.css">
<script type="text/javascript">
window.resizeTo(650, 890);
</script>
</head>

<body scroll=no>

<form id=form method=post action="<?php echo url("proc/indb.php")?>&" onsubmit="return chkForm(this)">
<input type=hidden name=mode value="sendmail">

<table width=100% height="100%" cellpadding=0 cellspacing=0 border=0>
<tr>
	<td height=600 style="border:10px solid #000000" valign=top>

	<div style="width:100%; background:#000000; border-bottom:2px solid #DDDDDD"><img src="/shop/data/skin/damoashop/img/common/popup_title_email.gif"></div>

	<div style="margin-left:10px; margin-right:10px;">
	<div style="border:1px solid #DEDEDE; margin-top:20px;" class="hundred">
	<table width=100% cellpadding=0 cellspacing=0 border=0>
	<tr>
		<td style="border:3px solid #F3F3F3; padding:5 5 5 5" align=center>

		<table width=100%>
<?php if(!$_GET["hidden"]){?>
		<tr>
			<td align=right width=90 nowrap class=input_txt>받는이메일</td>
			<td style="padding-left:10px"><input type=text name=To value="<?php echo $_GET["to"]?>" style="width:300px" required></td>
		</tr>
		<tr><td height=1 bgcolor=#cccccc colspan=2></td></tr>
<?php }else{?><input type=hidden name=To value="<?php echo $_GET["to"]?>" required>
<?php }?>
		<tr>
			<td align=right nowrap class=input_txt>보내는사람</td>
			<td style="padding-left:10px"><input type=text name=Name style="width:300px" required></td>
		</tr>
		<tr><td height=1 bgcolor=#cccccc colspan=2></td></tr>
		<tr>
			<td align=right nowrap class=input_txt>보내는이메일</td>
			<td style="padding-left:10px"><input type=text name=From style="width:300px" required></td>
		</tr>
		<tr><td height=1 bgcolor=#cccccc colspan=2></td></tr>
		<tr>
			<td align=right class=input_txt>제목</td>
			<td style="padding-left:10px"><input type=text name=Subject style="width:100%" required></td>
		</tr>
		<tr><td height=1 bgcolor=#cccccc colspan=2></td></tr>
		<tr>
			<td colspan=2 height=350>
			<textarea name="Body" style="width:100%;height:350px" label="내용"></textarea>
			</td>
		</tr>
		</table>

		</td>
	</tr>
	</table>
	</div>
	</div>

	<div style="margin-top:20px; padding:2%; border:1px solid #DEDEDE;">
		<div class="blue" style="margin-bottom:10px;"><strong>개인정보수집 및 이용에 대한 안내</strong></div>
		<?php echo $TPL_VAR["termsPolicyCollection4"]?>

		<p style="text-align:center;">
			<input type="radio" name="agreeyn" value="y"> 동의합니다.
			<input type="radio" name="agreeyn" value="n"> 동의하지 않습니다.
		</p>
	</div>

	<TABLE width=100%>
	<tr>
		<td align=center style="padding-top:5" class=noline><input type="image" src="/shop/data/skin/damoashop/img/common/btn_email.gif"></td>
	</tr>
	</TABLE>
	<TABLE width=100% cellpadding=0 cellspacing=0 border=0>
	<TR>
		<TD align=right><A HREF="javascript:this.close()" onFocus="blur()"><img src="/shop/data/skin/damoashop/img/common/popup_close.gif"></A></TD>
	</TR>
	</TABLE>

	</td>
</tr>
</table>

</form>

</body>
</html>