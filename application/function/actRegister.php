<?php
    include "conn.php";
	
    $email    = @$_POST['inputEmail'];
    $password  = hash("sha256",@$_POST['inputPassword']);
	$retypepassword  = hash("sha256",@$_POST['inputRetypePassword']);
	
	date_default_timezone_set("Asia/Bangkok");
	$dateRegister = date("Ymd",time()).date("H:i:s");
	
	//echo ($email."\n".$password."\n".$retypepassword."\n".$agreement);
	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header('location:register?status=fail');
		exit;
	}
	else {
		$email = filter_var($email, FILTER_SANITIZE_STRING);
	}
	
	if ($password != $retypepassword) {
		header('location:register?status=failed');
		exit;
	}
	else {
		if (isset($_POST['customCheck'])) {
			$userCheck = "SELECT email FROM users WHERE email = '$email'";
			$checkExist = mysqli_query($conn,$userCheck);
			$data = mysqli_fetch_array($checkExist, MYSQLI_NUM);
			echo ($data[0]);
			if($data[0] != NULL) {
				header('location:register?status=fail');
				exit;
			}
			else {
				$sql = "INSERT INTO users (email, password, created_at) VALUES ('$email', '$password', '$dateRegister')";
				if ($conn->query($sql) === TRUE) {
					header('location:login?status=success');
				} 
				else {;
					header('location:register?status=fail');
				}  
			}
		}
		else {
			header('location:register?status=failure');
			exit;
		}
	}
?>
