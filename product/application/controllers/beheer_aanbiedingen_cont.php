<?php

class Beheer_Aanbiedingen_cont extends CI_controller {

	// constructor
	function __construct() {
		parent::__construct();
		/** Initialize helpers, libraries, models and the database*/
		$this -> load -> model('product_model');
		$this -> load -> model('gebruiker_product_model');
		$this -> load -> model('categorie_model');
		$this -> load -> model('usersystem_model');
		
		if ($this -> session -> userdata('logged_in') == FALSE || $this -> usersystem_model -> hasAdminRights() == FALSE) {
			redirect(base_url());
		}
	}

	// deze functie maakt data klaar en geeft dat aan de aanbiedingen beheer view
	function index() {
		if ($this -> input -> is_ajax_request()) {
			if ($this -> input -> post('new') == '1') {
				if ($this -> product_model -> get_aanbieding_count() >= 5) {
					echo "publiekelijk";
					return;
				}
			}
			if (!$this -> product_model -> set_aanbieding($this -> input -> post('productid'), $this -> input -> post('new'))) {
				echo "failed";
			}
			return;
		}

		$data['rows'] = $this -> product_model -> get_all_aanbiedingen();
		$data['aanbiedingcountcount'] = 0;
		if ($data['rows'] != null) {
			foreach ($data['rows'] as $row) {
				if ($row -> aanbieding == 1) {
					$data['aanbiedingcountcount']++;
				}
				$categorienaam = $this -> categorie_model -> get_name($row -> categorieid);
				$row -> categorienaam = $categorienaam[0] -> naam;
				$prijs = $this -> product_model -> getTotalCost($row -> productid);
				$row -> prijs = $prijs;
				$names = $this -> product_model -> get_name_of_ingredients($row -> productid);
				$row -> names = $names;
			}
		} else {
			//error
		}

		//$data['publiekelijkcount'] = $this->gebruiker_product_model->get_publiekelijk_count($this->session->userdata('gebruikerid'));
		//var_dump( $data['rows'][0]);
		$this -> load -> view('beheer_aanbiedingen', $data);
	}

}
?>