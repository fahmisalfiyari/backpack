<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('m_auth');
	}

	public function login(){
		$setting = array(
			'title' => 'My Bookings'
		);

		$this->load->view('login');
	}
	
	public function register(){
		$setting = array(
			'title' => 'My Bookings'
		);

		$this->load->view('register');
	}
	
	public function forgotPassword(){
		$setting = array(
			'title' => 'My Bookings'
		);

		$this->load->view('forgotPassword');
	}
	
	public function resetPassword(){
		$setting = array(
			'title' => 'My Bookings'
		);

		$this->load->view('resetPassword');
	}
	
	public function actRegister(){
		$setting = array(
			'title' => 'My Bookings'
		);

		$this->load->view('../function/actRegister');
	}
	
	public function actoRegister(){
		$email = @$_POST['inputEmail'];
		$id	= mt_rand(0, 999999);
		$fullname = @$_POST['inputFullName'];
		$email    = @$_POST['inputEmail'];
		$password  = hash("sha256",@$_POST['inputPassword']);
		$retypepassword  = hash("sha256",@$_POST['inputRetypePassword']);
	
		date_default_timezone_set("Asia/Jakarta");
		$dateRegister = date("Ymd",time()).date("His");
	
		$fullname = preg_replace("/[^a-zA-Z0-9\s]/", "", $fullname);
		$fullname = preg_replace('/-+/', '-', $fullname);
		
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
				$userCheck = $this->m_auth->getUserByEmail($email);
				if($userCheck['email'] != NULL) {
					header('location:register?status=fail');
					exit;
				}
				else {
					while ($userCheck['id'] == '$id'){
						$id	= mt_rand(0, 999999);
					}
					$userInsert = $this->m_auth->insertUserData($id,$email,$password,$dateRegister);
					if ($userInsert['id'] != NULL) {
						$profileInsert = $this->m_auth->insertProfileData($id, $fullname, $dateRegister);
						if($profileInsert['id_user'] != NULL){
							header('location:login?status=success');
						}
						else {
							//$sql_revoke = "DELETE FROM users WHERE email = '$email'";
							//if($conn->query($sql_revoke) === TRUE){
							header('location:register?status=fail');
							//}
						}
					} 
					else {
						header('location:register?status=fail');
					} 
				}
			}
		}
	}
	
	public function actForgotPassword(){
		$setting = array(
			'title' => 'My Bookings'
		);

		$this->load->view('../function/actForgotPassword');
	}
	
	public function actResetPassword(){
		$setting = array(
			'title' => 'My Bookings'
		);

		$this->load->view('../function/actResetPassword');
	}

	//display
	private function display_page($main_content, $setting=null, $data=null){
		$this->load->view("template/header", $setting);
		$this->load->view($main_content,$data);
		$this->load->view("template/footer");
	}
}
