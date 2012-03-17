<?php

class Product_ingredient_model extends CI_model {
	
	function create_product_ingredient($data){
		$sql = 'INSERT INTO product_ingredient (catingid, productid, ingredienthoeveelheid) VALUES (?, ?, ?);';
		$insert = $this->db->query($sql, $data);
		return $insert;
	}
}
?>