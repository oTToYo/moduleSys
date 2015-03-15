<?php 
	header("Content-type: text/x-csv");
	header("Content-Disposition: attachment; filename='output.csv'");
	$name = $_POST["export"];
	$stDate = $_POST["stDate"];
	$endDate = $_POST["endDate"];
	include_once('connections/connDB.php');
	
	//echo $stDate.":".$endDate;
	$query = "SELECT date,account,type,ip,notes,checked FROM hackedmail WHERE account like \"%$name%\" or type like \"%$name%\"";
	if($stDate!="" && $endDate!="")
	$query = "SELECT date,account,type,ip,notes,checked FROM hackedmail WHERE (account like '%$name%' or type like '%$name%') AND (date BETWEEN '$stDate' and '$endDate')";
	
	$result = mysql_query($query, $link_ID) or die(mysql_error());
	$content = "日期,帳號,類型,IP,註釋,檢查狀態\n";
	while($row_result = mysql_fetch_assoc($result))
	{
		foreach($row_result as $key => $value)
		{
			
			if($key=="checked")
				$content=$content."$value\n";
			else
				$content=$content."$value,";
		}
	}
	
	//$content = "Column1,Column2,Column3\n";
	//$content = mb_convert_encoding($content , "Big5" , "UTF-8");
	echo $content;
	exit;
?>