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

  public function getRouteById($id){
    $this->db->select('*');
    $this->db->where('id', $id);
    return $this->db->get($this->table_route)->row_array();
  }

  public function loadSchedule($id){
    $this->db->select('*');
    $this->db->where('id_route', $id);
    return $this->db->get($this->table_schedule)->result_array();
  }

}
