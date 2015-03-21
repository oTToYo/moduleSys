<?php 
include_once('sessionCheck.php');
	$searchName = $_POST["search"];
	$numOfList = $_POST["num"];
	$pageNum = $_POST["page"];
	$start = $_POST["start"];
	$end = $_POST["end"];
	//$uName=$_POST["uname"];
	$initQ = (($pageNum-1)*2);
	$endQ = $initQ + $numOfList;
	
	include_once('connections/connDB.php');
	//echo c;
	$query = "SELECT date,account,type,ip,notes,checked FROM  hackedmail  where account like '%$searchName%' or type like '%$searchName%' LIMIT $initQ,$endQ";
	if($end!= "" && $start!="")
	{
		$query = "SELECT date,account,type,ip,notes,checked FROM  hackedmail  where (date BETWEEN '$start' and '$end') AND(account like '%$searchName%' or type like '%$searchName%')  LIMIT $initQ,$endQ ";
		
	}
	
		
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
	
	/*$lvQuery = "select ulevel from hackmailuser where account = '$uName'";
			$lvResult = mysql_query($lvQuery);
			$lv_result = mysql_fetch_assoc($lvResult);
			$modelLv = $lv_result['ulevel'];*/
	echo json_encode($dataArr);
	//$content = "Column1,Column2,Column3\n";
	//$content = mb_convert_encoding($content , "Big5" , "UTF-8");
	
	exit;
?>