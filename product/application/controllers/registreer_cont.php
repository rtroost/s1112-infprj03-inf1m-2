<?php

class registreer_cont extends CI_controller{
	
	function index(){
	
		$this->view_data['base_url'] = base_url();
		$this->load->model('gebruiker_model');
		$this->load->view('registreer.php' , $this->view_data);	
		
	}	
	function opslaan(){
	
	$this->load->library('form_validation');
	
	$this->form_validation->set_rules('reg_voornaam','voornaam','alpha_numeric|required');
	$this->form_validation->set_rules('reg_achternaam','achternaam','required');
	$this->form_validation->set_rules('reg_email','email','valid_email');
	$this->form_validation->set_rules('reg_wachtwoord1','wachtwoord','required');
	$this->form_validation->set_rules('reg_wachtwoord2','controle wachtwoord','matches[reg_wachtwoord1]');
	$this->form_validation->set_rules('reg_adres','adres','required');
	$this->form_validation->set_rules('reg_woonplaats','woonplaats','required');
	$this->form_validation->set_rules('reg_postcode','postcode','required|max_length[6]');
	$this->form_validation->set_rules('reg_telefoonnummer','telefoonnummer','required');
	
	$this->form_validation->set_message('alpha_numeric', 'Het veld %s bevat tekens uit een niet toegestane karaktergroep.');
	$this->form_validation->set_message('required', 'Het veld %s is niet ingevuld.');
	$this->form_validation->set_message('matches', 'De wachtwoord velden kwamen niet overeen.');
	$this->form_validation->set_message('email', 'Gelieve een geldig e-mailadres in te vullen.');
	$this->form_validation->set_message('max_length', 'Gelieve een geldige postcode invullen');
	
	if ($this->form_validation->run() == FALSE) 
	{
	//echo 'errors';
	
	$this->view_data['base_url'] = base_url();
	$this->load->view('registreer.php' , $this->view_data);
	
	}
	else
	{
	
	echo "Uw aanvraag is met succes naar de database verzonden!";
	
	
	$voornaam = $this->input->post('reg_voornaam');
	$achternaam = $this->input->post('reg_achternaam');
	$email = $this->input->post('reg_email');
	$wachtwoord = $this->input->post('reg_wachtwoord1');
	$adres = $this->input->post('reg_adres');
	$postcode = $this->input->post('reg_postcode');
	$woonplaats = $this->input->post('reg_woonplaats');
	$telefoonnummer = $this->input->post('reg_telefoonnummer');
	
	$this->load->model('gebruiker_model');
	$this->gebruiker_model->registreer_gebruiker(
	
		$voornaam,
		$achternaam,
		$email,
		$wachtwoord,
		$adres,
		$postcode,
		$woonplaats,
		$telefoonnummer
	
		);
	
	
	}

	}
	
}




?>