<?

include "../../conf/config.pay.php";
@include '../../conf/config.taxGuide.php'; //���ݰ�꼭 �̿�ȳ�, �����ȳ� ����

$set = $set['tax'];

if(!$set['tax_delivery']) $set['tax_delivery'] = "n";
if(!$set['period']) $set['period'] = "nolimit";

$checked['useyn'][$set[useyn]] = "checked";
$checked['step'][$set[step]] = "checked";
$checked['tax_delivery'][$set['tax_delivery']] = "checked";

$checked['use_a'][$set[use_a]] = "checked";
$checked['use_c'][$set[use_c]] = "checked";
$checked['use_o'][$set[use_o]] = "checked";
$checked['use_v'][$set[use_v]] = "checked";
$checked['period'][$set['period']] = "checked";
?>
<style>
.FontColorRed							{ color: #FF0000; line-height:180%;}
.FontColorSky							{ color: #0080FF; }
.FontWeightBold						{ font-weight: bold; }
.TextUnderline							{ text-decoration:underline; }
.TextAreaSize							{ width:100%; height:150px; margin-bottom:5px; }
</style>
<script>
	function chk_display(chk){
		if(chk == "limit"){
			document.getElementById("endRow").style.display ="";
		}else{
			document.getElementById("endRow").style.display ="none";
		}
	}
</script>
<form method=post action="../order/tax_indb.php" enctype="multipart/form-data">
<input type=hidden name=mode value="tax">

<div class="title title_top">���ݰ�꼭����<span>ȸ������ ����Ǵ� ���ݰ�꼭 ���� ��å�Դϴ�</span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=order&no=7')"><img src="../img/btn_q.gif" border=0 hspace=2 align=absmiddle></a></div>
<table class=tb>
<col class=cellC><col class=cellL>
<tr>
	<td>���� ��뿩��</td>
	<td class=noline>
	<input type=radio name=useyn value='y' <?=$checked['useyn']['y']?>> ���
	<input type=radio name=useyn value='n' <?=$checked['useyn']['n']?>> ������
	</td>
</tr>
<tr>
	<td>���� ��������</td>
	<td class=noline>
	<input type=checkbox name=use_a <?=$checked['use_a']['on']?>> �������Ա�
	<input type=checkbox name=use_c <?=$checked['use_c']['on']?> disabled> �ſ�ī��
	<input type=checkbox name=use_o <?=$checked['use_o']['on']?>> ������ü
	<input type=checkbox name=use_v <?=$checked['use_v']['on']?>> �������
	</td>
</tr>
<tr>
	<td>���� ���۴ܰ�</td>
	<td class=noline>
	<input type=radio name=step value='1' <?=$checked['step']['1']?>> �Ա�Ȯ��
	<input type=radio name=step value='2' <?=$checked['step']['2']?>> ����غ���
	<input type=radio name=step value='3' <?=$checked['step']['3']?>> �����
	<input type=radio name=step value='4' <?=$checked['step']['4']?>> ��ۿϷ�
	</td>
</tr>
<tr>
	<td>��ۺ� ���Կ���</td>
	<td class=noline>
	<input type=radio name=tax_delivery value='y' <?=$checked['tax_delivery']['y']?>> ��ۺ� ����
	<input type=radio name=tax_delivery value='n' <?=$checked['tax_delivery']['n']?>> ��ۺ� ������
	</td>
</tr>
<tr>	<td>���� ��û�Ⱓ����</td>
	<td class=noline>
	<input type=radio name=period value='limit' <?=$checked['period']['limit']?> onclick="chk_display(this.value)"> �Ա�Ȯ�α��� ������ 10�ϱ��� ����&nbsp;<span class="extext">�Ա�Ȯ�γ� �������� �Ϳ� 10�ϱ��� ���ݰ�꼭 ���� ��û�� �� �� ������ ���� �����û�� �Ұ��մϴ�.</span></br>
	<input type=radio name=period value='nolimit' <?=$checked['period']['nolimit']?> onclick="chk_display(this.value)"> �Ⱓ ���� ����&nbsp;<span class="extext">����Ⱓ�� ���� ���ݰ�꼭�� ���ؼ��� ���꼼�� �ΰ��˴ϴ�.</span>
	</td>
</tr>
<tr>
	<td>�̿�ȳ� ����</td>
	<td class=noline>
		<textarea name="guideWords" class="TextAreaSize"><?=$cfgtaxGuide['guideWords']?></textarea></br>
		<span class="FontWeightBold FontColorRed" >�� �̿�ȳ� ������ ��Ų��ġ�� �����Ͻ� �Ŀ� ������ �˴ϴ�. ��Ų��ġ ������� ������� �ʽ��ϴ�.</span></br>
		<span class="extext">&nbsp;- �̿�ȳ� ������ �������ο� ���� �����ϼż� ����Ͻñ� �ٶ��ϴ�.</br>
		&nbsp;- ȸ���ѽ���ȣ�� ġȯ�ڵ�{compFax}�� �����Ǿ� ȸ������ ������ ��ϵ� "�ѽ���ȣ"�� �ڵ����� ǥ�õ˴ϴ�.</br>
		&nbsp;- ����� ������ [�ֹ�����ȸ ������]�� ǥ�õ˴ϴ�.</span>
	</td>
</tr>
<?
	$str = "none";
	if(!$checked['period']['nolimit']){
		$str = "";
	}
?>
<tr id="endRow" style="display:<?=$str?>">
	<td>���� ��û </br>���� �ȳ� ����</td>
	<td class=noline>
		<textarea name="endWords" class="TextAreaSize"><?=$cfgtaxGuide['endWords']?></textarea></br>
		<span class="FontWeightBold FontColorRed">�� �̿�ȳ� ������ ��Ų��ġ�� �����Ͻ� �Ŀ� ������ �˴ϴ�. ��Ų��ġ ������� ������� �ʽ��ϴ�.</span></br>
		<span class="extext">&nbsp;- ���ݰ�꼭 �����û �Ⱓ�� ���� �ֹ��ǿ� ���ؼ��� ����˴ϴ�.</br>
		&nbsp;- ���ݰ�꼭 �̿�ȳ� ������ ���θ��� '�ֹ�����ȸ ������'�� ǥ�õ˴ϴ�.</br>
		&nbsp;- ġȯ�ڵ�{adminEmail}�� {compPhone}�� �����Ǿ� ȸ������ ������ ��ϵ� '������ E-mail'�� '��ȭ��ȣ'�� �ڵ����� ǥ�õ˴ϴ�. </span>
	</td>
</tr>
<tr>
	<td>�ΰ��̹���</td>
	<td>
	<input type="file" name="seal_up" size="50" class=line><input type="hidden" name="seal" value="<?=$set[seal]?>">
	<a href="javascript:webftpinfo( '<?=( $set[seal] != '' ? '/data/skin/' . $cfg['tplSkin'] . '/img/common/' . $set[seal] : '' )?>' );"><img src="../img/codi/icon_imgview.gif" border="0" alt="�̹��� ����" align="absmiddle"></a>
	<? if ( $set[seal] != '' ){ ?>&nbsp;&nbsp;<span class="noline"><input type="checkbox" name="seal_del" value="Y">����</span><? } ?>
	</td>
</tr>
</table>

<div class=button>
<input type=image src="../img/btn_save.gif">
<a href="javascript:history.back()"><img src="../img/btn_cancel.gif"></a>
</div>

</form>
<span class="FontWeightBold FontColorRed">�� 2016�� 03�� 31�� ���� ���� ���� ��Ų</span>�� ����Ͻô� ���
<span class="FontWeightBold TextUnderline">�ݵ�� ��Ų��ġ�� ����</span>�ؾ� ��� ����� �����մϴ�.
<a href="http://www.godo.co.kr/customer_center/patch.php?sno=2359" target="_blank" class="FontColorSky TextUnderline FontWeightBold">[��ġ �ٷΰ���]</a></br>
<span>- ��Ų��ġ �Ŀ��� �����ΰ��� ���������� �����ϴ� �̿�/Ż��ȳ� ���� �ؽ�Ʈ(txt)������ �� �̻� ������� �����Ƿ� ���θ� ��å�� ���� �̿�ȳ� �� Ż��ȳ� ���� ������
���� ���Է� �׸� �Է� �Ǵ� �����Ͽ� �ϼ��� �ֽñ� �ٶ��ϴ�.</span>
<div id=MSG01>
<table cellpadding=1 cellspacing=0 border=0 class=small_ex>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">�ſ�ī�� �����ֹ��� ���ݰ�꼭�� �������� �ʽ��ϴ�.</td></tr>
<tr><td style="padding-left:7pt;">2004�� ������ �ΰ���ġ������ ���ϸ�, 2004�� 7�� 1�� ���� �ſ�ī��� ������ �ǿ� ���ؼ��� ���� ��꼭 ������ �Ұ�</font>�ϸ� �ſ�ī�� ������ǥ�� �ΰ���ġ�� �Ű�</font>�� �ϼž� �մϴ�.<br>
[ �ΰ���ġ���� ����� 57�� ���ù��� ���� ]</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">�ΰ��̹����� ������� ����/���� 74 pixel�� ����ð�, ���������� JPG �Ǵ� GIF���Ϸ� ���弼��.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">�Ϲݼ��ݰ�꼭 ������ �ȳ�
<ol type="a" style="margin:0px 0px 0px 40px;">
<li>���ݰ�꼭�� ����� �ۼ��� �� ����߼��̳� ���� �����ϴ� ���� ���ݰ�꼭�� ���մϴ�.</li>
<li>���������� ���� ���ݰ�꼭�� �ս��� �ۼ�/���� �� �� �ֵ��� ����Ʈ ����� �����ϰ� �ֽ��ϴ�.</li>
</ol>
</td></tr>
</table>
</div>
<script>cssRound('MSG01')</script>