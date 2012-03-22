<?php

class Gebruiker_product_model extends CI_model {
	
	function create_gebruiker_product($data){
		$sql = 'INSERT INTO gebruiker_product (gebruikerid, productid, publiekelijk, aanmaak_datetime, eigenaar) VALUES (?, ?, ?, ?, ?);';
		$insert = $this->db->query($sql, $data);
		return $insert;
	}
	
	function get_all_products_from_user($user_id, $eigenaar){
		
		$data = NULL;
		$result = $this->db->query("
		SELECT * FROM gebruiker_product AS gp, product AS p WHERE gp.gebruikerid = '{$user_id}' AND gp.productid = p.productid  AND p.gearchiveerd = 0 AND gp.eigenaar = {$eigenaar}
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
	
	function get_publiekelijk($product_id){
		$result = $this->db->query("
			SELECT publiekelijk FROM gebruiker_product WHERE productid = '{$product_id}';
		");
		if ($result->num_rows() > 0){
			$data = $result->result();
		}
		return $data;
	}
	
	function get_publiekelijk_count($user_id){
		$result = $this->db->query("
			SELECT * FROM gebruiker_product WHERE gebruikerid = '{$user_id}' AND publiekelijk = 1;
		");
		$count = 0;
		if ($result->num_rows() > 0){
			foreach($result->result() as $gebruiker_product){
				$count++;
			}
		}
		return $count;
	}
	
	function remove_favoriet($product_id, $gebruikerid){
		return $this->db->query("
			DELETE FROM gebruiker_product WHERE productid = '{$product_id}' AND gebruikerid = '{$gebruikerid}' AND eigenaar = 0;
		");
	}
	
	function get_eigenaar($product_id){
		$result = $this->db->query("
			SELECT g.email FROM gebruiker_product AS gp, gebruiker AS g WHERE gp.gebruikerid = g.gebruikerid AND gp.productid = {$product_id} AND gp.eigenaar = 1;
		");
		if ($result->num_rows() > 0){
			$data = $result->result();
		}
		return $data;
	}
}
?>