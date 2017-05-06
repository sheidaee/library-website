$(document).ready(function(){    			
	$('a[title="ویرایش کتاب"]').click(function() {    				
		var book_id = $(this).attr("id");    
		var form = $("#edit_book");    				
		$(form).show("slow", function(){    					    					    					
			$.ajax({
				url: form.attr("action"),
				type: form.attr("method"),
				data: {id:book_id},
				success: function(data){    							
					var $response = $(data);						    
				    	$("input[name='title']").val($response.filter('#title').text());
				    	$("input[name='author']").val($response.filter('#author').text());
				    	$("input[name='year']").val($response.filter('#year').text());
				    	$("input[name='id']").val(book_id);
				}
			});//end ajax    					
		});//end show
	});//end click

	$("#edit_book").on("submit",function(){
		var form = $("#edit_book");    				    				
		var new_title = $("input[name='title']").val();
		var new_author = $("input[name='author']").val();				
		var new_year = $("input[name='year']").val();				
		if(new_title=='' || new_author =='' || new_year ==''){
			alert('لطفا اطلاعات را کامل وارد کنید');						
			return false;
		}
		$.ajax({
			url: form.attr("action"),
			type: form.attr("method"),
			data: {title:new_title, author:new_author, year:new_year, book_id:$("input[name='id']").val()},
			success: function(){									
				alert("عمل ویرایش با موفقیت انجام شد");
				window.location.replace("books.php");								
			}//end success	
		});//end ajax
	return false;
	});//end submit

	//delete user
	$('a[title="حذف کتاب"]').click(function() {    				
		var del_book = confirm("آیا نسبت به حذف کتاب انتخابی اطمینان دارید؟");
		var book_id = $(this).attr("id");    
		
		if(del_book==false) return false;

		$.ajax({
			url: 'del_book.php',
			type: 'POST',
			data: {id:book_id},
			success: function(data){    											
				alert("عمل حذف با موفقیت انجام شد");
				window.location.replace("books.php");								
			}//end success	
		});//end ajax    					
		
	});//end click
});//jquery