<?php
$location = "��ǰ���� > ��ǰ���� ����Ʈ";
include "../_header.php";
include "../../lib/page.class.php";
include "../../conf/config.pay.php";

$goodsHelper = Clib_Application::getHelperClass('admin_goods');

// �Ķ���� ����
$params = array(
	'page' => Clib_Application::request()->get('page', 1),
	'page_num' => Clib_Application::request()->get('page_num', 10),
	'cate' => Clib_Application::request()->get('cate'),
	'skey' => Clib_Application::request()->get('skey'),
	'sword' => Clib_Application::request()->get('sword'),
	'regdt' => Clib_Application::request()->get('regdt'),
	'goods_price' => Clib_Application::request()->get('goods_price'),
	'stock_type' => Clib_Application::request()->get('stock_type'),
	'stock_amount' => Clib_Application::request()->get('stock_amount'),
	'open' => Clib_Application::request()->get('open'),
	'soldout' => Clib_Application::request()->get('soldout'),
	'brandno' => Clib_Application::request()->get('brandno'),
	'origin' => Clib_Application::request()->get('origin'),
	'sort' => Clib_Application::request()->get('sort', 'goodsno desc'),
	'hashtag' => str_replace(" ", "_", trim(Clib_Application::request()->get('hashtag'))),
);

// ��ǰ ���
$goodsList = $goodsHelper->getGoodsCollection($params);

// ����¡
$pg = $goodsList->getPaging();

// ��ǰ �˻� ��
$searchForm = Clib_Application::form('admin_goods_search')->setData(Clib_Application::request()->gets('get'));

//��������� ����(��� 0�Ǹ� �ڵ����� �����Ǹ�)�� �������� by jung //////////////////////////////////////
	mysql_query("update ".GD_GOODS." set runout = 0, usestock = '' where runout = 1 or (usestock ='o' and totstock < 1) ");
	mysql_query("update ".GD_GOODS." set usestock = 'o' where totstock > 0 ");
	$red_b = "<span class='red_b'>[�������]</span>";
	$green_b = "<span class='green_b'>[�ؿ�]</span>";
	mysql_query("update ".GD_GOODS." set 	naver_import_flag='1',goods_prefix = REPLACE(	goods_prefix, \"<span class='red_b'>[�������]</span>\",\"<span class='green_b'>[�ؿ�]</span>\") where (usestock <>'o' or totstock<1) and 	goods_prefix LIKE '%�������%' ");
	//mysql_query("update ".GD_GOODS." set goods_prefix = REPLACE(goods_prefix, $red_b,$green_b) where usestock <>'o' and goods_prefix LIKE '%�������%' ");
	mysql_query("update ".GD_GOODS." set naver_import_flag='1',	goods_prefix = concat(\"<span class='green_b'>[�ؿ�]</span>\",goods_prefix) where (usestock ='' and goods_prefix NOT LIKE '%�ؿ�%' and goods_prefix NOT LIKE '%�������%') or (usestock IS NULL and goods_prefix NOT LIKE '%�ؿ�%' and goods_prefix NOT LIKE '%�������%') or (totstock ='' and goods_prefix NOT LIKE '%�ؿ�%' and goods_prefix NOT LIKE '%�������%') or (totstock IS NULL and goods_prefix NOT LIKE '%�ؿ�%' and goods_prefix NOT LIKE '%�������%') ");
	mysql_query("update ".GD_GOODS." set naver_import_flag='2',goods_prefix = concat(\"<span class='red_b'>[�������]</span>\",goods_prefix) where (totstock > 0 and goods_prefix NOT LIKE '%�ؿ�%' and goods_prefix NOT LIKE '%�������%') ");
	mysql_query("update ".GD_GOODS." set naver_import_flag='2',goods_prefix = REPLACE(goods_prefix, \"<span class='green_b'>[�ؿ�]</span>\",\"<span class='red_b'>[�������]</span>\") where (totstock > 0 and goods_prefix LIKE '%�ؿ�%') or (usestock ='o' and goods_prefix LIKE '%�ؿ�%') ");

	mysql_query("update ".GD_GOODS." set 	naver_import_flag='2' where (naver_import_flag<>'2' and totstock > 0 and goods_prefix LIKE '%�������%') or (naver_import_flag <> '2' and usestock = 'o' and goods_prefix LIKE '%�������%') ");
	mysql_query("update ".GD_GOODS." set naver_import_flag='1' where (naver_import_flag<>'1' and totstock <> 0 and goods_prefix LIKE '%�ؿ�%') or (naver_import_flag <> '1' and usestock <> 'o' and goods_prefix LIKE '%�ؿ�%') ");

	//mysql_query("update ".GD_GOODS." set goodssort = REPLACE(goods_prefix, \"<span class='green_b'>[�ؿ�]</span>\",\"\") where goods_prefix LIKE '%�ؿ�%' and goodssort ='' ");
	//mysql_query("update ".GD_GOODS." set goodssort = REPLACE(goods_prefix, \"<span class='red_b'>[�������]</span>\",\"\") where goods_prefix LIKE '%�������%' and goodssort ='' ");
	mysql_query("UPDATE gd_goods SET model_name = goodsnm WHERE model_name is NULL or TRIM(model_name) = '' " );
	mysql_query("update ".GD_GOODS." set model_name = REPLACE(model_name, \"<span class='red_b'>[�������]</span>\",\"\") where model_name LIKE '%�������%' ");
	mysql_query("update ".GD_GOODS." set model_name = REPLACE(model_name, \"<span class='green_b'>[�ؿ�]</span>\",\"\") where model_name LIKE '%�ؿ�%' ");
