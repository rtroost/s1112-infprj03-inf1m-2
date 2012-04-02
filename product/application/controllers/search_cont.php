<?php
// klasse haalt alle producten op die de search engine oplevert en geeft deze door aan de view search
class Search_cont extends CI_controller {
	
	function index(){
		$this->load->model('search_model');
		$data['search'] = $this->search_model->getSearchProducten();
		$this->load->view('search', $data);	
	}
}

?>