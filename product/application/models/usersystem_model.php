<?php

class Usersystem_model extends CI_model {

	function validate() {
		$sql = "SELECT gebruikerid, typeid, voornaam, achternaam, email FROM gebruiker WHERE email = '" . $this -> input -> post('username') . "' AND wachtwoord = '" . md5($this -> input -> post('password')) . "' LIMIT 1";

		$query = $this -> db -> query($sql);

		if ($query -> num_rows() > 0) {
			$row = $query->row();
			
			$data = array('gebruikerid' => $row -> gebruikerid, 'email' => $row -> email, 'voornaam' => $row -> voornaam, 'achternaam' => $row -> achternaam, 'type' => $row -> typeid, 'logged_in' => TRUE);
			$this -> session -> set_userdata($data);
			return TRUE;
			//fetch array
		}
		return FALSE;
	}

	function create_member() {
		$new_member_insert_data = array('first_name' => $this -> input -> post('first_name'), 'last_name' => $this -> input -> post('last_name'), 'username' => $this -> input -> post('username'), 'password' => md5($this -> input -> post('password')), 'email_address' => $this -> input -> post('email'));

		$sql = 'INSERT INTO membership (first_name, last_name, username, password, email_address) VALUES (?, ?, ?, ?, ?);';
		$insert = $this -> db -> query($sql, $new_member_insert_data);
		return $insert;
	}

}
?>