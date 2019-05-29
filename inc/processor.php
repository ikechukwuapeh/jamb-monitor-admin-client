<?php
include 'connect.inc.php';
include 'functions.php';
@$client_id = $_SESSION['admin'];
date_default_timezone_set("Africa/Lagos");

//Log Client IN
if (isset($_POST['login_client'])) {
	$email = sanitize($_POST['email']);
	$password = sanitize ($_POST['password']);
	$table = 'clients';
	$login = loguser($table,$email,$password); //loguser is a function described in functions.php
	echo "$login";
}


//Add branch to database
if (isset($_POST['add_branch'])) {
	$branch_name = sanitize($_POST['branch_name']);	
	$branch_location = sanitize($_POST['branch_location']);	

	if (empty($branch_name)) {
		$err_flag = true;
		echo "Branch name cannot be empty";
	}

	if (empty($branch_location)) {
		$err_flag = true;
		echo "Branch name cannot be empty";
	}

	if (!isset($err_flag)) {
		$insert_branch = mysqli_query($conn,"INSERT INTO branches (`branch_name`,`branch_location`,`client_id`) VALUES ('$branch_name','$branch_location','$client_id')");
		if ($insert_branch) {
			echo "Yes";
		}
		else{
			echo "An error occured";
		}
	}
}


//Add client user
if (isset($_POST['add_user'])) {


	if(!empty($_POST['fullname'])){
		$fullname = sanitize($_POST['fullname']);
	}else{
		echo "Fullname cannot be empty, ";
		$err_flag = true;
	}


	if(!empty($_POST['phone'])){
		$phone = sanitize($_POST['phone']);
	}else{
		echo "Phone cannot be empty, ";
		$err_flag = true;
	}


	if(!empty($_POST['email'])){
		$email = sanitize($_POST['email']);
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  $check_email = mysqli_query($conn,"SELECT email FROM client_users where email = '$email' AND deleted = '0'");
			if (mysqli_num_rows($check_email) > 0) {
				echo "Email Already Taken, ";
				$err_flag = true;
			} 
		}else{
			echo "Invalid Email Address, ";
			$err_flag = true;
		}
	}else{
		echo "Email cannot be empty, ";
		$err_flag = true;
	}


	if(!empty($_POST['password'])){
		$password = sanitize($_POST['password']);

		if(!empty($_POST['password2'])){
			$password2 = sanitize($_POST['password2']);
			if ($password2 != $password) {
				echo "Passwords do not match, ";
				$err_flag = true;
			}
		}else{
			echo "Confirm password field cannot be empty, ";
			$err_flag = true;
		}
	}else{
		echo "Password field cannot be empty, ";
		$err_flag = true;
	}
	

	if(!empty($_POST['branch'])){

		if ($_POST['branch'] == "Choose...") {
			$err_flag = true;
			echo "You did not choose a branch, ";
		}else{
			$branch = sanitize($_POST['branch']);
		}
	}else{
		echo "Branch cannot be empty, ";
		$err_flag = true;
	}


	if(!empty($_POST['role'])){
		if ($_POST['role'] == "Choose...") {
			$err_flag = true;
			echo "You did not choose a role";
		}else{
			$role = sanitize($_POST['role']);
		}
	}else{
		echo "Role cannot be empty";
		$err_flag = true;
	}


	if (!isset($err_flag)) {
		$password = sha1(md5($password));
		$date = time();
		$insert_user = mysqli_query($conn,"INSERT INTO client_users (`fullname`,`email`,`phone`,`password`,`branch_id`,`register_date`,`client_id`,`role`) VALUES ('$fullname','$email','$phone','$password','$branch','$date','$client_id','$role')");
		if ($insert_user) {
			echo "Yes";
		}else{
			echo "User not inserted successfully";
		}
	}
}


//Add new dealer
if (isset($_POST['add_dealer'])) {
	if(!empty($_POST['fullname'])){
		$fullname = sanitize($_POST['fullname']);
	}else{
		echo "Fullname cannot be empty, ";
		$err_flag = true;
	}


	if(!empty($_POST['phone'])){
		$phone = sanitize($_POST['phone']);
	}else{
		echo "Phone cannot be empty, ";
		$err_flag = true;
	}


	if(!empty($_POST['email'])){
		$email = sanitize($_POST['email']);
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  $check_email = mysqli_query($conn,"SELECT email FROM dealers where email = '$email' AND deleted = '0'");
			if (mysqli_num_rows($check_email) > 0) {
				echo "Email Already Taken, ";
				$err_flag = true;
			} 
		}else{
			echo "Invalid Email Address, ";
			$err_flag = true;
		}
	}else{
		echo "Email cannot be empty, ";
		$err_flag = true;
	}


	if(!empty($_POST['password'])){
		$password = sanitize($_POST['password']);

		if(!empty($_POST['password2'])){
			$password2 = sanitize($_POST['password2']);
			if ($password2 != $password) {
				echo "Passwords do not match, ";
				$err_flag = true;
			}
		}else{
			echo "Confirm password field cannot be empty, ";
			$err_flag = true;
		}
	}else{
		echo "Password field cannot be empty, ";
		$err_flag = true;
	}


	if(!empty($_POST['company'])){
		$company = sanitize($_POST['company']);
	}else{
		echo "company cannot be empty, ";
		$err_flag = true;
	}


	if(!empty($_POST['address'])){
		$address = sanitize($_POST['address']);
	}else{
		echo "address cannot be empty, ";
		$err_flag = true;
	}

	if (!isset($err_flag)) {
		$password = sha1(md5($password));
		$date = time();
		$insert_user = mysqli_query($conn,"INSERT INTO dealers (`fullname`,`phone`,`email`,`password`,`company_name`,`address`,`client_id`) VALUES ('$fullname','$phone','$email','$password','$company','$address','$client_id')");
		if ($insert_user) {
			echo "Yes";
		}else{
			echo "Dealer not inserted successfully";
		}
	}
}


