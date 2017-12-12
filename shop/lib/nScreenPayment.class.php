<?php
class nScreenPayment
{
	private $_mobile_agents = array(
				'iPhone',
				'Mobile',
				'UP.Browser',
				'Android',
				'BlackBerry',
				'Windows CE',
				'Nokia',
				'webOS',
				'Opera Mini',
				'SonyEricsson',
				'opera mobi',
				'Windows Phone',
				'IEMobile',
				'POLARIS',
				'lgtelecom',
				'NATEBrowser',
			);

	private $_screen = 'PC';
	private $_pg_config;
	private $_pg_mobile_config;
	private $_settle_pg = '';
	private $_settleprice;
	private $_tax;
	private $_vat;
	private $_taxfree;
	private $_ordno;

	public function __construct()
	{
		$this->getScreenType();

		$this->_setPgConfig();

	}

	public function executeCardGate($settleprice, $settlekind, $is_mobile=false, $tax=0, $vat=0, $taxfree=0, $ordno='')
	{
		global $config;
		$cfg = $config->load('config');

		$this->_settleprice = $settleprice;
		$this->_tax = $tax;
		$this->_vat = $vat;
		$this->_taxfree = $taxfree;
		$this->_ordno = $ordno;

		$mobilians = Core::loader('Mobilians');
		$danal = Core::loader('Danal');

		if ($settlekind == 'i')
		{
			$this->_settle_pg = 'ipay';
		}
		else if ($settlekind == 'h' && $cfg['settleCellPg'] === 'mobilians' && $mobilians->isEnabled()) {
			$this->_settle_pg = 'mobilians';
		}
		else if ($settlekind == 'h' && $cfg['settleCellPg'] === 'danal' && $danal->isEnabled()) {
			$this->_settle_pg = 'danal';
		}
		else if ($settlekind == 't'){
			$this->_settle_pg = 'payco';
		}

		if($is_mobile) {
			$this->executeCardGateByPgMobile($settlekind);
		}
		else {
			if($this->_screen == 'MOBILE') {
				if($this->_settle_pg == 'mobilians') {
					$this->executeCardGateByPg();
				}
				else {
					$this->executeCardGateByPgMobile($settlekind, $this->_screen);
				}
			}
			else {
				$this->executeCardGateByPg($settlekind);
			}
		}
	}

