<?php

//klasse voor de bestelllijst
class Bestellen_cont extends CI_controller {

	function __construct() {
		parent::__construct();
		/** Initialize helpers, libraries, models and the database*/
		$this -> load -> model('bestellen_model');
	}
	
	// haalt alle vaste producten op via de functie getFullProducten in de model bestellen_model en geeft de lijst vervolgens door aan de view bestellen
	function index() {
		
		$data['bestellijst'] = $this -> bestellen_model -> getFullProducten();
		$this -> load -> view('bestellen', $data);
	}

}
?>