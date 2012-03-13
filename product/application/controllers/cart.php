<?php
class Cart extends CI_controller {

	function index() {
		$this -> load -> view('includes/header');

		$this -> cart -> destroy();
		
		/** Test cookie data */
		$data = array( array('id' => 1, 'qty' => 1, 'price' => 1.00, 'name' => 'sdf'), array('id' => 2, 'qty' => 3, 'price' => 5.00, 'name' => 'Pizza Kuttelienie'));
		
		$this -> cart -> insert($data);

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
		$this -> load -> view('includes/header');
		
		$this -> load -> view('order-form');
		
		// if($this-> session -> userdata('logged_in')) {
			// //Proceed to checkout
		// } else {
			// //$data = array('return_href' => 'winkelwagen/checkout');
			// //$this -> load -> view('login', $data);
		// }
		
		$this -> load -> view('includes/footer');
	}

	// function updatePizzaData() {
		// $total = 0;
// 
		// foreach ($this->cart->contents() as $item) :
			// $this -> load -> model('Product_model');
// 
			// $name = $this -> Product_model -> getName($item['id']);
			// $price = $this -> Product_model -> getCost($item['id']);
// 
			// $data = array('rowid' => $item['rowid'], 'name' => $name, 'price' => $price);
// 
			// $total += $price;
// 
			// $this -> cart -> update($data);
		// endforeach;
// 
		// return $total;
	// }

}
?>