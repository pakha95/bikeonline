<?php
include '../lib.php';

set_time_limit(0);
ini_set("memory_limit", -1);

if($_POST['mode'] == 'remove'){
	try {
		$patternArray = array(
			'/�ſ�ī���ȣ\s:\s[0-9]+(\*)*[0-9]+\s\(�Ϲ�\s��������\s\*ó����\)/', //lgdacom
			'/ī���ȣ\s:\s[0-9]+(\*)*[0-9]+/', //������
			'/ī���ȣ\s:\s[0-9]+/', //��������
		);

		$query = "SELECT settlelog, ordno FROM ".GD_ORDER." WHERE settlekind='c' AND settlelog!='' ";
		$res = $db->query($query);
		if(!$res){
			throw new exception("�ֹ������� �ҷ����� ���Ͽ����ϴ�.\n�������� �����Ͽ� �ֽñ� �ٶ��ϴ�.");
		}
		while($row = $db->fetch($res, 1)){
			$reSettleLog = '';
			if(trim($row['settlelog']) != ''){
				$reSettleLog = preg_replace($patternArray, array(), $row['settlelog']);
				if(trim($reSettleLog) && $row['ordno'] && !preg_match("/ī���ȣ/", $reSettleLog)){
					$resUpdate = $db->query("UPDATE ".GD_ORDER." SET settlelog='".$reSettleLog."' WHERE ordno='".$row['ordno']."' LIMIT 1");
					if(!$resUpdate){
						throw new exception("�ֹ����� ������Ʈ�� �����Ͽ����ϴ�.\n�������� �����Ͽ� �ֽñ� �ٶ��ϴ�.");
					}
				}
			}
		}

		//�ſ�ī�� ���� ���� ���� ����
		if(!is_object($config)){
			$config = Core::loader('config');
		}
		$config->save('pgCardLogRemove', array('pgCardLogRemove' => 'y'));

		echo '�ſ�ī�� ��ȣ �ϰ������� �Ϸ�Ǿ����ϴ�.';
	}
	catch(Exception $e){
		echo $e->getMessage();
	}
}
?>