<?php

class search_model extends CI_model{

	function getSearchProducten(){
		$searchQ = $this->db->query("
		SELECT * FROM product
		WHERE naam like '%".$_GET['search']."%'
		");
		
		
		if ($searchQ->num_rows() > 0){
			foreach($searchQ->result() as $result){
				$data[] = $result;
			}
		}
		
		elseif ($searchQ->num_rows() == 0){
			$data[] = 'Geen resultaten';
		}
		
		return $data;
	}
}

?>