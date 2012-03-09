<style type="text/css" media="screen">
	table.winkelwagen {
		font-family: "Trebuchet MS", sans-serif;
		font-size: 16px;
		line-height: 1.4em;
		font-style: normal;
		border-collapse: separate;
		width: 100%;
	}
	table.winkelwagen tr {
		height: 30px;
	}
	table.winkelwagen th {
		font: bold 11px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
		color: #6D929B;
		border-right: 1px solid #C1DAD7;
		border-bottom: 1px solid #C1DAD7;
		border-top: 1px solid #C1DAD7;
		letter-spacing: 2px;
		text-transform: uppercase;
		text-align: left;
		padding: 6px 6px 6px 12px;
	}
	table.winkelwagen td {
		padding: 6px 6px 6px 12px;
		color: #6D929B;
	}
	table.winkelwagen input[type=text] {
		font: bold 11px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
		width: 80%;
		border: 0;
		border-bottom: 1px #222 inset;
		background: transparent;
		text-align: right;
	}
	
	div.checkout-div {
		width: 100%;
		text-align: right;
	}
	
	div.checkout-div input[type="submit"], div.checkout-div input[type="button"] {
		border: 1px solid #39adf0;
		background: #6ac7fc;
		color: white;
		font-size: 14px;
/*		width: 200px;*/
		text-transform: uppercase;
		font-weight: bold;
		font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
		text-shadow: 1px 1px 0 #7a7a7a;
		padding: 12px;
		cursor: pointer;
	}
	div.checkout-div input[type="submit"]:hover, div.checkout-div input[type="button"]:hover {
		background: #70d2fd;
	}
	
</style>
<script>
	$(document).ready(function() {
		$('.delete').click(function() {
			//Delete info from cookie

			//Remove line
			$(this).parents('tr').hide('slow');
		});
	});

</script>
<table class="winkelwagen">
	<thead>
		<tr>
			<th>#</th>
			<th>Omschrijving</th>
			<th>Aantal</th>
			<th>Prijs per product</th>
			<th>Sub-totaal</th>
			<th>Delete</th>
		</tr>
	</thead>
	<tbody>
		<?php $i = 1;?>
		<?php foreach ($this->cart->contents() as $items):
		?>
		<tr id="<?php echo $items['rowid'];?>">
			<td><?php echo $i;?></td>
			<td><?php echo $items['name'];?></td>
			<td>
			<input type="text" value="<?php echo $items['qty'];?>" />
			</td>
			<td>€ <?php echo $this -> cart -> format_number($items['price']);?></td>
			<td>€ <?php echo $this -> cart -> format_number($items['subtotal']);?></td>
			<td><a href="#" class="delete">Remove</a></td>
		</tr>
		<?php $i++;?>
		<?php endforeach;?>
	</tbody>
	<tfoot>
		<tr>
			<th scope="row">Total</th>
			<td></td>
			<td></td>
			<td></td>
			<td>€ <?php echo $this -> cart -> format_number($this -> cart -> total());?></td>
		</tr>
	</tfoot>
</table>
<br />
<div class="checkout-div">
	<input type="button" size="5" value="Save and update" id="update" />
	<input type="button" size="5" value="Check out" id="checkout" />
</div>