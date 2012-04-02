<?php 
//klasse handelt groot gedeelte van alle ajax functies op
class Ajax_cont extends CI_controller 
{
	function index()
	{
		//Pakt alle informatie van het bestelde product via "GET", update de CART en returned HTML aan JS
		if(isset ($_GET['updateWagen']))
		{
			$this->load->library('cart');
			
			$data['id'] = $this->input->get('id');
			$data['name'] = $this->input->get('naam');
			$data['price'] = $this->input->get('prijs');
			$data['qty'] = $this->input->get('aantal');				
			
			foreach ($this -> cart -> contents() as $item) {
				if($item['id'] == $this->input->get('id')) {
					$data = array('rowid' => $item['rowid'], 'qty' => $item['qty'] + $this->input->get('aantal'));
					$this->cart->update($data);
				}
			}
			
			
			$this->cart->insert($data);
			
			$totalitems = $this->cart->total_items();
			echo "&nbsp;Winkelwagen(".$totalitems.")";			
		}
				
		if(isset ($_GET['archiveer']))
		{
			$this->load->model('beheer_gebruikers_model');
			$this->beheer_gebruikers_model->archiveerGebruiker($_GET['id']);
			$data['gebruikers'] = $this->beheer_gebruikers_model->getGebruikersGearchiveerd($_GET['status']);
			$this->load->view('ajax/beheer_gebruikers_archiveer', $data);
		}
		
		if(isset ($_GET['activeer']))
		{
			$this->load->model('beheer_gebruikers_model');
			$this->beheer_gebruikers_model->activeerGebruiker($_GET['id']);
			$data['gebruikers'] = $this->beheer_gebruikers_model->getGebruikersGearchiveerd($_GET['status']);
			$this->load->view('ajax/beheer_gebruikers_activeer', $data);
		}
		
		if(isset ($_GET['archief']))
		{
			if(isset ($_GET['status']) && $_GET['status'] == 1)
			{
				$this->load->model('beheer_gebruikers_model');
				$data['gebruikers'] = $this->beheer_gebruikers_model->getGebruikersGearchiveerd($_GET['status']);
				$this->load->view('ajax/beheer_gebruikers_archief', $data);
			}
			
			if(isset ($_GET['status']) && $_GET['status'] == 0)
			{
				$this->load->model('beheer_gebruikers_model');
				$data['gebruikers'] = $this->beheer_gebruikers_model->getGebruikers();
				$this->load->view('ajax/beheer_gebruikers_actief', $data);
			}
		}
		
		if(isset ($_GET['search']))
		{
			if(isset ($_GET['status']) && $_GET['status'] == 1)
			{
				$this->load->model('beheer_gebruikers_model');
				$data['gebruikers'] = $this->beheer_gebruikers_model->searchGebruikers($_GET['status'], $_GET['search']);
				$this->load->view('ajax/beheer_gebruikers_archief', $data);
			}
			
			if(isset ($_GET['status']) && $_GET['status'] == 0)
			{
				$this->load->model('beheer_gebruikers_model');
				$data['gebruikers'] = $this->beheer_gebruikers_model->searchGebruikers($_GET['status'], $_GET['search']);
				$this->load->view('ajax/beheer_gebruikers_actief', $data);
			}
		}
		
		if (isset ($_GET['wijzigGebruiker']))
		{
			$this->load->model('beheer_gebruikers_model');
			$this->beheer_gebruikers_model->updateGebruiker($_GET['id'], $_GET['voornaam'], $_GET['achternaam'], $_GET['email'], $_GET['adres1'], $_GET['adres2'], $_GET['postcode'], $_GET['woonplaats'], $_GET['telefoon'], $_GET['korting']);
		}

		if(isset ($_GET['updateNews']))
		{
			$this->load->model('news_model');
			$this->news_model->updateNews($_GET['titel'], $_GET['inhoud']);
		}

		if (isset ($_GET['wijzigContact']))
		{
			$this->load->model('contact_model');
			$this->contact_model->updateContact($_GET['adres'], $_GET['postcode'], $_GET['plaats'], $_GET['land'], $_GET['telefoon'], $_GET['fax'], $_GET['email'], $_GET['twitter'], $_GET['facebook']);
		}
	}
}
	
?>