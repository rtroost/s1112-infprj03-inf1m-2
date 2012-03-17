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
		foreach ($this->cart->contents() as $item) :
			$query_prod_ingredients = $this -> db -> query('SELECT catingid, ingredienthoeveelheid FROM product_ingredient WHERE productid = ' . $item -> id);

			if ($query_prod_ingredients -> num_rows() > 0) {
				foreach ($query_prod_ingredients->results() as $row) :
					$query_ingredients = $this -> db -> query('SELECT prijs FROM categorie_ingredient WHERE catingid = ' . $row -> catingid);

					if ($query_ingredients -> num_rows() > 0) {
						$eeningredient = $query_ingredients -> row();
						$total_product_price = $total_product_price + ($eeningredient -> prijs * $query_prod_ingredients -> ingredienthoeveelheid);
					}
				endforeach;
			}
			$item['price'] = $total_product_price;
		endforeach;
	}

}
?>