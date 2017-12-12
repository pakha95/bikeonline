<?php
$location = '��Ÿ���� > �ֹ��� ���� �α� ����';
include '../_header.php';

//PG CARD NUMBER �α� ���� ����
$pgCardLogRemove = array();
if(!is_object($config)){
	$config = Core::loader('config');
}
$pgCardLogRemove = $config->load('pgCardLogRemove');
?>
<style type="text/css">
.pgCardLogRemove-infoLayout {
	border: solid #000 1px;
	padding: 15px 0px 15px 15px;
	margin: 10px 0px 30px 0px;
}
.pgCardLogRemove-infoLayout-title {
	font-weight: bold;
}
.pgCardLogRemove-infoLayout-content {
	margin-left: 15px;
	color: #666666;
}
.pgCardLogRemove-infoLayout-content-node {
	margin-top: 10px;
}
.pgCardLogRemove-infoLayout-content-node span{
	color: red;
	font-weight: bold;
}
</style>

<div class="title title_top">�ֹ��� ���� �α� ����</div>

<div class="pgCardLogRemove-infoLayout">
	<div class="pgCardLogRemove-infoLayout-title">�� ����������ȣ��, ������Ÿ��� �ؼ� ��� �ȳ�</div>
	<div class="pgCardLogRemove-infoLayout-content">
		<div>���������� ����� ������ ��ȣ��ġ ���� �� 6�� (���������� ��ȣȭ) �� �ǰ��Ͽ� �������� �ſ�ī���ȣ�� ������ �� ������, �����Ϸ��� ��ȣȭ�Ͽ� �����ؾ� �մϴ�.</div>
		<div class="pgCardLogRemove-infoLayout-content-node">
			<div>2016�� 1�� 28�� �� ���� �����ǵ鿡 ���ؼ��� �ֹ��� �����α׿� �ſ�ī�� ������ �������� �ʵ��� ó���ǰ� �ֽ��ϴ�.</div>
			<div>�ٸ�, <span>2016�� 1�� 28�� �� ���� �����ǵ鿡 ���� �ֹ��� �����α׿��� �̹� �ſ�ī�� ��ȣ�� ���� �� ��µǰ� �����Ƿ�, ������ ���� �����α׿��� �ſ�ī�� ��ȣ�� �ϰ� ������ �ֽñ� �ٶ��ϴ�.</span></div>
		</div>
	</div>
</div>

<table class="admin-form-table">
<tr>
	<th style="width: 150px;">�ſ�ī�� ��ȣ �ϰ�����</th>
	<td>
		<?php if($pgCardLogRemove['pgCardLogRemove'] != 'y'){ ?>
		<div><img src="../img/btn_cardNumber_del.png" border="0" class="hand" style="vertical-align: bottom;" id="cardLogSubmitButton" /> <span class="extext">2016�� 1�� 28�� ���� �ֹ����� �����α׿��� �ſ�ī�� ��ȣ�� �ϰ����� �մϴ�.</span></div>
		<div style="margin-top: 3px; color: red;">�� �ϰ����� �� ����ġ ���� ������ ���Ͽ� ó���� �ߴܵ� ��� �ٽ� �õ��Ͽ� ������ �Ϸ����ּ���.</div>
		<?php } else { ?>
		<span style="font:13px dotum; color: #627dce; font-weight: bold;">�̹� �����α׿��� �ſ�ī�� ��ȣ�� ���� �Ϸ�� �����Դϴ�.</span>
		<?php } ?>
	</td>
</tr>
</table>

<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery("#cardLogSubmitButton").click( function(){
		if(confirm("�����α׿��� �ſ�ī�� ��ȣ ������ ��� �����˴ϴ�.\n����Ͻðڽ��ϱ�?")){
			jQuery(window).bind("beforeunload",function(e){
				var nav = navigator.userAgent.toLowerCase();
				var event = e || window.event;
				var message = "�����α׿��� �ſ�ī�� ��ȣ ������ �������Դϴ�.\n���ΰ�ħ�� �ϰų� �������� ���� ��� ����ó�� ���� ���� �� �ֽ��ϴ�.\n����Ͻðڽ��ϱ�?";

				if(nav.indexOf("chrome") != -1 || nav.indexOf("firefox") != -1){
					return message;

					if(nav.indexOf("safari") != -1) return false;
					eventStop(event);
				}
				else {
					if(!confirm(message)) {
						if(nav.indexOf("safari") != -1) return false;
						eventStop(event);
					}
				}
			});

			showCardLogProgressBar();

			var ajaxTransfer =  jQuery.ajax({
				method: "POST",
				url: "adm_basic_pgCardLogRemove.indb.php",
				data: { mode: 'remove'}
			});
			ajaxTransfer.done(function( resultMessage ) {
				alert(resultMessage);
				window.location.reload();
			});
			ajaxTransfer.fail(function() {
				alert("��ſ����� �߻��Ͽ����ϴ�.\n�ٽ��ѹ� �õ��Ͽ� �ּ���.");
			});
			ajaxTransfer.always(function() {
				jQuery(window).unbind("keydown beforeunload");
				hiddenCardLogProgressBar();
			});
		}
	});

	function showCardLogProgressBar(){
		var progressImgMarginTop = Math.round((jQuery(window).height() - 116) / 2);

		jQuery("body").append('<div id="cardLogProgressBar" style="position:absolute;top:0;left:0;background:#44515b;filter:alpha(opacity=80);opacity:0.8;width:100%;height:'+jQuery('body').height()+'px;cursor:progress;z-index:100000;margin:0 auto;text-align: center;"><img src="../img/admin_progress.gif" border="0" style="margin-top:'+progressImgMarginTop+'px;" /></div>');
	}

	function hiddenCardLogProgressBar(){
		jQuery("#cardLogProgressBar").remove();
	}

	function eventStop(event){
		if(event.preventDefault){
			event.preventDefault();
		}
		else {
			event.returnValue = false;
		}
	}
});
</script>

<?php include '../_footer.php'; ?>