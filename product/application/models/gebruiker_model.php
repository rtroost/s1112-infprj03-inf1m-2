<?php

class Gebruiker_model extends CI_model {

	function registreer_gebruiker($form_data) {
		$this -> db -> insert('gebruiker', $form_data);
	}
	
	function check_bestaat_email($email)
	{
	
		$query_str 	= "SELECT email FROM gebruiker WHERE email = ?"; 
	
		$result 	=	$this -> db -> query($query_str, $email);
		
		if ($result->num_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	}