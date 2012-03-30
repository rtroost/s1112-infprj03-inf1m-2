<?php 

class Bestellen_cont extends CI_controller {
	
	function index(){
		$this->load->model('bestellen_model');
		$data['bestellijst'] = $this->bestellen_model->getFullProducten();
		$this->load->view('bestellen', $data);
	}
	
	function standaard(){
		$this->load->model('bestellen_model');
		$data['bestellijst'] = $this->bestellen_model->getFullProducten();
		$this->load->view('bestellen', $data);
	}
	
	function selfmade(){
		$this->load->model('bestellen_model');
		$data['bestellijst'] = $this->bestellen_model->getFullSelfmade();
		$this->load->view('bestellen', $data);
	}
}

?>