//mysql_query("update ".GD_GOODS." set goodsnm = REPLACE(goodsnm, goods_prefix,\"\") where goodsnm LIKE '%�������%' ");
//mysql_query("update ".GD_GOODS." set goodsnm = REPLACE(goodsnm, goods_prefix,\"\") where goodsnm LIKE '%�ؿ�%' ");
	//Ư�����λ�ǰ ����� 0 �Ǹ� �������� ��ȯ
	mysql_query("update gd_goods set open = 0 where open = 1 and totstock < 1 and goodsno in (SELECT goodsno FROM `gd_goods_link` where category = 002)");
	//���������ǰ ����� 0 �Ǹ� ���������ǰ ī�װ��������� ������ ������ ����ڿ��� �Ⱥ��̰� ��ȯ
	mysql_query("delete from gd_goods_link where autoadd = '1' and category = 050  and goodsno in (SELECT goodsno FROM `gd_goods` where totstock < 1)");
	mysql_query("update gd_goods_link set hidden = 1,hidden_mobile = 1 where category = 050  and goodsno in (SELECT goodsno FROM `gd_goods` where open = 1 and totstock < 1)");
	mysql_query("update gd_goods_link set hidden = 0,hidden_mobile = 0 where category = 050  and goodsno in (SELECT goodsno FROM `gd_goods` where open = 1 and totstock > 0) and (hidden = 1 or hidden_mobile = 1)");

// ��������� ���� �� ///////////////////////////////////////////////////////////////////////////////////

	$res_link = $db->query("select distinct(b.goodsno) from gd_goods as a left join gd_goods_link as b on a.goodsno = b.goodsno where (b.goodsno not in (select goodsno from gd_goods_link where category = '050' or category = '002')) and a.totstock > 0 order by b.goodsno desc ");



	while ($data_link= mysql_fetch_array($res_link)) {

	mysql_query("insert into gd_goods_link set goodsno='".$data_link[goodsno]."', category = '050', autoadd = '1' ");
	$last_sno = $db->lastID();
	$goods_link_sort = "-unix_timestamp()-".$last_sno;
	mysql_query("update gd_goods_link SET sort='".$goods_link_sort."' where sno = '".$last_sno."' ");

	//echo $data_link[goodsno]."<br />\n" ."|||".$goods_link_sort."<br />\n";

	}


// ����Ʈ������ ī�װ���, ��������, �� ǥ�ÿ���
$hideGoodsListExtraInfo = Clib_Application::cookie()->get('admin_goods_list_hide_extra_info') == 'true' ? true : false;
?>
<link rel="stylesheet" type="text/css" href="./css/css.css">
<script type="text/javascript" src="./js/goods_list.js"></script>
<script type="text/javascript" src="../js/adm_form.js"></script>
<script type="text/javascript" src="../godo.loading.indicator.js"></script>
<link href="<?php echo $cfg['rootDir']; ?>/lib/js/jquery-ui-1.10.4.custom.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo $cfg['rootDir']; ?>/proc/hashtag/hashtagControl.js?actTime=<?php echo time(); ?>"></script>

