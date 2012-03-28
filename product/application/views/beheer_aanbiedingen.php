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

input[type=submit]{
	width: 110px;
}

</style>
	<div id="content">
		<h1>Mijn producten</h1><br />
		<h3>Let op! U mag maximaal 5 producten publiekelijk maken. U heeft <span id="publiekelijkcount"><?php echo $publiekelijkcount; ?></span> publiekelijke producten.</h3>
		<?php if(count($rows) != 0){ ?>
		<table id="mijnproducten" cellspacing="0px">
			<tr>
				<th>Producten</th>
				<th>Aanbieding</th>

			</tr>
			<?php foreach($rows as $r){ ?>
				<tr id="<?php echo $r->productid; ?>">
				<td> 
					<h3><?php echo $r->product[0]->naam; ?></h3>
					<p><b>Categorie: </b> <?php echo $r->categorienaam; ?></p>
					<p><b>Ingredienten: </b><?php $count = 1; if(count($r->names) != 0){ foreach($r->names as $naam){ if($count != count($r->names)){ echo $naam . ", "; } else { echo $naam; } $count++;} }?></p>
					<p><b>Aangemaakt op: </b> <?php echo $r->aanmaak_datetime; ?></p>
					<p><b>Prijs: </b> €<span class="prijs"><?php if(strlen($r->prijs) == 4){ echo substr($r->prijs, 0, 2) . ',' . substr($r->prijs, 2);	} 
								else if(strlen($r->prijs) == 3){ echo substr($r->prijs, 0, 1) . ',' . substr($r->prijs, 1); } else { echo '0,' . $r->prijs; } ?></span></p>
				</td>
				
				<td> 
					<h5 style="display: inline;">Aanbieding</h5>
					<input class="publiekelijk" style="display: inline;" type="checkbox" <?php if($r->publiekelijk == 1){ echo "checked=\"checked\""; }?> />
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
		
	$('input.publiekelijk').on('click', function(e){
		
		var $this = $(this),
			spanText = parseInt($span.html());
			
		if(spanText >= 5 && $this.attr('checked')){
			alert('u heeft al 5 publiekelijke producten');
			e.preventDefault();
			return;
		}
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