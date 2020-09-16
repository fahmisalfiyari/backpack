<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mybookings extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$id=$this->session->userdata('id');
		$email=$this->session->userdata('email');
		if (!$id || !$email){
			session_destroy();
			redirect('/auth/login');
		}
	}

	public function index(){
		$setting = array(
			'title' 			=> 'Backpack | My Bookings'
		);

		$this->display_page('mybookings', $setting);
	}
	
	public function userLogout(){
		session_destroy();
		header('location:../auth/login');
	}

	//display
	private function display_page($main_content, $setting=null, $data=null){
		$this->load->view("template/header", $setting);
		$this->load->view($main_content,$data);
		$this->load->view("template/footer");
	}
}
