<?php
include_once('sessionCheck.php');
	include_once('connections/connDB.php');
				$query = "select * from module";
				$result = mysql_query($query);
				
				//print_r($row_result);
			$a = array();
			while($row_result = mysql_fetch_assoc($result))
			array_push($a,$row_result['name']);
		
			print_r($a);
	
	
	$service = '[]';
	if(!empty($_POST['s']))
		$service = $_POST["s"];
	
	$sName = $_POST["sName"];
	$uName = $_POST["uName"];
	include_once('connections/connDB.php');
	print_r ($service);
	echo $sName ;
	echo $uName ;
	$service = json_encode($service);
	$query = "UPDATE ".$sName."user SET func='$service' WHERE account='$uName'";
		$result = mysql_query($query, $link_ID) or die(mysql_error());
	
	/*foreach($service as $item)
	{
		$serviceStr="[";
		if(isset($_POST[$item]))
		{
			//print_r($_POST[$item]);
			$val = $_POST[$item];
			for($i=0;$i<count($val);$i++)
			{
				$serviceStr=$serviceStr.$val[$i];
				if($i+1 != count($val) )
					$serviceStr=$serviceStr.",";			
			}
		}
		$serviceStr = $serviceStr."]";
		$query = "UPDATE netcompservice.".$item."user SET func='$serviceStr' WHERE account='$sName'";
		$result = mysql_query($query, $link_ID) or die(mysql_error());
	
	}*/
	
	//echo $serviceStr;

		//header("Location: ./priviledgeManage.php");
	
?>