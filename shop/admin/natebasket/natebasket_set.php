<?php

$location = "����Ʈ �ٽ��� > ����Ʈ �ٽ��� ����";
include "../_header.php";
@include "../../conf/natebasket.php";

if (get_magic_quotes_gpc()) {
	stripslashes_all($_POST);
	stripslashes_all($_GET);
}

// ���� �� ����
$incoupon = ($natebasket['uncoupon'] == 'Y' ? 'N' : 'Y');
$useYn = $natebasket['useYn'];
$nb_pcard = $natebasket['nb_pcard'];
$nb_goodshead = $natebasket['nb_goodshead'];
$checked['incoupon'][$incoupon] = "checked";
$checked['useYn'][$useYn] = "checked";
?>

<div class="title title_top">����Ʈ �ٽ��� ����<span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=marketing&no=29')"><img src="../img/btn_q.gif" border=0 align=absmiddle hspace=2></a></div>

<div style="padding-top:10"></div>

<form name=form method=post action="indb.php">
<input type=hidden name=mode value="natebasket">

<table class=tb border=0>
<col class=cellC><col class=cellL>
<tr>
	<td>��뿩��</td>
	<td class="noline">
	<label><input type="radio" name="useYn" value="y" <?php echo $checked['useYn']['y'];?>/>���</label><label><input type="radio" name="useYn" value="n" <?php echo $checked['useYn']['n'];?> <?php echo $checked['useYn'][''];?> />������</label>
	</td>
</tr>
<tr>
	<td>��ǰ���� ����</td>
	<td class="noline">
	<div class="extext" style="padding-bottom:5px;">����Ʈ �ٽ��Ͽ� ����Ǵ� ���������� �����մϴ�.</div>
	<div>
		<span class="noline"><input type="checkbox" name="incoupon" value="Y" <?=$checked['incoupon']['Y']?>/></span> ���� ����
		<div style="padding:3px 0px 0px 25px;">
			<div class="extext">������ <a href="../event/coupon.php" class="extext" style="font-weight:bold">���θ��/SNS > ��������Ʈ </a>���� ���� �����մϴ�.</div>
		</div>
	</div>
	</td>
</tr>
<tr>
	<td>����Ʈ �ٽ���<br />�������Һ�����</td>
	<td><input type=text name="nb_pcard" value="<?=$nb_pcard?>" class=lline></td>
</tr>
<tr>
	<td>����Ʈ �ٽ���<br />��ǰ�� �Ӹ��� ����</td>
	<td>
	<div><input type=text name="nb_goodshead" value="<?=$nb_goodshead?>" class=lline>&nbsp;<a href="javascript:document.form.submit();"><img src="../img/btn_naver_install.gif" align=absmiddle></a></div>
	<div class="extext">* ��ǰ�� �Ӹ��� ������ ���� ġȯ�ڵ�</div>
	<div class="extext">- �Ӹ��� ��ǰ�� �Էµ� "������"�� �ְ� ���� �� : {_maker}</div>
	<div class="extext">- �Ӹ��� ��ǰ�� �Էµ� "�귣��"�� �ְ� ���� �� : {_brand}</div>
	</td>
</tr>
</table>
</form>

<div id=MSG02>
<table cellpadding=1 cellspacing=0 border=0 class=small_ex>
<tr><td><img src="../img/icon_list.gif" align=absmiddle>����Ʈ �ٽ��� �������Һ�������?: �� ī��纰 ������������ �Է��Ͻ� �� �ֽ��ϴ�. ��) �Ｚ2~3/�Ե�3/����6</td></tr>
<tr><td><img src="../img/icon_list.gif" align=absmiddle>����� �������Һ������� ����Ʈ �ٽ��� ������Ʈ �ֱ⿡ ���� ����Ʈ �ٽ��Ͽ� �ݿ��Ǿ����ϴ�.</td></tr>
<tr><td><img src="../img/icon_list.gif" align=absmiddle>����Ʈ �ٽ��Ͽ� ����Ǵ� ��ǰ������ �ٽ� ����Ͻô� ���� �ƴմϴ�.</td></tr>
<tr><td style="padding-left:8">���� ����� ���θ��� ��ǰ������ ����Ʈ �ٽ����� 1�� 1ȸ�̻�(���� 1 ~ 3ȸ) �ڵ����� �������ϴ�.</td></tr>
</table>
<br/>
<table cellpadding=1 cellspacing=0 border=0 class=small_ex>
<tr><td><img src="../img/icon_list.gif" align=absmiddle>����Ʈ �ٽ��Ͽ��� ��ǰ�˻��� ���� �� �� �ֵ��� ��ǰ�� �Ӹ��� ������ Ȱ���ϼ���!</td></tr>
<tr><td><img src="../img/icon_list.gif" align=absmiddle>���� 1) ��ǰ�� �Ӹ��� ���� : ����</td></tr>
<tr>
	<td style="padding-left:10">
	<table style='border:1px solid #ffffff;width:400' class=small_ex>
	<col align="center" width="60"><col align="center" width="50"><col align="center" width="50"><col>
	<tr>
		<td>��ǰ��</td>
		<td>������</td>
		<td>�귣��</td>
		<td>���̹� ���� ��ǰ��</td>
	</tr>
	<tr>
		<td>����û����</td>
		<td>������</td>
		<td>����</td>
		<td>����û����</td>
	</tr>
	</table>
	</td>
</tr>
<tr><td><img src="../img/icon_list.gif" align=absmiddle>���� 2) ��ǰ�� �Ӹ��� ���� : [������ / {_maker} / {_brand}]</td></tr>
<tr>
	<td style="padding-left:10">
	<table style='border:1px solid #ffffff;width:400' class=small_ex>
	<col align="center" width="60"><col align="center" width="50"><col align="center" width="50"><col>
	<tr>
		<td>��ǰ��</td>
		<td>������</td>
		<td>�귣��</td>
		<td>���̹� ���� ��ǰ��</td>
	</tr>
	<tr>
		<td>����û����</td>
		<td>������</td>
		<td>����</td>
		<td>[������ / ������ / ����] ����û����</td>
	</tr>
	</table>
	</td>
</tr>
</table>
<script>cssRound('MSG02')</script>
</div>

<div style="padding-top:10"></div>

<table width=100% cellpadding=0 cellspacing=0>
<col class=cellC><col style="padding:5px 10px;line-height:140%">
<tr class=rndbg>
	<th>��ü</th>
	<th>��ǰ DB URL [������ �̸�����]</th>
</tr>
<tr><td class=rnd colspan=10></td></tr>
<tr>
	<td>����Ʈ �ٽ���<br>��ǰDB URL������</td>
	<td>
	<font color="57a300">[��ü��ǰ]</font> <a href="../../partner/natebasket_all.php" target=_blank>
	<font class=ver8>http://<?=$_SERVER['HTTP_HOST'].$cfg[rootDir]?>/partner/natebasket_all.php</font>
	<img src="../img/btn_naver_view.gif" align=absmiddle></a><br>
	<font color="57a300">[����ǰ]</font> <a href="../../partner/natebasket_summary.php" target=_blank>
	<font class=ver8>http://<?=$_SERVER['HTTP_HOST'].$cfg[rootDir]?>/partner/natebasket_summary.php</font>
	<img src="../img/btn_naver_view.gif" align=absmiddle></a>
	</td>
</tr>
<tr><td colspan=12 class=rndline></td></tr>
</table>

<?include "../_footer.php"; ?>