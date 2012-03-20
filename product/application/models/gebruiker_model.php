<?php

class Gebruiker_model extends CI_model {

	function registreer_gebruiker($form_data) {
		$this -> db -> insert('gebruiker', $form_data);
	}

}
