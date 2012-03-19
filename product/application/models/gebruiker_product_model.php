<?php

class Gebruiker_product_model extends CI_model {
	
	function create_gebruiker_product($data){
		$sql = 'INSERT INTO gebruiker_product (gebruikerid, productid, publiekelijk, aanmaak_datetime) VALUES (?, ?, ?, ?);';
		$insert = $this->db->query($sql, $data);
		return $insert;
	}
	
	function get_all_products_from_user($user_id){
		
		$data = NULL;
		$result = $this->db->query("
		SELECT * FROM gebruiker_product AS gp, product AS p WHERE gp.gebruikerid = '{$user_id}' AND gp.productid = p.productid  AND p.gearchiveerd = 0
		");
		
		if ($result->num_rows() > 0){
			foreach($result->result() as $gebruiker_product){
				$data[] = $gebruiker_product;
			}			
		}
		return $data;
	}
	
	function set_publiekelijk($product_id, $new){
		return $this->db->query("
			UPDATE gebruiker_product SET publiekelijk = {$new} WHERE productid = '{$product_id}';
		");
	}
}
?>