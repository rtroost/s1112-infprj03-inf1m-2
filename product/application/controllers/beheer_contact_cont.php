<?php 

class Beheer_Contact_cont extends CI_controller
{	
	function index()
	{
		$this->load->model('contact_model');
		$data['contact'] = $this->contact_model->getContact();
		$this->load->view('beheer_contact', $data);
	}
	
}

?>