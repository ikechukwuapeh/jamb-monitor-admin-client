$(document).ready(function(){
	$("#savethis").click(function(e){
		e.preventDefault();
		branch_name = $("#fullname").val();
		branch_location = $("#location").val();
		id = $("#id").val();
		if (branch_name != "" && branch_location !="") {
       		$.post('inc/processor.php',{edit_branch:1,branch_location:branch_location,branch_name:branch_name,id:id},function (data) {
		     	if (data =='Yes') {
		     		$("#available").html("Branch edited successfully").delay(10000);
		        	location.href = "";
		    	}else{
		        	$("#available").html(data);
		      	}
		    });
	   	}else{
	   		$("#available").html("No field should be empty");
	   	}
	})
})