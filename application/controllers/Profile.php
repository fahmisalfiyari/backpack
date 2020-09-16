<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile extends CI_Controller {
	private $tabelPengguna='';
	private $action='';
	private $userid='';
	
	
	public function __construct(){
		parent::__construct();
		$this->load->model('m_profile');
	}

	public function index(){
		$id = '1';
		$setting = array(
			'title' 			=> 'My Profile'
		);		
     
        //Build data pengguna
        $hasil=$this->m_profile->getUsers($id);
		
		$data['profile'] = $hasil;		
			
		$this->display_page('profile', $setting, $data);

		//$this->display_page('profile', $setting);
		//$this->index();
	}
	
	public function Profile(){
		$id = '1';
		$setting = array(
			'title' 			=> 'My Profile'
		);		
     
        //Build data pengguna
        $hasil=$this->m_profile->getUsers($id);
		
		$data['profile'] = $hasil;		
			
		$this->display_page('profile', $setting, $data);

		//$this->display_page('profile', $setting);
		//$this->index();
	}
	
	public function actProfile()
    {
        $this->action="actProfile";
		$identity_card = $_FILES['userfile']['name'];
		
		// nama direktori upload
		$DirName = './files/';
		
		// cek size
		if($identity_card > 1024){
				echo "File gagal diupload.";
			}
		
		if(isset($identity_card)){			
			// memindahkan file ke temporary
			$tmpName  = $_FILES['userfile']['tmp_name'];
			
			$temp0 = explode(".", $identity_card);
			$temp = $temp0[1];
			$newfilename = round(microtime(true)) . '.' . $temp;
			//$newfilename = round(microtime(true)) . '.' . end($temp0[1]);
			//echo $newfilename;
			$pathFile = $DirName.$newfilename;
			
			move_uploaded_file($_FILES['userfile']['tmp_name'], $pathFile);
			
			$data = array(
				'id_user' => $_POST['id_user'],
				'fullname' => $_POST['name'],
				'phone' => $_POST['phone'],
				'identity_card' => $newfilename
			);
			$hasil=$this->m_profile->updateProfileIDC($data,$_POST['id_user']);
			//echo "ada";
			//ddp ($_FILES);
		}else {
			$data = array(
				'id_user' => $_POST['id_user'],
				'fullname' => $_POST['name'],
				'phone' => $_POST['phone']
			);
			$hasil=$this->m_profile->updateProfile($data,$_POST['id_user']);
			//echo "null";
			//ddp ($_FILES);
			//echo $_FILES['userfile']['name'];
		}
		//$hasil=$this->m_profile->updateProfile($_POST['id_user'],$_POST['name'],$_POST['email'],$_POST['phone'],$_POST['id_card']);
		//$hasil=$this->m_profile->updateProfile($data,$_POST['id_user']);
        $this->Profile();
		//$this->getProfile($_POST['id_user']);
        
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
