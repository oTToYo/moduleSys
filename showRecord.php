<?php

?>

<html>
<head>
<link rel="stylesheet" type="text/css" class="ui" href="../packaged/css/semantic.min.css">
	<link rel="stylesheet" type="text/css" href="../packaged/css/semantic.css">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
</head>

<body>
<table class="ui table segment">
      <thead>
        <tr>
			<th>時間</th>
			<th>帳號</th>
			<th>帳號類型</th>
			<th>IP</th>
			<th>動作</th>
			<th>異動者</th>
      </tr></thead>
      <tbody id="">
		 <?php
			include_once('connections/connDB.php');
			$query = "select time,account,type,ip,action,modifier from hackedMailRecord ";
			$result = mysql_query($query);
			
			
			
			while($row_result = mysql_fetch_assoc($result))
			{
				echo "<tr>";
				foreach($row_result as $key => $value)
				{
		
						echo "<td >".$value."</td>";
				}
				//if()
				echo "</tr>";
			}	
				
		?>
	  
	  
		</tbody>
</table>

</body>
</html>