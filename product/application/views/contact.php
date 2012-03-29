<?php $this->load->view('includes/header') ?>

	<div id="content">
		<table id="contactTable">
			<tr><td>Adres</td><td><?php print_r($contact[0]->adres); ?></td></tr>
			<tr><td>Postcode</td><td><?php print_r($contact[0]->postcode); ?></td></tr>
			<tr><td>Plaats</td><td><?php print_r($contact[0]->plaats); ?></td></tr>
			<tr><td>Land</td><td><?php print_r($contact[0]->land); ?></td></tr>
			<tr><td>Telefoon</td><td><?php print_r($contact[0]->telefoon); ?></td></tr>
			<tr><td>Fax</td><td><?php print_r($contact[0]->fax); ?></td></tr>
			<tr><td>Email</td><td><?php print_r($contact[0]->email); ?></td></tr>
			<tr><td>Twitter</td><td><?php print_r($contact[0]->twitter); ?></td></tr>
			<tr><td>Facebook</td><td><?php print_r($contact[0]->facebook); ?></td></tr>
		</table>
	</div>	
	
<?php $this->load->view('includes/footer') ?>