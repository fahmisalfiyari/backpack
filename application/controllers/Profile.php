<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile extends CI_Controller {
	private $tabelPengguna='';
	private $action='';
	private $userid='';
	
	
	public function __construct(){
		parent::__construct();
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
		$setting = array(
			'title' 			=> 'My Profile'
		);		
     
        //Build data pengguna
        $hasil=$this->m_profile->getUsers($idx);
		
		$data['profile'] = $hasil;		
		//echo $hasil->identity_card;
			
		$this->display_page('profile', $setting, $data);
	}
	
	public function Profile(){
		//$id = '1';
		$idx=$this->id;
		$setting = array(
			'title' 			=> 'My Profile'
		);		
     
        //Build data pengguna
        $hasil=$this->m_profile->getUsers($idx);
		
		$data['profile'] = $hasil;		
			
		$this->display_page('profile', $setting, $data);
	}
	
	public function actProfile()
    {
		// nama direktori upload
		$DirName = './files/';
		
		
		if ($_FILES['userfile']['size'] == 0)
		{
			// cover_image is empty (and not an error)
			
			$data = array(
				'id_user' => $_POST['id_user'],
				'fullname' => $_POST['name'],
				'phone' => $_POST['phone']
			);
			$hasil=$this->m_profile->updateProfile($data,$_POST['id_user']);
			
		} else{
			$identity_card = $_FILES['userfile']['name'];
			
			// cek size
			if($identity_card > 1024){
				echo "File gagal diupload.";
			}			
			
			// memindahkan file ke temporary
			$tmpName  = $_FILES['userfile']['tmp_name'];
			
			//echo $identity_card;
			$temp0 = explode(".", $identity_card);
			$temp = $temp0[1];
			$newfilename = round(microtime(true)) . '.' . $temp;
			$pathFile = $DirName.$newfilename;
			
			move_uploaded_file($_FILES['userfile']['tmp_name'], $pathFile);
			
			$data = array(
				'id_user' => $_POST['id_user'],
				'fullname' => $_POST['name'],
				'phone' => $_POST['phone'],
				'identity_card' => $newfilename
			);
			$hasil=$this->m_profile->updateProfileIDC($data,$_POST['id_user']);
			
			
		}
		
		
		
		/*
		
		if(isset($identity_card)){			
			// memindahkan file ke temporary
			$tmpName  = $_FILES['userfile']['tmp_name'];
			
			echo $identity_card;
			$temp0 = explode(".", $identity_card);
			$temp = $temp0[1];
			$newfilename = round(microtime(true)) . '.' . $temp;
			$pathFile = $DirName.$newfilename;
			
			move_uploaded_file($_FILES['userfile']['tmp_name'], $pathFile);
			
			$data = array(
				'id_user' => $_POST['id_user'],
				'fullname' => $_POST['name'],
				'phone' => $_POST['phone'],
				'identity_card' => $newfilename
			);
			$hasil=$this->m_profile->updateProfileIDC($data,$_POST['id_user']);
		}else {
			$data = array(
				'id_user' => $_POST['id_user'],
				'fullname' => $_POST['name'],
				'phone' => $_POST['phone']
			);
			$hasil=$this->m_profile->updateProfile($data,$_POST['id_user']);
		}
		*/

        //$this->index();
		$idx=$this->id;
		$setting = array(
			'title' 			=> 'My Profile'
		);		
     
        //Build data pengguna
        $hasil=$this->m_profile->getUsers($idx);
		$data['profile'] = $hasil;	
		
		$this->display_page('profile_u', $setting, $data);
        
    }


	//display
	private function display_page($main_content, $setting=null, $data=null){
		$this->load->view("template/header", $setting);
		$this->load->view($main_content,$data);
		$this->load->view("template/footer");
	}
}
