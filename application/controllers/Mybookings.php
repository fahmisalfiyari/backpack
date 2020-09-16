<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mybookings extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$setting = array(
			'title' 			=> 'Backpack | My Bookings'
		);

		$this->display_page('mybookings', $setting);
	}

	//display
	private function display_page($main_content, $setting=null, $data=null){
		$this->load->view("template/header", $setting);
		$this->load->view($main_content,$data);
		$this->load->view("template/footer");
	}
}
