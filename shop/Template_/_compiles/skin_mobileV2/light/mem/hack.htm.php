<?php /* Template_ 2.2.7 2014/09/29 10:07:44 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/mem/hack.htm 000003809 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>


<style type="text/css">
section { font-family:dotum; } 
section#content-wrap { padding:12px; background:#FFFFFF; }
section#content-wrap ul { padding-left:10px; }
section#content-wrap ul li { padding-top:10px; }
section#content-wrap .hack_title { font-weight: bold; font-size: 13px; color: #627dce; }
section#content-wrap .hack_contents { padding: 10px 0px 0px 5px; font-size: 12px; }
section#hack-list .hack-select-area { padding:3px 0px 3px 0px; text-align:center; border-top: solid 1px #dbdbdb; border-bottom: solid 1px #dbdbdb; height: 45px; }
section#hack-list .hack-select-area .hack_reason { width: 98%; height: 40px; font-size: 14px; color: #848484; background-color: #ffffff; border: 0px; padding-left: 3px; }
section#hack-list .hack-text-area {  padding:3px 0px 3px 0px; text-align:center; border-bottom: solid 1px #dbdbdb; height: 45px;}
section#hack-list .hack-text-area .hack_password{ width: 95%; height: 40px; font-size: 14px; color: #848484; background-color: #ffffff; border: 0px; padding-left: 3px; }
section#hack-list .btn_list { width: 100%; margin: auto; height: 34px; padding: 15px 0px 10px 0px; width: 202px;}
section#hack-list .btn_list .btn_save{ border: none; background:#808591; border-radius:3px; color:#FFFFFF; font-size:13px; width:94px; height:34px; float:left; font-weight:bold; }
section#hack-list .btn_list .btn_prev{ margin-left:10px; border:none; background:#808591; border-radius:3px; color:#FFFFFF; font-size:13px; width:94px; height:34px; float:left; font-weight:bold; }
</style>

<script type="text/javascript">
$(document).ready(function(){
	$("#btn_prev").click(function(){
		window.history.back(-1);
	});
});

function checkHackForm()
{
	if(confirm("ȸ��Ż�� �Ͻø� ȸ������ ��� ������(��������, ����Ʈ ��)�� �����Ǿ����ϴ�.\n�׷��� ȸ���� Ż���Ͻðڽ��ϱ�?")){
		if(!$("#hack_reason").val()){ 
			alert("Ż�� ������ �����Ͽ� �ּ���.");
			return false;
		}

		if(!$("#hack_password").val()){ 
			alert("��й�ȣ�� �Է��Ͽ� �ּ���.");
			return false;
		}

		$("#act").val("Y");
		return true;
	}
	return false;
}
</script>

<section id="page_title">
	<div class="top_title">ȸ��Ż��</div>
</section>

<section id="content-wrap">
	<div class="hack_title">�� ȸ��Ż��ȳ�</div>
	<div class="hack_contents">
<?php if($TPL_VAR["guideSecede"]){?>
	<?php echo $TPL_VAR["guideSecede"]?>

<?php }else{?>
	<ul>
		<li>ȸ�� Ż�� �� ������ ������ ��ǰ ��ǰ �� A/S�� ���� ���ڻ�ŷ� ����� �Һ��� ��ȣ�� ���� ������ �ǰ��� ������ ��ȣ��å������ ���� �˴ϴ�.</li>
		<li>Ż�� �� ���Բ��� �����ϼ̴� �������� ��� ���� �˴ϴ�.</li>
	</ul>
<?php }?>
	</div>
</section>

<section id="hack-list" class="content">
<form name="hackForm" id="hackForm" action="" method="POST" onsubmit="return checkHackForm(this)">
<input type="hidden" name="act" id="act" value="">
<div class="hack-select-area">
	<select name="hack_reason" id="hack_reason" class="hack_reason">
		<option value="">������ �����ϼ̳���?</option>
<?php if((is_array($TPL_R1=codeitem('hack'))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_K1=>$TPL_V1){?>
		<option value="<?php echo $TPL_K1?>"><?php echo $TPL_V1?></option>
<?php }}?>
	</select>
</div>
<div class="hack-text-area">
	<input type="password" name="hack_password" id="hack_password" class="hack_password" placeholder="��й�ȣ �Է�">
</div>

<div class="btn_list">
	<button type="submit" class="btn_save" id="btn_save">Ż ��</button>
	<button type="button" class="btn_prev" id="btn_prev">�� ��</button>
</div>
</form>
</section>

<?php $this->print_("footer",$TPL_SCP,1);?>