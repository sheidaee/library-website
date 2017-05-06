$(document).ready(function(){    			
	$('a[title="ویرایش کاربر"]').click(function() {    				
		var user_id = $(this).attr("id");    
		var form = $("#edit_user");    				
		$(form).show("slow", function(){    					    					    					
			$.ajax({
				url: form.attr("action"),
				type: form.attr("method"),
				data: {id:user_id},
				success: function(data){    							
					var $response = $(data);						    
				    	$("input[name='user_login']").val($response.filter('#user').text());
				    	$("input[name='user_email']").val($response.filter('#email').text());
				    	$("input[name='id']").val(user_id);
				}
			});//end ajax    					
		});//end show
	});//end click

	$("#edit_user").on("submit",function(){
		var form = $("#edit_user");    				    				
		var new_username = $("input[name='user_login']").val();
		var new_email = $("input[name='user_email']").val();				
		if(new_email=='' || new_username ==''){
			alert('لطفا اطلاعات را کامل وارد کنید');						
			return false;
		}
		$.ajax({
			url: form.attr("action"),
			type: form.attr("method"),
			data: {user:new_username, email:new_email, user_id:$("input[name='id']").val()},
			success: function(){									
				alert("عمل ویرایش با موفقیت انجام شد");
				window.location.replace("users.php");								
			}//end success	
		});//end ajax
	return false;
	});//end submit

	//delete user
	$('a[title="حذف کاربر"]').click(function() {    				
		var del_user = confirm("آیا نسبت به حذف کاربر انتخابی اطمینان دارید؟");
		var user_id = $(this).attr("id");    
		
		if(del_user==false) return false;

		$.ajax({
			url: 'del_user.php',
			type: 'POST',
			data: {id:user_id},
			success: function(){    							
				alert("عمل حذف با موفقیت انجام شد");
				window.location.replace("users.php");								
			}//end success	
		});//end ajax    					
		
	});//end click
});//jquery