<?php


class Gebruiker extends CI_model {
	
	function login() {
		$sql = "SELECT gebruikerid, typeid, voornaam, achternaam, email FROM gebruiker WHERE email = '" . $this->input->post('email') . "' AND wachtwoord = '" . md5($this->input->post('password')) . "' ";
		
		$q = $this->db->query($sql);
		
		if($q->num_rows == 1){
			return $q->result();  //fetch array
		} else {
			return NULL;
		}
	}
	
}


?>