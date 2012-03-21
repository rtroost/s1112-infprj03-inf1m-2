<?php
	$this->load->view('includes/header') 
?>
<div id="content"> 	
															
	<?php
		$fixedTooltipBegin = "<table id=\"dpop\" class=\"popup\">
        	<tbody><tr>
        		<td id=\"topleft\" class=\"corner\"></td>
        		<td class=\"top\"></td>
        		<td id=\"topright\" class=\"corner\"></td>
        	</tr>
        	<tr>
        		<td class=\"left\"></td>
        		<td>";
		$fixedTooltipEinde = "</td>
        		<td class=\"right\"></td>    
        	</tr>
        	<tr>
        		<td class=\"corner\" id=\"bottomleft\"></td>
        		<td class=\"bottom\"><img width=\"30\" height=\"29\" alt=\"popup tail\" src=\"".base_url()."images/tooltip/bubble-tail2.png\"></td>
        		<td id=\"bottomright\" class=\"corner\"></td>
        	</tr>
        </tbody></table>";
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
				<td id=\"productColumn\"><div class=\"tooltipStart\"><span class=\"trigger\">".$product."</span>";

				/* tooltip */
echo			$fixedTooltipBegin;
echo 			"<table style=\"background-color:#ffffff;\">
					<tr>
						<td><img width=\"100px\" src=\"".base_url()."images/products/".$productinformatie['plaatje']."\"></td>
						<td></td>
					</tr>
				</table>";
echo   			$fixedTooltipEinde;
				/* einde tooltip */				
				
echo   			"</div></td>
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
				for($i = 0; $i < count($productinformatie)-3; $i++){ 
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