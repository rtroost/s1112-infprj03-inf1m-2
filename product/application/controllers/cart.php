<?php
class Cart extends CI_controller {

	function __construct() {
		parent::__construct();
		/** Initialize helpers, libraries, models and the database*/
		$this -> load -> library('form_validation');
		$this -> load -> library('cart');
		$this -> load -> database();
		$this -> load -> helper('form');
		$this -> load -> helper('url');
		$this -> load -> model('cart_model');
		$this -> load -> model('product_model');
		$this -> load -> model('usersystem_model');

		/** Change error messages to display in Dutch */
		$this -> form_validation -> set_message('alpha_numeric', 'Het veld %s bevat tekens uit een niet toegestane karaktergroep.');
		$this -> form_validation -> set_message('required', 'Het veld %s is niet ingevuld.');
		$this -> form_validation -> set_message('matches', 'De wachtwoord velden kwamen niet overeen.');
		$this -> form_validation -> set_message('email', 'Gelieve een geldig e-mailadres in te vullen.');
		$this -> form_validation -> set_message('max_length', 'Het veld %s bevatte te veel of te weinig tekens');
	}

	function index() {
		/** Load the default view: cart */
		$this -> load -> view('cart');
	}

	/*
	 * The ajaxAddProduct function provides functionality for all pages who require on-the-go AJAX/JSON powered adding of a product.
	 * This function also checks if the ID is already in the cart and if so, no new product will be added in addition to
	 * the quantity being increased.
	 */
	function ajaxAddProduct() {

		/** Check if it's an AJAX request */
		if ($this -> input -> is_ajax_request()) {
			/** Pick up input */
			$id = $this -> input -> post('id');
			$qty = $this -> input -> post('qty');
			$price = $this -> input -> post('price');
			$name = $this -> input -> post('name');

			/** Loop through the cart contents */
			foreach ($this -> cart -> contents() as $item) {
				if ($item['id'] == $id) {
					/** If the ID already exists in the cart, add quantity to the existing row instead of creating a new one */
					$data = array('rowid' => $item['rowid'], 'qty' => $item['qty'] + $qty);
					/** Update the found row and return the result */
					return $this -> cart -> update($data);
				}
			}

			/** No return was triggered before this so the ID doesn't exist within the cart yet */
			$data = array('id' => $id, 'qty' => $qty, 'price' => $price, 'name' => $name);

			/** Insert a new row into the cart contents and return the result */
			return $this -> cart -> insert($data);
		}

	}

	/*
	 * The discount function sets or removes the discount userdata, if the user has 20 or more discount points, indicating the 10% discount is active.
	 */
	function discount($do) {

		if ($this -> session -> userdata('logged_in') == FALSE) {
			/** If the user is not logged in, redirect to the login page */
			redirect('user/login?redirect=cart');
		}

		if ($this -> cart -> total_items() == 0) {
			/** If the cart is empty, redirect to the base */
			redirect('cart');
		}

		if ($do == 'remove') {
			/** If the link has /remove in it, the discount boolean will be set to false */
			$this -> session -> set_userdata(array('discount' => FALSE));
		} else {
			if ($this -> cart_model -> getDiscountP($this -> session -> userdata('gebruikerid')) >= 20) {
				/** If the logged in user has 20 or more points, discount boolean will be set to true */
				$this -> session -> set_userdata(array('discount' => TRUE));
			}
		}

		/** All done, redirect to cart */
		redirect('cart');
	}

	/*
	 * The update_cart function picks up the quantity fields in the cart and updates the quantities accordingly in the cart.
	 */
	function update_cart() {

		if ($this -> session -> userdata('logged_in') == FALSE) {
			/** If the user is not logged in, redirect to the login page */
			redirect('user/login?redirect=cart');
		}

		if ($this -> cart -> total_items() == 0) {
			/** If the cart is empty, redirect to the base */
			redirect('cart');
		}

		$total = $this -> cart -> total_items();

		for ($i = 1; $i <= $total; $i++) {
			$item = $this -> input -> post($i);

			$data = array('rowid' => $item['rowid'], 'qty' => $item['qty']);
			$this -> cart -> update($data);
		}

		redirect('cart');
	}

	/*
	 * The remove function allows for easy removal of items in the cart, e.g.: index.php/cart/remove/<rowid>
	 */
	function remove($rowid) {
		$this -> cart -> update(array('rowid' => $rowid, 'qty' => 0));
		redirect('cart');
	}

