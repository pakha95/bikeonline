<?
$location = "����ϼ����� > ����ϼ� ���ڰ��� ����";
include "../_header.php";
include "../../conf/config.pay.php";
include "../../conf/config.mobileShop.php";

if ($cfg['settlePg']){
	include "../../conf/pg.".$cfg['settlePg'].".php";
}

if($cfg['settlePg']=='inicis' && $pg['id']!='') list($nowPg,$ifrmSrc) = array("�̴Ͻý�","inicis.php");
elseif($cfg['settlePg']=='inipay' && $pg['id']!='') list($nowPg,$ifrmSrc) = array("�̴Ͻý�","inipay.php");
elseif($cfg['settlePg']=='lgdacom' && $pg['id']!='') list($nowPg,$ifrmSrc) = array("LG U+","lgdacom.php");
elseif($cfg['settlePg']=='allat' && $pg['id']!='') list($nowPg,$ifrmSrc) = array("�þ�","allat.php");
elseif($cfg['settlePg']=='allatbasic' && $pg['id']!='') list($nowPg,$ifrmSrc) = array("�þ�","allatbasic.php");
elseif($cfg['settlePg']=='kcp' && $pg['id']!='') list($nowPg,$ifrmSrc) = array("KCP","kcp.php");
elseif($cfg['settlePg']=='agspay' && $pg['id']!='') list($nowPg,$ifrmSrc) = array("�ô�����Ʈ","agspay.php");
elseif($cfg['settlePg']=='easypay' && $pg['id']!='') list($nowPg,$ifrmSrc) = array("��������","easypay.php");
elseif($cfg['settlePg']=='settlebank' && $pg['id']!='') list($nowPg,$ifrmSrc) = array("��Ʋ��ũ","settlebank.php");
else $ifrmSrc = '';

?>
<div class="title title_top">
����ϼ� ���ڰ��� ���� �ȳ�<span>����ϰ����� �̿�����(�Ǵ� ����) ���ڰ���(PG) ���񽺻��� ����� ������ �̿��Ͻð� �˴ϴ�.
</span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=mobileshop&no=7')"><img src="../img/btn_q.gif" border=0 align=absmiddle hspace=2></a>
</div>

<table border="1" bordercolor="#e1e1e1" style="border-collapse:collapse" width="100%">
<col class="cellC"><col class="cellL">
<tr>
	<td>�̿����� PG��</td>
	<td style="padding-top:8px"><b><?if($nowPg){?><?=$nowPg?><?}else{?><font class=extext>���θ��⺻���� &gt; �������ڰ����������� ���ڰ��������� �������ּ���.</font> <a href="../basic/pg.php"><font class=extext_l>[�������ڰ�������]</font></a><?}?>
	</b></td>
</tr>
</table>

<?php if($ifrmSrc){?>
<div style="padding-top: 20px"></div>
<table width="100%" cellpadding=0 cellspacing=0 border=0>
<tr>
	<td>
	<iframe id="pgifrm" src="<?php echo $ifrmSrc;?>" width="100%" frameborder="0" marginwidth="0" marginheight="0" width="100%" height="10" scrolling="no"></iframe>
	</td>
</tr>
</table>
<?php }?>

<? include "../_footer.php"; ?>