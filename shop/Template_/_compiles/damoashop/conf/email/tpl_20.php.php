<?php /* Template_ 2.2.7 2012/10/04 18:27:50 /www/jbsinttr8192_godo_co_kr/shop/conf/email/tpl_20.php 000003311 */  $this->include_("dataBanner");?>
<TABLE style="BORDER-RIGHT: #cccccc 1px solid; BORDER-TOP: #cccccc 1px solid; BORDER-LEFT: #cccccc 1px solid; BORDER-BOTTOM: #cccccc 1px solid" cellSpacing=0 cellPadding=10 width=640 border=0>
<TBODY>
<TR>
<TD><!--���� ��� : Start -->
<DIV><IMG src="/shop/admin/img/mail/mail_bar_qna.gif"></DIV><!--���� ��� : End --><!--���� �κ� : Start -->
<TABLE style="MARGIN: 10px 0px" cellSpacing=0 cellPadding=6 width=610 align=center border=0>
<TBODY>
<TR>
<TD bgColor=#f2f2f2>
<TABLE cellSpacing=0 cellPadding=8 width="100%" border=0>
<TBODY>
<TR>
<TD style="FONT: 9pt/20px ����; COLOR: #585858" vAlign=top width=63><B>�������� :</B></TD>
<TD><?php echo $TPL_VAR["questiontitle"]?></TD></TR><?php if($TPL_VAR["question"]!=''){?>
<TR>
<TD style="BORDER-TOP: #e6e6e6 1px solid; FONT: 9pt/20px ����; COLOR: #585858" vAlign=top><B>�������� :</B></TD>
<TD style="BORDER-TOP: #e6e6e6 1px solid"><?php echo $TPL_VAR["question"]?></TD></TR><?php }?><?php if($TPL_VAR["answertitle"]!=''){?>
<TR>
<TD style="BORDER-TOP: #e6e6e6 1px solid; FONT: 9pt/20px ����; COLOR: #585858" vAlign=top><B>�亯���� :</B></TD>
<TD style="BORDER-TOP: #e6e6e6 1px solid"><?php echo $TPL_VAR["answertitle"]?></TD></TR><?php }?><?php if($TPL_VAR["answer"]!=''){?>
<TR>
<TD style="BORDER-TOP: #e6e6e6 1px solid; FONT: 9pt/20px ����; COLOR: #585858" vAlign=top><B>�亯 :</B></TD>
<TD style="BORDER-TOP: #e6e6e6 1px solid"><?php echo $TPL_VAR["answer"]?></TD></TR><?php }?></TBODY></TABLE></TD></TR></TBODY></TABLE>
<TABLE style="MARGIN-BOTTOM: 16px; FONT: 9pt/20px ����; COLOR: #585858" cellSpacing=0 cellPadding=0 width=610 align=center border=0>
<TBODY>
<TR>
<TD style="PADDING-LEFT: 10px" height=60>��Ÿ ���ǻ����� �����ø�, <A href="mailto:<?php echo $TPL_VAR["cfg"]["adminEmail"]?>"><STRONG><FONT color=#585858><?php echo $TPL_VAR["cfg"]["adminEmail"]?></FONT></STRONG></A> �� �����ֽñ� �ٶ��ϴ�.<BR><?php echo $TPL_VAR["cfg"]["shopName"]?> ���θ��� �̿��� �ּż� �����մϴ�. </TD></TR></TBODY></TABLE><!--���� �κ� : End --><!--���� �ϴ� : Start -->
<TABLE style="BORDER-RIGHT: #ffffff 0px solid; BORDER-TOP: #dddddd 1px solid; MARGIN-TOP: 10px; BORDER-LEFT: #ffffff 0px solid; BORDER-BOTTOM: #cfcfcf 1px solid" cellSpacing=0 cellPadding=0 width=640 border=0>
<TBODY>
<TR>
<TD style="PADDING-RIGHT: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 10px; PADDING-TOP: 10px" align=middle height=20>
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
<TBODY>
<TR>
<TD align=right width=200><?php if((is_array($TPL_R1=dataBanner( 92))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></TD>
<TD align=middle>
<TABLE cellSpacing=0 cellPadding=2 width="95%" border=0>
<TBODY>
<TR>
<TD><IMG src="/shop/admin/img/mail/mail_bottom.gif"></TD></TR>
<TR>
<TD style="FONT: 8pt verdana"><FONT color=#585858>Copyright(C) <STRONG><?php echo $TPL_VAR["cfg"]["shopName"]?></STRONG> All right reserved.</FONT></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE><!--���� �ϴ� : End --></TD></TR></TBODY></TABLE>