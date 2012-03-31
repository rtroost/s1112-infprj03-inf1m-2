<?php 

class product_cont extends CI_controller {
	
	function index(){
		
		$this->load->model('gebruiker_product_model');	
		
		if($this->input->is_ajax_request()){
			//$data = array('id' => 1, 'qty' => 1, 'price' => 1.00, 'name' => 'sdf');
			$this->load->library('cart');
			$data['id'] = $this->input->post('id');
			$data['name'] = $this->input->post('name');
			$data['price'] = $this->input->post('price');
			$data['qty'] = $this->input->post('qty');
			
			$gebruikerid = $this->input->post('gebruikerid');
			$productEigenaar = $this->input->post('productEigenaar');
			if($this->input->post('mediatype') == 'true' && $this->gebruiker_product_model->isPublieklijk($this->input->post('id')) && ($gebruikerid != $productEigenaar)){
				$data['options'] = array('media' => TRUE);
			}
			if($this->cart->insert($data)){
				echo "success";
				return;
			} else {
				echo "failed";
				return;
			}
			
		}

		if(!$this->input->get('productid')){
			$this->load->view('product');
			return;
		}
		
		$this->load->model('product_model');
		$this->load->model('categorie_model');
		
		$product_id = $this->input->get('productid');
		$data = null;
		$result = $this->product_model->get_products_by_id($product_id);
		if($result != null){
			$data['rows'] = $result[0];
			$categorienaam = $this->categorie_model->get_name($data['rows']->categorieid);
			$data['rows']->categorienaam = $categorienaam[0]->naam;
			$names = $this->product_model->get_name_of_ingredients($product_id);
			$data['rows']->names = $names;
			$prijs = $this->product_model->getTotalCost($product_id);
			$data['rows']->prijs = $prijs;
			$eigenaar = $this->gebruiker_product_model->get_eigenaar($product_id);
			if($eigenaar != null){
				$data['rows']->eigenaar_naam = $eigenaar[0]->email;
			}
			if($this->session->userdata('logged_in')){
				$favoriet = $this->gebruiker_product_model->is_favoriet($product_id, $this->session->userdata('gebruikerid'));
				$data['rows']->favoriet = $favoriet;
			}
		}
		if($this->input->get('ref')){
			$data['ref'] = "true";
		}
		$this->load->view('product', $data);
	}
	
	function creator(){
		
		if($this->input->post('productid')){
			$data['load'] = true;
			
			$this->load->model('product_model');
			$this->load->model('categorie_model');
			$this->load->model('gebruiker_product_model');
			$data['rows'] = $this->product_model->get_products_by_id($this->input->post('productid'));

			$data['rows'] = $data['rows'][0];
			
			if($data['rows'] != null){
				$categorierow = $this->categorie_model->getId($data['rows']->categorieid);
				$data['rows']->categorienaam = $categorierow[0]->naam;
				$data['rows']->categorieimg = $categorierow[0]->image_groot;
				$data['rows']->categorieomschrijving = $categorierow[0]->omschrijving;
				$data['rows']->standaardprijs = $categorierow[0]->standaardprijs;
				$publikelijk = $this->gebruiker_product_model->get_publiekelijk($this->input->post('productid'));
				$data['rows']->publiekelijk = $publikelijk[0]->publiekelijk;
				$records = $this->product_model->get_name_hoeveelheid_of_ingredients($data['rows']->productid);
				$data['rows']->ingredienten = $records;

			} else {
				//error
			}
			
			$this->load->model('ingredient_model');
			$data['ingredienten'] = $this->ingredient_model->get_all_names_by_categorie($data['rows']->categorieid);
			$data['id'] = $this->input->post('productid');
		}
		$this->load->model('categorie_model');
		$data['records'] = $this->categorie_model->getCategorieen();
		$this->load->view('creator', $data);
	}
	
	function ajax_getId(){

		$is_ajax = $this->input->post('ajax');
		
		$this->load->model('categorie_model');
		$this->load->model('categorie_ingredient_model');
		$this->load->model('ingredient_model');
		$id = $this->input->post('id');
		
		$data['records'] = $this->categorie_model->getId($id);
		$data['ingredienten'] = $this->categorie_ingredient_model->getIngredientenPerCategorie($id);
		
		//print_r($data['ingredienten']);
		
		foreach ($data['ingredienten'] as $row) {
			$result = $this->ingredient_model->getIdv2($row->catingid);
			$row->naam = $result[0]->naam;
			$row->gewichtspunten = $result[0]->gewichtspunten;
		}
		
		if($is_ajax){
			echo json_encode($data);
		} else {
			
		}
		
	}
	
