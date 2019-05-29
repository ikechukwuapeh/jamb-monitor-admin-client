$("#assign_pin").click(function(e){
	e.preventDefault();
	number = $("#number").val();
	amount = $("#amount").val();
	id = $("#id").val();

	if ((number != "" && amount != "") && (id != "")) {
		$.post('../inc/processor.php',{assign_pin:1,branch_id:id,number:number,amount:amount},function(data){
            if (data == 'Yes') {
                location.href = "";
             }else{
                $("#allocate_error").html(data);
            }
         });
	}else{
                $("#allocate_error").html("No field should be empty");
	}
})

$("#update_payment").click(function(e){
	e.preventDefault();
	amount_sub = $("#amount_sub").val();
	id = $("#id").val();
	if (amount_sub != "" && id != "") {
		$.post('../inc/processor.php',{update_payment:1,branch_id:id,amount_sub:amount_sub},function(data){
            if (data == 'Yes') {
                location.href = "";
             }else{
                $("#payment_error").html(data);
            }
         });
	}else{
		$("#payment_error").html("No field should be empty");
	}
})