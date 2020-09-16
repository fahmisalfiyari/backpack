<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile extends CI_Controller {
	private $tabelPengguna='';
	
	
	public function __construct(){
		parent::__construct();
		$this->load->model('Pengguna');
	}

	public function index(){
		$id = '1';
		$setting = array(
			'title' 			=> 'My Profile'
		);		
     
        //Build data pengguna
        $hasil=$this->Pengguna->getUsers($id);
		$data['profile'] = $hasil;
		
			
		$this->display_page('profile', $setting, $data);
		//$this->display_page('profile', $setting);
		//$this->index();
	}
	
	 public function ProfilePengguna()
    {
        
    }
	

	// @session_start();
    
	//    $id = @$_SESSION['id'];
   
    //if(!$id){
    //    header('location:'.$host.'signin.php');
    //}

    // get data user
    //$user = "SELECT user_profile.*,users.email FROM user_profile LEFT JOIN users ON users.id = user_profile.id_user WHERE user_profile.id_user = $id";

    //$user_result = $conn->query($user);

    //$user_profile = mysqli_fetch_assoc($user_result);


	//display
	private function display_page($main_content, $setting=null, $data=null){
		$this->load->view("template/header", $setting);
		$this->load->view($main_content,$data);
		$this->load->view("template/footer");
	}
}