	function save_product(){
		
		$this->load->model('product_model');
		$this->load->model('gebruiker_product_model');
		$this->load->model('product_ingredient_model');
		
		
		
		$dataProduct['naam'] = $this->input->post('productNaam');
		$dataProduct['standaard'] = 1;
		$dataProduct['categorieid'] = $this->input->post('categorieid');
		$dataProduct['gearchiveerd'] = 0;
		$load = $this->input->post('load');
		if($this->input->post('gebruikerid') == "undefined"){
			// de gebruiker was niet ingelogged dus moet als temp worden opgeslagen
			$dataProduct['temp'] = 1;
		} else {
			$dataProduct['temp'] = 0;
			if(!$this->product_model->check_name($this->input->post('productNaam'), $load)){
				echo "naam";
				return;
			}
		}

		$success = true;
		$publiekelijkonder5 = false;
		$publiekelijk = false;
		
		
		if($load == 'true'){
			$product_id = $this->input->post('product_id');
			if($this->product_ingredient_model->del_ingredients_for_product($product_id)){
				$publiekelijk_var = $this->input->post('publiekelijk');
				if($this->session->userdata('typeid') != 2){
					if($this->input->post('wasPubliekelijk') == "true"){
						if($this->input->post('publiekelijk') == 1){
							$publiekelijk_var = 1;
						} else {
							$publiekelijk_var = 0;
							$publiekelijk = true;
						}
					} else if($this->input->post('publiekelijk') == 1 && $this->gebruiker_product_model->get_publiekelijk_count($this->input->post('gebruikerid')) >= 5){
						$publiekelijk_var = 0;
						$publiekelijkonder5 = true;
					}
				}
				if($publiekelijk_var == 0){
					$publiekelijk = true;
				}
				$this->gebruiker_product_model->set_publiekelijk($product_id, $publiekelijk_var);
				$this->product_model->update_name($product_id, $this->input->post('productNaam'));
				if($this->input->post('aantalingredienten') != 0){
				
					for($i = 0; $i < $this->input->post('aantalingredienten'); $i++){
						$ingredientid = 'ingredientid'.($i+1);
						$hoeveelheid = 'hoeveelheid'.($i+1);
						$dataProduct_ingredient[$i]['catingid'] = $this->input->post($ingredientid);
						$dataProduct_ingredient[$i]['productid'] = $product_id;
						$dataProduct_ingredient[$i]['ingredienthoeveelheid'] = $this->input->post($hoeveelheid);
						
						if(!$this->product_ingredient_model->create_product_ingredient($dataProduct_ingredient[$i])){
							$success = false;
						}
					}
				}
			} else {
				$success = false;
			}
			
			
		} else {

			if($this->product_model->create_product($dataProduct)){
				
				$product_id = mysql_insert_id();
				
				if($this->input->post('gebruikerid') != "undefined"){
					$dataGebruiker_Product['gebruikerid'] = $this->input->post('gebruikerid');
					$dataGebruiker_Product['productid'] = $product_id;
					$dataGebruiker_Product['publiekelijk'] = $this->input->post('publiekelijk');
					if($this->session->userdata('typeid') != 2){
						if($this->input->post('publiekelijk') == 0){
							$publiekelijk = true;
						}
						if($this->input->post('publiekelijk') == 1 && $this->gebruiker_product_model->get_publiekelijk_count($this->input->post('gebruikerid')) >= 5){
							$dataGebruiker_Product['publiekelijk'] = 0;
							$publiekelijkonder5 = true;
							$publiekelijk = true;
						}
					}
					$dataGebruiker_Product['aanmaak_datetime'] = date("Y-m-d H:i:s");
					$dataGebruiker_Product['eigenaar'] = 1;
					
					if(!$this->gebruiker_product_model->create_gebruiker_product($dataGebruiker_Product)){
						$success = false;
					}
					//create Gebruiker_Product
				}
				
				if($this->input->post('aantalingredienten') != 0){
				
					for($i = 0; $i < $this->input->post('aantalingredienten'); $i++){
						$ingredientid = 'ingredientid'.($i+1);
						$hoeveelheid = 'hoeveelheid'.($i+1);
						$dataProduct_ingredient[$i]['catingid'] = $this->input->post($ingredientid);
						$dataProduct_ingredient[$i]['productid'] = $product_id;
						$dataProduct_ingredient[$i]['ingredienthoeveelheid'] = $this->input->post($hoeveelheid);				
						
						if(!$this->product_ingredient_model->create_product_ingredient($dataProduct_ingredient[$i])){
							$success = false;
						}
					}
				}
			
			} else {
				$success = false;
			}
		}
		
		if($success){
			if($publiekelijkonder5){
				echo $product_id . ",onder5";
			} elseif($publiekelijk) {
				echo $product_id . ",nietpubliekelijk";
			} else {
				echo $product_id;
			}
		} else {
			echo "failed";
		}
				
	}
	
	
	
}

?>