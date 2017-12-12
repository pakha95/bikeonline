<?
include "../lib.php";
include "../../lib/kakaoAlimtalk.class.php";
include "../../lib/kakaoAlimtalkAPI.class.php";

$post = $_POST;
$mode = $post['mode'];
unset($post['x']);
unset($post['y']);

$kakaoAlimtalk = new kakaoAlimtalk();
$kakaoAlimtalkAPI = new kakaoAlimtalkAPI();

switch ($mode) {
	// �˸��� ���� ȯ������
	case "config":
		$kakaoAlimtalk->configSave($post);
		go($_SERVER['HTTP_REFERER']);

		break;

	// �÷���ģ�� ������ȣ
	case "mobileAuth":
		if (!$post['plusFriendId']) {
			msg('�÷���ģ�� ���̵� �Է����ּ���.',-1);
		}

		if (!$post['phoneNumber']) {
			msg('�޴��� ��ȣ�� �Է����ּ���.',-1);
		}

		$res = $kakaoAlimtalkAPI->mobileAuth($post['plusFriendId'], $post['phoneNumber']);

		echo $res['code'];
		break;

	// �߽�������Ű �߱�
	case "profileRegister":
		if (!$post['plusFriendId']) {
			msg('�÷���ģ�� ���̵� �Է����ּ���.',-1);
		}

		if ($_FILES['license']['size'] == 0 && $_FILES['license']['error'] == 4) {
			msg('����ڵ������ ���ε� ���ּ���.',-1);
		}

		if ($_FILES['license']['size'] > 512000) {
			msg('500KB ������ ���ϸ� ���ε� �����մϴ�.',-1);
		}

		if (!$post['authNumber']) {
			msg('�޴��� ���� ������ �Է����ּ���.',-1);
		}

		$res = $kakaoAlimtalkAPI->profileRegister($post, $_FILES);

		if ($res['result'] == 'success') {
			$data['plusFriendId'] = $post['plusFriendId'];
			$data['profileKey'] = $res['data'];
			$data['phoneNumber'] = $post['phoneNumber'];

			$kakaoAlimtalk->configSave($data);

			msg('�÷���ģ�� ���̵� ��Ͽ� �����Ͽ����ϴ�.');
			echo'<script>parent.window.location.reload();</script>';
		}
		else {
			msg('�÷���ģ�� ���̵� ��Ͽ� �����Ͽ����ϴ�. ����� �ٽ� �õ��� �ּ���',-1);
		}

		break;

	// �߽�������Ű ����
	case "profileDelete":
		$res = $kakaoAlimtalkAPI->profileDelete();

		if ($res['result'] == 'success') {
			$data['plusFriendId'] = '';
			$data['profileKey'] = '';
			$data['phoneNumber'] = '';

			unlink('../../conf/kakaoAlimtalk.config.php');
			$kakaoAlimtalk->templateReset();
		}

		echo $res['result'];
		break;

	// ���ø� ���
	case "templateRegister":
		$post['increment'] = $kakaoAlimtalk->getTemplateAuto_increment();
		$res = $kakaoAlimtalkAPI->templateRegister($post);

		if ($res[0]['code'] == 'success') {
			$kakaoAlimtalk->templateSave($post);
			msg('���ø��� ����Ͽ����ϴ�.');
			echo'<script>parent.window.location.reload();</script>';
		}
		else {
			msg('���ø��� ����� �� �����ϴ�. ��� �� �ٽ� �õ����ּ���.',-1);
		}

		break;

	// ���ø� ����
	case "templateUpdate":
		$res = $kakaoAlimtalkAPI->templateUpdate($post);

		if ($res['code'] == 'success') {
			$kakaoAlimtalk->templateUpdate($post);
			msg('���ø��� �����Ͽ����ϴ�.');
			echo'<script>parent.window.location.reload();</script>';
		}
		else {
			msg('���ø��� ������ �� �����ϴ�. ��� �� �ٽ� �õ����ּ���.',-1);
		}

		break;

	// ���ø� ����
	case "templateDelete":
		$res = $kakaoAlimtalkAPI->templateDelete($post);

		if ($res[0]['code'] == 'success') {
			$kakaoAlimtalk->templateDelete($post);
		}

		echo $res[0]['code'];
		break;

	// ���ø� �˼���û
	case "templateRequest":
		$res = $kakaoAlimtalkAPI->templateRequest($post);

		if ($res[0]['code'] == 'success') {
			$post['inspection_status'] = 'REQ';
			$kakaoAlimtalk->templateStatusUpdate($post);
		}

		echo $res[0]['code'];
		break;

	// ���ø� ����
	case "templateComment":
		$res = $kakaoAlimtalkAPI->templateComment($post);

		if ($res['code'] == 'success') {
			msg('�˼� ���Ǹ� �Ϸ��Ͽ����ϴ�.');
			go($_SERVER['HTTP_REFERER']);
		}
		else {
			msg('�˼� ���Ǹ� �� �� �����ϴ�. ��� �� �ٽ� �õ����ּ���.',-1);
		}

		break;

	// ���ø� ����Ʈ ����
	case "templateList":
		$res = $kakaoAlimtalkAPI->templateList();

		if ($res['code'] == 'success') {
			for($i=0; $i<count($res['data']); $i++) {
				$post['status'] = $res['data'][$i]['status'];
				$post['inspection_status'] = $res['data'][$i]['inspectionStatus'];
				$post['contents'] = $res['data'][$i]['templateContent'];
				$post['code'] = $res['data'][$i]['templateCode'];
				$kakaoAlimtalk->templateListUpdate($post);

				if (!$kakaoAlimtalk->getTemplateData($res['data'][$i]['templateCode'])) {
					$kakaoAlimtalk->selectTemplateSave($res['data'][$i]);
				}

			}
		}

		$res = $kakaoAlimtalkAPI->groupTemplateList();

		if ($res['code'] == 'success') {
			for($i=0; $i<count($res['data']); $i++) {
				$post['status'] = $res['data'][$i]['status'];
				$post['inspection_status'] = $res['data'][$i]['inspectionStatus'];
				$post['contents'] = $res['data'][$i]['templateContent'];
				$post['code'] = $res['data'][$i]['templateCode'];
				$kakaoAlimtalk->templateListUpdate($post);

				if (!$kakaoAlimtalk->getTemplateData($res['data'][$i]['templateCode'])) {
					$kakaoAlimtalk->selectTemplateSave($res['data'][$i]);
				}

			}
		}

		echo $res['code'];
		break;

	// ���ø� ���� ��ȸ
	case "templateContents":
		$res = $kakaoAlimtalk->getTemplateData($post['code']);

		echo $res['contents'];
		break;

	// �˸��� �߼۳��� ����
	case "sendAlimtalkUpdate":
		$post = $kakaoAlimtalkAPI->resultAlimtalk();
		$post['data'] = gd_json_decode(iconv("UTF-8","EUC-KR",$post['data']));

		$res = $kakaoAlimtalk->updateSendResult($post);
		$_SESSION['kakaoSendUpdate'] = 'Y';

		echo $res;
		break;
}

?>
