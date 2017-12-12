<?php /* Template_ 2.2.7 2016/11/03 13:15:23 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/goods/goods_qna_register_v2.htm 000009700 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>


<?php $this->print_("sub_header",$TPL_SCP,1);?>

<style type="text/css">
section#nqnaregister {background:#FFFFFF;}
section#nqnaregister table{border:none; width:100%;}
section#nqnaregister table td{padding:8px 8px 8px 8px; vertical-align:middle; border-bottom:solid 1px #dbdbdb;}
section#nqnaregister table th{text-align:center; background:#f5f5f5; width:70px; vertical-align:middle; border-bottom:solid 1px #dbdbdb; color:#353535; font-size:12px;}
section#nqnaregister table .img{padding:5px; width:60px;}
section#nqnaregister table .img img{border:solid 1px #d9d9d9;}
section#nqnaregister table td input[type=text], input[type=password], select{width:95%;height:21px;}
section#nqnaregister table td input[name=subject]{width:80%;height:21px;margin-top:15px;float:left}
section#nqnaregister table td textarea{width:95%;height:116px;}
section#nqnaregister .btn_center {margin:auto; width:198px; height:34px; margin-top:20px; margin-bottom:20px;}
section#nqnaregister .btn_center .btn_save{border:none; background:#f35151; border-radius:3px; color:#FFFFFF; font-size:13px; width:94px; height:34px; float:left; font-family:dotum; font-weight:bold;}
section#nqnaregister .btn_center .btn_prev{border:none; background:#808591; border-radius:3px; color:#FFFFFF; font-size:13px; width:94px; height:34px; float:right; font-family:dotum; font-weight:bold;}
section#nqnaregister .goods-nm{color:#353535; font-weight:bold; fonst-size:14px; margin-bottom:5px; overflow:hidden; word-break:break-all;}
section#nqnaregister .goods-price{color:#f03c3c; font-size:12px;}
section#nqnaregister .attach{float:left;}
section#nqnaregister .camera_btn{width:80px; height:27px; line-height:27px; font-size:12px; color:#FFFFFF; font-weight:normal;text-align:center; background:#808591; border-radius:3px;}
section#nqnaregister .camera_btn :active{background:#808591; border-radius:3px; float:left;}

#page_title{position:relative;}
#page_title .btn_back {position:absolute; top:5px; left:10px; border:none; font-size:0; width:38px; height:27px; background-image:url("/shop/data/skin_mobileV2/light/common/img/new/btn_back.png"); background-size:100% 100%;}

#star-point{text-align:center; position:relative; overflow:hidden;}
#star-point .star-point-select{overflow:hidden; position:absolute; left:50%; top:0; width:230px; margin-left:-115px;}
#star-point .star-point-select span.star{display:block; width:26px; height:26px; float:left; margin:0 10px; font-size:0; background-image:url("/shop/data/skin_mobileV2/light/common/img/new/btn_star_off.png"); background-size:100% 100%;}
#star-point .star-point-select span.selected{font-weight:bold; background-image:url("/shop/data/skin_mobileV2/light/common/img/new/btn_star_on.png");}
#star-point div.description{margin-top: 40px;}

#qna-attach{list-style:none; overflow:hidden; position:relative; margin-bottom:5px;}
#qna-attach li.item{float:left; width:50px; height:50px; overflow:hidden; margin-right:7px; margin-bottom: 7px;}
#qna-attach li.item button.file-face{width:100%; height:100%; border:none; background-image:url("/shop/data/skin_mobileV2/light/common/img/new/btn_file_plus.png"); background-size:100% 100%; font-size:0;}
#qna-attach li.item button.file-face.pqna{background-size:100% auto; border:none;}
#qna-attach li.item input.file-hidden{opacity:0; margin-bottom:-20px;}

#guest-info input[type=password]{border:solid 1px #cfcfcf; border-radius:1px;}
.secret_button{width:48px;height:42px;float:left;}
.secret_button.on{background-image: url("/shop/data/skin_mobileV2/light/common/img/new/btn_secret_on.png");}
.secret_button.off{background-image: url("/shop/data/skin_mobileV2/light/common/img/new/btn_secret_off.png");}

section#nqnaregister .policyCollectionTable								{ border:solid 1px #dbdbdb; border-top: 0px; width:100%; }
section#nqnaregister .policyCollectionTable .policyCollectionTitle		{ color: #0080FF; font-weight: bold; border-bottom: 0px; }
section#nqnaregister .policyCollectionTable .policyCollectionContents	{ border-bottom: 0px; }
section#nqnaregister .policyCollectionTable .policyCollectionRadio		{ text-align:center; }
</style>

<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('.secret_button').click(function(){

		if ($(this).hasClass('on')) {
			$(this).removeClass('on').addClass('off');
		}
		else if ($(this).hasClass('off')) {
			$(this).removeClass('off').addClass('on');
		}
		else {
			$(this).addClass('on');
		}
	});
});
var submitted = false;
var chkForm2 = function(form)
{
	if (submitted === false) {

		if(checkAgreement(form) != true) return false;

		if(form.secret && jQuery('.secret_button').hasClass('on')){
			form.secret.value='1';
		}
		else if(form.secret){
			form.secret.value='';
		}
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

function checkAgreement(form){
	if(form.agree[0].checked !== true){
		alert('�������� ���� �� �̿뿡 ���� �ȳ��� ���� �ϼž� �ۼ��� �����մϴ�.');
		return false;
	}

	return true;
}

// euckr������ �Ѵ� Ư�� �ѱ� ȣȯ (cp949 ���ڵ� ����) 2016-03-31
function chkEncoding(form) {
	form.encodeSubject.value = encodeURIComponent(form.subject.value);
	form.encodeContents.value = encodeURIComponent(form.contents.value);
	form.encodeName.value = encodeURIComponent(form.name.value);
	form.encode.value = 'cp';
}
</script>

<section id="nqnaregister" class="content">
	<section id="page_title">
		<button class="btn_back" onclick="history.back();">�ڷ�</button>
		<div class="top_title">��ǰ����</div>
	</section>

	<form method="post" action="<?php echo $TPL_VAR["goodsQNAActionUrl"]?>" enctype="multipart/form-data" onsubmit="return chkForm2(this);">
	<input type="hidden" name="mode" value="<?php echo $GLOBALS["mode"]?>">
	<input type="hidden" name="goodsno" value="<?php echo $GLOBALS["goodsno"]?>">
	<input type="hidden" name="isAll" value="<?php echo $_GET["isAll"]?>">
	<input type="hidden" name="sno" value="<?php echo $GLOBALS["sno"]?>">
	<input type="hidden" name="referer" value="<?php echo $GLOBALS["referer"]?>">
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
			<input type="text" name="subject" placeholder="������ �Է��ϼ���" value="<?php echo $GLOBALS["data"]["subject"]?>"/>
<?php if($GLOBALS["cfg"]["qnaSecret"]=='secret'){?>
			<div class='secret_button off'></div>
			<input type="hidden" name="secret" value="" />
<?php }?>
		</td>
	</tr>
	<tr>
		<td>
			<textarea name="contents" placeholder="������ �Է��ϼ���"><?php echo $GLOBALS["data"]["contents"]?></textarea>
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
<?php if($GLOBALS["cfg"]["qnaSpamBoard"]& 2){?>
	<tr>
		<td class="cell_L"><?php echo $this->define('tpl_include_file_1',"proc/_captcha.htm")?> <?php $this->print_("tpl_include_file_1",$TPL_SCP,1);?></td>
	</tr>
<?php }?>
	</table>

	<div style="height:12px;"></div>
	<table cellpadding="0" cellspacing="0" class="policyCollectionTable" width="100%">
	<tr>
		<td class="policyCollectionTitle">�������� ���� �� �̿뿡 ���� �ȳ�</td>
	</tr>
	<tr>
		<td class="policyCollectionContents"><?php echo $TPL_VAR["termsPolicyCollection4"]?></td>
	</tr>
	<tr>
		<td class="policyCollectionRadio">
			<input type="radio" name="agree" value="y" /> �����մϴ� &nbsp;&nbsp;&nbsp;
			<input type="radio" name="agree" value="n" /> �������� �ʽ��ϴ�
		</td>
	</tr>
	</table>

	<div class="m_qna">
		<div class="btn_center">
			<button type="submit" id="save-btn" class="btn_save">Ȯ ��</button>
			<button type="button" id="prev-btn" class="btn_prev"  onclick="history.back();">�� ��</button>
		</div>
	</div>

</section>
</form>

<?php $this->print_("footer",$TPL_SCP,1);?>