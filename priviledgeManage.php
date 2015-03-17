<?php
SESSION_START();
header("Content-Type:text/html; charset=utf-8");
$name = $_SESSION['uname'];
include_once('connections/connDB.php');
echo $name;
?>

<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

<title>PriviledgeManagemt</title>

	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700|Open+Sans:300italic,400,300,700' rel='stylesheet' type='text/css'>
	
	<link rel="stylesheet" type="text/css" class="ui" href="../packaged/css/semantic.min.css">
	<link rel="stylesheet" type="text/css" href="../packaged/css/semantic.css">
	
	<link rel="stylesheet" type="text/css" href="homepage.css">

	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.js"></script>
	<script src="../packaged/javascript/jquery.min.js"></script>
	<script src="../packaged/javascript/semantic.js"></script>
	<script src="../packaged/javascript/semantic.min.js"></script>
	
	
	<script src="homepage.js"></script>
	<script src="controlPmenu.js"></script>
	
	<!--auto complete lib & css -->

	<script type="text/javascript" src="jquery.autocomplete.js"></script>  
	<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" /> 
	
	
	<script>
		var session="<?php echo $_SESSION['uname']?>";
		//alert(session);
		//alert('sss');
		$(document).ready(function(){
		
		$('.ui.accordion').accordion();
			
		$('#auth').on('click',function(){
			
			
			var acc = $('#addUAcc').val();
			var pwd = $('#addUPwd').val();
			//alert(acc);
			$.ajax({
			url: 'authCheck.php',
			cache: false,
			dataType: 'html',
			type:'POST',
			data: {acc:acc,pwd:pwd},
			error: function(xhr) 
			{
				alert('Ajax request 錯誤~');
			},
			success: function(response) 
			{
				//alert(response);
					if(response==1)
					{
						$('#authInfo').text('驗證成功');
						
					}
					else if(response ==12 || response ==02 )
						$('#authInfo').text('已帳號已申請');
					else
						$('#authInfo').text('驗證失敗，密碼或帳號錯誤');
			}
			
			
		})
		})
		});
	</script>

	
	
</head>
<body>

<div class="ui page grid">
    <div class="ui page grid">
    <div>
        <nav class="ui text menu navbar">
            <div class="left menu">
                <a href="" class="item"><div class="gray ui label">Setting</div></a>
            </div>
            <div class="right menu">
                
            </div>
        </nav>
        <div class="ui divider"></div>
       
				<?php //控制只有admin group才能用的功能
				/*
				$query = "SELECT account,type FROM user";
				$result = mysql_query($query)or die(mysql_error());
				while($row_result = mysql_fetch_assoc($result))
				{
					
					if($name==$row_result['account'])
					{
						if($row_result['account']=='admin')
						{
							{
							   echo" <div class='black ui buttons'>
								  <button class='ui button' onclick=\"$('#addUser').modal('show');\">
									<i class='user icon'></i>add User
									</button>

							
								  <button class='ui button' onclick=\"$('#editUser').modal('show');\">
									<i class='edit icon'></i>edit User
									</button>

							
								  <button class='ui button' onclick=\"$('#delUser').modal('show');\">
									<i class='remove icon'></i>delete User
									</button>
						 
							
								  <button class='ui button' onclick=\"$('#setPType').modal('show');\">
									<i class='plus icon'></i>Set group type
									</button>
									
								<button class='ui button' onclick=\"$('#setMAdmin').modal('show');\">
									<i class='plus icon'></i>Set Module Admin
									</button>
							  
							   
							   
							   </div >
							   ";
							   
							   
							   }
							
						}
						
					}
					
				}*/
				 ?>
				 
	
 
  
  
   <div class="ui three column grid">
  <div class="column">
    <div class="ui horizontal segment">
     <div class="ui  accordion field">
    <div class=" title">
      <i class="dropdown icon"></i>
      使用者操作
    </div>
    <div class=" content">
		<div class=" ui  fluid vertical buttons">
		  <div class="ui basic  button" onclick="$('#addUser').modal('show')";>新增使用者</div>
		  <div class="ui basic  button" onclick="$('#editUser').modal('show')">修改使用者</div>
		  <div class="ui basic  button" onclick="$('#delUser').modal('show')">刪除使用者</div>
  
		</div>
		
    </div>
  </div>
    </div>
  </div>
  <div class="column">
    <div class="ui horizontal segment">
      <div class="ui  accordion">
    <div class=" title">
      <i class="dropdown icon"></i>
     群組操作
    </div>
    <div class=" content">
		<div class=" ui  fluid vertical buttons">
		<div class="ui basic  button" onclick="$('#setPType').modal('show')">新增群組</div>
		  <div class="ui basic  button " onclick="$('#editGroup').modal('show')" >修改(查看)群組</div>
		  
  
		</div>
    </div>
  </div>
  
    </div>
  </div>
  <div class="column">
    <div class="ui horizontal segment">
     <div class="ui  accordion">
    <div class=" title">
      <i class="dropdown icon"></i>
      模組操作
    </div>
    <div class=" content">
		<div class=" ui  fluid vertical buttons">
		  <div class="ui basic  button" onclick = "$('#setMAdmin').modal('show')">新增模組管理者</div>
		  <div class="ui basic  button">新增模組</div>
		  <div class="ui basic  button">刪除模組</div>
		 
  
		</div>
    </div>
  </div>
    </div>
  </div>
