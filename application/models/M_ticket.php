<?php defined('BASEPATH') OR exit('No direct script access allowed');  
class M_ticket extends CI_Model {
  var $table              = 'booking';
  var $table_route        = 'route';
  var $table_schedule     = 'route_schedule';
  var $table_promo        = 'promo';
    
  public function __construct(){
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
    // Your own constructor code
    $this->db = $this->load->database('default', TRUE);
  }

  public function loadAllRoute(){
    $this->db->select('*');
    return $this->db->get($this->table_route)->result_array();
  }

}
