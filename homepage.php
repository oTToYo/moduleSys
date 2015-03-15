<!DOCTYPE html>

<?php
session_start();
include_once('connections/connDB.php');
if(!isset($_SESSION["uname"])||$_SESSION["uname"] ="")
{
	if(isset($_POST["acc"])&&isset($_POST["pwd"]))
	{
		$userid="";
		$password="";
		//$userid=$_POST['acc'];
		//$password=$_POST['pwd'];
		
			include_once('authSetting.php');
			fputs($fp, "PASS $password\r\n");
			$msg = fgets($fp,256);
			//echo $msg;
			if(substr($msg,0,2561)=='-')
			{
				//header("Location:homepage.php"); //帳密錯誤
			}

			if(substr($msg,0,1)=='+')  
			{
				$query = "select * from user where account = '$userid'";
				$result = mysql_query($query) or die(mysql_error());
				$row_result = mysql_fetch_assoc($result);
				
				$totalRows = mysql_num_rows($result);
				echo $totalRows;
				if($totalRows>0)
				{

					$_SESSION['uname']= $row_result['account'];
					$_SESSION['type']= $row_result['type'];
					
					header("Location:service.php");
				
				}
				
			}

			//檢查資料庫是否有重複申請的帳號

			
			$queryDefault = "Select account,pwd,type from user";
			$result = mysql_query($queryDefault)or die(mysql_error());

			for($cnt = 0;$row_result = mysql_fetch_assoc($result);$cnt++)
				{
					$tmpAcc = $row_result['account'];
					if($tmpAcc == $userid)
					{
						if($password ==$row_result['pwd'] )
						{
							$_SESSION['uname']= $row_result['account'];
							$_SESSION['type']= $row_result['type'];
							header("Location:service.php");
						}
						break;
					}
					if($cnt == mysql_num_rows($result))
						header("Location:homepage.php");
				}
		/*$query = "select * from user where account = '$userid' and pwd = '$password'";
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
		}*/
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
              <input type="text" placeholder="Username" name="acc">
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