<? //for ajax by jung?>
<script type="text/javascript">
//for ajax post by jung
(function ($) {
$(document).ready(function(){
    $('#pricechange').submit(function(){

			if ($("input#percent").val().trim() == "") {
			    alert( '���� �߰����� �Է����ּ���.' );
			    return false;
			}else{

        $('#response').html("<b>���� ������ �Դϴ�...</b>");// show that something is loading
        $.ajax({
            type: 'POST',
            url: 'procPrice.php',
            data: $(this).serialize()
        })
        .done(function(data){// show the response
						data = decodeURIComponent(data);
          	$('#response').html(data);

						document.location.reload();
						alert("������ ���� ������ ���� �������� ���ΰ�ħ �մϴ�.");

        })
        .fail(function() {// just in case posting your form failed
            alert( "Posting failed." );
        });
        return false;// to prevent refreshing the whole page page
				//return true;

			}
    });

});
})(jQuery);
//ajax
</script>
<? //ajax end?>
<form class="admin-form" method="get" name="frmList" id="el-admin-goods-search-form">
	<input type="hidden" name="sort" value="<?=Clib_Application::request()->get('sort')?>">

	<h2 class="title">��ǰ���� ����Ʈ <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=product&no=2')"><img src="../img/btn_q.gif" border=0 align=absmiddle hspace=2></a></h2>

	<table class="admin-form-table">
	<tr>
		<th>�з�����</th>
		<td colspan=3><script type="text/javascript">new categoryBox('cate[]',4,'<?=array_pop(array_notnull(Clib_Application::request()->get('cate')))?>');</script></td>
	</tr>
	<tr>
		<th>�˻���</th>
		<td>
			<?=$searchForm->getTag('skey');?>
			<?=$searchForm->getTag('sword');?>
		</td>
		<th>������</th>
		<td>
			<?=$searchForm->getTag('origin');?>
		</td>
	</tr>
	<tr>
		<th>��ǰ����</th>
		<td>
			<?
			$goods_price = (array)Clib_Application::request()->get('goods_price');
			?>
			<input type=text name=goods_price[] value="<?=$goods_price[0]?>" onkeydown="onlynumber()" size="15" class="ar"> �� -
			<input type=text name=goods_price[] value="<?=$goods_price[1]?>" onkeydown="onlynumber()" size="15" class="ar"> ��
		</td>
		<th>�귣��</th>
		<td>
			<?=$searchForm->getTag('brandno');?>
		</td>
	</tr>
	<tr>
		<th>��ǰ�������</th>
		<td colspan=3>
			<?php
			foreach ($searchForm->getTag('stock_type') as $label => $tag) {
				echo sprintf('<label>%s%s</label> ',$tag, $label);
			}

			$stock_amount = (array)Clib_Application::request()->get('stock_amount');
			?>
			<div>
				<input type=text name=stock_amount[] value="<?=$stock_amount[0]?>" onkeydown="onlynumber()" size="15" class="ar"> �� -
				<input type=text name=stock_amount[] value="<?=$stock_amount[1]?>" onkeydown="onlynumber()" size="15" class="ar"> ��
			</div>

			<p class="help">
				<font color="blue">��ǰ���:</font> ��ǰ�� ǰ��(���ݿɼ�)�� ��� ������ ������ ���մϴ�. �ֹ��� �������(���������)�� ��ǰ�� ��ȸ����� �˴ϴ�. <br/>
				<font color="blue">ǰ�����:</font> ǰ��(���ݿɼ�) ���� ��� ������ ���մϴ�. �ֹ��� �������(���������)�� ��ǰ�� ��ȸ����� �˴ϴ�.
			</p>
		</td>
	</tr>
	<tr>
		<th>��ǰ�����</th>
		<td colspan=3>
			<?
			$regdt = (array)Clib_Application::request()->get('regdt');
			?>
			<input type="text" name="regdt[]" value="<?=$regdt[0]?>" onclick="calendar(event)" onkeydown="onlynumber()" class="ac"> -
			<input type="text" name="regdt[]" value="<?=$regdt[1]?>" onclick="calendar(event)" onkeydown="onlynumber()" class="ac">
			<a href="javascript:setDate('regdt[]',<?=date("Ymd")?>,<?=date("Ymd")?>)"><img src="../img/sicon_today.gif" align=absmiddle></a>
			<a href="javascript:setDate('regdt[]',<?=date("Ymd",strtotime("-7 day"))?>,<?=date("Ymd")?>)"><img src="../img/sicon_week.gif" align=absmiddle></a>
			<a href="javascript:setDate('regdt[]',<?=date("Ymd",strtotime("-15 day"))?>,<?=date("Ymd")?>)"><img src="../img/sicon_twoweek.gif" align=absmiddle></a>
			<a href="javascript:setDate('regdt[]',<?=date("Ymd",strtotime("-1 month"))?>,<?=date("Ymd")?>)"><img src="../img/sicon_month.gif" align=absmiddle></a>
			<a href="javascript:setDate('regdt[]',<?=date("Ymd",strtotime("-2 month"))?>,<?=date("Ymd")?>)"><img src="../img/sicon_twomonth.gif" align=absmiddle></a>
			<a href="javascript:setDate('regdt[]')"><img src="../img/sicon_all.gif" align=absmiddle></a>
		</td>
	</tr>
	<tr>
		<th>��ǰ��������</th>
		<td>
			<?php
			foreach ($searchForm->getTag('open') as $label => $tag) {
				echo sprintf('<label>%s%s</label> ',$tag, $label);
			}
			?>
		</td>
		<th>ǰ����ǰ</th>
		<td>
			<?php
			foreach ($searchForm->getTag('soldout') as $label => $tag) {
				echo sprintf('<label>%s%s</label> ',$tag, $label);
			}
			?>
		</td>
	</tr>
	<tr>
		<th>�ؽ��±�</th>
		<td colspan="3">
			<div style="border: 1px #BDBDBD solid; width: 170px; float: left; height: 19px;">#<?php echo $searchForm->getTag('hashtag'); ?></div>
		</td>
	</tr>
	</table>
	<div class=button_top><input type=image src="../img/btn_search2.gif"></div>

	<div class="admin-list-toolbar">
		<div class="list-information">
			�˻� <b><?=number_format($pg->recode['total'])?></b>�� / <b><?=number_format($pg->page['now'])?></b> of <?=number_format($pg->page['total'])?> Pages
		</div>

		<div class="left-buttons" style="margin-left:5px;">
			<a href="javascript:void(0);" onclick="nsAdminGoodsList.toggleListExtraInfo();"><img src="../img/buttons/brn_<?=$hideGoodsListExtraInfo ? 'open' : 'cls'?>.gif" id="el-admin-goods-list-extra-info-toggle-button"></a>

			<span class="help">�����ڰ� �����ϴ� PC�� �����Դϴ�. ���� �ٸ� PC���� �Ͻø� ���� Ʋ������ �ֽ��ϴ�.</span>
		</div>


		<div class="list-tool">
		<ul>
			<li><img src="../img/sname_date.gif"><a href="javascript:nsAdminGoodsList.sort('regdt desc')"><img name="sort_regdt_desc" src="../img/list_up_off.gif"></a><a href="javascript:nsAdminGoodsList.sort('regdt')"><img name="sort_regdt" src="../img/list_down_off.gif"></a></li>
			<li class="separater"></li>
			<li><img src="../img/sname_product.gif"><a href="javascript:nsAdminGoodsList.sort('goodsnm desc')"><img name="sort_goodsnm_desc" src="../img/list_up_off.gif"></a><a href="javascript:nsAdminGoodsList.sort('goodsnm')"><img name="sort_goodsnm" src="../img/list_down_off.gif"></a></li>
			<li class="separater"></li>
			<li><img src="../img/sname_price.gif"><a href="javascript:nsAdminGoodsList.sort('goods_price desc')"><img name="sort_goods_price_desc" src="../img/list_up_off.gif"></a><a href="javascript:nsAdminGoodsList.sort('goods_price')"><img name="sort_goods_price" src="../img/list_down_off.gif"></a></li>
			<li class="separater"></li>
			<li><img src="../img/sname_brand.gif"><a href="javascript:nsAdminGoodsList.sort('brandno desc')"><img name="sort_brandno_desc" src="../img/list_up_off.gif"></a><a href="javascript:nsAdminGoodsList.sort('brandno')"><img name="sort_brandno" src="../img/list_down_off.gif"></a></li>
			<li class="separater"></li>
			<li><img src="../img/sname_company.gif"><a href="javascript:nsAdminGoodsList.sort('maker desc')"><img name="sort_maker_desc" src="../img/list_up_off.gif"></a><a href="javascript:nsAdminGoodsList.sort('maker')"><img name="sort_maker" src="../img/list_down_off.gif"></a></li>
			<li class="separater"></li>
			<li>
			<img src="../img/sname_output.gif" align=absmiddle>
			<select name=page_num onchange="this.form.submit()">
			<?
			$r_pagenum = array(10,20,40,60,100);
			foreach ($r_pagenum as $v){
			?>
			<option value="<?=$v?>" <?=($v == Clib_Application::request()->get('page_num')) ? 'selected' : ''?>><?=$v?>�� ���
			<? } ?>
			</select>
			</li>
		</ul>
		</div>
	</div>

