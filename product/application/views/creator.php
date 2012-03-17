<?php $this->load->view('includes/header') ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>css/productApp.css" />
	<div id="content">
		
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
						<?php foreach($records as $row) : ?>
						<tr>
							<td><img src="<?php echo base_url(); ?>images/productApp/<?php echo $row->image_klein; ?>" width="80px" height="70px"/></td>
							<td>
								<input class="sidebar_keuze_categorie" name="sidebar_keuze" value="<?php echo $row->categorieid; ?>" type="radio" />
								<label><?php echo $row->naam; ?></label>
							</td>
						</tr>
						<?php endforeach; ?>
					</table>
					
					<div class="center nav_div">
						<button class="nav_button" id="vorige" style="visibility:hidden;"> « Vorige </button>
						 &nbsp; <button class="nav_button" id="volgende"> Volgende » </button>
					</div>
					
				</div>
				<div id="appView">
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
				</div>
				<div id="appSelector">
					<!-- <h1>Pizza</h1>
					<p>Bij PizzaRio kunt u uw pizza rijkelijk beleggen met de verste ingredienten. De prijs zal varieren tussen €2,00 en €6,00.</p> -->
				</div>
				
			</div>
			<div id="appMainWindow2" class="mainWindows">
				<div id="appSideBar">
					<h1>Product samenstellen</h1>
					<p id="samenstellenText">U heeft nog geen categorie gekozen.<br /> Maak een product aan en probeer het opnieuw.</p>
					<br />
					<div id="sidebar_table2_div" style="display: none;">
						<table id="sidebar_table2">
						</table>
					</div>
					<div class="center nav_div">
						<button class="nav_button" id="vorige"> « Vorige </button>
						 &nbsp; <button class="nav_button" id="volgende"> Volgende » </button>
					</div>
				</div>
				<div id="appView2">
					<h1 id="samenstellen_view_titel" style="display:none;">Uw product:</h1>
					<table id="view2_table_head">
						<tr>
							<td><h4>Ingredient</h4></td>
							<td><h4>Gewicht</h4></td>
							<td><h4>Hoeveelheid</h4></td>
							<td><h4>Prijs</h4></td>
						</tr>
					</table>
					<div id="overflow" style="display:none;">
						<table id="view2_table_main">
						</table>
					</div>
					<table id="view2_table_foot" cellspacing="0">
						<tr>
							<td><h4>Totaal Gewicht (max 20)</h4></td>
							<td><h4 id="totaal_gewicht_ingredienten">0</h4></td>
							<td><h4>Totaal Prijs</h4></td>
							<td><h4 id="totaal_prijs_ingredienten">0</h4></td>
						</tr>
					</table>
				</div>
			</div>
			<div id="appMainWindow3" class="mainWindows">
				<div id="appSideBar">
					<h1>Uw product opslaan</h1>
					<p id="opslaanText">U heeft nog geen categorie gekozen.<br /> Maak een product aan en probeer het opnieuw.</p>
					<div id="opslaan" style="display:none;">
						<div id="opslaan_login" style="<?php if($this->session->userdata('logged_in') != 1){ echo "display: none;"; } ?>">
							<p>Hallo <span class="name"><?php if($this->session->userdata('voornaam')){ echo $this->session->userdata('voornaam'); } ?></span>, <br />
								U kan hier uw product opslaan in uw profiel
							</p>
							
							<h4>Product naam:</h4>
							<input id="product_name" type="text" name="naam" value=""/><br />
							<p>Wilt u uw product publikelijk maken?</p>
							<input id="product_publikelijk" type="checkbox" name="publikelijk" value=""/>
							<br />
							
							<button id="buttonOpslaan">Opslaan</button><br /><br />
							
							<p>U kunt dit product en andere gemaakte producten beheren door maar "Mijn profiel" te gaan.</p>
						</div>	
						<div id="opslaan_logout" style="<?php if($this->session->userdata('logged_in') == 1){ echo "display: none;"; } ?>">
							<p>U bent nog niet ingelogd. U hoeft uw product niet opteslaan om te kunnen bestellen, u kunt dan deze stap overslaan.</p>
							<h4>Login:</h4>
							<form id="login_form" action="<?php echo base_url();?>index.php/login" method="post">
								<label for="username">Username: </label>
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
					<h1 id="opslaan_view_titel" style="display:none;">Uw product:</h1>
					<table id="view3_table_head">
						<tr>
							<td><h4>Ingredient</h4></td>
							<td><h4>Hoeveelheid</h4></td>
							<td><h4>Prijs</h4></td>
						</tr>
					</table>
					<div id="overflow" style="display:none;">
						<table id="view3_table_main">
						</table>
					</div>
					<table id="view2_table_foot" cellspacing="0">
						<tr>
							<td><h4>Totaal Gewicht (max 20)</h4></td>
							<td><h4 id="totaal_gewicht_ingredienten">0</h4></td>
							<td><h4>Totaal Prijs</h4></td>
							<td><h4 id="totaal_prijs_ingredienten">0</h4></td>
						</tr>
					</table>
				</div>
			</div>
			<div id="appMainWindow4" class="mainWindows">
				<div id="appSideBar">
					<h1>Uw product bestellen</h1>
					<p id="bestelText">U heeft nog geen categorie gekozen.<br /> Maak een product aan en probeer het opnieuw.</p>
					<div id="bestellen" style="display:none;">
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
					<h1 id="bestellen_view_titel" style="display:none;">Uw product:</h1>
					<table id="view3_table_head">
						<tr>
							<td><h4>Ingredient</h4></td>
							<td><h4>Hoeveelheid</h4></td>
							<td><h4>Prijs</h4></td>
						</tr>
					</table>
					<div id="overflow" style="display:none;">
						<table id="view3_table_main">
						</table>
					</div>
					<table id="view2_table_foot" cellspacing="0">
						<tr>
							<td><h4>Totaal Gewicht (max 20)</h4></td>
							<td><h4 id="totaal_gewicht_ingredienten">0</h4></td>
							<td><h4>Totaal Prijs</h4></td>
							<td><h4 id="totaal_prijs_ingredienten">0</h4></td>
						</tr>
					</table>
				</div>
			</div>
			
			
		</div>
		<br />
	</div>
	
	<script src="<?php echo base_url(); ?>js/jquery.json-2.3.js"></script>
	<script src="<?php echo base_url(); ?>js/jquery.numeric.js"></script>
	
	<script>
		
		 // $this -> load -> library('cart');
