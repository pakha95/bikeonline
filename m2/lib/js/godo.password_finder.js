var passwordFinder = function()
{
	var self = this;
	var ajaxFindPasswordUrl = "./_ajax.indb.find_password.php";

	this.returnError = function(code){
		switch (code) {
			case '0001':
				alert('ȸ�� ������ �������� �ʽ��ϴ�.');
				break;
			case '0002':
				alert('�߸��� �����Դϴ�. �ٽ� �õ��� �ּ���.');
				break;
			case '0003':
				alert('��ȿ�Ⱓ�� ����Ǿ����ϴ�. �ٽ� �õ��� �ּ���.');
				break;
			case '0004':
				alert('������ �Ұ����� �̸��� �ּ� �Դϴ�.');
				break;
			case '0005':
				alert('������ �Ұ����� �޴��� ��ȣ �Դϴ�.');
				break;
			case '0006':
				alert('������ȣ�� ��Ȯ�� �Է��� �ּ���.');
				break;
			case '0007':
				alert('��й�ȣ ������ ���������� �Ϸ���� �ʾҽ��ϴ�.\n\n�ٽ� �õ��� �ּ���.');
				break;
			case '0008':
				alert('�����ȣã�� �޴�����ȣ ���� �� ��߱� ���� ����� ��ְ� �߻��Ͽ����ϴ�.\n\n�ٸ� ���񽺷� �����ȣã�⸦ �����Ͽ� �ּ���.');
				break;
			case '0009':
				alert('10~16���� ������ҹ���,����,Ư�����ڸ� �����Ͽ� ����� �� �ֽ��ϴ�.');
				break;
			default:
				alert('��Ÿ ������ �߻��Ͽ����ϴ�.\n\n�����Ϳ� �����Ͽ� �ּ���.');
				break;
		}
	}

	this.setToken = function(otpType, srch_id, srch_name, srch_mail) {
		$.post(ajaxFindPasswordUrl, {
			type : "setToken",
			srch_id : srch_id,
			srch_name : srch_name,
			srch_mail : srch_mail
		},
		function(responseData) {
			result = new Array();
			result = responseData.split("|");

			var resultCode = result[0];
			var token = result[1];

			if(resultCode == '0000'){
				//OTP �߼�
				self.sendOTP(otpType, token, srch_id);
			}
			else {
				self.returnError(resultCode);
			}
		});
	}

	this.sendOTP = function(otpType, token, srch_id) {
		$.post(ajaxFindPasswordUrl, {
			type : "sendOTP",
			otpType : otpType,
			m_id : srch_id,
			token : token
		},
		function(responseData) {
			if(responseData == '0000'){
				if(otpType == 'mail'){
					alert('������ȣ�� ������ �����ּҷ� ���� �Ǿ����ϴ�.');
				}
				else if(otpType == 'mobile'){
					alert('������ȣ�� ������ �ڵ��� ��ȣ�� ���� �Ǿ����ϴ�.');
				}
				else {

				}

				$("#find_password_form input[name='otpType']").val(otpType);
				$("#find_password_form input[name='token']").val(token);
				$("#find_password_form input[name='m_id']").val(srch_id);
				$('#find_password_form').attr('action','./find_password_auth.php').submit();
			}
			else {
				self.returnError(responseData);
			}
		});
	}

	this.resendOTP = function (otpType, token, srch_id){
		$.post(ajaxFindPasswordUrl, {
			type : "sendOTP",
			otpType : otpType,
			m_id : srch_id,
			token : token
		},
		function(responseData) {
			if(responseData == '0000'){
				alert('������ȣ�� ������ �Ǿ����ϴ�.');
			}
			else {
				self.returnError(responseData);

				window.location.replace('./find_password.php');
			}
		});
	}

	this.compareOTP = function (token, m_id, otp){
		$.post(ajaxFindPasswordUrl, {
			type : "compareOTP",
			m_id : m_id,
			otp : otp,
			token : token
		},
		function(responseData) {
			if(responseData == '0000'){
				$('#find_password_auth_form').attr('action','./change_password.php').submit();
			}
			else {
				self.returnError(responseData);

				if(responseData != '0006'){
					window.location.replace('./find_password.php');
				}
			}
		});
	}

	this.changePwd = function (token, m_id, newPassword){
		$.post(ajaxFindPasswordUrl, {
			type : "change",
			token : token,
			m_id : m_id,
			newPassword : newPassword
		},
		function(responseData) {
			if(responseData == '0000'){
				alert("��й�ȣ ������ �Ϸ�Ǿ����ϴ�.");
				window.location.replace('../index.php');
			}
			else {
				self.returnError(responseData);
			}
		});
	}
}