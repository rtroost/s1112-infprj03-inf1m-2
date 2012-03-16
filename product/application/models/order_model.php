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

}
?>