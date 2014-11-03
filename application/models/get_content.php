<?php

	class  get_content extends CI_Model{
	
		function getsponsors () {
			$query = $this->db->query("select * from sponsors");
			return $query->result();
		}
		

	}