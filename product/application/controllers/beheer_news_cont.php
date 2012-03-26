<?php 

class Beheer_News_cont extends CI_controller {
	
	function index()
	{
		$this->load->model('beheer_news_model');
		$data['news'] = $this->beheer_news_model->updateNews();
		$this->load->view('beheer_news', $data);
	}
}

?>