</form>
<?
//�����ϰ����� by jung
$cateBrand = Clib_Application::request()->get('cate');
$skeySch = Clib_Application::request()->get('skey');
$swordSch = Clib_Application::request()->get('sword');

if( (($cateBrand[0]=='004'||$cateBrand[0]=='048') && $cateBrand[1]!='')||(($skeySch == 'goods.goodscd' || $skeySch == 'goods.goodsnm') && $swordSch !='') ) {
	//$currPosition = currPosition($cateBrand[1],1);
	//list($cate1, $cate2) = split("[>]", $currPosition) ;
	?>
	<form method = "post" name = "pricechange" id = "pricechange"><div style="padding-bottom: 5px;">
<?
	foreach($goodsList as $goods) {
		$goodsNo = $goods->getId();
?>
	<input type = "hidden" name = "goodsNo[]" value = "<?=$goodsNo?>" >
<? }//foreach ?>
	<input type = "text" name = "percent" id = "percent" maxlength="3" size="5" placeholder="���ڸ�" onKeypress="if(event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" style="padding:3px;IME-MODE:disabled;">%
    <input type = "submit" value="���ݺ���" style="-webkit-appearance: push-button;" >
	<!-- <input type = "button" value="��� ���ΰ�ħ" onclick="document.location.reload()" style="-webkit-appearance: push-button;"><span class="help">(��Ͽ� ����� ���� �ݿ�)</span><br> -->
	</div></form>
	<div id='response'></div>
<? }//if cateBrand
//�����ϰ����� end
?>

