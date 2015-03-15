<?php 

	$userName="";
	$levelNum="";
	$userName=$_POST['userName'];
	$userName=explode(" ",$userName)[0];
	echo $userName;
	$moduleStr="[";
	if(!empty($_POST['modules']))
	{
		$modules=$_POST['modules'];
		for($i=0;$i<count($modules);$i++)
		{
			$moduleStr =$moduleStr.$modules[$i];
			if($i+1 !=count($modules) )
			$moduleStr =$moduleStr.",";	
		}
	}
	$moduleStr=$moduleStr."]";	
	
	//$moduleStr= json_encode($moduleStr);
	
	include_once('connections/connDB.php');
		$query = "UPDATE  user set adM='$moduleStr' where account='$userName'";
		$result = mysql_query($query, $link_ID) or die(mysql_error());
	//header("Location: ./priviledgeManage.php");
?>