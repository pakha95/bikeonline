<?php /* Template_ 2.2.7 2015/02/12 15:15:33 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/board/default/list.htm 000003689 */ 
if (is_array($TPL_VAR["list"])) $TPL_list_1=count($TPL_VAR["list"]); else if (is_object($TPL_VAR["list"]) && in_array("Countable", class_implements($TPL_VAR["list"]))) $TPL_list_1=$TPL_VAR["list"]->count();else $TPL_list_1=0;?>
<?php $this->print_("header",$TPL_SCP,1);?>

<?php $this->print_("sub_header",$TPL_SCP,1);?>

<script type="text/javascript">
$(document).ready(function(){

	var item_cnt = $("#board-table .title").length;

<?php if($GLOBALS["board_cnt"]){?>
	board_cnt = <?php echo $GLOBALS["board_cnt"]?>;
	if(board_cnt <= 10 ) {
		$(".more-btn").hide();
	}
<?php }?>
	if(item_cnt < 10 ) {
		$(".more-btn").hide();
	}
});

var ici_admin = '<?php echo $TPL_VAR["ici_admin"]?>';
var sess_no = '<?php echo $GLOBALS["sess"]["m_no"]?>';
</script>
<script src="/m2/lib/js/board.js"></script>
<section id="page_title">
	<button class="btn_index" onclick="location.href='/'+getMobileHomepath()+'/board/index.php';"></button>
	<div class="top_title"><?php echo $GLOBALS["bdName"]?></div>
	<button class="btn_write" onclick="location.href='/'+getMobileHomepath()+'/board/write.php?id=<?php echo $_GET["id"]?>';">글쓰기</button>
</section>


<section id="boardlist" class="content">
	<form name="search-form" action="<?php echo $_SERVER["PHP_SELF"]?>" method="get">
		<div class="search" style="width:95%;height:40px;vertical-align:middle;padding:10px 0 0 10px">
			<input type="hidden" name="id" value="<?php echo $_GET["id"]?>" />
			<input type="hidden" name="search[all]" value="on"  />
			<input type="search" name="search[word]" style="width:75%;height:35px"  placeholder="검색 단어를 입력해 주세요." />
			<div style="float:right;"><button type="submit" class="search-button" >검 색</button></div>
		</div>
	</form>
	<table id="board-table" >
<?php if($TPL_list_1){foreach($TPL_VAR["list"] as $TPL_V1){?>
	<tr class="data-row" onclick="viewContent('<?php echo $TPL_V1["viewUrl"]?>','<?php echo $TPL_V1["secret"]?>','<?php echo $TPL_V1["m_no"]?>','<?php echo $TPL_V1["_member"]?>')">
		<td <?php if(!$TPL_V1["notice"]){?> class="title"<?php }?>>
			<div class="data-box" >
				<div class="bullet"></div>
				<div class="subject">
<?php if($TPL_V1["sub"]){?><?php echo $TPL_V1["gapReply"]?><div class="icon-reply"></div><?php }?>
<?php if($TPL_V1["notice"]){?><div class="icon-notice"></div><?php }?>
<?php if($TPL_V1["secret"]){?><div class="icon-secret"></div><?php }?>
					<div class="subject-text screen-width"><b>
<?php if($GLOBALS["bdUseSubSpeech"]){?>
<?php if($TPL_V1["category"]){?>[<?php echo $TPL_V1["category"]?>]<?php }?>
<?php }?>
					<?php echo $TPL_V1["subject"]?></b>
<?php if($GLOBALS["bdUseComment"]&&$TPL_V1["comment"]){?>[<?php echo $TPL_V1["comment"]?>]<?php }?>
					</div>

<?php if($TPL_V1["new"]){?><div class="icon-new"></div><?php }?>
<?php if($TPL_V1["hot"]){?><div class="icon-hot"></div><?php }?>
					<div style="clear:both"></div>
				</div>
				<div class="etc"><?php echo $TPL_V1["name"]?> | <?php echo str_replace('-','.',substr($TPL_V1["regdt"], 0, 10))?></div>
			</div>

			<!-- <div class="bullet"></div> -->
		</td>
	</tr>
<?php }}else{?>
	<tr >
		<td class="first" align="center"> 게시글 없습니다.</td>
	</tr>
<?php }?>
	</table>
	<div class="more-btn" onclick="javascript:getBoardData('default', '<?php echo $_GET["id"]?>' , '<?php echo $_GET["search"]["word"]?>' , '<?php echo $GLOBALS["bdUseComment"]?>','<?php echo $GLOBALS["bdUseSubSpeech"]?>');">더보기</div>
</section>
<?php $this->print_("footer",$TPL_SCP,1);?>