<table class="admin-list-table">
<colgroup>
	<col style="width:35px;">
	<col style="width:50px;">
	<col >
	<col style="width:80px;">
	<col style="width:70px;">
	<col style="width:100px;">
	<col style="width:90px;">
</colgroup>
<thead>
<tr>
	<th><a href="javascript:void(0)" onclick="chkBox(document.getElementsByName('goodsno[]'),'rev')" class="white">����</a></th>
	<th>��ȣ</th>
	<th>��ǰ��</th>
	<th>�ǸŰ���</th>
	<th>�Ǹ����</th>
	<th>�����<br />(������)</th>
	<th>&nbsp;</th>
</tr>
</thead>
<tbody>
<?
	$listNo = $pg->idx;
	foreach($goodsList as $goods) {
?>
<tr class="ac has-info">
	<td><input type="checkbox" name="goodsno[]" value="<?=$goods->getId()?>"></td>
	<td><?=$listNo--?></td>
	<td class="al">
		<div>
			<a href="../../goods/goods_view.php?goodsno=<?=$goods->getId()?>" target=_blank><?=goodsimg($goods[img_s],40,'style="vertical-align:middle;border:1px solid #e9e9e9;"',1)?></a>
			<a href="adm_goods_form.php?mode=modify&goodsno=<?=$goods->getId()?>"><?=$goods->getData('goods_prefix')?><?=$goods->getGoodsName()?></a>
			<a href="adm_goods_form.php?mode=modify&goodsno=<?=$goods->getId()?>" onclick="nsAdminGoodsList.edit('<?=$goods->getId()?>');return false;"><img src="../img/icon_popup.gif"></a>
		</div>
	</td>
	<td class="price">
		<?=number_format($goods->getPrice())?>
		<div style="padding-top:2px"></div>
		<img src="../img/good_icon_point.gif" align=absmiddle><?=number_format($goods->getReserve())?>
	</td>
	<td><?=number_format($goods->getStock())?></td>
	<td><?=Core::helper('date')->format($goods['regdt'],'Y-m-d')?><? if ($goods['updatedt']) { ?><br />(<?=Core::helper('date')->format($goods['updatedt'],'Y-m-d')?>)<? } ?></td>
	<td>
		<a href="adm_goods_form.php?mode=modify&goodsno=<?=$goods->getId()?>"><img src="../img/buttons/btn_modify_small.gif"></a>
		<a href="javascript:void(0);" onclick="nsAdminGoodsList.openMemo('<?=$goods->getId()?>');return false;"><img src="../img/buttons/btn_memo.gif"></a>
	</td>
</tr>
<tr class="info el-admin-goods-list-extra-info" style="display:<?=$hideGoodsListExtraInfo ? 'none' : ''?>;">
	<td colspan="7">

	<div class="admin-goods-list-extra-info-wrap">
		<table>
		<tr>
			<th>��ǰ��ȣ :</th>
			<td><?=$goods->getId()?></td>
		</tr>
		<?
		if ($goods->hasOptions() == false) {
			//echo '<tr><th>���ϻ�ǰ</th><td>&nbsp;</td></tr>';
		}
		else {
			$optionInfo = array_combine($goods->getOptionName(), $goods->getOptionValue());
			$i = 1;
			foreach($optionInfo as $optionName => $optionValue) {
				printf('<tr><th>�ɼ� %d :</th><td>[ %s ] %s</td></tr>', $i++, htmlspecialchars($optionName), htmlspecialchars($optionValue));
			}
		}
		?>
		</table>
	</div>

	<hr>

	<div class="admin-goods-list-category-wrap">
		<ul class="admin-goods-list-category">
		<? foreach($goods->getCategory() as $linkedCategory) { ?>
			<li><a href="javascript:void(0);" onclick="nsAdminGoodsList.unlinkCategory(event, '<?=$linkedCategory['sno']?>');return false;"><img src="../img/buttons/btn_gorup_del.gif"></a> <?=currPosition($linkedCategory['category'] , 1);?></li>
		<? } ?>
		</ul>
	</div>

	<div class="admin-goods-list-function-wrap">
		<select onChange="nsAdminGoodsList.toggleOpen('<?=$goods->getId()?>', this.value)">
			<option value="1">����</option>
			<option value="0" <?=$goods->getData('open') == '0' ? 'selected' : ''?>  class="gray-bg">������</option>
		</select>

		<? if ($goods->getUseGoodsDiscount()) { ?>
			<img src="../img/icons/icon_sale.gif" />
		<? } ?>

		<? if ($goods->getSoldout()) { ?>
			<img src="../img/icons/icon_soldout.gif" />
		<? } ?>
	</div>

	<? $salesRange = $goods->getSalesRange(); ?>
	<div class="admin-goods-list-sales-range-wrap">
	<dl>
		<dt>�ǸűⰣ</dt>
		<dd>
		������ : <?=$salesRange[0] ? date('Y-m-d H:i', $salesRange[0]) : '���Ѿ���'?><br/>
		������ : <?=$salesRange[1] ? date('Y-m-d H:i', $salesRange[1]) : '���Ѿ���'?>
		</dd>
	</dl>
	</div>

	<div class="clear"></div>
	</td>
</tr>
<? } ?>
</tbody>
</table>

