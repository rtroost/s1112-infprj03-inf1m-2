<?php

class Product_model extends CI_model {
	
	function getName($productid) {
		$result = $this->db->query("
		SELECT naam FROM product WHERE productid = {$productid} LIMIT 1
		");
		
		if ($result->num_rows() > 0) {			
			$data = $result->result();
			$data = $data[0]->naam;
		}
		return $data;
	}

	function getCost($productid) {
		$data = 0;
		$result = $this->db->query("
		SELECT catingid FROM product_ingredient WHERE productid = {$productid}
		");
		
		if ($result->num_rows() > 0){
			foreach($result->result() as $product_ingredient){
				$result2 = $this->db->query("
					SELECT prijs FROM categorie_ingredient WHERE catingid = {$product_ingredient->catingid}
					");
					if ($result2->num_rows() > 0){
						$row = $result2->result();
						$data += $row[0]->prijs;
					}
			}
		}
		return $data;
	}
	
	function create_product($data){
		$sql = 'INSERT INTO product (naam, standaard, categorieid, gearchiveerd, temp) VALUES (?, ?, ?, ?, ?);';
		$insert = $this->db->query($sql, $data);
		return $insert;
	}
	
	function get_products_by_id($product_id){
		
		$data = NULL;
		$result = $this->db->query("
			SELECT * FROM product WHERE productid = '{$product_id}' AND gearchiveerd = '0' AND temp = '0' LIMIT 1
		");
		
		if ($result->num_rows() > 0){
			$data = $result->result();		
		}
		return $data;
	}
	
	function get_name_of_ingredients($product_id){
			$data = NULL;
			$result = $this->db->query("
				SELECT i.naam
				FROM product AS p, product_ingredient AS pi, categorie_ingredient AS ci, ingredient AS i
				WHERE p.productid = '{$product_id}' 
				AND p.productid= pi.productid 
				AND pi.catingid = ci.catingid 
				AND ci.ingredientid = i.ingredientid
			");
			if ($result->num_rows() > 0){
				foreach($result->result() as $naam){
					$data[] = $naam->naam;
				}	
				//$data = $result->result();		
			}
			return $data;
	}
	
	function get_name_hoeveelheid_of_ingredients($product_id){
			$data = array();
			$result = $this->db->query("
				SELECT i.naam, pi.ingredienthoeveelheid
				FROM product AS p, product_ingredient AS pi, categorie_ingredient AS ci, ingredient AS i
				WHERE p.productid = '{$product_id}' 
				AND p.productid= pi.productid 
				AND pi.catingid = ci.catingid 
				AND ci.ingredientid = i.ingredientid
			");
			if ($result->num_rows() > 0){
				foreach($result->result() as $naam){
					$data['names'][] = $naam->naam;
					$data['hoeveelheid'][] = $naam->ingredienthoeveelheid;
				}	
				//$data = $result->result();		
			}
			return $data;
	}
	
	function verwijder_product($product_id){
		return $this->db->query("
			UPDATE product SET gearchiveerd = 1 WHERE productid = '{$product_id}';
		");
	}
	
	
}
?>