	/*
	 * The clear_cart function simply clears the cart of all contents.
	 */
	function clear_cart() {
		$this -> cart -> destroy();
		redirect('cart');
	}

	/*
	 * The function checkout is the first step in the ordering process. It let's the user check its shipping data one last time before finalizing the order and asks how they want it delivered and how they want to pay, then moves on to payment
	 */
	function checkout() {

		if ($this -> session -> userdata('logged_in') == FALSE) {
			/** If the user is not logged in, redirect to the login page */
			redirect('user/login?redirect=cart/checkout');
		}
		if ($this -> cart -> total_items() == 0) {
			/** If the cart is empty, redirect to the base */
			redirect('cart');
		}

		/** Set all rules for our form */
		$this -> form_validation -> set_rules('voorletters', 'Voorletters', 'required|trim|max_length[20]');
		$this -> form_validation -> set_rules('achternaam', 'Achternaam', 'required|trim|max_length[50]');
		$this -> form_validation -> set_rules('adresregel_1', 'Adresregel 1', 'required|trim|max_length[50]');
		$this -> form_validation -> set_rules('adresregel_2', 'Adresregel 2', 'trim|max_length[50]');
		$this -> form_validation -> set_rules('postcode', 'Postcode', 'required|trim|max_length[6]');
		$this -> form_validation -> set_rules('woonplaats', 'Woonplaats', 'required|trim|max_length[50]');
		$this -> form_validation -> set_rules('telefoonnummer', 'Telefoonnummer', 'required|trim|is_numeric|max_length[10]');
		$this -> form_validation -> set_rules('email', 'Email', 'required|trim|valid_email|max_length[100]');
		$this -> form_validation -> set_rules('payment-method', 'Payment methode', 'required');
		$this -> form_validation -> set_rules('bestelmethode', 'Bestel methode', 'required');

		/** Set layout for each error */
		$this -> form_validation -> set_error_delimiters('<br /><span class="error">', '</span>');

		if ($this -> form_validation -> run() == FALSE) {
			/** Form validation didn't pass or nothing has been posted yet */

			/*Load the users data */
			$data = $this -> usersystem_model -> getUserData();

			/** Load the view and fill in the received userdata */
			$this -> load -> view('edit_userdata', $data);
		} else {
			/** Form validation passed */

			/** Create data to pass onto the database */
			$form_data = array('voornaam' => set_value('voorletters'), 'achternaam' => set_value('achternaam'), 'adresregel_1' => set_value('adresregel_1'), 'adresregel_2' => set_value('adresregel_2'), 'postcode' => set_value('postcode'), 'woonplaats' => set_value('woonplaats'), 'telefoonnummer' => set_value('telefoonnummer'), 'email' => set_value('email'));
			$this -> session -> set_userdata(array('bestelmethode' => set_value('bestelmethode')));

			if ($this -> usersystem_model -> setUserData($form_data) == TRUE) {
				/** Updating data in the database was successful */

				/** Choose a redirect path based upon payment method */
				if ($this -> input -> post('payment-method') === "contant") {
					redirect('cart/complete');
				} else {
					redirect('cart/payment');
				}
			} else {
				/** Something went wrong while updating userdata */
				echo 'An error occurred saving your information. Please try again later';
			}
		}
	}

	/*
	 * The payment function updates the prices of all items in the cart and handles the iDeal functionality
	 */
	function payment() {

		if ($this -> session -> userdata('logged_in') == FALSE) {
			/** If the user is not logged in, redirect to the login page */
			redirect('user/login?redirect=cart/payment');
		}

		if ($this -> cart -> total_items() == 0) {
			/** If the cart is empty, redirect to the base */
			redirect('cart');
		}

		foreach ($this->cart->contents() as $item) {
			/** Loop through the cart contents to update each price to their price in the database */
			$data = array('rowid' => $item['rowid'], 'price' => ($this -> product_model -> getTotalCost($item['id']) / 100));
			$this -> cart -> update($data);
		}

		/** Load the payment view */
		$this -> load -> view('payment');
	}

