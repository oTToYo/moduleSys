<?php 
include_once('sessionCheck.php');
	$account = $_POST["acc"];
	$user = $_POST['user'];
		//echo $user;
	include_once('connections/connDB.php');
	//echo c;
	//$query = "select useM from user inner join priviledge_type on user.type=priviledge_type.name where account='$account'";
	$query = "select actUseM from user where account='$account'";
	$result = mysql_query($query)or die(mysql_error());
	$row_result = mysql_fetch_assoc($result);
	$totalRows = mysql_num_rows($result);
	$dataArr = array();
	if($totalRows>0)
	{
		$modules = json_decode($row_result['actUseM']);
									
		foreach($modules as $item)
		{
			
			$queryAdmin = "select modules from moduleadmin where name='$user'";
			$resultAdmin = mysql_query($queryAdmin)or die(mysql_error());
			$row_resultAdmin = mysql_fetch_assoc($resultAdmin);
			//echo $row_resultAdmin['modules'];
			$modules = Array();
			if(json_decode($row_resultAdmin['modules'])!=null)
				$modules = json_decode($row_resultAdmin['modules']);

			$service="";								  
			if($item!=0 && in_Array($item,$modules))
			{
		
			 $query = "select service from module where moduleNo=$item ";
			 //echo $query ;
			 $result = mysql_query($query);
			 $row_result = mysql_fetch_assoc($result);
			 $service = $row_result['service'];
			 $query1 = "select * from ".$service."priviledge ";
				//echo $query1;
			 $result1 = mysql_query($query1);
			 
			 $query2 = "select * from ".$service."user where account='$account'";
				//echo $query1;
			 $result2 = mysql_query($query2);
			 $row_result2 = mysql_fetch_assoc($result2);
			 $funArr = json_decode($row_result2['func']);
			 $dufaultFunArr = Array();
			 
			 while($row_result1 = mysql_fetch_assoc($result1))
			 {
				$obj = Array(
				"name"=>$row_result1['name'],
				"ID"=>$row_result1['funID']
				);
				array_push($dufaultFunArr,$obj);
			 }
			 $func =Array(
			 "defaultM"=>$dufaultFunArr,
			 "used"=>$funArr
			 );
			 $objArr = array("name"=>$service,"service"=>$func);
			 array_push($dataArr,$objArr);
			
			}
											
		
											
															 
		}
									
									
	}
	
	
	echo json_encode($dataArr);

	

?>