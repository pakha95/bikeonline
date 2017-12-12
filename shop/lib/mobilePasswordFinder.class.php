<?php
/**
 * Copyright (c) 2015 GODO Co. Ltd
 * All right reserved.
 *
 * This software is the confidential and proprietary information of GODO Co., Ltd.
 * You shall not disclose such Confidential Information and shall use it only in accordance
 * with the terms of the license agreement  you entered into with GODO Co., Ltd
 *
 * Revision History
 * Author            Date              Description
 * ---------------   --------------    ------------------
 * workingby         2016.02.25        First Draft.
 */

/**
 * ����� �н����� ã�� ����
 *
 * @author mobilePasswordFinder.class.php workingby <bumyul2000@godo.co.kr>
 * @version 1.0
 * @date 2016-02-25
 */
class mobilePasswordFinder
{
	private $otp, $dormant, $cfg;

	function __construct()
	{
		global $shopRootDir, $cfg;

		$this->cfg = $cfg;
		$this->otp = Core::loader('gd_otp');
		if(is_file($shopRootDir.'/lib/dormant.class.php')){
			$this->dormant = Core::loader('dormant');
		}
	}

	/**
	 * �н����� ���濡 ���� �������� ó��
	 * @author workingby <bumyul2000@godo.co.kr>
	 * @param array $postData
	 * @return string
	 * @date 2016-02-25
	 */
	public function execute($postData)
	{
		try{
			$member = array();

			switch($postData['type']){
				//��ū����
				case 'setToken':
					//ȸ����ȸ
					$member = self::getMember('setToken', $postData);

					//�޸�ȸ�� ��ȸ
					if(is_object($this->dormant) && !$member['m_id']) $member = $this->dormant->findPasswordUser('name', $postData);
					if(!$member['m_id']){
						throw new Exception('0001');
					}

					//��ū ������Ʈ
					$token = self::updateToken($member);

					return '0000|'.$token;
				break;

				//OTP �߼�
				case 'sendOTP' :
					//ȸ����ȸ
					$member = self::getMember('sendOTP', $postData);

					//�޸�ȸ�� ��ȸ
					if(is_object($this->dormant) && !$member['m_id']) $member = $this->dormant->findPasswordUser('send', $postData);
					if (!$member['m_id']) {
						throw new Exception('0001');
					}

					//��ū��
					$token = $this->otp->getToken();
					if ($postData['token'] != $token) throw new Exception('0002');

					//token ������ üũ
					$checkTokenExpire = self::checkTokenExpire($member);
					if($checkTokenExpire === false){
						throw new Exception('0003');
					}

					//otp ����
					$authNum = $this->otp->getOTP();

					switch($postData['otpType']){
						case 'mail' :
							$mailData = array();
							$mailData = array_merge((array)$member, array('authNum'=>$authNum));
							$result_send_mail = self::send_mail('13', $mailData);
							if($result_send_mail === false) {
								throw new Exception('0004');
							}
						break;

						case 'mobile' :
							if($member['mobile']){
								$result = false;
								$result = self::send_sms($member, $authNum);
								if($result === false){
									throw new Exception('0008');
								}
							}
							else {
								throw new Exception('0005');
							}
						break;
					}

					//otp update
					self::updateOTP($member, $authNum);

					return '0000';

				break;

				//OTP ��
				case 'compareOTP':
					//ȸ����ȸ
					$member = self::getMember('compareOTP', $postData);

					//�޸�ȸ�� ��ȸ
					if(is_object($this->dormant) && !$member['m_id']){
						$member = $this->dormant->findPasswordUser('send', $postData);
					}
					if (!$member['m_id']) {
						throw new Exception('0001');
					}

					//token ������ üũ
					$checkTokenExpire = self::checkTokenExpire($member);
					if($checkTokenExpire === false){
						throw new Exception('0003');
					}

					if($member['otp'] == $postData['otp']){
						self::updateAuthOtp($member);

						return '0000';
					}
					else {
						throw new Exception('0006');
					}
				break;

				//password change
				case 'change' :
					//�н����� ���� üũ
					if(passwordPatternCheck($postData['newPassword']) === false) throw new Exception('0009');

					//�޸�ȸ�� �н����� ������Ʈ
					$dormantChangePasswordResult = false;
					$dormantChangePasswordResult = self::updateDormantMemberPassword($postData);
					if($dormantChangePasswordResult == false){
						throw new Exception('0007');
					}

					//�н����� ������Ʈ
					$result = self::updateMemberPassword($postData);

					if ($result) {
						//ȸ����ȸ
						$member = self::getMember('change', $postData);

						session_regenerate_id();

						self::deleteOTP($postData['m_id']);

						//��й�ȣ ���� �ȳ� ���� �߼�
						self::send_mail('14', $member);

						return '0000';
					}
					else {
						throw new Exception('0007');
					}
				break;
			}
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	/**
	 * ȸ�� ��ȸ
	 * @author workingby <bumyul2000@godo.co.kr>
	 * @param string $type, array $postData
	 * @return array $member
	 * @date 2016-02-25
	 */
	private function getMember($type, $postData)
	{
		global $db, $checked;

		$member = array();
		switch($type){
			//��ū����
			case 'setToken':
				$query = "
					SELECT
						mb.m_id, otp.token
					FROM
						".GD_MEMBER." AS mb LEFT JOIN
						".GD_OTP." AS otp
					ON
						mb.m_id = otp.m_id AND otp.expire > '".date('Y-m-d H:i:s')."'
					WHERE
						 mb.m_id = '".$db->_escape($postData['srch_id'])."' AND mb.name='".$db->_escape($postData['srch_name'])."'
				";
				if($checked['useField']['email']) $query .=  " AND mb.email='".$db->_escape($postData['srch_mail'])."'";
			break;

			//OTP �߼�
			case 'sendOTP' :
				$query = "
					SELECT
						mb.mobile, mb.email, mb.name, mb.m_id, otp.token, otp.expire
					FROM
						".GD_OTP." AS otp INNER JOIN
						".GD_MEMBER." AS mb
					ON
						otp.m_id = mb.m_id
					WHERE
						otp.m_id = '".$db->_escape($postData['m_id'])."' AND otp.token != '' AND otp.token = '".$db->_escape($postData['token'])."' AND dormant_regDate = '0000-00-00 00:00:00'
				";
			break;

			//OTP ��
			case 'compareOTP':
				$query = "
					SELECT
						 mb.m_id, otp.token, otp.otp, otp.expire
					FROM
						".GD_OTP." AS otp INNER JOIN
						 ".GD_MEMBER." AS mb
					ON
						otp.m_id = mb.m_id
					WHERE
						otp.m_id = '".$db->_escape($postData['m_id'])."' AND otp.token = '".$db->_escape($postData['token'])."' AND dormant_regDate = '0000-00-00 00:00:00'
				";
			break;

			//password change
			case 'change' :
				$query = "
					SELECT
						mb.m_id, mb.email, mb.name, otp.expire
					FROM
						".GD_OTP." AS otp INNER JOIN
						".GD_MEMBER." AS mb
					ON
						otp.m_id = mb.m_id
					WHERE
						otp.m_id = '".$db->_escape($postData['m_id'])."' AND otp.token = '".$db->_escape($postData['token'])."'
				";
			break;
		}

		if($query){
			$member = $db->fetch($query, 1);
		}

		return $member;
	}

	/**
	 * ��ū ������Ʈ
	 * @author workingby <bumyul2000@godo.co.kr>
	 * @param array $member
	 * @return string $token
	 * @date 2016-02-25
	 */
	private function updateToken($member)
	{
		global $db;

		$token = $this->otp->getToken();

		if(!$member['token'] || $token != $member['token']){
			$query = "REPLACE INTO ".GD_OTP." SET m_id = '".$db->_escape($member['m_id'])."', token = '".$db->_escape($token)."', expire = '".date('Y-m-d H:i:s', strtotime('+1 hour'))."'";
			$db->query($query);
		}

		return $token;
	}

	/**
	 * ��ū ��ȿ�Ⱓ üũ
	 * @author workingby <bumyul2000@godo.co.kr>
	 * @param array $member
	 * @return boolean
	 * @date 2016-02-25
	 */
	private function checkTokenExpire($member)
	{
		global $db;

		if ($member['expire'] < date('Y-m-d H:i:s')) {
			$db->query("DELETE FROM ".GD_OTP." WHERE m_id = '".$db->_escape($member['m_id'])."'");
			return false;
		}

		return true;
	}

	/**
	 * ���Ϲ߼�
	 * @author workingby <bumyul2000@godo.co.kr>
	 * @param string $mailmode, array $data
	 * @return boolean
	 * @date 2016-02-25
	 */
	private function send_mail($mailmode, $data)
	{
		$stringFormatter = Core::loader('stringFormatter');
		$email = $stringFormatter->get($data['email'], 'email');
		if($email !== false){
			switch($mailmode){
				case '13' :
					ob_start();
					$automail = Core::loader('automail');
					$automail->_set($mailmode, $data['email'], $this->cfg);
					$automail->_assign('name', $data['name']);
					$automail->_assign('id', $data['m_id']);
					$automail->_assign('authNum', $data['authNum']);
					$automail->_send();
					ob_end_clean();
				break;

				case '14' :
					if($this->cfg['mailyn_14'] == 'y'){
						ob_start();
						$automail = Core::loader('automail');
						$automail->_set($mailmode, $data['email'], $this->cfg);
						$automail->_assign('name', $data['name']);
						$automail->_assign('moddt', date('Y-m-d H:i:s'));
						$automail->_send();
						ob_end_clean();
					}
				break;
			}

			return true;
		}

		return false;
	}

	/**
	 * SMS �߼�
	 * @author workingby <bumyul2000@godo.co.kr>
	 * @param array $member, string $authNum
	 * @return boolean
	 * @date 2016-02-25
	 */
	private function send_sms($member, $authNum)
	{
		global $config;

		if(!is_object($config)){
			$config = Core::loader('config');
		}
		$info_cfg = $config->load('member_info');

		$sms = Core::loader('Sms');
		if(is_object($sms) && (int)$info_cfg['finder_use_mobile'] == 1){
			$sms_sendlist = $sms->loadSendlist();
			if ((int)$sms->smsPt < 1){
				return false;
			}

			$GLOBALS['dataSms']['authNum'] = $authNum;

			$msg = parseCode($info_cfg['finder_mobile_auth_message']);
			$sms->log($msg, $member['mobile'], '', 1);
			$sms_sendlist->setSimpleInsert($member['mobile'], $sms->smsLogInsertId, '');
			$sms->send($msg, $member['mobile'], $this->cfg['smsRecall']);
			$sms->update_ok_eNamoo = true;
			$sms->update();

			return true;
		}
		else {
			return false;
		}
	}

	/**
	 * OTP update
	 * @author workingby <bumyul2000@godo.co.kr>
	 * @param array $member, string $authNum
	 * @return void
	 * @date 2016-02-25
	 */
	private function updateOTP($member, $authNum)
	{
		global $db;

		$query = "UPDATE ".GD_OTP." SET otp = '".$authNum."', auth = 0 WHERE m_id = '".$db->_escape($member['m_id'])."' AND token = '".$db->_escape($member['token'])."'";
		$db->query($query);
	}

	/**
	 * OTP ���üũ
	 * @author workingby <bumyul2000@godo.co.kr>
	 * @param array $member
	 * @return void
	 * @date 2016-02-25
	 */
	private function updateAuthOtp($member)
	{
		global $db;

		$db->query("UPDATE ".GD_OTP." SET auth = 1 WHERE m_id = '".$db->_escape($member['m_id'])."' AND token = '".$db->_escape($member['token'])."'");
	}

	/**
	 * ȸ�� ��й�ȣ ����
	 * @author workingby <bumyul2000@godo.co.kr>
	 * @param array $postData
	 * @return object $result
	 * @date 2016-02-25
	 */
	private function updateMemberPassword($postData)
	{
		global $db;

		$query = "
			UPDATE
				".GD_MEMBER." AS mb INNER JOIN
				".GD_OTP." AS otp
			ON
				mb.m_id = otp.m_id AND otp.expire > '".date('Y-m-d H:i:s')."'
			SET
				mb.password = password('".$db->_escape($postData['newPassword'])."'),
				mb.password_moddt = NOW()
			WHERE
				otp.m_id = '".$db->_escape($postData['m_id'])."' and otp.token = '".$db->_escape($postData['token'])."'
		";
		$result = $db->query($query);

		return $result;
	}

	/**
	 * OTP ����
	 * @author workingby <bumyul2000@godo.co.kr>
	 * @param string $m_id
	 * @return void
	 * @date 2016-02-25
	 */
	private function deleteOTP($m_id)
	{
		global $db;

		$db->query("DELETE FROM ".GD_OTP." WHERE m_id = '".$db->_escape($m_id)."'");
	}

	/**
	 * �޸�ȸ�� �н����� ����
	 * @author workingby <bumyul2000@godo.co.kr>
	 * @param array $postData
	 * @return boolean
	 * @date 2016-02-25
	 */
	private function updateDormantMemberPassword($postData)
	{
		$dormantMember = false;
		$dormantMember = $this->dormant->checkDormantMember($postData, 'm_id');
		if($dormantMember === true){
			$dormantChangePasswordResult = false;
			$dormantChangePasswordResult = $this->dormant->findPasswordUser('change', $postData);
			//�޸�ȸ�� ��й�ȣ ���� ����
			if($dormantChangePasswordResult == false){
				return false;
			}
			else {
				return true;
			}
		}
		else {
			return true;
		}
	}
}
?>