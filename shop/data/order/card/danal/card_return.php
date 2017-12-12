<?
	// from card_gate.php
	header( "Pragma: No-Cache" );
	include( "./inc/function.php" );
	include dirname(__FILE__).'/../../../conf/config.mobileShop.php';

	/******************************************************************************** 
	 *
	 * �ٳ� �޴��� ����
	 *
	 * - ���� ��û ������ 
	 *�ݾ� Ȯ�� �� ���� ��û
	 *
	 * ���� �ý��� ������ ���� ���ǻ����� �����ø� ���񽺰��������� ���� �ֽʽÿ�.
	 * DANAL Commerce Division Technique supporting Team 
	 * EMail : tech@danal.co.kr 
	 *
	 ********************************************************************************/

	$ordno = $HTTP_POST_VARS['ordno'];			// �ֹ���ȣ
	$price = $danal->getPrice($ordno);			// ���� �ݾ��� �����ϱ� ���� DB���� ������
	$isMobile = $HTTP_POST_VARS['isMobile'];	// ����� ��� ���� Ȯ��
	$isPc = $HTTP_POST_VARS['isPc'];

	$BillErr = false;
	$TransR = array();

	/*
	 * Get ServerInfo
	 */
	$ServerInfo = $HTTP_POST_VARS["ServerInfo"];  

	/*
	 * NCONFIRM
	 */
	$nConfirmOption = 1; 
	$TransR["Command"] = "NCONFIRM";
	$TransR["OUTPUTOPTION"] = "DEFAULT";
	$TransR["ServerInfo"] = $ServerInfo;
	$TransR["IFVERSION"] = "V1.1.2";
	$TransR["ConfirmOption"] = $nConfirmOption;

	/*
	 * ConfirmOption�� 1�̸� CPID, AMOUNT �ʼ� ����
	 */
	if( $nConfirmOption == 1 )
	{
		$TransR["CPID"] = $ID;
		$TransR["AMOUNT"] = $price;
	}

	$Res = CallTeledit( $TransR,false );

	if( $Res["Result"] == "0" )
	{
		/*
		 * NBILL
		 */
		$TransR = array();

		$nBillOption = 1;
		$TransR["Command"] = "NBILL";
		$TransR["OUTPUTOPTION"] = "DEFAULT";
		$TransR["ServerInfo"] = $ServerInfo;
		$TransR["IFVERSION"] = "V1.1.2";
		$TransR["BillOption"] = $nBillOption;

		$Res2 = CallTeledit( $TransR,false );

		if( $Res2["Result"] != "0" )
		{
			$BillErr = true;
		}
	}

	if( $Res["Result"] == "0" && $Res2["Result"] == "0" )
	{
		/**************************************************************************
		 *
		 * ���� �Ϸῡ ���� �۾� 
		 * - AMOUNT, ORDERID �� ���� �ŷ����뿡 ���� ������ �ݵ�� �Ͻñ� �ٶ��ϴ�.
		 *
		 **************************************************************************/

		// �����ͺ��̽� ����
		$result = array_merge($HTTP_POST_VARS, $Res, $Res2 );
		$danal->setDB($result);

		if ($isMobile && $isPc) {
			go($shopConfig['rootDir'].'/order/order_end.php?ordno='.$ordno);
		}
		else if ($isMobile && !$isPc) {
			go($cfgMobileShop['mobileShopRootDir'].'/ord/order_end.php?ordno='.$ordno);
		}
		else {
			echo "<script>opener.parent.location.replace('".$shopConfig['rootDir']."/order/order_end.php?ordno=".$ordno."')</script>";
			echo '<script>window.close();</script>';
		}
	}
	else {
		/**************************************************************************
		 *
		 * ���� ���п� ���� �۾� 
		 *
		 **************************************************************************/

		if( $BillErr ) $Res = $Res2;

		$Result		= $Res["Result"];
		$ErrMsg		= $Res["ErrMsg"];
		$AbleBack	= false;
		$BackURL	= $HTTP_POST_VARS["BackURL"];
		$IsUseCI	= $HTTP_POST_VARS["IsUseCI"];
		$CIURL		= $HTTP_POST_VARS["CIURL"];
		$BgColor	= $HTTP_POST_VARS["BgColor"];
		
		// ���� ���� �α� �ۼ�
		$danal->failLog($ordno, $Result, $ErrMsg);

		if (isset($isMobile)) {
			include( "./card_mobile_error.php" );
		}
		else {
			include( "./card_error.php" );
		}
	}
?>
