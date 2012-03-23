<?php 

class Beheer_Gebruikers_cont extends CI_controller {
	
	function index(){
		$this->load->model('beheer_gebruikers_model');
		
		if(isset ($_GET['update']) && $_GET['update'] != '')
		{
			$this->beheer_gebruikers_model->updateGebruiker($_GET['id'], $_GET['voornaam'], $_GET['achternaam'], $_GET['email'], $_GET['adres1'], $_GET['adres2'], $_GET['postcode'], $_GET['woonplaats'], $_GET['telefoon'], $_GET['korting']);	
		}
		
		if(isset ($_GET['archiveer']))
		{
			$this->beheer_gebruikers_model->archiveerGebruiker($_GET['id']);
		}
		
		if(isset ($_GET['archief']))
		{
			$data['gebruikers'] = $this->beheer_gebruikers_model->getGebruikersGearchiveerd();
			print_r ($data);
		}
		
		else
		{
			$data['gebruikers'] = $this->beheer_gebruikers_model->getGebruikers();
			$this->load->view('beheer_gebruikers', $data);
		}
	}
}		
?>