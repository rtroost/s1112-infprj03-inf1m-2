<?php

class Beheer_Gebruikers_cont extends CI_controller {

	function __construct() {
		parent::__construct();
		/** Initialize helpers, libraries, models and the database*/
		$this -> load -> model('beheer_gebruikers_model');
		$this -> load -> model('usersystem_model');

		if ($this -> session -> userdata('logged_in') == FALSE || $this -> usersystem_model -> hasAdminRights() == FALSE) {
			redirect(base_url());
		}
	}

	function index() {
		$data['gebruikers'] = $this -> beheer_gebruikers_model -> getGebruikers();
		$this -> load -> view('beheer_gebruikers', $data);
	}

}
?>