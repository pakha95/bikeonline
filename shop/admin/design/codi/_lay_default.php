<?
/*------------------------------------------------------------------------------
ⓒ Copyright 2005, Flyfox All right reserved.
@파일내용: 디자인코디툴 > 레이아웃 > 전체레이아웃
@수정내용/수정자/수정일:
------------------------------------------------------------------------------*/
?>

<div style="padding-top:10;"></div>

<form method="post" name="fm" action="../design/codi/indb.php?mode=save&design_file=<?=$_GET['design_file']?>" onsubmit="return chkForm( this );" enctype="multipart/form-data">


<?
@include_once dirname(__FILE__) . "/_codi_map.php";
if ($todayShop->cfg['shopMode'] != "todayshop") {
?>


<div style="margin:17px 0;">
<table class=tb>
<col class=cellC><col class=cellL>
<tr>
	<td>측면위치</td>
	<td>
		<? foreach( $sidefloat as $opt ){ ?>
		<input type="radio" name="outline_sidefloat" id="outline_sidefloat" onclick="DCMAPM.file_float(this)" value="<?=$opt['value']?>" <?=$opt['checked']?> float="<?=$opt['float']?>" class="null"> <?=$opt['text']?>
		<? } ?>
	</td>
</tr>
<tr>
	<td>전체색상</td>
	<td>
		<div>
			전체의 배경색상 <input type="text" name="outbg_color" value="<?=$data_file['outbg_color']?>" maxlength="6" style="width:100;" class="line"> <a href="javascript:colortable();"><img src="../img/codi/btn_colortable.gif" border="0" alt="색상표 보기" align="absmiddle"></a>
		</div>
		<div>
			전체의 배경이미지
			<input type="file" name="outbg_img_up" size="30" class="line"><input type="hidden" name="outbg_img" value="<?=$data_file['outbg_img']?>">
			<a href="javascript:webftpinfo( '<?=( $data_file['outbg_img'] != '' ? '/data/skin/' . $cfg['tplSkinWork'] . '/img/codi/' . $data_file['outbg_img'] : '' )?>' );"><img src="../img/codi/icon_imgview.gif" border="0" alt="이미지 보기" align="absmiddle"></a>
			<? if ( $data_file['outbg_img'] != '' ){ ?>&nbsp;&nbsp;<span class="noline"><input type="checkbox" name="outbg_img_del" value="Y">삭제</span><? } ?>
		</div>
	</td>
</tr>
</table>
</div>


<div align=center class=noline>
	<input type=image src="../img/btn_save.gif" alt="저장하기">&nbsp;&nbsp;
	<a href="javascript:file_batch();"><img src="../img/btn_applyall.gif" border=0></a>
</div>

<div style="padding: 6px 0 25px 0" align=center><font color="#627dce">※</font> <font class="extext">[일괄적용]은 모든 페이지에 적용됩니다. 신중하게 저장하세요.</font></div>

</form>


<!-- header/footer 파일수정 -->
<TABLE width=100% cellpadding=0 cellspacing=0 border=0>
<TR>
	<TD><img src="../img/codi_main_05.gif"></TD>
</TR>
<tr>
	<td style="border:10px solid #EEEEEE; padding:5 5 5 5">
	<TABLE cellpadding=7 cellspacing=0 border=0>
	<TR>
		<TD colspan=2><div>스킨소스에는 외곽을 크게 감싸고 있는 상단 헤더파일과 하단 풋터파일 두개가 있습니다.</div>
		<div style="padding-top:4px">이 두개의 파일은 크게 수정할 일이 없는 외곽파일입니다.</div>
		<div style="padding-top:4px">외곽을 수정하실때에만 수정하시기 바랍니다. 아래 두개의 파일입니다.</div></TD>
	</TR>
	<tr>
		<td width=420><img src="../img/codi_main_06.gif"></td>
		<td width=400 align=left>
		<TABLE>
		<TR>
			<TD style="padding-bottom:30"><A HREF="iframe.codi.php?design_file=outline/_header.htm"><img src="../img/btn_header.gif"></A></TD>
		</TR>
		<TR>
			<TD valign=top><A HREF="iframe.codi.php?design_file=outline/_footer.htm"><img src="../img/btn_footer.gif"></A></TD>
		</TR>
		</TABLE>
		</td>
	</tr>
	</TABLE>
	</td>
</tr>
</TABLE>
<!-- header/footer 파일수정 끝 -->
<?
}
?>