	public function executeCardGateByPg($settlekind)
	{
		global $config,$db;
		$cfg = $config->load('config');

		switch($this->_settle_pg)
		{
			case "allat":
				$allat_multi_amt = '';
				if ($this->_taxfree > 0 && $this->_pg_config['tax'] === '1') {
					$allat_multi_amt = sprintf('%0d|%0d|%0d', $this->_tax, $this->_vat, $this->_taxfree);
					$db->query("update gd_order set pgTax='1' where ordno='".$this->_ordno."'");
				}
				else {
				}

				echo "<script>
					if(parent.document.getElementsByName('allat_amt')[0].value == '".$this->_settleprice."'){
						if(typeof parent.document.getElementsByName('allat_multi_amt')[0] == 'undefined') {
							var form = parent.document.getElementsByName('fm')[0];
							var multiamtinput = document.createElement('input');
							multiamtinput.setAttribute('type', 'hidden');
							multiamtinput.setAttribute('name', 'allat_multi_amt');
							multiamtinput.setAttribute('value', '".$allat_multi_amt."');
							form.appendChild(multiamtinput);
						} else {
							parent.document.getElementsByName('allat_multi_amt')[0].value = '".$allat_multi_amt."';
						}
						parent.ftn_app();
					}else{
						alert('�����ݾ��� �ùٸ��� �ʽ��ϴ�.');
						parent.location.replace('order.php');
					}
					</script>";
				exit;
				break;
			case "allatbasic":
				$allat_multi_amt = '';
				if ($this->_taxfree > 0 && $this->_pg_config['tax'] === '1') {
					$allat_multi_amt = sprintf('%0d|%0d|%0d', $this->_tax, $this->_vat, $this->_taxfree);
					$db->query("update gd_order set pgTax='1' where ordno='".$this->_ordno."'");
				}
				else {
				}

				echo "<script>
					if(parent.document.getElementsByName('allat_amt')[0].value == '".$this->_settleprice."'){
						if(typeof parent.document.getElementsByName('allat_multi_amt')[0] == 'undefined') {
							var form = parent.document.getElementsByName('fm')[0];
							var multiamtinput = document.createElement('input');
							multiamtinput.setAttribute('type', 'hidden');
							multiamtinput.setAttribute('name', 'allat_multi_amt');
							multiamtinput.setAttribute('value', '".$allat_multi_amt."');
							form.appendChild(multiamtinput);
						} else {
							parent.document.getElementsByName('allat_multi_amt')[0].value = '".$allat_multi_amt."';
						}
						parent.ftn_approval();
					}else{
					alert('�����ݾ��� �ùٸ��� �ʽ��ϴ�.');
					parent.location.replace('order.php');
					}
					</script>";
				exit;
				break;
			case "inipay":
				// �̴Ͻý� 5.0 �� ���հ��� �� �ΰ����� �鼼�� ����  **����!! �ʵ�� tax�� �ΰ�����
				$_SESSION['INI_TAX']		= $this->_vat;		// �ΰ���
				$_SESSION['INI_TAXFREE']	= $this->_taxfree;	// �鼼
				echo "<script>
					if(parent.document.getElementsByName('INISettlePrice')[0].value == '".$this->_settleprice."'){
						var fm=parent.document.ini; if (parent.pay(fm)) fm.submit();
					}else{
						alert('�����ݾ��� �ùٸ��� �ʽ��ϴ�.');
						parent.location.replace('order.php');
					}
					</script>";
				exit;
				break;
			case "inicis":
				// �̴Ͻý� 4.1 �� ���հ��� �� �ΰ����� �鼼�� ����  **����!! �ʵ�� tax�� �ΰ�����
				echo "<script>
					if(parent.document.getElementsByName('price')[0].value == '".$this->_settleprice."'){
						if(typeof parent.document.getElementsByName('tax')[0] == 'undefined') {
							var form = parent.document.getElementsByName('ini')[0];
							var taxinput = document.createElement('input');
							taxinput.setAttribute('type', 'hidden');
							taxinput.setAttribute('name', 'tax');
							taxinput.setAttribute('value', '".$this->_vat."');
							form.appendChild(taxinput);
						} else {
							parent.document.getElementsByName('tax')[0].value = '".$this->_vat."';
						}
						if(typeof parent.document.getElementsByName('taxfree')[0] == 'undefined') {
							var form = parent.document.getElementsByName('ini')[0];
							var taxfreeinput = document.createElement('input');
							taxfreeinput.setAttribute('type', 'hidden');
							taxfreeinput.setAttribute('name', 'taxfree');
							taxfreeinput.setAttribute('value', '".$this->_taxfree."');
							form.appendChild(taxfreeinput);
						} else {
							parent.document.getElementsByName('taxfree')[0].value = '".$this->_taxfree."';
						}
						var fm=parent.document.ini; if (parent.pay(fm)) fm.submit();
					}else{
						alert('�����ݾ��� �ùٸ��� �ʽ��ϴ�.');
						parent.location.replace('order.php');
					}
					</script>";
				exit;
				break;
			case "agspay":
				echo "<script>
					if(parent.document.getElementsByName('Amt')[0].value == '".$this->_settleprice."'){
						var fm=parent.document.frmAGS_pay; if (parent.Pay(fm)) parent.Pay(fm);
					}else{
						alert('�����ݾ��� �ùٸ��� �ʽ��ϴ�.');
						parent.location.replace('order.php');
					}
					</script>";
				exit;
				break;
			case "dacom":
				echo "<script>
					if(parent.document.getElementsByName('amount')[0].value == '".$this->_settleprice."'){
						parent.openWindow();
					}else{
						alert('�����ݾ��� �ùٸ��� �ʽ��ϴ�.');
						parent.location.replace('order.php');
					}
					</script>";
				exit;
				break;
			case "lgdacom":
				// ���������� �� ���հ��� �� �鼼�� ����
				if ($settlekind == 'u') {
					// cups
					echo "<script>
						if(parent.document.getElementsByName('LGD_AMOUNT')[0].value == '".$this->_settleprice."'){
							if(typeof parent.document.getElementsByName('LGD_TAXFREEAMOUNT')[0] == 'undefined') {
								var form = parent.document.getElementById('LGD_PAYINFO');
								var taxfreeinput = document.createElement('input');
								taxfreeinput.setAttribute('type', 'hidden');
								taxfreeinput.setAttribute('name', 'LGD_TAXFREEAMOUNT');
								taxfreeinput.setAttribute('value', '".$this->_taxfree."');
								form.appendChild(taxfreeinput);
							} else {
								parent.document.getElementsByName('LGD_TAXFREEAMOUNT')[0].value = '".$this->_taxfree."';
							}
							parent.doPay_CUPS();
						}else{
							alert('�����ݾ��� �ùٸ��� �ʽ��ϴ�.');
							parent.location.replace('order.php');
						}
						</script>";
				}
				else if (checkPatchPgStandard('lgdacom') === true) { // PC PG ǥ�ذ���â ��ġ����
					echo "<script>
						if(parent.document.getElementsByName('LGD_AMOUNT')[0].value == '".$this->_settleprice."'){
							parent.document.getElementsByName('LGD_TAXFREEAMOUNT')[0].value = '".$this->_taxfree."';
							parent.launchCrossPlatform();
						}else{
							alert('�����ݾ��� �ùٸ��� �ʽ��ϴ�.');
							parent.location.replace('order.php');
						}
						</script>";
				}
				else {
					// ���� ���� ���
					echo "<script>
						if(parent.document.getElementsByName('LGD_AMOUNT')[0].value == '".$this->_settleprice."'){
							if(typeof parent.document.getElementsByName('LGD_TAXFREEAMOUNT')[0] == 'undefined') {
								var form = parent.document.getElementById('LGD_PAYINFO');
								var taxfreeinput = document.createElement('input');
								taxfreeinput.setAttribute('type', 'hidden');
								taxfreeinput.setAttribute('name', 'LGD_TAXFREEAMOUNT');
								taxfreeinput.setAttribute('value', '".$this->_taxfree."');
								form.appendChild(taxfreeinput);
							} else {
								parent.document.getElementsByName('LGD_TAXFREEAMOUNT')[0].value = '".$this->_taxfree."';
							}
							parent.doPay_ActiveX();
						}else{
							alert('�����ݾ��� �ùٸ��� �ʽ��ϴ�.');
							parent.location.replace('order.php');
						}
						</script>";
				}
				exit;
				break;
			case "kcp":
				$kcp_tax = $kcp_taxfree = $kcp_vat = $kcp_tax_flag = '';
				if ($this->_pg_config['tax'] == '1' && $this->_taxfree > 0) {
					$db->query("update gd_order set pgTax='1' where ordno='".$this->_ordno."'");
					$kcp_tax = $this->_tax;
					$kcp_taxfree = $this->_taxfree;
					$kcp_vat = $this->_vat;
					$kcp_tax_flag = 'TG03';
				}
				else {}
				echo "<script>
					if(parent.document.getElementsByName('good_mny')[0].value == '".$this->_settleprice."'){
						if(typeof parent.document.getElementsByName('comm_tax_mny')[0] == 'undefined') {
							var form = parent.document.getElementsByName('order_info')[0];
							try {
								var taxinput = document.createElement('<input TYPE=hidden name=comm_tax_mny value=".$kcp_tax.">');
							}
							catch(e) {
								var taxinput = document.createElement('input');
								taxinput.setAttribute('type', 'hidden');
								taxinput.setAttribute('name', 'comm_tax_mny');
								taxinput.setAttribute('value', '".$kcp_tax."');
							}
							form.appendChild(taxinput);
						} else {
							parent.document.getElementsByName('comm_tax_mny')[0].value = '".$kcp_tax."';
						}
						if(typeof parent.document.getElementsByName('comm_free_mny')[0] == 'undefined') {
							var form = parent.document.getElementsByName('order_info')[0];
							try {
								var taxfreeinput = document.createElement('<input TYPE=hidden name=comm_free_mny value=".$kcp_taxfree.">');
							}
							catch(e) {
								var taxfreeinput = document.createElement('input');
								taxfreeinput.setAttribute('type', 'hidden');
								taxfreeinput.setAttribute('name', 'comm_free_mny');
								taxfreeinput.setAttribute('value', '".$kcp_taxfree."');
							}
							form.appendChild(taxfreeinput);
						} else {
							parent.document.getElementsByName('comm_free_mny')[0].value = '".$kcp_taxfree."';
						}
						if(typeof parent.document.getElementsByName('comm_vat_mny')[0] == 'undefined') {
							var form = parent.document.getElementsByName('order_info')[0];
							try {
								var taxfreeinput = document.createElement('<input TYPE=hidden name=comm_vat_mny value=".$kcp_vat.">');
							}
							catch(e) {
								var taxfreeinput = document.createElement('input');
								taxfreeinput.setAttribute('type', 'hidden');
								taxfreeinput.setAttribute('name', 'comm_vat_mny');
								taxfreeinput.setAttribute('value', '".$kcp_vat."');
							}
							form.appendChild(taxfreeinput);
						} else {
							parent.document.getElementsByName('comm_vat_mny')[0].value = '".$kcp_vat."';
						}
						if(typeof parent.document.getElementsByName('tax_flag')[0] == 'undefined') {
							var form = parent.document.getElementsByName('order_info')[0];
							try {
								var taxfreeinput = document.createElement('<input TYPE=hidden name=tax_flag value=".$kcp_tax_flag.">');
							}
							catch(e) {
								var taxfreeinput = document.createElement('input');
								taxfreeinput.setAttribute('type', 'hidden');
								taxfreeinput.setAttribute('name', 'tax_flag');
								taxfreeinput.setAttribute('value', '".$kcp_tax_flag."');
							}
							form.appendChild(taxfreeinput);
						} else {
							parent.document.getElementsByName('tax_flag')[0].value = '".$kcp_tax_flag."';
						}
						var fm=parent.document.order_info; if(parent.jsf__pay(fm))fm.submit();
					}else{
						alert('�����ݾ��� �ùٸ��� �ʽ��ϴ�.');
						parent.location.replace('order.php');
					}
					</script>";
				exit;
				break;
			case "easypay":
				echo "<script>
					if(parent.document.getElementsByName('EP_product_amt')[0].value == '".$this->_settleprice."'){
						var fm=parent.document.frm_pay; if(parent.f_submit(fm))fm.submit();
					}else{
						alert('�����ݾ��� �ùٸ��� �ʽ��ϴ�.');
						parent.location.replace('order.php');
					}
					</script>";
				exit;
				break;
			case "ipay":
				exit("
				<script type='text/javascript'>
				var idxs = parent.document.getElementsByName('idxs[]');
				var param = '';
				for (var i=0,m=idxs.length;i<m;i++) {
					if (idxs[i].checked == true) param += '&idxs[]='+idxs[i].value;
				}

				var f = parent.document.frmSettle;
				f.action = '../goods/auctionIpay.pg.php?ipay_pg=y&mode=cart'+param;
				f.target = 'ifrmHidden';
				f.submit();
				</script>
				");
				break;
			case "settlebank":
				echo "<script>
					if(parent.document.getElementsByName('PAmt')[0].value == '".$this->_settleprice."'){
						parent.submitSettleFormPopup();
					}else{
						alert('�����ݾ��� �ùٸ��� �ʽ��ϴ�.');
						parent.location.replace('order.php');
					}
					</script>";
				exit;
				break;
			case 'mobilians' :
				exit('
				<script type="text/javascript">
				var f = parent.document.frmSettle;
				f.action = "'.$cfg['rootDir'].'/order/card/mobilians/card_gate.php";
				f.target = "ifrmHidden";
				f.submit();
				</script>
				');
				break;
			case 'danal' :
				exit('
				<script type="text/javascript">
				var f = parent.document.frmSettle;
				f.action = "'.$cfg['rootDir'].'/order/card/danal/card_gate.php";
				f.target = "ifrmHidden";
				f.submit();
				</script>
				');
				break;
			case 'payco' :
				if($_POST['paycoType'] == 'CHECKOUT'){
					include '../order/card/payco/card_gate.php';
				}
				else {
					echo '
					<script type="text/javascript">
					var f = parent.document.frmSettle;

					//form ���� ����
					var oriAction	= f.action;
					var oriTarget	= f.target;

					f.action = "'.$cfg['rootDir'].'/order/card/payco/card_gate.php";
					f.target = "paycoPopup";
					f.submit();

					f.action = oriAction;
					f.target = oriTarget;
					</script>
					';
				}
				exit;

				break;
		}
	}

	public function executeCardGateByPgMobile($settlekind, $screen_type=null)
	{
		global $config,$db;
		$cfg = $config->load('config');

		switch($this->_settle_pg)
		{
			case "allat":
				$allat_multi_amt = '';
				if ($this->_taxfree > 0 && $this->_pg_config['tax'] === '1') {
					$allat_multi_amt = sprintf('%0d|%0d|%0d', $this->_tax, $this->_vat, $this->_taxfree);
					$db->query("update gd_order set pgTax='1' where ordno='".$this->_ordno."'");
				}
				else {
				}

				echo "<script>
					if(parent.document.getElementsByName('allat_amt')[0].value == '".$this->_settleprice."'){
						parent.document.getElementsByName('allat_multi_amt')[0].value = '".$allat_multi_amt."';
						parent.approval();
					}else{
						alert('�����ݾ��� �ùٸ��� �ʽ��ϴ�.');
						parent.location.replace('order.php');
					}
					</script>";
				exit;
				break;
			case "allatbasic":
				$allat_multi_amt = '';
				if ($this->_taxfree > 0 && $this->_pg_config['tax'] === '1') {
					$allat_multi_amt = sprintf('%0d|%0d|%0d', $this->_tax, $this->_vat, $this->_taxfree);
					$db->query("update gd_order set pgTax='1' where ordno='".$this->_ordno."'");
				}
				else {
				}

				echo "<script>
					if(parent.document.getElementsByName('allat_amt')[0].value == '".$this->_settleprice."'){
						parent.document.getElementsByName('allat_multi_amt')[0].value = '".$allat_multi_amt."';
						parent.approval();
					}else{
						alert('�����ݾ��� �ùٸ��� �ʽ��ϴ�.');
					parent.location.replace('order.php');
					}
					</script>";
				exit;
				break;
			case "inicis":
				// �̴Ͻý� 4.1 �� ���հ��� �� �ΰ����� �鼼�� ����  **����!! �ʵ�� tax�� �ΰ�����
				echo "<script>
					if(parent.document.getElementsByName('P_AMT')[0].value == '".$this->_settleprice."'){
						parent.document.getElementsByName('P_TAX')[0].value = '".$this->_vat."';
						parent.document.getElementsByName('P_TAXFREE')[0].value = '".$this->_taxfree."';
						parent.on_card();
					}else{
						alert('�����ݾ��� �ùٸ��� �ʽ��ϴ�.');
						parent.location.replace('order.php');
					}
					</script>";
				exit;
				break;
			case "inipay":
				// �̴Ͻý� 5.0 �� ���հ��� �� �ΰ����� �鼼�� ����  **����!! �ʵ�� tax�� �ΰ�����
				echo "<script>
					if(parent.document.getElementsByName('P_AMT')[0].value == '".$this->_settleprice."'){
						parent.document.getElementsByName('P_TAX')[0].value = '".$this->_vat."';
						parent.document.getElementsByName('P_TAXFREE')[0].value = '".$this->_taxfree."';
						parent.on_card();
					}else{
						alert('�����ݾ��� �ùٸ��� �ʽ��ϴ�.');
						parent.location.replace('order.php');
					}
					</script>";
				exit;
				break;
			case "lgdacom":
				// ���������� �� ���հ��� �� �鼼�� ����
				echo "<script>
					if(parent.document.getElementsByName('LGD_AMOUNT')[0].value == '".$this->_settleprice."'){
						parent.document.getElementsByName('LGD_TAXFREEAMOUNT')[0].value = '".$this->_taxfree."';
						parent.launchCrossPlatform();

					}else{
						alert('�����ݾ��� �ùٸ��� �ʽ��ϴ�.');
						parent.location.replace('order.php');
					}
					</script>";
				exit;
				break;
			case "agspay":
				echo "<script>
					if(parent.document.getElementsByName('Amt')[0].value == '".$this->_settleprice."'){
						parent.Pay();
					}else{
						alert('�����ݾ��� �ùٸ��� �ʽ��ϴ�.');
						parent.location.replace('order.php');
					}
					</script>";
				exit;
				break;
			case "easypay":
				echo "<script>
					if(parent.document.getElementsByName('sp_pay_mny')[0].value == '".$this->_settleprice."'){
						parent.f_submit();
					}else{
						alert('�����ݾ��� �ùٸ��� �ʽ��ϴ�.');
						parent.location.replace('order.php');
					}
					</script>";
				exit;
				break;
			case "settlebank":
				echo "<script>
					if(parent.document.getElementsByName('PAmt')[0].value == '".$this->_settleprice."'){
						parent.submitForm();
					}else{
						alert('�����ݾ��� �ùٸ��� �ʽ��ϴ�.');
						parent.location.replace('order.php');
					}
					</script>";
				exit;
				break;
			case 'mobilians' :
				if($screen_type == 'MOBILE') {
					exit('
					<script type="text/javascript">
					var f = parent.document.frmSettle;
					f.action = "'.$cfg['rootDir'].'/order/card/mobilians/card_gate.php";
					f.target = "ifrmHidden";
					f.submit();
					</script>
					');
				}
				else {
					exit('
					<script type="text/javascript">
					var f = parent.document.frmSettle;
					f.action = "'.$cfg['rootDir'].'/order/card/mobilians/card_gate.php?pc=true&isMobile=true";
					f.target = "ifrmHidden";
					f.submit();
					</script>
					');
				}
				break;
			case 'danal' :
				exit('
				<script type="text/javascript">
				var f = parent.document.frmSettle;
				f.action = "'.$cfg['rootDir'].'/order/card/danal/card_gate.php?pc=true&isMobile=true";
				f.target = "ifrmHidden";
				f.submit();
				</script>
				');
				break;
			case "kcp":
				$kcp_tax = $kcp_taxfree = $kcp_vat = $kcp_tax_flag = '';
				if ($this->_pg_config['tax'] == '1' && $this->_taxfree > 0) {
					$db->query("update gd_order set pgTax='1' where ordno='".$this->_ordno."'");
					$tax = $this->_tax;
					$taxfree = $this->_taxfree;
					$vat = $this->_vat;
					$tax_flag = 'TG03';
				}
				else {}
				echo "<script>
					if(parent.document.getElementsByName('good_mny')[0].value == '".$this->_settleprice."'){
						parent.document.getElementsByName('comm_tax_mny')[0].value = '".$kcp_tax."';
						parent.document.getElementsByName('comm_vat_mny')[0].value = '".$kcp_vat."';
						parent.document.getElementsByName('comm_free_mny')[0].value = '".$kcp_taxfree."';
						parent.document.getElementsByName('tax_flag')[0].value = '".$kcp_tax_flag."';
						parent.kcp_AJAX();
					}else{
						alert('�����ݾ��� �ùٸ��� �ʽ��ϴ�.');
						parent.location.replace('order.php');
					}
					</script>";
				exit;
				break;
			case 'payco' :
				if($_POST['paycoType'] == 'CHECKOUT'){
					include '../order/card/payco/card_gate.php';
				}
				else {
					echo '
					<script type="text/javascript">
					var f = parent.document.frmSettle;

					//form ���� ����
					var oriAction	= f.action;
					var oriTarget	= f.target;

					f.action = "'.$cfg['rootDir'].'/order/card/payco/card_gate.php";
					f.target = "ifrmHidden";
					f.submit();

					f.action = oriAction;
					f.target = oriTarget;
					</script>
					';
				}
				exit;

				break;
		}
	}


	//card_gate ������ ��������(����̽� �� �б�)
	public function getCardGate($tpl, $cart, $is_mobile=false)
	{
		global $config;
		$cfg = $config->load('config');
		if($is_mobile === true) {

			if ((is_array($this->_pg_mobile_config) && !empty($this->_pg_mobile_config))&& isset($this->_pg_config['id']) && strlen($this->_pg_config['id']) > 0) {
				ob_start();
				include (SHOPROOT.'/order/card/'.$this->_settle_pg.'/mobile/card_gate.php');
				$card_gate = ob_get_contents();
				ob_end_clean();
				$tpl->assign('card_gate',$card_gate);
			}
		}
		else {

			@include(SHOPROOT.'/conf/config.nscreenPayment.php');

			if($this->_screen == 'MOBILE' && $config_nscreen_payment['use']) {

				//nscreen_settle.htm ���� üũ�Ͽ� ������ ���� ��� �����Ѵ�.
				$key_file = 'order/nscreen_settle.htm';

				$key_file_path = SHOPROOT.'/data/skin/'.$cfg['tplSkin'].'/'.$key_file;

				// ��Ų�� order/nscreen_settle.htm �� ���ų�, pg�� dacom �� ��� nscreen ���� ���� ����
				if(!file_exists($key_file_path) || $this->_settle_pg=='dacom' ) {

					include (SHOPROOT.'/order/card/'.$this->_settle_pg.'/card_gate.php');
					$tpl->assign('pg',$this->_pg_config);
					$tpl->define('card_gate','order/card/'.$this->_settle_pg.'.htm');

				}
				else {
					$tpl->define( array(
						'tpl'			=> $key_file,
					) );

					if (isset($this->_pg_config['id']) && strlen($this->_pg_config['id']) > 0) {
						ob_start();
						include (SHOPROOT.'/order/card/'.$this->_settle_pg.'/mobile/nscreen_card_gate.php');
						$card_gate = ob_get_contents();
						ob_end_clean();

						$tpl->assign('card_gate',$card_gate);
					}
				}
			}
			else {
				if (checkPatchPgStandard($this->_settle_pg) === true) { // PC PG ǥ�ذ���â ��ġ����
					include (SHOPROOT.'/order/card/'.$this->_settle_pg.'/card_gate_std.php');
					$tpl->assign('pg',$this->_pg_config);
					$tpl->define('card_gate','order/card/'.$this->_settle_pg.'_std.htm');
				}
				else {
					include (SHOPROOT.'/order/card/'.$this->_settle_pg.'/card_gate.php');
					$tpl->assign('pg',$this->_pg_config);
					$tpl->define('card_gate','order/card/'.$this->_settle_pg.'.htm');
				}
			}
		}
	}

	public function getScreenType()
	{
		foreach($this->_mobile_agents as $mobile_agent) {

			if(strstr(strtolower($_SERVER['HTTP_USER_AGENT']), strtolower($mobile_agent))) {
				$this->_screen = 'MOBILE';
				break;
			}
		}
		return $this->_screen;
	}

	private function _setPgConfig()
	{
		global $config;
		$cfg = $config->load('config');

		$this->_settle_pg = $cfg['settlePg'];

		@include(SHOPROOT.'/conf/pg.'.$this->_settle_pg.'.php');
		@include(SHOPROOT.'/conf/pg_mobile.'.$this->_settle_pg.'.php');

		$this->_pg_config = $pg;
		$this->_pg_mobile_config = $pg_mobile;
	}
}