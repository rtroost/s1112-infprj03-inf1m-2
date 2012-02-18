<?php 
class Winkelwagen extends CI_controller {
	
	function index(){
		$this->load->view('includes/header');
		$this->load->view('winkelwagen');
		$this->load->view('includes/footer');
	}	
}
?>