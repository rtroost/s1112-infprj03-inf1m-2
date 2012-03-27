<?php

class Home_cont extends CI_controller {

	function index() {

		// LAAT STAAN AUB ================
		//var_dump($this->session->all_userdata());
		// ===============================
	
		if ($this -> session -> userdata('logged_in'))
		{
			$this->load->model('news_model');
			$data['logged_in'] = $this -> session -> userdata('logged_in');
			$data['naam'] = $this -> session -> userdata('voornaam');
			$data['news'] = $this->news_model->getNews();
			$this -> load -> view('index', $data);
		} 
		else 
		{
			$this->load->model('news_model');
			$data['news'] = $this->news_model->getNews();
			$this -> load -> view('index');
		}

	}
}
?>