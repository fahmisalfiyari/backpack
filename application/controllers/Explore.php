<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Explore extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('m_ticket');
	}

	public function index(){
		$route = $this->m_ticket->loadAllRoute();
		$data['route'] = $route;


		$setting = array(
			'title' 			=> 'Backpack | Explore '
		);

		$this->display_page('explore', $setting, $data);
	}

	public function schedule

	//display
	private function display_page($main_content, $setting=null, $data=null){
		$this->load->view("template/header", $setting);
		$this->load->view($main_content,$data);
		$this->load->view("template/footer");
	}
}
