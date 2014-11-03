<?php

	class model_db extends CI_Model{
	
		function getData($page){
			
			$query = $this->db->get_where("pages", array("page" => $page));
			
			return $query->result();
		}
		
		public function can_log_in() {

			$this->db->where("email", $this->input->post('email'));
			$this->db->where("password", md5($this->input->post('password')));

			$query = $this->db->get_where("users");
			
			if  ($query->num_rows() == 1) {				
				return true;
			} else {
				return false;
			}		
		}
		
		public function create_temp_user($key) {
		
			$data = array(
				'email' => $this->post->input->post('email'),
				'password' => $this->post->input->post('pw1'),
				'key' => $key	
			);
				
			$query = $this->db->insert( 'temp_users', $data);
			if ($query) {
				return true;
			} else {
				return false;
			}
			
		}
		
		
		
		
		
	}