<?php

class Contact_model extends CI_model
{
	function getContact()
	{
		$contact = $this->db->query('
		SELECT adres, postcode, plaats, land, telefoon, fax, email, twitter, facebook
		FROM contact');
		
		if ($contact->num_rows() > 0){
			$data = $contact->result();
		}
		
		else{
			$data = null;
		}
		return $data;
	}
}

?>