<?php /* Template_ 2.2.7 2016/11/03 13:12:05 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/board/default/view.htm 000005642 */ 
if (is_array($TPL_VAR["loop"])) $TPL_loop_1=count($TPL_VAR["loop"]); else if (is_object($TPL_VAR["loop"]) && in_array("Countable", class_implements($TPL_VAR["loop"]))) $TPL_loop_1=$TPL_VAR["loop"]->count();else $TPL_loop_1=0;?>
<?php $this->print_("header",$TPL_SCP,1);?>


<?php $this->print_("sub_header",$TPL_SCP,1);?>


<?php if($TPL_loop_1){foreach($TPL_VAR["loop"] as $TPL_V1){?>
<section id="page_title">
	<button class="btn_list" type="button" onclick="location.href='list.php?id=<?php echo $_GET["id"]?>'">목록보기</button>
	<div class="top_title"><?php echo $GLOBALS["bdName"]?></div>
</section>

<section id="content-wrap" class="content">
	<section id="boardContent">
			<div class="title">
				<div class="subject-text">
<?php if($TPL_V1["sub"]){?><?php echo $TPL_V1["gapReply"]?><div class="icon-reply"></div><?php }?>
<?php if($TPL_V1["notice"]){?><div class="icon-notice"></div><?php }?>
<?php if($TPL_V1["secret"]){?><div class="icon-secret"></div><?php }?>
<?php if($GLOBALS["bdUseSubSpeech"]&&$TPL_V1["category"]){?>[<?php echo $TPL_V1["category"]?>] <?php }?><?php echo $TPL_V1["subject"]?>

					<div style="clear:both"></div>
				</div>
				<div style="font-size:12px"><?php echo $TPL_V1["name"]?> | <?php echo $TPL_V1["regdt"]?></div>
			</div>
<?php if($TPL_V1["urlLink"]){?>
			<div class="link">
					외부링크 : <a href="<?php echo $TPL_V1["urlLink"]?>" target='_blank' style='color:'><u><?php echo $TPL_V1["urlLink"]?></u></a><br/><br/>
			</div>
<?php }?>
			<div class="contents_holder">
			<?php echo nl2br($TPL_V1["contents"])?>

			</div>
			
<?php if($TPL_V1["uploadedFile"]){?>
			<div class="uploadFile">
				<div style="margin-left:10px"><?php echo $TPL_V1["uploadedFile"]?></div>
			</div>
<?php }?>

<?php if($GLOBALS["bdUseComment"]){?>
						<div>
							<table width="100%">
								<col width="90%" />
								<col />
<?php if((is_array($TPL_R2=$TPL_V1["loopComment"])&&!empty($TPL_R2)) || (is_object($TPL_R2) && in_array("Countable", class_implements($TPL_R2)) && $TPL_R2->count() > 0)) {foreach($TPL_R2 as $TPL_V2){?>
								<tr style="height:50px;border-top:1px solid #DBDBDB;">
									<td style="padding:5px">
										<div style="padding:5px">
										<?php echo $TPL_V2["name"]?> | <?php echo $TPL_V2["regdt"]?></div>
										<div class="contents_holder"><?php echo $TPL_V2["comment"]?></div>
									</td>
									<td valign="middle" style="position:relative">
<?php if($TPL_V2["link"]["delete"]){?><?php echo $TPL_V2["link"]["delete"]?><div style="position:absolute;top:5px"><img src="/shop/data/skin_mobileV2/light/common/img/new/btn_reply_del.png" width="26" height="26" /></div><?php echo $TPL_VAR["link"]["end"]?><?php }?>
									</td>
								</tr>
<?php }}?>
				 
							</table>
						</div>
<?php if(!$GLOBALS["bdDenyComment"]){?>
			<form name="frmComment_<?php echo $TPL_VAR["no"]?>" method="post" action="comment_ok.php" onsubmit="return chkEncoding(this)">
			<input type="hidden" name="id" value="<?php echo $TPL_VAR["id"]?>">
			<input type="hidden" name="no" value="<?php echo $TPL_V1["no"]?>">
			<input type="hidden" name="mode" value="write">
			<input type="hidden" name="returnUrl" value="<?php echo $_SERVER["REQUEST_URI"]?>">
			<input type="hidden" name="encode" value="">
			<input type="hidden" name="encodeMemo" value="">
			<input type="hidden" name="encodeName" value="">
				<table  width="100%" cellspacing="0" cellpadding="0" >
					<col width="75%" />
					<col />
<?php if(!$GLOBALS["member"]["name"]){?>
					<tr>
						<td class="input_line" colspan="2" align="center">
							<input type="text" name="name" placeholder="이름" required fld_esssential msgR="이름을 입력해주세요"  /> &nbsp;<input type="password" name="password" placeholder="비밀번호"  required fld_esssential msgR="비밀번호를 입력해주세요" />
						</td>
					</tr>
<?php }?>
					<tr>
						<td valign="top">
							<div class="memo-box"><textarea class="memo" name="memo" placeholder=" 댓글을 작성하세요." required fld_esssential msgR="댓글을 작성해주세요."></textarea>
							</div>
							<div style="float:left;width:28%"><button type="submit" class="comment_button" >작성 완료</button></div>
							
							<div style="clear:both"></div>
						</td>
					</tr>
<?php if($GLOBALS["bdSpamComment"]& 2){?>
					<tr>
						<td colspan="2"><?php echo $this->define('tpl_include_file_1',"proc/_captcha.htm")?> <?php $this->print_("tpl_include_file_1",$TPL_SCP,1);?></td>
					</tr>
<?php }?>
				</table>
<?php }?>
<?php }?>
			<div class="btn_center">
<?php if($TPL_V1["link"]["modify"]){?><!-- <button type="button" onclick="location.href='<?php echo $TPL_V1["link"]["modify"]?>'" >수정</button> --><?php }?>
<?php if($TPL_V1["link"]["delete"]){?><button type="button" onclick="location.href='<?php echo $TPL_V1["link"]["delete"]?>'" >삭제</button><?php }?>
<?php if($TPL_V1["link"]["reply"]&&$GLOBALS["bdSkin"]!='gallery'){?><button type="button" onclick="location.href='<?php echo $TPL_V1["link"]["reply"]?>'" >답글</button><?php }?>
			</div>
	</section>
</section>
<?php }}?>

<script>
// euckr범위를 넘는 특정 한글 호환 (cp949 인코딩 영역) 2016-03-31
function chkEncoding(form) {
	form.encodeMemo.value = encodeURIComponent(form.memo.value);
	form.encodeName.value = encodeURIComponent(form.name.value);
	form.encode.value = 'cp';

	return chkForm(form);
}
</script>

<?php $this->print_("footer",$TPL_SCP,1);?>