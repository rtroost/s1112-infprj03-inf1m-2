<?php

class Bestellen_selfmade_cont extends CI_controller {

	function __construct() {
		parent::__construct();
		/** Initialize helpers, libraries, models and the database*/
		$this -> load -> model('bestellen_model');
	}
	
	//haalt allec zelfgemaakte producten op via de functie getFullSelfmade in de model bestellen_model en geeft de lijst vervolgens door aan de view bestellen
	function index() {

		$data['bestellijst'] = $this -> bestellen_model -> getFullSelfmade();
		$this -> load -> view('bestellen', $data);
	}

}
?>