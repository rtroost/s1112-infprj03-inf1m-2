<?php
	$this->load->view('includes/header') 
?>
<div id="content"> 	
															
	<?php
	 
		$i=0; 
		$pid=0;
		
		foreach($bestellijst as $categorie => $producten){ echo "						
		<table id=\"bestellijst\">
			<tr id=\"categorieRow\">
				<td id=\"categorieColumn\">".$categorie."</td>
				<td id=\"categoriePrijs\">Prijs per stuk</td>
				<td id=\"categorieAantal\">Aantal</td>
				<td id=\"categorieTotaal\">Totaal</td>
				<td id=\"categorieBestellen\"></td>
			</tr>";
			
			foreach($producten as $product => $productinformatie){ $pid++; echo "
			<tr id=\"productRow\" >
				<td id=\"productColumn\">".$product."</td>
				<td rowspan=\"2\" id=\"productPrijs\">&#8364;".number_format($productinformatie['prijs']/100, 2) ."</td>
				<td rowspan=\"2\" id=\"productAantal\">
					<img class=\"bestellenButtons\" onClick=\"plusAantal(".$pid.", ".$productinformatie['prijs'].")\" <img onmouseover=\"this.src='".base_url() ."images/img_order_plus_mouseover.png' \" onmouseout=\"this.src='".base_url()."images/img_order_plus.png'\" src=\"".base_url()."images/img_order_plus.png\"></img>
					<input class=\"aantal\" onChange=\"manualAantal(".$pid.", ".$productinformatie['prijs'].")\" id=\"aantal".$pid."\" value=\"0\" name=\"aantal\" type=\"text\" />
					<img class=\"bestellenButtons\" onClick=\"minAantal(".$pid.", ".$productinformatie['prijs'].")\" <img onmouseover=\"this.src='".base_url() ."images/img_order_min_mouseover.png' \" onmouseout=\"this.src='".base_url()."images/img_order_min.png'\" src=\"".base_url()."images/img_order_min.png\"></img>
				</td>
				<td rowspan=\"2\" id=\"totaal".$pid."\" class=\"productTotaal\">&#8364;".number_format(0, 2) ."</td>
				<td rowspan=\"2\" id=\"productBestellen\"><img height=\"16px\" style=\"cursor: pointer;\" onclick=\"updateWinkelwagen(".$productinformatie['id'].", ".$productinformatie['prijs'].")\" <img onmouseover=\"this.src='".base_url() ."images/img_order_cart_mouseover.png' \" onmouseout=\"this.src='".base_url()."images/img_order_cart.png'\" src=\"".base_url()."images/img_order_cart.png\"></img>
			</tr>
			<tr id=\"ingredientRow\">
				<td id=\"ingredientColumn\">";
				for($i = 0; $i < count($productinformatie)-2; $i++){ 
					if($i == 0){ echo $productinformatie[$i];}
					else{ echo ", ".$productinformatie[$i];}
					
				}echo "														
				</td>
			</tr>";															
			} echo "
		</table><p>&nbsp;<p>";
		}echo "																
	</div>";
	?>
	
	<?php
		$this->load->view('includes/footer')
	?>