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

}
?>