<?php /* Template_ 2.2.7 2015/06/24 15:09:09 /www/jbsinttr8192_godo_co_kr/shop/data/skin/damoashop/popup/move.htm 000004096 */  $this->include_("dataBoardArticle");?>
<TABLE cellpadding="0" cellspacing="0" border="0">
<TR>
	<TD style="background: URL('/shop/data/skin/damoashop/img/main/popup_top_left.gif') no-repeat;" nowrap width="12" height="33"></TD>
	<TD style="background: URL('/shop/data/skin/damoashop/img/main/popup_top_bg.gif') repeat-x;" align="right"><img src="/shop/data/skin/damoashop/img/main/popup_bu_close.gif" onclick="_ID('<?php echo $_GET['code']?>').style.display='none'" style="cursor:pointer; display:block; user-drag: none; -moz-user-select: none; -webkit-user-drag: none;" ondragstart="return false" /></TD>
	<TD style="background: URL('/shop/data/skin/damoashop/img/main/popup_top_right.gif') no-repeat;" nowrap width="12" height="33"></TD>
</TR>
<TR>
	<TD style="background: URL(/shop/data/skin/damoashop/img/main/popup_left_bg.gif) repeat-y;" nowrap width="12"></TD>
	<TD>
	<!-- 팝업내용 : Start -->	

	<TABLE cellpadding="0" cellspacing="0" border="0" >
	<TR>
		<!--백그라운드 제어되는 부분-->
		
		<!--<TD style="background:url(/shop/data/skin/damoashop/img/main/notice_bg.gif);">img src="/shop/data/skin/damoashop/img/main/popup_01.gif" style="display:block; user-drag: none; -moz-user-select: none; -webkit-user-drag: none;" ondragstart="return false" /-->
		<TD style="background:#fff;">	
		<!-- 게시판 리스트 -->
			
			<p  style="width:350px; background:#fa3e0c; padding:5px 0 0 10px;"><!--<span style="color:#ff8000;">▼&nbsp;</span>--><span style="color:#ffff00;font-weight:bold;font-size:14px;line-height:2em;"><!--img src="/shop/data/skin/damoashop/img/main/notice_bar.gif"--> 바이크온라인 새소식</span>
				<span style="float:right; margin-right:10px;"><a href="<?php echo url("board/list.php?")?>&id=notice" style="color:#fff;line-height:2em;">more<!--<img src="/shop/data/skin/damoashop/img/main/notice_bu_more.gif">--></a></span></p>
 			
			<table style="margin:3px 10px;" cellpadding=0 cellspacing=0 border=0  width="340px" >
<?php if((is_array($TPL_R1=dataBoardArticle('notice', 12))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?>
				<tr>
					<td style=" border-bottom:1px dotted #ccc;">						
						<!--<div style="padding-top:3px"></div>-->
						<span style="float:left; color:#000;font-weight:bold; line-height:2em;"><a href="<?php echo url("board/view.php?")?>&id=<?php echo $TPL_V1["id"]?>&no=<?php echo $TPL_V1["no"]?>">- <?php echo strcut($TPL_V1["subject"], 42)?></a></span><span style="float:right; color:#000; font-weight:bold; line-height:2em;"><?php echo substr($TPL_V1["regdt"], 2, 9)?></span>
						<!--<div style="border:1px solid #E4E4E4; padding:1">--><img src="../data/board/notice/t/<?php echo $TPL_V1["imgnm"]?>" width=60 height=40 onerror=this.style.display='none' onClick="popupImg('../data/board/notice/<?php echo $TPL_V1["imgnm"]?>')" style="border:1px solid #ebebeb; margin:5px;"></td>
					<!--<td width=15>&nbsp;&nbsp;</td>-->
				</tr>
			<tr><!--<tr><td height=4></td></tr>-->
<?php }}?>
 			</table>
		</TD>
	</TR>
	<tr>
		<td height=21 background="/shop/data/skin/damoashop/img/main/popup_02.gif" align="right" class="stxt"><font color="#FFFFFF"><b>오늘 하루 보이지 않음</b></font><input type="checkbox" style="cursor:pointer;" onClick="controlCookie( '<?php echo $_GET['code']?>', this );"></td>
	</tr>
	</TABLE>

	<!-- 팝업내용 : End -->
	</TD>
	<TD style="background: URL(/shop/data/skin/damoashop/img/main/popup_right_bg.gif) repeat-y;" nowrap width="12"></TD>
</TR>
<TR>
	<TD style="background: URL(/shop/data/skin/damoashop/img/main/popup_bottom_left.gif) no-repeat;" nowrap width="12" height="12"></TD>
	<TD style="background: URL(/shop/data/skin/damoashop/img/main/popup_bottom_bg.gif) repeat-x;"></TD>
	<TD style="background: URL(/shop/data/skin/damoashop/img/main/popup_bottom_right.gif) no-repeat;" nowrap width="12" height="12"></TD>
</TR>
</TABLE>