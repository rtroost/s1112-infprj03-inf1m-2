<?php $this->load->view('includes/header')
?>

<link rel="stylesheet" href="<?php echo base_url();?>css/productApp.css" />
<div id="content">
	<?php
	if (isset($load)) {
		$totaalgewicht = 0;
		$totaalprijs = $rows -> standaardprijs;

		$activeArray;
		$calcedPrice;

		$jsCount = 0;
		foreach ($ingredienten as $ingredient) {
			$JSingredienten[$jsCount] = "ingredientId: '{$ingredient->catingid}', prijs100: '{$ingredient->prijs}', prijs: " . round($ingredient -> prijs * 0.75) . ", naam: '{$ingredient->naam}', gewichtspunten: '{$ingredient->gewichtspunten}', hoeveelheid: 1, gewicht: {$ingredient->gewichtspunten}, gekozen: false";
			$jsCount++;
		}

	}
	?>
	<h2>Maak product</h2><br>
	<p>
		U kunt hier uw eigen product samenstellen, bestellen en delen om korting te verdienen!
	</p>
	<br />
	<div id="productApp">
		<div id="appNavigation">
			<ul>
				<li id="1" class="activated">
					<a class="appNav" href="">1: Categorie</a>
				</li>
				<li id="2" class="overig">
					<a class="appNav" href="">2: Maken</a>
				</li>
				<li id="3" class="overig">
					<a class="appNav" href="">3: Opslaan</a>
				</li>
				<li id="4" class="overig">
					<a class="appNav" href="">4: Bestellen</a>
				</li>
				<li id="5" class="overig">
					<a class="appNav" href="">5: Delen</a>
				</li>
			</ul>
		</div>
		<div id="appMainWindow1" class="mainWindows">
			<div id="appSideBar">
				<h2>Kies een categorie</h2><br>
				<br />
				<table id="sidebar_table">
					<?php $count = 1; foreach($records as $row) :
					?>
					<tr>
						<td><img src="<?php echo base_url();?>images/productApp/<?php echo $row -> image_klein;?>" width="80px" height="70px"/></td>
						<td>
						<input class="sidebar_keuze_categorie" name="sidebar_keuze" value="<?php echo $row -> categorieid;?>" type="radio" <?php
							if (isset($load)) {
								if ($count == $rows -> categorieid) { echo "checked='checked'";
								} else { echo "disabled='disabled'";
								}
							}
 ?>
						/> <label><?php echo $row -> naam;?></label></td>
					</tr>
					<?php $count++;
						endforeach;
					?>
				</table>
				<div class="center nav_div">
					<button class="nav_button" id="vorige" style="visibility:hidden;">
						« Vorige
					</button>
					&nbsp;
					<button class="nav_button" id="volgende">
						Volgende »
					</button>
				</div>
			</div>
			<div id="appView">
				<?php if(!isset($load)){
				?>
				<h2>Product creator</h2><br>
				<p>
					Welkom bij de product ontwikkelaar. Hier kan je zelf producten maken, bestellen en delen om korting te krijgen!
				</p><br>
				U kunt de product ontwikkelaar op de volgende eenvoudige manier gebruiken:
				<p>
					<br />
					<b>1: Categorie</b> - Kies een categorie.
					<br />
					<b>2: Maken</b> - Stel je product samen.
					<br />
					<b>3: Opslaan</b> - Sla je product op.
					<br />
					<b>4: Bestellen</b> - Bestel je product.
					<br />
					<b>5: Delen</b> - Deel je product met de wereld en verdien korting!<br><br>
					
					U kunt de product ontwikkelaar alleen gebruiken als u ingelogd bent.<br><br>
					Nog niet ingelogd? Je kan hier <a href="#">inloggen</a>.<br>
					Nog niet geregistreerd? Je kan hier <a href="#">registreren</a>.
					<br />
					
					<br />
				</p>
				<?php } else {?>

				<b>U heeft gekozen voor: <?php echo $rows -> categorienaam;?></b>
				<div class="center">
					<img src="<?php echo base_url();?>images/productApp/<?php echo $rows -> categorieimg;?>" style="width: 400px; height: 300px;">
					<!-- 						http://127.0.0.1/pizzario/images/productApp/soep_groot.jpg -->
				</div>
				<?php }?>
			</div>
			<div id="appSelector">
				<?php if(isset($load)){
				?>
				<h2><?php echo $rows -> categorienaam;?></h2>
				<p>
					<?php echo $rows -> categorieomschrijving;?>
				</p>
				<?php }?>
			</div>
		</div>
		<div id="appMainWindow2" class="mainWindows">
			<div id="appSideBar">
				<h2>Product samenstellen</h2><br>
				<div <?php
					if (isset($load)) { echo 'style="display: none;"';
					}
				?>>
					<p id="samenstellenText">
						U heeft nog geen categorie gekozen.
						<br />
						Kies een categorie en probeer het opnieuw.
					</p>
				</div>
				<div id="sidebar_table2_div" <?php
					if (!isset($load)) { echo 'style="display: none;"';
					}
				?>>
					<table id="sidebar_table2" style="width: 100%;">
						<?php if(isset($load)){
						?>

						<?php $count = 1; foreach($ingredienten as $ing) :
						?>
						<td><label for="sidebar_keuze"><?php echo $ing -> naam;?></label>
						<br>
						<img src="http://127.0.0.1/pizzario/images/productApp/<?php echo $rows -> categorieid;?>/<?php echo $ing -> catingid;?>/left.png" style="float: left; height: 50px; width: 50px;">
						<input class="sidebar_keuze_ingredient" type="checkbox" name="sidebar_keuze" value="<?php echo $ing -> catingid;?>" data-arrayindex="<?php echo $count - 1;?>" style="margin-top: 20px; margin-left: 10px;" <?php
							foreach ($rows->ingredienten as $ingredient) {
								if ($ing -> naam == $ingredient -> naam) { $activeArray[] = $count - 1;
									echo "checked='checked'";
								}
							}
 ?>> </td>
						<?php
							if ($count % 2 == 0) { echo "</tr>";
							}
						?>
						<?php $count++;
							endforeach;
						?>

						<?php }?>
					</table>
				</div>
				<div class="center nav_div">
					<button class="nav_button" id="vorige">
						« Vorige
					</button>
					&nbsp;
					<button class="nav_button" id="volgende">
						Volgende »
					</button>
				</div>
			</div>
			<div id="appView2">
				<h2 id="samenstellen_view_titel" <?php
				if (!isset($load)) { echo 'style="display: none;"';
				}
 ?>>Uw product</h2><br>
				<table id="view2_table_head" <?php
					if (isset($load)) { echo 'style="display:inline;"';
					}
 ?>>
					<tr>
						<td><h4>Ingredient</h4></td>
						<td><h4>Gewicht</h4></td>
						<td><h4>Hoeveelheid</h4></td>
						<td><h4>Prijs</h4></td>
					</tr>
				</table>
				<div id="overflow" <?php
					if (!isset($load)) { echo 'style="display: none;"';
					}
 ?>>
					<table id="view2_table_main" style="display: inline;">
						<?php if(isset($load)){
						?>
						<?php $viewCounter = 0;?>
						<?php foreach ($rows->ingredienten as $ingredient) {
						?>
						<?php
						switch ($ingredient->ingredienthoeveelheid) {
							case '1' :
								$multiplier = 0.75;
								break;
							case '2' :
								$multiplier = 1;
								break;
							case '3' :
								$multiplier = 1.25;
								break;
							default :
								$multiplier = 0.75;
								break;
						}

						$prijs = round($ingredient -> prijs * $multiplier);

						if (strlen($prijs) == 3) {
							$displayPrijs = '€' . substr($prijs, 0, 1) . ',' . substr($prijs, 1);
						} else {
							$displayPrijs = '€0,' . $prijs;
						}

						$calcedPrice[] = $displayPrijs;

						$gewicht = $ingredient -> gewichtspunten * $ingredient -> ingredienthoeveelheid;

						$totaalgewicht += $gewicht;
						$totaalprijs += $prijs;

						$JSingredienten[$activeArray[$viewCounter]] = $JSingredienten[$activeArray[$viewCounter]] . ", prijs: {$prijs}, naam: '{$ingredient->naam}', gewichtspunten: '{$ingredient->gewichtspunten}', hoeveelheid: {$ingredient->ingredienthoeveelheid}, gewicht: {$gewicht}, gekozen: true";
						?>
						<tr class="<?php echo $activeArray[$viewCounter];?>">
							<td><img src="<?php echo base_url();?>images/productApp/<?php echo $rows -> categorieid;?>/<?php echo $ingredient -> catingid;?>/left.png">
							<p>
								<?php echo $ingredient -> naam;?>
							</p></td>
							<td class="totaalGewicht"><?php echo $gewicht;?></td>
							<td>
							<div class="view2buttons">
								<button <?php
								if ($ingredient -> ingredienthoeveelheid == 1) { echo "class='down'";
								}
 ?>
									data-func="1">Weinig
								</button>
								<button <?php
									if ($ingredient -> ingredienthoeveelheid == 2) { echo "class='down'";
									}
 ?>
									data-func="2">Normaal
								</button>
								<button <?php
									if ($ingredient -> ingredienthoeveelheid == 3) { echo "class='down'";
									}
 ?>
									data-func="3">Veel
								</button>
							</div></td>
							<td class="prijs"><?php echo $displayPrijs;?></td>
						</tr>
						<?php $viewCounter++;
							}
						?>

						<?php }?>
					</table>
				</div>
				<table id="view2_table_foot" cellspacing="0" <?php
					if (isset($load)) { echo 'style="display:inline;"';
					}
 ?>>
					<tr>
						<td><h4>Totaal Gewicht (max 50)</h4></td>
						<td><h4 id="totaal_gewicht_ingredienten"><?php
							if (isset($load)) { echo $totaalgewicht;
							} else { echo "0";
							}
						?></h4></td>
						<td><h4>Totaal Prijs</h4></td>
						<td><h4 id="totaal_prijs_ingredienten"><?php
							if (isset($load)) {
								if (strlen($totaalprijs) == 4) { echo '€' . substr($totaalprijs, 0, 2) . ',' . substr($totaalprijs, 2);
								} else if (strlen($totaalprijs) == 3) {	echo '€' . substr($totaalprijs, 0, 1) . ',' . substr($totaalprijs, 1);
								} else {	echo '€0,' . $totaalprijs;
								}
							} else { echo "0";
							}
						?></h4></td>
					</tr>
				</table>
			</div>
		</div>
		<div id="appMainWindow3" class="mainWindows">
			<div id="appSideBar">
				<h2>Uw product opslaan</h2><br>
				<div <?php
					if (isset($load)) { echo 'style="display: none;"';
					}
				?>>
					<p id="opslaanText">
						U heeft nog geen categorie gekozen.
						<br />
						Kies een categorie en probeer het opnieuw.
					</p>
				</div>
				<div id="opslaan" <?php
					if (!isset($load)) { echo 'style="display: none;"';
					}
				?>>
					<div id="opslaan_login" style="<?php
					if ($this -> session -> userdata('logged_in') != 1) { echo "display: none;";
					}
 ?>">
							U kunt hier uw product opslaan.
						</p><br>
						<h4>Product naam:</h4>
						<input id="product_name" type="text" style="width: 190px" name="naam" size="34" value="<?php
							if (isset($load)) { echo $rows -> naam;
							}
						?>"/>
						<br /><br>
						<p>
							Wilt u uw product publiekelijk maken?
						</p>
						<input id="product_publikelijk" type="checkbox" name="publikelijk" value="" <?php
							if (isset($load) && $rows -> publiekelijk == 1) { echo "checked='checked'";
							}
						?>
						/>
						<br />
						<button id="buttonOpslaan">
							Opslaan
						</button>
						<br />
						<br />
						<p>
							U kunt dit product en andere gemaakte producten beheren door naar de "Mijn account" pagina te gaan.
						</p>
					</div>
					<div id="opslaan_logout" style="<?php
						if ($this -> session -> userdata('logged_in') == 1) { echo "display: none;";
						}
 ?>">
						<p>
							U bent nog niet ingelogd. U hoeft uw product niet op te slaan om te kunnen bestellen, u deze stap eventueel overslaan.
						</p>
						<h4>Login:</h4>
						<form id="login_form" action="<?php echo base_url();?>index.php/user/login" method="post">
							<label for="email">Email adres: </label>
							<br />
							<input name="email" value="" type="text" />
							<br />
							<label for="password">Password: </label>
							<br />
							<input name="password" value="" type="password" />
							<br />
							<input style="background: #b8cc81;" type="submit" value="login" id="loginSubmit" />
						</form>
						<br />
						<p>
							Geen account? <a href="<?php echo base_url();?>index.php/user/register">Registeer hier</a>
						</p>
					</div>
					<div id="after_opslaan" style="display: none;">
						<p>
							U kunt de samenstelling van dit product later nog wijzigen, dit kunt u regelen op de 'Mijn account' pagina.
							<br /><br>
							U kunt nu uw product bestellen door naar de volgende stap te gaan.
						</p>
						<br />
						<!-- 							<p class="successApp">Uw product is opgeslagen</p> -->
					</div>
				</div>
				<div class="center nav_div">
					<button class="nav_button" id="vorige">
						« Vorige
					</button>
					&nbsp;
					<button class="nav_button" id="volgende">
						Volgende »
					</button>
				</div>
			</div>
			<div id="appView2">
				<h2 id="opslaan_view_titel" <?php
				if (!isset($load)) { echo 'style="display: none;"';
				}
			?>>Uw product</h2><br>
				<table id="view3_table_head" <?php
					if (isset($load)) { echo 'style="display:inline;"';
					}
 ?>>
					<tr>
						<td><h4>Ingredient</h4></td>
						<td><h4>Hoeveelheid</h4></td>
						<td><h4>Prijs</h4></td>
					</tr>
				</table>
				<div id="overflow" <?php
					if (!isset($load)) { echo 'style="display: none;"';
					}
				?>>
					<table id="view3_table_main" style="display: inline;">
						<?php if(isset($load)){
						?>
						<?php $view2Counter = 0; foreach ($rows->ingredienten as $ingredient) {
						?>
						<tr class="<?php echo $activeArray[$view2Counter];?>">
							<td><img src="<?php echo base_url();?>images/productApp/<?php echo $rows -> categorieid;
							;
 ?>/<?php echo $ingredient -> catingid;?>/left.png">
							<p>
								<?php echo $ingredient -> naam;?>
							</p></td>
							<td>
							<p id="view3Hoeveelheid">
								<?php
								if ($ingredient -> ingredienthoeveelheid == 1) { echo "Weinig";
								} elseif ($ingredient -> ingredienthoeveelheid == 2) { echo "Normaal";
								} else { echo "Veel";
								}
								?>
							</p></td>
							<td class="prijs"><?php echo $calcedPrice[$view2Counter];?></td>
						</tr>
						<?php $view2Counter++;
							}
						?>
						<?php }?>
					</table>
				</div>
				<table id="view2_table_foot" cellspacing="0" <?php
					if (isset($load)) { echo 'style="display:inline;"';
					}
 ?>>
					<tr>
						<td><h4>Totaal Gewicht (max 20)</h4></td>
						<td><h4 id="totaal_gewicht_ingredienten"><?php
							if (isset($load)) { echo $totaalgewicht;
							} else { echo "0";
							}
						?></h4></td>
						<td><h4>Totaal Prijs</h4></td>
						<td><h4 id="totaal_prijs_ingredienten"><?php
							if (isset($load)) {
								if (strlen($totaalprijs) == 4) { echo '€' . substr($totaalprijs, 0, 2) . ',' . substr($totaalprijs, 2);
								} else if (strlen($totaalprijs) == 3) {	echo '€' . substr($totaalprijs, 0, 1) . ',' . substr($totaalprijs, 1);
								} else {	echo '€0,' . $totaalprijs;
								}
							} else { echo "0";
							}
						?></h4></td>
					</tr>
				</table>
			</div>
		</div>
		<div id="appMainWindow4" class="mainWindows">
			<div id="appSideBar">
				<h2>Uw product bestellen</h2><br>
				<div <?php
					if (isset($load)) { echo 'style="display: none;"';
					}
				?>>
					<p id="bestelText">
						U heeft nog geen categorie gekozen.
						<br />
						Kies een categorie en probeer het opnieuw.
					</p>
				</div>
				<div id="bestellen" <?php
					if (!isset($load)) { echo 'style="display: none;"';
					}
				?>>
					<div id="bestellen_login" style="<?php
					if ($this -> session -> userdata('logged_in') != 1) { echo "display: none;";
					}
 ?>">
							Uw product is nog niet opgeslagen. Ga naar de "Opslaan" pagina om uw product opgeslaan
						</p>
					</div>
					<div id="bestellen_logout" style="<?php
						if ($this -> session -> userdata('logged_in') == 1) { echo "display: none;";
						}
 ?>">
						<p>
							Bedankt voor het maken van een product.<br><br> U kunt uw product nu in uw winkelwagen plaatsen.<br><br> Daarna kunt u naar uw winkelwagen gaan om uw product te bestellen.<br><br>
						</p>
						<h5>Aantal</h5>
						<input id="qty" type="text" name="qty" value="1"/><br><br>
						<button id="winkelwagen" data-after="false">
							In winkelwagen
						</button>
						<br />
						<h4 id="winkelwagenHeading" class="successApp" data-after="false" style="display: none;">Uw bestelling is geplaatst</h4>
						<a id="naarWinkelwagen" data-after="false" href="<?php echo base_url();?>index.php/cart" style="display: none;">Naar uw Winkelwagen</a>
					</div>
					<div id="after_bestellen" style="display: none;">
						<p>
							Bedankt voor het maken van een product.<br><br> U kunt uw product nu in uw winkelwagen plaatsen.<br><br> Daarna kunt u naar uw winkelwagen gaan om uw product te bestellen.<br><br>
						</p>
						<h5>Aantal</h5>
						<input id="qty" type="text" name="qty" value="1"/><br><br>
						<button id="winkelwagen" data-after="true">
							In winkelwagen
						</button>
						<br />
						<h4 id="winkelwagenHeading" class="successApp" data-after="true" style="display: none;">Uw bestelling is geplaatst</h4>
						<a id="naarWinkelwagen" data-after="true" href="<?php echo base_url();?>index.php/cart" style="display: none;">Naar uw Winkelwagen</a>
					</div>
				</div>
				<div class="center nav_div">
					<button class="nav_button" id="vorige">
						« Vorige
					</button>
					&nbsp;
					<button class="nav_button" id="volgende">
						Volgende »
					</button>
				</div>
			</div>
			<div id="appView2">
				<h2 id="bestellen_view_titel" <?php
				if (!isset($load)) { echo 'style="display: none;"';
				}
			?>>Uw product</h2><br>
				<table id="view3_table_head" <?php
					if (isset($load)) { echo 'style="display:inline;"';
					}
 ?>>
					<tr>
						<td><h4>Ingredient</h4></td>
						<td><h4>Hoeveelheid</h4></td>
						<td><h4>Prijs</h4></td>
					</tr>
				</table>
				<div id="overflow" <?php
					if (!isset($load)) { echo 'style="display: none;"';
					}
				?>>
					<table id="view3_table_main" style="display: inline;">
						<?php if(isset($load)){
						?>
						<?php $view2Counter = 0; foreach ($rows->ingredienten as $ingredient) {
						?>
						<tr class="<?php echo $activeArray[$view2Counter];?>">
							<td><img src="<?php echo base_url();?>images/productApp/<?php echo $rows -> categorieid;
							;
 ?>/<?php echo $ingredient -> catingid;?>/left.png">
							<p>
								<?php echo $ingredient -> naam;?>
							</p></td>
							<td>
							<p id="view3Hoeveelheid">
								<?php
								if ($ingredient -> ingredienthoeveelheid == 1) { echo "Weinig";
								} elseif ($ingredient -> ingredienthoeveelheid == 2) { echo "Normaal";
								} else { echo "Veel";
								}
								?>
							</p></td>
							<td class="prijs"><?php echo $calcedPrice[$view2Counter];?></td>
						</tr>
						<?php $view2Counter++;
							}
						?>
						<?php }?>
					</table>
				</div>
				<table id="view2_table_foot" cellspacing="0" <?php
					if (isset($load)) { echo 'style="display:inline;"';
					}
 ?>>
					<tr>
						<td><h4>Totaal Gewicht (max 20)</h4></td>
						<td><h4 id="totaal_gewicht_ingredienten"><?php
							if (isset($load)) { echo $totaalgewicht;
							} else { echo "0";
							}
						?></h4></td>
						<td><h4>Totaal Prijs</h4></td>
						<td><h4 id="totaal_prijs_ingredienten"><?php
							if (isset($load)) {
								if (strlen($totaalprijs) == 4) { echo '€' . substr($totaalprijs, 0, 2) . ',' . substr($totaalprijs, 2);
								} else if (strlen($totaalprijs) == 3) {	echo '€' . substr($totaalprijs, 0, 1) . ',' . substr($totaalprijs, 1);
								} else {	echo '€0,' . $totaalprijs;
								}
							} else { echo "0";
							}
						?></h4></td>
					</tr>
				</table>
			</div>
		</div>
		<div id="appMainWindow5" class="mainWindows">
			<div id="appSideBar">
				<h2>Uw product delen</h2><br>
				<div <?php
					if (isset($load)) { echo 'style="display: none;"';
					}
				?>>
					<p id="bestelText">
						U heeft nog geen categorie gekozen.
						<br />
						Kies een categorie en probeer het opnieuw.
					</p>
				</div>
				<div id="delen" <?php
					if (!isset($load)) { echo 'style="display: none;"';
					}
				?>>
					<div id="delen_login" style="<?php
					if ($this -> session -> userdata('logged_in') != 1) { echo "display: none;";
					}
 ?>">
							<br />
							Uw product is nog niet opgeslagen. Ga naar de "Opslaan" pagina om uw product op te slaan.
						</p>
					</div>
					<div id="delen_logout" style="<?php
						if ($this -> session -> userdata('logged_in') == 1) { echo "display: none;";
						}
 ?>">
						<p>
							U kunt uw product niet delen als u niet ingelogged bent.
						</p>
					</div>
					<div id="after_delen" style="display: none;">
						<p>
							Je kan hier je aangemaakte product delen op uw favoriete social media sites.
						</p>
					</div>
				</div>
				<div class="center nav_div">
					<button class="nav_button" id="vorige">
						« Vorige
					</button>
					&nbsp;
					<button class="nav_button" id="volgende" style="visibility:hidden;">
						Volgende »
					</button>
				</div>
			</div>
			<div id="appView2">
				<div id="after_delen" style="display: none;"></div>
			</div>
		</div>
	</div>
	<br />
