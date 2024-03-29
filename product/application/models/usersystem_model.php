<?php

class Usersystem_model extends CI_model {

	function validate($form_data) {
		$this -> db -> select('gebruikerid, typeid, voornaam, achternaam, email');
		$this -> db -> where($form_data);
		$this -> db -> where(array('gearchiveerd' => '0'));
		$query = $this -> db -> get('gebruiker');

		if ($query -> num_rows() > 0) {
			$row = $query -> row();

			return $row;
		}
		return FALSE;
	}

	function register($form_data) {
		return $this -> db -> insert('gebruiker', $form_data);
	}

	function emailInUse($form_data) {
		$this -> db -> select('email');
		$this -> db -> where('email', $form_data['email']);
		$query = $this -> db -> get('gebruiker');

		if ($query -> num_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	}

	function getUserData() {
		$this -> db -> select('voornaam, achternaam, email, adresregel_1, adresregel_2, postcode, woonplaats, telefoonnummer');
		$this -> db -> where('gebruikerid', $this -> session -> userdata('gebruikerid'));
		$query = $this -> db -> get('gebruiker');

		if ($query -> num_rows() > 0) {
			$row = $query -> row();

			return $row;
		}
		return FALSE;
	}

	function setUserData($form_data) {
		$this -> db -> where('gebruikerid', $this -> session -> userdata('gebruikerid'));
		$this -> db -> update('gebruiker', $form_data);
		//If something, do something :D
		return TRUE;
	}

	function checkPassword($password) {
		$this -> db -> where(array('gebruikerid' => $this -> session -> userdata('gebruikerid'), 'wachtwoord' => $password));
		$query = $this -> db -> get('gebruiker');

		if ($query -> num_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	}

	function hasAdminRights() {
		$this -> db -> where('gebruikerid', $this -> session -> userdata('gebruikerid'));
		$this -> db -> where('typeid', 2);
		$query = $this -> db -> get('gebruiker');

		if ($query -> num_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	}

}
?>