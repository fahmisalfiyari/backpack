<?php
    include "conn.php";
	
	$id	= mt_rand(0, 9999999999);
	$fullname = @$_POST['inputFullName'];
    $email    = @$_POST['inputEmail'];
    $password  = hash("sha256",@$_POST['inputPassword']);
	$retypepassword  = hash("sha256",@$_POST['inputRetypePassword']);
	
	date_default_timezone_set("Asia/Jakarta");
	$dateRegister = date("Ymd",time()).date("His");
	
	$fullname = preg_replace("/[^a-zA-Z0-9\s]/", "", $fullname);
	$fullname = preg_replace('/-+/', '-', $fullname);
	//echo ($email."\n".$password."\n".$retypepassword."\n".$agreement);
	echo ($dateRegister);
	
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
			$userCheck = "SELECT email, id FROM users WHERE email = '$email'";
			$checkExist = mysqli_query($conn,$userCheck);
			$data = mysqli_fetch_array($checkExist, MYSQLI_NUM);
			echo ($data[0]);
			if($data[0] != NULL) {
				header('location:register?status=fail');
				exit;
			}
			else {
				while ($data[1] == '$id'){
					$id	= mt_rand(0, 9999999999);
				}
				$sql = "INSERT INTO users (id, email, password, created_at) VALUES ('$id', '$email', '$password', '$dateRegister')";
				if ($conn->query($sql) === TRUE) {
					$sql_profile = "INSERT INTO user_profile (id_user,fullname,created_at) VALUES ('$id','$fullname','$dateRegister')";
					if($conn->query($sql_profile) === TRUE){
						header('location:login?status=success');
					}
					else {
						$sql_revoke = "DELETE FROM users WHERE email = '$email'";
						if($conn->query($sql_revoke) === TRUE){
							//header('location:register?status=fail');
						}
					}
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
