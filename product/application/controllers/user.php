<?php

class User extends CI_controller {

	function __construct() {
		parent::__construct();

		$this -> load -> library('form_validation');
		$this -> load -> database();
		$this -> load -> helper('form');
		$this -> load -> helper('url');
		$this -> load -> model('usersystem_model');

		$this -> form_validation -> set_message('alpha_numeric', 'Het veld %s bevat tekens uit een niet toegestane karaktergroep.');
		$this -> form_validation -> set_message('required', 'Het veld %s is niet ingevuld.');
		$this -> form_validation -> set_message('matches', 'De wachtwoord velden kwamen niet overeen.');
		$this -> form_validation -> set_message('email', 'Gelieve een geldig e-mailadres in te vullen.');
		$this -> form_validation -> set_message('max_length', 'Het veld %s bevatte te veel of te weinig tekens.');
	}

	function index() {
		if ($this -> session -> userdata('logged_in') == FALSE) {
			redirect(base_url() . "index.php/user/login?redirect=user");
		} else {
			$this -> load -> view('mijnprofiel');
		}
	}

	function login() {
		if ($this -> session -> userdata('logged_in') == TRUE) {
			redirect('user');
		}

		$this -> form_validation -> set_rules('email', 'E-mail Adres', 'required|trim|valid_email');
		$this -> form_validation -> set_rules('password', 'Wachtwoord', 'required');

		$this -> form_validation -> set_error_delimiters('<br /><span class="error">', '</span>');

		if ($this -> form_validation -> run() == FALSE) {
			if ($this -> input -> is_ajax_request()) {
				return "false";
			} else {
				$this -> load -> view('login');
			}
		} else {
			$form_data = array('email' => set_value('email'), 'wachtwoord' => md5(set_value('password')));
			$result = $this -> usersystem_model -> validate($form_data);

			if ($result == NULL) {
				if ($this -> input -> is_ajax_request()) {
					return "false";
				} else {
					$data['error'] = '<p>Naam en wachtwoord combinatie komt niet voor in de database. Probeer het opnieuw.</p><br />';
					$this -> load -> view('login', $data);
				}
			} else {
				$this -> session -> set_userdata($result);
				$this -> session -> set_userdata(array('logged_in' => TRUE));
				if ($this -> input -> is_ajax_request()) {
					echo json_encode($result);
					return;
				} else {
					if ($this -> input -> post('redirect')) {
						redirect($this -> input -> post('redirect'));
					} else {
						redirect(base_url());
					}
				}
			}
		}
	}

	function register() {
		if ($this -> session -> userdata('logged_in') == TRUE) {
			redirect('user');
		}

		$this -> form_validation -> set_rules('voornaam', 'Voornaam', 'required|trim|max_length[20]');
		$this -> form_validation -> set_rules('achternaam', 'Achternaam', 'required|trim|max_length[50]');
		$this -> form_validation -> set_rules('adresregel_1', 'Adresregel 1', 'required|trim|max_length[50]');
		$this -> form_validation -> set_rules('adresregel_2', 'Adresregel 2', 'trim|max_length[50]');
		$this -> form_validation -> set_rules('postcode', 'Postcode', 'required|trim|max_length[6]');
		$this -> form_validation -> set_rules('woonplaats', 'Woonplaats', 'required|trim|max_length[50]');
		$this -> form_validation -> set_rules('telefoonnummer', 'Telefoonnummer', 'required|trim|is_numeric|max_length[10]');
		$this -> form_validation -> set_rules('email', 'Email', 'required|trim|valid_email|max_length[100]');
		$this -> form_validation -> set_rules('password', 'wachtwoord', 'required|md5');
		$this -> form_validation -> set_rules('password_check', 'controle wachtwoord', 'required|matches[password]');

		$this -> form_validation -> set_error_delimiters('<li">', '</li>');

		if ($this -> form_validation -> run() == FALSE) {
			$this -> load -> view('registreer');
		} else {
			$form_data = array('voornaam' => set_value('voornaam'), 'achternaam' => set_value('achternaam'), 'adresregel_1' => set_value('adresregel_1'), 'adresregel_2' => set_value('adresregel_2'), 'postcode' => set_value('postcode'), 'woonplaats' => set_value('woonplaats'), 'telefoonnummer' => set_value('telefoonnummer'), 'email' => set_value('email'), 'wachtwoord' => set_value('password'));

			if ($this -> usersystem_model -> emailInUse($form_data)) {
				$this -> form_validation -> set_message('email_is_uniek', 'Het opgegeven email adres bestaat al.');
				$this -> load -> view('registreer');
			} else {
				$this -> usersystem_model -> register($form_data);

				$data['result'] = '<h1>Succes!</h1><p>Gefeliciteerd. U bent geregistreerd en kunt nu inloggen.</p>';
				$this -> load -> view('message', $data);
			}
		}
	}

