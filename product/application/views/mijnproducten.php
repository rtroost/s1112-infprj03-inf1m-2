<?php $this->load->view('includes/header') ?>
<style>
table#mijnproducten{
	width: 100%;
}
table#mijnproducten td{
	border-bottom: 1px solid gray;
	padding-top: 10px;
	padding-bottom: 4px;
}

table#mijnproducten th{
	color: #C0A55A;
    font-family: calibri;
    font-size: 18px;
    font-weight: bold;
}

table#mijnproducten tr:last-child td{
	border-bottom: none;
}

/* 800 */
table#mijnproducten td:nth-child(1){ width: 460px; }
table#mijnproducten td:nth-child(2){ width: 120px; }
table#mijnproducten td:nth-child(3){ width: 80px;  padding-right: 20px;}
table#mijnproducten td:nth-child(4){ width: 100px; }
table#mijnproducten td:nth-child(5){ width: 60px; }

input[type=submit]{
	width: 110px;
}

</style>
	<div id="content">
		<h1>Mijn producten</h1><br />
		<?php if($this->session->userdata('typeid') != 2){ ?>
		<h3>Let op! U mag maximaal 5 producten publiekelijk maken. U heeft <span id="publiekelijkcount"><?php echo $publiekelijkcount; ?></span> publiekelijke producten.</h3><br /><br />
		<?php } ?>
		<?php if(count($rows) != 0){ ?>
		<table id="mijnproducten" cellspacing="0px">
			<tr>
				<th>Producten</th>
				<th>Delen</th>
				<th style="padding-left: 14px;">Aantal</th>
				<th>Bestellen</th>
				<th>Aanpassen</th>
			</tr>
			<?php foreach($rows as $r){ ?>
				<tr id="<?php echo $r->productid; ?>">
				<td> 
					<h3><?php echo $r->product[0]->naam; ?></h3><br />
					<p><b>Categorie: </b> <?php echo $r->categorienaam; ?></p>
					<p><b>Ingredienten: </b><?php $count = 1; if(count($r->names) != 0){ foreach($r->names as $naam){ if($count != count($r->names)){ echo $naam . ", "; } else { echo $naam; } $count++;} }?></p>
					<p><b>Aangemaakt op: </b> <?php echo $r->aanmaak_datetime; ?></p>
					<p><b>Prijs: </b> €<span class="prijs"><?php if(strlen($r->prijs) == 4){ echo substr($r->prijs, 0, 2) . ',' . substr($r->prijs, 2);	} 
								else if(strlen($r->prijs) == 3){ echo substr($r->prijs, 0, 1) . ',' . substr($r->prijs, 1); } else { echo '0,' . $r->prijs; } ?></span></p>
				</td>
				<td>
					<?php if($this->session->userdata('typeid') != 2){ ?>
					<div class="socialmedia" style="<?php if($r->publiekelijk != 1){ echo "display: none;"; }?>">
						<div id="fb-root"></div>
						<script>(function(d, s, id) {
						  var js, fjs = d.getElementsByTagName(s)[0];
						  if (d.getElementById(id)) return;
						  js = d.createElement(s); js.id = id;
						  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=164794886939768";
						  fjs.parentNode.insertBefore(js, fjs);
						}(document, 'script', 'facebook-jssdk'));</script>
						<div class="fb-like" data-href="http://127.0.0.1/pizzario/index.php/product_cont?ref=fb&productid=<?php echo $r->productid; ?>" data-send="false" data-layout="button_count" data-width="120" data-show-faces="false"></div>
						
						<a href="http://127.0.0.1/pizzario/index.php/product_cont?ref=tw&productid=<?php echo $r->productid; ?>" class="twitter-share-button" data-hashtags="Pizzario">Tweet</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
					</div>
					<?php } ?>
				</td>
				<td class="aantal">
					<img id="plus" class="bestellenButtons" src="http://127.0.0.1/pizzario/images/img_order_plus.png" onmouseout="this.src='http://127.0.0.1/pizzario/images/img_order_plus.png'" onmouseover="this.src='http://127.0.0.1/pizzario/images/img_order_plus_mouseover.png'">
					<input id="aantal1" class="aantal" type="text" name="aantal" value="0">
					<img id="min" class="bestellenButtons" src="http://127.0.0.1/pizzario/images/img_order_min.png" onmouseout="this.src='http://127.0.0.1/pizzario/images/img_order_min.png'" onmouseover="this.src='http://127.0.0.1/pizzario/images/img_order_min_mouseover.png'">
				</td>
				<td>
					<img id="<?php echo $r->productid; ?>" class="bestellen" height="16px" src="http://127.0.0.1/pizzario/images/img_order_cart.png" onmouseout="this.src='http://127.0.0.1/pizzario/images/img_order_cart.png'" onmouseover="this.src='http://127.0.0.1/pizzario/images/img_order_cart_mouseover.png'"style="cursor: pointer;">
				</td>
				<td> 
					<h5 style="display: inline;">publiekelijk</h5>
					<input class="publiekelijk" style="display: inline;" type="checkbox" <?php if($r->publiekelijk == 1){ echo "checked=\"checked\""; }?> />
					<br /> <form method="post" action="<?php echo base_url(); ?>index.php/product_cont/creator"><input type="submit" value="product wijzigen" name="button" /> <input type="hidden" name="productid" value="<?php echo $r->productid; ?>"/></form>
					<form method="post" action="<?php echo base_url(); ?>index.php/user/product"><input class="verwijder" type="submit" value="Verwijderen" name="button" onclick="confirm()"/> <input type="hidden" name="productid" value="<?php echo $r->productid; ?>"/></form><br />
				</td>
				</tr>
			<?php } ?>
		</table>
		<?php } else { ?>
			<p>Je hebt geen producten</p>
		<?php } ?>
							
	</div>
	<script src="<?php echo base_url(); ?>js/jquery.numeric.js"></script>
	
