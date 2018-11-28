<?
//  ###################################################################################
// 
//    return.php
// 
//    Copyright (c) 1997-2002 PG�� Co. LTD.
//    All rights reserved.
// 
//  ###################################################################################
//  ###################################################################################
// 
//   PG�翡�� ���� ����� �޾� DB�� �����ϴ� ���
// 
//  ###################################################################################
// 
//  [ return.php�� ȣ���Ҷ� ���ڷ� �Ѿ���� ������� ]
// 
//   1. ShopCode     : �ش� ���θ� ��ȣ(PG�翡�� �ο����� �ڵ�)
//   2. ReplyCode    : �����ڵ�� '0000'�̸� ���� �׿ܴ� ����ó���Ѵ�.
//   3. ScrMessage   : ����޽���
//   4. OrderDate    : �ŷ���û����(YYYYMMDD)
//   5. OrderTime    : �ŷ���û�ð�(HHMMSS)
//   6. SequenceNo   : �ŷ���û��ȣ
//   7. OrderNo      : �ֹ���ȣ
//   8. Installment  : �Һΰ���
//   9. AcquireCode  : ���Ի��ڵ�
//  10. AcquireName  : ���Ի��̸�
//  11. ApprovalNo   : ���ι�ȣ
//  12. ApprovalTime : �����Ͻ�(YYYYMMDDHHMM000)
//  13. CardIssuer   : ī��߱޻��̸�
//  14. tran_date    : PG���� �ŷ�����(YYYYMMDD)
//  15. tran_seq     : PG���� �ŷ���ȣ
//  16. Reserved1    : FILLER
//  17. Reserved1    : FILLER
// 
//    * Mall������ �ش� �������� �����Ͽ� ����� DB�� ������ �� �ֵ��� �Ѵ�.
// 
// 
// 
//  ###################################################################################
include "./config.php";
include "./log.php";
include "./mysql_function.php";
include "./php_function.php";

//*************************************************************************
//  PG��κ��� ���޵� ���ڸ� �Է¹޴� ��ƾ
//*************************************************************************
Function RecvFromPG()
{

   global
         $g_ShopCode    ,   $ShopCode    ,
         $g_UserID      ,   $UserID      ,
         $g_ReplyCode   ,   $ReplyCode   ,
         $g_ScrMessage  ,   $ScrMessage  ,
         $g_OrderDate   ,   $OrderDate   ,
         $g_OrderTime   ,   $OrderTime   ,
         $g_SequenceNo  ,   $SequenceNo  ,
         $g_OrderNo     ,   $OrderNo     ,
         $g_Installment ,   $Installment ,
         $g_AcquireCode ,   $AcquireCode ,
         $g_AcquireName ,   $AcquireName ,
         $g_ApprovalNo  ,   $ApprovalNo  ,
         $g_ApprovalTime,   $ApprovalTime,
         $g_CardIssuer  ,   $CardIssuer  ,
         $g_Reserved1   ,   $Reserved1   ,
         $g_Reserved2   ,   $Reserved2   ,
         $g_tran_date   ,   $tran_date   ,
         $g_tran_seq    ,   $tran_seq    ;

   $g_ShopCode          = Trim($ShopCode    );
   $g_UserID            = Trim($UserID      );
   $g_ReplyCode         = Trim($ReplyCode   );
   $g_ScrMessage        = Trim($ScrMessage  );
   $g_OrderDate         = Trim($OrderDate   );
   $g_OrderTime         = Trim($OrderTime   );
   $g_SequenceNo        = Trim($SequenceNo  );
   $g_OrderNo           = Trim($OrderNo     );
   $g_Installment       = Trim($Installment );
   $g_AcquireCode       = Trim($AcquireCode );
   $g_AcquireName       = Trim($AcquireName );
   $g_ApprovalNo        = Trim($ApprovalNo  );
   $g_ApprovalTime      = Trim($ApprovalTime);
   $g_CardIssuer        = Trim($CardIssuer  );
   $g_Reserved1         = Trim($Reserved1   );
   $g_Reserved2         = Trim($Reserved2   );
   $g_tran_date         = Trim($tran_date   );
   $g_tran_seq          = Trim($tran_seq    );

   TraceLog ("Return", "RecvFromPG",
             "ShopCode="     . $g_ShopCode       . ", " .
             "UserID="       . $g_UserID         . ", " .
             "ReplyCode="    . $g_ReplyCode      . ", " .
             "ScrMessage="   . $g_ScrMessage     . ", " .
             "OrderDate="    . $g_OrderDate      . ", " .
             "OrderTime="    . $g_OrderTime      . ", " .
             "SequenceNo="   . $g_SequenceNo     . ", " .
             "OrderNo="      . $g_OrderNo        . ", " .
             "Installment="  . $g_Installment    . ", " .
             "AcquireCode="  . $g_AcquireCode    . ", " .
             "AcquireName="  . $g_AcquireName    . ", " .
             "ApprovalNo="   . $g_ApprovalNo     . ", " .
             "ApprovalTime=" . $g_ApprovalTime   . ", " .
             "CardIssuer="   . $g_CardIssuer     . ", " .
             "tran_date="    . $g_tran_date      . ", " .
             "tran_seq="     . $g_tran_seq       . ", " .
             "Reserved1="    . $g_Reserved1      . ", " .
             "Reserved2="    . $g_Reserved2      ) ;
      
   return true;
}

