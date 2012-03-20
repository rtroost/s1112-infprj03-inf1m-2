<?php

class Registreer_cont extends CI_controller {

	function __construct() {
		parent::__construct();
		$this -> load -> model('gebruiker_model');
	}

	function index() {
		$this -> load -> library('form_validation');

		$this -> form_validation -> set_rules('voorletters', 'Voorletters', 'required|trim|max_length[20]');
		$this -> form_validation -> set_rules('achternaam', 'Achternaam', 'required|trim|max_length[50]');
		$this -> form_validation -> set_rules('adresregel_1', 'Adresregel 1', 'required|trim|max_length[50]');
		$this -> form_validation -> set_rules('adresregel_2', 'Adresregel 2', 'trim|max_length[50]');
		$this -> form_validation -> set_rules('postcode', 'Postcode', 'required|trim|max_length[6]');
		$this -> form_validation -> set_rules('woonplaats', 'Woonplaats', 'required|trim|max_length[50]');
		$this -> form_validation -> set_rules('telefoonnummer', 'Telefoonnummer', 'required|trim|is_numeric|max_length[10]');
		$this -> form_validation -> set_rules('email', 'Email', 'required|trim|valid_email|max_length[100]');
		$this -> form_validation -> set_rules('wachtwoord', 'wachtwoord', 'required');
		$this -> form_validation -> set_rules('wachtwoord2', 'controle wachtwoord', 'required|matches[wachtwoord]');

		$this -> form_validation -> set_message('alpha_numeric', 'Het veld %s bevat tekens uit een niet toegestane karaktergroep.');
		$this -> form_validation -> set_message('required', 'Het veld %s is niet ingevuld.');
		$this -> form_validation -> set_message('matches', 'De wachtwoord velden kwamen niet overeen.');
		$this -> form_validation -> set_message('email', 'Gelieve een geldig e-mailadres in te vullen.');
		$this -> form_validation -> set_message('max_length', 'Gelieve een geldige postcode invullen');

		if ($this -> form_validation -> run() == FALSE) {
			$this -> load -> view('registreer.php');

		} else {
			$form_data = array('voornaam' => set_value('voorletters'), 'achternaam' => set_value('achternaam'), 'adresregel_1' => set_value('adresregel_1'), 'adresregel_2' => set_value('adresregel_2'), 'postcode' => set_value('postcode'), 'woonplaats' => set_value('woonplaats'), 'telefoonnummer' => set_value('telefoonnummer'), 'email' => set_value('email'), 'wachtwoord' => md5(set_value('wachtwoord')));
			$this -> gebruiker_model -> registreer_gebruiker($form_data);
		}
	}

}
?>