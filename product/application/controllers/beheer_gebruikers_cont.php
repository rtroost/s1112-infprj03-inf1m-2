<?php 

class Beheer_Gebruikers_cont extends CI_controller {
	
	function index()
	{
		$this->load->model('beheer_gebruikers_model');		
		$data['gebruikers'] = $this->beheer_gebruikers_model->getGebruikers();
		$this->load->view('beheer_gebruikers', $data);	
	}
}		

?>