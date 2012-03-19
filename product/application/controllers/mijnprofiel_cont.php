<?php 

class Mijnprofiel_cont extends CI_controller {
	
	function __construct() {
		parent::__construct();
		
		if($this->session->userdata('logged_in') != 1) {
			redirect(base_url());
		}
	}

	function index(){
		$this->load->view('mijnprofiel');
	}
	
	function product(){

		$this->load->model('gebruiker_product_model');
		
		if($this->input->is_ajax_request()){
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
		
		$data['rows'] = $this->gebruiker_product_model->get_all_products_from_user($this->session->userdata('gebruikerid'));
		if($data['rows'] != null){
			foreach ($data['rows'] as $row) {
				$result = $this->product_model->get_products_by_id($row->productid);
				$row->product = $result;
				$categorienaam = $this->categorie_model->get_name($row->product[0]->categorieid);
				$row->categorienaam = $categorienaam[0]->naam;
				$names = $this->product_model->get_name_of_ingredients($row->productid);
				$row->names = $names;
			}
		} else {
			//error
		}
		//var_dump( $data['rows'][0]);
		$this->load->view('mijnproducten', $data);
	}
	
}

?>