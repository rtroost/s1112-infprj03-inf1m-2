<?php
	$this->load->view('includes/header') 
?>
<div id="content"> 	
															
	<?php $i=0;
		foreach($bestellijst as $categorie => $producten){ echo "						
		<table id=\"bestellijst\">
			<tr id=\"categorieRow\">
				<td id=\"categorieColumn\">".$categorie."</td>
				<td id=\"categoriePrijs\">Prijs per stuk</td>
				<td id=\"categorieAantal\">Aantal</td>
				<td id=\"categorieTotaal\">Totaal</td>
				<td id=\"categorieBestellen\">Bestellen</td>
			</tr>";
			foreach($producten as $product => $productinformatie){ $i++; echo "
			<tr id=\"productRow\" >
				<td id=\"productColumn\">".$product."</td>
				<td rowspan=\"2\" id=\"productPrijs\">&#8364;".number_format($productinformatie['prijs']/100, 2) ."</td>
				<td rowspan=\"2\" id=\"productAantal\">
					<img class=\"bestellenButtons\" onClick=\"plusAantal(".$i.", ".$productinformatie['prijs'].")\" <img onmouseover=\"this.src='".base_url() ."images/img_order_plus_mouseover.png' \" onmouseout=\"this.src='".base_url()."images/img_order_plus.png'\" src=\"".base_url()."images/img_order_plus.png\"></img>
					<input class=\"aantal\" onChange=\"manualAantal(".$i.", ".$productinformatie['prijs'].")\" id=\"aantal".$i."\" value=\"0\" name=\"aantal\" type=\"text\" />
					<img class=\"bestellenButtons\" onClick=\"minAantal(".$i.", ".$productinformatie['prijs'].")\" src=\"".base_url()."images/img_order_minus.png\">
				</td>
				<td rowspan=\"2\" id=\"totaal".$i."\" class=\"productTotaal\">&#8364;".number_format(0, 2) ."</td>
				<td rowspan=\"2\" id=\"productBestellen\"><img height=\"12px\" src=\"".base_url()."images/winkelwagen.png\" name=\"winkelwagen\"></td>
			</tr>
			<tr id=\"ingredientRow\">
				<td id=\"ingredientColumn\">";
				for($i = 0; $i < count($productinformatie)-1; $i++){ 
					if($i == 0){ echo $productinformatie[$i];}
					else{ echo ", ".$productinformatie[$i];}
					
				}echo "														
				</td>
			</tr>";															
			} echo "
		</table>";
		}echo "																		
	</div>";
	$this->load->view('includes/footer') 										
?>