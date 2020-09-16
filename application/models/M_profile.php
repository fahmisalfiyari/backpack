<?php
    class M_profile extends CI_Model
    {
		var $table_user 	= 'users';
		var $table_profile 	= 'user_profile';
		
		
        function M_profile_model() {
                parent::Model();
        }
		
		//fungsi-fungsi yang berhubungan dengan pengelolaan pengguna
        public function getUsers($id)
        {
			$this->db->select('u.id,p.fullname,p.phone,p.identity_card,u.email,u.password');
			$this->db->from('users u');
			$this->db->join('user_profile p','u.id = p.id_user','INNER');
			$this->db->where('id',$id);
			$query = $this->db->get();
			return $query->row();
        }


		public function updateProfile($data_profile,$id_user)
        {

			$this->db->where('id_user',$id_user);
			$this->db->update('user_profile',$data_profile);
			//return $query->row();
			
			$this->db->select('u.id,p.fullname,p.phone,p.identity_card,u.email,u.password');
			$this->db->from('users u');
			$this->db->join('user_profile p','u.id = p.id_user','INNER');
			$this->db->where('id',$id_user);
			$query = $this->db->get();
			return $query->row();
			
        }
		
		public function updateProfileIDC($data_profile,$id_user)
        {

			$this->db->where('id_user',$id_user);
			$this->db->update('user_profile',$data_profile); 
			
			$this->db->select('u.id,p.fullname,p.phone,p.identity_card,u.email,u.password');
			$this->db->from('users u');
			$this->db->join('user_profile p','u.id = p.id_user','INNER');
			$this->db->where('id',$id_user);
			$query = $this->db->get();
			return $query->row();
			
        }
		

}

?>
