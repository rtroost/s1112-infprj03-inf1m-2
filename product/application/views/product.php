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

table#mijnproducten tr:last-child td{
	border-bottom: none;
}

table#mijnproducten th{
	color: #C0A55A;
    font-family: calibri;
    font-size: 18px;
    font-weight: bold;
}


/* 800 */
table#mijnproducten td:nth-child(1){ width: 460px; }
table#mijnproducten td:nth-child(2){ width: 80px; }
table#mijnproducten td:nth-child(3){ width: 100px; }

input[type=submit]{
	width: 110px;
}
</style>
	<div id="content">
		<h1>Mijn Favorieten</h1><br />
		<?php if(isset($rows)){?>
		<table id="mijnproducten" cellspacing="0px">
			<tr>
				<th>Producten</th>
				<th style="padding-left: 14px;">Aantal</th>
				<th>Bestellen</th>
			</tr>
			<tr id="<?php echo $rows->productid; ?>" data-mediatype="<?php if(isset($ref)){ echo "true"; }?>">
			<td> 
				<h3><?php echo $rows->naam; ?></h3>
				<p><b>Eigenaar: </b> <?php echo $rows->eigenaar_naam; ?></p>
				<p><b>Categorie: </b> <?php echo $rows->categorienaam; ?></p>
				<p><b>Ingredienten: </b><?php $count = 1; foreach($rows->names as $naam){ if($count != count($rows->names)){ echo $naam . ", "; } else { echo $naam; } $count++;}?></p>
				<p><b>Prijs: </b> €<span class="prijs"><?php if(strlen($rows->prijs) == 4){ echo substr($rows->prijs, 0, 2) . ',' . substr($rows->prijs, 2);	} 
							else if(strlen($rows->prijs) == 3){ echo substr($rows->prijs, 0, 1) . ',' . substr($rows->prijs, 1); } else { echo '0,' . $rows->prijs; } ?></span></p>
			</td>
			<td class="aantal">
				<div style="margin-right: 30px;">
					<img id="plus" class="bestellenButtons" src="http://127.0.0.1/pizzario/images/img_order_plus.png" onmouseout="this.src='http://127.0.0.1/pizzario/images/img_order_plus.png'" onmouseover="this.src='http://127.0.0.1/pizzario/images/img_order_plus_mouseover.png'">
					<input id="aantal1" class="aantal" type="text" name="aantal" value="0">
					<img id="min" class="bestellenButtons" src="http://127.0.0.1/pizzario/images/img_order_min.png" onmouseout="this.src='http://127.0.0.1/pizzario/images/img_order_min.png'" onmouseover="this.src='http://127.0.0.1/pizzario/images/img_order_min_mouseover.png'">
				</div>			
			</td>
			<td>
				<img id="<?php echo $rows->productid; ?>" class="bestellen" height="16px" src="http://127.0.0.1/pizzario/images/img_order_cart.png" onmouseout="this.src='http://127.0.0.1/pizzario/images/img_order_cart.png'" onmouseover="this.src='http://127.0.0.1/pizzario/images/img_order_cart_mouseover.png'"style="cursor: pointer;">
			</td>
			</tr>
		</table>
		<?php } else { ?>
			<p>niet gevonden</p>
		<?php } ?>
							
	</div>
	<script src="<?php echo base_url(); ?>js/jquery.numeric.js"></script>
	
<script>
(function( $ ){
	
	
	
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
		console.log($this.parents('tr').data('mediatype'));
		$.ajax({
				url: '<?php echo base_url(); ?>index.php/product_cont',
				type: 'POST',
				data: {id: $this.parents('tr').attr('id'), qty: $this.parents('tr').find('input.aantal').attr('value'), price: $this.parents('tr').find('span.prijs').html().replace(',', '.'), name: $this.parents('tr').find('h3').html(), mediatype: $this.parents('tr').data('mediatype')},
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

		$this = $(this);
		if($this.attr('checked')){
			var checked = true;
		} else {
			var checked = false;
		}

		var id = $this.parents('tr').attr('id'),
			varnew = '';
			
		if($this.attr('checked') === 'checked'){
			varnew = 1;
		} else {
			varnew = 0;
		}
		
		
		$.ajax({
			url: '<?php echo base_url(); ?>index.php/mijnprofiel_cont/product',
			type: 'POST',
			data: {productid: id, new: varnew, userid: '<?php echo $this->session->userdata('gebruikerid'); ?>', check: checked},
			success: function(results) {
				if(results === 'publiekelijk'){
					//$('<p>', {text: 'u heeft al 5 publiekelijke producten', style: 'color: red;'}).insertAfter($this);
					$this.removeAttr('checked');
					alert('u heeft al 5 publiekelijke producten');
				} else if(results === 'failed'){
					//iets
				} else {
				}
			}
		});
	});
})( jQuery );
</script>
<?php $this->load->view('includes/footer') ?>