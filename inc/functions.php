<?php session_start();
include 'connect.inc.php';

function sanitize($input)
{
	global $conn;
	$input= trim($input);
	$input = strip_tags($input);
	$input = mysqli_real_escape_string($conn,$input);
	
	return $input;
}


function loguser($table,$email,$password)
{
		global $conn;
		if ($password == "") {
			$result = "Password Cannot Be Empty";
			$err_flag = true;
			return $result;
		}
		if ($email == "") {
			$result = "Email Cannot Be Empty";
			$err_flag = true;
			return $result;
		}
		if (!isset($err_flag)) {
			$password = sha1(md5($password));
			$checkusser = mysqli_query($conn,"SELECT * from $table where `email` = '$email' and `password` = '$password'");
			if (mysqli_num_rows($checkusser) > 0) {
				$admin_detail = mysqli_fetch_array($checkusser);
				$result = "Yes";
				$_SESSION['admin'] = $admin_detail['client_id'];
				$_SESSION['fullname'] = $admin_detail['fullname'];
				return $result;
			}else{
				$result = "No record found";
				return $result;
			}
		}else{
			$result = "error";
			return $result;
		}
}

?>
