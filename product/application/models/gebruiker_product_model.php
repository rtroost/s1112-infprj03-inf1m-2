<?php

class Gebruiker_product_model extends CI_model {
	
	function create_gebruiker_product($data){
		$sql = 'INSERT INTO gebruiker_product (gebruikerid, productid, publiekelijk, aanmaak_datetime) VALUES (?, ?, ?, ?);';
		$insert = $this->db->query($sql, $data);
		return $insert;
	}
}
?>