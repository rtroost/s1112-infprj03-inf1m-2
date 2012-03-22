<?php 

class Mijnprofiel_cont extends CI_controller {
	
	function __construct() {
		parent::__construct();
		
		if($this->session->userdata('logged_in') != 1) {
			redirect(base_url()."index.php/login?redirect=mijnprofiel_cont");
		}
	}

	function index(){
		$this->load->view('mijnprofiel');
	}
	
	function product(){

		$this->load->model('gebruiker_product_model');
		
		if($this->input->is_ajax_request()){
			if($this->input->post('check') == 'true'){
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
		//var_dump( $data['rows'][0]);
		$this->load->view('mijnproducten', $data);
	}

	function favoriet(){

		$this->load->model('gebruiker_product_model');		
		$this->load->model('product_model');
		$this->load->model('categorie_model');
		
		if($this->input->post('productid')){
			if($this->gebruiker_product_model->remove_favoriet($this->input->post('productid'), $this->session->userdata('gebruikerid'))){
				redirect(base_url() . 'index.php/mijnprofiel_cont/favoriet');
			} else {
				//error
			}
		}
		
		$data['rows'] = $this->gebruiker_product_model->get_all_products_from_user($this->session->userdata('gebruikerid'), 0);
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
				$eigenaar = $this->gebruiker_product_model->get_eigenaar($row->productid);
				$row->eigenaar_naam = $eigenaar[0]->email;
			}
		} else {
			//error
		}
		//var_dump( $data['rows'][0]);
		$this->load->view('mijnfavorieten', $data);
	}

	
}

?>