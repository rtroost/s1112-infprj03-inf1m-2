<?php

class Beheer_News_cont extends CI_controller {

	function __construct() {
		parent::__construct();
		/** Initialize helpers, libraries, models and the database*/
		$this -> load -> model('news_model');
		$this -> load -> model('usersystem_model');

		if ($this -> session -> userdata('logged_in') == FALSE || $this -> usersystem_model -> hasAdminRights() == FALSE) {
			redirect(base_url());
		}
	}

	function index() {
		$this -> load -> view('beheer_news');
	}

}
?>