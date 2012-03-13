<style type="text/css" media="screen">
	table {
		font: bold 12px "Trebuchet MS", sans-serif;
		line-height: 1.0em;
		padding: 0px;
		border-collapse: collapse;
		width: 100%;
	}
	th {
		font-size: 18px;
		color: #c0a55a;
		height: 25px;
	}
	tr {
		height: 25px;
	}
	td:last-child {
		text-align: right;
	}
	td.upperBorder {
		border-top: 1px #000 solid;
	}
	div.checkout-div {
		width: 100%;
		text-align: right;
	}
	button, div.checkout-div input[type="submit"], div.checkout-div input[type="button"] {
		border: 1px solid #39adf0;
		background: #6ac7fc;
		color: white;
		font-size: 14px;
		text-transform: uppercase;
		font-weight: bold;
		font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
		text-shadow: 1px 1px 0 #7a7a7a;
		padding: 12px;
		cursor: pointer;
	}
	button:hover, div.checkout-div input[type="submit"]:hover, div.checkout-div input[type="button"]:hover {
		background: #70d2fd;
	}
</style>
<div id="content">
	<?php
if($this->cart->total_items() == 0) {
echo '<p>Je winkelwagen is leeg!</p>';
} else {
echo form_open('winkelwagen/update_cart');
	?>
	<table class="winkelwagen" id="winkelwagen">
		<thead>
			<tr>
				<th>#</th>
				<th>Omschrijving</th>
				<th>Aantal</th>
				<th>Prijs per product</th>
				<th>Subtotaal</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php $i = 1;?>
			<?php foreach ($this->cart->contents() as $item):
			?>
			<?php echo form_hidden($i . '[rowid]', $item['rowid']);?>
			<tr>
				<td><?php echo $i;?></td>
				<td><?php echo $item['name'];?></td>
				<td><?php echo form_input(array('name' => $i . '[qty]', 'value' => $item['qty'], 'maxlength' => '3', 'size' => '5'));?></td>
				<td>€ <?php echo $this -> cart -> format_number($item['price']);?></td>
				<td>€ <?php echo $this -> cart -> format_number($item['subtotal']);?></td>
				<td><?php echo anchor('winkelwagen/remove/' . $item['rowid'], '<img src="' . base_url() . 'images/validationError.png" />');?></td>
			</tr>
			<?php $i++;?>
			<?php endforeach;?>
		</tbody>
		<tfoot>
			<tr>
				<th scope="row">Totaal</th>
				<td></td>
				<td></td>
				<td></td>
				<td class="upperBorder">€ <?php echo $this -> cart -> format_number($this -> cart -> total());?></td>
				<td></td>
			</tr>
		</tfoot>
	</table>
	<br />
	<div class="checkout-div">
		<?php echo form_submit('', 'Update your Cart');?>
		<?php echo form_button('', 'Check Out', 'onClick="javascript: location.href=\'winkelwagen/checkout/\'"');?>
		<?php echo form_button('', 'Clear Cart', 'onClick="javascript: location.href=\'winkelwagen/clear_cart/\'"');?>
	</div>
	</form> <?php } //endif?>
</div>