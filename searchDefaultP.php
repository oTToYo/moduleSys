<?php 
include_once('connections/connDB.php');
	
	if(!empty($_POST['muduleNo'])&&!empty($_POST['groupName']))
	{
		$muduleNo=$_POST['muduleNo'];
		$groupName=$_POST['groupName'];
			$query_search_name = "Select * from module where moduleNo=$muduleNo";
			$result = mysql_query($query_search_name)or die(mysql_error());

				while($row_result = mysql_fetch_assoc($result)) //找到模組對應的名字
					{
						$serviceRelation = $row_result['service']."relation";
						$query_search_defaultP = "Select defaultP from ".$serviceRelation." where groupName='$groupName'";
						//echo $query_search_defaultP;
						$search_defaultP_result = mysql_query($query_search_defaultP)or die(mysql_error());
						$search_defaultP_row_result = mysql_fetch_assoc($search_defaultP_result);
						
						echo json_encode($search_defaultP_row_result['defaultP']);
					}
			
		
	}                                                                                                                                                                 
?>