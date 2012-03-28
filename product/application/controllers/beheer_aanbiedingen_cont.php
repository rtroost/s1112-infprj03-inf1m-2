<?php 

class Beheer_Aanbiedingen_cont extends CI_controller {
	
	function index(){
		$this->load->model('aanbiedingen_model');
		$data['aanbiedingen'] = $this->aanbiedingen_model->getAanbiedingen();
		$this->load->view('beheer_aanbiedingen', $data);
	}
	
	function product(){
		if($this->session->userdata('logged_in') != 1) {
			redirect(base_url()."index.php/user?redirect=user");
		}
		$this->load->model('gebruiker_product_model');
		
		if($this->input->is_ajax_request()){
			if($this->input->post('new') == '1'){
				if($this->gebruiker_product_model->get_publiekelijk_count($this->input->post('userid')) >= 5){
					echo "publiekelijk";
					return;
				}
			}
			if(!$this->gebruiker_product_model->set_publiekelijk($this->input->post('productid'), $this->input->post('new'))){
				echo "failed";
			}
			return;
		}
		
		$this->load->model('product_model');
		$this->load->model('categorie_model');
		
		if($this->input->post('productid')){
			if($this->product_model->verwijder_product($this->input->post('productid'))){
				redirect(base_url() . 'index.php/mijnprofiel_cont/product');
			} else {
				//error
			}
		}
		
		$data['rows'] = $this->gebruiker_product_model->get_all_products_from_user($this->session->userdata('gebruikerid'), 1);
		if($data['rows'] != null){
			foreach ($data['rows'] as $row) {
				$result = $this->product_model->get_products_by_id($row->productid);
				$row->product = $result;
				$categorienaam = $this->categorie_model->get_name($row->product[0]->categorieid);
				$row->categorienaam = $categorienaam[0]->naam;
				$names = $this->product_model->get_name_of_ingredients($row->productid);
				$row->names = $names;
				$prijs = $this->product_model->getTotalCost($row->productid);
				$row->prijs = $prijs;
			}
		} else {
			//error
		}
		
		$data['publiekelijkcount'] = $this->gebruiker_product_model->get_publiekelijk_count($this->session->userdata('gebruikerid'));
		//var_dump( $data['rows'][0]);
		$this->load->view('mijnproducten', $data);
	}
}

?>