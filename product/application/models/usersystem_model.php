<?php

class Usersystem_model extends CI_model {

	function validate($form_data) {
		$this->db->select('gebruikerid, typeid, voornaam, achternaam, email');
		$this->db->where($form_data);
		$this->db->where(array('gearchiveerd' => '0'));
		$query = $this->db->get('gebruiker');

		if ($query -> num_rows() > 0) {
			$row = $query -> row();

			return $row;
		}
		return FALSE;		
	}

	function register($form_data) {
		return $this->db->insert('gebruiker', $form_data);
	}

	function emailInUse($form_data)
	{	
		$this->db->select('email');
		$this->db->where('email', $form_data['email']);
		$query = $this->db->get('gebruiker');

		if ($query -> num_rows() > 0) {
			return TRUE;
		}
		return FALSE;	
	}

	function getUserData() {
		$this->db->select('voornaam, achternaam, email, adresregel_1, adresregel_2, postcode, woonplaats, telefoonnummer');
		$this->db->where('gebruikerid', $this -> session -> userdata('gebruikerid'));
		$query = $this->db->get('gebruiker');

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
	function setPassword($ww_data){
	
	$q = mysql_query("	UPDATE gebruiker
						SET wachtwoord = '{$ww_data['wwnieuw']}'
						WHERE gebruikerid = '{$ww_data['gebruikerid']}'
					");
	
	
	
	}
	
	function checkPassword(){
	
	$q2 = mysql_query("			SELECT * 
								FROM gebruiker 
								WHERE gebruikerid = '55' 
								AND wachtwoord = '1abfb6e1b2eb8ae4560aebe5690e40ff'");
	
	if (mysql_num_rows($q2) == 1)
		{
		return true;
		}
		else
		{
		return false;
		}
	
}
}
?>