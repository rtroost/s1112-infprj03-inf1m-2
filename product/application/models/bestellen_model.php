<?php

class Bestellen_model extends CI_model{

	function getFullProducten(){
		$categorienQ = $this->db->query('select * from categorie where gearchiveerd = 0');
		if($categorienQ->num_rows() > 0){
			foreach($categorienQ->result() as $categorie){
				
				$productenQ = $this->db->query('select * from product where categorieid = '.$categorie->categorieid .' and gearchiveerd = 0 and standaard = 1');
				if($productenQ->num_rows() > 0){
					foreach($productenQ->result() as $product){
						
						$ingredientenQ = $this->db->query('
						select ingredient.naam, product_ingredient.ingredienthoeveelheid, categorie_ingredient.prijs from product_ingredient
						inner join categorie_ingredient on (product_ingredient.catingid = categorie_ingredient.catingid)
						inner join ingredient on (categorie_ingredient.ingredientid = ingredient.ingredientid)
						where productid = '.$product->productid .'');
						if($ingredientenQ->num_rows() > 0){
							$i=0;
							$prijs = 0;
							foreach($ingredientenQ->result() as $ingredient){
								$data[$categorie->naam][$product->naam][$i]	= $ingredient->naam;
								$prijs = $prijs+(($ingredient->ingredienthoeveelheid*0.5)*$ingredient->prijs);
								$i++;								
							}
							$prijs = $categorie->standaardprijs+$prijs;
							$data[$categorie->naam][$product->naam]['prijs'] = $prijs;
						}
					}
				}
			}
		}
		return $data;
	}
	
	function getCategorien(){
		$categorienQ = $this->db->query("select categorieid, naam from categorie where gearchiveerd = '0'");
		if ($categorienQ->num_rows() > 0){
			foreach($categorienQ->result() as $categorie){
				$data[] = $categorie;
				
			}
		}
		return $data;
	}
	
	function getProducten(){
		$productenQ = $this->db->query("select productid, naam, categorieid from product where gearchiveerd = '0'");
		if ($productenQ->num_rows() > 0){
			foreach($productenQ->result() as $product){
				$data[] = $product;
				
			}
		}
		return $data;
	}
}
?>