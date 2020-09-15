<?php
    include "conn.php";
	
    $email    = @$_POST['inputEmail'];
	
	date_default_timezone_set("Asia/Bangkok");
	$dateRegister = date("Ymd",time()).date("H:i:s");
	
	$hash = hash("sha256",$dateRegister);
	
	$link = 'http://localhost/backpack/auth/resetPassword?key='.($hash);
	//echo ($email.$hash);
	
	//$fullname = preg_replace("/[^a-zA-Z0-9\s]/", "", $fullname);
	//$fullname = preg_replace('/-+/', '-', $fullname);
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header('location:forgotPassword?status=fail');
		exit;
	}
	else {
		$email = filter_var($email, FILTER_SANITIZE_STRING);
	}
	
	$userCheck = "SELECT email FROM users WHERE email = '$email'";
	$checkExist = mysqli_query($conn,$userCheck);
	$data = mysqli_fetch_array($checkExist, MYSQLI_NUM);
	echo ($data[0]);
	if($data[0] == NULL) {
		header('location:forgotPassword?status=failed');
		exit;
	}
	else {
		$sql = "INSERT INTO forgot_password (email, hash, link, flag, created_at) VALUES ('$email', '$hash', '$link', '0','$dateRegister')";
		if ($conn->query($sql) === TRUE) {
			header('location:login?status=forgotPassword');
		} 
		else {;
			header('location:forgotPassword?status=failed');
		}  
	}
?>
