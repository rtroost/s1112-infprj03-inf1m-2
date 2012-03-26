<?php

class Beheer_News_model extends CI_model
{
	
	function updateNews($titel, $inhoud)
	{
		$news = $this->db->query("
		INSERT INTO news (titel, inhoud)
		VALUES ('".$titel."', '".$inhoud."')
		");
	}
}

?>