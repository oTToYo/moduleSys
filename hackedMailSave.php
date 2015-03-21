<?php 
include_once('sessionCheck.php');
	$add="";
	$del="";
	$change="";
	$add=json_decode($_POST['add']);
	$del=json_decode($_POST['del']);
	$change=json_decode($_POST['change']);
	date_default_timezone_set('Asia/Taipei');
			$currentTime=date("H:i:s");
	print_r($change);
	
	//echo $_POST['user'];
	$user = $_POST['user'];
	//$if(!empty($_POST['modules']))
		//$user = json_decode($_POST['user']);
	include_once('connections/connDB.php');
	//add
		foreach($add as $value)
		{
			$ch=0;
			if((strpos($value[5],"hecked"))!=false)
			$ch=1;
			
			$query = "INSERT INTO  netcompservice.hackedmail(date,account,type,ip,notes,checked)VALUES('$value[0]','$value[1]','$value[2]','$value[3]','$value[4]',$ch)";
			$result = mysql_query($query, $link_ID) or die(mysql_error());
			//record
			$query = "INSERT INTO netcompservice.hackedmailrecord(time,account,type,ip,action,modifier)VALUES('$currentTime','$value[1]','$value[2]','$value[3]','new','$user')";
			$result = mysql_query($query, $link_ID) or die(mysql_error());
			
			
		}
	//delete
		foreach($del as $value)
		{
			$query = "select type,ip from hackedMail where account='$value'";
			$result = mysql_query($query, $link_ID) or die(mysql_error());
			$row_result = mysql_fetch_assoc($result);
			print_r($row_result);
			$type=$row_result['type'];
			$ip=$row_result['ip'];
			//echo($type);
			
			$query = "DElETE FROM  netcompservice.hackedmail WHERE hackedmail.account='$value'";
			$result = mysql_query($query, $link_ID) or die(mysql_error());
			
			//record
			$query = "INSERT INTO netcompservice.hackedmailRecord(time,account,type,ip,action,modifier)VALUES('$currentTime','$value','$type','$ip','delete','$usr')";
			$result = mysql_query($query, $link_ID) or die(mysql_error());
		}
		
	//change
		foreach($change as $value)
		{
			$ch=0;
			//echo (strpos($value[5],"hecked"));
			if((strpos($value[5],"hecked"))!=false)
			{
			$ch=1;
			}
			 //date='$value[0]',account='$value[1] ',type='$value[2]',ip='$value[3]',notes='$value[4]',
			
			$query = "UPDATE netcompservice.hackedmail SET date='$value[0]',account='$value[1]',type='$value[2]',ip='$value[3]',notes='$value[4]',checked=$ch WHERE hackedmail.account='$value[1]'";
			$result = mysql_query($query, $link_ID) or die(mysql_error());
			//record
			$query = "INSERT INTO netcompservice.hackedmailRecord(time,account,type,ip,action,modifier)VALUES('$currentTime','$value[1]','$value[2]','$value[3]','modify','$user')";
			$result = mysql_query($query, $link_ID) or die(mysql_error());
		}
		
?>