<?php
class Order_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function saveShippingData($form_data) {
		$this -> db -> where('gebruikerid', $this -> session -> userdata('gebruikerid'));
		$this -> db -> update('gebruiker', $form_data);

		//If something, do something :D
		return TRUE;
	}

	function getShippingData() {
		$sql = "SELECT voornaam, achternaam, email, adresregel_1, adresregel_2, postcode, woonplaats, telefoonnummer FROM gebruiker WHERE gebruikerid = '" . $this -> session -> userdata('gebruikerid') . "' LIMIT 1";

		$query = $this -> db -> query($sql);

		if ($query -> num_rows() > 0) {
			$row = $query -> row();

			return $row;
		}
		return FALSE;
	}

	function getUpToDatePizzaCost() {
		//Werkt nog niet helemaal D:
		
		foreach ($this->cart->contents() as $item) :
			$query_prod_ingredients = $this -> db -> query('SELECT catingid, ingredienthoeveelheid FROM product_ingredient WHERE productid = ' . $item['id']);

			$total_product_price = 0.0;

			if ($query_prod_ingredients -> num_rows() > 0) {
				foreach ($query_prod_ingredients->result() as $row) :
					$query_ingredients = $this -> db -> query('SELECT prijs FROM categorie_ingredient WHERE catingid = ' . $row -> catingid);

					if ($query_ingredients -> num_rows() > 0) {
						$eeningredient = $query_ingredients -> row();
						$total_product_price = $total_product_price + (($eeningredient -> prijs / 100) * $row -> ingredienthoeveelheid);
					}
				endforeach;
			}

			echo $total_product_price.'<br/>';
			// $data = array('rowid' => $item['rowid'], 'price' => $total_product_price);
			// $this -> cart -> update($data);

			echo $item['price'];
		endforeach;
	}

	function createOrder() {
		$q = array('gebruikerid' => $this -> session -> userdata('gebruikerid'), 'kortingspunten' => '0', 'verwerkdatum' => date('Y-m-d H:i:s'), 'bestelmethodeid' => $this->session->userdata('bestelmethode'));
		$this -> db -> insert('bestelling', $q);

		$bestellingid = $this -> db -> insert_id();

		foreach ($this->cart->contents() as $item) :
			$q = array('productid' => $item['id'], 'bestellingid' => $bestellingid, 'aantal' => $item['qty'], 'korting' => '0');
			$this -> db -> insert('bestelregel', $q);
		endforeach;

		return $bestellingid;
	}

	function makePayment($orderid) {
		$q = array('bestellingid' => $orderid, 'bedrag' => $this -> cart -> total(), 'datetime' => date('Y-m-d H:i:s'), 'betaalmethodeid' => '1');
		$this -> db -> insert('betaling', $q);
	}

}
?>