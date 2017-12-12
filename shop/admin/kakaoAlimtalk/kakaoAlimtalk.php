<?
$location = "카카오 알림톡 > 카카오 알림톡 설정";
include "../_header.php";
include "../../lib/kakaoAlimtalk.class.php";

$kakaoAlimtalk = new kakaoAlimtalk();

if ($kakaoAlimtalk->config['plusFriendId']) {
	// 환경설정 초기설정
	$kakaoAlimtalk->alimtalkInitConfig();
	include "../../conf/kakaoAlimtalk.config.php";

	// 그룹 템플릿 최초 갱신
	$kakaoAlimtalk->groupTemplateUpdate();

	// 템플릿 조회
	$template = $kakaoAlimtalk->getTemplate();

	// 주문, 멤버, 게시판 별로 분류
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
$adminTemplate = array('order', 'incash', 'runout', 'join', 'qna_register');	// 관리자/추가관리자 설정
$selectDate = array('3', '7', '15', '30', '90');

foreach ($alimtalk as $k => $v) {
	if (is_array($v)) {
		foreach ($v as $k2 => $v2) {
			// 셀렉트박스
			foreach ($selectBox as $selectValue) {
				if ($selectValue == $k2) {
					$selected[$k][$selectValue][$v2] = 'selected';
				}
			}

			// 체크박스
			foreach ($checkBox as $checkValue) {
				if ($checkValue == $k2 && ($v2 == 'on' || $v2 == 'y')) {
					$checked[$k][$checkValue] = 'checked';
				}
			}
		}
	}
	// 라디오박스
	else {
		foreach ($radioBox as $radioValue) {
			if ($radioValue == $k) {
				$checked[$radioValue][$v] = 'checked';
			}
		}
	}
}

// 플러스친구 등록 안되어 있을 경우
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
<div class="title title_top">카카오톡 플러스친구 아이디 등록<span>카카오 알림톡 사용을 위한 카카오톡 플러스친구 아이디를 등록합니다.</span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=member&no=33')"><img src="../img/btn_q.gif" border="0" hspace="2" align="absmiddle" /></a></div>

<table class="tb">
<col class="cellC"><col class="cellL">
<tr>
	<td>플러스친구 아이디</td>
	<td>
		<input type="text" style="width:300px; background-color: #e2e2e2;" value="<?=$alimtalk['plusFriendId']?>" readonly/>
		<? if ($alimtalk['plusFriendId'] && $alimtalk['profileKey']) { ?>
		<a href="javascript:profileKeyDelete();"><img src="../img/btn_plusFriend_del.png" border="0" hspace="2" align="absmiddle"/></a>
		<? } else { ?>
		<a href="javascript:popupLayer('kakaoPlusFriend.php',700,400)"><img src="../img/btn_plusFriend_add.png" border="0" hspace="2" align="absmiddle"/></a>
		<?}?>

		<div class="extext" style="margin-top:5px;">
			알림톡을 사용하시려면 발신프로필키가 필요합니다.<br>발신프로필키는 카카오톡 플러스친구 아이디 등록을 하여 발급받을 수 있습니다.<br>
			카카오톡 플러스친구 아이디가 없다면 <a href="https://center-pf.kakao.com/login" class="extext" style="font-weight:bold" target="_blank">[카카오톡 플러스친구 관리자]</a>에서 발급받은 후 등록해주세요.
		</div>
	</td>
</tr>
<tr>
	<td>발신프로필키</td>
	<td>
		<input type="text" style="width:300px; background-color: #e2e2e2;" value="<?=$alimtalk['profileKey']?>" readonly/>
	</td>
</tr>
</table>

<form name="form" method="post" action="indb.php">
<input type="hidden" name="mode" value="config">
<div class="title">알림톡 사용 설정</div>

<table class="tb">
<col class="cellC"><col class="cellL">
<tr>
	<td>알림톡 사용 설정</td>
	<td>
		<input type="radio" name="use" value="y" <?=$checked['use']['y']?> <?=$disabled['use']?> onclick="useCheck();">사용함
		<input type="radio" name="use" value="n" <?=$checked['use']['n']?> <?=$checked['use']['']?> onclick="useCheck();">사용안함
		<div class="extext" style="margin-top:5px;">
			<font color="red">카카오 알림톡 발송 시 1건당 SMS 0.6포인트가 차감됩니다.</font><br>
			SMS 포인트가 없을 경우 카카오 알림톡은 발송 되지 않습니다. <a href="../member/sms.pay.php" class="extext" style="font-weight:bold" target="_blank">[SMS 포인트충전 바로가기]</a><br>
			카카오 알림톡 발신프로필키를 받은 후 최소 1시간이 경과해야 정상적으로 사용이 가능합니다.
		</div>
	</td>
</tr>
</table>

<div class="title">알림톡 발송조건 / 문구 설정</div>

<div id="container">
	<ul class="tabs">
		<li class="active" rel="tab1">주문관련</li>
		<li rel="tab2">회원관련</li>
		<li rel="tab3">게시판관련</li>
	</ul>
	<div class="tab_container">
		<div id="tab1" class="tab_content">
			<ul>
				<table class="tb">
				<col class="cellC"><col class="cellL">
				<tr>
					<td>주문관련 메시지<br>알림톡으로 사용</td>
					<td id="use_order">
						<input type="radio" name="order_use" value="y" <?=$checked['order_use']['y']?>>사용함
						<input type="radio" name="order_use" value="n" <?=$checked['order_use']['n']?> <?=$checked['order_use']['']?>>사용안함
						<div class="extext" style="margin-top:5px;">
							알림톡으로 사용 시 자동 SMS 는 발송되지 않습니다.<br>
							카카오톡 미설치 등으로 알림톡 발송 실패 시 SMS/LMS로 동일 메시지가 재발송됩니다.
						</div>
					</td>
					<td id="not_use_order" style="display:none;">
						<div style="margin-top:5px; color:red">
							* 알림톡 사용 설정을 ‘사용함’으로 변경하셔야 알림톡을 발송할 수 있습니다.
						</div>
					</td>
				</tr>
				</table>

				<table class="cfg">
				<tr style="background:#f6f6f6;">
					<td rowspan="2" style="width: 156px;">발송항목</td>
					<td rowspan="2" style="width: 156px;">추가설정</td>
					<td colspan="2">발송대상 및 알림톡 문구설정</td>
				</tr>
				<tr style="background:#f6f6f6;">
					<td style="width: 242px;">회원</td>
					<td style="width: 242px;">관리자/추가관리자</td>
				</tr>
				<tr>
					<td>주문접수시 발송<br><span style="color: #0074ba;">(무통장주문만 해당)</span></td>
					<td>발송대상 : 최근 
						<select name="order[sendDate]">
							<? for($i=0; $i<count($selectDate); $i++) {?>
							<option value="<?=$selectDate[$i]?>" <?=$selected['order']['sendDate'][$selectDate[$i]]?>><?=$selectDate[$i]?>일</option>
							<?}?>
						</select>주문건만
					</td>
					<td style="vertical-align:top">
						<textarea id="order_mem_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$orderTemplate[$alimtalk['order']['memTemplate']]['contents']?></textarea>
						<select name="order[memTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'order_mem_contents');">
							<option value="">= 발송 템플릿 변경 =</option>
							<?foreach ($orderTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['order']['memTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="order[send_c]" <?=$checked['order']['send_c']?>>자동발송</div>
					</td>
					<td style="vertical-align:top">
						<textarea id="order_admin_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$orderTemplate[$alimtalk['order']['adminTemplate']]['contents']?></textarea>
						<select name="order[adminTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'order_admin_contents');">
							<option value="">= 발송 템플릿 변경 =</option>
							<?foreach ($orderTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['order']['adminTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="order[send_a]" <?=$checked['order']['send_a']?>>관리자에게도 자동발송</div>
						<div style="text-align:left;"><input type="checkbox" name="order[send_m]" <?=$checked['order']['send_m']?>>추가관리자에게도 자동발송</div>
					</td>
				</tr>
				<tr>
					<td>입금확인시 발송<br><span style="color: #0074ba;">(무통장입금확인, 카드결제승인시 발송)</span></td>
					<td>발송대상 : 최근 
						<select name="incash[sendDate]">
							<? for($i=0; $i<count($selectDate); $i++) {?>
							<option value="<?=$selectDate[$i]?>" <?=$selected['incash']['sendDate'][$selectDate[$i]]?>><?=$selectDate[$i]?>일</option>
							<?}?>
						</select>주문건만
					</td>
					<td style="vertical-align:top">
						<textarea id="incash_mem_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$orderTemplate[$alimtalk['incash']['memTemplate']]['contents']?></textarea>
						<select name="incash[memTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'incash_mem_contents');">
							<option value="">= 발송 템플릿 변경 =</option>
							<?foreach ($orderTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['incash']['memTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="incash[send_c]" <?=$checked['incash']['send_c']?> >자동발송</div>
					</td>
					<td style="vertical-align:top">
						<textarea id="incash_admin_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$orderTemplate[$alimtalk['incash']['adminTemplate']]['contents']?></textarea>
						<select name="incash[adminTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'incash_admin_contents');">
							<option value="">= 발송 템플릿 변경 =</option>
							<?foreach ($orderTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['incash']['adminTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="incash[send_a]" <?=$checked['incash']['send_a']?> >관리자에게도 자동발송</div>
						<div style="text-align:left;"><input type="checkbox" name="incash[send_m]" <?=$checked['incash']['send_m']?> >추가관리자에게도 자동발송</div>
					</td>
				</tr>
				<tr>
					<td>입금요청 발송<br><span style="color: #0074ba;">(무통장주문만 해당, 주문접수시 발송)</span></td>
					<td>발송대상 : 최근 
						<select name="account[sendDate]">
							<? for($i=0; $i<count($selectDate); $i++) {?>
							<option value="<?=$selectDate[$i]?>" <?=$selected['account']['sendDate'][$selectDate[$i]]?>><?=$selectDate[$i]?>일</option>
							<?}?>
						</select>주문건만<br><br>
						<input type="checkbox" name="account[useAccountAutoSend]" value='y' <?=$checked['account']['useAccountAutoSend']?>> 주문 
						<select name="account[afterDate]">
							<?for ($i=1; $i<8; $i++) {?>
							<option value="<?=$i?>" <?=$selected['account']['afterDate'][$i]?>><?=$i?>일</option>
							<?}?>
						</select> 후 
						<select name="account[accountSendTime]">
							<?for ($i=8; $i<22; $i++) {?>
							<option value="<?=$i?>" <?=$selected['account']['accountSendTime'][$i]?>><?=$i?>시</option>
							<?}?>
						</select>에 추가발송
					</td>
					<td style="vertical-align:top">
						<textarea id="account_mem_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$orderTemplate[$alimtalk['account']['memTemplate']]['contents']?></textarea>
						<select name="account[memTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'account_mem_contents');">
							<option value="">= 발송 템플릿 변경 =</option>
							<?foreach ($orderTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['account']['memTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="account[send_c]" <?=$checked['account']['send_c']?> >자동발송</div>
					</td>
					<td style="color:EA0095;">
						회원전용
					</td>
				</tr>
				<tr>
					<td>상품배송시 발송<br><span style="color: #0074ba;">(배송중 상태로 변경시 발송)</span></td>
					<td>발송대상 : 최근 
						<select name="delivery[sendDate]">
							<? for($i=0; $i<count($selectDate); $i++) {?>
							<option value="<?=$selectDate[$i]?>" <?=$selected['delivery']['sendDate'][$selectDate[$i]]?>><?=$selectDate[$i]?>일</option>
							<?}?>
						</select>주문건만
					</td>
					<td style="vertical-align:top">
						<textarea id="delivery_mem_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$orderTemplate[$alimtalk['delivery']['memTemplate']]['contents']?></textarea>
						<select name="delivery[memTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'delivery_mem_contents');">
							<option value="">= 발송 템플릿 변경 =</option>
							<?foreach ($orderTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['delivery']['memTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="delivery[send_c]" <?=$checked['delivery']['send_c']?> >자동발송</div>
					</td>
					<td style="color:EA0095;">
						회원전용
					</td>
				</tr>
				<tr>
					<td>송장번호 발송<br><span style="color: #0074ba;">(배송중 상태로 변경시 발송)</span></td>
					<td>발송대상 : 최근 
						<select name="dcode[sendDate]">
							<? for($i=0; $i<count($selectDate); $i++) {?>
							<option value="<?=$selectDate[$i]?>" <?=$selected['dcode']['sendDate'][$selectDate[$i]]?>><?=$selectDate[$i]?>일</option>
							<?}?>
						</select>주문건만
					</td>
					<td style="vertical-align:top">
						<textarea id="dcode_mem_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$orderTemplate[$alimtalk['dcode']['memTemplate']]['contents']?></textarea>
						<select name="dcode[memTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'dcode_mem_contents');">
							<option value="">= 발송 템플릿 변경 =</option>
							<?foreach ($orderTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['dcode']['memTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="dcode[send_c]" <?=$checked['dcode']['send_c']?> >자동발송</div>
					</td>
					<td style="color:EA0095;">
						회원전용
					</td>
				</tr>
				<tr>
					<td>주문취소시 발송<br><span style="color: #0074ba;">(주문취소 상태로 변경시 발송)</span></td>
					<td>발송대상 : 최근 
						<select name="cancel[sendDate]">
							<? for($i=0; $i<count($selectDate); $i++) {?>
							<option value="<?=$selectDate[$i]?>" <?=$selected['cancel']['sendDate'][$selectDate[$i]]?>><?=$selectDate[$i]?>일</option>
							<?}?>
						</select>주문건만
					</td>
					<td style="vertical-align:top">
						<textarea id="cancel_mem_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$orderTemplate[$alimtalk['cancel']['memTemplate']]['contents']?></textarea>
						<select name="cancel[memTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'cancel_mem_contents');">
							<option value="">= 발송 템플릿 변경 =</option>
							<?foreach ($orderTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['cancel']['memTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="cancel[send_c]" <?=$checked['cancel']['send_c']?> >자동발송</div>
					</td>
					<td style="color:EA0095;">
						회원전용
					</td>
				</tr>
				<tr>
					<td>환불완료시 발송</td>
					<td>발송대상 : 최근 
						<select name="repay[sendDate]">
							<? for($i=0; $i<count($selectDate); $i++) {?>
							<option value="<?=$selectDate[$i]?>" <?=$selected['repay']['sendDate'][$selectDate[$i]]?>><?=$selectDate[$i]?>일</option>
							<?}?>
						</select>주문건만
					</td>
					<td style="vertical-align:top">
						<textarea id="repay_mem_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$orderTemplate[$alimtalk['repay']['memTemplate']]['contents']?></textarea>
						<select name="repay[memTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'repay_mem_contents');">
							<option value="">= 발송 템플릿 변경 =</option>
							<?foreach ($orderTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['repay']['memTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="repay[send_c]" <?=$checked['repay']['send_c']?> >자동발송</div>
					</td>
					<td style="color:EA0095;">
						회원전용
					</td>
				</tr>
				<tr>
					<td>상품품절시 발송</td>
					<td></td>
					<td style="color:EA0095;">
						관리자전용
					</td>
					<td style="vertical-align:top">
						<textarea id="runout_admin_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$orderTemplate[$alimtalk['runout']['adminTemplate']]['contents']?></textarea>
						<select name="runout[adminTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'runout_admin_contents');">
							<option value="">= 발송 템플릿 변경 =</option>
							<?foreach ($orderTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['runout']['adminTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="runout[send_a]" <?=$checked['runout']['send_a']?> >관리자에게도 자동발송</div>
						<div style="text-align:left;"><input type="checkbox" name="runout[send_m]" <?=$checked['runout']['send_m']?> >추가관리자에게도 자동발송</div>
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
					<td>회원관련 메시지<br>알림톡으로 사용</td>
					<td id="use_member">
						<input type="radio" name="member_use" value="y" <?=$checked['member_use']['y']?>>사용함
						<input type="radio" name="member_use" value="n" <?=$checked['member_use']['n']?> <?=$checked['member_use']['']?>>사용안함
						<div class="extext" style="margin-top:5px;">
							알림톡으로 사용 시 자동 SMS 는 발송되지 않습니다.<br>
							카카오톡 미설치 등으로 알림톡 발송 실패 시 SMS/LMS로 동일 메시지가 재발송됩니다.
						</div>
					</td>
					<td id="not_use_member" style="display:none;">
						<div style="margin-top:5px; color:red">
							* 알림톡 사용 설정을 ‘사용함’으로 변경하셔야 알림톡을 발송할 수 있습니다.
						</div>
					</td>
				</tr>
				</table>

				<table class="cfg">
				<tr style="background:#f6f6f6;">
					<td rowspan="2" style="width: 156px;">발송항목</td>
					<td rowspan="2" style="width: 156px;">추가설정</td>
					<td colspan="2">발송대상 및 알림톡 문구설정</td>
				</tr>
				<tr style="background:#f6f6f6;">
					<td style="width: 242px;">회원</td>
					<td style="width: 242px;">관리자/추가관리자</td>
				</tr>
				<tr>
					<td>회원가입시 발송</td>
					<td></td>
					<td style="vertical-align:top">
						<textarea id="join_mem_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$memberTemplate[$alimtalk['join']['memTemplate']]['contents']?></textarea>
						<select name="join[memTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'join_mem_contents');">
							<option value="">= 발송 템플릿 변경 =</option>
							<?foreach ($memberTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['join']['memTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="join[send_c]" <?=$checked['join']['send_c']?>>자동발송</div>
					</td>
					<td style="vertical-align:top">
						<textarea id="join_admin_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$memberTemplate[$alimtalk['join']['adminTemplate']]['contents']?></textarea>
						<select name="join[adminTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'join_admin_contents');">
							<option value="">= 발송 템플릿 변경 =</option>
							<?foreach ($memberTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['join']['adminTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="join[send_a]" <?=$checked['join']['send_a']?>>관리자에게도 자동발송</div>
						<div style="text-align:left;"><input type="checkbox" name="join['send_m']" <?=$checked['join']['send_m']?>>추가관리자에게도 자동발송</div>
					</td>
				</tr>
				<tr>
					<td>비밀번호찾기시 발송</td>
					<td></td>
					<td style="vertical-align:top">
						<textarea id="id_pass_mem_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$memberTemplate[$alimtalk['id_pass']['memTemplate']]['contents']?></textarea>
						<select name="id_pass[memTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'id_pass_mem_contents');">
							<option value="">= 발송 템플릿 변경 =</option>
							<?foreach ($memberTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['id_pass']['memTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="id_pass[send_c]" <?=$checked['id_pass']['send_c']?> >자동발송</div>
					</td>
					<td style="color:EA0095;">
						회원전용
					</td>
				</tr>
				<tr>
					<td>휴면 전환 사전 안내 발송</td>
					<td>발송대상 : 휴면회원 전환<br>
						<input type="checkbox" name="dormant[sendBeforeDay_30]" value='y' <?=$checked['dormant']['sendBeforeDay_30']?>> 한달 전,<br>
						<input type="checkbox" name="dormant[sendBeforeDay_7]" value='y' <?=$checked['dormant']['sendBeforeDay_7']?>> 일주일 전 발송<br>
						발송시점 : 매일 
						<select name="dormant[sendTime]">
							<?for ($i=8; $i<22; $i++) {?>
							<option value="<?=$i?>" <?=$selected['dormant']['sendTime'][$i]?>><?=$i?>시</option>
							<?}?>
						</select> 발송
					</td>
					<td style="vertical-align:top">
						<textarea id="dormant_mem_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$memberTemplate[$alimtalk['dormant']['memTemplate']]['contents']?></textarea>
						<select name="dormant[memTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'dormant_mem_contents');">
							<option value="">= 발송 템플릿 변경 =</option>
							<?foreach ($memberTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['dormant']['memTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="dormant[send_c]" <?=$checked['dormant']['send_c']?> >자동발송</div>
					</td>
					<td style="color:EA0095;">
						회원전용
					</td>
				</tr>
				<tr>
					<td>수신동의여부 확인 안내 발송</td>
					<td>발송대상 : 수신동의 후 1년 11개월이 지난 회원<br>
						발송시점 : 매일 
						<select name="reception_agreement[sendTime]">
							<?for ($i=8; $i<22; $i++) {?>
							<option value="<?=$i?>" <?=$selected['reception_agreement']['sendTime'][$i]?>><?=$i?>시</option>
							<?}?>
						</select> 발송
					</td>
					<td style="vertical-align:top">
						<textarea id="reception_agreement_mem_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$memberTemplate[$alimtalk['reception_agreement']['memTemplate']]['contents']?></textarea>
						<select name="reception_agreement[memTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'reception_agreement_mem_contents');">
							<option value="">= 발송 템플릿 변경 =</option>
							<?foreach ($memberTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['reception_agreement']['memTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="reception_agreement[send_c]" <?=$checked['reception_agreement']['send_c']?> >자동발송</div>
					</td>
					<td style="color:EA0095;">
						회원전용
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
					<td>게시판관련 메시지<br>알림톡으로 사용</td>
					<td id="use_board">
						<input type="radio" name="board_use" value="y" <?=$checked['board_use']['y']?>>사용함
						<input type="radio" name="board_use" value="n" <?=$checked['board_use']['n']?> <?=$checked['board_use']['']?>>사용안함
						<div class="extext" style="margin-top:5px;">
							알림톡으로 사용 시 자동 SMS 는 발송되지 않습니다.<br>
							카카오톡 미설치 등으로 알림톡 발송 실패 시 SMS/LMS로 동일 메시지가 재발송됩니다.
						</div>
					</td>
					<td id="not_use_board" style="display:none;">
						<div style="margin-top:5px; color:red">
							* 알림톡 사용 설정을 ‘사용함’으로 변경하셔야 알림톡을 발송할 수 있습니다.
						</div>
					</td>
				</tr>
				</table>

				<table class="cfg">
				<tr style="background:#f6f6f6;">
					<td rowspan="2" style="width: 156px;">발송항목</td>
					<td rowspan="2" style="width: 156px;">추가설정</td>
					<td colspan="2">발송대상 및 알림톡 문구설정</td>
				</tr>
				<tr style="background:#f6f6f6;">
					<td style="width: 242px;">회원</td>
					<td style="width: 242px;">관리자/추가관리자</td>
				</tr>
				<tr>
					<td>1:1문의와 상품문의 등록시 발송<br><span style="color: #0074ba;">(작성시 핸드폰번호를 입력한 고객에게만 발송)</span></td>
					<td></td>
					<td style="vertical-align:top;">
						<textarea id="qna_register_mem_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$boardTemplate[$alimtalk['qna_register']['memTemplate']]['contents']?></textarea>
						<select name="qna_register[memTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'qna_register_mem_contents');">
							<option value="">= 발송 템플릿 변경 =</option>
							<?foreach ($boardTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['qna_register']['memTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="qna_register[send_c]" <?=$checked['qna_register']['send_c']?>>자동발송</div>
					</td>
					<td style="vertical-align:top;">
						<textarea id="qna_register_admin_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$boardTemplate[$alimtalk['qna_register']['adminTemplate']]['contents']?></textarea>
						<select name="qna_register[adminTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'qna_register_admin_contents');">
							<option value="">= 발송 템플릿 변경 =</option>
							<?foreach ($boardTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['qna_register']['adminTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="qna_register[send_a]" <?=$checked['qna_register']['send_a']?>>관리자에게도 자동발송</div>
						<div style="text-align:left;"><input type="checkbox" name="qna_register[send_m]" <?=$checked['qna_register']['send_m']?>>추가관리자에게도 자동발송</div>
					</td>
				</tr>
				<tr>
					<td>1:1문의 답변등록시 발송</td>
					<td></td>
					<td style="vertical-align:top">
						<textarea id="qna_mem_contents" style="width:100%; height:132px; background-color:#fefcea"><?=$boardTemplate[$alimtalk['qna']['memTemplate']]['contents']?></textarea>
						<select name="qna[memTemplate]" style="margin-top:5px; width:100%;" onchange="templateContents(this.value,'qna_mem_contents');">
							<option value="">= 발송 템플릿 변경 =</option>
							<?foreach ($boardTemplate as $k => $v) {?>
							<option value="<?=$k?>" <?=$selected['qna']['memTemplate'][$k]?>><?=$v['name']?></option>
							<?}?>
						</select>
						<div style="text-align:left; margin-top:5px;" ><input type="checkbox" name="qna[send_c]" <?=$checked['qna']['send_c']?> >자동발송</div>
					</td>
					<td style="color:EA0095;">
						회원전용
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
	if (confirm('플러스친구 아이디를 삭제하면 카카오 알림톡을 사용할 수 없습니다. 등록된 템플릿 및 관련 설정들도 모두 삭제됩니다. 계속하시겠습니까?')) {
		var ajax = new Ajax.Request("indb.php",
		{
			method: "post",
			parameters: "mode=profileDelete",
			onComplete: function (req)
			{
				var res = req.responseText;
				if (res == 'success') {
					alert('플러스친구 아이디를 삭제하였습니다.');
					window.location.reload();
				}
				else {
					alert('플러스친구 아이디 삭제를 실패하였습니다. 잠시 후 다시 시도해주세요.');
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