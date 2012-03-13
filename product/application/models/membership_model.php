<?php


class Membership_model extends CI_model {
	
	function validate() {
		$sql = "SELECT gebruikerid, typeid, voornaam, achternaam, email FROM gebruiker WHERE email = '" . $this->input->post('email') . "' AND wachtwoord = '" . md5($this->input->post('password')) . "' ";
		
		$q = $this->db->query($sql);
		
		if($q->num_rows == 1){
			return $q->result();  //fetch array
		} else {
			return NULL;
		}
	}
	
	function create_member(){
		$new_member_insert_data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password')),
			'email_address' => $this->input->post('email')
		);
		
		$sql = 'INSERT INTO membership (first_name, last_name, username, password, email_address) VALUES (?, ?, ?, ?, ?);';
		$insert = $this->db->query($sql, $new_member_insert_data);
		return $insert;
	}
}


?>