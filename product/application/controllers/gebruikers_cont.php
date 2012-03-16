<?php 

class Gebruikers_cont extends CI_controller {
	
	function index(){
		$this->load->model('gebruikers_model');
		$data['gebruikers'] = $this->gebruikers_model->getGebruikers();
		$this->load->view('gebruikers', $data);
	}
}

?>