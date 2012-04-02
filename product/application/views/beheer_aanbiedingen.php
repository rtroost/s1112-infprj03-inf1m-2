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

/* HTML en PHP opmaak voor het beheren van aanbiedingen */
</style>
	<div id="content">
		<div id="titelAanbiedingen">
			<h2>Aanbiedingen beheer</h2>
		</div>
		<div id="navigatieAanbiedingen">
			U kunt maximaal 5 producten in de aanbieding plaatsen. <br><span id="aanbiedingcount"><?php echo $aanbiedingcountcount; ?></span> aanbiedingen geselecteerd.
		</div>
		
		<?php if(count($rows) != 0){ ?>
		<table id="mijnproducten" cellspacing="0px">
		
			<?php foreach($rows as $r){ ?>
				<tr id="<?php echo $r->productid; ?>">
				<td> 
					<b><?php echo $r->naam; ?></b>
					<p>Categorie: <i><?php echo $r->categorienaam; ?></i></p>
					
					
					<p>Prijs: <b>€<span class="prijs"><?php if(strlen($r->prijs) == 4){ echo substr($r->prijs, 0, 2) . ',' . substr($r->prijs, 2);	} 
								else if(strlen($r->prijs) == 3){ echo substr($r->prijs, 0, 1) . ',' . substr($r->prijs, 1); } else { echo '0,' . $r->prijs; } ?></b></span></p>
				</td>
				
				<td> 
					<h5 style="display: inline;">Aanbieding</h5>
					<input class="aanbieding" style="display: inline;" type="checkbox" <?php if($r->aanbieding == 1){ echo "checked=\"checked\""; }?> />
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
	
	var $span = $('span#aanbiedingcount');
		
	$('input.aanbieding').on('click', function(e){
		
		var $this = $(this),
			spanText = parseInt($span.html());
			
		if(spanText >= 5 && $this.attr('checked')){
			alert('u heeft al 5 producten in de aanbieding ');
			e.preventDefault();
			return;
		}
		var parent =  $this.parents('tr'),
			id = parent.attr('id'),
			varnew = '';

		if($this.attr('checked')){
			var checked = true;
			$span.text(spanText+1);
			varnew = 1;
		} else {
			var checked = false;
			$span.text(spanText-1);
			varnew = 0;
		}
		
		$.ajax({
			url: '<?php echo base_url(); ?>index.php/beheer_aanbiedingen_cont',
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