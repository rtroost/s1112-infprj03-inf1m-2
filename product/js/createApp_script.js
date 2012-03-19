var CreateApp = {
	
	init: function( config ){
		this.config = config;

		this.bindEvents();
		
		$('input#qty').numeric();
		
	},
	
	bindEvents: function(){
		// Navigation events
		var self = CreateApp;
		this.config.nav_buttons.on('click', 'button', this.changeNav);
		this.config.a_nav.on('click', 'a', function(e){
			self.changeNav('link', $(this));
			e.preventDefault();
		});
		//categorie event
		this.config.sidebar_keuze_categorie.on('change', this.get_categorie);
		//ingredient event
		self.config.appMainWindow2.find('table#sidebar_table2').on('click', 'input', function(e){
			self.check_gewicht($(this), e);
		});
		//hoeveelheid event
		self.config.view2.find('table#view2_table_main').on('click', 'button', this.hoeveelheid_button);
		//login event
		self.config.sidebar3.find('input#loginSubmit').on('click', function(e){
			self.login($(this));
			e.preventDefault();
		});
		//product opslaan event
		self.config.opslaanButton.on('click', this.product_opslaan);
		//winkelwagen event
		self.config.winkelwagenButton.on('click', this.winkelwagen);
		
	},

	changeNav: function(a, $this){
		var self = CreateApp;
		if(a === 'link'){
			var li = $this.parent('li');
			self.config.pagenr = parseInt(li.attr('id'));
			li.removeClass().addClass('activated')
			.siblings().removeClass().addClass('overig');
		} else {
			if($(this).attr('id') === 'volgende'){
				self.config.pagenr += 1;
				self.config.appNavigationUl.find('li.activated')
				.removeClass().addClass('overig')				
				.next().removeClass().addClass('activated');
			} else {
				self.config.pagenr -= 1;
				self.config.appNavigationUl.find('li.activated')
				.removeClass().addClass('overig')
				.prev().removeClass().addClass('activated');
			}
		}
		self.changeMainWindow();
	},
	
	changeMainWindow: function(){
		if(this.config.pagenr == 1){ this.config.appMainWindow1.show().siblings('.mainWindows').hide();
		} else if(this.config.pagenr == 2){	this.config.appMainWindow2.show().siblings('.mainWindows').hide();
		} else if(this.config.pagenr == 3){	this.config.appMainWindow3.show().siblings('.mainWindows').hide();
		} else { this.config.appMainWindow4.show().siblings('.mainWindows').hide();	}
	},
	
	get_categorie: function(){
		var self = CreateApp,
		$this = $(this);
		self.config.gekozenCategorie = $this.attr('value');
		$.ajax({
			url: self.config.base_url+'index.php/product_cont/ajax_getId',
			type: 'POST',
			data: {id: self.config.gekozenCategorie, ajax: '1'},
			success: function(msg){
				self.categorie_content_change(msg)
			}
		});
	},
	
	categorie_content_change: function(msg){
		var self = CreateApp;
		
		var records = $.evalJSON( msg ).records;
		var ingredienten = $.evalJSON( msg ).ingredienten;
		
		var count = 0;
		var tr;
		
		self.config.samenstellenText.remove();
		self.config.divSamenstellen.show();
		self.config.samenstellenViewTitel.show();
		
		self.config.opslaanText.remove();
		self.config.divOpslaan.show();
		self.config.opslaanViewTitel.show();
		
		self.config.bestelText.remove();
		self.config.divBestellen.show();
		self.config.bestellenViewTitel.show();
		
		self.config.sidebar2.find('table').empty();
		self.config.totaalGewicht = 0;
		self.config.h4Gewicht.text(self.config.totaalGewicht);
		self.config.totaalPrijs = parseInt(records[0].standaardprijs);
		this.setPrice();
		
		self.config.view2.find('table#view2_table_main').empty();
		self.config.view3.find('table#view3_table_main').empty();
		self.config.view4.find('table#view3_table_main').empty();
		self.config.ingredienten = [];
		
		for ( property in ingredienten ){
			self.config.ingredienten[count] = {
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
				tr = $('<tr>').appendTo(self.config.sidebar2.find('table'));
			}
			
			var td = $('<td>').appendTo(tr);
			
			$('<label>', {
				for: 'sidebar_keuze',
				text: self.config.ingredienten[count].naam,
			}).appendTo(td);
			
			$('<br />').appendTo(td);
			
			$('<img>', {
				src: 'http://127.0.0.1/pizzario/images/productApp/' + self.config.gekozenCategorie + '/' + ingredienten[count].ingredientid + '/left.png',
				width: 50,
				height: 50,
				style: 'float: left; height: 50px; width: 50px;',
			}).appendTo(td);
			
			$('<input>', {
				class: 'sidebar_keuze_ingredient',
				name: 'sidebar_keuze',
				value: self.config.ingredienten[count].ingredientId,
				'data-arrayIndex': count,
				type: 'checkbox',
				style: 'margin-top: 20px; margin-left: 10px;',
			}).appendTo(td);
			count++;
		} 
		
		// aanpassingen aan div1
		self.config.view1.empty();
		self.config.selector1.empty();

		$('<h1>', {
			text: 'U heeft gekozen voor: ' + records[0].naam,
		}).appendTo(self.config.view1);
		
		var div = $('<div>', {
			class: 'center',
		}).appendTo(self.config.view1);
		
		$('<img>', {
			src: 'http://127.0.0.1/pizzario/images/productApp/' + records[0].image_groot,
			width: 400,
			height: 300,
		}).appendTo(div);

		$('<h1>', {
			text: records[0].naam,
		}).appendTo(self.config.selector1);
		$('<p>', {
			text: records[0].omschrijving,
		}).appendTo(self.config.selector1);
		// end aanpassingen aan div1

		self.config.view2.find('table').show();
		self.config.view3.find('table').show();
		self.config.view4.find('table').show();
		
	},
	
	setPrice: function(id){
		var self = CreateApp;
		if(String(self.config.totaalPrijs).length == 3){
			self.config.h4Prijs.text('€' + String(self.config.totaalPrijs).substring(0,1) + ',' + String(self.config.totaalPrijs).substring(1));
		} else {
			self.config.h4Prijs.text('€' + String(self.config.totaalPrijs).substring(0,2) + ',' + String(self.config.totaalPrijs).substring(2));
		}
		if(id){
			if(String(self.config.ingredienten[id].prijs).length == 2){
				var string = '€0,' + String(self.config.ingredienten[id].prijs);
			} else {
				var string = '€' + String(self.config.ingredienten[id].prijs).substring(0,1) + ',' + String(self.config.ingredienten[id].prijs).substring(1);
			}
			self.config.view2.find('tr.'+id).children('.prijs').text(string);
			self.config.view3.find('table#view3_table_main tr.'+id).children('.prijs').text(string);
			self.config.view4.find('table#view3_table_main tr.'+id).children('.prijs').text(string);
		} 
	},
	
	setPriceFirst: function(id){
		var self = CreateApp;
		if(String(self.config.ingredienten[id].prijs).length == 2){
			return '€0,' + String(self.config.ingredienten[id].prijs);
		} else {
			return '€' + String(self.config.ingredienten[id].prijs).substring(0,1) + ',' + String(self.config.ingredienten[id].prijs).substring(1);
		}
	},
	
	check_gewicht: function($this, e){
		var self = CreateApp;
		var	id = $this.attr('data-arrayIndex');

		if((parseInt(self.config.totaalGewicht) + parseInt(self.config.ingredienten[id].gewichtspunten)) > 20){
			if(self.config.ingredienten[$this.attr('data-arrayIndex')].gekozen && self.config.view2.find('table#view2_table_main tr.' + id).length == 1){
				self.config.ingredienten[$this.attr('data-arrayIndex')].gekozen = !self.config.ingredienten[$this.attr('data-arrayIndex')].gekozen;
				self.click_ingredient(id, self.config.ingredienten[$this.attr('data-arrayIndex')].gekozen);
			} else {
				console.log('kom ik hier');
				e.preventDefault();
				return;
			}
		} else {
			self.config.ingredienten[$this.attr('data-arrayIndex')].gekozen = !self.config.ingredienten[$this.attr('data-arrayIndex')].gekozen;
			self.click_ingredient(id, self.config.ingredienten[$this.attr('data-arrayIndex')].gekozen);
		}
	},
	
	click_ingredient: function(id, bool){
		var self = CreateApp;
		if(bool){
			self.create_ingredient(id);
		} else {
			self.remove_ingredient(id);
		}
	},

	create_ingredient: function(id){
		var self = CreateApp;
		self.config.view2.find('div#overflow').show();
		self.config.view3.find('div#overflow').show();
		self.config.view4.find('div#overflow').show();
		
		var tr = $('<tr>', {class: id}).appendTo(self.config.view2.find('table#view2_table_main')),
		 	td1 = $('<td>').appendTo(tr),
			td2 = $('<td>', { text: (self.config.ingredienten[id].gewicht), class: 'totaalGewicht'}).appendTo(tr),
			td3 = $('<td>').appendTo(tr),
		 	td4 = $('<td>', { text: self.setPriceFirst(id), class: 'prijs'}).appendTo(tr),
		 	tr2 = $('<tr>', {class: id}).appendTo(self.config.view3.find('table#view3_table_main')),
		 	td1tr2 = $('<td>').appendTo(tr2),
		 	td2tr2 = $('<td>').appendTo(tr2),
		 	td3tr2 = $('<td>', {text: self.setPriceFirst(id), class: 'prijs'}).appendTo(tr2),
		 	tr3 = $('<tr>', {class: id}).appendTo(self.config.view4.find('table#view3_table_main')),
		 	td1tr3 = $('<td>').appendTo(tr3),
		 	td2tr3 = $('<td>').appendTo(tr3),						
		 	td3tr3 = $('<td>', {text: self.setPriceFirst(id), class: 'prijs'}).appendTo(tr3);					
		
		$('<img>', { 
			src: 'http://127.0.0.1/pizzario/images/productApp/' + self.config.gekozenCategorie + '/' + self.config.ingredienten[id].ingredientId + '/left.png'
		}).appendTo(td1);
		$('<p>', { text: self.config.ingredienten[id].naam }).appendTo(td1);
		
		$('<img>', { 
			src: 'http://127.0.0.1/pizzario/images/productApp/' + self.config.gekozenCategorie + '/' + self.config.ingredienten[id].ingredientId + '/left.png'
		}).appendTo(td1tr2);
		$('<p>', { text: self.config.ingredienten[id].naam }).appendTo(td1tr2);
		
		
		
		$('<img>', { 
			src: 'http://127.0.0.1/pizzario/images/productApp/' + self.config.gekozenCategorie + '/' + self.config.ingredienten[id].ingredientId + '/left.png'
		}).appendTo(td1tr3);
		$('<p>', { text: self.config.ingredienten[id].naam }).appendTo(td1tr3);
		
		$('<p>', { id: 'view3Hoeveelheid', text: 'Wijnig'}).appendTo(td2tr2);
		$('<p>', { id: 'view4Hoeveelheid', text: 'Wijnig'}).appendTo(td2tr3);
		
		var divButtons = $('<div>', {class: 'view2buttons'}).appendTo(td3);
		
		$('<button>', {text: 'Wijzig', class: 'down', 'data-func': 1}).appendTo(divButtons);
		$('<button>', {text: 'Normaal', 'data-func': 2}).appendTo(divButtons);
		$('<button>', {text: 'Veel', 'data-func': 3}).appendTo(divButtons);

		self.config.totaalGewicht += self.config.ingredienten[id].gewicht;
		self.config.h4Gewicht.text(self.config.totaalGewicht);

		self.config.totaalPrijs += self.config.ingredienten[id].prijs;
		self.setPrice();
	},
	
	remove_ingredient: function(id){
		var self = CreateApp;
		if(self.config.view2.find('table#view2_table_main tr.' + id).length == 1){
			self.config.view2.find('table#view2_table_main tr.' + id).remove();
			self.config.view3.find('table#view3_table_main tr.' + id).remove();
			self.config.view4.find('table#view3_table_main tr.' + id).remove();
			self.config.ingredienten[id].gewicht = parseInt(self.config.ingredienten[id].gewichtspunten);

			self.config.totaalGewicht -= self.config.ingredienten[id].gewicht;
			self.config.h4Gewicht.text(self.config.totaalGewicht);
			
			self.config.totaalPrijs -= self.config.ingredienten[id].prijs;
			self.setPrice();
		}
			
		if(self.config.view2.find('table#view2_table_main tr').length == 0){
			self.config.view2.find('div#overflow').hide();
			self.config.view3.find('div#overflow').hide();
			self.config.view4.find('div#overflow').hide();
		}
	},
	
	hoeveelheid_button: function(){
		var self = CreateApp,
			$this = $(this);
		if($this.attr('class') === 'down'){ return; }
		var	tr = $this.parents('tr'),
			id = tr.attr('class'),
			dataFunc = $this.attr('data-func'),
			view3Hoeveelheid = self.config.view3.find('table#view3_table_main tr.'+id).find('p#view3Hoeveelheid'),
			view4Hoeveelheid = self.config.view4.find('table#view3_table_main tr.'+id).find('p#view4Hoeveelheid');
		if(self.config.ingredienten[id].gewichtspunten != 0){
			var huidigGewichtPunt = self.config.ingredienten[id].gewicht/self.config.ingredienten[id].gewichtspunten,
				diff = (dataFunc - huidigGewichtPunt) * self.config.ingredienten[id].gewichtspunten;
			if(self.config.totaalGewicht + diff > 20){
				return;
			}
		}							
		$this.toggleClass('down').siblings().removeClass('down');
		self.config.ingredienten[id].hoeveelheid = dataFunc;
		if(diff){
			self.config.totaalGewicht += diff;
			self.config.h4Gewicht.text(self.config.totaalGewicht);
		}
		self.config.ingredienten[id].gewicht = self.config.ingredienten[id].gewichtspunten*self.config.ingredienten[id].hoeveelheid;
		tr.children('.totaalGewicht').text(self.config.ingredienten[id].gewicht);
		var oldPrijs = self.config.ingredienten[id].prijs;
		if(dataFunc == 1){
			view3Hoeveelheid.text('Wijnig');
			view4Hoeveelheid.text('Wijnig');
			self.config.ingredienten[id].prijs = Math.round(self.config.ingredienten[id].prijs100*0.75);
		} else if(dataFunc == 2){
			view3Hoeveelheid.text('Normaal');
			view4Hoeveelheid.text('Normaal');
			self.config.ingredienten[id].prijs = Math.round(self.config.ingredienten[id].prijs100);
		} else {
			view3Hoeveelheid.text('Veel');
			view4Hoeveelheid.text('Veel');
			self.config.ingredienten[id].prijs = Math.round(self.config.ingredienten[id].prijs100*1.25);
		}
		self.config.totaalPrijs -= oldPrijs;
		self.config.totaalPrijs += self.config.ingredienten[id].prijs;
		self.setPrice(id);
	},
	
	login: function($this){
		var self = CreateApp;
		$.ajax({
			url: $this.parent('form').attr('action'),
			type: $this.parent('form').attr('method'),
			data: $this.parent('form').serialize(),  // q=d&test=hallo
			dataType: 'json',
			success: function(results) {
				self.set_user_data(results);
			}
		});
	},
	
	set_user_data: function(results){
		var self = CreateApp;
		if(results !== 'failed'){
			self.config.loginData = {
				achternaam: results.achternaam,
				email: results.email,
				gebruikerid: results.gebruikerid,
				logged_in: results.logged_in,
				type: results.type,
				voornaam: results.voornaam
			}
			self.config.spanNaam.text(self.config.loginData.voornaam);
			self.config.opslaan_login.show();
			self.config.opslaan_logout.hide();
			self.config.bestellen_login.show();
			self.config.bestellen_logout.hide();
			$('div#inlog_false').hide();
			$('div#inlog_true').show();
		} else {
			if(self.config.sidebar3.find('h5#loginFlaseText').length === 0){
				$('<h5>', {
					text: 'gebruikersnaam en password combinatie verkeerd',
					style: 'color: red;',
					id: 'loginFlaseText'
				}).insertAfter(self.config.sidebar3.find('form#login_form'));
			}
		}
	},
	
	
	createFormData: function(){
		var self = CreateApp;
		var gekozenCount = 0;
		var publikelijk;
		if($('input#product_publikelijk').attr('checked') == 'checked'){
			publikelijk = 1;
		} else {
			publikelijk = 0;
		}
		var formData = 'gebruikerid='+self.config.loginData.gebruikerid+'&publiekelijk='+publikelijk+'&productNaam='+self.config.product_naam+'&categorieid='+self.config.gekozenCategorie;
		for(var i = 0; i < self.config.ingredienten.length; i++){
			if(self.config.ingredienten[i].gekozen){
				gekozenCount++;
				formData = formData.concat('&ingredientid'+gekozenCount+'='+self.config.ingredienten[i].ingredientId+
				'&hoeveelheid'+gekozenCount+'='+self.config.ingredienten[i].hoeveelheid);
			}
		}
		formData = formData.concat('&aantalingredienten='+gekozenCount);
		if(self.config.loginData.logged_in){
			formData = formData.concat('&logged_in=true');
		} else {
			formData = formData.concat('&logged_in=false');
		}
		
		return formData;
	},
	
	
	product_opslaan: function(temp){
		var self = CreateApp;
		if(temp !== 'true'){
			self.config.product_naam = $('input#product_name').attr('value');
		}
		formData = self.createFormData();
		$.ajax({
			url: self.config.base_url+'index.php/product_cont/save_product',
			type: 'POST',
			data: formData,  // q=d&test=hallo
			success: function(results) {
				if(temp !== 'true'){
					self.after_opslaan(results);
				} else {
					self.after_opslaan_temp(results);
				}
			}
		});
	},
	
	after_opslaan: function (results){
		var self = CreateApp;
		if(results !== 'failed'){
			self.config.opslaan_login.hide();
			self.config.bestellen_login.hide();
			self.config.after_opslaan.show();
			self.config.after_bestellen.show();
			self.config.sidebar1.find('.sidebar_keuze_categorie').attr('disabled', 'disabled');
			self.config.sidebar2.find('.sidebar_keuze_ingredient').attr('disabled', 'disabled');
			self.config.view2.find('div.view2buttons button').attr('disabled', 'disabled');
			self.config.aangemaakt_product_id = results;
		} else {
			//error
		}
	},
	
	insertCart: function($this){
		var self = CreateApp,
			prijs = 0;
		if(String(self.config.totaalPrijs).length == 3){
			prijs = String(self.config.totaalPrijs).substring(0,1) + '.' + String(self.config.totaalPrijs).substring(1);
		} else {
			prijs = String(self.config.totaalPrijs).substring(0,2) + '.' + String(self.config.totaalPrijs).substring(2);
			console.log(prijs);
		}
		$.ajax({
				url: self.config.base_url+'index.php/product_cont',
				type: 'POST',
				data: {id: self.config.aangemaakt_product_id, qty: self.config.quantity, price: prijs, name: self.config.product_naam},
				success: function(result){
					if(result === 'success'){
						self.config.winkelwagenHeading.show();
						self.config.a_naarWinkelwagen.show();
						
						self.config.winkelwagenButton.siblings('#qty').remove();
						self.config.winkelwagenButton.siblings('h5').remove();
						self.config.winkelwagenButton.remove();
					} else {
						self.config.winkelwagenHeading.text('bestellen is mislukt').show();
					}
				}
		});
	},
	
	winkelwagen: function(){
		var self = CreateApp;
		$this = $(this);
		if(self.config.product_naam === ''){
			self.config.product_naam = 'product zonder naam';
		}
		var qtyVal = $this.siblings('#qty').attr('value');
		if(qtyVal === ''){
			self.config.quantity = 1;
		} else {
			self.config.quantity = qtyVal;
		}
		if($this.data('after')){
			self.insertCart();
		} else {
			self.product_opslaan('true');
		}
	},

	after_opslaan_temp: function(results){
		var self = CreateApp;
		if(results !== 'failed'){
			self.config.sidebar1.find('.sidebar_keuze_categorie').attr('disabled', 'disabled');
			self.config.sidebar2.find('.sidebar_keuze_ingredient').attr('disabled', 'disabled');
			self.config.view2.find('div.view2buttons button').attr('disabled', 'disabled');
			self.config.sidebar3.find('input#loginSubmit').attr('disabled', 'disabled');
			self.config.aangemaakt_product_id = results;
			self.insertCart();
		} else {
			//error
		}
	},

}