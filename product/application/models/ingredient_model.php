<?php

class Ingredient_model extends CI_model{
	
	function getId($id){
		$ingredien = $this->db->query('
		SELECT naam, gewichtspunten FROM ingredient WHERE ingredientid = ' . $id . ';');
		
		if ($ingredien->num_rows() > 0){
			$data = $ingredien->result();
		}
		return $data;
	}
	
}
?>