<?
/*------------------------------------------------------------------------------
�� Copyright 2005, Flyfox All right reserved.
@���ϳ���: �������ڵ��� > ���̾ƿ� > �ܰ��κе�����
@��������/������/������:
------------------------------------------------------------------------------*/
?>

<div style="padding-top:10;"></div>

<form method="post" name="fm" action="../todayshop/codi/indb.php?mode=save&design_file=<?=$_GET['design_file']?>" onsubmit="return chkForm( this );" enctype="multipart/form-data">
<input type="hidden" name="linkurl" value="<?=$data_file['linkurl']?>">

<?
if ($todayShop->cfg['shopMode'] == "todayshop") {
@include_once dirname(__FILE__) . "/_codi_map.php";
?>

<div style="margin:17px 0;">
<table class=tb>
<col class=cellC><col class=cellL>
<tr>
	<td>���ϼ���</td>
	<td><input type="text" name="text" value="<?=$data_file['text']?>" size="50" class="line"></td>
</tr>
<? if ( dirname( $_GET['design_file'] ) == 'outline/header' ){ ?>
<tr>
	<td>����̹���</td>
	<td>
		<input type="file" name="inbg_img_up" size="50" class="line"><input type="hidden" name="inbg_img" value="<?=$data_file['inbg_img']?>">
		<a href="javascript:webftpinfo( '<?=( $data_file['inbg_img'] != '' ? '/data/skin_today/' . $cfg['tplSkinTodayWork'] . '/img/codi/' . $data_file['inbg_img'] : '' )?>' );"><img src="../img/codi/icon_imgview.gif" border="0" alt="�̹��� ����" align="absmiddle"></a>
		<? if ( $data_file['inbg_img'] != '' ){ ?>&nbsp;&nbsp;<span class="noline"><input type="checkbox" name="inbg_img_del" value="Y">����</span><? } ?>
	</td>
</tr>
<? } ?>
</table>
</div>


<?
}
else {
?>
<div style="margin:17px 0;">
<table class=tb>
<tr>
	<td width=50>���ϼ���</td>
	<td colspan="3"><input type="text" name="text" value="<?=$data_file['text']?>" class="line"></td>
</tr>
</table>
</div>
<?
}

@include_once dirname(__FILE__) . "/_codi_info.php"; # ��������
?>


<?
{ // �������ڵ���

	$tmp = array();
	$tmp['t_name']		= 'content';
	$tmp['t_width']		= '100%';
	$tmp['t_rows']		= 40;
	$tmp['t_property']	= ' required label="HTML �ҽ�"';
	$tmp['tplFile']		= "/" . $_GET['design_file'];

	echo "<script>DCTM.write('{$tmp['t_name']}', '{$tmp['t_width']}', '{$tmp['t_rows']}', '{$tmp['t_property']}', '{$tmp['tplFile']}');</script>";
}
?>


<div style="padding:20px" align=center class=noline>
<input type=image src="../img/btn_save.gif" alt="�����ϱ�">
<a href="javascript:;" onclick="DCSM.call( 'on' );"><img src="../img/btn_saveas.gif" border=0></a>
<a href="javascript:file_del('<?=$_GET['design_file']?>');"><img src="../img/btn_del.gif" border=0></a>
</div>


</form>