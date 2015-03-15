<!DOCTYPE html>

<?php
session_start();
if(!isset($_SESSION["uname"])||$_SESSION["uname"] ="")
{
	if(isset($_POST["uid"])&&isset($_POST["pwd"]))
	{
		$userid="";
		$password="";
		$userid=$_POST['uid'];
		$password=$_POST['pwd'];
		echo $userid;

		include_once('connections/connDB.php');
		$query = "select * from user where account = '$userid' and pwd = '$password'";
		$result = mysql_query($query, $link_ID) or die(mysql_error());
		$row_result = mysql_fetch_assoc($result);
		
		$totalRows = mysql_num_rows($result);
		
		if($totalRows>0)
		{
			//session_register('uname');
			//session_register('type');
			$_SESSION['uname']= $row_result['account'];
			$_SESSION['type']= $row_result['type'];
			
			header("Location:service.php");
		
		}
		else
		{
			header("Location:homepage.php");
		}
	}
}
else
{
	unset($_SESSION["uname"]);
	unset($_SESSION["type"]);
	//header("Location:service.php");
}
?>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <!-- Site Properities -->
  <title>Login</title>

  <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700|Open+Sans:300italic,400,300,700' rel='stylesheet' type='text/css'>

  <link rel="stylesheet" type="text/css" href="../packaged/css/semantic.css">
  <link rel="stylesheet" type="text/css" href="homepage.css">

  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.js"></script>
  <script src="../packaged/javascript/semantic.js"></script>
  <script src="homepage.js"></script>

</head>
<body id="home">
  <form id="login" name="login" method="post" action="">
 <div class="ui form segment">
          <div class="field">
            <label>Username</label>
            <div class="ui left labeled icon input">
              <input type="text" placeholder="Username" name="uid">
              <i class="user icon"></i>
              <div class="ui corner label">
                <i class="asterisk icon"></i>
              </div>
            </div>
          </div>
          <div class="field">
            <label>Password</label>
            <div class="ui left labeled icon input">
              <input type="password" name="pwd" >
              <i class="lock icon"></i>
              <div class="ui corner label">
                <i class="asterisk icon"></i>
              </div>
            </div>
          </div>
         
		  <input class="ui blue submit button"  type="submit" value="Login">
        </div>
		</form>
</body>

</html>
