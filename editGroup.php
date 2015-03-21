<?php 
include_once('connections/connDB.php');
	include_once('sessionCheck.php');
	
	if(!empty($_POST['modules'])&&!empty($_POST['selected']))
	{
		$typeName = $_POST['selected'];
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
						//對此模組的relation 更新group預設權限
						
						$query_insert_relation = "update ".$row_result['service']."relation set defaultP = '$default' where  groupName = '$typeName' ";
						echo $query_insert_relation;
						mysql_query($query_insert_relation)or die(mysql_error());
					}
				
			}
			
		
		}
	}                                                                                                                                                                   
	
	header("Location: ./priviledgeManage.php");
?>