<?php
SESSION_START();
header("Content-Type:text/html; charset=utf-8");
$uname = $_SESSION['uname'];
echo $uname;
?>

<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

<title>hackMailManagemt</title>

	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700|Open+Sans:300italic,400,300,700' rel='stylesheet' type='text/css'>
	
	<link rel="stylesheet" type="text/css" class="ui" href="../packaged/css/semantic.min.css">
	<link rel="stylesheet" type="text/css" href="../packaged/css/semantic.css">
	
	<link rel="stylesheet" type="text/css" href="homepage.css">
	<link href="css/latoja.datepicker.css" rel="stylesheet">
	<link href="css/jquery-ui-1.10.1.css" rel="stylesheet" >
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	
	<script src="../packaged/javascript/jquery.min.js"></script>
	<script src="../packaged/javascript/semantic.js"></script>
	
	<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
	
	<script src="homepage.js"></script>
	<script>
		$( document ).ready(function() 
		{
			
			
			$('tbody').on('click','.ui.toggle.button',function()
			{
				$(this).toggleClass("active");
				$(this).parent().parent().toggleClass("negative ");
				$(this).parent().parent().addClass('changed');
				//$(this).parent().parent().toggleClass("changed");
				$(this).siblings("i").toggleClass("checkmark ");				
				if ($(this).text() == "check") 
					$(this).text("checked");
				else
					$(this).text("check");
			});
			
			$('tbody').on('click','.ui.button.removeBtn',function()
			{
				
				$(this).parent().parent().remove();
				
			});
			
			$('tbody').on('click','.ui.button.delBtn',function()
			{
				$(this).toggleClass("red");
				$(this).siblings("i.delete").css("color","red");
				//if(($(this).parent().parent().hasClass("changed"))==false)
					$(this).parent().parent().toggleClass("delR");
			});
			
			
			
			$( "#add" ).on( "click", function()
			{
	
				$('#addform').modal('show');
			});
			
		
		
			$("#prepend").on("click",function()
			{
				var d = new Date(); 
				var year = d.getFullYear();
				var month = d.getMonth()+1; 
				var day = d.getDate(); 
				
				var time = year + '-' + 
				 (month<10 ? '0' : '') + month + '-' + 
				 (day<10 ? '0' : '') + day;
			
				var $tr = $("<tr/>");
				$tr.addClass("newAdd");
				//$("tbody").prepend('<tr class=\'newAdd\'></tr>');
				//$tr.prepend('<td>'+time+'</td>');
				var $data  = $('.addCount');
				$data.each(function()
				{
					if($(this).attr('name')=="type")
						$tr.append('<td>'+$(".text").text()+'</td>');
					else
					$tr.append('<td>'+$(this).val()+'</td>');
				})
				$tr.append("<td><i class=\"icon\"></i><div class=\"ui toggle button\">check</div><i class=\"icon delete\" style=\"color:red\"></i><div class=\" ui orange button removeBtn\">remove</div></td>");
				$("#listCnt").prepend($tr);
			//$("tbody").prepend("")
		});
			
			$("#search").on("click",function()
			{
				$input = $(".srch");
				
				var searchName = $($input[0]).val();
				var startTime = $($input[1]).val();
				var endTime = $($input[2]).val();
				
				
				var numOflist = 10;
				var pageNum = 1;
				
		
				searchName = searchName.toLowerCase();
				$("#exportName").attr("value",searchName);
				$.ajax
				({
					url: 'search.php',
					cache: false,
					dataType: 'json',
					type:'POST',
					data: { search:searchName,num:numOflist,page:pageNum,start:startTime,end:endTime,},
					error: function(xhr) 
					{
					   alert('Ajax request 發生錯誤');
					},
					success: function(response) 
					{ 
						
						alert($(response).size());
						$("#total").text($(response).size());
						$("#listCnt").html("");
						$.each(response,function(key,val)
						{
							var $tr = $("<tr/>");
							
							$.each(val,function(tdKey,tdVal)
							{
								//alert(tdKey);
								
								if(tdKey==5)
								{
									if(tdVal==1)
									{
										

										$tr.append("<td><i class=\"icon checkmark\"  ></i><div class=\"ui toggle button active\">checked</div>");
										
									}
									else
									{
										$tr.append("<td><i class=\"icon\"></i><div class=\"ui toggle button\">check</div>");
									}
									
									$("#listCnt").prepend($tr);
								}
								else
								{
									$tr.append('<td>'+tdVal+'</td>');
								}
								
							});
							
							
										

						});
						
						
					}
				});
				
				/*$allTr = $("tbody >tr");
				
				$allTr.each(function()
				{
					$accField= $(this).children("td:eq(1)");
					var acc = $accField.text();
					//alert(acc);
					if(acc.match(searchName)!=null)
					{
						if($(this).css("display")=="none")
							$(this).removeAttr("style");
							//alert("1");
							
					}
					else
						$(this).css("display","none");
				
				});*/
			
			})
		
			
			
			$("#save").on("click",function()
			{
			    var delArr =[];
				$delTr = $(".delR");
				$delTr.each(function()
				{
					$addTd = $(this).children("td:eq(1)");
					delArr.push($addTd.text());
						
				});
				
				var changeArr = [] ;
				
				$changedTr = $(".changed:not(.delR)");
				
				$changedTr.each(function()
				{
						$allTd = $(this).children("td");
						var allField = [];
						$allTd.each(function()
						{
							
							//alert($(this).text());
							allField.push($(this).text());
						})
						changeArr.push(allField);
				})
					
				var newArr = [];
				$newTr = $(".newAdd");
				$newTr.each(function()
				{
						$newAllTd = $(this).children("td");
						var allField = [];
						$newAllTd.each(function()
						{
							
							//alert($(this).text());
							allField.push($(this).text());
						})
						newArr.push(allField);
						//alert(JSON.stringify(allField));
				})
				
					//for(var i=0;i<newArr.length;i=i+1)
						//for(var j=0;j<newArr[i].length;j=j+1)
							//alert(newArr[i][j]);
				
				
				$.ajax
				({
					url: 'hackedMailSave.php',
					cache: false,
					dataType: 'html',
					type:'POST',
					data: { change:JSON.stringify(changeArr) ,del:JSON.stringify(delArr),add: JSON.stringify(newArr),user:"<?php  echo $uname?>"},
					error: function(xhr) 
					{
					   alert('Ajax request 發生錯誤');
					},
					success: function(response) 
					{ 
						alert(response);
						 location.reload();
					}
				});
			});
			
			
			
			
		$( ".datepicker" ).datepicker
		({dateFormat:"yy-mm-dd",showMonthAfterYear:true});
		
		$("#export").on("click",function()
		{
		$input = $(".srch");
		
		$("#stDate").attr("value",$($input[1]).val());
		$("#endDate").attr("value",$($input[2]).val());
		$("#f1").submit();
		
		});
			
	/*-----------------------------------------------------------------------------------*/
            
		
		
		});
		
		$(function () {
		
			//加上點選進入編輯模式的事件
            $("td.cell").on("dblclick", function () {
                //若已有其他欄位在編輯中，強制結束
				$(this).parent().addClass('changed');
                if (window.$currEditing)
                    finishEditing($currEditing);
                var $cell = $(this);
                var $inp = $("<input type='text' />");
                $inp.val($cell.text());
                $cell.addClass("cell-editor").html("").append($inp);
                $inp[0].select();
                window.$currEditing = $inp;
            }).on("click", function () {
                //點選其他格子，強制結束目前的編輯欄
                if (window.$currEditing
                    //排除點選目前編輯欄位的情況
                    && $currEditing.parent()[0] != this)
                    finishEditing($currEditing);
            });
            //加上按Enter/Tab切回原來Text的事件
            $("td.cell").on('keydown','input',function (e) {
				if (e.which == 13 || e.which == 9)
                    finishEditing($(this));
            });
            //結束編輯模式
            function finishEditing($inp) {
                $inp.parent().removeClass("cell-editor").text($inp.val());
                window.$currEditing = null;
            }
			
			
		
		
		});

 
    
  
		
	</script>


