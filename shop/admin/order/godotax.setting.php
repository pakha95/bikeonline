<?php
$location = "�����ڼ��ݰ�꼭 > �����ڼ��ݰ�꼭 ����";
include "../_header.php";
@include '../../conf/config.taxGuide.php'; //���ݰ�꼭 �̿�ȳ�, �����ȳ� ����
$config_pay = $config->load('configpay');
$config_tax = $config_pay['tax'];
$config_godotax = $config->load('godotax');
if(!$config_tax['period']) $config_tax['period'] = "nolimit";
?>
<style>
.FontColorRed							{ color: #FF0000; line-height:180%; }
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
<form method="post" action="../order/godotax.setting.indb.php" target="ifrmHidden" id="frmTax">
<div class="title title_top">���� ��û/����<span>����(���ڼ��ݰ�꼭) ���񽺸� ��û �� �����ϴ� ������ �Դϴ�.</span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=order&no=20')"><img src="../img/btn_q.gif" border="0" align="absmiddle"></a></div>
<table class="tb">
<col class="cellC"><col class="cellL">
<tr>
	<td>���� ��뿩��</td>
	<td class="noline">
	<input type="radio" name=useyn value='y' <?=frmChecked($config_tax['useyn'],'y')?>> ���
	<input type="radio" name=useyn value='n' <?=frmChecked($config_tax['useyn'],'n')?>> ������
	</td>
</tr>
<tr>
	<td>���� ��������</td>
	<td class=noline>
	<input type=checkbox name=use_a <?=frmChecked($config_tax['use_a'],'on')?> value="on"> �������Ա�
	<input type=checkbox name=use_c disabled> �ſ�ī��
	<input type=checkbox name=use_o <?=frmChecked($config_tax['use_o'],'on')?> value="on"> ������ü
	<input type=checkbox name=use_v <?=frmChecked($config_tax['use_v'],'on')?> value="on"> �������
	</td>
</tr>
<tr>
	<td>���� ���۴ܰ�</td>
	<td class=noline>
	<input type=radio name=step value='1' <?=frmChecked($config_tax['step'],'1')?>> �Ա�Ȯ��
	<input type=radio name=step value='2' <?=frmChecked($config_tax['step'],'2')?>> ����غ���
	<input type=radio name=step value='3' <?=frmChecked($config_tax['step'],'3')?>> �����
	<input type=radio name=step value='4' <?=frmChecked($config_tax['step'],'4')?>> ��ۿϷ�
	</td>
</tr>
<tr>
	<td>���� ��û�Ⱓ����</td>
	<td class=noline>
	<input type=radio name=period value='limit' <?=frmChecked($config_tax['period'],'limit')?> onclick="chk_display(this.value)"> �Ա�Ȯ�α��� ������ 10�ϱ��� ����&nbsp;<span class="extext">�Ա�Ȯ�γ� �������� �Ϳ� 10�ϱ��� ���ݰ�꼭 ���� ��û�� �� �� ������ ���� �����û�� �Ұ��մϴ�.</span></br>
	<input type=radio name=period value='nolimit' <?=frmChecked($config_tax['period'],'nolimit')?> onclick="chk_display(this.value)"> �Ⱓ ���� ����&nbsp;<span class="extext">����Ⱓ�� ���� ���ݰ�꼭�� ���ؼ��� ���꼼�� �ΰ��˴ϴ�.</span>
	</td>
</tr>
<tr>
	<td>�̿�ȳ� ����</td>
	<td class=noline>
		<textarea name="guideWords" class="TextAreaSize"><?=$cfgtaxGuide['guideWords']?></textarea></br>
		<span class="FontWeightBold FontColorRed">�� �̿�ȳ� ������ ��Ų��ġ�� �����Ͻ� �Ŀ� ������ �˴ϴ�. ��Ų��ġ ������� ������� �ʽ��ϴ�.</span></br>
		<span class="extext">&nbsp;- �̿�ȳ� ������ �������ο� ���� �����ϼż� ����Ͻñ� �ٶ��ϴ�.</br>
		&nbsp;- ȸ���ѽ���ȣ�� ġȯ�ڵ�{compFax}�� �����Ǿ� ȸ������ ������ ��ϵ� "�ѽ���ȣ"�� �ڵ����� ǥ�õ˴ϴ�.</br>
		&nbsp;- ����� ������ [�ֹ�����ȸ ������]�� ǥ�õ˴ϴ�.</span>
	</td>
</tr>
<?
	$str = "none";
	if($config_tax['period'] != 'nolimit'){
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
		&nbsp;- ġȯ�ڵ�{adimEmail}�� {compPhone}�� �����Ǿ� ȸ������ ������ ��ϵ� '������ E-mail'�� '��ȭ��ȣ'�� �ڵ����� ǥ�õ˴ϴ�. </span>
	</td>
</tr>
</table>
<br><br>
<table class="tb">
<col class="cellC"><col class="cellL">
<tr>
	<td>���� ȸ�� ID</td>
	<td>
		<input type="text" name="godotax_site_id" value="<?=$config_godotax['site_id']?>" class="line" style="width:170px" maxlength="16">
	</td>
</tr>
<tr>
	<td>���� API_KEY</td>
	<td>
		<input type="text" name="godotax_api_key" value="<?=$config_godotax['api_key']?>" class="line" style="width:300px" maxlength="32"><br>
		<div class="extext" style="padding-top: 3px;">
		 ���� Ȩ���������� �α��� ��, �α��ιڽ��� �ִ� [API KEY] ��ư�� Ŭ���ϸ� Ȯ���� �� �ֽ��ϴ�. <br>
		 API KEY ���� �����Ͽ�, �����Ͻø� �˴ϴ�.
		</div>
	</td>
</tr>

</table>

<div style="position:relative;">
	<div class=button >
	<input type=image src="../img/btn_save.gif">
	</div>
	<a href="http://www.godobill.com" target="_blank" style="display:block;position:absolute;right:10px;top:0px"><img src="../img/btn_godobill_go2.gif"></a>
</div>

</form>
<span class="FontWeightBold FontColorRed">�� 2016�� 03�� 31�� ���� ���� ���� ��Ų</span>�� ����Ͻô� ���
<span class="FontWeightBold TextUnderline">�ݵ�� ��Ų��ġ�� ����</span>�ؾ� ��� ����� �����մϴ�.
<a href="http://www.godo.co.kr/customer_center/patch.php?sno=2359" target="_blank" class="FontColorSky TextUnderline FontWeightBold">[��ġ �ٷΰ���]</a></br>
<span>- ��Ų��ġ �Ŀ��� �����ΰ��� ���������� �����ϴ� �̿�/Ż��ȳ� ���� �ؽ�Ʈ(txt)������ �� �̻� ������� �����Ƿ� ���θ� ��å�� ���� �̿�ȳ� �� Ż��ȳ� ���� ������
���� ���Է� �׸� �Է� �Ǵ� �����Ͽ� �ϼ��� �ֽñ� �ٶ��ϴ�.</span>
<div id=MSG01>
<table cellpadding=1 cellspacing=0 border=0 class=small_ex>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">���� �������ǿ��� �ſ�ī���� ��쿡�� ���ݰ�꼭 �߱��� �Ұ����մϴ�.
�ſ�ī�� ������ǥ�� ���ݰ�꼭 ������� ����ϸ� �˴ϴ�.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">���� ȸ��ID, ���� API_KEY �� ������ ȸ�������� �ϸ� �߱��� �Ǵ� �����Դϴ�. ���� Ȩ���������� Ȯ�� �� �Է��Ͻø� �˴ϴ�.
</td></tr>
</table>
</div>
<script>cssRound('MSG01')</script>
<? include "../_footer.php"; ?>