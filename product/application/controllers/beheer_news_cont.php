<?php 

class Beheer_News_cont extends CI_controller {
	
	function index()
	{
			$this->load->model('news_model');
			$this->load->view('beheer_news');
	}
}

?>