<?php 

class Bestellen_cont extends CI_controller {
	
	function index(){
		$this->load->model('bestellen_model');
		$data['bestellijst'] = $this->bestellen_model->getFullProducten();
		$this->load->view('bestellen', $data);
		
	}
	
}

?>