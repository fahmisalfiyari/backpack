<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Review extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('m_review');
		$this->load->model('m_profile');
		
		$this->id=$this->session->userdata('id');
		$this->email=$this->session->userdata('email');
		if (!$this->id || !$this->email){
			session_destroy();
			redirect('/auth/login');
		}
	}

	public function index(){
		
		$idx=$this->id;
		$owncomment = '';
		
		$setting = array(
			'title' 			=> 'Ratings and Reviews'
		);		
     
        //Build data own review
		$submitcomment=$this->m_profile->getComment($idx);
		
		if($submitcomment != '0'){
			//show own comment
			$owncomment=$this->m_review->getReview($idx);
			$data['owncomment'] = $owncomment;
		}
		
		$allcomment=$this->m_review->getAllReview();
		
		if($allcomment != null){
			//show all comment
			$data['allcomment'] = $allcomment;
		}
		
		$this->display_page('review', $setting, $data);
	}
	
	public function actReview()
    {
	
		$idx=$this->id;
		
		if ((!empty($_POST["comment_name"])) && (!empty($_POST["comment_content"])))
		{
			
			$data = array(
				'parent_comment_id' => $_POST['comment_id'],
				'comment' => $_POST['comment_content'],
				'comment_user_id' => $idx,
				'comment_sender_name' => $_POST['comment_name']
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
