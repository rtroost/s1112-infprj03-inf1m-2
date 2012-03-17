<?php
class Cart extends CI_controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library('form_validation');
		$this -> load -> library('cart');
		$this -> load -> database();
		$this -> load -> helper('form');
		$this -> load -> helper('url');
		$this -> load -> model('order_model');
	}

	function index() {
		$this -> load -> view('includes/header');
		$this -> load -> view('cart');
		$this -> load -> view('includes/footer');
	}

	function update_cart() {
		$total = $this -> cart -> total_items();

		for ($i = 1; $i <= $total; $i++) {
			$item = $this -> input -> post($i);

			$data = array('rowid' => $item['rowid'], 'qty' => $item['qty']);
			$this -> cart -> update($data);
		}

		redirect('cart');
	}

	function remove($rowid) {
		$this -> cart -> update(array('rowid' => $rowid, 'qty' => 0));
		redirect('cart');
	}

	function clear_cart() {
		$this -> cart -> destroy();
		redirect('cart');
	}

	function checkout() {
		if ($this -> session -> userdata('logged_in') == FALSE) {
			redirect('login?redirect=cart/checkout');
		}

		$this -> form_validation -> set_rules('voorletters', 'Voorletters', 'required|trim|max_length[20]');
		$this -> form_validation -> set_rules('achternaam', 'Achternaam', 'required|trim|max_length[50]');
		$this -> form_validation -> set_rules('adresregel_1', 'Adresregel 1', 'required|trim|max_length[50]');
		$this -> form_validation -> set_rules('adresregel_2', 'Adresregel 2', 'trim|max_length[50]');
		$this -> form_validation -> set_rules('postcode', 'Postcode', 'required|trim|max_length[6]');
		$this -> form_validation -> set_rules('woonplaats', 'Woonplaats', 'required|trim|max_length[50]');
		$this -> form_validation -> set_rules('telefoonnummer', 'Telefoonnummer', 'required|trim|is_numeric|max_length[10]');
		$this -> form_validation -> set_rules('email', 'Email', 'required|trim|valid_email|max_length[100]');
		$this -> form_validation -> set_rules('payment-method', 'Payment method', 'required');

		$this -> form_validation -> set_error_delimiters('<br /><span class="error">', '</span>');

		if ($this -> form_validation -> run() == FALSE)// validation hasn't been passed
		{
			$data = $this -> order_model -> getShippingData();
			$this -> load -> view('includes/header');
			$this -> load -> view('order-form', $data);
			$this -> load -> view('includes/footer');
		} else// passed validation proceed to post success logic
		{
			// build array for the model

			$form_data = array('voornaam' => set_value('voorletters'), 'achternaam' => set_value('achternaam'), 'adresregel_1' => set_value('adresregel_1'), 'adresregel_2' => set_value('adresregel_2'), 'postcode' => set_value('postcode'), 'woonplaats' => set_value('woonplaats'), 'telefoonnummer' => set_value('telefoonnummer'), 'email' => set_value('email'));

			// run insert model to write data to db

			if ($this -> order_model -> saveShippingData($form_data) == TRUE)// the information has therefore been successfully saved in the db
			{
				redirect('cart/payment');
			} else {
				echo 'An error occurred saving your information. Please try again later';
				// Or whatever error handling is necessary
			}
		}
	}

	function payment() {
		$this->order_model->getUpToDatePizzaCost();

		$this -> load -> view('includes/header');
		$this -> load -> view('payment');
		$this -> load -> view('includes/footer');
	}

	function idealresult() {
		$status = $this -> input -> get('status');

		if (strcmp($status, 'cancel') === 0) {
			// Notify user
			$data['result'] = '<h1>Transactie geannuleerd.</h1><p>U heeft de betaling met iDEAL afgebroken.</p>';
		} elseif (strcmp($status, 'error') === 0) {
			// Notify user
			$data['result'] = '<h1>Transactie fout.</h1><p>Betalen met iDEAL is nu niet mogelijk. Probeer het later opnieuw of betaal op een andere manier.<br>Als u in uw Internetbankieren ziet dat de betaling van uw bestelling toch heeft plaatsgevonden, zullen wij zodra wij hiervan de bevestiging ontvangen tot levering overgaan.</p>';
		} elseif (strcmp($status, 'success') === 0) {
			// Notify user
			$data['result'] = '<h1>Transactie geslaagd.</h1><p>Uw betaling met iDEAL is geslaagd.</p>';
			$this -> cart -> destroy();
		} else {
			// Notify user
			$data['result'] = '<h1>Transactie fout.</h1><p>De status van uw iDEAL betaling is onbekend.</p>';
		}

		$this -> load -> view('includes/header');
		$this -> load -> view('message', $data);
		$this -> load -> view('includes/footer');
	}

}
?>