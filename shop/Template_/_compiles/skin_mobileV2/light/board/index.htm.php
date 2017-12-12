<?php /* Template_ 2.2.7 2014/07/28 14:39:37 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/board/index.htm 000001994 */ 
if (is_array($TPL_VAR["boardData"])) $TPL_boardData_1=count($TPL_VAR["boardData"]); else if (is_object($TPL_VAR["boardData"]) && in_array("Countable", class_implements($TPL_VAR["boardData"]))) $TPL_boardData_1=$TPL_VAR["boardData"]->count();else $TPL_boardData_1=0;?>
<?php $this->print_("header",$TPL_SCP,1);?>


<?php $this->print_("sub_header",$TPL_SCP,1);?>


<style type="text/css">
#page_title{margin-bottom:0px}
#page_title .btn_back {position:absolute; top:5px; left:10px; border:none; font-size:0; width:38px; height:27px; background-image:url("/shop/data/skin_mobileV2/light/common/img/new/btn_back.png"); background-size:100% 100%;}
#page_title .btn_write {position:absolute; top:5px; right:10px; border:none; font-size:0; width:56px; height:27px; background-image:url("/shop/data/skin_mobileV2/light/common/img/new/btn_qna.png"); background-size:100% 100%;}

.board_list li{clear:both;padding-left:20px; height:50px; line-height:50px; background:#ffffff; color:#222222; font-size:14px; font-weight:bold; text-align:left; font-family:dotum; border-bottom:solid 1px #969ca3; }
.board_list li .bullet{text-align:right;background:url('/shop/data/skin_mobileV2/light/common/img/myp/bullet.png') no-repeat right center; width:12px; height:50px;margin-right:20px;float:right;}
</style>

<script language="JavaScript">
$(document).ready(function(){
	$('.board_list li').click(function(){
		$boardId = $(this).attr('data-sno');
		location.href='list.php?id='+$boardId;
	});

});
</script>

<section id="page_title">
	<div class="top_title">°Ô½ÃÆÇ</div>
</section>

<ul class='board_list'>
<?php if($TPL_boardData_1){foreach($TPL_VAR["boardData"] as $TPL_K1=>$TPL_V1){?>
	<li data-sno='<?php echo $TPL_K1?>'><?php echo $TPL_V1?><div class='bullet'></div></li>
<?php }}?>
</ul>

<?php $this->print_("footer",$TPL_SCP,1);?>