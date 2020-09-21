<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Review extends CI_Controller {
	private $id='';
	private $data='';
		
	public function __construct(){
		parent::__construct();
		$this->load->model('m_review');		
		
		$this->id=$this->session->userdata('id');
		$this->email=$this->session->userdata('email');
		if (!$this->id || !$this->email){
			session_destroy();
			redirect('/auth/login');
		}	
	}

	public function index(){
		
		$idx=$this->id;
		
		$allcomment = '';
		$owncomment = '';
		$data['login'] = '0';
		
		if($idx){
			//login		
			$data['login'] = $idx; //login

			$iscomment=$this->m_review->getReview($idx);
			
			if($iscomment != null){
				//show own comment
				$owncomment=$this->m_review->getReview($idx);
				$data['owncomment'] = $owncomment;	
			} else {
				$data['owncomment'] = $owncomment;	
			}			
		} 

		//get all comments
		$allcomment=$this->m_review->getAllReview();
		$data['allcomment'] = $allcomment;
		
		$setting = array(
				'title' 			=> 'Ratings and Reviews'
		);	
		
		$this->display_page('review', $setting, $data);
		
	}
	
	public function actReview()
    {
	
		$idx=$this->id;
		$user_rating = $_POST["user_rating"];
		
		if (!empty($_POST["comment_content"]))
		{
			
			$data = array(
				'parent_comment_id' => $_POST['comment_id'],
				'comment' => $_POST['comment_content'],
				'comment_user_id' => $idx,
				'rating' => $user_rating,
			);
			$hasil=$this->m_review->addReview($data,$idx);
			
		}
        
		$setting = array(
			'title' 			=> 'Ratings and Reviews'
		);		
     
		$this->index();
    }
	

	//display
	private function display_page($main_content, $setting=null, $data=null){
		$this->load->view("template/header", $setting);
		$this->load->view($main_content,$data);
		$this->load->view("template/footer");
	}
}
