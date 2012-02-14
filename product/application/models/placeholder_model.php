<?php

class Placeholder_model extends CI_model {
	
	function getAll(){
		$q = $this->db->query("SELECT * FROM test" );

		foreach($q->result() as $row){
			$data[] = $row;
		}
		return $data;

	}
}
?>