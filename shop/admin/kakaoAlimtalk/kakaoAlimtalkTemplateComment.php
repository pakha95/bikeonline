<?
include "../_header.popup.php";
include "../../lib/kakaoAlimtalkAPI.class.php";

$get = $_GET;

$kakaoAlimtalk = new kakaoAlimtalk();
$templateData = $kakaoAlimtalk->getTemplateData($get['code']);

$kakaoAlimtalkAPI = new kakaoAlimtalkAPI();
$status = $kakaoAlimtalkAPI->templateStatus($get);

$diviLine = '--------------------------------------------------------------';
foreach($status['data']['comments'] as $v) {
	$createdAt = explode('.',$v['createdAt']);
	if ($v['status'] == 'INQ') $status = '����';
	else if ($v['status'] == 'APR') $status = '����';
	else if ($v['status'] == 'REJ') $status = '�ݷ�';
	else if($v['status'] == 'REP') $status = '�亯';

	$msg .= $createdAt[0]."\n".$diviLine."\n";
	if($v['status']  == 'REP') $msg .= '�ۼ��� : '.$v['userName']."\n";
	$msg .= '���� : '.$status."\n";
	$msg .= '���� : '.$v['content']."\n".$diviLine."\n\n";
}

?>
<div class="title title_top">īī�� �˸��� ���ø� �˼� ����/�亯 Ȯ��</div>

<form name="form" method="post" action="indb.php">
<input type="hidden" name="mode" value="templateComment">
<input type="hidden" name="code" value="<?=$get['code']?>">
<table class="tb" width="100%">
<col class="cellC"><col class="cellL">
<tr>
	<td>���ǳ���</td>
	<td>
		<textarea name="comment" style="width:100%; height:100px;"></textarea>
	</td>
</tr>
</table>

<div class="button">
	<input type="image" src="../img/btn_register.gif">
	<a href="javascript:parent.closeLayer();"><img src="../img/btn_cancel.gif" /></a>
</div>

<table class="tb" width="100%">
<col class="cellC"><col class="cellL">
<tr>
	<td>����/�亯 �α�</td>
	<td>
		<textarea style="width:100%; height:300px;"><?=$msg?></textarea>
	</td>
</tr>
</table>
</form>