<?php $this->load->view('includes/header') ?>

<div id="content">
	
	<h2>Beheer contactgegevens</h2>
	
	<div id="contactGegevens">
		<table id="beheerContactTable">
				<tr><td id="contactTd1">Adres</td><td><input id="adres2" name="adres2" class="contactInput" disabled value="<?php print_r($contact[0]->adres)?>"</td></tr>
				<tr><td id="contactTd1">Postcode</td><td><input id="postcode2" name="postcode2" class="contactInput" disabled value="<?php print_r($contact[0]->postcode)?>"</td></tr>
				<tr><td id="contactTd1">Plaats</td><td><input id="plaats2" name="plaats2" class="contactInput" disabled value="<?php print_r($contact[0]->plaats)?>"</td></tr>
				<tr><td id="contactTd1">Land</td><td><input id="land2" name="land2" class="contactInput" disabled value="<?php print_r($contact[0]->land)?>"</td></tr>
				<tr><td id="contactTd1">Telefoon<td><input id="telefoon2" name="telefoon2" class="contactInput" disabled value="<?php print_r($contact[0]->telefoon)?>"</td></tr>
				<tr><td id="contactTd1">Fax</td><td><input id="fax2" name="fax2" class="contactInput" disabled value="<?php print_r($contact[0]->fax)?>"</td></tr>
				<tr><td id="contactTd1">Email</td><td><input id="email2" name="email2" class="contactInput" disabled value="<?php print_r($contact[0]->email)?>"</td></tr>
				<tr><td id="contactTd1">Twitter</td><td><input id="twitter2" name="twitter2" class="contactInput" disabled value="<?php print_r($contact[0]->twitter)?>"</td></tr>
				<tr><td id="contactTd1">Facebook</td><td><input id="facebook2" name="facebook2" class="contactInput" disabled value="<?php print_r($contact[0]->facebook)?>"</td></tr>		
		</table>

		<div id="contactNavigatie">
			<input name="wijzigContact" id="wijzigContact" onmousedown="wijzigContact()" type="button" value="Wijzig">
			<input name="cancelContact" id="cancelContact" onmousedown="cancelContact()" type="button" disabled value="Annuleer"><br>
			<div id="contactResultaat""></td></tr></div>
		</div>
	
</div>

<?php $this->load->view('includes/footer') ?>