<?php /* Template_ 2.2.7 2016/04/18 17:50:19 /www/jbsinttr8192_godo_co_kr/shop/conf/email/tpl_10.php 000003786 */  $this->include_("dataBanner");?>
<TABLE style="BORDER-RIGHT: #cccccc 1px solid; BORDER-TOP: #cccccc 1px solid; BORDER-LEFT: #cccccc 1px solid; BORDER-BOTTOM: #cccccc 1px solid" cellSpacing=0 cellPadding=10 width=640 border=0>
<TBODY>
<TR>
<TD><!--���� ��� : Start -->
<TABLE cellSpacing=0 cellPadding=0 width=640 border=0>
<TBODY>
<TR>
<TD width=640><IMG src="/shop/admin/img/mail/mail_bar_member.gif"></TD></TR></TBODY></TABLE><!--���� ��� : End --><!--���� �κ� : Start -->
<TABLE cellSpacing=0 cellPadding=0 width=640 border=0>
<TBODY>
<TR>
<TD align=middle>
<TABLE cellSpacing=0 cellPadding=0 width=610 border=0>
<TBODY>
<TR>
<TD height=20></TD></TR>
<TR>
<TD style="FONT: 9pt/20px ����; COLOR: #585858"><STRONG><?php echo $TPL_VAR["name"]?> ���Բ����� <?php echo $TPL_VAR["cfg"]["shopName"]?>ȸ������ ���ԵǼ̽��ϴ�.<BR><BR></STRONG><?php echo $TPL_VAR["cfg"]["shopName"]?> ȸ���� �ǽ� ���� �ٽ� �ѹ� ���ϵ帮��,<BR>������ ȸ���Բ��� �پ��� ��ǰ������ �Բ� ������ �������� ������ �Ͻ� �� �ֵ���<BR>�ּ��� ���ϴ� <?php echo $TPL_VAR["cfg"]["shopName"]?>���θ�<A href="http://<?php echo $TPL_VAR["cfg"]["shopUrl"]?>/"><FONT color=#585858>(<STRONG><?php echo $TPL_VAR["cfg"]["shopUrl"]?></STRONG>)</FONT></A> �� �ǰڽ��ϴ�.<BR>�׻� ���Ӱ� �ż��� ������ �̺�Ʈ�� ������ ���������� �����ϰ��� ���� ������ ����ϰڽ��ϴ�.<BR>�����մϴ�. </TD></TR></TBODY></TABLE></TD></TR>
<TR>
<TD height=16></TD></TR>
<TR>
<TD style="FONT: 9pt/20px ����; COLOR: #585858;"> * ���� ���� ���ŵ��� ����
<TABLE cellSpacing=0 cellPadding=0 width=640 border=0 style="FONT: 9pt/20px ����; COLOR: #585858;BORDER-TOP:2PX #8C8C8C SOLID;BORDER-BOTTOM:2PX #8C8C8C SOLID;">
<TBODY>
<TR style="BACKGROUND:#DDDDDD;TEXT-ALIGN:CENTER;FONT-WEIGHT:BOLD;HEIGHT:25PX;">
<TD style="WIDTH:200PX;">�����׸�</TD>
<TD style="WIDTH:200PX;">��������</TD>
<TD style="WIDTH:210PX;">����������</TD>
</TR>
<TR style="TEXT-ALIGN:CENTER;HEIGHT:25PX;">
<TD style="BORDER-TOP:1PX #EAEAEA SOLID;BORDER-RIGHT:1PX #EAEAEA SOLID;">SMS</TD>
<TD style="BORDER-TOP:1PX #EAEAEA SOLID;BORDER-RIGHT:1PX #EAEAEA SOLID"><?php echo $TPL_VAR["smsAgree"]?></TD>
<TD ROWSPAN="2" style="BORDER-TOP:1PX #EAEAEA SOLID;"><?php echo $TPL_VAR["agreeDate_year"]?>.<?php echo $TPL_VAR["agreeDate_month"]?>.<?php echo $TPL_VAR["agreeDate_day"]?></TD>
</TR>
<TR style="TEXT-ALIGN:CENTER;HEIGHT:25PX;">
<TD style="BORDER-TOP:1PX #EAEAEA SOLID;BORDER-RIGHT:1PX #EAEAEA SOLID">EMAIL</TD>
<TD style="BORDER-TOP:1PX #EAEAEA SOLID;BORDER-RIGHT:1PX #EAEAEA SOLID"><?php echo $TPL_VAR["emailAgree"]?></TD>
</TR>
</TBODY>
</TABLE>
</TD>
</TR>
</TBODY></TABLE><!--���� �κ� : End --><!--���� �ϴ� : Start -->
<TABLE cellSpacing=0 cellPadding=0 width=640 border=0>
<TBODY>
<TR>
<TD bgColor=#dddddd height=1></TD></TR>
<TR>
<TD height=10></TD></TR>
<TR>
<TD align=middle height=20>
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
<TD style="FONT: 8pt verdana"><FONT color=#585858>Copyright(C) <STRONG><?php echo $TPL_VAR["cfg"]["shopName"]?></STRONG> All right reserved.</FONT></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR>
<TR>
<TD align=middle height=10></TD></TR></TBODY></TABLE><!--���� �ϴ� : End --></TD></TR></TBODY></TABLE>