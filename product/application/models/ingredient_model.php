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
	function getIdv2($catid){
		$ingredien = $this->db->query("
		SELECT naam, gewichtspunten FROM ingredient AS i, categorie_ingredient AS ci WHERE  i.ingredientid = ci.ingredientid AND ci.catingid = {$catid}
		");
		
		if ($ingredien->num_rows() > 0){
			$data = $ingredien->result();
		}
		return $data;
	}
	
	function get_all_names_by_categorie($catid){
		$data = NULL;
		$namen = $this->db->query("
		SELECT ci.catingid, naam, i.gewichtspunten, prijs FROM categorie_ingredient AS ci, ingredient AS i WHERE ci.ingredientid = i.ingredientid AND ci.categorieid = {$catid}
		");
		
		if ($namen->num_rows() > 0){
			foreach($namen->result() as $naam){
				$data[] = $naam;
			}
		}
		return $data;
	}
	
}
?>