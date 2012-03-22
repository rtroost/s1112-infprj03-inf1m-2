<?php
	$this->load->view('includes/header') 
?>
<div id="content"> 	
	<div id="legenda"><div class="legendaItem" ><b>(w) = weinig</div><div class="legendaItem">(n) = normale hoeveelheid</div><div class="legendaItem" >(v) = veel</b></div></div>													
	<p>&nbsp;<p>&nbsp;
	<?php
	/* variabellen */
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
        		<td class=\"bottom\"></td>
        		<td id=\"bottomright\" class=\"corner\"></td>
        	</tr>
        </tbody></table>";
		$i=0; 
		$pid=0;
		/* einde variabellen */
		
		
		/* bestellijst  */
		foreach($bestellijst as $categorie => $producten){ echo "						
		<table id=\"bestellijst\">
			<tr id=\"categorieRow\">
				<td id=\"categorieColumn\">".$categorie."</td>
				<td id=\"categoriePrijs\">Prijs per stuk</td>
				<td id=\"categorieAantal\">Aantal</td>
				<td id=\"categorieTotaal\">Totaal</td>
				<td id=\"categorieBestellen\"></td>
			</tr>";
			
			foreach($producten as $product => $productinformatie){ $pid++; $tableWidth = ceil((count($productinformatie)-3)/4);
echo		"<tr id=\"productRow\" >
				<td id=\"productColumn\"><div class=\"tooltipStart\"><span class=\"trigger\">".$product."</span>";

				/* tooltip */
echo			$fixedTooltipBegin;
echo 			"<table style=\"background-color:#ffffff;\">
					<tr>
						<td rowspan=\"3\" style=\"width:130px;\"><img style=\"border:1px solid #000000;\" width=\"100px\" height=\"100px\" src=\"".base_url()."images/products/".$productinformatie['plaatje']."\"></td>
						<td colspan=\"".$tableWidth."\" style=\"font-size:13px;font-weight:bold; vertical-align:baseline\">".$product."</td>
					</tr>
					<tr>
						<td colspan=\"".$tableWidth."\" style=\"font-size:11px;height:30px;font-weight:bold; vertical-align:baseline\">&#8364;".number_format($productinformatie['prijs']/100, 2)."</td>
					</tr>
					
					<tr>";
								for($i = 0; $i < $tableWidth; $i++){
echo								"<td style=\"vertical-align:baseline\">";
										if(0+$i*4 < count($productinformatie)-3) {echo $productinformatie[0+$i*4]."&nbsp;&nbsp;<br>";}
										if(1+$i*4 < count($productinformatie)-3) {echo $productinformatie[1+$i*4]."&nbsp;&nbsp;<br>";}
										if(2+$i*4 < count($productinformatie)-3) {echo $productinformatie[2+$i*4]."&nbsp;&nbsp;<br>";}
										if(3+$i*4 < count($productinformatie)-3) {echo $productinformatie[3+$i*4]."&nbsp;&nbsp;";}
echo								"</td>";
								}
echo					"</td>
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
		}
		
		/* einde bestellijst */
		echo "																
	</div>";
	?>
	
	<?php
		$this->load->view('includes/footer')
	?>