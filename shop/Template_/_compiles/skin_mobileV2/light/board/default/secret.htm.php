<?php /* Template_ 2.2.7 2014/07/25 10:55:20 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/board/default/secret.htm 000001358 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>

<?php $this->print_("sub_header",$TPL_SCP,1);?>

<section id="page_title">
	<button class="btn_list" onclick="location.href='list.php?id=<?php echo $_GET["id"]?>'">목록보기</button>
	<div class="top_title"><?php echo $GLOBALS["bdName"]?></div>
</section>
  
<section id="board-secret">
	<form name='frmSecret' method='post'>
	<input type='hidden' name='returnUrl' value="<?php echo $TPL_VAR["returnUrl"]?>">
	<div class="content"> 
<?php if($TPL_VAR["m_no"]){?>
	<br/>
	접근 권한이 없습니다	
	<div class="btn_center" style="padding-left:80px">
		<button type="button" class="btn_back" onclick="location.href='<?php echo $TPL_VAR["returnUrl"]?>'">취소</button>
	</div>
<?php }else{?>
	<div>비밀글입니다. <br/>글을 작성하실때 입력한 비밀번호를 입력하세요.</div>
	<input type="password" name='password' class='line' size='30' placeholder="비밀번호"> 
	<div class="btn_center">
		<button type="submit" class="btn_confirm">확인</button>
		<button type="button" class="btn_back" onclick="location.href='<?php echo $TPL_VAR["returnUrl"]?>'">취소</button>
	</div>
<?php }?>
	</div>
	</form>
</section>
<?php $this->print_("footer",$TPL_SCP,1);?>