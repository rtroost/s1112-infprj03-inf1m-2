<?php
class Cart_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function createOrder($userid) {
		$q = array('gebruikerid' => $userid, 'kortingspunten' => '0', 'verwerkdatum' => date('Y-m-d H:i:s'), 'bestelmethodeid' => $this->session->userdata('bestelmethode'));
		$this -> db -> insert('bestelling', $q);

		return $this -> db -> insert_id();
	}

	function createOrderLines($orderid, $item) {
		$q = array('productid' => $item['id'], 'bestellingid' => $orderid, 'aantal' => $item['qty'], 'korting' => '0');
		$this -> db -> insert('bestelregel', $q);
	}

	function giveDiscountPoints($productid) {
		$this -> db -> select('gebruikerid');
		$this -> db -> where(array('productid' => $productid, 'eigenaar' => 1));
			$result = $this -> db -> get('gebruiker_product');

			if ($result -> num_rows() > 0) {
				$row = $result -> row();

				if(($row -> gebruikerid == $this -> session -> userdata('gebruikerid')) == FALSE) {
					$data = array('kortingspunten' => 'kortingspunten + 5');
					$this -> db -> where('gebruikerid', $row -> gebruikerid);
					$this -> db -> update('gebruiker', $data);
				}			
			}		
		}

		function takeDiscountPoints($gebruikerid, $points) {
			$data = array('kortingspunten' => 'kortingspunten - '.$points);
			$this -> db -> where('gebruikerid', $gebruikerid);
			$this -> db -> update('gebruiker', $data);
		}

		function getDiscountP($userid) {
			$this -> db -> select('kortingspunten');
			$this -> db -> where('gebruikerid', $userid);
			$result = $this -> db -> get('gebruiker');

			if ($result -> num_rows() > 0) {
				$row = $result -> row();

				return $row -> kortingspunten;
			}
			return FALSE;
		}

		function makePayment($orderid) {
			$q = array('bestellingid' => $orderid, 'bedrag' => $this -> cart -> total(), 'datetime' => date('Y-m-d H:i:s'), 'betaalmethodeid' => '1');
			$this -> db -> insert('betaling', $q);
		}

	}
	?>