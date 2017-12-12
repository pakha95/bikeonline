<?php
include '../_header.popup.php';
include_once('../../lib/page.class.php');
include '../../lib/sms_sendlist.class.php';
include '../../lib/kakaoAlimtalk.class.php';
$sms_sendlist = new sms_sendlist();
$kakaoAlimtalk = new kakaoAlimtalk();

if(!$_GET['sms_phoneNumber']){
	msg("정보확인이 되지 않습니다.", "close");
	exit;
}

if (!$_GET['search']) {
	$_GET['search'] = 'sms';
}
$checked['search'][$_GET['search']] = 'checked';

if(!$_GET['page'])		$_GET['page'] = 1;
if(!$_GET['page_num'])	$_GET['page_num'] = 10;
$selected['page_num'][$_GET['page_num']] = " selected='selected'";

if ($_GET['search'] == 'sms') {
	$where[] = "sms_phoneNumber = '" . $_GET['sms_phoneNumber'] . "'";
	$table = GD_SMS_SENDLIST;
	$orderby = 'sms_no desc';
	$count = 'sms_no';
}
else {
	$where[] = "send_number = '" . $_GET['sms_phoneNumber'] . "'";
	$table = GD_KAKAOALIMTALK_SENDLIST;
	$orderby = 'sno desc';
	$count = 'sno';
}

$pg = new Page($_GET['page'], $_GET['page_num']);
$pg->field = " * ";
$pg->setQuery($table ,$where ,$orderby);
$pg->exec();

$result = $db->query($pg->query);

list ($total) = $db->fetch("SELECT COUNT(".$count.") FROM " . $table . ' WHERE ' . $where[0]);
?>
<style type="text/css">
.sendView-contents					{ vertical-align: top;}
#sendView-search					{ margin-top: 10px; }
#sendView							{ word-break: break-all; }
#sendView th						{ color: #333333; background: #f6f6f6; font: 9pt tahoma; text-align: center; }
#sendView tr td						{ color:#262626; font-family:Tahoma,Dotum; font-size:11px; height: 25px; text-align: center; }
.sendView-total						{ padding: 30px 0px 5px 0px; }
.sendView-TextAlignL				{ text-align: left; }
.sendView-TextAlignR				{ text-align: right; }
.sendView-btn .sendView-btn-td2		{ padding-left: 10px; }
.sendView-btn .sendView-btn-td2 img { padding-left: 10px; border: 0px; cursor: pointer; }
.sendView-phoneInfo					{ font-size:13px; }
</style>

<div class="title title_top">
	발송이력<span>SMS 및 알림톡 발송이력을 확인할 수 있습니다.</span>
</div>

