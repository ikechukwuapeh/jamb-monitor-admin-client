$(document).ready(function(){
	$("#save-edit").click(function(e){
		e.preventDefault();
		id = $("#id").val();
		fullname = $("#fullname").val();
		phone = $("#phone").val();
		role = $("#role").val();
		branch = $("#branch").val();
		if ((fullname != "" && phone !="") && (role != "" && branch !="")) {
       		$.post('inc/processor.php',{edit_user:1,phone:phone,fullname:fullname,role:role,branch:branch,id:id},function (data) {
		     	if (data =='Yes') {
		     		$("#available").html("User edited successfully").delay(10000);
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