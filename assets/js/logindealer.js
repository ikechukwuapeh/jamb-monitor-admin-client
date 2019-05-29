$(document).ready(function(){
	$("#signin").click(function(e){
		e.preventDefault();
		email = $("#signin-email").val();
		password = $("#signin-password").val();
		if (password != "" && email !="") {
       		$.post('../inc/processor.php',{login_dealer:1,email:email,password:password},function (data) {
		     	if (data =='Yes') {
		        	location.href = "dashboard";
		    	}else{
		        	$("#available").html(data);
		      	}
		    });
	   	}else{
	   		$("#available").html("No field should be empty");
	   	}
	});
})