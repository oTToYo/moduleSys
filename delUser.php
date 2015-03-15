<?php 

	$account="";
	$account=$_POST['act'];
	echo $account;
	$account=explode(" ",$account)[0];
	include_once('connections/connDB.php');
		$query = "SELECT account FROM user WHERE account = '$account'";
		$result = mysql_query($query, $link_ID) or die(mysql_error());
		$totalRows = mysql_num_rows($result);
		if($totalRows>0)
		{
			$query = "DElETE FROM  netcompservice.user WHERE user.account='$account'";
			$result = mysql_query($query, $link_ID) or die(mysql_error());
		}
	header("Location: ./priviledgeManage.php");
?>