<?php
class Updatewinkelwagen_model extends CI_model{
	
	function updateWagen($id, $aantal, $price){
		$sql = "select * from product where productid = '".$id."'";
		$result = mysql_query($sql);
		$results = mysql_fetch_object($result);
		
		$data = array(
               'id'      => $id,
               'qty'     => $aantal,
               'price'   => $price,
               'name'    => $results->naam
            );
			
		return $data;
	}
}
?>