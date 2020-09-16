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

	public function schedule(){
		$id = $this->uri->segment('3');
		if($id){
			$idr = decrypt_id($this->uri->segment('3'));
			$schedule 	= $this->m_ticket->loadRouteSchedule($idr);
			$route 		= $this->m_ticket->getRouteById($idr);

			$data['schedule'] = $schedule;
			$data['route'] = $route;

			$setting = array(
				'title' 			=> 'Backpack | Schedule '
			);

			$this->display_page('v_schedule', $setting, $data);
		}else{

		}

	}

	public function ajax_list_schedule(){
		$token 	= $this->input->post('token') ? $this->input->post("token") : null;
		$id 	= $this->input->post('id') ? $this->input->post("id") : null;
		if($token && $id){

			$table 	= 'route_schedule';
			$list 	= $this->m_ticket->get_datatable($table, decrypt_id($id));
			$data 	= array();
			$no 	= $_POST['start'];

			foreach ($list as $result) {
				$no++;
				$row	= array();
				$row[] 	= $no;
				$row[] 	= date_eng4($result->time);
				$row[] 	= $result->seats;

				$row[] 	= '<button class="btn btn-secondary" type="button" onclick="confirm('.$result->id.')"><span class="material-icons" style="font-size:16px; padding:3px;">Book</span></a>';
				$data[]	= $row;
			}

			$output = array(
				'draw' 				=> $_POST['draw'],
				'recordsTotal'		=> $this->m_ticket->count_all($table, decrypt_id($id)),
				'recordsFiltered'	=> $this->m_ticket->count_filtered($table, decrypt_id($id)),
				'data'				=> $data
			);

			echo json_encode($output);
		}else{
			$output = 'No csrf token passed #1';
			echo json_encode($output);
		}
	}

	public function loadSchedule(){
		$ids = $this->input->post('ids') ? $this->input->post('ids') : null;
		if($ids){

			$schedule = $this->m_ticket->getScheduleById($ids);
			if($schedule){
				$data['schedule'] = $schedule;
				$route  = $this->m_ticket->getRouteById($schedule['id_route']);
				$data['route'] = $route;
				$data['price_parsing'] = rupiah($route['price']);
				$data['time_format'] = date_eng4($schedule['time']);
				$data['price'] = $route['price'];
				$data['status'] = 'success';
				echo json_encode($data);
			}else{
				$data['status'] = 'error';
				echo json_encode($data);
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
