<?
$location = "�⺻���� > ������ IP�������� ����";
include "../_header.php";
@include "../../conf/config.admin_access_ip.php";

//�ʱⰪ ����
if(!$set_ip_permit) $set_ip_permit = '0';

//��ϵ� IP����
$set_ip_cnt = count($set_regist_ip);

//���� ���� IP
$accessIP = $_SERVER['REMOTE_ADDR'];
$ex_accessIP = explode(".",$accessIP);
?>

<script type="text/javascript">
<!--
function validateForm(obj) {
	if(obj.ip_permit[1].checked == true) {

		if(!obj["regist_ip[]"]) {
		
			alert("�ּ� 1�� �̻��� ��ϵ� IP�� �־�� �մϴ�.\n���Ӱ��� IP�� ����� �ּ���.");			
			return false;
		}

		var regist_ip = (obj["regist_ip[]"].length===undefined) ? new Array(obj["regist_ip[]"]) : obj["regist_ip[]"], a=0;
		for(var i=0; i<regist_ip.length; i++) {
			if(regist_ip[i].value == "") a++;
		}

		if(regist_ip.length===a) {
			alert('�ּ� 1�� �̻��� ��ϵ� IP�� �־�� �մϴ�.\n���Ӱ��� IP�� ����� �ּ���.');
			return false;
		}

	}
	
}	
//-->
</script>

<form name="form" method="post" action="indb.php" onsubmit="return validateForm(this);">
<input type="hidden" name="mode" value="admin_ip">
<div class="title title_top">������ IP�������� ����<span></span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=basic&no=35')"><img src="../img/btn_q.gif" border="0" align="absmiddle"></a></div>

<table class=tb>
<col class=cellC><col class=cellL>
<tr>
	<td>�������� ����</td>
	<td>
	<input type="radio" name="ip_permit" value="0" style='border:0px' onclick="cl_none()" <?if($set_ip_permit=='0'){?>checked<?}?>>
	������ ���� IP ��� ���
	&nbsp;
	<input type="radio" name="ip_permit" value="1" style='border:0px' onclick="cl_use()" <?if($set_ip_permit=='1'){?>checked<?}?>>
	������ ���� IP ���� (��ϵ� IP�� ���� ����)
	</td>
</tr>
<tr>
	<td rowspan="2">���Ӱ��� IP ���</td>
	<td>
	<div id="IP_regist" disabled>
		<div style="margin-bottom:10px;float:left;">
			<div style="margin-bottom:10px;float:left;">
				<input type="text" id="class0" name="class[]" maxlength="3" size="3" onkeyup="onlyNumber(this);" onkeypress="onlyNumber(this);" style="IME-MODE:disabled;" disabled />.
				<input type="text" id="class1" name="class[]" maxlength="3" size="3" onkeyup="onlyNumber(this);" onkeypress="onlyNumber(this);" style="IME-MODE:disabled;" disabled />.
				<input type="text" id="class2" name="class[]" maxlength="3" size="3" onkeyup="onlyNumber(this);" onkeypress="onlyNumber(this);" style="IME-MODE:disabled;" disabled />.
				<input type="text" id="class3" name="class[]" maxlength="3" size="3" onkeyup="onlyNumber(this);" onkeypress="onlyNumber(this);" style="IME-MODE:disabled;" disabled />
			</div>
			<div id="add_f" style="display:none;float:left;">
				~ <input type="text" id="class4" maxlength="3" size="3" onkeyup="onlyNumber(this);" style="IME-MODE:disabled;"/>
			</div>
			<div style="float:left;" class="noline">
				<input type="image" id="b2" src='../img/i_add.gif' onClick='fnRegist();return false;' style='border:0;margin:2px 5px;vertical-align:top;cursor:pointer;' disabled />
				<input type="checkbox" id="chkbox" onclick="fnAdd('add_f',this)" value="1" /> �뿪�����ϱ�
			</div>
			<div style="float:left;padding-left:20px;margin:2px 5px;">
				<span style="color:#627DCE;" >[ ��������IP : <?=$accessIP?>  <input type="image" id="b1" src='../img/btn_s_apply.gif' onClick='fnApply();return false;' style='border:0;vertical-align:middle;cursor:pointer;' disabled /> ]</span>
				<input type="hidden" name="accessIP" value="<?=$ex_accessIP[0]?>" />
				<input type="hidden" name="accessIP" value="<?=$ex_accessIP[1]?>" />
				<input type="hidden" name="accessIP" value="<?=$ex_accessIP[2]?>" />
				<input type="hidden" name="accessIP" value="<?=$ex_accessIP[3]?>" />
			</div>
		</div>		

		<div class="extext" style="clear:both;margin:5px 0 0 3px;line-height:150%">
		�ִ� 10������ ���Ӱ��� IP����� �����մϴ�. <br />
		IP�뿪�� ����� 4��° �Է¶����� ������ �� ������, ��ĭ���� �νø� �뿪��(0~255)�� ��ϵ˴ϴ�.
		</div>
		<div style="color:#7F7F7F;"><b>������������ ����Ǵ� IP�� ��Ͻ� ������ ���ѵǽ� �� ������ ���ǹٶ��ϴ�.</b></div>
		
	</div>
	</td>
</tr>
<tr>
	<td>
	<div id="IP_list" disabled>		
		<? for($i=0; $i<$set_ip_cnt; $i++) { ?>
		<div id="regip_<?=$i?>" style="padding:4px 0px;">
			<span id="ip_addr_<?=$i?>" style="width:100px;"><?=$set_regist_ip[$i]?></span>&nbsp;&nbsp;&nbsp;<input type='hidden' id='regist_ip<?=$i?>' name='regist_ip[]' value='<?=$set_regist_ip[$i]?>' /><input type="image" id="bb<?=$i?>" src='../img/i_del.gif' onClick='javascript:delDIV(<?=$i?>);return false;' style='border:0;vertical-align:top;cursor:pointer;' disabled />
		</div>
		<? } ?>
	</div> 
	</td>
</tr>
</table>

<div class="button">
<input type="image" src="../img/btn_register.gif">
</div>

<script src="../ip_access.js"></script>

<?if($set_ip_permit == '0'){?><script>cl_none()</script><?}?>
<?if($set_ip_permit == '1'){?><script>cl_use()</script><?}?>


<? include "../_footer.php"; ?>