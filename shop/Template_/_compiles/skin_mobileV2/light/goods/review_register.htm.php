<?php /* Template_ 2.2.7 2016/11/03 13:16:19 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/goods/review_register.htm 000011327 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>


<?php $this->print_("sub_header",$TPL_SCP,1);?>

<style type="text/css">
section#nreviewregister {background:#FFFFFF;}
section#nreviewregister table{border:none; width:100%;}
section#nreviewregister table td{padding:8px 8px 8px 8px; vertical-align:middle; border-bottom:solid 1px #dbdbdb;}
section#nreviewregister table th{text-align:center; background:#f5f5f5; width:70px; vertical-align:middle; border-bottom:solid 1px #dbdbdb; color:#353535; font-size:12px;}
section#nreviewregister table .img{padding:5px; width:60px;}
section#nreviewregister table .img img{border:solid 1px #d9d9d9;}
section#nreviewregister table td input[type=text], input[type=password], select{width:95%;height:21px;}
section#nreviewregister table td textarea{width:95%;height:116px;}
section#nreviewregister .btn_center {margin:auto; width:198px; height:34px; margin-top:20px; margin-bottom:20px;}
section#nreviewregister .btn_center .btn_save{border:none; background:#f35151; border-radius:3px; color:#FFFFFF; font-size:13px; width:94px; height:34px; float:left; font-family:dotum; font-weight:bold;}
section#nreviewregister .btn_center .btn_prev{border:none; background:#808591; border-radius:3px; color:#FFFFFF; font-size:13px; width:94px; height:34px; float:right; font-family:dotum; font-weight:bold;}
section#nreviewregister .goods-nm{color:#353535; font-weight:bold; fonst-size:14px; margin-bottom:5px; overflow:hidden; word-break:break-all;}
section#nreviewregister .goods-price{color:#f03c3c; font-size:12px;}
section#nreviewregister .attach{float:left;}
section#nreviewregister .camera_btn{width:80px; height:27px; line-height:27px; font-size:12px; color:#FFFFFF; font-weight:normal;text-align:center; background:#808591; border-radius:3px;}
section#nreviewregister .camera_btn :active{background:#808591; border-radius:3px; float:left;}

#page_title{position:relative;}
#page_title .btn_back {position:absolute; top:5px; left:10px; border:none; font-size:0; width:38px; height:27px; background-image:url("/shop/data/skin_mobileV2/light/common/img/new/btn_back.png"); background-size:100% 100%;}

#star-point{text-align:center; position:relative; overflow:hidden;}
#star-point .star-point-select{overflow:hidden; position:absolute; left:50%; top:0; width:230px; margin-left:-115px;}
#star-point .star-point-select span.star{display:block; width:26px; height:26px; float:left; margin:0 10px; font-size:0; background-image:url("/shop/data/skin_mobileV2/light/common/img/new/btn_star_off.png"); background-size:100% 100%;}
#star-point .star-point-select span.selected{font-weight:bold; background-image:url("/shop/data/skin_mobileV2/light/common/img/new/btn_star_on.png");}
#star-point div.description{margin-top: 40px;}

#review-attach{list-style:none; overflow:hidden; position:relative; margin-bottom:5px;}
#review-attach li.item{float:left; width:50px; height:50px; overflow:hidden; margin-right:7px; margin-bottom: 7px;}
#review-attach li.item button.file-face{width:100%; height:100%; border:none; background-image:url("/shop/data/skin_mobileV2/light/common/img/new/btn_file_plus.png"); background-size:100% 100%; font-size:0;}
#review-attach li.item button.file-face.preview{background-size:100% auto; border:none;}
#review-attach li.item input.file-hidden{opacity:0; margin-bottom:-20px;}

#guest-info input[type=password]{border:solid 1px #cfcfcf; border-radius:1px;}
</style>

<script type="text/javascript">
jQuery(document).ready(function(){
	var maxUploadFile = parseInt("<?php echo $GLOBALS["reviewFileNum"]?>");
	maxUploadFile = maxUploadFile ? maxUploadFile : 0;
	jQuery("#review-attach li.item.template button.file-face").live("click", function(){
		var templateContainer = this.parentNode;
		var $container = jQuery(templateContainer);
		var $fileFace = $container.find("button.file-face"), fileFace = $fileFace[0];
		var $fileHidden = $container.find("input.file-hidden"), fileHidden = $fileHidden[0];
		if (jQuery("#review-attach li.item:not(.template) input.file-hidden").length >= maxUploadFile) {
			alert("÷�������� �ִ� " + maxUploadFile.toString() + "�� ���� ���ε� �����մϴ�.");
			return false;
		}
		else {
			fileHidden.onchange = function()
			{
				var fileReader = new FileReader();
				fileReader.readAsDataURL(this.files[0]);
				fileReader.onload = function()
				{
					jQuery(templateContainer.cloneNode(true)).appendTo(jQuery("#review-attach"));
					$container.removeClass("template");

					$fileFace.addClass("preview").css({
						"background-image" : "url('" + this.result + "')",
						"background-position" : "center",
						"background-size" : "cover",
						"background-repeat" : "no-repeat",
						"-webkit-background-size" : "cover",
						"-moz-background-size" : "cover",
						"-o-background-size" : "cover"
					});
					fileFace.onclick = function()
					{
						if (confirm("÷�ε� ������ �����Ͻðڽ��ϱ�?")) {
							$container.remove();
						}
					};
				};
				fileReader.onerror = function()
				{
					alert("�̹��� �ε��� ������ �߻��Ͽ����ϴ�.");
				};
			};
			$fileHidden.trigger("click");
		}
	});
	jQuery("#star-point span.star").click(function(){
		var $starCollection = jQuery("#star-point span.star");
		var starPoint = parseInt($(this).attr("data-value"));
		for (var index = 0; index < 5; index++) {
			if (index < starPoint) {
				$starCollection.filter("[data-value=" + (index + 1).toString() + "]").addClass("selected");
			}
			else {
				$starCollection.filter("[data-value=" + (index + 1).toString() + "]").removeClass("selected");
			}
		}
		jQuery("#star-point input[type=hidden]").val(starPoint);
	});
});
var submitted = false;
var chkForm2 = function(form)
{
	if (submitted === false) {
		if (form.subject.value.trim().length < 1) {
			alert("������ �Է����ּ���");
			form.subject.focus();
			return false;
		}
		else if (form.contents.value.trim().length < 1) {
			alert("������ �Է����ּ���");
			form.contents.focus();
			return false;
		}
		else if (form.name && form.name.value.trim().length < 1) {
			alert("�̸��� �Է����ּ���");
			form.name.focus();
			return false;
		}
		else if (form.password && form.password.value.trim().length < 1) {
			alert("��й�ȣ�� �Է����ּ���");
			form.password.focus();
			return false;
		}
		else if (chkForm(form) === false) {
			return false;
		}
		else {
			chkEncoding(form);
			submitted = true;
			return true;
		}
	}
	else {
		return false;
	}
};

// euckr������ �Ѵ� Ư�� �ѱ� ȣȯ (cp949 ���ڵ� ����) 2016-03-31
function chkEncoding(form) {
	form.encodeSubject.value = encodeURIComponent(form.subject.value);
	form.encodeContents.value = encodeURIComponent(form.contents.value);
	form.encodeName.value = encodeURIComponent(form.name.value);
	form.encode.value = 'cp';
}
</script>

<section id="nreviewregister" class="content">
	<section id="page_title">
		<button class="btn_back" onclick="history.back();">�ڷ�</button>
		<div class="top_title">��ǰ�ı�</div>
	</section>

	<form method="post" action="../myp/indb.php" enctype="multipart/form-data" onsubmit="return chkForm2(this);">
	<input type="hidden" name="mode" value="<?php echo $GLOBALS["mode"]?>">
	<input type="hidden" name="goodsno" value="<?php echo $GLOBALS["goodsno"]?>">
	<input type="hidden" name="sno" value="<?php echo $GLOBALS["sno"]?>">
	<input type="hidden" name="referer" value="<?php echo $GLOBALS["referer"]?>">
	<input type="hidden" name="ordsno" value="<?php echo $GLOBALS["ordsno"]?>">
	<input type="hidden" name="ordno" value="<?php echo $GLOBALS["ordno"]?>">
	<input type="hidden" name="encode" value="">
	<input type="hidden" name="encodeSubject" value="">
	<input type="hidden" name="encodeContents" value="">
	<input type="hidden" name="encodeName" value="">
<?php if($GLOBALS["sess"]||!empty($GLOBALS["data"]['m_no'])){?>
	<input type="hidden" name="name" value="<?php echo $GLOBALS["data"]["name"]?>"/>
<?php }?>

<?php if($GLOBALS["goods"]){?>
	<table>
	<tr>
		<th class="img"><?php echo goodsimgMobile($GLOBALS["goods"]["img_s"], 50)?></th>
		<td>
			<div class="goods-nm">
				<?php echo $GLOBALS["goods"]["goodsnm"]?>

			</div>
			<div class="goods-price">
				<?php echo number_format($GLOBALS["goods"]["price"])?>��
			</div>
		</td>
	</tr>
	</table>
<?php }?>
	<table>
	<tr>
		<td>
			<div id="star-point">
				<div class="star-point-select">
					<span class="star" data-value="1" data-selected="<?php echo $GLOBALS["data"]["point"]['1']?>">1��</span>
					<span class="star" data-value="2" data-selected="<?php echo $GLOBALS["data"]["point"]['2']?>">2��</span>
					<span class="star" data-value="3" data-selected="<?php echo $GLOBALS["data"]["point"]['3']?>">3��</span>
					<span class="star" data-value="4" data-selected="<?php echo $GLOBALS["data"]["point"]['4']?>">4��</span>
					<span class="star" data-value="5" data-selected="<?php echo $GLOBALS["data"]["point"]['5']?>">5��</span>
				</div>
				<input type="hidden" name="point"/>
				<div class="description">���Ϸ��� ��ǥ ���ϱ�</div>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<input type="text" name="subject" placeholder="������ �Է��ϼ���" value="<?php echo $GLOBALS["data"]["subject"]?>"/>
		</td>
	</tr>
	<tr>
		<td>
			<textarea name="contents" placeholder="������ �Է��ϼ���"><?php echo $GLOBALS["data"]["contents"]?></textarea>
		</td>
	</tr>
	<tr>
		<td>
			<ul id="review-attach">
				<li class="item template">
					<button class="file-face" type="button">����÷��</button>
					<input class="file-hidden" type="file" name="file[]" accept="image/*"/>
				</li>
			</ul>
			<div style="font-size:10px;">
				* ������ �ִ� <?php echo $GLOBALS["reviewFileNum"]?>������ ���ε尡 �����˴ϴ�.<br/>
<?php if($GLOBALS["cfg"]["reviewLimitPixel"]){?>* ������ ���� ����� <?php echo number_format($GLOBALS["cfg"]["reviewLimitPixel"])?>px���� Ŭ ��� �ڵ� �������� �˴ϴ�.<br/><?php }?>
<?php if($GLOBALS["cfg"]["reviewFileSize"]){?>* ������ ��� �ִ� <?php echo $GLOBALS["cfg"]["reviewFileSize"]?>KB�� ���� �� �����ϴ�.<br/><?php }?>
			</div>
		</td>
	</tr>
<?php if(!$GLOBALS["sess"]&&empty($GLOBALS["data"]['m_no'])){?>
	<tr>
		<td style="padding:0; border:none;">
			<table id="guest-info" style="border-top:none;">
				<td>
					<input type="text" name="name" placeholder="�̸�" value="<?php echo $GLOBALS["data"]["name"]?>"/>
				</td>
				<td>
					<input type="password" name="password" placeholder="��й�ȣ"/>
				</td>
			</table>
		</td>
	</tr>
<?php }?>
<?php if($GLOBALS["cfg"]["reviewSpamBoard"]& 2){?>
	<tr>
		<td><?php echo $this->define('tpl_include_file_1',"proc/_captcha.htm")?> <?php $this->print_("tpl_include_file_1",$TPL_SCP,1);?></td>
	</tr>
<?php }?>
	</table>

	<div class="m_review">
		<div class="btn_center">
			<button type="submit" id="save-btn" class="btn_save">Ȯ ��</button>
			<button type="button" id="prev-btn" class="btn_prev"  onclick="history.back();">�� ��</button>
		</div>
	</div>

</section>
</form>

<?php $this->print_("footer",$TPL_SCP,1);?>