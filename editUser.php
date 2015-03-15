<?php 

	$account="";
	$type="";
	$account=$_POST['act'];
	$type=$_POST['selected'];
	
	
	$account=explode(" ",$account);
	echo $account[0]."dd";
	$actM = Array();
	/*foreach($actM as $item)
		$actMstr.=$item;
	$actMStr.="]";
	echo $actMStr;*/
	//echo json_encode($actM);
	//print_r($actM);
	if(isset($_POST['modules']))
	{
		$actM =$_POST['modules']; 
		
	}
	$actM = json_encode($actM);

	include_once('connections/connDB.php');
		$query = "SELECT account FROM user WHERE account = '$account[0]'";
		$result = mysql_query($query, $link_ID) or die(mysql_error());
		$totalRows = mysql_num_rows($result);
		if($totalRows>0)
		{
			echo "ok";
			$query = "UPDATE netcompservice.user SET user.type='$type',actUseM='$actM' WHERE user.account='$account[0]'";
			$result = mysql_query($query, $link_ID) or die(mysql_error());
		}
		//header("Location: ./priviledgeManage.php");
?>