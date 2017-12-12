<?php /* Template_ 2.2.7 2015/01/28 16:49:46 /www/jbsinttr8192_godo_co_kr/shop/data/skin/damoashop/service/company.htm 000000829 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>


<!-- 상단이미지 || 현재위치 -->
<TABLE width=100% cellpadding=0 cellspacing=0 border=0>
<tr>
<td><img src="/shop/data/skin/damoashop/img/common/title_company.gif" border=0></td>
</tr>
<TR>
<td class="path">HOME > <B>회사소개</B></td>
</TR>
</TABLE>


<div class="indiv"><!-- Start indiv -->

<br>

<table width=100% cellSpacing=0 cellPadding=0 border=0>
<tr>
	<td style="padding-left:10"><?php echo $TPL_VAR["compIntroduce"]?></td>
</tr>
<tr>
<td height=10></td>
</tr>
<tr>
	<td align=middle><?php echo $TPL_VAR["compMap"]?></td>
</tr>
</table>

</div><!-- End indiv -->

<?php $this->print_("footer",$TPL_SCP,1);?>