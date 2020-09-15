<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {
	public function __construct(){
		parent::__construct();
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
