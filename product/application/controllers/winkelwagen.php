<?php
class Winkelwagen extends CI_controller {

	function index() {
		$this -> load -> view('includes/header');

		$this -> cart -> destroy();
		
		/** Test cookie data */
		$data = array( array('id' => 1, 'qty' => 1, 'price' => 1.00, 'name' => 'sdf'), array('id' => 2, 'qty' => 3, 'price' => 5.00, 'name' => 'Pizza Kuttelienie'));
		
		$this -> cart -> insert($data);

		$data['totaal'] = $this -> updatePizzaData();

		$this -> load -> view('winkelwagen');
		$this -> load -> view('includes/footer');
	}

	function update_cart() {
		$total = $this -> cart -> total_items();

		for ($i = 1; $i <= $total; $i++) {			
			$item = $this -> input -> post($i);
			
			$data = array('rowid' => $item['rowid'], 'qty' => $item['qty']);
			$this -> cart -> update($data);
		}
		
		redirect('winkelwagen');
	}

	function remove($rowid) {
		$this -> cart -> update(array('rowid' => $rowid, 'qty' => 0));

		redirect('winkelwagen');
	}

	function clear_cart() {
		$this -> cart -> destroy();
		redirect('winkelwagen');
	}

	function updatePizzaData() {
		$total = 0;

		foreach ($this->cart->contents() as $item) :
			$this -> load -> model('Product_model');

			$name = $this -> Product_model -> getName($item['id']);
			$price = $this -> Product_model -> getCost($item['id']);

			$data = array('rowid' => $item['rowid'], 'name' => $name, 'price' => $price);

			$total += $price;

			$this -> cart -> update($data);
		endforeach;

		return $total;
	}

}
?>