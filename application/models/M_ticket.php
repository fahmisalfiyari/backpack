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

  public function get_datatable($table, $id = null){
      $function = 'query_'.$table;
      if($id != null){
        $this->$function($id);
      }else{
        $this->function();
      }
      if(isset($_POST['length']) && $_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);

      $query = $this->db->get();
      return $query->result();
  }

  public function count_filtered($table){
      $function = 'query_'.$table;
      $this->$function();
      $query = $this->db->get();
      return $query->num_rows();
  }

  public function count_all($table){
      $this->db->from($table);
      return $this->db->count_all_results();
  }

  public function query_route_schedule($id = null){
    $this->db->select('*');
    $this->db->from($this->table_schedule);

    if($id){
      $this->db->where('id_route', $id);
    }

    $this->db->order_by('time', 'asc');
  }

  public function loadAllRoute(){
    $this->db->select('*');
    return $this->db->get($this->table_route)->result_array();
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
