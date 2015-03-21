<?php 

	$account="";
	$account=$_POST['act'];
	echo $account;
	$account=explode(" ",$account)[0];
	include_once('connections/connDB.php');
		/*$query = "SELECT account FROM user WHERE account = '$account'";
		$result = mysql_query($query, $link_ID) or die(mysql_error());
		$totalRows = mysql_num_rows($result);
		if($totalRows>0)
		{
			$query = "DElETE FROM  netcompservice.user WHERE user.account='$account'";
			$result = mysql_query($query, $link_ID) or die(mysql_error());
		}*/
		
	//將每個模組內的使用者資料刪除
	$query = "select service from module";
	$result = mysql_query($query)or die(mysql_error());;
		while($row_result = mysql_fetch_assoc($result))
		{
			$delete_target_query = "delete from ".$row_result['service']."user where account='$account'";
			echo $delete_target_query;
			mysql_query($delete_target_query, $link_ID) or die(mysql_error());
		}
	header("Location: ./priviledgeManage.php");
?>