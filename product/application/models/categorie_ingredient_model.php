<?php

class Categorie_ingredient_model extends CI_model{
	
	function getIngredientenPerCategorie($id){
		$ingredienCategorie = $this->db->query('
		SELECT ingredientid, prijs FROM categorie_ingredient WHERE categorieid = ' . $id . ';');
		
		if ($ingredienCategorie->num_rows() > 0){
			foreach($ingredienCategorie->result() as $categorie){
				$data[] = $categorie;
			}
		}
		return $data;
	}
	
}
?>