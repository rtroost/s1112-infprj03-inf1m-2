<?php $this->load->view('includes/header') ?>
<div id="content"> 															<?php
	foreach($bestellijst as $categorie => $producten){ echo "						
	<table id=\"bestellijst\">
		<tr id=\"categorieRow\">
			<td id=\"categorieColumn\">".$categorie."</td>
			<td id=\"categoriePrijs\">Prijs per stuk</td>
			<td id=\"categorieAantal\">Aantal</td>
			<td id=\"categorieTotaal\">Totaal</td>
		</tr>";
		foreach($producten as $product => $productinformatie){ echo "
		<tr id=\"productRow\" >
			<td id=\"productColumn\">".$product."</td>
			<td id=\"productPrijs\">&#8364;".number_format($productinformatie['prijs']/100, 2) ."</td>
			<td id=\"productAantal\"></td>
			<td id=\"productTotaal\"></td>
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
$this->load->view('includes/footer') 										?>