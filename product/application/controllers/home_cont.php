<?php
// klasse haalt gegevens op voor de homepage en stuurt deze door naar de view
class Home_cont extends CI_controller {

	// functie load models news_model en product_model, haalt daar de aanbiedingen(functie get_set_aanbiedingen), top5 meest verkochte producten(functie get_top_producten) 
	// en het laatste nieuwsbericht(functie getNews). Geeft deze data door aan de home view
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