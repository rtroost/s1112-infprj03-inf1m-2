<?php

class Bestellen_model extends CI_model{

	function getProducten(){
		$productenQ = $this->db->query('
		SELECT * FROM product
		INNER JOIN product_ingredient ON (product.productid = product_ingredient.productid)
		INNER JOIN categorie_ingredient ON (product_ingredient.catingid = categorie_ingredient.catingid)
		INNER JOIN categorie ON (categorie_ingredient.categorieid = categorie.categorieid)
		INNER JOIN ingredient ON (categorie_ingredient.categorieid = ingredient.ingredientid)
		');
		
		if ($productenQ->num_rows() > 0){
			foreach($productenQ->result() as $product){
				$data[] = $product;
				
			}
		}
		return $data;
	}
}
?>