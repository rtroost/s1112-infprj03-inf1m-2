<?php

class Gebruiker_model extends CI_model {

	function registreer_gebruiker(
	
		$voornaam,
		$achternaam,
		$email,
		$wachtwoord,
		$adres,
		$postcode,
		$woonplaats,
		$telefoonnummer
	
	) {
	
	$wachtwoord = md5($wachtwoord);
	$typeid = 1;
	
	$query = 'INSERT INTO gebruiker (typeid,voornaam,achternaam,email,wachtwoord,adresregel_1,postcode,woonplaats,telefoonnummer)
	
	VALUES ("'.$typeid.'","'.$voornaam.'","'.$achternaam.'","'.$email.'","'.$wachtwoord.'","'.$adres.'","'.$postcode.'","'.$woonplaats.'",
	"'.$telefoonnummer.'")'; 
	
	$this->db->query($query);
	
	}

}
