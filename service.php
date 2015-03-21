<!DOCTYPE HTML> 
<?php

include_once('sessionCheck.php');
header("Content-Type:text/html; charset=utf-8");




//echo $_SESSION['uname'];
?>


<html class="no-js" lang="zh-TW">
<head>
    <meta charset="utf-8">

    <title>service</title>
    <meta name="description" content="">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <meta name="mobile-web-app-capable" content="yes">

    <!-- build:css styles/vendor.css -->
    <!-- bower:css -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.13.0/css/semantic.min.css">
    <!-- endbower -->
    <!-- endbuild -->
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,300&subset=latin,vietnamese' rel='stylesheet' type='text/css'>

    <!-- build:css styles/main.css -->
    <link rel="stylesheet" href="homepage.css">
    <!-- endbuild -->
</head>
<body>

    <div class="ui page grid">
        <div class="computer tablet only row">
            <div class="ui inverted menu navbar">
                <a href="" class="brand item"><?php echo " Hi! ".$_SESSION['uname'] ?></a>
                <a href="" class="active item">宗旨</a>
                <a href="" class="item">相關網站</a>
                <a class="ui dropdown item">服務項目
                  <i class="dropdown icon"></i>
                  <div class="menu">
				  <?php
					include_once('connections/connDB.php');
					$name = $_SESSION['uname'];
					$type = $_SESSION['type'];
					/*$useModule =json_decode($type);
					
					foreach ($useModule as $value)
					{
						echo $value;
					}*/
					/*$queryAdmin = "select modules from moduleadmin where name='$name'";
					$resultAdmin = mysql_query($queryAdmin)or die(mysql_error());
					$row_resultAdmin = mysql_fetch_assoc($resultAdmin);
					
					$checkM = json_decode($row_resultAdmin['modules']);
					$len = count($checkM);*/
					
					
					$query = "select actUseM from user where account ='$name' ";
					$result = mysql_query($query);
					
					$moduleArr = array();
					while($row_result = mysql_fetch_assoc($result))
					{
						$useModule =json_decode($row_result['actUseM']);
						
						foreach ($useModule as $value)
						{
							$queryM = "select content,name,imgUrl from module where moduleNo='$value' ";
							$resultM = mysql_query($queryM);
							$row_resultM = mysql_fetch_assoc($resultM);
							
							$object = array();
							array_push($object,$row_resultM['content'],$row_resultM['name'],$row_resultM['imgUrl']);
							
							echo "<div class='item' onclick=\"location.href= '".$row_resultM['content']."'\">".$row_resultM['name']."</div>";
							//echo $row_resultM['content'];
							array_push($moduleArr,$object);
						}
						
						//foreach($row_result as $item)
							//echo "<div class='item' onclick=\"location.href= '".$row_result['content']."'\">".$row_result['name']."</div>";
					}
					
					
				  ?>
                    <!--<div class="item">帳號停用管理</div>
                    <div class="item">使用者權限管理</div>
                    <div class="item">其他</div>-->
                   
                  </div>

                </a>
                <div class="right menu">
                    <a href="" class="active item">介紹</a>
                    <a href="" class="item">連絡我們</a>
                    <a href="" class="item">登出</a>
                </div>
            </div>
        </div>
        <div class="mobile only narrow row">
            <div class="ui inverted navbar menu">
                <a href="" class="brand item">綜合服務平台</a>
                <div class="right menu open">
                    <a href="" class="menu item">
                        <i class="reorder icon"></i>
                    </a>
                </div>
            </div>
            <div class="ui vertical navbar menu">
                <a href="" class="brand item">綜合服務平台</a>
                <a href="" class="active item">宗旨</a>
                <a href="" class="item">相關網站</a>
                <div class="ui item">
                    <div class="text">服務項目</div>
                    <div class="menu">
                        <div class="item">帳號停用管理</div>
						<div class="item">使用者權限管理</div>
						<div class="item">其他</div>
                    </div>
                </div>
                <div class="menu">
                    <a href="" class="active item">介紹</a>
                    <a href="" class="item">連絡我們</a>
                    <a href="" class="item">登出</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="column padding-reset">
                <div class="ui huge message" style="background-image:url(./images/binary.jpeg)">
                    <h1 class="ui huge header " style="color:white">Welcome to Network computing Center</h1>
                   
					<p></p>
                    <a href="" class="ui blue button">see more &raquo;</a>
                </div>
            </div>
        </div>
		<p></p>
		<div class="ui five connected items row">
		<?php
	
			foreach($moduleArr as $value)
			{
				echo "<div class='item'>
					  <div class='image'>
					  <a class='ui  image ' href='$value[0]'>
					  <img src='$value[2]'>
						
					
						</a>
					  </div>
			          <div class='content'>
					  <div class='name'>$value[1]</div>
			          <p class='description'></p>
			          </div>
		              </div>";
				
			}
		?>
		
		  
		  
		  
		</div>
    </div>

    <!-- build:js scripts/vendor.js -->
    <!-- bower:js -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.13.0/javascript/semantic.min.js"></script>
    <script src="homepage.js"></script>
    <!-- endbower -->
    <!-- endbuild -->
	
	
</body>



</html>