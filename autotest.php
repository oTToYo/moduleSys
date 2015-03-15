<?php 

include_once('connections/connDB.php'); 
$q = $_POST["q"];  
if (!$q) return;

$data = Array();
$query = "SELECT account,type,nickName FROM user";
$result = mysql_query($query)or die(mysql_error());
while($row_result = mysql_fetch_assoc($result))
{
	$userInfo = $row_result['account']." (".$row_result['type'].")"." (".$row_result['nickName'].")";
	array_push($data,$userInfo);
}

  
//$data = array('aaa','bbb','ccc','ddd','eeee');  
foreach ($data as $value) {  
  if (strpos($value, $q) !== false) {  
    echo $value."\n";  
  }  
}  
?>  