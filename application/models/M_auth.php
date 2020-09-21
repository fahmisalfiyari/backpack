<?php defined('BASEPATH') OR exit('No direct script access allowed');  
class M_auth extends CI_Model {
  var $table_account    = 'users';
  var $table_profile    = 'user_profile';
  var $table_forgot     = 'forgot_password';
    
  public function __construct(){
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
    // Your own constructor code
    $this->db = $this->load->database('default', TRUE);
  }

	public function getToken(){
		$ch = curl_init("https://apigwdev.telkom.co.id:7777/invoke/pub.apigateway.oauth2/getAccessToken");
		$data = array(
			'grant_type' => 'client_credentials',
			'client_id' => '72f49b9a-7571-445b-997f-f5c3de883bf6',
			'client_secret' => '7664bc7b-a511-4b8e-a594-837fd1dfd86e'
			);
		$payload = json_encode($data);
		
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		$result = json_decode($result, true);
		curl_close($ch);
		return $result;
	}

	public function sendEmail($email, $link, $key){
		$ch = curl_init("https://apigwdev.telkom.co.id:7777/gateway/telkom-securecoding-training/1.0/sendEmailTraining");
		$data = array(
			'to' => $email,
			'subject' => 'Reset password request',
			'from' => 'backpack',
			'data' => array (
				'inputLink' => $link)
			);
		$payload = json_encode($data);
		$auth = 'Authorization:Bearer '.$key;
		
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', $auth));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		$result = json_decode($result, true);

		curl_close($ch);
		return $result;
	}
	
	
	public function userLogin($email, $password){
		$this->db->select('*');
		$this->db->where([
						'email'=>$email,
						'password'=>$password
					]);
		return $this->db->get($this->table_account)->row_array();
	}
	
	public function getUserByEmail($email){
		$this->db->select('email, id');
		$this->db->where('email', $email);
		return $this->db->get($this->table_account)->row_array();
	}
  
    public function insertUserData($id, $email, $password, $created_at){
	$dataInsert = [
					'id' => $id,
					'email' => $email,
					'password' => $password,
					'created_at' => $created_at
				];
    $this->db->insert($this->table_account, $dataInsert);
    return $this->db->get_where($this->table_account, array('id'=>$id))->row_array();
	}
  
    public function insertProfileData($id, $fullname, $created_at){
	$dataInsert = [
					'id_user' => $id,
					'fullname' => $fullname,
					'created_at' => $created_at
				];
    $this->db->insert($this->table_profile, $dataInsert);
    return $this->db->get_where($this->table_profile, array('id_user'=>$id))->row_array();
	}

    public function insertForgotPassword($email, $hash, $link, $flag, $created_at){
	$dataInsert = [
					'email' => $email,
					'hash' => $hash,
					'link' => $link,
					'flag' => $flag,
					'created_at' => $created_at
				];
    $this->db->insert($this->table_forgot, $dataInsert);
    return $this->db->get_where($this->table_forgot, array('link'=>$link))->row_array();
	}

	public function getForgotPassword($hash, $flag){
	$this->db->select('link, email');
	$this->db->where([
						'hash'=>$hash,
						'flag'=>$flag
					]);
	return $this->db->get($this->table_forgot)->row_array();
	}

	public function updateForgotPassword($hash, $flag){
	$dataUpdate = [
					'flag' => $flag,
			];	
	$this->db->set($dataUpdate);
	$this->db->where([
							'hash'=>$hash,
							'flag'=>'0'
						]);
	$this->db->update($this->table_forgot);
	return $this->db->get($this->table_forgot)->row_array();
	}
	
	public function updateUserAuth($email, $password, $created_at){
	$dataUpdate = [
					'email' => $email,
					'password' => $password,
					'created_at' => $created_at
			];	
	$this->db->set($dataUpdate);
	$this->db->where([
							'email'=>$email
						]);
	$this->db->update($this->table_account);
	return $this->db->get($this->table_account)->row_array();
	}
	

  public function loadSchedule($id){
    $this->db->select('*');
    $this->db->where('id_route', $id);
    return $this->db->get($this->table_schedule)->result_array();
  }

}
