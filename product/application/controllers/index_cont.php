<?php 

class Index_cont extends CI_controller {
	
	function index(){
		$this->load->model('index_model');
		$data['news'] = $this->index_model->getNews();
		$this->load->view('index', $data);
	}
}

?>