</div>
  
                  
        <div class="ui hidden divider"></div> <!-- 分隔線-->
		
        <div class="ui grid">
            <div class="column">
			
				<div class="ui left icon input ">
				  <input name="searchN" id='pSearchIpt'  class='selectUsr' type="text" placeholder="Search users...">
				  <i class="users icon"></i>

				</div>
				<button id="pSearchBtn" class="ui orange button">Search</button>
				
				<div class="ui hidden divider"></div>
				
				<!--<div class="ui fluid  vertical menu">
						<div class="header item">
							<i class="user icon"></i>
							<span class="h">Communities</span>
							<div class="userList menu">
							
							 <div class="three column doubling ui grid">
								  <div class="column">
									<div class="ui segment">
									  <div class="ui red ribbon label">hackedMail</div>
									 
									  <form>
									  <input type="checkbox"  NAME="check1" checked>1.旅遊<P> 
										<input type="checkbox"  NAME="check2">2.音樂<P>
										<input type="checkbox"  NAME="check3">3.美術<P>
										<input type="checkbox"  NAME="check4">4.閱讀<P>
										<input type="checkbox"  NAME="check5">5.計算機與網路<P>
									</form>
									</div>
								  </div>
								  <div class="column">
									<div class="ui segment">
									  <p>test1</p>
									  <p></p>
									</div>
								  </div>
								  <div class="column">
									<div class="ui segment">
									  <p>test2</p>
									  <p></p>
									</div>
								  </div>
								  
								</div>
								
							</div>
						  </div>
				  </div>-->
				  
				  <?php // 產生使用者list (當onclick 利用ajax去append資料) controlPmenu 內
				  
				  
					//將moudule的名字抓出來並存到array
					$all_moudule_name = array();
					$get_all_ModuleName_Q = "SELECT moduleNo,name FROM  module";
					$get_all_ModuleName_Q_result= mysql_query($get_all_ModuleName_Q)or die(mysql_error());
					while($moduleName_row_result = mysql_fetch_assoc($get_all_ModuleName_Q_result))
					{
						$all_moudule_name[$moduleName_row_result['moduleNo']] = $moduleName_row_result['name'];
						//array_push($all_moudule_name,$moduleName_row_result['name']);
					}
					//print_r($all_moudule_name);
					
					$query = "SELECT account,nickName,type,adM FROM  user";
						$result = mysql_query($query)or die(mysql_error());
						while($row_result = mysql_fetch_assoc($result))
						{
							$adM  = json_decode($row_result['adM']);
							//print_r($adM);
							
							$moudleAdmStr = "";
							
							for($i=0;$i<count($adM);$i++)
							{
								$moudleAdmStr .= $i.".".$all_moudule_name[$adM[$i]]." ";
							}
							
							
							echo "<div class='ui fluid vertical menu'>
									
								  <div class='header item userItem '>
								  <div class='field t' >
					              <span class='h' name='account'><i class='user icon'></i><div  class='ui blue label '>帳號 : <span class='clickName'>".$row_result['account']."</span></div><div class='ui red label'>暱稱 : ".$row_result['nickName']."</div></span>
								  <div class='ui teal label'><span name='group'> 群組 : ".$row_result['type']."</span></div>
									";
								
								echo "<div class='ui  label'><span name='group'> 管理模組 : ".$moudleAdmStr."</span></div>";	
								  
							echo"</div>
								 ";
								  
							echo"	  <div class='userList menu'>
									<div class='three column doubling ui grid'>
									
									</div>
					              </div>
					              </div>
				                  </div>";
						}
					
				  ?>
				
				
				
            </div>
			</div>
 
        </div>
    









