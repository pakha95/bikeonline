<?

$location = "��ǰ���� > �귣�����";
include "../_header.php";

$query = "select * from ".GD_GOODS_BRAND."";
$res = $db->query($query);
while ($data=$db->fetch($res, MYSQL_ASSOC)){
	$data[brandnm] = strip_tags( $data[brandnm] );
	if (!$data[brandnm]) $data[brandnm] = "_deleted_";
	$brands[$data[sort]][] = $data;
}

### �迭 ���� ������
$brands = resort($brands);

### IFRAME �Ѱ����� ����Ÿ
parse_str( $_SERVER['QUERY_STRING'], $query_str );
unset( $query_str[ifrmScroll] );
unset( $query_str[brand] );
foreach( $query_str as $k => $v ) $query_str[$k] = "$k=$v";
$query_str = implode( "&", $query_str );
?>

<script>

/*** �귣��Ʈ�� �Ϻγ�� �ε� ***/
function openTree(obj)
{
	tree.sorting.ready(obj);
	ifrmbrand.location.href = "iframe.brand.php?ifrmScroll=1&brand=" + obj.parentNode.getElementsByTagName('input')[0].value + "&<?=$query_str?>";
}

function loadHistory(brand)
{
	var el = "brand[]";
	var obj = document.getElementsByName(el);
	for (i=0;i<obj.length;i++){
		if (obj[i].value==brand){
			openTree(obj[i].parentNode);
			break;
		}
	}
}

/*** �귣��� ���� ***/
function brandSort(num)
{
	var brandnm_kor_array = []; //���� ���� �迭
	var brandnm_eng_array = []; //���� ���� �迭
	var brandnm_num_array = []; //���� ���� �迭
	var brandnm_spc_array = []; //Ư�� ���� �迭
	var brandnm_merge_array = []; //��ü �迭�� sorting�Ͽ� ���� �迭
	var brandnm_sort_array = []; //Ű�� ����� �迭�� ��ü �迭�� ����� �迭�� ��Ī�Ͽ� ���� ����
	var brandnm_key_array = []; //�귣����� Ű ���� �迭
	var eng_chk_text = /[a-zA-Z]/g;
	var num_chk_text = /[0-9]/g;
	
	$$('.brandnm').each(function(e,key){
		var text = strip_tags(e.innerHTML);
		
		brandnm_key_array[text] = key;
		if (escape(text.charAt(0)).length >= 4) { // �ѱ�
			brandnm_kor_array[key] = text;
		} else {
			if (text.charAt(0).match(eng_chk_text)) { // ����
				brandnm_eng_array[key] = text;
			} else {
				if (text.charAt(0).match(num_chk_text)) { // ����
					brandnm_num_array[key] = text;
				} else { // Ư��
					var sno = e.readAttribute('data-sno');
					brandnm_spc_array[sno] = text;
				}
			}
		}
		
	});

	brandnm_eng_array.sort(function(s,t){
		var text1 = s.toLowerCase();
		var text2 = t.toLowerCase();
		if(text1 < text2) return -1;
		if(text1 > text2) return 1;
		return 0;
	});

	if (num == 1) {
		brandnm_merge_array = brandnm_eng_array.concat(brandnm_kor_array.sort(),brandnm_num_array.sort(),brandnm_spc_array);
	} else {
		brandnm_merge_array = brandnm_kor_array.sort().concat(brandnm_eng_array,brandnm_num_array.sort(),brandnm_spc_array);
	}

	for (var i in brandnm_merge_array) {
		if (i.match(num_chk_text)) {
			var key = brandnm_key_array[brandnm_merge_array[i]];
			brandnm_sort_array[i] = $$(".doc")[key].outerHTML;
		}
	}
	
	$('tree').innerHTML = brandnm_sort_array.join('');
}
</script>

<link rel="stylesheet" type="text/css" href="http://tagin.net/js/ex/js7-61/DynamicTree.css" />
<script src="../DynamicTree.js"></script>
<script src="../DynamicTreeSorting.js"></script>

<div class="title title_top">�귣�� ����<span>���ο� �귣����� ����ϰ� ��ǰ��Ͻ� �귣���Է�â���� ��ϵ� �귣�带 �����ϰ� �մϴ�</span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=product&no=5')"><img src="../img/btn_q.gif" border=0 align=absmiddle></a></div>


<table width=100%>
<tr>
	<td valign=top>
	<form method=post action="indb.php">
	<input type=hidden name=mode value="chgBrandSort">
	<input type=hidden name=rtn_query>
	
	<div style="width:100%; background:#FFDC6D;">
	<table width="95%" cellpadding="0" cellspacing="0" border="0" style="margin:auto; padding:5px 0;">
	<tr>
		<td colspan="2" align="left"><b>�귣�����ļ��� :</b></td>
	</tr>
	<tr>
		<td><img src="../img/brandnm_sort_01.png" onclick="brandSort(1)" class="hand"></td>
		<td align="right"><img src="../img/brandnm_sort_02.png" onclick="brandSort(2)" class="hand"></td>
	</tr>
	<tr>
		<td colspan="2"><img src="../img/icon_list.gif" align="absmiddle">�귣��������� = Ű���� �����̵�Ű���<br />���� �� [����]��ư�� Ŭ���ؾ� ������ �ݿ��˴ϴ�.</td>
	</tr>
	</table>
	</div>

	<div id=treeCategory class=scroll onmousewheel="return iciScroll(this)">

	<div style="padding-bottom:1px"><span><a id=node_top href="javascript:void(0)" onclick="openTree(this)" onfocus=blur()>TOP<input type=hidden name=brand[] value=""></a></span> (�ֻ���)</div>
	<div class="DynamicTree"><div class="wrap" id="tree">
	<? foreach ($brands as $data){ ?>
	<div class="doc"><span><a class="brandnm" data-sno="<?=$data['sno']?>" href="javascript:void(0)" onclick="openTree(this)" onfocus=blur()><?=$data[brandnm]?><input type=hidden name=brand[] value="<?=$data[sno]?>"></a></span></div>
	<? } ?>
	</div></div>

	</div>

	</form>

	<div id=MSG01>
	<table cellpadding=1 cellspacing=0 border=0 class=small_ex>
	<tr><td><img src="../img/icon_list.gif" align="absmiddle">TOP</font> ������ �귣�带 �����ϼ���.<br>
	</td></tr>
	</table>
	</div>
	<script>cssRound('MSG01')</script>

	</td>
	<td valign=top width=100% style="padding-left:10px">

	<iframe id=ifrmbrand name=ifrmbrand src="iframe.brand.php?ifrmScroll=1" style="width:100%;height:500px" frameborder=0></iframe>

	</td>
</tr>
</table>

<script type="text/javascript">
var tree = new DynamicTree("tree");
tree.init();
tree.Sorting();
<? if ($_GET[brand]){ ?>loadHistory('<?=$_GET[brand]?>');
<? } else { ?>openTree(_ID('node_top'));
<? } ?>
</script>

<? include "../_footer.php"; ?>