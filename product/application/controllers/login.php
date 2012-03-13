<?php


class Login extends CI_controller{
	
	function validate_credentials(){
		$this->load->model('membership_model');
		$query = $this->membership_model->validate();

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
			
			if($this->input->post('link')){
				redirect(base_url() . $this->input->post('link'));
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
	
	function create_member(){
		$this->load->library('form_validation');
		//fieldname, error message, validation rules
		
		$this->form_validation->set_rules('first_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
		
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password_conf', 'Password Confirm', 'trim|required|matches[password]');
		
		if($this->form_validation->run() == TRUE){
			$this->load->model('membership_model');
			if($query = $this->membership_model->create_member()){
				$data['main_content'] = 'signup_successful';
				$this->load->view('includes/template', $data);
			} else {
				$this->signup();
			}
		} else {
			$this->signup();
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