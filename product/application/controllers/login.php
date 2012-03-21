<?php

class Login extends CI_controller {

	function __construct() {
		parent::__construct();
		
		if($this->session->userdata('logged_in') == 1) {
			redirect(base_url());
		} 
		
		$this -> load -> library('form_validation');
		$this -> load -> database();
		$this -> load -> helper('form');
		$this -> load -> helper('url');
		$this -> load -> model('usersystem_model');
	}

	function index() {
		$this -> form_validation -> set_rules('username', 'E-mail Adres', 'required|trim|valid_email');
		$this -> form_validation -> set_rules('password', 'Wachtwoord', 'required');

		$this -> form_validation -> set_error_delimiters('<br /><span class="error">', '</span>');

		if ($this -> form_validation -> run() == FALSE)// validation hasn't been passed and/or no post has happend
		{
			if(!$this->input->is_ajax_request()){
				$this -> load -> view('login');
			} else {
				echo json_encode("failed");
				return;
			}
		} else // passed validation proceed to post success logic
		{
			$data = $this -> usersystem_model -> validate();
			if($data != null) {
				// $data = array('gebruikerid' => $query[0] -> gebruikerid, 'email' => $query[0] -> email, 'voornaam' => $query[0] -> voornaam, 'achternaam' => $query[0] -> achternaam, 'type' => $query[0] -> typeid, 'logged_in' => TRUE);
				// $this -> session -> set_userdata($data);

				if(!$this->input->is_ajax_request()){
					if ($this -> input -> post('redirect')) {
						redirect(base_url() . 'index.php/'. $this -> input -> post('redirect'));
					} else {
						redirect(base_url());
					}
				} else {
					//echo "lol";
					echo json_encode($data);
					return;
				}

				
			} else {
				
				// ERROR VERKEERDE COMBINATIE
				if(!$this->input->is_ajax_request()){
					//redirect(base_url() . 'index.php');
				} else {
					echo json_encode("failed");
					return;
				}

			}
		}
	}

	function create_member() {
		$this -> load -> library('form_validation');

		$this -> form_validation -> set_rules('first_name', 'Name', 'trim|required');
		$this -> form_validation -> set_rules('last_name', 'Last Name', 'trim|required');
		$this -> form_validation -> set_rules('email', 'Email Address', 'trim|required|valid_email');

		$this -> form_validation -> set_rules('username', 'Username', 'trim|required|min_length[4]');
		$this -> form_validation -> set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this -> form_validation -> set_rules('password_conf', 'Password Confirm', 'trim|required|matches[password]');
		
		$this -> form_validation -> set_error_delimiters('<br /><span class="error">', '</span>');

		if ($this -> form_validation -> run() == TRUE) {
			$this -> load -> model('membership_model');
			if ($query = $this -> membership_model -> create_member()) {
				$data['main_content'] = 'signup_successful';
				$this -> load -> view('includes/template', $data);
			} else {
				$this -> signup();
			}
		} else {
			$this -> signup();
		}
	}

	function logout() {
		$data = array('gebruikerid' => '', 'email' => '', 'voornaam' => '', 'achternaam' => '', 'logged_in' => '');
		$this -> session -> unset_userdata($data);
		redirect(base_url() . 'index.php');
	}

}
?>