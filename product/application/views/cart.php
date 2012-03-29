<?php $this->load->view('includes/header');?>
<div id="content">
	<?php
	if($this->cart->total_items() == 0) {
		echo '<p>Je winkelwagen is leeg!</p>';
	} else {
		echo form_open('cart/update_cart');
		?>
		<table class="cart">
			<thead>
				<tr>
					<th>#</th>
					<th>Omschrijving</th>
					<th>Aantal</th>
					<th>Prijs per product</th>
					<th>Subtotaal</th>
					<th>Verwijder</th>
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
			<?php if($this -> session -> userdata('discount') == TRUE) { ?>
				<tr>
				<td>-</td>
				<td> 10% korting voor 20 punten</td>
				<td>-</td>
				<td>-</td>
				<td>€ -<?php echo $this -> cart -> format_number($this -> cart -> total() * 0.1); ?></td>
				<td><?php echo anchor('cart/discount/remove', '<img src="' . base_url() . 'images/validationError.png" />');?></td>
			</tr>
			<?php } ?>
			<tr>
				<td>-</td>
				<td>Verzendkosten</td>
				<td>-</td>
				<td>-</td>
				<td>€ 1,95</td>
				<td></td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<th scope="row">Totaal</th>
				<td></td>
				<td></td>
				<td></td>
				<td class="upperBorder">
					€ 
				<?php
					if($this -> session -> userdata('discount') == FALSE) {
						echo $this -> cart -> format_number($this -> cart -> total() + 1.95);
					} else {
						echo $this -> cart -> format_number($this -> cart -> total() - ($this -> cart -> total() * 0.1) + 1.95);
					}					
				?>
				</td>
				<td></td>				
			</tr>			
		</tfoot>
	</table>
	<br />
	<?php $discountP = $this -> cart_model -> getDiscountP($this -> session -> userdata('gebruikerid')); ?>
	<div class="checkout-div">
		<?php echo form_submit('', 'Voer wijzigingen door');?>
		<?php echo form_button('', 'Betalen', 'onClick="javascript: location.href=\''.base_url().'index.php/cart/checkout/\'"');?> 
		<?php if($discountP > 20 && $this -> session -> userdata('discount') == FALSE) echo form_button('', '20/'.$discountP.' kortingspunten gebruiken', 'onClick="javascript: location.href=\'cart/discount/\'"');?>
		<?php echo form_button('', 'Maak winkelwagen leeg', 'onClick="javascript: location.href=\''.base_url().'index.php/cart/clear_cart/\'"');?>
	</div>
</form>
<?php }?>
</div>
<?php $this->load->view('includes/footer');?>