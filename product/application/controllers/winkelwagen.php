<?php
class Winkelwagen extends CI_controller {

	function index() {
		$this -> load -> view('includes/header');
		$this -> load -> library('cart');
		
		$this->cart->destroy();

		/** Test cookie data */
		$data = array(
               array(
                       'id'      => 1,
                       'qty'     => 1,
                       'price'	 => 1.00,
                       'name'	 => 'sdf'
                    ),
                array(
                       'id'      => 2,
                       'qty'     => 3,
                       'price'	 => 5.00,
                       'name'	 => 'Pizza Kuttelienie'
                    )
        );

		$this->cart->insert($data);

		//$data['totaal'] = $this -> updatePizzaData();

		$this -> load -> view('winkelwagen', $data);
		$this -> load -> view('includes/footer');
	}

	function updatePizzaData() {
		$total = 0;
		
		foreach ($this->cart->contents() as $item):
			$this -> load -> model('Product_model');
			
			$name = $this -> Product_model -> getName($item['id']);
			$price = $this -> Product_model -> getCost($item['id']);
			
			$data = array(
               'rowid' => $item['rowid'],
               'name' => $name,
               'price'   => $price
            );
			
			$total += $price;

			$this->cart->update($data);
		endforeach;
		
		return $total;
	}
}
?>