//Edit branch details
if (isset($_POST['edit_branch'])) {
	$branch_name = sanitize($_POST['branch_name']);
	$branch_location = sanitize($_POST['branch_location']);
	$id = sanitize($_POST['id']);

	if (empty($branch_name)) {
		$err_flag = true;
		echo "Branch name cannot be empty";
	}

	if (empty($branch_location)) {
		$err_flag = true;
		echo "Branch name cannot be empty";
	}

	if (!isset($err_flag)) {
		$editbranch = mysqli_query($conn,"UPDATE branches SET branch_name = '$branch_name', branch_location = '$branch_location' where 	branch_id = '$id'");
		if ($editbranch) {
			echo "Yes";
		}else{
			echo "An error occured";
		}
	}
}


//Delete branch
if (isset($_POST['delete_branch'])) {
	$id = sanitize($_POST['id']);
	$deleteid = mysqli_query($conn,"UPDATE branches SET deleted = 1 WHERE branch_id = '$id'");
	if ($deleteid) {
		echo "Yes";
	}else{
		echo "An error occured";
	}
}


//Edit branch details
if (isset($_POST['edit_dealer'])) {
	$fullname = sanitize($_POST['fullname']);
	$phone = sanitize($_POST['phone']);
	$company = sanitize($_POST['company']);
	$address = sanitize($_POST['address']);
	$id = sanitize($_POST['id']);

	if (empty($fullname)) {
		$err_flag = true;
		echo "Dealer name cannot be empty";
	}

	if (empty($phone)) {
		$err_flag = true;
		echo "Phone cannot be empty";
	}

	if (empty($company)) {
		$err_flag = true;
		echo "Company field cannot be empty";
	}

	if (empty($address)) {
		$err_flag = true;
		echo "Address cannot be empty";
	}

	if (!isset($err_flag)) {
		$editbranch = mysqli_query($conn,"UPDATE dealers SET fullname = '$fullname', phone = '$phone', company_name = '$company', address = '$address' where 	dealer_id = '$id'");
		if ($editbranch) {
			echo "Yes";
		}else{
			echo "An error occured";
		}
	}
}


//Delete dealer
if (isset($_POST['delete_dealer'])) {
	$id = sanitize($_POST['id']);
	$deleteid = mysqli_query($conn,"UPDATE dealers SET deleted = 1 WHERE dealer_id = '$id'");
	if ($deleteid) {
		echo "Yes";
	}else{
		echo "An error occured";
	}
}


//EDIT USER 
if (isset($_POST['edit_user'])) {
	$fullname = sanitize($_POST['fullname']);
	$phone = sanitize($_POST['phone']);
	$branch = sanitize($_POST['branch']);
	$role = sanitize($_POST['role']);
	$id = sanitize($_POST['id']);

	if (empty($fullname)) {
		$err_flag = true;
		echo "User name cannot be empty";
	}

	if (empty($phone)) {
		$err_flag = true;
		echo "Phone cannot be empty";
	}

	if(!empty($_POST['branch'])){

		if ($_POST['branch'] == "Choose...") {
			$err_flag = true;
			echo "You did not choose a branch, ";
		}else{
			$branch = sanitize($_POST['branch']);
		}
	}else{
		echo "Branch cannot be empty, ";
		$err_flag = true;
	}


	if(!empty($_POST['role'])){
		if ($_POST['role'] == "Choose...") {
			$err_flag = true;
			echo "You did not choose a role";
		}else{
			$role = sanitize($_POST['role']);
		}
	}else{
		echo "Role cannot be empty";
		$err_flag = true;
	}

	if (!isset($err_flag)) {
		$editbranch = mysqli_query($conn,"UPDATE client_users SET fullname = '$fullname', phone = '$phone', branch_id = '$branch', role = '$role' where 	client_user_id = '$id'");
		if ($editbranch) {
			echo "Yes";
		}else{
			echo "An error occured";
		}
	}
}


//Delete dealer
if (isset($_POST['delete_user'])) {
	$id = sanitize($_POST['id']);
	$deleteid = mysqli_query($conn,"UPDATE client_users SET deleted = 1 WHERE client_user_id = '$id'");
	if ($deleteid) {
		echo "Yes";
	}else{
		echo "An error occured";
	}
}