</head>
<body>
<input type="hidden" name="uName" value="<?php echo $uname;?>">
<div class="ui segment">
<div class="ui left icon input ">
  <input class="srch" type="text" placeholder="Search users...">
  <i class="users icon"></i>

</div>
  <button id="search" class="ui button">Search</button>
  <div class="ui label">
					<i class="Calendar icon"></i> 起迄日
				</div>
  <div class="ui icon input sr">
				
				<input class=" datepicker ll-skin-latoja srch"  name="act" type="text">
	</div>
	<div class="ui icon input ">
				<input class=" datepicker ll-skin-latoja srch"  name="act" type="text">
	</div>
	<div class="ui label">
	totla:
	<i id="total"class="File icon"></i>
	</div>
	
	<div id="record" class="ui icon button">
	<a href='./showRecord.php'>record</a>
  <i id="record"class="inbox icon"></i>
	</div>
	
	
  </div>
<div class="ui segment">
  <form method="post" action="export.php" id="f1">
<input id="exportName" type="hidden" name="export" value="">
<input id="stDate" type="hidden" name="stDate" value="">
<input id="endDate" type="hidden" name="endDate" value="">
<input id="export" class="ui button " type="button" value="export">

<?php 
			include_once('connections/connDB.php');
			$query = "select date,account,type,ip,notes,checked from hackedMail";
			$result = mysql_query($query);
			
			$lvQuery = "select func from hackedmailuser where account = '$uname'";
			$lvResult = mysql_query($lvQuery);
			$lv_result = mysql_fetch_assoc($lvResult);
			$moduleP = json_decode($lv_result['func']);
		if(in_array("0",$moduleP))
			echo"<i class=\"add icon\"></i><div class=\"ui button\" id=\"add\">add</div>";
	?>
	
	<i class="save icon"></i><div class="ui button" id="save">save(異動後請記得儲存)</div>
