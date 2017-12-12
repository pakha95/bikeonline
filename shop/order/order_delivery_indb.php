<?
include '../_header.php';
include '../conf/fieldset.php';

$mode = empty($_REQUEST['mode']) ? 'list' : $_REQUEST['mode'];
$kind = empty($_REQUEST['pkind']) ? '' : $_REQUEST['pkind'];
$mno = $sess['m_no'] ? $sess['m_no'] : '';

if ($sess){
	switch($mode) {
		case 'check': // ajax
			$cnt_query = "SELECT COUNT(*) FROM ".GD_MEMBER_DELIVERY." dm WHERE dm.gmd_m_no = ".$mno;
			list ($cnt) = $db->fetch($cnt_query);
			$rtn = false;
			if($cnt >= 10) {
				$rtn = true;
			}
			echo $rtn;
			exit;
			break;
		case 'select': // ajax
			$q_select = "SELECT * FROM ".GD_MEMBER_DELIVERY." dm WHERE dm.gmd_sno = ".$_REQUEST['sno'];
			$delivery = $db->query($q_select);
			while ($list=$db->fetch($delivery, 1)){
				$a_zipcode = explode('-', $list['gmd_zipcode']);
				$a_mobile = explode('-', $list['gmd_mobile']);
				$a_phone = explode('-', $list['gmd_phone']);
				$loop['m_no'] = $list['gmd_m_no'];
				$loop['sno'] = $list['gmd_sno'];
				$loop['title'] = iconv('euc-kr', 'utf-8', $list['gmd_title']);
				$loop['name'] = iconv('euc-kr', 'utf-8', $list['gmd_name']);
				$loop['address'] = empty($list['gmd_address']) ? '' : iconv('euc-kr', 'utf-8', $list['gmd_address']);
				$loop['road_address'] = empty($list['gmd_road_address']) ? '' : iconv('euc-kr', 'utf-8', $list['gmd_road_address']);
				$loop['address_sub'] = empty($list['gmd_address_sub']) ? '' : iconv('euc-kr', 'utf-8', $list['gmd_address_sub']);
				$loop['mobile0'] = empty($a_mobile[0]) ? '' : $a_mobile[0];
				$loop['mobile1'] = empty($a_mobile[1]) ? '' : $a_mobile[1];
				$loop['mobile2'] = empty($a_mobile[2]) ? '' : $a_mobile[2];
				$loop['phone0'] = empty($a_phone[0]) ? '' : $a_phone[0];
				$loop['phone1'] = empty($a_phone[1]) ? '' : $a_phone[1];
				$loop['phone2'] = empty($a_phone[2]) ? '' : $a_phone[2];
				$loop['zipcode0'] = empty($a_zipcode[0]) ? '' : $a_zipcode[0];
				$loop['zipcode1'] = empty($a_zipcode[1]) ? '' : $a_zipcode[1];
				$loop['zonecode'] = empty($list['gmd_zonecode']) ? '' : $list['gmd_zonecode'];
			}
			echo json_encode($loop);
			exit;
			break;
		case 'add':
			$cnt_query = "SELECT COUNT(*) FROM ".GD_MEMBER_DELIVERY." dm WHERE dm.gmd_m_no = ".$mno;
			list ($cnt) = $db->fetch($cnt_query);
			if($cnt >= 10) {
				msg('��ϰ����� ������� ��� ����Ͽ����ϴ�. ����� ���� �� �ٽ� �õ����ּ���.', -1);
			} else {

				### ��� �� �⺻������� �������� ��� ������ �ִ� �⺻ ����� �ʱ�ȭ
				if($_POST['gmd_default'] == 'y') {
					$q_update = "
					UPDATE ".GD_MEMBER_DELIVERY." SET
						gmd_default = '',
						gmd_moddate = NOW()
					WHERE gmd_m_no = ".$mno;
					$db->query($q_update);
				}

				$q_insert = "
				INSERT INTO ".GD_MEMBER_DELIVERY." SET
					gmd_m_no = '".$mno."',
					gmd_default = '".$_POST['gmd_default']."',
					gmd_title = '".trim($_POST['delivery_name'])."',
					gmd_name = '".trim($_POST['delivery_receiver'])."',
					gmd_zipcode = '".$_POST['zipcode'][0]."-".$_POST['zipcode'][1]."',
					gmd_address = '".$_POST['address']."',
					gmd_road_address = '".$_POST['road_address']."',
					gmd_address_sub = '".$_POST['address_sub']."',
					gmd_phone = '".$_POST['phoneReceiver'][0]."-".$_POST['phoneReceiver'][1]."-".$_POST['phoneReceiver'][2]."',
					gmd_mobile = '".$_POST['mobileReceiver'][0]."-".$_POST['mobileReceiver'][1]."-".$_POST['mobileReceiver'][2]."',
					gmd_zonecode = '".$_POST['zonecode']."',
					gmd_regdate = NOW()
				";
				$db->query($q_insert);

				### �⺻������ϰ�� ȸ�� ���̺� ����ȭ
				$i_sno = $db->_last_insert_id();
				$def_query = "SELECT gmd_default FROM ".GD_MEMBER_DELIVERY." dm WHERE dm.gmd_sno = ".$i_sno;
				list ($default) = $db->fetch($def_query);
				if($default == 'y') {
					$mem_query = "
					UPDATE ".GD_MEMBER." SET
						zipcode = '".$_POST['zipcode'][0]."-".$_POST['zipcode'][1]."',
						zonecode = '".$_POST['zonecode']."',
						address = '".$_POST['address']."',
						address_sub = '".$_POST['address_sub']."',
						road_address = '".$_POST['road_address']."',
						phone = '".$_POST['phoneReceiver'][0]."-".$_POST['phoneReceiver'][1]."-".$_POST['phoneReceiver'][2]."',
						mobile = '".$_POST['mobileReceiver'][0]."-".$_POST['mobileReceiver'][1]."-".$_POST['mobileReceiver'][2]."'
					WHERE m_no = ".$mno;
					msg($mem_query);
					$db->query($mem_query);
				}

				go('order_delivery.php?mode=list'.($kind ? '&pkind='.$kind : ''));
			}
			break;
		case 'delete':
			$def_query = "SELECT gmd_default FROM ".GD_MEMBER_DELIVERY." dm WHERE dm.gmd_sno = ".$_REQUEST['sno'];
			list ($default) = $db->fetch($def_query);

			### �⺻����� �ϳ��� �ʼ��� ���� ��� ���� �ȵ�
			if($default == 'y' && ($checked['reqField']['address'] || $checked['reqField']['phone'] || $checked['reqField']['mobile'])) {
				msg('�⺻ ������� ������ �� �����ϴ�.', -1);
			} else {
				$del_query = "DELETE FROM ".GD_MEMBER_DELIVERY." WHERE gmd_sno=".$_REQUEST['sno'];
				$db->query($del_query);
				if($default == 'y') {
					$mem_query = "
					UPDATE ".GD_MEMBER." SET
						zipcode = '',
						address = '',
						road_address = '',
						address_sub = '',
						phone = '',
						mobile = '',
						zonecode = ''
					WHERE m_no = ".$mno;
					$db->query($mem_query);
				}
				go('order_delivery.php?mode=list'.($kind ? '&pkind='.$kind : ''));
			}
			break;
		default : // edit
			$check_query = "
				SELECT gmd_default,
				(SELECT COUNT(*) FROM ".GD_MEMBER_DELIVERY." WHERE gmd_m_no = ".$mno." AND gmd_default = 'y') cnt
				FROM ".GD_MEMBER_DELIVERY." WHERE gmd_sno = ".$_POST['sno'];
			list($default, $cnt) = $db->fetch($check_query);
			if($default == 'y' && $cnt == 1 && !$_POST['gmd_default']) {
				msg('�⺻ ������� �ݵ�� ����ϼž� �մϴ�.', -1);
				break;
			}

			### ���� �� �⺻������� �������� ��� ������ �ִ� �⺻ ����� �ʱ�ȭ
			if($_POST['gmd_default'] == 'y') {
				$q_update = "
				UPDATE ".GD_MEMBER_DELIVERY." SET
					gmd_default = '',
					gmd_moddate = NOW()
				WHERE gmd_m_no = ".$mno;
				$db->query($q_update);
			}

			$q_update = "
			UPDATE ".GD_MEMBER_DELIVERY." SET
				gmd_default = '".$_POST['gmd_default']."',
				gmd_title = '".trim($_POST['delivery_name'])."',
				gmd_name = '".trim($_POST['delivery_receiver'])."',
				gmd_zipcode = '".$_POST['zipcode'][0]."-".$_POST['zipcode'][1]."',
				gmd_address = '".$_POST['address']."',
				gmd_road_address = '".$_POST['road_address']."',
				gmd_address_sub = '".$_POST['address_sub']."',
				gmd_phone = '".$_POST['phoneReceiver'][0]."-".$_POST['phoneReceiver'][1]."-".$_POST['phoneReceiver'][2]."',
				gmd_mobile = '".$_POST['mobileReceiver'][0]."-".$_POST['mobileReceiver'][1]."-".$_POST['mobileReceiver'][2]."',
				gmd_zonecode = '".$_POST['zonecode']."',
				gmd_moddate = NOW()
			WHERE gmd_sno = ".$_POST['sno'];
			$db->query($q_update);

			### �⺻������ϰ�� ȸ�� ���̺� ����ȭ
			$def_query = "SELECT gmd_default FROM ".GD_MEMBER_DELIVERY." dm WHERE dm.gmd_sno = ".$_REQUEST['sno'];
			list ($default) = $db->fetch($def_query);
			if($default == 'y') {
				$mem_query = "
				UPDATE ".GD_MEMBER." SET
					zipcode = '".$_POST['zipcode'][0]."-".$_POST['zipcode'][1]."',
					zonecode = '".$_POST['zonecode']."',
					address = '".$_POST['address']."',
					address_sub = '".$_POST['address_sub']."',
					road_address = '".$_POST['road_address']."',
					phone = '".$_POST['phoneReceiver'][0]."-".$_POST['phoneReceiver'][1]."-".$_POST['phoneReceiver'][2]."',
					mobile = '".$_POST['mobileReceiver'][0]."-".$_POST['mobileReceiver'][1]."-".$_POST['mobileReceiver'][2]."'
				WHERE m_no = ".$mno;
				msg($mem_query);
				$db->query($mem_query);
			}

			go('order_delivery.php?mode=list'.($kind ? '&pkind='.$kind : ''));
			break;
	}
}

$tpl->assign('mode', $mode); // ���̾ƿ� ����(list:���, form:���/����)
$tpl->assign('pkind', $_REQUEST['pkind']); // ������ ����(d:�⺻(������), p:�˾�)
$tpl->print_('tpl');
?>