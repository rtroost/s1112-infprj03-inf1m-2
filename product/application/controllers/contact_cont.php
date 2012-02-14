<?php 

class Contact_cont extends CI_controller {
	
	function index(){
		$this->load->model('placeholder_model');
		$data['records'] = $this->placeholder_model->getAll();
		$this->load->view('contact', $data);
	}
	
}

?>