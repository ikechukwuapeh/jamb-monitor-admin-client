$(document).ready(function(){
	$("#branch_adder").click(function(e){
		e.preventDefault();

		branch_name = $("#branch_name").val();
		branch_location = $("#branch_location").val();

		if (branch_name != "" && branch_location !="") {
       		$.post('inc/processor.php',{add_branch:1,branch_location:branch_location,branch_name:branch_name},function (data) {
		     	if (data =='Yes') {
		     		$("#available").html("Branch added successfully").delay(10000);
		        	location.href = "branches";
		    	}else{
		        	$("#available").html(data);
		      	}
		    });
	   	}else{
	   		$("#available").html("No field should be empty");
	   	}
	})
})