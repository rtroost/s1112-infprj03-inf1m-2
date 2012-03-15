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
				<td id=\"productPrijs\">&#8364;".number_format($productinformatie['prijs']/100, 2) ."</td>
				<td id=\"productAantal\">
				<img onClick=\"minAantal(".$i.", ".$productinformatie['prijs'].")\" src=\"".base_url()."images/img_order_minus.png\">
				<input class=\"aantal\" onChange=\"manualAantal(".$i.", ".$productinformatie['prijs'].")\" id=\"aantal".$i."\" value=\"0\" name=\"aantal\" type=\"text\" />
				<img onClick=\"plusAantal(".$i.", ".$productinformatie['prijs'].")\" src=\"".base_url()."images/img_order_plus.png\">
				</td>
				<td id=\"totaal".$i."\" class=\"productTotaal\">&#8364;".number_format(0, 2) ."</td>
				<td id=\"categorieBestellen\"><img src=\"".base_url()."images/winkelwagen.png\" name=\"winkelwagen\"></td>
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