$(document).ready(function(){
	$("#savethis").click(function(e){
		e.preventDefault();
		id = $("#id").val();
		fullname = $("#fullname").val();
		phone = $("#phone").val();
		company = $("#company").val();
		address = $("#address").val();
		if ((fullname != "" && phone !="") && (company != "" && address !="")) {
       		$.post('inc/processor.php',{edit_dealer:1,phone:phone,fullname:fullname,company:company,address:address,id:id},function (data) {
		     	if (data =='Yes') {
		     		$("#available").html("Dealer edited successfully").delay(10000);
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