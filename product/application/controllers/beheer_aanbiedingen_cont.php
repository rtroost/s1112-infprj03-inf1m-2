<?php 

class Beheer_Aanbiedingen_cont extends CI_controller {
	
	function index(){
		if($this->session->userdata('logged_in') != 1 || $this->session->userdata('typeid') != 2) {
			redirect(base_url()."index.php/user?redirect=beheer_aanbiedingen_cont");
		}
		
		$this->load->model('product_model');
		if($this->input->is_ajax_request()){
			//aanpassen
			if($this->input->post('new') == '1'){
				if($this->product_model->get_aanbieding_count() >= 5){
					echo "publiekelijk";
					return;
				}
			}
			if(!$this->product_model->set_aanbieding($this->input->post('productid'), $this->input->post('new'))){
				echo "failed";
			}
			return;
		}
		
		
		$this->load->model('gebruiker_product_model');
		$this->load->model('categorie_model');
		
		
		$data['rows'] = $this->product_model->get_all_aanbiedingen();
		$data['aanbiedingcountcount'] = 0;
		if($data['rows'] != null){
			foreach ($data['rows'] as $row) {
				if($row->aanbieding == 1){
					$data['aanbiedingcountcount']++;
				}
				$categorienaam = $this->categorie_model->get_name($row->categorieid);
				$row->categorienaam = $categorienaam[0]->naam;
				$prijs = $this->product_model->getTotalCost($row->productid);
				$row->prijs = $prijs;
				$names = $this->product_model->get_name_of_ingredients($row->productid);
				$row->names = $names;
			}
		} else {
			//error
		}
		
		//$data['publiekelijkcount'] = $this->gebruiker_product_model->get_publiekelijk_count($this->session->userdata('gebruikerid'));
		//var_dump( $data['rows'][0]);
		$this->load->view('beheer_aanbiedingen', $data);
	}
}

?>