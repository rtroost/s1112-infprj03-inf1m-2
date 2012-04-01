<?php 

class Bestellen_selfmade_cont extends CI_controller {
	
	function index(){
		$this->load->model('bestellen_model');
		$data['bestellijst'] = $this->bestellen_model->getFullSelfmade();
		$this->load->view('bestellen', $data);
	}
}

?>