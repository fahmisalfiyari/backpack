<?php
    class M_review extends CI_Model
    {
		var $table_comment        = 'comment';
		
        function M_review_model() {
                parent::Model();
        }
		
		public function getReview($id)
        {
			$this->db->select('*');
			$this->db->from('comment');
			$this->db->where('comment_user_id', $id);
			$query = $this->db->get();
			return $query->row();
        }
		
        public function getAllReview()
        {
			$this->db->select('*');
			$this->db->where('parent_comment_id', 0);
			return $this->db->get($this->table_comment)->result_array();
        }


		public function addReview($data,$id_user)
        {
			
			$this->db->insert('comment',$data);
			
        }
	
}

?>
