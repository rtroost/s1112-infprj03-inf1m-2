<?php


class Login_cont extends CI_controller{
	
	function index(){
		if($this->session->userdata('logged_in')){
			$data['logged_in'] = $this->session->userdata('logged_in');
			$this->load->view('login', $data);
		} else {
			if($this->input->get('link')){
				$data['link'] = $this->input->get('link');
				$this->load->view('login', $data);
			} else {
				$this->load->view('login');
			}
		}
	}
	
	function login(){
		$this->load->model('gebruiker');
		$query = $this->gebruiker->login();

		if($query != NULL){
			$data = array(
				'gebruikerid' => $query[0]->gebruikerid,
				'email' => $query[0]->email,
				'voornaam' => $query[0]->voornaam,
				'achternaam' => $query[0]->achternaam,
				'type' => $query[0]->typeid,
				'logged_in' => true
			);
			$this->session->set_userdata($data);
			
			if($this->input->get('link')){
				redirect(base_url() . $this->input->get('link'));
			}
			
			// als er geen ajax request gemaakt is moet een ridirect gedaan worden.
			if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
				redirect(base_url() . 'index.php');
			}
			
			
			
		} else {
			
			//redirect(base_url() . 'index.php?login=false');
			// verkeerde combinatie 
			//$this->index();
		}
	}
	
	function logout() {
		$data = array(
				'gebruikerid' => '',
				'email' => '',
				'voornaam' => '',
				'achternaam' => '',
				'logged_in' => ''
			);
        $this->session->unset_userdata($data);
        redirect(base_url() . 'index.php');
    }  
	
}

?>