//ASSIGN PIN TO BRANCH
if (isset($_POST['assign_pin'])) {
	$branch_id = sanitize($_POST['branch_id']);
	$amount = sanitize($_POST['amount']);
	$number = sanitize($_POST['number']);

	if (empty($branch_id)) {
		$err_flag = true;
		echo "Branch cannot be empty";
	}

	if (empty($amount)) {
		$err_flag = true;
		echo "Amount cannot be empty";
	}

	if (empty($number)) {
		$err_flag = true;
		echo "Number of pins cannot be empty";
	}

	if (!isset($err_flag)) {
		$time = time();
		$insert_new_pin = mysqli_query($conn,"INSERT INTO branch_pin_allocated (number_of_pins,branch_id,amount_per_pin,client_id,allocate_date) VALUES ('$number','$branch_id','$amount','$client_id','$time')");
		if ($insert_new_pin) {
			echo "Yes";
		}else{
			echo "An error occured";
		}
	}
}


//UPDATE BRANCH PAYMENT
if (isset($_POST['update_payment'])) {
	$branch_id = sanitize($_POST['branch_id']);
	$amount_sub = sanitize($_POST['amount_sub']);

	if (empty($branch_id)) {
		$err_flag = true;
		echo "Branch cannot be empty";
	}

	if (empty($amount_sub)) {
		$err_flag = true;
		echo "Amount cannot be empty";
	}

	if (!isset($err_flag)) {
		$check_if_pin_assigned = mysqli_query($conn,"SELECT * FROM branch_pin_allocated where branch_id = '$branch_id'");
		if (mysqli_num_rows($check_if_pin_assigned) > 0) {
			$time = time();
			$update_payment = mysqli_query($conn,"INSERT INTO branch_reconcile (branch_id,client_id,amount_paid,payment_date) VALUES ('$branch_id','$client_id','$amount_sub','$time')");
			if ($update_payment) {
				echo "Yes";
			}else{
				echo "An error occured";
			}
		}else{
			echo "You have not yet assigned pin to this branch and so, You cannot update payment for the branch";
		}
	}
}


//ASSIGN PIN TO DEALER
if (isset($_POST['assign_dealer_pin'])) {
	$dealer_id = sanitize($_POST['dealer_id']);
	$amount = sanitize($_POST['amount']);
	$number = sanitize($_POST['number']);

	if (empty($dealer_id)) {
		$err_flag = true;
		echo "Branch cannot be empty";
	}

	if (empty($amount)) {
		$err_flag = true;
		echo "Amount cannot be empty";
	}

	if (empty($number)) {
		$err_flag = true;
		echo "Number of pins cannot be empty";
	}

	if (!isset($err_flag)) {
		$time = time();
		$insert_new_pin = mysqli_query($conn,"INSERT INTO dealer_pin_allocated (number_of_pins,dealer_id,amount_per_pin,client_id,allocate_date) VALUES ('$number','$dealer_id','$amount','$client_id','$time')");
		if ($insert_new_pin) {
			echo "Yes";
		}else{
			echo "An error occured";
		}
	}
}


//UPDATE DEALER PAYMENT
if (isset($_POST['update_dealer_payment'])) {
	$dealer_id = sanitize($_POST['dealer_id']);
	$amount_sub = sanitize($_POST['amount_sub']);

	if (empty($dealer_id)) {
		$err_flag = true;
		echo "Branch cannot be empty";
	}

	if (empty($amount_sub)) {
		$err_flag = true;
		echo "Amount cannot be empty";
	}

	if (!isset($err_flag)) {
		$check_if_pin_assigned = mysqli_query($conn,"SELECT * FROM dealer_pin_allocated where dealer_id = '$dealer_id'");
		if (mysqli_num_rows($check_if_pin_assigned) > 0) {
			$time = time();
			$update_dealer_payment = mysqli_query($conn,"INSERT INTO dealer_reconcile (dealer_id,client_id,amount_paid,payment_date) VALUES ('$dealer_id','$client_id','$amount_sub','$time')");
			if ($update_dealer_payment) {
				echo "Yes";
			}else{
				echo "An error occured";
			}
		}else{
			echo "You have not yet assigned pin to this branch and so, You cannot update payment for the branch";
		}
	}
}

//LOGIN A DEALER
if (isset($_POST['login_dealer'])) {
	$email = sanitize($_POST['email']);
	$password = sanitize ($_POST['password']);
	if ($password == "") {
		echo "Password Cannot Be Empty";
		$err_flag = true;
	}
	if ($email == "") {
		echo "Email Cannot Be Empty";
		$err_flag = true;
	}
	if (!isset($err_flag)) {
		$password = sha1(md5($password));
		$checkusser = mysqli_query($conn,"SELECT * from dealers where `email` = '$email' and `password` = '$password'");
		if (mysqli_num_rows($checkusser) > 0) {
			$dealer_details = mysqli_fetch_array($checkusser);
			$_SESSION['dealer'] = $dealer_details['dealer_id'];
			$_SESSION['dealer_fullname'] = $dealer_details['fullname'];
			echo "Yes";
		}else{
			echo "No record found";
		}
	}else{
		echo "error";
	}
}
?>