<?php $this->load->view('includes/header') ?>

<div id="content"> 		
	<?php
		$i=0; 
		$pid=0;
		
		if($search == null){
			echo "geen resultaten";
		} else {
			foreach($search as $categorie => $producten) { ?>
			<table id="bestellijst">			
				<tbody id="categorieRow">
					<td id="categorieColumn"><?php echo $categorie; ?></td>
					<td id="categoriePrijs">Prijs per stuk</td>
					<td id="categorieAantal">Aantal</td>
					<td id="categorieTotaal">Totaal</td>
					<td id="categorieBestellen"></td>
				</tbody>
				<?php foreach($producten as $product => $productinformatie) { $pid++; ?>
				<tr id="productRow" >
					<td id="productColumn"><?php echo $product; ?></td>
					<td rowspan="2" id="productPrijs">&#8364; <?php echo number_format($productinformatie['prijs']/100, 2); ?></td>
					<td rowspan="2" id="productAantal">
						<img class="bestellenButtons" onClick="plusAantal(<?php echo $pid; ?>, <?php echo $productinformatie['prijs']; ?>)" <img onmouseover="this.src='<?php echo base_url(); ?>images/img_order_plus_mouseover.png'" onmouseout="this.src='<?php echo base_url(); ?>images/img_order_plus.png'" src="<?php echo base_url(); ?>images/img_order_plus.png"></img>
						<input class="aantal\" onChange="manualAantal(<?php echo $pid; ?>, <?php echo $productinformatie['prijs']; ?>)" id="aantal<?php echo $pid;?>" value="0" name="aantal" type="text" />
						<img class="bestellenButtons" onClick="minAantal(<?php echo $pid; ?>, <?php echo $productinformatie['prijs']; ?>)" <img onmouseover="this.src='<?php echo base_url(); ?>images/img_order_min_mouseover.png'" onmouseout="this.src='<?php echo base_url(); ?>images/img_order_min.png'" src="<?php echo base_url(); ?>images/img_order_min.png"></img>
					</td>
					<td rowspan="2" id="totaal<?php echo $pid; ?>" class="productTotaal">&#8364;<?php echo number_format(0, 2); ?></td>
					<td rowspan="2" id="productBestellen"><img height="16px" onmouseover="this.src='<?php echo base_url(); ?>images/img_order_cart_mouseover.png'" onmouseout="this.src='<?php echo base_url(); ?>images/img_order_cart.png'" src="<?php echo base_url(); ?>images/img_order_cart.png"></img>
				</tr>
				<tr id="ingredientRow">
					<td id="ingredientColumn">";
					<?php
					for($i = 0; $i < count($productinformatie)-1; $i++){ 
						if($i == 0){ echo $productinformatie[$i];}
						else{ echo ", ".$productinformatie[$i];}
						
					}echo "														
					</td>
				</tr>";															
				} echo "
			</table>";
			}
		} echo "																		
	</div>";
	?>
																
<?php $this->load->view('includes/footer') ?>