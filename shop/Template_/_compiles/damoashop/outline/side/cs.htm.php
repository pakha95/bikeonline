<?php /* Template_ 2.2.7 2015/12/23 17:58:47 /www/jbsinttr8192_godo_co_kr/shop/data/skin/damoashop/outline/side/cs.htm 000001920 */  $this->include_("dataBanner");?>
<!-- ������ �޴� ���� -->
<div id="left_cs" style="width:<?php echo $GLOBALS["cfg"]['shopSideSize']?>px;">
	<div class="title_cs">������</div>
	<div class="line_cs"></div>
	<div style="padding:5px 0 3px 8px;">
	<table cellpadding=0 cellspacing=7 border=0>
	<tr>
		<td><a href="<?php echo url("service/faq.php")?>&" class="lnbmenu">��FAQ</a></td>
	</tr>
	<tr>
		<td><a href="<?php echo url("service/guide.php")?>&" class="lnbmenu">���̿�ȳ�</a></td>
	</tr>
	<tr>
		<td><a href="<?php echo url("mypage/mypage_qna.php")?>&" class="lnbmenu">��1:1���ǰԽ���</a></td>
	</tr>
	<tr>
		<td><a href="<?php echo url("member/find_id.php")?>&" class="lnbmenu">��IDã��</a></td>
	</tr>
	<tr>
		<td><a href="<?php echo url("member/find_pwd.php")?>&" class="lnbmenu">����й�ȣã��</a></td>
	</tr>
	<tr>
		<td><a href="<?php echo url("mypage/mypage.php")?>&" class="lnbmenu">������������</a></td>
	</tr>
	</table>
	</div>
	<div class="line_cs"></div>
</div>
<!-- ������ �޴� �� -->

<!-- ���ο��ʹ�� : Start -->
<table cellpadding="0" cellspacing="0" border="0" width=100% style="padding:10px 0;">
<tr><td align="center"><!-- (��ʰ������� ��������) --><?php if((is_array($TPL_R1=dataBanner( 4))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></td></tr>
<tr><td align="center"><!-- (��ʰ������� ��������) --><?php if((is_array($TPL_R1=dataBanner( 5))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></td></tr>
</table>
<!-- ���ο��ʹ�� : End -->