<div class="admin-list-toolbar">

	<div class="right-buttons">
		<a href="../goods/adm_goods_form.php"><img src="../img/buttons/btn_product_up.gif"></a>
	</div>

	<div class="left-buttons">
		<a href="javascript:void(0);" onclick="nsAdminGoodsList.setSoldout();return false;"><img src="../img/buttons/btn_select_soldout.gif"></a>
		<a href="javascript:void(0);" onclick="nsAdminGoodsList.copy();return false;"><img src="../img/buttons/btn_select_copy.gif"></a>
		<a href="javascript:void(0);" onclick="nsAdminGoodsList.del();return false;"><img src="../img/buttons/btn_select_del.gif"></a>
	</div>

	<div class="paging"><?=$pg->page['navi']?></div>
</div>

<ul class="admin-simple-faq">
	<li>������� ����� ��ǰ�� ��ü��ǰ����Ʈ�Դϴ�.</li>
	<li>[���û�ǰ ����] ��ư�� Ŭ���Ͻø� ���� ��ǰ�� �߰� �����˴ϴ�.</li>
	<li>��ǰ������ �����Ͻ÷��� ��ǰ���� Ŭ���ϼ���.</li>
	<li>��ǰ�̹����� Ŭ���Ͻø� �ش� ��ǰ�� ���������� ��â���� ���� �� �ֽ��ϴ�.</li>
	<li>����ϼ� ��ǰ����(����) ������ ������������ �Ǿ� �ִ� ��ǰ�� <a href="../<?=$mobileShop?>/mobile_goods_list.php"><font color="#ffffff"><b>[����ϼ� ��ǰ����]</b></font></a> ���� ������ ����(����) ���θ� ������ �ּ���. </li>
</ul>

<script type="text/javascript">
// onload events
Event.observe(document, 'dom:loaded', function(){
	nsAdminGoodsList.sortInit('<?=Clib_Application::request()->get('sort')?>');
	nsAdminForm.init($('el-admin-goods-search-form'));
});
jQuery(document).ready(HashtagInputListController);
</script>

<? include "../_footer.php"; ?>