<form name="sendView_SearchForm" id="sendView_SearchForm" method="get">
<input type="hidden" name="sms_phoneNumber" value="<?php echo $_GET['sms_phoneNumber']; ?>" />
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
	<td class="sendView-contents">
		<table class="tb">
		<col class="cellC"><col class="cellL">
		<tr>
			<th>수신번호</th>
			<td><?=$_GET['sms_phoneNumber']?></td>
		</tr>
		<tr>
			<th>구분</th>
			<td>
				<label><input type="radio" name="search" value="sms" <?=$checked['search']['sms']?>>SMS/LMS</label>
				<label><input type="radio" name="search" value="alimtalk" <?=$checked['search']['alimtalk']?>>알림톡</label>
			</td>
		</tr>
		</table>
		<div class="button_top"><input type="image" src="../img/btn_search2.gif" /></div>

		<table width="100%" cellpadding="0" cellspacing="0" border="0" class="sendView-total">
		<tr>
			<td class="sendView-TextAlignL">총 <?php echo $total; ?>개 / <?php echo $pg->page['total']; ?> of <?php echo $pg->page['now']; ?> Pages</td>
			<td class="sendView-TextAlignR">
				<select name="page_num" onchange="javascript:this.form.submit();">
					<option value="10" <?php echo $selected['page_num'][10]; ?>>10개 출력</option>
					<option value="20" <?php echo $selected['page_num'][20]; ?>>20개 출력</option>
					<option value="40" <?php echo $selected['page_num'][40]; ?>>40개 출력</option>
					<option value="60" <?php echo $selected['page_num'][60]; ?>>60개 출력</option>
					<option value="100" <?php echo $selected['page_num'][100]; ?>>100개 출력</option>
				</select>
			</td>
		</tr>
		</table>

		<table width="100%" cellpadding="0" cellspacing="0" border="0" id="sendView" class="tb">
		<colgroup>
			<col width="7%" />
			<col width="20%" />
			<col width="40%" />
			<col width="13%" />
			<col width="20%" />
		</colgroup>
		<tr>
			<th>번호</th>
			<th>발송시간</th>
			<th>제목+메시지</th>
			<th>발송결과</th>
			<th>실패사유</th>
		</tr>

		<?php
		while ($data = $db->fetch($result, 1)){
			/*
			$smsLog = array();
			$sendDate = $msg = $smsResultStatus = $smsFailMsg = ' - ';

			$smsLog = $db->fetch(" SELECT regdt, reservedt, subject, msg, sms_type FROM " . GD_SMS_LOG . " WHERE sno = '" . $data['sms_logNo'] . "' LIMIT 1");

			if($data['sms_mode'] == 'i'){
				$sendDate = $smsLog['regdt'];
			}
			else {
				$sendDate = $smsLog['reservedt'];
			}

			if($smsLog['sms_type'] == 'lms'){
				$msg = '<div style="margin: 5px 0px 7px 0px;">' . $smsLog['subject'] . '</div>' . $smsLog['msg'];
			}
			else {
				$msg = $smsLog['msg'];
			}

			$smsResultStatus = $sms_sendlist->getSendListStatus($data['sms_send_status'], $data['sms_status'], $data['sms_mode'], $smsLog['reservedt']);

			if($data['sms_status'] == 'n' && $data['sms_failCode'] > 0){
				$smsErrorCode	= $sms_sendlist->errorCodeList();
				$smsFailMsg		= $smsErrorCode[$data['sms_failCode']];
			}
			*/
			if ($_GET['search'] == 'alimtalk') {
				$sendDate = $data['send_date'];
				$msg = $data['send_contents'];
				$smsResultStatus = $kakaoAlimtalk->getSendStatus($data['send_status']);
				$smsFailMsg = $kakaoAlimtalk->errorCode($data['fail_code']);
				if (!$smsFailMsg) $smsFailMsg = '-';
			}
			else {
				$smsLog = array();
				$sendDate = $msg = $smsResultStatus = $smsFailMsg = ' - ';

				$smsLog = $db->fetch(" SELECT regdt, reservedt, subject, msg, sms_type FROM " . GD_SMS_LOG . " WHERE sno = '" . $data['sms_logNo'] . "' LIMIT 1");

				if($data['sms_mode'] == 'i'){
					$sendDate = $smsLog['regdt'];
				}
				else {
					$sendDate = $smsLog['reservedt'];
				}

				// 인증번호 숨기기
				if (strpos($smsLog['msg'], "인증번호")) {
					$smsLog['msg'] = preg_replace("/([0-9]){8}/", "********", $smsLog['msg']);
				}

				if($smsLog['sms_type'] == 'lms'){
					$msg = '<div style="margin: 5px 0px 7px 0px;">' . $smsLog['subject'] . '</div>' . $smsLog['msg'];
				}
				else {
					$msg = $smsLog['msg'];
				}

				$smsResultStatus = $sms_sendlist->getSendListStatus($data['sms_send_status'], $data['sms_status'], $data['sms_mode'], $smsLog['reservedt']);

				if($data['sms_status'] == 'n' && $data['sms_failCode'] > 0){
					$smsErrorCode	= $sms_sendlist->errorCodeList();
					$smsFailMsg		= $smsErrorCode[$data['sms_failCode']];
				}
			}

		?>
		<tr>
			<td><?php echo $pg->idx--; ?></td>
			<td><?php echo $sendDate; ?></td>
			<td style="text-align: left;"><?php echo $msg; ?></td>
			<td><?php echo $smsResultStatus; ?></td>
			<td><?php echo $smsFailMsg; ?></td>
		</tr>
		<?php } ?>
		</table>

		<div class="pageNavi" align="center"><font class="ver8"><?php echo $pg->page['navi']; ?></div>
	</td>
</tr>
</table>
</form>

<script>
table_design_load();
</script>