	function logout() {
		$data = array('gebruikerid' => '', 'email' => '', 'voornaam' => '', 'achternaam' => '', 'logged_in' => FALSE);
		$this -> session -> unset_userdata($data);
		redirect(base_url());
	}

	function product() {
		if ($this -> session -> userdata('logged_in') != 1) {
			redirect(base_url() . "index.php/user?redirect=user");
		}
		$this -> load -> model('gebruiker_product_model');

		if ($this -> input -> is_ajax_request()) {
			if ($this -> input -> post('new') == '1') {
				if ($this -> gebruiker_product_model -> get_publiekelijk_count($this -> input -> post('userid')) >= 5) {
					echo "publiekelijk";
					return;
				}
			}
			if (!$this -> gebruiker_product_model -> set_publiekelijk($this -> input -> post('productid'), $this -> input -> post('new'))) {
				echo "failed";
			}
			return;
		}

		$this -> load -> model('product_model');
		$this -> load -> model('categorie_model');

		if ($this -> input -> post('productid')) {
			if ($this -> product_model -> verwijder_product($this -> input -> post('productid'))) {
				redirect(base_url() . 'index.php/user/product');
			} else {
				//error
			}
		}

		$data['rows'] = $this -> gebruiker_product_model -> get_all_products_from_user($this -> session -> userdata('gebruikerid'), 1);
		if ($data['rows'] != null) {
			foreach ($data['rows'] as $row) {
				$result = $this -> product_model -> get_products_by_id($row -> productid);
				$row -> product = $result;
				$categorienaam = $this -> categorie_model -> get_name($row -> product[0] -> categorieid);
				$row -> categorienaam = $categorienaam[0] -> naam;
				$names = $this -> product_model -> get_name_of_ingredients($row -> productid);
				$row -> names = $names;
				$prijs = $this -> product_model -> getTotalCost($row -> productid);
				$row -> prijs = $prijs;
			}
		} else {
			//error
		}

		$data['publiekelijkcount'] = $this -> gebruiker_product_model -> get_publiekelijk_count($this -> session -> userdata('gebruikerid'));
		//var_dump( $data['rows'][0]);
		$this -> load -> view('mijnproducten', $data);
	}

