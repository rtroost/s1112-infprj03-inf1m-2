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
		$this->db->select('voornaam, achternaam, email, adresregel_1, adresregel_2, postcode, woonplaats, telefoonnummer');
		$this->db->where('gebruikerid', $this -> session -> userdata('gebruikerid'));
		$query = $this->db->get('gebruiker');

		if ($query -> num_rows() > 0) {
			$row = $query -> row();

			return $row;
		}
		return FALSE;
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