</div>
<script src="http://cloud.github.com/downloads/wycats/handlebars.js/handlebars-1.0.0.beta.6.js"></script>
<script src="<?php echo base_url();?>js/jquery.json-2.3.js"></script>
<script src="<?php echo base_url();?>js/jquery.numeric.js"></script>
<script src="<?php echo base_url();?>js/createApp_script.js"></script>
<script>
		(function( $ ){
			$('input#qty').numeric();

			CreateApp.init({
				<?php 	if ($this -> session -> userdata('logged_in') == 1) {
					echo "loginData: {
						achternaam: '{$this->session->userdata('achternaam')}',
						email: '{$this->session->userdata('email')}',
						gebruikerid: '{$this->session->userdata('gebruikerid')}',
						logged_in: {$this->session->userdata('logged_in')},
						type: '{$this->session->userdata('typeid')}',
						voornaam: '{$this->session->userdata('voornaam')}'
					},";
				} else {
					echo "loginData: {},";
				}	?>
				opgeslagen: 0,<?php if(isset($load)){ ?>
				ingredienten: [<?php  $javascriptCounter = 0;
					foreach ($JSingredienten as $JSing) { echo '{' . $JSing . "},";
						$javascriptCounter++;
					}	?>	],
				gekozenCategorie: <?php echo $rows -> categorieid;?>,
				totaalGewicht: <?php echo $totaalgewicht;?>,
				totaalPrijs: <?php echo $totaalprijs;?>,
				load: true,
				product_id: <?php echo $rows -> productid;?>,
				wasPubliekelijk:
		 		<?php
				if ($rows -> publiekelijk == 1) {
					echo "true";
				} else {
					 echo "false";
				}
				?>,
				<?php } else {?>
					ingredienten: [],
					gekozenCategorie: 0,
					totaalGewicht: 0,
					totaalPrijs: 0,
					load: false,
					product_id: 0,
					wasPubliekelijk: false,
				<?php }?>
				pagenr: 1,
				appNavigationUl: $('div#appNavigation ul'),
		
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
		
				appMainWindow5: $('div#appMainWindow5'),
		
				h4Gewicht: $('h4#totaal_gewicht_ingredienten'),
				h4Prijs: $('h4#totaal_prijs_ingredienten'),
		
				samenstellenText: $('p#samenstellenText'),
				divSamenstellen: $('div#sidebar_table2_div'),
				samenstellenViewTitel: $('h2#samenstellen_view_titel'),
		
				opslaanText: $('p#opslaanText'),
				divOpslaan: $('div#opslaan'),
				opslaanViewTitel: $('h2#opslaan_view_titel'),
		
				bestelText: $('p#bestelText'),
				divBestellen: $('div#bestellen'),
				divDelen: $('div#delen'),
				bestellenViewTitel: $('h2#bestellen_view_titel'),
				a_naarWinkelwagen: $('a#naarWinkelwagen'),
				winkelwagenHeading: $('h4#winkelwagenHeading'),
				opslaan_login: $('div#opslaan_login'),
				opslaan_logout: $('div#opslaan_logout'),
				bestellen_login: $('div#bestellen_login'),
				bestellen_logout: $('div#bestellen_logout'),
				delen_login: $('div#delen_login'),
				delen_logout: $('div#delen_logout'),
				spanNaam: $('span.name'),
				after_opslaan: $('div#after_opslaan'),
				after_bestellen: $('div#after_bestellen'),
				after_delen: $('div#after_delen'),
				product_naam: '',
				quantity: 0,
				a_nav: $('div#appNavigation'),
				nav_buttons: $('div.nav_div'),
				sidebar_keuze_categorie: $('input.sidebar_keuze_categorie'),
				base_url: '<?php echo base_url();?>		',
				opslaanButton: $('button#buttonOpslaan'),
				winkelwagenButton: $('button#winkelwagen'),
				facebook: $('div#facebook'),
				twitter: $('iframe'),
				maxGewicht: 50
			});

		})( jQuery );
</script>
<?php $this -> load -> view('includes/footer');?>