	function favoriet() {
		if ($this -> session -> userdata('logged_in') != 1) {
			redirect(base_url() . "index.php/user?redirect=user");
		}
		$this -> load -> model('gebruiker_product_model');

		if ($this -> input -> is_ajax_request()) {
			if ($this -> input -> post('new') == 1) {
				$data['gebruikerid'] = $this -> session -> userdata('gebruikerid');
				$data['productid'] = $this -> input -> post('id');
				$data['publiekelijk'] = 0;
				$data['aanmaak_datetime'] = date("Y-m-d H:i:s");
				$data['eigenaar'] = 0;
				$this -> gebruiker_product_model -> create_gebruiker_product($data);
			} else {
				$this -> gebruiker_product_model -> remove_favoriet($this -> input -> post('id'), $this -> session -> userdata('gebruikerid'));
			}

			return;
		}

		$this -> load -> model('product_model');
		$this -> load -> model('categorie_model');

		if ($this -> input -> post('productid')) {
			if ($this -> gebruiker_product_model -> remove_favoriet($this -> input -> post('productid'), $this -> session -> userdata('gebruikerid'))) {
				redirect(base_url() . 'index.php/user/favoriet');
			} else {
				//error
			}
		}

		$data['rows'] = $this -> gebruiker_product_model -> get_all_products_from_user($this -> session -> userdata('gebruikerid'), 0);
		if ($data['rows'] != null) {
			foreach ($data['rows'] as $row) {
				$result = $this -> product_model -> get_products_by_id($row -> productid);
				$row -> product = $result;
				$categorienaam = $this -> categorie_model -> get_name($row -> product[0] -> categorieid);
				$row -> categorienaam = $categorienaam[0] -> naam;
				$names = $this -> product_model -> get_name_of_ingredients($row -> productid);
				$row -> names = $names;
				$prijs = $this -> product_model -> getTotalCost($row -> productid);
				$row -> prijs = $prijs;
				$eigenaar = $this -> gebruiker_product_model -> get_eigenaar($row -> productid);
				$row -> eigenaar_naam = $eigenaar[0] -> email;
			}
		} else {
			//error
		}
		//var_dump( $data['rows'][0]);
		$this -> load -> view('mijnfavorieten', $data);
	}

	function edit() {

		if ($this -> session -> userdata('logged_in') == FALSE) {
			/** If the user is not logged in, redirect to the login page */
			redirect('user/login?redirect=user/edit');
		}

		$this -> form_validation -> set_rules('voornaam', 'Voornaam', 'required|trim|max_length[20]');
		$this -> form_validation -> set_rules('achternaam', 'Achternaam', 'required|trim|max_length[50]');
		$this -> form_validation -> set_rules('adresregel_1', 'Adresregel 1', 'required|trim|max_length[50]');
		$this -> form_validation -> set_rules('adresregel_2', 'Adresregel 2', 'trim|max_length[50]');
		$this -> form_validation -> set_rules('postcode', 'Postcode', 'required|trim|max_length[6]');
		$this -> form_validation -> set_rules('woonplaats', 'Woonplaats', 'required|trim|max_length[50]');
		$this -> form_validation -> set_rules('telefoonnummer', 'Telefoonnummer', 'required|trim|is_numeric|max_length[10]');
		$this -> form_validation -> set_rules('email', 'Email', 'required|trim|valid_email|max_length[100]');

		if ($this -> form_validation -> run() == FALSE) {
			/** Form validation didn't pass or nothing has been posted yet */

			/*Load the users data */
			$data = $this -> usersystem_model -> getUserData();

			/** Load the view and fill in the received userdata */
			$data -> change_password = TRUE;
			$this -> load -> view('edit_userdata', $data);
		} else {
			$form_data = array('voornaam' => set_value('voornaam'), 'achternaam' => set_value('achternaam'), 'adresregel_1' => set_value('adresregel_1'), 'adresregel_2' => set_value('adresregel_2'), 'email' => set_value('email'), 'postcode' => set_value('postcode'), 'telefoonnummer' => set_value('telefoonnummer'));
			$this -> usersystem_model -> setUserData($form_data);

			redirect('user');
		}
	}

	function edit_password() {

		if ($this -> session -> userdata('logged_in') == FALSE) {
			/** If the user is not logged in, redirect to the login page */
			redirect('user/login?redirect=user/edit_password');
		}

		$this -> form_validation -> set_rules('wwoud', 'huidig wachtwoord', 'required|md5|callback_password_check');
		$this -> form_validation -> set_rules('wwnieuw', 'nieuw wachtwoord', 'required|md5');
		$this -> form_validation -> set_rules('wwnieuw2', 'herhaling van nieuw wachtwoord', 'required|md5|matches[wwnieuw]');

		$this -> form_validation -> set_message('password_check', 'Uw huidige wachtwoord is niet correct.');

		if ($this -> form_validation -> run() == FALSE) {
			redirect('user/edit');
		} else {
			$data = array('wachtwoord' => set_value('wwnieuw'));
			$this -> usersystem_model -> setUserData($data);
		}
	}

	public function password_check($str) {
		return $this -> usersystem_model -> checkPassword($str);
	}

}
?>