<script>
(function( $ ){
	
	var $span = $('span#publiekelijkcount');
		
	
	$('input.aantal').numeric();
	
	$('td.aantal').on('click', 'img', function(e){
		var $this = $(this);
		var input = $this.siblings('input');
		var value = parseInt(input.attr('value'));
		if($this.attr('id') === 'plus'){
			if(value+1 >= 100){ return; }
			input.attr('value', value+1);
		} else {
			if(value-1 < 0){ return; }
			input.attr('value', value-1);
		}
	});
	
	$('img.bestellen').on('click', function(e){
		$this = $(this);
		$.ajax({
				url: '<?php echo base_url(); ?>index.php/product_cont',
				type: 'POST',
				data: {id: $this.parents('tr').attr('id'), qty: $this.parents('tr').find('input.aantal').attr('value'), price: $this.parents('tr').find('span.prijs').html().replace(',', '.'), name: $this.parents('tr').find('h3').html()},
				success: function(result){
					if(result === 'success'){
						//succes callback
					} else {
						//error
					}
				}
		});
	});
	
	$('input.verwijder').on('click', function(e){
		if(confirm('Weet u het zeker')){
			return;
		} else {
			e.preventDefault();
		}
	});
	
	$('input.publiekelijk').on('click', function(e){
		
		var $this = $(this),
			spanText = parseInt($span.html());
		
		<?php if($this->session->userdata('typeid') != 2){ ?>
		if(spanText >= 5 && $this.attr('checked')){
			alert('u heeft al 5 publiekelijke producten');
			e.preventDefault();
			return;
		}
		<?php } ?>
		var parent =  $this.parents('tr'),
			id = parent.attr('id'),
			varnew = '',
			socialmediaDiv = parent.find('div.socialmedia');

		if($this.attr('checked')){
			var checked = true;
			$span.text(spanText+1);
			socialmediaDiv.show();
			varnew = 1;
		} else {
			var checked = false;
			$span.text(spanText-1);
			socialmediaDiv.hide();
			varnew = 0;
		}
		
		$.ajax({
			url: '<?php echo base_url(); ?>index.php/user/product',
			type: 'POST',
			data: {productid: id, new: varnew, userid: '<?php echo $this->session->userdata('gebruikerid'); ?>', check: checked},
			success: function(results) {
				if(results === 'failed'){
					//iets
				}
			}
		});
	});
})( jQuery );
</script>
<?php $this->load->view('includes/footer') ?>