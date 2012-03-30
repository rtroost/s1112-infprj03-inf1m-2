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
	
	function updateContact($adres, $postcode, $plaats, $land, $telefoon, $fax, $email, $twitter, $facebook){
		$contact = $this->db->query("
		UPDATE contact
		SET adres = '".$adres."',
		postcode = '".$postcode."',
		plaats = '".$plaats."',
		land = '".$land."',
		telefoon = '".$telefoon."',
		fax = '".$fax."',
		email = '".$email."',
		twitter = '".$twitter."',
		facebook = '".$facebook."' 
		");
	}
}

?>