<form class="ui form segment modal" id="addUser" name="addUser" method="post" action="addUser.php">

  <div class="field">
    <label>帳號 : </label>
    <input id='addUAcc'   placeholder="Username" name="act" type="text"><p></p>
	<label>密碼 : </label>
    <input id='addUPwd'   placeholder="Username" name="" type="password">
  </div>

  <div class="field">
    <div id='auth' class="ui button">驗證</div>
   <div id='authInfo' class="ui pointing label">
      
    </div>
  </div>
  <div class='field'>
   <label>使用者暱稱 : </label>
    <input id='addUNick'   placeholder="Username" name="nick" type="text"><p></p>
  </div>
  <p>群組 : </p>
  <div class="ui upward  selection dropdown">
  <input type="hidden" name="selected" value='admin'>
		<div class="default text">admin</div>
		<i class="dropdown icon"></i>
		<div class="menu " style="height:200px;overflow:scroll">
		  <?php 
			include_once('connections/connDB.php');
				$query = "select name from priviledge_type";
				$result = mysql_query($query);
							while($row_result = mysql_fetch_assoc($result))
							{
								
									echo "<div class='item' data-value='".$row_result['name']."'>".$row_result['name']."</div>";
							}
		  ?>
	
		
		</div>
	</div>
	<p></p>
  <div class="inline field">
    
  </div>
  
  <button class="ui blue submit button">送出</button>

</form> <!--add end -->


<form class="ui form segment modal" id="delUser" name="delUser" method="post" action="delUser.php">

  <div class="field">
    <label>account</label>
    <input  class='selectUsr' placeholder="Username" name="act" type="text">
  </div>
	<p></p>

  <button class="ui blue submit button">Submit</button>

</form> <!--delete end -->



<form class="ui form segment modal" id="editUser" name="editUser" method="post" action="editUser.php">

  <div class="field">
    <label>account</label>
    <input class='selectUsr' placeholder="Username" name="act" type="text">
  </div>
	<p>group</p>
  <div class="ui selection dropdown" id="editUserChange">
  <input type="hidden" name="selected" value='admin'>
		<div class="default text"  >admin</div>
		<i class="dropdown icon"></i>
		<div class="menu" >
		  <?php 
			include_once('connections/connDB.php');
				$query = "select * from priviledge_type";
				$result = mysql_query($query);
							while($row_result = mysql_fetch_assoc($result))
							{
								
									echo "<div class='item' value='".$row_result['useM']."' data-value='".$row_result['name']."'>".$row_result['name']."</div>";
							}
		  ?>
	
		</div>
		
		
		
	</div> 
	
	<div class="field" id="userChangeField">
	<p></p>
		<?php 
			include_once('connections/connDB.php');
				$query = "select * from module";
				$result = mysql_query($query);
							while($row_result = mysql_fetch_assoc($result))
							{
									echo "<input type='checkbox' name='modules[]' value='$row_result[moduleNo]'>$row_result[name]";
							}
		 ?>
	</div>
	
	
	<p></p>

  <button class="ui blue submit button">送出</button>

</form> <!--edit user end -->


