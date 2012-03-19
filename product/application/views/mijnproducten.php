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
table#mijnproducten td:nth-child(1){ width: 710px; }
table#mijnproducten td:nth-child(2){ width: 60px; }

input[type=submit]{
	width: 110px;
}

</style>
	<div id="content">
		<h1>Mijn producten</h1>
		
		<table id="mijnproducten" cellspacing="0px">
			<?php foreach($rows as $r){ ?>
				<tr id="<?php echo $r->productid; ?>">
				<td> 
					<h3><?php echo $r->product[0]->naam; ?></h3>
					<p><b>Categorie: </b> <?php echo $r->categorienaam; ?></p>
					<p><b>Ingredienten: </b><?php foreach($r->names as $naam){ echo $naam . ", "; }?></p>
					<p><b>Aangemaakt op: </b> <?php echo $r->aanmaak_datetime; ?></p>
				</td>
				<td> 
					<h5 style="display: inline;">publiekelijk</h5>
					<input class="publiekelijk" style="display: inline;" type="checkbox" <?php if($r->publiekelijk == 1){ echo "checked=\"checked\""; }?> />
					<br /> <form method="post" action="<?php echo base_url(); ?>index.php/product_cont/creator"><input type="submit" value="product wijzigen" name="button" /> <input type="hidden" name="productid" value="<?php echo $r->productid; ?>"/></form>
					<form method="post" action="<?php echo base_url(); ?>index.php/mijnprofiel_cont/product"><input class="verwijder" type="submit" value="Verwijderen" name="button" onclick="confirm()"/> <input type="hidden" name="productid" value="<?php echo $r->productid; ?>"/></form><br />
				</td>
				</tr>
			<?php } ?>
		</table>
		
							
	</div>
	
	
<script>
(function( $ ){
	
	$('input.verwijder').on('click', function(e){
		if(confirm('Weet u het zeker')){
			return;
		} else {
			e.preventDefault();
		}
	});
	
	$('input.publiekelijk').on('change', function(){

		$this = $(this);
		
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
			data: {productid: id, new: varnew},
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