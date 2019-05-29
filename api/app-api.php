<?php 
include '../inc/connect.inc.php';
include '../inc/functions.php';
header("Content-type:application/json");

//LOG CLIENT REGISTERED USER IN AND FETCH NECESSARY DETAILS
if (isset($_POST['check_client_user_login'])) {
	$email = sanitize($_POST['email']);
	$password = sanitize ($_POST['password']);

	if (empty($email)) {
		$email_error =  "Password is empty";
		$login_response["email_error"] = $email_error;
		$err_flag = true;
	}

	if (empty($password)) {
		$password_error =  "Password is empty";
		$login_response["password_error"] = $password_error;
		$err_flag = true;
	}

	if (!isset($err_flag)) {
		$password = sha1(md5($password));
		$checkusser = mysqli_query($conn,"SELECT * from client_users where `email` = '$email' and `password` = '$password'");
		if (mysqli_num_rows($checkusser) > 0) {
			$login_response["success"] = "Yes";
			$row = mysqli_fetch_array($checkusser);
			$login_response["fullname"] = $row["fullname"];
			$login_response["branch_id"] = $row["branch_id"];
			$login_response["client_id"] = $row["client_id"];
			$login_response["role"] = $row["role"];
			$client_id =  $row["client_id"];
			$getpins = mysqli_query($conn,"SELECT * FROM branch_pin_allocated where client_id = '$client_id'");
			if (mysqli_num_rows($getpins) > 0) {
				$count = 0;
				while ($row = mysqli_fetch_array($getpins)) {
					$pins = $row['number_of_pins'];
					$count = $count + $pins;
					$pin_amount = $row['amount_per_pin'];
				}
				$login_response['pins_allocated'] = $count;
				$login_response['pin_amount'] = $pin_amount;
			}else{
				$login_response['pins_allocated'] = 0;
			}
		}else{	
			$result = "No record found";
			$login_response["success"] = $result;
		}
	}

	echo json_encode($login_response);
}


//PIN CHECKER API
if (isset($_POST['check_in_generation'])) {
	$branch_id = sanitize($_POST['branch_id']);
	$client_id = sanitize($_POST['client_id']);
	$checkkey = mysqli_query($conn,"SELECT * FROM student_record where branch_id = '$branch_id' AND client_id = '$client_id' AND register_status = 0");
	if (mysqli_num_rows($checkkey) < 1) {
		$i = 0;
		for ($range= "A"; $range < "Z" ; $range++) { 
			for ($j="F"; $j < "Z"; $j++) { 
				$gen_key = date("ymtd").$range.$j;
				$time = time();
				$input_key = mysqli_query($conn,"INSERT INTO student_record (ref_key,client_id,branch_id) VALUES('$gen_key','$client_id','$branch_id')");
				$pins[$i] = $gen_key;
				$i++;
			}
		}
		if ($i = 499) {
			$pins['response'] = 'done';
		}
	}else{
		$pins['response'] = 'You still have unused reference keys!';
	}
	echo json_encode($pins);
}


//SYNC DATA FOR REGISTRATION AGENT
if (isset($_POST['register_sync'])) {
	$number = sanitize($_POST['number']);
	$client_id = sanitize($_POST['client_id']);
	$branch_id = sanitize($_POST['branch_id']);
	$j=0;
	for ($i=0; $i < $number; $i++) { 
		$fullname = sanitize($_POST[$i]['0']);
		$ref_key = sanitize($_POST[$i]['1']);
		$phone = sanitize($_POST[$i]['2']);
		$jamb_profile_code = sanitize($_POST[$i]['3']);
		$date = time();
		$update_details = mysqli_query($conn,"UPDATE student_record SET fullname = '$fullname', phone = '$phone', jamb_profile_code = '$jamb_profile_code', register_status = '1', key_date = '$date' WHERE ref_key ='$ref_key' AND client_id = '$client_id' AND branch_id = '$branch_id'");
		if ($update_details) {
			$j++;
		}
	}
	if ($j = $number) {
		$saver['result'] = 'okay';
	}else{
		$saver['result'] = "An error occured";
	}
	echo json_encode($saver);
}


//UPDATE PIN RECORDS FOR PIN VENDOR
if (isset($_POST['update_pin'])) {
	$client_id = sanitize($_POST['client_id']);
	$branch_id = sanitize($_POST['branch_id']);
	$checkkey = mysqli_query($conn,"SELECT * FROM student_record where branch_id = '$branch_id' AND client_id = '$client_id' AND pin_status = 0");
	if (mysqli_num_rows($checkkey) < 1) {
		$response['result'] = "Your keys are up-to-date or the registration officer have not generated any";
	}else{
		$i = 0;
		while ($row = mysqli_fetch_array($checkkey)) {
			$response[$i] = $row['ref_key'];
			$i++;
		}
		$response['result'] = "okay";
		$response['number'] = $i;
	}
	echo json_encode($response);
}


//SYNC REGISTERED PINS FROM THE PIN VENDOR
if (isset($_POST['pin_sync'])) {
	$client_id = sanitize($_POST['client_id']);
	$branch_id = sanitize($_POST['branch_id']);
	$number = sanitize($_POST['number']);
	$j = 0;
	for ($i=0; $i < $number; $i++) { 
		$ref_key = sanitize($_POST[$i]);
		$date = time();
		$pin_update = mysqli_query($conn,"UPDATE student_record SET pin_status = 1, key_date = '$date' WHERE client_id = '$client_id' AND branch_id = '$branch_id' AND ref_key = '$ref_key'");
	}
	if ($pin_update) {
		$j++;
	}
	if ($j = ($number)) {
		$response['pinresult'] = 'done';
	}else{
		$response['pinresult'] = 'An error occured';
	}
	echo json_encode($response);
}
 ?>