	/*
	 * The giveDiscountPoints function makes sure the owner of every product that was added to the cart via social media gets points for sharing their product and also adds all products that are being ordered to the 'bestel_regel' table
	 */
	function giveDiscountPoints($orderid) {

		foreach ($this->cart->contents() as $item) :
			/** Loop through the cart contents */

			/** Create a bestel_regel for each item in the cart */
			$this -> cart_model -> createOrderLines($orderid, $item);

			if ($this -> cart -> has_options($item['rowid']) == TRUE) :
				/** If the cart has any options at all.. */
				foreach ($this->cart->product_options($item['rowid']) as $option_name => $option_value) :
					/** ..loop through all the options.. */
					if ($option_name == 'media' && $option_value == TRUE) :
						/** ..and if the option indicates the product was added through social media, give the owner of the product points */
						$this -> cart_model -> giveDiscountPoints($item['id']);
					endif;
				endforeach;
			endif;
		endforeach;
	}

	/*
	 * The removeDiscountPoints function simply removes discount points from the users account if he chose to activate his 10% discount with 20 discount points
	 */
	function removeDiscountPoints() {

		if ($this -> session -> userdata('discount') == TRUE) {
			/** If the user chose to use discount points on the purchase, take 20 points from the user */
			$this -> cart_model -> takeDiscountPoints($this -> session -> userdata('gebruikerid'), 20);
		}
	}

	/*
	 * The idealresult function checks the result of the ideal transaction and notifies the user
	 */
	function idealresult() {

		if ($this -> session -> userdata('logged_in') == FALSE) {
			/** If the user is not logged in, redirect to the login page */
			redirect('user/login?redirect=cart');
		}

		if ($this -> cart -> total_items() == 0) {
			/** If the cart is empty, redirect to the base */
			redirect('cart');
		}

		/** Get the status returned by iDeal simulator */
		$status = $this -> input -> get('status');

		if (strcmp($status, 'cancel') === 0) {
			/** The transaction was canceled */
			$data['result'] = '<h1>Transactie geannuleerd.</h1><p>U heeft de betaling met iDEAL afgebroken.</p>';
		} elseif (strcmp($status, 'error') === 0) {
			/** The transaction ended in error */
			$data['result'] = '<h1>Transactie fout.</h1><p>Betalen met iDEAL is nu niet mogelijk. Probeer het later opnieuw of betaal op een andere manier.<br>Als u in uw Internetbankieren ziet dat de betaling van uw bestelling toch heeft plaatsgevonden, zullen wij zodra wij hiervan de bevestiging ontvangen tot levering overgaan.</p>';
		} elseif (strcmp($status, 'success') === 0) {
			/** The transaction was successful */
			$data['result'] = '<h1>Transactie geslaagd.</h1><p>Uw betaling met iDEAL is geslaagd.</p>';

			/** Create a 'bestelling' in the database */
			$orderid = $this -> cart_model -> createOrder($this -> session -> userdata('gebruikerid'));
			/** Give discount points to people of whose products were ordered */
			$this -> giveDiscountPoints($orderid);
			/** Remove discount points if any were spent */
			$this -> removeDiscountPoints();
			/** Make payment */
			$this -> cart_model -> makePayment($orderid);

			/** Clean up */
			$array_items = array('discount' => '', 'bestelmethode' => '');
			$this -> session -> unset_userdata($array_items);
			$this -> cart -> destroy();
		} else {
			// Notify user
			$data['result'] = '<h1>Transactie fout.</h1><p>De status van uw iDEAL betaling is onbekend.</p>';
		}

		$this -> load -> view('message', $data);
	}

	/*
	 * The complete function provides the end-point for users who chose to make payment by cash at the door and will simply finish the entire sequence of order functionality
	 */
	function complete() {

		/** Create a 'bestelling' in the database */
		$orderid = $this -> cart_model -> createOrder($this -> session -> userdata('gebruikerid'));
		/** Give discount points to people of whose products were ordered */
		$this -> giveDiscountPoints($orderid);
		/** Remove discount points if any were spent */
		$this -> removeDiscountPoints();
		/** Make payment */
		$this -> cart_model -> makePayment($orderid);

		/** Clean up */
		$array_items = array('discount' => '', 'bestelmethode' => '');
		$this -> session -> unset_userdata($array_items);
		$this -> cart -> destroy();

		$data['result'] = '<h1>Bestelling kompleet</h1><p>Uw bestelling is geplaatst.</p>';
		$this -> load -> view('message', $data);
	}

}
?>