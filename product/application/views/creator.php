<?php $this->load->view('includes/header') ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>css/productApp.css" />
	<article>
		
		<h1>De product creëer pagina</h1>
		<p>U kunt hier uw eigen product samenstellen</p>
		
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
					<h1>Kies je categorie: </h1>
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
						<button class="nav_button" id="vorige" disabled="disabled"> « Vorige </button>
						 &nbsp; <button class="nav_button" id="volgende"> Volgende » </button>
					</div>
					
				</div>
				<div id="appView">
					<h1>Product creator</h1>
					<p>U kunt hier zelf een product samenstellen. Begin door een categorie te kiezen.</p>
				</div>
				<div id="appSelector">
					<!-- <h1>Pizza</h1>
					<p>Bij PizzaRio kunt u uw pizza rijkelijk beleggen met de verste ingredienten. De prijs zal varieren tussen €2,00 en €6,00.</p> -->
				</div>
				
			</div>
			<div id="appMainWindow2" class="mainWindows">
				<div id="appSideBar">
					<br />
					<table id="sidebar_table">
					</table>
					<div class="center nav_div">
						<button class="nav_button" id="vorige"> « Vorige </button>
						 &nbsp; <button class="nav_button" id="volgende"> Volgende » </button>
					</div>
				</div>
				<div id="appView">
					<h1>Je hebt nog geen categorie gekozen</h1>
				</div>
				<div id="appSelector2">
					<div id="slider-nav">
						<button data-dir="prev"><</button>
						<button data-dir="next">></button>
					</div>
					<div id="appSelector2Content">
						<ul>
						</ul>
					</div>
				</div>
			</div>
			<div id="appMainWindow3" class="mainWindows">
				<div id="appSideBar">
					<div class="center nav_div">
						<button class="nav_button" id="vorige"> « Vorige </button>
						 &nbsp; <button class="nav_button" id="volgende"> Volgende » </button>
					</div>
				</div>
				<div id="appView">
				</div>
				<div id="appSelector">
				</div>
			</div>
			<div id="appMainWindow4" class="mainWindows">
				<div id="appSideBar">
					<div class="center nav_div">
						<button class="nav_button" id="vorige"> « Vorige </button>
						 &nbsp; <button class="nav_button" id="volgende" disabled="disabled"> Volgende » </button>
					</div>
				</div>
				<div id="appView">
				</div>
				<div id="appSelector">
				</div>
			</div>
			
			
		</div>
		<br />
	</article>
	
	<script src="<?php echo base_url(); ?>js/jquery.json-2.3.js"></script>
	
	<script>
		
		(function( $ ){

			// FUNCTION VARIABELEN
			vars = {
				pagenr: 1,
				appNavigationUl: $('div#appNavigation ul'),
				gekozenCategorie: 0,
				ingredienten: [],
				sidebar1: $('div#appMainWindow1').find('div#appSideBar'),
				view1: $('div#appMainWindow1').find('div#appView'),
				selector1: $('div#appMainWindow1').find('div#appSelector'),
				
				sidebar2: $('div#appMainWindow2').find('div#appSideBar'),
				view2: $('div#appMainWindow2').find('div#appView'),
				selector2: $('div#appMainWindow2').find('div#appSelector2'),
				
				sidebar3: $('div#appMainWindow3').find('div#appSideBar'),
				view3: $('div#appMainWindow3').find('div#appView'),
				selector3: $('div#appMainWindow3').find('div#appSelector'),
				
				sidebar4: $('div#appMainWindow4').find('div#appSideBar'),
				view4: $('div#appMainWindow4').find('div#appView'),
				selector4: $('div#appMainWindow4').find('div#appSelector'),
			}
		
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
			
			
			$('input.sidebar_keuze_categorie').on('change', function(){
				var thisId = $(this).attr('value');
				changeContent.categorie_content_change(thisId);
				vars.gekozenCategorie = thisId;
			});
			
			$('div#appMainWindow2 #sidebar_table').on('click', 'input', function(){
				var $this = $(this);
				vars.ingredienten[$this.attr('data-arrayIndex')].gekozen = !vars.ingredienten[$this.attr('data-arrayIndex')].gekozen;
				changeContent.createIngredient($this.attr('data-arrayIndex'), vars.ingredienten[$this.attr('data-arrayIndex')].gekozen);
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
				
				categorie_content_change: function(value){
					
					$.ajax({
						url: "<?php echo base_url(); ?>index.php/product_cont/ajax_getId",
						type: 'POST',
						data: {id: value, ajax: '1'},
						success: function(msg){

							var records = $.evalJSON( msg ).records;
							var ingredienten = $.evalJSON( msg ).ingredienten;
							
							var count = 0;
							var tr;
							
							vars.sidebar2.find('h1').remove();
							$('<h1>', {
								text: 'Stel uw ' + records[0].naam + ' samen'
							}).prependTo(vars.sidebar2);
							vars.sidebar2.find('table').empty();
							vars.selector2.find('div#appSelector2Content ul').empty();
							
							vars.ingredienten = [];
							
							for ( property in ingredienten ){
								vars.ingredienten[count] = {
									ingredientId: ingredienten[count].ingredientid,
									prijs: ingredienten[count].prijs,
									naam: ingredienten[count].naam,
									gewichtspunten: ingredienten[count].gewichtspunten,
									hoeveelheid: 2,
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
									
								
								
								// vullen tabel
								// plaatje opvragen door categorieID(map)/ingredientID(map)
								
								count++;
							} 
							
							// aanpassingen aan div1
								vars.view1.empty();
								vars.selector1.empty();
									
								//main view
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
								//end main view
								
								//selector
									$('<h1>', {
										text: records[0].naam,
									}).appendTo(vars.selector1);
									$('<p>', {
										text: records[0].omschrijving,
									}).appendTo(vars.selector1);
								//end selector
							// end aanpassingen aan div1
							
							
							// aanpassingen aan div2
								vars.view2.empty();									
								//main view
									$('<h1>', {
										text: 'Uw ' + records[0].naam,
									}).appendTo(vars.view2);
									
									var div = $('<div>', {
										class: 'center',
									}).appendTo(vars.view2);
									
									
									$('<table>', {
										id : 'view2_table',
									}).appendTo(div);

									
									// $('<img>', {
										// src: 'http://127.0.0.1/pizzario/images/productApp/' + vars.gekozenCategorie + '/start.png',
										// width: 400,
										// height: 330,
									// }).appendTo(div);
								//end main view
							// end aanpassingen aan div2
							
							
						}
					});
				},
				
				createIngredient: function(id, bool){

					if(vars.selector2.find('li').length == 6 && vars.ingredienten.length > 6){
						vars.selector2.find('button').show();
					}
					
					
					if(bool){
						
						var li = $('<li>', {
							class: 'center',
							id: id,
						}).appendTo(vars.selector2.find('div#appSelector2Content ul'));
						var left = $('<div>', {
							style: 'float: left; height: 100%; width: 50px;',
						}).appendTo(li);
						$('<p>', {
							text: vars.ingredienten[id].naam,
							style: '',
							class: ''
						}).appendTo(left);
						
						var right = $('<div>', {
							class: 'selectorRightButtons',
							style: 'float: right; height: 100%; width: 24px;'
						}).appendTo(li);
						$('<button>', {
							class: '-',
							text: '˄'
						}).appendTo(right).on('click', function(){
								var id = $(this).parents('li').attr('id');
								if(vars.ingredienten[id].hoeveelheid < 5){
									vars.ingredienten[id].hoeveelheid++;
									$(this).siblings('span').text(' ' + vars.ingredienten[id].hoeveelheid + ' ');
								}
							});
						$('<br />').appendTo(right);
						$('<span>', {
							class: 'val',
							text: ' ' + vars.ingredienten[id].hoeveelheid + ' '
						}).appendTo(right);
						$('<br />').appendTo(right);
						$('<button>', {
							class: '+',
							text: '˅'
						}).appendTo(right).on('click', function(){
								var id = $(this).parents('li').attr('id');
								if(vars.ingredienten[id].hoeveelheid > 1){
									vars.ingredienten[id].hoeveelheid--;
									$(this).siblings('span').text(' ' + vars.ingredienten[id].hoeveelheid + ' ');
								}
							});
						
						if((vars.selector2.find('li').length-1) % 3 === 0){
							$('<tr>').appendTo(vars.view2.find('table'));
						}
						
						var td = $('<td>', { class: vars.ingredienten[id].ingredientId}).appendTo(vars.view2.find('table tr').last());
						
						$('<img>', {
							src: 'http://127.0.0.1/pizzario/images/productApp/' + vars.gekozenCategorie + '/' + vars.ingredienten[id].ingredientId + '/left.png',
						}).appendTo(td);
						$('<h4>', {
							text: vars.ingredienten[id].naam,
						}).appendTo(td);
						// $('<p>', {
							// text: 'Omschrijving omschrijving omschrijving',
						// }).appendTo(td);
						//vars.view2.find('table')
							
							
					} else {
						vars.view2.find('.'+vars.ingredienten[id].ingredientId).remove();
						if(vars.view2.find('tr').last().children().length === 0){
							vars.view2.find('tr').last().remove();
						}
					
						if(vars.selector2.find('li').length == 7 && vars.ingredienten.length > 6){
							vars.selector2.find('#slider-nav button').hide();
							vars.selector2.find('ul').animate({
								'margin-left': 0,
							});
						}
						
						vars.selector2.find('#' + id).remove();
					}
					
				}
			}
			// END changeContent verzameling
			//=================================================================

			vars.selector2.find('button').on('click', function(){		
				var temp = '';
				var count = $(this).parent().siblings('div#appSelector2Content').find('ul li').length;
				var toAnimate = $(this).parent().siblings('div#appSelector2Content').find('ul');
				var liWidth = 80;
				var margin = parseInt(toAnimate.css('margin-left'));

				if($(this).attr('data-dir') === 'next'){
					if((margin-(liWidth*2)) <= (370-(count*liWidth))){
						return;
					}
					temp = '-='+liWidth;
				} else {
					if(margin >= 0){
						return;
					}
					temp = '+='+liWidth;
					
				}
				
				toAnimate.animate({
					'margin-left': temp,
				});
			});
			
			


		})( jQuery );
		
		
		
		
</script>
<?php $this->load->view('includes/footer') ?>