<?php /* Template_ 2.2.7 2014/07/25 10:55:20 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/board/default/delete.htm 000001751 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>


<?php $this->print_("sub_header",$TPL_SCP,1);?>

<section id="page_title">
	<button class="btn_list" onclick="location.href='list.php?id=<?php echo $_GET["id"]?>'">목록보기</button>
	<div class="top_title"><?php echo $GLOBALS["bdName"]?></div>
</section>

<section id="board-delete" >
	<form name=frmDelete action="delete_ok.php" method=post onSubmit="return chkForm(this)">
		<input type=hidden name=id value=<?php echo $_GET["id"]?>>
		<input type=hidden name=sel[] value=<?php echo $GLOBALS["no"]?>>
		<input type=hidden name=mode value="<?php echo $GLOBALS["mode"]?>">
		<input type=hidden name=returnUrl value="<?php echo $GLOBALS["returnUrl"]?>">

		<div class="content">
			<br/>
			<?php  $TPL_VAR["auth"] = true ?>
<?php if(($GLOBALS["m_no"]&&$GLOBALS["m_no"]==$GLOBALS["sess"]["m_no"])||$GLOBALS["ici_admin"]){?>
			정말로 삭제하시겠습니까? 데이터 삭제시 복구가 불가능 합니다.
<?php }elseif($GLOBALS["m_no"]){?>
			<?php  $TPL_VAR["auth"] = false ?>
			<b>삭제권한이 없습니다</b><p>
			글을 삭제할수 있는 권한을 가지고 있지 않습니다
<?php }else{?>
			비밀번호를 입력하여 주십시오. <br/>데이터 삭제시 복구가 불가능 합니다.<br/><br/>
			<input type=password name=password required class=line placeholder="비밀번호">
<?php }?>
		</div>

		<div class="btn_center">
			<button type="submit" class="btn_confirm">확인</button>
			<button type="button" class="btn_back" onclick="history.back();">취소</button>
		</div>
	</form>
</section>
<?php echo $GLOBALS["bdFooter"]?>

<?php $this->print_("footer",$TPL_SCP,1);?>