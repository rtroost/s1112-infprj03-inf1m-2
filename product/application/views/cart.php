<?php $this->load->view('includes/header');?>
<div id="content">
	<?php
	if($this->cart->total_items() == 0) {
		echo '<p>Je winkelwagen is leeg!</p>';
	} else {
		echo form_open('cart/update_cart');
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
					<td><?php echo anchor('cart/remove/' . $item['rowid'], '<img src="' . base_url() . 'images/validationError.png" />');?></td>
				</tr>
				<?php $i++;?>
			<?php endforeach;?>
			<tr>
				<td>-</td>
				<td>Verzendkosten</td>
				<td>-</td>
				<td>-</td>
				<td>€ 1,95</td>
				<td>-</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<th scope="row">Totaal</th>
				<td></td>
				<td></td>
				<td></td>
				<td class="upperBorder">€ <?php echo $this -> cart -> format_number($this -> cart -> total() + 1.95);?></td>
				<td></td>
			</tr>
		</tfoot>
	</table>
	<br />
	<div class="checkout-div">
		<?php echo form_submit('', 'Update your Cart');?>
		<?php echo form_button('', 'Check Out', 'onClick="javascript: location.href=\'cart/checkout/\'"');?>
		<?php echo form_button('', 'Clear Cart', 'onClick="javascript: location.href=\'cart/clear_cart/\'"');?>
	</div>
</form> <?php }?>
</div>
<?php $this->load->view('includes/footer');?>