<?php /* Template_ 2.2.7 2017/11/29 18:47:40 /www/jbsinttr8192_godo_co_kr/shop/data/skin/damoashop/outline/side/standard.htm 000004640 */  $this->include_("dataBoard","dataBank","displaySSLSeal","dataBanner");?>
<!-- ī�װ��� �޴� ���� -->
<!-- ���� ���μҽ��� '��Ÿ/�߰�������(proc) > ī�װ����޴�- menuCategory.htm' �ȿ� �ֽ��ϴ� -->
<?php $this->print_("menuCategory",$TPL_SCP,1);?>

<!-- ī�װ��� �޴� �� -->

<div id="comm" style="padding-top:35px;">
	<div><img src="/shop/data/skin/damoashop/img/main/community.gif"></div>
	<ul>
<?php if((is_array($TPL_R1=dataBoard( 20))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?>
<?php if($TPL_V1["id"]=='order'){?>
<?php if($GLOBALS["sess"]["level"]== 100){?>
			<!--li><a href="<?php echo url("board/list.php?")?>&id=<?php echo $TPL_V1["id"]?>"><?php echo $TPL_V1["name"]?></a></li-->
<?php }?>
<?php }?>
<?php }}?>
		<li><a href="<?php echo url("board/list.php?")?>&id=notice">����ũ�¶��� �ҽ�</a></li>
		<li><a href="<?php echo url("board/list.php?")?>&id=specialorder">Ư���ֹ� ����Խ���</a></li>
		<li><a href="<?php echo url("board/list.php?")?>&id=inquiry">��ǰ �Ǹ� ����</a></li>
		<li><a href="<?php echo url("board/list.php?")?>&id=qna">���� ���ϱ�</a></li>
	</ul>
</div>
<!-- ���ο��� SNS��ư -->
<div style="margin-top:20px;"><span style="margin-left:19px"><a href="https://facebook.com/bikeonline.co.kr" target="_blank"><img src="http://jbsinter2.godohosting.com/banner/facebook_52px.png" /></a></span><span style="margin-left:19px"><a href="https://blog.naver.com/bikeonline" target="_blank"><img src="http://jbsinter2.godohosting.com/banner/naver_blog_52px.png" /></a></span></div>
<!-- ���ο��� �������� 01 : Start -->
<div id="cs">
	<div class="number"><?php echo $GLOBALS["cfg"]['compPhone']?></div>
	<dl>
		<dt>MON - FRI</dt>
		<dd>am 10:00 - pm 6:00</dd>
		<dt>LUNCH</dt>
		<dd>am 12:00 - pm 1:00</dd>
		<dt>SAT, SUN, HOLIDAY </dt>
		<dd>off</dd>
	</dl>
	<div class="number" style="margin-left:5px;color:#3c1e1e;font-size:14px;font-weight: bold;background-image: url(/shop/data/skin/damoashop/img/main/kakaolink_btn_small.png);background-repeat: no-repeat;background-size: 20px;background-position: left bottom;">&nbsp;&nbsp;�ǽð� ī�� ���</div>
	<dl>
		<div class="number" style="color:#3c1e1e;font-size:12px;line-height: 10px;padding-left:10px">ģ���߰�: <strong>bikeonline</strong></div>
		<div class="number" style="color:#3c1e1e;font-size:12px;line-height: 10px;margin: 0 0 5 0;padding-left:10px">�÷���ģ��: <strong>����ũ�¶���</strong></div>
		<dd>am 10:00 - pm 7:00</dd>
	</dl>
</div>
<!-- ���ο��� �������� 01 : End -->
<!-- �������Ա� : Start -->
<div id="bankinfo">
	<div><img src="/shop/data/skin/damoashop/img/main/banking.gif"></div>
	<dl>
<?php if((is_array($TPL_R1=dataBank())&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?>
		<dt><?php echo $TPL_V1["bank"]?></dt>
		<dd><?php echo $TPL_V1["account"]?></dd>
		<dd><?php echo $TPL_V1["name"]?></dd>
<?php }}?>
	</dl>
</div>
<!-- �������Ա� : End -->
<div style="width:161px;text-align:center;">
	<div style="display:block"><?php echo displaySSLSeal()?></div>
	<br />
	<div style="display:block">
		<script>function usafe(){var win=window.open('http://www.usafe.co.kr/usafeShopCheck.asp?com_no=1170998538','', 'width=500, height=370, scrollbars=no, location=yes,status=yes,left=0, top=0');}</script><a href="javascript:usafe()"><img src="http://www.bikeonline.co.kr/shop/skin/damoashop/img/banner/usafe.gif" border="0"></a></div>
</div>
<!-- ���ο��ʹ�� : Start -->
<div style="padding:10px 0;"><!-- (��ʰ������� ��������) --><?php if((is_array($TPL_R1=dataBanner( 4))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></div>
<div style="padding:10px 0;"><!-- (��ʰ������� ��������) --><?php if((is_array($TPL_R1=dataBanner( 5))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></div>
<!-- ���ο��ʹ�� : End -->

<div style="padding-top:30px"></div>

<!-- SNS �ǽð����� ����Ʈ : Start-->
<table cellpadding=0 cellspacing=0 border=0 width=100%>
<tr><td align=center><?php echo snsPosts( 1)?></td></tr>
</table>
<!-- SNS �ǽð����� ����Ʈ : End-->