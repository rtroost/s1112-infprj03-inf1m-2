<?php 

class Home_cont extends CI_controller {
	
	function index(){
		
		if($this->session->userdata('logged_in')){
			$data['logged_in'] = $this->session->userdata('logged_in');
	
			$data['naam'] = $this->session->userdata('voornaam');
			
			$this->load->view('index', $data);
		} else {
			$this->load->view('index');
		}
	}
	
}

?>