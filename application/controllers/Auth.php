<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('m_auth');
		$id=$this->session->userdata('id');
		$email=$this->session->userdata('email');
		if ($id != NULL|| $email != NULL){
			header('location:../mybookings');
		}
	}

	public function login(){
		$this->load->view('login');
	}

	public function actLogin(){
		$email = $_POST['inputEmail'];
		$password  = hash("sha256",@$_POST['inputPassword']);
		$userSignin = $this->m_auth->userLogin($email, $password);
		$id = $userSignin['id'];
		
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			header('location:login?status=failed');
			exit;
		}
		else {
			$email = filter_var($email, FILTER_SANITIZE_STRING);
		}
		
		if($userSignin['email'] == NULL) {
			header('location:login?status=failed');
		}
		else {
			session_start();
			$_SESSION['email'] = $email;
			$_SESSION['id'] = $id;
			header('location:../mybookings');
		}
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
		date_default_timezone_set("Asia/Jakarta");
		$dateRegister = date("Ymd",time()).date("His");
		$key  = @$_GET['key'];
		
		$getForgotReq = $this->m_auth->getForgotPassword($key,'0');
		if($getForgotReq['link'] == NULL) {
			header('location:forgotPassword?status=unknown');
			exit;
		}
		else {
			$updateForgotPass = $this->m_auth->updateForgotPassword($key,'1');
			if ($updateForgotPass['link'] != NULL) {
				}		 
			else {
				header('location:forgotPassword?status=unknown');
				exit;
			}  
		}
		$this->load->view('resetPassword');
	}
	
	public function actRegister(){
		date_default_timezone_set("Asia/Jakarta");
		
		$email = @$_POST['inputEmail'];
		$id	= mt_rand(0, 999999);
		$fullname = @$_POST['inputFullName'];
		$email    = @$_POST['inputEmail'];
		$password  = hash("sha256",@$_POST['inputPassword']);
		$retypepassword  = hash("sha256",@$_POST['inputRetypePassword']);
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
							header('location:register?status=fail');
						}
					} 
					else {
						header('location:register?status=fail');
					} 
				}
			}
			else {
				header('location:register?status=failure');
				exit;
			}
		}
	}
	
	public function actForgotPassword(){
		date_default_timezone_set("Asia/Jakarta");
		
		$email    = @$_POST['inputEmail'];
		$dateRegister = date("Ymd",time()).date("His");
		$hash = hash("sha256",($email.$dateRegister));
		$link = 'http://'.$_SERVER[HTTP_HOST].str_replace('/actForgotPassword','',$_SERVER[REQUEST_URI]).'/resetPassword?key='.($hash);
		
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			header('location:forgotPassword?status=fail');
			exit;
		}	
		else {
			$email = filter_var($email, FILTER_SANITIZE_STRING);
		}
		
		$userCheck = $this->m_auth->getUserByEmail($email);
		if($userCheck['email'] == NULL) {
			header('location:forgotPassword?status=failed');
			exit;
		}
		else {
			$token = $this->m_auth->getToken();
			$passResetEmail = $this->m_auth->sendEmail($email, $link, $token['access_token']);
			$forgotPasswordInsert = $this->m_auth->insertForgotPassword($email, $hash, $link, '0', $dateRegister);
			
			print_r ($passResetEmail);
			
			if($forgotPasswordInsert['email'] != NULL) {
				header('location:login?status=forgotPassword');
				exit;
			}
			else {
				header('location:forgotPassword?status=failed');
				exit;
			}
		}
	}
	
	public function actResetPassword(){
		date_default_timezone_set("Asia/Jakarta");
		$dateRegister = date("Ymd",time()).date("His");
	    $password  = hash("sha256",@$_POST['inputPassword']);
		$retypepassword  = hash("sha256",@$_POST['inputRetypePassword']);
		$key = @$_POST['inputKey'];
		
		if ($password != $retypepassword) {
			header('location:forgotPassword?status=unknown');
			exit;
		}
		else {
			$getForgotReq = $this->m_auth->getForgotPassword($key,'1');
			if($getForgotReq['link'] == NULL) {
				header('location:forgotPassword?status=unknown');
				exit;
			}
			else {
				$updateCredential = $this->m_auth->updateUserAuth($getForgotReq['email'], $password, $dateRegister);
				if (updateCredential['email'] != NULL) {
					header('location:login?status=resetSuccess');
					exit;
				}
				else {
					header('location:forgotPassword?status=unknown');
					exit;
				}
			}
		}
	}

	//display
	private function display_page($main_content, $setting=null, $data=null){
		$this->load->view("template/header", $setting);
		$this->load->view($main_content,$data);
		$this->load->view("template/footer");
	}
}
