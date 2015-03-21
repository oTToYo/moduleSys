<?php
SESSION_START();
if(empty($_SESSION['uname'])||empty($_SESSION['type'])||!isset($_SESSION['uname'])||!isset($_SESSION['type']))
	header("Location:homepage.php");
				
?>