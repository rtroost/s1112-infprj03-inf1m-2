<script>
	$(document).ready(function() {
		$('#delete').click(function() {
			//Delete info from cookie
			
			//Remove line
			$(this).parents('tr').hide('slow');
		});
	});
</script>
<table class="winkelwagen">
	<thead>
		<tr>
			<th>Product ID</th>
			<th>Omschrijving</th>
			<th>Aantal</th>
			<th>Prijs per product</th>
			<th>Sub-totaal</th>
			<th>Delete</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th scope="row">Total</th>
			<td></td>
			<td></td>
			<td></td>
			<td>€ 11,00</td>
		</tr>
	</tfoot>
	<tbody>
		<tr>
			<td>1</td>
			<td>Margarita!</td>
			<td>
			<input type="text" name="order-1" id="order-1" size="1" value="2" />
			</td>
			<td>€ 5,50</td>
			<td>€ 11,00</td>
			<td><a href="#" id="delete">X</a></td>
		</tr>
	</tbody>
</table>