<?php 

class product_cont extends CI_controller {
	
	function index(){
		$this->load->view('product');
	}
	
	function creator(){
		$this->load->model('categorie_model');
		$data['records'] = $this->categorie_model->getCategorieen();
		$this->load->view('creator', $data);
	}
	
	function ajax_getId(){

		$is_ajax = $this->input->post('ajax');
		
		$this->load->model('categorie_model');
		$this->load->model('categorie_ingredient_model');
		$this->load->model('ingredient_model');
		
		$data['records'] = $this->categorie_model->getId($this->input->post('id'));
		$data['ingredienten'] = $this->categorie_ingredient_model->getIngredientenPerCategorie($this->input->post('id'));
		
		//print_r($data['ingredienten']);
		
		foreach ($data['ingredienten'] as $row) {
			$result = $this->ingredient_model->getId($row->ingredientid);
			$row->naam = $result[0]->naam;
			$row->gewichtspunten = $result[0]->gewichtspunten;
		}
		
		if($is_ajax){
			echo json_encode($data);
		} else {
			
		}
		
	}
	
	function ajax_getAll(){

		$is_ajax = $this->input->post('ajax');
		
		$this->load->model('categorie_model');
		$data['records'] = $this->categorie_model->getCategorieen();
		
		if($is_ajax){
			echo json_encode($data);
		} else {
			
		}
		
	}
	
	
	
}

?>