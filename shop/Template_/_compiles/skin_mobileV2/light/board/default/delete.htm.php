<?php /* Template_ 2.2.7 2014/07/25 10:55:20 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/board/default/delete.htm 000001751 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>


<?php $this->print_("sub_header",$TPL_SCP,1);?>

<section id="page_title">
	<button class="btn_list" onclick="location.href='list.php?id=<?php echo $_GET["id"]?>'">��Ϻ���</button>
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
			������ �����Ͻðڽ��ϱ�? ������ ������ ������ �Ұ��� �մϴ�.
<?php }elseif($GLOBALS["m_no"]){?>
			<?php  $TPL_VAR["auth"] = false ?>
			<b>���������� �����ϴ�</b><p>
			���� �����Ҽ� �ִ� ������ ������ ���� �ʽ��ϴ�
<?php }else{?>
			��й�ȣ�� �Է��Ͽ� �ֽʽÿ�. <br/>������ ������ ������ �Ұ��� �մϴ�.<br/><br/>
			<input type=password name=password required class=line placeholder="��й�ȣ">
<?php }?>
		</div>

		<div class="btn_center">
			<button type="submit" class="btn_confirm">Ȯ��</button>
			<button type="button" class="btn_back" onclick="history.back();">���</button>
		</div>
	</form>
</section>
<?php echo $GLOBALS["bdFooter"]?>

<?php $this->print_("footer",$TPL_SCP,1);?>