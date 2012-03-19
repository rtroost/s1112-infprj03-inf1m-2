<?php

class Categorie_model extends CI_model{

	function getCategorieen(){
		$categorieQ = $this->db->query('
		SELECT * FROM categorie');
		
		if ($categorieQ->num_rows() > 0){
			foreach($categorieQ->result() as $categorie){
				$data[] = $categorie;
			}
		}
		return $data;
	}
	
	function getId($id){
		$categorieQ = $this->db->query('
		SELECT * FROM categorie WHERE categorieid = ' . $id . ';');
		
		if ($categorieQ->num_rows() > 0){
				$data = $categorieQ->result();
		}
		return $data;
	}
	
	function get_name($id){
		$data = NULL;
		$naam = $this->db->query("
			SELECT naam FROM categorie WHERE categorieid = '{$id}'
		");
		
		if ($naam->num_rows() > 0){
			$data = $naam->result();
		}
		return $data;
	}
	
}
?>