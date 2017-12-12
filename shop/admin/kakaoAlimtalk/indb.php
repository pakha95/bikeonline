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
	// 알림톡 설정 환경저장
	case "config":
		$kakaoAlimtalk->configSave($post);
		go($_SERVER['HTTP_REFERER']);

		break;

	// 플러스친구 인증번호
	case "mobileAuth":
		if (!$post['plusFriendId']) {
			msg('플러스친구 아이디를 입력해주세요.',-1);
		}

		if (!$post['phoneNumber']) {
			msg('휴대폰 번호를 입력해주세요.',-1);
		}

		$res = $kakaoAlimtalkAPI->mobileAuth($post['plusFriendId'], $post['phoneNumber']);

		echo $res['code'];
		break;

	// 발신프로필키 발급
	case "profileRegister":
		if (!$post['plusFriendId']) {
			msg('플러스친구 아이디를 입력해주세요.',-1);
		}

		if ($_FILES['license']['size'] == 0 && $_FILES['license']['error'] == 4) {
			msg('사업자등록증을 업로드 해주세요.',-1);
		}

		if ($_FILES['license']['size'] > 512000) {
			msg('500KB 이하인 파일만 업로드 가능합니다.',-1);
		}

		if (!$post['authNumber']) {
			msg('휴대폰 인증 정보를 입력해주세요.',-1);
		}

		$res = $kakaoAlimtalkAPI->profileRegister($post, $_FILES);

		if ($res['result'] == 'success') {
			$data['plusFriendId'] = $post['plusFriendId'];
			$data['profileKey'] = $res['data'];
			$data['phoneNumber'] = $post['phoneNumber'];

			$kakaoAlimtalk->configSave($data);

			msg('플러스친구 아이디 등록에 성공하였습니다.');
			echo'<script>parent.window.location.reload();</script>';
		}
		else {
			msg('플러스친구 아이디 등록에 실패하였습니다. 잠시후 다시 시도해 주세요',-1);
		}

		break;

	// 발신프로필키 삭제
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

	// 템플릿 등록
	case "templateRegister":
		$post['increment'] = $kakaoAlimtalk->getTemplateAuto_increment();
		$res = $kakaoAlimtalkAPI->templateRegister($post);

		if ($res[0]['code'] == 'success') {
			$kakaoAlimtalk->templateSave($post);
			msg('템플릿을 등록하였습니다.');
			echo'<script>parent.window.location.reload();</script>';
		}
		else {
			msg('템플릿을 등록할 수 없습니다. 잠시 후 다시 시도해주세요.',-1);
		}

		break;

	// 템플릿 수정
	case "templateUpdate":
		$res = $kakaoAlimtalkAPI->templateUpdate($post);

		if ($res['code'] == 'success') {
			$kakaoAlimtalk->templateUpdate($post);
			msg('템플릿을 수정하였습니다.');
			echo'<script>parent.window.location.reload();</script>';
		}
		else {
			msg('템플릿을 수정할 수 없습니다. 잠시 후 다시 시도해주세요.',-1);
		}

		break;

	// 템플릿 삭제
	case "templateDelete":
		$res = $kakaoAlimtalkAPI->templateDelete($post);

		if ($res[0]['code'] == 'success') {
			$kakaoAlimtalk->templateDelete($post);
		}

		echo $res[0]['code'];
		break;

	// 템플릿 검수요청
	case "templateRequest":
		$res = $kakaoAlimtalkAPI->templateRequest($post);

		if ($res[0]['code'] == 'success') {
			$post['inspection_status'] = 'REQ';
			$kakaoAlimtalk->templateStatusUpdate($post);
		}

		echo $res[0]['code'];
		break;

	// 템플릿 문의
	case "templateComment":
		$res = $kakaoAlimtalkAPI->templateComment($post);

		if ($res['code'] == 'success') {
			msg('검수 문의를 완료하였습니다.');
			go($_SERVER['HTTP_REFERER']);
		}
		else {
			msg('검수 문의를 할 수 없습니다. 잠시 후 다시 시도해주세요.',-1);
		}

		break;

	// 템플릿 리스트 갱신
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

	// 템플릿 내용 조회
	case "templateContents":
		$res = $kakaoAlimtalk->getTemplateData($post['code']);

		echo $res['contents'];
		break;

	// 알림톡 발송내역 갱신
	case "sendAlimtalkUpdate":
		$post = $kakaoAlimtalkAPI->resultAlimtalk();
		$post['data'] = gd_json_decode(iconv("UTF-8","EUC-KR",$post['data']));

		$res = $kakaoAlimtalk->updateSendResult($post);
		$_SESSION['kakaoSendUpdate'] = 'Y';

		echo $res;
		break;
}

?>