//*************************************************************************
//  ���� ��������� DB�� Update �ϴ� ��ƾ
//*************************************************************************
Function UpdateDB()
{
   global    
           $TABLE_NAME       ,   $g_ApprovalNo    ,
           $g_ApprovalTime   ,   $g_AcquireCode   ,
           $g_AcquireName    ,   $g_CardIssuer    ,
           $g_ReplyCode      ,   $g_ScrMessage    ,
           $g_tran_date      ,   $g_tran_seq      ,
           $g_UserID         ,   $g_Installment   ,
           $g_OrderDate      ,   $g_SequenceNo    ,
           $g_ShopCode ;

   $strQuery  = "";
   $strQuery .=   " UPDATE  $TABLE_NAME SET ";
   $strQuery .=   "         APPROVAL_NO     ='"  . $g_ApprovalNo     . "', ";
   $strQuery .=   "         APPROVAL_TIME   ='"  . $g_ApprovalTime   . "', ";
   $strQuery .=   "         ACQUIRE_CODE    ='"  . $g_AcquireCode    . "', ";
   $strQuery .=   "         ACQUIRE_NAME    ='"  . $g_AcquireName    . "', ";
   $strQuery .=   "         CARD_ISSUER     ='"  . $g_CardIssuer     . "', ";
   $strQuery .=   "         REPLY_CODE      ='"  . $g_ReplyCode      . "', ";
   $strQuery .=   "         RESULT_MSG      ='"  . $g_ScrMessage     . "', ";
   $strQuery .=   "         TRAN_PAY_DATE   ='"  . $g_tran_date      . "', ";
   $strQuery .=   "         TRAN_PAY_SEQ    = "  . $g_tran_seq       . " , ";
   $strQuery .=   "         USER_ID         ='"  . $g_UserID         . "'  ";
   $strQuery .=   "  WHERE  SHOP_CODE       ='"  . $g_ShopCode       . "'  ";
   $strQuery .=   "    AND  ORDER_DATE      ='"  . $g_OrderDate      . "'  ";
   $strQuery .=   "    AND  SEQ_NO          = "  . $g_SequenceNo     . "   ";

   TraceLog ("Return", "Query Builder", $strQuery);

   if ( ! FncExecQuery( $strQuery ) )
   {
      TraceLog ("Return", "UpdateDB", "[ERROR] DB �۾� ����.-- (" . mysql_errno() . ")" . mysql_error() );
      return false;
   }

   return true;
}

   //*************************************************************************
   //  MAIN
   //*************************************************************************

   TraceLog ("Return", "==================", "===> Start");

   RecvFromPG();

   $bRetVal = false;

   If ( strlen(Trim($g_OrderDate)) > 0 And strlen(Trim($g_SequenceNo)) > 0 )
   {
      $bRetVal = UpdateDB();
   }

   echo ( $bRetVal ) ? "0000" : "9999";

?>