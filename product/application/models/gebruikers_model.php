<?php

class Gebruikers_model extends CI_model
{
	function getGebruikers()
	{
		$gebruikers = $this->db->query('
		SELECT gebruikerid, typeid, voornaam, achternaam, email, adres, huisnummer, postcode, woonplaats, kortingspunten 
		FROM gebruiker
		WHERE gearchiveerd = 0');
		
				if ($gebruikers->num_rows() > 0)
				{
					foreach($gebruikers->result() as $gebruiker)
					{
						$data[] = $gebruiker;
					}
				}
		return $data;
	}			
}

?>