</form>
</div>



<table class="ui table  segment" style="  table-layout:fixed;
    word-break:break-all;
    word-wrap:break-word;">
      <thead>
        <tr><th>日期</th>
        <th>帳號</th>
        <th>帳號類型</th>
		<th>IP位址</th>
		<th>備註</th>
		<th>狀態</th>
		
      </tr></thead>
      <tbody id="listCnt">
        <?php
			include_once('connections/connDB.php');
			$query = "select date,account,type,ip,notes,checked from hackedMail";
			$result = mysql_query($query);
			
			$lvQuery = "select func from hackedmailuser where account = '$uname'";
			$lvResult = mysql_query($lvQuery);
			$lv_result = mysql_fetch_assoc($lvResult);
			$moduleP = json_decode($lv_result['func']);
			
			while($row_result = mysql_fetch_assoc($result))
			{
				if($row_result['checked']==1)
					echo "<tr class='negative'>";
				else
					echo "<tr>";
				foreach($row_result as $key => $value)
				{
					
					if($key=="checked")
					{
						if($value==0)
							echo  "<td><i class=\"icon\"></i><div class=\"ui toggle button\">check</div>";
						elseif($value==1)
							echo  "<td><i class=\"icon checkmark\"  ></i><div class=\"ui toggle button active\">checked</div>";
							
							echo "<br/>";
							if(in_array("0",$moduleP))
								echo "<i class=\"icon delete\" style=\"color:gray\"></i><div class=\" ui button delBtn\">delete</div></td>";
							else
								echo"</td>";
						
					}
					else
						echo "<td class='cell column'>".$value."</td>";
				}
				//if()
				echo "</tr>";
			}	
				
		?>
        <!--<tr >
          <td >Jimmy</td>
          <td>Approved</td>
          <td>None</td>
		  <td><div class="ui form">
			<div class="field">
			<textarea></textarea>
			</div>
			</div></td>
		  <td><i class="remove icon"></i><div class="ui button">delete</div></td>
        </tr>
        <tr>
          <td>Jamie</td>
          <td>Unknown</td>
          <td class="negative"><i class="icon close"></i> Requires call</td>
        </tr>
        -->
      </tbody>
    </table>
	
	<!--add dialog form -->
	<div class="ui modal" id="addform">
	  <i class="close icon"></i>
	  <div class="header">
		新增停用帳號
	  </div>
		  <div class="content">
			<form class="ui form segment">
				
				<div class="field">
				<label>date</label>
				<input class="addCount datepicker ll-skin-latoja"  name="act" type="text">
			  </div>
				<p></p>
			  <div class="field">
				<label>account</label>
				<input class="addCount" placeholder="account" name="act" type="text">
			  </div>
				<p></p>
				<div class="field">
				<label>type</label>
					<div class="ui selection dropdown">
					  <input class="addCount" type="hidden" name="type">
					  <div class="default text">教職員帳號</div>
					  <i class="dropdown icon"></i>
					  <div class="menu">
						<div class="item" data-value="1">公務帳號</div>
						<div class="item" data-value="0">學生帳號</div>
					  </div>
					</div>
				
			  </div>
				<p></p>
				<div class="field">
				<label>ip</label>
				<input class="addCount" placeholder="ip" name="act" type="text">
			  </div>
				<p></p>
				<div class="field">
				<label>備註</label>
				<input class="addCount" placeholder="notes" name="act" type="text">
			  </div>
			 
		</form>
	  </div>
	  <div class="actions">
		<div class="ui button">
		  Cancel
		</div>
		<button class="ui button" id="prepend">
		  Okay
		</button>
	  </div>
	</div>
	
</body>

</html>