<?php

class Home_cont extends CI_controller {

	function index() {

		// LAAT STAAN AUB ================
		//var_dump($this->session->all_userdata());
		// ===============================
		
		$this->load->model('news_model');
		$this->load->model('product_model');
		$data['topProducten'] = $this->product_model->get_top_producten();
		$data['news'] = $this->news_model->getNews();
		$data['aanbiedingen'] = $this->product_model->get_set_aanbiedingen();
		$this->load->view('index', $data);
	
		if ($this -> session -> userdata('logged_in'))
		{
			$data['logged_in'] = $this -> session -> userdata('logged_in');
			$data['naam'] = $this -> session -> userdata('voornaam');
		} 

	}
}
?>