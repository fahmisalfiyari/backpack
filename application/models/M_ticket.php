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

  /* DataTables Related Start */

  public function get_datatable($table, $id = null){
      $function = 'query_'.$table;
      if($id != null){
        $this->$function($id);
      }else{
        $this->$function();
      }
      if(isset($_POST['length']) && $_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);

      $query = $this->db->get();
      return $query->result();
  }

  public function count_filtered($table, $id = null){
      $function = 'query_'.$table;
      if($id != null){
        $this->$function($id);
      }else{
        $this->$function();
      }
      $query = $this->db->get();
      return $query->num_rows();
  }

  public function count_all($table, $id = null){
      $this->db->from($table);

      if($id && $table == 'route_schedule'){
        $this->db->where('id_route', $id);
      }

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

  /* DataTables Related Ended */


  public function loadAllRoute(){
    $this->db->select('*');
    return $this->db->get($this->table_route)->result_array();
  }

  public function getRouteById($id){
    $this->db->select('*');
    $this->db->where('id', $id);
    return $this->db->get($this->table_route)->row_array();
  }


  // ================================================================

  public function loadRouteSchedule($id){
    $this->db->select('*');
    $this->db->where('id_route', $id);
    return $this->db->get($this->table_schedule)->result_array();
  }

  public function getScheduleById($id){
    $this->db->select('*');
    $this->db->where('id', $id);
    return $this->db->get($this->table_schedule)->row_array();
  }

  public function updateSchedule($id, $data){
    $this->db->where('id', $id);
    $this->db->update($this->table_schedule, $data);
  }

  // ===================================================================

  public function loadAllPromoAvailable(){
    $this->db->select('*');
    $this->db->where('status', 1);
      return $this->db->get($this->table_promo)->result_array();
  }

  public function getPromoById($id){
    $this->db->select('*');
    $this->db->where('id', $id);
    return $this->db->get($this->table_promo)->row_array();
  }


  // ======================================================================

  public function addBooking($data){
    $this->db->insert($this->table, $data);
    return $this->db->insert_id();
  }

  public function getBooking($id){
    $this->db->select('*');
    $this->db->where('id', $id);
    return $this->db->get($this->table)->row_array();
  }

  public function updateBooking($data, $id){
    $this->db->where('id', $id);
    $this->db->update($this->table, $data);
  }

  public function getMyBooking($id){
    $this->db->where('id_user', $id);
    return $this->db->get($this->table)->result_array();
  }

  public function searchBook($q, $id){
    $this->db->like('code', $q);
    $this->db->where('id_user', $id);
    return $this->db->get($this->table)->result_array();
  }


}
