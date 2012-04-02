<?php 

class Contact_cont extends CI_controller
{
	/** Initialize helpers, libraries, models and the database*/	
	function index()
	{
		$this->load->model('contact_model');
		$data['contact'] = $this->contact_model->getContact();
		$this->load->view('contact', $data);
	}
	
}

?>