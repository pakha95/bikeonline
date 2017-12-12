<?php /* Template_ 2.2.7 2015/01/28 16:49:46 /www/jbsinttr8192_godo_co_kr/shop/data/skin/damoashop/member/myinfo.htm 000000749 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>


<!-- 상단이미지 || 현재위치 -->
<TABLE width=100% cellpadding=0 cellspacing=0 border=0>
<tr>
<td><img src="/shop/data/skin/damoashop/img/common/title_modifyinfo.gif" border=0></td>
</tr>
<TR>
<td class="path">HOME > 마이페이지 > <B>회원정보수정</B></td>
</TR>
</TABLE>


<div class="indiv"><!-- Start indiv -->

<?php if($TPL_VAR["memberSocialStatus"]){?>
<?php $this->print_("memberSocialStatus",$TPL_SCP,1);?>

<?php }?>
	
<?php $this->print_("frmMember",$TPL_SCP,1);?>


</div><!-- End indiv -->

<?php $this->print_("footer",$TPL_SCP,1);?>