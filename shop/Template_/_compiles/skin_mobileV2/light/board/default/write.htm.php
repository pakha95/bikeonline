<?php /* Template_ 2.2.7 2016/11/03 13:13:23 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/board/default/write.htm 000007644 */ 
if (is_array($TPL_VAR["prvFilePath"])) $TPL_prvFilePath_1=count($TPL_VAR["prvFilePath"]); else if (is_object($TPL_VAR["prvFilePath"]) && in_array("Countable", class_implements($TPL_VAR["prvFilePath"]))) $TPL_prvFilePath_1=$TPL_VAR["prvFilePath"]->count();else $TPL_prvFilePath_1=0;
if (is_array($TPL_VAR["prvFileName"])) $TPL_prvFileName_1=count($TPL_VAR["prvFileName"]); else if (is_object($TPL_VAR["prvFileName"]) && in_array("Countable", class_implements($TPL_VAR["prvFileName"]))) $TPL_prvFileName_1=$TPL_VAR["prvFileName"]->count();else $TPL_prvFileName_1=0;?>
<?php $this->print_("header",$TPL_SCP,1);?>

<?php $this->print_("sub_header",$TPL_SCP,1);?>


<style type="text/css">
.policyCollectionTable								{ border:solid 0px #dbdbdb; width:100%; }
.policyCollectionTable .policyCollectionTitle		{ color: #0080FF; font-weight: bold; border-bottom: 0px; }
.policyCollectionTable .policyCollectionContents	{ border-bottom: 0px; }
.policyCollectionTable .policyCollectionRadio		{ text-align:center; }
.policyCollectionTable .policyCollectionTextarea	{ width: 100%; height: 200px; border:0px solid #dbdbdb; padding: 0; font-family:dotum, ����, verdana, gulim, ����9; font-size: 12px;}
</style>

<script type="text/javascript">
var mode = '<?php echo $GLOBALS["mode"]?>';
var rootDir = '<?php echo $GLOBALS["cfg"]["rootDir"]?>';
var mobileSkin = '<?php echo $GLOBALS["cfgMobileShop"]["tplSkinMobile"]?>';
var prvFilePath = new Array();
var prvFileName = new Array();
<?php if($TPL_prvFilePath_1){foreach($TPL_VAR["prvFilePath"] as $TPL_V1){?>
prvFilePath.push("<?php echo $TPL_V1?>");
<?php }}?>
<?php if($TPL_prvFileName_1){foreach($TPL_VAR["prvFileName"] as $TPL_V1){?>
prvFileName.push("<?php echo $TPL_V1?>");
<?php }}?>

var bdSecretChk = '<?php echo $GLOBALS["bdSecretChk"]?>';
var bdUseFile = '<?php echo $GLOBALS["bdUseFile"]?>';
var maxFileNumber = '<?php echo $GLOBALS["maxFileNumber"]?>';
</script>

<script type="text/javascript">
jQuery(document).ready(function(){
	if (bdUseFile == 'on')
	{
		initFileUpload();
	}

	jQuery('.secret_button').click(function(){
		if(bdSecretChk == 0 || bdSecretChk == 1){
			if ($(this).hasClass('on')) {
				$(this).removeClass('on').addClass('off');
			}
			else if ($(this).hasClass('off')) {
				$(this).removeClass('off').addClass('on');
			}
			else {
				$(this).addClass('on');
			}
		}
		else if(bdSecretChk == 3 ){
			alert('�ش� �Խ����� ��б۷θ� �ۼ��� �����մϴ�.');
		}
	});

	if(jQuery('.notice_button').length>0){
		jQuery('.notice_button').click(function(){
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
	}
});

function chkForm3(form)
{
<?php if($GLOBALS["termsPolicyCollectionYn"]=='Y'){?>
	if(checkAgreement(form) != true) return false;
<?php }?>
	
	chkEncoding(form);

	return chkForm2(form);
}

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

<script src="/m2/lib/js/board.js"></script>

<section id="page_title">
	<button class="btn_back" onclick="history.back();">�ڷ�</button>
	<div class="top_title"><?php echo $GLOBALS["bdName"]?></div>
</section>

<section id="boardregister" class="content">
	<form method="post" action="<?php echo $TPL_VAR["boardwriteActionUrl"]?>" enctype="multipart/form-data" onsubmit="return chkForm3(this)">
	<input type='hidden' name='tmp' />
	<input type='hidden' name="id" value="<?php echo $TPL_VAR["id"]?>" />
	<input type='hidden' name='category_pre' value="<?php echo $TPL_VAR["category"]?>" />
	<input type='hidden' name='no' value="<?php echo $TPL_VAR["no"]?>" />
	<input type='hidden' name='mode' value="<?php echo $TPL_VAR["mode"]?>" />
	<input type='hidden' name='page' value="<?php echo $TPL_VAR["page"]?>" />
	<input type='hidden' name='encode' value="" />
	<input type='hidden' name="encodeSubject" value="">
	<input type='hidden' name="encodeContents" value="">
	<input type='hidden' name="encodeName" value="">
	<input type='hidden' name='chkSpamKey' />
	<table>
<?php if($GLOBALS["bdUseSubSpeech"]){?>
	 <tr>
		<td>
			<?php echo $TPL_VAR["subSpeech"]?>

		</td>
	</tr>	
<?php }?>
	<tr>
		<td>
			<input type="text" name="subject" required fld_esssential msgR="������ �Է����ּ���" placeholder="������ �Է��ϼ���" value="<?php echo $GLOBALS["data"]["subject"]?>"  />
<?php if($GLOBALS["chk"]["notice"]){?><?php echo $GLOBALS["chk"]["notice"]?><?php }?>
				<?php echo $GLOBALS["chk"]["secret"]?>

		</td>
	</tr>
	<tr>
		<td>
			<textarea name="contents" id="contents" style="width:100%;height:200px" placeholder="������ �Է��ϼ���" ><?php echo htmlspecialchars($GLOBALS["data"]["contents"])?></textarea>
			<!--<script type="text/javascript">mobileEditor('contents')</script>-->
		</td>
	</tr>
<?php if($GLOBALS["bdUseFile"]){?>
	<?php echo $TPL_VAR["prvFile"]?>

	<tr>
		<td>
			<ul id="board-attach">
				<li class="item template">
					<button class="file-face" type="button">����÷��</button>
					<input class="file-hidden" type="file" name="file[]" accept="*"/>
				</li>
			</ul>
			<div style="font-size:10px;">
				* ������ �ִ� <?php echo $GLOBALS["maxFileNumber"]?>������ ���ε尡 �����˴ϴ�.<br/>
<?php if($GLOBALS["bdMaxSize"]){?>* ���� ���ε� �ִ� ������� <?php echo byte2str($GLOBALS["bdMaxSize"])?>�Դϴ�<br/><?php }?>
			</div>
		</td>
	</tr>
<?php }?>
<?php if(!$GLOBALS["sess"]&&empty($GLOBALS["data"]['m_no'])){?>
	<tr>
		<td align="center">
			<input type="text" name="name" placeholder="�̸�" value="" required fld_esssential msgR="�̸��� �Է����ּ���"/>&nbsp;&nbsp;
			<input type="password" name="password" placeholder="��й�ȣ" required fld_esssential msgR="��й�ȣ�� �Է����ּ���"/>
		</td>
	</tr>
<?php }?>
<?php if($GLOBALS["bdSpamBoard"]& 2){?>
	<tr>
		<td class="cell_L"><?php echo $this->define('tpl_include_file_1',"proc/_captcha.htm")?> <?php $this->print_("tpl_include_file_1",$TPL_SCP,1);?></td>
	</tr>
<?php }?>
	</table>

<?php if($GLOBALS["termsPolicyCollectionYn"]=='Y'){?>
	<div style="height:12px;"></div>
	<table cellpadding="0" cellspacing="0" class="policyCollectionTable">
	<tr>
		<td class="policyCollectionTitle">�������� ���� �� �̿뿡 ���� �ȳ�</td>
	</tr>
	<tr>
		<td class="policyCollectionContents"><textarea class="policyCollectionTextarea"><?php echo $TPL_VAR["termsPolicyCollection3"]?></textarea></td>
	</tr>
	<tr>
		<td class="policyCollectionRadio">
			<input type="radio" name="agree" value="y" /> �����մϴ� &nbsp;&nbsp;&nbsp;
			<input type="radio" name="agree" value="n" /> �������� �ʽ��ϴ�
		</td>
	</tr>
	</table>
<?php }?>

	<div class="btn_center">
		<button type="submit" class="btn_save">Ȯ ��</button>
		<button type="button" class="btn_prev"  onclick="history.back();">�� ��</button>
	</div>
</section>
</form>

<?php $this->print_("footer",$TPL_SCP,1);?>