<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Promo extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('m_ticket');
		$id=$this->session->userdata('id');
		$email=$this->session->userdata('email');
		if (!$id || !$email){
			session_destroy();
			redirect('/auth/login');
		}
	}

	public function index(){
		$promo = $this->m_ticket->loadAllPromoAvailable();
		$data['promo'] = $promo;

		$setting = array(
			'title' 			=> 'Backpack | Promo Code'
		);

		$this->display_page('v_promo', $setting, $data);
	}

	//display
	private function display_page($main_content, $setting=null, $data=null){
		$this->load->view("template/header", $setting);
		$this->load->view($main_content,$data);
		$this->load->view("template/footer");
	}
}
