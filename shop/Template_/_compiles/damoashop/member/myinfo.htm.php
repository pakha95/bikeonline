<?php /* Template_ 2.2.7 2015/01/28 16:49:46 /www/jbsinttr8192_godo_co_kr/shop/data/skin/damoashop/member/myinfo.htm 000000749 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>


<!-- ����̹��� || ������ġ -->
<TABLE width=100% cellpadding=0 cellspacing=0 border=0>
<tr>
<td><img src="/shop/data/skin/damoashop/img/common/title_modifyinfo.gif" border=0></td>
</tr>
<TR>
<td class="path">HOME > ���������� > <B>ȸ����������</B></td>
</TR>
</TABLE>


<div class="indiv"><!-- Start indiv -->

<?php if($TPL_VAR["memberSocialStatus"]){?>
<?php $this->print_("memberSocialStatus",$TPL_SCP,1);?>

<?php }?>
	
<?php $this->print_("frmMember",$TPL_SCP,1);?>


</div><!-- End indiv -->

<?php $this->print_("footer",$TPL_SCP,1);?>