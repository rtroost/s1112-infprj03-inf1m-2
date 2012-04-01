<?php
	$this->load->view('includes/header') 
?>
<div id="content"> 	
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
        		<td class=\"bottom\"><img style=\"display:none;\" width=\"30\" height=\"29\" alt=\"popup tail\" src=\"".base_url()."images/tooltip/bubble-tail2.png\"></td>
        		<td id=\"bottomright\" class=\"corner\"></td>
        	</tr>
        </tbody>
        </table>";
		$i=0; 
		/* einde variabellen */
		
		
		/* bestellijst  */
		foreach($bestellijst as $categorie => $producten){ echo "						
		<table id=\"bestellijst\" class=\"productlijst\">
			<thead>
			<tr id=\"categorieRow\">
				<th id=\"categorieColumn\">".$categorie."</th>
				<th id=\"categoriePrijs\">Prijs per stuk</th>
				<th id=\"categorieAantal\">Aantal</th>
				<th id=\"categorieTotaal\">Totaal</th>
				<th id=\"categorieBestellen\"></th>
			</tr>
			</thead>
			";
			
			foreach($producten as $product => $productinformatie){ $tableWidth = ceil((count($productinformatie)-3)/4); $lol = $product;
echo		"<tr id=\"productRow\" >
				<td id=\"productColumn\"><div class=\"tooltipStart\"><span class=\"trigger\"><a href=\"". base_url() ."index.php/product_cont?productid=" . $productinformatie['id']  . " \">".$product."</span>";

				/* tooltip */
echo			$fixedTooltipBegin;
echo 			"<table style=\"background-color:#ffffff;\">
					<tr>
						<td rowspan=\"3\" style=\"width:130px;\"><img style=\"border:1px solid #000000;\" width=\"100px\" height=\"100px\" src=\"".base_url()."images/products/".$productinformatie['plaatje']."\"></td>
						<td colspan=\"".$tableWidth."\" style=\"font-size:13px;font-weight:bold;text-align:left; vertical-align:baseline\">".$product."</td>
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
					<img class=\"bestellenButtons\" onClick=\"plusAantal(".$productinformatie['id'].", ".$productinformatie['prijs'].")\" onmouseover=\"this.src='".base_url() ."images/img_order_plus_mouseover.png' \" onmouseout=\"this.src='".base_url()."images/img_order_plus.png'\" src=\"".base_url()."images/img_order_plus.png\"></img>
					<input class=\"aantal\" onChange=\"manualAantal(".$productinformatie['id'].", ".$productinformatie['prijs'].")\" id=\"aantal".$productinformatie['id']."\" value=\"0\" name=\"aantal\" type=\"text\" />
					<img class=\"bestellenButtons\" onClick=\"minAantal(".$productinformatie['id'].", ".$productinformatie['prijs'].")\" onmouseover=\"this.src='".base_url() ."images/img_order_min_mouseover.png' \" onmouseout=\"this.src='".base_url()."images/img_order_min.png'\" src=\"".base_url()."images/img_order_min.png\"></img>
				</td>
				<td rowspan=\"2\" id=\"totaal".$productinformatie['id']."\" class=\"productTotaal\">&#8364;".number_format(0, 2) ."</td>
				<td rowspan=\"2\" id=\"productBestellen\"><img height=\"16px\" style=\"cursor: pointer;\" onclick=\"updateWinkelwagen('".$product."', ".$productinformatie['id'].", ".number_format($productinformatie['prijs']/100, 2).")\" onmouseover=\"this.src='".base_url() ."images/img_order_cart_mouseover.png' \" onmouseout=\"this.src='".base_url()."images/img_order_cart.png'\" src=\"".base_url()."images/img_order_cart.png\"></img>
			</tr>
			<tr id=\"ingredientRow\">
				<td id=\"ingredientColumn\">";
				for($i = 0; $i < count($productinformatie)-3; $i++){ 
					if($i == 0){ echo substr($productinformatie[$i], 3);}
					else{ echo ", ".substr($productinformatie[$i], 3);}
					
				}echo "														
				</td>
			</tr>";															
			} echo "
		</table>";
		}
		
		/* einde bestellijst */
		echo "																
	</div>";
	?>
	
	<?php
		$this->load->view('includes/footer')
	?>