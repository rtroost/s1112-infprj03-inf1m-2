


		// Some comments :P
		
		
		//changeMainWindow.delContent();
					
					
					
					// ajax hier
					
					//var form_data = {
						// ajax: '1'
					// };
// 									
// 					
					// $.ajax({
						// // NIEUWE FUNCTION MAKEN IN CONTROLLER: VALIDATE
						// // HIERNAAR TOE LIJDEN EN DOOR MIDDEL VAN AJAX DE VALIDATE FUNCTIE AANROEPEN EN DE PAGE REFRESSEN NET ALS BIJ DE LOGIN PAGE OF IETS GEVEN.
						// url: "<?php echo base_url(); ?>index.php/product_cont/ajax_getAll",
						// type: 'POST',
						// data: form_data,
						// success: function(msg){
// 
							// var records = $.evalJSON( msg ).records;
// 
							// var count = 0;
// 							
							// //sidebar
							// $('<h1>Kies je categorie:</h1><br />').appendTo(changeMainWindow.vars.sidebar);
							// var tempTable = $('<table id="sidebar_table"><form method="post" action=""></form></table>').appendTo(changeMainWindow.vars.sidebar);
// 							
							// for ( property in records ){
// 								
								// var temp = $('<tr></tr>').appendTo(tempTable);
								// $('<td><img src="http://127.0.0.1/pizzario/images/productApp/' + records[count].image_klein + '" width="80px" height="70px"/></td>').appendTo(temp);					
// 								
								// if(count == gekozenCategorie-1) {
									// $('<td><input class="sidebar_keuze" name="sidebar_keuze" value="' + records[count].categorieid + '" type="radio" checked="checked" /><label>' + records[count].naam + '</label></td>').appendTo(temp).on('change', function(){
										// changeContent.categorie_content_change($(this).find('input').attr('value'));
									// });									
								// } else {
									// $('<td><input class="sidebar_keuze" name="sidebar_keuze" value="' + records[count].categorieid + '" type="radio" /><label>' + records[count].naam + '</label></td>').appendTo(temp).on('change', function(){
										// changeContent.categorie_content_change($(this).find('input').attr('value'));
									// });
								// }
// 								
								// count++;
							// } 
// 							
							// $('<div class="center nav_div"></div>').appendTo(changeMainWindow.vars.sidebar);
// 							
							// if(pagenr == 1){
								// $('<button class="nav_button" id="vorige" disabled="disabled"> « Vorige </button> &nbsp;').appendTo($('div.nav_div')).on('click', function(){ changeNavVorige(); });
							// } else {
								// $('<button class="nav_button" id="vorige"> « Vorige </button> &nbsp;').appendTo($('div.nav_div')).on('click', function(){ changeNavVorige(); });
							// }
							// if(pagenr == 4){
								// $('<button class="nav_button" id="volgende" disabled="disabled"> Volgende » </button>').appendTo($('div.nav_div')).on('click', function(){ changeNavVolgende(); });
							// } else {
								// $('<button class="nav_button" id="volgende"> Volgende » </button>').appendTo($('div.nav_div')).on('click', function(){ changeNavVolgende(); });
							// }
							// // end sidebar
// 							
							// //main view
							// $('<h1>U heeft gekozen voor: ' + records[gekozenCategorie-1].naam + '</h1>').appendTo(changeMainWindow.vars.view);
							// $('<div class="center"><img src="http://127.0.0.1/pizzario/images/productApp/' + records[gekozenCategorie-1].image_groot + '" width="400" height="300" /></div>').appendTo(changeMainWindow.vars.view);
							// //end main view
// 							
							// //selector
							// $('<h1>' + records[gekozenCategorie-1].naam + '</h1>').appendTo(changeMainWindow.vars.selector);
							// $('<p>' + records[gekozenCategorie-1].omschrijving + '</p>').appendTo(changeMainWindow.vars.selector);
							// //end selector
// 							
// 							
						// }
					// });

