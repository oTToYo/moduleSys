<?php

include_once('authSetting.php');


//傳送密碼

fputs($fp, "PASS $password\r\n");
$msg = fgets($fp,256);
//echo $msg;
if(substr($msg,0,1)=='-')
{
echo "0"; //帳密錯誤

}

if(substr($msg,0,1)=='+')  
{
echo "1";
}

//檢查資料庫是否有重複申請的帳號

include_once('connections/connDB.php');
$queryDefault = "Select account,pwd from user";
$result = mysql_query($queryDefault)or die(mysql_error());

while($row_result = mysql_fetch_assoc($result))
	{
		$tmpAcc = $row_result['account'];
		if($tmpAcc == $userid)
		{
			echo 2;
			break;
		}
	}






?>

      
      
 

