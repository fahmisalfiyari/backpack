<?php
    include "conn.php";
	
    $email    = @$_POST['inputEmail'];
	$link = @$_POST['inputHash'];
    $password  = hash("sha256",@$_POST['inputPassword']);
	$retypepassword  = hash("sha256",@$_POST['inputRetypePassword']);
	
	date_default_timezone_set("Asia/Bangkok");
	$dateRegister = date("Ymd",time()).date("H:i:s");

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header('location:forgotPassword?status=uknown');
		exit;
	}
	else {
		$email = filter_var($email, FILTER_SANITIZE_STRING);
	}
	
	if ($password != $retypepassword) {
		header('location:forgotPassword?status=unknown');
		exit;
	}
	else {
		$userCheck = "SELECT link, email FROM forgot_password WHERE link = '$link' AND flag='1'";
		$checkExist = mysqli_query($conn, $userCheck);
		$data = mysqli_fetch_array($checkExist, MYSQLI_NUM);
		if($data[0] == NULL) {
			header('location:forgotPassword?status=unknown');
			exit;
		}
		else {
			$userUpdate = "UPDATE users SET password = '$password', created_at = '$dateRegister' WHERE email='$email'";
			if ($conn->query($userUpdate) === TRUE) {
				header('location:login?status=resetSuccess');
				exit;
			}	
			else {
				header('location:forgotPassword?status=unknown');
				exit;  
			}
		}
	}
?>
