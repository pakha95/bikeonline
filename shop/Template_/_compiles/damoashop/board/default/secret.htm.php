<?php /* Template_ 2.2.7 2016/06/29 12:49:53 /www/jbsinttr8192_godo_co_kr/shop/data/skin/damoashop/board/default/secret.htm 000002235 */ ?>
<?php if($_GET['id']=='dealer'){?>
<?php }else{?>
<?php $this->print_("header",$TPL_SCP,1);?><?php echo $GLOBALS["bdHeader"]?>

<?php }?>

<body onLoad="if (document.frmSecret.password) document.frmSecret.password.focus()">

<table width=<?php echo $GLOBALS["bdWidth"]?> align=<?php echo $GLOBALS["bdAlign"]?> cellpadding=0 cellspacing=0><tr><td>

<form name=frmSecret method=post>
<input type=hidden name=returnUrl value="<?php echo $TPL_VAR["returnUrl"]?>">

<div style="height:20; font-size:0pt"></div>
<?php if($TPL_VAR["m_no"]){?>

<div style="width:100%; border:1px solid #DEDEDE;">
<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr>
	<td style="border:5px solid #F3F3F3;" align=center>
	<table>
	<tr height=50>
		<td class=input_txt>���� ������ �����ϴ�</td>
	</tr>
	</table>
	</td>
</tr>
</table>
</div>

<div align=center style="padding:50px 0 20px 0" class=noline>
<a href="javascript:history.back()"><img src="/shop/data/skin/damoashop/board/default/img/btn_board_confirm.gif"></a>
</div>

<?php }else{?>



<div class="hundred" style="text-align:left; padding-left:20; height:20"><div class="input_txt">�� ��б��Դϴ�. ���� �ۼ��ϽǶ� �Է��� ��й�ȣ�� �Է��ϼ���.</div></div>
<div class="hundred" style="border:1px solid #DEDEDE;">
<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr>
	<td style="border:5px solid #F3F3F3;" align=center>
	<table>
	<tr height=50>
		<td class=input_txt align=right>��й�ȣ</td>
		<td><input type=password name=password class=line size=30></td>
	</tr>
	</table>
	</td>
</tr>
</table>
</div>

<div align=center style="padding:50px 0 20px 0" class=noline>
<a href="javascript:document.frmSecret.submit()"><img src="/shop/data/skin/damoashop/board/default/img/btn_board_confirm.gif"></a>
<a href="<?php echo $TPL_VAR["returnUrl"]?>"><img src="/shop/data/skin/damoashop/board/default/img/btn_board_back.gif"></a>
</div>


<?php }?>

</form>

</td></tr></table>
<?php if($_GET['id']=='dealer'){?>
<?php }else{?>
<?php $this->print_("footer",$TPL_SCP,1);?>

<?php }?>