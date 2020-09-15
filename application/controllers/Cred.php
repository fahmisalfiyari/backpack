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
			$schedule 	= $this->m_ticket->loadSchedule($idr);
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

				// if($result->status==1){
				// 	$row[] = '<span class="badge badge-success">Active</span>';
				// }else{
				// 	$row[] = '<span class="badge badge-danger">Inactive</span>';
				// }

				$row[] 	= '<a href="javascript:void(0)" class="btn btn-info btn-sm" tabindex="-1" role="button" title="Preview" onclick="preview('.$result->id.')"><i class="material-icons" style="font-size:16px; padding:3px;">Book</i></a>';
				$data[]	= $row;
			}

			$output = array(
				'draw' 				=> $_POST['draw'],
				'recordsTotal'		=> $this->m_ticket->count_all($table),
				'recordsFiltered'	=> $this->m_ticket->count_filtered($table),
				'data'				=> $data
			);

			echo json_encode($output);
		}else{
			$output = 'No csrf token passed #1';
			echo json_encode($output);
		}
	}

	//display
	private function display_page($main_content, $setting=null, $data=null){
		$this->load->view("template/header", $setting);
		$this->load->view($main_content,$data);
		$this->load->view("template/footer");
	}
}
