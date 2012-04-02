<?php

class Beheer_Contact_cont extends CI_controller {
	function __construct() {
		parent::__construct();
		/** Initialize helpers, libraries, models and the database*/
		$this -> load -> model('contact_model');
		$this -> load -> model('usersystem_model');

		if ($this -> session -> userdata('logged_in') == FALSE || $this -> usersystem_model -> hasAdminRights() == FALSE) {
			redirect(base_url());
		}
	}

	function index() {

		$data['contact'] = $this -> contact_model -> getContact();
		$this -> load -> view('beheer_contact', $data);
	}

}
?>