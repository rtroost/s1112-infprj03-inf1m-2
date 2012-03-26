<?php 

class Test_cont extends CI_controller {
	
	function index()
	{
		$this->load->model('test_model');
		$data['news'] = $this->test_model->getNews();
		$this->load->view('test', $data);
	}
}

?>