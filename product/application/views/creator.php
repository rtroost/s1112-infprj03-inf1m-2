<?php $this->load->view('includes/header') ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>css/productApp.css" />
	<div id="content">
		
		
<?php
	if(isset($load)){
		$nameCounter = 0;
		//var_dump($rows[0]);
		//var_dump($ingredienten);
		//var_dump($rows[0]->categorieid);
		
		$totaalgewicht = 0;
		$totaalprijs = $rows[0]->standaardprijs;
	}
 ?>
		
		
		
		<h1>De product creëer pagina</h1>
		<p>U kunt hier uw eigen product samenstellen</p>
		<br />
		
		<div id="productApp">
			<div id="appNavigation">

				<ul>
					<li id="1" class="activated">
						<a class="appNav" href="">Categorie</a>
					</li>
					<li id="2" class="overig">
						<a class="appNav" href="">Samenstellen</a>
					</li>
					<li id="3" class="overig">
						<a class="appNav" href="">Opslaan</a>
					</li>
					<li id="4" class="overig">
						<a class="appNav" href="">Bestellen</a>
					</li>
				</ul>

			</div>

			<div id="appMainWindow1" class="mainWindows">
				<div id="appSideBar">
					<h1>Kies een categorie: </h1>
					<br />
					<table id="sidebar_table">
						<?php $count = 1; foreach($records as $row) : ?>
						<tr>
							<td><img src="<?php echo base_url(); ?>images/productApp/<?php echo $row->image_klein; ?>" width="80px" height="70px"/></td>
							<td>
								<input class="sidebar_keuze_categorie" name="sidebar_keuze" value="<?php echo $row->categorieid; ?>" type="radio" <?php if(isset($load)){ if($count == $rows[0]->categorieid){ echo "checked='checked'"; } } ?>/>
								<label><?php echo $row->naam; ?></label>
							</td>
						</tr>
						<?php $count++; endforeach; ?>
					</table>
					
					<div class="center nav_div">
						<button class="nav_button" id="vorige" style="visibility:hidden;"> « Vorige </button>
						 &nbsp; <button class="nav_button" id="volgende"> Volgende » </button>
					</div>
					
				</div>
				<div id="appView">
					<?php if(!isset($load)){ ?>
					<h1>Product creator</h1>
					<p>Welkom bij de product creator. Hier kan je zelf een product maken en gelijk bestellen.</p>
					<p>
						<br />
						<b>Stap1</b> : Kies een categorie. Elke categorie heeft een start prijs <br />
						<b>Stap2</b> : Stel je product samen. <br />
						<b>Stap3</b> : Sla je product op.<br />
							 Dit kan allen als je ingelogged bent. Ben je nog niet ingeloged?
							 	 Je kan hier <a href="#">inloggen</a> of <a href="#">registreren</a>.
							 Je kan je product een naam geven en opslaan zodat je het product later nog een keer kan bestellen.<br />
						<b>Stap4</b> : Bestel je product.<br />
					</p>
					<?php } else { ?>
						
						<h1>U heeft gekozen voor: <?php echo $rows[0]->categorienaam; ?></h1>
						<div class="center">
						<img src="<?php echo base_url(); ?>images/productApp/<?php echo $rows[0]->categorieimg; ?>" style="width: 400px; height: 300px;">
<!-- 						http://127.0.0.1/pizzario/images/productApp/soep_groot.jpg -->
						</div>
					<?php } ?>
				</div>
				<div id="appSelector">
					<?php if(isset($load)){ ?>
						<h1><?php echo $rows[0]->categorienaam; ?></h1>
						<p><?php echo $rows[0]->categorieomschrijving; ?></p>
					<?php } ?>
				</div>
				
			</div>
			<div id="appMainWindow2" class="mainWindows">
				<div id="appSideBar">
					
					<h1>Product samenstellen</h1>
					<div <?php if(isset($load)){ echo 'style="display: none;"'; }?>>
						<p id="samenstellenText">U heeft nog geen categorie gekozen.<br /> Maak een product aan en probeer het opnieuw.</p>
					</div>
					<div id="sidebar_table2_div" <?php if(!isset($load)){ echo 'style="display: none;"'; }?>>
						<table id="sidebar_table2" style="width: 100%;">
							
							<?php if(isset($load)){ ?>
								
								<?php $count = 1; foreach($ingredienten as $ing) : ?>
									<?php if($count % 2 == 0 ){ } ?>
										<td>
											<label for="sidebar_keuze"><?php echo $ing->naam; ?></label>
											<br>
											<img src="http://127.0.0.1/pizzario/images/productApp/<?php echo $rows[0]->categorieid; ?>/<?php echo $ing->ingredientid; ?>/left.png" style="float: left; height: 50px; width: 50px;">
											<input class="sidebar_keuze_ingredient" type="checkbox" name="sidebar_keuze" value="1" data-arrayindex="0" style="margin-top: 20px; margin-left: 10px;" <?php if(($nameCounter < count($rows[0]->names) && ($ing->naam == $rows[0]->names[$nameCounter]))){ echo "checked='checked'"; $nameCounter++; }  ?>>
										</td>
									<?php if($count % 2 == 0 ){ echo "</tr>"; } ?>
								<?php $count++; endforeach; ?>
								
							<?php } ?>
							
						</table>
					</div>
					<div class="center nav_div">
						<button class="nav_button" id="vorige"> « Vorige </button>
						 &nbsp; <button class="nav_button" id="volgende"> Volgende » </button>
					</div>
				</div>
				<div id="appView2">
					<h1 id="samenstellen_view_titel" <?php if(!isset($load)){ echo 'style="display: none;"'; }?>>Uw product:</h1>
					<table id="view2_table_head" <?php if(isset($load)){ echo 'style="display:inline;"'; } ?>>
						<tr>
							<td><h4>Ingredient</h4></td>
							<td><h4>Gewicht</h4></td>
							<td><h4>Hoeveelheid</h4></td>
							<td><h4>Prijs</h4></td>
						</tr>
					</table>
					<div id="overflow" <?php if(!isset($load)){ echo 'style="display: none;"'; }?>>
						<table id="view2_table_main" style="display: inline;">
							
							<?php if(isset($load)){ ?>
								
								<?php $catid = $rows[0]->categorieid; $count = 1; $tempcount = 1; foreach($rows[0]->names as $naam) : ?>
									<?php 
									
									$JScount = 0;
									$temptemp = false;
									foreach($ingredienten as $ing){
										
										$id = ($ing->ingredientid-1);
										$multi = 0.75;
										$prijs100 = $ing->prijs;
										
										$hoeveelheid = 1;
										$gewichtspunten = $ing->gewichtspunten;
										$tempgewicht = $gewichtspunten * $hoeveelheid;
										
										$tempprijs = round($prijs100 * $multi);
										
										if($ing->naam == $naam){
											
											$viewid =  ($ing->ingredientid-1);
												
											$hoeveelheid = $rows[0]->hoeveelheid[$count-1];
											$viewhoeveelheid = $hoeveelheid;
											//var_dump($hoeveelheid);
											
											$tempgewicht = $gewichtspunten * $hoeveelheid;
											$viewgewicht = $tempgewicht;
											$totaalgewicht += $tempgewicht;
											
											if($hoeveelheid == 1){ $multi = 0.75;
											} elseif($hoeveelheid == 2){ $multi = 1; 
											} else { $multi = 1.25; }
											
											$tempprijs = round($prijs100 * $multi);
											$totaalprijs += $tempprijs;
											
											$ingredientenArray[$count-1]['id'] = $id;
											$ingredientenArray[$count-1]['naam'] = $naam;
											$ingredientenArray[$count-1]['hoeveelheid'] = $hoeveelheid;
											
											if(strlen($tempprijs) == 3){
												$prijs = '€' . substr($tempprijs, 0, 1) . ',' . substr($tempprijs, 1);
											} else {
												$prijs = '€0,' . $tempprijs;
											}
											$ingredientenArray[$count-1]['calcedprijs'] = $prijs;
											$temptemp = true;
										}
										
										
										if($tempcount == 1 || $temptemp == true){
											$JSingredienten[$JScount] = "ingredientId: {$ing->ingredientid}, prijs100: {$ing->prijs}";
											$JSingredienten[$JScount] = $JSingredienten[$JScount] . ", prijs: {$tempprijs}";
											
											$JSingredienten[$JScount] = $JSingredienten[$JScount] . ", naam: {$ing->naam}, gewichtspunten: {$ing->gewichtspunten}";
											if(isset($hoeveelheid)){
												$JSingredienten[$JScount] = $JSingredienten[$JScount] . ", hoeveelheid: {$hoeveelheid}";
											} else {
												$JSingredienten[$JScount] = $JSingredienten[$JScount] . ", hoeveelheid: 1";
											}
											$JSingredienten[$JScount] = $JSingredienten[$JScount] . ", gewicht: {$tempgewicht}";
											
											if(($ing->naam == $naam)){
												$JSingredienten[$JScount] = $JSingredienten[$JScount] . ", gekozen: true";
											} else {
												$JSingredienten[$JScount] = $JSingredienten[$JScount] . ", gekozen: false";
											}
											
										}										
										$JScount++;

									}
											if($tempcount == 1){
												$tempcount++;
											}
									?>
									<tr class="<?php echo $id; ?>">
											<td>
												<img src="<?php echo base_url(); ?>images/productApp/<?php echo $catid; ?>/<?php echo $viewid+1; ?>/left.png">
												<p><?php echo $naam; ?></p>
											</td>
											<td class="totaalGewicht"><?php echo $viewgewicht; ?></td>
											<td>
												<div class="view2buttons">
													<button <?php if($viewhoeveelheid == 1){ echo "class='down'"; } ?> data-func="1">Weinig</button>
													<button <?php if($viewhoeveelheid == 2){ echo "class='down'"; } ?> data-func="2">Normaal</button>
													<button <?php if($viewhoeveelheid == 3){ echo "class='down'"; } ?> data-func="3">Veel</button>
												</div>
											</td>
											<td class="prijs"><?php echo $prijs; ?></td>
										</tr>
								<?php $count++; endforeach; ?>
								
							<?php } ?>
							
						</table>
					</div>
					<table id="view2_table_foot" cellspacing="0" <?php if(isset($load)){ echo 'style="display:inline;"'; } ?>>
						<tr>
							<td><h4>Totaal Gewicht (max 20)</h4></td>
							<td><h4 id="totaal_gewicht_ingredienten"><?php if(isset($load)){ echo $totaalgewicht; } else { echo "0"; }?></h4></td>
							<td><h4>Totaal Prijs</h4></td>
							<td><h4 id="totaal_prijs_ingredienten"><?php if(isset($load)){ if(strlen($totaalprijs) == 4){ echo '€' . substr($totaalprijs, 0, 2) . ',' . substr($totaalprijs, 2);	} 
								else if(strlen($totaalprijs) == 3){	echo '€' . substr($totaalprijs, 0, 1) . ',' . substr($totaalprijs, 1); } else {	echo '€0,' . $totaalprijs; } } else { echo "0"; }?>
								</h4></td>
						</tr>
					</table>
				</div>
			</div>
			<div id="appMainWindow3" class="mainWindows">
				<div id="appSideBar">
					<h1>Uw product opslaan</h1>
					<div <?php if(isset($load)){ echo 'style="display: none;"'; }?>>
						<p id="opslaanText">U heeft nog geen categorie gekozen.<br /> Maak een product aan en probeer het opnieuw.</p>
					</div>
					<div id="opslaan" <?php if(!isset($load)){ echo 'style="display: none;"'; }?>>
						<div id="opslaan_login" style="<?php if($this->session->userdata('logged_in') != 1){ echo "display: none;"; } ?>">
							<p>Hallo <span class="name"><?php if($this->session->userdata('voornaam')){ echo $this->session->userdata('voornaam'); } ?></span>, <br />
								U kunt hier uw product opslaan op uw profiel.
							</p>
							
							<h4>Product naam:</h4>
							<input id="product_name" type="text" name="naam" value=""/><br />
							<p>Wilt u uw product publiekelijk maken?</p>
							<input id="product_publikelijk" type="checkbox" name="publikelijk" value=""/>
							<br />
							
							<button id="buttonOpslaan">Opslaan</button><br /><br />
							
							<p>U kunt dit product en andere gemaakte producten beheren door maar "Mijn profiel" te gaan.</p>
						</div>	
						<div id="opslaan_logout" style="<?php if($this->session->userdata('logged_in') == 1){ echo "display: none;"; } ?>">
							<p>U bent nog niet ingelogd. U hoeft uw product niet op te slaan om te kunnen bestellen, u deze stap eventueel overslaan.</p>
							<h4>Login:</h4>
							<form id="login_form" action="<?php echo base_url();?>index.php/login" method="post">
								<label for="username">Email adres: </label>
								<br />
								<input name="username" value="" type="text" />
								<br />
								<label for="password">Password: </label>
								<br />
								<input name="password" value="" type="password" />
								<br />
								<input style="background: #b8cc81;" type="submit" value="login" id="loginSubmit" />
							</form><br />
							
							
							
							<p>Geen account? <a href="register">Registeer hier</a></p>
						</div>
						<div id="after_opslaan" style="display: none;">
							<p>Uw product is opgeslagen<br />
								U kunt de samenstelling van dit product later nog wijzigen, dit kunt u regelen in "mijn profiel".<br />
								U kunt nu uw product bestellen door naar de volgende stap te gaan.
							</p>
						</div>		
					</div>
					
					
					<div class="center nav_div">
						<button class="nav_button" id="vorige"> « Vorige </button>
						 &nbsp; <button class="nav_button" id="volgende"> Volgende » </button>
					</div>
				</div>
				<div id="appView2">
					<h1 id="opslaan_view_titel" <?php if(!isset($load)){ echo 'style="display: none;"'; }?>>Uw product:</h1>
					<table id="view3_table_head" <?php if(isset($load)){ echo 'style="display:inline;"'; } ?>>
						<tr>
							<td><h4>Ingredient</h4></td>
							<td><h4>Hoeveelheid</h4></td>
							<td><h4>Prijs</h4></td>
						</tr>
					</table>
					<div id="overflow" <?php if(!isset($load)){ echo 'style="display: none;"'; }?>>
						<table id="view3_table_main" style="display: inline;">
							<?php if(isset($load)){ ?>
								<?php 
								  foreach($ingredientenArray as $ingredientdeel) : ?>
									<tr class="<?php echo $ingredientdeel['id']; ?>">
										<td>
											<img src="<?php echo base_url(); ?>images/productApp/<?php echo $catid; ?>/<?php echo $ingredientdeel['id']+1; ?>/left.png">
											<p><?php echo $ingredientdeel['naam']; ?></p>
										</td>
										<td>	
											<p id="view3Hoeveelheid"><?php if($ingredientdeel['hoeveelheid'] == 1){ echo "Weinig"; } elseif($ingredientdeel['hoeveelheid'] == 2){ echo "Normaal"; } else { echo "Veel"; } ?></p>
										</td>
										<td class="prijs"><?php echo $ingredientdeel['calcedprijs']; ?></td>
									</tr>
								<?php  endforeach; ?>
							<?php } ?>
						</table>
					</div>
					<table id="view2_table_foot" cellspacing="0" <?php if(isset($load)){ echo 'style="display:inline;"'; } ?>>
						<tr>
							<td><h4>Totaal Gewicht (max 20)</h4></td>
							<td><h4 id="totaal_gewicht_ingredienten"><?php if(isset($load)){ echo $totaalgewicht; } else { echo "0"; }?></h4></td>
							<td><h4>Totaal Prijs</h4></td>
							<td><h4 id="totaal_prijs_ingredienten"><?php if(isset($load)){ if(strlen($totaalprijs) == 4){ echo '€' . substr($totaalprijs, 0, 2) . ',' . substr($totaalprijs, 2);	} 
								else if(strlen($totaalprijs) == 3){	echo '€' . substr($totaalprijs, 0, 1) . ',' . substr($totaalprijs, 1); } else {	echo '€0,' . $totaalprijs; } } else { echo "0"; }?>
								</h4></td>
						</tr>
					</table>
				</div>
			</div>
			<div id="appMainWindow4" class="mainWindows">
				<div id="appSideBar">
					<h1>Uw product bestellen</h1>
					<div <?php if(isset($load)){ echo 'style="display: none;"'; }?>>
						<p id="bestelText">U heeft nog geen categorie gekozen.<br /> Maak een product aan en probeer het opnieuw.</p>
					</div>
					<div id="bestellen" <?php if(!isset($load)){ echo 'style="display: none;"'; }?>>
						<div id="bestellen_login" style="<?php if($this->session->userdata('logged_in') != 1){ echo "display: none;"; } ?>">
							<p>Hallo <span class="name"><?php if($this->session->userdata('voornaam')){ echo $this->session->userdata('voornaam'); } ?></span>, <br />
								Uw product is nog niet opgeslagen. Ga naar de "Opslaan" pagina om uw product opgeslaan
							</p>
						</div>
						<div id="bestellen_logout" style="<?php if($this->session->userdata('logged_in') == 1){ echo "display: none;"; } ?>">
							<p>Bedankt voor het maken van een product. U kunt uw product nu in uw winkelwagen stoppen. En daarna kunt u naar uw winkelwagen gaan om uw product te bestellen.</p>
							<h5>Hoeveel wilt u bestellen</h5>
							<input id="qty" type="text" name="qty" value="1"/>
							<button id="winkelwagen" data-after="false">In Winkelwagen</button><br />
							<h4 id="winkelwagenHeading" data-after="false" style="display: none;">Uw bestelling is geplaatst</h4>
							<a id="naarWinkelwagen" data-after="false" href="<?php echo base_url();?>index.php/cart" style="display: none;">Naar uw Winkelwagen</a>
						</div>
						<div id="after_bestellen" style="display: none;">
							<p>Bedankt voor het maken van een product. U kunt uw product nu in uw winkelwagen stoppen. En daarna kunt u naar uw winkelwagen gaan om uw product te bestellen.</p>
							<h5>Hoeveel wilt u bestellen</h5>
							<input id="qty" type="text" name="qty" value="1"/>
							<button id="winkelwagen" data-after="true">In Winkelwagen</button><br />
							<h4 id="winkelwagenHeading" data-after="true" style="display: none;">Uw bestelling is geplaatst</h4>
							<a id="naarWinkelwagen" data-after="true" href="<?php echo base_url();?>index.php/cart" style="display: none;">Naar uw Winkelwagen</a>
						</div>	
					</div>	
					<div class="center nav_div">
						<button class="nav_button" id="vorige"> « Vorige </button>
						 &nbsp; <button class="nav_button" id="volgende" style="visibility:hidden;"> Volgende » </button>
					</div>
				</div>
				<div id="appView2">
					<h1 id="bestellen_view_titel" <?php if(!isset($load)){ echo 'style="display: none;"'; }?>>Uw product:</h1>
					<table id="view3_table_head" <?php if(isset($load)){ echo 'style="display:inline;"'; } ?>>
						<tr>
							<td><h4>Ingredient</h4></td>
							<td><h4>Hoeveelheid</h4></td>
							<td><h4>Prijs</h4></td>
						</tr>
					</table>
					<div id="overflow" <?php if(!isset($load)){ echo 'style="display: none;"'; }?>>
						<table id="view3_table_main" style="display: inline;">
							<?php if(isset($load)){ ?>
								<?php 
								  foreach($ingredientenArray as $ingredientdeel) : ?>
									<tr class="<?php echo $ingredientdeel['id']; ?>">
										<td>
											<img src="<?php echo base_url(); ?>images/productApp/<?php echo $catid; ?>/<?php echo $ingredientdeel['id']+1; ?>/left.png">
											<p><?php echo $ingredientdeel['naam']; ?></p>
										</td>
										<td>
											<p id="view3Hoeveelheid"><?php if($ingredientdeel['hoeveelheid'] == 1){ echo "Weinig"; } elseif($ingredientdeel['hoeveelheid'] == 2){ echo "Normaal"; } else { echo "Veel"; } ?></p>
										</td>
										<td class="prijs"><?php echo $ingredientdeel['calcedprijs']; ?></td>
									</tr>
								<?php  endforeach; ?>
							<?php } ?>
						</table>
					</div>
					<table id="view2_table_foot" cellspacing="0" <?php if(isset($load)){ echo 'style="display:inline;"'; } ?>>
						<tr>
							<td><h4>Totaal Gewicht (max 20)</h4></td>
							<td><h4 id="totaal_gewicht_ingredienten"><?php if(isset($load)){ echo $totaalgewicht; } else { echo "0"; }?></h4></td>
							<td><h4>Totaal Prijs</h4></td>
							<td><h4 id="totaal_prijs_ingredienten"><?php if(isset($load)){ if(strlen($totaalprijs) == 4){ echo '€' . substr($totaalprijs, 0, 2) . ',' . substr($totaalprijs, 2);	} 
								else if(strlen($totaalprijs) == 3){	echo '€' . substr($totaalprijs, 0, 1) . ',' . substr($totaalprijs, 1); } else {	echo '€0,' . $totaalprijs; } } else { echo "0"; }?>
								</h4></td>
						</tr>
					</table>
				</div>
			</div>
			
			
		</div>
		<br />
	</div>

	<script src="http://cloud.github.com/downloads/wycats/handlebars.js/handlebars-1.0.0.beta.6.js"></script>
	<script src="<?php echo base_url(); ?>js/jquery.json-2.3.js"></script>
	<script src="<?php echo base_url(); ?>js/jquery.numeric.js"></script>
	<script src="<?php echo base_url(); ?>js/createApp_script.js"></script>
	
