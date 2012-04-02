<?php

//SQL queries voor het ophalen, wijzigen, archiveren en activeren van accounts/gebruikers.
class Beheer_Gebruikers_model extends CI_model{
	
	function getGebruikers(){
		$gebruikers = $this->db->query('
		SELECT gebruikerid, typeid, voornaam, achternaam, email, adresregel_1, adresregel_2, postcode, woonplaats, telefoonnummer, kortingspunten
		FROM gebruiker
		WHERE gearchiveerd = 0');
		
		if ($gebruikers->num_rows() > 0){
			$data = $gebruikers->result();
		}
		else{
			$data = null;
		}
		return $data;
	}
	
	function getGebruikersGearchiveerd($status){
		$gebruikers = $this->db->query("
		SELECT gebruikerid, typeid, voornaam, achternaam, email, adresregel_1, adresregel_2, postcode, woonplaats, telefoonnummer, kortingspunten
		FROM gebruiker
		WHERE gearchiveerd = '".$status."'");
	
		if ($gebruikers->num_rows() > 0){
			$data = $gebruikers->result();
		}
		else{
		$data = null;
		}
		return $data;
	}
	
	function updateGebruiker($gebruikerid, $voornaam, $achternaam, $email, $adres1, $adres2, $postcode, $woonplaats, $telefoon, $korting){
		$gebruikers = $this->db->query("
		UPDATE gebruiker
		SET voornaam = '".$voornaam."',
		achternaam = '".$achternaam."',
		email = '".$email."',
		adresregel_1 = '".$adres1."',
		adresregel_2 = '".$adres2."',
		postcode = '".$postcode."',
		woonplaats = '".$woonplaats."',
		telefoonnummer = '".$telefoon."',
		kortingspunten = '".$korting."' 
		WHERE gebruikerid = '".$gebruikerid."'");
	}
	
	function archiveerGebruiker($gebruikerid){
		$gebruikers = $this->db->query("
		UPDATE gebruiker
		SET gearchiveerd = '1'
		WHERE gebruikerid = '".$gebruikerid."'
		");
	}
	
	function activeerGebruiker($gebruikerid){
		$gebruikers = $this->db->query("
		UPDATE gebruiker
		SET gearchiveerd = '0'
		WHERE gebruikerid = '".$gebruikerid."'
		");
	}
	
	function searchGebruikers($status, $search){
		$gebruikers = $this->db->query("
		SELECT gebruikerid, typeid, voornaam, achternaam, email, adresregel_1, adresregel_2, postcode, woonplaats, telefoonnummer, kortingspunten
		FROM gebruiker
		WHERE voornaam like '%".$search."%' OR achternaam like '%".$search."%' OR email like '%".$search."%' OR woonplaats like '%".$search."%' OR adresregel_1 like '%".$search."%' OR adresregel_2 like '%".$search."%' OR postcode like '%".$search."%' OR telefoonnummer like '%".$search."%' AND gearchiveerd = '".$status."'");
		
		if ($gebruikers->num_rows() > 0)
		{
			$data = $gebruikers->result();
		}
		else
		{
			$data = null;
		}
		
		return $data;
	}
}

?>