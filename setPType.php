<?php 
include_once('connections/connDB.php');
	$typeName="";
	$levelNum="";
	$typeName=$_POST['typeName'];
	
	$moduleStr="[";
	if(!empty($_POST['modules']))
	{
		$modules=$_POST['modules'];
		print_r($modules);
		for($i=0;$i<count($modules);$i++)
		{
			$muduleNo = $modules[$i]; //使用者所勾選的模組編號
			echo $muduleNo;
			
			if($muduleNo>0)
			{
			$query_search_name = "Select * from module where moduleNo=$muduleNo";
			$result = mysql_query($query_search_name)or die(mysql_error());

				while($row_result = mysql_fetch_assoc($result)) //找到模組對應的名字
					{
						$serviceUsed = $row_result['service']."Used";
						echo $serviceUsed ;
						//print_r($_POST[$serviceUsed]);
						                //hackedmailUsed
						$default = "[]";
						if(!empty($_POST[$serviceUsed]))
						{
							$default =  json_encode($_POST[$serviceUsed]);
							//print_r($_POST[$serviceUsed]);
		
						}
						//對此模組的relation 新增一個group預設權限
						
						$query_insert_relation = "INSERT INTO ".$row_result['service']."relation(groupName,defaultP)VALUES('$typeName','$default')";
						echo $query_insert_relation;
						mysql_query($query_insert_relation)or die(mysql_error());
					}
				
			}
			
			
			
			$moduleStr =$moduleStr.$modules[$i];
			if($i+1 !=count($modules) )
			$moduleStr =$moduleStr.",";	
		}
	}                                                                                                                                                                   
	$moduleStr=$moduleStr."]";	
	echo $moduleStr;
	

		$query = "INSERT INTO  netcompservice.priviledge_type(name,useM)VALUES('$typeName','$moduleStr')";
		$result = mysql_query($query, $link_ID) or die(mysql_error());
	//header("Location: ./priviledgeManage.php");
?>