//   
		  // $this->cart->destroy();
// 		
		  // /** Test cookie data */
		  // $data = array(
		               // array(
		                       // 'id'      => 1,
		                       // 'qty'     => 1,
		                       // 'price'  => 1.00,
		                       // 'name'  => 'sdf'
		                    // ),
		                // array(
		                       // 'id'      => 2,
		                       // 'qty'     => 3,
		                       // 'price'  => 5.00,
		                       // 'name'  => 'Pizza Kuttelienie'
		                    // )
		        // );
// 		
		  // $this->cart->insert($data);
		
		
		
		
		
		// $('button#setcookie').on('click', function(){
			// $.cookie('koekje_test', [id= 2, qty= 1, price=1.00, name='pizza of awesomeness'], { expires: 1});
		// });
// 		
		// $('button#unsetcookie').on('click', function(){
			// $.cookie('koekje_test', null);
		// });
		
		
		
		
		(function( $ ){

			// FUNCTION VARIABELEN
			vars = {
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
				pagenr: 1,
				appNavigationUl: $('div#appNavigation ul'),
				gekozenCategorie: 0,
				ingredienten: [],
				totaalGewicht: 0,
				totaalPrijs: 0,
				sidebar1: $('div#appMainWindow1').find('div#appSideBar'),
				view1: $('div#appMainWindow1').find('div#appView'),
				selector1: $('div#appMainWindow1').find('div#appSelector'),
				
				sidebar2: $('div#appMainWindow2').find('div#appSideBar'),
				view2: $('div#appMainWindow2').find('div#appView2'),
				
				sidebar3: $('div#appMainWindow3').find('div#appSideBar'),
				view3: $('div#appMainWindow3').find('div#appView2'),
				
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
				quantity: 0
			};
			
			console.log(vars.loginData);
			
			$('input#qty').numeric();

			
			// Navigation script
			$('a.appNav').on('click', function(e){
				
				var li = $(this).parent('li');
				vars.pagenr = parseInt(li.attr('id'));
				
				li.removeClass().addClass('activated')
				.siblings().removeClass().addClass('overig')
				.end()
				.prev().removeClass().addClass('yellow');
				
				changeMainWindow.load();
				e.preventDefault();
			});
			
			$('button#vorige').on('click', function(){
				vars.pagenr -= 1;
				changeMainWindow.load();
				vars.appNavigationUl.find('li.activated')
				.removeClass().addClass('overig')
				.prev().removeClass().addClass('activated')
				.prev().removeClass().addClass('yellow');
			});
			$('button#volgende').on('click', function(){
				vars.pagenr += 1;
				changeMainWindow.load();
				vars.appNavigationUl.find('li.activated')
				.removeClass().addClass('yellow')
				.next().removeClass().addClass('activated')				
				.end()
				.prev().removeClass().addClass('overig');
			});
			// END Navigation script
			
			$('button#winkelwagen').on('click', function(){
				$this = $(this);
				if(vars.product_naam === ''){
					vars.product_naam = 'product zonder naam';
				}
				var qtyVal = $(this).siblings('#qty').attr('value');
				if(qtyVal === ''){
					vars.quantity = 1;
				} else {
					vars.quantity = qtyVal;
				}
				
				if($this.data('after')){
					insertCart($this);
				} else {
					console.log(vars.product_naam);
					formData = createFormData();
					console.log(formData);
					$.ajax({
						url: '<?php echo base_url(); ?>index.php/product_cont/save_product',
						type: 'POST',
						data: formData,  // q=d&test=hallo
						success: function(results) {
							if(results !== 'failed'){
								vars.sidebar1.find('.sidebar_keuze_categorie').attr('disabled', 'disabled');
								vars.sidebar2.find('.sidebar_keuze_ingredient').attr('disabled', 'disabled');
								vars.view2.find('div.view2buttons button').attr('disabled', 'disabled');
								vars.sidebar3.find('input#loginSubmit').attr('disabled', 'disabled');
								vars.aangemaakt_product_id = results;
								console.log(results);
								console.log(vars.aangemaakt_product_id);
								insertCart($this);
							} else {
								//error
							}
						}
					});
				}				
			});
			
			var insertCart = function(obj){
				$.ajax({
						url: '<?php echo base_url(); ?>index.php/product_cont',
						type: 'POST',
						data: {id: vars.aangemaakt_product_id, qty: vars.quantity, price: vars.totaalPrijs, name: vars.product_naam},
						success: function(result){
							if(result === 'success'){
								vars.winkelwagenHeading.show();
								vars.a_naarWinkelwagen.show();
								
								obj.siblings('#qty').remove();
								obj.siblings('h5').remove();
								obj.remove();
							} else {
								vars.winkelwagenHeading.text('bestellen is mislukt').show();
							}
						}
				});
			}
			
			
			$('input.sidebar_keuze_categorie').on('change', function(){
				var thisId = $(this).attr('value');
				changeContent.categorie_content_change(thisId);
				vars.gekozenCategorie = thisId;
			});
			
			$('div#appMainWindow2 #sidebar_table2').on('click', 'input', function(e){
				//e.preventDefault();
				var $this = $(this),
					id = $this.attr('data-arrayIndex');


			 if((parseInt(vars.totaalGewicht) +parseInt(vars.ingredienten[id].gewichtspunten)) > 20){
					console.log('stop');
					if(vars.ingredienten[$this.attr('data-arrayIndex')].gekozen && vars.view2.find('table#view2_table_main tr.' + id).length == 1){
						console.log('del');
						vars.ingredienten[$this.attr('data-arrayIndex')].gekozen = !vars.ingredienten[$this.attr('data-arrayIndex')].gekozen;
						changeContent.createIngredient(id, vars.ingredienten[$this.attr('data-arrayIndex')].gekozen, e);
					} else {
					console.log('stopstop');
						e.preventDefault();
						return;
					}
				} else {						vars.ingredienten[$this.attr('data-arrayIndex')].gekozen = !vars.ingredienten[$this.attr('data-arrayIndex')].gekozen;						changeContent.createIngredient(id, vars.ingredienten[$this.attr('data-arrayIndex')].gekozen, e);
				}
				
			});
			
			$('input#loginSubmit').on('click', function(e){
				$this = $(this);
				$.ajax({
					url: $this.parent('form').attr('action'),
					type: $this.parent('form').attr('method'),
					data: $this.parent('form').serialize(),  // q=d&test=hallo
					dataType: 'json',
					success: function(results) {
						if(results !== 'failed'){
							console.log(results);
							console.log(results.logged_in);
							console.log(results.type);
							vars.loginData = {
								achternaam: results.achternaam,
								email: results.email,
								gebruikerid: results.gebruikerid,
								logged_in: results.logged_in,
								type: results.type,
								voornaam: results.voornaam
							}
							console.log(vars.loginData);
							vars.spanNaam.text(vars.loginData.voornaam);
							vars.opslaan_login.show();
							vars.opslaan_logout.hide();
							vars.bestellen_login.show();
							vars.bestellen_logout.hide();
							$('div#inlog_false').hide();
							$('div#inlog_true').show();
						} else {
							if(vars.sidebar3.find('h5#loginFlaseText').length === 0){
								$('<h5>', {
									text: 'Username en password combinatie verkeerd',
									style: 'color: red;',
									id: 'loginFlaseText'
								}).insertAfter(vars.sidebar3.find('form#login_form'));
							}
						}
					}
				});
				e.preventDefault();
			});
			
			var createFormData = function(){
				var gekozenCount = 0;
				var publikelijk;
				if($('input#product_publikelijk').attr('checked') == 'checked'){
					publikelijk = 1;
				} else {
					publikelijk = 0;
				}
				var formData = 'gebruikerid='+vars.loginData.gebruikerid+'&publiekelijk='+publikelijk+'&productNaam='+vars.product_naam+'&categorieid='+vars.gekozenCategorie;
				for(var i = 0; i < vars.ingredienten.length; i++){
					if(vars.ingredienten[i].gekozen){
						gekozenCount++;
						formData = formData.concat('&ingredientid'+gekozenCount+'='+vars.ingredienten[i].ingredientId+
						'&hoeveelheid'+gekozenCount+'='+vars.ingredienten[i].hoeveelheid);
					}
				}
				formData = formData.concat('&aantalingredienten='+gekozenCount);
				if(vars.loginData.logged_in){
					formData = formData.concat('&logged_in=true');
				} else {
					formData = formData.concat('&logged_in=false');
				}
				
				return formData;
			};
			
			$('button#buttonOpslaan').on('click', function(){
				vars.product_naam = $('input#product_name').attr('value');
				formData = createFormData();
				console.log(formData);
				
				$.ajax({
					url: '<?php echo base_url(); ?>index.php/product_cont/save_product',
					type: 'POST',
					data: formData,  // q=d&test=hallo
					success: function(results) {
						if(results !== 'failed'){
							vars.opslaan_login.hide();
							vars.bestellen_login.hide();
							vars.after_opslaan.show();
							vars.after_bestellen.show();
							vars.sidebar1.find('.sidebar_keuze_categorie').attr('disabled', 'disabled');
							vars.sidebar2.find('.sidebar_keuze_ingredient').attr('disabled', 'disabled');
							vars.view2.find('div.view2buttons button').attr('disabled', 'disabled');
							vars.aangemaakt_product_id = results;
						}
					}
				});
			});
			
			//=================================================================
			// changeMainWindow verzameling
			var changeMainWindow = {
				
				load: function(){
					if(vars.pagenr == 1){
						$('div#appMainWindow1').show()
						.siblings('.mainWindows').hide();
					} else if(vars.pagenr == 2){
						$('div#appMainWindow2').show()
						.siblings('.mainWindows').hide();
					} else if(vars.pagenr == 3){
						$('div#appMainWindow3').show()
						.siblings('.mainWindows').hide();
					} else {
						$('div#appMainWindow4').show()
						.siblings('.mainWindows').hide();
					}
				},
				
			}
			// END changeMainWindow verzameling
			//=================================================================
			
			//=================================================================
			// changeContent verzameling
			var changeContent = {
				
				setPriceFirst: function(id){
					if(String(vars.ingredienten[id].prijs).length == 2){
						return '€0,' + String(vars.ingredienten[id].prijs);
					} else {
						return '€' + String(vars.ingredienten[id].prijs).substring(0,1) + ',' + String(vars.ingredienten[id].prijs).substring(1);
					}
				},
				
				setPrice: function(id){
					if(String(vars.totaalPrijs).length == 3){
						vars.h4Prijs.text('€' + String(vars.totaalPrijs).substring(0,1) + ',' + String(vars.totaalPrijs).substring(1));
					} else {
						vars.h4Prijs.text('€' + String(vars.totaalPrijs).substring(0,2) + ',' + String(vars.totaalPrijs).substring(2));
					}
					if(id){
						if(String(vars.ingredienten[id].prijs).length == 2){
							var string = '€0,' + String(vars.ingredienten[id].prijs);
						} else {
							var string = '€' + String(vars.ingredienten[id].prijs).substring(0,1) + ',' + String(vars.ingredienten[id].prijs).substring(1);
						}
						vars.view2.find('tr.'+id).children('.prijs').text(string);
						vars.view3.find('table#view3_table_main tr.'+id).children('.prijs').text(string);
						vars.view4.find('table#view3_table_main tr.'+id).children('.prijs').text(string);
					} 
				},
				
				categorie_content_change: function(value){
					
					$.ajax({
						url: '<?php echo base_url(); ?>index.php/product_cont/ajax_getId',
						type: 'POST',
						data: {id: value, ajax: '1'},
						success: function(msg){

							var records = $.evalJSON( msg ).records;
							var ingredienten = $.evalJSON( msg ).ingredienten;
							
							var count = 0;
							var tr;
							
							vars.samenstellenText.remove();
							vars.divSamenstellen.show();
							vars.samenstellenViewTitel.show();
							
							vars.opslaanText.remove();
							vars.divOpslaan.show();
							vars.opslaanViewTitel.show();
							
							vars.bestelText.remove();
							vars.divBestellen.show();
							vars.bestellenViewTitel.show();
							
							vars.sidebar2.find('table').empty();
							vars.totaalGewicht = 0;
							vars.h4Gewicht.text(vars.totaalGewicht);
							vars.totaalPrijs = parseInt(records[0].standaardprijs);
							changeContent.setPrice();
							
							vars.view2.find('table#view2_table_main').empty();
							vars.view3.find('table#view3_table_main').empty();
							vars.view4.find('table#view3_table_main').empty();
							vars.ingredienten = [];
							
							for ( property in ingredienten ){
								vars.ingredienten[count] = {
									ingredientId: ingredienten[count].ingredientid,
									prijs100: ingredienten[count].prijs,
									prijs: Math.round(ingredienten[count].prijs*0.75),
									naam: ingredienten[count].naam,
									gewichtspunten: ingredienten[count].gewichtspunten,
									hoeveelheid: 1,
									gewicht: parseInt(ingredienten[count].gewichtspunten),
									gekozen: false
								}
								
								if(count % 2 == 0){
									tr = $('<tr>').appendTo(vars.sidebar2.find('table'));
								}
								
								var td = $('<td>').appendTo(tr);
								
								$('<label>', {
									for: 'sidebar_keuze',
									text: vars.ingredienten[count].naam,
								}).appendTo(td);
								
								$('<br />').appendTo(td);
								
								$('<img>', {
									src: 'http://127.0.0.1/pizzario/images/productApp/' + vars.gekozenCategorie + '/' + ingredienten[count].ingredientid + '/left.png',
									width: 50,
									height: 50,
									style: 'float: left; height: 50px; width: 50px;',
								}).appendTo(td);
								
								$('<input>', {
									class: 'sidebar_keuze_ingredient',
									name: 'sidebar_keuze',
									value: vars.ingredienten[count].ingredientId,
									'data-arrayIndex': count,
									type: 'checkbox',
									style: 'margin-top: 20px; margin-left: 10px;',
								}).appendTo(td);
								count++;
							} 
							
							// aanpassingen aan div1
								vars.view1.empty();
								vars.selector1.empty();

									$('<h1>', {
										text: 'U heeft gekozen voor: ' + records[0].naam,
									}).appendTo(vars.view1);
									
									var div = $('<div>', {
										class: 'center',
									}).appendTo(vars.view1);
									
									$('<img>', {
										src: 'http://127.0.0.1/pizzario/images/productApp/' + records[0].image_groot,
										width: 400,
										height: 300,
									}).appendTo(div);

									$('<h1>', {
										text: records[0].naam,
									}).appendTo(vars.selector1);
									$('<p>', {
										text: records[0].omschrijving,
									}).appendTo(vars.selector1);
							// end aanpassingen aan div1

								vars.view2.find('table').show();
								vars.view3.find('table').show();
								vars.view4.find('table').show();
							
						}
					});
				},
				
				createIngredient: function(id, bool, e){
					
					if(bool){
						
						vars.view2.find('div#overflow').show();
						vars.view3.find('div#overflow').show();
						vars.view4.find('div#overflow').show();
						
						var tr = $('<tr>', {class: id}).appendTo(vars.view2.find('table#view2_table_main')),
						 	td1 = $('<td>').appendTo(tr),
							//td2 = $('<td>', { text: vars.ingredienten[id].gewichtspunten }).appendTo(tr),
							td2 = $('<td>', { text: (vars.ingredienten[id].gewicht), class: 'totaalGewicht'}).appendTo(tr),
							td3 = $('<td>').appendTo(tr),
						 	td4 = $('<td>', { text: changeContent.setPriceFirst(id), class: 'prijs'}).appendTo(tr),
						 	
						 	tr2 = $('<tr>', {class: id}).appendTo(vars.view3.find('table#view3_table_main')),
						 	td1tr2 = $('<td>').appendTo(tr2),
						 	td2tr2 = $('<td>').appendTo(tr2),
						 	td3tr2 = $('<td>', {text: changeContent.setPriceFirst(id), class: 'prijs'}).appendTo(tr2),
						 	tr3 = $('<tr>', {class: id}).appendTo(vars.view4.find('table#view3_table_main')),
						 	td1tr3 = $('<td>').appendTo(tr3),
						 	td2tr3 = $('<td>').appendTo(tr3),						
						 	td3tr3 = $('<td>', {text: changeContent.setPriceFirst(id), class: 'prijs'}).appendTo(tr3);						
						
						$('<img>', { 
							src: 'http://127.0.0.1/pizzario/images/productApp/' + vars.gekozenCategorie + '/' + vars.ingredienten[id].ingredientId + '/left.png'
						}).appendTo(td1);
						$('<p>', { text: vars.ingredienten[id].naam }).appendTo(td1);
						
						$('<img>', { 
							src: 'http://127.0.0.1/pizzario/images/productApp/' + vars.gekozenCategorie + '/' + vars.ingredienten[id].ingredientId + '/left.png'
						}).appendTo(td1tr2);
						$('<p>', { text: vars.ingredienten[id].naam }).appendTo(td1tr2);
						
						
						
						$('<img>', { 
							src: 'http://127.0.0.1/pizzario/images/productApp/' + vars.gekozenCategorie + '/' + vars.ingredienten[id].ingredientId + '/left.png'
						}).appendTo(td1tr3);
						$('<p>', { text: vars.ingredienten[id].naam }).appendTo(td1tr3);
						
						$('<p>', { id: 'view3Hoeveelheid', text: 'Wijnig'}).appendTo(td2tr2);
						$('<p>', { id: 'view4Hoeveelheid', text: 'Wijnig'}).appendTo(td2tr3);
						
						var divButtons = $('<div>', {class: 'view2buttons'}).appendTo(td3).on('click', 'button', function(){
							var $this = $(this);
							if($this.attr('class') === 'down'){ return; }
							var	tr = $this.parents('tr'),
								id = tr.attr('class'),
								dataFunc = $this.attr('data-func'),
								view3Hoeveelheid = vars.view3.find('table#view3_table_main tr.'+id).find('p#view3Hoeveelheid'),
								view4Hoeveelheid = vars.view4.find('table#view3_table_main tr.'+id).find('p#view4Hoeveelheid');
							if(vars.ingredienten[id].gewichtspunten != 0){
								var huidigGewichtPunt = vars.ingredienten[id].gewicht/vars.ingredienten[id].gewichtspunten,
									diff = (dataFunc - huidigGewichtPunt) * vars.ingredienten[id].gewichtspunten;
								if(vars.totaalGewicht + diff > 20){
									return;
								}
							}							
							$this.toggleClass('down').siblings().removeClass('down');
							vars.ingredienten[id].hoeveelheid = dataFunc;
							if(diff){
								vars.totaalGewicht += diff;
								vars.h4Gewicht.text(vars.totaalGewicht);
							}
							vars.ingredienten[id].gewicht = vars.ingredienten[id].gewichtspunten*vars.ingredienten[id].hoeveelheid;
							tr.children('.totaalGewicht').text(vars.ingredienten[id].gewicht);
							var oldPrijs = vars.ingredienten[id].prijs;
							if(dataFunc == 1){
								view3Hoeveelheid.text('Wijnig');
								view4Hoeveelheid.text('Wijnig');
								vars.ingredienten[id].prijs = Math.round(vars.ingredienten[id].prijs100*0.75);
							} else if(dataFunc == 2){
								view3Hoeveelheid.text('Normaal');
								view4Hoeveelheid.text('Normaal');
								vars.ingredienten[id].prijs = Math.round(vars.ingredienten[id].prijs100);
							} else {
								view3Hoeveelheid.text('Veel');
								view4Hoeveelheid.text('Veel');
								vars.ingredienten[id].prijs = Math.round(vars.ingredienten[id].prijs100*1.25);
							}
							vars.totaalPrijs -= oldPrijs;
							vars.totaalPrijs += vars.ingredienten[id].prijs;
							changeContent.setPrice(id);
						});
						
						$('<button>', {text: 'Wijzig', class: 'down', 'data-func': 1}).appendTo(divButtons);
						$('<button>', {text: 'Normaal', 'data-func': 2}).appendTo(divButtons);
						$('<button>', {text: 'Veel', 'data-func': 3}).appendTo(divButtons);

						vars.totaalGewicht += vars.ingredienten[id].gewicht;
						vars.h4Gewicht.text(vars.totaalGewicht);

						vars.totaalPrijs += vars.ingredienten[id].prijs;
						changeContent.setPrice();

					} else {

						if(vars.view2.find('table#view2_table_main tr.' + id).length == 1){
							vars.view2.find('table#view2_table_main tr.' + id).remove();
							vars.view3.find('table#view2_table_main tr.' + id).remove();
							vars.view4.find('table#view2_table_main tr.' + id).remove();
							vars.ingredienten[id].gewicht = parseInt(vars.ingredienten[id].gewichtspunten);
	
							vars.totaalGewicht -= vars.ingredienten[id].gewicht;
							vars.h4Gewicht.text(vars.totaalGewicht);
							
							vars.totaalPrijs -= vars.ingredienten[id].prijs;
							changeContent.setPrice();
						}
						
						if(vars.view2.find('table#view2_table_main tr').length == 0){
							vars.view2.find('div#overflow').hide();
							vars.view3.find('div#overflow').hide();
							vars.view4.find('div#overflow').hide();
						}

					}
				}
			}
			// END changeContent verzameling
			//=================================================================

		})( jQuery );
		
</script>
<?php $this->load->view('includes/footer') ?>