<?php

class Bestellen_cont extends CI_controller {

	function __construct() {
		parent::__construct();
		/** Initialize helpers, libraries, models and the database*/
		$this -> load -> model('bestellen_model');
	}

	function index() {
		
		$data['bestellijst'] = $this -> bestellen_model -> getFullProducten();
		$this -> load -> view('bestellen', $data);
	}

}
?>