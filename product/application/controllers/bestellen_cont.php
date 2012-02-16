<?php 

class Bestellen_cont extends CI_controller {
	
	function index(){
		$this->load->model('bestellen_model');
		$data['categorien'] = $this->bestellen_model->getProducten();
		$this->load->view('bestellen', $data);
		
	}
	
}

?>