<form class="ui form segment modal" id="setPType" method="post" action="setPType.php">

  <div class="field">
    <label>GroupName</label>
    <input placeholder="typeName" name="typeName" type="text">
	<label>modules</label>
		
		<?php 
			include_once('connections/connDB.php');
				$query = "select * from module";
				$result = mysql_query($query);
							while($row_result = mysql_fetch_assoc($result))
							{
									
							
									echo "	<div class='ui  accordion'>
											<div class='title'>
												<i class='dropdown icon'></i>
												<input type='checkbox' name='modules[]' value='$row_result[moduleNo]'>$row_result[name]
											</div>
											<div class='content'>
												
											";
									$serviceName = $row_result['service'].'priviledge' ;
									
									if($serviceName != 'priviledge')
									{
									$query2 = "select * from $serviceName";
									
									$result2 = mysql_query($query2);
										while($row_result2 = mysql_fetch_assoc($result2))
										{
											$tName = $row_result['service']."Used[]";
											echo "<input type='checkbox' name='$tName' value='$row_result2[funID]'>$row_result2[name]";
										}
									}
									echo "</div>
										  </div>";
							}
		 ?>
		
		
		
  </div>
	<p></p>

  <button class="ui blue submit button">Submit</button>

</form><!--SetPriviledgeType end -->

<form class="ui form segment modal" id="editGroup" name="editGroup" method="post" action="editGroup.php">

	<p>group</p>
  <div class="ui selection dropdown" id="editGroupChange">
  <input type="hidden" name="selected" value='admin'>
		<div class="default text"  >admin</div>
		<i class="dropdown icon"></i>
		<div class="menu" >
		  <?php 
			include_once('connections/connDB.php');
				$query = "select * from priviledge_type";
				$result = mysql_query($query);
							while($row_result = mysql_fetch_assoc($result))
							{
								
									echo "<div class='item' value='".$row_result['useM']."' data-value='".$row_result['name']."'>".$row_result['name']."</div>";
							}
		  ?>
	
		</div>
		
		
		
	</div> 
	
	<div class="field" id="groupChangeField">
	<label>modules</label>
		
		<?php 
			include_once('connections/connDB.php');
				$query = "select * from module";
				$result = mysql_query($query);
							while($row_result = mysql_fetch_assoc($result))
							{
									
							
									echo "	<div class='ui  accordion'>
											<div class='title'>
												<i class='dropdown icon'></i>
												<input class='gCH' type='checkbox' name='modules[]' value='$row_result[moduleNo]'>$row_result[name]
											</div>
											<div class='content'>
												
											";
									$serviceName = $row_result['service'].'priviledge' ;
									
									if($serviceName != 'priviledge')
									{
									$query2 = "select * from $serviceName";
									
									$result2 = mysql_query($query2);
										
										while($row_result2 = mysql_fetch_assoc($result2))
										{
											$tName = $row_result['service']."Used[]";
											echo "<input id='U".$row_result['moduleNo']."F$row_result2[funID]' type='checkbox' name='$tName' value='$row_result2[funID]'>$row_result2[name]";
										}
									}
									echo "</div>
										  </div>";
							}
		 ?>
	</div>
	
	
	<p></p>

  <button class="ui blue submit button">送出</button>

</form>


<!--modifyPriviledgeType end -->
<form class="ui form segment modal" id="setMAdmin" method="post" action="setMAdmin.php">

  <div class="field">
    <label>UserName</label>
    <input class='selectUsr' placeholder="userName" name="userName" type="text">
	<label>modules</label>
		
		<?php 
			include_once('connections/connDB.php');
				$query = "select * from module";
				$result = mysql_query($query);
							while($row_result = mysql_fetch_assoc($result))
							{
									echo "<input type='checkbox' name='modules[]' value='$row_result[moduleNo]'>$row_result[name]";
							}
		 ?>
		
		
		
  </div>
	<p></p>

  <button class="ui blue submit button">Submit</button>

</form><!--SetMoudel Admin end -->

<form class="ui form segment modal" id="setGrpdefaultP" method="post" action="setGrpdefaultP.php">

  <div class="field">
    <label>GroupName</label>
    <input class='selectUsr' placeholder="userName" name="userName" type="text">
	<label>modules</label>
		
		<?php 
			include_once('connections/connDB.php');
				$query = "select * from module";
				$result = mysql_query($query);
							while($row_result = mysql_fetch_assoc($result))
							{
									echo "<input type='checkbox' name='modules[]' value='$row_result[moduleNo]'>$row_result[name]";
							}
		 ?>
		
		
		
  </div>
	<p></p>

  <button class="ui blue submit button">Submit</button>

</form><!--SetGroup default privilege end -->



</body>
</html>