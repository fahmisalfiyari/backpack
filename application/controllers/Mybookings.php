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

		$this->load->model('m_ticket');
	}

	public function index(){
		$setting = array(
			'title' 			=> 'Backpack | My Bookings'
		);

		$id_user = $this->session->userdata('id');

		$mybookings = $this->m_ticket->getMyBooking($id_user);

		$temp = array();
		$i = 0;
		$data = array();

		if($mybookings){
			foreach ($mybookings as $book) {
				$schedule 	= $this->m_ticket->getScheduleById($book['id_ticket']);
				$route 		= $this->m_ticket->getRouteById($schedule['id_route']);
				$temp[$i]['price_disc'] = '';
				$temp[$i]['code'] = $book['code'];

				if($book['status'] == 1){
					$temp[$i]['status'] = '<span class="badge badge-danger">Unpaid</span>';
				}else if($book['status'] == 2){
					$temp[$i]['status'] = '<span class="badge badge-success">Paid</span>';
				}
				
				$temp[$i]['type'] = $route['type'];
				$temp[$i]['price'] = rupiah($route['price']);

				if($book['promo_id']){
					$promo = $this->m_ticket->getPromoById($book['promo_id']);

					if($promo['value'] || $promo['percentage']){
						if($promo['value'] && $promo['percentage']==null){
							$temp[$i]['price_disc'] = $route['price'] - $promo['value'];
						}else if($promo['percentage'] && $promo['value']==null){	
							$temp[$i]['price_disc'] = $route['price'] - (($promo['percentage'] / 100) * $route['price']);
						}

						$temp[$i]['price'] = '<strike>'.rupiah($route['price']).'</strike></br>'.rupiah($temp[$i]['price_disc']);
					}
				}



				$temp[$i]['time']= $schedule['time'];
				$temp[$i]['departure'] = $route['from'].' - '.$route['to'];
				
				$i++;
			}

			$data['booking'] = $temp;

		}

		$this->display_page('v_mybookings', $setting, $data);
	}

	public function search(){
		$id_user 	= $this->session->userdata('id');
		$q 			= $this->input->get('searchq');

		if($q){
			$q = strtoupper($q);

			$mybookings = $this->m_ticket->searchBook($q, $id_user);

			if($mybookings){
				$temp = array();
				$i = 0;

				foreach ($mybookings as $book) {
					$schedule 	= $this->m_ticket->getScheduleById($book['id_ticket']);
					$route 		= $this->m_ticket->getRouteById($schedule['id_route']);
					$temp[$i]['price_disc'] = '';
					$temp[$i]['code'] = $book['code'];

					if($book['status'] == 1){
						$temp[$i]['status'] = '<span class="badge badge-danger">Unpaid</span>';
					}else if($book['status'] == 2){
						$temp[$i]['status'] = '<span class="badge badge-success">Paid</span>';
					}
					
					$temp[$i]['type'] = $route['type'];
					$temp[$i]['price'] = rupiah($route['price']);

					if($book['promo_id']){
						$promo = $this->m_ticket->getPromoById($book['promo_id']);

						if($promo['value'] || $promo['percentage']){
							if($promo['value'] && $promo['percentage']==null){
								$temp[$i]['price_disc'] = $route['price'] - $promo['value'];
							}else if($promo['percentage'] && $promo['value']==null){	
								$temp[$i]['price_disc'] = $route['price'] - (($promo['percentage'] / 100) * $route['price']);
							}

							$temp[$i]['price'] = '<strike>'.rupiah($route['price']).'</strike></br>'.rupiah($temp[$i]['price_disc']);
						}
					}



					$temp[$i]['time']= $schedule['time'];
					$temp[$i]['departure'] = $route['from'].' - '.$route['to'];
					
					$i++;
				}

				$data['booking'] = $temp;
				$data['q'] = $q;
				$data['result'] = 1;

			}else{
				$data['result'] = 98;
			}


		}else{
			$data['result'] = 99;
		}

		$setting = array(
			'title' 			=> 'Backpack | My Bookings'
		);

		$this->display_page('v_mybookings', $setting, $data);
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
