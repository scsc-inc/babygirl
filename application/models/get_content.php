<?php

	class  get_content extends CI_Model{
	
		function getall () {
			$query = $this->db->query("select * from address_list");
			return $query->result();
		}
	}