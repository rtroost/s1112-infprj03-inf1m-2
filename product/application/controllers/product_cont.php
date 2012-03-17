<?php 

class product_cont extends CI_controller {
	
	function index(){
// 		
		// if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && isset($_POST['setCookie'])){
// 			
// 						
			  // /** Test cookie data */
			  // // $data = 
			  		// // //array(
			                // // array(
			                       // // 'id'      => 2,
			                       // // 'qty'     => 3,
			                       // // 'price'  => 5.00,
			                       // // 'name'  => 'Pizza Kuttelienie'
			                    // // )
			       // // // );
// // 			
			  // // $this->cart->insert($data);
// 			  
// 			  
// 			  
// 			  
// 			  
// 
// 			  
// 						
// 			
			// // SET COOKIE
			// // if(setcookie($name)){
				// // echo "succes";
			// // } else {
				// // echo "failed";
			// // }
// 			
			// echo "success";
			// return;
		// }
		
		if($this->input->is_ajax_request()){
			//$data = array('id' => 1, 'qty' => 1, 'price' => 1.00, 'name' => 'sdf');
			$this->load->library('cart');
			$data['id'] = $this->input->post('id');
			$data['name'] = $this->input->post('name');
			$data['price'] = $this->input->post('price');
			$data['qty'] = $this->input->post('qty');
			if($this->cart->insert($data)){
				echo "success";
				return;
			} else {
				echo "failed";
				return;
			}
			
		}

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
	
	function save_product(){
		
		$this->load->model('product_model');
		$this->load->model('gebruiker_product_model');
		$this->load->model('product_ingredient_model');
		
		
		
		$dataProduct['naam'] = $this->input->post('productNaam');
		$dataProduct['standaard'] = 1;
		$dataProduct['categorieid'] = $this->input->post('categorieid');
		$dataProduct['gearchiveerd'] = 0;
		if($this->input->post('gebruikerid') == "undefined"){
			// de gebruiker was niet ingelogged dus moet als temp worden opgeslagen
			$dataProduct['temp'] = 1;
		} else {
			$dataProduct['temp'] = 0;
		}
		
		$success = true;
		
		if($this->product_model->create_product($dataProduct)){
			
			$product_id = mysql_insert_id();
			
			if($this->input->post('gebruikerid') != "undefined"){
				$dataGebruiker_Product['gebruikerid'] = $this->input->post('gebruikerid');
				$dataGebruiker_Product['productid'] = $product_id;
				$dataGebruiker_Product['publiekelijk'] = $this->input->post('publiekelijk');
				$dataGebruiker_Product['aanmaak_datetime'] = date("Y-m-d H:i:s");
				
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
		
		if($success){
			echo $product_id;
		} else {
			echo "failed";
		}
				
	}
	
	
	
}

?>