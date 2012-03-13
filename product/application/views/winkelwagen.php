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
		font-family: "Trebuchet MS", sans-serif;
		font-size: 11px;
		line-height: 1.4em;
		padding: 6px 6px 6px 6px;
		border: 0;
		width: 90%;
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
		$('.update').click(function() {
			//Update quanTITIES with JSON
		});

		$('#winkelwagen').submit(function(e) {

			e.preventDefault();

			/* Sending the form fileds to submit.php: */
			$.post('submit.php', $(this).serialize(), function() {
			}, 'json');
		});

		$('#update').click(function() {
			var $kids = $('#winkelwagen').children('tbody').children('tr');
			var $rowids = '';

			for(var i = 0; i < $kids.length; i++) {
				$rowids = $rowids.concat($kids.eq(i).attr('id') + '=' + $kids.eq(i).children('td').eq(2).children('input').attr('value') + '&');
			}
			console.log($rowids);

			$.ajax({
				url : 'winkelwagen/update',
				type : 'POST',
				data : $rowids,
				success : function(result) {
				}
			});
		});
	});

</script>
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
				<th>Sub-totaal</th>
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
				<td><?php echo anchor('winkelwagen/remove/' . $item['rowid'], 'X');?></td>
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
		<?php echo form_submit('', 'Update your Cart');?>
		<input type="button" size="5" value="Check-out &rarr;" id="checkout" />
		<?php echo form_button('', 'Clear Cart', 'onClick="javascript: location.href=\'winkelwagen/clear_cart\'"');?>
	</div>
	</form> <?php } //endif?>
</div>