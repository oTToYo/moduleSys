<?php
	/*
	parameter:
		type : 1.all
			   2.search
		q : keyword you want to search
		stD : start date
		endDate : end date
	*/
	$query="";
	if(!empty($_GET["type"]))
	{	
		$query="Select * from rview ";
		$type = $_GET["type"];
		if($type=="search")
		{
		
			if(!empty($_GET["stD"])&&!empty($_GET["endD"]))
			{	
				$query=$query."where ";
				$stDate = $_GET["stD"];
				$endDate = $_GET["endD"];	
				$query=$query." date BETWEEN '$stDate' and '$endDate' ";
			}
			
			if(!empty($_GET["q"]))
			{	
				if(!empty($_GET["stD"])&&!empty($_GET["endD"]))
					$query=$query." and ";
				else
					$query=$query."where ";
				$keyword = $_GET["q"];
				$query=$query." account like '%$keyword%'or type like '%$keyword%' ";
			}
		}
	}
	include_once('connections/connDB.php');

//		echo $query;
	
	if(!empty($query))
	{
		$result = mysql_query($query, $link_ID) or die(mysql_error());
		$dataArr = array();                                       
		while($row_result = mysql_fetch_assoc($result))
		{
			$listArr = array();
			foreach($row_result as $key => $value)
			{
				array_push($listArr,$value);
			}
			array_push($dataArr,$listArr);
		}
		echo json_encode($dataArr);
	}
?>