<?php
include_once('sessionCheck.php');
	header("Content-Type:text/html; charset=utf-8");
	
	//$account="";
	//$password="";
	//$type="";
	

	
	if(!empty($_POST['act'])&&!empty($_POST['selected'])&&!empty($_POST['nick']))
	{
	$account=$_POST['act'];
	//$password=$_POST['pwd'];
	$type=$_POST['selected'];
	$nickName=$_POST['nick'];
	
	echo $account.$nickName.$type;
	include_once('connections/connDB.php');
	$queryDefault = "Select useM from priviledge_type where name='$type'";
	$result = mysql_query($queryDefault)or die(mysql_error());
	$row_result = mysql_fetch_assoc($result);
	$default = $row_result['useM'];
		//$query = "INSERT INTO  netcompservice.user(account,pwd,type,actUseM)VALUES('$account','$password','$type','$default')";
		$query = "INSERT INTO  netcompservice.user(account,type,actUseM,adM,nickName)VALUES('$account','$type','$default','[]','$nickName')";
		mysql_query($query)or die(mysql_error());
		
		//在每個service 新增user
		
		$default = json_decode($default);
		
		foreach($default as $moduleNo)
		{
			if($moduleNo!=0)
			{
				$query = "select service from module where moduleNo='$moduleNo' ";
				$result =mysql_query($query)or die(mysql_error());
				$row_result = mysql_fetch_assoc($result);
				echo $row_result['service'];
				
				//找到group 對應的預設權限
				$query_getDefault = "select defaultP from ".$row_result['service']."relation where groupName='$type'";
				$getDefault_result = mysql_query($query_getDefault)or die(mysql_error());
				$get_defaultP = mysql_fetch_assoc($getDefault_result);
				$defaultP  = $get_defaultP['defaultP'];
				
				$query = "INSERT INTO ".$row_result['service']."user(account,func)VALUES('$account','$defaultP')";
				echo "<p> ". $query;
				mysql_query($query)or die(mysql_error());
			}
			
			
		}
	}
	else 
		echo "資訊輸入不完全"
		//$query = "INSERT INTO  netcompservice.user(account,pwd,type,actUseM)VALUES('$account','$password','$type','$default')";
		//mysql_query($query)or die(mysql_error());
		
		
		header("Location: ./priviledgeManage.php");
?>