<?php

class User extends CI_controller {

	function __construct() {
		parent::__construct();

		$this -> load -> library('form_validation');
		$this -> load -> database();
		$this -> load -> helper('form');
		$this -> load -> helper('url');
		$this -> load -> model('usersystem_model');
	}
	function index() {
		if($this->session->userdata('logged_in') == TRUE) {
			$this->load->view('mijnprofiel');
		} else {
			redirect('user/login');
		}
	}

	function login() {
		if($this->session->userdata('logged_in') == TRUE) {
			redirect('user');
		} 

		$this -> form_validation -> set_rules('email', 'E-mail Adres', 'required|trim|valid_email');
		$this -> form_validation -> set_rules('password', 'Wachtwoord', 'required');

		$this -> form_validation -> set_error_delimiters('<br /><span class="error">', '</span>');

		if ($this -> form_validation -> run() == FALSE)// validation hasn't been passed and/or no post has happend
		{
			if($this->input->is_ajax_request()){
				return FALSE;				
			} else {
				$this -> load -> view('login');
			}
		} else // passed validation proceed to post success logic
		{
			$form_data = array('email' => set_value('email'), 'wachtwoord' => md5(set_value('password')));
			$result = $this -> usersystem_model -> validate($form_data);

			if($result == FALSE) {
				// ERROR VERKEERDE COMBINATIE
				if($this->input->is_ajax_request()){
					return FALSE;					
				} else {
					//Foutieve ingave
					$this->load->view('login');
				}							
			} else {				
				if($this->input->is_ajax_request()){
					echo json_encode($result);
					return;					
				} else {
					$this -> session -> set_userdata($result);
					$this -> session -> set_userdata(array('logged_in' => TRUE));

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
		if($this->session->userdata('logged_in') == TRUE) {
			redirect('user');
		} 

		$this -> form_validation -> set_rules('voorletters', 'Voorletters', 'required|trim|max_length[20]');
		$this -> form_validation -> set_rules('achternaam', 'Achternaam', 'required|trim|max_length[50]');
		$this -> form_validation -> set_rules('adresregel_1', 'Adresregel 1', 'required|trim|max_length[50]');
		$this -> form_validation -> set_rules('adresregel_2', 'Adresregel 2', 'trim|max_length[50]');
		$this -> form_validation -> set_rules('postcode', 'Postcode', 'required|trim|max_length[6]');
		$this -> form_validation -> set_rules('woonplaats', 'Woonplaats', 'required|trim|max_length[50]');
		$this -> form_validation -> set_rules('telefoonnummer', 'Telefoonnummer', 'required|trim|is_numeric|max_length[10]');
		$this -> form_validation -> set_rules('email', 'Email', 'required|trim|valid_email|max_length[100]');
		$this -> form_validation -> set_rules('password', 'wachtwoord', 'required');
		$this -> form_validation -> set_rules('password_check', 'controle wachtwoord', 'required|matches[password]');

		$this -> form_validation -> set_message('alpha_numeric', 'Het veld %s bevat tekens uit een niet toegestane karaktergroep.');
		$this -> form_validation -> set_message('required', 'Het veld %s is niet ingevuld.');
		$this -> form_validation -> set_message('matches', 'De wachtwoord velden kwamen niet overeen.');
		$this -> form_validation -> set_message('email', 'Gelieve een geldig e-mailadres in te vullen.');
		$this -> form_validation -> set_message('max_length', 'Het veld %s bevatte te veel of te weinig tekens.');

		$this -> form_validation -> set_error_delimiters('<li">', '</li>');

		if ($this -> form_validation -> run() == FALSE) {
			$this -> load -> view('registreer');
		} else {
			$form_data = array('voornaam' => set_value('voorletters'), 'achternaam' => set_value('achternaam'), 'adresregel_1' => set_value('adresregel_1'), 'adresregel_2' => set_value('adresregel_2'), 'postcode' => set_value('postcode'), 'woonplaats' => set_value('woonplaats'), 'telefoonnummer' => set_value('telefoonnummer'), 'email' => set_value('email'), 'wachtwoord' => md5(set_value('wachtwoord')));
			
			if($this->usersystem_model->emailInUse($form_data)) {
				$this->form_validation->set_message('email_is_uniek','Het opgegeven email adres bestaat al.');
				$this->load->view('registreer');
			} else {
				$this -> usersystem_model -> register($form_data);

				$data['result'] = '<h1>Succes!</h1><p>Gefeliciteerd. U bent geregistreerd en kunt nu inloggen.</p>';
				$this->load->view('message', $data);
			}			
		}
	}

	function logout() {
		$data = array('gebruikerid' => '', 'email' => '', 'voornaam' => '', 'achternaam' => '', 'logged_in' => FALSE);
		$this -> session -> unset_userdata($data);
		redirect(base_url());
	}

	function product(){

		$this->load->model('gebruiker_product_model');
		
		if($this->input->is_ajax_request()){
			if($this->input->post('check') == 'true'){
				if($this->gebruiker_product_model->get_publiekelijk_count($this->input->post('userid')) >= 5){
					echo "publiekelijk";
					return;
				}
			}
			if(!$this->gebruiker_product_model->set_publiekelijk($this->input->post('productid'), $this->input->post('new'))){
				echo "failed";
			}
			return;
		}
		
		$this->load->model('product_model');
		$this->load->model('categorie_model');
		
		if($this->input->post('productid')){
			if($this->product_model->verwijder_product($this->input->post('productid'))){
				redirect('user/product');
			} else {
				//error
			}
		}
		
		$data['rows'] = $this->gebruiker_product_model->get_all_products_from_user($this->session->userdata('gebruikerid'), 1);
		if($data['rows'] != null){
			foreach ($data['rows'] as $row) {
				$result = $this->product_model->get_products_by_id($row->productid);
				$row->product = $result;
				$categorienaam = $this->categorie_model->get_name($row->product[0]->categorieid);
				$row->categorienaam = $categorienaam[0]->naam;
				$names = $this->product_model->get_name_of_ingredients($row->productid);
				$row->names = $names;
				$prijs = $this->product_model->getTotalCost($row->productid);
				$row->prijs = $prijs;
			}
		} else {
			//error
		}
		//var_dump( $data['rows'][0]);
		$this->load->view('mijnproducten', $data);
	}

	function favoriet(){

		$this->load->model('gebruiker_product_model');		
		$this->load->model('product_model');
		$this->load->model('categorie_model');
		
		if($this->input->post('productid')){
			if($this->gebruiker_product_model->remove_favoriet($this->input->post('productid'), $this->session->userdata('gebruikerid'))){
				redirect('user/favoriet');
			} else {
				//error
			}
		}
		
		$data['rows'] = $this->gebruiker_product_model->get_all_products_from_user($this->session->userdata('gebruikerid'), 0);
		if($data['rows'] != null){
			foreach ($data['rows'] as $row) {
				$result = $this->product_model->get_products_by_id($row->productid);
				$row->product = $result;
				$categorienaam = $this->categorie_model->get_name($row->product[0]->categorieid);
				$row->categorienaam = $categorienaam[0]->naam;
				$names = $this->product_model->get_name_of_ingredients($row->productid);
				$row->names = $names;
				$prijs = $this->product_model->getTotalCost($row->productid);
				$row->prijs = $prijs;
				$eigenaar = $this->gebruiker_product_model->get_eigenaar($row->productid);
				$row->eigenaar_naam = $eigenaar[0]->email;
			}
		} else {
			//error
		}
		//var_dump( $data['rows'][0]);
		$this->load->view('mijnfavorieten', $data);
	}

}
?>