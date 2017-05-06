$(document).ready(function(){
	
		$("#search-library").keyup(function () { 
    			var key = ($(this).val());
    			$.ajax({
    				url: "search.php",
				type: "POST",
				data: {key:key},
				success: function(data){									
					$("#list-books").html(data);
				}
    			});
		});
	
	
});