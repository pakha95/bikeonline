<?
$location = "īī�� �˸��� > īī�� �˸��� ����";
include "../_header.php";
include "../../lib/kakaoAlimtalk.class.php";

$kakaoAlimtalk = new kakaoAlimtalk();

if ($kakaoAlimtalk->config['plusFriendId']) {
	// ȯ�漳�� �ʱ⼳��
	$kakaoAlimtalk->alimtalkInitConfig();
	include "../../conf/kakaoAlimtalk.config.php";

	// �׷� ���ø� ���� ����
	$kakaoAlimtalk->groupTemplateUpdate();

	// ���ø� ��ȸ
	$template = $kakaoAlimtalk->getTemplate();

	// �ֹ�, ���, �Խ��� ���� �з�
	for ($i=0; $i<count($template); $i++) {
		if ($template[$i]['mode'] == 'order') {
			$orderTemplate[$template[$i]['code']] = $template[$i];
		}
		else if ($template[$i]['mode'] == 'member') {
			$memberTemplate[$template[$i]['code']] = $template[$i];
		}
		else {
			$boardTemplate[$template[$i]['code']] = $template[$i];
		}
	}
}

$radioBox = array('use', 'order_use', 'member_use', 'board_use');
$selectBox = array('sendDate', 'sendTime', 'afterDate', 'accountSendTime', 'memTemplate', 'adminTemplate');
$checkBox = array('send_c', 'send_a', 'send_m', 'useAccountAutoSend', 'sendBeforeDay_7', 'sendBeforeDay_30');
$adminTemplate = array('order', 'incash', 'runout', 'join', 'qna_register');	// ������/�߰������� ����
$selectDate = array('3', '7', '15', '30', '90');

foreach ($alimtalk as $k => $v) {
	if (is_array($v)) {
		foreach ($v as $k2 => $v2) {
			// ����Ʈ�ڽ�
			foreach ($selectBox as $selectValue) {
				if ($selectValue == $k2) {
					$selected[$k][$selectValue][$v2] = 'selected';
				}
			}

			// üũ�ڽ�
			foreach ($checkBox as $checkValue) {
				if ($checkValue == $k2 && ($v2 == 'on' || $v2 == 'y')) {
					$checked[$k][$checkValue] = 'checked';
				}
			}
		}
	}
	// �����ڽ�
	else {
		foreach ($radioBox as $radioValue) {
			if ($radioValue == $k) {
				$checked[$radioValue][$v] = 'checked';
			}
		}
	}
}

// �÷���ģ�� ��� �ȵǾ� ���� ���
if (!$alimtalk['plusFriendId']) {
	$disabled['use'] = 'disabled';
	$checked['use']['y'] = '';
	$checked['use']['n'] = 'checked';
}
?>
<style>
ul.tabs {
	margin: 0;
	padding: 0;
	float: left;
	list-style: none;
	height: 32px;
	border-bottom: 1px solid #cccccc;
	border-left: 1px solid #cccccc;
	width: 100%;
	font-size:12px;
}

ul.tabs li {
	float: left;
	text-align:center;
	cursor: pointer;
	width:85px;
	height: 31px;
	line-height: 31px;
	border: 1px solid #cccccc;
	border-left: none;
	background: #f6f6f6;
	overflow: hidden;
	position: relative;
}

ul.tabs li.active {
	background: #FFFFFF;
	border-bottom: 1px solid #FFFFFF;
}

.tab_container {
	width:100%;
	float: left;
	background: #FFFFFF;
}

.tab_content {
	padding-top: 10px;
}

.tab_container .tab_content ul {
	margin:0px;
	padding:0px;
}

.tab_container .tab_content ul li {
	padding:0px;
}

