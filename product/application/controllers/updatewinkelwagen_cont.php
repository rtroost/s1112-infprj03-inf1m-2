<?php

class Updatewinkelwagen_cont extends CI_controller {
	
	function index(){
		$this->load->model('updatewinkelwagen_model');
		
		$data = $this->updatewinkelwagen_model->updateWagen($_GET['id'], $_GET['aantal'], $_GET['prijs']);
		
		$this->load->library('cart');
		$this->cart->insert($data);
		
		if($this->cart->insert($data)){
			echo "success";
			return;
		   } else {
			echo "failed";
			return;
		   }
	}
}

?>