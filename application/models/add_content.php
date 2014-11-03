<?php

	class  add_content extends CI_Model{
	
		function add_sponsor() {
			
			if (trim($this->input->post('sponsor_name') != '')) {
			
				$data = array(
				   'sponsor_name' => $this->input->post('sponsor_name')
				);
				
				$query = $this->db->insert('sponsors', $data);
				return ($this->db->affected_rows() != 1) ? false : true;

				}

			}	
		function add_thankyou() {
		
			$data = array(
			   'sponsor' => $this->input->post('my_sponsors'),
			   'note' => $this->input->post('note')
			);
			
			$query = $this->db->insert('thanks', $data);
			return ($this->db->affected_rows() != 1) ? false : true;
		}					
	}