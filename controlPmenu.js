$(document)
  .ready(function() {
    
    $('.userList.menu').hide();
	$('.t').on('click',function(){
	
	
	//alert($(this).val());
	
	
	$(this).siblings(".userList.menu").slideToggle('slow');
	 $pan = $(this).find(".h");
	//alert((this).hasClass("change"));
	if(!$pan.hasClass("change"))
	{
	var account = $pan.find(".clickName").text();
	//alert(account);
	$userList = $(this).siblings(".userList.menu").find("div");
	//$userList.append("<p>dsf</p>");
	//alert(account);
	$.ajax
				({
					url: 'gethackPInfo.php',
					cache: false,
					dataType: 'json',
					type:'POST',
					data: { acc:account,user:session },
					error: function(xhr) 
				{
					   alert('Ajax request wtf 錯誤~');
					   
					},
					success: function(response) 
					{ 
						//alert(response);
						$userList.html("");
						for(var i=0;i<response.length;i++)
						{
						//alert();
							/*var content = $("<div/>")
							.addClass("columm")
							.append($("<div/>").addClass("ui segment").append("hellow"));
							
							
							var content = $('<div/>', {
								class: 'column',
								html:$('<div/>',{
										className: 'ui segment',
										html:'sdfsdf'
										})
							});*/
							var name = response[i].name;
							var defService = response[i].service.defaultM;
							var usedService = response[i].service.used;
							
							var checkBox = "";
							//alert(usedService);
							
							for(var j=0;j<defService.length;j++)
							{
									if(usedService.indexOf(defService[j].ID)>=0)
										checkBox+="<input type='checkbox'  name='s[]' value='"+defService[j].ID+"' checked>"+defService[j].name+"<p>";
									else
										checkBox+="<input type='checkbox'  name='s[]' value='"+defService[j].ID+"' >"+defService[j].name+"<p>";
							}
							checkBox+="<input type='hidden' name='sName' value='"+name+"'> ";
							checkBox+="<input type='hidden' name='uName' value='"+account+"'> ";
							var info =($("<div/>").addClass("ui ribbon red label").append(name));
							
							var seg = ($("<form/>").attr("method","post").attr("action","updateM.php").addClass("ui segment").append(info).append(" <button type='submit' class='ui circular black button'>save</button>").append("<p>"+checkBox));
							var content = $("<div/>").addClass("column").append(seg);
							
							//$userList.append("<div class='column'><div class='ui segment'><div class='ui ribbon red label'>"+name+"</div>"+"ss"+"</div></div>");
							//var form =$("<form method='post' action='updateM.php'>").append(content);
							$userList.append(content);
							
							
						}
						
						
						
					}
				}); //end ajax
				$(this).addClass("change");
	}//end if
	
	});
	//end
	
	//控制修改使用者
	$("#editUserChange").dropdown({
		onChange: function (val) {
        console.log("hi");
		
		
		$group = $(this).find(".menu > .item");
		
		$group.each(function(){
		
		//alert($(this).attr("data-value"));
		var check = $(this).attr("data-value");
		//alert(check);
		if(val===check)
		{
			selectM = JSON.parse ($(this).attr("value"));
			//alert("dd");
			
			$eachM = $("#userChangeField > input");
			
			
			//alert(selectM[0]);
			//alert("test"+$.inArray(0,selectM));
			$eachM.each(function(){
			$(this).prop('checked', false);
			var valID = $(this).attr("value");
			//alert(valID);
			
				if($.inArray(parseInt(valID,10),selectM)!=-1)
					$(this).prop('checked', true);
				
			});
			return false; //break foreach
		}
		
		
		});
		//alert($group);
		}
	});
	
	
	//控制修改群組
	$("#editGroupChange").dropdown({
		onChange: function (val) {
        console.log("hi");
		
		
		$group = $(this).find(".menu > .item");
		
		$group.each(function(){
		
		//console.log($(this).attr("data-value"));
		var check = $(this).attr("data-value");
		//alert(check);
		if(val===check)
		{
			selectM = JSON.parse ($(this).attr("value"));
			//alert("dd");
			
			$eachM = $(".gCH");
			
			
			//alert(selectM[0]);
			//alert("test"+$.inArray(0,selectM));
			$eachM.each(function(){
				//alert($(this));
			$(this).prop('checked', false);
			var valID = $(this).attr("value");
			//alert(valID);
			
				if($.inArray(parseInt(valID,10),selectM)!=-1)
				{
					$(this).prop('checked', true);
					//alert($(this).text());
					$.ajax
					({
							url: 'searchDefaultP.php',
							cache: false,
							dataType: 'json',
							type:'POST',
							data: { muduleNo:valID ,groupName:val},
							error: function(xhr) 
							{
							  // alert('Ajax request 錯誤~');
							},
							success: function(response) 
							{ 
								console.log(response);
								var usedFunc = JSON.parse(response);
								for(var i=0;i<usedFunc.length;i++)
								{
									
									console.log(usedFunc[i]);
									var target = "#U"+String(valID)+"F"+String(usedFunc[i]);
									console.log(target);
									
								 $(target).prop('checked', true) ;
								  
									
								}
									
							}
								
								
								
						
					});
			
					
						
				}
					
				
			});
			return false; //break foreach
		}
		
		
		});
		//alert($group);
		}
	});
	
	
	
	//auto conplete
	$(".selectUsr").autocomplete("autotest.php", {matchContains: true});  
	
	//search 
	
	$("#pSearchBtn").on('click',function(){
		
		var searchKey = $('#pSearchIpt').val();
		searchKey = searchKey.split(" ",1);
		
		$allObj = $(".userItem");
		
		if(searchKey!="") //確定搜尋列不為空
		{
			$allObj.each(function( index ) {
				$name = $(this).find("span > div");
				if($name.text() == searchKey)
				{
					$(this).show();
				}
				else
					$(this).hide();
			  //alert( index + ": " + $name.text() );
			});
		}
		else
			$allObj.show();
		
	});
	
	
	
  })
;