<<<<<<< .mine
=======
	
>>>>>>> .r77
	<script>
	(function( $ ){

		CreateApp.init({
			<?php if($this->session->userdata('logged_in') == 1){
					echo "loginData: {
						achternaam: '{$this->session->userdata('achternaam')}',
						email: '{$this->session->userdata('email')}',
						gebruikerid: '{$this->session->userdata('gebruikerid')}',
						logged_in: {$this->session->userdata('logged_in')},
						type: '{$this->session->userdata('type')}',
						voornaam: '{$this->session->userdata('voornaam')}'
					},"; 
				} else {
					echo "loginData: {},";
				} ?>
				
				
				opgeslagen: 0,
				
	
				<?php if(isset($load)){ ?>
				ingredienten: [],
				gekozenCategorie: <?php echo $catid; ?>,
				<?php } else { ?>
				ingredienten: [],
				gekozenCategorie: 0,
				<?php } ?>
				
				pagenr: 1,
				appNavigationUl: $('div#appNavigation ul'),
				totaalGewicht: 0,
				totaalPrijs: 0,
				appMainWindow1: $('div#appMainWindow1'),
				sidebar1: $('div#appMainWindow1').find('div#appSideBar'),
				view1: $('div#appMainWindow1').find('div#appView'),
				selector1: $('div#appMainWindow1').find('div#appSelector'),
				
				appMainWindow2: $('div#appMainWindow2'),
				sidebar2: $('div#appMainWindow2').find('div#appSideBar'),
				view2: $('div#appMainWindow2').find('div#appView2'),
				
				appMainWindow3: $('div#appMainWindow3'),
				sidebar3: $('div#appMainWindow3').find('div#appSideBar'),
				view3: $('div#appMainWindow3').find('div#appView2'),
				
				appMainWindow4: $('div#appMainWindow4'),
				sidebar4: $('div#appMainWindow4').find('div#appSideBar'),
				view4: $('div#appMainWindow4').find('div#appView2'),

				h4Gewicht: $('h4#totaal_gewicht_ingredienten'),
				h4Prijs: $('h4#totaal_prijs_ingredienten'),
				
				samenstellenText: $('p#samenstellenText'),
				divSamenstellen: $('div#sidebar_table2_div'),
				samenstellenViewTitel: $('h1#samenstellen_view_titel'),
				
				opslaanText: $('p#opslaanText'),
				divOpslaan: $('div#opslaan'),
				opslaanViewTitel: $('h1#opslaan_view_titel'),
				
				bestelText: $('p#bestelText'),
				divBestellen: $('div#bestellen'),
				bestellenViewTitel: $('h1#bestellen_view_titel'),
				a_naarWinkelwagen: $('a#naarWinkelwagen'),
				winkelwagenHeading: $('h4#winkelwagenHeading'),
				opslaan_login: $('div#opslaan_login'),
				opslaan_logout: $('div#opslaan_logout'),
				bestellen_login: $('div#bestellen_login'),
				bestellen_logout: $('div#bestellen_logout'),
				spanNaam: $('span.name'),
				after_opslaan: $('div#after_opslaan'),
				after_bestellen: $('div#after_bestellen'),
				aangemaakt_product_id: 0,
				product_naam: '',
				quantity: 0,
				a_nav: $('div#appNavigation'),
				nav_buttons: $('div.nav_div'),
				sidebar_keuze_categorie: $('input.sidebar_keuze_categorie'),
				base_url: '<?php echo base_url(); ?>',
				opslaanButton: $('button#buttonOpslaan'),
				winkelwagenButton: $('button#winkelwagen'),
		});
		
	})( jQuery );	
</script>
<?php $this->load->view('includes/footer') ?>