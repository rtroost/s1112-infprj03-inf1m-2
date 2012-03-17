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
}
?>