table.cfg {border-collapse: collapse; margin-top:10px; text-align:center; width: 840px; table-layout:fixed;}
table.cfg>tr>td,
table.cfg>tr>th,
table.cfg>tbody>tr>td,
table.cfg>tbody>tr>th {border:1px solid #cccccc; padding:5px;}

</style>
<div class="title title_top">īī���� �÷���ģ�� ���̵� ���<span>īī�� �˸��� ����� ���� īī���� �÷���ģ�� ���̵� ����մϴ�.</span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=member&no=33')"><img src="../img/btn_q.gif" border="0" hspace="2" align="absmiddle" /></a></div>

<table class="tb">
<col class="cellC"><col class="cellL">
<tr>
	<td>�÷���ģ�� ���̵�</td>
	<td>
		<input type="text" style="width:300px; background-color: #e2e2e2;" value="<?=$alimtalk['plusFriendId']?>" readonly/>
		<? if ($alimtalk['plusFriendId'] && $alimtalk['profileKey']) { ?>
		<a href="javascript:profileKeyDelete();"><img src="../img/btn_plusFriend_del.png" border="0" hspace="2" align="absmiddle"/></a>
		<? } else { ?>
		<a href="javascript:popupLayer('kakaoPlusFriend.php',700,400)"><img src="../img/btn_plusFriend_add.png" border="0" hspace="2" align="absmiddle"/></a>
		<?}?>

		<div class="extext" style="margin-top:5px;">
			�˸����� ����Ͻ÷��� �߽�������Ű�� �ʿ��մϴ�.<br>�߽�������Ű�� īī���� �÷���ģ�� ���̵� ����� �Ͽ� �߱޹��� �� �ֽ��ϴ�.<br>
			īī���� �÷���ģ�� ���̵� ���ٸ� <a href="https://center-pf.kakao.com/login" class="extext" style="font-weight:bold" target="_blank">[īī���� �÷���ģ�� ������]</a>���� �߱޹��� �� ������ּ���.
		</div>
	</td>
</tr>
<tr>
	<td>�߽�������Ű</td>
	<td>
		<input type="text" style="width:300px; background-color: #e2e2e2;" value="<?=$alimtalk['profileKey']?>" readonly/>
	</td>
</tr>
</table>

<form name="form" method="post" action="indb.php">
<input type="hidden" name="mode" value="config">
<div class="title">�˸��� ��� ����</div>

<table class="tb">
<col class="cellC"><col class="cellL">
<tr>
	<td>�˸��� ��� ����</td>
	<td>
		<input type="radio" name="use" value="y" <?=$checked['use']['y']?> <?=$disabled['use']?> onclick="useCheck();">�����
		<input type="radio" name="use" value="n" <?=$checked['use']['n']?> <?=$checked['use']['']?> onclick="useCheck();">������
		<div class="extext" style="margin-top:5px;">
			<font color="red">īī�� �˸��� �߼� �� 1�Ǵ� SMS 0.6����Ʈ�� �����˴ϴ�.</font><br>
			SMS ����Ʈ�� ���� ��� īī�� �˸����� �߼� ���� �ʽ��ϴ�. <a href="../member/sms.pay.php" class="extext" style="font-weight:bold" target="_blank">[SMS ����Ʈ���� �ٷΰ���]</a><br>
			īī�� �˸��� �߽�������Ű�� ���� �� �ּ� 1�ð��� ����ؾ� ���������� ����� �����մϴ�.
		</div>
	</td>
</tr>
</table>

<div class="title">�˸��� �߼����� / ���� ����</div>

<div id="container">
	<ul class="tabs">
		<li class="active" rel="tab1">�ֹ�����</li>
		<li rel="tab2">ȸ������</li>
		<li rel="tab3">�Խ��ǰ���</li>
	</ul>
	<div class="tab_container">
		<div id="tab1" class="tab_content">
			<ul>
				<table class="tb">
				<col class="cellC"><col class="cellL">
				<tr>
					<td>�ֹ����� �޽���<br>�˸������� ���</td>
					<td id="use_order">
						<input type="radio" name="order_use" value="y" <?=$checked['order_use']['y']?>>�����
						<input type="radio" name="order_use" value="n" <?=$checked['order_use']['n']?> <?=$checked['order_use']['']?>>������
						<div class="extext" style="margin-top:5px;">
							�˸������� ��� �� �ڵ� SMS �� �߼۵��� �ʽ��ϴ�.<br>
							īī���� �̼�ġ ������ �˸��� �߼� ���� �� SMS/LMS�� ���� �޽����� ��߼۵˴ϴ�.
						</div>
					</td>
					<td id="not_use_order" style="display:none;">
						<div style="margin-top:5px; color:red">
							* �˸��� ��� ������ ������ԡ����� �����ϼž� �˸����� �߼��� �� �ֽ��ϴ�.
						</div>
					</td>
				</tr>
				</table>

				<table class="cfg">
				<tr style="background:#f6f6f6;">
					<td rowspan="2" style="width: 156px;">�߼��׸�</td>
					<td rowspan="2" style="width: 156px;">�߰�����</td>
					<td colspan="2">�߼۴�� �� �˸��� ��������</td>
				</tr>
				<tr style="background:#f6f6f6;">
					<td style="width: 242px;">ȸ��</td>
					<td style="width: 242px;">������/�߰�������</td>
				</tr>
				<tr>
					<td>�ֹ������� �߼�<br><span style="color: #0074ba;">(�������ֹ��� �ش�)</span></td>
					<td>�߼۴�� : �ֱ� 
						<select name="order[sendDate]">
							<? for($i=0; $i<count($selectDate); $i++) {?>
							<option value="<?=$selectDate[$i]?>" <?=$selected['order']['sendDate'][$selectDate[$i]]?>><?=$selectDate[$i]?>��</option>
							<?}?>
						</select>�ֹ��Ǹ�
					</td>
					<td style="vertical-align:top">
						<textarea id="order_mem_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$orderTemplate[$alimtalk['order']['memTemplate']]['contents']?></textarea>
						<select name="order[memTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'order_mem_contents');">
							<option value="">= �߼� ���ø� ���� =</option>
							<?foreach ($orderTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['order']['memTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="order[send_c]" <?=$checked['order']['send_c']?>>�ڵ��߼�</div>
					</td>
					<td style="vertical-align:top">
						<textarea id="order_admin_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$orderTemplate[$alimtalk['order']['adminTemplate']]['contents']?></textarea>
						<select name="order[adminTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'order_admin_contents');">
							<option value="">= �߼� ���ø� ���� =</option>
							<?foreach ($orderTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['order']['adminTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="order[send_a]" <?=$checked['order']['send_a']?>>�����ڿ��Ե� �ڵ��߼�</div>
						<div style="text-align:left;"><input type="checkbox" name="order[send_m]" <?=$checked['order']['send_m']?>>�߰������ڿ��Ե� �ڵ��߼�</div>
					</td>
				</tr>
				<tr>
					<td>�Ա�Ȯ�ν� �߼�<br><span style="color: #0074ba;">(�������Ա�Ȯ��, ī��������ν� �߼�)</span></td>
					<td>�߼۴�� : �ֱ� 
						<select name="incash[sendDate]">
							<? for($i=0; $i<count($selectDate); $i++) {?>
							<option value="<?=$selectDate[$i]?>" <?=$selected['incash']['sendDate'][$selectDate[$i]]?>><?=$selectDate[$i]?>��</option>
							<?}?>
						</select>�ֹ��Ǹ�
					</td>
					<td style="vertical-align:top">
						<textarea id="incash_mem_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$orderTemplate[$alimtalk['incash']['memTemplate']]['contents']?></textarea>
						<select name="incash[memTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'incash_mem_contents');">
							<option value="">= �߼� ���ø� ���� =</option>
							<?foreach ($orderTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['incash']['memTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="incash[send_c]" <?=$checked['incash']['send_c']?> >�ڵ��߼�</div>
					</td>
					<td style="vertical-align:top">
						<textarea id="incash_admin_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$orderTemplate[$alimtalk['incash']['adminTemplate']]['contents']?></textarea>
						<select name="incash[adminTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'incash_admin_contents');">
							<option value="">= �߼� ���ø� ���� =</option>
							<?foreach ($orderTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['incash']['adminTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="incash[send_a]" <?=$checked['incash']['send_a']?> >�����ڿ��Ե� �ڵ��߼�</div>
						<div style="text-align:left;"><input type="checkbox" name="incash[send_m]" <?=$checked['incash']['send_m']?> >�߰������ڿ��Ե� �ڵ��߼�</div>
					</td>
				</tr>
				<tr>
					<td>�Աݿ�û �߼�<br><span style="color: #0074ba;">(�������ֹ��� �ش�, �ֹ������� �߼�)</span></td>
					<td>�߼۴�� : �ֱ� 
						<select name="account[sendDate]">
							<? for($i=0; $i<count($selectDate); $i++) {?>
							<option value="<?=$selectDate[$i]?>" <?=$selected['account']['sendDate'][$selectDate[$i]]?>><?=$selectDate[$i]?>��</option>
							<?}?>
						</select>�ֹ��Ǹ�<br><br>
						<input type="checkbox" name="account[useAccountAutoSend]" value='y' <?=$checked['account']['useAccountAutoSend']?>> �ֹ� 
						<select name="account[afterDate]">
							<?for ($i=1; $i<8; $i++) {?>
							<option value="<?=$i?>" <?=$selected['account']['afterDate'][$i]?>><?=$i?>��</option>
							<?}?>
						</select> �� 
						<select name="account[accountSendTime]">
							<?for ($i=8; $i<22; $i++) {?>
							<option value="<?=$i?>" <?=$selected['account']['accountSendTime'][$i]?>><?=$i?>��</option>
							<?}?>
						</select>�� �߰��߼�
					</td>
					<td style="vertical-align:top">
						<textarea id="account_mem_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$orderTemplate[$alimtalk['account']['memTemplate']]['contents']?></textarea>
						<select name="account[memTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'account_mem_contents');">
							<option value="">= �߼� ���ø� ���� =</option>
							<?foreach ($orderTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['account']['memTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="account[send_c]" <?=$checked['account']['send_c']?> >�ڵ��߼�</div>
					</td>
					<td style="color:EA0095;">
						ȸ������
					</td>
				</tr>
				<tr>
					<td>��ǰ��۽� �߼�<br><span style="color: #0074ba;">(����� ���·� ����� �߼�)</span></td>
					<td>�߼۴�� : �ֱ� 
						<select name="delivery[sendDate]">
							<? for($i=0; $i<count($selectDate); $i++) {?>
							<option value="<?=$selectDate[$i]?>" <?=$selected['delivery']['sendDate'][$selectDate[$i]]?>><?=$selectDate[$i]?>��</option>
							<?}?>
						</select>�ֹ��Ǹ�
					</td>
					<td style="vertical-align:top">
						<textarea id="delivery_mem_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$orderTemplate[$alimtalk['delivery']['memTemplate']]['contents']?></textarea>
						<select name="delivery[memTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'delivery_mem_contents');">
							<option value="">= �߼� ���ø� ���� =</option>
							<?foreach ($orderTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['delivery']['memTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="delivery[send_c]" <?=$checked['delivery']['send_c']?> >�ڵ��߼�</div>
					</td>
					<td style="color:EA0095;">
						ȸ������
					</td>
				</tr>
				<tr>
					<td>�����ȣ �߼�<br><span style="color: #0074ba;">(����� ���·� ����� �߼�)</span></td>
					<td>�߼۴�� : �ֱ� 
						<select name="dcode[sendDate]">
							<? for($i=0; $i<count($selectDate); $i++) {?>
							<option value="<?=$selectDate[$i]?>" <?=$selected['dcode']['sendDate'][$selectDate[$i]]?>><?=$selectDate[$i]?>��</option>
							<?}?>
						</select>�ֹ��Ǹ�
					</td>
					<td style="vertical-align:top">
						<textarea id="dcode_mem_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$orderTemplate[$alimtalk['dcode']['memTemplate']]['contents']?></textarea>
						<select name="dcode[memTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'dcode_mem_contents');">
							<option value="">= �߼� ���ø� ���� =</option>
							<?foreach ($orderTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['dcode']['memTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="dcode[send_c]" <?=$checked['dcode']['send_c']?> >�ڵ��߼�</div>
					</td>
					<td style="color:EA0095;">
						ȸ������
					</td>
				</tr>
				<tr>
					<td>�ֹ���ҽ� �߼�<br><span style="color: #0074ba;">(�ֹ���� ���·� ����� �߼�)</span></td>
					<td>�߼۴�� : �ֱ� 
						<select name="cancel[sendDate]">
							<? for($i=0; $i<count($selectDate); $i++) {?>
							<option value="<?=$selectDate[$i]?>" <?=$selected['cancel']['sendDate'][$selectDate[$i]]?>><?=$selectDate[$i]?>��</option>
							<?}?>
						</select>�ֹ��Ǹ�
					</td>
					<td style="vertical-align:top">
						<textarea id="cancel_mem_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$orderTemplate[$alimtalk['cancel']['memTemplate']]['contents']?></textarea>
						<select name="cancel[memTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'cancel_mem_contents');">
							<option value="">= �߼� ���ø� ���� =</option>
							<?foreach ($orderTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['cancel']['memTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="cancel[send_c]" <?=$checked['cancel']['send_c']?> >�ڵ��߼�</div>
					</td>
					<td style="color:EA0095;">
						ȸ������
					</td>
				</tr>
				<tr>
					<td>ȯ�ҿϷ�� �߼�</td>
					<td>�߼۴�� : �ֱ� 
						<select name="repay[sendDate]">
							<? for($i=0; $i<count($selectDate); $i++) {?>
							<option value="<?=$selectDate[$i]?>" <?=$selected['repay']['sendDate'][$selectDate[$i]]?>><?=$selectDate[$i]?>��</option>
							<?}?>
						</select>�ֹ��Ǹ�
					</td>
					<td style="vertical-align:top">
						<textarea id="repay_mem_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$orderTemplate[$alimtalk['repay']['memTemplate']]['contents']?></textarea>
						<select name="repay[memTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'repay_mem_contents');">
							<option value="">= �߼� ���ø� ���� =</option>
							<?foreach ($orderTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['repay']['memTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="repay[send_c]" <?=$checked['repay']['send_c']?> >�ڵ��߼�</div>
					</td>
					<td style="color:EA0095;">
						ȸ������
					</td>
				</tr>
				<tr>
					<td>��ǰǰ���� �߼�</td>
					<td></td>
					<td style="color:EA0095;">
						����������
					</td>
					<td style="vertical-align:top">
						<textarea id="runout_admin_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$orderTemplate[$alimtalk['runout']['adminTemplate']]['contents']?></textarea>
						<select name="runout[adminTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'runout_admin_contents');">
							<option value="">= �߼� ���ø� ���� =</option>
							<?foreach ($orderTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['runout']['adminTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="runout[send_a]" <?=$checked['runout']['send_a']?> >�����ڿ��Ե� �ڵ��߼�</div>
						<div style="text-align:left;"><input type="checkbox" name="runout[send_m]" <?=$checked['runout']['send_m']?> >�߰������ڿ��Ե� �ڵ��߼�</div>
					</td>
				</tr>
				</table>
			</ul>
		</div>
		<!-- tab1 end -->
		<div id="tab2" class="tab_content">
			<ul>
				<table class="tb">
				<col class="cellC"><col class="cellL">
				<tr>
					<td>ȸ������ �޽���<br>�˸������� ���</td>
					<td id="use_member">
						<input type="radio" name="member_use" value="y" <?=$checked['member_use']['y']?>>�����
						<input type="radio" name="member_use" value="n" <?=$checked['member_use']['n']?> <?=$checked['member_use']['']?>>������
						<div class="extext" style="margin-top:5px;">
							�˸������� ��� �� �ڵ� SMS �� �߼۵��� �ʽ��ϴ�.<br>
							īī���� �̼�ġ ������ �˸��� �߼� ���� �� SMS/LMS�� ���� �޽����� ��߼۵˴ϴ�.
						</div>
					</td>
					<td id="not_use_member" style="display:none;">
						<div style="margin-top:5px; color:red">
							* �˸��� ��� ������ ������ԡ����� �����ϼž� �˸����� �߼��� �� �ֽ��ϴ�.
						</div>
					</td>
				</tr>
				</table>

				<table class="cfg">
				<tr style="background:#f6f6f6;">
					<td rowspan="2" style="width: 156px;">�߼��׸�</td>
					<td rowspan="2" style="width: 156px;">�߰�����</td>
					<td colspan="2">�߼۴�� �� �˸��� ��������</td>
				</tr>
				<tr style="background:#f6f6f6;">
					<td style="width: 242px;">ȸ��</td>
					<td style="width: 242px;">������/�߰�������</td>
				</tr>
				<tr>
					<td>ȸ�����Խ� �߼�</td>
					<td></td>
					<td style="vertical-align:top">
						<textarea id="join_mem_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$memberTemplate[$alimtalk['join']['memTemplate']]['contents']?></textarea>
						<select name="join[memTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'join_mem_contents');">
							<option value="">= �߼� ���ø� ���� =</option>
							<?foreach ($memberTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['join']['memTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="join[send_c]" <?=$checked['join']['send_c']?>>�ڵ��߼�</div>
					</td>
					<td style="vertical-align:top">
						<textarea id="join_admin_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$memberTemplate[$alimtalk['join']['adminTemplate']]['contents']?></textarea>
						<select name="join[adminTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'join_admin_contents');">
							<option value="">= �߼� ���ø� ���� =</option>
							<?foreach ($memberTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['join']['adminTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="join[send_a]" <?=$checked['join']['send_a']?>>�����ڿ��Ե� �ڵ��߼�</div>
						<div style="text-align:left;"><input type="checkbox" name="join['send_m']" <?=$checked['join']['send_m']?>>�߰������ڿ��Ե� �ڵ��߼�</div>
					</td>
				</tr>
				<tr>
					<td>��й�ȣã��� �߼�</td>
					<td></td>
					<td style="vertical-align:top">
						<textarea id="id_pass_mem_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$memberTemplate[$alimtalk['id_pass']['memTemplate']]['contents']?></textarea>
						<select name="id_pass[memTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'id_pass_mem_contents');">
							<option value="">= �߼� ���ø� ���� =</option>
							<?foreach ($memberTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['id_pass']['memTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="id_pass[send_c]" <?=$checked['id_pass']['send_c']?> >�ڵ��߼�</div>
					</td>
					<td style="color:EA0095;">
						ȸ������
					</td>
				</tr>
				<tr>
					<td>�޸� ��ȯ ���� �ȳ� �߼�</td>
					<td>�߼۴�� : �޸�ȸ�� ��ȯ<br>
						<input type="checkbox" name="dormant[sendBeforeDay_30]" value='y' <?=$checked['dormant']['sendBeforeDay_30']?>> �Ѵ� ��,<br>
						<input type="checkbox" name="dormant[sendBeforeDay_7]" value='y' <?=$checked['dormant']['sendBeforeDay_7']?>> ������ �� �߼�<br>
						�߼۽��� : ���� 
						<select name="dormant[sendTime]">
							<?for ($i=8; $i<22; $i++) {?>
							<option value="<?=$i?>" <?=$selected['dormant']['sendTime'][$i]?>><?=$i?>��</option>
							<?}?>
						</select> �߼�
					</td>
					<td style="vertical-align:top">
						<textarea id="dormant_mem_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$memberTemplate[$alimtalk['dormant']['memTemplate']]['contents']?></textarea>
						<select name="dormant[memTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'dormant_mem_contents');">
							<option value="">= �߼� ���ø� ���� =</option>
							<?foreach ($memberTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['dormant']['memTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="dormant[send_c]" <?=$checked['dormant']['send_c']?> >�ڵ��߼�</div>
					</td>
					<td style="color:EA0095;">
						ȸ������
					</td>
				</tr>
				<tr>
					<td>���ŵ��ǿ��� Ȯ�� �ȳ� �߼�</td>
					<td>�߼۴�� : ���ŵ��� �� 1�� 11������ ���� ȸ��<br>
						�߼۽��� : ���� 
						<select name="reception_agreement[sendTime]">
							<?for ($i=8; $i<22; $i++) {?>
							<option value="<?=$i?>" <?=$selected['reception_agreement']['sendTime'][$i]?>><?=$i?>��</option>
							<?}?>
						</select> �߼�
					</td>
					<td style="vertical-align:top">
						<textarea id="reception_agreement_mem_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$memberTemplate[$alimtalk['reception_agreement']['memTemplate']]['contents']?></textarea>
						<select name="reception_agreement[memTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'reception_agreement_mem_contents');">
							<option value="">= �߼� ���ø� ���� =</option>
							<?foreach ($memberTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['reception_agreement']['memTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="reception_agreement[send_c]" <?=$checked['reception_agreement']['send_c']?> >�ڵ��߼�</div>
					</td>
					<td style="color:EA0095;">
						ȸ������
					</td>
				</tr>
				</table>
			</ul>
		</div>
		<!-- tab2 end -->
		<div id="tab3" class="tab_content">
			<ul>
				<table class="tb">
				<col class="cellC"><col class="cellL">
				<tr>
					<td>�Խ��ǰ��� �޽���<br>�˸������� ���</td>
					<td id="use_board">
						<input type="radio" name="board_use" value="y" <?=$checked['board_use']['y']?>>�����
						<input type="radio" name="board_use" value="n" <?=$checked['board_use']['n']?> <?=$checked['board_use']['']?>>������
						<div class="extext" style="margin-top:5px;">
							�˸������� ��� �� �ڵ� SMS �� �߼۵��� �ʽ��ϴ�.<br>
							īī���� �̼�ġ ������ �˸��� �߼� ���� �� SMS/LMS�� ���� �޽����� ��߼۵˴ϴ�.
						</div>
					</td>
					<td id="not_use_board" style="display:none;">
						<div style="margin-top:5px; color:red">
							* �˸��� ��� ������ ������ԡ����� �����ϼž� �˸����� �߼��� �� �ֽ��ϴ�.
						</div>
					</td>
				</tr>
				</table>

				<table class="cfg">
				<tr style="background:#f6f6f6;">
					<td rowspan="2" style="width: 156px;">�߼��׸�</td>
					<td rowspan="2" style="width: 156px;">�߰�����</td>
					<td colspan="2">�߼۴�� �� �˸��� ��������</td>
				</tr>
				<tr style="background:#f6f6f6;">
					<td style="width: 242px;">ȸ��</td>
					<td style="width: 242px;">������/�߰�������</td>
				</tr>
				<tr>
					<td>1:1���ǿ� ��ǰ���� ��Ͻ� �߼�<br><span style="color: #0074ba;">(�ۼ��� �ڵ�����ȣ�� �Է��� �����Ը� �߼�)</span></td>
					<td></td>
					<td style="vertical-align:top;">
						<textarea id="qna_register_mem_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$boardTemplate[$alimtalk['qna_register']['memTemplate']]['contents']?></textarea>
						<select name="qna_register[memTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'qna_register_mem_contents');">
							<option value="">= �߼� ���ø� ���� =</option>
							<?foreach ($boardTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['qna_register']['memTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="qna_register[send_c]" <?=$checked['qna_register']['send_c']?>>�ڵ��߼�</div>
					</td>
					<td style="vertical-align:top;">
						<textarea id="qna_register_admin_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$boardTemplate[$alimtalk['qna_register']['adminTemplate']]['contents']?></textarea>
						<select name="qna_register[adminTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'qna_register_admin_contents');">
							<option value="">= �߼� ���ø� ���� =</option>
							<?foreach ($boardTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['qna_register']['adminTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="qna_register[send_a]" <?=$checked['qna_register']['send_a']?>>�����ڿ��Ե� �ڵ��߼�</div>
						<div style="text-align:left;"><input type="checkbox" name="qna_register[send_m]" <?=$checked['qna_register']['send_m']?>>�߰������ڿ��Ե� �ڵ��߼�</div>
					</td>
				</tr>
				<tr>
					<td>1:1���� �亯��Ͻ� �߼�</td>
					<td></td>
					<td style="vertical-align:top">
						<textarea id="qna_mem_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$boardTemplate[$alimtalk['qna']['memTemplate']]['contents']?></textarea>
						<select name="qna[memTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'qna_mem_contents');">
							<option value="">= �߼� ���ø� ���� =</option>
							<?foreach ($boardTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['qna']['memTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="qna[send_c]" <?=$checked['qna']['send_c']?> >�ڵ��߼�</div>
					</td>
					<td style="color:EA0095;">
						ȸ������
					</td>
				</tr>
				</table>
			</ul>
		</div>
		<!-- #tab3 -->
		<div style="padding:20px 0 0 330px;">
			<input type="image" src="../img/btn_register.gif">
			<a href="javascript:history.back();"><img src="../img/btn_cancel.gif" /></a>
		</div>
	</div>
</div>
</form>
<script type="text/javascript" src="../../lib/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
$(function () {
	$(".tab_content").hide();
	$(".tab_content:first").show();

	$("ul.tabs li").click(function () {
		$("ul.tabs li").removeClass("active").css("color", "#333");
		$(this).addClass("active").css("color", "darkred");
		$(".tab_content").hide()
		var activeTab = $(this).attr("rel");
		$("#" + activeTab).show();
	});

	useCheck();
});

function useCheck() {
	if ($("input:radio[name=use]:checked").val() != 'y') {
		$("#use_order").hide();
		$("#not_use_order").show();
		$("#use_member").hide();
		$("#not_use_member").show();
		$("#use_board").hide();
		$("#not_use_board").show();
	}
	else {
		$("#use_order").show();
		$("#not_use_order").hide();
		$("#use_member").show();
		$("#not_use_member").hide();
		$("#use_board").show();
		$("#not_use_board").hide();
	}
}

function profileKeyDelete() {
	if (confirm('�÷���ģ�� ���̵� �����ϸ� īī�� �˸����� ����� �� �����ϴ�. ��ϵ� ���ø� �� ���� �����鵵 ��� �����˴ϴ�. ����Ͻðڽ��ϱ�?')) {
		var ajax = new Ajax.Request("indb.php",
		{
			method: "post",
			parameters: "mode=profileDelete",
			onComplete: function (req)
			{
				var res = req.responseText;
				if (res == 'success') {
					alert('�÷���ģ�� ���̵� �����Ͽ����ϴ�.');
					window.location.reload();
				}
				else {
					alert('�÷���ģ�� ���̵� ������ �����Ͽ����ϴ�. ��� �� �ٽ� �õ����ּ���.');
				}
			}
		});
	}
}

function templateContents(code,id) {
	var ajax = new Ajax.Request("indb.php",
	{
		method: "post",
		parameters: "mode=templateContents&code=" + code,
		onComplete: function (req)
		{
			var res = req.responseText;
			document.getElementById(id).value = res; 
		}
	});
}
</script>
<? include "../_footer.php"; ?>